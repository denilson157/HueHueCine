<?php
require_once(dirname(__FILE__) . "../../../../../controller/TvAPI.php");

$tmdb = new TVSHOWApi();

$animes = $tmdb->getTopRatedTVAnimes();

?>


<script src="./listMovies/featuredAnime/index.js"></script>

<div class="movieRow my-3">
    <h2 class="h4">Desenhos mais assistidos.</h2>
    <div class="movieRow--left" onclick="scroll.handleLeft()">
        <span>
            < </span> </div> <div class="movieRow--right" onclick="scrollFeaturedTVAnime.handleRight(<?= isset($animes) ? count($animes) : 0 ?>)">
                <span> > </span>
    </div>
    <div class="movieRow--listarea">
        <div class="movieRow--list" id="featuredTvAnime">
            <?php foreach ($animes as $anime) : ?>
                <a href="../../../view/infoFilm/tv/login.php?id=<?= $anime->getID() ?>">
                    <div class="movieRow--item">
                        <div class="movie" style="background-size:cover;
                    background-position:center;
                    background-image: url(https://image.tmdb.org/t/p/w400<?= $anime->getPoster() ?>)
                    ">
                            <div class="infos p-2">

                                <div class="movie--name">
                                    <?= $anime->getName() ?>
                                </div>
                                <div class="movie--info">
                                    <div class="movie--info-points">
                                        <?= $anime->getVoteAverage() ?>
                                    </div>
                                    <div class="movie--info-year">
                                        <?= $anime->getYear() ?>
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