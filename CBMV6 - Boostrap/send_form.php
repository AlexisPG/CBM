<?php
session_start();//on démarre la session

    $errors = [];
    $errors = array(); // on crée une vérif de champs
    if (!array_key_exists('firstname', $_POST) || $_POST['firstname'] == '') {// on verifie l'existence du champ et d'un contenu
        $errors ['firstname'] = "Vous n'avez pas renseigné votre prénom";
    }

    if (!array_key_exists('lastname', $_POST) || $_POST['lastname'] == '') {// on verifie l'existence du champ et d'un contenu
        $errors ['lastname'] = "Vous n'avez pas renseigné votre nom";
    }

    if (!array_key_exists('email', $_POST) || $_POST['email'] == '' || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {// on verifie existence de la clé
        $errors ['mail'] = "Vous n'avez pas renseigné votre email";
    }

    if (!array_key_exists('phone', $_POST) || $_POST['phone'] == '') {// on verifie l'existence du champ et d'un contenu
        $errors ['phone'] = "Vous n'avez pas renseigné votre numéro de téléphone";
    }

    if (!array_key_exists('message', $_POST) || $_POST['message'] == '') {
        $errors ['message'] = "Vous n'avez pas renseigné votre message";
    }

    /*if(array_key_exists('antispam', $_POST)) {// on place un petit filet anti robots spammers
      $errors ['antispam'] = "Vous êtes un robots spammer";
      }*/

//On check les infos transmises lors de la validation
    if (!empty($errors)) { // si erreur on renvoie vers la page précédente
        $_SESSION['errors'] = $errors;//on stocke les erreurs
        $_SESSION['inputs'] = $_POST;
        header('Location: contact.php');
    } else {
        $_SESSION['success'] = 1;
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= 'FROM:' . htmlspecialchars($_POST['email']);
        $to = 'alexispersinettegautrez@gmail.com'; // Insérer votre adresse email ICI
        $subject = 'Caroline, vous avez reçu un message envoyé par ' . htmlspecialchars($_POST['firstname']) . ' ' . htmlspecialchars($_POST['lastname']);
        $message_content = '
  <table>
    <tr>
        <td><b>Emetteur du message :</b></td>
    </tr>
    <tr>
        <td>Prénom : ' . htmlspecialchars($_POST['firstname']) . '</td>
    </tr>
    <tr>
        <td>Nom : ' . htmlspecialchars($_POST['lastname']) . '</td>
    </tr>
    <tr>
        <td>Adresse email : ' . htmlspecialchars($_POST['email']) . '</td>
    </tr>
    <tr>
        <td>Numéro de téléphone : ' . htmlspecialchars($_POST['phone']) . '</td>
    </tr>
    </tr>
    <tr>
        <td><b>Contenu du message :</b></td>
    </tr>
    <tr>
        <td>' . htmlspecialchars($_POST['message']) . '</td>
    </tr>
  </table>
  ';

       $post = mail($to, $subject, $message_content, $headers);
       if($post == false)
       {
           /*$post = true;*/
           var_dump($post);
           die();
       }
       header('Location: contact.php');
}
