<?php

// logique de connexion à la database

// fonction qui crée et renvoi une connexion à la db
function dbConnexion() {

    // l'information pour se connecter
    // l'endroit où est ma database
    $host = "localhost";
    // le nom de la db
    $dbname = "users_db";
    // identifiant de connexion
    $username = "root";
    // mdp de connexion
    $password = "";
    // port
    $port = 3306;
    // encodage
    $charset = "utf8mb4";
    
    try {
        // je prépare mes param de co
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset;port=$port";
        // fait mon objet de co
        $pdo = new PDO($dsn, $username, $password);
        // comment récupérer les exceptions
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // comment renvoyer les données
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        var_dump($pdo);
        return $pdo;

    } catch (PDOException $e) {
        // sinon la db n'arrive pas à renvoyée les données, voici le msg 
        die("Erreur durant la co à la db: " . $e->getMessage());
    }
}

?>