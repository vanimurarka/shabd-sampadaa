<?php

class Word extends Eloquent
{
	protected $table = 'ssp_words';
	// protected $primaryKey = "PRIMARY";

	public static function findWord($word)
	{
		// \DB::enableQueryLog();

		$words = Word::where('word','=',$word)
					->get();
		// dd(\DB::getQueryLog());
		return $words;
	}


}
