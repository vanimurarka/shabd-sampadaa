<?php

# app/Models/Word.php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

final class Importer
{
	// protected $table = 'ssp_words';
	// protected $primaryKey = "PRIMARY";

	public static function importWords($wordFilename,$pos)
	{
		$file = fopen("C:\\vani\Dropbox\www\shabd-sampadaa\HindiWN_1_4\database\idxadverb_txt","r");
		echo fgets($file);
		echo fgets($file);
		fclose($file);
	}
}