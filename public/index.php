<?php

use Broadcast\FrontController;
use DI\ContainerBuilder;
use Laminas\Diactoros\ServerRequestFactory;

require_once('../vendor/autoload.php');

$builder = new ContainerBuilder();
$definitions = require_once(__DIR__ . '/../config/services.php');
$builder->addDefinitions($definitions);
$container = $builder->build();
$request = ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
$frontController = $container->get(FrontController::class);
$frontController->run($request);

