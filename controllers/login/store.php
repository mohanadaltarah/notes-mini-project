<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);
$email = $_POST['email'];
$password = $_POST['password'];
$errors = [];

if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address.';
}
if (!Validator::string($password)) {
    $errors['password'] = 'Please provide the correct password.';
}

if (! empty($errors)) {
    return view('login/create.view.php', [
        'errors' => $errors
    ]);
}

$user = $db->query("SELECT * FROM users WHERE email = :email", [
    'email' => $email
])->find();

if($user) {
    if(password_verify($password, $user['password'])) {

        login([
            'email' => $email,
        ]);

        header('Location: / ');
        exit();
    }
}

return view('login/create.view.php', [
    'errors' => [
        'email' => "No matching account found for that email address and password!"
    ]
]);
