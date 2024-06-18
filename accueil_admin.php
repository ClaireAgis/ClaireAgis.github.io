<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Utilisateurs</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="accueil.css">
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
    <div class="text2">
        <h1 class="main-title">Soundneo</h1>
        <h2 class="soustext">Liste des Utilisateurs</h2>

    

        <div class="table-container">
            <table border="10">
                <thead>
                    <tr>s
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('config.php');
                    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

                    // Vérifier la connexion
                    if ($conn->connect_error) {
                        die("Échec de la connexion : " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM `user` WHERE role = 'client'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()){
                            echo "<tr>" ;
                            echo "<td>".$row["nom"]."</td>" ;
                            echo "<td>".$row["prenom"]."</td>" ;
                            echo "<td>".$row["adresseMail"]."</td>" ;
                            echo "<td><button onclick='supprimerUtilisateur(\"".$row["adresseMail"]."\")'>Supprimer</button></td>" ;
                            echo "</tr>" ;
                        }
                    } else {
                        echo "<tr><td colspan='4'>Aucun utilisateur trouvé</td></tr>" ;
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
        <div class="intro-container">
            <div class="intro-text">
                <!-- Ajoutez votre paragraphe principal ici -->
          </div>
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

<!--Code de la liste d'utilisateur-->

<script>
    function supprimerUtilisateur(adresseMail) {
        if(confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
            $.ajax({
                url: 'suppression_user.php',
                type: 'POST',
                data: { 'adresseMail': adresseMail},
                success: function(response) {
                    alert("Utilisateur supprimé");
                    window.location.reload();
                },
                error: function() {
                    alert("Erreur lors de la suppression");
                }
            });
        }
    }
</script>

</body>
</html>