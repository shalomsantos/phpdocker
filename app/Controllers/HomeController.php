<?php

namespace App\Controllers;

use App\Helpers\Helpers;
use App\Models\Usuario;
use App\Models\Position;
use App\Mapper\UserMapper;

class HomeController extends AuthorizedController
{
  function index()
  {
    try {
      $positions = Position::all();
      $users     = Usuario::all();

      return self::view("home/home", [
        'user'      => (array) $this->user,
        'positions' => $positions,
        'users'     => $users
      ]);
    } catch (\Throwable $e) {
      Helpers::jsonResponse(500, [
        'success' => false,
        'message' => 'Erro na chamada da home principal',
        'details' => $e->getMessage()
      ]);
    }
  }
  function validationExam()
  {
    $cms_values = ['ds_first_nam' => 'fulano', 'ds_last_name' => 'de tal'];
    $dto = UserMapper::toDto($cms_values);

    echo $dto->primeironome;
    echo $dto->ultimonome;
    echo $dto->nome();
  }
}
