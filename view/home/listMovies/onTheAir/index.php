<?php
require_once(dirname(__FILE__) . "../../../../../controller/TvAPI.php");

$tmdb = new TVSHOWApi();

$tvs = $tmdb->getOnTheAir();
?>

<script src="./listMovies/onTheAir/index.js"></script>

<div class="tvRow my-3">
    <h2 class="h4">Mais assistidos da semana.</h2>
    <div class="tvRow--left" onclick="scrollOnTheAir.handleLeft()">
        <span>
            < </span> </div> <div class="tvRow--right" onclick="scrollOnTheAir.handleRight(<?= isset($tvs) ? count($tvs) : 0 ?>)">
                <span> > </span>
    </div>
    <div class="tvRow--listarea">
        <div class="tvRow--list" id="onTheAir">
            <?php foreach ($tvs as $tv) : ?>
                <div class="tvRow--item">
                    <a href="../../../view/infoFilm/tv/login.php?id=<?= $tv->getID() ?>">
                        <img src="https://image.tmdb.org/t/p/w200<?= $tv->getPoster() ?>" alt="<?= $tv->getOriginalName() ?>" title="<?= $tv->getOriginalName() ?>">
                    </a>
                </div>
            <?php endforeach ?>
        </div>

    </div>
</div>