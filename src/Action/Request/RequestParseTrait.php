<?php


namespace Broadcast\Action\Request;


use Psr\Http\Message\ServerRequestInterface;

trait RequestParseTrait
{
    private static function parseRequest(ServerRequestInterface $request): array
    {
        return json_decode($request->getBody(), true);
    }
}
