<?php

$uri =parse_url($_SERVER['REQUEST_URI'])['path'];
$uri;
$routes = [
    '/' => 'controllers/index.php',
    '/signin'=>'controllers/signin.php',
    '/driver-signup'=>'controllers/driver-signup.php',
    '/passenger-signup'=>'controllers/passenger-signup.php',
    '/vehicle-registration'=>'controllers/vehicle-registration.php',
    '/registration-controller'=>'controllers/registration-controller.php',
    '/submitDriverRegistrationForm'=>'controllers/submitDriverRegistrationForm.php',
    '/driver-dashboard'=>'controllers/driver-dashboard.php',
    '/passenger-dashboard'=>'controllers/passenger-dashboard.php',
    '/admin-dashboard'=>'controllers/admin-dashboard.php',
    '/post-a-ride'=>'controllers/post-a-ride.php',
    '/logout'=>'controllers/logout.php',
    '/find-rides'=>'controllers/find-rides.php',
    '/bookings'=>'controllers/passenger-bookings.php',
    '/search-rides'=>'controllers/search-rides.php',
    '/view-ride'=>'controllers/view-ride.php'
    
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