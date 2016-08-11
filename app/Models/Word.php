<?php

# app/Models/Word.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Word extends Model  
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
