<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\News;
use App\Services\NewsContentSanitizer;
use InvalidArgumentException;
use Throwable;

class NewsController extends AuthorizedController
{
    public function create(object $request): void
    {
        $this->view('pages/news/create', [
            'title' => 'Nova notícia',
            'tinymceApiKey' => trim((string) ($_ENV['TINYMCE_API_KEY'] ?? '')) ?: 'no-api-key',
        ]);
    }

    public function store(object $request): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->renderError(
                405,
                'Método não permitido',
                'Esta operação aceita somente requisições POST.'
            );
            return;
        }

        $title = $_POST['title'] ?? null;
        $excerpt = $_POST['excerpt'] ?? null;
        $content = $_POST['content'] ?? null;
        $status = $_POST['status'] ?? 'draft';

        if (
            !is_string($title) ||
            !is_string($content) ||
            ($excerpt !== null && !is_string($excerpt)) ||
            !is_string($status)
        ) {
            $this->renderError(
                422,
                'Dados inválidos',
                'Confira os dados enviados e tente novamente.'
            );
            return;
        }

        $title = trim($title);
        $excerpt = trim($excerpt);

        if ($title === '' || trim(strip_tags($content)) === '') {
            $this->renderError(
                422,
                'Campos obrigatórios',
                'Título e conteúdo são obrigatórios.'
            );
            return;
        }

        if (mb_strlen($title) > 200 || mb_strlen($excerpt) > 300) {
            $this->renderError(
                422,
                'Texto muito longo',
                'O título pode ter até 200 caracteres e a linha fina até 300.'
            );
            return;
        }

        if (!in_array($status, ['draft', 'published'], true)) {
            $this->renderError(
                422,
                'Status inválido',
                'Escolha rascunho ou publicado.'
            );
            return;
        }

        $authorId = (int) $this->user['id'];

        try {
            $sanitizer = new NewsContentSanitizer();
            $safeContent = $sanitizer->sanitize($content);

            $news = new News();

            $news->create([
                'title' => $title,
                'excerpt' => $excerpt,
                'content' => $safeContent,
                'status' => $status,
                'author_id' => $authorId,
            ]);

            header('Location: /news');
            exit;
        } catch (InvalidArgumentException $e) {
            $this->renderError(
                422,
                'Dados inválidos',
                'Confira os dados enviados e tente novamente.',
                $e->getMessage()
            );
        } catch (Throwable $e) {
            error_log($e->getMessage());
            $this->renderError(
                500,
                'Falha ao salvar',
                'Não foi possível salvar a notícia.'
            );
        }
    }

    public function index(object $request): void
    {
        $news = new News();

        $this->view('pages/news/index', [
            'title' => 'Notícias',
            'news' => $news->all(),
        ]);
    }

    public function show(object $request): void
    {
        $id = filter_var(
            $request->id ?? null,
            FILTER_VALIDATE_INT,
            ['options' => ['min_range' => 1]]
        );

        if ($id === false) {
            $this->renderError(
                404,
                'Notícia não encontrada',
                'A notícia solicitada não existe.'
            );
            return;
        }

        $news = new News();
        $article = $news->findById($id);

        if ($article === null) {
            $this->renderError(
                404,
                'Notícia não encontrada',
                'A notícia solicitada não existe.'
            );
            return;
        }

        $article['content'] = (new NewsContentSanitizer())->sanitize(
            $article['content']
        );

        $this->view('pages/news/show', [
            'title' => $article['title'],
            'article' => $article,
        ]);
    }

    private function renderError(
        int $statusCode,
        string $title,
        string $message,
        ?string $details = null
    ): void {
        http_response_code($statusCode);
        $this->view('pages/errors/error', [
            'statusCode' => $statusCode,
            'title' => $title,
            'message' => $message,
            'details' => $details,
        ]);
    }
}
