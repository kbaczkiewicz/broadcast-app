<?php


namespace Broadcast\Action\Task;


use Broadcast\Action\BaseAction;
use Broadcast\Entity\Task;
use Broadcast\Repository\TaskRepository;
use Psr\Http\Message\ServerRequestInterface;
use Broadcast\Action\Response\Task as TaskResponse;

class GetTasks implements BaseAction
{
    private $repository;

    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function process(ServerRequestInterface $request, array $args = []): array
    {
        $boardId = $args['boardId'];

        return [
            'data' => array_map(
                function (Task $task) {
                    return TaskResponse::fromEntity($task);
                },
                $this->repository->findForBoard($boardId)
            ),
        ];
    }
}
