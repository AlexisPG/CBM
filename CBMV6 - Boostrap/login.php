<?php

session_start();

if (empty($_POST)) {
    // Template
    $template = 'login';
    include 'layout.phtml';
}

else {
    include 'connection.php';

    $query = $pdo->prepare('SELECT * 
                            FROM users
                            WHERE username = ?');
    $query->execute([
        $_POST['username']
    ]);
    $user = $query->fetch();

    if($user == false)
    {
        header("location: login.php");
        exit();
    }
    
    //  Vrai si c'est le mot de passe correspond
    // Faux si le mot de passe ne correspond pas
    if($user['password'] == crypt($_POST['password'], $user['password']))
    {
        $_SESSION['auth'] = $user;
        header("location: admin.php");
        exit();
    }

    else
    {
        header("location: login.php");
        exit();
    }
}




