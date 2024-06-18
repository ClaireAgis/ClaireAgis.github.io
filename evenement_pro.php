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
</head>
<body class="main">
    <div class="wrapper">
        <!-- Barre de menu -->
        <div class="banner">
            <div class="navbar">
                <h2 class="logo"><a href="accueil_pro.php"><img src="images/SN1.png" alt="logo soundneo"></a></h2>
                <div id="menu-icon">&#9776;</div>
                <ul class="main-menu">
                    <li><a href="evenement_pro.php">Évènement</a></li>
                    <li><a href="statistique.php">Statistiques</a></li>
                    <li><a href="profil.php"><img src="images/logo_profil2.png" alt="logo profil" style="width: 50px; height: auto;"></a></li>
                </ul>
            </div>
        </div>

        <div class="text">
            <h2>Configurez les cinémas équipés de nos technologies ! &#x1F680;</h2>
            <p>Bienvenue sur votre espace évènement ! Vous pouvez dès à présent ajouter vos salles et vos cinémas équipés de notre technologie et faire découvrir au monde les nouvelles frontières du divertissement cinématographique &#x1F3A5; <br></p>
        </div>

        <!-- Formulaire de recherche -->
        <form id="searchForm" action="evenement_pro.php" method="GET">
            <input type="text" id="searchQuery" name="query" placeholder="Rechercher un cinéma...">
            <button type="submit">Rechercher</button>
        </form>

        <!-- Section des événements -->
        <div class="event-section">
            <div class="event-container">
                <details>
                    <summary>Cliquez pour dérouler la liste des Cinémas et Salles</summary>
                    <ul id="cinemaList" class="cinema-list">
                        <?php
                        foreach ($searchResult as $cinemaNom => $salles) {
                            echo "<li><strong>" . htmlspecialchars($cinemaNom) . "</strong>";
                            if (!empty($salles)) {
                                echo "<ul>";
                                foreach ($salles as $salleNom) {
                                    echo "<li>" . htmlspecialchars($salleNom) . "</li>";
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

        <!-- Formulaire d'ajout de cinéma -->
        <form id="formulaireAjoutCinema" action="ajout_cinema.php" method="post">
            <label for="nom_cinema">Nom du cinéma :</label>
            <input type="text" name="nom_cinema" required>
            <label for="adresse_cinema">Adresse du cinéma :</label>
            <input type="text" name="adresse_cinema" required>
            <label for="ville_cinema">Ville du cinéma :</label>
            <input type="text" name="ville_cinema" required>
            <button type="submit">Ajouter Cinéma</button>
        </form>

        <!-- Formulaire d'ajout de salle -->
        <form id="formulaireAjoutSalle" action="ajout_salle.php" method="post">
            <label for="nom_salle">Nom de la salle :</label>
            <input type="text" name="nom_salle" required>
            <label for="cinema_id">Cinéma :</label>
            <select name="cinema_id" required>
                <?php
                // Générer la liste des cinémas pour le menu déroulant
                $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                $sql = "SELECT cinema_id, nom FROM cinema";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['cinema_id'] . "'>" . $row['nom'] . "</option>";
                }
                $conn->close();
                ?>
            </select>
            <label for="capacite">Capacité :</label>
            <input type="number" name="capacite" required>
            <button type="submit">Ajouter une salle</button>
        </form>

        <!-- Pied de page -->
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

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#searchForm').on('submit', function (e) {
                    e.preventDefault();
                    var query = $('#searchQuery').val();
                    window.location.href = 'evenement_pro.php?query=' + query;
                });

                $('#menu-icon').click(function () {
                    $('.navbar').toggleClass('show');
                });

                $(window).scroll(function () {
                    if ($(window).scrollTop() > $(document).height() - $(window).height() - 200) {
                        $('.footer').show();
                    } else {
                        $('.footer').hide();
                    }
                });
            });
        </script>
    </div>
</body>
</html>
