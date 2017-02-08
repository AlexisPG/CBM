function valider(){
    // si la valeur du champ prenom est non vide
    if(document.formSaisie.value != "") {
        // les données sont ok, on peut envoyer le formulaire
        alert("Votre message va être envoyé. Nous vous contacterons très prochainement.");
        return true;
    }
    else {
        // sinon on affiche un message
        alert("Veuillez compléter tous les champs");
        // et on indique de ne pas envoyer le formulaire
        return false;
    }
}