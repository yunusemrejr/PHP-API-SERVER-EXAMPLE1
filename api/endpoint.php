<?php
/**
 * Copyright (c) 2024 by YUNUS EMRE VURGUN
 * Programmed in January 2024, this is the GITHUB FREE EDITION of this software, some parts are modified.
 */


session_start();
/**************//**************/
/**************//**************/
/**************//**************/

// function to get the request body as an assoc. array
function getRequestBody() {
    $input = file_get_contents("php://input");
    parse_str($input, $data);
    return $data;
}

$id = isset($_GET['id']) ? $_GET['id'] : null;
$method = $_SERVER['REQUEST_METHOD'];

if (!$id) {
    echo "No 'id' parameter found in the URL.";
    header('Location: ../index/index.php');
    exit;
}

include '../db/database.php';
delete_old_sessions();

function getRandomMillisecondBetweenOneToThreeSeconds() {
    return rand(1000, 3000);  // 1-3 sec range
}
 

$slugId = $id;
$randomMillisecond = getRandomMillisecondBetweenOneToThreeSeconds();
usleep($randomMillisecond * 1000); // cnvrt milliseconds to microseconds and sleep

$current_timestamp = time();
$three_hours_in_seconds = 3 * 3600;
$current_timestamp = $current_timestamp + $three_hours_in_seconds;

$timestamp_of_slug = get_api_session_timestamp_from_db($slugId);

if ($current_timestamp - $timestamp_of_slug > 1800) { // 1800 sec = 30 min
    if (delete_api_session($slugId) === true) {
        header('Location: ../index/index.php');
        exit;
    }
    header('Location: ../index/index.php');
    exit;
} else {
    if (get_api_session_timestamp_from_db($slugId)) {
        $sessionData = get_api_session($slugId);

        if ($sessionData !== null) {
            $contentTypeSession = (string)$sessionData["contentType"];
            $speedTypeSession = (string)$sessionData["speedType"];

            include 'api_content_generator.php';

            if ($method === 'GET') {
 
                $responseData = generate_data($contentTypeSession, $speedTypeSession,$method,null);
                 header('Content-Type: application/json');
                 echo json_encode($responseData);
            } elseif ($method === 'POST' || $method === 'PUT' || $method === 'PATCH') {
                 $requestBody = getRequestBody();
                  
                $responseData = generate_data($contentTypeSession, $speedTypeSession,$method,$requestBody);
                $responseData=json_encode($responseData);
                header('Content-Type: application/json');
                echo json_encode(['message' => $responseData]);
            } elseif ($method === 'DELETE') {
                 $responseData = generate_data($contentTypeSession, $speedTypeSession,$method,null);

 
                header('Content-Type: application/json');
                echo json_encode(['message' => 'Resource deleted successfully']);
            }
        } else {
            header('Location: ../index/index.php');
            exit;
        }
    }
}

/**************//**************/
/**************//**************/
/**************//**************/
/**************//**************/

?>