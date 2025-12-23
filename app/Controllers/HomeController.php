<?php

namespace App\Controllers;

use App\Config\Database;
use App\Helpers\Helpers;
use App\Controllers\Controller;
use PDO;
use PDOException;

class HomeController
{
  public function index()
  {
    return Controller::view("home/home");
  }
}
