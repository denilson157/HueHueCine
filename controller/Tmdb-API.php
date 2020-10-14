<?php

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
}
