<?php


namespace Broadcast\Action\Response;


class Task implements \JsonSerializable
{
    private $id;
    private $name;
    private $dueDate;
    private $boardId;

    public function __construct(string $id, string $name, \DateTime $dueDate, string $boardId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->dueDate = $dueDate;
        $this->boardId = $boardId;
    }

    public static function fromEntity(\Broadcast\Entity\Task $entity)
    {
        return new self(
            $entity->getId(),
            $entity->getName(),
            $entity->getDueDate(),
            $entity->getBoard()->getId()
        );
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'dueDate' => $this->dueDate->format('Y-m-d H:i:s'),
            'boardId' => $this->boardId
        ];
    }
}
