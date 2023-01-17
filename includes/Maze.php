<?php

class Maze {
	private const BASE_URL = "https://www.mazegenerator.net/";
	private MazeGenerator $generator;

	public function __construct() {
		$this->generator = new MazeGenerator($this);
	}

	public function getGetOptions() {
		$tag = getQueryParameter("tag");
		if (!$tag) {
			sendHTTPResponse(HTTPResponseCode::NotFound);
			die();
		}
		return [
			"tag" => $tag,
			"solve" => getQueryParameterBool("solve") ? 1 : 0
		];
	}

	public function getGenerationOptions(int $overrideShape = null) {
		$shape = $overrideShape ?? getPostParameter("shape", 1);
		switch($shape) {
			case 1:
				$options = [
					"S1TesselationDropDownList" => getPostParameter("style", 1),
					"S1WidthTextBox" => getPostParameter("width", 20),
					"S1HeightTextBox" => getPostParameter("height", 20),
					"S1InnerWidthTextBox" => getPostParameter("innerwidth", 0),
					"S1InnerHeightTextBox" => getPostParameter("innerheight", 0),
					"S1StartsAtDropDownList" => getPostParameter("startsat", 1),
				];
				break;
			case 2:
				$horizontalBias = getPostParameter("horizontalbias", true);
				$options = [
					"S2OuterDiameterTextBox" => getPostParameter("outerdiameter", 20),
					"S2InnerDiameterTextBox" => getPostParameter("innerdiameter", 4),
					"S2StartsAtDropDownList" => getPostParameter("startsat", 1),
				];
				if ($horizontalBias)
					$options["S2HorizontalBiasCheckBox"] = "on";
				break;
			case 3:
				$options = [
					"S3SideLengthTextBox" => getPostParameter("sidelength", 20),
					"S3InnerSideLengthTextBox" => getPostParameter("innersidelength", 5),
					"S3StartsAtDropDownList" => getPostParameter("startsat", 1),
				];
				break;
			case 4:
				$options = [
					"S4TesselationDropDownList" => getPostParameter("style", 2),
					"S4SideLengthTextBox" => getPostParameter("sidelength", 12),
					"S4InnerSideLengthTextBox" => getPostParameter("innersidelength", 2),
					"S4StartsAtDropDownList" => getPostParameter("startsat", 1),
				];
				break;
			default:
				sendHTTPResponse(HTTPResponseCode::NotFound);
				die();
		}
		return array_merge([
			"ShapeDropDownList" => getPostParameter("shape", 1),
			"AlgorithmParameter1TextBox" => getPostParameter("algorithmparameter1", 50),
			"AlgorithmParameter2TextBox" => getPostParameter("algorithmparameter2", 100),
			"GenerateButton" => "Generate"
		], $options);
	}

	public function generate(): array {
		$generateOptions = $this->getGenerationOptions();
		return $this->generator->generateImage(Maze::BASE_URL, $generateOptions);
	}

	public function get() {
		$getOptions = $this->getGetOptions();
		$imageURL = MAZE::BASE_URL."ImageGenerator.ashx?Tag={$getOptions["tag"]}&Solution={$getOptions["solve"]}";
		$image = curl($imageURL, false, false, false, MAZE::BASE_URL);

		if (!$image) {
			sendHTTPResponse(HTTPResponseCode::NotFound);
			die();
		}

		header("Content-Type: image/svg+xml");
		echo $image;
	}
}
