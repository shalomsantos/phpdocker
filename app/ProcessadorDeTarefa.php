<?php

namespace App;

class ProcessadorDeTarefa
{
  private const TOTAL_PASSOS = 10;

  public static function processar()
  {
    if (ob_get_level() === 0) {
      ob_start();
    }

    echo "<h1>Iniciando Processamento...</h1>";
    self::flushOutput();

    for ($i = 1; $i <= self::TOTAL_PASSOS; $i++) {
      sleep(1);
      $percentual = round(($i / self::TOTAL_PASSOS) * 100);
      $mensagem = "Progresso: {$percentual}% - Concluindo passo {$i} de " . self::TOTAL_PASSOS . "<br>";

      echo $mensagem;
      self::flushOutput();
    }

    echo "<h2>Processamento Concluído! (100%)</h2>";
    self::flushOutput();
    ob_end_flush();
  }
  private static function flushOutput()
  {
    ob_flush();
    flush();
  }
}
