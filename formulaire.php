<?php
    if(count($_POST) == 0){
        //on ne fais rien
    }
    else{
        //print_r($_POST);
    if (!empty($_POST['salle_id']) && !empty($_POST['nom_user']) && !empty($_POST['date_debut'])
    && !empty($_POST['date_fin']) && !empty($_POST['adresse'])){
    //inclure le fichier de connexion à la bdd

  

    $salle_id = (int)htmlspecialchars($_POST['salle_id']);
    $nom_user = htmlspecialchars($_POST['nom_user']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $date_debut = htmlspecialchars($_POST['date_debut']);
    $date_fin = htmlspecialchars($_POST['date_fin']);

    include('bdd.php');

    //requete de recupération de la salle
    $sql = "SELECT fin FROM reservation WHERE idsalle = ? ORDER BY fin DESC LIMIT 1";
    $requete = $bdd->prepare($sql);
    $requete->execute([$salle_id]);

    //recuperation des données de la bdd
    $resultat = $requete->fetch();
    
    //si la taille de la variable $resultat n'est pas égal à 0 donc le salle est reservée 
    if($resultat != false){
        //verification des dates
        if($date_debut > $resultat['fin']){
            //faire la reservation

            //enregistrement de l'utilisateur dans la table utilisateur
            $req = $bdd->prepare("INSERT INTO utilisateur(nom, adresse) VALUES(?, ?)");
            $req->execute([$nom_user, $adresse]);

            //recuperation de l'id  de l'utilisateur
            $req = $bdd->prepare("SELECT id FROM utilisateur WHERE nom = ?");
            $req->execute([$nom_user]);
            $id_user = $req->fetch();

            //insertion de la salle dans la table reservation 
            try{
                if(is_int($salle_id)){
                $req = $bdd->prepare("INSERT INTO reservation (idsalle, idutilisateur, debut, fin) VALUES (?,?,?,?)");
                $req->execute([$salle_id,$id_user['id'], $date_debut, $date_fin]);
                echo '<p> la salle a ete reservee avec succes.</p>';
            }
    
            }catch(PDOException){
                echo "Desoler !! Nous avons rencontré une erreur lors de la connexion";
            }

        }
        else{
            echo "la salle n'est pas disponible,
            voulez-vous reserver une autre salle ou attendre la fin la reservation en cours?";
        }
    }
    else{//si la salle n'est pas reservée
        //faire la reservation
            //enregistrement de l'utilisateur dans la table utilisateur
            $req = $bdd->prepare("INSERT INTO utilisateur(nom, adresse) VALUES(?, ?)");
            $req->execute([$nom_user, $adresse]);

            //recuperation de l'id  de l'utilisateur
            $req = $bdd->prepare("SELECT id FROM utilisateur WHERE nom = ?");
            $req->execute([$nom_user]);
            $id_user = $req->fetch();

            //insertion de la salle dans la table reservation 
            try{
                if(is_int($salle_id)){
                $req = $bdd->prepare("INSERT INTO reservation (idsalle, idutilisateur, debut, fin) VALUES (?,?,?,?)");
                $req->execute([$salle_id,$id_user['id'], $date_debut, $date_fin]);
                echo '<p> la salle a ete reservee avec succes.</p>';
            }
    
            }catch(PDOException){
                echo "Desoler !! Nous avons rencontré une erreur lors de la connexion";
            }
    }

    //$salle_id=(int)$salle_id;
}
else{
    echo "pas de champs vides svp!!!";
}


    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    <h3>veuillez remplire les champs</h3>
    <form action="" method="post">
        <input type="hidden" name="salle_id" value=<?= $_GET['salle_id'] ?? '' ?>>
        <label>Nom: </label>
        <input type="nom" name="nom_user" value=""><br>
        <label>Adresse: </label>
        <input type="Adresse" name="adresse" value=""><br>
        <label>Date-debut</label>
        <input type="date" name="date_debut" value=""><br>
        <label>Date-fin</label>
        <input type="date" name="date_fin" value=""><br>
        <input type="submit" value="reserver">
    </form>

</body>
</html>