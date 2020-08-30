<?php


namespace Broadcast\Entity;


use Doctrine\Mapping as ORM;

/**
 * @Entity()
 * @Table(name="task")
 */
class Task
{
    /**
     * @Id
     * @GeneratedValue(strategy="UUID")
     * @Column(type="string")
     */
    private $id;
    /**
     * @Column(type="string")
     */
    private $name;
    /**
     * @Column(type="datetime", name="due_date")
     */
    private $dueDate;
    /**
     * @ManyToOne(targetEntity="Broadcast\Entity\Board", inversedBy="tasks")
     * @JoinColumn(name="board_id", referencedColumnName="id")
     */
    private $board;

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

    public function getDueDate(): ?\DateTime
    {
        return $this->dueDate;
    }

    public function setDueDate(\DateTime $dueDate): void
    {
        $this->dueDate = $dueDate;
    }

    public function getBoard(): ?Board
    {
        return $this->board;
    }

    public function setBoard(Board $board): void
    {
        $this->board = $board;
    }
}
