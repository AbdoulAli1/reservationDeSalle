<?php

    //include("bdd.php");
    include("FunctionInsert.php");
    if(isset($_POST['Index'])){
        if(isset($_POST['nom']) && isset($_POST['capacite']) && isset($_POST['descriptions'])){
           // echo "salut";
            $nom = $_POST['nom'];
            $capacite = $_POST['capacite'];
            $descriptions = $_POST['descriptions'];
            //echo "sqlt";
            if(empty($nom) && empty($capacite) && empty($descriptions)){
                $erreur = 'Erreur, veuillez remplire tout les champs';
            }else{
                //insertion de salle a la base de donnee

                insertSalle($nom, $capacite, $descriptions);
                /*$req = "INSERT INTO salle(nom,capacite,descriptions) VALUES (:nom,:capacite,:descriptions)";
                $req = $bdd->prepare($req);
                $req->execute(array('nom'=>$nom, 'capacite'=>$capacite, 'descriptions'=>$descriptions));*/
            }
        }
           header("location:Index.php");
    } 
   

    
   
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sqlu</title>
    </head>
    <body>
        
            <form method="POST" action="">
                    <label> Nom de la salle:</label>
                    <input  name="nom" type="text" required><br>
                    <label> Capacite:</label>
                    <input  name="capacite"  type="number"  required><br>
                    <label> Description:</label>
                    <textarea name="descriptions"  required></textarea><br>
                    <input type="submit" value="Ajouter" name="Index">
            </form> 
    </body>
    </html>