let templateFile = await fetch("./component/Movie/template.html");
let template = await templateFile.text();

console.log("Movie template loaded:", template);

let Movie = {};

Movie.format = function (movie) {
  let html = template;
  html = html.replaceAll("{{name}}", movie.name);
  html = html.replaceAll("{{image}}", movie.image);
  console.log("Formatted movie:", movie.name, "->", html);
  return html;
};

Movie.formatMany = function (movies) {
  let html = '';
  for (const movie of movies) {
    html += Movie.format(movie);
  }
  return html;
};

export { Movie };
