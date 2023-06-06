<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/User.php';


    $database = new Database();

    $db = $database->connect();

    $user = new User($db);

    $data = json_decode(file_get_contents("php://input"));
    $user->firstName = $data->firstName;
    $user->lastName = $data->lastName;
    $user->email = $data->email;
    $user->location = $data->location;
    $user->comments = $data->comments;
    $user->rating = $data->rating;


    if($user->create()) {
        echo json_encode(
            array('message' => 'User Created')
        );
    } else {
        echo json_encode(
            array('message' => 'User Not Created')
        );
    }