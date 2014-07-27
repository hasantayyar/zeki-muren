<?php
require 'bootstrap.php';

get('/', function(){
    include 'app/pages/index.php';
});


get('/album', function(){
	include 'app/pages/album.php';
});


get('/about', function(){
	include 'app/pages/about.php';
});
