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
 * Contrôleur pour lire les détails d'un film
 * 
 * @return array Détails du film ou message d'erreur
 */
function readMovieDetailController(){
    // Vérification de l'ID du film
    if (!isset($_REQUEST['id']) || $_REQUEST['id'] === '') {
        return array('error' => 'L\'identifiant du film est obligatoire');
    }
    
    $id = $_REQUEST['id'];
    
    // Validation de l'ID
    if (!is_numeric($id) || $id < 1) {
        return array('error' => 'L\'identifiant du film est invalide');
    }
    
    // Appel de la fonction modèle pour obtenir les détails du film
    $movie = getMovieDetailsById($id);
    
    if ($movie) {
        return $movie;
    } else {
        return array('error' => 'Film non trouvé');
    }
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
 * @return array Message de succès ou d'erreur
 */
function addMovieController(){
    // Vérification des paramètres obligatoires
    if (!isset($_REQUEST['name']) || $_REQUEST['name'] === '') {
        return array('error' => 'Le titre du film est obligatoire');
    }
    if (!isset($_REQUEST['director']) || $_REQUEST['director'] === '') {
        return array('error' => 'Le réalisateur est obligatoire');
    }
    if (!isset($_REQUEST['year']) || $_REQUEST['year'] === '') {
        return array('error' => 'L\'année de sortie est obligatoire');
    }
    if (!isset($_REQUEST['length']) || $_REQUEST['length'] === '') {
        return array('error' => 'La durée est obligatoire');
    }
    if (!isset($_REQUEST['description']) || $_REQUEST['description'] === '') {
        return array('error' => 'La description est obligatoire');
    }
    if (!isset($_REQUEST['id_category']) || $_REQUEST['id_category'] === '') {
        return array('error' => 'La catégorie est obligatoire');
    }
    if (!isset($_REQUEST['image']) || $_REQUEST['image'] === '') {
        return array('error' => 'Le nom du fichier image est obligatoire');
    }
    if (!isset($_REQUEST['trailer']) || $_REQUEST['trailer'] === '') {
        return array('error' => 'L\'URL du trailer est obligatoire');
    }
    if (!isset($_REQUEST['min_age']) || $_REQUEST['min_age'] === '') {
        return array('error' => 'La restriction d\'âge est obligatoire');
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
        return array('error' => 'L\'année de sortie doit être entre 1900 et ' . date('Y'));
    }
    
    // Validation de la durée
    if (!is_numeric($length) || $length <= 0) {
        return array('error' => 'La durée doit être un nombre positif');
    }
    
    // Validation de l'ID catégorie
    if (!is_numeric($id_category) || $id_category < 1 || $id_category > 10) {
        return array('error' => 'La catégorie est invalide');
    }
    
    // Validation de l'âge minimum
    if (!is_numeric($min_age) || $min_age < 0 || $min_age > 99) {
        return array('error' => 'La restriction d\'âge doit être entre 0 et 99');
    }
    
    // Appel de la fonction modèle pour ajouter le film
    $result = addMovie($name, $director, $year, $length, $description, $id_category, $image, $trailer, $min_age);
    
    if ($result) {
        return array('message' => 'Le film a été ajouté avec succès.');
    } else {
        return array('error' => 'Erreur lors de l\'ajout du film. Vérifiez votre connexion à la base de données.');
    }
}

/**
 * Contrôleur pour ajouter un profil utilisateur
 * 
 * Validation:
 * - Le nom doit être présent dans la requête
 * - La restriction d'âge doit être numérique et valide (0, 12, 16, etc.)
 * 
 * @return array Message de succès ou d'erreur
 */
function addProfileController(){
    // Vérification du paramètre obligatoire: nom
    if (!isset($_REQUEST['name']) || $_REQUEST['name'] === '') {
        return array('error' => 'Le nom du profil est obligatoire');
    }
    
    $name = $_REQUEST['name'];
    $avatar = isset($_REQUEST['avatar']) ? $_REQUEST['avatar'] : '';
    $age_restriction = isset($_REQUEST['age_restriction']) ? $_REQUEST['age_restriction'] : 0;
    
    // Validation de la restriction d'âge
    if (!is_numeric($age_restriction) || $age_restriction < 0 || $age_restriction > 99) {
        return array('error' => 'La restriction d\'âge doit être un nombre entre 0 et 99');
    }
    
    // Appel de la fonction modèle pour ajouter le profil
    $result = addUserProfile($name, $avatar, $age_restriction);
    
    if ($result) {
        return array('message' => 'Le profil a été ajouté avec succès.');
    } else {
        return array('error' => 'Erreur lors de l\'ajout du profil. Vérifiez votre connexion à la base de données.');
    }
}
