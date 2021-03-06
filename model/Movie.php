<?php

require_once "ApiBaseTMDB.php";

class Movie extends ApiBaseTMDB
{
	public function getOriginalTitle()
	{
		return $this->_data['original_title'];
	}
	public function getTitle()
	{
		return $this->_data['title'];
	}

	public function getVotes()
	{
		return $this->_data['vote_average'];
	}

	public function getYear()
	{
		$pdate = $this->_data['release_date'];

		if ($pdate != "") {
			$date = DateTime::createFromFormat("Y-m-d", $pdate);
			return $date->format("Y");
		} else
			return "";
	}

	public function getGenres()
	{
		return $this->_data['genres'];
	}

	public function getRuntime()
	{
		return $this->_data['runtime'];
	}

	public function getReviews()
	{
		$reviews = array();

		foreach ($this->_data['review']['result'] as $data) {
			$reviews[] = new Review($data);
		}

		return $reviews;
	}
}
