let templateFile = await fetch('./component/Movie/template.html');
let template = await templateFile.text();

let MovieForm = {};

/**
 * Fonction pour valider les données du formulaire
 */
let validateData = function(data) {
    // Validation des champs obligatoires
    if (!data.name || data.name.trim() === '') {
        return { valid: false, message: 'Le titre du film est obligatoire' };
    }
    if (!data.director || data.director.trim() === '') {
        return { valid: false, message: 'Le réalisateur est obligatoire' };
    }
    if (!data.year || isNaN(data.year) || data.year < 1900 || data.year > new Date().getFullYear()) {
        return { valid: false, message: 'L\'année de sortie est invalide' };
    }
    if (!data.length || isNaN(data.length) || data.length <= 0) {
        return { valid: false, message: 'La durée est invalide' };
    }
    if (!data.description || data.description.trim() === '') {
        return { valid: false, message: 'La description est obligatoire' };
    }
    if (!data.id_category || data.id_category === '') {
        return { valid: false, message: 'La catégorie est obligatoire' };
    }
    if (!data.image || data.image.trim() === '') {
        return { valid: false, message: 'Le nom du fichier image est obligatoire' };
    }
    if (!data.trailer || data.trailer.trim() === '') {
        return { valid: false, message: 'L\'URL du trailer est obligatoire' };
    }
    if (!data.min_age || isNaN(data.min_age) || data.min_age < 0 || data.min_age > 99) {
        return { valid: false, message: 'La restriction d\'âge est invalide' };
    }
    
    return { valid: true, message: 'Données valides' };
};

/**
 * Fonction pour envoyer les données au serveur
 */
let sendToServer = function(data) {
    // Construction de l'URL avec les paramètres
    let params = new URLSearchParams();
    params.append('todo', 'addmovie');
    params.append('name', data.name);
    params.append('director', data.director);
    params.append('year', data.year);
    params.append('length', data.length);
    params.append('description', data.description);
    params.append('id_category', data.id_category);
    params.append('image', data.image);
    params.append('trailer', data.trailer);
    params.append('min_age', data.min_age);

    return fetch('../server/script.php', {
        method: 'POST',
        body: params
    })
    .then(response => response.json())
    .then(data => {
        return data;
    })
    .catch(error => {
        return { error: 'Erreur de connexion au serveur: ' + error };
    });
};

/**
 * Fonction appelée lorsque l'utilisateur clique sur le bouton Ajouter
 */
let handleSubmit = async function(e) {
    e.preventDefault();
    
    // Récupération du formulaire
    let form = document.querySelector('#movie');
    
    // Récupération des données du formulaire
    let data = {
        name: form.querySelector('#name').value,
        director: form.querySelector('#director').value,
        year: parseInt(form.querySelector('#year').value),
        length: parseInt(form.querySelector('#length').value),
        description: form.querySelector('#description').value,
        id_category: parseInt(form.querySelector('#id_category').value),
        image: form.querySelector('#image').value,
        trailer: form.querySelector('#trailer').value,
        min_age: parseInt(form.querySelector('#min_age').value)
    };
    
    // Validation des données
    let validation = validateData(data);
    if (!validation.valid) {
        C.log(validation.message);
        return;
    }
    
    // Envoi au serveur
    let result = await sendToServer(data);
    
    // Vérification du résultat
    if (result.error) {
        C.log(result.error);
    } else if (result.message) {
        C.log(result.message);
        // Réinitialisation du formulaire
        form.reset();
    } else {
        C.log('Le film a été ajouté avec succès.');
        // Réinitialisation du formulaire
        form.reset();
    }
};

/**
 * Fonction pour formater et retourner le HTML du formulaire
 */
MovieForm.format = function() {
    let html = template;
    return html;
};

/**
 * Fonction pour initialiser les écouteurs d'événements
 */
MovieForm.init = function() {
    let button = document.querySelector('#movie button');
    if (button) {
        button.addEventListener('click', handleSubmit);
    }
};

export { MovieForm };
