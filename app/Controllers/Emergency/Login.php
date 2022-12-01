<?php

namespace App\Controllers\Emergency;

use App\Controllers\AopBaseController;
use \CodeIgniter\HTTP\ResponseInterface;
use \Ramsey\Uuid\Uuid;

class Login extends AopBaseController
{

    public function index()
    {
        $session = \Config\Services::session();
        if ($session->uuid == null) {
            $session->uuid = Uuid::uuid4()->toString();
        }

        $aop = new \Config\Aop();
        $this->cors();
        if ($json = $this->request->getJSON()) {
            $keys = array_keys((array) $json);
            foreach ($keys as $key) {
                switch ($key) {
                    case 'username':
                        if (password_verify($json->username, $aop->emergency['username']) && password_verify($json->password, $aop->emergency['password'])) {
                            return $this->renderJson([
                                'id' => 1,
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
