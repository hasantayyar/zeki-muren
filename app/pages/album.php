<?php
include 'header.php'; 

if(!isset($_GET['name'])){
	echo "404";
	die();
}
$name = urldecode($_GET['name']);
$data = json_decode(file_get_contents(__DIR__.'/../../data/album_'.md5($name).'.json'),1);

echo '<a href="/" class="btn btn-default">Back to list</a> <br><div class="list-group">';
foreach($data['songs']  as $song){
	echo '<div class="list-group-item">'.
	'<a href="'.$song['video'].'" class="btn btn-success">P</a> '.
	urldecode($song['name']).
	'</div>';
}
echo '</div>';


include 'footer.php';