<?php

namespace App\Controllers;

use App\Helpers\Helpers;
use App\Models\Usuario;
use App\Models\Position;

class HomeController extends AuthorizedController
{
    function index()
    {
        try {
            $positions = Position::all();
            $users     = Usuario::all();

            $nomeCompleto = trim($this->user['nome'] ?? '');
            $partes = explode(' ', $nomeCompleto);
            $partes = array_filter($partes); 
            $partes = array_values($partes); 

            if (count($partes) >= 2) {
                $primeiraLetra = mb_substr($partes[0], 0, 1);
                $ultimaLetra = mb_substr(end($partes), 0, 1);
                $iniciais = strtoupper($primeiraLetra . $ultimaLetra);
            } else {
                $iniciais = strtoupper(mb_substr($nomeCompleto ?: 'V', 0, 1));
            }
            $user['iniciais']   = $iniciais;
            $user['nome']       = ucfirst($partes[0] ?? '') . ' ' . ucfirst(end($partes) ?? '');

            return $this->view("pages/home/home", [
                'user'      => $user,
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
}
