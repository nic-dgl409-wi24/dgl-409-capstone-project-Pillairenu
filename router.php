<?php

$uri =parse_url($_SERVER['REQUEST_URI'])['path'];
$uri;
$routes = [
    '/' => 'controllers/index.php',
    '/signin'=>'controllers/signin.php',
    '/signup'=>'controllers/signup.php'
];

//function to handle routing

function routeToController($uri,$routes)
{

    if(array_key_exists($uri,$routes))
    {
        require $routes[$uri];
    }
    else
    {

        //abort();
    }
}

// function abort($code = 404)
// {
//     http_response_code($code);
    
//     require "app/views/{$code}.php";
//     die();
// }

routeToController($uri,$routes);