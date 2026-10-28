<?php

/** @var array $positions */
?>

<?php $this->layout("templates/layout", [
    "title" => "Workspace"
]); ?>

<?php $this->start("styles"); ?>
    <link rel="stylesheet" href="/css/home.css">
<?php $this->stop(); ?>

<div class="d-flex overflow-hidden min-vh-100 bg-tertiary">
    <aside class="offcanvas-md offcanvas-start d-flex flex-column flex-shrink-0 p-3 text-bg-dark" tabindex="-1" id="sidebarMira" aria-labelledby="sidebarMiraLabel" style="width: 260px;">
        <a href="/" class="d-flex align-items-center text-white text-decoration-none" id="sidebarMiraLabel">
            <span class="fs-4 fw-semibold">Mira</span>
        </a>
        <hr>
        <nav class="nav nav-pills flex-column gap-1 mb-auto">
            <a
                href="/news"
                class="nav-link text-white"
                id="materias"
                data-window-open
                data-window-id="news"
                data-window-title="Matérias"
                data-window-url="/news"
                data-window-position="top-center"
                aria-haspopup="dialog"
                data-window-icon="fa-solid fa-newspaper">
                <i class="fa-solid fa-newspaper me-2"></i>
                Materias
            </a>

            <a href="#user-list" class="nav-link active text-white" aria-current="page">
                <i class="fa-solid fa-users me-2"></i>
                Usuários
            </a>

            <a href="#position" class="nav-link text-white">
                <i class="fa-solid fa-briefcase me-2"></i>
                Cargos
            </a>

            <button
                type="button"
                class="nav-link text-white text-start"
                data-bs-toggle="modal"
                data-bs-target="#modalAdicionar">
                <i class="fa-solid fa-plus me-2"></i>
                Adicionar
            </button>
        </nav>
        <div class="d-flex align-items-center gap-2">
            <div
                class="rounded-circle bg-secondary d-flex align-items-center justify-content-center flex-shrink-0 text-primary"
                style="width: 42px; height: 42px;"
                title="<?= $this->e($user['nome']); ?>">
                <?= $this->e($user['iniciais']) ?>
            </div>

            <div class="text-truncate">
                <span class="d-block fw-semibold text-truncate">
                    <?= $this->e($user['nome'] ?? 'Usuário') ?>
                </span>
                <small class="text-white-50">Workspace</small>
            </div>
        </div>
        <hr>
        <a href="/logout" class="nav-link text-white">
            <i class="fa-solid fa-right-from-bracket me-2"></i>
            Sair
        </a>
    </aside>

    <main class="flex-grow-1 p-2 p-md-3 main-content">
        <div class="mb-2">
            <input
                type="search"
                id="searchTitle"
                class="form-control"
                placeholder="Digite o título..."
                autocomplete="off"
            >
        </div>
        <div id="cardsContainer" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-6 g-2">
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Agência de Notícias</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento de agências de notícias</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Anunciante da Rádio</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">anurd</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Apresentador</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Cadastro do Locutor da Rádio</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Artista</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">artis</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Assinante</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento dos assinantes do jornal</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Autor</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Descrição: Realizar o cadastro de autor e reporter dos conteúdos, esse cadastro é realizado automático a medida que é preenchido o campo no formulário de matérias.
                            Responsável: Administrador e desenvolvedor</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Bairro</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Descrição: Realizar o cadastro de bairro das cidades, esse cadastro é realizado quando é migrado a base de CEP ou base de cadastro de logradora.
                            Responsável: Administrador e desenvolvedor</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Banca do Jornal</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento das bancas de jornal</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Banco de Dados</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Descrição: Realizar gerenciamento do banco da dados, para realizar select na base e exibir a consulta.
                            Responsável: Administrador e desenvolvedor</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Bibliotecas</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Bibliotecas do Indesign (.indl) utilizadas na produção do jornal</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Busca de páginas</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Sem descrição disponível.</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Caderno</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento dos cadernos do jornal</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Categoria de Anunciantes</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento das categorias de anunciante</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Categoria de Guia</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento dos tipos de categoria de guia</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Categoria de Produtos Editoriais</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento das categoria de produtos editoriais</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Categoria dos Prod. de Fech.</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento da categoria dos produtos de fechamento</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Cidade</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Descrição: Realizar o cadastro de cidades, esse cadastro é realizado quando é migrado a base de CEP ou base de cadastro de logradora.
                            Responsável: Administrador e desenvolvedor</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Clientes</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento anunciantes</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Comentário</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Descrição: Gerenciar o cadastro de comentários das matérias, esse gerenciamento é realizado quando o comentário da matéria é implementado com o formulário do fiveedit, exclui essa função quando o comentário da matéria utiliza o disqus, facebook ou ou</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Configuração do FiveAds</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Configurações de ADS</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Conteúdo</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento de máterias</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Conteúdo</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento dos tipos de conteúdo</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Conteúdo de Agências</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento de conteúdo de agências</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Contrato (ADS)</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Sem descrição disponível.</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Cores</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Descrição: Gerenciar a parametrização de cores por função no sistema.
                            Responsável: Administrador, desenvolvedor</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Descrição da Mídia</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">dlmid</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Dimensão</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento de dimenssão de midia</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Editoria</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento das editorias do jornal</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Editoria de Agência</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento de editorias das agências</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Edição</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerencimanto edições e acompanhamento das páginas da edição</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Edição Impressos/Web</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento de artigos vinculados à versão impressa para web</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Email Resposta</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Descrição: Realizar o cadastro de email de retorno e resposta para formulários do portal, como: contato, fale conosco, trabalhe conosco.
                            Responsável: Administrador e desenvolvedor</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Estado</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Descrição: Realizar o cadastro de estados, esse cadastro é realizado quando é migrado a base de CEP ou base de cadastro de logradora.
                            Responsável: Administrador e desenvolvedor</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Estilo de Anuncios</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento de Estilos de Anuncios</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Estilos de Pagina</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Estilos dos elementos das páginas da edição</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Exportação de Portal</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Exportar estrutura de sites de portal</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Fechamento de Conteudo</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Controle do fechamento de conteúdo</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Fila de processamento</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento de Filas</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Fivelive</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Publicação de matérias em tempo real</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Fonte</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerencimaento das fontes das mídias/Conteúdo</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Forma</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento dos formatos de jornal</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Forma de Pagamento</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento das formas de pagamento disponíveis</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Formato de ADS</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento dos formatos de publicidades utilizados nos jornais</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Fotógrafo</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Descrição: Realizar o cadastro de fotografos para as mídias.
                            Responsável: Administrador e desenvolvedor</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Funcoes do Sistemas</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento das funções do sistema</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Gateway de Pagamento</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Sem descrição disponível.</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Genero</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento de Genero de Filme</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Gerar Senha</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Criptografar/Descriptografar senha</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Grade de Programação</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento de grade de programação</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Grupo de Editorias</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento de grupo de editoria</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Grupo de Sistema</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento de grupos de usuários</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Gráfico ADS</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gráficos com relatórios dos anuncios</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Gráfico Analytics</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Visualização dos grafícos de dados do analitycs</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Gênero Musical</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">midgn</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Jornal</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento dos jornais</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Jsons do Portal</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento de Jsons do Portal e outros</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Log de Edição</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Lista com logs da edição</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Log de Scripts</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Lista com logs de processamento dos scripts</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Mídia</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Biblioteca de mídias</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Ordem (ADS)</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento de Anuncios</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Pais</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento do países</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Pasta</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Pastas de mídia</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Pauta</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Sem descrição disponível.</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Popular Portal</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Utilitário para popular site com conteúdo de teste</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Portal</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento dos domínios utilizado pelo sistema</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Posicionar Publicidades</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Posicionamento das publicidades na edição.</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Produto de Fechamento</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento dos produtos disponiveis para o fechamento de conteúdo</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Produto Editorial</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento dos produtos editorias</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Programa</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento de programa</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Propaganda</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">prprd</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Publicações de ADS</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento de publicidades do jornal</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Push de Mensagens</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Envio de mensagens para os apps</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Páginas Diagramação</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Sem descrição disponível.</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Rede Social</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento de rede social</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Relatório (ADS)</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Relatórios de Anúncios</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Retranca</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento de Anuncios</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Rádio e TV</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento de rádio e tv do portal</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Sincronia de pastas</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Configurar lista de pastas a ser sincronizadas</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Sistema</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento de Sistemas</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Site</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento de site do portal</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Sorteio Promoção</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">prsor</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Status da mídia</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento do status de tratamento de midia</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Status de Pagina</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Status utilizado no jornal para representar as etapas da produção da edição</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">tags</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento de Tags</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Template</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Template de páginas do fiveedit</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Template de Pagina</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento dos templates .indd utilizados no jornal</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Template de Tag</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento dos templates Tag</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Tipo de evento</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento dos tipos de avento</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Tipo de Guia</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento dos tipos de guia</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Tipo de Midia</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerenciamento de tipo de mídia</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Tratamento de mídias</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Lista das mídias para tratamento</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Upload PDF</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Ferramento de upload de PDF de edição do jornal</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Usuario</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Gerencimento de usuario do sistema</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Usuário da Rádio</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">assrd</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Wordpress</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Ferramenta para importar conteúdo do wordpress</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Álbum Musical</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Cadastro de Album de artistas</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h6">Área de Interesse</h2>
                        <p class="card-text text-body-secondary small mb-0 text-truncate-3">Descrição: Realizar o cadastro de área de interesse de assinantes para popular o cadastro de assinante
                            Responsável: Administrador e desenvolvedor</p>
                    </div>
                </article>
            </div>
        </div>
    </main>
</div>

<?= $this->insert('components/modals/store-user', [
    'positions' => $positions
]); ?>

<?php $this->start("scripts"); ?>
<script>
    window.positions = <?= json_encode($positions, JSON_THROW_ON_ERROR) ?>;
</script>
<script src="/js/home.js"></script>
<?php $this->stop(); ?>