<?php
include 'config/config.php';
include 'layers/database/database.php';
include 'config/path.php';

$db = new Database($db_param);
$routes = new ROUTES();
$logic = new Logic($db);


$routes->get('/', function($routes) {
    return $routes->view('index');
});

$routes->get('/login', function($router) {
    return $router->view('login');
});

$routes->get('/signup', function($routes) {
    return $routes->view('signup');
});

$routes->get('/404', function($routes) {
    return $routes->view('404');
});

$routes->post('/login', function($routes, $logic) {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $login = $logic->login($data);

    if($login['status'] == 'success') {
        echo json_encode([
            "status"=>$login['status'],
            "message"=>$login['message']
        ]);
    }else{
        echo json_encode([
            "status"=>$login['status'],
            "message"=>$login['message']
        ]);
    }
});

$routes->post('/signup', function($routes, $logic) {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $login = $logic->Register($data);

    if($login['status'] == 'success') {
        echo json_encode([
            "status"=>$login['status'],
            "message"=>$login['message']
        ]);
    }else{
        echo json_encode([
            "status"=>$login['status'],
            "message"=>$login['message']
        ]);
    }
});

// Initialize Routing 
$routes->openRoutes($logic);