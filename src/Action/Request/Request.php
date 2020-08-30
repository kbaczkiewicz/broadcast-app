<?php


namespace Broadcast\Action\Request;


use Psr\Http\Message\ServerRequestInterface;

interface Request
{
    public static function fromServerRequest(ServerRequestInterface $request);
}
