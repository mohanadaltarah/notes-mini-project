<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUser = 1;

$note  = $db->query("SELECT * FROM notes WHERE id = :id", ['id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] == $currentUser);

$db->query("delete from notes where id = :id", [
    "id" => $_POST["id"]]
);

header("Location: /notes");
exit();


