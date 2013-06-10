# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.28)
# Database: bus_catchers
# Generation Time: 2013-05-30 18:01:28 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table cities
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cities`;

CREATE TABLE `cities` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `region` varchar(50) NOT NULL DEFAULT '',
  `lat` varchar(50) NOT NULL DEFAULT '',
  `long` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;

INSERT INTO `cities` (`id`, `name`, `region`, `lat`, `long`)
VALUES
	(2,'Baltimore','MD','39.286388898889','-76.61500001'),
	(3,'Boston','MA','42.357777787778','-71.061666676667'),
	(7,'Newark','NJ','40.72422','-74.172574'),
	(8,'New York','NY','40.74','-73.97'),
	(11,'Philadelphia','PA','39.953333','-75.17'),
	(15,'Washington','DC','38.895111',' -77.036667');

/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table companies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `companies`;

CREATE TABLE `companies` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;

INSERT INTO `companies` (`id`, `name`, `description`)
VALUES
	(1,'BoltBus','Bolt understands that customers expect simplicity when it comes to traveling on a bus. And when it comes to a frequent rider program, we’re keeping it simple as well. \n\nIntroducing the Bolt Rewards program. No miles, no restrictions. Simply take eight trips on BoltBus and you’re eligible for a free one-way ticket trip. \n\nThat’s it. No strings attached. Valid at any time, regardless of time of day, day of week, or even holiday travel. You’ve earned it, so why not use it whenever you want? \n'),
	(2,'Greyhound','Founded in 1914, Greyhound Lines, Inc. is the largest provider of intercity bus transportation, serving more than 3,800 destinations with 13,000 daily departures across North America. It has become an American icon, providing safe, enjoyable and affordable travel to nearly 25 million passengers each year. The Greyhound running dog is one of the most-recognized brands in the world.\n\nWhile Greyhound is well known for its regularly scheduled passenger service, the company also provides a number of other services for its customers. Greyhound PackageXpress service offers value-priced same-day and early-next-day package delivery to thousands of destinations. And the company\'s Greyhound Travel Services unit offers charter packages for businesses, conventions, schools and other groups at competitive rates.\n\nGreyhound has three operating subsidiaries in the United States, which are a part of the nationwide Greyhound network. They include: Valley Transit Company, serving the Texas-Mexico border, Crucero USA, serving southern California and Arizona into Mexico, and Americanos USA, serving points in Mexico from Texas and New Mexico.\n\nIn addition, Greyhound has interline partnerships with a number of independent bus lines across the United States. These bus companies provide complementary service to Greyhound Lines\' existing schedules and link to many of the smaller towns in Greyhound Lines\' national route system.\n\nAmtrak passengers use Greyhound to make connections to cities not served by rail on Amtrak Thruway service, by purchasing a ticket for the bus connection from Amtrak in conjunction with the purchase of their rail ticket. If passengers desire, they may also buy a bus ticket directly from Greyhound.\n\nFor travel within Canada, Greyhound Canada carries millions of passengers across the country\'s provinces and territories each year. The company also provides Greyhound Courier Express package delivery service to its various Canadian locations.\n\nFor those within Mexico who wish to travel by Greyhound in the United States, Greyhound subsidiary Greyhound de Mexico can sell Greyhound tickets at one of more than 100 agencies located throughout Mexico. The agencies also sell tickets for several Mexican bus companies, like Estrella Blanca, which connect to Greyhound service at the United States-Mexico border cities.'),
	(3,'Megabus','Megabus.com is the first, low-cost, express bus service to offer city center-to-city center travel for as low as $1 via the Internet. Since launching in April 2006, megabus.com has served more than 24 million customers throughout more than 100 cities across North America.  Our luxury single and double deckers offer free wi-fi, at-seat plug ins, panoramic windows and a green alternative way to travel. Meticulously maintained with professional drivers at the wheel, when you travel with megabus.com, you will be riding in comfort and confidence. We provide affordable and reliable bus services, offering the highest level of comfort and safety.  You can be assured of a great experience and overall satisfaction when you choose megabus.com. Our professional staff, and our fleet of clean, comfortable, well maintained wheelchair accessible, state-of-the-art double decker buses enable us to provide you with the dependable, quality service you expect.  We look forward to serving you!'),
	(4,'Peterpan','Today, Peter Pan is one of the largest privately owned intercity bus companies in the United States with the most modern fleet of buses numbering 250 vehicles. Our new state-of-the-art, custom designed motorcoaches have changed bus travel forever. Peter Pan’s 750 employees include the best drivers in the industry. Our highly-trained drivers have been recognized nationally for their achievements in safety … see our section on “Safety & Drivers” to meet some of our award-winning One-, Two- and Three-Million Mile drivers! Peter Pan coaches travel over 25 million miles a year: The equivalent of nearly 100 trips to the moon annually… or one of our buses going around the world three times every day!'),
	(5,'LuckyStar',' Established in 2003, Lucky River Transportation Inc offers competitive fare to customers traveling between Boston and New York City. Since then, Lucky Star evolved from a family style operation business into a corporation which maintains its fleet of more than 20 luxury motor coaches from the state of the art maintenance facility. \"We are serious about our service because we strive to provide a professional, dependable and safe environment to our passengers.\"'),
	(6,'GoBus','GO Buses is dedicated to providing safe, reliable and professional bus charter services in and around the Metropolitan Area. We offer the finest service for those who enjoy traveling in style and comfort. Whether you need group transportation to and from airports, hotels, amusement parks or casinos, our experienced and courteous drivers strive for top-quality service.\nWith our wide range of services, GO Buses provides travel services for all group sizes. Our services include, travel to and from destinations, arranging New York City sightseeing in any language, dining, theater, cultural and arts venues and admission to famous New York City attractions. GO Buses is also a contracted vendor of the New York City Board of Education, which allows us to provide charter services to schools for round-trip transportation of students.'),
	(7,'Amtrack','The National Railroad Passenger Corporation, Amtrak, is a corporation striving to deliver a high quality, safe, on-time rail passenger service that exceeds customer expectations. Learn all about Amtrak here from every angle.');

/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table routes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `routes`;

CREATE TABLE `routes` (
  `id` int(11) unsigned NOT NULL,
  `origin_key` int(11) NOT NULL,
  `arrival_key` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `routes` WRITE;
/*!40000 ALTER TABLE `routes` DISABLE KEYS */;

INSERT INTO `routes` (`id`, `origin_key`, `arrival_key`)
VALUES
	(1,1,5),
	(2,1,8),
	(3,2,7),
	(4,2,4),
	(5,3,7),
	(6,3,8);

/*!40000 ALTER TABLE `routes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table stations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `stations`;

CREATE TABLE `stations` (
  `id` int(11) NOT NULL,
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lat` double NOT NULL,
  `long` double NOT NULL,
  `address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `stations` WRITE;
/*!40000 ALTER TABLE `stations` DISABLE KEYS */;

INSERT INTO `stations` (`id`, `description`, `company_name`, `city`, `lat`, `long`, `address`)
VALUES
	(1,'by Sbarro - To DC or Baltimore','BoltBus','New York, NY',40.750411,-73.9908395,'West 33rd St. and 7th Ave. NY, NY 10018 '),
	(2,'by Tick Tock - To Philadelphia or Boston','BoltBus','New York, NY',40.752508,-73.993714,'34 St. & 8 Ave NY, NY 10001 '),
	(3,'To DC or Philadelphia ','BoltBus','New York, NY',40.722462,-74.005516,'Canal St. & 6 Av. NY, NY 10014 '),
	(4,'Boston South Station -- Gate 9','BoltBus','Boston, MA',42.351241,-71.056179,'700 Atlantic Ave. Boston, MA 02110 '),
	(5,'Marc Penn Station ','BoltBus','Baltimore, MD',39.308452,-76.615069,'1610 St. Paul St., Baltimore, MD 21202 '),
	(6,'Newark Penn Station','BoltBus','Newark, NJ',40.734181,-74.165062,'Newark Penn Station'),
	(7,'Philadelphia JFK & N. 30th St','BoltBus','Philadelphia, PA',39.956053,-75.183628,'3101 John F. Kennedy Blvd '),
	(8,'Washington (Union Station), DC','BoltBus','Washington, DC ',38.89686864,-77.0063121,'50 Massachusetts Avenue, N.E. '),
	(9,'','BoltBus','Seattle, WA',47.5983,-122.32758,'5th Avenue South & S. King St'),
	(10,'','BoltBus','Bellingham, WA',48.79272,-122.4911,'4194 Cordata Pkwy '),
	(11,'1150 Station Street-Gate 4','BoltBus','Vancouver, BC ',49.27372,-123.09807,'1150 Station Street '),
	(12,'','BoltBus','Portland, OR',45.51705,-122.67975,'SW Salmon St. between 5th & 6th Ave'),
	(13,'Baltimore Downtown, MD','Greyhound','Baltimore, MD',39.271072,-76.6272414,'Baltimore Greyhound Station, 2110 Haines St, Baltimore Downtown, MD 21201'),
	(14,'Boston - South Station','Greyhound','Boston, MA',42.352139,-71.055108,'South Station Transit CTR, 700 Atlantic Avenue, Boston, MA 02110'),
	(15,'Newark - Penn Station','Greyhound','Newark, NJ',40.734332,-74.162141,'1 Penn RR Station, Newark, NJ 07102'),
	(16,'New York - Port Authority','Greyhound','New York, NY',40.756167,-73.9905694,'Port Authority, 625 8TH Avenue, New York, NY 10018'),
	(17,'Philadelphia - Midtown Village','Greyhound','Philadelphia, PA',39.95292,-75.157098,'Philadelphia Greyhound, 1001 Filbert St, Philadelphia, PA 19107'),
	(18,'Washington DC - Union Station','Greyhound','Washington, DC',38.897019,-77.006437,'UNION STATION, 50 MASSACHUSETTS AVE NE, Washington, DC 20002'),
	(19,'Baltimore - White Marsh Mall','Megabus','Baltimore, MD',39.37233,-76.46866,' by 8098 Honeygo Blvd, Nottingham, MD 21236'),
	(20,'New York - 34th St','Megabus','New York, NY',40.756313,-74.00357,'34th St between 11th Ave and 12th Ave, New York, NY 10001'),
	(21,'Boston - South Station','Megabus','Boston, MA',42.351936,-71.054168,'700 Atlantic Ave, Boston, MA'),
	(22,'Philadelphia - 30th Street Station','Megabus','Philadelphia, PA',39.96,-75.18,'NA'),
	(23,'Washington DC - Union Station','Megabus','Washington, DC',38.897019,-77.006437,'UNION STATION, 50 MASSACHUSETTS AVE NE, Washington, DC 20002'),
	(24,'Baltimore Downtown, MD','Peterpan','Baltimore, MD',39.271072,-76.6272414,'Baltimore Greyhound Station, 2110 Haines St, Baltimore Downtown, MD 21201'),
	(25,'Boston - South Station','Peterpan','Boston, MA',42.352139,-71.055108,'South Station Transit CTR, 700 Atlantic Avenue, Boston, MA 02110'),
	(26,'New York - Port Authority','Peterpan','New York, NY',40.756167,-73.9905694,'Port Authority, 625 8TH Avenue, New York, NY 10018'),
	(27,'Philadelphia - Midtown Village','Peterpan','Philadelphia, PA',39.95292,-75.157098,'Philadelphia Greyhound, 1001 Filbert St, Philadelphia, PA 19107'),
	(28,'Washington DC - Union Station','Peterpan','Washington, DC',38.897019,-77.006437,'UNION STATION, 50 MASSACHUSETTS AVE NE, Washington, DC 20002'),
	(29,'Manhattan - opposite Penn Station','GoBus','New York, NY',40.750292,-73.994858,'8th Ave & 31st Street, Northwest Corner, New York, NY 10001'),
	(30,'Cambridge - Alewife Bus Station Red Line','GoBus','Boston, MA',42.395456,-71.142512,'Alewife Brook Parkway Cambridge, MA 02140'),
	(31,'Manhattan - Chinatown','LuckyStar','New York, NY',40.716512,-73.994803,'55-59 Chrystie Street (between Hester and Canal Streets) Manhattan, NY 10002'),
	(32,'Boston - South Station','LuckyStar','Boston, MA',42.352139,-71.055108,'South Station Transit CTR, 700 Atlantic Avenue, Boston, MA 02110');

/*!40000 ALTER TABLE `stations` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
