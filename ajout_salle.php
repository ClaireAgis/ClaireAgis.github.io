<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_salle = $_POST["nom_salle"];
    $cinema_id = intval($_POST["cinema_id"]);
    $capacite = $_POST["capacite"];

    // Validation des données
    if (empty($nom_salle) || empty($cinema_id) || !is_numeric($capacite)) {
        echo "Veuillez fournir des données valides.";
        exit;
    }

    // Connexion à la base de données
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion à la base de données a échoué : " . $conn->connect_error);
    }

    // Requête préparée
    $sql = "INSERT INTO Salle (nom_salle, cinema_id, capacite) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Liaison des paramètres
    $stmt->bind_param("sii", $nom_salle, $cinema_id, $capacite);

    // Exécution de la requête
    if ($stmt->execute()) {
        echo "La salle a été ajoutée avec succès !";
    } else {
        echo "Erreur lors de l'ajout de la salle : " . $stmt->error;
    }

    // Fermer la connexion
    $stmt->close();
    $conn->close();
}
?>



