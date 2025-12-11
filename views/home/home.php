<?php
session_start();

define('BASE_URL', '/CadUsuarioPhp');

if (!isset($_SESSION['user'])) header('Location: ' . BASE_URL . '/app/Views/auth/login.php');

$nomeCompleto = trim($_SESSION['user']['nome'] ?? '');
$partes = explode(' ', $nomeCompleto);

if (count($partes) >= 2) {
    $user = ucfirst($partes[0]) . ' ' . ucfirst(end($partes));
} else {
    $user = ucfirst($nomeCompleto ?: 'vazio');
}

include dirname(__DIR__, 1) . '/header.php';
?>

<div class="row mx-0 panel rounded overflow-hidden">
    <div class="col-2 p-0 border-end">
      <ul>
        <li>
          <a class="nav-link" href="#">
            <i class="fa-solid fa-house"></i>
            <p>Home</p>
          </a>
        </li>
        <li>
          <a class="nav-link" href="#">
            <i class="fa-solid fa-chart-line"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li>
          <a class="nav-link" href="#">
            <i class="fa-solid fa-sitemap"></i>
            <p>Options</p>
          </a>
        </li>
        <li>
          <a class="nav-link" href="#">
            <i class="fa-solid fa-users"></i>
            <p>Users</p>
          </a>
        </li>
        <li id="signOut">
          <a class="nav-link" href="#">
            <i class="fa-solid fa-right-from-bracket"></i>
            <p>Exit</p>
          </a>
        </li>
      </ul>
      <?= $user ?? 'vazio' ?>
    </div>
    <div class="col-10">
        <table id="usersTable" class="table w-100" style="background-color: transparent !important;">
            <thead>
                <tr>
                    <th>Nº</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>...</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5" class="text-center text-muted">Carregando...</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- MODALS -->
<div class="modal fade" id="modalAdicionar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 27vw;">
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

<?php include dirname(__DIR__, 1) . '/footer.php'; ?>

<script src="<?= BASE_URL ?>/public/js/home.js"></script>