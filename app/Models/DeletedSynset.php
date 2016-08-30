<?php

# backup of deleted Synsets

class DeletedSynset extends Eloquent
{
	protected $table = 'synsets_deleted';
	protected $primaryKey = "synsetID";
	
}