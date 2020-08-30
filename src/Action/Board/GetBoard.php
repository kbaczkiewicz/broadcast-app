<?php


namespace Broadcast\Action\Board;


use Broadcast\Action\BaseAction;
use Broadcast\Action\Response\Board;
use Broadcast\Repository\BoardRepository;
use Psr\Http\Message\ServerRequestInterface;

class GetBoard implements BaseAction
{
    private $repository;

    public function __construct(BoardRepository $repository)
    {
        $this->repository = $repository;
    }

    public function process(ServerRequestInterface $request, array $args = []): array
    {
        $entity = $this->repository->find($args['id']);
        if (null === $entity) {
            return [];
        }

        return [
            'data' => Board::fromEntity($entity)
        ];
    }
}
