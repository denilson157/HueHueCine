<?php
require_once(dirname(__FILE__) . "/../../../../tmdb-api.php");


$tmdb = new TMDB();

$movies = $tmdb->getTopRatedMovies();

?>


<script src="./listMovies/featuredFilms/index.js"></script>

<div class="movieRow my-3">
    <h2 class="h4">Séries mais assistidos.</h2>
    <div class="movieRow--left" onclick="scrollFeaturedFilms.handleLeft()">
        <span>
            < </span> </div> <div class="movieRow--right" onclick="scrollFeaturedFilms.handleRight(<?= isset($movies) ? count($movies) : 0 ?>)">
                <span> > </span>
    </div>
    <div class="movieRow--listarea">
        <div class="movieRow--list" id="featuredFilms">
            <?php foreach ($movies as $movie) : ?>
                <div class="movieRow--item">
                    <div class="movie" style="background-size:cover;
                    background-position:center;
                    background-image: url(https://image.tmdb.org/t/p/w400<?= $movie->getPoster() ?>)
                    ">
                        <div class="infos p-2">

                            <div class="movie--name">
                                <?= $movie->getTitle() ?>
                            </div>
                            <div class="movie--info">
                                <div class="movie--info-points">
                                    <?= $movie->getVotes() ?>
                                </div>
                                <div class="movie--info-year">
                                    <?= $movie->getYear() ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

    </div>
</div>