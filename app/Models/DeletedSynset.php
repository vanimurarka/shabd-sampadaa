<?php

# backup of deleted Synsets

class DeletedSynset extends Eloquent
{
	protected $table = 'ssp_synsets_deleted';
	protected $primaryKey = "synsetID";
	
}