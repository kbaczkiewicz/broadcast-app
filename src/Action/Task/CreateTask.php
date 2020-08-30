<?php


namespace Broadcast\Action\Task;


use Broadcast\Action\BaseAction;
use Broadcast\Action\Request\Task;
use Broadcast\Entity\Task as TaskEntity;
use Broadcast\Exception\NotFoundException;
use Broadcast\Repository\BoardRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\ServerRequestInterface;

class CreateTask implements BaseAction
{
    private $boardRepository;
    private $entityManager;

    public function __construct(BoardRepository $boardRepositoy, EntityManagerInterface $entityManager)
    {
        $this->boardRepository = $boardRepositoy;
        $this->entityManager = $entityManager;
    }

    public function process(ServerRequestInterface $request, array $args = []): array
    {
        try {
            $taskRequest = Task::fromServerRequest($request);
            $taskRequest->validate();
            if (false === $taskRequest->isValid()) {
                return ['errors' => $taskRequest->getErrors()];
            }

            $task = $this->createTask($taskRequest);

            return ['data' => ['taskId' => $task->getId()]];
        } catch (NotFoundException $e) {
            return ['errors' => ['board' => 'Board does not exist']];
        }
    }

    private function createTask(Task $taskRequest): TaskEntity
    {
        $board = $this->boardRepository->find($taskRequest->getBoardId());
        if (null === $board) {
            throw new NotFoundException('Board not found');
        }

        $task = new TaskEntity();
        $task->setName($taskRequest->getName());
        $task->setDueDate($taskRequest->getDueDate());
        $task->setBoard($board);
        $this->entityManager->persist($task);
        $this->entityManager->flush();

        return $task;
    }
}
