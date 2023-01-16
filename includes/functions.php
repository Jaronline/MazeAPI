<?php
function curl(
	string $url, $post = false, $header = false, $follow_location = false, $referer = false, $proxy = false
) {
	$cookiePath = __DIR__."/../cookie.txt";

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FAILONERROR, true);
	curl_setopt($ch, CURLOPT_REFERER, $referer);
	curl_setopt($ch, CURLOPT_HEADER, $header);
	curl_setopt($ch, CURLOPT_PROXY, $proxy);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $follow_location);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiePath);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiePath);
	if ($post) {
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	}
	$response = curl_exec($ch);
	curl_close($ch);
	return $response;
}

function getQueryParameter(string $name, $default = null) {
	return $_GET[$name] ?? $default;
}

function getQueryParameterBool(string $name): bool {
	return isset($_GET[$name]);
}

function getPostParameter(string $name, $default = null) {
	return $_POST[$name] ?? $default;
}
