<?php

class WebInterfaceController extends BaseController {

	public function showIndex()
	{
		$word = Input::get('word');
		$synsets = NULL;
		if ($word != NULL)
	    {
	        $utf = urlencode($word);
	        $url = Config::get('shabd-sampadaa.api-base-url')."word?word=".$utf;
	        $output = file_get_contents($url);
	        $str = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
	            return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
	        }, $output);
	        $str = str_replace([":","_"], [", "," "], $str);
	        $receivedData = json_decode($output);
	        $synsets = $receivedData->synsets;
	    }
		return View::make('home',
                   array('word' => $word,'synsets'=>$synsets))->render();
	}

}
