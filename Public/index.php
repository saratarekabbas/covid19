<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require '../vendor/autoload.php';

    $app = new \Slim\App;

    $app->get('/ping', function($request, $response){
        return $response->getBody()->write("It works!");
    });

    require '../api/get.php';
    require '../api/post.php';
    require '../api/put.php';
    require '../api/delete.php';
                
    $app->run();
?>