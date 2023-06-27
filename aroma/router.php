<?php

session_start();
$url = explode('/', $_SERVER['REQUEST_URI']);
require_once("php/db.php");
require_once("php/classes/User.php");



if($url[3] == "auth") {
    $content = file_get_contents("pages/login.php");
} else if($url[3] == "register"){
    $content = file_get_contents("pages/register.html");
} else if ($url[3] == "blog") {
    $content = file_get_contents("pages/blog.html");
} else if ($url[3] == "users") {
    require_once("pages/users/index.html");
} else if ($url[3] == "addUser") {
    echo User::addUser($_POST["name"], $_POST["lastname"], $_POST["email"], $_POST["pass"]);
} else if ($url[3] == "authUser") {
    echo User::authUser($_POST["email"], $_POST["pass"]);
} 
else if ($url[3] == "getUser") {
    echo User::getUser($_SESSION["id"]);
} 
else if ($url[3] == "getUsers") {
    echo User::getUsers();
} 
else {
    $content = file_get_contents("pages/index.php");
}
// for ($i = 0; $i < count($url); $i++) {
//     echo $url[$i] . "<hr>";
// }


// if($url[3] == "login") {
//     require_once("login.php");
// }
// if($url[2] == "") {
//     require_once("index.php");
// }
if (!empty($content)) require_once("template.php");
