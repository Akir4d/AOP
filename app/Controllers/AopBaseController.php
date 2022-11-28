<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

/**
 * Class AopBaseController
 *
 * AopBaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers with Aop fetures on!
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class AopBaseController extends BaseController
{

    protected $styles = [];
    protected $headFooter = ['head' => ['row' => [], 'auto' => []], 'footer' => ['row' => [], 'auto' => []]];

    /**
     * Add Styles to head 
     *
     * @param [type] $value type 
     * @param string $type
     * @return void
     */
    protected function addStyles($value)
    {
        $uniq = md5($value);
        $styles[$uniq] = $value;
    }

    /**
     * Adds Header and Footer stuff!
     *
     * @param [type] $value
     * @param string $type
     * @param string $position
     * @return void
     */
    protected function addHeadFooter($value, $type = "auto", $position="footer")
    {
        $uniq = md5($value);
        switch($type){
            case 'row':
                $this->headFooter[$position]['row'][$uniq] = $value;
                break;
            case 'auto':
                $this->headFooter[$position]['auto'][$uniq] = $value;
                break;
        }
    }

    /**
     * Check db is an optional feature that check and populate db
     *
     * @return object
     */
    protected function checkDb(): object
    {
        $migrate = null;
        $status = (object)['message' => '', 'error' => false, 'debug' => ''];
        try {
            $migrate = \Config\Services::migrations();
        } catch (\Throwable $e) {
            $status->message = "Db Connection Error";
            $status->error = true;
            $status->debug = $e;
        }
        if ($migrate !== null) {
            try {
                $migrate->latest();
            } catch (\Throwable $e) {
                $status->message = "Db Update Error";
                $status->error = true;
                $status->debug = $e;
            }
        }
        return $status;
    }

    protected function renderJson(
        array $responseBody,
        int $code = ResponseInterface::HTTP_OK
    ) {
        return $this
            ->response
            ->setStatusCode($code)
            ->setJSON($responseBody);
    }

    /**
     * Just a common function aopRender and aopModularize
     *
     * @param [type] $module
     * @param [type] $returnPath
     * @param array $arguments
     * @return object
     */
    private function aopPreRender($module, $returnPath, $arguments = []): object
    {
        $config = new \Config\Aop();
        $du = $config->develCi;
        $file = FCPATH . "amodules/$module/index.html";
        $modulePath = "Views/AopAutogen/AopModule";
        $moudelPathAbsolute = APPPATH . $modulePath;
        $args = "";
        if (!empty($arguments)) {
            foreach ($arguments as $k => $v) {
                $args .= ' ' . $k . '="' . $v . '"';
            }
        }
        (file_exists(($moudelPathAbsolute))) || mkdir($moudelPathAbsolute, 0755, true);
        if (substr(base_url(), 0, strlen($du)) == $du) {
            $du = $config->develAn;
            $file = $du . '/index.html';
            file_put_contents("$moudelPathAbsolute/$module.php", preg_replace('/<base.*?>/m', '<base href="' . $du . '"' . $args . '>', file_get_contents($file)));
        } else {
            if (file_exists($file)) {
                $du = base_url($returnPath) . '/';
                file_put_contents("$moudelPathAbsolute/$module.php", preg_replace('/<base.*?>/m', '<base href="' . $du . '"' . $args . '>', file_get_contents($file)));
                if (strpos($du, 'localhost') === false) unlink($file);
            }
        }
        $seg =  str_replace(base_url($returnPath), '', base_url($this->request->getPath()));
        $file = 'amodules/' . $module . $seg;
        //echo $file;
        //die();
        if (is_file(FCPATH . $file)) {
            return (object)['type' => 'redirect', 'file' => $file];
        } else {
            return (object)['type' => 'module', 'file' => "$modulePath/$module"];
        }
    }

    /**
     * aopRender renders an angular module in its entirety, with no additional CSS or JS injections.
     *
     * @param [type] $module Name of module
     * @param [type] $returnPath Controller path or routing, for example: api/users
     * @param array  $arguments Array of arguments to pass to Angular. 
     *               All arguments can be accessed from within the Angular app using 
     *               document.getElementsByTagName("base")[0]. getAttribute("name")
     * 
     * @return string | \CodeIgniter\HTTP\RedirectResponse
     */
    protected function aopRender($module, $returnPath, $arguments = []): string | \CodeIgniter\HTTP\RedirectResponse
    {
        $pre = $this->aopPreRender($module, $returnPath, $arguments);
        if ($pre->type == 'redirect') {
            return redirect()->to(base_url($pre->file));
        } else {
            return view($pre->file);
        }
    }

    /**
     * Make Angualer page integrable inside a Codeigniter page!
     *
     * @param [type] $module Name of module
     * @param [type] $returnPath Controller path or routing, for example: api/users
     * @param array  $arguments Array of arguments to pass to Angular. 
     *               All arguments can be accessed from within the Angular app using 
     *               document.getElementsByTagName("base")[0]. getAttribute("name")
     * @return void
     */
    protected function aopModularize($module, $returnPath, $arguments = [])
    {
        $pre = $this->aopPreRender($module, $returnPath, $arguments);
        if ($pre->type == 'redirect') {
            return redirect()->to(base_url($pre->file));
        } else {
            $file = file_get_contents(APPPATH . $pre->file . '.php');
            $matches = [];
            preg_match('/<body.*?>(.*?)<\/body>/s', $file, $matches);
            // Print the entire match result
            $body = $matches[1];
            $matches = [];
            preg_match('/<head.*?>(.*?)<\/head>/s', $file, $matches);
            // Print the entire match result
            $head = $matches[1];

            // Destructure Angular header
            $doc = new \DOMDocument();
            $doc->loadHTML('<html><head>' . $head . '</head></html>');
            foreach ($doc->getElementsByTagName('base') as $node) {
                $val = $doc->saveXML($node);
                $this->addHeadFooter($val, 'row', 'head');
            }
            foreach ($doc->getElementsByTagName('link') as $node) {
                $val = $doc->saveXML($node);
                if (strpos($val, 'rel="icon"') == false) echo $val . PHP_EOL;
                $this->addHeadFooter($val, 'row', 'head');
            }
            foreach ($doc->getElementsByTagName('script') as $node) {
                $val = $doc->saveXML($node);
                $this->addHeadFooter($val, 'row', 'head');
            }
            foreach ($doc->getElementsByTagName('noscript') as $node) {
                $val = $doc->saveXML($node);
                $this->addHeadFooter($val, 'row', 'head');
            }
            foreach ($doc->getElementsByTagName('style') as $node) {
                $val = $doc->saveXML($node);
                $this->addHeadFooter($val, 'row', 'head');
            }
            
            // Return Body content
            return $body;
        }
    }
}
