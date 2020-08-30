<?php


namespace Broadcast;


use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Route\Router;
use Psr\Http\Message\ServerRequestInterface;

class FrontController
{
    private $router;
    private $emitter;

    public function __construct(Router $router, SapiEmitter $emitter)
    {
        $this->router = $router;
        $this->emitter = $emitter;
    }

    public function run(ServerRequestInterface $request): void
    {

        $response = $this->router->dispatch($request);
        $this->emitter->emit($response);
    }
}
