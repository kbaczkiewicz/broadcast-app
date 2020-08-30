<?php

use Doctrine\ORM\EntityManagerInterface;
use Laminas\Diactoros\ResponseFactory;
use League\Route\Router;
use Psr\Http\Message\ResponseFactoryInterface;

return [
    ResponseFactoryInterface::class => DI\autowire(ResponseFactory::class),
    Router::class => require_once(__DIR__.'/routing.php'),
    EntityManagerInterface::class => require_once(__DIR__.'/doctrine.php'),
];
