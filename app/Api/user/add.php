<?php
    // Headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Import the class
    $BASE_PATH = dirname(dirname(__DIR__)); 
    include("$BASE_PATH/helpers/Response.php");

    use App\Model\User;

    // Initialized response wrapper
    $response = Response::response();

    // Get connection
    $conn = $db->getConnection();

    // Get the inputed data
    $data = (Array) json_decode(file_get_contents("php://input"));

    User::create();

    // $result = User::create($conn, $data);

    // if (!$result['error']) {
    //     $response['data'] = $result['last_inserted'];
    // } else {
    //     $response['message'] = $result['message'];
    //     $response['status'] = 400;
    //     $response['is_error'] = $result['error'];
    // }

    // echo json_encode($response);
