<?php

namespace App\Controllers;

use \Ramsey\Uuid\Uuid;

class Aop extends AopBaseController
{
    public function __construct()
    {
        $check = $this->checkDb();
        if($check->error) redirect()->to(base_url('/aop/emergency'));
    }

    public function index()
    {
        return $this->aopRender("main","/");
    }

    public function blank()
    {

        $userModel = new \App\Models\Api\Users();
        //$userModel->save(['email'=>'liadserv@gmail.com', 'first_name'=>'Paolo', 'last_name' =>'Rampino', 'password' => '1234']);
        var_dump($userModel->findAll());
        return 'pippo';
    }

    public function emergency()
    {
        $session = \Config\Services::session();
        if ($session->uuid == null) $session->uuid = Uuid::uuid4()->toString();
        $aop = new \Config\Aop();
        if ($json = $this->request->getJSON()) {
            $keys = array_keys((array)$json);
            foreach ($keys as $key) {
                switch ($key) {
                    case 'login':
                        if (password_verify($json->login->user, $aop->emergency['username']) && password_verify($json->login->pass, $aop->emergency['password'])) {
                            return $this->renderJson(['uuid' => $session->uuid]);
                        }
                        break;
                }
            }
            return $this->renderJson(['status' => 'forbidden']);
        } else {
            return $this->aopRender("emergency", "aop/emergency", ['api' => base_url("aop/emergency")]);
        }
    }
}
