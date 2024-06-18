
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
</head>
<body class="main">
    <div class="wrapper">
         <!-- Barre de menu -->
        <div class="banner">
            <div class="navbar">
                <h2 class="logo"> <a href="accueil.php"><img src="images/SN1.png" alt="logo soundneo"></a></h2>
                <div id="menu-icon">&#9776;</div>
                <ul class="main-menu">
                    
                    <li><a href="evenement.php">Évènement</a></li>
                    <li><a href="apropos.html">A propos</a></li>
                    
                    
                    <?php
                        // Vérifie si l'utilisateur est connecté
                        if(isset($_SESSION['user_id'])) {
                            // Si connecté, affiche le lien de profil et de déconnexion
                            echo '<li><a href="profil.php">Profil</a></li>';
                            echo '<li><a href="logout.php">Déconnexion</a></li>';
                        } else {
                            // Sinon, affiche le lien de login
                            echo '<li><a href="login.php">Login</a></li>';
                        }
                    ?>

                 
                </ul>
                
            </div>

            

        </div>
        <div class="text3">
            <h1 class="main-title">Soundneo</h1>
        </div>

        <div class="intro">
            <p class="soustext">Le futur du cinéma</p>
        </div>
        <div class="flex-container">                  
            <div class="texte1">
            Bienvenue chez CineSound.<br> C’est ici que commence votre voyage audio futuriste.<br> Notre priorité est de garantir un son pur et adapté à vos salles,<br> pour donner accès aux plus grands nombres à un audio adaptatif et immergeant.<br> Pour cela, nous avons créé une solution innovante et high tech : <br>SoundNeo. Cette nouvelle technologie s’appuie sur des capteurs <br> dernier cri et l’utilisation de l’intelligence artificielle pour <br>que le son puisse suivre et s’adapter aux médias visuels auxquels il est rattaché.<br>
            </div>
        
            <div class="photo-cine">
                <img src="images/photo_cine2.jpg" alt="photo-cine">
            </div>
        </div>
        <div class="flex-container2"> 

            <div class="photo-soncine">
                <img src="images/photo_soncine.jpg" alt="photo-cine2">
            </div>

            <div class="texte6">
                Un film d’animation aux nombreux détails sonores ?<br> SoundNeo mettra en avant tous ces petits sons (feuillage, bruit de criquet, <br>crépitement du feu) qui permettront aux petits et grands de se sentir projetés dans<br> la scène qu’ils regarderont, leur faisant ainsi vivre une expérience inoubliable.<br>Au contraire, vous voulez faire une conférence avec un son doux<br> et un niveau sonore adapté ? L’intelligence artificielle de notre solution traitera<br> le son des différentes voix pour vous permettre de passer une agréable conférence <br>(notamment en supprimant tous les bruits parasites du micro).
            </div>
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
                <li><a href="faq.php">FAQ</a></li>
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
</body>
</html>