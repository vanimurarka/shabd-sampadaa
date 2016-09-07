<?php

class Synset extends Eloquent
{
	protected $table = 'synsets';
	protected $primaryKey = "synsetID";

	public function linkedwords()
    {
        return $this->belongsToMany('Word','synset_words','synsetid','wordid');
    }

	public function Backup()
	{
		$deletedSynset = new DeletedSynset;
		$deletedSynset->synsetID = $this->synsetID;
		$deletedSynset->words = $this->words;
		$deletedSynset->sense = $this->sense;
		$deletedSynset->save();
	}

	public static function getSynsets($ids)
	{
		$wordsArray = '';
		$synsets = Synset::whereIn('synsetID',explode(',',$ids))
					->select('synsetID','words','sense','join_row_created')
					->with('linkedwords')
					->get();
		foreach ($synsets as $synset) {
			// var_dump($synset->join_row_created);
			if ($synset->join_row_created != 1) // join row not created
			{
				$strSynsetid = (string) $synset->synsetID;
				$wordsArray = explode(":", $synset->words);
				$wordCollection = Word::whereIn('word',$wordsArray)->get();
				foreach ($wordCollection as $linkedword)
				{
					$pos = strpos($linkedword->synsets, $strSynsetid);
					Log::info($linkedword->synsets);
					Log::info($strSynsetid);
					Log::info($pos);
					if ($pos !== false)
					{
						Log::info("adding join row");
						$synsetWord = new SynsetWord;
						$synsetWord->synsetid = $synset->synsetID;
						$synsetWord->wordid = $linkedword->id;
						$synsetWord->save();
					}
				}
				$synset->join_row_created = 1;
				$synset->save();
			}
			$synset->words = str_replace([":","_"], [", "," "], $synset->words);
		}
		return $synsets;
	}
}