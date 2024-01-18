-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 09 Oca 2024, 18:17:06
-- Sunucu sürümü: 8.0.27-18
-- PHP Sürümü: 8.1.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `kerem`
--
CREATE DATABASE IF NOT EXISTS `kerem` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `kerem`;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `gorevler`
--

CREATE TABLE `gorevler` (
  `id` int NOT NULL,
  `proje_id` int NOT NULL,
  `ekleyen` int NOT NULL,
  `sorumlu` varchar(255) NOT NULL,
  `gorev` varchar(255) NOT NULL,
  `start` int NOT NULL,
  `end` int NOT NULL,
  `durum` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Tablo döküm verisi `gorevler`
--

INSERT INTO `gorevler` (`id`, `proje_id`, `ekleyen`, `sorumlu`, `gorev`, `start`, `end`, `durum`) VALUES
(1, 1, 16, '12,9,12', 'Web Sitesi Yenileme', 1643870262, 1641671067, 0),
(2, 17, 16, '10,3,8', 'Finansal Analiz ve Raporlama', 1698691808, 1699296425, 1),
(3, 15, 14, '1,5,1', 'Yeni Ürün Lansmanı', 1696301055, 1696723668, 0),
(4, 12, 18, '19,20,19', 'E-Ticaret Stratejisi Geliştirme', 1688756181, 1686401795, 1),
(5, 10, 17, '13,16,15', 'Sosyal Medya Yönetimi', 1678958808, 1679887838, 0),
(6, 13, 21, '11,15,20', 'Yazılım Test ve Kalite Güvencesi', 1689208655, 1694975962, 1),
(7, 21, 5, '16,21,10', 'Enerji Verimliliği İyileştirmesi', 1712764538, 1716520920, 0),
(8, 20, 7, '1,4,16', 'Müşteri İlişkileri Yönetimi', 1706555183, 1714977788, 1),
(9, 3, 1, '11,8,7', 'Yazılım Güncelleme', 1652818398, 1650680093, 1),
(10, 11, 1, '9,20,6', 'Müşteri Memnuniyeti Analizi', 1684366632, 1681844938, 1),
(11, 7, 6, '7,18,2', 'SEO Stratejileri Geliştirme', 1669629682, 1665410344, 0),
(12, 18, 7, '7,14,4', 'Ekip Verimliliği Artırma', 1707111668, 1701119698, 0),
(13, 28, 8, '10,3,7', 'Dijital Pazarlama Kampanyası', 1726979542, 1731806369, 1),
(14, 6, 2, '5,16,22', 'Veritabanı Optimizasyonu', 1664735190, 1662627430, 0),
(15, 22, 4, '12,5,9', 'Siber Güvenlik Güncelleme', 1713849293, 1713656367, 0),
(16, 23, 21, '6,13,3', 'İnovasyon ve Ar-Ge', 1720503694, 1718197295, 0),
(17, 27, 3, '3,3,9', 'Yazılım Eğitim Programı', 1728453311, 1728674614, 0),
(18, 4, 16, '3,9,16', 'E-Ticaret Entegrasyonu', 1653477464, 1660077063, 0),
(19, 24, 4, '3,1,19', 'Çevre Dostu İnisiyatifler', 1718120837, 1720576927, 1),
(20, 26, 19, '7,21,17', 'Marka Yönetimi Stratejileri', 1721416829, 1729102255, 0),
(21, 14, 9, '22,19,7', 'Veri Analitiği Uygulaması', 1697241995, 1695470812, 1),
(22, 19, 15, '12,12,2', 'Güvenlik Altyapısı Güçlendirme', 1711257324, 1712185977, 0),
(23, 25, 18, '3,1,20', 'Sosyal Sorumluluk Projeleri', 1721013668, 1724914147, 1),
(24, 2, 10, '1,6,20', '<p>Mobil Uygulama Geliştirme</p>', 1704087180, 1707432840, 0),
(25, 29, 1, '19,4,4', 'Hedef Belirleme ve Strateji', 1731112450, 1729052379, 0),
(26, 16, 6, '15,14,4', 'İçerik Pazarlama Stratejisi', 1701086295, 1699615571, 1),
(27, 9, 12, '1,13,17', 'Eğitim Platformu Geliştirme', 1672308669, 1672884444, 1),
(28, 5, 3, '20,2,17', 'Proje Yönetim Sistemi', 1659867973, 1663688769, 1),
(29, 30, 9, '2', '<p>Eğitim ve Gelişim Programları</p>', 1675356360, 1675824660, 0),
(30, 8, 9, '2,4,12', 'E-Posta Pazarlama Kampanyası', 1668093886, 1669173558, 1),
(32, 1, 5, '7,20,14', 'Web Sitesi Yenileme', 1644085832, 1648770240, 0),
(40, 30, 9, '4', '<p>Web Sitesi G&uuml;venlik Analizi</p>', 1672837680, 1733292840, 1),
(41, 30, 7, '7', '<p>E-Ticaret Stratejisi Analizi</p>', 1704007680, 1707033600, 0),
(46, 30, 1, '4', '<p>G&ouml;rev i&ccedil;eriği <strong>buraya</strong>!xxxx</p>', 1704820560, 1705079760, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `logs`
--

CREATE TABLE `logs` (
  `id` int NOT NULL,
  `log` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `projeler`
--

CREATE TABLE `projeler` (
  `id` int NOT NULL,
  `ekleyen` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `start` int NOT NULL,
  `end` int NOT NULL,
  `status` int NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Tablo döküm verisi `projeler`
--

INSERT INTO `projeler` (`id`, `ekleyen`, `name`, `start`, `end`, `status`, `content`) VALUES
(1, 10, 'Web Sitesi Yenileme', 1641081600, 1649875200, 1, '<p><b>Web Sitesi Yenileme:</b> Web sitesinin tasarım ve içeriğini güncelleme çalışmaları. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut ex a elit luctus varius.</p>\r\n               <p>Proin facilisis, dolor nec elementum congue, turpis m'),
(2, 5, 'Mobil Uygulama Geliştirme', 1643760000, 1652553600, 1, '<p><b>Mobil Uygulama Geliştirme:</b> Yeni bir mobil uygulama geliştirme projesi. Fusce luctus, tortor vel convallis facilisis, odio tortor posuere lacus.</p>\r\n               <p>Cras gravida sem in sapien facilisis, eu fermentum turpis aliquet. Vestibulum '),
(3, 18, 'Yazılım Güncelleme', 1649232000, 1658025600, 1, '<p><b>Yazılım Güncelleme:</b> Mevcut yazılımın güncellenmesi ve hata düzeltme işlemleri. Vestibulum eu justo ut quam efficitur fringilla vitae nec mauris.</p>\r\n               <p>Phasellus euismod leo nec efficitur lacinia. Curabitur at justo ut massa maxi'),
(4, 7, 'E-Ticaret Entegrasyonu', 1651708800, 1660502400, 1, '<p><b>E-Ticaret Entegrasyonu:</b> E-Ticaret platformuna entegrasyon sağlama projesi. Integer vitae ex ut est efficitur imperdiet non ut est.</p>\r\n               <p>Pellentesque sollicitudin augue non metus suscipit, ac tincidunt urna sagittis. In hac habi'),
(5, 15, 'Proje Yönetim Sistemi', 1656288000, 1665081600, 1, '<p><b>Veritabanı Optimizasyonu:</b> Veritabanı performansını artırmak amacıyla optimizasyon ve indeksleme çalışmaları. Duis bibendum eros et urna commodo, vel dapibus arcu gravida.</p>\r\n               <p>Nulla facilisi. Proin id semper risus, sit amet ali'),
(6, 3, 'Veritabanı Optimizasyonu', 1658966400, 1667760000, 1, '<p><b>Büyüme Stratejisi Geliştirme:</b> Şirketin büyüme stratejilerini belirleme ve uygulama projesi. In hac habitasse platea dictumst. Sed consectetur tincidunt leo id eleifend.</p>\r\n               <p>Phasellus ac diam at metus mattis convallis vel vel n'),
(7, 12, 'SEO Stratejileri Geliştirme', 1661452800, 1670246400, 1, '<p><b>İş Süreçleri Analizi:</b> Şirket içindeki iş süreçlerini inceleme ve analiz etme projesi. Etiam vitae sapien a justo placerat tincidunt.</p>\r\n               <p>Maecenas sit amet enim a libero volutpat vehicula. Nam vestibulum, purus sit amet varius '),
(8, 21, 'E-Posta Pazarlama Kampanyası', 1666617600, 1675411200, 1, '<p><b>Finansal Strateji Belirleme:</b> Şirketin finansal hedeflerini belirleme ve stratejik plan oluşturma projesi. Sed ac nisi eu nunc tristique fermentum.</p>\r\n               <p>Vivamus id justo nec augue efficitur volutpat. Sed finibus, risus eu vehicu'),
(9, 2, 'Eğitim Platformu Geliştirme', 1671542400, 1680336000, 1, '<p><b>Kurumsal İletişim Geliştirme:</b> Şirket içi ve dışı iletişimi güçlendirmek amacıyla projeler ve eğitim programları düzenleme projesi. Maecenas et justo id turpis tempus fermentum.</p>\r\n               <p>Vestibulum auctor sem ac mauris mattis, in su'),
(10, 14, 'Sosyal Medya Yönetimi', 1676534400, 1685328000, 1, '<p><b>Müşteri Geri Bildirim Analizi:</b> Müşteri geri bildirimlerini değerlendirme ve şirket stratejilerini güncelleme projesi. Aliquam eget urna sed turpis dignissim feugiat.</p>\r\n               <p>Integer ullamcorper libero vel aliquet bibendum. Sed nec'),
(11, 1, 'Müşteri Memnuniyeti Analizi', 1678896000, 1687689600, 1, '<p><b>Lojistik Süreç İyileştirme:</b> Şirket içindeki lojistik süreçlerin analizi ve iyileştirme çalışmaları projesi. Duis eu eros ac ligula tempus fringilla eu vel velit.</p>\r\n               <p>Nulla facilisi. Etiam vestibulum risus nec neque condimentum'),
(13, 11, 'Yazılım Test ve Kalite Güvencesi', 1686460800, 1695254400, 1, '<p><b>Ürün Yenileme Stratejisi:</b> Mevcut ürün portföyünü gözden geçirme ve yenileme stratejisi oluşturma projesi. Phasellus vulputate diam a purus consectetur facilisis.</p>\r\n               <p>Quisque eu arcu eu orci vestibulum euismod. Vivamus tincidun'),
(14, 22, 'Veri Analitiği Uygulaması', 1689129600, 1697923200, 1, '<p><b>İnsan Kaynakları Eğitimleri:</b> Şirket çalışanlarına yönelik eğitim programları düzenleme ve insan kaynakları stratejilerini güçlendirme projesi. Sed id magna eu sem eleifend posuere.</p>\r\n               <p>Maecenas ut massa ut felis tincidunt curs'),
(15, 9, 'Yeni Ürün Lansmanı', 1691548800, 1700342400, 1, '<p><b>Tedarik Zinciri Yönetimi:</b> Şirketin tedarik zinciri süreçlerini optimize etme projesi. Etiam tempus libero vel ligula venenatis, at tincidunt ex tristique.</p>\r\n               <p>Donec eget nisi ut augue consectetur vulputate. Fusce rhoncus aucto'),
(16, 20, 'İçerik Pazarlama Stratejisi', 1693934400, 1702728000, 1, '<p><b>Bilgi Güvenliği Analizi:</b> Şirketin bilgi güvenliği süreçlerini değerlendirme ve iyileştirme projesi. Sed vel turpis et ligula laoreet feugiat sit amet in massa.</p>\r\n               <p>Vivamus vitae justo vel libero volutpat vestibulum vel eu erat'),
(17, 8, 'Finansal Analiz ve Raporlama', 1696339200, 1705132800, 1, '<p><b>Yeni Ürün Lansmanı:</b> Yeni bir ürünün piyasaya sürülmesi projesi. Integer et ligula non nulla cursus tristique. Nullam vehicula tincidunt varius.</p>\r\n               <p>Phasellus eget risus vestibulum, facilisis purus vel, auctor turpis. Ut vel ve'),
(18, 4, 'Ekip Verimliliği Artırma', 1698800000, 1707593600, 1, '<p><b>Sürdürülebilirlik Raporlaması:</b> Şirketin sürdürülebilirlik performansını değerlendirme ve raporlama projesi. Morbi nec urna vel nunc dictum vestibulum.</p>\r\n               <p>Aliquam erat volutpat. Nulla facilisi. Vestibulum dignissim, lacus et h'),
(21, 13, 'Enerji Verimliliği İyileştirmesi', 1708947200, 1717740800, 1, '<p><b>Yapay Zeka Uygulama Geliştirme:</b> Şirketin iş süreçlerinde yapay zeka uygulamalarının geliştirilmesi projesi. Nulla facilisi. Sed euismod elit in quam tempus, et tincidunt nisi tincidunt.</p>\r\n               <p>Phasellus ac fermentum justo. In hac'),
(22, 19, 'Siber Güvenlik Güncelleme', 1711420800, 1720214400, 0, '<p><strong>Veri Analitiği ve Raporlama:</strong> Şirketin veri analitiği s&uuml;re&ccedil;lerini geliştirme ve etkili raporlama sağlama projesi. Aliquam vel tortor a dolor congue tristique vitae vel lacus.</p>\r\n<p>Curabitur fermentum, elit vel gravida imp'),
(23, 1, 'İnovasyon ve Ar-Ge', 1713811200, 1722604800, 1, '<p><b>İnovasyon Yönetimi:</b> Şirket içindeki inovasyon süreçlerini yönetme ve yeni fikirlerin geliştirilmesi projesi. Etiam at mauris eu nisl varius dapibus.</p>\r\n               <p>Integer sit amet leo at felis rhoncus fringilla ut id nisl. Morbi vestibu'),
(25, 6, 'Sosyal Sorumluluk Projeleri', 1718683200, 1727476800, 1, '<p><b>Siber Güvenlik İyileştirme:</b> Şirketin siber güvenlik önlemlerini güçlendirme ve eğitim programları düzenleme projesi. Donec ac luctus libero. Integer commodo ex vitae felis efficitur, vel hendrerit velit aliquam.</p>\r\n               <p>Curabitur '),
(26, 11, 'Marka Yönetimi Stratejileri', 1721088000, 1729881600, 1, '<p><b>Stratejik İşbirlikleri Geliştirme:</b> Şirketin stratejik işbirlikleri oluşturma projesi. Integer euismod quam in bibendum fermentum. Vivamus a bibendum tortor.</p>\r\n               <p>Maecenas vel neque a tellus dictum facilisis id sit amet ante. Se'),
(27, 3, 'Yazılım Eğitim Programı', 1723622400, 1732416000, 1, '<p><b>Marka Yönetimi:</b> Şirket markasının güçlendirilmesi ve marka yönetimi projesi. Aliquam erat volutpat. Nullam dignissim lacinia tristique.</p>\r\n               <p>Quisque gravida, sapien eu tincidunt tincidunt, mi nisi bibendum purus, vitae sollicit'),
(28, 16, 'Dijital Pazarlama Kampanyası', 1726104000, 1734897600, 1, '<p><b>Enerji Verimliliği Artırma:</b> Şirketin enerji verimliliğini artırmaya yönelik çalışmaların yürütülmesi projesi. Nulla facilisi. Aliquam ac augue eu augue imperdiet fermentum eu id tortor.</p>\r\n               <p>Sed ut tincidunt dolor. Etiam consec'),
(29, 8, 'Hedef Belirleme ve Strateji', 1728496000, 1737289600, 0, '<p><strong>&Ccedil;evresel S&uuml;rd&uuml;r&uuml;lebilirlik:</strong> Şirketin &ccedil;evresel s&uuml;rd&uuml;r&uuml;lebilirlik stratejilerini belirleme ve uygulama projesi. Fusce tristique vulputate fringilla.</p>\r\n<p>Curabitur nec neque vitae elit finib'),
(30, 4, 'Eğitim ve Gelişim Programları', 1699267200, 1708060800, 0, '<p><strong>M&uuml;şteri Deneyimi Geliştirme:</strong> Şirketin m&uuml;şteri deneyimini artırmaya y&ouml;nelik projelerin y&uuml;r&uuml;t&uuml;lmesi. Maecenas eu mi vel ex aliquet tincidunt.</p>\r\n<p>Suspendisse potenti. Sed commodo, velit in accumsan condi'),
(33, 1, 'Eğitim ve Gelişim Programları', 1699290660, 1733511840, 0, '<p>Proje i&ccedil;eriği <strong>buraya</strong>! Test</p>');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `surname`, `sex`) VALUES
(1, 'admin', '$2y$10$c0ZIYnrxT0j/lZpx2b9RnOP8r8Hr5WLmJRzmtbiEs4bVTWDRrEV.O', 'Kerem', 'Er', '006m.jpg'),
(2, 'ayse', '$2y$10$zUC31Sdv4aoyyqMSaG5mVe.dA8ep7svQ0mjEW8A24C6MsVxzzSDiW', 'Ayşe', 'Demir', '010f.jpg'),
(3, 'mehmet', '$2y$10$zUC31Sdv4aoyyqMSaG5mVe.dA8ep7svQ0mjEW8A24C6MsVxzzSDiW', 'Mehmet', 'Kaya', '050m.jpg'),
(4, 'fatma', '$2y$10$zUC31Sdv4aoyyqMSaG5mVe.dA8ep7svQ0mjEW8A24C6MsVxzzSDiW', 'Fatma', 'Çelik', '070f.jpg'),
(5, 'mustafa', '$2y$10$zUC31Sdv4aoyyqMSaG5mVe.dA8ep7svQ0mjEW8A24C6MsVxzzSDiW', 'Mustafa', 'Koç', '051m.jpg'),
(6, 'zeynep', '$2y$10$zUC31Sdv4aoyyqMSaG5mVe.dA8ep7svQ0mjEW8A24C6MsVxzzSDiW', 'Zeynep', 'Aydın', '046f.jpg'),
(7, 'emre', '$2y$10$zUC31Sdv4aoyyqMSaG5mVe.dA8ep7svQ0mjEW8A24C6MsVxzzSDiW', 'Emre', 'Şahin', '004m.jpg'),
(8, 'esra', '$2y$10$zUC31Sdv4aoyyqMSaG5mVe.dA8ep7svQ0mjEW8A24C6MsVxzzSDiW', 'Esra', 'Öztürk', '031f.jpg'),
(9, 'cem', '$2y$10$zUC31Sdv4aoyyqMSaG5mVe.dA8ep7svQ0mjEW8A24C6MsVxzzSDiW', 'Cem', 'Erdoğan', '067m.jpg'),
(10, 'hulya', '$2y$10$zUC31Sdv4aoyyqMSaG5mVe.dA8ep7svQ0mjEW8A24C6MsVxzzSDiW', 'Hülya', 'Güneş', '019f.jpg'),
(11, 'murat', '$2y$10$zUC31Sdv4aoyyqMSaG5mVe.dA8ep7svQ0mjEW8A24C6MsVxzzSDiW', 'Murat', 'Taş', '045m.jpg'),
(12, 'gizem', '$2y$10$zUC31Sdv4aoyyqMSaG5mVe.dA8ep7svQ0mjEW8A24C6MsVxzzSDiW', 'Gizem', 'Aktaş', '017f.jpg'),
(13, 'okan', '$2y$10$zUC31Sdv4aoyyqMSaG5mVe.dA8ep7svQ0mjEW8A24C6MsVxzzSDiW', 'Okan', 'Kurt', '027m.jpg'),
(14, 'derya', '$2y$10$zUC31Sdv4aoyyqMSaG5mVe.dA8ep7svQ0mjEW8A24C6MsVxzzSDiW', 'Derya', 'Yıldırım', '011f.jpg'),
(15, 'efe', '$2y$10$zUC31Sdv4aoyyqMSaG5mVe.dA8ep7svQ0mjEW8A24C6MsVxzzSDiW', 'Efe', 'Aydın', '048m.jpg'),
(16, 'gül', '$2y$10$zUC31Sdv4aoyyqMSaG5mVe.dA8ep7svQ0mjEW8A24C6MsVxzzSDiW', 'Gül', 'Güler', '057f.jpg'),
(17, 'oğuz', '$2y$10$zUC31Sdv4aoyyqMSaG5mVe.dA8ep7svQ0mjEW8A24C6MsVxzzSDiW', 'Oğuz', 'Tuncer', '065m.jpg'),
(18, 'sema', '$2y$10$zUC31Sdv4aoyyqMSaG5mVe.dA8ep7svQ0mjEW8A24C6MsVxzzSDiW', 'Sema', 'Güven', '006f.jpg'),
(19, 'okan', '$2y$10$zUC31Sdv4aoyyqMSaG5mVe.dA8ep7svQ0mjEW8A24C6MsVxzzSDiW', 'Okan', 'Uzun', '060m.jpg'),
(20, 'berna', '$2y$10$zUC31Sdv4aoyyqMSaG5mVe.dA8ep7svQ0mjEW8A24C6MsVxzzSDiW', 'Berna', 'Erten', '058f.jpg'),
(21, 'yiğit', '$2y$10$zUC31Sdv4aoyyqMSaG5mVe.dA8ep7svQ0mjEW8A24C6MsVxzzSDiW', 'Yiğit', 'Çetin', '036m.jpg'),
(22, 'ahmet', '$2y$10$zUC31Sdv4aoyyqMSaG5mVe.dA8ep7svQ0mjEW8A24C6MsVxzzSDiW', 'Ahmet', 'Yılmaz', '025m.jpg');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `gorevler`
--
ALTER TABLE `gorevler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `projeler`
--
ALTER TABLE `projeler`
  ADD UNIQUE KEY `id` (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `gorevler`
--
ALTER TABLE `gorevler`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Tablo için AUTO_INCREMENT değeri `projeler`
--
ALTER TABLE `projeler`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
