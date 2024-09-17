<?php


require "Validator.php";


$heading = "Create Note";
$config = require "config.php";
$db = new Database($config['database']);


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $validator = new Validator();

    $errors = [];



    if(!$validator->string($_POST['body'], 1, 1000)){
        $errors['body'] = "Your not should be within 1000 characters!";
    }

    if(empty($errors)){
        $db->query("INSERT INTO notes(body, user_id) VALUES(:body, :user_id)", ['body' => $_POST['body'],
            'user_id' => 1] );
    }

}

require "views/note-create.view.php";

