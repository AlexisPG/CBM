<?php
session_start();

//On inclut le fichier de connexion à la base de données
include 'connection.php';

// Afficher la liste des articles
// Récupération des articles
$query = $pdo->prepare
(
    'SELECT articles.id, content, title, -- Provenant de la table articles
            titles, -- Provenant de la table categories
            firstName, lastName -- Provenant de la table authors  
     FROM articles
     INNER JOIN categories ON categories.id = articles.categoryId
     INNER JOIN authors ON authors.id = articles.authorId'
);


$query->execute();
$articles = $query->fetchAll();
$title = 'Administration';

//On précise le nom du template
$template = 'admin';

//On inclut le layout
include 'layout.phtml';

