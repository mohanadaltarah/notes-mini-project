<?php


$config = require('config.php');
$db = new Database($config['database']);

$heading = "My Notes";

$notes = $db->query("SELECT * FROM notes")->getAll();


require "views/notes/index.view.php";