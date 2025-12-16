<?php
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
try {
  $dotenv->load();
} catch (\Dotenv\Exception\InvalidPathException $e) {
  die("ERRO: Arquivo .env não encontrado em " . dirname(__DIR__, 2));
}
