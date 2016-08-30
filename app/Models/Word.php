<?php

class Word extends Eloquent
{
	protected $table = 'words';

	public static function findWord($word)
	{

		$words = Word::where('word','=',$word)
					->select('word','pos','synsets')
					->get();
		return $words;
	}


}
