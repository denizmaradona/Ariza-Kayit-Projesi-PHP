-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 23 Nis 2016, 13:36:13
-- Sunucu sürümü: 10.1.10-MariaDB
-- PHP Sürümü: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `sistem`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

CREATE TABLE `kullanici` (
  `id` smallint(6) NOT NULL,
  `sifre` varchar(20) NOT NULL,
  `isim` varchar(20) DEFAULT NULL,
  `soyisim` varchar(20) DEFAULT NULL,
  `email` varchar(63) NOT NULL,
  `tel_no` varchar(20) DEFAULT NULL,
  `dogum_tarih` date DEFAULT NULL,
  `adres` varchar(255) DEFAULT NULL,
  `kayit_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rank` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Tetikleyiciler `kullanici`
--
DELIMITER $$
CREATE TRIGGER `trg4` AFTER UPDATE ON `kullanici` FOR EACH ROW BEGIN
    DECLARE kul_isim VARCHAR(20);
    DECLARE kul_soyisim VARCHAR(20);
    
    SET kul_isim = (SELECT isim FROM kullanici WHERE id = NEW.id);
    SET kul_soyisim = (SELECT soyisim FROM kullanici WHERE id = NEW.id);
    
    UPDATE talep_yazisma SET yazan=CONCAT(kul_isim,' ',kul_soyisim) WHERE  talep_yazisma.yazan = CONCAT(OLD.isim,' ', OLD.soyisim) AND talep_yazisma.talep_id = (SELECT talep.id FROM talep WHERE talep.kullanici_id = NEW.id);
END
$$
DELIMITER ;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
