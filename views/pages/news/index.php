<?php $this->layout('templates/layout', 
    ['title' => $title
]); ?>

<main class="container py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1">Notícias</h1>
            <p class="text-body-secondary mb-0">Gerencie os rascunhos e as publicações.</p>
        </div>
        <a class="btn btn-primary" href="/news/create">Nova notícia</a>
    </div>

    <?php if (empty($news)): ?>
        <div class="alert alert-info" role="status">
            Ainda não há notícias cadastradas.
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th scope="col">Título</th>
                        <th scope="col">Status</th>
                        <th scope="col">Criada em</th>
                        <th scope="col">Publicada em</th>
                        <th scope="col"><span class="visually-hidden">Ações</span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($news as $article): ?>
                        <tr>
                            <th scope="row"><?= $this->e($article['title'] ?? '') ?></th>
                            <td>
                                <?php if (($article['status'] ?? '') === 'published'): ?>
                                    <span class="badge text-bg-success">Publicada</span>
                                <?php else: ?>
                                    <span class="badge text-bg-secondary">Rascunho</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $this->e($article['created_at'] ?? '') ?></td>
                            <td><?= $this->e($article['published_at'] ?? '—') ?></td>
                            <td class="text-end">
                                <a
                                    class="btn btn-sm btn-outline-primary"
                                    href="/news/show?id=<?= rawurlencode((string) ($article['id'] ?? '')) ?>"
                                >
                                    Visualizar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</main>
