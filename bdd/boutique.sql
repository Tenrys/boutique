-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 25 mars 2020 à 16:27
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `boutique`
--
CREATE DATABASE IF NOT EXISTS `boutique` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `boutique`;

-- --------------------------------------------------------

--
-- Structure de la table `adress`
--

DROP TABLE IF EXISTS `adress`;
CREATE TABLE IF NOT EXISTS `adress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` varchar(500) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `city` varchar(140) NOT NULL,
  `country` varchar(140) NOT NULL,
  `name_adresse` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `basket`
--

DROP TABLE IF EXISTS `basket`;
CREATE TABLE IF NOT EXISTS `basket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(1, 'Nourriture', 'Tout ce qu\'il faut pour remplir vos estomac et cuisiner vos meilleurs plats !'),
(2, 'Equipement', 'Les meilleures armes dont vous avez besoin pour vous défendre face aux Goblins et autre Lynels !'),
(3, 'Vêtements', 'Vous voulez être stylé, vous avez froid, vous souhaiter avoir une meilleure défense ? Vous êtes au bon endroit !'),
(4, 'Divers', 'Encore plus d\'objets pour vous rendre plus fort !');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` date NOT NULL,
  `message` varchar(500) NOT NULL,
  `rate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(140) NOT NULL,
  `description` varchar(500) NOT NULL,
  `img` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `id_subcat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `img`, `price`, `quantity`, `id_subcat`) VALUES
(1, 'Truite Volt', 'Cette truite fraichement pêchée, ravira vos papilles et vous donneras une défense amélioré contre les attaques électriques !', '../img/product/nourriture/poisson/truite-volt.png', 15, 100, 1),
(2, 'Venaison', 'Cette viande fraichement chassée seras votre meilleure alliée pour tout vos petits creux !', '../img/product/nourriture/viande/venaison.png', 120, 100, 2),
(3, 'Champi Armo', 'Ce champignon relevera vos plats et vous donneras en plus un bonus de défense incroyable', '../img/product/nourriture/champignon/champi-armo.png', 80, 100, 3),
(4, 'Baie', 'Cette jolie baie gorgée de soleil ravira vos papilles avec sa douceur !', '../img/product/nourriture/autre/baie.png', 50, 100, 4),
(5, 'Epée de Chevalier', 'Cette épée à deux mains pourfendra vos ennemis sans problème, si vous arrivez à la soulever.', '../img/product/equipement/epee/epee-chevalier.png', 450, 10, 5),
(6, 'Bouclier du Dieu Bestial', 'Ce bouclier, appartenant autrefois à un Dieu Bestial, seras votre meilleure défense contre n\'importe quel coup asséné par l\'ennemi.', '../img/product/equipement/bouclier/bouclier-dieu-bestial', 5500, 3, 6),
(7, 'Fourche Electrique', 'Cette fourche electrifiera tous vos ennemis, à manier avec précaution', '../img/product/equipement/lance/fourche-electrique.png', 1200, 5, 7),
(8, 'Arc Archeonique', 'Cet arc vous permet de viser droit. Extremement droit.', '../img/product/equipement/arc/arc-archeonique.png', 3200, 5, 8),
(9, 'Baguette Electrique', 'Cette baguette electrifiera tous vos ennemis, à manier avec précaution', '../img/product/equipement/divers/baguette-electrique.png', 2300, 2, 9),
(10, 'Armure de soldat', 'Cette armure vous protégera de beaucoup de coups qui auraient pu être fatal,  et vous donneras de la classe par dessus le marché !', '../img/product/vetement/haut/armure-soldat.png', 1500, 4, 10),
(11, 'Chausse furtive', 'Ces chaussures vous conférerons une furtivité hors paire, personne ne pourras vous entendre !', '../img/product/vetement/pantalon/chausse-furtive.png', 1200, 5, 11),
(12, 'Bandana d\'escalade', 'Ce bandana vous aider à escalader plus vite falaises et montagnes !', '../img/product/vetement/coiffes/bandana-escalade', 800, 10, 13),
(13, 'Filet Apparat', 'Ce filet mettra en valeur le museau de votre animal, vous ne passerai pas inaperçu !', '../img/product/divers/harnachement/filet-apparat.png', 1200, 3, 14),
(14, 'Ambre brut', 'Cette ambre au magnifique reflets miel vous seras très utile pendant votre aventure !', '../img/product/divers/minerai/ambre-brut.png', 300, 30, 15),
(15, 'Aile de feu', 'Cette aile de feu est un ingrédient indispensable à toute concoction de remèdes et potions !', '../img/product/divers/ingredients/aile-feu.png', 140, 50, 16);

-- --------------------------------------------------------

--
-- Structure de la table `purchase`
--

DROP TABLE IF EXISTS `purchase`;
CREATE TABLE IF NOT EXISTS `purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_adress` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `purchase_product`
--

DROP TABLE IF EXISTS `purchase_product`;
CREATE TABLE IF NOT EXISTS `purchase_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_purchase` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sub_category`
--

DROP TABLE IF EXISTS `sub_category`;
CREATE TABLE IF NOT EXISTS `sub_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `id_category` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sub_category`
--

INSERT INTO `sub_category` (`id`, `name`, `description`, `id_category`) VALUES
(1, 'Poisson', 'Carpes, saumons, tout le fretin existant se trouve ici !', 1),
(2, 'Viande', 'Venaison, volaille, toute la barbaque existante se trouve ici !', 1),
(3, 'Champignons', 'Coloré et savoureux, tous les champignons existants sont disponibles ici !', 1),
(4, 'Autre', 'Oeuf, miel.. Différents produits pour tous les goûts !', 1),
(5, 'Epée', 'Les épées les plus tranchantes', 2),
(6, 'Bouclier', 'Pour une défense optimale !', 2),
(7, 'Lance', 'Besoin d\'un peu plus d\'allonge ? La lance seras votre meilleure amie !', 2),
(8, 'Arc', 'Vos ennemis sont toujours trop loin ? Achetez un arc !', 2),
(9, 'Divers', 'Masses, flèches, baguette.. ', 2),
(10, 'Haut', 'Les tuniques et haut variés se trouvent ici !', 3),
(11, 'Pantalon', 'Les pantalon les plus confortable pour courir en forêt', 3),
(13, 'Coiffes et masques', 'Les coiffes et les masques les plus élégants !', 3),
(14, 'Harnachement ', 'Tout ce qu\'il faut pour votre cheval favori !', 4),
(15, 'Minerai', 'Rubis, saphir, diamant..', 3),
(16, 'Ingrédients', 'Scarabées et grenouille pour préparer vos meilleures potions !', 3);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `grade` varchar(140) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
