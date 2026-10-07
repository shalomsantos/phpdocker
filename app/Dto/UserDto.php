<?php
declare(strict_types=1);

namespace App\Dto;

use App\Exception\DadoInvalidoException;

final readonly class UserDto
{
    public function __construct(
        public string $primeironome,
        public ?string $ultimonome = null,
    ) {
        if (trim($primeironome) === '') {
            echo 'primeironome', 'O nome é obrigatório.';
        }
    }

    public function nome(): string
    {
        return trim($this->primeironome . ' ' . ($this->ultimonome ?? ''));
    }
}