<?php

namespace App\Controllers;

class Aop extends AopBaseController
{
    public function __construct()
    {
        $check = $this->checkDb();
        if ($check->error)
            redirect()->to(base_url('/emergency/aop'));
    }

    public function index()
    {
        return $this->aopRender("main", "/", ['api' => base_url("aop/emergency"), 'oth' => ['io' => 1, 'tu' => '2']]);
    }


}