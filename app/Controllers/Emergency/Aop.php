<?php

namespace App\Controllers\Emergency;
use Ramsey\Uuid\Uuid;

class Aop extends BaseController
{

    private function _construct()
    {
        $test = explode(' ', $this->request->getServer("HTTP_AUTHORIZATION"));
        if ($test[0] !== "Bearer") redirect()->to(base_url('emergency/aop/login'));
    }

    public function index()
    {
        return $this->aopRender("emergency", "emergency/aop", ['api' => base_url("emergency")]);
    }

}
