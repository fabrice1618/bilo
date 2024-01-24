<?php
require_once("config.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les valeurs des champs du formulaire
    $pseudo = $_POST['pseudo'];
    $password_saisi = $_POST['motdepasse'];

    $connexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Vérification de la connexion à la base de données
    if ($connexion->connect_error) {
        die('Erreur de connexion à la base de données : ' . $connexion->connect_error);
    }

    // Échapper les valeurs pour éviter les injections SQL
    $pseudo = $connexion->real_escape_string($pseudo);

    // Requête pour récupérer le mot de passe haché de l'utilisateur en fonction du pseudo
    $query = "SELECT motdepass_hash FROM users WHERE pseudo = '$pseudo'";
    $result = $connexion->query($query);

    // Vérifier si la requête a renvoyé des résultats
    if ($result->num_rows > 0) {
        // Récupérer le mot de passe haché depuis la base de données
        $row = $result->fetch_assoc();
        $motDePasseHacheDeLaBaseDeDonnees = $row['motdepass_hash'];

        // Vérifier si le mot de passe saisi correspond au mot de passe haché de la base de données
        if (password_verify($password_saisi, $motDePasseHacheDeLaBaseDeDonnees)) {
            // Mot de passe valide, l'utilisateur est connecté
            $_SESSION["pseudo"] = $pseudo;
            header("Location: ../pages/leaderboard.php");
            exit;
        } else {
            // Mot de passe incorrect
            echo 'Mot de passe incorrect.';
        }
    } else {
        // Pseudo non trouvé dans la base de données
        echo 'Pseudo non trouvé dans la base de données.';
    }

    // Fermer la connexion à la base de données
    $connexion->close();
}
?>
