<?php
    session_start();

    include('config.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinesound</title>
    <link rel="stylesheet" href="accueil.css">
    <style>

.main-text {
    text-align: center;
    padding: 50px 20px;
}

.main-text h1 {
    font-size: 2.5em;
    color: #333;
    margin-bottom: 20px; 
    color: #8f209a;
}

.main-text p {
    font-size: 1.2em;
    color: #666;
    line-height: 1.8; 
    margin-bottom: 30px; 
    color: #2980b9;
}


.main-text ul li {
    font-size: 1.1em;
    color: #888;
    margin-bottom: 40px;
    color: white;
}

.cta-button {
    display: inline-block;
    margin-top: 20px;
    padding: 15px 25px; /* Augmentation de la taille du bouton */
    background-color: #8f209a;
    color: #fff;
    text-decoration: none;
    font-size: 1.2em;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.cta-button:hover {
    background-color: #3367d6;
}

/* Ajout de styles pour les images des partenariats */
.partnerships {
    margin-top: 50px;
    display: flex;
    justify-content: space-around;
}

.partnership-image {
    max-width: 200px;
    height: auto;
    margin-bottom: 20px;
}
.partenaires {
    font-size: 1.2em;
    margin-top: 50px;
}
.partenaires p{
    color: #8f209a;
}


    </style>
</head>
<body class="main">
    <div class="wrapper">
        <!-- Barre de menu -->
        <div class="banner">
            <div class="navbar">
                <h2 class="logo"> <a href="accueil_pro.php"><img src="images/SN1.png" alt="logo soundneo"></a></h2>
                <div id="menu-icon">&#9776;</div>
                <ul class="main-menu">
                    <li><a href="evenement_pro.php">Évènement</a></li>
                    <li><a href="statistique.php">Statistiques</a></li>
                    <li><a href="profil.php"><img src="images/logo_profil2.png" alt="logo profil" style="width: 50px; height: auto;"></a></li>
                </ul>
            </div>
        </div>

        <!-- Ajoutez le texte ici -->
        <div class="main-text">
            <h1>Bienvenue dans l'univers SoundNeo, là où le son devient une expérience. 🎥🔊</h1>
            <p>Chers professionnels du cinéma, bienvenue sur la plateforme SoundNeo, votre billet d'or pour redéfinir l'expérience audio dans vos salles de cinéma ! Nous sommes ravis de vous avoir parmi nous, prêts à explorer de nouvelles frontières dans le monde du divertissement cinématographique.</p>
            <p><strong>Découvrez les possibilités infinies avec SoundNeo :</strong></p>
            <ul>
                <li>🎬 <em>Gestion d'Événements Simplifiée :</em> Grâce à notre onglet "Événement", vous pouvez facilement ajouter et configurer les cinémas et les salles qui intègrent déjà la magie de SoundNeo. Un processus simple et intuitif pour vous permettre de gérer efficacement chaque événement.</li>
                <li>👤 <em>Personnalisez votre Profil :</em>  Rendez-vous dans l'onglet "Profil" pour consulter et mettre à jour vos informations personnelles et professionnelles. Assurez-vous que tout soit à jour pour une collaboration optimale.</li>
                <li>📈 <em>Statistiques Analytiques :</em> Plongez dans l'univers des données avec notre onglet "Statistiques". Obtenez des analyses approfondies des signaux de base de vos salles, et observez l'impact réel de SoundNeo sur l'expérience cinématographique. Des chiffres, des graphiques et des informations pour optimiser chaque détail.</li>
            </ul>
        
            <p>SoundNeo n'est pas seulement une solution, c'est une évolution dans la manière dont nous appréhendons le son au cinéma. En tant que professionnel du cinéma, votre adhésion à SoundNeo ouvre la porte à une expérience audio sans précédent, rehaussant la magie de chaque film.</p>
            <a href="evenement_pro.php" class="cta-button">Démarrer l'aventure avec SoundNeo !</a>
        <div class="partenaires">
           <p> Nos Partenariats
        </div>
 
            <!-- Section Partenariats -->
            <div class="partnerships">
                <img class="partnership-image" src="images/mk2.jpg" alt="Partenaire 1">
                <img class="partnership-image" src="images/pathé.jpg" alt="Partenaire 2">
                <img class="partnership-image" src="images/ugc.jpg" alt="Partenaire 3">
            </div>
        </div>

        <!-- Bas de page -->
        <div class="footer" style="display: none;">
            <div class="centered-image">
                <img src="images/logo_ecriture1.png" alt="Sound 2 Image">
            </div>
            <div class="menu3">
                <ul>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="cgu.html">CGU</a></li>
                    <li><a href="mentions.html">Mentions Légales</a></li>
                </ul>
            </div>
        </div>

        <!-- Script JS pour le menu hamburger et le footer -->
        <script>
            document.getElementById('menu-icon').addEventListener('click', function() {
                var navbar = document.querySelector('.navbar');
                navbar.classList.toggle('show');
            });

            window.addEventListener('scroll', function() {
                var footer = document.querySelector('.footer');
                var scrollPosition = window.scrollY || document.documentElement.scrollTop;
                // Ajustez cette valeur selon votre besoin, cela détermine à quelle distance du bas de la page le footer doit apparaître
                var triggerDistance = 200;
                if (scrollPosition > (document.documentElement.scrollHeight - window.innerHeight - triggerDistance)) {
                    footer.style.display = 'block';
                } else {
                    footer.style.display = 'none';
                }
            });
        </script>
    </div>
</body>
</html>