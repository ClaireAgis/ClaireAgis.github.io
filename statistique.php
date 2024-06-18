<?php
include 'config.php';
$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);

// Traitement de la requête AJAX pour les salles
if (isset($_GET['action']) && $_GET['action'] == 'get_salles' && isset($_GET['cinema_id'])) {
    $cinemaId = $_GET['cinema_id'];
    $stmt = $pdo->prepare('SELECT nom_salle FROM salle WHERE cinema_id = ?');
    $stmt->execute([$cinemaId]);
    
    echo '<option value="">Sélectionnez une salle</option>';
    while ($salle = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="' . $salle['nom_salle'] . '">' . $salle['nom_salle'] . '</option>';
    }
    exit; 
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Statistiques</title>
        <link rel="stylesheet" href="accueil.css">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <style>
                
        .text3 {
            width: 100%;
            max-width: 1200px;
            margin: auto;
            position: relative;
            padding: 20px;
            color: #fff; 
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }

        .text3 h2 {
            font-family: serif;
            font-size: 30px;
            padding-left: 20px;
            margin-top: 0%;
            letter-spacing: 2px;
            color: #fff; 
            margin-bottom: 20px; 
            text-align: center;
        }
        .text3 h1 {
            font-size: 27px;
        }
        
        .event-section .select-container {
            display: flex;
            flex-direction: row;
            gap: 20px;
            margin-bottom: 10%;
        }


        /* Style pour les listes déroulantes */
        #cinemaSelect, #salleSelect {
            width: 20%; 
            padding: 10px;
            margin-bottom: 20px; 
            border: 2px solid violet;
            border-radius: 5px;
            background-color: white;
            color: black;
            font-size: 16px;
        }


        .images-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }</style>
    </head>

    <body class="main">
        <div class="wrapper">
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

            <div class="text3">
                <h2>Retrouvez l'analyse graphique de nos salles équipées de notre solution!</h2>
                <h1>Si vous souhaitez voir le bénéfice accoustique réel de notre solution, vous êtes au bon endroit ! <br></h1>
            </div>
            <div class="event-section">
                <div class="select-container">
                    <select id="cinemaSelect">
                        <option value="">Sélectionnez un cinéma</option>
                        <?php
                        include 'config.php';
                        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
                        $query = $pdo->query('SELECT cinema_id, nom FROM cinema');
                        while ($cinema = $query->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="' . $cinema['cinema_id'] . '">' . $cinema['nom'] . '</option>';
                        }
                        ?>
                    </select>

                    <select id="salleSelect">
                        <option value="">Sélectionnez une salle</option>
                    </select>                    
                </div>
            </div>

            <div class="images-container">
                <div class="images" style="display: none;">
                    <h1>Signal initial <br></h1>
                    <img src="images/graph 1.jpg" alt="graph 1"><br><br>
                    <h1>Signal traité <br></h1>
                    <img src="images/graph 2.jpg" alt="graph 2">
                </div>
            </div>

            <div class="footer" style="display: block;">
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
        </div>

        <script>
            $(document).ready(function() {
                function checkSelections() {
                    var cinemaSelected = $('#cinemaSelect').val() !== '';
                    var salleSelected = $('#salleSelect').val() !== '';
                    if (cinemaSelected && salleSelected) {
                        $('.images').show();
                    } else {
                        $('.images').hide();
                    }
                }
                $('#cinemaSelect').change(function() {
                    var cinemaId = $(this).val();
                    if (cinemaId) {
                        $.ajax({
                            url: '?action=get_salles&cinema_id=' + cinemaId,
                            success: function(response) {
                                $('#salleSelect').html(response);
                                checkSelections();
                            }
                        });
                    } else {
                        $('#salleSelect').html('<option value="">Sélectionnez une salle</option>');
                    }
                    checkSelections();
                });
                $('#salleSelect').change(function() {
                    checkSelections();
                });
            });
        </script>

    </body>
</html>
