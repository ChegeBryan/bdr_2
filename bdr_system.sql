SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `bdr_system` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bdr_system`;

CREATE TABLE `bdr_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `bdr_company` (
  `id` int(11) NOT NULL,
  `name` varchar(252) NOT NULL,
  `location` varchar(255) NOT NULL,
  `sector` varchar(64) NOT NULL,
  `comp_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `bdr_hospital` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `hosp_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `bdr_school` (
  `id` int(11) NOT NULL,
  `name` varchar(252) NOT NULL,
  `location` varchar(255) NOT NULL,
  `level` varchar(64) NOT NULL,
  `sch_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `bdr_users` (
  `id` int(11) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `health` text NOT NULL,
  `pic` text NOT NULL,
  `gender` varchar(16) NOT NULL,
  `dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `bdr_admin`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `bdr_company`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `bdr_hospital`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `bdr_school`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `bdr_users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `bdr_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `bdr_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `bdr_hospital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `bdr_school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `bdr_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
