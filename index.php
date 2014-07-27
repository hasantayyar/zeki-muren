<?php
require 'bootstrap.php';

get('/', function(){
    include 'app/pages/index.php';
});

get('/about', function(){
	include 'app/pages/about.php';
});
