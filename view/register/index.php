<?php include "../cabecalho.php";

?>
</header>

<body>
    <main>

        <header>
            <nav class="navbar navbar-expand-sm navbar-dark justify-content-center">
                <div>
                    <img src="http://via.placeholder.com/100x60">
                    <h1 class="d-none">HueHueCine</h1>
                </div>
            </nav>
        </header>


        <section class="container-form d-flex align-items-center justify-content-center px-4">
            <div class="col-6">

                <form class="form-group" action="">
                    <div class="row">
                        <div class="col-6">
                            <label for="name">Nome</label>
                            <input type="text" id="name" class="form-control" name="name" />
                        </div>
                        <div class="col-6">
                            <label for="lastName">Sobrenome</label>
                            <input type="text" id="lastName" class="form-control" name="lastName" />
                        </div>
                        <div class="col-6">
                            <label for="dateBirth">Data de nascimento</label>
                            <input type="date" id="dateBirth" class="form-control" name="dateBirth" />
                        </div>
                        <div class="col-6">
                            <label for="tel">Telefone</label>
                            <input type="tel" id="tel" class="form-control" name="tel" />
                        </div>
                        <div class="col-12">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control" name="email" />
                        </div>
                        <div class="col-6">
                            <label for="password">Senha</label>
                            <input type="password" id="password" class="form-control" name="password" />
                        </div>
                        <div class="col-6">
                            <label for="verifyPassword">Confirmar Senha</label>
                            <input type="password" id="verifyPassword" class="form-control" name="verifyPassword" />
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="mx-auto">
                            <button class="btn btn-primary" type="submit">
                                Cadastrar
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mx-auto">
                            <span>
                                Se você já tem uma conta, você pode <a href="../login/index.php"> fazer o login.</a>
                            </span>
                        </div>
                    </div>
                </form>
            </div>

        </section>
    </main>
</body>

<html />