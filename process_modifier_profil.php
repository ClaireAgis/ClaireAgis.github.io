<?php
session_start();

if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('config.php');

    // Connexion à la base de données
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion à la base de données : " . $conn->connect_error);
    }

    // Récupérer les données du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $adresseMail = $_POST["email"];
    $numSiret = $_POST["numSiret"];

    // Validez et traitez les données si nécessaire (ex : évitez les injections SQL)

    // Mettez à jour les informations dans la base de données
    $sql = "UPDATE `user` SET nom = '$nom', prenom = '$prenom', adresseMail = '$adresseMail', numSiret = '$numSiret' WHERE adresseMail = '$adresseMail'";

    if ($conn->query($sql) === TRUE) {
        // Mise à jour réussie, mettez à jour la session utilisateur avec les nouvelles informations
        $_SESSION['user']['nom'] = $nom;
        $_SESSION['user']['prenom'] = $prenom;
        $_SESSION['user']['adresseMail'] = $adresseMail;
        $_SESSION['user']['numSiret'] = $numSiret;

        // Redirigez l'utilisateur vers la page de profil
        header("Location: profil.php");
        exit();
    } else {
        // Gestion de l'erreur, redirigez l'utilisateur avec un message d'erreur si nécessaire
        echo "Erreur lors de la mise à jour : " . $conn->error;
    }

    $conn->close();
} else {
    // Redirigez l'utilisateur vers la page de modification de profil s'il n'y a pas de données postées
    header("Location: modifier_profil.php");
    exit();
}
?>
