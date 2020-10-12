<?php

require_once "ApiBaseObject.php";

class Movie extends ApiBaseObject
{

	private $_tmdb;

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

	
	public function getReviews()
	{
		$reviews = array();

		foreach ($this->_data['review']['result'] as $data) {
			$reviews[] = new Review($data);
		}

		return $reviews;
	}
}
