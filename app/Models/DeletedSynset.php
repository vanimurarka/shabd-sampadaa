<?php

# backup of deleted Synsets

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class DeletedSynset extends Model  
{
	protected $table = 'ssp_synsets_deleted';
	protected $primaryKey = "synsetID";
	
}