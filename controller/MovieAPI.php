<?php

require_once(dirname(__FILE__) . "/../model/Movie.php");
require_once(dirname(__FILE__) . "./Tmdb-API.php");

class MOVIEApi extends TMDB
{

    public function getMovieDetail($movieId)
    {
        $result = $this->get("/movie/$movieId?");
        if (count($result) > 0)
            return (object)  new Movie($result);
        else
            return null;
    }

    public function getTopRatedMovies()
    {
        $movies = array();

        $result = $this->get('/movie/top_rated?');

        foreach ($result['results'] as $data) {
            $movies[] = new Movie($data);
        }

        return (array) $movies;
    }

    public function getByName($movieName)
    {
        $movies = array();

        $result = $this->get("/search/movie?query=$movieName");

        if (count($result) > 0)
            foreach ($result['results'] as $data) {
                $movies[] = new Movie($data);
            }

        return (array) $movies;
    }
}
