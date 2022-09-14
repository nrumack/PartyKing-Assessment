<?php
require_once 'vendor/autoload.php';
require_once 'Route.php';
require_once 'packer.php';

const BASE_URL = 'https://www.partykungen.se';

// Add base route (startpage)
Route::add('/',function() {
    include 'home.html';
});

// Get route example
Route::add('/get-item/([0-9]*)',function($id) {

	$requestUri = sprintf('%s/%s.json',	BASE_URL, $id);
	$fp = fopen($requestUri, 'r');

	echo stream_get_contents($fp);

	fclose($fp);
    // Something here
}, 'get');

// Post route example
Route::add('/get-box',function() {
	$post = file_get_contents('php://input');
	$item = json_decode($post);
	
	packing_response($item->{'description'}, $item->{'height'}, $item->{'depth'}, $item->{'width'}, $item->{'weight'});

	echo($packer);
 // Something here
}, 'post');

Route::add('/packing-response',function() {

	packing_response();
}, 'get');


// Accept only numbers as parameter example. 
Route::add('/foo/([0-9]*)/bar',function($var1) {
    echo $var1.' is a great number!';
});

Route::run('/');