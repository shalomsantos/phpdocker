<?php
namespace DigShalomsantos\TesteHtml\utils;

class jsonResponse
{
  public static function hellow()
  {
    header('Content-Type: application/json; charset=utf-8');

    $data = [
      'message' => 'Hello, World!'
    ];

    echo json_encode($data);
    exit();
  }
}