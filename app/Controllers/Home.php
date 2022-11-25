<?php

namespace App\Controllers;

class Home extends BaseController
{
    
    public function index()
    {
        $migrate = \Config\Services::migrations();
        try {
            $migrate->latest();
        } catch (\Throwable $e) {
            // Do something with the error here...
        }
        $du=DEVEL_CSERVE;
        $file=FCPATH . 'main.html';
        if (substr(base_url(), 0, strlen($du))==$du) {
            $du=DEVEL_ASERVE;
            $file = $du.'/main.html';
            file_put_contents(APPPATH . "Views/main.php", preg_replace('/<base.*?>/m', '<base href="'.$du.'">', file_get_contents($file)));
        } else {
            if(file_exists($file)) {
                $du = base_url() . '/';
                file_put_contents(APPPATH . "Views/main.php", preg_replace('/<base.*?>/m', '<base href="'.$du.'">', file_get_contents($file)));
                if(strpos($du, 'localhost') === false) unlink($file);
            } 
        }

        return view('main');
    }

    public function blank(){
        
        $userModel = new \App\Models\Api\Users();
        //$userModel->save(['email'=>'liadserv@gmail.com', 'first_name'=>'Paolo', 'last_name' =>'Rampino', 'password' => '1234']);
        var_dump($userModel->findAll());
        return 'pippo';
    }
}