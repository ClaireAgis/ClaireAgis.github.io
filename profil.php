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
</head>
<body>
    

    <div class="profile-container">
        <h1>Informations du compte</h1>
        <img class="profile-image" src="images/profil_image2.png" alt="Profil Image">
   
        <div class="info">
            <p><strong>Nom:</strong>&nbsp <?php echo $nom; ?> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</p>
            <p><strong>Prénom:</strong>&nbsp<?php echo $prenom; ?> </p>
        </div>

        <div class="info">
            <p><strong>Email:</strong>&nbsp<?php echo $email; ?> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</p>
            <p><strong>Numéro de Siret:</strong>&nbsp<?php echo $numSiret; ?></p>
        </div>

        <div class="button-container">
            <!-- Redirigez vers la page de modification de profil -->
            <a href="modifier_profil.php" class="button">Modifier Compte</a>
            <a href="deconnexion.php" class="button" onclick="confirmLogout()">Déconnexion</a>
        </div>
    </div>

    <script>
        function confirmLogout() {
            if (confirm("Êtes-vous sûr de vouloir vous déconnecter?")) {
                window.location.href = "deconnexion.php"; // Redirigez vers la page de déconnexion
            }
        }
    </script>
</body>
</html>
