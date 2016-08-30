<?php

use Chrisbjr\ApiGuard\Controllers\ApiGuardController;

class DBEnhancer extends ApiGuardController
{
	public function get()
    {
        $words = Word::findWord('प्रेम');
	    $data = [];
	    $data['word']=$words;
	    if (count($words) > 0)
	    {
	        $synsets = Synset::getSynsets($words[0]->synsets);
	        $data['synsets'] = $synsets;
	    }
	    return Response::json($data);

        //return $this->response->withCollection($books, new BookTransformer);
    }
}