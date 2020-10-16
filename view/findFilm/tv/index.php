<?php
require_once(dirname(__FILE__) . "../../../../controller/MovieAPI.php");

$showName = str_replace(" ", "%20", $_GET['name']);;

$tvAPI = new TVSHOWApi();
$tvs = $tvAPI->getByName($showName);
?>


<script src="./tv/index.js"></script>

<div class="movieRow my-3">
    <h2 class="h4">Séries encontradas.</h2>
    <div class="movieRow--left" onclick="scrollFeaturedTV.handleLeft()">
        <span>
            < </span> </div> <div class="movieRow--right" onclick="scrollFeaturedTV.handleRight(<?= isset($movies) ? count($movies) : 0 ?>)">
                <span> > </span>
    </div>
    <div class="movieRow--listarea">
        <div class="movieRow--list" id="featuredTv">
            <?php foreach ($tvs as $tv) : ?>
                <a href="../../../view/infoFilm/tv/logout.php?id=<?= $tv->getID() ?>">
                    <div class="movieRow--item">
                        <div class="movie" style="background-size:cover;
                    background-position:center;
                    background-image: url(https://image.tmdb.org/t/p/w400<?= $tv->getPoster() ?>)
                    ">
                            <div class="infos p-2">

                                <div class="movie--name">
                                    <?= $tv->getName() ?>
                                </div>
                                <div class="movie--info">
                                    <div class="movie--info-points">
                                        <?= $tv->getVoteAverage() ?>
                                    </div>
                                    <div class="movie--info-year">
                                        <?= $tv->getYear() ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach ?>
        </div>

    </div>
</div>