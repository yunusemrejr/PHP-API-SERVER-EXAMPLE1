<?php
/**
 * Copyright (c) 2024 by YUNUS EMRE VURGUN
 * Programmed in January 2024, this is the GITHUB FREE EDITION of this software, some parts are modified.
 */

 
session_start();

// host of the requester
$currentHost = $_SERVER['HTTP_HOST'];

//  host of the PHP script
$scriptHost = $_SERVER['SERVER_NAME']; 

//   if the request method is POST and if it's coming from the same host
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $currentHost === $scriptHost) {

    //   the JSON body of the request
    $jsonBody = file_get_contents('php://input');

    // parse   JSON data
    $jsonData = json_decode($jsonBody, true);

    // chk if   decoding was successful
    if ($jsonData !== null) {

        // extrct the values and assign them to variables
        $api_data_type = $jsonData['content'];
        $speed_of_value_change = $jsonData['speed'];
        $thisUrl =  $jsonData['targetUrl'];
        $theSlugId=  $jsonData['slug'];
        
        if(!strpos($thisUrl,$theSlugId)){
            http_response_code(400);
            echo json_encode(['error' => 'Invalid JSON data']);
            session_destroy();
            header("Location: ../index/index.php");
            exit;
        }

        include '../db/database.php';
        insert_api_session($theSlugId, $api_data_type, $speed_of_value_change);
        


        // 200 OK response
        http_response_code(200);
        echo json_encode(['message' => 'Data received successfully for:'.$api_data_type.','.$speed_of_value_change.','.$thisUrl.','.$theSlugId]);

    } else {
        //   decoding failed
        http_response_code(400);
        echo json_encode(['error' => 'Invalid JSON data']);
        session_destroy();
        header("Location: ../index/index.php");

    }

} else {
    //   is not a POST request or not from the same host
    http_response_code(403);
    echo json_encode(['error' => 'Forbidden']);
    session_destroy();
    header("Location: ../index/index.php");

}

?>