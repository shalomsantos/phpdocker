<?php
namespace App\utils;

class NomeDaClasse
{
  public $propriedade1;
  public $propriedade2;

  public function __construct($valor1, $valor2)
  {
    $this->propriedade1 = $valor1;
    $this->propriedade2 = $valor2;
  }

  public function metodoAcao()
  {
    return $this->propriedade1 + $this->propriedade2;
  }

  public static function saudacao()
  {
    return "Olá do NomeDaClasse!";
  }
}