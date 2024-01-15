<?php
/**
 * Copyright (c) 2024 by YUNUS EMRE VURGUN
 * Programmed in January 2024, this is the GITHUB FREE EDITION of this software, some parts are modified.
 */

 
function check_credentials($username, $password) {

    $hostname = "localhost"; 
    $dbUsername = "xxx"; 
    $dbPassword = "xxx"; 
    $database = "xxx"; 

    $mysqli = new mysqli($hostname, $dbUsername, $dbPassword, $database);

    if ($mysqli->connect_error) {
        die("DB Connection failed!");
    }

    $username = $mysqli->real_escape_string($username);

    $query = "SELECT id, username, password FROM users WHERE username = '$username'";
    $result = $mysqli->query($query);

    if ($result) {
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $storedHashedPassword = $row['password'];

            if (hash_equals(hash('sha256', $password), $storedHashedPassword)) {
                $mysqli->close();
                return true;
            }
        }
    }

    $mysqli->close();
    return false;
}

function get_api_session_timestamp_from_db($slugId) {

    $hostname = "localhost"; 
    $dbUsername = "xxx"; 
    $dbPassword = "xxx"; 
    $database = "xxx"; 

    $mysqli = new mysqli($hostname, $dbUsername, $dbPassword, $database);

    if ($mysqli->connect_error) {
        die("DB Connection failed: " . $mysqli->connect_error);
    }

$query = "SELECT timestamp FROM sessions WHERE slugid=?";

$stmt = $mysqli->prepare($query);

if (!$stmt) {
    die("Failed to prepare statement: " . $mysqli->error);
}

$stmt->bind_param("s", $slugId);

if ($stmt->execute()) {

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        $timestamp = strtotime($row['timestamp']);

        $stmt->close();
        $mysqli->close();

        return $timestamp;
    } else {

        $stmt->close();
        $mysqli->close();
        return false;
    }
} else {
    die("Error executing the statement: " . $stmt->error);
}
}

function get_api_session($slugId){

    $hostname = "localhost"; 
    $dbUsername = "xxx"; 
    $dbPassword = "xxx"; 
    $database = "xxx"; 

    $mysqli = new mysqli($hostname, $dbUsername, $dbPassword, $database);

    if ($mysqli->connect_error) {
        die("DB Connection failed: " . $mysqli->connect_error);
    }

    $query = "SELECT contenttype, speedtype FROM sessions WHERE slugid = ?";
    $stmt = $mysqli->prepare($query);

    if (!$stmt) {
        die("Failed to prepare statement: " . $mysqli->error);
    }

    $stmt->bind_param("s", $slugId);

    if ($stmt->execute()) {

        $stmt->bind_result($contentType, $speedType);

        if ($stmt->fetch()) {

            $stmt->close();

            $mysqli->close();

            return array(
                "contentType" => $contentType,
                "speedType" => $speedType
            );
        } else {

            $stmt->close();
            $mysqli->close();
            return null;
        }
    } else {
        die("Error executing the statement: " . $stmt->error);
    }
}

function insert_api_session($slugId, $contentType, $speedType){

    $hostname = "localhost"; 
    $dbUsername = "xxx"; 
    $dbPassword = "xxx"; 
    $database = "xxx"; 

    $mysqli = new mysqli($hostname, $dbUsername, $dbPassword, $database);

    if ($mysqli->connect_error) {
        die("DB Connection failed: " . $mysqli->connect_error);
    }

    $query = "INSERT IGNORE INTO sessions (slugid, contenttype, speedtype) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($query);

    if (!$stmt) {
        die("Failed to prepare statement: " . $mysqli->error);
    }

    $stmt->bind_param("sss", $slugId, $contentType, $speedType);

    if ($stmt->execute()) {

        $stmt->close();

        $mysqli->close();

        return true;
    } else {
        die("Error executing the statement: " . $stmt->error);
    }
}

function delete_api_session($slugId) {

    $hostname = "localhost"; 
    $dbUsername = "xxx"; 
    $dbPassword = "xxx"; 
    $database = "xxx"; 

    $mysqli = new mysqli($hostname, $dbUsername, $dbPassword, $database);

    if ($mysqli->connect_error) {
        die("DB Connection failed: " . $mysqli->connect_error);
    }

    $slugId = $mysqli->real_escape_string($slugId);

    $query = "DELETE FROM sessions WHERE slugid = ?";
    $stmt = $mysqli->prepare($query);

    if (!$stmt) {
        die("Failed to prepare statement: " . $mysqli->error);
    }

    $stmt->bind_param("s", $slugId);

    if ($stmt->execute()) {

        if ($stmt->affected_rows > 0) {

            $stmt->close();

            $mysqli->close();

            return true;
        } else {
            return false;

        }
    } else {
        die("Error executing the statement: " . $stmt->error);
    }
}

function delete_old_sessions() {

    $hostname = "localhost"; 
    $dbUsername = "xxx"; 
    $dbPassword = "xxx"; 
    $database = "xxx"; 

    try {

        $mysqli = new mysqli($hostname, $dbUsername, $dbPassword, $database);

        if ($mysqli->connect_error) {
            throw new Exception("DB Connection failed: " . $mysqli->connect_error);
        }

        $thirtyMinutesAgo = date('Y-m-d H:i:s', strtotime('-30 minutes'));

        $query = "DELETE FROM sessions WHERE timestamp < ?";

        $stmt = $mysqli->prepare($query);

        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $mysqli->error);
        }

        $stmt->bind_param("s", $thirtyMinutesAgo);

        if ($stmt->execute()) {

            $stmt->close();

            $mysqli->close();

            return true;
        } else {
            throw new Exception("Error executing the statement: " . $stmt->error);
        }
    } catch (Exception $e) {

        error_log($e->getMessage());

        if (isset($stmt)) {
            $stmt->close();
        }
        if (isset($mysqli)) {
            $mysqli->close();
        }

        return false;
    }
}
?>