<?php $this->layout("templates/layout-admin"); ?>

<main>
    <?php \App\Dto\renderizarPainel(new \App\Dto\FabricaBootstrap()); ?>
</main>