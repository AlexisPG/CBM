<?php
session_start();
//On inclut le fichier de connexion à la base de données
include 'connection.php';

if (empty($_POST)){
//    1. Récupération des auteurs
// Préparation de la requête
    $query = $pdo->prepare('SELECT * FROM authors');
    $query->execute();
// Récupération de tous les résultats dans un tableau associatif
    $authors = $query->fetchAll();

//    2. Récupéation des catégories
    $query = $pdo->prepare('SELECT * FROM categories');
    $query->execute();
    $categories = $query->fetchAll();

//  On précise le nom du template
    $template = 'add_article';
    //On inclut le layout
    include 'layout.phtml';
}

else {

//Insertion dans une table
    $query = $pdo->prepare("INSERT INTO articles
                            (authorId, categoryId, content, title, creationTimestamp) 
                            VALUES(?, ?, ?, ?, NOW())");

    $query->execute([
        $_POST['author'], 
        $_POST['category'], 
        $_POST['contents'], 
        $_POST['title']]);

//Redirection HTTP
    header("location: index.php");
    exit();

}

