

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Success</title>
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
            color: #800080 ; /* Une couleur verte pour indiquer le succès */
        }

        p {
            margin-top: 20px;
        }

        a {
            color: #3498db; /* Une couleur bleue pour le lien */
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline; /* Souligner le lien au survol */
        }

        .hidden {
            display: none; /* Masquer par défaut */
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

    <div class="SN2">
        <a href="accueil.php">
            <img src="images/SN2.png" alt="logo">
        </a>
    </div>

    <div id="successMessage" class="hidden">
        <h1>Registration Successful!</h1>
        <p>Thank you for registering. You can now <a href="login.php">log in</a>.</p>
    </div>

    <script>
        // Affiche le message de succès après l'inscription
        document.getElementById('successMessage').style.display = 'block';
    </script>
    

</body>
</html>