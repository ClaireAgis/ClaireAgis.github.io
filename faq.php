<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinesound - FAQ</title>
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
                    <li><a href="login.php">Login</a></li>
                </ul>
            </div>
        </div>

        <!-- Section FAQ -->
        <div class="faq-section">
            <h2>Foire Aux Questions</h2>
            <div class="faq-container">
                <?php
                // Database connection
                include("config.php");

                $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch FAQ data from the database
                $sql = "SELECT id, question, reponse FROM faq";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '
                        <div class="faq-item">
                            <div class="question">
                                <span>Q: ' . htmlspecialchars($row["question"]) . '</span>
                                <div class="toggle-icon">&#9660;</div>
                            </div>
                            <div class="answer">
                                <p>' . htmlspecialchars($row["reponse"]) . '</p>
                            </div>
                        </div>
                        ';
                    }
                } else {
                    echo "0 results";
                }

                // Close database connection
                $conn->close();
                ?>
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
            </ul>
        </div>
   

    </div>
    <!-- Script pour le menu hamburger  et le footer-->

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

        // Script pour gérer le clic sur les questions FAQ
        var faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(function(item) {
            var question = item.querySelector('.question');

            question.addEventListener('click', function() {
                item.classList.toggle('active');
            });
        });
    </script>
</body>
</html>