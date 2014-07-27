<?php

include __DIR__."/../../bootstrap.php";

$url = "http://ws.audioscrobbler.com/2.0/?method=artist.gettopalbums&artist=Zeki%20M%C3%BCren&api_key=".$lastfmApikey."&format=json";
$urlSongs = "http://ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key=".$lastfmApikey."&artist=Zeki%20M%C3%BCren&format=json&album=";
$youtubeUrl = "https://gdata.youtube.com/feeds/api/videos?orderby=viewCount&start-index=1&max-results=1&alt=json&q=";
$data = json_decode(file_get_contents($url),1);


foreach($data['topalbums']['album'] as $album){
	$albumInfo = array('name'=>$album['name']);
	echo $albumInfo['name']." is downloading\n";


	$coverPath = '/assets/covers/'.md5($albumInfo['name']).'.jpg';
	$defultCover = '/assets/images/default_cover.jpg';
	$thumb = array_pop($album['image']);
	if($thumb["#text"]=="http://cdn.last.fm/flatness/catalogue/noimage/2/default_album_medium.png"){
		$coverPath = $defultCover;
	} else if(!file_exists($appRoot.$coverPath)){
		$f = fopen($appRoot.$coverPath,'w');
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

	
	$f = fopen($appRoot.'/data/album_'.md5($albumInfo['name']).'.json','w');
	fwrite($f,json_encode($albumInfo));
	fclose($f);
}

$f = fopen($appRoot.'/data/albums.json','w');
fwrite($f,json_encode($albums));
fclose($f);
