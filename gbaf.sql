-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 26 avr. 2021 à 14:17
-- Version du serveur :  5.7.32
-- Version de PHP : 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gbaf`
--

-- --------------------------------------------------------

--
-- Structure de la table `actors`
--

CREATE TABLE `actors` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `url_website` varchar(255) NOT NULL,
  `texte` text NOT NULL,
  `url_post` varchar(255) NOT NULL,
  `url_img_actors` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `user_id_post` int(2) NOT NULL,
  `date_post` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `actors`
--

INSERT INTO `actors` (`id`, `titre`, `url_website`, `texte`, `url_post`, `url_img_actors`, `meta_description`, `meta_keywords`, `user_id_post`, `date_post`) VALUES
(1, 'Exemple fiche partenaire 1 ', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque non quam magna. Praesent id tincidunt dolor. Ut odio magna, bibendum ac ex eu, rutrum bibendum eros. Vestibulum purus massa, sollicitudin at eros id, blandit consectetur elit. Vestibulum accumsan ante vitae neque venenatis, faucibus ultrices sem auctor. Mauris commodo sapien vel aliquet cursus. Donec quis sapien nec magna euismod laoreet. Vivamus et justo luctus, pellentesque ante quis, euismod erat. Morbi diam est, malesuada et nulla at, interdum finibus sem. Aenean non diam dictum libero lobortis scelerisque. ', 'Exemple-fiche-partenaire-1.html', '/img/no_image.png', '', '', 2, '2021-04-19 08:56:21'),
(2, 'Exemple fiche partenaire 2', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque non quam magna. Praesent id tincidunt dolor. Ut odio magna, bibendum ac ex eu, rutrum bibendum eros. Vestibulum purus massa, sollicitudin at eros id, blandit consectetur elit. Vestibulum accumsan ante vitae neque venenatis, faucibus ultrices sem auctor. Mauris commodo sapien vel aliquet cursus. Donec quis sapien nec magna euismod laoreet. Vivamus et justo luctus, pellentesque ante quis, euismod erat. Morbi diam est, malesuada et nulla at, interdum finibus sem. Aenean non diam dictum libero lobortis scelerisque. ', 'Exemple-fiche-partenaire-2.html', '/img/no_image.png', '', '', 2, '2021-04-19 08:57:29'),
(4, 'Formation&Co', 'http://formationco.fr', '<p>Formation&co est une association française présente sur tout le territoire.\r\n                Nous proposons à des personnes issues de tout milieu de devenir entrepreneur grâce à un crédit et un accompagnement professionnel et personnalisé.\r\n            </p>\r\n                <ul>\r\n                    <li>un financement jusqu’à 30 000€</li>\r\n                    <li>un suivi personnalisé et gratuit</li>\r\n                    <li>une lutte acharnée contre les freins sociétaux et les stéréotypes</li>\r\n                </ul>\r\n            <p>\r\n                Le financement est possible, peu importe le métier : coiffeur, banquier, éleveur de chèvres… . Nous collaborons avec des personnes talentueuses et motivées.\r\n                Vous n’avez pas de diplômes ? Ce n’est pas un problème pour nous ! Nos financements s’adressent à tous.\r\n            </p>', 'Formation-Co.html', '/img/actors/Formation&Co.png', '', '', 2, '2021-04-19 10:11:52'),
(5, 'Protectpeople', 'http://www.protectpeople.com', 'Protectpeople finance la solidarité nationale.\r\nNous appliquons le principe édifié par la Sécurité sociale française en 1945 : permettre à chacun de bénéficier d’une protection sociale.\r\n\r\nChez Protectpeople, chacun cotise selon ses moyens et reçoit selon ses besoins.\r\nProectecpeople est ouvert à tous, sans considération d’âge ou d’état de santé.\r\nNous garantissons un accès aux soins et une retraite.\r\nChaque année, nous collectons et répartissons 300 milliards d’euros.\r\nNotre mission est double :\r\nsociale : nous garantissons la fiabilité des données sociales ;\r\néconomique : nous apportons une contribution aux activités économiq', 'Protectpeople.html', '/img/actors/Protectpeople.png', '', '', 2, '2021-04-19 11:46:52'),
(6, 'Dsa France', 'http://www.dsafrance.com', 'Dsa France accélère la croissance du territoire et s’engage avec les collectivités territoriales.\r\nNous accompagnons les entreprises dans les étapes clés de leur évolution.\r\nNotre philosophie : s’adapter à chaque entreprise.\r\nNous les accompagnons pour voir plus grand et plus loin et proposons des solutions de financement adaptées à chaque étape de la vie des entreprises', 'Dsa-France.html', '/img/actors/Dsa-France.png', '', '', 2, '2021-04-19 11:51:33'),
(7, 'Chambre Des Entrepreneurs', 'http://www.cde.com', 'La CDE (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation. \r\nSon président est élu pour 3 ans par ses pairs, chefs d’entreprises et présidents des CDE', 'Chambre-Des-Entrepreneurs.html', '/img/actors/Chambre-Des-Entrepreneurs.png', '', '', 2, '2021-04-19 11:56:35');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `date_commentaire` datetime NOT NULL,
  `user_id_comment` int(11) NOT NULL,
  `actors_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `commentaire`, `date_commentaire`, `user_id_comment`, `actors_id`) VALUES
(1, 'Super partenaire!', '2021-04-23 17:15:40', 2, 4),
(2, 'Très satisfait de la Chambre Des Entrepreneurs.', '2021-04-26 14:39:45', 1, 7),
(3, 'D\'accord avec Frédéric!', '2021-04-26 15:11:30', 3, 7);

-- --------------------------------------------------------

--
-- Structure de la table `like_unlike`
--

CREATE TABLE `like_unlike` (
  `id` int(11) NOT NULL,
  `up` int(11) NOT NULL,
  `down` int(11) NOT NULL,
  `actors_id` int(11) NOT NULL,
  `user_id_like` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `like_unlike`
--

INSERT INTO `like_unlike` (`id`, `up`, `down`, `actors_id`, `user_id_like`) VALUES
(1, 1, 0, 7, 1),
(2, 1, 0, 7, 3);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `question` varchar(255) NOT NULL,
  `reponse` varchar(255) NOT NULL,
  `url_img_avatar` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `usergroup` int(2) NOT NULL,
  `date_inscription` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `mail`, `username`, `password`, `question`, `reponse`, `url_img_avatar`, `active`, `usergroup`, `date_inscription`) VALUES
(1, 'PIERROT', 'Frédéric', 'fpierrot@entherapie.com', 'fpierrot', '$2y$10$DePp.Bu7r2iiJZt7T/4WBO1i2ROjM.ca3L4kGAbSnOt3CiYWP9PKi', 'Quelle est votre ville de naissance?', 'cafe', 'avatar_user_1.jpg', 1, 1, '2021-04-23 10:53:56'),
(2, 'BULCOURT', 'Nicolas', 'nicolas@bulcourt.fr', 'nbulcourt', '$2y$10$mV92ts6CFfuSq4SzOd0sDuuvkBSbjce.Cpq7IzSv37sMriD3sFgV.', 'Quelle est votre boisson préférée?', 'coca', 'avatar_user_2.jpg', 1, 2, '2021-04-23 10:58:25'),
(3, 'THIERRY', 'Mélanie', 'mthierry@entherapie.com', 'mthierry', '$2y$10$WeFKvr8WkZYhEQAUtqPd7.AQMeJBoZkrfPeygZngz/JfwgzL0y5Ai', 'Quel est votre chanteur/groupe préféré?', 'queen', 'avatar_user_3.jpg', 1, 1, '2021-04-26 15:10:39');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id_post` (`user_id_post`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id_comment` (`user_id_comment`),
  ADD KEY `fk_actors_id` (`actors_id`);

--
-- Index pour la table `like_unlike`
--
ALTER TABLE `like_unlike`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_actor_id` (`actors_id`),
  ADD KEY `fk_user_id_like` (`user_id_like`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `actors`
--
ALTER TABLE `actors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `like_unlike`
--
ALTER TABLE `like_unlike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `actors`
--
ALTER TABLE `actors`
  ADD CONSTRAINT `fk_user_id_post` FOREIGN KEY (`user_id_post`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_actors_id` FOREIGN KEY (`actors_id`) REFERENCES `actors` (`id`),
  ADD CONSTRAINT `fk_user_id_comment` FOREIGN KEY (`user_id_comment`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `like_unlike`
--
ALTER TABLE `like_unlike`
  ADD CONSTRAINT `fk_actor_id` FOREIGN KEY (`actors_id`) REFERENCES `actors` (`id`),
  ADD CONSTRAINT `fk_user_id_like` FOREIGN KEY (`user_id_like`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
