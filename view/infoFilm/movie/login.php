<?php
include "../../cabecalho.php";
include "../../acess.php";
require_once(dirname(__FILE__) . "../../../../controller/MovieAPI.php");

$id = $_GET['id'];

$userSession = new ACESS("/HUEHUECINE/view/infoFilm/movie/logout.php?id=$id");
$userSession->retirectIfDoesntExist();
$user = $userSession->getUser();

$tmdb = new MOVIEApi();
$movie = $tmdb->getMovieDetail($id);

$typeMTV = "film";

?>

<link href="../style.css" rel="stylesheet" />
<link href="./style.css" rel="stylesheet" />
<script src="/HUEHUECINE/assets/jQuery.js" defer></script>
<script src="/HUEHUECINE/view/infoFilm/scripts.js" defer></script>

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
                    <li class="nav-item">
                        <a class="nav-link" href="/HUEHUECINE/view/myList/login.php">Minha Lista</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" method="GET" action="/HUEHUECINE/view/findFilm/login.php?">
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

                                <section>
                                    <p class="h4 text-primary d-block">Adicione a sua lista:</p>

                                    <form id="formLista">
                                        <div class="row mx-auto">
                                            <select id="estadoLista">
                                                <option value="1">Pretendo</option>
                                                <option value="2">Assistindo</option>
                                                <option value="3">Completo</option>
                                            </select>
                                            <input type="hidden" id="typeMTV" value="<?= $typeMTV ?>">
                                            <div id="submits">
                                                <button class="ml-1 btn btn-sm btn-primary" form="formLista" type="submit" id="submitAdd">Adicionar</button>
                                                <button class="ml-1 btn btn-sm btn-secondary" form="formLista" type="submit" id="submitAtt">Atualizar</button>
                                                <button class="ml-1 btn btn-sm btn-warning" form="formLista" type="submit" id="submitRem">Remover</button>
                                            </div>
                                        </div>
                                    </form>

                                </section>


                            </div>
                            <div class="Sinopse py-2">
                                <h4 class="h4 text-primary">Sinopse</h4>
                                <p>
                                    <?= $movie->getOverview() ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <section class="mt-5">
                        <p class="h4 text-primary d-block">Comentários</p>
                        <p class="text-secondary h5">O que quem assistiu tem comentado sobre este filme?</p>

                        <div class="box-comment">

                        </div>

                    </section>
                    <div class="py-3">
                        <p class="h6 text-primary" id="review">Escreva um comentário...</p>
                        <form id="formReview">

                            <div class="row mx-auto mb-2">
                                <textarea name="newReview" id="review" cols="100" rows="2"></textarea>
                                <input type="hidden" id="idMovieTv" value="<?= $id ?>">
                                <input type="hidden" id="emailUser" value="<?= $user ?>">
                            </div>
                            <button class="btn btn-sm btn-primary" form="formReview" type="submit">
                                Escrever
                            </button>
                        </form>
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