<?php
session_start();
require_once("config.php");

if (isset($_SESSION['pseudo'])) {
    $pseudo = $_SESSION['pseudo'];

    // Établir une connexion à la base de données (utilisez votre propre configuration)
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);    
    if ($mysqli->connect_error) {
        die("La connexion à la base de données a échoué : " . $mysqli->connect_error);
    }
    
    $user_pseudo = $_SESSION["pseudo"]; // Assurez-vous de remplacer cette ligne par votre propre code d'authentification.

    // Vérifier si l'utilisateur existe déjà dans la table "player"
    $selectQuery = "SELECT * FROM player WHERE user_pseudo = ?";
    $stmt = $mysqli->prepare($selectQuery);
    $stmt->bind_param("s", $user_pseudo);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // L'utilisateur existe déjà dans la table "player", incrémente le nombre de clics.
        $row = $result->fetch_assoc();
        $nbr_click = $row['nbr_click'] + 1;
        $updateQuery = "UPDATE player SET nbr_click = ? WHERE user_pseudo = ?";
        $stmt = $mysqli->prepare($updateQuery);
        $stmt->bind_param("is", $nbr_click, $user_pseudo);
    } else {
        // L'utilisateur n'existe pas dans la table "player", insérez-le avec un clic initial de 1.
        $nbr_click = 1;
        $insertQuery = "INSERT INTO player (user_pseudo, nbr_click) VALUES (?, ?)";
        $stmt = $mysqli->prepare($insertQuery);
        $stmt->bind_param("si", $user_pseudo, $nbr_click);
    }

    $stmt->execute();

    $stmt->close();
    $mysqli->close();
}
?>
