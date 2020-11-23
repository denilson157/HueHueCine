<?php
include "../../cabecalho.php";
include "../../acess.php";
require_once(dirname(__FILE__) . "../../../../controller/TvAPI.php");

$id = $_GET['id'];

$userSession = new ACESS("/HUEHUECINE/view/infoFilm/tv/logout.php?id=$id");
$userSession->retirectIfDoesntExist();
$user = $userSession->getUser();

$tmdb = new TVSHOWApi();

$show = $tmdb->getTVDetail($id);


?>

<link href="../style.css" rel="stylesheet" />
<link href="./style.css" rel="stylesheet" />

<script src="/HUEHUECINE/assets/jQuery.js" defer></script>
<script src="/HUEHUECINE/view/infoFilm/scripts.js" defer></script>
</header>

<body style="background-size:cover;
                    background-position:center;
                    background-image: url(https://image.tmdb.org/t/p/original<?= $show->getPoster() ?>);
                    ">
    <div class="bgPoster">

        <header>

            <nav class="navbar navbar-expand navbar-dark justify-content-between">
                <div class="navbar-brand">
                    <a href="../../home/logout.php">
                        <img src="http://via.placeholder.com/100x60">
                    </a>
                    <h1 class="d-none">HueHueCine</h1>
                </div>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/HUEHUECINE/view/home/login.php">Home </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Minha Lista</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" method="GET" action="/HUEHUECINE/view/findFilm/login.php?">
                    <input class="form-control form-control-sm mr-sm-2 inputFind" name="name" type="text" placeholder="Pesquisar por Nome">
                    <button class="btn btn-outline-light my-2 btn-sm my-sm-0" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                <div class="d-flex ml-3 align-items-center">
                    <p class="px-2 mb-0">Olá, <?php if (isset($user['email']))  echo $user['email'] ?></p>
                    <a href="/HUEHUECINE/view/signOut.php" class="btn btn-sm"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </nav>
        </header>

        <main>
            <?php if (isset($show)) : ?>
                <section id="tvShow" class="container">
                    <div class="row">
                        <div class="col-6 infoTVShow">
                            <img src="https://image.tmdb.org/t/p/original<?= $show->getPoster() ?>" alt="<?= $show->getOriginalName() ?>" title="<?= $show->getOriginalName() ?>">
                        </div>
                        <div class="col-6">
                            <div class="pb-3">
                                <h2 class="h4 text-primary"><?= $show->getName() ?></h2>
                                <h3 class="h6 text-secondary"><?= $show->getOriginalName() ?></h3>
                            </div>
                            <div class="d-block py-2">
                                <div class="mb-1">
                                    <p class="h4 text-primary">Avaliação de quem assistiu</p>

                                    <?php

                                    $star = 0;
                                    $votes = floor($show->getVoteAverage());

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
                                    <p class="h6 mr-2 ">
                                        <?= $show->getNumSeasons() ?> temporada<?= $show->getNumSeasons() > 1 ? 's' : '' ?>
                                    </p>
                                    <p class="h6 text-secondary">
                                        <?= $show->getNumEpisodes() ?> episódio<?= $show->getNumEpisodes() > 1 ? 's' : '' ?>
                                    </p>
                                </div>
                                <div class="d-flex my-2">
                                    <p class="h6 mr-2">
                                        Gêneros:
                                    </p>
                                    <p class="text-secondary">
                                        <?php
                                        $genres = array();

                                        foreach ($show->getGenres() as $g) {
                                            array_push($genres, $g['name']);
                                        }

                                        echo implode(", ", $genres);
                                        ?>
                                    </p>
                                </div>

                                <section>
                                    <p class="h4 text-primary d-block">Adicione a sua lista:</p>

                                    <form id="formLista">
                                        <div class="row mx-auto mb-2">
                                            <select id="estadoLista">
                                                <option value="Pretendo">Pretendo</option>
                                                <option value="Assistindo">Assistindo</option>
                                                <option value="Completo">Completo</option>
                                            </select>
                                            <button class="ml-1 btn btn-sm btn-primary" form="formlista" type="submit">
                                                Adicionar
                                            </button>
                                        </div>
                                    </form>

                                </section>

                            </div>
                            <div class="Sinopse py-2 ">
                                <h4 class="h4 text-primary">Sinopse</h4>
                                <p>
                                    <?= $show->getOverview() ?>
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
            <?php if (!isset($show)) :
                include '../../notFound/index.html';
            endif
            ?>
        </main>
    </div>

</body>

<html />