<?php

require_once "ApiBaseObject.php";

class TVShow extends ApiBaseObject
{
    public function getName()
    {
        return $this->_data['name'];
    }

    public function getOriginalName()
    {
        return $this->_data['original_name'];
    }

    public function getNumSeasons()
    {
        return $this->_data['number_of_seasons'];
    }

    public function getNumEpisodes()
    {
        return $this->_data['number_of_episodes'];
    }
    
	public function getGenres()
	{
		return $this->_data['genres'];
	}

    public function getPoster()
    {
        return $this->_data['poster_path'];
    }

    public function getYear()
    {
        $pdate = $this->_data['first_air_date'];

        $date = DateTime::createFromFormat("Y-m-d", $pdate);
        return $date->format("Y");
    }
}
