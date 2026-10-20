<?php
/** @var array $positions */
?>

<?php $this->layout("templates/layout", [
    "title" => "Workspace"
]); ?>

<?php $this->start("styles"); ?>
<?php $this->stop(); ?>

<div class="d-flex overflow-hidden min-vh-100" style="background-color: var(--bs-secondary-bg);">
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
                data-window-icon="fa-solid fa-newspaper"
            >
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
                data-bs-target="#modalAdicionar"
            >
                <i class="fa-solid fa-plus me-2"></i>
                Adicionar
            </button>
        </nav>

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
        <button class="btn btn-dark d-md-none mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMira" aria-controls="sidebarMira" aria-label="Abrir menu">
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
                <button id="reload" class="btn btn-primary" type="button" aria-label="Atualizar">
                    <i class="fa-solid fa-arrow-rotate-right"></i>
                </button>
            </div>
        </div>

        <table class="table table-striped table-hover table-sm my-3">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Senha</th>
                </tr>
            </thead>
            <tbody id="user-list">
                <?php foreach ($users as $key => $value): ?>
                    <tr>
                        <td><?= $value['nome']; ?></td>
                        <td><?= $value['email']; ?></td>
                        <td><?= $value['telefone']; ?></td>
                        <?php
                        $positionIndex = array_search(
                            $value['position_id'] ?? null,
                            array_column($positions, 'id')
                        );
                        ?>
                        <td> <?= $this->e($positionIndex !== false ? $positions[$positionIndex]['description'] : 'Não definido'); ?></td>
                        <td><?= $value['senha']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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
