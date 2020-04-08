-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2020 at 11:46 PM
-- Server version: 10.4.12-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `boutique`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `address` varchar(500) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `city` varchar(140) NOT NULL,
  `country` varchar(140) NOT NULL,
  `name_address` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Nourriture', 'Tout ce qu\'il faut pour remplir vos estomac et cuisiner vos meilleurs plats !'),
(2, 'Equipement', 'Les meilleures armes dont vous avez besoin pour vous défendre face aux Goblins et autre Lynels !'),
(3, 'Vêtements', 'Vous voulez être stylé, vous avez froid, vous souhaiter avoir une meilleure défense ? Vous êtes au bon endroit !'),
(4, 'Divers', 'Encore plus d\'objets pour vous rendre plus fort !');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `message` varchar(500) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(140) NOT NULL,
  `description` varchar(500) NOT NULL,
  `img` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `id_subcategory` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `img`, `price`, `quantity`, `id_subcategory`, `date`) VALUES
(1, 'Truite Volt', 'Cette truite fraichement pêchée, ravira vos papilles et vous donneras une défense amélioré contre les attaques électriques !', '../img/products/nourriture/poisson/truite-volt.png', 15, 100, 1, '2020-04-07 23:46:08'),
(2, 'Venaison', 'Cette viande fraichement chassée seras votre meilleure alliée pour tout vos petits creux !', '../img/products/nourriture/viande/venaison.png', 120, 100, 2, '2020-04-07 23:46:08'),
(3, 'Champi Armo', 'Ce champignon relèvera vos plats et vous donnera en plus un bonus de défense incroyable', '../img/products/nourriture/champignon/champi-armo.png', 80, 100, 3, '2020-04-07 23:46:08'),
(4, 'Baie', 'Cette jolie baie gorgée de soleil ravira vos papilles avec sa douceur !', '../img/products/nourriture/autre/baie.png', 50, 100, 4, '2020-04-07 23:46:08'),
(5, 'Epée de Chevalier', 'Cette épée à deux mains pourfendra vos ennemis sans problème, si vous arrivez à la soulever.', '../img/products/equipement/epee/epee-chevalier.png', 450, 10, 5, '2020-04-07 23:46:08'),
(6, 'Bouclier du Dieu Bestial', 'Ce bouclier, appartenant autrefois à un Dieu Bestial, sera votre meilleure défense contre n\'importe quel coup asséné par l\'ennemi.', '../img/products/equipement/bouclier/bouclier-dieu-bestial', 5500, 3, 6, '2020-04-07 23:46:08'),
(7, 'Fourche Electrique', 'Cette fourche électrifiera tous vos ennemis, à manier avec précaution', '../img/products/equipement/lance/fourche-electrique.png', 1200, 5, 7, '2020-04-07 23:46:08'),
(8, 'Arc Archeonique', 'Cet arc vous permet de viser droit. Extrêmement droit.', '../img/products/equipement/arc/arc-archeonique.png', 3200, 5, 8, '2020-04-07 23:46:08'),
(9, 'Baguette Electrique', 'Cette baguette électrifiera tous vos ennemis, à manier avec précaution', '../img/products/equipement/divers/baguette-electrique.png', 2300, 2, 9, '2020-04-07 23:46:08'),
(10, 'Armure de soldat', 'Cette armure vous protégera de beaucoup de coups qui auraient pu être fatal, et vous donneras de la classe par dessus le marché !', '../img/products/vetement/haut/armure-soldat.png', 1500, 4, 10, '2020-04-07 23:46:08'),
(11, 'Chausses furtives', 'Ces chaussures vous conféreront une furtivité hors paire, personne ne pourra vous entendre !', '../img/products/vetement/pantalon/chausses-furtives.png', 1200, 5, 11, '2020-04-07 23:46:08'),
(12, 'Bandana d\'escalade', 'Ce bandana vous aidera à escalader plus vite falaises et montagnes !', '../img/products/vetement/coiffes/bandana-escalade', 800, 10, 13, '2020-04-07 23:46:08'),
(13, 'Filet Apparat', 'Ce filet mettra en valeur le museau de votre animal, vous ne passerez pas inaperçu !', '../img/products/divers/harnachement/filet-apparat.png', 1200, 3, 14, '2020-04-07 23:46:08'),
(14, 'Ambre brut', 'Cette ambre au magnifique reflets miel vous sera très utile pendant votre aventure !', '../img/products/divers/minerai/ambre-brut.png', 300, 30, 15, '2020-04-07 23:46:08'),
(15, 'Aile de feu', 'Cette aile de feu est un ingrédient indispensable à toute concoction de remèdes et potions !', '../img/products/divers/ingredients/aile-feu.png', 140, 50, 16, '2020-04-07 23:46:08');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_address` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `method` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchases_products`
--

CREATE TABLE `purchases_products` (
  `id` int(11) NOT NULL,
  `id_purchase` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `description`, `id_category`) VALUES
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `lastname`, `firstname`, `email`, `password`, `rank`) VALUES
(1, 'Maubert', 'Marceau', 'marceau.maubert@laplateforme.io', 'test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`) USING BTREE;

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`) USING BTREE,
  ADD KEY `id_user` (`id_user`) USING BTREE;

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_subcategory` (`id_subcategory`) USING BTREE;

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`) USING BTREE,
  ADD KEY `id_address` (`id_address`) USING BTREE;

--
-- Indexes for table `purchases_products`
--
ALTER TABLE `purchases_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_purchase` (`id_purchase`) USING BTREE,
  ADD KEY `id_product` (`id_product`) USING BTREE;

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`) USING BTREE,
  ADD KEY `id_product` (`id_product`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases_products`
--
ALTER TABLE `purchases_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_subcategory`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchases_ibfk_2` FOREIGN KEY (`id_address`) REFERENCES `address` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchases_products`
--
ALTER TABLE `purchases_products`
  ADD CONSTRAINT `purchases_products_ibfk_1` FOREIGN KEY (`id_purchase`) REFERENCES `purchases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchases_products_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
