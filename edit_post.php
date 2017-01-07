<?php
session_start();
//On inclut le fichier de connexion à la base de données
include 'connection.php';

// A. Récupération de l'article


if (empty($_POST))
{
// /Si aucune donnée n'est envoyée on affiche le formulaire
//    1. Récupération des auteurs
    $query = $pdo->prepare("SELECT id, content, title
                            FROM articles
                            WHERE articles.id= ?");
    $query->execute([$_GET['id']]);
    $article = $query->fetch();

    $template = 'edit_post';
    include 'layout.phtml';
} // B. Modification dans une table

else
{
    $query = $pdo->prepare("
UPDATE articles
SET content = ?, title = ?
WHERE id = ?
");
    $query->execute([
        $_POST['contents'],
        $_POST['title'],
        $_POST['id']
    ]);
    header("location: admin.php"); //Redirection vers index.php
    exit();

}
