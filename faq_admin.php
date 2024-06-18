<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="faq_admin.css">
    <title>Admin - FAQ</title>
</head>
<body class="main">
    <div class="wrapper">
        <!-- Barre de menu -->
        <div class="banner">
            <div class="navbar">
                <h2 class="logo"> <a href="accueil_admin.php"><img src="images/SN1.png" alt="logo soundneo"></a></h2>
                <div id="menu-icon">&#9776;</div>
                <ul class="main-menu">
                    <li><a href="accueil_admin.php">Comptes</a></li>
                    <li><a href="faq_admin.php">FAQ</a></li>
                    <li><a href="profil.php"><img src="images/logo_profil2.png" alt="logo profil" style="width: 50px; height: auto;"></a></li>
                </ul>
            </div>
        </div>
        <div class="faq-container">
            <h2 class="text">Gestion de la FAQ</h2>
            <div class="formulaire">
                <!-- Formulaire pour ajouter une nouvelle question -->
                <form action="faq_admin.php" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir ajouter cette question ?');">
                    <input type="text" name="new_question" placeholder="Nouvelle question" required>
                    <textarea name="new_reponse" placeholder="Réponse à la nouvelle question" required></textarea>
                    <input type="submit" name="add_faq" value="Ajouter">
                </form>
            </div>

            <!-- Liste des questions existantes avec option de suppression -->
            <?php
            // Inclure le fichier de configuration de la base de données
            include("config.php");

            // Connexion à la base de données
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Affichage des questions existantes
            $sql = "SELECT id, question, reponse FROM faq";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '
                    <div class="formulaire">
                        <form action="faq_admin.php" method="post" onsubmit="return confirm(\'Êtes-vous sûr de vouloir supprimer cette question ?\');">
                            <div class="question">'.$row["question"].'</div>
                            <br>
                            <div class="reponse">'.$row["reponse"].'</div>
                            <input type="hidden" name="id_to_delete" value="'.$row["id"].'">
                            <input class="supprimer" type="submit" name="delete_faq" value="Supprimer">
                        </form>
                    </div>
                    ';
                }
            } else {
                echo "Aucune question dans la FAQ.";
            }

            // Traitement du formulaire d'ajout
            if (isset($_POST['add_faq'])) {
                $new_question = $conn->real_escape_string($_POST['new_question']);
                $new_reponse = $conn->real_escape_string($_POST['new_reponse']);
                $insert_sql = "INSERT INTO faq (question, reponse) VALUES ('$new_question', '$new_reponse')";
                if ($conn->query($insert_sql) === TRUE) {
                    echo "<script>alert('Nouvelle question ajoutée avec succès.'); window.location='faq_admin.php';</script>";
                } else {
                    echo "Erreur : " . $conn->error;
                }
            }

            // Traitement du formulaire de suppression
            if (isset($_POST['delete_faq'])) {
                $id_to_delete = $conn->real_escape_string($_POST['id_to_delete']);
                $delete_sql = "DELETE FROM faq WHERE id = $id_to_delete";
                if ($conn->query($delete_sql) === TRUE) {
                    echo "<script>alert('Question supprimée avec succès.'); window.location='faq_admin.php';</script>";
                } else {
                    echo "Erreur : " . $conn->error;
                }
            }

            // Fermeture de la connexion à la base de données
            $conn->close();
            ?>
        </div>
    </div>


    <!-- Bas de page -->
<div class="footer" style="display: none;">
    <div class="centered-image">
        <img src="images/logo_ecriture1.png" alt="Sound 2 Image">
    </div>
    <div class="menu3">
        <ul>
            <li><a href="contact_pro.html">Contact</a></li>
            <li><a href="cgu_pro.html">CGU</a></li>
            <li><a href="mentions.html">Mentions Légales</a></li>
        </ul>
    </div>
</div>

<!-- Script JS pour le menu hamburger et le footer -->
<script>
    document.getElementById('menu-icon').addEventListener('click', function() {
        var navbar = document.querySelector('.navbar')
        navbar.classList.toggle('show')
    });

    window.addEventListener('scroll', function() {
        var footer = document.querySelector('.footer')
        var scrollPosition = window.scrollY || document.documentElement.scrollTop;
        // Ajustez cette valeur selon votre besoin, cela détermine à quelle distance du bas de la page le footer doit apparaître
        var triggerDistance = 200;
        if (scrollPosition > (document.documentElement.scrollHeight - window.innerHeight - triggerDistance)) {
            footer.style.display = 'block'
        } else {
            footer.style.display = 'none'
        }
    });
</script>
</body>
</html>
