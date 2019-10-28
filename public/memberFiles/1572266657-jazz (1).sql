-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 23 2019 г., 12:26
-- Версия сервера: 5.6.41
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `jazz`
--

-- --------------------------------------------------------

--
-- Структура таблицы `application`
--

CREATE TABLE `application` (
  `application_id` int(10) UNSIGNED NOT NULL,
  `nomination_id` int(10) UNSIGNED NOT NULL,
  `application_type_id` int(10) UNSIGNED NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `application`
--

INSERT INTO `application` (`application_id`, `nomination_id`, `application_type_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'approved', NULL, '2019-10-22 05:56:02'),
(2, 2, 2, 'created', NULL, '2019-10-22 06:26:11'),
(3, 3, 4, 'archive', NULL, '2019-10-22 06:25:43'),
(4, 1, 5, 'created', NULL, '2019-10-22 06:26:09'),
(5, 3, 5, 'archive', NULL, '2019-10-21 11:51:38'),
(6, 3, 3, 'archive', NULL, '2019-10-21 11:51:34'),
(7, 3, 3, 'archive', NULL, '2019-10-21 11:49:15'),
(8, 1, 1, 'archive', '2019-10-21 11:55:48', '2019-10-22 05:54:46'),
(9, 2, 1, 'archive', '2019-10-22 06:06:22', '2019-10-22 06:07:43');

-- --------------------------------------------------------

--
-- Структура таблицы `application_type`
--

CREATE TABLE `application_type` (
  `application_type_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `application_type`
--

INSERT INTO `application_type` (`application_type_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'соліст', NULL, NULL),
(2, 'дует', NULL, NULL),
(3, 'ансамбль', NULL, NULL),
(4, 'Хор', NULL, NULL),
(5, 'Оркестр', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `contact-items`
--

CREATE TABLE `contact-items` (
  `contact_items_id` int(10) UNSIGNED NOT NULL,
  `contact_section_id` int(10) UNSIGNED NOT NULL,
  `contact_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `contact-items`
--

INSERT INTO `contact-items` (`contact_items_id`, `contact_section_id`, `contact_title`, `contact`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Суми, Сумська область, 40000', NULL, NULL),
(2, 2, NULL, '0542 330 032', NULL, NULL),
(3, 3, 'Facebook', 'https://school-link.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `contact_section`
--

CREATE TABLE `contact_section` (
  `contact_section_id` int(10) UNSIGNED NOT NULL,
  `caption` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `contact_section`
--

INSERT INTO `contact_section` (`contact_section_id`, `caption`, `created_at`, `updated_at`) VALUES
(1, 'address', NULL, NULL),
(2, 'phones', NULL, NULL),
(3, 'socials', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `evaluations`
--

CREATE TABLE `evaluations` (
  `evaluations_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `application_id` int(10) UNSIGNED NOT NULL,
  `stylistic_matching` tinyint(4) NOT NULL DEFAULT '0',
  `artistic_value` tinyint(4) NOT NULL DEFAULT '0',
  `artistry` tinyint(4) NOT NULL DEFAULT '0',
  `originality` tinyint(4) NOT NULL DEFAULT '0',
  `evaluation` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `evaluations`
--

INSERT INTO `evaluations` (`evaluations_id`, `user_id`, `application_id`, `stylistic_matching`, `artistic_value`, `artistry`, `originality`, `evaluation`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 4, 4, 3, 25, 36, '2019-10-21 11:44:49', '2019-10-21 11:44:54'),
(2, 4, 2, 23, 25, 22, 22, 92, '2019-10-21 11:45:15', '2019-10-21 11:45:15'),
(3, 4, 7, 1, 1, 1, 1, 4, '2019-10-21 11:45:41', '2019-10-21 11:45:41'),
(4, 4, 3, 3, 3, 3, 3, 12, '2019-10-21 11:48:17', '2019-10-21 11:48:17'),
(5, 4, 9, 3, 4, 3, 2, 12, '2019-10-22 06:07:34', '2019-10-22 06:07:34');

-- --------------------------------------------------------

--
-- Структура таблицы `foto_gallery`
--

CREATE TABLE `foto_gallery` (
  `foto_id` int(10) UNSIGNED NOT NULL,
  `file` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `foto_gallery`
--

INSERT INTO `foto_gallery` (`foto_id`, `file`, `type`, `year`, `created_at`, `updated_at`) VALUES
(1, 'test.png', 'Джаз-Вітраж', '2019', NULL, NULL),
(2, '1571751693-222.jpg', 'Джаз-Вітраж', '2019', '2019-10-22 10:41:33', '2019-10-22 10:41:33'),
(3, '1571751693-274px-Розовая_пантера_(персонаж).png', 'Джаз-Вітраж', '2019', '2019-10-22 10:41:33', '2019-10-22 10:41:33'),
(4, '1571751693-Без названия.png', 'Джаз-Вітраж', '2019', '2019-10-22 10:41:33', '2019-10-22 10:41:33'),
(5, '1571752042-Без названия.png', 'Джаз-Вітраж', '2003', '2019-10-22 10:47:22', '2019-10-22 10:47:22'),
(6, '1571752057-222.jpg', 'Джаз-Вітраж', '2010', '2019-10-22 10:47:37', '2019-10-22 10:47:37'),
(7, '1571752065-60435560-1CAA-469E-983D-254A7DC7EC38_cx0_cy2_cw0_w1023_r1_s.jpg', 'Джаз-Вітраж', '2009', '2019-10-22 10:47:45', '2019-10-22 10:47:45');

-- --------------------------------------------------------

--
-- Структура таблицы `group_people`
--

CREATE TABLE `group_people` (
  `group_people_id` int(10) UNSIGNED NOT NULL,
  `application_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count_people` int(11) NOT NULL,
  `average_age` int(11) NOT NULL,
  `file` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `group_people`
--

INSERT INTO `group_people` (`group_people_id`, `application_id`, `name`, `count_people`, `average_age`, `file`, `created_at`, `updated_at`) VALUES
(1, 3, 'Океан Ельзи', 5, 37, '0', NULL, NULL),
(2, 4, 'Bon Jovi', 5, 37, '0', NULL, NULL),
(3, 5, 'Five Finger Death Punch', 5, 37, '0', NULL, NULL),
(4, 6, '3 Doors Down', 5, 37, '0', NULL, NULL),
(5, 7, 'Daughtry', 5, 37, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `hymn_section`
--

CREATE TABLE `hymn_section` (
  `id` int(10) UNSIGNED NOT NULL,
  `hymn_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `audio` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note_image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `hymn_section`
--

INSERT INTO `hymn_section` (`id`, `hymn_text`, `audio`, `note_image`, `created_at`, `updated_at`) VALUES
(1, 'Куплет\r\nЯкщо твоє серце постійно співає,\r\nМелодія блюзу тебе надихає,\r\nЯкщо ти сміливий і маєш кураж –\r\nНа тебе чекає сумський «Джаз-Вітраж»!\r\nБо Джаз – то є символ свободи і миру.\r\nВін-скарб неповторний, яскравий і щирий.\r\nДавайте сьогодні покажемо клас\r\nАнумо всі разом: «Ми любимо ДЖАЗ!»\r\n\r\nПриспів\r\nДжаз! Джаз! Джаз! Джаз!\r\nЛунає джаз.\r\nЄднає нас.\r\nХай буде джаз!\r\nбо Джаз – це Джаз! ДЖАЗ!\r\n\r\nКуплет\r\nВітаємо щиро цінителів Джазу\r\nВіват, Джаз- Вітраж! Об&#39;єднаймося разом!\r\nЩоб музику стильну усім дарувать,\r\nу світ її дивний без гальм поринать:\r\nНе варто сидіти і чогось чекати -\r\nТи просто повинен себе показати!\r\nВирує хай свято не день і не час\r\nВіват Джаз-Вітраж! Хай завджди буде ДЖАЗ!', '/audio/jazz.wav', '/img/hymn.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `logo_section`
--

CREATE TABLE `logo_section` (
  `id` int(10) UNSIGNED NOT NULL,
  `logo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticker` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `logo_section`
--

INSERT INTO `logo_section` (`id`, `logo`, `description`, `ticker`, `created_at`, `updated_at`) VALUES
(1, '/img/logo.svg', 'Протягом березня-квітня 2016 року в місті Суми проходив Другий обласний дитячий фестиваль-конкурс джазової музики «Джаз Вітраж». Головна мета цього нового творчого проекту - популяризація класичного та сучасного джазового мистецтва серед дітей та молоді сумського краю', 'Протягом березня-квітня 2016 року в місті Суми проходив Другий обласний дитячий фестиваль-конкурс джазової музики «Джаз Вітраж». Головна мета цього нового творчого проекту - популяризація класичного та сучасного джазового мистецтва серед дітей та молоді сумського краю', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_08_08_110802_create_tasks_application_type', 1),
(2, '2019_08_08_110846_create_tasks_nomination', 1),
(3, '2019_08_08_150749_create_tasks_application', 1),
(4, '2019_08_08_150910_create_solo_duet_table', 1),
(5, '2019_08_08_150921_create_tasks_presentation', 1),
(6, '2019_08_08_160717_create_tasks_table_group_people', 1),
(7, '2019_08_08_160949_create_tasks_preparation', 1),
(8, '2019_08_21_111610_create_foto_gallery_table', 1),
(9, '2019_08_22_113121_create_users_table', 1),
(10, '2019_08_30_110429_create_logo_section', 1),
(11, '2019_08_30_110755_create_position_section', 1),
(12, '2019_08_30_110935_create_video_gallery_section', 1),
(13, '2019_08_30_111023_create_contact_section', 1),
(14, '2019_08_30_111137_create_hymn_section', 1),
(15, '2019_08_30_111218_create_contact-items', 1),
(16, '2019_09_05_125831_create_quotes_table', 1),
(17, '2019_09_13_094346_create_questions_table', 1),
(18, '2019_09_23_073444_create_evaluations_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `nomination`
--

CREATE TABLE `nomination` (
  `nomination_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `nomination`
--

INSERT INTO `nomination` (`nomination_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Вокальний жанр', NULL, NULL),
(2, 'інструментальний жанр', NULL, NULL),
(3, 'композиція', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `position_section`
--

CREATE TABLE `position_section` (
  `id` int(10) UNSIGNED NOT NULL,
  `provisions_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `position_section`
--

INSERT INTO `position_section` (`id`, `provisions_text`, `video`, `file`, `created_at`, `updated_at`) VALUES
(1, 'Протягом березня-квітня 2016 року в місті Суми проходив Другий обласний дитячий фестиваль-конкурс джазової музики \"Джаз Вітраж\". \r\nГоловна мета цього нового творчого проекту - популяризація класичного та сучасного джазового мистецтва серед дітей та молоді', 'https://www.youtube.com/watch?v=fMKZMI8ByTs', '/file/file.pdf', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `preparation`
--

CREATE TABLE `preparation` (
  `preparation_id` int(10) UNSIGNED NOT NULL,
  `school_one` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_surname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_patronymic` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_in` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_concertmaster` int(11) NOT NULL,
  `concertmaster_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `concertmaster_surname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `concertmaster_patronymic` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `application_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `preparation`
--

INSERT INTO `preparation` (`preparation_id`, `school_one`, `school_address`, `school_email`, `school_phone`, `teacher_name`, `teacher_surname`, `teacher_patronymic`, `teacher_in`, `teacher_email`, `teacher_phone`, `is_concertmaster`, `concertmaster_name`, `concertmaster_surname`, `concertmaster_patronymic`, `application_id`, `created_at`, `updated_at`) VALUES
(1, 'Сумська Музична школа 1', 'м.Суми, вул.Засумська 1', 'email@school.lol1', '+380502864031', 'Иван 1', 'Иванов 1', 'Иванович', '880055535351', 'teacher@email.com1', '+380502864031', 1, 'Виктор', 'Федорович', 'Концертмейстерович', 1, NULL, NULL),
(2, 'Сумська Музична школа 2', 'м.Суми, вул.Засумська 2', 'email@school.lol2', '+380502864032', 'Иван 2', 'Иванов 2', 'Иванович', '880055535352', 'teacher@email.com2', '+380502864031', 1, 'Виктор', 'Федорович', 'Концертмейстерович', 2, NULL, NULL),
(3, 'Сумська Музична школа 1', 'м.Суми, вул.Засумська 1', 'email@school.lol1', '+380502864031', 'Иван 1', 'Иванов 1', 'Иванович', '880055535351', 'teacher@email.com1', '+380502864031', 1, 'Виктор', 'Федорович', 'Концертмейстерович', 3, NULL, NULL),
(4, 'Сумська Музична школа 1', 'м.Суми, вул.Засумська 1', 'email@school.lol1', '+380502864031', 'Иван 1', 'Иванов 1', 'Иванович', '880055535351', 'teacher@email.com1', '+380502864031', 1, 'Виктор', 'Федорович', 'Концертмейстерович', 4, NULL, NULL),
(5, 'Сумська Музична школа 1', 'м.Суми, вул.Засумська 1', 'email@school.lol1', '+380502864031', 'Иван 1', 'Иванов 1', 'Иванович', '880055535351', 'teacher@email.com1', '+380502864031', 1, 'Виктор', 'Федорович', 'Концертмейстерович', 5, NULL, NULL),
(6, 'Сумська Музична школа 1', 'м.Суми, вул.Засумська 1', 'email@school.lol1', '+380502864031', 'Иван 1', 'Иванов 1', 'Иванович', '880055535351', 'teacher@email.com1', '+380502864031', 1, 'Виктор', 'Федорович', 'Концертмейстерович', 6, NULL, NULL),
(7, 'Сумська Музична школа 1', 'м.Суми, вул.Засумська 1', 'email@school.lol1', '+380502864031', 'Иван 1', 'Иванов 1', 'Иванович', '880055535351', 'teacher@email.com1', '+380502864031', 1, 'Виктор', 'Федорович', 'Концертмейстерович', 7, NULL, NULL),
(8, 'sfdgs', 'dfgsdfg', 'sdfsdf@gmail.com', '3453453454', 'gsdfgsdfg', 'sdfgsdf', 'sdfgsdfg', '3454353444', 'sdfsdf@gmail.com', '435345345434', 0, 'sdfg', 'sdfg', '', 8, '2019-10-21 11:55:52', '2019-10-21 11:55:52'),
(9, 'sdfgsdfg', 'sdfgsdfgsd', 'name@email.com', '234242423423', 'fasdfas', 'awefasdfasd', 'dfasdfasdf', '3453453533454', 'name@email.com', '35345345434543', 1, '', '', '', 9, '2019-10-22 06:06:27', '2019-10-22 06:06:27');

-- --------------------------------------------------------

--
-- Структура таблицы `presentation`
--

CREATE TABLE `presentation` (
  `presentation_id` int(10) UNSIGNED NOT NULL,
  `composition_one` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_one` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_one` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `composition_two` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_two` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_two` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `application_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `presentation`
--

INSERT INTO `presentation` (`presentation_id`, `composition_one`, `author_one`, `time_one`, `composition_two`, `author_two`, `time_two`, `video`, `application_id`, `created_at`, `updated_at`) VALUES
(1, 'Назва твору 1', 'Автор твору 1', '4', 'Назва твору 2', 'Автор твору 2', '5', 'https://www.youtube.com/watch?v=UAxNcJprLA0', 1, NULL, NULL),
(2, 'Назва твору 1', 'Автор твору 1', '4', 'Назва твору 2', 'Автор твору 2', '5', 'https://www.youtube.com/watch?v=NNdTljRzPqE', 2, NULL, NULL),
(3, 'Назва твору 1', 'Автор твору 1', '4', 'Назва твору 2', 'Автор твору 2', '5', 'https://www.youtube.com/watch?v=Wx_r_wap-Jg', 3, NULL, NULL),
(4, 'Назва твору 1', 'Автор твору 1', '4', 'Назва твору 2', 'Автор твору 2', '5', 'https://www.youtube.com/watch?v=Wx_r_wap-Jg', 4, NULL, NULL),
(5, 'Назва твору 1', 'Автор твору 1', '4', 'Назва твору 2', 'Автор твору 2', '5', 'https://www.youtube.com/watch?v=Wx_r_wap-Jg', 5, NULL, NULL),
(6, 'Назва твору 1', 'Автор твору 1', '4', 'Назва твору 2', 'Автор твору 2', '5', 'https://www.youtube.com/watch?v=Wx_r_wap-Jg', 6, NULL, NULL),
(7, 'Назва твору 1', 'Автор твору 1', '4', 'Назва твору 2', 'Автор твору 2', '5', 'https://www.youtube.com/watch?v=Wx_r_wap-Jg', 7, NULL, NULL),
(8, 'sfg', 'sdfg', '4', 'sfg', 'sdfg', '4', '1571669752-Без названия.png', 8, '2019-10-21 11:55:52', '2019-10-21 11:55:52'),
(9, 'sdfgsd', 'fgsdfg', '44', 'sdfgs', 'dfgsdf', '44', '1571735187-222.jpg', 9, '2019-10-22 06:06:27', '2019-10-22 06:06:27');

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id`, `name`, `email`, `question_text`, `created_at`, `updated_at`) VALUES
(1, 'questions', 'questions@gmail.com', 'Чи є життя на марсі?', '2019-10-21 14:43:29', '2019-10-21 14:43:29');

-- --------------------------------------------------------

--
-- Структура таблицы `quotes`
--

CREATE TABLE `quotes` (
  `quote_id` int(10) UNSIGNED NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `quotes`
--

INSERT INTO `quotes` (`quote_id`, `text`, `created_at`, `updated_at`) VALUES
(1, 'Протягом березня-квітня 2016 року в місті Суми проходив Другий обласний дитячий фестиваль-конкурс джазової музики «Джаз Вітраж». Головна мета цього нового творчого проекту - популяризація класичного та сучасного джазового мистецтва серед дітей та молоді сумського краю', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `solo_duet`
--

CREATE TABLE `solo_duet` (
  `solo_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patronymic` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_birthday` date NOT NULL,
  `passport_photo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `in` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `in_file` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_surname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_patronymic` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_duet` int(11) NOT NULL,
  `application_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `solo_duet`
--

INSERT INTO `solo_duet` (`solo_id`, `name`, `surname`, `patronymic`, `member_email`, `data_birthday`, `passport_photo`, `in`, `in_file`, `parent_name`, `parent_surname`, `parent_patronymic`, `is_duet`, `application_id`, `created_at`, `updated_at`) VALUES
(1, 'Василий', 'Ситников', 'Константинович', 'member@gmail.com', '2019-08-16', 'passport-photo.png', '547435445', 'in.jpg', 'Констант', 'Ситников', 'Егорович', 0, 1, NULL, NULL),
(2, 'Валентин', 'Шубин', 'Петрович', 'member@gmail.com', '2019-08-16', 'passport-photo.png', '547435445', 'in.jpg', 'Петро', 'Шубин', 'Семёнович', 1, 2, NULL, NULL),
(3, 'Нинна', 'Баранова', 'Петровна', 'member@gmail.com', '2019-08-16', 'passport-photo.png', '547435445', 'in.jpg', 'Петро', 'Баранов', 'Семёнович', 1, 2, NULL, NULL),
(4, 'вапывап', 'чапиывпы', 'ывапвыапы', 'sdfsdf@gmail.com', '2002-12-12', '1571669748-Без названия.png', '4234242433', '1571669748-Без названия.png', 'sdfgsdfg', 'sdfgsdfg', 'sdfgsdfg', 0, 8, '2019-10-21 11:55:52', '2019-10-21 11:55:52'),
(5, 'cvzxcvzx', 'zxcvzx', 'cvzxvzxcv', 'zxcvzxcv@sdfsdfdsf.ff', '2002-12-12', '1571735183-222.jpg', '2134243234234', '1571735183-222.jpg', 'asfasdf', 'daf', 'asdfasdf', 0, 9, '2019-10-22 06:06:27', '2019-10-22 06:06:27');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patronymic` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rank` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nominations` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `informations` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `role`, `email`, `password`, `name`, `surname`, `patronymic`, `photo`, `rank`, `nominations`, `informations`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'admin', 'admin@gmail.com', '$2y$10$E06rAcM.0juxH78Oo8NOdODN8OnRtHBa30R/ToofHSrvIUclfESSO', 'Петров', 'Несторович', 'default', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'superAdmin', 'superadmin@gmail.com', '$2y$10$xlqQoQYkwWpYQZ.pTD5kwup887p9OUc6JVDqRxgpdOoB.wKFce6JG', 'Андрей', 'Новичков', 'default', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'jury', 'dfgsdfg@dfgdfg.hh', '$2y$10$RHskKlEqrtnKuS/DamnPaOsIrBN5VRYQXqa1DZs9Zkmcm0m5mQwhq', 'впаывп', 'фывапмы', 'ывапыва', '1571752317-Без названия.png', 'пывап', 'Вокальний жанр', 'dasfadfasd', NULL, '2019-10-22 10:51:57', '2019-10-22 10:51:57'),
(6, 'jury', 'dfgsdfg@dfgdfg.hh', '$2y$10$Mewo5XGFMsmGUfYCK5DCMejd7YUJ.UN0uV1bMh7DutflbMpI.5pEy', 'впаывп', 'фывапмы', 'ывапыва', '1571752323-Без названия.png', 'пывап', 'Вокальний жанр', 'dasfadfasd', NULL, '2019-10-22 10:52:03', '2019-10-22 10:52:03'),
(7, 'jury', 'dfgsdfg@dfgdfg.hh', '$2y$10$d7uAYvKlVk1GC39sYLVSNOmPzNG/R4KualTUkuu3hFe3F/zyurlLO', 'впаывп', 'фывапмы', 'ывапыва', '1571752324-Без названия.png', 'пывап', 'Вокальний жанр', 'dasfadfasd', NULL, '2019-10-22 10:52:04', '2019-10-22 10:52:04'),
(8, 'orgComittee', 'dafasd@dzssfzd.ghh', '$2y$10$9Dgy//bc3hPtmMlD/CLTqO/WufdaAEAhIsfYPuvfM4Flq43fOeY1q', 'вапрв', 'апрвпа', 'вапрвапр', '1571752574-Без названия.png', NULL, NULL, 'вапрвпв в пвп рвапр вапр првапр в', NULL, '2019-10-22 10:56:14', '2019-10-22 10:56:14'),
(9, 'orgComittee', 'dafasd@dzssfzd.ghh', '$2y$10$p5PJTJsWzheO.MoopNc03erSYjCta2ZLd7oUaNKKfZuw/RMedt1TG', 'вапрв', 'апрвпа', 'вапрвапр', '1571752576-Без названия.png', NULL, NULL, 'вапрвпв в пвп рвапр вапр првапр в', NULL, '2019-10-22 10:56:16', '2019-10-22 10:56:16'),
(10, 'orgComittee', 'dafasd@dzssfzd.ghh', '$2y$10$IXErR8RsSpDb3/Tq6wlbPu4ONTCIov/hgIGFDzfoSWo8NHFmFDhze', 'вапрв', 'апрвпа', 'вапрвапр', '1571752579-Без названия.png', NULL, NULL, 'вапрвпв в пвп рвапр вапр првапр в', NULL, '2019-10-22 10:56:19', '2019-10-22 10:56:19'),
(11, 'orgComittee', 'dafasd@dzssfzd.ghh', '$2y$10$TR7J2r1oxHiR46BkiEdHpuX9b3DkFUSRkAVJs3CiZpcfUNDBx/gcy', 'вапрв', 'апрвпа', 'вапрвапр', '1571752580-Без названия.png', NULL, NULL, 'вапрвпв в пвп рвапр вапр првапр в', NULL, '2019-10-22 10:56:20', '2019-10-22 10:56:20'),
(12, 'orgComittee', 'dafasd@dzssfzd.ghh', '$2y$10$Z7xaDT4EtKiqTzaQpBZzWOQDtl1ZWYVnaemw9qnPAyES9M5GcPsvu', 'вапрв', 'апрвпа', 'вапрвапр', '1571752581-Без названия.png', NULL, NULL, 'вапрвпв в пвп рвапр вапр првапр в', NULL, '2019-10-22 10:56:21', '2019-10-22 10:56:21'),
(13, 'orgComittee', 'dafasd@dzssfzd.ghh', '$2y$10$hko7ZX36PJC3zlSb9z84x.fyhnFb/w1N3h/e1ci5TWDiVGw2Y8MQK', 'вапрв', 'апрвпа', 'вапрвапр', '1571752582-Без названия.png', NULL, NULL, 'вапрвпв в пвп рвапр вапр првапр в', NULL, '2019-10-22 10:56:22', '2019-10-22 10:56:22');

-- --------------------------------------------------------

--
-- Структура таблицы `video_gallery`
--

CREATE TABLE `video_gallery` (
  `video_id` int(10) UNSIGNED NOT NULL,
  `url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `video_gallery`
--

INSERT INTO `video_gallery` (`video_id`, `url`, `year`, `created_at`, `updated_at`) VALUES
(1, 'https://www.youtube.com/watch?v=fMKZMI8ByTs', '2019', NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `application_nomination_id_index` (`nomination_id`),
  ADD KEY `application_application_type_id_index` (`application_type_id`);

--
-- Индексы таблицы `application_type`
--
ALTER TABLE `application_type`
  ADD PRIMARY KEY (`application_type_id`);

--
-- Индексы таблицы `contact-items`
--
ALTER TABLE `contact-items`
  ADD PRIMARY KEY (`contact_items_id`),
  ADD KEY `contact_items_contact_section_id_index` (`contact_section_id`);

--
-- Индексы таблицы `contact_section`
--
ALTER TABLE `contact_section`
  ADD PRIMARY KEY (`contact_section_id`);

--
-- Индексы таблицы `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`evaluations_id`),
  ADD KEY `evaluations_user_id_index` (`user_id`),
  ADD KEY `evaluations_application_id_index` (`application_id`);

--
-- Индексы таблицы `foto_gallery`
--
ALTER TABLE `foto_gallery`
  ADD PRIMARY KEY (`foto_id`);

--
-- Индексы таблицы `group_people`
--
ALTER TABLE `group_people`
  ADD PRIMARY KEY (`group_people_id`),
  ADD KEY `group_people_application_id_index` (`application_id`);

--
-- Индексы таблицы `hymn_section`
--
ALTER TABLE `hymn_section`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `logo_section`
--
ALTER TABLE `logo_section`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nomination`
--
ALTER TABLE `nomination`
  ADD PRIMARY KEY (`nomination_id`);

--
-- Индексы таблицы `position_section`
--
ALTER TABLE `position_section`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `preparation`
--
ALTER TABLE `preparation`
  ADD PRIMARY KEY (`preparation_id`),
  ADD KEY `preparation_application_id_index` (`application_id`);

--
-- Индексы таблицы `presentation`
--
ALTER TABLE `presentation`
  ADD PRIMARY KEY (`presentation_id`),
  ADD KEY `presentation_application_id_index` (`application_id`);

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`quote_id`);

--
-- Индексы таблицы `solo_duet`
--
ALTER TABLE `solo_duet`
  ADD PRIMARY KEY (`solo_id`),
  ADD KEY `solo_duet_application_id_index` (`application_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `video_gallery`
--
ALTER TABLE `video_gallery`
  ADD PRIMARY KEY (`video_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `application`
--
ALTER TABLE `application`
  MODIFY `application_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `application_type`
--
ALTER TABLE `application_type`
  MODIFY `application_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `contact-items`
--
ALTER TABLE `contact-items`
  MODIFY `contact_items_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `contact_section`
--
ALTER TABLE `contact_section`
  MODIFY `contact_section_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `evaluations_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `foto_gallery`
--
ALTER TABLE `foto_gallery`
  MODIFY `foto_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `group_people`
--
ALTER TABLE `group_people`
  MODIFY `group_people_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `hymn_section`
--
ALTER TABLE `hymn_section`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `logo_section`
--
ALTER TABLE `logo_section`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `nomination`
--
ALTER TABLE `nomination`
  MODIFY `nomination_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `position_section`
--
ALTER TABLE `position_section`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `preparation`
--
ALTER TABLE `preparation`
  MODIFY `preparation_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `presentation`
--
ALTER TABLE `presentation`
  MODIFY `presentation_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `quotes`
--
ALTER TABLE `quotes`
  MODIFY `quote_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `solo_duet`
--
ALTER TABLE `solo_duet`
  MODIFY `solo_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `video_gallery`
--
ALTER TABLE `video_gallery`
  MODIFY `video_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_application_type_id_foreign` FOREIGN KEY (`application_type_id`) REFERENCES `application_type` (`application_type_id`),
  ADD CONSTRAINT `application_nomination_id_foreign` FOREIGN KEY (`nomination_id`) REFERENCES `nomination` (`nomination_id`);

--
-- Ограничения внешнего ключа таблицы `contact-items`
--
ALTER TABLE `contact-items`
  ADD CONSTRAINT `contact_items_contact_section_id_foreign` FOREIGN KEY (`contact_section_id`) REFERENCES `contact_section` (`contact_section_id`);

--
-- Ограничения внешнего ключа таблицы `evaluations`
--
ALTER TABLE `evaluations`
  ADD CONSTRAINT `evaluations_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `application` (`application_id`),
  ADD CONSTRAINT `evaluations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Ограничения внешнего ключа таблицы `group_people`
--
ALTER TABLE `group_people`
  ADD CONSTRAINT `group_people_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `application` (`application_id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `preparation`
--
ALTER TABLE `preparation`
  ADD CONSTRAINT `preparation_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `application` (`application_id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `presentation`
--
ALTER TABLE `presentation`
  ADD CONSTRAINT `presentation_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `application` (`application_id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `solo_duet`
--
ALTER TABLE `solo_duet`
  ADD CONSTRAINT `solo_duet_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `application` (`application_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
