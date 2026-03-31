<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Helpers\Helpers;
use App\Models\Usuario;
use App\Models\Position;

class HomeController extends Controller
{
  public function index()
  {
    $positions = Position::all();
    $users = Usuario::all();

    if (!$positions) {
      Helpers::jsonResponse(200, [
        'success' => true,
        'message' => 'Nenhum usuário cadastrado.',
        'data' => []
      ]);
      return;
    }
    return self::view("home/home", [
      'positions' => $positions,
      'users' => $users
    ]);
  }
}
