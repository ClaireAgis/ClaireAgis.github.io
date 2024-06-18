<?php
include('config.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $adresseMail = $_POST["adresseMail"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $numSiret = $_POST["numSiret"];
    // Connexion à la base de données
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion à la base de données : " . $conn->connect_error);
    }

    // Utilisation de requêtes préparées pour éviter les injections SQL
    $sql = "INSERT INTO User (nom, prenom, adresseMail, password,numSiret) VALUES (?, ?, ?, ?,?)";
    echo $sql  . "<br>"; // Ajoutez cette ligne pour afficher la requête
    $stmt = $conn->prepare($sql);

    // Vérifier la préparation de la requête
    if ($stmt === false) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }

    // Liaison des valeurs
    $stmt->bind_param("sssss",$nom, $prenom, $adresseMail, $password, $numSiret);
    //echo "Liaison des valeurs : " . ( "Succès" : "Échec") . "<br>"; // Afficher le résultat de la liaison (ligne ajoutée)
   
    if ($stmt->execute()) {

        // L'utilisateur a été inscrit avec succès
        echo "Enregistrement réussi.<br>";
        header("Location: registration_sucess.php");
        exit();
    } else {
         // Une erreur s'est produite lors de l'inscription
         echo "Erreur MySQL lors de l'exécution : " . $stmt->error . "<br>";
         header("Location: registration_failed.php?error=" . urlencode($stmt->error));
         exit();
        
    }
    

    // Fermer la connexion et la déclaration préparée lorsque vous avez terminé
    $stmt->close();
    $conn->close();


}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registration.css">
    
    <title>Formulaire de Connexion</title>
</head>
<body>

    <div class="SN2">
        <a href="accueil.php">
            <img src="images/SN2.png" alt="logo">
        </a>
    </div>

    <div class="fleche">
        <a href="accueil.php">
            <img src="images/fleche.png" alt="fleche">
        </a>
    </div>

    <form action="registration.php" method="post">
        <h1>Registration</h1>
        
        <div class="name-container">
            <input type="text" id="nom" name="nom" required placeholder="Nom">
            <input type="text" id="prenom" name="prenom" required placeholder="Prénom">
        </div>
        
        <div class="mail">
        <input type="text" name="numSiret" required placeholder="numSiret">
        <input type="email" name="adresseMail" required placeholder="Adresse e-mail">
        <input type="password" id="password" name="password" required placeholder="Mot de passe">
        </div>

        <a class="link" href="login.php">Se connecter</a>
        
       
        <button type="submit" name="submit">Register</button>
    </form>

    <div class="ellipse">
        <img src="images/ellipse.png" alt="fleche">
    </div>

    <div class="ellipse2">
        <img src="images/ellipse.png" alt="fleche">
    </div>

    <div class="ellipse3">
        <img src="images/ellipse.png" alt="fleche">
    </div>

</body>
</html>