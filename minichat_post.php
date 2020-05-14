<?php
session_start();

include("pdo.php");

// Ajouter un message
$username = $_SESSION['username'];
$message = $_POST['message'] ?? '';

// Si les champs username et message sont remplis, alors on insert le message dans la table minichat de la bdd
if (!empty($username) && !empty($message)) {
    $requestNewMessage = $PDO->prepare("INSERT INTO minichat ( username, message) VALUES( :username, :message)");
    $requestNewMessage->execute(
        array("username" => $username, "message" => $message)
    );
}

// Redirection vers la page minichat.php
header('Location: minichat.php');
