let templateFile = await fetch('./component/MovieDetail/template.html');
let template = await templateFile.text();

let MovieDetail = {};

/**
 * Fonction pour convertir une URL YouTube en URL d'embedding
 */
let convertYoutubeToEmbed = function(url) {
    if (!url) return '';
    
    // Formats supportés:
    // https://www.youtube.com/watch?v=dQw4w9WgXcQ
    // https://www.youtube.com/watch?v=dQw4w9WgXcQ&si=...
    // https://youtu.be/dQw4w9WgXcQ
    // https://youtu.be/dQw4w9WgXcQ?si=...
    // https://www.youtube.com/embed/dQw4w9WgXcQ
    
    let videoId = '';
    
    try {
        // Format: watch?v=ID
        if (url.includes('youtube.com/watch')) {
            const urlObj = new URL(url);
            videoId = urlObj.searchParams.get('v');
        }
        // Format: youtu.be/ID
        else if (url.includes('youtu.be')) {
            videoId = url.split('youtu.be/')[1]?.split('?')[0];
        }
        // Format: embed/ID
        else if (url.includes('youtube.com/embed')) {
            videoId = url.split('/embed/')[1]?.split('?')[0];
        }
        
        if (videoId) {
            return `https://www.youtube.com/embed/${videoId}`;
        }
    } catch (e) {
        console.error('Erreur conversion URL YouTube:', e);
    }
    
    return url; // Retourne l'URL originale si aucun format reconnu
};

/**
 * Fonction pour formater et afficher les détails d'un film
 */
MovieDetail.format = function(movie) {
    let html = template;
    
    if (movie && movie.id_category) {
        // Mapping des catégories
        const categories = {
            1: 'Action',
            2: 'Comédie',
            3: 'Drame',
            4: 'Science-fiction',
            5: 'Animation',
            6: 'Thriller',
            7: 'Horreur',
            8: 'Aventure',
            9: 'Fantaisie',
            10: 'Documentaire'
        };
        
        const categoryName = categories[movie.id_category] || 'Non définie';
        const embedUrl = convertYoutubeToEmbed(movie.trailer);
        
        // Remplacements directs dans le HTML
        html = html.replaceAll('{{TITLE}}', movie.name);
        html = html.replaceAll('{{IMAGE}}', `../server/images/${movie.image}`);
        html = html.replaceAll('{{DIRECTOR}}', movie.director);
        html = html.replaceAll('{{YEAR}}', movie.year);
        html = html.replaceAll('{{LENGTH}}', movie.length);
        html = html.replaceAll('{{CATEGORY}}', categoryName);
        html = html.replaceAll('{{MINAGE}}', movie.min_age);
        html = html.replaceAll('{{SYNOPSIS}}', movie.description);
        html = html.replaceAll('{{TRAILER}}', embedUrl);
    }
    
    return html;
};

export { MovieDetail };
