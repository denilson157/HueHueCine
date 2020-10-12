<?php

require_once(dirname(__FILE__) . "/../model/Movie.php");
require_once(dirname(__FILE__) . "./Tmdb-API.php");

class MOVIEApi extends TMDB
{

    public function getTopRatedMovies()
    {
        $movies = array();

        $result = $this->get('/movie/top_rated?');

        foreach ($result['results'] as $data) {
            $movies[] = new Movie($data);
        }

        return (array) $movies;
    }
}
