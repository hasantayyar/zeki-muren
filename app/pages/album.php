<?php
$albumName = urldecode($_GET['name']);

include 'header.php'; 

if(!isset($_GET['name'])){
	echo "404";
	die();
}
$data = json_decode(file_get_contents(__DIR__.'/../../data/album_'.md5($albumName).'.json'),1);

echo '<a href="/" class="btn btn-default">Back to list</a> <br>'.
	'<h2>Zeki Müren - '.htmlentities($albumName).'</h2> <div class="list-group">';
foreach($data['songs']  as $song){
	echo '<div class="list-group-item">'.
	'<a href="'.$song['video'].'" id="play_'.md5($song['name']).'" '.
	'class="play">'.
	urldecode($song['name']).
	'</a></div>';
}
echo '</div>';

include 'footer.php';
