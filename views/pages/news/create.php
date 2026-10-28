<?php $this->layout('templates/layout', [
    'title' => 'Nova notícia'
]); ?>

<?php $this->start('styles'); ?>
<link rel="stylesheet" href="/css/news-editor.css">
<?php $this->stop(); ?>

<main class="container-fluid p-2 bg-secondary bg-opacity-10">
    <div class="d-flex justify-content-between align-items-center gap-2 mb-2">
        <div>
            <button type="submit" name="status" value="published" class="btn btn-success btn-sm rounded-pill">
                <i class="fa-solid fa-floppy-disk me-2"></i>Guardar
            </button>
            <button type="submit" name="status" value="published" class="btn btn-primary btn-sm rounded-pill">
                <i class="fa-solid fa-upload me-2"></i>Publicar
            </button>
            <button type="submit" name="status" value="draft" class="btn btn-secondary btn-sm rounded-pill">
                <i class="fa-solid fa-file me-2"></i>Rascunho
            </button>
        </div>
        <a class="btn btn-danger btn-sm rounded-pill" href="/news"><i class="fa-solid fa-ban me-2"></i>Cancelar</a>
    </div>
    <hr class="my-1">
    <form action="/news/store" method="POST" id="newsForm" class="row g-1">
        <div class="col">
            <label for="portal" class="form-label text-black-50">Portal</label>
            <select id="portal" class="form-select form-select-sm" aria-label="Small select example">
                <option value="1" selected>O povo</option>
                <option value="2">O povo mais</option>
            </select>
        </div>
        <div class="col-4">
            <label for="site" class="form-label text-black-50">Site</label>
            <select id="site" class="form-select form-select-sm" aria-label="Small select example">
                <option value="1" selected>/Economia</option>
                <option value="2">/Vida&Arte</option>
                <option value="2">/Política</option>
            </select>
        </div>
        <div class="col-6">
            <label for="title" class="form-label text-black-50">Título</label>
            <input
                type="text"
                name="title"
                id="title"
                class="form-control form-control-sm"
                maxlength="200"
                required>
        </div>
        <div class="col-12">
            <label for="excerpt" class="form-label text-black-50">Linha fina</label>
            <input
                type="text"
                name="excerpt"
                id="excerpt"
                class="form-control form-control-sm"
                rows="2"
                maxlength="300">
        </div>
    </form>
    <ul class="nav nav-tabs mt-2" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Dados Gerais</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Impresso</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Extras</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false" disabled>SEO</button>
        </li>
    </ul>
    <div class="tab-content border border-top-0 bg-white" id="myTabContent">
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="row m-0 p-0">
                <div class="col-9 g-2">
                    <div class="row g-1">
                        <div class="col-3">
                            <label for="title" class="form-label text-black-50">Cartola</label>
                            <input
                                type="text"
                                name="title"
                                id="title"
                                class="form-control form-control-sm"
                                maxlength="200"
                                required>
                        </div>
                        <div class="col">
                            <label for="title" class="form-label text-black-50">Abre</label>
                            <input
                                type="text"
                                name="title"
                                id="title"
                                class="form-control form-control-sm"
                                maxlength="200"
                                required>
                        </div>
                        <div class="col-12">
                            <textarea
                                name="content"
                                id="content"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-3 py-2">
                    <label type="file" for="input-file" id="label-file" class="w-100">
                        <input type="file" accept="image/*" id="input-file" hidden>
                        <div id="img-view" class="d-flex justify-content-center align-items-center text-primary border border-dashed border-primary rounded p-2" style="min-height: 150px;">
                            <p class="mb-0">Selecione uma imagem</p>
                        </div>
                    </label>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <h1>Impresso</h1>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi atque repudiandae numquam magni sunt nemo delectus dolorum adipisci ab! Eum inventore, illo consectetur cupiditate voluptatum distinctio nulla fugiat labore vero.</p>
        </div>
        <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
            <h1>Extras</h1>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi atque repudiandae numquam magni sunt nemo delectus dolorum adipisci ab! Eum inventore, illo consectetur cupiditate voluptatum distinctio nulla fugiat labore vero.</p>
        </div>
        <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">
            <h1>SEO</h1>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi atque repudiandae numquam magni sunt nemo delectus dolorum adipisci ab! Eum inventore, illo consectetur cupiditate voluptatum distinctio nulla fugiat labore vero.</p>
        </div>
    </div>
</main>

<?php $this->start('scripts'); ?>
<script src="https://cdn.tiny.cloud/1/<?= $this->e($tinymceApiKey ?? 'no-api-key') ?>/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
<script src="/js/news-editor.js"></script>
<?php $this->stop(); ?>