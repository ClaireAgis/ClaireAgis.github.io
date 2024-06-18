<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Failed</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            text-align: center;
            padding: 20px;

            background-color: #02182d;
            margin: 0px;
            padding: 0px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
        }

        h1 {
            color: #e74c3c; /* Une couleur rouge pour indiquer l'échec */
        }

        p {
            margin-top: 100px;
        }

        a {
            color: #3498db; /* Une couleur bleue pour le lien */
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline; /* Souligner le lien au survol */
            
        }
        .SN2 img {
        position: absolute;
        top: 5%;
        left: 50%;
        transform: translateX(-50%);
        max-width: 10%;
        max-height: 25%;
        }
    </style>
</head>
<body>
    <h1>Registration Failed. Please try again.</h1>

    <div class="SN2">
        <a href="accueil.php">
            <img src="images/SN2.png" alt="logo">
        </a>
    </div>
    <?php
    if (isset($_GET['error'])) {
        echo "<p>Error details: " . htmlspecialchars($_GET['error']) . "</p>";
    }
    ?>
    <p>If the issue persists, you can <a href="registration.php">try registering again</a>.</p>
</body>
</html>