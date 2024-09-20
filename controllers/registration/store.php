<?php


use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];
//validate email and password
$errors = [];
if(!Validator::email($email)){
    $errors['email'] = "You need to enter a valid email address";
}

if(!Validator::string($password, 8, 25)){
    $errors['password'] = "You need to enter a password that is at least 8 characters long";
}

if(!empty($errors)){
    return view("registration/create.view.php", [
        "errors" => $errors
    ]);
}

//check if the user exist
$db = App::resolve(Database::class);
$user = $db->query("SELECT * FROM users WHERE email = :email", ['email'=> $email])->find();
    //if yes, redirect to the login page with a note upon the redirection
if($user){

    header("Location: /");
    exit();
}else{
    $db->query("INSERT INTO users(email, password) VALUES(:email, :password)", [
        'email'=> $email,
        'password'=> $password
    ]);

    $_SESSION['user'] = [
        'email' =>  $email
    ];

    header("Location: /");
    exit();
}


    //if no, persist the user to the database and redirect