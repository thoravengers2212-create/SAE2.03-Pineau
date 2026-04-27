<?php

/** ARCHITECTURE PHP SERVEUR  : Rôle du fichier controller.php
 * 
 *  Dans ce fichier, on va définir les fonctions de contrôle qui vont traiter les requêtes HTTP.
 *  Les requêtes HTTP sont interprétées selon la valeur du paramètre 'todo' de la requête (voir script.php)
 *  Pour chaque valeur différente, on déclarera une fonction de contrôle différente.
 * 
 *  Les fonctions de contrôle vont éventuellement lire les paramètres additionnels de la requête, 
 *  les vérifier, puis appeler les fonctions du modèle (model.php) pour effectuer les opérations
 *  nécessaires sur la base de données.
 *  
 *  Si la fonction échoue à traiter la requête, elle retourne false (mauvais paramètres, erreur de connexion à la BDD, etc.)
 *  Sinon elle retourne le résultat de l'opération (des données ou un message) à includre dans la réponse HTTP.
 */

/** Inclusion du fichier model.php
 *  Pour pouvoir utiliser les fonctions qui y sont déclarées et qui permettent
 *  de faire des opérations sur les données stockées en base de données.
 */
require("model.php");


function readMoviesController(){
    $movies = getAllMovies();
    return $movies;
}

/**
 * Contrôleur pour ajouter un film à la base de données
 * 
 * Validation:
 * - Tous les paramètres doivent être présents dans la requête
 * - L'année doit être valide (entre 1900 et l'année courante)
 * - La durée doit être positive
 * - L'ID de catégorie doit être valide
 * - L'âge minimum doit être entre 0 et 99
 * 
 * @return false|string Message de succès ou false en cas d'erreur
 */
function addMovieController(){
    // Vérification des paramètres obligatoires
    if (!isset($_REQUEST['name']) || $_REQUEST['name'] === '') {
        return false;
    }
    if (!isset($_REQUEST['director']) || $_REQUEST['director'] === '') {
        return false;
    }
    if (!isset($_REQUEST['year']) || $_REQUEST['year'] === '') {
        return false;
    }
    if (!isset($_REQUEST['length']) || $_REQUEST['length'] === '') {
        return false;
    }
    if (!isset($_REQUEST['description']) || $_REQUEST['description'] === '') {
        return false;
    }
    if (!isset($_REQUEST['id_category']) || $_REQUEST['id_category'] === '') {
        return false;
    }
    if (!isset($_REQUEST['image']) || $_REQUEST['image'] === '') {
        return false;
    }
    if (!isset($_REQUEST['trailer']) || $_REQUEST['trailer'] === '') {
        return false;
    }
    if (!isset($_REQUEST['min_age']) || $_REQUEST['min_age'] === '') {
        return false;
    }
    
    // Récupération des paramètres
    $name = $_REQUEST['name'];
    $director = $_REQUEST['director'];
    $year = $_REQUEST['year'];
    $length = $_REQUEST['length'];
    $description = $_REQUEST['description'];
    $id_category = $_REQUEST['id_category'];
    $image = $_REQUEST['image'];
    $trailer = $_REQUEST['trailer'];
    $min_age = $_REQUEST['min_age'];
    
    // Validation de l'année
    if (!is_numeric($year) || $year < 1900 || $year > date('Y')) {
        return false;
    }
    
    // Validation de la durée
    if (!is_numeric($length) || $length <= 0) {
        return false;
    }
    
    // Validation de l'ID catégorie
    if (!is_numeric($id_category) || $id_category < 1 || $id_category > 10) {
        return false;
    }
    
    // Validation de l'âge minimum
    if (!is_numeric($min_age) || $min_age < 0 || $min_age > 99) {
        return false;
    }
    
    // Appel de la fonction modèle pour ajouter le film
    $result = addMovie($name, $director, $year, $length, $description, $id_category, $image, $trailer, $min_age);
    
    if ($result) {
        return array('message' => 'Le film a été ajouté avec succès.');
    } else {
        return false;
    }
}