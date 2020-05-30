-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 15 Eki 2018, 23:14:18
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
-- Veritabanı: `uyeler`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kisisel`
--

DROP TABLE IF EXISTS `kisisel`;
CREATE TABLE IF NOT EXISTS `kisisel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `soyad` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `tc` int(11) NOT NULL,
  `meslek` varchar(15) COLLATE utf8_turkish_ci NOT NULL,
  `aidat` float NOT NULL,
  `yetki` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kisisel`
--

INSERT INTO `kisisel` (`id`, `ad`, `soyad`, `tc`, `meslek`, `aidat`, `yetki`) VALUES
(1, 'Hakan', 'Tunç', 1234567891, 'Diş Hekimi', 155, 1),
(5, 'olcay', 'kalyoncu', 1454574241, 'Mühendis', 250, 3),
(3, 'Ahmet', 'Kaçar', 2145365847, 'Ressam', 209, 2),
(4, 'Nermin', 'Soyak', 1241341534, 'Mimar', 330, 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
