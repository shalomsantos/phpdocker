<?php /** @var string $title */ ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- LIBS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/window-manager.css">
    <!-- FAVICON -->
    <link rel="shortcut icon" href="/favicon/favicon.ico" type="image/x-icon" />
    <?= $this->section("styles") ?>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <title><?= $this->e($_ENV['PROJECT_NAME']) . (!empty($title) ? ' - ' . $title : '') ?></title>
</head>
<body>
  <?= $this->section("content") ?>
  <!-- SCRIPTS_MAIN -->
  <script src="https://kit.fontawesome.com/c3cffe3b5e.js" crossorigin="anonymous" defer></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script src="/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="/js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/interactjs@1.10.28/dist/interact.min.js"></script>
  <script src="/js/window-manager.js"></script>
  <script src="/js/loadScreen.js"></script>
  <?= $this->section("scripts") ?>
</body>

</html>
