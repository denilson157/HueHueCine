<?php include "../cabecalho.php";

?>

<body>

    <header>
        <nav class="navbar navbar-expand-sm navbar-dark justify-content-center">
            <div>
                <img src="http://via.placeholder.com/100x60">
                <h1 class="d-none">HueHueCine</h1>
            </div>
        </nav>
    </header>

    <main>
        <section class="container-form d-flex align-items-center justify-content-center px-4">

            <div>
                <form class="form-group" action="">
                    <div class="row">
                        <div class="col-12">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control" name="email" />
                        </div>
                        <div class="col-12">
                            <label for="password">Senha</label>
                            <input type="password" id="password" class="form-control" name="password" />
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="mx-auto">
                            <button class="btn btn-primary" type="submit">
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
                </form>
            </div>
        </section>
    </main>
</body>

<html />