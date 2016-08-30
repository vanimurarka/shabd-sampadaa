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

		$synsets = Synset::whereIn('synsetID',explode(',',$ids))
					->select('synsetID','words','sense')
					->get();
		foreach ($synsets as $synset) {
			$synset->words = str_replace([":","_"], [", "," "], $synset->words);
		}
		return $synsets;
	}
}