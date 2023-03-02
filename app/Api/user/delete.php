<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Import the class
    $BASE_PATH = dirname(dirname(__DIR__)); 
    include("$BASE_PATH/model/User.php");
    include("$BASE_PATH/helpers/Response.php");

    $conn = $db->getConnection();

    $data = json_decode(file_get_contents("php://input"));

    
    if (User::delete($conn, $data->id)) {
        echo json_encode(['message' => 'deleted!']);
    } else {
        echo json_encode(['message' => 'unable to delete!']);
    }
