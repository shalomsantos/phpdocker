<?php $this->layout("templates/master"); ?>

<main>
    <?php \App\Dto\renderizarPainel(new \App\Dto\FabricaBootstrap()); ?>
</main>