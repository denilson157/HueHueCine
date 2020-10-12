<?php

require_once(dirname(__FILE__) . "/../model/TVShow.php");
require_once(dirname(__FILE__) . "./Tmdb-API.php");

class TVSHOWApi extends TMDB
{
    public function getTopRatedTV()
    {
        $tv = array();

        $result = $this->get('/tv/top_rated?');

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
}
