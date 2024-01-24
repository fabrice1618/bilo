<?php
    require_once("config.php");
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['pseudo'];
        $password = $_POST['motdepasse'];
        $confirm_password = $_POST['confirm_motdepasse'];

        // Vérification si les mots de passe correspondent
        if ($confirm_password !== $password) {
            echo "Les mots de passe sont différents.";
            exit;
            // Créer une alerte pour dire que le mot de passe est différent
        }
        
        $connexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        // Vérification de la connexion à la base de données
        if ($connexion->connect_error) {
            die('Erreur de connexion à la base de données : ' . $connexion->connect_error);
        }



        $password = password_hash($password, PASSWORD_DEFAULT);



        //Insertion des valeurs dans la DB
        $query = "INSERT INTO users (pseudo, motdepass_hash) 
        VALUES ('$username', '$password')";


        $_SESSION["pseudo"] = $username;

        //Si insertion réussi alors j'ouvre la page menu
        if ($connexion->query($query) === TRUE) {
            header("Location: ../src/pages/leaderboard.php");
            exit;
        } else {
            echo "Erreur lors de l'inscription : " . $connexion->error;
        }

        $connexion->close();
    }
?>
