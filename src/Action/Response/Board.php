<?php


namespace Broadcast\Action\Response;


class Board implements \JsonSerializable
{

    private $id;
    private $name;
    private $color;

    public function __construct(string $id, string $name, string $color)
    {

        $this->id = $id;
        $this->name = $name;
        $this->color = $color;
    }

    public static function fromEntity(\Broadcast\Entity\Board $entity)
    {
        return new self($entity->getId(), $entity->getName(), $entity->getColor());
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'color' => $this->color
        ];
    }
}
