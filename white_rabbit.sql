-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 13 Ara 2019, 00:11:29
-- Sunucu sürümü: 10.1.19-MariaDB
-- PHP Sürümü: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `white_rabbit`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `card`
--

CREATE TABLE `card` (
  `card_id` int(11) NOT NULL,
  `card_title` varchar(80) NOT NULL,
  `card_desc` varchar(300) NOT NULL,
  `card_date` date NOT NULL,
  `card_link` varchar(800) NOT NULL,
  `card_category` varchar(40) NOT NULL,
  `card_type` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `card`
--

INSERT INTO `card` (`card_id`, `card_title`, `card_desc`, `card_date`, `card_link`, `card_category`, `card_type`) VALUES
(1, 'Bayraktar AKINCI TİHA ilk kez gökyüzüyle buluştu', 'Bayraktar insansız hava aracının gelişmiş versiyonu olarak tasarlanan Akıncı İnsansız Hava Aracı ilk kez gökyüzü ile buluştu. Bin 350 kilo yük taşıyabilen ve 40 bin feet irtifaya çıkan İHA 24 saat havada kalabiliyor.', '2019-12-04', 'https://www.ntv.com.tr/turkiye/bayraktar-akinci-tiha-ilk-kez-gokyuzuyle-bulustu,9d3wi8-nAEOYEctvolLpKw', 'news', 'link'),
(2, 'Google Fonts', 'Google Fonts is a library of 960 free licensed fonts, an interactive web directory for browsing the library, and APIs for conveniently using the fonts via CSS and Android.', '2019-12-17', 'https://fonts.google.com/', 'tech', 'link'),
(3, 'Cordova Pause and Resume Events - YouTube', 'https://www.youtube.com/embed/FfYXu-lhQ_A', '2019-12-11', 'https://www.youtube.com/embed/FfYXu-lhQ_A', 'tech', 'youtube'),
(4, 'Acordeão, a song by Tiësto, MOSKA on Spotify', 'Tiesto new song. Tijs Michiel Verwest OON, better known by his stage name Tiësto, is a Dutch DJ and record producer from Breda. He was named "the Greatest DJ of All Time" by Mix magazine in a poll vot', '2019-12-11', 'https://open.spotify.com/track/4P7F3kb2Ze1YleD6lUYwJo', 'music', 'spotify');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `comment` varchar(340) NOT NULL,
  `which_user` int(200) NOT NULL,
  `which_card` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `favorites`
--

CREATE TABLE `favorites` (
  `fid` int(11) NOT NULL,
  `which_user` int(200) NOT NULL,
  `which_card` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `favorites`
--

INSERT INTO `favorites` (`fid`, `which_user`, `which_card`) VALUES
(5, 1, 2),
(7, 1, 3),
(12, 2, 4),
(13, 2, 3);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `mail` varchar(200) NOT NULL,
  `pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `user`
--

INSERT INTO `user` (`id`, `username`, `mail`, `pass`) VALUES
(1, 'fatay', 'fataycomputers@gmail.com', 'a13e13b3f7b23a9ee4eb769a695f6839'),
(2, 'ismail', 'isba@hotmail.com', '25f9e794323b453885f5181f1b624d0b');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`card_id`);

--
-- Tablo için indeksler `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`fid`);

--
-- Tablo için indeksler `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `card`
--
ALTER TABLE `card`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Tablo için AUTO_INCREMENT değeri `favorites`
--
ALTER TABLE `favorites`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Tablo için AUTO_INCREMENT değeri `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
