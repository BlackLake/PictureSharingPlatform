-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost
-- Üretim Zamanı: 08 Mar 2019, 09:38:52
-- Sunucu sürümü: 5.6.24
-- PHP Sürümü: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `PictureSharingPlatform`
--
CREATE DATABASE IF NOT EXISTS `PictureSharingPlatform` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `PictureSharingPlatform`;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Comments`
--

CREATE TABLE IF NOT EXISTS `Comments` (
  `CommentID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PostID` int(11) NOT NULL,
  `Comment` varchar(500) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `Comments`
--

INSERT INTO `Comments` (`CommentID`, `UserID`, `PostID`, `Comment`, `Date`) VALUES
(1, 16, 14, 'deneme', '2017-05-05 13:58:52'),
(2, 14, 14, 'try by code', '2017-05-08 15:59:28'),
(3, 21, 2, 'comment test', '2017-05-09 11:19:03'),
(4, 21, 2, 'asds', '2017-05-09 11:19:16'),
(5, 22, 16, 'commnet', '2017-05-10 13:55:27');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Posts`
--

CREATE TABLE IF NOT EXISTS `Posts` (
  `PostID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PhotoURL` varchar(300) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `Posts`
--

INSERT INTO `Posts` (`PostID`, `UserID`, `Title`, `Date`, `PhotoURL`) VALUES
(1, 14, 'deneme', '2017-04-08 13:03:13', 'posts/df1aca4e824f77ac2130d854df12a50b.png'),
(2, 14, 'scheme', '2017-04-08 14:33:13', 'posts/12527f18c64b6c01bfc993e99f06ade6.png'),
(3, 14, 'asd', '2017-04-08 14:56:39', 'posts/9e4894f30b849f2bf4c3dbeefe6b5bb8.png'),
(4, 14, 'asdqqw', '2017-04-08 14:57:20', 'posts/0dff3df6162fab847cc7e3a14f2e0085.jpg'),
(5, 14, 'fgddv', '2017-04-08 14:57:32', 'posts/1d84aeeb9797f71d76a14031b4876f74.png'),
(6, 14, 'sgdgsdfsdg', '2017-04-08 14:57:44', 'posts/23c7792a80385293e73423379fd91199.png'),
(7, 14, 'screen', '2017-04-10 16:23:13', 'posts/5ab43a2d3b907334ef384278fc7ba924.png'),
(8, 14, 'water', '2017-04-11 10:38:26', 'posts/5707852fa205e4f001e43008191283bb.jpg'),
(9, 14, 'sky', '2017-04-11 10:39:03', 'posts/6de6313d30e3ab9c606e3aa33862547f.jpg'),
(10, 14, 'water drops', '2017-04-11 10:39:20', 'posts/4cc618775c6b175484355d9613744338.jpg'),
(11, 16, 'keys', '2017-04-11 10:40:06', 'posts/9cff63713cf0721fea4138376d8a03ee.jpg'),
(12, 16, 'aurora', '2017-04-11 10:40:33', 'posts/fd8aeabdbdf34384d370945e07f59f4d.jpg'),
(13, 18, 'grass', '2017-04-11 10:41:19', 'posts/3ecd90a07df202d85238de6da30c99a2.jpg'),
(14, 18, 'steam', '2017-04-11 10:41:34', 'posts/e9ad22b1d88e058f631530084f8d287f.jpg'),
(15, 14, 'berries', '2017-04-11 11:07:55', 'posts/abc0a70109706f8ef83767c49ec56501.jpg'),
(16, 21, 'pen', '2017-05-09 11:16:50', 'posts/4447ff1096cbc97c79e59e8ed30e66c0.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `UserID` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Nick` varchar(15) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `PPURL` varchar(300) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `Users`
--

INSERT INTO `Users` (`UserID`, `Email`, `Nick`, `Password`, `PPURL`) VALUES
(14, 'oguzhankaragol60@gmail.com', 'rooty', '1', 'pp/c770d8ccb5e1b1e25d1d69195bc1bb7b.jpg'),
(16, 'asd@sd.v', 'asd', '123', 'pp/def.jpg'),
(17, 'asd@sd.vf', 'cedc', 'edcedcdece', 'pp/8e520f68e7f08ac9373c32d2fd9051b5.png'),
(18, 'oguzhankaragol60@gmail.comaa', 'comaa', '1', 'pp/def.jpg'),
(19, 'deneme@gmail.com', 'deneme', '1', 'pp/def.jpg'),
(20, 'user@gmail.com', 'user', '2', 'pp/def.jpg'),
(22, 'martin.peresini@gmail.com', 'mashroom_martin', '123', 'pp/74a002dcfb89207d3540ee8d6c1648df.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Vote`
--

CREATE TABLE IF NOT EXISTS `Vote` (
  `VoteID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PostID` int(11) NOT NULL,
  `Value` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `Vote`
--

INSERT INTO `Vote` (`VoteID`, `UserID`, `PostID`, `Value`) VALUES
(4, 16, 2, 1),
(5, 17, 2, 1),
(6, 18, 1, -1),
(21, 14, 14, 1),
(26, 14, 13, 1),
(40, 14, 2, 1),
(42, 14, 1, -1),
(43, 14, 12, 1),
(45, 14, 15, 1),
(49, 21, 2, 1),
(52, 22, 16, 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`CommentID`),
  ADD UNIQUE KEY `CommentID` (`CommentID`);

--
-- Tablo için indeksler `Posts`
--
ALTER TABLE `Posts`
  ADD PRIMARY KEY (`PostID`),
  ADD UNIQUE KEY `PostID` (`PostID`);

--
-- Tablo için indeksler `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Nick` (`Nick`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `UserID` (`UserID`);

--
-- Tablo için indeksler `Vote`
--
ALTER TABLE `Vote`
  ADD PRIMARY KEY (`VoteID`),
  ADD UNIQUE KEY `VoteID` (`VoteID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `Comments`
--
ALTER TABLE `Comments`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Tablo için AUTO_INCREMENT değeri `Posts`
--
ALTER TABLE `Posts`
  MODIFY `PostID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- Tablo için AUTO_INCREMENT değeri `Users`
--
ALTER TABLE `Users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- Tablo için AUTO_INCREMENT değeri `Vote`
--
ALTER TABLE `Vote`
  MODIFY `VoteID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
