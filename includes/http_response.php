<?php
class HTTPResponseCode {
	const NotFound = 404;
	const MethodNotAllowed = 405;
}

$responseMessages = [
	HTTPResponseCode::NotFound => [
		"title" => "Not Found",
		"message" => "The page that you have requested could not be found."
	],
	HTTPResponseCode::MethodNotAllowed => [
		"title" => "Method Not Allowed",
		"message" => "The request method is not supported for the requested resource."
	]
];

function sendHTTPResponse(int $code) {
	global $responseMessages;
	$message = $responseMessages[$code];
	if (!$message) {
		return false;
	}
	header("HTTP/1.0 $code {$message["title"]}");
	echo "<h1>$code {$message["title"]}</h1>";
	echo "<p>{$message["message"]}</p>";
	return $code;
}
