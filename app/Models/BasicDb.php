<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class BasicDb
{
    protected $db;

    public function __construct(ConnectionInterface $db)
    {
        $this->db = $db;
    }

    public function testConnection(){
        $db2 = new ConnectionInterface();
    }
}