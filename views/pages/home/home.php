<?php $this->layout("templates/layout-admin", [
    "title" => "Workspace"
]); ?>

<?php $this->start("styles"); ?>
<?php $this->stop(); ?>

<div class="d-flex overflow-hidden min-vh-100">
    <aside 
        class="offcanvas-md offcanvas-start d-flex flex-column flex-shrink-0 p-3 text-bg-dark"
        tabindex="-1"
        id="sidebarMira"
        aria-labelledby="sidebarMiraLabel"
        style="width: 260px;"
    >
        <a
            href="/"
            class="d-flex align-items-center text-white text-decoration-none"
            id="sidebarMiraLabel"
        >
            <span class="fs-4 fw-semibold">Mira</span>
        </a>

        <hr>

        <nav class="nav nav-pills flex-column gap-1 mb-auto">
            <a href="#" class="nav-link active" aria-current="page">
                <i class="fa-solid fa-house me-2"></i>
                Workspace
            </a>

            <a href="#user-list" class="nav-link text-white">
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
                data-bs-target="#modalAdicionar"
            >
                <i class="fa-solid fa-plus me-2"></i>
                Adicionar
            </button>
        </nav>

        <hr>

        <div class="d-flex align-items-center gap-2">
            <div
                class="rounded-circle bg-secondary d-flex align-items-center justify-content-center flex-shrink-0"
                style="width: 42px; height: 42px;"
                title="<?= $this->e($user['nome']); ?>"
            >
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

    <main class="flex-grow-1 p-3 p-md-4 main-content">
        <button
            class="btn btn-dark d-md-none mb-3"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#sidebarMira"
            aria-controls="sidebarMira"
            aria-label="Abrir menu"
        >
            <i class="fa-solid fa-bars"></i>
            Menu
        </button>

        <div class="row">
            <div class="col-12 col-md-4 col-lg-3">
                <label for="position" class="form-label">
                    Selecione o cargo:
                </label>

                <select name="position_id" id="position" class="form-select">
                    <option value="">Selecione...</option>
                    <?php foreach ($positions as $pos): ?>
                        <option value="<?= $this->e((string) $pos['id']) ?>">
                            <?= $this->e($pos['description']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-auto mt-auto">
                <button id="reload" class="btn btn-light" type="button" aria-label="Atualizar">
                    <i class="fa-solid fa-arrow-rotate-right"></i>
                </button>
            </div>
        </div>

        <div class="row mt-3" id="user-list">
            <?php foreach ($users as $key => $value): ?>
                <div class="col-12 col-md-6 col-xl-4 mb-3">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between gap-2">
                            <span class="text-truncate">
                                <?= $this->e($value['nome'] ?? '') ?>
                            </span>

                            <button
                                type="button"
                                class="btn btn-light btn-sm btn-<?= (int) $key ?>"
                                onclick="onVisible(<?= (int) $key ?>)"
                                aria-label="Alternar visibilidade"
                            >
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>

                        <div class="card-body d-flex flex-column gap-3">
                            <div>
                                <small class="text-body-secondary">E-mail</small>
                                <p class="mb-0 text-break">
                                    <?= $this->e($value['email'] ?? '') ?>
                                </p>
                            </div>

                            <div>
                                <small class="text-body-secondary">Telefone</small>
                                <p class="mb-0">
                                    <?= $this->e($value['telefone'] ?? '') ?>
                                </p>
                            </div>

                            <div>
                                <small class="text-body-secondary">Cargo</small>
                                <?php
                                $positionIndex = array_search(
                                    $value['position_id'] ?? null,
                                    array_column($positions, 'id')
                                );
                                ?>
                                <p class="mb-0">
                                    <?= $this->e(
                                        $positionIndex !== false
                                            ? $positions[$positionIndex]['description']
                                            : 'Não definido'
                                    ) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</div>

<!-- MODALS -->
<div class="modal fade" id="modalAdicionar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 35vw;">
        <div id="modalAddUserSpinner" class="spinner-border m-auto d-none" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <form id="modalAddUser" class="modal-content">
            <div class="modal-header justify-content-between">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar usuário</h1>
                <button class="btn btn-light rounded-circle" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="storeUserForm">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-2">
                                <label for="name" class="form-label text-body-tertiary">Nome</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="name"
                                    placeholder="Nome:"
                                    required>
                            </div>
                            <div class="mb-2">
                                <label for="email" class="form-label text-body-tertiary">E-mail</label>
                                <input
                                    class="form-control"
                                    type="email"
                                    id="email"
                                    placeholder="E-mail:"
                                    required>
                            </div>
                            <div class="mb-2">
                                <label for="tel" class="form-label text-body-tertiary">Telefone</label>
                                <input
                                    class="form-control"
                                    type="tel"
                                    id="tel"
                                    placeholder="Telefone:">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <label for="password" class="form-label text-body-tertiary">Senha</label>
                                <input
                                    class="form-control"
                                    type="password"
                                    id="password"
                                    placeholder="Senha:"
                                    required>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="confirmPassword" class="form-label text-body-tertiary">Confirme</label>
                            <input
                                class="form-control"
                                type="password"
                                id="confirmPassword"
                                placeholder="Confirmar senha:"
                                required>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <button class="btn btn-success" id="submit" type="submit">Adicionar</button>
                            <button class="btn btn-primary" id="limpar" type="button">Limpar</button>
                        </div>
                    </div>
                </form>
            </div>
        </form>
    </div>
</div>
<?php $this->start("scripts"); ?>
    <script src="/js/home.js"></script>
<?php $this->stop(); ?>