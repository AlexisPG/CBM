<?php
session_start();
//On inclut le fichier de connexion à la base de données
include 'connection.php';

//On précise le nom du template
$template = '404';

//On inclut le layout
include 'layout.phtml';