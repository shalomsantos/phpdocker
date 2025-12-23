<?php $this->layout("templates/master"); ?>
<?php
session_start();

if (isset($_SESSION['user'])) header('Location: /home');
?>

<div class="row m-0 p-0 vw-100 bg-background">
    <div class="row col-6 m-0 p-0 rounded position-absolute top-50 start-50 translate-middle overflow-hidden border border-2" style="height: 70vh;">
        <div class="col-6 d-flex align-items-center bg-white">
            <div class="w-75 mx-auto">
                <img src="/img/icon-background.png" alt="" style="width: 100%;">
                <div class="text-center">
                    <button class="btn btn-invert rounded-pill">Sign up</button>
                </div>
            </div>
        </div>
        
        <div class="col-6 d-flex align-items-center m-0 p-0 bg-end">
            <div class="w-75 mx-auto">
                <form id="formLogin" class="p-3">
                    <p class="fs-4 fw-bold">Sign in</p>
                    <input type="email" name="email" id="email" class="form-control mb-3" placeholder="E-mail:" required>
                    <input type="password" name="password" id="password" class="form-control mb-3" placeholder="Senha:" required>
                    <a href="#">Esqueceu a senha?</a>
                    <button type="submit" id="entrar" class="btn btn-normal rounded-pill w-100 mt-3">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="/js/login.js"></script>