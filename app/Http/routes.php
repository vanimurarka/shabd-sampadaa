<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use App\Models\Importer;

$app->get('/import', function () use($app) {
    // return $app->version();
    $wordFile = "C:\\vani\Dropbox\www\shabd-sampadaa\HindiWN_1_4\database\idxadjective-without-numberwords_txt";
    $wordPartOfSpeech = 2;
    $lineStart = 1;
    $lineEnd = 1000;
    $words = Importer::importWords($wordFile,$wordPartOfSpeech);
});

$app->get('/', function () use($app) {
    <form method="GET" action="http://manaskriti.com/geet-gatiroop/login-submit" accept-charset="UTF-8">
    From Line: <input name="lineFrom" type="text"><br/>
    To Line: <input name="lineTo" type="text"><br/>
	<input class="submit" type="submit" value="Import">
	</form>
});


