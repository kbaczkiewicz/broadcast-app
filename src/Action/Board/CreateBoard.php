<?php


namespace Broadcast\Action\Board;


use Broadcast\Action\BaseAction;
use Broadcast\Entity\Board;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Broadcast\Action\Request\Board as CreateRequest;

class CreateBoard implements BaseAction
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function process(ServerRequestInterface $request, array $args = []): array
    {
        $createRequest = CreateRequest::fromServerRequest($request);
        $createRequest->validate();
        if (false === $createRequest->isValid()) {
            return ['errors' => $createRequest->getErrors()];
        }

        $boardId = $this->createBoard($createRequest);

        return ['data' => ['boardId' => $boardId]];
    }

    private function createBoard(CreateRequest $createRequest): string
    {
        $board = new Board();
        $board->setName($createRequest->getName());
        $board->setColor($createRequest->getColor());
        $this->entityManager->persist($board);
        $this->entityManager->flush();

        return $board->getId();
    }
}
