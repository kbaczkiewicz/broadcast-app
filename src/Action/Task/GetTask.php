<?php


namespace Broadcast\Action\Task;


use Broadcast\Action\BaseAction;
use Broadcast\Action\Response\Board;
use Broadcast\Repository\TaskRepository;
use Psr\Http\Message\ServerRequestInterface;

class GetTask implements BaseAction
{
    private $repository;

    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function process(ServerRequestInterface $request, array $args = []): array
    {
        $taskId = $args['id'];
        $task = $this->repository->find($taskId);
        if (null === $task) {
            return ['code' => 404];
        }

        return Board::fromEntity($task);
    }
}
