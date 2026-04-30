-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 28 mars 2025 à 18:01
-- Version du serveur :  5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `SAE2.03`
--

-- --------------------------------------------------------

--
-- Structure de la table `Category`
--

CREATE TABLE `Category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Category`
--

INSERT INTO `Category` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Comédie'),
(3, 'Drame'),
(4, 'Science-fiction'),
(5, 'Animation'),
(6, 'Thriller'),
(7, 'Horreur'),
(8, 'Aventure'),
(9, 'Fantaisie'),
(10, 'Documentaire');

-- --------------------------------------------------------

--
-- Structure de la table `Movie`
--

CREATE TABLE `Movie` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  `description` text,
  `director` varchar(255) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `trailer` varchar(255) DEFAULT NULL,
  `min_age` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Movie`
--

INSERT INTO `Movie` (`id`, `name`, `year`, `length`, `description`, `director`, `id_category`, `image`, `trailer`, `min_age`) VALUES
(7, 'Interstellar', 2014, 169, 'Un groupe d\'explorateurs voyage à travers un trou de ver pour sauver l\'humanité.', 'Christopher Nolan', 4, 'interstellar.jpg', 'https://www.youtube.com/embed/VaOijhK3CRU?si=76Ke4uw4LYjuLuQ6', 12),
(12, 'La Liste de Schindler', 1993, 195, 'Un industriel allemand sauve des milliers de Juifs pendant l\'Holocauste.', 'Steven Spielberg', 3, 'schindler.webp', 'https://www.youtube.com/embed/ONWtyxzl-GE?si=xC3ASGGPy5Ib-aPn', 16),
(17, 'Your Name', 2016, 107, 'Deux adolescents échangent leurs corps de manière mystérieuse.', 'Makoto Shinkai', 5, 'your_name.jpg', 'https://www.youtube.com/embed/AROOK45LXXg?si=aUQyGk2VMCb_ToUL', 10),
(27, 'Le Bon la Brute et le Truand', 1966, 161, 'Trois hommes se lancent à la recherche d\'un trésor caché.', 'Sergio Leone', 8, 'bon_brute_truand.jpg', 'https://www.youtube.com/embed/WA1hCZFOPqs?si=TwNZAoM4oj4KpGja', 12),
(31, 'Arthur et les Minimoys', 2006, 94, 'Un jeune garçon découvre le monde microscopique des Minimoys.', 'Luc Besson', 8, 'arthur_minimoys.jpg', '', 6),
(32, 'Asterix et Obelix Mission Cleopatre', 2002, 120, 'Les aventures de nos héros gaulois en Égypte.', 'Alain Chabat', 2, 'Asterix et Obelix Mission Cleopatre.png', '', 8),
(33, 'Bee Movie', 2007, 91, 'Une abeille avocat defend les droits des abeilles.', 'Steve Hickner', 5, 'bee_movie.jpg', '', 6),
(34, 'Blade Runner 2049', 2017, 163, 'Un blade runner en quête d\'un secret long oublié.', 'Denis Villeneuve', 4, 'blade_runner_2049.jpg', '', 12),
(35, 'Dragons', 2010, 98, 'Un jeune viking apprend à apprivoiser les dragons.', 'Dean DeBlois', 8, 'dragons.jpg', '', 6),
(36, 'Fantastic Mr. Fox', 2009, 87, 'Un renard tente de voler les poules d\'trois fermiers.', 'Wes Anderson', 2, 'fantastic_mr_fox.jpg', '', 10),
(37, 'I Robot', 2004, 115, 'Un détective enquête sur des crimes impliquant des robots.', 'Alex Proyas', 4, 'i_robot.jpg', '', 12),
(38, 'Independence Day', 1996, 145, 'L\'humanité se défend contre une invasion extraterrestre.', 'Roland Emmerich', 1, 'independence_day.jpg', '', 12),
(39, 'John Wick Chapitre 3', 2019, 131, 'Un tueur à gages cherche à se venger.', 'Chad Stahelski', 1, 'John Wick Chapitre 3.png', '', 16),
(40, 'John Wick Chapitre 4', 2023, 169, 'John Wick affronte des ennemis puissants.', 'Chad Stahelski', 1, 'John Wick Chapitre 4.png', '', 16),
(41, 'Joker', 2019, 122, 'L\'histoire d\'un homme qui devient un criminel.', 'Todd Phillips', 3, 'joker.jpg', '', 16),
(42, 'Le Labyrinthe', 2014, 113, 'Des jeunes gens piégés dans un labyrinthe mortel.', 'Wes Ball', 4, 'maze_runner.jpg', '', 12),
(43, 'Le Monde de Nemo', 2003, 100, 'Un poisson clown cherche son fils perdu.', 'Andrew Stanton', 5, 'finding_nemo.jpg', '', 6),
(44, 'Men in Black', 1997, 98, 'Deux agents secrets protègent la terre des extraterrestres.', 'Barry Sonnenfeld', 4, 'men_in_black.jpg', '', 12),
(45, 'Men in Black II', 2002, 88, 'Les agents sont de retour pour une nouvelle mission.', 'Barry Sonnenfeld', 4, 'men_in_black_2.jpg', '', 12),
(46, 'Men in Black III', 2012, 104, 'Les agents voyagent dans le temps.', 'Barry Sonnenfeld', 4, 'men_in_black_3.jpg', '', 12),
(47, 'Oppenheimer', 2023, 180, 'La vie du scientifique J. Robert Oppenheimer.', 'Christopher Nolan', 3, 'oppenheimer.jpg', '', 12),
(48, 'Pirates des Caraibes', 2003, 143, 'Un pirate excentrique cherche un trésor maudit.', 'Gore Verbinski', 8, 'Pirates des Caraibes.png', '', 12),
(49, 'Prince of Persia The Sands of Time', 2010, 116, 'Un prince doit remonter le temps pour sauver un royaume.', 'Mike Newell', 8, 'Prince of Persia The Sands of Time.png', '', 12),
(50, 'Ring', 2002, 115, 'Une vidéo maudite tue ceux qui la regardent.', 'Gore Verbinski', 7, 'ring.jpg', '', 16),
(51, 'Robots', 2005, 91, 'Un jeune robot rêve de devenir un grand inventeur.', 'Chris Wedge', 5, 'robots.jpg', '', 6),
(52, 'Rush Hour', 1998, 98, 'Un inspecteur hongkongais s\'associe avec un flic de Los Angeles.', 'Brett Ratner', 2, 'rush_hour.jpg', '', 12),
(53, 'Rush Hour II', 2001, 99, 'Ils sont de retour pour une mission dangereuse.', 'Brett Ratner', 2, 'rush_hour_2.jpg', '', 12),
(54, 'Scary Movie 1', 2000, 88, 'Une parodie d\'horreur hilarante.', 'Keenen Ivory Wayans', 2, 'scary_movie_1.jpg', '', 16),
(55, 'Scary Movie 2', 2001, 83, 'Plus de parodie, plus de rires.', 'Keenen Ivory Wayans', 2, 'scary_movie_2.jpg', '', 16),
(56, 'Scary Movie 3', 2003, 84, 'La saga continue avec plus de gags.', 'David Zucker', 2, 'scary_movie_3.jpg', '', 16),
(57, 'Scary Movie 4', 2006, 86, 'Encore plus de parodie déjantée.', 'David Zucker', 2, 'scary_movie_4.jpg', '', 16),
(58, 'Scary Movie 5', 2013, 88, 'Les parodie arrivent enfin à cinq.', 'Malcolm D. Lee', 2, 'scary_movie_5.jpg', '', 16),
(59, 'Sonic 1 le film', 2020, 99, 'Un hérisson bleu rapide fait ses débuts au cinéma.', 'Jeff Fowler', 5, 'Sonic 1 le film.png', '', 6),
(60, 'Sonic 2 le film', 2022, 122, 'Sonic affronteLe Dr. Robotnik et Knuckles.', 'Jeff Fowler', 5, 'Sonic 2 le film.png', '', 6),
(61, 'Sonic 3 le film', 2024, 110, 'Sonic revient pour une nouvelle aventure.', 'Jeff Fowler', 5, 'Sonic 3 le film.png', '', 6),
(62, 'Spider-Man Across the Spider-Verse', 2023, 140, 'Miles Morales voyage à travers les univers Spider-Man.', 'Joaquim Dos Santos', 4, 'Spider-Man Across the Spider-Verse.png', '', 10),
(63, 'Spider-Man Into the Spider-Verse', 2018, 140, 'Miles Morales devient le nouveau Spider-Man.', 'Bob Persichetti', 4, 'Spider-Man Into the Spider-Verse.png', '', 10),
(64, 'Star Wars Episode I La Menace fantome', 1999, 136, 'Les débuts de la saga Star Wars.', 'George Lucas', 4, 'Star Wars Episode I La Menace fantome.png', '', 12),
(65, 'Super Mario Bros le film', 2023, 92, 'Les frères Mario traversent les royaumes.', 'Aaron Horvath', 5, 'Super Mario Bros le film.png', '', 6),
(66, 'Super Mario Galaxy le film', 2023, 95, 'Mario explore une galaxie lointaine.', 'Aaron Horvath', 5, 'Super Mario Galaxy le film.png', '', 6),
(67, 'The Mask', 1994, 101, 'Un comptable trouve un masque magique.', 'Chuck Russell', 2, 'the_mask.jpg', '', 12),
(68, 'The Matrix', 1999, 136, 'Un hacker découvre la nature de la réalité.', 'Lana Wachowski', 4, 'the_matrix.jpg', '', 12),
(69, 'The Truman Show', 1998, 103, 'Un homme découvre que sa vie est une émission.', 'Peter Weir', 2, 'truman_show.jpg', '', 12),
(70, 'Titanic', 1997, 194, 'L\'amour et la tragédie à bord du Titanic.', 'James Cameron', 3, 'titanic.jpg', '', 12),
(71, 'Top Gun', 1986, 110, 'Des pilotes de chasse rivalisent pour devenir les meilleurs.', 'Tony Scott', 1, 'top_gun.jpg', '', 12),
(72, 'Top Gun Maverick', 2022, 131, 'Maverick revient pour entraîner la prochaine génération.', 'Joseph Kosinski', 1, 'Top Gun Maverick.png', '', 12),
(73, 'WALL-E', 2008, 98, 'Un robot nettoyeur solitaire découvre le sens de la vie.', 'Andrew Stanton', 5, 'wall_e.jpg', '', 6);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Movie`
--
ALTER TABLE `Movie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Category`
--
ALTER TABLE `Category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `Movie`
--
ALTER TABLE `Movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Movie`
--
ALTER TABLE `Movie`
  ADD CONSTRAINT `movie_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `Category` (`id`);

-- --------------------------------------------------------

--
-- Structure de la table `UserProfile`
--

CREATE TABLE `UserProfile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `avatar` varchar(255),
  `age_restriction` int(11) DEFAULT 0,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `UserProfile`
--

INSERT INTO `UserProfile` (`id`, `name`, `avatar`, `age_restriction`) VALUES
(1, 'Parents', NULL, 0),
(2, 'Enfants', NULL, 8),
(3, 'Ados', NULL, 12);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
