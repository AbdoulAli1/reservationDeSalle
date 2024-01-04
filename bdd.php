<?php
try {
    $bdd = new PDO("mysql:host=localhost;dbname=location", "root", "");
}catch(PDOException $e){
    echo "Erreur lors de la connexion de salle". $e->getMessage();
}
?>