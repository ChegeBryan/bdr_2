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

CREATE TABLE `bdr_academics` (
  `id` int(11) NOT NULL,
  `school` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `certificate` text NOT NULL,
  `entered_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `bdr_health_information` (
  `id` int(11) NOT NULL,
  `hospital` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `diagnosis` text NOT NULL,
  `medication` text NOT NULL,
  `healed` int(11) NOT NULL DEFAULT '0',
  `entered_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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

CREATE TABLE `bdr_work_information` (
  `id` int(11) NOT NULL,
  `company` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `position` varchar(255) NOT NULL,
  `remarks` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `entered_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `bdr_academics`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `bdr_admin`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `bdr_company`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `bdr_health_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hsp_id_fk` (`hospital`),
  ADD KEY `usr_id_fk` (`user`);

ALTER TABLE `bdr_hospital`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `bdr_school`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `bdr_users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `bdr_work_information`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `bdr_academics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `bdr_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `bdr_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `bdr_health_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `bdr_hospital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `bdr_school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `bdr_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `bdr_work_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `bdr_health_information`
  ADD CONSTRAINT `hsp_id_fk` FOREIGN KEY (`hospital`) REFERENCES `bdr_hospital` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `usr_id_fk` FOREIGN KEY (`user`) REFERENCES `bdr_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
