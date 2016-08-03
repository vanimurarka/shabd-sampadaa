<?php

# app/Models/Word.php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

use App\Models\Word;

final class Importer
{
	// protected $table = 'ssp_words';
	// protected $primaryKey = "PRIMARY";

	public static function importWords($wordFilename,$pos)
	{
		set_time_limit(60*5);
		$file = fopen($wordFilename,"r");
		while (!feof($file))
		{
			$line = fgets($file);
			$wordEnd = strpos($line, " ");
			$word = substr($line,0,$wordEnd);
			echo $word;
			echo "<br/>";
			$remainingLine = substr($line, $wordEnd);
			echo $remainingLine."<br/>";
			$numbers = explode(" ", trim($remainingLine));
			// echo $numbers[1];
			$senseCount = (int)$numbers[2+(int)$numbers[1]];
			echo($senseCount."<br/>");
			$synsetNumbersAsString = "";
			$synsetStart = 3+$numbers[1];
			echo($synsetStart."<br/>");
			for ($i=$synsetStart; $i < $synsetStart+$senseCount; $i++) { 
				if ($i > $synsetStart)
					$synsetNumbersAsString .= ",";	
				$synsetNumbersAsString .= (int)$numbers[$i];
			}
			echo($synsetNumbersAsString."<br/>");
			$dbWord = new Word;
			$dbWord->word = $word;
			$dbWord->pos = $pos;
			$dbWord->synsets = $synsetNumbersAsString;
			$dbWord->save();
		}
		// echo fgets($file);
		fclose($file);
	}
}