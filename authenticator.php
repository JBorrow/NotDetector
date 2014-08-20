<?php

require_once("Auth/user.php");

session_start();
$_SESSION = $_POST;
unset($_POST);

$user = new User($_SESSION['username'], $_SESSION['password']);

if ($user->validUser) {
    $_SESSION['loggedin'] = true;
} else {
    $_SESSION['loggedin'] = false;
}

$_SESSION['user'] = $user;

header("Location: Editor/list.php");

