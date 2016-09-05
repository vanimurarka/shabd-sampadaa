<?php

class Synset extends Eloquent
{
	protected $table = 'synsets';
	protected $primaryKey = "synsetID";

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
					->get();
		foreach ($synsets as $synset) {
			// var_dump($synset->join_row_created);
			if ($synset->join_row_created != 1) // join row not created
			{
				$wordsArray = explode(":", $synset->words);
				$wordids = DB::table('words')->whereIn('word',$wordsArray)->lists('id');
				foreach ($wordids as $wordid )
				{
					$synsetWord = new SynsetWord;
					$synsetWord->synsetid = $synset->synsetID;
					$synsetWord->wordid = $wordid;
					$synsetWord->save();
				}
				$synset->join_row_created = 1;
				$synset->save();
			}
			$synset->words = str_replace([":","_"], [", "," "], $synset->words);
		}
		return $synsets;
	}
}