<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require __DIR__.'/./vendor/autoload.php';
require __DIR__.'/src/config/db.php';

$app = new \Slim\App;

// Routes
$app->get('/', function (){
    // $response->getBody()->write("Hello and welcome to the homepage!");
    echo 'Homepage found';
});

require __DIR__.'/src/routes/users.php';

$app->run();