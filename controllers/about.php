<?php


dd($_SERVER['REQUEST_URI']);

view("about.view.php", [
    "heading" => "About us"
]);
