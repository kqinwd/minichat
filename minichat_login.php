<?php
session_start();

include("pdo.php");

$username = $_POST['username'];
$password = $_POST['password'];

if (isset($_POST['username']) && isset($_POST['password'])) {
    $requestUser = $PDO->prepare("SELECT * FROM user WHERE username = :username AND password = :password");
    $requestUser->execute(
        array(
            "username" => $username,
            "password" => $password
        )
    );

    $user = $requestUser->fetchAll();

    if (count($user) == 1) {
        $_SESSION['username'] = $username;
    }
}

// Redirection vers la page minichat.php
header('Location: minichat.php');
