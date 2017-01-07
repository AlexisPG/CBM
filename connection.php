<?php

/**
 * Retourne la connexion à la base de données
 * @return PDO
 */

    $pdo = new PDO("mysql:host=localhost;dbname=myBlog","root","root", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC //Par défaut on récupère FETCH_ASSOC
    ]);
    $pdo->exec('SET NAMES UTF8');

