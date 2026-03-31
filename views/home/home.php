<?php $this->layout("templates/master"); ?>
<?php
session_start();

if (!isset($_SESSION['user'])) header('Location: /');

$nomeCompleto = trim($_SESSION['user']['nome'] ?? '');
$partes = explode(' ', $nomeCompleto);

$partes = array_filter($partes); 
$partes = array_values($partes); 

if (count($partes) >= 2) {
    $primeiraLetra = mb_substr($partes[0], 0, 1);
    $ultimaLetra = mb_substr(end($partes), 0, 1);
    $user = strtoupper($primeiraLetra . $ultimaLetra);
} else {
    $user = strtoupper(mb_substr($nomeCompleto ?: 'V', 0, 1));
}
?>

<div class="row mx-0 panel rounded overflow-hidden position-relative p-0 m-0">
    <div class="col-2 p-0 border-end">
        <div class="d-flex justify-content-center align-items-center rounded-circle text-bg-secondary mx-auto my-4" style="width: 3.5vw;height: 3.5vw;">
            <p><?= $user ?? 'vazio' ?></p>
        </div>
        <ul>
            <li>
                <a class="nav-link" href="#">
                    <i class="fa-solid fa-house"></i>
                    <p>Home</p>
                </a>
            </li>
            <li data-bs-toggle="modal" data-bs-target="#modalAdicionar">
                <a class="nav-link" href="#">
                    <i class="fa-solid fa-plus"></i>
                    <p>Adicionar</p>
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
    </div>
    <div class="col-10 main-content">
        <div>
            <label for="position">Selecione o Cargo:</label>
            <select name="position_id" id="position" class="form-control">
                <option value="">Selecione...</option>
                <?php foreach ($positions as $pos): ?>
                    <option value="<?= $pos['id'] ?>">
                        <?= htmlspecialchars($pos['description']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button id="reload" class="btn btn-light btn-sm">Recarregar</button>
        </div>
        <div class="d-flex overflow-hidden rounded mt-2">
            <div class="row m-0 p-0 w-100" id="user-list">
                <?php foreach ($users as $key => $value): ?>
                    <div class="col-4 m-0 p-0">
                        <div class="card m-2">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <p><?= $value['nome'] ?></p>
                                <button class="btn btn-light btn-sm btn-<?= $key ?>" onclick="onVisible(<?= $key ?>)"><i class="fa-solid fa-eye"></i></button>
                            </div>
                            <div class="card-body d-flex flex-column gap-2">
                                <div class="label-content">
                                    <p>E-mail:.</p>
                                    <p class="text-body-secondary"><?= $value['email'] ?></p>
                                </div>                                    
                                <div class="label-content">
                                    <p>Telefone:.</p>
                                    <p class="text-body-secondary"><?= $value['telefone'] ?></p>
                                </div>                    
                                <div class="label-content">
                                    <p>Senha:.</p>
                                    <span class="span-senha-<?= $key ?> d-flex align-items-center">
                                        <p class="text-body-secondary senha-show d-none mb-0"><?= $value['senha'] ?></p>
                                        <i class="fa-solid fa-ellipsis senha-hide"></i>
                                    </span>
                                </div>                    
                                <div class="label-content">
                                    <p>Cargo:.</p>
                                    <?php
                                        $key = array_search($value['position_id'], array_column($positions, 'id'));
                                        echo "<p class='text-body-secondary'>".(($key !== false) ? $positions[$key]['description'] : 'Não definido')."</p>";
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
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
<script src="/js/home.js">

</script>