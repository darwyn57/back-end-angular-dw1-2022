<?php

include("headers.php");
include("connexion.php");

$idUtilisateur = $_GET["id"];

$requete = $connexion->prepare("DELETE FROM utilisateur WHERE id = :id");
$requete->execute(
    ["id" => $idUtilisateur]
);
