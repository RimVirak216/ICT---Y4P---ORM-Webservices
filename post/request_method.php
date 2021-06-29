<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
$postdata = json_decode(file_get_contents("php://input"), true);
$response = array();
$response['method'] = $method;
$response['data'] = $postdata;
echo json_encode($response);;

switch ($method) {
    case 'PUT':
        break;
    case 'POST':
        break;
    case 'GET':
        break;
    case 'DELETE':
        break;
}
