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

$app->get('/', function () use($app) {
    // return $app->version();
    $adverbFile = "C:\\vani\Dropbox\www\shabd-sampadaa\HindiWN_1_4\database\idxadverb_txt";
    $adverbPartOfSpeech = 4;
    $words = Importer::importWords($adverbFile,$adverbPartOfSpeech);
});


