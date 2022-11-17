<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$routes = [
    '/' => 'views/index.php',
    '/register' => 'views/register.php',
    '/login' => 'views/login.php',
    '/profile' => 'views/profile.php',
    '/history' => 'views/history.php',
];

function routeToController($uri,$routes){
    if(array_key_exists($uri,$routes)){
        require $routes[$uri];
    }
    else{
        abort();
        
    }
}
function abort(){
    http_response_code(404);
    require 'views/404.php';
    die();
}

routeToController($uri,$routes);