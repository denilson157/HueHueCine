<?php
include "../../cabecalho.php";
require_once(dirname(__FILE__) . "../../../../controller/TvAPI.php");
$tmdb = new TVSHOWApi();

$show = $tmdb->getTVDetail($_GET['id']);


?>

<link href="../style.css" rel="stylesheet" />
<link href="./style.css" rel="stylesheet" />
</header>

<body>

    <header>

        <nav class="navbar navbar-expand navbar-dark justify-content-between">
            <div class="navbar-brand">
                <a href="../../home/logout.php">
                    <img src="http://via.placeholder.com/100x60">
                </a>
                <h1 class="d-none">HueHueCine</h1>
            </div>
            <div class="d-inline">
                <a href="../login" class="btn btn-sm btn-secondary mx-2 my-sm-0">Entrar</a>
                <a href="../register" class="btn btn-sm btn-primary my-sm-0">Cadastre-se</a>
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
                            <h2 class="h4"><?= $show->getName() ?></h2>
                            <h3 class="h6 text-secondary"><?= $show->getOriginalName() ?></h3>
                        </div>
                        <div class="d-block py-2">
                            <div class="mb-1">
                                <p class="h4">Avaliação de quem assistiu</p>

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

                        </div>
                        <div class="Sinopse py-2">
                            <h4 class="h4">Sinopse</h4>
                            <p>
                                <?= $show->getOverview() ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row my-5">
                    <div class="mx-auto">
                        <p class="text-center h3 mb-0">Você já assitiu?</p>
                        <p class="text-center text-secondary h5">Faça o login e adicione <?= $show->getName() ?> a sua lista de assistidos.</p>
                    </div>
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
</body>

<html />