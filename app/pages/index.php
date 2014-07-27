<?php
include 'header.php'; 

$data = json_decode(file_get_contents(__DIR__.'/../../data/albums.json'),1);

echo '<div class="col-md-12">';
foreach($data  as $album){
	echo '<div class="col-md-4">'.
	'<a href="/album?name='.urlencode($album['name']).'" class="thumbnail">'.
	'<img src="'.($album['image']?$album['image']:'/assets/images/default_cover.jpg').'" />'.
	'<small>'.$album['name'].'</small></a>'
	.'</div>';
}
echo '</div>';


include 'footer.php';
