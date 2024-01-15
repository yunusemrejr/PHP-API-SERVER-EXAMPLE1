<?php
/**
 * Copyright (c) 2024 by YUNUS EMRE VURGUN
 * Programmed in January 2024, this is the GITHUB FREE EDITION of this software, some parts are modified.
 */


 
function generate_data($contentType, $speedType, $httpMethod, $requestBody) {
   

    if ($speedType == 0 && $httpMethod=="GET" && isset($_SESSION['cached_data']) && isset($_SESSION['cache_timestamp']) && time() - $_SESSION['cache_timestamp'] <= 30) {
        // return the cached data
        return $_SESSION['cached_data'];
    }
    $data = [];
    if ($contentType && strlen($speedType) > 0) {
        if ($contentType == "Topic1") {
            // generate cnc data based on http method
            if ($httpMethod === 'GET') {
                $data = generateTopic1DataForGET();
            } elseif ($httpMethod === 'POST' && $requestBody) {
                $data = generateTopic1DataForPOST($requestBody);
            } elseif ($httpMethod === 'PUT' && $requestBody) {
                $data = generateTopic1DataForPUT($requestBody);
            } elseif ($httpMethod === 'DELETE') {
                $data = generateTopic1DataForDELETE();
            } elseif ($httpMethod === 'PATCH' && $requestBody) {
                $data = generateTopic1DataForPATCH($requestBody);
            }
        } elseif ($contentType == "Topic2") {
            // generate weather data based on http method
            if ($httpMethod === 'GET') {
                $data = generateTopic2DataForGET();
            } elseif ($httpMethod === 'POST' && $requestBody) {
                $data = generateTopic2DataForPOST($requestBody);
            } 
            elseif ($httpMethod === 'PUT' && $requestBody) {
                $data = generateTopic2DataForPUT($requestBody);
            }
            elseif ($httpMethod === 'DELETE') {
                $data = generateTopic2DataForDELETE();
            }
            elseif ($httpMethod === 'PATCH' && $requestBody) {
                $data = generateTopic2DataPATCH($requestBody);
            }

        } elseif ($contentType == "Topic3") {
            // generate solar data based on http method
            if ($httpMethod === 'GET') {
                $data = generateTopic3DataForGET();
            }  elseif ($httpMethod === 'POST' && $requestBody) {
                $data = generateTopic3DataForPOST($requestBody);
            } 
            elseif ($httpMethod === 'PUT' && $requestBody) {
                $data = generateTopic3DataForPUT($requestBody);
            }
            elseif ($httpMethod === 'DELETE') {
                $data = generateTopic3DataForDELETE();
            }
            elseif ($httpMethod === 'PATCH' && $requestBody) {
                $data = generateTopic3DataPATCH($requestBody);
            }
        } else {
            $data = [
                'error' => 'Unknown content type',
            ];
        }

                // cache the generated data and timestamp
                $_SESSION['cached_data'] = $data;
                $_SESSION['cache_timestamp'] = time();

    } else {
        $data = [
            'error' => 'Content type and speed type are required',
        ];
    }

    return $data;
}

// implement separate data generation functions for each http method
function generateTopic1DataForGET() {
    // generate data specific to get request for cnc
    $data = [
        'spindle_speed' => mt_rand(8000, 15000) . ' RPM',
        'feed_rate' => mt_rand(200, 500) . ' IPM',
        'tool_temperature' => mt_rand(50, 90) . '°C',
        'motor_voltage' => mt_rand(200, 240) . 'V',
        'motor_current' => mt_rand(5, 15) . ' A',
        'tool_wear' => mt_rand(0, 5) . ' mm',
        'tool_life' => mt_rand(1000, 3000) . ' hours',
        'axis_position_x' => mt_rand(0, 200) . ' mm',
        'axis_position_y' => mt_rand(0, 100) . ' mm',
        'coolant_flow_rate' => mt_rand(1, 10) . ' L/min',
        'cutting_depth' => mt_rand(5, 15) . ' mm',
        'workpiece_temperature' => mt_rand(20, 60) . '°C',
        'tool_change_count' => mt_rand(0, 100) . ' times',
        'tool_diameter' => mt_rand(10, 20) . ' mm',
        'spindle_load' => mt_rand(0, 100) . '%',
        'program_executed' => 'Program ' . mt_rand(1, 10),
        'workpiece_material' => ['Aluminum', 'Steel', 'Copper'][mt_rand(0, 2)],
        'alarm_code' => 'No alarms',
        'total_runtime' => mt_rand(50, 200) . ' hours',
        'idle_time' => mt_rand(10, 50) . ' hours',
        'operating_time' => mt_rand(40, 150) . ' hours',
        'program_number' => mt_rand(1000, 9999),
        'tool_speed' => mt_rand(1000, 3000) . ' RPM',
        'tool_type' => ['End Mill', 'Drill', 'Tap'][mt_rand(0, 2)],
        'feed_override' => mt_rand(50, 200) . '%',
        'rapid_override' => mt_rand(50, 150) . '%',
     ];

    return $data;
}

function generateTopic1DataForPOST($requestBody) {
    if (empty($requestBody)) {
        http_response_code(400); // bad req
        echo json_encode(["error" => "Empty POST body"]);
        return;
    }

    // attempt to decode the JSON data
    $requestData = $requestBody;
    //  if JSON decoding successful
    if ($requestData === null) {
        $data = [
            "message" => "Your body Json couldn't be validated."
            
        ];
    }else{

    $processedData = [];
    foreach ($requestData as $key => $value) {
        $newKey = "processed$key";
        $processedData[$newKey] = $value;
    }
 

    //  response with the provided data
    $data = [
        "message" => "Topic1 data received and processed successfully for POST REQUEST",
        "data" => $processedData
    ];

    }
    
 

    return $data;
}

function generateTopic1DataForPUT($requestBody) {
    if (empty($requestBody)) {
        http_response_code(400); //bad req 
        echo json_encode(["error" => "Empty PUT body"]);
        return;
    }

    // try decode the JSON data
    $requestData = $requestBody;
    // Check JSON decoding success 
    if ($requestData === null) {
        $data = [
            "message" => "Your body Json couldn't be validated."
            
        ];
    }else{

    $processedData = [];
    foreach ($requestData as $key => $value) {
        $newKey = "processed$key";
        $processedData[$newKey] = $value;
    }
 

    // response with the provided data
    $data = [
        "message" => "Topic1 data received and processed successfully for PUT REQUEST",
        "data" => $processedData
    ];

    }
    
 

    return $data;
}

function generateTopic1DataForDELETE() {
    // gen. data specific to DEL req for Topic1
    $data = [
        'STATUS' => 'RESOURCE HAS BEEN DELETED FROM THE SERVER.',
    ];

    return $data;
}

function generateTopic1DataForPATCH($requestBody) {
    if (empty($requestBody)) {
        http_response_code(400); // bad req
        echo json_encode(["error" => "Empty PATCH body"]);
        return;
    }

     $requestData = $requestBody;
     if ($requestData === null) {
        $data = [
            "message" => "Your body Json couldn't be validated."
            
        ];
    }else{

    $processedData = [];
    foreach ($requestData as $key => $value) {
        $newKey = "processed$key";
        $processedData[$newKey] = $value;
    }
 

     $data = [
        "message" => "Topic1 data received and processed successfully for PATCH REQUEST",
        "data" => $processedData
    ];

    }
    
 

    return $data;
}

function generateTopic2DataForGET() {
    $data = [
        'temperature' => mt_rand(-10, 40) . '°C',
        'humidity' => mt_rand(20, 80) . '%',
        'wind_speed' => mt_rand(0, 30) . ' km/h',
        'pressure' => mt_rand(990, 1030) . ' hPa',
        'precipitation' => mt_rand(0, 10) . ' mm/h',
        'cloud_cover' => mt_rand(0, 100) . '%',
        'visibility' => mt_rand(1, 20) . ' km',
        'uv_index' => mt_rand(0, 10),
        'sunrise' => mt_rand(600, 800) . ' AM',
        'sunset' => mt_rand(700, 900) . ' PM',
        'moon_phase' => ['Waxing Crescent', 'First Quarter', 'Full Moon', 'Last Quarter'][mt_rand(0, 3)],
        'dew_point' => mt_rand(-10, 30) . '°C',
        'air_quality_index' => mt_rand(0, 100),
        'rainfall_today' => mt_rand(0, 20) . ' mm',
        'wind_direction' => mt_rand(0, 360) . '°',
        'heat_index' => mt_rand(0, 40) . '°C',
        'wind_gusts' => mt_rand(0, 40) . ' km/h',
        'solar_radiation' => mt_rand(0, 1000) . ' W/m²',
        'fog_density' => ['Low', 'Medium', 'High'][mt_rand(0, 2)],
        'storm_alert' => ['None', 'Severe Thunderstorm', 'Tornado Warning'][mt_rand(0, 2)],
        'pollen_count' => ['Low', 'Moderate', 'High'][mt_rand(0, 2)],
        'ozone_level' => mt_rand(0, 0.1) . ' ppm',
        'snowfall' => mt_rand(0, 10) . ' cm',
        'ice_accumulation' => mt_rand(0, 5) . ' mm',
        'air_temperature_high' => mt_rand(10, 35) . '°C',
        'air_temperature_low' => mt_rand(-10, 20) . '°C',
     ];

    return $data;
} function generateTopic2DataForPOST($requestBody) {
    if (empty($requestBody)) {
        http_response_code(400);  
        echo json_encode(["error" => "Empty POST body"]);
        return;
    }

     $requestData = $requestBody;
     if ($requestData === null) {
        $data = [
            "message" => "Your body Json couldn't be validated."
            
        ];
    }else{

    $processedData = [];
    foreach ($requestData as $key => $value) {
        $newKey = "processed$key";
        $processedData[$newKey] = $value;
    }
 

     $data = [
        "message" => "Topic2 data received and processed successfully for POST REQUEST",
        "data" => $processedData
    ];

    }
    
 

    return $data;
}

 function generateTopic2DataForPUT($requestBody) {
    if (empty($requestBody)) {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Empty PUT body"]);
        return;
    }

     $requestData = $requestBody;
     if ($requestData === null) {
        $data = [
            "message" => "Your body Json couldn't be validated."
            
        ];
    }else{

    $processedData = [];
    foreach ($requestData as $key => $value) {
        $newKey = "processed$key";
        $processedData[$newKey] = $value;
    }
 

     $data = [
        "message" => "Topic2 data received and processed successfully for PUT REQUEST",
        "data" => $processedData
    ];

    }
    
 

    return $data;
}

function generateTopic2DataForDELETE() {
    $data = [
        'STATUS' => 'RESOURCE HAS BEEN DELETED FROM THE SERVER.',
    ];

    return $data;
}

function generateTopic2DataForPATCH($requestBody) {
    if (empty($requestBody)) {
        http_response_code(400);  
        echo json_encode(["error" => "Empty PATCH body"]);
        return;
    }

     $requestData = $requestBody;
     if ($requestData === null) {
        $data = [
            "message" => "Your body Json couldn't be validated."
            
        ];
    }else{

    $processedData = [];
    foreach ($requestData as $key => $value) {
        $newKey = "processed$key";
        $processedData[$newKey] = $value;
    }
 

     $data = [
        "message" => "Topic2 data received and processed successfully for PATCH REQUEST",
        "data" => $processedData
    ];

    }
    
 

    return $data;
}


 function generateTopic3DataForGET() {
    $data = [
        'solar_voltage' => mt_rand(20, 30) . ' V',
        'solar_current' => mt_rand(2, 8) . ' A',
        'battery_voltage' => mt_rand(11, 14) . ' V',
        'battery_current' => mt_rand(0, 4) . ' A',
        'power_output' => mt_rand(0, 100) . ' W',
        'charge_controller_state' => ['Charging', 'Idle', 'Discharging'][mt_rand(0, 2)],
        'battery_capacity' => mt_rand(0, 100) . '%',
        'inverter_status' => ['Online', 'Offline'][mt_rand(0, 1)],
        'load_status' => ['On', 'Off'][mt_rand(0, 1)],
        'solar_panel_temperature' => mt_rand(20, 60) . '°C',
        'battery_temperature' => mt_rand(10, 40) . '°C',
        'grid_voltage' => mt_rand(220, 240) . ' V',
        'grid_frequency' => mt_rand(49, 51) . ' Hz',
        'power_factor' => (mt_rand(90, 99) / 100),
        'grid_import_power' => mt_rand(0, 500) . ' W',
        'grid_export_power' => mt_rand(0, 200) . ' W',
        'inverter_efficiency' => (mt_rand(85, 95) / 100),
        'solar_panel_efficiency' => (mt_rand(15, 20) / 100),
        'battery_charge_status' => ['Bulk Charging', 'Float Charging', 'Equalization'][mt_rand(0, 2)],
        'battery_discharge_status' => ['Discharging', 'Idle'][mt_rand(0, 1)],
        'load_power' => mt_rand(0, 50) . ' W',
        'inverter_temperature' => mt_rand(20, 60) . '°C',
        'solar_radiation' => mt_rand(100, 1000) . ' W/m²',
        'total_energy_generated' => mt_rand(1000, 5000) . ' kWh',
        'total_energy_consumed' => mt_rand(500, 2000) . ' kWh',
        'battery_cycle_count' => mt_rand(50, 200) . ' cycles',
        'solar_panel_orientation' => ['North', 'South', 'East', 'West'][mt_rand(0, 3)],
        'solar_panel_azimuth' => mt_rand(0, 360) . '°',
     ];

    return $data;
}
 function generateTopic3DataForPOST($requestBody) {
    if (empty($requestBody)) {
        http_response_code(400);  
        echo json_encode(["error" => "Empty POST body"]);
        return;
    }

     $requestData = $requestBody;
     if ($requestData === null) {
        $data = [
            "message" => "Your body Json couldn't be validated."
            
        ];
    }else{

    $processedData = [];
    foreach ($requestData as $key => $value) {
        $newKey = "processed$key";
        $processedData[$newKey] = $value;
    }
 

     $data = [
        "message" => "Topic3 data received and processed successfully for POST REQUEST",
        "data" => $processedData
    ];

    }
    
 

    return $data;
}

function generateTopic3DataForPUT($requestBody) {
    if (empty($requestBody)) {
        http_response_code(400);  
        echo json_encode(["error" => "Empty PUT body"]);
        return;
    }

     $requestData = $requestBody;
     if ($requestData === null) {
        $data = [
            "message" => "Your body Json couldn't be validated."
            
        ];
    }else{

    $processedData = [];
    foreach ($requestData as $key => $value) {
        $newKey = "processed$key";
        $processedData[$newKey] = $value;
    }
 

     $data = [
        "message" => "Topic3 data received and processed successfully for PUT REQUEST",
        "data" => $processedData
    ];

    }
    
 

    return $data;
}

function generateTopic3DataForDELETE() {
    $data = [
        'STATUS' => 'RESOURCE HAS BEEN DELETED FROM THE SERVER.',
    ];
    return $data;
}

function generateTopic3DataForPATCH($requestBody) {
    if (empty($requestBody)) {
        http_response_code(400);  
        echo json_encode(["error" => "Empty PATCH body"]);
        return;
    }

     $requestData = $requestBody;
     if ($requestData === null) {
        $data = [
            "message" => "Your body Json couldn't be validated."
            
        ];
    }else{

    $processedData = [];
    foreach ($requestData as $key => $value) {
        $newKey = "processed$key";
        $processedData[$newKey] = $value;
    }
 

     $data = [
        "message" => "Topic3 data received and processed successfully for PATCH REQUEST",
        "data" => $processedData
    ];

    }
    
 

    return $data;
}
?>