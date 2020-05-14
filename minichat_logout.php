<?php
session_start();

include("pdo.php");

// on détruit la session pour déconnecter l'utilisateur
session_destroy();

header('Location: minichat.php');
