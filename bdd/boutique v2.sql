-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 08 avr. 2020 à 13:53
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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `adress`
--

INSERT INTO `adress` (`id`, `adresse`, `zip_code`, `city`, `country`, `name_adresse`, `id_user`) VALUES
(1, '6 rue du docteur laÃ«nnec', 13005, 'Marseille', 'France', 'Maman5', 1),
(3, '3 rue du chapelier', 13012, 'marseille', 'france', 'Papa', 1),
(5, '3 rue test', 12005, 'ailleurs', 'loin', 'Test', 1),
(6, '6 rue du docteur laÃ«nnec', 13005, 'Marseille', 'France', 'Maman3', 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(1, 'Nourriture', 'Tout ce qu\'il faut pour remplir vos estomac et cuisiner vos meilleurs plats !'),
(2, 'Equipement', 'Les meilleures armes dont vous avez besoin pour vous dÃ©fendre face aux Goblins et autre Lynels !'),
(3, 'VÃªtements', 'Vous voulez Ãªtre stylÃ©, vous avez froid, vous souhaiter avoir une meilleure dÃ©fense ? Vous Ãªtes au bon endroit !'),
(4, 'Divers', 'Tout ce qui peut se collectionner ou Ãªtre minÃ© se trouve ici !');

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
  `date` date NOT NULL DEFAULT '2020-04-08',
  `id_subcat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `img`, `price`, `quantity`, `date`, `id_subcat`) VALUES
(1, 'Truite Volt', 'Cette truite fraichement pÃªchÃ©e, ravira vos papilles et vous donneras une dÃ©fense amÃ©liorÃ©e contre les attaques Ã©lectriques !', 'img/product/nourriture/poisson/truite-volt.png', 15, 100, '2020-04-08', 1),
(2, 'Venaison', 'Cette viande fraichement chassÃ©e seras votre meilleure alliÃ©e pour tout vos petits creux !', 'img/product/nourriture/viande/venaison.png', 120, 100, '2020-04-08', 2),
(3, 'Champi Armo', 'Ce champignon relevera vos plats et vous donneras en plus un bonus de dÃ©fense incroyable', 'img/product/nourriture/champignons/champi-armo.png', 80, 100, '2020-04-08', 3),
(4, 'Baie', 'Cette jolie baie gorgÃ©e de soleil ravira vos papilles avec sa douceur !', 'img/product/nourriture/autre/baie.png', 50, 100, '2020-04-08', 4),
(5, 'EpÃ©e de Chevalier', 'Cette Ã©pÃ©e Ã  deux mains pourfendra vos ennemis sans problÃ¨me, si vous arrivez Ã  la soulever.', 'img/product/equipements/epee/epee-chevalier.png', 500, 10, '2020-04-08', 5),
(6, 'Bouclier du Dieu Bestial', 'Ce bouclier, appartenant autrefois à un Dieu Bestial, seras votre meilleure défense contre n\'importe quel coup asséné par l\'ennemi.', 'img/product/equipements/bouclier/bouclier-dieu-bestial.png', 5500, 3, '2020-04-08', 6),
(7, 'Fourche Electrique', 'Cette fourche electrifiera tous vos ennemis, Ã  manier avec prÃ©caution', 'img/product/equipements/lance/fourche-electrique.png', 1200, 5, '2020-04-08', 7),
(8, 'Arc Archeonique', 'Cet arc vous permet de viser droit. ExtrÃªmement droit.', 'img/product/equipements/arc/arc-archeonique.png', 3200, 5, '2020-04-08', 8),
(9, 'Baguette Electrique', 'Cette baguette electrifiera tous vos ennemis, Ã  manier avec prÃ©caution', 'img/product/equipements/divers/baguette-electrique.png', 2300, 2, '2020-04-08', 9),
(10, 'Armure de soldat', 'Cette armure vous protÃ¨gera de beaucoup de coups qui auraient pu Ãªtre fatal,  et vous donneras de la classe par dessus le marchÃ© !', 'img/product/vetements/haut/armure-soldat.png', 1500, 4, '2020-04-08', 10),
(11, 'Chausse furtive', 'Ces chaussures vous confÃ¨rerons une furtivitÃ© hors pair, personne ne pourras vous entendre !', 'img/product/vetements/pantalon/chausses-furtives.png', 1200, 5, '2020-04-08', 11),
(12, 'Bandana d\'escalade', 'Ce bandana vous aider à escalader plus vite falaises et montagnes !', 'img/product/vetements/coiffes/bandana-escalade', 800, 10, '2020-04-08', 13),
(13, 'Filet Apparat', 'Ce filet mettra en valeur le museau de votre animal, vous ne passerai pas inaperçu !', 'img/product/divers/harnachement/filet-apparat.png', 1200, 3, '2020-04-08', 14),
(14, 'Ambre brut', 'Cette ambre au magnifique reflets miel vous seras trÃ©s utile pendant votre aventure !', 'img/product/divers/minerai/ambre-brut.png', 300, 30, '2020-04-08', 15),
(15, 'Aile de feu', 'Cette aile de feu est un ingrÃ©dient indispensable Ã  toute concoction de remÃ¨des et potions !', 'img/product/divers/ingredients/aile-feu.png', 140, 50, '2020-04-08', 16),
(17, 'Perche enduro', 'La perche enduro vous donneras une endurance supplÃ©mentaire !', 'img/product/nourriture/poisson/perche-enduro.png', 340, 10, '2020-04-08', 1);

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
  `means` varchar(140) NOT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sub_category`
--

INSERT INTO `sub_category` (`id`, `name`, `description`, `id_category`) VALUES
(1, 'Poisson', 'Carpes, saumons, tout le fretin existant se trouve ici !', 1),
(2, 'Viande', 'Venaison, volaille, toute la barbaque existante se trouve ici !', 1),
(3, 'Champignons', 'ColorÃ©s et savoureux, tous les champignons existants sont disponibles ici !', 1),
(4, 'Autre', 'Oeuf, miel.. DiffÃ©rents produits pour tous les goÃ»ts !', 1),
(5, 'EpÃ©e', 'Les Ã©pÃ©es les plus tranchantes', 2),
(6, 'Bouclier', 'Pour une dÃ©fense optimale !', 2),
(7, 'Lance', 'Besoin d\'un peu plus d\'allonge ? La lance seras votre meilleure amie !', 2),
(8, 'Arc', 'Vos ennemis sont toujours trop loin ? Achetez un arc !', 2),
(9, 'Divers', 'Masses, flÃ¨ches, baguette.. ', 2),
(10, 'Haut', 'Les tuniques et haut variÃ©s se trouvent ici !', 3),
(11, 'Pantalon', 'Les pantalon les plus confortable pour courir en forÃªt', 3),
(13, 'Coiffes et masques', 'Les coiffes et les masques les plus Ã©lÃ©gants !', 3),
(14, 'Harnachement ', 'Tout ce qu\'il faut pour votre cheval favori !', 4),
(15, 'Minerai', 'Rubis, saphir, diamant..', 4),
(16, 'IngrÃ©dients', 'ScarabÃ©es et grenouille pour prÃ©parer vos meilleures potions !', 4);

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
  `birthday` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `grade` varchar(140) NOT NULL,
  `point` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `lastname`, `firstname`, `mail`, `birthday`, `password`, `grade`, `point`) VALUES
(1, 'Admin', 'Admin', 'admin@admin.fr', '2020-04-23', '$2y$15$Fbxvv9xYqdCRUUQdlbI.gef2IZguSuv1/81WUmalKi6DSDKUGdJwq', 'admin', 100),
(2, 'Jean', 'Michel', 'jm@jm.fr', '2020-04-15', '$2y$15$9fHmaf1FqTOuu2GiGUqRdOQ9STD9YRQCSDaz9Je4cOjJhe2oMUFou', 'membre', 100);

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `wishlist`
--

INSERT INTO `wishlist` (`id`, `id_user`, `id_product`) VALUES
(1, 1, 4),
(2, 1, 6);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
