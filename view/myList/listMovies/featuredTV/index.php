<?php
require_once(dirname(__FILE__) . "../../../../../controller/list/ListDBController.php");

$controller = new ListDBController();

$tvIds = $controller->getListByUser("tv");

$movies = $controller->getTvsById($tvIds);

$moviesWantWatchID = $controller->getMoviesWantWatch($tvIds);

$moviesWantWatch = $controller->getTvsById($moviesWantWatchID);

$moviesWatchingID = $controller->getMoviesWatching($tvIds);

$moviesWatching = $controller->getTvsById($moviesWatchingID);

$moviesWatchedID = $controller->getMoviesWatched($tvIds);

$moviesWatched = $controller->getTvsById($moviesWatchedID);


?>


<script src="./listMovies/featuredTV/index.js"></script>

<div class="movieRow my-3">
    <h2 class="h4">
        <?php
        if ($tvIds == null)
            echo "Adicione uma série para sua lista";
        else
            echo "Séries";
        ?>
    </h2>
    <div class="movieRow--left" onclick="scrollFeaturedTV.handleLeft()">
        <span>
            < </span> </div> <div class="movieRow--right" onclick="scrollFeaturedTV.handleRight(<?= isset($movies) ? count($movies) : 0 ?>)">
                <span> > </span>
    </div>
    <div class="movieRow--listarea">
        <div class="movieRow--list" id="featuredTv">
            <?php foreach ($movies as $movie) : ?>
                <a href="../../../HUEHUECINE/view/infoFilm/tv/login.php?id=<?= $movie->getID() ?>">
                    <div class="movieRow--item">
                        <div class="movie" style="background-size:cover;
                    background-position:center;
                    background-image: url(https://image.tmdb.org/t/p/w400<?= $movie->getPoster() ?>)
                    ">
                            <div class="infos p-2">

                                <div class="movie--name">
                                    <?= $movie->getName() ?>
                                </div>
                                <div class="movie--info">
                                    <div class="movie--info-points">
                                        <?= $movie->getVoteAverage() ?>
                                    </div>
                                    <div class="movie--info-year">
                                        <?= $movie->getYear() ?>

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


<div class="movieRow my-3">
    <h2 class="h4">
        <?php
        if ($tvIds != null)
            echo "Pretendo assistir";
        ?>
    </h2>
    <div class="movieRow--left" onclick="scrollFeaturedTV.handleLeft()">
        <span>
            < </span> </div> <div class="movieRow--right" onclick="scrollFeaturedTV.handleRight(<?= isset($movies) ? count($movies) : 0 ?>)">
                <span> > </span>
    </div>
    <div class="movieRow--listarea">
        <div class="movieRow--list" id="featuredTv">
            <?php foreach ($moviesWantWatch as $movie) : ?>
                <a href="../../../HUEHUECINE/view/infoFilm/tv/login.php?id=<?= $movie->getID() ?>">
                    <div class="movieRow--item">
                        <div class="movie" style="background-size:cover;
                    background-position:center;
                    background-image: url(https://image.tmdb.org/t/p/w400<?= $movie->getPoster() ?>)
                    ">
                            <div class="infos p-2">

                                <div class="movie--name">
                                    <?= $movie->getName() ?>
                                </div>
                                <div class="movie--info">
                                    <div class="movie--info-points">
                                        <?= $movie->getVoteAverage() ?>
                                    </div>
                                    <div class="movie--info-year">
                                        <?= $movie->getYear() ?>

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

<div class="movieRow my-3">
    <h2 class="h4">
        <?php
        if ($tvIds != null)
            echo "Assistindo";
        ?>
    </h2>
    <div class="movieRow--left" onclick="scrollFeaturedTV.handleLeft()">
        <span>
            < </span> </div> <div class="movieRow--right" onclick="scrollFeaturedTV.handleRight(<?= isset($movies) ? count($movies) : 0 ?>)">
                <span> > </span>
    </div>
    <div class="movieRow--listarea">
        <div class="movieRow--list" id="featuredTv">
            <?php foreach ($moviesWatching as $movie) : ?>
                <a href="../../../HUEHUECINE/view/infoFilm/tv/login.php?id=<?= $movie->getID() ?>">
                    <div class="movieRow--item">
                        <div class="movie" style="background-size:cover;
                    background-position:center;
                    background-image: url(https://image.tmdb.org/t/p/w400<?= $movie->getPoster() ?>)
                    ">
                            <div class="infos p-2">

                                <div class="movie--name">
                                    <?= $movie->getName() ?>
                                </div>
                                <div class="movie--info">
                                    <div class="movie--info-points">
                                        <?= $movie->getVoteAverage() ?>
                                    </div>
                                    <div class="movie--info-year">
                                        <?= $movie->getYear() ?>

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

<div class="movieRow my-3">
    <h2 class="h4">
        <?php
        if ($tvIds != null)
            echo "Assistido";
        ?>
    </h2>
    <div class="movieRow--left" onclick="scrollFeaturedTV.handleLeft()">
        <span>
            < </span> </div> <div class="movieRow--right" onclick="scrollFeaturedTV.handleRight(<?= isset($movies) ? count($movies) : 0 ?>)">
                <span> > </span>
    </div>
    <div class="movieRow--listarea">
        <div class="movieRow--list" id="featuredTv">
            <?php foreach ($moviesWatched as $movie) : ?>
                <a href="../../../HUEHUECINE/view/infoFilm/tv/login.php?id=<?= $movie->getID() ?>">
                    <div class="movieRow--item">
                        <div class="movie" style="background-size:cover;
                    background-position:center;
                    background-image: url(https://image.tmdb.org/t/p/w400<?= $movie->getPoster() ?>)
                    ">
                            <div class="infos p-2">

                                <div class="movie--name">
                                    <?= $movie->getName() ?>
                                </div>
                                <div class="movie--info">
                                    <div class="movie--info-points">
                                        <?= $movie->getVoteAverage() ?>
                                    </div>
                                    <div class="movie--info-year">
                                        <?= $movie->getYear() ?>

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