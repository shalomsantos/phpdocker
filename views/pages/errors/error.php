<?php $this->layout('templates/layout', ['title' => $title]); ?>

<main class="container py-5">
    <section class="mx-auto" style="max-width: 42rem;">
        <p class="text-muted mb-2">Erro <?= $this->e((string) $statusCode) ?></p>
        <h1 class="h2 mb-3"><?= $this->e($title) ?></h1>
        <p><?= $this->e($message) ?></p>

        <?php if (!empty($details)): ?>
            <details class="mt-4">
                <summary>Detalhes</summary>
                <p class="mt-2 mb-0"><?= $this->e($details) ?></p>
            </details>
        <?php endif; ?>

        <a class="btn btn-primary mt-4" href="/">Voltar ao início</a>
    </section>
</main>
