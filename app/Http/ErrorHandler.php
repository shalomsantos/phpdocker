<?php
declare(strict_types=1);

namespace App\Http;

use App\Exceptions\HttpException;
use ErrorException;
use League\Plates\Engine;
use Throwable;

final class ErrorHandler
{
    private static ?Engine $engine = null;

    public function __construct()
    {
        $this->engine = self::$engine;
    }

    public static function register(Engine $engine): void
    {
        self::$engine = $engine;

        ini_set('display_errors', '0');
        set_exception_handler([self::class, 'handle']);
        register_shutdown_function([self::class, 'handleShutdown']);
    }

    public static function handle(Throwable $e): never
    {
        // $debug = filter_var($_ENV['APP_DEBUG'], FILTER_VALIDATE_BOOLEAN);
        $debug = true;

        if ($e instanceof HttpException) {
            $status  = $e->statusCode();
            $title   = $e->title();
            $message = $e->getMessage();
        } else {
            $status  = 500;
            $title   = 'Erro interno';
            $message = 'Ocorreu um erro inesperado. Tente novamente em instantes.';
        }

        $details = $debug
            ? sprintf("%s\n%s\n%s:%d\n\n%s", get_class($e), $e->getMessage(), $e->getFile(), $e->getLine(), $e->getTraceAsString())
            : null;

        while (ob_get_level() > 0) {
            ob_end_clean();
        }

        if (!headers_sent()) {
            http_response_code($status);
            header('Content-Type: text/html; charset=utf-8');
        }

        echo self::render(compact('status', 'title', 'message', 'details'));
        exit;
    }

    public static function handleShutdown(): void
    {
        $err = error_get_last();

        if ($err !== null && in_array($err['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR], true)) {
            self::handle(new ErrorException($err['message'], 0, $err['type'], $err['file'], $err['line']));
        }
    }

    private static function render(array $data): string
    {
        try {
            return self::$engine->render('errors/error', $data);
        } catch (Throwable $t) {
            // plano B: nunca devolver corpo vazio
            $h    = fn($s): string => htmlspecialchars((string) $s, ENT_QUOTES, 'UTF-8');
            $html = '<!doctype html><meta charset="utf-8"><title>' . (int) $data['status'] . '</title>'
                  . '<h1>' . (int) $data['status'] . ' · ' . $h($data['title']) . '</h1>'
                  . '<p>' . $h($data['message']) . '</p>';

            if ($data['details'] !== null) {
                $html .= '<pre>' . $h('Falha ao renderizar a view de erro: ' . $t->getMessage() . "\n\n" . $data['details']) . '</pre>';
            }
            return $t->getMessage();
            return $html;
        }
    }
}