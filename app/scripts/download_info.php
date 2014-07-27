<?php
$apikey = "f5af8b18105cb72ed5473827d4fe407b";
$url = "http://ws.audioscrobbler.com/2.0/?method=artist.gettopalbums&artist=Zeki%20M%C3%BCren&api_key=".$apikey."&format=json";
$urlSongs = "http://ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key=".$apikey."&artist=Zeki%20M%C3%BCren&format=json&album=";
$data = json_decode(file_get_contents($url),1);

foreach($data['topalbums']['album'] as $album){
	$albumInfo = array('name'=>$album['name']);
	echo $albumInfo['name']." is downloading\n";
	$thumb = array_pop($album['image']);
	if(!file_exists('assets/covers/'.md5($albumInfo['name']).'.jpg')){
		$f = fopen('assets/covers/'.md5($albumInfo['name']).'.jpg','w');
		fwrite($f,file_get_contents($thumb['#text']));
		fclose($f);
	}
	$albumInfo['image'] = '/assets/covers/'.md5($albumInfo['name']).'.jpg';
	$songsData = json_decode(file_get_contents($urlSongs.urlencode($albumInfo['name'])),1);
	foreach($songsData['album']['tracks']['track'] as $song){
		$albumInfo['songs'][] = array(
			'name'=>$song['name'],
			'duration'=>$song['duration']
		);
	}
	print_r($albumInfo);
	$albums[] =  $albumInfo;
}

$f = fopen('data/albums.json','w');
fwrite($f,json_encode($albums));
fclose($f);
