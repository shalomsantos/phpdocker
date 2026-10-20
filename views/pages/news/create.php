
<?php $this->layout('templates/layout', ['title' => 'Nova notícia']); ?>

<?php $this->start('styles'); ?>
<link rel="stylesheet" href="/css/news-editor.css">
<?php $this->stop(); ?>

<div class="container py-4">
    <h1 class="h3 mb-4">Nova notícia</h1>

    <form action="/news/store" method="POST" id="newsForm">
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input
                type="text"
                name="title"
                id="title"
                class="form-control"
                maxlength="200"
                required
            >
        </div>

        <div class="mb-3">
            <label for="excerpt" class="form-label">Linha fina</label>
            <textarea
                name="excerpt"
                id="excerpt"
                class="form-control"
                rows="2"
                maxlength="300"
            ></textarea>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Conteúdo da notícia</label>
            <textarea
                name="content"
                id="content"
            ></textarea>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" name="status" value="draft" class="btn btn-secondary">
                Salvar rascunho
            </button>

            <button type="submit" name="status" value="published" class="btn btn-primary">
                Publicar notícia
            </button>
        </div>
    </form>
</div>

<?php $this->start('scripts'); ?>
<script src="https://cdn.tiny.cloud/1/<?= $this->e($tinymceApiKey ?? 'no-api-key') ?>/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
<script src="/js/news-editor.js"></script>
<?php $this->stop(); ?>
