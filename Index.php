<?php 
    try{
        include("bdd.php");
    
        $ali = $bdd->Prepare("SELECT *FROM salle");
        $ali->execute();
        $Resultats =$ali->fetchAll();
    }
    catch(PDOException $e){
        echo "Erreur lors de la connexion de salle". $e->getMessage();
    }
    foreach ($Resultats as $salle){
      
         echo '<a href="formulaire.php?salle_id='.$salle["id"].'"><p>'. $salle["nom"]. '</p></a>';
         echo "<p>". $salle["capacite"]. "</p>";
         echo "<p>". $salle["descriptions"]."</p>";
        
    }
    

?>

