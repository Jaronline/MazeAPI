<?php

class MazeGenerator {
	private Maze $maze;

	public function __construct(Maze $maze) {
		$this->maze = $maze;
	}

	private function getAspNetData(string $url, $options = false): array {
		// Get HTML
		if (!$options) {
			$result = curl($url);
		} else {
			$result = curl($url, $options, 1, false, $url);
		}

		// Get ASP.NET data
		preg_match('/<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="(.*)" \/>/', $result, $viewstate);
		preg_match('/<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="(.*)" \/>/', $result, $eventvalidation);
		preg_match('/<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="(.*)" \/>/', $result, $viewstategenerator);
		preg_match('/<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="(.*)" \/>/', $result, $eventtarget);
		preg_match('/<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="(.*)" \/>/', $result, $eventargument);
		preg_match('/<input type="hidden" name="__LASTFOCUS" id="__LASTFOCUS" value="(.*)" \/>/', $result, $lastfocus);

		$viewstate = $viewstate[1];
		$eventvalidation = $eventvalidation[1];
		$viewstategenerator = $viewstategenerator[1];
		$eventtarget = count($eventtarget) < 2 ? "" : $eventtarget[1];
		$eventargument = count($eventargument) < 2 ? "" : $eventargument[1];
		$lastfocus = count($lastfocus) < 2 ? "" : $lastfocus[1];

		// Return ASP.NET data
		return [
			"__VIEWSTATE" => $viewstate,
			"__EVENTVALIDATION" => $eventvalidation,
			"__VIEWSTATEGENERATOR" => $viewstategenerator,
			"__EVENTTARGET" => $eventtarget,
			"__EVENTARGUMENT" => $eventargument,
			"__LASTFOCUS" => $lastfocus
		];
	}

	public function generateImage(string $url, array $options): array {
		$aspNetData = $this->getAspNetData($url);

		if ($options["ShapeDropDownList"] != 1) {
			$aspNetData = $this->getAspNetData($url, array_merge($aspNetData, [
				"__EVENTTARGET" => "ShapeDropDownList"
			], $this->maze->getGenerationOptions(1)));
		}

		$response = curl($url, array_merge($aspNetData, $options), 1, false, $url);

		preg_match('/<img id="MazeDisplay" src="(.*)" alt=".*" \/>/', $response, $mazeImage);

		// Get maze tag
		$mazeURL = parse_url($url.$mazeImage[1]);
		parse_str($mazeURL["query"], $mazeParameters);

		return [
			"tag" => $mazeParameters["Tag"]
		];
	}
}
