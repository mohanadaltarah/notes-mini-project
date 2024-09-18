<?php


use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$currentUser = 2;

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $note  = $db->query("SELECT * FROM notes WHERE id = :id", ['id' => $_GET['id']
    ])->findOrFail();

    authorize($note['user_id'] == $currentUser);

    $db->query("delete from notes where id = :id", [
        "id" => $_POST["id"]]
    );

    header("Location: /notes");
    exit();
}else{
    $note  = $db->query("SELECT * FROM notes WHERE id = :id", ['id' => $_GET['id']
    ])->findOrFail();

    authorize($note['user_id'] == $currentUser);

    view("notes/show.view.php", [
        "heading" => "Note",
        "note" => $note
    ]);

}

