<?php
    session_start();
    require_once("config.php");

    if (!isset($_SESSION['pseudo'])) {
        header('Location: ../src/page/connexion.php'); // Remplacez 'login.php' par la page de connexion appropriée.
        exit;
    }

    $connexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($connexion->connect_error) {
        die("La connexion à la base de données a échoué : " . $connexion->connect_error);
    }

    // Requête SQL pour sélectionner toutes les lignes de la table
    $requete = "SELECT * FROM player ORDER BY nbr_click DESC";
    $resultat = $connexion->query($requete);

    $rows = [];
    if ($resultat->num_rows > 0) {
        while ($ligne = $resultat->fetch_assoc()) {
            $rows[] = $ligne;
        }
    }

    // Fermer la connexion à la base de données
    $connexion->close();

    // Retourner les données au format JSON
    echo json_encode($rows);
?>
