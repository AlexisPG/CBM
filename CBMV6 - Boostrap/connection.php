<?php

/**
 * Retourne la connexion à la base de données
 * @return PDO
 */
// Pour Caroline mysql:host=db658334794.db.1and1.com;dbname=db658334794","dbo658334794","Caroline",
// Pour les tests : mysql:host=localhost;dbname=myBlog","root","root",

/*$host_name  = "db668598054.db.1and1.com";
$database   = "db668598054";
$user_name  = "dbo668598054";
$password   = "pantagruel";*/


    $pdo = new PDO("mysql:host=db668598054.db.1and1.com;dbname=db668598054","dbo668598054","pantagruel", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC //Par défaut on récupère FETCH_ASSOC
    ]);
    $pdo->exec('SET NAMES UTF8');

