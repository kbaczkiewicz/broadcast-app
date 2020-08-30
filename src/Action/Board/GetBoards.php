<?php


namespace Broadcast\Action\Board;


use Broadcast\Action\BaseAction;
use Broadcast\Entity\Board;
use Broadcast\Repository\BoardRepository;
use Psr\Http\Message\ServerRequestInterface;

class GetBoards implements BaseAction
{
    private $repository;

    public function __construct(BoardRepository $repository)
    {
        $this->repository = $repository;
    }

    public function process(ServerRequestInterface $request, array $args = []): array
    {
        return [
            'data' => array_map(
                function (Board $entity) {
                    return \Broadcast\Action\Response\Board::fromEntity($entity);
                },
                $this->repository->findAll()
            ),
        ];
    }
}
