<?php
include "../cabecalho.php";

$showName = $_GET['name'];

require_once(dirname(__FILE__) . "../../../controller/MovieAPI.php");
require_once(dirname(__FILE__) . "../../../controller/TvAPI.php");


$movieAPI = new MOVIEApi();

$movies = $movieAPI->getByName($showName);

$tvAPI = new TVSHOWApi();

$tvs = $tvAPI->getByName($showName);


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
                <li class="nav-item">
                    <a class="nav-link" href="../../../view/home/logout.php">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Minha Lista</a>
                </li>
            </ul>
            <div class="d-inline">
                <a href="../login" class="btn btn-sm btn-secondary mx-2 my-sm-0">Entrar</a>
                <a href="../register" class="btn btn-sm btn-primary my-sm-0">Cadastre-se</a>
            </div>
        </nav>
    </header>

    <main>
        <section id="maisAvaliados" class="container-fluid">
            <h2 class="h4">Resultados para <?= $_GET['name'] ?></h2>
            <div class="lists">

                <?php
                include "./films/logout.php";
                include "./tv/logout.php";

                ?>
            </div>
        </section>
    </main>
</body>

<html />