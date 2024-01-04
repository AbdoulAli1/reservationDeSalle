<?php
include("bdd.php");

$req = "SELECT utilisateur.nom, salle.nom,debut,fin FROM reservation inner join salle on 
reservation.idsalle = salle.id inner join utilisateur on reservation.idutilisateur = utilisateur.id";
$req = $bdd->prepare($req);
$req->execute();
$donnees = $req->fetchAll();
echo "<table border='1'>";
echo "<tr>
    <th>Nom</th>
    <th>Salle</th>
    <th>Debut</th>
    <th>Fin</th>

</tr>";
echo "<pre>";
//print_r($donnees);
echo "</pre>";
  echo " Liste de Salle en Location";
foreach($donnees as $donnee ){
  
    echo "<tr> <td>".$donnee[0]."</td> <td>".$donnee[1]."</td> <td>".$donnee[2]."</td> <td>".$donnee[3]."</td></tr>";
}
echo "</table>";


?>