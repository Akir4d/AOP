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

    /**
     * Undocumented function
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

    protected function aopRender($module, $mPath, $arguments = [])
    {
        $config = new \Config\Aop();
        $du = $config->develCi;
        $file = FCPATH . "amodules/$module/index.html";
        $modulePath = "Views/AopAutogen/AopModule";
        $moudelPathAbsolute = APPPATH . $modulePath;
        $args="";
        if(!empty($arguments)){
            foreach($arguments as $k => $v) {
                $args .= ' '.$k.'="'.$v.'"';
            }
        }
        (file_exists(($moudelPathAbsolute))) || mkdir($moudelPathAbsolute, 0755, true);
        if (substr(base_url(), 0, strlen($du)) == $du) {
            $du = $config->develAn;
            $file = $du . '/index..html';
            file_put_contents("$moudelPathAbsolute/$module.php", preg_replace('/<base.*?>/m', '<base href="' . $du . '"'.$args.'>', file_get_contents($file)));
        } else {
            if (file_exists($file)) {
                $du = base_url($mPath) . '/';
                file_put_contents("$moudelPathAbsolute/$module.php", preg_replace('/<base.*?>/m', '<base href="' . $du . '"'.$args.'>', file_get_contents($file)));
                if (strpos($du, 'localhost') === false) unlink($file);
            }
        }
        $seg =  str_replace(base_url($mPath), '', base_url($this->request->getPath()));
        $file = 'amodules/'.$module.$seg;
        if(is_file(FCPATH.$file)){
             return redirect()->to(base_url($file));
        } else {
            return view("$modulePath/$module");
        }
        
    }
}
