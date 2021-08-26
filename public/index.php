<?php

// Mostrar erros
error_reporting(E_ALL);
ini_set('display_errors', '1');

header('Content-Type: application/json');

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap/app.php';

use \App\Models\User;
use \Exception;

if(!$_GET['url']) {
    die('Variável url não existe');
}

$url = explode('/', $_GET['url']);

if(!$url[0] === 'api') {
    die('A URI da API não está sendo corretamente utilizada');
}

array_shift($url);
$service =  'App\Services\\' . ucfirst($url[0]) . 'Service';

array_shift($url);
$method = strtolower($_SERVER['REQUEST_METHOD']);

$data = [
    'status' => 'failed',
    'data' => null,
];

try {
    
    $response = call_user_func_array([new $service, $method], $url);

    if(!$response) {
        throw new Exception("This user doesn't exist!");
        exit;
    }

    http_response_code(200);

    $data['status'] = 'success';
    $data['data'] = $response;

    echo json_encode($data);
    exit;

} catch(Exception $error) {
    http_response_code(404);

    $data['data'] = $error->getMessage();
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}
