<?php
/**
 * Ce fichier contient toutes les fonctions qui réalisent des opérations
 * sur la base de données, telles que les requêtes SQL pour insérer, 
 * mettre à jour, supprimer ou récupérer des données.
 */

/**
 * Définition des constantes de connexion à la base de données.
 *
 * HOST : Nom d'hôte du serveur de base de données, ici "localhost".
 * DBNAME : Nom de la base de données
 * DBLOGIN : Nom d'utilisateur pour se connecter à la base de données.
 * DBPWD : Mot de passe pour se connecter à la base de données.
 */
define("HOST", "localhost");
define("DBNAME", "pineau18");
define("DBLOGIN", "pineau18");
define("DBPWD", "pineau18");


function getAllMovies(){
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer le menu avec des paramètres
    $sql = "select id, name, image from Movie ORDER BY name ASC";
    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    // Exécute la requête SQL
    $stmt->execute();
    // Récupère les résultats de la requête sous forme d'objets
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res; // Retourne les résultats
}

/**
 * Ajoute un nouveau film à la base de données
 * 
 * @param string $name Titre du film
 * @param string $director Réalisateur du film
 * @param int $year Année de sortie
 * @param int $length Durée en minutes
 * @param string $description Description ou synopsis
 * @param int $id_category ID de la catégorie
 * @param string $image Nom du fichier image
 * @param string $trailer URL du trailer
 * @param int $min_age Restriction d'âge minimum
 * 
 * @return bool true si succès, false sinon
 */
function addMovie($name, $director, $year, $length, $description, $id_category, $image, $trailer, $min_age){
    try {
        // Connexion à la base de données
        $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
        // Requête SQL pour insérer un film avec des paramètres nommés
        $sql = "INSERT INTO Movie (name, director, year, length, description, id_category, image, trailer, min_age) 
                VALUES (:name, :director, :year, :length, :description, :id_category, :image, :trailer, :min_age)";
        // Prépare la requête SQL
        $stmt = $cnx->prepare($sql);
        // Exécute la requête SQL avec les paramètres
        $result = $stmt->execute(array(
            ':name' => $name,
            ':director' => $director,
            ':year' => $year,
            ':length' => $length,
            ':description' => $description,
            ':id_category' => $id_category,
            ':image' => $image,
            ':trailer' => $trailer,
            ':min_age' => $min_age
        ));
        return $result; // Retourne true si succès, false sinon
    } catch (Exception $e) {
        return false; // Retourne false en cas d'erreur
    }
}

