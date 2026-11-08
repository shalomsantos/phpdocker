<?php

namespace App\Exceptions;

use RuntimeException;
use Throwable;

final class HttpException extends RuntimeException
{
    public function __construct(
        private int $statusCode,
        private string $title,
        string $message = '',
        ?Throwable $previous = null
    ) {
        parent::__construct($message, 0, $previous);
    }

    public function statusCode(): int
    {
        return $this->statusCode;
    }

    public function title(): string
    {
        return $this->title;
    }
}