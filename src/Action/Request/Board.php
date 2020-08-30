<?php


namespace Broadcast\Action\Request;

use Broadcast\Validation\Validatable;
use Psr\Http\Message\ServerRequestInterface;

class Board implements Request, Validatable
{
    use RequestParseTrait;

    private $name;
    private $color;
    private $errors = [];

    public function __construct(string $name, string $color)
    {
        $this->name = $name;
        $this->color = $color;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public static function fromServerRequest(ServerRequestInterface $request): self
    {
        $body = self::parseRequest($request);

        return new self($body['name'], $body['color']);
    }

    public function validate(): void
    {
        $this->errors = [];

        if (empty($this->name)) {
            $this->errors['name'] = 'Name is empty';
        }

        if (empty($this->color)) {
            $this->errors['color'] = 'Color is empty';
        }
    }

    public function isValid(): bool
    {
        return count($this->errors) === 0;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
