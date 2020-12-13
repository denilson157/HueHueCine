<?php
require_once(dirname(__FILE__) . "../../../controller/MovieAPI.php");
require_once(dirname(__FILE__) . "../../../controller/TvAPI.php");
include "../cabecalho.php";
include "../acess.php";

$name = $_GET['name'];

$userSession = new ACESS("/HUEHUECINE/view/findFilm/logout.php?name=$name");
$userSession->retirectIfDoesntExist();
$user = $userSession->getUser();

$showName = $_GET['name'];

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
                <img src="../images/Logo.png" style="width: 100px;">
                <h1 class="d-none">HueHueCine</h1>
            </div>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../../../HUEHUECINE/view/home/logout.php">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../../HUEHUECINE/view/myList/login.php">Minha Lista</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" method="GET" action="../findFilm/login.php?">
                <input class="form-control form-control-sm mr-sm-2 inputFind" name="name" type="text" placeholder="Pesquisar por Nome">
                <button class="btn btn-outline-light my-2 btn-sm my-sm-0" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <div class="d-flex ml-3 align-items-center">
                <p class="px-2 mb-0">
                    Olá,
                    <a href="/HUEHUECINE/view/register/" />
                    <?php if (isset($user))  echo $user ?>
                    </a>
                </p>
                <a href="/HUEHUECINE/view/signOut.php" class="btn btn-sm"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        </nav>
    </header>

    <main>
        <section id="maisAvaliados" class="container-fluid">
            <h2 class="h4">Resultados para <?= $_GET['name'] ?></h2>
            <div class="lists">

                <?php
                include "./films/index.php";
                include "./tv/index.php";
                ?>
            </div>
        </section>
    </main>
</body>

<html />