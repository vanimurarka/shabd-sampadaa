<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/import', ['as'=>'import', function () use($app) {
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


// Route::get('/show-synset', ['as' => 'show-synset', function ()
// {
//     $which = Input::get('which');
//     $synset = Synset::find($which);
//     if (is_object($synset))
//     {
//         // $action = Input::get('action');
//         // if ($action == "delete")
//         // {
//         //     echo "Deleted<br/>";
//         //     echo "ID: ".$synset->synsetID."<br/>";
//         //     echo "words: ".$synset->words."<br/>";
//         //     echo "sense: ".$synset->sense."<br/><br/>";
//         //     $synset->Backup();
//         //     $synset->delete();
//         // }
//         // else
//         // {
//             echo "ID: ".$synset->synsetID."<br/>";
//             echo "words: ".$synset->words."<br/>";
//             echo "sense: ".$synset->sense."<br/>";
//             // echo '<form method="GET" action="'.route('show-synset').'">';
//             // echo '<input name="action" type="hidden" value="delete">';
//             // echo '<input name="which" type="hidden" value="'.$which.'">';
//             // echo '<input class="submit" type="submit" value="Delete">';
//             // echo '</form>';
//         // }
//     }
//     else
//     {
//         echo "Synset for ID ".$which." not found.<br/>";
//     }
//     echo '<form method="GET" action="'.route('show-synset').'">';
//     echo '<input name="which" type="hidden" value="'.($which+1).'">';
//     echo '<input class="submit" type="submit" value="Next '.($which+1).'">';
//     echo '</form>';
    
// }]);



Route::get('/', ['as' => 'search', function ()
{
    echo "<h1>Shabd Sampadaa शब्द सम्पदा</h1>";
    if (Auth::check())
        echo "Welcome editing user<br/><br/>";

    $word = Input::get('word');
    echo '<form method="GET" action="'.route('search').'">';
    echo 'Word: <input name="word" type="text" value="'.$word.'">';
    echo '<input class="submit" type="submit" value="Search">';
    echo '</form>';

    echo $word;
    if ($word != NULL)
    {
        $utf = urlencode($word);
        $url = Config::get('shabd-sampadaa.api-base-url')."word?word=".$utf;
        echo "<br/><br/>";
        $output = file_get_contents($url);
        $str = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
            return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
        }, $output);
        $str = str_replace([":","_"], [", "," "], $str);
        $receivedData = json_decode($output);
        foreach ($receivedData->synsets as $synset)
        {
            // echo "ID: ".$synset->synsetID."<br/>";
            echo str_replace([":","_"], [", "," "], $synset->words)."<br/>";
            echo $synset->sense."<br/><br/>";
        }
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

Route::get('/api/word', ['as' => 'api-search', function ()
{
    $word = Input::get('word');

    $words = Word::findWord($word);
    $data = [];
    $data['word']=$words;
    if (count($words) > 0)
    {
        $synsets = Synset::getSynsets($words[0]->synsets);
        $data['synsets'] = $synsets;
    }
    return Response::json($data);
}]);

Route::get('/test', ['as' => 'secsearch', function ()
{
        $url = Config::get('shabd-sampadaa.api-base-url')."secureword";
        echo "<br/><br/>";
        $context = stream_context_create(array(
            'http' => array(
                'header'  => "X-Authorization: b33a86e0eb9efa4d06e56bfe5d5f305bf6b4a35e")
        ));
        $output = file_get_contents($url, false, $context);
        var_dump($output);
}]);

Route::get('/login', function()
{
    return View::make('login');
});
Route::post('/login-submit','UserController@login');

Route::get('/api/secureword', 'DBEnhancer@get');