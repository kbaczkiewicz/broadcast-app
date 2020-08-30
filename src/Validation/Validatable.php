<?php


namespace Broadcast\Validation;


interface Validatable
{
    public function validate(): void;
    public function isValid(): bool;
    public function getErrors(): array;
}
