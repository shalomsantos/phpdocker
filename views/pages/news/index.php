<?php $this->layout('templates/layout', 
    ['title' => $title
]); ?>

<main class="container-fluid p-2">
    <div class="d-flex justify-content-between align-items-center gap-2 mb-2">
        <div class="d-flex align-items-center gap-2">
            <a class="btn btn-primary btn-sm rounded-pill" href="/news/create">Nova notícia</a>
            <a class="btn btn-secondary btn-sm rounded-pill" href="#">Opção A</a>
            <a class="btn btn-secondary btn-sm rounded-pill" href="#">Opção B</a>
            <a class="btn btn-secondary btn-sm rounded-pill" href="#">Opção C</a>
        </div>
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-primary btn-sm rounded-pill"><i class="fa-solid fa-angle-left"></i></button>
            <button class="btn btn-primary btn-sm rounded-pill"><i class="fa-solid fa-angle-right"></i></button>
        </div>
    </div>
    <hr class="my-1">

    <?php if (empty($news)): ?>
        <div class="alert alert-info" role="status">
            Ainda não há notícias cadastradas.
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-sm align-middle">
                <thead>
                    <tr>
                        <td scope="col" class="text-sm">Status</td>
                        <td scope="col" class="text-sm"><span class="visually-hidden">Ações</span></td>
                        <td scope="col" class="text-sm">Título</td>
                        <td scope="col" class="text-sm">Criada em</td>
                        <td scope="col" class="text-sm">Publicada em</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($news as $article): ?>
                        <tr>
                            <td>
                                <?php if (($article['status'] ?? '') === 'published'): ?>
                                    <span class="badge text-bg-success"><i class="fa-solid fa-check-double"></i></span>
                                <?php else: ?>
                                    <span class="badge text-bg-secondary"><i class="fa-solid fa-brush"></i></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a
                                    class="btn btn-sm btn-outline-primary"
                                    href="/news/show?id=<?= rawurlencode((string) ($article['id'] ?? '')) ?>"
                                >
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </a>
                            </td>
                            <td scope="row" class="text-sm"><?= $this->e($article['title'] ?? '') ?></td>
                            <td class="fw-lighter text-sm"><?= $this->e(\App\Helpers\Helpers::datesFormater($article['created_at'] ?? null)) ?></td>
                            <td class="fw-lighter text-sm"><?= $this->e(\App\Helpers\Helpers::datesFormater($article['published_at'] ?? null)) ?></td>
                            
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</main>
