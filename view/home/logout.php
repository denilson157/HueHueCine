<?php include "../cabecalho.php";
include "../acess.php";

$userSession = new ACESS("/view/home/login.php");

$userSession->retirectIfExist();

?>

<link href="./style.css" rel="stylesheet" />
<link href="./tvRow.css" rel="stylesheet" />
<link href="./movieRow.css" rel="stylesheet" />
</header>

<body>

    <header>

        <nav class="navbar navbar-expand navbar-dark justify-content-between">
            <div class="navbar-brand">
                <img src="http://via.placeholder.com/100x60">
                <h1 class="d-none">HueHueCine</h1>
            </div>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../../../view/home/logout.php">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Minha Lista</a>
                </li>
            </ul>

            <form class="form-inline my-2 my-lg-0" method="GET" action="../findFilm/login.php?">
                <input class="form-control form-control-sm mr-sm-2" name="name" type="text" placeholder="Pesquisar por Nome">
                <button class="btn btn-outline-light my-2 btn-sm my-sm-0" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <div class="d-inline">
                <a href="../login" class="btn btn-sm btn-secondary mx-2 my-sm-0">Entrar</a>
                <a href="../register" class="btn btn-sm btn-primary my-sm-0">Cadastre-se</a>
            </div>
        </nav>
    </header>

    <main>
        <section id="maisAvaliados" class="container-fluid">
            <div class="lists">
                <?php
                include './listMovies/onTheAir/index.php';
                include './listMovies/featuredFilms/index.php';
                include './listMovies/featuredTV/index.php';
                include './listMovies/featuredAnime/index.php';
                ?>
            </div>
        </section>
    </main>
</body>

<html />