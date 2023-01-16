<?php
function curl(string $url, $post = false, $header = false, $follow_location = false, $referer=false,$proxy=false) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_REFERER, $referer);
    curl_setopt($ch, CURLOPT_HEADER, $header);
    curl_setopt($ch, CURLOPT_PROXY, $proxy);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $follow_location);
    curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__."/cookie.txt");
    curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__."/cookie.txt");
    if ($post) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function getAspNetData(string $url, $options = false) {
    // Get HTML
    $result = null;
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

function generateMazeImage(string $url, array $options) {
    $aspNetData = getAspNetData($url);

    if ($options["ShapeDropDownList"] != 1) {
        $aspNetData = getAspNetData($url, array_merge($aspNetData, [
            "__EVENTTARGET" => "ShapeDropDownList"
        ], getMazeOptions(1)));
    }

    $response = curl($url, array_merge($aspNetData, $options), 1, false, $url);

    preg_match('/<img id="MazeDisplay" src="(.*)" alt=".*" \/>/', $response, $mazeImage);
    return $url.$mazeImage[1];
}

function displayMazeImage(string $url, array $options) {
    $imageURL = generateMazeImage($url, $options);
    $image = curl($imageURL, false, false, false, $url);

    header("Content-Type: image/svg+xml");
    echo $image;
}

function getQueryParameter(string $name, $default = null) {
    return isset($_GET[$name]) ? $_GET[$name] : $default;
}

function getQueryParameterBool(string $name) {
    return isset($_GET[$name]) ? true : false;
}

function getMazeOptions(int $overrideShape = null) {
    $options = [];
    $shape = $overrideShape ?? getQueryParameter("shape", 1);
    switch($shape) {
        case 1:
            $options = [
                "S1TesselationDropDownList" => getQueryParameter("style", 1),
                "S1WidthTextBox" => getQueryParameter("width", 20),
                "S1HeightTextBox" => getQueryParameter("height", 20),
                "S1InnerWidthTextBox" => getQueryParameter("innerwidth", 0),
                "S1InnerHeightTextBox" => getQueryParameter("innerheight", 0),
                "S1StartsAtDropDownList" => getQueryParameter("startsat", 1),
            ];
            break;
        case 2:
            $horizontalBias = getQueryParameterBool("horizontalbias");
            $options = [
                "S2OuterDiameterTextBox" => getQueryParameter("outerdiameter", 20),
                "S2InnerDiameterTextBox" => getQueryParameter("innerdiameter", 4),
                "S2StartsAtDropDownList" => getQueryParameter("startsat", 1),
            ];
            if ($horizontalBias)
                $options["S2HorizontalBiasCheckBox"] = "on";
            break;
        case 3:
            $options = [
                "S3SideLengthTextBox" => getQueryParameter("sidelength", 20),
                "S3InnerSideLengthTextBox" => getQueryParameter("innersidelength", 5),
                "S3StartsAtDropDownList" => getQueryParameter("startsat", 1),
            ];
            break;
        case 4:
            $options = [
                "S4TesselationDropDownList" => getQueryParameter("style", 2),
                "S4SideLengthTextBox" => getQueryParameter("sidelength", 12),
                "S4InnerSideLengthTextBox" => getQueryParameter("innersidelength", 2),
                "S4StartsAtDropDownList" => getQueryParameter("startsat", 1),
            ];
            break;
        default:
            header("HTTP/1.0 404 Not Found");
            echo "<h1>404 Not Found</h1>";
            echo "The page that you have requested could not be found.";
            die();
    }
    $options = array_merge([
        "ShapeDropDownList" => getQueryParameter("shape", 1),
        "AlgorithmParameter1TextBox" => getQueryParameter("algorithmparameter1", 50),
        "AlgorithmParameter2TextBox" => getQueryParameter("algorithmparameter2", 100),
        "GenerateButton" => "Generate"
    ], $options);
    return $options;
}

displayMazeImage("https://mazegenerator.net/", getMazeOptions());
