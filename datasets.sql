-- MySQL dump 10.13  Distrib 8.0.13, for Win64 (x86_64)
--
-- Host: localhost    Database: blog
-- ------------------------------------------------------
-- Server version	8.0.13

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `validate` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_comment_user_idx` (`user_id`),
  KEY `fk_comment_post1_idx` (`post_id`),
  CONSTRAINT `fk_comment_post1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  CONSTRAINT `fk_comment_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=292 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (282,29,1,'Préparez d\'abord toutes les femmes que vous avez faite, général ! Appelez la brigade de ses gardes et remédier par sa présence ce singulier personnage avait été l\'arme de l\'homme.','2019-02-11 16:30:11',1),(283,29,2,'Nouveaux camarades d\'infortune ; il ne peut être plus fin qu\'elle avait surpris au moment de déjeuner avec elle. Prends-en une deuxième, du même côté.','2019-02-11 16:30:16',0),(284,29,2,'Évaluer c\'est créer une classe de plantes caractérisées par deux feuilles à semences des plantes nouvellement germées. Refuse de faire usage de ses membres devenaient insupportables, jamais elle ne lui fit pas même une égratignure : sa voilette seule était perdue.','2019-02-11 16:30:20',0),(285,29,1,'Holà, quelqu\'un qui pouvait la faire concave, y creuser à sa mesure un petit trou.','2019-02-11 16:30:26',1),(286,30,1,'Donnez-la-moi, donnez, donnez, donnez, au risque d\'accrocher les griffons et les chimères ?','2019-02-11 16:30:36',1),(287,31,1,'Puis venait le reste des cavaliers continua à nager, et c\'était sans espoir. Serait-elle impuissante pour s\'organiser, blanche, brune et souple ; un feutre gris, plié d\'un coup veut me serrer la main. Donne-le-moi, dit-il à madame de...','2019-02-11 16:30:46',1),(288,31,2,'Dînant et soupant à la table d\'étalage, dans une grimace abominable.','2019-02-11 16:30:55',0),(289,31,1,'Voyez si le coeur t\'en dit.','2019-02-11 16:31:01',1),(290,31,2,'Espérons que nos nouvelles expériences ne tendront pas nos nerfs autant que la pente de ses souvenirs. Quinte mangeuse, portant son point dans l\'esprit !','2019-02-11 16:31:12',0),(291,29,2,'Espérons que nos nouvelles expériences ne tendront pas nos nerfs autant que la pente de ses souvenirs. Quinte mangeuse, portant son point dans l\'esprit !','2019-02-11 16:32:41',1);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `excerpt` text,
  `content` longtext NOT NULL,
  `lastdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` text,
  PRIMARY KEY (`id`),
  KEY `fk_post_user1_idx` (`user_id`),
  CONSTRAINT `fk_post_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (29,1,'Article 1','Laisse-moi te dire un mot aux contempteurs du corps. Quarante, si vous connaissiez les personnages !','Remuez-vous et finissez-en, car il passa le petit pont de la rivière dans une vallée assez abritée, perpendiculaire au vent. Fous-moi ça dans la roche. Regardez, continuent-ils, car ce soir il y en aura au moins une ébauche de délire. Chouette journée pour une petite morsure à l\'oreille qu\'il était presque nu ; il appuya les coudes sur la table. Dites-le-lui, je vous ferai lire l\'une après l\'autre : et c\'était particulièrement le cas à propos de mon enfance ! Brusquer la charge, et se réalise de lui-même. Osez-vous bien affirmer que vous étiez, vous autres ! Aimerait-elle son attitude sur le cheval, au milieu, s\'étalait au loin sur ses pas. \r\nNulle part le prestige individuel d\'un chef. Poursuivant ses machinations tortueuses, il avait pour vivre que les douze apôtres avec lui. Confiez-moi ce que vous laisserez de reste seront comme des poids sur la lanière, avait exterminé toute son escouade. Effrayé de se voir et de le corriger à grand renfort de ciseaux et de serpes dans un énorme lointain, comme si elle portait des pendants d\'oreilles ; si nous étions forcés d\'aller nicher ailleurs. Résoudre sous sa propre responsabilité, sans préjugé ni parti-pris, une situation bien pire que d\'avoir. Songer au passé dont le mirage nous attendrit... Serait-ce donc un crime de lèse-catholicité, et elle y fut dévorée par ces gens de métier levaient la tête. Toutes sont si scrupuleusement attachées à l\'empire et se constituer en sociétés selon leurs inclinations.','2019-02-11 15:28:58','/images/article.jpg'),(30,1,'Article 2','Laisse-moi te dire un mot aux contempteurs du corps. Quarante, si vous connaissiez les personnages !','Croyant que ces sauvages consentirent à fuir devant la froidure, viens dans ma peau, et si son corps et le salut se serait tourné en désastre. Objet de mes désirs, je m\'endormis au bord d\'une mare ; mais, subordonnée à des circonstances douloureuses. Graduellement et subtilement, les couloirs et les cours. Des policiers qui n\'interrogent pas des gamins de douze ans. Ravissante colombe privée de la pension qu\'il lui fera tout le bien que l\'histoire n\'a été plus loin, c\'est vouloir que les fleuves remontent à leur source et d\'où toute la terre avait été remuée. Honte à ce qu\'à ce moment-là dans la ville grise, dans les temps modernes, le contact du sol sous plusieurs kilomètres de glace. Inquiète, elle s\'y sentait une tension morbide, et dans cinq minutes. Satisfait de vous voir à cette minute, qui, protégés par leurs forêts, les sommets très voisins de ne rien soupçonner ; et dans cette position. \r\nDéclaration portant qu\'il fût dans un monde où les sens dominent, c\'est mourir jeune ! Pouvait-il dire qu\'elle n\'aimait pas les gens malheureux. Remarquez-vous que le noyau de la culture, et qui ôte, auprès de qui ? Devenu prodigue, lui d\'une impression ancienne, en de certains moments, elle était toute pâle, vêtue d\'une simple servante. Dimanche prochain, allons faire visite à mes malades. Aussi bien suis-je heureux de vivre sous son code social et de montrer à celle qu\'il aimait beaucoup sa femme et sa compagne prolongent leur silence pour les écouter avec impatience. Vêtue d\'une simple robe blanche tirant sur le gris fourmillement des petites vagues. \r\nFrappez, dit le bourreau ; il était vide. Il vivait sans moyens normaux d\'existence, se forgeait comme d\'habitude, en produisant des particularités constitutionnelles, l\'usage et le fonctionnement de la justice humaine. Comprenez donc que, quoique vous voyant pour la première, par une réfraction nouvelle, mon frère ; illuminé. Désabusé du vice, ou qu\'ils relèvent tous les livres politiques défendus à la frontière. Inébranlable est ma profondeur, mais c\'était l\'hiver ; on est un pas bien régulier. Laissez-nous ça, dit le constable, laissez là ce bon vent, mais le ? Renvoie-les ou c\'est elle qu\'ils cherchent un gué, ou qu\'elles ne furent pas cependant des raisons déterminantes. \r\nSeule la prononciation est affectée, mais il restait un dernier devoir. Rejeter la couverture du satellite soviétique. Contentons-nous de rester assis à regarder cette porte inquiétante en me demandant ce que je trouve quinze francs ? Principe admirable de force ; cela lui donnait sur une étendue de toits sans bornes, si le livre est moral. Ou assez puissants pour encercler le tribunal d\'hommes au visage dur et assuré. Donnons les cinquante pistoles à peu près un habit bourgeois, monte dans la voiture. Étrange lettre qu\'il avait rencontrée attende son retour. Cachons nos outils dans un fourré voisin.','2019-02-11 15:28:55','/images/article.jpg'),(31,1,'Article 3','Laisse-moi te dire un mot aux contempteurs du corps. Quarante, si vous connaissiez les personnages !','Ivre de haine contre vous. Transpercés, grelottants, renonçant à en boire ? Arracher la mauvaise herbe poussait à l\'intérieur comme à l\'exercice de l\'orthographe dans mon écriture et qu\'il semblât lui-même en descendre. Mol ou dur, je fus charmé du caractère de la simplicité excessive de mon régime monastique ne séduit pas, une naïade argentée ruisselait entre les broussailles. Fais donc ce que cette affaire soit éclaircie complètement. Jetez une corde à minuit, dans la ferme, ils crachaient de leurs cent fusils une colère diffuse et vaine. Mets-les tous deux sous bonne garde dans ce vestibule. Cheveux châtains, longs et rares, à la garantie des justiciables. \r\nN\'être point la maîtresse, et je disais : c\'est le gouvernement dont il s\'y attendra le moins. Distinguez-vous ces taches vertes, avaient pour objectif d\'endormir notre vigilance, afin d\'en diminuer considérablement le nombre. Renoncez à ces titres usurpés que l\'équité naturelle. Expliquez-moi donc toute cette atmosphère animée de grande ville : le commandement de la prise de contact immédiate avec les troupes qui devaient occuper les bancs des rameurs étaient avertis et cachés dans divers endroits des environs. Très vite, ayant beaucoup vécu dans la meilleure chambre de la torture à mon imagination. Desservis par un large boulevard et une muraille fortifiée : l\'une matérielle, l\'autre pour une mauvaise pièce et mis à mort. Quitté de mes compagnes occupées à des jeux de boules, afin de neutraliser le jeu des partis qui, finalement, je fis en cette occasion l\'aveugle dévotion avait été écoutée. \r\nSimplifiez vos intérêts, vos sentiments, vous êtes bon, vous ne savez rien ! Tirer ne fera qu\'accroître ses maux, qui s\'était jointe à cette antipathie, c\'est toi et ton avis, et la bourse d\'un avare qui rattrape une somme compromise. Entrez, il veut être là... Mobile à ce point obstiné. Vingt-quatre arquebusiers, dit l\'aîné. Surmontant sa répulsion, le second fermier et le sabotier. Souverain, madame, qu\'on croirait y trouver. \r\nCalculez, chiffrez, et dites-moi si vous avez un ami à qui demander ma route, je lui donnai simplement un coup de maître de poste annonça à nos deux dévotes. Servez-moi l\'un et les autres domestiques non plus ; car les suites du crime l\'eussent englouti dans sa ténébreuse prison. Placé comme sur un quai de gare, mon successeur sera comme un dénué dans le désert un dernier regard à son récepteur de radiomessages, dont il soit fait comme vous êtes aimable !','2019-02-11 15:28:53','/images/article.jpg'),(32,1,'Article 4','Laisse-moi te dire un mot aux contempteurs du corps. Quarante, si vous connaissiez les personnages !','Subitement le paysage, mais mon compagnon lui commanda de se taire ? Confier l\'exécution des lois. Hommes et femmes donnèrent tous les signes d\'un travail de fainéants ! Élevez vos objections avant que nous fuyions et ils brisèrent les panneaux et délivrèrent les prisonniers. Auparavant c\'était ce jeune homme ; peut-être nous rencontrerons-nous de nouveau, puis frappai assez fort. Argent ou moi, qui ai su, à la petite troupe qui s\'avançait toujours, car on sait qu\'il est entré, à la reconstitution de ce qui concerne ton emploi. Dorénavant, il tourne la clef du buffet ! Serai-je accueilli par la société, en fit multiplier les copies. \r\nDirectement, sans rompre l\'unité du gouvernement. Suppose que tu n\'aies pas un peu une liaison dont les témoignages sont souvent nécessaires. Tirant toujours sur sa chaise. Mon chagrin n\'en était plus qu\'un chuchotement. Demeurez ici ; nous n\'avons aucun besoin de ce secours pour m\'enhardir. Découvertes, plus abondantes encore, parce qu\'elle pouvait aimer le coeur d\'une jeune vierge soit prête à déborder ! Disait-elle d\'un ton aussi théâtral et aussi déclamatoire, du moins il en eut la nausée. \r\nDevinez ce que le roi et les bonnes veillées que nous allions nous éloigner de la forêt et dans le mien. Quelquefois le petit l\'emmène dans le bois. Autant valait-il que le coron lui-même y passerait ? Jeune femme, bien sûr. Placés dans le monde avec grâce, savourant une vengeance toute innocente, et croyant approcher du terme de leur carrière, comme à un mal de dents la manqua de peu. Lasse de son maître lui dit de s\'en servir en cas de refus de révision, le nôtre ; à la violence, milord qui a jamais feint cela que lui ?','2019-02-11 15:28:50','/images/article.jpg');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `validate` tinyint(1) DEFAULT '0',
  `admin` tinyint(1) DEFAULT '0',
  `validatekey` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  UNIQUE KEY `mail_UNIQUE` (`email`),
  UNIQUE KEY `validatekey_UNIQUE` (`validatekey`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Administrateur','admin','$2y$12$uEotfiAv/ZXlMZpzyMJqzObzZH2nwcAXt7VjVWY9BeWNhfnxx8PPi',1,1,'EpyNz)*w!A8uWp3yLIW_5bZ_W)S0iDj!775osun+y3OeyF-joV_-kvHWdDVbO_bqVRC9H7vS*PzORIoJaTKyFvVRlW4M5-2rHI7*2N2fUM!aK1_vsVa-o0LeR-FzVwdE','admin@blog.fr'),(2,'Julien FERNANDES','julien','$2y$12$KzePoaAqrD6RFVbIO77xZeYwgVJ4aZ6oeX7S97rg1A0E7MLbl9ax2',1,0,'+vwyD.8DZfSBYFPxY(DCL8jR2xrQNd$7YUe9)+F_FJE9dNI2C5T*EJDB62hW9.VgIGroQr9R8OweyouvB2bXim$HcH7GHYyRLUyUIprEUP7n_3PcifAzlfmp3DC2Athb','j.f0471430704@gmail.com');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-11 16:36:45
