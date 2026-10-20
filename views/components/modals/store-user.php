<?php 
/** @var array $positions */
?>
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
                                <label for="position" class="form-label text-body-tertiary">Cargo</label>
                                <select class="form-select" id="position" aria-label="position">
                                    <option selected>Selecione o cargo</option>
                                    <?php foreach ($positions as $position): ?>
                                        <option value="<?= $this->e($position['id']) ?>">
                                            <?= $this->e($position['description']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
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