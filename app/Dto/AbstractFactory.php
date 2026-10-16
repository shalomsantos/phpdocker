<?php

namespace App\Dto;

/**
 * Exemplo de Abstract Factory aplicado a um painel administrativo.
 * Cada fábrica cria componentes de uma mesma família visual.
 */

// Produtos abstratos: definem o que o painel pode usar sem conhecer o tema.
interface Botao
{
    public function renderizar(string $texto): string;
}

interface Modal
{
    public function renderizar(string $titulo, string $conteudo): string;
}

// Fábrica abstrata: garante que cada família forneça todos os componentes.
interface FabricaTemaPainel
{
    public function criarBotao(): Botao;

    public function criarModal(): Modal;
}

// Família Bootstrap.
class BotaoBootstrap implements Botao
{
    public function renderizar(string $texto): string
    {
        return
        <<<HTML
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                {$texto}
            </button>
        HTML;
    }
}

class ModalBootstrap implements Modal
{
    public function renderizar(string $titulo, string $conteudo): string
    {
        return 
        <<<HTML
            <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{$titulo}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>{$conteudo}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        HTML;
    }
}

class FabricaBootstrap implements FabricaTemaPainel
{
    public function criarBotao(): Botao
    {
        return new BotaoBootstrap();
    }

    public function criarModal(): Modal
    {
        return new ModalBootstrap();
    }
}

// Família Material Design.
class BotaoMaterial implements Botao
{
    public function renderizar(string $texto): string
    {
        return "<button class=\"md-button md-button--contained\">{$texto}</button>";
    }
}

class ModalMaterial implements Modal
{
    public function renderizar(string $titulo, string $conteudo): string
    {
        return "<div class=\"md-dialog\"><h2>{$titulo}</h2><p>{$conteudo}</p></div>";
    }
}

class FabricaMaterial implements FabricaTemaPainel
{
    public function criarBotao(): Botao
    {
        return new BotaoMaterial();
    }

    public function criarModal(): Modal
    {
        return new ModalMaterial();
    }
}

// O painel depende das interfaces. A família escolhida vem de fora.
function renderizarPainel(FabricaTemaPainel $fabrica): void
{
    $botao = $fabrica->criarBotao();
    $modal = $fabrica->criarModal();

    echo $botao->renderizar('Salvar alterações') . PHP_EOL;
    echo $modal->renderizar('Confirmação', 'Deseja salvar as alterações?') . PHP_EOL;
}

// A troca de fábrica muda a família inteira de componentes do painel.
