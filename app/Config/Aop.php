<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Aop extends BaseConfig
{
    public $develCi = 'http://localhost:8085';
    public $develAn = 'http://localhost:4200';

     /**
     * Emergency user and password.
     *
     * @var array
     */
    public $emergency = [
        'username' => '$2y$10$6EWtXD0zgVea4w7Is4K80OUhcwgb5fWz6BqCzYJUcUuzTMEYxWVfK', //admin
        'password' => '$2y$10$zgSqKhQ73fkINdN88X7FKeEVM4O2wXfNJGsBXLlGHAzFEjcc8JViu' //admin
    ];

}
