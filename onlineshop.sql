-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 02 juil. 2024 à 09:35
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `onlineshop`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id_contact` int NOT NULL AUTO_INCREMENT,
  `id_member` int DEFAULT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone_number` int NOT NULL,
  `message` longtext NOT NULL,
  `subject` varchar(250) NOT NULL,
  `date` date DEFAULT NULL,
  `state` enum('in progress','processed') DEFAULT 'in progress',
  `response` longtext,
  `response_state` enum('read','unread') NOT NULL DEFAULT 'unread',
  `date_response` date DEFAULT NULL,
  PRIMARY KEY (`id_contact`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id_member` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `name` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sexe` enum('m','f') NOT NULL,
  `city` varchar(20) NOT NULL,
  `postal_code` int(5) UNSIGNED ZEROFILL NOT NULL,
  `address` varchar(50) NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `photo` varchar(250) DEFAULT NULL,
  `phone_number` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_member`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`id_member`, `pseudo`, `password`, `name`, `first_name`, `email`, `sexe`, `city`, `postal_code`, `address`, `status`, `photo`, `phone_number`) VALUES
(1, 'Sam', 'toto', 'Habbani', 'Samih', 'mail@mail.com', 'm', 'Cannes', 06400, 'Rue d\'antibes', 0, NULL, '0676776641'),
(6, 'ryme', '$2y$10$25n8zVQhBocWNM3M44dhieVPSlJ75QlmGsqTthxHz6vvVoRkw5nF6', 'Rbs', 'Remy', 'remy@mail.com', 'm', 'Cannes', 06400, 'Rue d\'antibes', 2, NULL, NULL),
(7, 'John', '$2y$10$cyJHSkVflV5hgN1MZ7LsJuYMa1HPGVUuVEmjZoSKXXJba3WozqgPG', 'php', 'Remy', 'admin@example.com', 'm', 'Cannes', 06400, 'Rue d\'antibes', 2, NULL, NULL),
(8, 'Samos2022', '$2y$10$ADCAAT1dnov4tOdH/y2iyOVZhccrndLr3seO6kS6FcpsL6FYqbZ6e', 'php', 'Rémy', 'admin@example.com', 'm', 'Cannes', 06400, 'Rue d\'antibes', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id_order` int NOT NULL AUTO_INCREMENT,
  `id_member` int DEFAULT NULL,
  `amount` int NOT NULL,
  `date` datetime NOT NULL,
  `state` enum('en traitement','envoyé','livré') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_order`),
  KEY `id_member` (`id_member`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id_order`, `id_member`, `amount`, `date`, `state`) VALUES
(41, 1, 9990, '2024-07-02 09:18:00', 'en traitement');

-- --------------------------------------------------------

--
-- Structure de la table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id_order_details` int NOT NULL AUTO_INCREMENT,
  `id_order` int DEFAULT NULL,
  `id_product` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL,
  PRIMARY KEY (`id_order_details`),
  KEY `id_order` (`id_order`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `order_details`
--

INSERT INTO `order_details` (`id_order_details`, `id_order`, `id_product`, `quantity`, `price`) VALUES
(28, 41, 4, 10, 999);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id_product` int NOT NULL AUTO_INCREMENT,
  `reference` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `picture` varchar(250) NOT NULL,
  `price` int NOT NULL,
  `stock` int NOT NULL,
  PRIMARY KEY (`id_product`),
  UNIQUE KEY `reference` (`reference`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id_product`, `reference`, `category`, `title`, `description`, `picture`, `price`, `stock`) VALUES
(2, '31-p-33', 'Création', 'Raspberry Velvet Tart', 'Une tartelette élégante composée d\'une pâte sablée au cacao, d\'une ganache au chocolat noir et de framboises fraîches, parsemée d\'éclats de pistache et de feuille d\'or comestible.', 'http://localhost:80/onlineshop_light/assets/choco-1.png', 14, 50),
(3, '56-a-65', 'Chocolat', 'Tablette Wonka', 'La tablette Wonka est un produit phare de l\'usine de chocolat de Willy Wonka, connue pour son goût exceptionnel et ses emballages colorés. Chaque tablette peut contenir des surprises, comme des tickets d\'or permettant de visiter l\'usine. La tablette combine un chocolat riche et onctueux avec des inclusions variées, telles que des noix caramélisées ou des éclats de biscuit.', 'http://localhost:80/onlineshop_light/assets/effet-tabl1.png', 7, 5000),
(4, '77-p-79', 'Main d\'oeuvre', 'Oompa Loompa', 'Les Oompa Loompas travaillent dans l\'usine de chocolat de Willy Wonka, où ils s\'occupent de diverses tâches liées à la fabrication et à l\'emballage des produits. Originaires de Loompaland, ils sont ramenés par Wonka pour leur expertise unique et en échange de leur travail, ils sont rémunérés en fèves de cacao, leur mets préféré. Ils sont connus pour leurs chants et danses, souvent utilisés pour transmettre des leçons morales.', 'http://localhost:80/onlineshop_light/assets/oompaloompa.gif', 999, 110),
(5, '11-d-231', 'Creation', 'Caramel Lava Brownie', 'Un brownie riche et dense avec un cœur coulant de caramel salé, offrant une explosion de saveurs chocolatées et sucrées-salées.', 'http://localhost:80/onlineshop_light/assets/choco-2.png', 28, 42),
(6, '66-f-15_01', 'Creation', 'Triple Choco Crunch Mousse', 'Une mousse légère et onctueuse en trois couches de chocolat (blanc, lait et noir), agrémentée de noisettes caramélisées pour une texture croquante et un goût de noisette grillée.', 'http://localhost:80/onlineshop_light/assets/choco-4.png', 12, 160),
(7, '88-g-77-01', 'Confiserie', 'Fizzy Fruity Fizzles', 'Ces bonbons pétillants explosent en bouche avec des saveurs de fruits tropicaux. Ils offrent une expérience sensorielle unique grâce à leur texture effervescente et leurs couleurs vibrantes.', 'http://localhost:80/onlineshop_light/assets/bonbon2.jpg', 6, 400);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `members` (`id_member`);

--
-- Contraintes pour la table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
