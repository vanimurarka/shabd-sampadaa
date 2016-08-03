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
use Illuminate\Support\Facades\Input;

$app->get('/import', ['as'=>'import', function () use($app) {
    // return $app->version();
    $wordFile = "C:\\vani\Dropbox\www\shabd-sampadaa\HindiWN_1_4\database\idxadjective-without-numberwords_txt";
    $wordPartOfSpeech = 2;
    $lineStart = Input::get('lineFrom');
    $lineEnd = Input::get('lineTo');
    // echo $lineStart.$lineEnd;
    echo("start:".$lineStart." end:".$lineEnd."<br/><br/>");
    $words = Importer::importWords($wordFile,$wordPartOfSpeech,$lineStart,$lineEnd);
    echo "<br/><br/>";
    echo '<form method="GET" action="'.route('import').'">';
    echo 'From Line: <input name="lineFrom" type="text" value="'.($lineEnd+1).'"><br/>';
    echo 'To Line: <input name="lineTo" type="text" value="'.($lineEnd+1+2000).'"><br/>';
    echo '<input class="submit" type="submit" value="Import">';
    echo '</form>';
}]);

$app->get('/', function () use($app) {

    echo '<form method="GET" action="'.route('import').'">';
    echo 'From Line: <input name="lineFrom" type="text"><br/>';
    echo 'To Line: <input name="lineTo" type="text"><br/>';
	echo '<input class="submit" type="submit" value="Import">';
	echo '</form>';
});


