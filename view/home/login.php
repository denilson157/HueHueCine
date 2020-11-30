<?php
include "../cabecalho.php";
include "../acess.php";

$userSession = new ACESS("/HUEHUECINE/view/home/logout.php");
$userSession->retirectIfDoesntExist();
$user = $userSession->getUser();

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
                <li class="nav-item active">
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
                <p class="px-2 mb-0">Olá, <?php if (isset($user))  echo $user ?></p>
                <a href="/HUEHUECINE/view/signOut.php" class="btn btn-sm"><i class="fas fa-sign-out-alt"></i></a>
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