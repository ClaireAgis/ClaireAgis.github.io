<?php
session_start();

if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $nom = $user['nom'];
    $prenom = $user['prenom'];
    $email = $user['adresseMail'];
    $numSiret = $user['numSiret'];
} else {
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="profil.css">
    <style>
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            color: #2980b9;
            margin-bottom: 8px;
            textà-align: left;
            width: 100%;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #2980b9;
            border-radius: 4px;
            color: #333;
        }

        button {
            background-color: #2980b9;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #24567e;
        }

</style>
</head>
<body>
    <div class="fleche">
        <a href="profil.php">
            <img src="images/fleche.png" alt="fleche">
        </a>
    </div>

    <div class="profile-container">
        <h1>Modifier le compte</h1>
        <img class="profile-image" src="images/profil_image2.png" alt="Profil Image">

        <!-- Formulaire de modification -->
        <form action="process_modifier_profil.php" method="post">
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" value="<?php echo $nom; ?>">

            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo $prenom; ?>">

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo $email; ?>">

            <label for="siret">Numéro de Siret:</label>
            <input type="text" id="numSiret" name="numSiret" value="<?php echo $numSiret; ?>">

            <button type="submit">Enregistrer les modifications</button>
        </form>
    </div>
</body>
</html>
