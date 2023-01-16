<?php
require_once "includes/functions.php";
require_once "includes/http_response.php";
require_once "includes/MazeGenerator.php";
require_once "includes/Maze.php";

switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		(new Maze())->get();
		break;
	case "POST":
		echo json_encode((new Maze())->generate());
		break;
	default:
		sendHTTPResponse(HTTPResponseCode::MethodNotAllowed);
		die();
}

