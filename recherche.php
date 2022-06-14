<?php

include('headers.php');
include('connexion.php');

$requete = $connexion->prepare(
    "SELECT * FROM utilisateur
    WHERE prenom LIKE :recherche
    OR nom LIKE :recherche"
);
$requete->execute([":recherche" => "%" . $_GET["recherche"] . "%"]);

$listeUtilisateur = $requete->fetchAll();

echo json_encode($listeUtilisateur);
