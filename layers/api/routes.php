<?php
class ROUTES {
    private $routes;
    private $logic;

    public function openRoutes($logic) {
        $this->logic = $logic;
        $uri = parse_url($_SERVER['REQUEST_URI']);
        
        $method = $_SERVER['REQUEST_METHOD'];

        // $uri = explode('/PHPMONOLITHICSERVER', $_SERVER['REQUEST_URI']);
        $found = false;
        foreach($this->routes as $path => $callback) {
            if($path !== $uri['path']) continue;
            $found = true;
            call_user_func($callback, $this, $this->logic, $_GET, $_POST);
        }

        if(!$found) {
            $notFoundCallback = $this->routes['/404'];
            call_user_func($notFoundCallback, $this);
        }
    }

    public function get(String $path, callable $callback) {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->routes[$path] = $callback;
        }
    }

    public function view($file, $data=[]) {
        if(file_exists(SERVER_PATH.'/'.TEMPLATE_FOLDER.$file.'.php')) {
            include SERVER_PATH.'/'.TEMPLATE_FOLDER.$file.'.php';
        }else {
            include SERVER_PATH.'/'.TEMPLATE_FOLDER.'404.php';
        }
    }

    public function post(String $url, callable $callback) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->routes[$url] = $callback;
        }
    }

    public function redirect($url, $data=[]) {
        return $this->view($url, $data);
    }
}