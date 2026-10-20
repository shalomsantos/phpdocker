<?php $this->layout('templates/layout', ['title' => $title]); ?>

<main class="container py-4">
    <nav aria-label="Navegação estrutural" class="mb-4">
        <a href="/news">&larr; Voltar às notícias</a>
    </nav>

    <article>
        <header class="mb-4">
            <h1 class="display-6"><?= $this->e($article['title'] ?? '') ?></h1>

            <?php if (!empty($article['excerpt'])): ?>
                <p class="lead"><?= $this->e($article['excerpt']) ?></p>
            <?php endif; ?>

            <p class="small text-body-secondary">
                Por <?= $this->e($article['author_name'] ?? 'Autor desconhecido') ?>
                <?php if (!empty($article['published_at'])): ?>
                    · Publicada em <?= $this->e($article['published_at']) ?>
                <?php else: ?>
                    · Rascunho
                <?php endif; ?>
            </p>
        </header>

        <div class="news-content">
            <?= $article['content'] ?? '' ?>
        </div>
    </article>
</main>
