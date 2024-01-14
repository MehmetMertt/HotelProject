-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 14. Jan 2024 um 01:09
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `hotel`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ausstattung`
--

CREATE TABLE `ausstattung` (
  `ausstattung_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `ausstattung`
--

INSERT INTO `ausstattung` (`ausstattung_id`, `name`) VALUES
(59, 'Additional Power Outlets'),
(2, 'Air Conditioning'),
(90, 'Air Purifier'),
(9, 'Alarm Clock'),
(73, 'Badewannenregal'),
(74, 'Badradio'),
(39, 'Bar Counter with Stools'),
(52, 'Bath Mat Set'),
(13, 'Bathrobes'),
(48, 'Bathroom Phone'),
(15, 'Bathtub'),
(34, 'Bedspread'),
(17, 'Blackout Curtains'),
(31, 'Bookshelf'),
(86, 'Bose-Soundsystem'),
(40, 'Carpet'),
(22, 'Central Heating'),
(25, 'Closet'),
(10, 'Coffee and Tea Maker'),
(42, 'Complimentary Bottled Water'),
(75, 'Complimentary Newspaper'),
(16, 'Complimentary Toiletries'),
(92, 'Daylight Lamp'),
(5, 'Desk and Chair'),
(64, 'Desk Lamp'),
(58, 'Dining Table'),
(45, 'Door Peephole'),
(37, 'Drying Rack'),
(88, 'Elektrischer Wasserkocher für Tee'),
(43, 'Emergency Flashlight'),
(61, 'Fire Extinguisher'),
(63, 'First Aid Kit'),
(1, 'Flat-screen TV'),
(3, 'Free Wi-Fi'),
(77, 'Fresh Flowers'),
(27, 'Full-Length Mirror'),
(71, 'Gästemappe mit Hotelinformationen'),
(46, 'Gepäckträger'),
(29, 'Hair Dryer'),
(12, 'Hairdryer'),
(41, 'Hangers'),
(85, 'Hanging Chair'),
(94, 'Humidifier'),
(7, 'In-room Safe'),
(66, 'Individuell regulierbare Heizung'),
(82, 'Infrared Sauna'),
(11, 'Iron and Ironing Board'),
(57, 'Kettle'),
(67, 'Kinderbett'),
(68, 'Kindersicherungen'),
(72, 'Kopfkissen nach Wahl'),
(65, 'Laptop Safe'),
(36, 'Laundry Basket'),
(91, 'Lounge-Ecke mit Panoramablick'),
(28, 'Luggage Rack'),
(49, 'Makeup Mirror'),
(81, 'Massagestuhl'),
(56, 'Microwave'),
(4, 'Minibar'),
(19, 'Mirror'),
(20, 'Nightstands with Lamps'),
(33, 'Notepad and Pen'),
(70, 'Office Supplies'),
(35, 'Pillow Menu'),
(87, 'Projector and Screen'),
(80, 'Razor and Shaving Cream'),
(21, 'Reading Lamp'),
(55, 'Refrigerator'),
(32, 'Remote Control for Lighting'),
(54, 'Remote for Blinds'),
(24, 'Seating Area'),
(38, 'Shoe Polish Kit'),
(53, 'Shoe Shine Service'),
(14, 'Shower'),
(62, 'Smoke Detector'),
(51, 'Soap Dispenser'),
(6, 'Sofa'),
(69, 'Soundproof Rooms'),
(78, 'Spielkonsole mit Spielen'),
(79, 'Sunglasses Cleaner'),
(93, 'Table Fan'),
(8, 'Telephone'),
(50, 'Towel Holder'),
(23, 'Towel Warmer'),
(26, 'Trash Bin'),
(47, 'Trouser Press'),
(83, 'Underfloor Heating in Bathroom'),
(60, 'USB Charging Stations'),
(30, 'Wake-up Service'),
(89, 'Wandgemälde'),
(18, 'Wardrobe'),
(76, 'Wäschereiservice'),
(44, 'Waste Separation System'),
(84, 'Wein- und Spirituosenangebot');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `buchungsdetails`
--

CREATE TABLE `buchungsdetails` (
  `preis` int(11) NOT NULL,
  `buchungsid` int(11) NOT NULL,
  `cardid` int(11) NOT NULL,
  `wann` datetime NOT NULL,
  `buchungsdetailid` int(11) NOT NULL,
  `fruestueck` int(1) NOT NULL,
  `parkplatz` int(1) NOT NULL,
  `adults` int(11) NOT NULL,
  `pets` int(11) NOT NULL,
  `children` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `buchungsdetails`
--

INSERT INTO `buchungsdetails` (`preis`, `buchungsid`, `cardid`, `wann`, `buchungsdetailid`, `fruestueck`, `parkplatz`, `adults`, `pets`, `children`) VALUES
(10500, 13, 0, '0000-00-00 00:00:00', 4, 0, 0, 2, 2, 2),
(3598, 14, 0, '2024-01-02 21:34:56', 5, 1, 0, 2, 1, 1),
(1611, 15, 0, '2024-01-02 22:37:03', 6, 1, 1, 1, 1, 0),
(2240, 16, 0, '2024-01-04 18:33:06', 7, 0, 1, 2, 0, 0),
(1884, 17, 0, '2024-01-09 12:50:04', 8, 1, 0, 1, 0, 0),
(1820, 18, 0, '2024-01-12 23:39:30', 9, 0, 1, 2, 0, 0),
(1120, 19, 0, '2024-01-12 23:51:37', 10, 0, 1, 2, 0, 0),
(959, 20, 0, '2024-01-13 14:35:46', 11, 1, 1, 1, 1, 1),
(1050, 21, 0, '2024-01-13 15:07:13', 12, 0, 0, 1, 0, 0),
(960, 22, 0, '2024-01-13 23:04:56', 13, 0, 1, 2, 0, 0),
(1190, 23, 0, '2024-01-13 23:19:40', 14, 0, 0, 1, 0, 1),
(1120, 24, 0, '2024-01-13 23:29:58', 15, 0, 1, 1, 1, 1),
(2289, 25, 0, '2024-01-13 23:30:31', 16, 1, 0, 2, 1, 2),
(129, 26, 0, '2024-01-13 23:38:48', 17, 1, 0, 1, 1, 0),
(300, 27, 0, '2024-01-14 00:49:18', 18, 0, 0, 1, 0, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gebuchtezimmer`
--

CREATE TABLE `gebuchtezimmer` (
  `buchungsid` int(11) NOT NULL,
  `zimmerid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `von` varchar(50) NOT NULL,
  `bis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `gebuchtezimmer`
--

INSERT INTO `gebuchtezimmer` (`buchungsid`, `zimmerid`, `userid`, `von`, `bis`) VALUES
(13, 6, 11, '02.01.2024', '23.01.2024'),
(14, 4, 11, '03.01.2024', '17.01.2024'),
(15, 18, 11, '03.01.2024', '06.01.2024'),
(16, 1, 10, '04.01.2024', '18.01.2024'),
(17, 1, 10, '19.01.2024', '31.01.2024'),
(18, 4, 10, '18.01.2024', '25.01.2024'),
(19, 1, 10, '01.02.2024', '08.02.2024'),
(20, 2, 10, '19.01.2024', '26.01.2024'),
(21, 1, 10, '10.02.2024', '17.02.2024'),
(22, 1, 10, '23.02.2024', '29.02.2024'),
(23, 19, 10, '19.01.2024', '26.01.2024'),
(24, 1, 11, '01.03.2024', '08.03.2024'),
(25, 11, 11, '13.01.2024', '20.01.2024'),
(26, 2, 11, '27.01.2024', '28.01.2024'),
(27, 1, 11, '18.02.2024', '20.02.2024');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `author_id` int(11) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `news`
--

INSERT INTO `news` (`news_id`, `title`, `image`, `date`, `author_id`, `body`) VALUES
(18, 'Places to Visit in Lisabon', 'upload/news/F486.tmp.jpg', '2024-01-12 22:14:15', 10, '<h1> Exploring the Charms of Lisbon </h1>\r\n\r\nLisbon, the capital of Portugal, is a city steeped in history, vibrant culture, and breathtaking scenery. Lets delve into the details of some of the must-visit places that make Lisbon a unique and enticing destination.\r\n\r\n<h3> A Stroll Through Alfama: Lisbons Oldest District </h3>\r\n\r\n<b>Maze of Narrow Streets and Fado Music</b>\r\n\r\nAlfama, Lisbons oldest district, invites visitors to wander through a labyrinth of narrow streets, colorful houses, and historic landmarks. The São Jorge Castle perched on a hill offers panoramic views of the city and the Tagus River. Alfama is also synonymous with Fado music, and intimate Fado houses allow travelers to experience the soulful melodies that capture the essence of Portuguese emotions.\r\n\r\n<h3> Belem Tower: A Maritime Icon by the Tagus </h3>\r\n\r\n<b>Gothic Architecture and Seafaring Heritage</b>\r\n\r\nBelem Tower, a UNESCO World Heritage site, stands proudly on the banks of the Tagus River. This iconic fortress, built in the 16th century, symbolizes Portugals Age of Discovery. Its intricate Manueline architecture and strategic location make it a testament to the nations maritime history. Visitors can explore the towers rooms, climb to the top for panoramic views, and soak in the atmosphere of Portugals seafaring past.\r\n\r\n<h3> Jeronimos Monastery: A Masterpiece of Manueline Architecture </h3>\r\n\r\n<b>Spiritual Grandeur and Intricate Details</b>\r\n\r\nJeronimos Monastery, another UNESCO World Heritage site, is a masterpiece of Manueline architecture. Built to commemorate Vasco da Gamas voyage to India, the monastery boasts intricate details, including maritime motifs and elaborate stonework. The interior features stunning vaulted ceilings and the tomb of the explorer himself. A visit to Jeronimos Monastery provides a deep dive into Portugals rich history and artistic achievements.\r\n\r\n<h3> Rossio Square: Lisbons Heartbeat </h3>\r\n\r\n<b>Historic Square and Architectural Elegance</b>\r\n\r\nRossio Square, officially named Dom Pedro IV Square, is the bustling heart of Lisbon. The square is surrounded by elegant buildings, including the iconic Rossio Station. The Rossio train stations façade is a blend of Neo-Manueline and Romantic styles, making it a captivating architectural gem. Cafés and shops surrounding the square offer a perfect spot to relax and soak in the lively atmosphere.\r\n\r\n<h3> LX Factory: Where Creativity Meets Industry </h3>\r\n\r\n<b>Artistic Hub in a Former Industrial Complex</b>\r\n\r\nLX Factory, located under the Ponte 25 de Abril bridge, is a dynamic cultural and creative hub housed in a former industrial complex. Visitors can explore art galleries, trendy shops, and unique restaurants. The vibrant atmosphere and street art contribute to LX Factorys distinct character. Its an excellent place to discover Lisbons contemporary arts scene while enjoying a coffee or browsing through local boutiques.\r\n\r\n<h3> Tram 28: A Scenic Journey Through Lisbons Hills </h3>\r\n\r\n<b>Vintage Tram Experience with Breathtaking Views</b>\r\n\r\nTaking Tram 28 is a nostalgic and scenic way to explore Lisbons hills and historic neighborhoods. The vintage yellow tram winds its way through Alfama, Baixa, and Graça, offering passengers panoramic views of the city. This leisurely tram journey provides a unique perspective on Lisbons architecture, vibrant street life, and historic sites.\r\n\r\n<h3> National Tile Museum: A Colorful Journey Through Portuguese Tiles </h3>\r\n\r\n<b>Tile Artistry and Cultural Heritage</b>\r\n\r\nThe National Tile Museum, or Museu Nacional do Azulejo, is dedicated to the art of Portuguese tiles. Housed in a former convent, the museum showcases an extensive collection of azulejos, decorative ceramic tiles. The exhibits span centuries and provide insight into the cultural and artistic significance of this traditional Portuguese craft.\r\n\r\n<h3> Bairro Alto: Lisbons Bohemian Quarter </h3>\r\n\r\n<b>Nightlife, Fado Bars, and Trendy Atmosphere</b>\r\n\r\nBairro Alto comes alive in the evening, transforming into Lisbons bohemian quarter. This district is known for its vibrant nightlife, with numerous bars, Fado houses, and eclectic venues. Wander through the narrow streets adorned with street art, join locals and visitors in lively bars, and experience the dynamic and artistic energy that defines Bairro Alto.\r\n\r\nLisbon, with its rich tapestry of history, art, and contemporary culture, offers a captivating experience for every traveler. These carefully selected places provide a glimpse into the soul of the city, inviting visitors to immerse themselves in the unique charm of Lisbon.'),
(21, 'Places to Visit in Istanbul', 'upload/news/8422.tmp.jpg', '2024-01-13 20:07:33', 10, '<h1> Exploring the Rich Tapestry of Istanbul: Must-Visit Places\r</h1>\n\r\nIstanbul, the city where East meets West, is a mesmerizing blend of history, culture, and modernity. As you traverse its bustling streets, youll find yourself immersed in a rich tapestry of experiences. From ancient wonders to vibrant markets, Istanbul offers a kaleidoscope of attractions that captivate the hearts of visitors. Here are some must-visit places that will make your trip to Istanbul an unforgettable journey.\r\n\r\n<h3> Hagia Sophia: A Living Testament to Time\r</h3>\n\r\n<b>Istanbul, Turkey</b> - The Hagia Sophia stands as an iconic symbol of Istanbuls rich history. Originally built as a cathedral in the 6th century, it later became a mosque and is now a museum. Step inside to witness breathtaking mosaics, intricate architecture, and a palpable sense of the past. The Hagia Sophia is a living testament to the diverse cultural influences that have shaped Istanbul over the centuries.\r\n\r\n<h3> Grand Bazaar: Shoppers Paradise\r</h3>\n\r\nFor those with a penchant for vibrant markets and unique finds, the Grand Bazaar is a must-visit destination. With over 4,000 shops, this sprawling market is one of the largest and oldest covered markets in the world. Lose yourself in the maze of narrow alleys filled with colorful textiles, spices, and handcrafted treasures. The Grand Bazaar is not just a shopping destination; its an immersive cultural experience.\r\n\r\n<h3> Topkapi Palace: Where Royalty Meets Opulence\r</h3>\n\r\nPerched on the Seraglio Point overlooking the Golden Horn, the Topkapi Palace is a stunning testament to Ottoman grandeur. Once the residence of Ottoman sultans, the palace offers a glimpse into the opulent lifestyle of the royal court. Explore the ornate chambers, lush gardens, and the Harem, where the intrigue of the past comes to life. The panoramic views of Istanbul from the palace are nothing short of spectacular.\r\n\r\n<h3> Blue Mosque: A Jewel in Istanbuls Skyline\r</h3>\n\r\nThe Blue Mosque, officially known as the Sultan Ahmed Mosque, graces the skyline of Istanbul with its six minarets and cascading domes. Step into a world of awe-inspiring architecture adorned with blue tiles, giving the mosque its nickname. As a functioning mosque, it provides a serene space for prayer and reflection amidst the bustling city.\r\n\r\n<h3> Bosphorus Cruise: A Journey Between Continents\r</h3>\n\r\nEmbark on a Bosphorus cruise to experience the unique charm of Istanbul from the water. The Bosphorus Strait, separating the European and Asian sides of the city, offers breathtaking views of historical landmarks and modern architecture. As you cruise along the water, youll witness the fusion of past and present, making it a truly unforgettable experience.\r\n\r\n<h3> Spice Bazaar: A Feast for the Senses\r</h3>\n\r\nIndulge your senses at the Spice Bazaar, also known as the Egyptian Bazaar. Located in the Eminönü quarter, this aromatic market is a sensory delight with stalls brimming with spices, teas, sweets, and more. The vibrant colors and fragrances create a lively atmosphere that immerses visitors in the citys rich culinary traditions.\r\n\r\nIn conclusion, Istanbul is a city that invites exploration and discovery at every turn. Whether youre drawn to its historical landmarks, bustling markets, or scenic waterways, Istanbuls diverse offerings cater to every travelers interests. So, pack your bags and get ready to unravel the enchanting tapestry of Istanbul, where the past seamlessly intertwines with the present.'),
(22, '5 Things to do in London', 'upload/news/CF90.tmp.jpg', '2024-01-13 20:08:56', 10, '<h1> Unlocking the Best of London: 5 Unmissable Experiences\r</h1>\n\r\nLondon, the vibrant capital of the United Kingdom, is a city that seamlessly blends tradition with modernity. From iconic landmarks to hidden gems, theres no shortage of things to see and do in this bustling metropolis. Whether youre a first-time visitor or a seasoned traveler, here are five unmissable experiences that will make your stay in London truly unforgettable.\r\n\r\n<h3> 1. Buckingham Palace Changing of the Guard\r</h3>\n\r\nNo visit to London is complete without witnessing the pomp and pageantry of the Changing of the Guard ceremony at Buckingham Palace. This iconic event takes place outside the official residence of the Queen and is a spectacular display of precision and tradition. The immaculately dressed guards, accompanied by a military band, create a mesmerizing spectacle that attracts crowds from around the world. Be sure to check the schedule for this daily event and arrive early to secure a good vantage point.\r\n\r\n<h3> 2. Explore the British Museum\r</h3>\n\r\nImmerse yourself in the vast and diverse collections of the British Museum, a treasure trove of human history and culture. From the Rosetta Stone to the Elgin Marbles, the museum houses an unparalleled collection of artifacts spanning centuries and civilizations. Admission to the British Museum is free, making it an accessible and enriching experience for history enthusiasts and casual visitors alike. Take your time to wander through its hallowed halls and uncover the stories behind each exhibit.\r\n\r\n<h3> 3. Walk Along the Thames River\r</h3>\n\r\nThe Thames River is the lifeblood of London, and a leisurely stroll along its banks offers a picturesque perspective of the city. Start at Westminster Bridge and marvel at the panoramic views of the Houses of Parliament and Big Ben. Continue your walk to the South Bank, where youll find a vibrant atmosphere with street performers, food markets, and cultural venues such as the Tate Modern. As you cross the iconic Tower Bridge, youll be treated to breathtaking views of the Tower of London and the city skyline.\r\n\r\n<h3> 4. West End Theatre Experience\r</h3>\n\r\nLondons West End is synonymous with world-class theater, and catching a show in this entertainment district is a must for any visitor. From timeless classics to cutting-edge productions, the West End offers a diverse range of performances to suit every taste. Book tickets in advance to secure the best seats for a memorable night out. Whether youre into musicals, dramas, or comedies, the West End promises a theatrical experience that rivals the best in the world.\r\n\r\n<h3> 5. Indulge in Culinary Delights at Borough Market\r</h3>\n\r\nFor a gastronomic adventure, head to Borough Market, one of Londons oldest and most renowned food markets. Located near London Bridge, this culinary haven boasts a dazzling array of fresh produce, artisanal treats, and international cuisine. Explore the markets labyrinthine alleys, sampling everything from gourmet cheeses to delectable pastries. The vibrant atmosphere and diverse culinary offerings make Borough Market a haven for food lovers seeking a taste of Londons culinary diversity.\r\n\r\nIn conclusion, London beckons with a myriad of experiences that cater to every interest and preference. Whether youre drawn to history, culture, theater, or gastronomy, the city has something special to offer. So, pack your bags and get ready to unlock the best of London with these five unmissable experiences that showcase the citys vibrant tapestry.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `vname` varchar(100) DEFAULT NULL,
  `nname` varchar(100) DEFAULT NULL,
  `geschlecht` char(1) DEFAULT NULL,
  `passwort` varchar(255) DEFAULT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `stadt` varchar(100) DEFAULT NULL,
  `plz` varchar(10) DEFAULT NULL,
  `isAdmin` int(1) DEFAULT 0,
  `isActive` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `mail`, `username`, `vname`, `nname`, `geschlecht`, `passwort`, `adresse`, `stadt`, `plz`, `isAdmin`, `isActive`) VALUES
(10, 'if23b019@technikum-wien.at', 'Admin', 'Mehmet', 'Mert', 'm', 'ecd71870d1963316a97e3ac3408c9835ad8cf0f3c1bc703527c30265534f75ae', 'Ringstraße 01', 'Wien', '12300', 1, 1),
(11, 'sarah@mueler.at', 'sarahmueller', 'Sarah', 'Mueller', 'f', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', 'Ringstraße 02', 'Wien', '1010', 0, 1),
(14, 'waewae@wewe.com', 'guha1', 'Gustav', 'Hans', 'd', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 'ewewewe', '12', '23232', 0, 0),
(15, 'test@test.com', 'sarah2121212', 'Mehmet', 'ewewe', 'f', '39adba3034ddf7654e727771846c7802e9fc0b0c5592731e05d3176bda1cb9c9', '223', '2323', '2323', 0, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zimmer`
--

CREATE TABLE `zimmer` (
  `zimmerId` int(11) NOT NULL,
  `preisProTag` int(5) NOT NULL,
  `maxPerson` int(11) NOT NULL,
  `maxHaustier` int(11) NOT NULL,
  `kategorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `zimmer`
--

INSERT INTO `zimmer` (`zimmerId`, `preisProTag`, `maxPerson`, `maxHaustier`, `kategorie`) VALUES
(1, 150, 2, 2, 1),
(2, 120, 2, 2, 2),
(3, 80, 1, 2, 3),
(4, 250, 3, 2, 4),
(5, 300, 4, 2, 5),
(6, 500, 4, 2, 6),
(7, 200, 2, 2, 1),
(8, 130, 2, 2, 2),
(9, 90, 1, 2, 3),
(10, 270, 3, 2, 4),
(11, 320, 4, 2, 5),
(12, 550, 4, 2, 6),
(13, 180, 2, 2, 1),
(14, 110, 2, 2, 2),
(15, 70, 1, 2, 3),
(16, 240, 3, 2, 4),
(17, 290, 4, 2, 5),
(18, 520, 4, 2, 6),
(19, 170, 2, 2, 1),
(20, 140, 2, 2, 2),
(21, 100, 1, 2, 3),
(22, 260, 3, 2, 4),
(23, 310, 4, 2, 5),
(24, 540, 4, 2, 6),
(25, 190, 2, 2, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zimmerbilder`
--

CREATE TABLE `zimmerbilder` (
  `zimmerid` int(11) NOT NULL,
  `bildpfad` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `zimmerbilder`
--

INSERT INTO `zimmerbilder` (`zimmerid`, `bildpfad`) VALUES
(1, 'upload/hotelrooms/4.jpg'),
(2, 'upload/hotelrooms/5.jpg'),
(3, 'upload/hotelrooms/6.jpg'),
(4, 'upload/hotelrooms/7.jpg'),
(5, 'upload/hotelrooms/8.jpg'),
(6, 'upload/hotelrooms/9.jpg'),
(7, 'upload/hotelrooms/10.jpg'),
(8, 'upload/hotelrooms/11.jpg'),
(9, 'upload/hotelrooms/12.jpg'),
(10, 'upload/hotelrooms/13.jpg'),
(11, 'upload/hotelrooms/14.jpg'),
(12, 'upload/hotelrooms/15.jpg'),
(13, 'upload/hotelrooms/16.jpg'),
(14, 'upload/hotelrooms/17.jpg'),
(15, 'upload/hotelrooms/18.jpg'),
(16, 'upload/hotelrooms/19.jpg'),
(17, 'upload/hotelrooms/20.jpg'),
(18, 'upload/hotelrooms/21.jpg'),
(19, 'upload/hotelrooms/22.jpg'),
(20, 'upload/hotelrooms/23.jpg'),
(21, 'upload/hotelrooms/24.jpg'),
(22, 'upload/hotelrooms/25.jpg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zimmerdescription`
--

CREATE TABLE `zimmerdescription` (
  `zimmerid` int(11) NOT NULL,
  `beschreibung` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `zimmerdescription`
--

INSERT INTO `zimmerdescription` (`zimmerid`, `beschreibung`) VALUES
(1, 'Das Luxuszimmer bietet einen opulenten Rückzugsort mit elegantem Dekor, einem Kingsize-Bett und atemberaubendem Stadtblick.'),
(2, 'Das Doppelzimmer ist perfekt für Paare, mit gemütlichem Ambiente, einem romantischen Balkon und modernen Annehmlichkeiten.'),
(3, 'Das Einzelzimmer ist ideal für Geschäftsreisende oder Alleinreisende, mit einem komfortablen Einzelbett und Arbeitsbereich.'),
(4, 'Das Dreierzimmer ist geräumig und familienfreundlich, mit drei Betten und einem eigenen Badezimmer.'),
(5, 'Das Viererzimmer bietet ausreichend Platz für eine Gruppe von Freunden oder Familie, mit separaten Schlafbereichen und Gemeinschaftsbereichen.'),
(6, 'Die Präsidentensuite ist die Krönung des Luxus, mit exquisitem Design, einem eigenen Whirlpool und erstklassigem Service.'),
(7, 'Genießen Sie erneut das Luxuszimmer mit exklusivem Service, stilvollem Interieur und Blick auf den hoteleigenen Garten.'),
(8, 'Das Doppelzimmer bietet eine Mischung aus modernem Komfort und traditionellem Charme, perfekt für einen erholsamen Aufenthalt.'),
(9, 'Das Einzelzimmer ist eine Oase der Ruhe mit minimalistischem Design, perfekt für Geschäftsreisende auf der Suche nach Entspannung.'),
(10, 'Das Dreierzimmer ist geräumig und gemütlich, mit modernem Dekor und Panoramablick auf die Stadt.'),
(11, 'Die Viererzimmer-Suite ist ideal für Familien, bietet geräumige Wohnbereiche und eine private Terrasse mit Blick auf den Ozean.'),
(12, 'Die Präsidentensuite verbindet zeitlose Eleganz mit modernem Luxus, bietet einen eigenen Fitnessraum und exklusiven Zimmerservice.'),
(13, 'Das Luxuszimmer ist eine Hommage an Raffinesse, mit handgefertigten Möbeln, kunstvollen Details und einem eigenen Kamin.'),
(14, 'Das Doppelzimmer strahlt Gemütlichkeit aus, mit weichen Bettdecken, warmen Farbtönen und einem malerischen Blick auf den Innenhof.'),
(15, 'Das Einzelzimmer bietet eine ruhige Umgebung zum Entspannen, mit einem bequemen Bett und Blick auf den hoteleigenen Garten.'),
(16, 'Das Dreierzimmer ist geräumig und stilvoll, mit modernen Annehmlichkeiten und einem eigenen Balkon.'),
(17, 'Das Viererzimmer ist perfekt für Gruppen, mit komfortablen Betten, separaten Wohnbereichen und einem atemberaubenden Blick auf die Berge.'),
(18, 'Die Präsidentensuite ist ein Meisterwerk des Designs, mit marmornen Akzenten, einem eigenen Weinkeller und 24-Stunden-Concierge-Service.'),
(19, 'Das Luxuszimmer bietet einen Rückzugsort mit zeitgenössischem Design, hochwertigen Annehmlichkeiten und Panoramablick auf die Stadt.'),
(20, 'Das Doppelzimmer ist ein eleganter Rückzugsort für Paare, mit einem Himmelbett, romantischer Beleuchtung und Blick auf den Sonnenuntergang.'),
(21, 'Das Einzelzimmer strahlt eine beruhigende Atmosphäre aus, mit neutralen Farben, einem komfortablen Bett und Blick auf den hoteleigenen Park.'),
(22, 'Das Dreierzimmer bietet geräumigen Komfort, mit modernem Design, einem großen Sofa und einem privaten Essbereich.'),
(23, 'Die Viererzimmer-Suite ist perfekt für Familienurlaube, mit separaten Schlafzimmern, einem gemeinsamen Wohnzimmer und einem eigenen Balkon.'),
(24, 'Die Präsidentensuite setzt neue Maßstäbe für Luxus, mit einem eigenen Spa-Bereich, einem privaten Koch und uneingeschränktem Panoramablick.'),
(25, 'Das Luxuszimmer lädt zum Verweilen ein, mit edlen Stoffen, luxuriösen Möbeln und einem eigenen Balkon mit Blick auf die Skyline.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zimmer_ausstattung`
--

CREATE TABLE `zimmer_ausstattung` (
  `zimmer_id` int(11) NOT NULL,
  `ausstattung_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `zimmer_ausstattung`
--

INSERT INTO `zimmer_ausstattung` (`zimmer_id`, `ausstattung_id`) VALUES
(1, 1),
(1, 3),
(1, 6),
(1, 9),
(1, 12),
(1, 15),
(2, 2),
(2, 4),
(2, 7),
(2, 10),
(2, 13),
(2, 16),
(3, 1),
(3, 5),
(3, 8),
(3, 11),
(3, 14),
(3, 17),
(4, 2),
(4, 6),
(4, 9),
(4, 12),
(4, 15),
(4, 18),
(5, 3),
(5, 7),
(5, 10),
(5, 13),
(5, 16),
(5, 19),
(6, 4),
(6, 8),
(6, 11),
(6, 14),
(6, 17),
(6, 20),
(7, 5),
(7, 9),
(7, 12),
(7, 15),
(7, 18),
(7, 21),
(8, 1),
(8, 6),
(8, 10),
(8, 13),
(8, 16),
(8, 19),
(9, 2),
(9, 7),
(9, 11),
(9, 14),
(9, 17),
(9, 20),
(10, 3),
(10, 8),
(10, 12),
(10, 15),
(10, 18),
(10, 21),
(11, 4),
(11, 9),
(11, 13),
(11, 16),
(11, 19),
(11, 22),
(12, 5),
(12, 10),
(12, 14),
(12, 17),
(12, 20),
(12, 23),
(13, 1),
(13, 6),
(13, 11),
(13, 15),
(13, 18),
(13, 21),
(14, 2),
(14, 7),
(14, 12),
(14, 16),
(14, 19),
(14, 22),
(15, 3),
(15, 8),
(15, 13),
(15, 17),
(15, 20),
(15, 23),
(16, 4),
(16, 9),
(16, 14),
(16, 18),
(16, 21),
(16, 24),
(17, 5),
(17, 10),
(17, 15),
(17, 19),
(17, 22),
(17, 25),
(18, 1),
(18, 6),
(18, 11),
(18, 16),
(18, 20),
(18, 23),
(19, 2),
(19, 7),
(19, 12),
(19, 17),
(19, 21),
(19, 24),
(20, 3),
(20, 8),
(20, 13),
(20, 18),
(20, 22),
(20, 25),
(21, 4),
(21, 9),
(21, 14),
(21, 19),
(21, 23),
(21, 26),
(22, 5),
(22, 10),
(22, 15),
(22, 20),
(22, 24),
(22, 27),
(23, 1),
(23, 6),
(23, 11),
(23, 16),
(23, 21),
(23, 26),
(24, 2),
(24, 7),
(24, 12),
(24, 17),
(24, 22),
(24, 27),
(25, 3),
(25, 8),
(25, 13),
(25, 18),
(25, 23),
(25, 28);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `ausstattung`
--
ALTER TABLE `ausstattung`
  ADD PRIMARY KEY (`ausstattung_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indizes für die Tabelle `buchungsdetails`
--
ALTER TABLE `buchungsdetails`
  ADD PRIMARY KEY (`buchungsdetailid`),
  ADD KEY `buchungsid` (`buchungsid`);

--
-- Indizes für die Tabelle `gebuchtezimmer`
--
ALTER TABLE `gebuchtezimmer`
  ADD PRIMARY KEY (`buchungsid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `zimmerid` (`zimmerid`);

--
-- Indizes für die Tabelle `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`);

--
-- Indizes für die Tabelle `zimmer`
--
ALTER TABLE `zimmer`
  ADD PRIMARY KEY (`zimmerId`);

--
-- Indizes für die Tabelle `zimmerbilder`
--
ALTER TABLE `zimmerbilder`
  ADD PRIMARY KEY (`zimmerid`);

--
-- Indizes für die Tabelle `zimmerdescription`
--
ALTER TABLE `zimmerdescription`
  ADD PRIMARY KEY (`zimmerid`);

--
-- Indizes für die Tabelle `zimmer_ausstattung`
--
ALTER TABLE `zimmer_ausstattung`
  ADD PRIMARY KEY (`zimmer_id`,`ausstattung_id`),
  ADD KEY `ausstattung_id` (`ausstattung_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `ausstattung`
--
ALTER TABLE `ausstattung`
  MODIFY `ausstattung_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT für Tabelle `buchungsdetails`
--
ALTER TABLE `buchungsdetails`
  MODIFY `buchungsdetailid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT für Tabelle `gebuchtezimmer`
--
ALTER TABLE `gebuchtezimmer`
  MODIFY `buchungsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT für Tabelle `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT für Tabelle `zimmer`
--
ALTER TABLE `zimmer`
  MODIFY `zimmerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT für Tabelle `zimmerbilder`
--
ALTER TABLE `zimmerbilder`
  MODIFY `zimmerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `buchungsdetails`
--
ALTER TABLE `buchungsdetails`
  ADD CONSTRAINT `buchungsdetails_ibfk_1` FOREIGN KEY (`buchungsid`) REFERENCES `gebuchtezimmer` (`buchungsid`),
  ADD CONSTRAINT `buchungsdetails_ibfk_2` FOREIGN KEY (`buchungsid`) REFERENCES `gebuchtezimmer` (`buchungsid`),
  ADD CONSTRAINT `buchungsdetails_ibfk_3` FOREIGN KEY (`buchungsid`) REFERENCES `gebuchtezimmer` (`buchungsid`),
  ADD CONSTRAINT `buchungsdetails_ibfk_4` FOREIGN KEY (`buchungsid`) REFERENCES `gebuchtezimmer` (`buchungsid`);

--
-- Constraints der Tabelle `gebuchtezimmer`
--
ALTER TABLE `gebuchtezimmer`
  ADD CONSTRAINT `gebuchtezimmer_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `gebuchtezimmer_ibfk_2` FOREIGN KEY (`zimmerid`) REFERENCES `zimmer` (`zimmerId`);

--
-- Constraints der Tabelle `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);

--
-- Constraints der Tabelle `zimmerbilder`
--
ALTER TABLE `zimmerbilder`
  ADD CONSTRAINT `zimmerbilder_ibfk_1` FOREIGN KEY (`zimmerid`) REFERENCES `zimmer` (`zimmerId`);

--
-- Constraints der Tabelle `zimmerdescription`
--
ALTER TABLE `zimmerdescription`
  ADD CONSTRAINT `zimmerdescription_ibfk_1` FOREIGN KEY (`zimmerid`) REFERENCES `zimmer` (`zimmerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `zimmer_ausstattung`
--
ALTER TABLE `zimmer_ausstattung`
  ADD CONSTRAINT `zimmer_ausstattung_ibfk_1` FOREIGN KEY (`zimmer_id`) REFERENCES `zimmer` (`zimmerId`),
  ADD CONSTRAINT `zimmer_ausstattung_ibfk_2` FOREIGN KEY (`ausstattung_id`) REFERENCES `ausstattung` (`ausstattung_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
