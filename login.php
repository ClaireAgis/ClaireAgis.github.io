<?php
session_start();

include('config.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adresseMail = $_POST["adresseMail"];
    $password = $_POST["password"];

    // Connexion à la base de données
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion à la base de données : " . $conn->connect_error);
    }

    // Validation de l'adresse e-mail
    $adresseMail = filter_var($adresseMail, FILTER_VALIDATE_EMAIL);
    if (!$adresseMail) {
        echo "<script>alert('Adresse e-mail invalide');</script>";
    } else {
        // Exécutez une requête pour vérifier les informations de connexion
        $sql = "SELECT * FROM User WHERE adresseMail = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $adresseMail);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // Mot de passe correct
                $_SESSION['user'] = $row;

                // Vérifier le rôle de l'utilisateur
                if ($row['role'] === 'admin') {
                    header("Location: accueil_admin.php");
                } else {
                    header("Location: accueil_pro.php");
                }

                exit();
            } else {
                echo "<script>alert('Mot de passe incorrect');</script>";
            }
        } else {
            echo "Adresse e-mail invalide ou utilisateur non enregistré";
        }

        $stmt->close();
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">

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

    <form method="post" action="login.php">
        <h1>Login</h1>
        <input type="text" id="adresseMail" name="adresseMail" required placeholder="Adresse e-mail">
        <input type="password" id="password" name="password" required placeholder="Mot de passe">
        <a class="link" href="mdp_lost.html">Mot de passe oublié?</a>
        <a class="link" href="registration.php">Créer un compte</a>
        <button type="submit">Se connecter</button>
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
