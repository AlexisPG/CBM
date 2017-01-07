<?php
session_start();
//On inclut le fichier de connexion à la base de données
include 'connection.php';

//Insertion dans une table
$query = $pdo->prepare("INSERT INTO comments
                            (articleId, username, message, creationTimestamp )
                            VALUES(?, ?, ?, NOW())");

$query->execute([
    $_POST['id'],
    $_POST['username'],
    $_POST['message']
]);


////Redirection HTTP
header("location: show_post.php?id=" . $_POST['id']);
exit();


