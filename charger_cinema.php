<?php
include('config.php');

// Connexion à la base de données
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Récupérer la liste des cinémas
$sqlCinemas = "SELECT cinema_id, nom FROM Cinema";
$resultCinemas = $conn->query($sqlCinemas);

// Générer le HTML pour la liste des cinémas et des salles
$html = '';
if ($resultCinemas->num_rows > 0) {
    while ($rowCinema = $resultCinemas->fetch_assoc()) {
        $cinemaId = $rowCinema['cinema_id'];
        $html .= '<option value="' . $cinemaId . '">' . $rowCinema['nom'] . '</option>';

        // Récupérer la liste des salles pour ce cinéma
        $sqlSalles = "SELECT salle_id, nom_salle FROM Salle WHERE cinema_id = $cinemaId";
        $resultSalles = $conn->query($sqlSalles);

        // Générer le HTML pour les options des salles (sous-liste)
        if ($resultSalles->num_rows > 0) {
            while ($rowSalle = $resultSalles->fetch_assoc()) {
                $html .= '<option value="' . $rowSalle['salle_id'] . '">' . $rowSalle['nom_salle'] . '</option>';
            }
        }
    }
}


// Fermer la connexion
$conn->close();

// Renvoyer le HTML généré
echo $html;
?>
