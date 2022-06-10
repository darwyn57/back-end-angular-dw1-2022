<?php

include("headers.php");
include("connexion.php");

$requete = $connexion->prepare("SELECT * FROM utilisateur");
$requete->execute();

echo json_encode($requete->fetchAll());
