<?php
include("config.php");

function getCinemas() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT cinema.nom, salle.nom_salle AS salle_nom FROM cinema 
            LEFT JOIN salle ON cinema.cinema_id = salle.cinema_id";
    $result = $conn->query($sql);

    $cinemas = [];
    while ($row = $result->fetch_assoc()) {
        $cinemas[$row['nom']][] = $row['salle_nom'];
    }

    $conn->close();
    return $cinemas;
}


function searchCinemas($query) {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT cinema.nom, salle.nom_salle AS salle_nom FROM cinema 
            LEFT JOIN salle ON cinema.cinema_id = salle.cinema_id 
            WHERE cinema.nom LIKE CONCAT('%', ?, '%')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $query);
    $stmt->execute();
    $result = $stmt->get_result();

    $cinemas = [];
    while ($row = $result->fetch_assoc()) {
        $cinemas[$row['nom']][] = $row['salle_nom'];
    }

    $stmt->close();
    $conn->close();
    return $cinemas;
}

$searchResult = getCinemas();
if (isset($_GET['query']) && $_GET['query'] != '') {
    $searchResult = searchCinemas($_GET['query']);
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evenement</title>
    <link rel="stylesheet" href="accueil.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
</head>

<body class="main">
    <div class="wrapper">
        <!-- Barre de menu -->
        <div class="banner">
            <div class="navbar">
                <h2 class="logo"><a href="accueil.php"><img src="images/SN1.png" alt="logo soundneo"></a></h2>
                <div id="menu-icon">&#9776;</div>
                <ul class="main-menu">
                    
                    <li><a href="evenement.php">Évènement</a></li>
                    <li><a href="apropos.html">A propos</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </div>
        </div>

        <div class="text">
            <h2>Retrouvez les cinémas équipés de nos technologies !</h2>
            <p>Que vous soyez simplement un visiteur qui veut découvrir notre solution au cinéma ou un futur partenaire, c’est ici que vous retrouverez les différentes salles de cinémas disposant déjà de notre solution. Vous pourrez ainsi y réserver une séance pour écouter notre solution en action sur votre film préféré (et faire la différence 😉) ! <br></p>
        </div>

        <form id="searchForm">
            <input type="text" id="searchQuery" name="query" placeholder="Rechercher un cinéma...">
            <button type="submit">Rechercher</button>
        </form>
        
        <!-- Section Évènement -->
        <div class="event-section">
            <div class="event-container">
                <!-- Cinéma -->
                <details>
                    <summary>Cliquez pour dérouler la liste des Cinémas et Salles</summary>
                    
                    <ul id="cinemaList" class="cinema-list">
                        <!-- La liste des cinémas sera ajoutée ici via JavaScript -->
                        <?php
                        foreach ($searchResult as $cinemaNom => $salles) {
                            echo "<li><strong>" . htmlspecialchars($cinemaNom) . "</strong>";
                            if (!empty($salles)) {
                                echo "<ul>";
                                foreach ($salles as $salleNom) {
                                    if ($salleNom) {
                                        echo "<li>" . htmlspecialchars($salleNom) . "</li>";
                                    }
                                }
                                echo "</ul>";
                            }
                            echo "</li>";
                        }
                        ?>
                    </ul>

                </details>
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

       
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            
            //Script pour le menu hamburger et le footer 
                document.getElementById('menu-icon').addEventListener('click', function () {
                    var navbar = document.querySelector('.navbar');
                    navbar.classList.toggle('show');
                });

                // Fonction pour basculer la visibilité de la sous-liste
                function toggleSubList(element) {
                    var subList = element.querySelector('ul');
                    if (subList) {
                        subList.style.display = subList.style.display === 'none' ? 'block' : 'none';
                    }
                }

                window.addEventListener('scroll', function () {
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

                

            $(document).ready(function () {
               
                 $('#searchForm').on('submit', function (e) {
                    e.preventDefault();
                    var query = $('#searchQuery').val();
                    window.location.href = 'evenement.php?query=' + query;
                });

                
            });    







        </script>

       
    </div>
</body>

</html>
