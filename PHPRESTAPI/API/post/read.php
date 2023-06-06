<?php

    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json");

    include_once '../../config/Database.php';
    include_once '../../models/User.php';


    $database = new Database();

    $db = $database->connect();

    $User = new User($db);

    $result = $User->read();

    $num = $result->rowCount();

    if($num > 0){
        $users_arr = array();
        $users_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $user_item = array(
            'id' => $id,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'location' => $location,
            'comments' => $comments,
            'rating' => $rating

          );

          array_push($users_arr['data'], $user_item);
        }
        echo json_encode($users_arr);
    } else {
        echo json_encode(
            array('message' => 'no post found')
        );
    }
    
