<?php


$config = require base_path('config.php');
$db = new Database($config['database']);


$notes = $db->query("SELECT * FROM notes")->getAll();


view("notes/index.view.php", [
    "heading" => "My Notes",
    "notes" => $notes
]);
