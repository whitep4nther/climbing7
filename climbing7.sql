-- phpMyAdmin SQL Dump
-- version 4.4.13.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jan 11, 2016 at 11:14 AM
-- Server version: 5.6.26
-- PHP Version: 5.5.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `climbing7`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Climbing'),
(2, 'Ferrata'),
(3, 'Canyoning'),
(4, 'Trekking');

-- --------------------------------------------------------

--
-- Table structure for table `medias`
--

CREATE TABLE IF NOT EXISTS `medias` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `folder_id` int(11) NOT NULL DEFAULT '0',
  `filename` varchar(500) NOT NULL,
  `full_path` varchar(1000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medias`
--

INSERT INTO `medias` (`id`, `title`, `folder_id`, `filename`, `full_path`) VALUES
(42, '01-wadi-tiwi-perspective', 27, '01-wadi-tiwi-perspective.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/01-wadi-tiwi-perspective.jpg'),
(43, '02-accc3a8s-au-canyon', 27, '02-accc3a8s-au-canyon.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/02-accc3a8s-au-canyon.jpg'),
(44, '03-nos-guides-locaux', 27, '03-nos-guides-locaux.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/03-nos-guides-locaux.jpg'),
(45, '04-umq-bir', 27, '04-umq-bir.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/04-umq-bir.jpg'),
(46, '05-depuis-lentrc3a9e-du-canyon', 27, '05-depuis-lentrc3a9e-du-canyon.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/05-depuis-lentrc3a9e-du-canyon.jpg'),
(47, '06-entrc3a9e-du-canyon', 27, '06-entrc3a9e-du-canyon.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/06-entrc3a9e-du-canyon.jpg'),
(48, '07-1er-rappel-15m', 27, '07-1er-rappel-15m.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/07-1er-rappel-15m.jpg'),
(49, '08-sur-une-rive-blanche', 27, '08-sur-une-rive-blanche.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/08-sur-une-rive-blanche.jpg'),
(50, '09-suivre-la-rive-c3a9troite', 27, '09-suivre-la-rive-c3a9troite.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/09-suivre-la-rive-c3a9troite.jpg'),
(51, '10-perspective', 27, '10-perspective.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/10-perspective.jpg'),
(52, '11-entrc3a9e-de-la-cave', 27, '11-entrc3a9e-de-la-cave.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/11-entrc3a9e-de-la-cave.jpg'),
(53, '12-douche', 27, '12-douche.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/12-douche.jpg'),
(54, '13-dans-la-cave', 27, '13-dans-la-cave.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/13-dans-la-cave.jpg'),
(55, '14-sous-la-cave', 27, '14-sous-la-cave.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/14-sous-la-cave.jpg'),
(56, '15-sortie-de-la-cave', 27, '15-sortie-de-la-cave.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/15-sortie-de-la-cave.jpg'),
(57, '16-paradisiaque', 27, '16-paradisiaque.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/16-paradisiaque.jpg'),
(58, '17-juste-aprc3a8s-la-cave', 27, '17-juste-aprc3a8s-la-cave.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/17-juste-aprc3a8s-la-cave.jpg'),
(59, '18-essai-des-palmes', 27, '18-essai-des-palmes.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/18-essai-des-palmes.jpg'),
(60, '19-c3a7a-continue', 27, '19-c3a7a-continue.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/19-c3a7a-continue.jpg'),
(61, '20-eau-verte', 27, '20-eau-verte.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/20-eau-verte.jpg'),
(62, '21-siphon-c3a0-gauche', 27, '21-siphon-c3a0-gauche.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/21-siphon-c3a0-gauche.jpg'),
(63, '22-nouveau-saut', 27, '22-nouveau-saut.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/22-nouveau-saut.jpg'),
(64, '23-plus-loin-toujours-magnifique', 27, '23-plus-loin-toujours-magnifique.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/23-plus-loin-toujours-magnifique.jpg'),
(65, '24-toujours-nager', 27, '24-toujours-nager.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/24-toujours-nager.jpg'),
(66, '25-sculpture', 27, '25-sculpture.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/25-sculpture.jpg'),
(67, '26-suivre-le-cours-de-leau', 27, '26-suivre-le-cours-de-leau.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/26-suivre-le-cours-de-leau.jpg'),
(68, '27-encore-un-joli-saut', 27, '27-encore-un-joli-saut.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/27-encore-un-joli-saut.jpg'),
(69, '28-lueur-au-bout', 27, '28-lueur-au-bout.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/28-lueur-au-bout.jpg'),
(70, '29-sortie-vers-mibam', 27, '29-sortie-vers-mibam.jpg', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/29-sortie-vers-mibam.jpg'),
(72, 'happysenior1', 27, 'happysenior1.png', '/2015/Wadi-Tiwi-Hajar-oriental-Oman/happysenior1.png');

-- --------------------------------------------------------

--
-- Table structure for table `medias_to_posts`
--

CREATE TABLE IF NOT EXISTS `medias_to_posts` (
  `id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `identifier` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medias_to_posts`
--

INSERT INTO `medias_to_posts` (`id`, `media_id`, `post_id`, `identifier`) VALUES
(1, 42, 3, 'gallery'),
(2, 43, 3, 'gallery'),
(3, 44, 3, 'gallery'),
(4, 45, 3, 'gallery'),
(5, 46, 3, 'gallery'),
(6, 47, 3, 'gallery'),
(7, 48, 3, 'gallery'),
(8, 49, 3, 'gallery'),
(9, 50, 3, 'gallery'),
(10, 51, 3, 'gallery'),
(11, 52, 3, 'gallery'),
(12, 53, 3, 'gallery'),
(13, 54, 3, 'gallery'),
(14, 55, 3, 'gallery'),
(15, 56, 3, 'gallery'),
(16, 57, 3, 'gallery'),
(17, 58, 3, 'gallery'),
(18, 59, 3, 'gallery'),
(19, 60, 3, 'gallery'),
(20, 61, 3, 'gallery'),
(21, 62, 3, 'gallery'),
(22, 63, 3, 'gallery'),
(23, 64, 3, 'gallery'),
(24, 65, 3, 'gallery'),
(25, 66, 3, 'gallery'),
(26, 67, 3, 'gallery'),
(27, 68, 3, 'gallery'),
(28, 69, 3, 'gallery'),
(29, 70, 3, 'gallery');

-- --------------------------------------------------------

--
-- Table structure for table `media_folders`
--

CREATE TABLE IF NOT EXISTS `media_folders` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT '0',
  `path` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `media_folders`
--

INSERT INTO `media_folders` (`id`, `title`, `slug`, `parent_id`, `path`) VALUES
(26, '2015', '2015', 0, '/2015'),
(27, 'Wadi Tiwi, Hajar oriental, Oman ✯✯✯', 'Wadi-Tiwi-Hajar-oriental-Oman', 26, '/2015/Wadi-Tiwi-Hajar-oriental-Oman');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `presentation` text NOT NULL,
  `rate` tinyint(4) NOT NULL,
  `category_id` int(11) NOT NULL,
  `country` varchar(500) NOT NULL,
  `region` varchar(500) NOT NULL,
  `site` varchar(500) NOT NULL,
  `cover_id` int(11) NOT NULL,
  `access` text NOT NULL,
  `approach` text NOT NULL,
  `parcours` text NOT NULL,
  `back` text NOT NULL,
  `characteristics` text NOT NULL,
  `topo_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `label`, `presentation`, `rate`, `category_id`, `country`, `region`, `site`, `cover_id`, `access`, `approach`, `parcours`, `back`, `characteristics`, `topo_id`, `date`) VALUES
(3, 'Wadi Tiwi, Hajar oriental, Oman ✯✯✯', '																																																																																												Le plus beau canyon d’Oman ? Probablement l’un des plus esthétiques pour les yeux: depuis le petit village d’Umq Bir, le wadi Tiwi forme sur 6 kilomètres un splend', '																																																																Le plus beau canyon d’Oman ? Probablement l’un des plus esthétiques pour les yeux: depuis le petit village d’Umq Bir, le wadi Tiwi forme sur 6 kilomètres un splendide couloir de roche blanche au fond d’un défilé impressionnant de parois orangées avant de s’ouvrir sur Mibam et de filer vers la mer d’Oman. Canyon très aquatique avec d’innombrables vasques et longs biefs à nager dans une eau bleue ou verte verte, un passage incroyable au coeur d’une cave sous cascade, le décor est absolument fantastique. Compter au moins 7h dans le canyon, et pour un groupe de 4, 8h à 9h pour rejoindre Mibam depuis le départ. Sans vraiment d’obstacle ni de difficulté si ce n’est des épaules solides pour nager des centaines de mètres, c’est en quelque sorte de la randonnée aquatique très haut de gamme. Un canyon exceptionnel !\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			', 3, 3, 'Test', '', '', 0, '																																																																																												Accès (2h à 3h selon état de la route)\r\nC’est là que c’est compliqué: il faut organiser le retour (ou l’aller) depuis Mibam. Étant 2, nous avons été à Umq Bir la veille et réservé un taxi pour retour le lendemain (70 rials). Sur la route 17 qui va de Quryat à Sur, passer Tiwi, puis Qalhat et juste après, tourner à droite avant un grand pont (évident). Suivre cette piste qui monte raide et plus haut tourner à droite vers Hallout. Continuer un moment sur une sorte de plateau avant de monter pour passer une épaule montagneuse et plonger vers Hallout (très beau point de vue sur Tiwi un peu avant à droite). Passer le village et continuer en descendant vers le wadi au fond (Tiwi déjà). Tourner à droite et passer dans le village de Wadi Bir. Suivre dans le lit du torrent pour attraper la piste qui monte coté droit. Cette piste impressionnante est en très très mauvais état actuellement. La suivre pour redescendre à nouveau très raide et croiser à nouveau le lit du wadi. Poursuivre encore un peu jusqu’au bout de la route. On peut se garer et camper. On est juste au dessus d’Umq Bir et on voit l’entrée du canyon.\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			', '																																																																																												Approche (30′ à 45′)\r\nDe façon directe, descendre sur l’ancienne piste défoncée puis tracer directement vers l’entrée en se faufilant entre terrasses et blocs pour rejoindre les dalles blanches. Sauter dans la 1ère grande vasque pour filer vers l’entrée les pieds dans l’eau.\r\nSinon, plus confortable, depuis le parking, prendre un sentier marqué à droite d’un arbre et qui mène au village en bas. Le traverser et poursuivre sur le flanc droit pour rejoindre un autre petit bout de village plus bas et descendre enfin pour rejoindre directement l’entrée (mieux se faire guider par un gamin du village, qui sera heureux de vous montrer le meilleur chemin !)\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			', '																																																																																												Parcours (7h à 8h)\r\nBasiquement, il suffit de suivre le lit du torrent et surtout de nager, beaucoup nager ! La combinaison est utile surtout en hiver, mais aussi pour protéger genoux et coudes, d’autant plus que l’on reste à l’ombre tout le temps. Les biefs à nager sont très nombreux et certains très longs (200 ou 300m peut-être). Prévoir une corde de 40m et de quoi ré-équipéer les 2 rappels obligatoires (sangles, maillons rapides, pitons et tamponnoir..). Le passage de la cave peut se contourner par le haut pour faire un rappel de 40m, donc dans ce cas prévoir 2x40m (mais le passage dans la cave est exceptionnel, à ne pas manquer !). De nombreux sauts à faire entre 2m et 5m dont 1 semble-t-il obligatoire.Rappel 1 (15m)\r\nAssez rapidement, sur un gros bloc, coté droit. l’équipement à souffert: 1 spit en état moyen seulement.Rappel 2 (5m)\r\nPlus loin coté gauche mais évitable avec un saut de 5m environ (points non vérifiés).Rappel 3 (dans la cave, 15m)\r\nAprès 2h30 de marche et de nage environ. Entrée fabuleuse sous une cascade puis entrée dans la pénombre. Le relais est posé sur des sangles autour d’un bloc coté droit (à vérifier et éventuellement doubler). On part alors dans un toboggan qui finit au fond dans l’eau. La sortie en nageant est exceptionnelle. de l’autre coté un bassin vert bleu et des cascades d’eau tiède.. le paradis.Le siphon\r\nLe repère suivant est le passage au niveau d’un siphon géant à gauche après 5h30 de progression. \r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			', '																																																																																												Sortie et retour (30′ à 45′)\r\nAprès un coude à droite et un dernier grand virage à gauche, le canyon s’ouvre sur une vallée plus large. Repérer un grande cave (ou plutôt un large cassure qui forme une voute) sous la paroi coté gauche et passer dessous pour trouver le sentier. Monter coté gauche pour rester au dessus du wadi et surtout ne pas aller dans le lit du wadi, où il est très difficile de progresser vu la quantité de blocs énormes. Le sentier est plus ou moins marqué (quelques cairns) au début mais ensuite bien tracé pour filer vite et sans problème jusqu’au village de Mibam (pick up final). Compter ensuite encore au moins 2h30 à 3h de route et de piste pour revenir à Umq Bir.D’autres options semblent possible pour gérer les trajets (à tester):\r\n1. Camper à Mibam et se faire amener à Umq Bir le matin tôt, ce qui évite la remontée après le canyon. Cependant, on rate la possibilité d’explorer le magnifique petit village d’Umq Bir.\r\n2. Apparemment, il y aurait un sentier de Mibam à Umq Bir par les crêtes qui permettrait de faire le retour à pied (à vérifier ?). Dans ce cas, camper à Mibam, faire le sentier le matin par exemple et descendre le canyon dans la foulée (grosse journée !)\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			', '																																																																																												\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			', 0, '2015-04-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medias`
--
ALTER TABLE `medias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medias_to_posts`
--
ALTER TABLE `medias_to_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_folders`
--
ALTER TABLE `media_folders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `medias`
--
ALTER TABLE `medias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `medias_to_posts`
--
ALTER TABLE `medias_to_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `media_folders`
--
ALTER TABLE `media_folders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
