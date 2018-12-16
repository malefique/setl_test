-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 16 2018 г., 16:40
-- Версия сервера: 10.1.31-MariaDB
-- Версия PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `author` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `author`, `email`, `subject`, `message`, `published`, `created_at`, `updated_at`) VALUES
(6, 'Kabanbay Kuanyshev', 'someguy@mail.ru', 'лееееее када бои будет', 'По астанинкому времени во сколько?', 1, '2018-12-16 16:50:10', '2018-12-16 16:50:10'),
(7, 'Sulima Shekihacheva', 'somegirl@mail.ru', 'Gustaffson VS JONES', 'еще бы ты не хотел, многие хотят, но... ничего личного, милый Гусь,но чемпионом тебе не быть..', 1, '2018-12-16 16:53:18', '2018-12-16 16:53:18'),
(8, ' Shokhrukh Kanaatbekov', 'someguy@mail.ru', 'Wild Conversation', 'Sulima, откуда ты знаешь вдруг будет по другому', 1, '2018-12-16 16:55:23', '2018-12-16 16:55:23'),
(9, 'Eziz Annamyradov', 'someguy@mail.ru', 'Ответ КРОТЯРЕ', 'Кротяра, с меем шансов в 10 раз больше чем с Саулем. Я ярый фанат Хабы, но, СА просто его разорвёт. Лучше пусть с Майским заработает деньги и половину пожертвует на школы и т.д', 1, '2018-12-16 16:59:05', '2018-12-16 16:59:05'),
(10, 'Alisher Arystanbekov', 'someguy@mail.ru', 'АНАЛИТИКА от АЛИШЕРА', 'Ор будет если Эл победит. Маловероятно, так как Кевин крут. В ожидании этого боя', 1, '2018-12-16 17:03:08', '2018-12-16 17:03:08');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `login` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
