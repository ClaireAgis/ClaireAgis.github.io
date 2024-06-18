<?php
include('config.php');


// Connexion à la base de données
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

echo "Connexion réussie à la base de données.";
// Vous pouvez maintenant exécuter des requêtes SQL et interagir avec la base de données ici.


// Exemple : Sélectionner toutes les lignes de la table User
$sql = "SELECT * FROM User";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Afficher les données
    while ($row = $result->fetch_assoc()) {
        echo "Username: " . $row["username"] . " - Nom: " . $row["nom"] . "<br>";
    }
} else {
    echo "Aucun utilisateur trouvé.";
}
// Fermer la connexion lorsque vous avez terminé
$conn->close();


?>