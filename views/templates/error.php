<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- LIBS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap');
        *{
            font-family: "Roboto Slab", serif;
            font-optical-sizing: auto;
            font-weight: 500;
            font-style: normal;
        }
    </style>
    <!-- FAVICON -->
    <link rel="shortcut icon" href="/favicon/favicon.ico" type="image/x-icon" />
    <?= $this->section("styles") ?>
    <title><?= $this->e('PHP') . (!empty($title) ? ' - ' . $title : '') ?></title>
</head>

<body class="d-flex align-items-center justify-content-start min-vh-100 bg-body-tertiary">
    <?= $this->section("content") ?>

    <!-- SCRIPTS -->
    <script src="https://kit.fontawesome.com/c3cffe3b5e.js" crossorigin="anonymous" defer></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <?= $this->section("scripts") ?>
</body>

</html>