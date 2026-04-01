<?php

namespace App\Controllers;

use App\Helpers\Helpers;
use App\Models\Usuario;
use App\Models\Position;

class HomeController extends AuthorizedController
{
  public function index()
  {
    try {
      $positions = Position::all();
      $users = Usuario::all();
  
      return self::view("home/home", [
        'user' => (array) $this->user,
        'positions' => $positions,
        'users' => $users
      ]);
    } catch (\Throwable $e) {
      Helpers::jsonResponse(500, [
        'success' => false,
        'message' => 'Erro na chamada da home principal',
        'details' => $e->getMessage()
      ]);
    }
  }
}
