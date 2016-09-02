<html>
<head>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
<script type="text/javascript">
	function hexc(colorval) {
	    var parts = colorval.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
	    delete(parts[0]);
	    for (var i = 1; i <= 3; ++i) {
	        parts[i] = parseInt(parts[i]).toString(16);
	        if (parts[i].length == 1) parts[i] = '0' + parts[i];
	    }
	    return '#' + parts.join('');
	}
	function selectword(id)
	{
		color = hexc($(id).css('background-color'));
		if (color=="#ffffff")
			$(id).css( "background-color", "red" );
		else
			$(id).css( "background-color", "white" );
	}
</script>
</head>
<body>

<h1>Shabd Sampadaa शब्द सम्पदा</h1>
@if (Auth::check())
    Welcome editing user<br/><br/>
@endif

<form method="GET" action="{{route('search')}}">
Word: <input name="word" type="text" value="{{$word}}">
<input class="submit" type="submit" value="Search">
</form>

{{$word}}<br/><br/>
@if ($synsets != NULL)
	@if (Auth::check())
		<?php $wordid = 1 ?>
		@foreach ($synsets as $synset)
			<?php
				$words = '';
				$words = explode(', ', $synset->words);
			?>
			@foreach ($words as $synsetWord)
				<div style="display:inline-block;min-width:100px;background-color:white" id="word{{$wordid}}" onclick="selectword('{{'#word'.$wordid++}}');">{{$synsetWord}}</div>
			@endforeach
			<br/>
			{{$synset->sense}}
			<br/><br/>
		@endforeach
		<input class="submit" type="button" value="Mark Selected Words as Urdu">
	@else
		@foreach ($synsets as $synset)
			 {{$synset->words}}<br/>
	         {{$synset->sense}}
	         <br/><br/>
	    @endforeach
    @endif
@endif

</body>
</html>