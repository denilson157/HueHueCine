<?php
require_once(dirname(__FILE__) . "/../model/TVShow.php");
require_once(dirname(__FILE__) . "./Tmdb-API.php");

class TVSHOWApi extends TMDB
{
    public function getTopRatedTV()
    {
        $tv = array();

        $result = $this->get('/discover/tv?without_genres=16');

        foreach ($result['results'] as $data) {
            $tv[] = new TVShow($data);
        }

        return (array) $tv;
    }

    public function getTopRatedTVAnimes()
    {
        $tv = array();

        $result = $this->get('/discover/tv?with_genres=16');

        foreach ($result['results'] as $data) {
            $tv[] = new TVShow($data);
        }

        return (array) $tv;
    }

    public function getOnTheAir()
    {
        $tv = array();

        $result = $this->get('/tv/on_the_air?');

        foreach ($result['results'] as $data) {
            $tv[] = new TVShow($data);
        }

        return (array) $tv;
    }

    public function getTVDetail($tvId)
    {
        $result = $this->get("/tv/$tvId?");

        if (count($result) > 0)
            return (object)  new TVShow($result);
        else
            return null;
    }

    public function getByName($tvName)
    {
        $movies = array();

        $result = $this->get("/search/tv?query=$tvName");

        if (count($result) > 0)
            foreach ($result['results'] as $data) {
                $movies[] = new TVShow($data);
            }

        return (array) $movies;
    }
}
