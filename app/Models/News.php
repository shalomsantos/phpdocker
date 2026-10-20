<?php

declare(strict_types=1);

namespace App\Models;

use InvalidArgumentException;
use PDO;

final class News extends Model
{
    protected string $table = 'news';

    public static function create(array $data): string
    {
        return self::createNews($data);
    }

    public static function createNews(array $data): string
    {
        self::validateNewsData($data);

        $status = $data['status'] ?? 'draft';

        return parent::create([
            'title' => trim($data['title']),
            'excerpt' => trim($data['excerpt'] ?? ''),
            'content' => $data['content'],
            'status' => $status,
            'author_id' => $data['author_id'],
            'published_at' => $status === 'published'
                ? date('Y-m-d H:i:s')
                : null,
        ]);
    }

    public static function updateNews(int|string $id, array $data): bool
    {
        self::validateNewsData($data, true);

        $fields = [];

        foreach (['title', 'excerpt', 'content', 'status'] as $field) {
            if (array_key_exists($field, $data)) {
                $fields[$field] = $data[$field];
            }
        }

        if (isset($fields['title'])) {
            $fields['title'] = trim($fields['title']);
        }

        if (isset($fields['excerpt'])) {
            $fields['excerpt'] = trim($fields['excerpt']);
        }

        if (isset($fields['status'])) {
            if ($fields['status'] === 'published') {
                $existing = parent::find($id);

                if (
                    !$existing ||
                    $existing['status'] !== 'published' ||
                    empty($existing['published_at'])
                ) {
                    $fields['published_at'] = date('Y-m-d H:i:s');
                }
            } else {
                $fields['published_at'] = null;
            }
        }

        return parent::update($id, $fields);
    }

    public static function findById(int|string $id): ?array
    {
        $stmt = self::getDb()->prepare(
            'SELECT n.*, u.nome AS author_name
             FROM news n
             INNER JOIN usuario u ON u.id = n.author_id
             WHERE n.id = :id
             LIMIT 1'
        );

        $stmt->execute(['id' => $id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result === false ? null : $result;
    }

    public static function allPublished(int $limit = 20, int $offset = 0): array
    {
        if ($limit < 1 || $limit > 100 || $offset < 0) {
            throw new InvalidArgumentException('Paginação inválida.');
        }

        $stmt = self::getDb()->prepare(
            "SELECT n.id, n.title, n.excerpt,
                    n.author_id, n.created_at, n.published_at,
                    u.nome AS author_name
             FROM news n
             INNER JOIN usuario u ON u.id = n.author_id
             WHERE n.status = 'published'
             ORDER BY n.published_at DESC
             LIMIT :limit OFFSET :offset"
        );

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private static function validateNewsData(
        array $data,
        bool $partial = false
    ): void {
        if (!$partial || array_key_exists('title', $data)) {
            if (
                !isset($data['title']) ||
                !is_string($data['title']) ||
                trim($data['title']) === '' ||
                mb_strlen(trim($data['title'])) > 200
            ) {
                throw new InvalidArgumentException('Título inválido.');
            }
        }

        if (array_key_exists('excerpt', $data)) {
            if (
                !is_string($data['excerpt']) ||
                mb_strlen(trim($data['excerpt'])) > 300
            ) {
                throw new InvalidArgumentException('Linha fina inválida.');
            }
        }

        if (!$partial || array_key_exists('content', $data)) {
            if (
                !isset($data['content']) ||
                !is_string($data['content']) ||
                trim(strip_tags($data['content'])) === ''
            ) {
                throw new InvalidArgumentException('Conteúdo inválido.');
            }
        }

        if (!$partial && (
            !isset($data['author_id']) ||
            filter_var($data['author_id'], FILTER_VALIDATE_INT) === false ||
            (int) $data['author_id'] <= 0
        )) {
            throw new InvalidArgumentException('Autor inválido.');
        }

        if (array_key_exists('status', $data)) {
            if (
                !is_string($data['status']) ||
                !in_array($data['status'], ['draft', 'published'], true)
            ) {
                throw new InvalidArgumentException('Status inválido.');
            }
        }
    }
}
