<?php

use Broadcast\Action\Board\CreateBoard;
use Broadcast\Action\Board\GetBoard;
use Broadcast\Action\Board\GetBoards;
use Broadcast\Action\Task\CreateTask;
use Broadcast\Action\Task\GetTask;
use Broadcast\Action\Task\GetTasks;
use League\Route\Router;
use League\Route\Strategy\JsonStrategy;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

return function (ContainerInterface $container): Router {
    $router = new Router();
    $router->setStrategy($container->get(JsonStrategy::class));
    $router->map(
        'POST',
        '/board',
        function (ServerRequestInterface $request, array $args) use ($container): array {
            return ($container->get(CreateBoard::class))->process($request, $args);
        }
    );

    $router->map(
        'GET',
        '/board',
        function (ServerRequestInterface $request, array $args) use ($container): array {
            return ($container->get(GetBoards::class))->process($request, $args);
        }
    );

    $router->map(
        'GET',
        '/board/{id}',
        function (ServerRequestInterface $request, array $args) use ($container): array {
            return ($container->get(GetBoard::class))->process($request, $args);
        }
    );

    $router->map(
        'POST',
        '/task',
        function (ServerRequestInterface $request, array $args) use ($container): array {
            return ($container->get(CreateTask::class))->process($request, $args);
        }
    );

    $router->map(
        'GET',
        '/task',
        function (ServerRequestInterface $request, array $args) use ($container): array {
            return ($container->get(GetTasks::class))->process($request, $args);
        }
    );

    $router->map(
        'GET',
        '/task/{id}',
        function (ServerRequestInterface $request, array $args) use ($container): array {
            return ($container->get(GetTask::class))->process($request, $args);
        }
    );

    return $router;
};
