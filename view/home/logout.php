<?php include "../cabecalho.php"; ?>

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
                ?>
            </div>
        </section>
    </main>
</body>

<html />