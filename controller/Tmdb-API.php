<?php

// require("controller/classes/data/Movie.php");
// require("../model/TMDB/");

class TMDB
{
    const API_KEY = "e7a11df02151175c2b20f723cc8545ec";
    const AUTH = "&language=pt-BR&api_key=" . self::API_KEY;
    const API_BASE = "https://api.themoviedb.org/3";

    public function get($endpoint)
    {

        $url = self::API_BASE . $endpoint . self::AUTH;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);

        $results = curl_exec($ch);

        curl_close($ch);

        return (array) json_decode(($results), true);
    }

    // public function getTopRatedTV()
    // {
    //     $tv = array();

    //     $result = $this->call('/tv/top_rated?');

    //     foreach ($result['results'] as $data) {
    //         $tv[] = new TVShow($data);
    //     }

    //     return (array) $tv;
    // }

    // public function getTopRatedMovies()
    // {
    //     $movies = array();

    //     $result = $this->call('/movie/top_rated?');

    //     foreach ($result['results'] as $data) {
    //         $movies[] = new Movie($data);
    //     }

    //     return (array) $movies;
    // }

    // public function getOnTheAir()
    // {
    //     $tv = array();

    //     $result = $this->call('/tv/on_the_air?');

    //     foreach ($result['results'] as $data) {
    //         $tv[] = new TVShow($data);
    //     }

    //     return (array) $tv;
    // }
}
