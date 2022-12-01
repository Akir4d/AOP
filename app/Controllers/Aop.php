<?php

namespace App\Controllers;

class Aop extends AopBaseController
{
    public function __construct()
    {
        $check = $this->checkDb();
        if ($check->error)
            redirect()->to(base_url('/aop/emergency'));
    }

    public function index()
    {
        return $this->aopRender("main", "/", ['api' => base_url("aop/emergency"), 'oth' => ['io' => 1, 'tu' => '2']]);
    }




    public function emergency()
    {
        return $this->aopRender("emergency", "aop/emergency", ['api' => base_url("emergency")]);
    }


}