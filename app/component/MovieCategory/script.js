import { Movie } from "../Movie/script.js";

let templateFile = await fetch('./component/MovieCategory/template.html');
let template = await templateFile.text();

let MovieCategory = {};

// Mapping des catégories ID vers leurs noms
const CATEGORIES_MAP = {
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

/**
 * Formate une catégorie avec ses films
 * @param {number} categoryId - L'ID de la catégorie
 * @param {string} categoryName - Le nom de la catégorie
 * @param {array} movies - Tableau des films de cette catégorie
 * @returns {string} HTML formaté
 */
MovieCategory.format = function(categoryId, categoryName, movies) {
  let html = template;
  
  // Remplacer le nom de la catégorie
  html = html.replaceAll('{{CATEGORY_NAME}}', categoryName);
  
  // Formater les films de la catégorie
  let moviesHtml = '';
  if (movies && movies.length > 0) {
    moviesHtml = Movie.formatMany(movies);
  } else {
    moviesHtml = '<p class="no-movies-category">Aucun film dans cette catégorie.</p>';
  }
  
  html = html.replaceAll('{{MOVIES_LIST}}', moviesHtml);
  
  return html;
};

/**
 * Formate plusieurs catégories avec leurs films
 * @param {object} categoriesData - Objet avec les catégories et leurs films
 * @returns {string} HTML formaté pour toutes les catégories
 */
MovieCategory.formatMany = function(categoriesData) {
  let html = '';
  
  for (const [categoryId, movies] of Object.entries(categoriesData)) {
    const categoryName = CATEGORIES_MAP[categoryId] || `Catégorie ${categoryId}`;
    html += MovieCategory.format(categoryId, categoryName, movies);
  }
  
  return html;
};

export { MovieCategory };
