<?php

$routes->get('emergency', 'Emergency\Aop::index');
$routes->get('emergency/aop', 'Emergency\Aop::index');
$routes->get('emergency/aop/(:any)', 'Emergency\Aop::index');
$routes->get('emergency/checks/dbConfig', 'Emergency\Checks::getDbConfig');

$routes->post('emergency/login', 'Emergency\Login::postLogin');
$routes->post('emergency/login/checks', 'Emergency\Login::postChecks');
$routes->post('emergency/users/adminUser', 'Emergency\Users::postAdminUser');
