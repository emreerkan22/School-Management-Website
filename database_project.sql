-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 20 Haz 2021, 20:00:25
-- Sunucu sürümü: 10.4.18-MariaDB
-- PHP Sürümü: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `database_project`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `first_name`, `last_name`, `phone`, `email`, `password`) VALUES
(2, 'admin', 'admin', 'admin', '65465465464', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `registered_student` int(11) DEFAULT NULL,
  `instructor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `registered_student`, `instructor_id`) VALUES
(15, 'Bilişim', NULL, 2),
(25, 'Deneme', NULL, 2),
(15, 'Bilişim', 6, 2),
(25, 'Deneme', 6, 2),
(4, 'asfasf', NULL, 4),
(15, 'Bilişim', 3, 2),
(25, 'Deneme', 3, 2),
(4, 'asfasf', 3, 4),
(6, 'Emre Dersi', NULL, 6),
(15, 'Bilişim', 10, 2),
(6, 'Emre Dersi', 10, 6),
(25, 'Deneme', 10, 2),
(6, 'Emre Dersi', 10, 6),
(6, 'Emre Dersi', 10, 6),
(4, 'asfasf', 10, 4),
(56, 'samet', NULL, 7),
(56, 'samet', 10, 7),
(256, 'samet1', NULL, 7),
(256, 'samet1', NULL, 7),
(256, 'samet1', NULL, 7),
(256, 'samet1', NULL, 7),
(998, 'samet2', NULL, 6),
(998, 'samet2', 10, 6);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `files`
--

CREATE TABLE `files` (
  `file_name` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `course_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `files`
--

INSERT INTO `files` (`file_name`, `course_id`, `file_id`) VALUES
('index.jpg', 15, 6),
('2021-06-20 01_25_21-Unable to connect.png', 15, 8),
('2021-06-20 01_25_21-Unable to connect.png', 6, 9),
('2021-06-20 01_25_21-Unable to connect.png', 7, 10),
('2021-06-20 01_25_21-Unable to connect.png', 998, 11);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `grade`
--

CREATE TABLE `grade` (
  `homework_grade` int(11) NOT NULL,
  `quiz_grade` int(11) NOT NULL,
  `midterm_grade` int(11) NOT NULL,
  `final_grade` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `grade`
--

INSERT INTO `grade` (`homework_grade`, `quiz_grade`, `midterm_grade`, `final_grade`, `student_id`, `course_id`) VALUES
(0, 0, 0, 0, 3, 4),
(50, 0, 0, 0, 3, 15),
(0, 0, 0, 0, 3, 25),
(0, 0, 0, 0, 6, 15),
(0, 0, 0, 0, 6, 25),
(0, 0, 0, 0, 10, 4),
(90, 50, 60, 80, 10, 6),
(50, 60, 80, 90, 10, 15),
(0, 0, 0, 0, 10, 25),
(0, 0, 0, 0, 10, 56),
(10, 20, 30, 40, 10, 998);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `instructor`
--

CREATE TABLE `instructor` (
  `instructor_id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `registered_school` int(11) NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `instructor`
--

INSERT INTO `instructor` (`instructor_id`, `username`, `first_name`, `last_name`, `phone`, `email`, `registered_school`, `password`) VALUES
(2, 'samet', 'samet', 'sarial', '1241241', 'saadkfljakf', 1, 'samet2828'),
(3, 'enes', 'enes', 'enes', '4564645', 'enes', 1, 'samet2828'),
(4, 'samet_instructor', 'samet', 'sarial', '65464664', 'asfasf', 1, 'samet2828'),
(5, 'asd', 'asd', 'asd', '2352', 'asfd', 2, 'asdf'),
(6, 'emre', 'emre', 'erkan', '12345', 'emre@mail.com', 2, '12345'),
(7, 'medipol', 'medipol', 'medipol', '12345', 'medipol', 25, '12345');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `manager`
--

CREATE TABLE `manager` (
  `manager_id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `managed_school` int(11) NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `manager`
--

INSERT INTO `manager` (`manager_id`, `username`, `first_name`, `last_name`, `email`, `phone`, `managed_school`, `password`) VALUES
(2, 'manager', 'manager', 'manager', 'manager@manager.com', '5323523232', 1, 'manager'),
(8, 'samet29', 'Samet', 'Sarıal', 'asjlkhfkajhsf', '0982374928', 2, 'samet2828'),
(10, 'medipol', 'medipol', 'medipol', 'medipol', '231321', 25, '12345');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `school`
--

CREATE TABLE `school` (
  `school_id` int(11) NOT NULL,
  `school_name` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `school`
--

INSERT INTO `school` (`school_id`, `school_name`) VALUES
(2, 'Ferda Turan'),
(1, 'İshakağa İlköğretim Okulu'),
(25, 'İstanbul Medipol Üniversitesi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `registered_school` int(11) NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `student`
--

INSERT INTO `student` (`student_id`, `username`, `first_name`, `last_name`, `phone`, `email`, `registered_school`, `password`) VALUES
(3, 'student', 'student', 'student', '5323523232', 'sarialsamet@gmail.com', 1, 'samet2828'),
(4, 'smtsarial', 'samet', 'sarial', '5323950205', 'sarialsamet@gmail.com', 1, 'samet2828'),
(6, 'enes', 'enes', 'sarial', '64546645654', 'enes@gmail.com', 1, 'samet2828'),
(8, 'smtsariall', 'samet', 'sarıal', '65465654654', 'asflkjalksfj', 1, 'samet2828'),
(9, 'emir', 'emirhan', 'sarıal', '564654654', 'asfasfkja', 1, 'samet2828'),
(10, 'emre', 'emre', 'erkan', '12345', 'emre@mail.com', 2, '12345');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Tablo için indeksler `course`
--
ALTER TABLE `course`
  ADD KEY `course_id` (`course_id`);

--
-- Tablo için indeksler `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`file_id`);

--
-- Tablo için indeksler `grade`
--
ALTER TABLE `grade`
  ADD UNIQUE KEY `student_id_2` (`student_id`,`course_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Tablo için indeksler `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`instructor_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD KEY `registered_school` (`registered_school`);

--
-- Tablo için indeksler `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`manager_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD UNIQUE KEY `managed_school_2` (`managed_school`),
  ADD KEY `managed_school` (`managed_school`);

--
-- Tablo için indeksler `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`school_id`),
  ADD UNIQUE KEY `school_name` (`school_name`);

--
-- Tablo için indeksler `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `registered_school` (`registered_school`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `files`
--
ALTER TABLE `files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `instructor`
--
ALTER TABLE `instructor`
  MODIFY `instructor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `manager`
--
ALTER TABLE `manager`
  MODIFY `manager_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `school`
--
ALTER TABLE `school`
  MODIFY `school_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Tablo için AUTO_INCREMENT değeri `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `grade`
--
ALTER TABLE `grade`
  ADD CONSTRAINT `grade_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grade_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `instructor`
--
ALTER TABLE `instructor`
  ADD CONSTRAINT `instructor_ibfk_1` FOREIGN KEY (`registered_school`) REFERENCES `school` (`school_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `manager_ibfk_1` FOREIGN KEY (`managed_school`) REFERENCES `school` (`school_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
