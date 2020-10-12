<?php

require_once "ApiBaseObject.php";

class Movie extends ApiBaseObject
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

		$date = DateTime::createFromFormat("Y-m-d", $pdate);
		return $date->format("Y");
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
