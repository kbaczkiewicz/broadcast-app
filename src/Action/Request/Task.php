<?php


namespace Broadcast\Action\Request;

use Broadcast\Validation\Validatable;
use Psr\Http\Message\ServerRequestInterface;

class Task implements Request, Validatable
{
    use RequestParseTrait;

    private $name;
    private $dueDate;
    private $boardId;
    private $errors;

    public function __construct(string $name, \DateTime $dueDate, string $boardId)
    {
        $this->name = $name;
        $this->dueDate = $dueDate;
        $this->boardId = $boardId;
    }

    public static function fromServerRequest(ServerRequestInterface $request): self
    {
        $body = self::parseRequest($request);

        return new self(
            $body['name'],
            \DateTime::createFromFormat('Y-m-d H:i:s', $body['dueDate']),
            $body['boardId']
        );
    }

    public function validate(): void
    {
        if (empty($this->name)) {
            $this->errors['name'] = 'Name is empty';
        }

        if (empty($boardId)) {
            $this->errors['boardId'] = 'Board id is empty';
        }

        if ($this->dueDate > new \DateTime()) {
            $this->errors['dueDate'] = 'Due date cannot be from the future';
        }
    }

    public function isValid(): bool
    {
        return count($this->errors) === 0;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDueDate(): \DateTime
    {
        return $this->dueDate;
    }

    public function getBoardId(): string
    {
        return $this->boardId;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
