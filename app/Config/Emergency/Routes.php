<?php

$routes->get('emergency', 'Emergency\Aop::index');
$routes->get('emergency/aop', 'Emergency\Aop::index');
$routes->get('emergency/aop/(:any)', 'Emergency\Aop::index');
$routes->post('emergency/login', 'Emergency\Login::index');