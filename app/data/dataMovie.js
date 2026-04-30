// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL = "..";//"http://mmi.unilim.fr/~????"; // CHANGE THIS TO MATCH YOUR CONFIG

let DataMovie = {};

DataMovie.requestMovies = async function(){
    // fetch permet d'envoyer une requête HTTP à l'URL spécifiée. 
    // L'URL est construite en concaténant HOST_URL à "/server/script.php?todo=readmovies"
    // L'URL finale dépend de la valeur de HOST_URL.
    let answer = await fetch(HOST_URL + "/server/script.php?todo=readmovies");
    // answer est la réponse du serveur à la requête fetch.
    // On utilise ensuite la méthode json() pour extraire de cette réponse les données au format JSON.
    // Ces données (data) sont automatiquement converties en objet JavaScript.
    let data = await answer.json();
    // Enfin, on retourne ces données.
    return data;
}

DataMovie.requestMovieDetails = async function(id){
    // Envoie une requête pour obtenir les détails d'un film spécifique par son ID
    let answer = await fetch(HOST_URL + "/server/script.php?todo=readmoviedetail&id=" + id);
    let data = await answer.json();
    return data;
}

/**
 * Regroupe les films par catégorie
 * @param {array} movies - Tableau des films
 * @returns {object} Objet avec les films regroupés par catégorie ID
 */
DataMovie.groupByCategory = function(movies) {
    let grouped = {};
    
    if (!movies || !Array.isArray(movies)) {
        return grouped;
    }
    
    for (const movie of movies) {
        const categoryId = movie.id_category || 0;
        
        // Créer la catégorie si elle n'existe pas
        if (!grouped[categoryId]) {
            grouped[categoryId] = [];
        }
        
        // Ajouter le film à sa catégorie
        grouped[categoryId].push(movie);
    }
    
    // Trier par catégorie ID
    const sorted = {};
    Object.keys(grouped).sort((a, b) => a - b).forEach(key => {
        sorted[key] = grouped[key];
    });
    
    return sorted;
}

export {DataMovie};
