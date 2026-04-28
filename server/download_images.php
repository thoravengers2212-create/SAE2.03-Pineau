<?php
/**
 * Script pour télécharger les images des films depuis TMDB API
 * et les enregistrer dans le dossier images/
 */

// Configuration
$TMDB_API_KEY = ""; // À remplacer par votre clé API TMDB
$IMAGE_DIR = __DIR__ . "/images/";

// Liste des films à télécharger (basés sur la capture d'écran)
$movies = [
    ["name" => "Interstellar", "year" => 2014],
    ["name" => "La Liste de Schindler", "year" => 1993],
    ["name" => "Your Name", "year" => 2016],
    ["name" => "Le Bon, la Brute et le Truand", "year" => 1966],
    ["name" => "Arthur et les Minimoys", "year" => 2006],
    ["name" => "Astérix et Obélix : Mission Cléopâtre", "year" => 2002],
    ["name" => "Bee Movie", "year" => 2007],
    ["name" => "Blade Runner 2049", "year" => 2017],
    ["name" => "Dragons", "year" => 2010],
    ["name" => "Fantastic Mr. Fox", "year" => 2009],
    ["name" => "I Robot", "year" => 2004],
    ["name" => "Independence Day", "year" => 1996],
    ["name" => "John Wick 3", "year" => 2019],
    ["name" => "John Wick 4", "year" => 2023],
    ["name" => "Joker", "year" => 2019],
    ["name" => "Le Labyrinthe", "year" => 2014],
    ["name" => "Le Monde de Nemo", "year" => 2003],
    ["name" => "Men in Black", "year" => 1997],
];

// Vérifier que le dossier existe
if (!is_dir($IMAGE_DIR)) {
    mkdir($IMAGE_DIR, 0755, true);
}

// Fonction pour télécharger une image depuis une URL
function downloadImage($url, $filename) {
    global $IMAGE_DIR;
    
    if (empty($url)) {
        return false;
    }
    
    $filepath = $IMAGE_DIR . $filename;
    
    // Vérifier si le fichier existe déjà
    if (file_exists($filepath)) {
        echo "Image déjà présente : $filename<br>";
        return true;
    }
    
    // Télécharger l'image
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
    
    $data = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($http_code == 200 && !empty($data)) {
        if (file_put_contents($filepath, $data)) {
            echo "Téléchargé : $filename<br>";
            return true;
        }
    }
    
    echo "Erreur lors du téléchargement : $filename (HTTP $http_code)<br>";
    return false;
}

// Si une clé API est configurée, utiliser TMDB
if (!empty($TMDB_API_KEY)) {
    echo "<h2>Téléchargement des images depuis TMDB</h2>";
    
    foreach ($movies as $movie) {
        // Chercher le film dans TMDB
        $search_url = "https://api.themoviedb.org/3/search/movie?api_key=$TMDB_API_KEY&query=" . urlencode($movie["name"]) . "&year=" . $movie["year"];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $search_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        
        $result = curl_exec($ch);
        curl_close($ch);
        
        $data = json_decode($result, true);
        
        if (isset($data['results']) && count($data['results']) > 0) {
            $poster_path = $data['results'][0]['poster_path'];
            
            if ($poster_path) {
                $image_url = "https://image.tmdb.org/t/p/w500" . $poster_path;
                $filename = sanitize_filename($movie["name"]) . ".jpg";
                
                downloadImage($image_url, $filename);
            }
        }
    }
} else {
    // Alternative : Utiliser des URLs directes depuis Wikipedia/IMDB (à compléter)
    echo "<h2>Téléchargement d'images depuis sources alternatives</h2>";
    echo "Pour utiliser TMDB, veuillez configurer une clé API TMDB à la ligne 9 du script.<br>";
    echo "Vous pouvez en obtenir une gratuitement sur : <a href='https://www.themoviedb.org/settings/api'>https://www.themoviedb.org/settings/api</a>";
}

function sanitize_filename($filename) {
    $filename = preg_replace("/[^a-zA-Z0-9]/", "_", $filename);
    return strtolower($filename);
}

?>
