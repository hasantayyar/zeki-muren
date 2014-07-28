<?php
include 'header.php'; 

if(!isset($_GET['name'])){
	echo "404";
	die();
}
$name = urldecode($_GET['name']);
$data = json_decode(file_get_contents(__DIR__.'/../../data/album_'.md5($name).'.json'),1);

echo '<div id="video" style="display:none"></div> '.
		'<a href="#" id="play-button" class="btn btn-success hide">Play</a> '.
		'<a href="#" id="pause-button" class="btn btn-success hide">Pause</a> ';
echo '<a href="/" class="btn btn-default">Back to list</a> <br>'.
	'<h2>Zeki Müren - '.htmlentities($name).'</h2> <div class="list-group">';
foreach($data['songs']  as $song){
	echo '<div class="list-group-item">'.
	'<a href="'.$song['video'].'?enablejsapi=1&playerapiid=ytplayer" id="play_'.md5($song['name']).'" '.
	'onclick="loadVideo(\'play_'.md5($song['name']).'\');return false;" '.
	'class="play"></a>'.
	urldecode($song['name']).
	'</div>';
}
echo '</div>';


include 'footer.php';
