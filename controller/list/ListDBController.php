<?php
require_once(dirname(__FILE__) . "../../../controller/MovieAPI.php");
require_once(dirname(__FILE__) . "../../../controller/TvAPI.php");
require_once(dirname(__FILE__) . "/../../model/ListDB.php");


class ListDBController
{
    private $user;
    private $wantWatch = 1;
    private $watching = 2;
    private $watched = 3;

    public function __construct()
    {
        $this->user = $_SESSION['user'];
    }

    public function getListByUser($typeMTV)
    {
        $list = new ListaDB();

        $return = $list->getListByUser($this->user, $typeMTV);

        return $return;
    }

    public function getMoviesById($movieIds): array
    {

        $tmdb = new MOVIEApi();

        $movies = [];

        if ($movieIds != null)
            foreach ($movieIds as $movieId) {

                $returnMovie = $tmdb->getMovieDetail((int)$movieId['idFilme']);

                array_push(
                    $movies,
                    $returnMovie
                );
            }

        return $movies;
    }

    public function getMoviesWantWatch($moviesList)
    {
        return array_filter($moviesList, function ($k) {
            return $k['idStatus'] == $this->wantWatch;
        }, ARRAY_FILTER_USE_BOTH);
    }

    public function getMoviesWatching($moviesList)
    {
        return array_filter($moviesList, function ($k) {
            return $k['idStatus'] == $this->watching;
        }, ARRAY_FILTER_USE_BOTH);
    }

    public function getMoviesWatched($moviesList)
    {
        return array_filter($moviesList, function ($k) {
            return $k['idStatus'] == $this->watched;
        }, ARRAY_FILTER_USE_BOTH);
    }


    public function getTvsById($tvIds): array
    {

        $tmdb = new TVSHOWApi();

        $tvs = [];

        foreach ($tvIds as $tv) {

            $returnTv = $tmdb->getTVDetail((int)$tv['idFilme']);

            array_push(
                $tvs,
                $returnTv
            );
        }


        return $tvs;
    }
}
