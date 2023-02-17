<?php
    // Headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    $BASE_PATH = dirname(dirname(__DIR__));
    include("$BASE_PATH/model/User.php");
    include("$BASE_PATH/helpers/Response.php");

    $users = User::all($db->getConnection());
    $rowCount = $users->rowCount();
    $response = Response::response();
    
    if ( $rowCount > 0 ) {
        while ( $row = $users->fetch(PDO::FETCH_ASSOC) ) {
            array_push($response['data'], $row);
        }
    }else {
        http_response_code(200);
        $response['message'] = 'no data';
    }

    // Retturn data
    echo json_encode($response);
