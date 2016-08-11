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
use App\Models\Synset;
use App\Models\Word;
use Illuminate\Support\Facades\Input;

$app->get('/import', ['as'=>'import', function () use($app) {
    // return $app->version();
    $filename = "C:\\vani\Dropbox\www\shabd-sampadaa\HindiWN_1_4\database\data_txt";
    // $wordPartOfSpeech = 1;
    $lineStart = Input::get('lineFrom');
    $lineEnd = Input::get('lineTo');
    // echo $lineStart.$lineEnd;
    echo("start:".$lineStart." end:".$lineEnd."<br/><br/>");
    $words = Importer::importSynsets($filename,$lineStart,$lineEnd);
    echo "<br/><br/>";
    echo '<form method="GET" action="'.route('import').'">';
    echo 'From Line: <input name="lineFrom" type="text" value="'.($lineEnd+1).'"><br/>';
    echo 'To Line: <input name="lineTo" type="text" value="'.($lineEnd+1+4000).'"><br/>';
    echo '<input class="submit" type="submit" value="Import">';
    echo '</form>';
}]);

// $app->get('/', function () use($app) {


// });

$app->get('/show-synset', ['as' => 'show-synset', function ()
{
    $which = Input::get('which');
    $synset = Synset::find($which);
    if (is_object($synset))
    {
        $action = Input::get('action');
        if ($action == "delete")
        {
            echo "Deleted<br/>";
            echo "ID: ".$synset->synsetID."<br/>";
            echo "words: ".$synset->words."<br/>";
            echo "sense: ".$synset->sense."<br/><br/>";
            $synset->Backup();
            $synset->delete();
        }
        else
        {
            echo "ID: ".$synset->synsetID."<br/>";
            echo "words: ".$synset->words."<br/>";
            echo "sense: ".$synset->sense."<br/>";
            echo '<form method="GET" action="'.route('show-synset').'">';
            echo '<input name="action" type="hidden" value="delete">';
            echo '<input name="which" type="hidden" value="'.$which.'">';
            echo '<input class="submit" type="submit" value="Delete">';
            echo '</form>';
        }
    }
    else
    {
        echo "Synset for ID ".$which." not found.<br/>";
    }
    echo '<form method="GET" action="'.route('show-synset').'">';
    echo '<input name="which" type="hidden" value="'.($which+1).'">';
    echo '<input class="submit" type="submit" value="Next '.($which+1).'">';
    echo '</form>';
    
}]);



$app->get('/', ['as' => 'search', function ()
{
    $word = Input::get('word');
    echo '<form method="GET" action="'.route('search').'">';
    echo 'Word: <input name="word" type="text" value="'.$word.'">';
    echo '<input class="submit" type="submit" value="Search">';
    echo '</form>';

    var_dump($word);
    if ($word != NULL)
    {
        $utf = urlencode($word);
        var_dump($utf);
        var_dump(urldecode($utf));
        $url = "http://localhost/shabd-sampadaa/public/api/word?word=".$utf;
        var_dump($url);
        echo "<br/>";
        $output = file_get_contents($url);
        echo "<br/>output: ";
        var_dump($output);
        echo "<br/>";
        $str = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
            return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
        }, $output);
        var_dump($str);
    }

    // $words = Word::findWord($word);
    // if (count($words) > 0)
    // {
    //     $synsets = Synset::getSynsets($words[0]->synsets);
    //     if (count($synsets)>0)
    //     {
    //         foreach ($synsets as $synset) {
    //             echo "ID: ".$synset->synsetID."<br/>";
    //             echo "words: ".str_replace([":","_"], [", "," "], $synset->words)."<br/>";
    //             echo "sense: ".$synset->sense."<br/><br/>";
    //         }
    //     }
    // }
}]);

$app->get('/api/word', ['as' => 'api-search', function ()
{
    $word = Input::get('word');

    $words = Word::findWord($word);
    // if (count($words) > 0)
    // {
    //     $synsets = Synset::getSynsets($words[0]->synsets);
    //     if (count($synsets)>0)
    //     {
    //         foreach ($synsets as $synset) {
    //             echo "ID: ".$synset->synsetID."<br/>";
    //             echo "words: ".str_replace([":","_"], [", "," "], $synset->words)."<br/>";
    //             echo "sense: ".$synset->sense."<br/><br/>";
    //         }
    //     }
    // }
    return response()->json($words);
}]);