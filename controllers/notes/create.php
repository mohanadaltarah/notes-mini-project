<?php


$errors = [];
$heading = "Create Note";
$config = require base_path("config.php");
$db = new Database($config['database']);

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(! Validator::string($_POST['body'], 1, 1000)){
        $errors['body'] = "Your note should be within 1000 characters!";
    }

    if(empty($errors)){
        $db->query("INSERT INTO notes(body, user_id) VALUES(:body, :user_id)", ['body' => $_POST['body'],
            'user_id' => 1] );
    }

}
view("notes/create.view.php", [
    "heading" => "Create Note",
    "errors" => $errors,

]);