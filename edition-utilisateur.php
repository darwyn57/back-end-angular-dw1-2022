<?php
include('headers.php');
include('connexion.php');

$json = $_POST['utilisateur'];
$data = json_decode($json);
//uploads des image dans le dossier uplods 
if (isset($_FILES) && isset($_FILES['image'])) {
    $pathParts = pathinfo($_FILES['image']['name']);
    $nomImage = 'avatar-' . uniqid() . '.' . $pathParts['extension'];
    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        __DIR__ . "/uploads/" . $nomImage
    );
}

//si c'est une création d'utiilisateur
if (!isset($data->id) || $data->id == null) {

    $requete = $connexion->prepare(
        "INSERT INTO utilisateur (prenom, nom, image, mot_de_passe)
        VALUES (:prenom, :nom, :image, :mot_de_passe)"
    );

    $requete->execute([
        ":prenom" => $data->prenom,
        ":nom" => $data->nom,
        ":image" => $nomImage,
        ":mot_de_passe" => $data->mot_de_passe
    ]);
} else {
    //si c'est une modification utilisateur
    $requete = $connexion->prepare(
        "UPDATE utilisateur 
         SET prenom = :prenom,
             nom = :nom,
             image = :image,
             mot_de_passe = :mot_de_passe
         WHERE id = :id"
    );

    $requete->execute([
        ":prenom" => $data->prenom,
        ":nom" => $data->nom,
        ":image" => $nomImage,
        ":mot_de_passe" => $data->mot_de_passe,
        ":id" => $data->id
    ]);
}

// var_dump($_FILES);

// echo json_encode($_FILES);
