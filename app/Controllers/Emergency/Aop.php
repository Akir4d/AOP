<?php

namespace App\Controllers\Emergency;
use Ramsey\Uuid\Uuid;

class Aop extends BaseController
{

    private function _construct()
    {
        $test = explode(' ', $this->request->getServer("HTTP_AUTHORIZATION"));
        $uuid = "";
        if ($test[0] = "Bearer") {
            $session = \Config\Services::session();
            if ($session->uuid == null) {
                $session->uuid = Uuid::uuid4()->toString();
            }
            $uuid = $test[1];
            if ($session->uuid !== $uuid) {
                redirect()->to(base_url('emergency/aop/login'));
            }
        } 
    }

    public function index()
    {
        return $this->aopRender("emergency", "emergency/aop", ['api' => base_url("emergency")]);
    }

}
