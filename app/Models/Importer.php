<?php

class Importer
{
	// protected $table = 'ssp_words';
	// protected $primaryKey = "PRIMARY";

	public static function importWords($wordFilename,$pos,$start=0,$end=0)
	{
		set_time_limit(60*10);
		$file = fopen($wordFilename,"r");
		$linecounter = 0;
		$somelines = false;
		if ($start > 0)
			$somelines = true;
		while (!feof($file))
		{
			$line = fgets($file);
			if ($somelines)
			{
				$linecounter++;
				if (($linecounter>=$start) && ($linecounter<=$end))
					self::importWordLine($line,$pos);
				if ($linecounter>$end)
					break;
			}
			else
			{
				self::importWordLine($line,$pos);
			}
		}
		// echo fgets($file);
		fclose($file);
	}

	private static function importWordLine($line,$pos)
	{
		$wordEnd = strpos($line, " ");
		$word = substr($line,0,$wordEnd);
		echo $word;
		echo "<br/>";
		$remainingLine = substr($line, $wordEnd);
		echo $remainingLine."<br/>";
		$numbers = explode(" ", trim($remainingLine));
		// echo $numbers[1];
		$senseCount = (int)$numbers[2+(int)$numbers[1]];
		// echo($senseCount."<br/>");
		$synsetNumbersAsString = "";
		$synsetStart = 3+$numbers[1];
		// echo($synsetStart."<br/>");
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

	private static function importSynsetLine($line)
	{
		$lineParts = explode(" | ", trim($line));
		$lineSubParts = explode(" ", $lineParts[0]);
		$synsetID = (int)$lineSubParts[0];
		echo($synsetID."<br/>");
		$synsetWords = $lineSubParts[3];
		echo($synsetWords."<br/>");

		$synset = new Synset;
		$synset->synsetID = $synsetID;
		$synset->words = $synsetWords;
		if (count($lineParts)>1)
		{
			echo($lineParts[1]."<br/>");
			$synset->sense = $lineParts[1];
		}
		$synset->save();
	}

	public static function importSynsets($filename,$start=0,$end=0)
	{
		set_time_limit(60*10);
		$file = fopen($filename,"r");
		$linecounter = 0;
		$somelines = false;
		if ($start > 0)
			$somelines = true;
		while (!feof($file))
		{
			$line = fgets($file);
			if ($somelines)
			{
				$linecounter++;
				if (($linecounter>=$start) && ($linecounter<=$end))
					self::importSynsetLine($line);
				if ($linecounter>$end)
					break;
			}
			else
			{
				self::importSynsetLine($line);
			}
		}
		// echo fgets($file);
		fclose($file);
	}
}