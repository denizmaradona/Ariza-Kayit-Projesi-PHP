-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 26 Nis 2016, 13:24:30
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

DELIMITER $$
--
-- Yordamlar
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_talep_cevapla` (IN `talep_no` SMALLINT, IN `talep_mesaj` VARCHAR(255), OUT `bilgi` VARCHAR(20))  BEGIN

  DECLARE talep_durum VARCHAR(20);
  
  SET talep_durum = (SELECT durum FROM talep WHERE id = talep_no);
  
  IF (talep_durum = 'İnceleniyor') THEN
    UPDATE talep SET durum = 'Cevaplandırıldı' WHERE id = talep_no;
    INSERT INTO talep_yazisma(yazan,mesaj,talep_id) VALUES('Müşteri Temsilcisi',talep_mesaj,talep_no);
    SET bilgi = 'iletildi';
    
  ELSE  
    SET bilgi = 'iletilemez';
  END IF;
  
  SELECT bilgi;
  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ariza_bilgilerini_degistir` (IN `ariza_id` SMALLINT, IN `ariza_marka` VARCHAR(20), IN `ariza_model` VARCHAR(20), IN `ariza_problem` VARCHAR(255), OUT `bilgi` VARCHAR(20))  BEGIN

  DECLARE ariza_durum VARCHAR(255);
  DECLARE tel_id SMALLINT;
  
  SET tel_id = (SELECT id FROM telefon WHERE marka=ariza_marka AND model=ariza_model);
  SET ariza_durum = (SELECT durum FROM ariza_kayit WHERE id = ariza_id);
  
  IF (ariza_durum = 'Onay bekliyor') THEN
    UPDATE ariza_kayit SET telefon_id = tel_id, problem = ariza_problem WHERE id = ariza_id;
    SET bilgi = 'degistirildi';
  
  ELSE
    SET bilgi = 'degistirilemez';
  END IF;
  
    SELECT bilgi;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ariza_detay_goster` (IN `ariza_no` SMALLINT)  BEGIN
  
  IF NOT EXISTS (SELECT * FROM durum_detay WHERE durum_detay.ariza_id = ariza_no AND durum LIKE '%fiyat onaylandı%') THEN
  
    SELECT ariza_kayit.durum, telefon.marka, telefon.model, ariza_kayit.detay, SUM(durum_detay.fiyat), ariza_kayit.verilis_tarih FROM ariza_kayit,telefon,durum_detay WHERE ariza_kayit.id = ariza_no AND telefon.id = ariza_kayit.telefon_id AND durum_detay.ariza_id = ariza_kayit.id AND durum_detay.durum NOT LIKE '%tespit edildi%' AND durum_detay.fiyat IS NOT NULL;
    
  ELSE
  
    SELECT ariza_kayit.durum, telefon.marka, telefon.model, ariza_kayit.detay, SUM(durum_detay.fiyat), ariza_kayit.verilis_tarih FROM ariza_kayit,telefon,durum_detay WHERE ariza_kayit.id = ariza_no AND telefon.id = ariza_kayit.telefon_id AND durum_detay.ariza_id = ariza_kayit.id AND durum_detay.fiyat IS NOT NULL;
    
  END IF; 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ariza_durum_guncelle` (IN `ariza_no` SMALLINT, IN `ariza_durum` VARCHAR(127), IN `ariza_detay` VARCHAR(255), IN `ariza_fiyat` SMALLINT)  BEGIN

      UPDATE ariza_kayit SET durum=ariza_durum , detay=ariza_detay WHERE id = ariza_no;
      INSERT INTO durum_detay(ariza_id,durum,detay,fiyat) VALUES(ariza_no,ariza_durum,ariza_detay,ariza_fiyat);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ariza_guncelleme_kontrol` (IN `ariza_no` SMALLINT, OUT `bilgi` VARCHAR(20))  BEGIN
  DECLARE ariza_durum VARCHAR(127);
  
  SET ariza_durum = (SELECT durum FROM ariza_kayit WHERE id = ariza_no);
  
  IF ariza_durum LIKE '%tespit edildi%' THEN
    SET bilgi = 'guncellenemez';
    
  ELSE
    SET bilgi = 'guncellenebilir';
    
  END IF;
  
  SELECT bilgi;
  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ariza_kaydini_sil` (IN `ariza_id` SMALLINT, OUT `bilgi` VARCHAR(20))  BEGIN

  DECLARE ariza_durum VARCHAR(127);
  SET ariza_durum = (SELECT durum FROM ariza_kayit WHERE id = ariza_id);
  
  IF (ariza_durum IN('Onay bekliyor','Onaylanmadı','Teslimat tamamlandı')) THEN
    DELETE FROM ariza_kayit WHERE id = ariza_id;
    SET bilgi = 'silindi';
  
  ELSE
    SET bilgi = 'silinemez';  
  END IF;
  
  SELECT bilgi;
  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ariza_kaydi_ver` (IN `kul_email` VARCHAR(63), IN `tel_marka` VARCHAR(20), IN `tel_model` VARCHAR(20), IN `tel_problem` VARCHAR(255), OUT `bilgi` VARCHAR(20))  BEGIN

  DECLARE kul_id SMALLINT;
  DECLARE tel_id SMALLINT;
  DECLARE kayit_sayisi SMALLINT;
  
  SET kul_id = (SELECT id FROM kullanici WHERE email = kul_email);
  SET kayit_sayisi = (SELECT COUNT(*) FROM ariza_kayit WHERE kullanici_id = kul_id);
  SET tel_id = (SELECT id FROM telefon WHERE marka = tel_marka AND model = tel_model);
  
  IF (kayit_sayisi >= 5) THEN
    SET bilgi = 'verilemez';
    
  ELSE
    INSERT INTO ariza_kayit(problem,kullanici_id,telefon_id) VALUES(tel_problem,kul_id,tel_id);
    SET bilgi = 'verildi';
  END IF;
  
  SELECT bilgi;
  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ariza_kayitlarini_goster` (IN `kul_email` VARCHAR(63))  BEGIN
  DECLARE kul_id SMALLINT;
  
  SET kul_id = (SELECT id FROM kullanici WHERE email = kul_email);
  SELECT ariza_kayit.id,telefon.marka,telefon.model,ariza_kayit.verilis_tarih,ariza_kayit.problem,ariza_kayit.durum,ariza_kayit.detay FROM kullanici,ariza_kayit,telefon WHERE kullanici.email = kul_email AND kullanici.id = ariza_kayit.kullanici_id AND ariza_kayit.telefon_id = telefon.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `butun_ariza_kayitlarini_goster` ()  BEGIN
  SELECT ariza_kayit.id, ariza_kayit.durum, telefon.marka, telefon.model, ariza_kayit.detay, ariza_kayit.verilis_tarih , sum(durum_detay.fiyat) FROM ariza_kayit, telefon, durum_detay WHERE ariza_kayit.telefon_id = telefon.id AND ariza_kayit.id = durum_detay.ariza_id GROUP BY ariza_kayit.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `durum_combobox` ()  BEGIN
  SELECT durum FROM olasi_durumlar WHERE durum NOT IN ('Onay bekliyor','İptal edildi','Verilen fiyat onaylandı','Verilen fiyat onaylanmadı');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `durum_detay_degistir` (IN `detay_id` SMALLINT, IN `ariza_durum` VARCHAR(127), IN `ariza_detay` VARCHAR(255), IN `ariza_fiyat` SMALLINT, OUT `bilgi` VARCHAR(20))  BEGIN

  IF (ariza_durum NOT IN('Onay bekliyor','İptal edildi','Verilen fiyat onaylandı','Verilen fiyat onaylanmadı')) THEN
    UPDATE durum_detay SET durum = ariza_durum , detay = ariza_detay , fiyat = ariza_fiyat WHERE id = detay_id;
    SET bilgi = 'degistirildi';
  
  ELSE
    SET bilgi = 'degistirilemez';
  END IF;
  
  SELECT bilgi;
  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `durum_gecmis_goster` (IN `ariza_no` SMALLINT)  BEGIN

  SELECT durum, detay, durum_tarih, fiyat FROM durum_detay WHERE ariza_id = ariza_no  ORDER BY id ASC;
  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `fiyati_onayla` (IN `ariza_no` SMALLINT)  BEGIN

  UPDATE ariza_kayit SET durum = 'Verilen fiyat onaylandı',detay = 'Verilen fiyat müşteri tarafından onaylanmıştır' WHERE id = ariza_no;
  INSERT INTO durum_detay(durum,detay,ariza_id,fiyat) VALUES('Verilen fiyat onaylandı','Verilen fiyat müşteri tarafından onaylanmıştır',ariza_no,0);
  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `fiyati_onaylama` (IN `ariza_no` SMALLINT)  BEGIN
  
  UPDATE ariza_kayit SET durum = 'Verilen fiyat onaylanmadı',detay = 'Verilen fiyat müşteri tarafından onaylanmamıştır' WHERE id = ariza_no;
  INSERT INTO durum_detay(durum,detay,ariza_id,fiyat) VALUES('Verilen fiyat onaylanmadı','Verilen fiyat müşteri tarafından onaylanmamıştır',ariza_no,0);
  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `giris_yap` (IN `kul_email` VARCHAR(63), IN `kul_sifre` VARCHAR(20), OUT `bilgi` VARCHAR(31))  BEGIN

  DECLARE parola VARCHAR(20);
  DECLARE rutbe SMALLINT;
  
  IF NOT EXISTS(SELECT * FROM kullanici WHERE email = kul_email) THEN
    SET bilgi = 'kullanici yok';
  
  ELSE
    SET parola = (SELECT sifre FROM kullanici WHERE email = kul_email);
    SET rutbe = (SELECT rank FROM kullanici WHERE email = kul_email );
    IF (parola = kul_sifre) THEN
      IF (rutbe = 1) THEN
        SET bilgi = 'kullanici girisi basarili';
        
      ELSE
        SET bilgi = 'temsilci girisi basarili';
      END IF;
    ELSE
      SET bilgi = 'sifre hatali';
    END IF;
  END IF;
  
  SELECT bilgi;
  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hesabi_sil` (IN `kul_email` VARCHAR(63), IN `kul_sifre` VARCHAR(20), OUT `bilgi` VARCHAR(20))  BEGIN

  DECLARE parola VARCHAR(20);
  DECLARE kul_id SMALLINT;
  
  IF NOT EXISTS (SELECT * FROM kullanici,ariza_kayit WHERE kullanici.email = kul_email AND ariza_kayit.kullanici_id = kullanici.id AND ariza_kayit.durum NOT IN ('Onay bekliyor','İptal edildi','Onaylanmadı','Teslimat tamamlandı')) THEN
    SET parola = (SELECT sifre FROM kullanici WHERE email = kul_email);
    SET kul_id = (SELECT id FROM kullanici WHERE email = kul_email);
    
    IF (parola = kul_sifre) THEN
      DELETE FROM kullanici WHERE id = kul_id;
      SET bilgi='silindi';
      
    ELSE
      SET bilgi= 'hatali sifre';
      
    END IF;  
    
  ELSE
    SET bilgi='silinemez';
  END IF;
  
  SELECT bilgi;
  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hesap_silimi_kontrol` (IN `kul_email` VARCHAR(63), OUT `bilgi` VARCHAR(20))  BEGIN
  DECLARE kul_id SMALLINT;
  SET kul_id = (SELECT id FROM kullanici WHERE email = kul_email);
  
  IF EXISTS (SELECT * FROM ariza_kayit WHERE kullanici_id = kul_id AND durum NOT IN ('Onay bekliyor','Onaylanmadı','Teslimat tamamlandı')) THEN
    SET bilgi = 'silemez';
  ELSE
    SET bilgi = 'silebilir';
  END IF;
  
  SELECT bilgi;
  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `isim_cek` (IN `kul_email` VARCHAR(63), OUT `kul_isim` VARCHAR(20))  BEGIN
  SET kul_isim = (SELECT UPPER(isim) FROM kullanici WHERE email = kul_email);
  SELECT kul_isim;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `kayit_ol` (IN `kul_email` VARCHAR(63), IN `kul_isim` VARCHAR(20), IN `kul_soyisim` VARCHAR(20), IN `kul_sifre` VARCHAR(20), IN `kul_tel_no` VARCHAR(20), IN `kul_dogum_tarih` VARCHAR(10), IN `kul_adres` VARCHAR(255), OUT `bilgi` VARCHAR(31))  BEGIN

  DECLARE rutbe SMALLINT DEFAULT 1;
  
  IF NOT EXISTS (SELECT * FROM kullanici WHERE email = kul_email) THEN
    INSERT INTO kullanici(email,isim,soyisim,sifre,tel_no,dogum_tarih,adres,rank) VALUES(kul_email,kul_isim,kul_soyisim,kul_sifre,kul_tel_no,STR_TO_DATE(kul_dogum_tarih,'%d/%m/%Y'),kul_adres,rutbe);
    SET bilgi='kayit basarili';
    
  ELSE
    SET bilgi='email kullanilmakta';
  END IF;
  
  SELECT bilgi;
  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `kisisel_bilgileri_cek` (IN `kul_email` VARCHAR(63))  BEGIN
  SELECT isim,soyisim,tel_no,DATE_FORMAT(dogum_tarih,'%d/%m/%Y'),adres FROM kullanici WHERE email = kul_email ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `kisisel_bilgileri_guncelle` (IN `kul_isim` VARCHAR(20), IN `kul_soyisim` VARCHAR(20), IN `eski_kul_email` VARCHAR(63), IN `kul_email` VARCHAR(63), IN `kul_tel_no` VARCHAR(20), IN `kul_dogum_tarih` VARCHAR(10), IN `kul_adres` VARCHAR(255))  BEGIN

  DECLARE kul_id SMALLINT;
  
  SET kul_id = (SELECT id FROM kullanici WHERE email = eski_kul_email);
  UPDATE kullanici SET isim=kul_isim,soyisim=kul_soyisim,email=kul_email,tel_no=kul_tel_no,dogum_tarih=STR_TO_DATE(kul_dogum_tarih,'%d/%m/%Y'),adres=kul_adres WHERE id = kul_id;
  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `konusma_gecmis_goster` (IN `talep_no` SMALLINT)  BEGIN
  SELECT talep_yazisma.yazan, talep_yazisma.mesaj, talep_yazisma.mesaj_tarih FROM talep_yazisma WHERE talep_yazisma.talep_id = talep_no;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `kullanicilari_goster` ()  BEGIN

  SELECT isim,soyisim,email,tel_no,kayit_tarih,adres FROM kullanici WHERE rank = 1;
  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `kul_talep_cevapla` (IN `talep_no` SMALLINT, IN `talep_mesaj` VARCHAR(255), IN `kul_email` VARCHAR(63), OUT `bilgi` VARCHAR(20))  BEGIN

  DECLARE kul_isim VARCHAR(20);
  DECLARE kul_soyisim VARCHAR(20);
  DECLARE isim_soyisim VARCHAR(40);
  DECLARE talep_durum VARCHAR(20);
  
  SET talep_durum = (SELECT durum FROM talep WHERE id = talep_no);
  
  IF (talep_durum = 'Cevaplandırıldı') THEN
    SET kul_isim = (SELECT isim FROM kullanici WHERE email = kul_email);
    SET kul_soyisim = (SELECT soyisim FROM kullanici WHERE email = kul_email);
    SET isim_soyisim = (SELECT CONCAT (kul_isim,' ',kul_soyisim));
    
    UPDATE talep SET durum = 'İnceleniyor' WHERE id = talep_no;
    
    INSERT INTO talep_yazisma(yazan,mesaj,talep_id) VALUES(isim_soyisim,talep_mesaj,talep_no);
    
    SET bilgi = 'iletildi';
    
  ELSE 
    SET bilgi = 'iletilemez';
  END IF;  
  
  SELECT bilgi;  
  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `marka_combobox` ()  BEGIN
  SELECT DISTINCT marka FROM telefon ORDER BY marka ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `model_combobox` (IN `tel_marka` VARCHAR(20))  BEGIN
  SELECT model FROM telefon  WHERE marka = tel_marka ORDER BY model ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `musteri_talepleri` (IN `kul_email` VARCHAR(63))  BEGIN

  DECLARE kul_id SMALLINT;
  #DECLARE islem_tarih TIMESTAMP;
  
  SET kul_id = (SELECT id FROM kullanici WHERE email = kul_email);
  #SET islem_tarih = (SELECT talep_yazisma.mesaj_tarih FROM talep_yazisma,talep WHERE talep.kullanici_id = kul_id AND talep.id = talep_yazisma.talep_id ORDER BY talep_yazisma.id DESC LIMIT 1);
  
  SELECT talep.id, talep.olusturma_tarih, MAX(talep_yazisma.mesaj_tarih), talep.konu, talep.durum FROM talep, talep_yazisma  WHERE talep.kullanici_id = kul_id AND talep.id = talep_yazisma.talep_id GROUP BY talep.id;

  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sifre_degistir` (IN `kul_email` VARCHAR(63), IN `kul_sifre` VARCHAR(20))  BEGIN
  UPDATE kullanici SET sifre = kul_sifre WHERE email = kul_email; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sifre_unuttum` (IN `kul_email` VARCHAR(63), OUT `kul_sifre` VARCHAR(20), OUT `bilgi` VARCHAR(20))  BEGIN

  IF EXISTS(SELECT * FROM kullanici WHERE email=kul_email) THEN
    SET kul_sifre = (SELECT sifre FROM kullanici WHERE email = kul_email);
    SET bilgi='kullanici var';
  
  ELSE
    SET bilgi='kullanici yok';
  END IF;
  
  SELECT bilgi,kul_sifre;
 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `talepleri_goster` ()  BEGIN
  SELECT talep.id, CONCAT(kullanici.isim,' ',kullanici.soyisim), (SELECT talep_yazisma.yazan FROM talep_yazisma WHERE talep_yazisma.talep_id = talep.id ORDER BY talep_yazisma.id DESC LIMIT 1), talep.olusturma_tarih, MAX(talep_yazisma.mesaj_tarih), talep.konu, talep.durum FROM kullanici, talep, talep_yazisma WHERE kullanici.id = talep.kullanici_id AND talep.id = talep_yazisma.talep_id GROUP BY talep.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `talep_olustur` (IN `talep_konu` VARCHAR(63), IN `talep_icerik` VARCHAR(255), IN `kul_email` VARCHAR(63), OUT `bilgi` VARCHAR(20))  BEGIN

 DECLARE kul_id SMALLINT;
 DECLARE talep_sayisi SMALLINT;
 
 SET kul_id = (SELECT id FROM kullanici WHERE email=kul_email);
 SET talep_sayisi = (SELECT COUNT(*) FROM talep WHERE talep.kullanici_id = kul_id);
 
 IF (talep_sayisi < 5) THEN
  INSERT INTO talep(konu,icerik,durum,kullanici_id) VALUES(talep_konu,talep_icerik,'İnceleniyor',kul_id);
  SET bilgi= 'basarili';
  
 ELSE
  SET bilgi='basarisiz';
  
 END IF;
 
 SELECT bilgi;
 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `toplam_maliyet` (IN `ariza_no` SMALLINT, OUT `toplam` SMALLINT)  BEGIN
  IF NOT EXISTS(SELECT durum FROM durum_detay WHERE durum_detay.ariza_id = ariza_no AND durum LIKE '%fiyat onaylandı%') THEN
  
    SET toplam = (SELECT SUM(fiyat) FROM durum_detay WHERE ariza_id = ariza_no AND fiyat IS NOT NULL AND durum NOT LIKE '%tespit%');
    
  ELSE
  
    SET toplam = (SELECT SUM(fiyat) FROM durum_detay WHERE ariza_id = ariza_no AND fiyat IS NOT NULL);

  END IF;
  
  SELECT toplam;
  
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ariza_kayit`
--

CREATE TABLE `ariza_kayit` (
  `id` smallint(6) NOT NULL,
  `problem` varchar(255) NOT NULL,
  `verilis_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `durum` varchar(127) NOT NULL DEFAULT 'Onay bekliyor',
  `detay` varchar(255) DEFAULT 'Arıza kaydınız onay beklemektedir. Lütfen daha sonra tekrar bakınız',
  `kullanici_id` smallint(6) NOT NULL,
  `telefon_id` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Tetikleyiciler `ariza_kayit`
--
DELIMITER $$
CREATE TRIGGER `trg1` AFTER INSERT ON `ariza_kayit` FOR EACH ROW BEGIN
  
    DECLARE fiyat SMALLINT DEFAULT 0;
    INSERT INTO durum_detay(ariza_id,durum,detay,fiyat) VALUES(NEW.id,NEW.durum,NEW.detay,fiyat);
    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `durum_detay`
--

CREATE TABLE `durum_detay` (
  `id` smallint(6) NOT NULL,
  `durum` varchar(127) NOT NULL,
  `detay` varchar(255) DEFAULT NULL,
  `fiyat` smallint(6) DEFAULT NULL,
  `durum_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ariza_id` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Tetikleyiciler `durum_detay`
--
DELIMITER $$
CREATE TRIGGER `trg2` AFTER UPDATE ON `durum_detay` FOR EACH ROW BEGIN
  
    DECLARE ariza_durum VARCHAR(255);
    DECLARE son_durum VARCHAR(255);
    
    SET son_durum = (SELECT OLD.durum FROM durum_detay WHERE ariza_id = NEW.ariza_id ORDER BY id DESC LIMIT 1);
    SET ariza_durum = (SELECT durum FROM ariza_kayit WHERE id = NEW.ariza_id);
    
    IF (son_durum = ariza_durum) THEN
      UPDATE ariza_kayit SET durum = NEW.durum , detay = NEW.detay;
    END IF;
    
END
$$
DELIMITER ;

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
-- Tablo döküm verisi `kullanici`
--

INSERT INTO `kullanici` (`id`, `sifre`, `isim`, `soyisim`, `email`, `tel_no`, `dogum_tarih`, `adres`, `kayit_tarih`, `rank`) VALUES
(3, '123456', NULL, NULL, 'temsilci1@arizakayit.com', NULL, NULL, NULL, '2016-04-26 11:24:24', 2);

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

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `olasi_durumlar`
--

CREATE TABLE `olasi_durumlar` (
  `id` smallint(6) NOT NULL,
  `durum` varchar(63) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Tablo döküm verisi `olasi_durumlar`
--

INSERT INTO `olasi_durumlar` (`id`, `durum`) VALUES
(1, 'Onay bekliyor'),
(2, 'Onaylandı'),
(3, 'Onaylanmadı'),
(4, 'İptal edildi'),
(5, 'Ekip yollandı'),
(6, 'Telefon alındı'),
(7, 'Teknik ekibe teslim edildi'),
(8, 'Arıza tespit edildi ve fiyat verildi'),
(9, 'Verilen fiyat onaylandı'),
(10, 'Verilen fiyat onaylanmadı'),
(11, 'Onarım aşamasında'),
(12, 'Onarıldı'),
(13, 'Kargolandı'),
(14, 'Teslimat tamamlandı');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `talep`
--

CREATE TABLE `talep` (
  `id` smallint(6) NOT NULL,
  `konu` varchar(63) NOT NULL,
  `icerik` varchar(255) NOT NULL,
  `olusturma_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `durum` varchar(20) NOT NULL,
  `kullanici_id` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Tetikleyiciler `talep`
--
DELIMITER $$
CREATE TRIGGER `trg3` AFTER INSERT ON `talep` FOR EACH ROW BEGIN
    DECLARE kul_isim VARCHAR(20);
    DECLARE kul_soyisim VARCHAR(20);
    DECLARE isim_soyisim VARCHAR(40);
    
    SET kul_isim = (SELECT isim FROM kullanici WHERE id = NEW.kullanici_id);
    SET kul_soyisim = (SELECT soyisim FROM kullanici WHERE id = NEW.kullanici_id);
    SET isim_soyisim = (SELECT CONCAT (kul_isim,' ',kul_soyisim));
    
    INSERT INTO talep_yazisma(yazan,mesaj,talep_id) VALUES(isim_soyisim,NEW.icerik,NEW.id);
    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `talep_yazisma`
--

CREATE TABLE `talep_yazisma` (
  `id` smallint(6) NOT NULL,
  `yazan` varchar(63) NOT NULL,
  `mesaj` varchar(255) NOT NULL,
  `mesaj_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `talep_id` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `telefon`
--

CREATE TABLE `telefon` (
  `id` smallint(6) NOT NULL,
  `marka` varchar(20) NOT NULL,
  `model` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Tablo döküm verisi `telefon`
--

INSERT INTO `telefon` (`id`, `marka`, `model`) VALUES
(1, 'Nokia', 'Lumia 520'),
(2, 'Nokia', 'Lumia 620'),
(3, 'Nokia', 'Lumia 720'),
(4, 'Nokia', 'Lumia 820'),
(5, 'Nokia', 'Lumia 920'),
(6, 'Nokia', 'Lumia 1020'),
(7, 'Nokia', 'Lumia 1320'),
(8, 'Nokia', 'Lumia 1520'),
(9, 'Nokia', 'Lumia 930'),
(10, 'Nokia', 'Lumia 925'),
(11, 'Samsung', 'Galaxy S3'),
(12, 'Samsung', 'Galaxy S3 Mini'),
(13, 'Samsung', 'Galaxy S4'),
(14, 'Samsung', 'Galaxy S4 Mini'),
(15, 'Samsung', 'Galaxy S5'),
(16, 'Samsung', 'Galaxy S5 Mini'),
(17, 'Samsung', 'Galaxy S6'),
(18, 'Samsung', 'Galaxy S6 Edge'),
(19, 'Samsung', 'Galaxy Note Edge'),
(20, 'Samsung', 'Galaxy Note 3'),
(21, 'Samsung ', 'Galaxy Note 4'),
(22, 'iPhone', '3GS'),
(23, 'iPhone', '4'),
(24, 'iPhone', '4S'),
(25, 'iPhone', '5'),
(26, 'iPhone', '5C'),
(27, 'iPhone', '5S'),
(28, 'iPhone', '6'),
(29, 'iPhone', '6 PLUS'),
(30, 'LG', 'G2'),
(31, 'LG', 'G3'),
(32, 'LG', 'G4'),
(33, 'LG', 'Nexus 5'),
(34, 'LG', 'G'),
(35, 'LG', 'Optimus'),
(36, 'Sony', 'Xperia Z'),
(37, 'Sony', 'Xperia Z1'),
(38, 'Sony', 'Xperia Z2'),
(39, 'Sony', 'Xperia Z3'),
(40, 'HTC', 'One M8'),
(41, 'HTC', 'One M8 Mini'),
(42, 'HTC', 'One M9+'),
(43, 'HTC', 'One M9'),
(44, 'HTC', 'One'),
(45, 'HTC', 'Desire'),
(46, 'Blackberry', 'Q10'),
(47, 'Blackberry', 'Z10'),
(48, 'Blackberry', 'Classic'),
(49, 'Blackberry', 'Passport'),
(50, 'Blackberry', 'Z30'),
(51, 'Blackberry', 'Leap'),
(52, 'General Mobile', 'Discovery'),
(53, 'General Mobile', 'Discovery 2'),
(54, 'General Mobile', '4G Android One'),
(55, 'General Mobile', 'Discovery 2 Mini'),
(56, 'General Mobile', 'Elite'),
(57, 'General Mobile', 'Air'),
(58, 'Huawei', 'Ascend P6'),
(59, 'Huawei', 'Ascend P7'),
(60, 'Huawei', 'Ascend G7'),
(61, 'Huawei', 'Ascend Mate 7'),
(62, 'Vestel', 'Venüs 5.0X'),
(63, 'Vestel', 'Venüs 5.5V'),
(64, 'Lenovo', 'Vibe X2'),
(65, 'Lenovo', 'Vibe Z2'),
(66, 'Lenovo', 'S90'),
(67, 'Lenovo', 'S580'),
(68, 'Lenovo', 'Vibe Z2 Pro'),
(69, 'Lenovo', 'Lenovo S850'),
(70, 'Casper', 'Via V6'),
(71, 'Casper', 'Via V5'),
(72, 'Casper', 'Via V8'),
(73, 'Casper', 'Via'),
(74, 'Casper', 'Via V8c'),
(75, 'Casper', 'Via V6X'),
(76, 'Asus', 'Zenfone 2'),
(77, 'Asus', 'Zenfone 4'),
(78, 'Asus', 'Zenfone 5'),
(79, 'Asus', 'Zenfone 6'),
(80, 'Avea', 'inTouch 4'),
(81, 'Turkcell', 'T50'),
(82, 'Turkcell', 'T60');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ariza_kayit`
--
ALTER TABLE `ariza_kayit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ariza_kayit_ibfk_1` (`kullanici_id`),
  ADD KEY `ariza_kayit_ibfk_2` (`telefon_id`);

--
-- Tablo için indeksler `durum_detay`
--
ALTER TABLE `durum_detay`
  ADD PRIMARY KEY (`id`),
  ADD KEY `durum_detay_ibfk_1` (`ariza_id`);

--
-- Tablo için indeksler `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Tablo için indeksler `olasi_durumlar`
--
ALTER TABLE `olasi_durumlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `talep`
--
ALTER TABLE `talep`
  ADD PRIMARY KEY (`id`),
  ADD KEY `talep_ibfk_1` (`kullanici_id`);

--
-- Tablo için indeksler `talep_yazisma`
--
ALTER TABLE `talep_yazisma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `talep_id` (`talep_id`);

--
-- Tablo için indeksler `telefon`
--
ALTER TABLE `telefon`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ariza_kayit`
--
ALTER TABLE `ariza_kayit`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Tablo için AUTO_INCREMENT değeri `durum_detay`
--
ALTER TABLE `durum_detay`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Tablo için AUTO_INCREMENT değeri `olasi_durumlar`
--
ALTER TABLE `olasi_durumlar`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Tablo için AUTO_INCREMENT değeri `talep`
--
ALTER TABLE `talep`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Tablo için AUTO_INCREMENT değeri `talep_yazisma`
--
ALTER TABLE `talep_yazisma`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Tablo için AUTO_INCREMENT değeri `telefon`
--
ALTER TABLE `telefon`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `ariza_kayit`
--
ALTER TABLE `ariza_kayit`
  ADD CONSTRAINT `ariza_kayit_ibfk_1` FOREIGN KEY (`kullanici_id`) REFERENCES `kullanici` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ariza_kayit_ibfk_2` FOREIGN KEY (`telefon_id`) REFERENCES `telefon` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `durum_detay`
--
ALTER TABLE `durum_detay`
  ADD CONSTRAINT `durum_detay_ibfk_1` FOREIGN KEY (`ariza_id`) REFERENCES `ariza_kayit` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `talep`
--
ALTER TABLE `talep`
  ADD CONSTRAINT `talep_ibfk_1` FOREIGN KEY (`kullanici_id`) REFERENCES `kullanici` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `talep_yazisma`
--
ALTER TABLE `talep_yazisma`
  ADD CONSTRAINT `talep_yazisma_ibfk_1` FOREIGN KEY (`talep_id`) REFERENCES `talep` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
