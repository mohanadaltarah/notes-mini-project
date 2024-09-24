<?php

// find the corresponding note
use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$currentUser = 1;
$errors= [];

$note  = $db->query('SELECT * FROM notes WHERE id = :id', ['id' => $_POST['id']
])->findOrFail();

// validate the user
authorize($note['user_id'] == $currentUser);

// validate the form
if(! Validator::string($_POST['body'], 1, 1000)){
    $errors['body'] = "Your note should be within 1000 characters!";
}


if(!empty($errors)){
    return view("notes/edit.view.php", [
        'heading' => 'Edit Note',
        'note' => $note,
        'errors' => $errors,

        ]

    );
}

//update the corresponding note in the notes database
$db->query("UPDATE notes SET body = :body WHERE id = :id", ['body' => $_POST['body'], "id" => $_POST['id']]);

//redirect the user
header('Location: /notes');
die();