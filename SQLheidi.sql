-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for demodatabase
DROP DATABASE IF EXISTS `demodatabase`;
CREATE DATABASE IF NOT EXISTS `demodatabase` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `demodatabase`;

-- Dumping structure for table demodatabase.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `material` varchar(255) NOT NULL,
  `size` varchar(100) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `moredescription` varchar(10000) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table demodatabase.products: ~7 rows (approximately)
INSERT INTO `products` (`id`, `image`, `title`, `description`, `material`, `size`, `supplier`, `price`, `moredescription`, `color`) VALUES
	(1, 'assets/images/bed1.jpg', 'Giường Hoàng Gia Siêu Sang', 'Giường phong cách hoàng gia, chạm trổ tinh xảo, mang đến giấc ngủ đẳng cấp quý tộc.', 'Gỗ sồi tự nhiên, nệm cao cấp', '1m8 x 2m', 'Nội Thất Hoàng Gia', 15900000.00, 'Bạn đã từng mơ thấy mình là một hoàng tử hay công chúa chưa? Đừng chỉ mơ, hãy biến giấc mơ thành hiện thực với chiếc giường Hoàng Gia Siêu Sang này! Với thiết kế tinh xảo như trong lâu đài, bạn sẽ ngủ ngon đến mức không cần báo thức cũng tự dậy trong tâm thế quyền quý!\n', 'Trắng ngà, vàng đồng'),
	(2, 'assets/images/bed2.webp', 'Giường Gỗ Tự Nhiên "Mộc Mạc Mà Sang"', 'Thiết kế đơn giản nhưng đầy tinh tế, phù hợp với mọi không gian.', 'Gỗ xoan đào', '1m6 x 2m', 'Gỗ Việt Decor', 7500000.00, 'Một chiếc giường dành cho những ai yêu thích sự giản dị nhưng không kém phần thanh lịch. Mộc Mạc Mà Sang không chỉ giúp bạn ngủ ngon mà còn làm nổi bật phong cách sống tối giản nhưng vẫn đầy sang trọng. Cẩn thận, có thể bạn sẽ không muốn rời khỏi giường đâu!', 'Nâu gỗ tự nhiên'),
	(3, 'assets/images/bed3.jpg', 'Giường Thông Minh Biến Hình', 'Giường có thể gấp gọn, có ngăn kéo chứa đồ tiện lợi.', 'Gỗ MDF chống ẩm', '1m5 x 2m', 'SmartHome Việt Nam', 8200000.00, 'Không gian nhỏ nhưng muốn giường lớn? Không thành vấn đề! Giường Thông Minh Biến Hình sẽ giúp bạn tận dụng từng cm trong căn phòng. Sáng là giường, tối có thể thành ghế sofa, thậm chí còn có hộc tủ để bạn nhét mọi thứ từ chăn gối đến… bí mật cá nhân!', 'Trắng, đen, vân gỗ'),
	(4, 'assets/images/bed4.jpg', 'Giường Ngủ Siêu Êm "Mây Bay"', 'Giường bọc nệm êm ái, cảm giác ngủ như đang trôi trên mây.', 'Khung gỗ bọc nệm mousse cao cấp', '2m x 2m2', 'DreamSleep', 12300000.00, 'Nếu bạn đã từng muốn bay bổng trên mây nhưng không có điều kiện làm phi công, thì chiếc giường Mây Bay này chính là lựa chọn hoàn hảo! Độ êm ái vượt xa tiêu chuẩn giường thông thường, đảm bảo bạn sẽ ngủ ngon đến mức đồng hồ báo thức cũng phải ghen tị vì không đánh thức nổi bạn!', 'Xám, xanh dương'),
	(5, 'assets/images/bed5.jpg', 'Giường Cộng Sản', 'Thiết kế theo phong cách yêu nước, yêu Đảng', 'Khung sắt cao cấp', '1m8 x 2m2', 'Soviet Union', 30041975.00, 'Dành cho các công dân, cán bộ yêu nước, yêu Đảng. Khi nằm xuống, ta sẽ cảm nhận được một luồng ánh sáng rực rỡ từ các cụ Mác-Lenin rọi xuống đầu chúng ta, xóa mọi nghi ngờ và tư tưởng chống phá Đảng Cộng Sản. Bất cứ ai nằm chiếc giường này đều sẽ trở thành công dân của Cách Mạng Cộng Sản đầy vinh quang và vĩ đại mãi trường tồn.', 'Đỏ rực, sao sáng'),
	(6, 'assets/images/bed6.jpg', 'Giường "Khá Bảnh" – Ngủ Phải Có Phong Cách!', 'Lấy cảm hứng từ dân chơi Bảnh AKA VinaHouse Dancer', 'Gỗ mun đen huyền bí, bọc da cao cấp', '2m x 2m', 'Nội Thất Thế Giới Ngầm', 13999999.00, 'Bạn có từng nghĩ rằng một chiếc giường có thể giúp bạn trở thành huyền thoại? Với giường "Khá Bảnh", bạn không chỉ ngủ mà còn tận hưởng cuộc sống theo cách riêng của mình! Thiết kế siêu "bảnh", bọc da cao cấp như ghế siêu xe, lại có đèn LED đổi màu giúp căn phòng sáng trưng như sàn nhảy.\nĐặc biệt: Giường này có chế độ rung nhẹ khi bạn mở nhạc remix, đảm bảo nằm là "phiêu", ngủ là "chill". Ai mà chưa có chiếc giường này thì đúng là thiếu một phần quan trọng trong cuộc đời!\n\n🔥 Ngủ thôi cũng phải có phong cách! 🔥\n\n\n\n\n\n\n', 'Nâu gỗ'),
	(7, 'assets/images/bed7.jpg', 'Giường (Ghế 69) – Đỉnh Cao Sáng Tạo!', 'Vừa là giường, vừa là ghế, nằm thoải mái, ngồi thư giãn!', 'Khung gỗ bạch dương, nệm mousse đàn hồi cao', '1m8 x 2m (khi mở ra giường), 1m x 1m5 (khi gập thành ghế)', 'Nội thất 6969', 2696969.00, 'Chiếc giường 69 này rất vô cùng đa năng có thể vừa làm giường, vừa làm ghế ngồi. Ngoài ra khi bạn sử dụng chiếc giường này sẽ học được tất cả bí quyết "69 loại võ công đỉnh nóc trần" giành cho 2 người  ( ͡° ͜ʖ ͡°). Đặc biệt: Có chế độ ngả linh hoạt với 69 góc độ, đảm bảo bạn tìm được tư thế thoải mái nhất! Dù bạn muốn đọc sách, xem phim hay ngủ sâu, chiếc giường này sẽ chiều bạn theo đúng kiểu "69 phong cách - 69 trải nghiệm!"\r\n\r\n🔥 Sống phải chất, giường cũng phải độc! 🔥 ', ': Đỏ rượu vang, đen huyền bí, xanh navy');

-- Dumping structure for table demodatabase.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table demodatabase.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`) VALUES
	(13, 'haihoan15', 'haihoang15122002@gmail.com', '$2y$10$LWolZ5vHd6IHMYq0ihUwk.sJKM4LyB49mk/sJMLpQM8cxZoG4arxG', '1742189072_12.jpg'),
	(18, 'haihoan12', 'haihoantamquoc@gmail.com', '$2y$10$vYNKrJQhVAkq0FADq83CcujPJxGQS2C7cmODhD3rWxW1w.1IpsrUW', '1742127381_11.jpg');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
