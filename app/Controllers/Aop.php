<?php

namespace App\Controllers;

use \Ramsey\Uuid\Uuid;
use \CodeIgniter\HTTP\ResponseInterface;
class Aop extends AopBaseController
{
    public function __construct()
    {
        $check = $this->checkDb();
        if($check->error) redirect()->to(base_url('/aop/emergency'));
    }

    public function index()
    {
        return $this->aopRender("main", "/", ['api' => base_url("aop/emergency"), 'oth' => ['io'=>1, 'tu'=>'2']]);
    }




    public function emergency()
    {
            return $this->aopRender("emergency", "aop/emergency", ['api' => base_url("aop")]);
    }

    public function emergencyLogin(){
        $session = \Config\Services::session();
        if ($session->uuid == null) $session->uuid = Uuid::uuid4()->toString();
        $aop = new \Config\Aop();
        $this->cors();
        if ($json = $this->request->getJSON()) {
            $keys = array_keys((array)$json);
            foreach ($keys as $key) {
                switch ($key) {
                    case 'username':
                        if (password_verify($json->username, $aop->emergency['username']) && password_verify($json->password, $aop->emergency['password'])) {
                            return $this->renderJson([
                                'id'=> 1, 
                                'username' => $json->username, 
                                'password' => '********', 
                                'firstName' => 'Emergency', 
                                'lastName' => 'User',
                                'token' => $session->uuid]);
                        }
                        break;
                }
            }
            return $this->renderJson(['status' => 'forbidden'], ResponseInterface::HTTP_UNAUTHORIZED);
        }
    }
}


