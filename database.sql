SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE `calculate`
  ADD CONSTRAINT `calculate_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
