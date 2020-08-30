<?php


namespace Broadcast\Entity;


use Doctrine\Mapping;

/**
 * @Entity()
 * @Table(name="board")
 */
class Board
{
    /**
     * @Id
     * @GeneratedValue(strategy="UUID")
     * @Column(type="string")
     */private $id;
    /**
     * @Column(type="string")
     */
    private $name;
    /**
     * @Column(type="string")
     */
    private $color;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): void
    {
        $this->color = $color;
    }
}
