<?php
require 'app/nanite.php';
get('/', function(){
    include 'app/pages/index.php';
});

get('/about', function(){
	include 'app/pages/about.php';
});
