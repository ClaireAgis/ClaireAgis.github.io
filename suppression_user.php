<?php
include('config.php');
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adresseMail = $conn->real_escape_string($_POST['adresseMail']);

    $sql = "DELETE FROM `user` WHERE `adresseMail` = '$adresseMail'";

    if ($conn->query($sql) === TRUE) {
        echo "Utilisateur supprimé";
    } else {
        echo "Erreur: " . $conn->error;
    }
}

$conn->close();
?>