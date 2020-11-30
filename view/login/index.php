<?php include "../cabecalho.php";

?>
</header>

<body>

    <header>
        <nav class="navbar navbar-expand-sm navbar-dark justify-content-center">
            <div>
                <img src="../images/Logo.png" style="width: 125px;">
                <h1 class="d-none">HueHueCine</h1>
            </div>
        </nav>
    </header>

    <main>
        <section class="container-form d-flex flex-column align-items-center justify-content-center px-4">
            <div class="my-4 text-center">
                <h2 class="h3 w-50 mx-auto">
                    Comece a marcar quais filmes e séries você está assistindo
                </h2>

                <?php if (isset($msg)) : ?>
                    <h2 class="h3 w-100 mx-auto py-2 text-warning">
                        <?= $msg ?>
                    </h2>
                <?php endif ?>
            </div>
            <div>
                <form class="form-group" method="post" action="/HUEHUECINE/view/login/logar.php">
                    <div class="row">
                        <div class="col-12">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control" required name="email" />
                        </div>
                        <div class="col-12">
                            <label for="password">Senha</label>
                            <input type="password" id="password" class="form-control" required name="password" />
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="mx-auto">
                            <button class="btn btn-primary" type="submit" name="logar">
                                Entrar
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mx-auto">
                            <div class="text-center">
                                <p class="mb-0">Ainda não está cadastrado?</p>
                                <a class="text-center" href="../register/"> Cadastre-se agora</a>

                                <p> e descubra o HueHueCine</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mx-auto">
                            <div class="text-center">
                                <a class="text-secondary" href="/HUEHUECINE/view/home/logout.php"> Prosseguir sem cadastro</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>

<html />