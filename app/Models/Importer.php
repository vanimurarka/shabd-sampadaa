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
		$file = fopen($wordFilename,"r");
		while (!feof($file))
		{
			$line = fgets($file);
			$wordEnd = strpos($line, " ");
			echo substr($line,0,$wordEnd);
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
				$synsetNumbersAsString .= $numbers[$i]." ";
			}
			echo($synsetNumbersAsString."<br/>");
		}
		// echo fgets($file);
		fclose($file);
	}
}