<?php
include('config.php');

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom_cinema = $_POST["nom_cinema"];
    $adresse_cinema = $_POST["adresse_cinema"];
    $ville_cinema = $_POST["ville_cinema"];

    // Connexion à la base de données
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion à la base de données a échoué : " . $conn->connect_error);
    }

    // Préparer la requête SQL
    $sql = "INSERT INTO Cinema (nom, adresse, ville) VALUES ('$nom_cinema', '$adresse_cinema', '$ville_cinema')";

    // Exécuter la requête
    if ($conn->query($sql) === TRUE) {
        echo "Le cinéma a été ajouté avec succès !";
    } else {
        echo "Erreur lors de l'ajout du cinéma : " . $conn->error;
    }

    // Fermer la connexion
    $conn->close();
}
?>
