<?php

namespace App\Controllers;

use App\Helpers\Helpers;
use App\Models\Usuario;
use App\Services\JwtService;

class AuthorizedController extends Controller
{
  protected array $user;

  function __construct()
  {
    $token = $this->getBearerToken();

    if (!$token) $this->forbidden();

    $JwtService = new JwtService();
    $decoded    = $JwtService->validateToken($token);

    if (!$decoded || !isset($decoded->data->id)) $this->forbidden();

    $usuarioModel = new Usuario();
    $userData     = $usuarioModel->find($decoded->data->id);

    if (!$userData) $this->forbidden();

    $this->user = $userData;
  }

  private function getBearerToken()
  {
    $headers = getallheaders();

    if (isset($headers['Authorization']) && preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches))
      return $matches[1];
    
    if (isset($_COOKIE['auth_token'])) return $_COOKIE['auth_token'];
    
    return null;
  }

  private function forbidden()
  {
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      Helpers::jsonResponse(403, ['error' => 'Acesso negado']);
    } else {
      header("Location: /");
    }
    exit;
  }
}
