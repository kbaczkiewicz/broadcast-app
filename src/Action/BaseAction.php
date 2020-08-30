<?php


namespace Broadcast\Action;


use Psr\Http\Message\ServerRequestInterface;

interface BaseAction
{
    public function process(ServerRequestInterface $request, array $args = []): array;
}
