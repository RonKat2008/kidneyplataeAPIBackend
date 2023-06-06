<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/User.php';


    $database = new Database();

    $db = $database->connect();

    $user = new User($db);

    $data = json_decode(file_get_contents("php://input"));

    $date = Date("y-m-d");
    $realDate = (string)$date;

    $user->firstName = $data->firstName;
    $user->lastName = $data->lastName;
    $user->email = $data->email;
    $user->location = $data->location;
    $user->comments = $data->comments;
    $user->rating = $data->rating;
    $user->id = $data->id;
    $user->updatedAt = $realDate;


    if($user->update()) {
        echo json_encode(
            array('message' => 'User Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'User Not Updated')
        );
    }