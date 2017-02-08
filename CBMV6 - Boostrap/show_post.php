<?php
session_start();
include 'connection.php';

// 1. Récupération de l'article
$query = $pdo->prepare("SELECT articles.id, content, articles.title AS articleTitle, creationTimestamp, lastName, firstName, categories.titles AS categoryTitle
FROM articles
INNER JOIN authors ON authors.id = articles.authorId
INNER JOIN categories ON categories.id = articles.categoryId
WHERE articles.id= ?");

$query->execute([$_GET['id']]);

$article = $query->fetch();

// 2. Récupération de tous les commentaires l'article pour affichage des bons commantaires dans les bon articles

$query = $pdo->prepare("        
		SELECT
            username, message, creationTimestamp
        FROM
            comments
        WHERE
            articleId = ? #Permet de faire le lien avec ce qui est exécuté
                        ");
$query->execute([$_GET['id']]);
$comments = $query->fetchAll();

// On précise le nom du template
$template = 'show_post';

$title = $article['articleTitle'];

//On inclut le layout
include 'layout.phtml';
