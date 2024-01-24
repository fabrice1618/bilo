<?php
    require_once("config.php");

    $adresseIP = $_SERVER['REMOTE_ADDR'];

    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($mysqli->connect_error) {
        die("Échec de la connexion à la base de données : " . $mysqli->connect_error);
    }
    // Préparer la requête SQL pour insérer l'adresse IP et la date de création dans la base de données
    $query = "INSERT INTO visit (adresse_ip, date_creation) VALUES (?, NOW())";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $adresseIP);

    // // Exécute la requête
    // if ($stmt->execute()) {
    //     echo "Adresse IP et date de création insérées avec succès dans la base de données.";
    // } else {
    //     echo "Erreur lors de l'insertion : " . $stmt->error;
    // }

    $stmt->close();
    $mysqli->close();
?>

<!-- <html>
    <a class="bg-transparent p-3 border-2 border-white border-opacity-20 " href="show_visit.php">Afficher le tableau.</a>
</html> -->
