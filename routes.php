<?php



$router->get("/", "index.php");
$router->get("/about", "about.php");
$router->get("/contact", "contact.php");

$router->get("/notes", "notes/index.php")->only("auth");
$router->get("/note", "notes/show.php");
$router->delete("/note", "notes/destroy.php");

$router->get("/notes/create", "notes/create.php");
$router->post("/notes", "notes/store.php");

$router->get("/note/edit", "notes/edit.php");
$router->patch("/note", "notes/update.php");

$router->get("/register", "registration/create.php")->only("guest");
$router->post("/register", "registration/store.php");

$router->get("/login", "login/create.php")->only("guest");
$router->post("/login", "login/store.php")->only("guest");
$router->delete("/login", "login/destroy.php")->only("auth");



