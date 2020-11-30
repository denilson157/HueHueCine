<?php
include "../../cabecalho.php";
include "../../acess.php";
require_once(dirname(__FILE__) . "../../../../controller/MovieAPI.php");

$id = $_GET['id'];

$userSession = new ACESS("/HUEHUECINE/view/infoFilm/movie/login.php?id=$id");
$userSession->retirectIfExist();

$tmdb = new MOVIEApi();

$movie = $tmdb->getMovieDetail($_GET['id']);


?>

<link href="../style.css" rel="stylesheet" />
<link href="./style.css" rel="stylesheet" />
</header>

<body style="background-size:cover;
            background-position:center;
            background-image: url(https://image.tmdb.org/t/p/original<?= $movie->getPoster() ?>);
            ">

    <div class="bgPoster">

        <header>

            <nav class="navbar navbar-expand navbar-dark justify-content-between">
                <div class="navbar-brand">
                    <a href="../../home/logout.php">
                        <img src="../../images/Logo.png" style="width: 100px;">
                    </a>
                    <h1 class="d-none">HueHueCine</h1>
                </div>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/HUEHUECINE/view/home/logout.php">Home </a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" method="GET" action="/HUEHUECINE/view/findFilm/logout.php?">
                    <input class="form-control form-control-sm mr-sm-2 inputFind" name="name" type="text" placeholder="Pesquisar por Nome">
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
            <?php if (isset($movie)) : ?>
                <section id="tvmovie" class="container">
                    <div class="row">
                        <div class="col-6 infoTVmovie">
                            <img src="https://image.tmdb.org/t/p/original<?= $movie->getPoster() ?>" alt="<?= $movie->getOriginalTitle() ?>" title="<?= $movie->getOriginalTitle() ?>">
                        </div>
                        <div class="col-6">
                            <div class="pb-3">
                                <h2 class="h4 text-primary"><?= $movie->getTitle() ?></h2>
                                <h3 class="h6 text-secondary"><?= $movie->getOriginalTitle() ?></h3>
                            </div>
                            <div class="d-block py-2">
                                <div class="mb-1">
                                    <p class="h4 text-primary">Avaliação de quem assistiu</p>

                                    <?php

                                    $star = 0;
                                    $votes = floor($movie->getVotes());

                                    for ($i = 0; $i < $votes; $i = $i + 2)
                                        if ($i <= $votes) {
                                            echo '<i class="fas fa-star fa-2x text-primary"></i>';
                                            $star++;
                                        }


                                    for ($i = 0; $i < 5 - $star; $i++)
                                        echo '<i class="far fa-star fa-2x text-primary"></i>';

                                    ?>
                                </div>

                                <div class="d-flex my-2">
                                    <p class="text-secondary">
                                        <?= $movie->getRuntime() ?> minutos
                                    </p>
                                </div>

                                <div class="d-flex my-2">
                                    <p class="h6 mr-2">
                                        Gêneros:
                                    </p>
                                    <p class="text-secondary">
                                        <?php
                                        $genres = array();

                                        foreach ($movie->getGenres() as $g) {
                                            array_push($genres, $g['name']);
                                        }

                                        echo implode(", ", $genres);
                                        ?>
                                    </p>
                                </div>


                            </div>
                            <div class="Sinopse py-2">
                                <h4 class="h4 text-primary">Sinopse</h4>
                                <p>
                                    <?= $movie->getOverview() ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="mx-auto">
                            <p class="text-center h3 mb-0">Você já assitiu?</p>
                            <p class="text-center text-secondary h5">Faça o login e adicione <?= $movie->getTitle() ?> a sua lista de assistidos.</p>
                        </div>
                    </div>
                </section>
            <?php
            endif
            ?>
            <?php if (!isset($movie)) :
                include '../../notFound/index.html';
            endif
            ?>
        </main>
    </div>
</body>

<html />