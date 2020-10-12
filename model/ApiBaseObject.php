<?php

require_once "ApiBaseObject.php";

class ApiBaseObject
{
    const MEDIA_TYPE_MOVIE = 'movie';
    const CREDITS_TYPE_CAST = 'cast';
    const CREDITS_TYPE_CREW = 'crew';
    const MEDIA_TYPE_TV = 'tv';

    protected $_data;

    public function __construct($data) {
        $this->_data = $data;
    }
    
    public function getID() {
        return $this->_data['id'];
    }
    
    public function getPoster() {
        return $this->_data['poster_path'];
    }

    public function getOverview() {
        return $this->_data['overview'];
    }    
    
    public function getVoteAverage() {
        return $this->_data['vote_average'];
    }

    public function getVoteCount() {
        return $this->_data['vote_count'];
    }

    public function get($item = ''){

        if(empty($item)){
            return $this->_data;
        }

        if(array_key_exists($item, $this->_data)){
            return $this->_data[$item];
        }

        return null;
    }
}