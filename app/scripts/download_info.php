<?php
$apikey = "f5af8b18105cb72ed5473827d4fe407b";
$url = "http://ws.audioscrobbler.com/2.0/?method=artist.gettopalbums&artist=Zeki%20M%C3%BCren&api_key=".$apikey."&format=json";
$urlSongs = "http://ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key=".$apikey."&artist=Zeki%20M%C3%BCren&format=json&album=";
$youtubeUrl = "https://gdata.youtube.com/feeds/api/videos?orderby=viewCount&start-index=1&max-results=1&alt=json&q=";
$data = json_decode(file_get_contents($url),1);
$appRoot = __DIR__."/../../";
$artist = "Zeki Müren";

foreach($data['topalbums']['album'] as $album){
	$albumInfo = array('name'=>$album['name']);
	echo $albumInfo['name']." is downloading\n";

	$coverPath = $appRoot.'assets/covers/'.md5($albumInfo['name']).'.jpg';
	$thumb = array_pop($album['image']);
	if(!file_exists($coverPath)){
		$f = fopen($coverPath,'w');
		fwrite($f,file_get_contents($thumb['#text']));
		fclose($f);
	} 
	$albumInfo['image'] = $coverPath;
	$songsData = json_decode(file_get_contents($urlSongs.urlencode($albumInfo['name'])),1);
	foreach($songsData['album']['tracks']['track'] as $song){
		$youtubeApi = $youtubeUrl.urlencode($artist." - ".trim($song['name']));
		$videoData = json_decode(file_get_contents($youtubeApi),1); 
		$albumInfo['songs'][] = array(
			'name'=>$song['name'],
			'duration' => $song['duration'],
			'video' => $videoData['feed']['entry'][0]['link'][0]['href']
		);
	}
	print_r($albumInfo);
	$albums[] =  $albumInfo;
}

$f = fopen('data/albums.json','w');
fwrite($f,json_encode($albums));
fclose($f);
