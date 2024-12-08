-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Дек 07 2024 г., 16:26
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `kazakh_language`
--

-- --------------------------------------------------------

--
-- Структура таблицы `dictionaries`
--

CREATE TABLE `dictionaries` (
  `id` int(11) NOT NULL,
  `kazakh_word` varchar(255) NOT NULL,
  `translation` varchar(255) NOT NULL,
  `audio_path` varchar(255) DEFAULT NULL,
  `example_sentence` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `dictionaries`
--

INSERT INTO `dictionaries` (`id`, `kazakh_word`, `translation`, `audio_path`, `example_sentence`) VALUES
(1, 'кітап', 'book', 'uploads/kitap.mp3', 'Мен жаңа кітап сатып алдым.'),
(2, 'қалам', 'pen', 'uploads/qalam.mp3', 'Қалам жазуға өте ыңғайлы.'),
(3, 'үй', 'house', 'uploads/uy.mp3', 'Бұл біздің жаңа үйіміз.'),
(4, 'мектеп', 'school', 'uploads/mektep.mp3', 'Ол мектепте сабақ оқиды.'),
(5, 'дос', 'friend', 'uploads/dos.mp3', 'Менің ең жақын досым мектепте оқиды.'),
(6, 'машина', 'car', 'uploads/mashina.mp3', 'Олар жаңа машина сатып алды.'),
(7, 'сабақ', 'lesson', 'uploads/sabak.mp3', 'Сабақ сағат тоғызда басталады.'),
(8, 'қала', 'city', 'uploads/qala.mp3', 'Бұл қала өте әдемі.'),
(9, 'балалар', 'children', 'uploads/balalar.mp3', 'Балалар ойын ойнап жүр.'),
(10, 'күн', 'sun', 'uploads/kun.mp3', 'Күн бүгін өте жарқын.'),
(11, 'көпір', 'bridge', 'uploads/kopir.mp3', 'Көпір өзеннің үстінен өтеді.'),
(12, 'ағаш', 'tree', 'uploads/agash.mp3', 'Бұл ағаш өте биік.'),
(13, 'гүл', 'flower', 'uploads/gul.mp3', 'Гүлдер бақшаны сәндейді.');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `dictionaries`
--
ALTER TABLE `dictionaries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `dictionaries`
--
ALTER TABLE `dictionaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
