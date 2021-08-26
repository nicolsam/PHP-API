<?php

// Mostrar erros
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap/app.php';

use \App\Models\User;

if(!$_GET['url']) {
    die('Variável url não existe');
}

$url = explode('/', $_GET['url']);

if(!$url[0] === 'api') {
    die('API não está sendo acessada');
}

$users = User::get(1);

echo '<pre>';
print_r($users);
echo '</pre>';
