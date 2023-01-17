-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 17 jan. 2023 à 17:51
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `madeth`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int NOT NULL AUTO_INCREMENT,
  `name_client` varchar(50) DEFAULT NULL,
  `address_client` varchar(100) NOT NULL,
  `facebook` varchar(50) DEFAULT NULL,
  `instagram` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tel` varchar(10) DEFAULT NULL,
  `total_point` int DEFAULT NULL,
  `ultimate` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `name_client`, `address_client`, `facebook`, `instagram`, `email`, `tel`, `total_point`, `ultimate`) VALUES
(1, 'jean michel', '1 rue de la bdd', NULL, '6+5', 'jm@mail.com', '4586957845', 100, 0),
(2, 'clément jamelot', 'rue du pouet', NULL, NULL, 'cjj@mail.fr', NULL, 500, 1),
(3, 'zeiof', 'fdhyht', NULL, NULL, NULL, NULL, 800, 0);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id_commande` int NOT NULL AUTO_INCREMENT,
  `date_commande` datetime DEFAULT CURRENT_TIMESTAMP,
  `delevery_fee` int DEFAULT NULL,
  `status_commande` varchar(50) DEFAULT NULL,
  `date_delevery` date DEFAULT NULL,
  `date_send` date DEFAULT NULL,
  `id_consierge` int DEFAULT NULL,
  `id_client` int DEFAULT NULL,
  PRIMARY KEY (`id_commande`),
  KEY `id_consierge` (`id_consierge`),
  KEY `id_client` (`id_client`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `date_commande`, `delevery_fee`, `status_commande`, `date_delevery`, `date_send`, `id_consierge`, `id_client`) VALUES
(1, '2023-01-17 15:33:56', NULL, NULL, NULL, NULL, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `concern`
--

DROP TABLE IF EXISTS `concern`;
CREATE TABLE IF NOT EXISTS `concern` (
  `id_concern` int NOT NULL AUTO_INCREMENT,
  `id_commande` int DEFAULT NULL,
  `id_invoice` int DEFAULT NULL,
  PRIMARY KEY (`id_concern`),
  KEY `id_commande` (`id_commande`),
  KEY `id_invoice` (`id_invoice`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `concierge`
--

DROP TABLE IF EXISTS `concierge`;
CREATE TABLE IF NOT EXISTS `concierge` (
  `id_concierge` int NOT NULL AUTO_INCREMENT,
  `nom_concierge` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_concierge`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `concierge`
--

INSERT INTO `concierge` (`id_concierge`, `nom_concierge`) VALUES
(1, 'con1');

-- --------------------------------------------------------

--
-- Structure de la table `contains`
--

DROP TABLE IF EXISTS `contains`;
CREATE TABLE IF NOT EXISTS `contains` (
  `id_contains` int NOT NULL AUTO_INCREMENT,
  `quantity_contains` int DEFAULT NULL,
  `unit_price` int DEFAULT NULL,
  `service_charge` int DEFAULT NULL,
  `id_commande` int DEFAULT NULL,
  `id_stock` int DEFAULT NULL,
  `id_direct` int DEFAULT NULL,
  PRIMARY KEY (`id_contains`),
  KEY `id_commande` (`id_commande`),
  KEY `id_stock` (`id_stock`),
  KEY `id_direct` (`id_direct`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `contains`
--

INSERT INTO `contains` (`id_contains`, `quantity_contains`, `unit_price`, `service_charge`, `id_commande`, `id_stock`, `id_direct`) VALUES
(1, 2, 15, NULL, 1, NULL, 1),
(2, 1, 2, NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `historical`
--

DROP TABLE IF EXISTS `historical`;
CREATE TABLE IF NOT EXISTS `historical` (
  `id_historique` int NOT NULL AUTO_INCREMENT,
  `date_hist` date DEFAULT NULL,
  `nb_use` int DEFAULT NULL,
  `id_client` int DEFAULT NULL,
  `id_use_point` int DEFAULT NULL,
  PRIMARY KEY (`id_historique`),
  KEY `id_client` (`id_client`),
  KEY `id_use_point` (`id_use_point`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `id_invoice` int NOT NULL AUTO_INCREMENT,
  `date_invoice` date DEFAULT NULL,
  `last_modif` date DEFAULT NULL,
  PRIMARY KEY (`id_invoice`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `management`
--

DROP TABLE IF EXISTS `management`;
CREATE TABLE IF NOT EXISTS `management` (
  `id_management` int NOT NULL AUTO_INCREMENT,
  `id_client` int DEFAULT NULL,
  `id_concierge` int DEFAULT NULL,
  PRIMARY KEY (`id_management`),
  KEY `id_concierge` (`id_concierge`),
  KEY `id_client` (`id_client`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `membership`
--

DROP TABLE IF EXISTS `membership`;
CREATE TABLE IF NOT EXISTS `membership` (
  `id_membership` int NOT NULL AUTO_INCREMENT,
  `min_point` int DEFAULT NULL,
  `max_point` int DEFAULT NULL,
  `type_member` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_membership`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `membership`
--

INSERT INTO `membership` (`id_membership`, `min_point`, `max_point`, `type_member`) VALUES
(1, 0, 300, 'Silver'),
(2, 300, 700, 'Gold'),
(3, 700, NULL, 'Platinium');

-- --------------------------------------------------------

--
-- Structure de la table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id_payment` int NOT NULL AUTO_INCREMENT,
  `amout` int DEFAULT NULL,
  `date_payment` date DEFAULT NULL,
  `deposit` tinyint(1) DEFAULT NULL,
  `id_type` int DEFAULT NULL,
  PRIMARY KEY (`id_payment`),
  KEY `id_type` (`id_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `point`
--

DROP TABLE IF EXISTS `point`;
CREATE TABLE IF NOT EXISTS `point` (
  `id_point` int NOT NULL AUTO_INCREMENT,
  `nb_point` int DEFAULT NULL,
  `expery_date` date DEFAULT NULL,
  `id_client` int DEFAULT NULL,
  PRIMARY KEY (`id_point`),
  KEY `id_client` (`id_client`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `point`
--

INSERT INTO `point` (`id_point`, `nb_point`, `expery_date`, `id_client`) VALUES
(1, 50, '2023-06-23', 2);

-- --------------------------------------------------------

--
-- Structure de la table `productdirect`
--

DROP TABLE IF EXISTS `productdirect`;
CREATE TABLE IF NOT EXISTS `productdirect` (
  `id_direct` int NOT NULL AUTO_INCREMENT,
  `direct_name` varchar(50) DEFAULT NULL,
  `direct_desc` varchar(200) DEFAULT NULL,
  `direct_sell_price` int DEFAULT NULL,
  `direct_statu` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_direct`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `productstock`
--

DROP TABLE IF EXISTS `productstock`;
CREATE TABLE IF NOT EXISTS `productstock` (
  `id_stock` int NOT NULL AUTO_INCREMENT,
  `stock_name` varchar(50) DEFAULT NULL,
  `stock_desc` varchar(200) DEFAULT NULL,
  `stock_sell_price` int DEFAULT NULL,
  `stock_quantity` int DEFAULT NULL,
  PRIMARY KEY (`id_stock`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ruler`
--

DROP TABLE IF EXISTS `ruler`;
CREATE TABLE IF NOT EXISTS `ruler` (
  `id_ruler` int NOT NULL AUTO_INCREMENT,
  `id_invoice` int DEFAULT NULL,
  `id_payment` int DEFAULT NULL,
  PRIMARY KEY (`id_ruler`),
  KEY `id_invoice` (`id_invoice`),
  KEY `id_payment` (`id_payment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sells`
--

DROP TABLE IF EXISTS `sells`;
CREATE TABLE IF NOT EXISTS `sells` (
  `is_sells` int NOT NULL AUTO_INCREMENT,
  `purchase_date` date DEFAULT NULL,
  `purchase_price` int DEFAULT NULL,
  PRIMARY KEY (`is_sells`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `id_supplier` int NOT NULL AUTO_INCREMENT,
  `name_supplier` varchar(100) DEFAULT NULL,
  `address_supplier` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `take_care`
--

DROP TABLE IF EXISTS `take_care`;
CREATE TABLE IF NOT EXISTS `take_care` (
  `id_take_care` int NOT NULL AUTO_INCREMENT,
  `id_client` int DEFAULT NULL,
  `id_consierge` int DEFAULT NULL,
  PRIMARY KEY (`id_take_care`),
  KEY `id_client` (`id_client`),
  KEY `id_consierge` (`id_consierge`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type_payment`
--

DROP TABLE IF EXISTS `type_payment`;
CREATE TABLE IF NOT EXISTS `type_payment` (
  `id_type` int NOT NULL AUTO_INCREMENT,
  `name_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `use_point`
--

DROP TABLE IF EXISTS `use_point`;
CREATE TABLE IF NOT EXISTS `use_point` (
  `id_use_point` int NOT NULL AUTO_INCREMENT,
  `nb_point_min` int DEFAULT NULL,
  `valeur_points` int DEFAULT NULL,
  `percentage` int DEFAULT NULL,
  `end_promo` date DEFAULT NULL,
  PRIMARY KEY (`id_use_point`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
