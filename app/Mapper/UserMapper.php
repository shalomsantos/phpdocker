<?php
declare(strict_types=1);

namespace App\Mapper;

use App\Dto\UserDto;

final class CmsUserMapper
{
    public static function toDto(array $row): UserDto
    {
        $ultimo = isset($row['ds_last_name']) ? trim((string) $row['ds_last_name']) : null;

        return new UserDto(
            primeironome: trim((string) ($row['ds_first_nam'] ?? '')),
            ultimonome: $ultimo === '' ? null : $ultimo,
        );
    }

    // caminho inverso, se o app precisar gravar de volta no CMS
    public static function toRow(UserDto $dto): array
    {
        return [
            'ds_first_nam'  => $dto->primeironome,
            'ds_last_name'  => $dto->ultimonome,
        ];
    }
}