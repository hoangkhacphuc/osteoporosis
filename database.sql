SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

DROP DATABASE IF EXISTS `osteoporosis`;
CREATE DATABASE IF NOT EXISTS `osteoporosis` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `osteoporosis`;

CREATE TABLE `calculate` (
  `id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `birth` int(11) DEFAULT NULL,
  `gender` int(11) DEFAULT 0 COMMENT '0:Nữ-1: Nam',
  `height` float DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `cholesterol` int(11) DEFAULT 0 COMMENT '0: Không rõ - 1: < 200 - 2: > 240',
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `calculate` (`id`, `member_id`, `name`, `birth`, `gender`, `height`, `weight`, `cholesterol`, `phone`, `address`, `created_at`) VALUES
(1, 1, 'Nguyễn Văn A', 2000, 1, 150, 50, 0, '', '', '2022-06-11 15:19:22'),
(2, 1, 'Nguyễn Văn B', 2001, 1, 160, 52, 1, '0123123123', 'Hà Nội', '2022-06-11 15:19:55'),
(3, 1, 'Nguyễn Văn B', 2001, 1, 160, 56, 2, '0123123123', 'Hà Nội', '2022-06-11 15:20:12'),
(4, 1, 'Nguyễn Văn C', 2001, 1, 165, 56, 1, '0123123123', 'Hà Nội', '2022-06-11 15:20:33'),
(5, 1, 'Nguyễn Thị D', 2000, 0, 155, 52, 1, '0321321321', 'Hà Đông', '2022-06-11 15:22:40');

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` int(11) DEFAULT 0 COMMENT '0: TV-1: Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `member` (`id`, `username`, `password`, `user_type`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 1),
(2, 'user001', 'e10adc3949ba59abbe56e057f20f883e', 0);


ALTER TABLE `calculate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `calculate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE `calculate`
  ADD CONSTRAINT `calculate_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
