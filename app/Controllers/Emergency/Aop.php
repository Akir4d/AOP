<?php

namespace App\Controllers\Emergency;

class Aop extends BaseController
{
    public function index()
    {
        return $this->aopRender("emergency", "emergency/aop", ['api' => base_url("emergency")]);
    }

}
