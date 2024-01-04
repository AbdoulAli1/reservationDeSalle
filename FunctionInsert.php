<?php
    function insertSalle($nom, $capacite, $description){
        include("bdd.php");
        

        $req = "INSERT INTO salle (nom, capacite, descriptions) VALUES (?,?,?)";
        $val = $bdd->prepare($req);
        $val->execute([$nom, $capacite, $description]);

        if($val->rowCount()>0){
            return true;
        } else{
            return false;
        }
       
    }

   
?>
