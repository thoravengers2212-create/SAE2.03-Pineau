// URL où se trouve le répertoire "server"
let HOST_URL = "..";//"http://mmi.unilim.fr/~????"; // CHANGE THIS TO MATCH YOUR CONFIG

let DataProfile = {};

/**
 * Envoie les données du profil au serveur pour l'ajouter à la base de données
 * @param {string} name - Nom du profil
 * @param {File|null} avatar - Avatar/image du profil (facultatif)
 * @param {number} age_restriction - Restriction d'âge
 * @returns {Promise} Réponse du serveur
 */
DataProfile.add = async function(name, avatar, age_restriction){
    try {
        // Créer les données à envoyer
        let formData = new FormData();
        formData.append('todo', 'addprofile');
        formData.append('name', name);
        formData.append('age_restriction', age_restriction);
        
        // Ajouter l'avatar s'il existe
        if (avatar && avatar instanceof File) {
            formData.append('avatar', avatar);
        }
        
        // Envoyer la requête POST au serveur
        let answer = await fetch(HOST_URL + "/server/script.php", {
            method: 'POST',
            body: formData
        });
        
        // Vérifier si la réponse est OK
        if (!answer.ok) {
            console.error('Erreur HTTP:', answer.status, answer.statusText);
            return { error: 'Erreur du serveur (HTTP ' + answer.status + ')' };
        }
        
        // Récupérer la réponse en JSON
        let data = await answer.json();
        return data;
    } catch (error) {
        console.error('Erreur lors de l\'envoi des données:', error);
        return { error: 'Erreur de connexion au serveur: ' + error.message };
    }
}

export { DataProfile };
