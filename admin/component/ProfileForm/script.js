import { DataProfile } from "../../data/dataProfile.js";

let templateFile = await fetch('./component/ProfileForm/template.html');
let template = await templateFile.text();

let ProfileForm = {};

/**
 * Formate et retourne le template du formulaire
 */
ProfileForm.format = function() {
  return template;
};

/**
 * Initialise le formulaire avec les événements
 */
ProfileForm.init = function() {
  let form = document.querySelector('#profile-form');
  
  if (!form) {
    console.error('Formulaire de profil non trouvé');
    return;
  }
  
  // Ajouter l'événement de soumission
  form.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    // Récupérer les valeurs du formulaire
    let name = document.querySelector('#profile-name').value.trim();
    let ageRestriction = document.querySelector('#profile-age').value;
    let avatarInput = document.querySelector('#profile-avatar');
    
    // Valider les champs obligatoires
    if (!name) {
      ProfileForm.showMessage('Veuillez remplir le nom du profil', 'error');
      return;
    }
    
    // Récupérer le fichier avatar s'il existe
    let avatar = null;
    if (avatarInput && avatarInput.files && avatarInput.files.length > 0) {
      avatar = avatarInput.files[0];
    }
    
    // Afficher un message de chargement
    ProfileForm.showMessage('Ajout du profil en cours...', 'info');
    
    // Envoyer les données au serveur
    let response = await DataProfile.add(name, avatar, ageRestriction);
    
    if (response.error) {
      ProfileForm.showMessage(response.error, 'error');
    } else if (response.message) {
      ProfileForm.showMessage(response.message, 'success');
      // Réinitialiser le formulaire après succès
      form.reset();
      // Optionnel: rafraîchir la liste des profils
      if (window.C && window.C.handlerListProfiles) {
        setTimeout(() => {
          window.C.handlerListProfiles();
        }, 1500);
      }
    }
  });
};

/**
 * Affiche un message dans le formulaire
 * @param {string} message - Le message à afficher
 * @param {string} type - Type du message: 'success', 'error', 'info'
 */
ProfileForm.showMessage = function(message, type) {
  let messageDiv = document.querySelector('#form-message');
  if (messageDiv) {
    messageDiv.textContent = message;
    messageDiv.className = 'form-message ' + type;
    messageDiv.style.display = 'block';
    
    // Cacher le message après 5 secondes si c'est un succès
    if (type === 'success') {
      setTimeout(() => {
        messageDiv.style.display = 'none';
      }, 5000);
    }
  }
};

export { ProfileForm };
