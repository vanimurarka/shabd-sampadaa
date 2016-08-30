<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWordId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('words', function(Blueprint $table)
		{
			$table->dropPrimary('PRIMARY');
			$table->unique(array('word', 'pos'));
			// $table->bigIncrements('id')->before('word');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('words', function(Blueprint $table)
		{
			// $table->dropColumn('id');
			$table->dropIndex('ssp_words_word_pos_unique');
			$table->primary(array('word', 'pos'));
		});
	}

}
