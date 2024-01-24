<?php
    require_once("config.php");
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($mysqli->connect_error) {
        die("Échec de la connexion à la base de données : " . $mysqli->connect_error);
    }

    // Requête SQL pour sélectionner toutes les lignes de la table (remplacez "votre_table" par le nom de votre table)
    $query = "SELECT * FROM visit";

    // Exécuter la requête
    $result = $mysqli->query($query);

    // Vérifier si la requête a réussi
    if ($result) {
        // Afficher les données dans un tableau HTML
        echo "<table>";
        echo "<tr><th>ID</th><th>Nom</th><th>Description</th></tr>";

        // Parcourir les résultats et afficher chaque ligne
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["date_creation"] . "</td>";
            echo "<td>" . $row["adresse_ip"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";

        // Libérer les résultats
        $result->free();
    } else {
        echo "Erreur lors de l'exécution de la requête : " . $mysqli->error;
    }

    // Fermer la connexion
    $mysqli->close();
?>
