<?php

// Mostrar erros
error_reporting(E_ALL);
ini_set('display_errors', '1');

header('Content-Type: application/json; charset=UTF-8');

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap/app.php';

use App\Http\Api;

$obApi = new Api($_GET['url']);

echo $obApi->run();
