<?php
// On inclut le fichier de connexion à la base de données
session_start();
include 'connection.php';

$query = $pdo->prepare
(
    'SELECT articles.id, content, title, creationTimestamp, firstName, lastName 
     FROM articles
     INNER JOIN authors ON authors.id = articles.authorId
     INNER JOIN categories ON categories.id = articles.categoryId
     ORDER BY creationTimestamp DESC'
);


$query->execute();
$articles = $query->fetchAll();
// On précise le nom du template
$template = 'blog';
//$title = 'Liste des articles';

//On inclut le layout
include 'layout.phtml';

