<?php $this->layout("templates/login", [
    "title" => "Login"
]); ?>

<?php $this->start("styles"); ?>
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" href="/css/signin.css">
<?php $this->stop(); ?>

<main class="form-signin w-100 m-auto">
    <form id="formLogin">
        <div class="logo-login mb-3">
            <img src="/favicon/OPOVO.png" alt="logo-opovo" style="max-width: 100%;"/>
            <h6>CMS</h6>
        </div>
        <div class="form-floating">
            <input type="email" class="form-control form-control-sm" name="email" id="email" placeholder="name@example.com">
            <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating input-group mb-3">
            <input type="password" class="form-control form-control-sm mb-0" name="password" id="password" placeholder="Password">

            <button class="input-group-text" id="eyeToggle" type="button">
                <i class="fa-solid fa-eye"></i>
            </button>
            <label for="floatingPassword">Senha</label>
        </div>

        <button id="entrar" class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>

        <p class="mt-5 mb-3 text-muted">Shalom pereira dos santos Web Development &copy; 2024-2026</p>

        <a href="/abstract-factory" class="btn btn-secondary rounded-pill w-100 mt-2">Exemplo Abstract Factory</a>
    </form>
</main>

<?php $this->start("scripts"); ?>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="/js/login.js"></script>
<?php $this->stop(); ?>
