<?php

/** @var int $status */
/** @var string $title */
/** @var string $message */
/** @var string|null $details */
?>

<?php $this->layout("templates/error", [
    "title" => $title
]); ?>

<?php $this->start("styles"); ?>
<style>
    .fa-solid.fa-plug-circle-exclamation{
        font-size: 10vw;
    }
</style>
<?php $this->stop(); ?>

<main class="container">
    <div class="d-flex gap-2">
        <button type="button" class="btn btn-primary rounded-pill" onclick="location.assign('/')"><i class="fa-solid fa-chevron-left me-2"></i>Voltar</button>

        <?php if ($details !== null): ?>
            <button type="button" class="btn btn-outline-secondary rounded-pill"
                data-bs-toggle="modal" data-bs-target="#detalhesErro"><i class="fa-solid fa-info me-2"></i>Detalhes</button>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="col">
            <p class="display-1 fw-bold text-body-secondary mb-0"><?= (int) $status ?></p>
        
            <h1 class="h3"><?= $this->e($title) ?></h1>
        
            <p class="text-body-secondary" style="max-width: 36rem"><?= $this->e($message) ?></p>
        </div>
        <div class="col d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-plug-circle-exclamation text-primary"></i>
        </div>
    </div>
</main>

<?php if ($details !== null): ?>
    <div class="modal fade" id="detalhesErro" tabindex="-1" aria-labelledby="detalhesErroLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="detalhesErroLabel">Detalhes do erro</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <pre class="small mb-0" style="white-space: pre-wrap; word-break: break-word">
                        <code><?= $this->e($details) ?></code>
                    </pre>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>