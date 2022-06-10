<?php
include("headers.php");
include("connexion.php");

$idUtilisateur = $_GET["id"];
$requete = $connexion->prepare("SELECT * FROM utilisateur WHERE id = :id");
$requete->execute(["id" => $idUtilisateur]);
$utilisateur = $requete->fetch();
echo json_encode($utilisateur);
