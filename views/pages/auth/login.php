<?php $this->layout("templates/layout-admin", [
    "title" => "Login"
]); ?>

<div class="row m-0 p-0 vw-100 bg-background">
    <div class="row col-6 m-0 p-0 rounded-5 position-absolute top-50 start-50 translate-middle overflow-hidden border border-2" style="height: 70vh;">
        <?= $this->insert("components/login/sign-up"); ?>

        <?= $this->insert("components/login/login-form"); ?>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="/js/login.js"></script>
