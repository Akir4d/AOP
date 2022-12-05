<?php

namespace App\Controllers\Emergency;

class Checks extends BaseController
{

    public function index()
    {
        //
    }

    public function getDbConfig(){
        $dbc = new \Config\Database();
        return $this->renderJson((array) $dbc->default);
    }

}
