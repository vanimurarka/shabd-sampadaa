<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSynsetWords extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('synset_words', function(Blueprint $table)
		{
		    $table->bigincrements('id')->unsigned();
		    $table->biginteger('synsetid');
		    $table->biginteger('wordid');
		    $table->timestamps();
		});
		Schema::table('synset_words', function(Blueprint $table)
		{
			$table->unique(array('synsetid', 'wordid'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('synset_words');
	}

}
