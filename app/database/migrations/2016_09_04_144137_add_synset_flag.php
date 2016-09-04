<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSynsetFlag extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// a flag in the synset table to track whether
		// its row has been created in the synset-words many-to-many 
		// table with all its words
		Schema::table('synsets', function(Blueprint $table)
		{
			$table->tinyinteger('join_row_created')->after('sense');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('synsets', function(Blueprint $table)
		{
			$table->dropColumn('join_row_created');
		});
	}

}
