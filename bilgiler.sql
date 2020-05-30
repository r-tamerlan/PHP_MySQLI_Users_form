-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 16 Eki 2018, 11:52:07
-- Sunucu sürümü: 5.7.23
-- PHP Sürümü: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `ogrenci`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bilgiler`
--

DROP TABLE IF EXISTS `bilgiler`;
CREATE TABLE IF NOT EXISTS `bilgiler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `soyad` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `memleket` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `maas` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `bilgiler`
--

INSERT INTO `bilgiler` (`id`, `ad`, `soyad`, `memleket`, `maas`) VALUES
(1, 'Selim', 'turgut', 'sinop', '2700'),
(3, 'musa', 'lama', 'sinop', '3500'),
(4, 'olcay', 'kalyoncu', 'istanbul', '3000'),
(5, 'yalçın', 'kabak', 'zonguldak', '5000'),
(6, 'ayşe', 'yılmaz', 'samsun', '1600');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
