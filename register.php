<?php

session_start();
//On inclut le fichier de connexion à la base de données


if (empty($_POST))
{
//  On affiche le template
    $template = 'register';
    include 'layout.phtml';
}
else
{
    include 'connection.php';
//    Vérifications
//    1. Le mot de passe et la confirmation sont identiques
    if ($_POST['password'] != $_POST['confirm_password']) {
        // Si le mot de passe et confirmation sont différents,
        // on renvoit vers le formulaire
        header("location: register.php");
        exit();
    }

//    2. L'utilisateur existe déjà
    $query = $pdo->prepare('SELECT * 
                            FROM users
                            WHERE username = ?');
    $query->execute([
        $_POST['username']
    ]);
    $user = $query->fetch();

    //Si l'utilisateur n'a pas été trouvé,
    // le pseudo n'existe pas encore et donc $user est faux

if ($user != false)
{
    // Le pseudo existe déjà
    header("location: index.php");
    exit();

}
    $salt = '$2y$11$'.substr(bin2hex(openssl_random_pseudo_bytes(32)), 22);
    $passwordHashed = crypt($_POST['password'], $salt);

    $query = $pdo->prepare("INSERT INTO users
                            (username, password)
                            VALUES(?, ?)");

    $query->execute(
        [$_POST['username'], $passwordHashed]
    );

    $_SESSION['auth'] = [
        'username' => $_POST['username']
    ];

    //Inscription de l'utilisateur
    //J'enregistre une notification en session
    $_SESSION['message'] = 'Merci de vous être inscrit sur notre magnifique site !';

    //Redirection HTTP
    header("location: index.php");
    exit();
}


