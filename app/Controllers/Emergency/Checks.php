<?php

namespace App\Controllers\Emergency;
use CodeIgniter\HTTP\ResponseInterface;

class Checks extends Auth
{

    public function index()
    {
        //
    }

    public function credentials(){
        $aop = new \Config\Aop();
        if (password_verify('admin', $aop->emergency['password'])) {
            return $this->renderJson(['status' => 'Change default credentials', 'error' => true], ResponseInterface::HTTP_UNAUTHORIZED);
        } else {
            return $this->renderJson(['status' => 'Ok', 'error' => false]);
        }
    }
}
