<?php

// Mostrar erros
error_reporting(E_ALL);
ini_set('display_errors', '1');

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
    'data' => "This user doesn't exist!"
];

try {
    
    $response = call_user_func_array([new $service, $method], $url);

    if(!$response) {
        echo '<pre>';
        echo json_encode($data);
        echo '</pre>';
    }

    $data['status'] = 'success';
    $data['data'] = $response;

    echo '<pre>';
    echo json_encode($data);
    echo '</pre>';

} catch(Exception $error) {
    echo 'Erro genérico' . $error; exit;
}
