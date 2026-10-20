<?php $this->layout("templates/layout"); ?>

<main>
    <?php \App\Dto\renderizarPainel(new \App\Dto\FabricaBootstrap()); ?>
</main>