-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 20-10-2020 a las 07:27:45
-- Versión del servidor: 10.0.38-MariaDB-0+deb8u1
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ventonic`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aplicants`
--

CREATE TABLE `aplicants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `oportunity_id` bigint(20) UNSIGNED NOT NULL,
  `status_postulations_id` bigint(20) UNSIGNED NOT NULL,
  `type-message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favorite` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `aplicants`
--

INSERT INTO `aplicants` (`id`, `user_id`, `oportunity_id`, `status_postulations_id`, `type-message`, `message`, `favorite`, `created_at`, `updated_at`) VALUES
(1, 8, 7, 1, 'mensaje directo', 'Hola quiero postularme.', 0, '2020-05-31 09:38:10', '2020-05-31 09:39:03'),
(2, 8, 6, 1, 'mensaje directo', 'Buenas noches quiero postularme.', 0, '2020-05-31 09:39:46', '2020-05-31 09:39:46'),
(3, 8, 4, 3, 'mensaje directo', 'Que tal deseo postularme.', 0, '2020-05-31 09:40:20', '2020-05-31 12:35:38'),
(4, 16, 7, 1, 'mensaje directo', 'Hola quiero postularme', 0, '2020-05-31 09:41:38', '2020-05-31 09:41:38'),
(5, 16, 4, 5, 'mensaje directo', 'Que tal deseo postularme en su oportunidad.', 0, '2020-05-31 09:42:13', '2020-05-31 12:35:29'),
(6, 16, 1, 3, 'mensaje directo', 'Hola quiero postularme', 0, '2020-05-31 09:42:44', '2020-07-01 12:55:26'),
(7, 16, 6, 1, 'mensaje directo', 'Deseo postularme', 0, '2020-05-31 09:43:11', '2020-05-31 09:43:17'),
(8, 18, 6, 1, 'mensaje directo', NULL, 0, '2020-05-31 09:46:59', '2020-05-31 09:46:59'),
(9, 18, 3, 3, 'mensaje directo', 'Hola me quiero postular', 0, '2020-05-31 09:47:23', '2020-05-31 13:17:29'),
(10, 8, 10, 1, 'mensaje directo', 'Hola deseo postularme', 0, '2020-06-02 12:50:05', '2020-06-02 12:50:41'),
(11, 8, 11, 1, 'mensaje directo', 'Soy el mejor programador del mundo.', 0, '2020-06-02 23:00:34', '2020-06-02 23:00:34'),
(12, 8, 9, 1, 'mensaje directo', 'Hola quiero postularme', 0, '2020-06-02 23:15:40', '2020-06-02 23:15:40'),
(13, 8, 1, 1, 'mensaje directo', 'Deseo postularme', 0, '2020-06-19 08:40:32', '2020-06-19 08:40:32'),
(14, 18, 11, 1, 'mensaje directo', 'hi', 0, '2020-06-21 02:58:56', '2020-06-21 02:58:56'),
(15, 8, 3, 1, 'mensaje directo', 'Saludos', 0, '2020-06-21 08:00:00', '2020-06-21 08:00:00'),
(16, 18, 10, 1, 'sala chat', NULL, 0, '2020-06-21 08:04:10', '2020-06-21 08:04:10'),
(17, 18, 4, 1, 'sala chat', NULL, 0, '2020-06-21 08:08:19', '2020-06-21 08:08:19'),
(18, 22, 4, 1, 'mensaje directo', 'Me interesa esta oportunidad.', 0, '2020-06-22 09:30:46', '2020-06-22 09:30:46'),
(19, 22, 7, 1, 'mensaje directo', 'Hola, quiero postular.', 0, '2020-06-22 09:35:09', '2020-06-22 09:35:09'),
(20, 18, 18, 1, 'mensaje directo', 'Deseo aportaros valor si me permite demostrárselo con resultados concretos', 0, '2020-10-15 17:47:39', '2020-10-15 17:47:39'),
(21, 18, 19, 1, 'mensaje directo', 'Deseo aportaros valor colaborando juntos', 0, '2020-10-15 23:28:50', '2020-10-15 23:28:50'),
(22, 18, 14, 1, 'mensaje directo', 'Deseo aportaros valor colaborando juntos', 0, '2020-10-15 23:49:13', '2020-10-15 23:49:13'),
(23, 18, 20, 1, 'mensaje directo', 'Deseo aportaros valor colaborando juntos', 0, '2020-10-15 23:56:03', '2020-10-15 23:56:03'),
(24, 187, 14, 1, 'mensaje directo', 'Estoy interesado.', 0, '2020-10-16 10:03:05', '2020-10-16 10:03:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apps`
--

CREATE TABLE `apps` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `type` enum('pub','pri') COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_user` enum('V','E','A') COLLATE utf8mb4_unicode_ci NOT NULL,
  `parameteres` longtext COLLATE utf8mb4_unicode_ci,
  `widget_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iframe` longtext COLLATE utf8mb4_unicode_ci COMMENT 'Iframe para video de explicacion',
  `info` longtext COLLATE utf8mb4_unicode_ci COMMENT 'Informacion general de la app',
  `code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Codigo de la app'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `apps`
--

INSERT INTO `apps` (`id`, `name`, `description`, `type`, `type_user`, `parameteres`, `widget_type`, `created_at`, `updated_at`, `image`, `iframe`, `info`, `code`) VALUES
(1, 'Call Me', 'App para convertir visitas en clientes', 'pub', 'E', NULL, 'freeapps', NULL, NULL, 'images/pages/apps/call_me.jpeg', '<iframe\r\n class=\"img-thumbnail\"\r\n src=\"https://www.youtube.com/embed/vTlSEMdC5qw\"\r\n allowfullscreen\r\n></iframe>', '<strong>App para convertir visitas en clientes</strong>\r\n<br><p>\r\n\r\nInformación genral de como instalar el widget Call Me en su página web\r\n</p>', 'callme');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aptitudes`
--

CREATE TABLE `aptitudes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `aptitudes`
--

INSERT INTO `aptitudes` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Creatividad', NULL, NULL),
(2, 'Persuasión', NULL, NULL),
(3, 'Flexibilidad', NULL, NULL),
(4, 'Iniciativa', NULL, NULL),
(5, 'Resilencia', NULL, NULL),
(6, 'Liderazgo', NULL, NULL),
(7, 'Empatía', NULL, NULL),
(8, 'Seguridad', NULL, NULL),
(9, 'Honestidad', NULL, NULL),
(10, 'Disciplina', NULL, NULL),
(11, 'Inteligencia emocional', NULL, NULL),
(12, 'Actitudes profesionales', NULL, NULL),
(13, 'Adaptabilidad', NULL, NULL),
(14, 'Gestión del tiempo', NULL, NULL),
(15, 'Polivalencia', NULL, NULL),
(16, 'Proactividad', NULL, NULL),
(17, 'Capacidad de resolución', NULL, NULL),
(18, 'Capacidad analítica', NULL, NULL),
(19, 'Lealtad', NULL, NULL),
(20, 'Perseverancia', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendar_settings`
--

CREATE TABLE `calendar_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'gCalendar' COMMENT 'Tipo de aplicación a configurar. Ejemplo: Google Calendar, Outlook Calendar, iCal, etc.',
  `credentials` text COLLATE utf8mb4_unicode_ci COMMENT 'Ruta en donde se encuentra el archivo de credenciales si el cliente del calendario asi lo requiere',
  `api_key` text COLLATE utf8mb4_unicode_ci COMMENT 'Clave de la API si el cliente del calendario asi lo requiere',
  `secret_key` text COLLATE utf8mb4_unicode_ci COMMENT 'Clave secreta de la API si el cliente del calendario asi lo requiere',
  `token` text COLLATE utf8mb4_unicode_ci COMMENT 'Token del API si el cliente del calendario asi lo requiere',
  `calendar_key` text COLLATE utf8mb4_unicode_ci COMMENT 'Identificador del calendario suministrado por la API a configurar, normalmente con el nombre CALENDAR_ID',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `calendar_settings`
--

INSERT INTO `calendar_settings` (`id`, `appType`, `credentials`, `api_key`, `secret_key`, `token`, `calendar_key`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'gContact', NULL, NULL, NULL, '{\"access_token\":\"ya29.a0AfH6SMCkASKBYKus_ofMJB1aOnVIM8KWhImdvPyKC1vVWoaCRYxwluUWv5TZe3fcga0NPyxNVblvkY8tQXJsFyRzzHYrnJP7pLqKnQdXI1cG7cSay6H2WbgZA-886bScNjYIinSrNnR3IYdZNhd_AUm_tbch_NjfxUkx\",\"expires_in\":3599,\"scope\":\"https:\\/\\/www.googleapis.com\\/auth\\/contacts https:\\/\\/www.googleapis.com\\/auth\\/calendar\",\"token_type\":\"Bearer\",\"created\":1602747458}', NULL, 187, '2020-10-14 11:13:59', '2020-10-15 07:37:38'),
(2, 'gContact', NULL, NULL, NULL, '{\"access_token\":\"ya29.a0AfH6SMAjq0olbAI5mpZ6EJ6bUB8bdzYbUI2yV42n-mxHT_1v5TXh5xIzOGX6Lacq4AC_uBTo466YUc3-8R1FI_RfoBD5VBuYHHQAGOVomIGpwhSIMWGJ3iJdzj-TWdDrfjhgmZMa799NeoSuDmJbqkFDO6_WY-rn58Gr\",\"expires_in\":3599,\"scope\":\"https:\\/\\/www.googleapis.com\\/auth\\/calendar https:\\/\\/www.googleapis.com\\/auth\\/contacts\",\"token_type\":\"Bearer\",\"created\":1602727066}', NULL, 8, '2020-10-15 01:21:14', '2020-10-15 01:57:46'),
(6, 'gCalendar', NULL, NULL, NULL, '{\"access_token\":\"ya29.a0AfH6SMBiPpnIe0uZ6VGLr_TMLQ-jFdc99Ko2pjYmnxIETVjun6Ltjhnpk9ORFjmfbYVfWNCl22jROxQz23QnftkHjbJGVyO4_ZhOapu8s7MVq99k5xsn86-_I1OvHF9-GXSGDghZouHZTmNuV1cCQ-koCbcDy5LEh0Zl\",\"expires_in\":3599,\"scope\":\"https:\\/\\/www.googleapis.com\\/auth\\/calendar https:\\/\\/www.googleapis.com\\/auth\\/contacts\",\"token_type\":\"Bearer\",\"created\":1602849136}', NULL, 187, '2020-10-15 11:24:07', '2020-10-16 11:52:16'),
(17, 'gContact', NULL, NULL, NULL, '{\"access_token\":\"ya29.a0AfH6SMDN7KyLJ-zhn-n_uXNCKXEnJxiPzfpS61K7FMz_S3t7af_2OJxvsJAYBqmtgMYm_tr7yQiK-YviISx7ayeuuxcLROa_5vmPBsbeCdl2u5KbsQsfCAtBgIMEKvCtJS41DSaClKO6lBMa7HZSQaIRTxB2X6vDlyIw\",\"expires_in\":3599,\"scope\":\"https:\\/\\/www.googleapis.com\\/auth\\/contacts https:\\/\\/www.googleapis.com\\/auth\\/calendar\",\"token_type\":\"Bearer\",\"created\":1603119599}', NULL, 17, '2020-10-18 18:33:03', '2020-10-19 14:59:59'),
(19, 'gCalendar', NULL, NULL, NULL, '{\"access_token\":\"ya29.a0AfH6SMBA58YJg5q0hcWrhgXBVbLzvV1Q7kYrtMGjZdPlOmAPG1i064aWjbcoAaVJFRuXb6RPX3ZLivnfvOHU2a4yBjTjvxhNJixjw0X5r7Almiv8NacWYP7AdzOyIAtndnA1pgY2D1EupGld56Jvz9lNf17yrPR_v0jS\",\"expires_in\":3599,\"scope\":\"https:\\/\\/www.googleapis.com\\/auth\\/calendar https:\\/\\/www.googleapis.com\\/auth\\/contacts\",\"token_type\":\"Bearer\",\"created\":1603051429}', NULL, 15, '2020-10-18 20:03:49', '2020-10-18 20:03:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `call_events`
--

CREATE TABLE `call_events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `called_at` date NOT NULL,
  `called_time` time NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `follow_task` datetime DEFAULT NULL COMMENT 'establece una fecha y hora para recordatorio o tarea',
  `contact_id` bigint(20) UNSIGNED NOT NULL,
  `call_result_id` bigint(20) UNSIGNED DEFAULT NULL,
  `calleventable_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calleventable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `call_events`
--

INSERT INTO `call_events` (`id`, `called_at`, `called_time`, `description`, `follow_task`, `contact_id`, `call_result_id`, `calleventable_type`, `calleventable_id`, `created_at`, `updated_at`, `user_id`) VALUES
(1, '2020-08-13', '00:00:00', '<p>Llamar nuevamente el 20 de agosto</p>', '2020-08-20 00:00:00', 26, 2, 'App\\Negotiation', 126, '2020-08-14 03:52:26', '2020-08-14 03:52:26', 9),
(2, '2020-10-13', '12:00:00', '<p>Llamar para cerrar</p>', '2020-10-14 00:00:00', 192, 3, 'App\\Contact', 192, '2020-10-12 11:24:37', '2020-10-12 11:24:37', 18),
(3, '2020-10-12', '15:00:00', '<p>Llamar</p>', '2020-10-13 00:00:00', 176, 3, 'App\\Negotiation', 148, '2020-10-12 11:34:58', '2020-10-12 11:34:58', 18),
(4, '2020-10-13', '12:00:00', '<p>Primera conversación.</p>', NULL, 194, 1, 'App\\Negotiation', 150, '2020-10-14 09:31:29', '2020-10-14 09:31:29', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `call_results`
--

CREATE TABLE `call_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `call_results`
--

INSERT INTO `call_results` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Completada', NULL, NULL),
(2, 'No contesto', NULL, NULL),
(3, 'Número Ocupado', NULL, NULL),
(4, 'Número Equivocado', NULL, NULL),
(5, 'Contestadora', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_rooms`
--

CREATE TABLE `chat_rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('OP','NE','CO','OT') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'OT' COMMENT '(OP)ortunidad, (NE)gocio, (CO)ntactos, (OT)ros',
  `origenable_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `origenable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `chat_rooms`
--

INSERT INTO `chat_rooms` (`id`, `type`, `origenable_type`, `origenable_id`, `created_at`, `updated_at`) VALUES
(33, 'OT', NULL, NULL, '2020-08-27 10:01:39', '2020-08-27 10:01:39'),
(34, 'OT', NULL, NULL, '2020-08-29 00:31:13', '2020-09-08 09:53:21'),
(35, 'OT', NULL, NULL, '2020-09-08 09:28:02', '2020-10-01 22:39:40'),
(36, 'OT', NULL, NULL, '2020-09-20 10:29:34', '2020-09-20 11:48:00'),
(37, 'OT', NULL, NULL, '2020-09-20 10:46:10', '2020-09-20 10:46:10'),
(38, 'OT', NULL, NULL, '2020-09-20 10:57:46', '2020-09-20 10:57:46'),
(39, 'OT', NULL, NULL, '2020-09-20 11:47:19', '2020-09-20 11:47:37'),
(40, 'OT', NULL, NULL, '2020-09-30 10:49:36', '2020-10-05 07:48:42'),
(41, 'OT', NULL, NULL, '2020-10-01 06:21:33', '2020-10-01 06:21:33'),
(46, 'OT', NULL, NULL, '2020-10-08 20:59:30', '2020-10-08 20:59:30'),
(47, 'OT', NULL, NULL, '2020-10-08 21:00:54', '2020-10-08 21:00:54'),
(48, 'OT', NULL, NULL, '2020-10-08 21:16:52', '2020-10-08 21:19:04'),
(49, 'OT', NULL, NULL, '2020-10-15 15:11:45', '2020-10-15 15:13:55'),
(50, 'OP', NULL, NULL, '2020-10-15 15:36:08', '2020-10-15 15:36:08'),
(51, 'OT', NULL, NULL, '2020-10-16 20:45:03', '2020-10-16 20:45:03'),
(52, 'OT', NULL, NULL, '2020-10-20 07:13:56', '2020-10-20 07:14:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_room_user`
--

CREATE TABLE `chat_room_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chat_room_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `chat_room_user`
--

INSERT INTO `chat_room_user` (`id`, `chat_room_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 33, 8, '2020-08-27 10:01:39', '2020-08-27 10:01:39'),
(2, 33, 9, '2020-08-27 10:01:39', '2020-08-27 10:01:39'),
(3, 34, 8, '2020-08-29 00:31:13', '2020-09-08 09:53:21'),
(4, 34, 9, '2020-08-29 00:31:14', '2020-09-08 09:53:21'),
(5, 35, 8, '2020-09-08 09:28:02', '2020-10-01 22:39:40'),
(6, 35, 9, '2020-09-08 09:28:02', '2020-10-01 22:39:40'),
(7, 36, 18, '2020-09-20 10:29:34', '2020-09-20 11:48:00'),
(8, 36, 9, '2020-09-20 10:29:34', '2020-09-20 11:48:00'),
(9, 37, 18, '2020-09-20 10:46:10', '2020-09-20 10:46:10'),
(10, 37, 9, '2020-09-20 10:46:10', '2020-09-20 10:46:10'),
(11, 38, 18, '2020-09-20 10:57:46', '2020-09-20 10:57:46'),
(12, 38, 9, '2020-09-20 10:57:46', '2020-09-20 10:57:46'),
(13, 39, 18, '2020-09-20 11:47:19', '2020-09-20 11:47:37'),
(14, 39, 9, '2020-09-20 11:47:19', '2020-09-20 11:47:37'),
(15, 40, 17, '2020-09-30 10:49:36', '2020-10-05 07:48:42'),
(16, 40, 15, '2020-09-30 10:49:36', '2020-10-05 07:48:42'),
(17, 41, 8, '2020-10-01 06:21:33', '2020-10-01 06:21:33'),
(18, 41, 14, '2020-10-01 06:21:33', '2020-10-01 06:21:33'),
(27, 46, 187, '2020-10-08 20:59:30', '2020-10-08 20:59:30'),
(28, 46, 15, '2020-10-08 20:59:30', '2020-10-08 20:59:30'),
(29, 47, 187, '2020-10-08 21:00:54', '2020-10-08 21:00:54'),
(30, 47, 15, '2020-10-08 21:00:54', '2020-10-08 21:00:54'),
(31, 48, 187, '2020-10-08 21:16:52', '2020-10-08 21:19:04'),
(32, 48, 15, '2020-10-08 21:16:52', '2020-10-08 21:19:04'),
(33, 49, 18, '2020-10-15 15:11:45', '2020-10-15 15:13:55'),
(34, 49, 14, '2020-10-15 15:11:45', '2020-10-15 15:13:55'),
(35, 50, 14, '2020-10-15 15:36:08', '2020-10-15 15:36:08'),
(36, 50, 16, '2020-10-15 15:36:08', '2020-10-15 15:36:08'),
(37, 51, 18, '2020-10-16 20:45:03', '2020-10-16 20:45:03'),
(38, 51, 15, '2020-10-16 20:45:03', '2020-10-16 20:45:03'),
(39, 52, 22, '2020-10-20 07:13:56', '2020-10-20 07:14:05'),
(40, 52, 9, '2020-10-20 07:13:56', '2020-10-20 07:14:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company_answered_surveys`
--

CREATE TABLE `company_answered_surveys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `option_index` int(11) NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `company_answered_surveys`
--

INSERT INTO `company_answered_surveys` (`id`, `option_index`, `question_id`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 21, 1, 9, '2020-05-15 00:15:29', '2020-05-15 00:15:29'),
(8, 13, 1, 13, '2020-08-27 07:55:02', '2020-08-27 07:55:02'),
(14, 18, 1, 14, '2020-10-15 10:43:56', '2020-10-15 10:43:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company_profiles`
--

CREATE TABLE `company_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dni_rif` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` double(8,2) NOT NULL DEFAULT '0.00' COMMENT 'Estatus completado',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `answered` longtext COLLATE utf8mb4_unicode_ci,
  `notified` tinyint(1) NOT NULL DEFAULT '0',
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `company_profiles`
--

INSERT INTO `company_profiles` (`id`, `country`, `dni_rif`, `status`, `user_id`, `created_at`, `updated_at`, `answered`, `notified`, `photo`) VALUES
(1, '+34', NULL, 75.00, 9, '2020-05-13 11:02:04', '2020-05-15 00:15:29', '[{\"question_id\":\"1\",\"option_index\":\"21\"}]', 0, 'storage/files/5ebda6e14a1a85.67820891.png'),
(2, '+34', NULL, 50.00, 13, '2020-05-13 11:03:09', '2020-08-27 07:55:02', '[{\"question_id\":\"1\",\"option_index\":\"13\"}]', 0, NULL),
(3, '+34xxxxxxxxx', 'XXXXXXXXX', 100.00, 14, '2020-08-27 08:07:53', '2020-10-15 10:43:56', '[{\"question_id\":\"1\",\"option_index\":\"18\"}]', 1, 'storage/files/5f8827ec704751.53761338.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_latitude` double DEFAULT NULL,
  `address_longitude` double DEFAULT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sector` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` longtext COLLATE utf8mb4_unicode_ci,
  `share` tinyint(1) DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `favorite` tinyint(1) DEFAULT '0',
  `stickers` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cargo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `private` tinyint(1) DEFAULT NULL,
  `type_contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `allow_change_image` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Indica si se permite la modificación de la imagen',
  `image_updated_at` datetime DEFAULT NULL COMMENT 'Fecha de la última modificación de la imagen',
  `change_image_user_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Identificador del último usuario que modificó la imagen',
  `external_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'identificador externo del contacto',
  `external_contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Determina la fuente externa desde donde se extraen los contactos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `last_name`, `image`, `email`, `web`, `phone`, `company`, `address`, `address_latitude`, `address_longitude`, `postal_code`, `sector`, `notes`, `share`, `country_id`, `user_id`, `favorite`, `stickers`, `cargo`, `created_at`, `updated_at`, `private`, `type_contact`, `contact_type_id`, `allow_change_image`, `image_updated_at`, `change_image_user_id`, `external_key`, `external_contact`) VALUES
(1, 'Jose', 'Rojas', NULL, 'rojasj@correo.com', NULL, '04245556677', 'rojas\' coorporation', 'Calle2', NULL, NULL, '20903', 'Agricultura', 'Cliente a considerar en proximas negociaciones.', NULL, 11, 8, 0, NULL, NULL, '2020-06-03 05:35:10', '2020-06-03 05:35:10', NULL, '', NULL, 1, NULL, NULL, NULL, NULL),
(2, 'Jose', 'Rojas', NULL, 'rojasj@correo.com', 'rojas.com', '04245556677', 'rojas\' coorporation', 'Calle2', NULL, NULL, '20903', 'Agricultura', 'Cliente a considerar en proximas negociaciones.', NULL, 11, 8, 0, NULL, NULL, '2020-06-03 07:08:25', '2020-06-03 07:08:25', NULL, '', NULL, 1, NULL, NULL, NULL, NULL),
(3, 'Jose', 'Lara', NULL, 'jose@correo.com', 'jose.com', '454534', 'empresa', 'calle2', NULL, NULL, '30492', 'Comercio', 'Futuro inversionista', NULL, 17, 8, 0, NULL, 'operador', '2020-06-03 07:14:51', '2020-06-03 07:14:51', NULL, '', NULL, 1, NULL, NULL, NULL, NULL),
(4, 'Juan', 'Sanchez', NULL, 'textilera@correo.com', 'textilera.com', '55533355', 'Textilera', 'Malaga', NULL, NULL, '2091', 'Administracion', 'Tenerlo en cuenta', NULL, 1, 8, 0, NULL, 'Coordinador', '2020-06-03 09:45:24', '2020-06-03 09:45:24', NULL, '', NULL, 1, NULL, NULL, NULL, NULL),
(6, 'Mi empresa', 'Favorita', NULL, NULL, NULL, NULL, NULL, 'Calle de Alcalá, 23, Madrid, Spain', 40.4182023, -3.6992631, NULL, NULL, NULL, NULL, NULL, 9, NULL, NULL, NULL, '2020-06-18 15:50:32', '2020-06-19 08:41:53', NULL, 'persona', NULL, 1, NULL, NULL, NULL, NULL),
(9, 'LUIS', NULL, NULL, NULL, NULL, NULL, NULL, 'Mánchester, Manchester, Reino Unido', 53.4807593, -2.2426305, NULL, NULL, NULL, NULL, NULL, 9, 1, NULL, NULL, '2020-06-25 20:58:11', '2020-06-25 20:58:11', NULL, 'empresa', NULL, 1, NULL, NULL, NULL, NULL),
(10, 'Lura Lockman', 'Reichert', NULL, 'adolph.durgan@example.net', NULL, '1-866-667-3124', NULL, '2377 Gutmann Villages Suite 007\nNew Crystel, NC 55261-9065', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-06-27 10:00:00', '2020-07-11 02:56:08', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(11, 'Ms. Burnice Kutch PhD', 'D\'Amore', NULL, 'wsimonis@example.net', NULL, '866-988-0183', NULL, '27035 Kunde Place Apt. 522\nLegrosmouth, WY 51514-3515', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-06-27 10:00:00', '2020-07-11 02:56:08', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(12, 'Prof. Kaleigh Hills', 'Hane', NULL, 'nasir53@example.com', NULL, '1-866-490-0155', NULL, '547 Rico Center Suite 419\nSatterfieldborough, OR 17620-9487', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-06-27 10:00:00', '2020-07-11 02:56:08', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(13, 'Prof. Bernadine Kerluke II', 'Gerlach', NULL, 'kylee.dach@example.com', NULL, '(866) 535-2306', NULL, '9235 Julius Island\nWest Catherine, WA 23445-9783', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-06-27 10:00:00', '2020-07-11 02:56:09', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(14, 'Prof. Yesenia Larson', 'Gislason', NULL, 'loberbrunner@example.com', NULL, '1-877-708-0615', NULL, '3142 Tyra Corners\nPort Novaside, ME 80396', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-06-27 10:00:00', '2020-07-11 02:56:09', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(15, 'Niko Kovacek', 'Pouros', NULL, 'ken.satterfield@example.net', NULL, '1-844-886-3118', NULL, '43874 Conroy Prairie\nEast Frederickton, NJ 79603', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-06-28 10:00:00', '2020-07-11 02:56:09', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(16, 'Emelie Macejkovic', 'Schmidt', NULL, 'irwin53@example.com', NULL, '800-718-2977', NULL, '706 Mraz Creek Apt. 843\nLake Wilton, MI 41928-3310', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-06-28 10:00:00', '2020-07-11 02:56:09', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(17, 'Alta Russel', 'Bogan', NULL, 'blick.mavis@example.net', NULL, '(888) 460-6073', NULL, '853 Greta Causeway Suite 342\nBoehmburgh, KY 80689-6903', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-06-28 10:00:00', '2020-07-11 02:56:09', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(18, 'Jaunita Kozey PhD', 'Schultz', NULL, 'gbrown@example.com', NULL, '800-215-4372', NULL, '252 Gerson Mill Suite 448\nJesustown, TN 91726-6230', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-06-28 10:00:00', '2020-07-11 02:56:09', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(19, 'Mrs. Breanne Kuhlman', 'Bergstrom', NULL, 'irutherford@example.net', NULL, '(877) 712-2940', NULL, '6187 McLaughlin Spring\nProhaskastad, OH 91938-0640', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-06-28 10:00:00', '2020-07-11 02:56:09', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(20, 'Phyllis Crist', 'Bernhard', NULL, 'llarson@example.net', NULL, '1-877-958-9354', NULL, '87828 Adrien Motorway Suite 764\nCatherineside, NM 94537', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-06-28 10:00:00', '2020-07-11 02:56:09', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(21, 'Kobe Dietrich', 'Will', NULL, 'dgibson@example.net', NULL, '1-866-917-9095', NULL, '866 Wilma Court Suite 358\nLake Demarcofort, NH 75190-8894', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-06-29 10:00:00', '2020-07-11 02:56:09', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(22, 'Golda Carter', 'Sawayn', NULL, 'damion83@example.net', NULL, '(844) 639-6593', NULL, '827 Rosalia Creek\nWest Pierceport, AZ 90133', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-06-29 10:00:00', '2020-07-11 02:56:09', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(23, 'Rasheed Carter PhD', 'Hettinger', NULL, 'christine.king@example.org', NULL, '844-671-0597', NULL, '4578 Lang Point Suite 748\nNorth Jamalhaven, MA 50252-0744', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-06-29 10:00:00', '2020-07-11 02:56:09', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(24, 'Sister Funk', 'Bayer', NULL, 'fmueller@example.org', NULL, '844.862.8913', NULL, '37542 Toby Plains Suite 941\nSchroedermouth, DC 13093-8031', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-06-29 10:00:00', '2020-07-11 02:56:09', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(25, 'Prof. Matteo Schroeder IV', 'Orn', NULL, 'destin63@example.com', NULL, '800.627.2592', NULL, '8124 Pouros Curve\nEast Caliville, MI 21111-5547', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-06-30 10:00:00', '2020-07-11 02:56:10', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(26, 'Aditya Smith', 'Robel', NULL, 'seamus77@example.org', NULL, '(866) 941-6875', NULL, '413 Elena Loop\nPort Wilton, AR 54696-9798', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-06-30 10:00:00', '2020-07-11 02:56:10', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(27, 'Dr. Marley West II', 'Nicolas', NULL, 'kylee19@example.org', NULL, '(800) 350-7235', NULL, '40852 Boehm Extension\nBaileyhaven, NY 97012-2425', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-06-30 10:00:00', '2020-07-11 02:56:10', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(28, 'Maximus Heidenreich IV', 'Harber', NULL, 'roberts.pierre@example.com', NULL, '(844) 890-9223', NULL, '9782 Leuschke Key Suite 030\nJannieburgh, TX 62566-5055', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-06-30 10:00:00', '2020-07-11 02:56:10', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(29, 'Britney Klocko Sr.', 'Macejkovic', NULL, 'brenda.effertz@example.org', NULL, '877-967-0368', NULL, '9090 Fleta Fords Apt. 834\nDerrickmouth, PA 24572-4978', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-06-30 10:00:00', '2020-07-11 02:56:10', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(30, 'Margaret Rippin', 'Hessel', NULL, 'kulas.kory@example.org', NULL, '800-392-0606', NULL, '937 Lauren Cape Apt. 237\nBaumbachbury, MS 97963', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-06-30 10:00:00', '2020-07-11 02:56:10', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(31, 'Curtis Schinner', 'Bergstrom', NULL, 'kschmeler@example.com', NULL, '1-866-806-9432', NULL, '86543 Bridie Green\nStokesview, NH 46871-4068', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-06-30 10:00:00', '2020-07-11 02:56:10', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(32, 'Dedrick Legros', 'Halvorson', NULL, 'zelma.hudson@example.com', NULL, '844-248-2029', NULL, '79195 Nelle Pine\nPort Al, IL 42976', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-06-30 10:00:00', '2020-07-11 02:56:10', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(33, 'Adelle Gottlieb', 'O\'Connell', NULL, 'testtristest@outlook.com', NULL, NULL, NULL, '27100 Abbigail ValleysPort Joanne, IL 47979', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, NULL, NULL, NULL, '2020-07-01 10:00:00', '2020-08-04 09:51:16', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(34, 'Prof. Kareem Larkin DVM', 'Spinka', NULL, 'gladys.nolan@example.org', NULL, '855.524.1307', NULL, '5887 Roma Lodge\nNorth Sheldonmouth, GA 62087', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-01 10:00:00', '2020-07-11 02:56:10', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(35, 'Glen Smith', 'Wyman', NULL, 'chance88@example.com', NULL, '(844) 654-3128', NULL, '617 Verna Ford\nPort Jocelyn, CT 14638', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-01 10:00:00', '2020-07-11 02:56:10', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(36, 'Berry Olson', 'Hilpert', NULL, 'aiden78@example.org', NULL, '855-842-8877', NULL, '26538 Heller Well Apt. 715\nKassulkeborough, NJ 52202-3090', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-01 10:00:00', '2020-07-11 02:56:10', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(37, 'Kaitlin Reichel II', 'Bins', NULL, 'sebastian06@example.org', NULL, '866.929.6818', NULL, '4612 Edmond Valley Suite 297\nShemarstad, RI 56499-3377', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-01 10:00:00', '2020-07-11 02:56:10', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(38, 'Zane Harvey', 'Smith', NULL, 'wilkinson.alan@example.net', NULL, '(877) 470-0617', NULL, '829 Ken Isle Apt. 211\nWest Deron, IA 75364-7895', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-01 10:00:00', '2020-07-11 02:56:10', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(39, 'Haleigh Donnelly', 'Cummings', NULL, 'gretchen75@example.org', NULL, '1-800-304-9045', NULL, '9992 Gusikowski Points Suite 194\nHilmaside, ME 84717', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-01 10:00:00', '2020-07-11 02:56:10', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(40, 'Mariela Williamson', 'Purdy', NULL, 'candice.kutch@example.com', NULL, '1-844-665-1258', NULL, '68203 McClure Rue\nSouth Vivienton, NM 44062', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-01 10:00:00', '2020-07-11 02:56:10', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(41, 'Carlo Yundt', 'Feeney', NULL, 'ppollich@example.com', NULL, '855.864.0533', NULL, '5964 Vivian Forges\nRempelfort, CO 43704', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-01 10:00:00', '2020-07-11 02:56:10', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(42, 'Ms. Elena Ward DDS', 'Gutkowski', NULL, 'nader.jay@example.org', NULL, '(855) 892-7530', NULL, '4286 Geoffrey Shore\nWeimanntown, OR 05110', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-02 10:00:00', '2020-07-11 02:56:11', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(43, 'Emerald Greenholt', 'Mueller', NULL, 'ncremin@example.com', NULL, '1-877-895-8012', NULL, '72018 O\'Kon Throughway\nZulaufmouth, CO 03855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-02 10:00:00', '2020-07-11 02:56:11', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(44, 'Mr. Winfield Ryan', 'Klein', NULL, 'bcollins@example.org', NULL, '855-858-2355', NULL, '64901 Sporer Trail\nPort Annabellfort, NE 46317-9399', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-02 10:00:00', '2020-07-11 02:56:11', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(45, 'Dawn Schoen', 'Jerde', NULL, 'monserrat.jacobs@example.com', NULL, '(888) 290-6547', NULL, '5979 Hilbert Ville Apt. 942\nWunschport, VT 91759-1174', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-03 10:00:00', '2020-07-11 02:56:11', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(46, 'Dr. Bobbie Langworth', 'Huel', NULL, 'adelle08@example.com', NULL, '855.258.9614', NULL, '638 Aufderhar Road Apt. 928\nDickinsonshire, MN 70390', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-03 10:00:00', '2020-07-11 02:56:11', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(47, 'Prof. Lucius McClure', 'Feil', NULL, 'dorris90@example.net', NULL, '866.944.4857', NULL, '97403 Riley Turnpike\nLake Peyton, FL 85820', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-03 10:00:00', '2020-07-11 02:56:11', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(48, 'Astrid Kulas III', 'Gibson', NULL, 'davis.bella@example.org', NULL, '877-491-0914', NULL, '81215 Jarrell Bypass Apt. 570\nNew Geoffrey, CT 72329-3048', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-03 10:00:00', '2020-07-11 02:56:11', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(49, 'Coby Medhurst DDS', 'King', NULL, 'xhartmann@example.net', NULL, '1-888-721-3889', NULL, '62071 Roma Street Suite 631\nEast Adeline, SD 50019-0812', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-03 10:00:00', '2020-07-11 02:56:11', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(50, 'Emie Wilderman', 'Yundt', NULL, 'qokeefe@example.com', NULL, '800.898.5923', NULL, '2988 Erdman Mountain\nDietrichville, IN 88627', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-03 10:00:00', '2020-07-11 02:56:11', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(51, 'Maia Cartwright', 'Littel', NULL, 'nader.gino@example.com', NULL, '866-373-0771', NULL, '79763 Maribel Burg Suite 646\nKileyville, MI 92638', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-03 10:00:00', '2020-07-11 02:56:11', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(52, 'Miss Vanessa Harber', 'Marquardt', NULL, 'lehner.danielle@example.com', NULL, '(800) 380-3562', NULL, '94670 Bechtelar Points\nEast Kimberly, FL 55106-0787', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-03 10:00:00', '2020-07-11 02:56:11', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(53, 'Demario Friesen I', 'Padberg', NULL, 'viva.abshire@example.com', NULL, '866-803-9238', NULL, '8311 Gottlieb Meadow Suite 780\nLake Ocie, IN 07541-8596', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-03 10:00:00', '2020-07-11 02:56:11', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(54, 'Mr. Timmy Monahan III', 'DuBuque', NULL, 'elwyn.satterfield@example.net', NULL, '800.853.1005', NULL, '91989 Buckridge Mall Suite 144\nLake Zelda, MO 77342', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-03 10:00:00', '2020-07-11 02:56:11', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(55, 'Dr. Keaton Schmitt II', 'Heidenreich', NULL, 'dcorkery@example.org', NULL, '1-866-780-9824', NULL, '64480 Hegmann Summit\nLittlehaven, TX 15392-6878', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-03 10:00:00', '2020-07-11 02:56:12', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(56, 'Prof. Freddie Morar', 'Feeney', NULL, 'cathryn.bauch@example.org', NULL, '877-250-7398', NULL, '90360 Marilou Vista Suite 102\nSouth Ryley, NJ 82363-2655', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-03 10:00:00', '2020-07-11 02:56:12', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(57, 'Dr. Camilla Hand', 'Wuckert', NULL, 'duane26@example.org', NULL, '844.660.5156', NULL, '832 Leuschke Road Apt. 402\nPaxtonland, AL 15415', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-04 10:00:00', '2020-07-11 02:56:12', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(58, 'Dr. Randi Sipes II', 'Shields', NULL, 'tmitchell@example.org', NULL, '(888) 426-8777', NULL, '6259 Kreiger Fort\nPort Mateo, TX 45344-2143', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-04 10:00:00', '2020-07-11 02:56:12', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(59, 'Myrtie Wintheiser Sr.', 'Pollich', NULL, 'haley03@example.com', NULL, '855.444.2632', NULL, '37864 Alba Trafficway\nAngiechester, DC 78118-4574', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-04 10:00:00', '2020-07-11 02:56:12', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(60, 'Lela Hills MD', 'Hartmann', NULL, 'javonte.quigley@example.net', NULL, '(877) 524-4701', NULL, '1855 Carroll Rest\nWest Elishaland, CT 42152', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-04 10:00:00', '2020-07-11 02:56:12', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(61, 'Mertie Terry', 'Krajcik', NULL, 'hudson.linda@example.net', NULL, '(800) 486-5511', NULL, '69766 Icie Brooks Suite 296\nNew Celineville, DC 14395', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-04 10:00:00', '2020-07-11 02:56:12', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(62, 'Beatrice Kreiger', 'O\'Keefe', NULL, 'hbins@example.com', NULL, '866.624.5978', NULL, '9366 Jennie Crest Apt. 176\nMaurinehaven, CT 48232-5272', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-04 10:00:00', '2020-07-11 02:56:12', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(63, 'Prof. Andrew Heathcote MD', 'Shanahan', NULL, 'kuvalis.bernie@example.net', NULL, '1-800-550-1018', NULL, '598 Auer Plain\nMaeveburgh, AR 45308-8868', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-04 10:00:00', '2020-07-11 02:56:12', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(64, 'Selmer Padberg Sr.', 'Runte', NULL, 'afriesen@example.com', NULL, '888.345.2571', NULL, '57384 Jade Islands\nLake Olga, UT 25311', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-04 10:00:00', '2020-07-11 02:56:12', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(65, 'Hailee Gaylord', 'Trantow', NULL, 'miguel82@example.com', NULL, '800-983-0124', NULL, '5117 Kilback Forest Apt. 389\nEast Forrestshire, CA 27514-4010', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-04 10:00:00', '2020-07-11 02:56:12', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(66, 'Dr. Arch Boyle IV', 'Gutmann', NULL, 'moises.deckow@example.net', NULL, '1-855-456-5521', NULL, '499 Nader Village Suite 403\nFaheychester, HI 45942', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-05 10:00:00', '2020-07-11 02:56:13', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(67, 'Pierre McKenzie', 'Huel', NULL, 'cbartoletti@example.org', NULL, '877-736-3890', NULL, '1432 Kuphal Crest\nKendallfort, GA 13099', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-05 10:00:00', '2020-07-11 02:56:13', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(68, 'Terrill Kutch', 'Zieme', NULL, 'cathryn.roberts@example.com', NULL, '844.762.8702', NULL, '66777 Marquardt Extension Suite 156\nBraunhaven, CT 77988', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-05 10:00:00', '2020-07-11 02:56:13', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(69, 'Alex Cummerata', 'Rodriguez', NULL, 'barton.ward@example.org', NULL, '877-694-4402', NULL, '26145 Schowalter Prairie Suite 432\nYundtton, WI 80036', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-05 10:00:00', '2020-07-11 02:56:13', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(70, 'Dr. Daryl Eichmann III', 'Kuvalis', NULL, 'kattie26@example.org', NULL, '888-461-5199', NULL, '3595 Pearl Mission\nWest Timmothyberg, NE 44822-7558', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-05 10:00:00', '2020-07-11 02:56:13', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(71, 'Armand Hegmann', 'Roberts', NULL, 'kunde.daryl@example.org', NULL, '1-877-255-4185', NULL, '8943 Predovic Port\nNorth Patrickport, PA 89470-0937', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-05 10:00:00', '2020-07-11 02:56:13', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(72, 'Mrs. Justine Leuschke', 'Schmidt', NULL, 'vivienne76@example.org', NULL, '1-866-925-3527', NULL, '36323 Prohaska Greens Suite 563\nHermanmouth, LA 70542-7757', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-05 10:00:00', '2020-07-11 02:56:13', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(73, 'Flossie Gulgowski', 'Bergnaum', NULL, 'lue38@example.org', NULL, '800-730-0343', NULL, '52839 Petra Cove Apt. 454\nWilliamsonchester, ME 51118-7802', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-05 10:00:00', '2020-07-11 02:56:13', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(74, 'Alfred Reichel', 'Beier', NULL, 'rosendo.wiegand@example.org', NULL, '1-800-402-7956', NULL, '449 Dach Radial Suite 339\nPort Elisha, DE 52604', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-05 10:00:00', '2020-07-11 02:56:13', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(75, 'Justus Brekke PhD', 'Schmidt', NULL, 'dereck55@example.org', NULL, '1-888-351-6136', NULL, '519 Klocko Run Suite 661\nNorth Tomas, ME 11226', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-05 10:00:00', '2020-07-11 02:56:13', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(76, 'Danial Klein V', 'Smith', NULL, 'ena.hettinger@example.com', NULL, '855.828.7540', NULL, '54034 Rogahn Falls Apt. 536\nSteuberton, CA 94649-1954', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-05 10:00:00', '2020-07-11 02:56:13', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(77, 'Kristina Bednar', 'Emard', NULL, 'ned.rodriguez@example.com', NULL, '1-866-314-9101', NULL, '455 Nicolas Falls Suite 451\nSouth Tyrique, AR 70506-9367', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-05 10:00:00', '2020-07-11 02:56:13', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(78, 'Cassie O\'Reilly', 'O\'Hara', NULL, 'maribel02@example.org', NULL, '(800) 742-3131', NULL, '782 Vita Brooks\nLake Mauricio, AZ 08117-1231', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-05 10:00:00', '2020-07-11 02:56:13', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(79, 'Eliza Moen', 'Walter', NULL, 'zrutherford@example.com', NULL, '(888) 243-9970', NULL, '925 Koepp Lodge\nEast Mariannahaven, AK 31052-1110', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-05 10:00:00', '2020-07-11 02:56:13', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(80, 'Tyreek Lindgren', 'Monahan', NULL, 'ella.torp@example.org', NULL, '(855) 868-3764', NULL, '1394 Maya Square\nMcDermottmouth, GA 73818-6651', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-06 10:00:00', '2020-07-11 02:56:14', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(81, 'Geovanni Rempel II', 'Aufderhar', NULL, 'cortez.pacocha@example.net', NULL, '866.412.6436', NULL, '206 Marks Estates Apt. 001\nNorth Green, SD 65882', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-06 10:00:00', '2020-07-11 02:56:14', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(82, 'Anais Christiansen', 'Mitchell', NULL, 'laron49@example.com', NULL, '888-950-5155', NULL, '1399 Prosacco Mews Apt. 911\nNaomihaven, MI 18183-3722', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-06 10:00:00', '2020-07-11 02:56:14', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(83, 'Rashad Monahan DVM', 'Balistreri', NULL, 'itzel.ondricka@example.org', NULL, '1-888-974-5090', NULL, '6184 Hildegard Points\nSouth Kacey, WA 64514', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-06 10:00:00', '2020-07-11 02:56:14', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(84, 'Eddie Fritsch I', 'Kozey', NULL, 'lubowitz.yvette@example.org', NULL, '866-214-6363', NULL, '798 Reynolds Union Suite 177\nHirthestad, LA 74175', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-06 10:00:00', '2020-07-11 02:56:14', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(85, 'Kieran Swift', 'Langosh', NULL, 'frederique.paucek@example.net', NULL, '1-800-649-6979', NULL, '71183 Jacey Overpass\nSouth Destineefort, SC 37619-1932', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-06 10:00:00', '2020-07-11 02:56:14', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(86, 'Prof. Javier Abbott', 'Zemlak', NULL, 'ernser.jenifer@example.net', NULL, '1-888-547-3377', NULL, '23722 Jakubowski Rapid Apt. 262\nSchoenshire, NH 01095', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-06 10:00:00', '2020-07-11 02:56:14', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(87, 'Molly Rodriguez MD', 'Gleichner', NULL, 'koss.domenick@example.org', NULL, '1-877-823-2368', NULL, '4233 Gutmann Freeway Apt. 218\nWest Lemuel, VT 26670-2953', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-06 10:00:00', '2020-07-11 02:56:14', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(88, 'Lisa Hermiston', 'Deckow', NULL, 'hermiston.donny@example.net', NULL, '1-877-633-8157', NULL, '3954 Yost Valley Apt. 380\nBashirianbury, MA 20720', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-06 10:00:00', '2020-07-11 02:56:14', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(89, 'Irwin Runte', 'Harber', NULL, 'frederick79@example.org', NULL, '888-758-1328', NULL, '18207 Rosie Ford\nGusikowskiton, RI 35856-8595', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-06 10:00:00', '2020-07-11 02:56:14', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(90, 'Finn Pfannerstill', 'Aufderhar', NULL, 'ulittel@example.net', NULL, '877-804-6163', NULL, '979 Abshire Ports\nYostchester, KY 99608-1938', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-06 10:00:00', '2020-07-11 02:56:14', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(91, 'Harvey Littel', 'Hane', NULL, 'eldridge.schaefer@example.net', NULL, '1-800-754-6282', NULL, '61810 Armstrong Wall\nLake Jeanne, AZ 08245-6277', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-06 10:00:00', '2020-07-11 02:56:14', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(92, 'Aisha Wiegand I', 'Mueller', NULL, 'ellie.walter@example.com', NULL, '(855) 649-0426', NULL, '8769 Vince Run\nSchmelerfurt, WY 91967', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-06 10:00:00', '2020-07-11 02:56:15', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(93, 'Javon Bergstrom', 'Baumbach', NULL, 'leone29@example.org', NULL, '(866) 271-8134', NULL, '310 Zemlak Spurs Apt. 375\nVandervortview, DE 19445-2494', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-06 10:00:00', '2020-07-11 02:56:15', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(94, 'Elena Kutch', 'Kunze', NULL, 'walsh.kameron@example.net', NULL, '(855) 948-3255', NULL, '917 Jace Ville Apt. 791\nWest Waltonview, KS 80792-3141', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-06 10:00:00', '2020-07-11 02:56:15', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(95, 'Randal Dietrich DDS', 'Kirlin', NULL, 'rbernhard@example.org', NULL, '(800) 560-8200', NULL, '9116 VonRueden Inlet\nZiemannhaven, GA 51978-4745', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-06 10:00:00', '2020-07-11 02:56:15', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(96, 'Eliane Hilpert V', 'Balistreri', NULL, 'rhett.kunde@example.org', NULL, '877-595-3070', NULL, '86178 Collier Junction\nImeldafort, RI 02928', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-06 10:00:00', '2020-07-11 02:56:15', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(97, 'Anthony Emmerich', 'Rowe', NULL, 'leif61@example.net', NULL, '(844) 636-2767', NULL, '406 West Curve\nSouth Derek, KY 34150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-06 10:00:00', '2020-07-11 02:56:15', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(98, 'Prof. Arianna Rogahn IV', 'Langosh', NULL, 'braun.joel@example.net', NULL, '866.836.0414', NULL, '5283 Hildegard Row\nSouth Lorifort, WA 83745-0457', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-06 10:00:00', '2020-07-11 02:56:15', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(99, 'Sofia Ullrich', 'Hackett', NULL, 'gordon95@example.com', NULL, '(800) 901-2013', NULL, '71478 Karelle Vista Suite 787\nSouth Leiftown, DE 72521-8535', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-06 10:00:00', '2020-07-11 02:56:15', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(100, 'Prof. Moses Grady', 'Berge', NULL, 'daniel.otilia@example.org', NULL, '1-800-381-5418', NULL, '379 Axel Fields Suite 807\nPort Ruth, AZ 26544-6917', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-07 10:00:00', '2020-07-11 02:56:15', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(101, 'Prof. Jarred Block', 'McLaughlin', NULL, 'ehudson@example.net', NULL, '(888) 493-2591', NULL, '744 Bauch Lock Apt. 687\nSawaynville, VT 67470', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-07 10:00:00', '2020-07-11 02:56:15', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(102, 'Deborah Medhurst', 'Ruecker', NULL, 'jerde.laisha@example.net', NULL, '888.473.8381', NULL, '330 Willms Pass\nNew Madalyn, FL 89912', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-07 10:00:00', '2020-07-11 02:56:15', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(103, 'Lillian Bechtelar V', 'McGlynn', NULL, 'xgerhold@example.net', NULL, '1-888-869-7954', NULL, '2046 Wunsch Squares\nLake Ebony, NH 34681-5072', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-07 10:00:00', '2020-07-11 02:56:15', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(104, 'Charles Lowe', 'Jacobi', NULL, 'clemens.abshire@example.org', NULL, '(800) 686-8806', NULL, '3858 Lucienne Wall Apt. 917\nNorth Hectorhaven, IN 48615', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-07 10:00:00', '2020-07-11 02:56:15', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(105, 'Giovanny Johnson', 'Zieme', NULL, 'diego.mohr@example.com', NULL, '(866) 380-5132', NULL, '89723 O\'Kon Ridges Apt. 881\nWest Rosaburgh, KS 01109', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-07 10:00:00', '2020-07-11 02:56:15', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(106, 'Adrianna Beier', 'Harvey', NULL, 'otha.cartwright@example.net', NULL, '877.806.3330', NULL, '72671 Gregorio Drives Suite 816\nNorth Jarredborough, ME 03033-3247', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-07 10:00:00', '2020-07-11 02:56:15', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(107, 'Ms. Margie Legros II', 'Hammes', NULL, 'tanya26@example.org', NULL, '1-877-571-7078', NULL, '46408 Purdy Divide Apt. 293\nLake Jarvis, LA 98992-3189', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-07 10:00:00', '2020-07-11 02:56:15', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(108, 'Ms. Lucie Kling', 'Wunsch', NULL, 'westley.barton@example.org', NULL, '888.899.5074', NULL, '224 Deangelo Brooks Suite 594\nShanahanborough, RI 81959-2894', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-07 10:00:00', '2020-07-11 02:56:15', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(109, 'Dr. Joshua Mosciski PhD', 'Strosin', NULL, 'larry.ankunding@example.net', NULL, '855-415-3643', NULL, '2494 Cade Burg\nNew Domenicchester, WI 18724', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-07 10:00:00', '2020-07-11 02:56:16', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(110, 'Jaquelin Thiel', 'Wilderman', NULL, 'vritchie@example.org', NULL, '1-800-255-1086', NULL, '29018 Virginie Mall\nFriesenburgh, CO 92584-3608', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-07 10:00:00', '2020-07-11 02:56:16', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(111, 'Liliane Stanton', 'Kutch', NULL, 'cdooley@example.net', NULL, '(866) 517-5944', NULL, '41089 Metz Route Apt. 358\nPort Hadleyville, NE 05906', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-07 10:00:00', '2020-07-11 02:56:16', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(112, 'Taylor Morar', 'Schuster', NULL, 'emmanuel.rath@example.net', NULL, '844.671.0123', NULL, '92116 Maggio Station\nLake Merleborough, NE 23756', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-08 10:00:00', '2020-07-11 02:56:16', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(113, 'Wanda Kunde', 'Gibson', NULL, 'steuber.schuyler@example.org', NULL, '800-386-0689', NULL, '764 Grant Ports Suite 278\nWest Alyshaport, GA 70617-8063', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-08 10:00:00', '2020-07-11 02:56:16', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(114, 'Dallas Sawayn', 'Cormier', NULL, 'kirstin.shields@example.com', NULL, '855-921-3366', NULL, '9295 Lavina Mews Apt. 640\nJadefurt, GA 56291', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-09 10:00:00', '2020-07-11 02:56:16', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(115, 'Prof. Stephany Robel', 'Gottlieb', NULL, 'huel.bettie@example.org', NULL, '866-377-9321', NULL, '54255 Breitenberg Lake\nNew Jon, MN 71968', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-09 10:00:00', '2020-07-11 02:56:16', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(116, 'Mr. Guillermo Bernier IV', 'Ernser', NULL, 'mgoldner@example.com', NULL, '1-877-665-3991', NULL, '133 Smith Mill\nElenorport, AK 41680', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-09 10:00:00', '2020-07-11 02:56:17', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(117, 'Ms. Maggie Greenfelder', 'Shanahan', NULL, 'jett.watsica@example.net', NULL, '844-455-6741', NULL, '10232 Konopelski Burgs\nNorth Lauryn, PA 26495-4010', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-09 10:00:00', '2020-07-11 02:56:17', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(118, 'Elena O\'Kon', 'Boyer', NULL, 'mayert.vanessa@example.com', NULL, '877-317-5013', NULL, '636 Mortimer Hill\nNorth Elisabethland, NC 16359-5799', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-09 10:00:00', '2020-07-11 02:56:17', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(119, 'Eldon Waelchi', 'Thompson', NULL, 'ldubuque@example.com', NULL, '844-300-3526', NULL, '7890 Considine Corner\nAlexandriatown, NM 09600', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-09 10:00:00', '2020-07-11 02:56:17', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(120, 'Rae Ward', 'Green', NULL, 'leopoldo26@example.org', NULL, '(844) 996-6020', NULL, '85061 Erdman Spur\nEast Maximo, WV 42144-7151', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-09 10:00:00', '2020-07-11 02:56:17', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(121, 'Monroe Effertz PhD', 'Corwin', NULL, 'oreilly.karley@example.com', NULL, '800.601.6816', NULL, '9668 Ledner Isle\nEast Anjalifort, OR 87672-1009', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-09 10:00:00', '2020-07-11 02:56:17', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(122, 'Jeanie Wisoky', 'Hamill', NULL, 'nathan73@example.net', NULL, '888-821-2969', NULL, '50181 Jude Spring Apt. 404\nWest Jarrod, VA 37325', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-09 10:00:00', '2020-07-11 02:56:17', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(123, 'Leanna Orn', 'Towne', NULL, 'lswift@example.net', NULL, '(855) 793-8640', NULL, '64029 O\'Reilly Path\nLake Braulio, AL 19582-3703', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-09 10:00:00', '2020-07-11 02:56:17', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(124, 'Robyn Kshlerin', 'Hoeger', NULL, 'rowe.newell@example.org', NULL, '(855) 880-9256', NULL, '3372 Swift Shore\nZiemannshire, RI 42165-6852', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-09 10:00:00', '2020-07-11 02:56:17', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(125, 'Devin Hoeger', 'Cremin', NULL, 'aprosacco@example.com', NULL, '(877) 466-2853', NULL, '5766 Monica Springs\nLuzmouth, WI 87203-1741', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-09 10:00:00', '2020-07-11 02:56:17', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(126, 'Yasmeen Johns', 'Boyle', NULL, 'cartwright.magali@example.net', NULL, '844-308-3259', NULL, '93502 Joel Way Apt. 776\nWest Demondhaven, RI 77918', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-09 10:00:00', '2020-07-11 02:56:17', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(127, 'Kattie Wuckert I', 'Wunsch', NULL, 'mills.julio@example.org', NULL, '(800) 358-7106', NULL, '93087 Schinner Spurs Suite 364\nPort Glendaburgh, IN 85706-1011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-09 10:00:00', '2020-07-11 02:56:17', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(128, 'Mr. Freeman Heaney III', 'Collier', NULL, 'hilpert.ryan@example.org', NULL, '(888) 765-1765', NULL, '647 Oberbrunner Port\nEast Estevan, RI 24674-9588', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-09 10:00:00', '2020-07-11 02:56:17', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(129, 'Jovan Becker', 'Heidenreich', NULL, 'crawford99@example.net', NULL, '(855) 482-5008', NULL, '633 Leffler Mountain Apt. 827\nNew Lyric, MD 24883', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-09 10:00:00', '2020-07-11 02:56:17', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(130, 'Mr. Ludwig D\'Amore', 'Schultz', NULL, 'uhayes@example.net', NULL, '877.939.8950', NULL, '60928 Stoltenberg Lane\nLake Wilford, MS 18535-0449', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-09 10:00:00', '2020-07-11 02:56:17', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(131, 'Lazaro Hills', 'Mosciski', NULL, 'zachariah76@example.org', NULL, '855.386.0436', NULL, '49618 Lucio Plaza Apt. 463\nNorth Aminaview, TX 35305', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-09 10:00:00', '2020-07-11 02:56:17', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(132, 'Favian Schroeder', 'Tremblay', NULL, 'zbaumbach@example.org', NULL, '800-336-6846', NULL, '117 Rosalyn Well\nSierrabury, IN 52957-7684', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-09 10:00:00', '2020-07-11 02:56:17', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(133, 'Cade Ward', 'Emmerich', NULL, 'kyle78@example.org', NULL, '866-617-1555', NULL, '298 Breana Parkways\nJedediahmouth, DC 05512', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-09 10:00:00', '2020-07-11 02:56:17', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(134, 'Quinten Carter I', 'Schmeler', NULL, 'batz.larue@example.org', NULL, '800-258-4069', NULL, '337 Kaley Green\nHillhaven, MO 71288', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-10 10:00:00', '2020-07-11 02:56:18', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(135, 'Michelle Williamson', 'Abshire', NULL, 'evert.schoen@example.org', NULL, '855.548.1600', NULL, '522 Rippin Stream Apt. 208\nJairoport, SC 52887-8616', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-10 10:00:00', '2020-07-11 02:56:18', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(136, 'Ms. Rafaela Mraz Jr.', 'O\'Reilly', NULL, 'xwilkinson@example.org', NULL, '1-888-735-1742', NULL, '7291 Leannon Shores Suite 281\nNorth Francis, OH 84750', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-10 10:00:00', '2020-07-11 02:56:18', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(137, 'Nicklaus Champlin', 'Blick', NULL, 'sgleason@example.com', NULL, '1-888-962-9704', NULL, '79183 Rosenbaum Fall\nNorth Karine, NM 73962-5972', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-10 10:00:00', '2020-07-11 02:56:18', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(138, 'Rhea Bashirian Jr.', 'Lindgren', NULL, 'ryan.lindsay@example.org', NULL, '800-917-0309', NULL, '413 Taryn Junctions Suite 137\nNew Ninaton, LA 61664', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-10 10:00:00', '2020-07-11 02:56:18', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(139, 'Ofelia Gerhold', 'Johnston', NULL, 'johnston.clay@example.org', NULL, '800.325.4069', NULL, '888 Hanna Mountain Apt. 727\nNorth Vivian, AL 86694', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-10 10:00:00', '2020-07-11 02:56:18', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(140, 'Miss Katelin Schmeler Jr.', 'Ortiz', NULL, 'valentine81@example.org', NULL, '1-866-570-9515', NULL, '19212 Pfannerstill Villages Apt. 659\nErdmanbury, PA 89829-6163', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-10 10:00:00', '2020-07-11 02:56:18', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(141, 'Prof. Mckenna Gulgowski', 'Lubowitz', NULL, 'gwen.fahey@example.net', NULL, '(800) 435-1581', NULL, '513 Toy Spur\nLevihaven, SC 49863', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-10 10:00:00', '2020-07-11 02:56:18', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(142, 'Zion Schinner', 'Reilly', NULL, 'uheathcote@example.net', NULL, '866.455.2746', NULL, '9924 Dominique Mill\nCydneyport, CO 72180', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-10 10:00:00', '2020-07-11 02:56:18', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(143, 'Odell Gottlieb I', 'Terry', NULL, 'nona26@example.org', NULL, '800.486.7373', NULL, '812 Meda Ramp Suite 682\nEast Demetris, ND 43246', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-10 10:00:00', '2020-07-11 02:56:18', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(144, 'Prof. Sallie Emard', 'Erdman', NULL, 'orn.alexane@example.com', NULL, '1-888-624-4923', NULL, '40163 Friesen Road\nWest Nikkifort, MO 56251-5104', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-10 10:00:00', '2020-07-11 02:56:18', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(145, 'Ms. Tressie Kihn', 'Hodkiewicz', NULL, 'flockman@example.com', NULL, '1-800-552-3957', NULL, '272 Bernhard Walks Suite 837\nWisokybury, CA 48676', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-10 10:00:00', '2020-07-11 02:56:18', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(146, 'Bartholome Ortiz', 'Fadel', NULL, 'maegan18@example.org', NULL, '888.610.7708', NULL, '3975 Marjorie Crest Suite 931\nSouth Raymond, AR 86043', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-11 10:00:00', '2020-07-11 02:56:31', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(147, 'Yoshiko Beier', 'Donnelly', NULL, 'rosalinda23@example.com', NULL, '(844) 367-6227', NULL, '9846 Gusikowski Unions\nWest Clemens, TN 14355', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-11 10:00:00', '2020-07-11 02:56:31', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(148, 'Dr. Trevion Stamm Jr.', 'Luettgen', NULL, 'lang.chauncey@example.net', NULL, '1-888-289-1626', NULL, '2753 Fahey Ridge\nMarvinshire, WY 92900', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-11 10:00:00', '2020-07-11 02:56:31', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(149, 'Dr. Tremaine Rohan PhD', 'Lueilwitz', NULL, 'jake.cruickshank@example.com', NULL, '877.874.5912', NULL, '239 Lorna Courts\nLake Bridietown, AK 05539-7549', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-11 10:00:00', '2020-07-11 02:56:31', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(150, 'Beulah Goyette', 'Ferry', NULL, 'emmalee.abernathy@example.org', NULL, '1-855-246-4325', NULL, '202 Gennaro Roads\nZolamouth, SC 50737', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-11 10:00:00', '2020-07-11 02:56:31', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(151, 'Octavia Durgan', 'Lowe', NULL, 'virginie60@example.org', NULL, '(888) 758-9719', NULL, '15539 Pasquale Harbor\nNorth Brandiville, NC 86653', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-11 10:00:00', '2020-07-11 02:56:31', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(152, 'Gilda Kris', 'Senger', NULL, 'ayden.rodriguez@example.net', NULL, '1-855-687-0382', NULL, '78503 Luettgen Via Apt. 541\nNorth Emanuelview, NC 30210', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-11 10:00:00', '2020-07-11 02:56:31', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(153, 'Vernie West', 'McClure', NULL, 'wbalistreri@example.com', NULL, '(844) 778-8044', NULL, '121 Lockman Spurs Apt. 681\nReichelfort, KY 99859', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-11 10:00:00', '2020-07-11 02:56:31', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(154, 'Lisette Monahan', 'Lakin', NULL, 'brandyn43@example.net', NULL, '1-866-495-4125', NULL, '1821 Jerald Crest Suite 764\nDavismouth, NE 44163', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-11 10:00:00', '2020-07-11 02:56:31', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(155, 'Elna Paucek', 'Stroman', NULL, 'qgulgowski@example.com', NULL, '1-855-314-7801', NULL, '21469 Caesar Expressway\nSouth Darianchester, AZ 08221', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-11 10:00:00', '2020-07-11 02:56:31', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(156, 'Kaia Homenick', 'Spencer', NULL, 'iwilkinson@example.com', NULL, '1-800-334-9075', NULL, '546 Dickinson Stream Apt. 642\nJesusfurt, MO 75642-6213', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-11 10:00:00', '2020-07-11 02:56:31', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(157, 'Miss Alena McGlynn I', 'Yundt', NULL, 'zschulist@example.org', NULL, '888-200-8006', NULL, '36627 Kessler Parks\nPort Emie, OH 03781', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-11 10:00:00', '2020-07-11 02:56:32', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(158, 'Jose Jenkins', 'O\'Hara', NULL, 'ullrich.arlene@example.net', NULL, '855-542-1050', NULL, '5419 Monahan Summit\nSouth Lafayette, NH 15981', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-11 10:00:00', '2020-07-11 02:56:32', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(159, 'Marianna Lemke', 'Hand', NULL, 'kamren.nitzsche@example.com', NULL, '844-888-1788', NULL, '4506 Darien Camp Suite 203\nSchuylerchester, KS 19429', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-11 10:00:00', '2020-07-11 02:56:32', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(160, 'Nelle Champlin', 'Bernhard', NULL, 'retha.carter@example.com', NULL, '877.674.6123', NULL, '63075 Barbara Club\nJuvenalhaven, NE 30173-4967', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-11 10:00:00', '2020-07-11 02:56:32', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(161, 'Nola Hoppe', 'Jacobson', NULL, 'yhane@example.org', NULL, '(844) 305-0842', NULL, '432 Kamren Fall Suite 143\nWestview, NM 02432', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-12 10:00:00', '2020-07-11 02:56:55', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(162, 'Neva Tremblay', 'Nienow', NULL, 'hyatt.laila@example.net', NULL, '866-905-1629', NULL, '65764 Melba Station\nLake Lexiberg, AK 97863-4780', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-12 10:00:00', '2020-07-11 02:56:55', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(163, 'Brando Gorczany MD', 'Wolf', NULL, 'ynolan@example.net', NULL, '(888) 276-8528', NULL, '378 Judah Turnpike Apt. 931\nSouth Arnaldo, MO 68358-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-12 10:00:00', '2020-07-11 02:56:55', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(164, 'Leland Reichert', 'Cole', NULL, 'ellen29@example.com', NULL, '(888) 588-2960', NULL, '23109 Bins Inlet\nChristiansenstad, VT 98919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-12 10:00:00', '2020-07-11 02:56:55', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(165, 'Carmela Parker', 'Langosh', NULL, 'waino.kohler@example.com', NULL, '877-821-9099', NULL, '20518 Elisha Via Apt. 690\nCarrollshire, AK 27900', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-07-12 10:00:00', '2020-07-11 02:56:55', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(166, 'José', 'Suárez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-08-28 17:42:56', '2020-08-28 17:42:56', NULL, 'persona', NULL, 1, NULL, NULL, NULL, NULL),
(167, 'Arturo', 'Jiménez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-09-16 20:38:27', '2020-09-16 20:38:27', NULL, 'persona', NULL, 1, NULL, NULL, NULL, NULL),
(168, 'xxxx', 'xxxxxx', NULL, 'xxxx@xxxx.xxx', 'xxxxxxx.xx', '000000000', 'xxxxxx', NULL, NULL, NULL, 'xxx', NULL, NULL, NULL, NULL, 14, 0, NULL, 'xxxxx', '2020-09-30 11:06:12', '2020-10-19 20:58:42', 1, 'empresa', 2, 1, NULL, NULL, NULL, NULL);
INSERT INTO `contacts` (`id`, `name`, `last_name`, `image`, `email`, `web`, `phone`, `company`, `address`, `address_latitude`, `address_longitude`, `postal_code`, `sector`, `notes`, `share`, `country_id`, `user_id`, `favorite`, `stickers`, `cargo`, `created_at`, `updated_at`, `private`, `type_contact`, `contact_type_id`, `allow_change_image`, `image_updated_at`, `change_image_user_id`, `external_key`, `external_contact`) VALUES
(169, 'xxxxxx', 'xxxxx', NULL, NULL, NULL, NULL, NULL, 'Madrid, España', 40.4167754, -3.7037902, NULL, NULL, NULL, NULL, NULL, 14, 0, NULL, NULL, '2020-10-01 07:27:06', '2020-10-19 21:43:07', NULL, 'persona', NULL, 1, NULL, NULL, NULL, NULL),
(170, 'xxxxxxxx', 'xxxxxxx', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, 0, NULL, NULL, '2020-10-01 07:29:13', '2020-10-19 20:59:28', NULL, 'persona', NULL, 1, NULL, NULL, NULL, NULL),
(171, 'xxxxxx', 'xxxxxx', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, 0, NULL, NULL, '2020-10-01 13:20:37', '2020-10-19 20:59:43', NULL, 'persona', NULL, 1, NULL, NULL, NULL, NULL),
(172, 'xxxxxx', 'xxxxxxx', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, 0, NULL, NULL, '2020-10-01 13:26:10', '2020-10-19 20:59:54', NULL, 'persona', NULL, 1, NULL, NULL, NULL, NULL),
(173, 'Luisito', 'Martinez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, 0, NULL, NULL, '2020-10-01 13:27:49', '2020-10-01 13:27:49', NULL, 'persona', NULL, 1, NULL, NULL, NULL, NULL),
(174, 'Asier', 'Rodriguez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, 0, NULL, NULL, '2020-10-01 13:31:52', '2020-10-01 13:31:52', NULL, 'persona', NULL, 1, NULL, NULL, NULL, NULL),
(175, 'Alberto', 'Rodríguez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, NULL, NULL, '2020-10-01 16:03:41', '2020-10-01 16:03:41', NULL, 'persona', NULL, 1, NULL, NULL, NULL, NULL),
(176, 'XXXXX SSSSS XXXXXX', NULL, NULL, NULL, NULL, NULL, 'Empresa DAYRON.COM ARMAS BENITEZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, 0, NULL, NULL, '2020-10-02 11:43:59', '2020-10-15 23:43:27', NULL, 'empresa', NULL, 1, NULL, NULL, NULL, NULL),
(177, 'NuevoContacto', '107', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, 0, NULL, NULL, '2020-10-05 09:35:59', '2020-10-05 09:35:59', NULL, 'persona', NULL, 1, NULL, NULL, NULL, NULL),
(178, 'NuevoContacto', '108', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, 0, NULL, NULL, '2020-10-05 09:37:20', '2020-10-06 09:59:55', NULL, 'persona', 5, 1, NULL, NULL, NULL, NULL),
(179, 'Nuevo Contacto', '076', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, 0, NULL, NULL, '2020-10-05 16:44:40', '2020-10-05 16:44:40', NULL, 'persona', NULL, 1, NULL, NULL, NULL, NULL),
(180, 'NuevaEmpresa', '029', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, 0, NULL, NULL, '2020-10-05 16:45:19', '2020-10-05 16:45:19', NULL, 'empresa', NULL, 1, NULL, NULL, NULL, NULL),
(181, 'María', 'Ramirez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, 0, NULL, NULL, '2020-10-07 01:01:27', '2020-10-07 01:01:27', NULL, 'persona', NULL, 1, NULL, NULL, NULL, NULL),
(182, 'AUSBARG.ALE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, 0, NULL, NULL, '2020-10-07 01:50:55', '2020-10-07 01:50:55', NULL, 'empresa', NULL, 1, NULL, NULL, NULL, NULL),
(183, 'AUSBARG.AL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, 0, NULL, NULL, '2020-10-07 01:53:18', '2020-10-07 01:53:18', NULL, 'empresa', NULL, 1, NULL, NULL, NULL, NULL),
(184, 'AHDJE.C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, 0, NULL, NULL, '2020-10-07 01:54:44', '2020-10-07 01:54:44', NULL, 'empresa', NULL, 1, NULL, NULL, NULL, NULL),
(185, 'ARETE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, 0, NULL, NULL, '2020-10-07 01:55:59', '2020-10-07 01:55:59', NULL, 'empresa', NULL, 1, NULL, NULL, NULL, NULL),
(186, 'Empresa 051', 'SL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 187, 0, NULL, NULL, '2020-10-07 18:14:32', '2020-10-07 18:14:32', NULL, 'empresa', NULL, 1, NULL, NULL, NULL, NULL),
(187, 'Persona 009', 'PF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 187, 0, NULL, NULL, '2020-10-07 18:19:06', '2020-10-07 18:19:06', NULL, 'persona', NULL, 1, NULL, NULL, NULL, NULL),
(188, 'Empresa 078', 'SA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 187, 0, NULL, NULL, '2020-10-07 18:21:01', '2020-10-07 18:21:01', NULL, 'empresa', NULL, 1, NULL, NULL, NULL, NULL),
(189, 'Empresa 991', 'SL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 187, 0, NULL, NULL, '2020-10-07 18:22:13', '2020-10-07 18:22:13', NULL, 'empresa', NULL, 1, NULL, NULL, NULL, NULL),
(190, 'Empresa 086', 'SL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 187, 0, NULL, NULL, '2020-10-07 18:29:41', '2020-10-07 18:29:41', NULL, 'empresa', NULL, 1, NULL, NULL, NULL, NULL),
(191, 'XXXXX', 'XXXXXX', NULL, 'XXXX@gmail.com', 'XXXXXXXXX.COM', '000000000', 'XXXXX S.L.', 'XXXXXXXXXXX', 43.34468680000001, -8.428638, 'XXXXXXX', 'Alimentación', NULL, NULL, NULL, 18, 0, NULL, 'Encargado', '2020-10-08 10:28:40', '2020-10-15 23:45:16', 1, 'persona', 2, 1, NULL, NULL, NULL, NULL),
(192, 'XXXXXX', 'XXXXXX', NULL, 'XXXXXX@HOTMAIL.COM', NULL, '000000000', 'XXXXXX', 'XXXXXXXXXXXXXXXX', NULL, NULL, 'XXXXXXX', 'XXXXXX', NULL, NULL, NULL, 18, 0, NULL, 'XXXXXXX', '2020-10-08 10:30:11', '2020-10-15 23:46:31', 1, 'persona', 4, 1, NULL, NULL, NULL, NULL),
(193, 'XXXXXXXXX', NULL, NULL, 'XXXXXXX@XXXX.ES', 'XXXXXXXX', '000000000', 'XXXXXXXXXXXX', 'XXXXXXXXXXXXX', 43.353814, -8.411406, 'XXXXXX', 'XXXX', NULL, NULL, NULL, 18, 0, NULL, 'XXXXX', '2020-10-08 10:35:17', '2020-10-15 23:47:19', NULL, 'empresa', 3, 1, NULL, NULL, NULL, NULL),
(194, 'Carlos', 'Fernández', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '2020-10-14 06:59:49', '2020-10-14 06:59:49', NULL, 'persona', NULL, 1, NULL, NULL, NULL, NULL),
(195, 'Telefónica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '2020-10-14 07:00:04', '2020-10-14 07:00:04', NULL, 'empresa', NULL, 1, NULL, NULL, NULL, NULL),
(196, 'Persona 201', 'Vincular 201', NULL, NULL, NULL, '666666201', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 187, 0, NULL, NULL, '2020-10-14 10:55:18', '2020-10-14 10:55:18', NULL, 'persona', NULL, 1, NULL, NULL, NULL, NULL),
(197, 'Contacto 001', 'Vincular 001', NULL, NULL, NULL, '+34666666001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 0, NULL, NULL, '2020-10-15 01:57:46', '2020-10-15 01:57:46', NULL, NULL, NULL, 1, NULL, NULL, 'people/c6049527278499063441', 'gContact'),
(198, 'Contacto 002', 'Vincular 002', NULL, NULL, NULL, '+34666666002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 0, NULL, NULL, '2020-10-15 01:57:46', '2020-10-15 01:57:46', NULL, NULL, NULL, 1, NULL, NULL, 'people/c6061925687224605849', 'gContact'),
(199, 'Contacto 003', 'Vincular 003', NULL, NULL, NULL, '+34666666003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 0, NULL, NULL, '2020-10-15 01:57:46', '2020-10-15 01:57:46', NULL, NULL, NULL, 1, NULL, NULL, 'people/c3625695664027925', 'gContact'),
(200, 'Contacto 004', 'Vincular 004', NULL, NULL, NULL, '+34666666004', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 0, NULL, NULL, '2020-10-15 01:57:46', '2020-10-15 01:57:46', NULL, NULL, NULL, 1, NULL, NULL, 'people/c9105201597510498807', 'gContact'),
(201, 'Contacto 005', 'Vincular 005', NULL, NULL, NULL, '+34666666005', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 0, NULL, NULL, '2020-10-15 01:57:46', '2020-10-15 01:57:46', NULL, NULL, NULL, 1, NULL, NULL, 'people/c5372336668854615231', 'gContact'),
(202, 'Contacto 001', 'Vincular 001', NULL, NULL, NULL, '+34666666001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 187, 0, NULL, NULL, '2020-10-15 07:37:38', '2020-10-15 07:37:38', NULL, NULL, NULL, 1, NULL, NULL, 'people/c6049527278499063441', 'gContact'),
(203, 'Contacto 002', 'Vincular 002', NULL, NULL, NULL, '+34666666002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 187, 0, NULL, NULL, '2020-10-15 07:37:38', '2020-10-15 07:37:38', NULL, NULL, NULL, 1, NULL, NULL, 'people/c6061925687224605849', 'gContact'),
(204, 'Contacto 003', 'Vincular 003', NULL, NULL, NULL, '+34666666003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 187, 0, NULL, NULL, '2020-10-15 07:37:38', '2020-10-15 07:37:38', NULL, NULL, NULL, 1, NULL, NULL, 'people/c3625695664027925', 'gContact'),
(205, 'Contacto 004', 'Vincular 004', NULL, NULL, NULL, '+34666666004', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 187, 0, NULL, NULL, '2020-10-15 07:37:38', '2020-10-15 07:37:38', NULL, NULL, NULL, 1, NULL, NULL, 'people/c9105201597510498807', 'gContact'),
(206, 'Contacto 005', 'Vincular 005', NULL, NULL, NULL, '+34666666005', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 187, 0, NULL, NULL, '2020-10-15 07:37:38', '2020-10-15 07:37:38', NULL, NULL, NULL, 1, NULL, NULL, 'people/c5372336668854615231', 'gContact'),
(207, 'Contacto 001', 'Vincular 001', NULL, NULL, NULL, '+34666666001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, 0, NULL, NULL, '2020-10-15 07:48:51', '2020-10-15 07:48:51', NULL, NULL, NULL, 1, NULL, NULL, 'people/c6049527278499063441', 'gContact'),
(208, 'Contacto 002', 'Vincular 002', NULL, NULL, NULL, '+34666666002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, 0, NULL, NULL, '2020-10-15 07:48:51', '2020-10-15 07:48:51', NULL, NULL, NULL, 1, NULL, NULL, 'people/c6061925687224605849', 'gContact'),
(209, 'Contacto 003', 'Vincular 003', NULL, NULL, NULL, '+34666666003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, 0, NULL, NULL, '2020-10-15 07:48:51', '2020-10-15 07:48:51', NULL, NULL, NULL, 1, NULL, NULL, 'people/c3625695664027925', 'gContact'),
(210, 'Contacto 004', 'Vincular 004', NULL, NULL, NULL, '+34666666004', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, 0, NULL, NULL, '2020-10-15 07:48:51', '2020-10-15 07:48:51', NULL, NULL, NULL, 1, NULL, NULL, 'people/c9105201597510498807', 'gContact'),
(211, 'Contacto 005', 'Vincular 005', NULL, NULL, NULL, '+34666666005', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, 0, NULL, NULL, '2020-10-15 07:48:51', '2020-10-15 07:48:51', NULL, NULL, NULL, 1, NULL, NULL, 'people/c5372336668854615231', 'gContact'),
(212, 'Esther', 'González', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, 0, NULL, NULL, '2020-10-15 16:41:15', '2020-10-15 16:41:15', NULL, 'persona', NULL, 1, NULL, NULL, NULL, NULL),
(213, 'Carlos', 'Martínez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16, 0, NULL, NULL, '2020-10-15 17:31:01', '2020-10-15 17:31:01', NULL, 'persona', NULL, 1, NULL, NULL, NULL, NULL),
(214, 'Contacto 006', 'Vincular 006', NULL, NULL, NULL, '+34666666006', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, 0, NULL, NULL, '2020-10-16 10:36:31', '2020-10-16 10:36:31', NULL, NULL, NULL, 1, NULL, NULL, 'people/c9097723507594694143', 'gContact'),
(215, 'Contacto009', NULL, NULL, NULL, NULL, '34666666009', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, 0, NULL, NULL, '2020-10-16 10:50:15', '2020-10-16 10:53:08', NULL, 'persona', NULL, 1, NULL, NULL, NULL, NULL),
(216, 'Contacto009', NULL, NULL, NULL, NULL, '+34666666009', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, 0, NULL, NULL, '2020-10-16 10:50:35', '2020-10-16 21:28:53', NULL, NULL, NULL, 1, NULL, NULL, 'people/c4790509621253753534', 'gContact'),
(217, 'PERFIL', 'PRUEBA', 'storage/files/5f88261d96ca18.33777123.png', 'vendedor3@ventonic.com', NULL, '+34XXXXXXXXX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, 0, NULL, NULL, '2020-10-16 20:45:46', '2020-10-16 20:45:46', NULL, 'persona', NULL, 1, NULL, NULL, NULL, NULL),
(218, 'Contacto 001', 'Vincular 001', NULL, NULL, NULL, '+34666666001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, 0, NULL, NULL, '2020-10-18 18:24:10', '2020-10-18 18:24:10', NULL, NULL, NULL, 1, NULL, NULL, 'people/c6049527278499063441', 'gContact'),
(219, 'Contacto 002', 'Vincular 002', NULL, NULL, NULL, '+34666666002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, 0, NULL, NULL, '2020-10-18 18:24:10', '2020-10-18 18:24:10', NULL, NULL, NULL, 1, NULL, NULL, 'people/c6061925687224605849', 'gContact'),
(220, 'Contacto 003', 'Vincular 003', NULL, NULL, NULL, '+34666666003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, 0, NULL, NULL, '2020-10-18 18:24:10', '2020-10-18 18:24:10', NULL, NULL, NULL, 1, NULL, NULL, 'people/c3625695664027925', 'gContact'),
(221, 'Contacto 004', 'Vincular 004', NULL, NULL, NULL, '+34666666004', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, 0, NULL, NULL, '2020-10-18 18:24:10', '2020-10-18 18:24:10', NULL, NULL, NULL, 1, NULL, NULL, 'people/c9105201597510498807', 'gContact'),
(222, 'Contacto 005', 'Vincular 005', NULL, NULL, NULL, '+34666666005', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, 0, NULL, NULL, '2020-10-18 18:24:10', '2020-10-18 18:24:10', NULL, NULL, NULL, 1, NULL, NULL, 'people/c5372336668854615231', 'gContact'),
(223, 'Contacto 006', 'Vincular 006', NULL, NULL, NULL, '+34666666006', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, 0, NULL, NULL, '2020-10-18 18:24:10', '2020-10-18 18:24:10', NULL, NULL, NULL, 1, NULL, NULL, 'people/c9097723507594694143', 'gContact'),
(224, 'Contacto009', NULL, NULL, NULL, NULL, '+34666666009', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, 0, NULL, NULL, '2020-10-18 18:24:10', '2020-10-18 18:24:10', NULL, NULL, NULL, 1, NULL, NULL, 'people/c4790509621253753534', 'gContact'),
(225, 'ContactoApp 101', 'CreadoEnVen 101', NULL, NULL, NULL, '666666101', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, 0, NULL, NULL, '2020-10-18 18:26:36', '2020-10-18 18:26:36', NULL, 'persona', NULL, 1, NULL, NULL, NULL, NULL),
(226, 'ContactoApp 101', 'CreadoEnVen 101', NULL, NULL, NULL, '+34666666101', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, 0, NULL, NULL, '2020-10-18 18:26:38', '2020-10-18 18:26:38', NULL, NULL, NULL, 1, NULL, NULL, 'people/c3070460540912676226', 'gContact'),
(227, 'ContactoApp 101', 'CreadoEnVen 101', NULL, NULL, NULL, '+34666666101', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, 0, NULL, NULL, '2020-10-18 18:33:04', '2020-10-18 18:37:07', NULL, NULL, NULL, 1, NULL, NULL, 'people/c988630976327519773', 'gContact'),
(228, 'ContactoApp 101', 'CreadoEnVen 101', NULL, NULL, NULL, '+34666666101', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, 0, NULL, NULL, '2020-10-18 18:45:16', '2020-10-18 18:45:16', NULL, NULL, NULL, 1, NULL, NULL, 'people/c988630976327519773', 'gContact'),
(229, 'Contacto 010', 'Vincular 010', NULL, 'micorreo010@mail.com', NULL, '+34666666010', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, 0, NULL, NULL, '2020-10-18 18:49:58', '2020-10-18 18:49:58', NULL, NULL, NULL, 1, NULL, NULL, 'people/c9015406119277930055', 'gContact'),
(230, 'ContactoApp  102', 'CradoEnVen 102', NULL, 'miemail102@mail.es', NULL, '666666102', NULL, 'Avenida de América, Madrid, España', 40.4486229, -3.6356614, NULL, NULL, NULL, NULL, NULL, 15, 0, NULL, NULL, '2020-10-18 19:08:25', '2020-10-18 19:14:36', NULL, 'empresa', NULL, 1, NULL, NULL, NULL, NULL),
(231, 'ContactoApp  102', 'CradoEnVen 102', NULL, 'miemail102@mail.es', NULL, '+34666666102', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, 0, NULL, NULL, '2020-10-18 19:08:26', '2020-10-18 19:08:26', NULL, NULL, NULL, 1, NULL, NULL, 'people/c607345153669860146', 'gContact'),
(232, 'Empresa', 'Cuatro', NULL, 'empresa4@ventonic.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, 0, NULL, NULL, '2020-10-19 14:59:37', '2020-10-19 14:59:37', NULL, 'empresa', NULL, 1, NULL, NULL, NULL, NULL),
(233, 'Contacto 010', 'Vincular 010', NULL, 'micorreo010@mail.com', NULL, '+34666666010', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, 0, NULL, NULL, '2020-10-19 15:00:00', '2020-10-19 15:00:00', NULL, NULL, NULL, 1, NULL, NULL, 'people/c9015406119277930055', 'gContact'),
(234, 'ContactoApp  102', 'CradoEnVen 102', NULL, 'miemail102@mail.es', NULL, '+34666666102', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, 0, NULL, NULL, '2020-10-19 15:00:00', '2020-10-19 15:00:00', NULL, NULL, NULL, 1, NULL, NULL, 'people/c607345153669860146', 'gContact');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contact_group`
--

CREATE TABLE `contact_group` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contact_group_user`
--

CREATE TABLE `contact_group_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_id` bigint(20) UNSIGNED NOT NULL,
  `group_user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contact_types`
--

CREATE TABLE `contact_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nombre del tipo de contacto',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contact_types`
--

INSERT INTO `contact_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Cliente', '2020-08-13 00:25:10', '2020-08-13 00:25:10'),
(2, 'Cliente potencial', '2020-08-13 00:25:10', '2020-08-13 00:25:10'),
(3, 'Colaborador', '2020-08-13 00:25:10', '2020-08-13 00:25:10'),
(4, 'Proveedor', '2020-08-13 00:25:10', '2020-08-13 00:25:10'),
(5, 'Cliente Perdido', '2020-08-31 00:00:00', '2020-08-31 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso_code_cca2` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso_code_cca3` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `countries`
--

INSERT INTO `countries` (`id`, `name`, `iso_code_cca2`, `iso_code_cca3`, `created_at`, `updated_at`) VALUES
(1, 'Bangladesh', 'BD', 'BGD', '2020-06-01 22:58:31', '2020-06-01 22:58:31'),
(2, 'Belgium', 'BE', 'BEL', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(3, 'Burkina Faso', 'BF', 'BFA', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(4, 'Bulgaria', 'BG', 'BGR', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(5, 'Bosnia and Herzegovina', 'BA', 'BIH', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(6, 'Barbados', 'BB', 'BRB', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(7, 'Wallis and Futuna', 'WF', 'WLF', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(8, 'Saint Barthelemy', 'BL', 'BLM', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(9, 'Bermuda', 'BM', 'BMU', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(10, 'Brunei', 'BN', 'BRN', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(11, 'Bolivia', 'BO', 'BOL', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(12, 'Bahrain', 'BH', 'BHR', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(13, 'Burundi', 'BI', 'BDI', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(14, 'Benin', 'BJ', 'BEN', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(15, 'Bhutan', 'BT', 'BTN', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(16, 'Jamaica', 'JM', 'JAM', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(17, 'Bouvet Island', 'BV', 'BVT', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(18, 'Botswana', 'BW', 'BWA', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(19, 'Samoa', 'WS', 'WSM', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(20, 'Bonaire, Saint Eustatius and Saba ', 'BQ', 'BES', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(21, 'Brazil', 'BR', 'BRA', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(22, 'Bahamas', 'BS', 'BHS', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(23, 'Jersey', 'JE', 'JEY', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(24, 'Belarus', 'BY', 'BLR', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(25, 'Belize', 'BZ', 'BLZ', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(26, 'Russia', 'RU', 'RUS', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(27, 'Rwanda', 'RW', 'RWA', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(28, 'Serbia', 'RS', 'SRB', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(29, 'East Timor', 'TL', 'TLS', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(30, 'Reunion', 'RE', 'REU', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(31, 'Turkmenistan', 'TM', 'TKM', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(32, 'Tajikistan', 'TJ', 'TJK', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(33, 'Romania', 'RO', 'ROU', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(34, 'Tokelau', 'TK', 'TKL', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(35, 'Guinea-Bissau', 'GW', 'GNB', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(36, 'Guam', 'GU', 'GUM', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(37, 'Guatemala', 'GT', 'GTM', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(38, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(39, 'Greece', 'GR', 'GRC', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(40, 'Equatorial Guinea', 'GQ', 'GNQ', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(41, 'Guadeloupe', 'GP', 'GLP', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(42, 'Japan', 'JP', 'JPN', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(43, 'Guyana', 'GY', 'GUY', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(44, 'Guernsey', 'GG', 'GGY', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(45, 'French Guiana', 'GF', 'GUF', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(46, 'Georgia', 'GE', 'GEO', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(47, 'Grenada', 'GD', 'GRD', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(48, 'United Kingdom', 'GB', 'GBR', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(49, 'Gabon', 'GA', 'GAB', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(50, 'El Salvador', 'SV', 'SLV', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(51, 'Guinea', 'GN', 'GIN', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(52, 'Gambia', 'GM', 'GMB', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(53, 'Greenland', 'GL', 'GRL', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(54, 'Gibraltar', 'GI', 'GIB', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(55, 'Ghana', 'GH', 'GHA', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(56, 'Oman', 'OM', 'OMN', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(57, 'Tunisia', 'TN', 'TUN', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(58, 'Jordan', 'JO', 'JOR', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(59, 'Croatia', 'HR', 'HRV', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(60, 'Haiti', 'HT', 'HTI', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(61, 'Hungary', 'HU', 'HUN', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(62, 'Hong Kong', 'HK', 'HKG', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(63, 'Honduras', 'HN', 'HND', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(64, 'Heard Island and McDonald Islands', 'HM', 'HMD', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(65, 'Venezuela', 'VE', 'VEN', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(66, 'Puerto Rico', 'PR', 'PRI', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(67, 'Palestinian Territory', 'PS', 'PSE', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(68, 'Palau', 'PW', 'PLW', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(69, 'Portugal', 'PT', 'PRT', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(70, 'Svalbard and Jan Mayen', 'SJ', 'SJM', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(71, 'Paraguay', 'PY', 'PRY', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(72, 'Iraq', 'IQ', 'IRQ', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(73, 'Panama', 'PA', 'PAN', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(74, 'French Polynesia', 'PF', 'PYF', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(75, 'Papua New Guinea', 'PG', 'PNG', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(76, 'Peru', 'PE', 'PER', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(77, 'Pakistan', 'PK', 'PAK', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(78, 'Philippines', 'PH', 'PHL', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(79, 'Pitcairn', 'PN', 'PCN', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(80, 'Poland', 'PL', 'POL', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(81, 'Saint Pierre and Miquelon', 'PM', 'SPM', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(82, 'Zambia', 'ZM', 'ZMB', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(83, 'Western Sahara', 'EH', 'ESH', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(84, 'Estonia', 'EE', 'EST', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(85, 'Egypt', 'EG', 'EGY', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(86, 'South Africa', 'ZA', 'ZAF', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(87, 'Ecuador', 'EC', 'ECU', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(88, 'Italy', 'IT', 'ITA', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(89, 'Vietnam', 'VN', 'VNM', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(90, 'Solomon Islands', 'SB', 'SLB', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(91, 'Ethiopia', 'ET', 'ETH', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(92, 'Somalia', 'SO', 'SOM', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(93, 'Zimbabwe', 'ZW', 'ZWE', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(94, 'Saudi Arabia', 'SA', 'SAU', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(95, 'Spain', 'ES', 'ESP', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(96, 'Eritrea', 'ER', 'ERI', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(97, 'Montenegro', 'ME', 'MNE', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(98, 'Moldova', 'MD', 'MDA', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(99, 'Madagascar', 'MG', 'MDG', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(100, 'Saint Martin', 'MF', 'MAF', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(101, 'Morocco', 'MA', 'MAR', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(102, 'Monaco', 'MC', 'MCO', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(103, 'Uzbekistan', 'UZ', 'UZB', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(104, 'Myanmar', 'MM', 'MMR', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(105, 'Mali', 'ML', 'MLI', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(106, 'Macao', 'MO', 'MAC', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(107, 'Mongolia', 'MN', 'MNG', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(108, 'Marshall Islands', 'MH', 'MHL', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(109, 'Macedonia', 'MK', 'MKD', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(110, 'Mauritius', 'MU', 'MUS', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(111, 'Malta', 'MT', 'MLT', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(112, 'Malawi', 'MW', 'MWI', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(113, 'Maldives', 'MV', 'MDV', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(114, 'Martinique', 'MQ', 'MTQ', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(115, 'Northern Mariana Islands', 'MP', 'MNP', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(116, 'Montserrat', 'MS', 'MSR', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(117, 'Mauritania', 'MR', 'MRT', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(118, 'Isle of Man', 'IM', 'IMN', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(119, 'Uganda', 'UG', 'UGA', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(120, 'Tanzania', 'TZ', 'TZA', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(121, 'Malaysia', 'MY', 'MYS', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(122, 'Mexico', 'MX', 'MEX', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(123, 'Israel', 'IL', 'ISR', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(124, 'France', 'FR', 'FRA', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(125, 'British Indian Ocean Territory', 'IO', 'IOT', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(126, 'Saint Helena', 'SH', 'SHN', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(127, 'Finland', 'FI', 'FIN', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(128, 'Fiji', 'FJ', 'FJI', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(129, 'Falkland Islands', 'FK', 'FLK', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(130, 'Micronesia', 'FM', 'FSM', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(131, 'Faroe Islands', 'FO', 'FRO', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(132, 'Nicaragua', 'NI', 'NIC', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(133, 'Netherlands', 'NL', 'NLD', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(134, 'Norway', 'NO', 'NOR', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(135, 'Namibia', 'NA', 'NAM', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(136, 'Vanuatu', 'VU', 'VUT', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(137, 'New Caledonia', 'NC', 'NCL', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(138, 'Niger', 'NE', 'NER', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(139, 'Norfolk Island', 'NF', 'NFK', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(140, 'Nigeria', 'NG', 'NGA', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(141, 'New Zealand', 'NZ', 'NZL', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(142, 'Nepal', 'NP', 'NPL', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(143, 'Nauru', 'NR', 'NRU', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(144, 'Niue', 'NU', 'NIU', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(145, 'Cook Islands', 'CK', 'COK', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(146, 'Kosovo', 'XK', 'XKX', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(147, 'Ivory Coast', 'CI', 'CIV', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(148, 'Switzerland', 'CH', 'CHE', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(149, 'Colombia', 'CO', 'COL', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(150, 'China', 'CN', 'CHN', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(151, 'Cameroon', 'CM', 'CMR', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(152, 'Chile', 'CL', 'CHL', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(153, 'Cocos Islands', 'CC', 'CCK', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(154, 'Canada', 'CA', 'CAN', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(155, 'Republic of the Congo', 'CG', 'COG', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(156, 'Central African Republic', 'CF', 'CAF', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(157, 'Democratic Republic of the Congo', 'CD', 'COD', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(158, 'Czech Republic', 'CZ', 'CZE', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(159, 'Cyprus', 'CY', 'CYP', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(160, 'Christmas Island', 'CX', 'CXR', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(161, 'Costa Rica', 'CR', 'CRI', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(162, 'Curacao', 'CW', 'CUW', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(163, 'Cape Verde', 'CV', 'CPV', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(164, 'Cuba', 'CU', 'CUB', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(165, 'Swaziland', 'SZ', 'SWZ', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(166, 'Syria', 'SY', 'SYR', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(167, 'Sint Maarten', 'SX', 'SXM', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(168, 'Kyrgyzstan', 'KG', 'KGZ', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(169, 'Kenya', 'KE', 'KEN', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(170, 'South Sudan', 'SS', 'SSD', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(171, 'Suriname', 'SR', 'SUR', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(172, 'Kiribati', 'KI', 'KIR', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(173, 'Cambodia', 'KH', 'KHM', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(174, 'Saint Kitts and Nevis', 'KN', 'KNA', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(175, 'Comoros', 'KM', 'COM', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(176, 'Sao Tome and Principe', 'ST', 'STP', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(177, 'Slovakia', 'SK', 'SVK', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(178, 'South Korea', 'KR', 'KOR', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(179, 'Slovenia', 'SI', 'SVN', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(180, 'North Korea', 'KP', 'PRK', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(181, 'Kuwait', 'KW', 'KWT', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(182, 'Senegal', 'SN', 'SEN', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(183, 'San Marino', 'SM', 'SMR', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(184, 'Sierra Leone', 'SL', 'SLE', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(185, 'Seychelles', 'SC', 'SYC', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(186, 'Kazakhstan', 'KZ', 'KAZ', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(187, 'Cayman Islands', 'KY', 'CYM', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(188, 'Singapore', 'SG', 'SGP', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(189, 'Sweden', 'SE', 'SWE', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(190, 'Sudan', 'SD', 'SDN', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(191, 'Dominican Republic', 'DO', 'DOM', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(192, 'Dominica', 'DM', 'DMA', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(193, 'Djibouti', 'DJ', 'DJI', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(194, 'Denmark', 'DK', 'DNK', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(195, 'British Virgin Islands', 'VG', 'VGB', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(196, 'Germany', 'DE', 'DEU', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(197, 'Yemen', 'YE', 'YEM', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(198, 'Algeria', 'DZ', 'DZA', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(199, 'United States', 'US', 'USA', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(200, 'Uruguay', 'UY', 'URY', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(201, 'Mayotte', 'YT', 'MYT', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(202, 'United States Minor Outlying Islands', 'UM', 'UMI', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(203, 'Lebanon', 'LB', 'LBN', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(204, 'Saint Lucia', 'LC', 'LCA', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(205, 'Laos', 'LA', 'LAO', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(206, 'Tuvalu', 'TV', 'TUV', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(207, 'Taiwan', 'TW', 'TWN', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(208, 'Trinidad and Tobago', 'TT', 'TTO', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(209, 'Turkey', 'TR', 'TUR', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(210, 'Sri Lanka', 'LK', 'LKA', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(211, 'Liechtenstein', 'LI', 'LIE', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(212, 'Latvia', 'LV', 'LVA', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(213, 'Tonga', 'TO', 'TON', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(214, 'Lithuania', 'LT', 'LTU', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(215, 'Luxembourg', 'LU', 'LUX', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(216, 'Liberia', 'LR', 'LBR', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(217, 'Lesotho', 'LS', 'LSO', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(218, 'Thailand', 'TH', 'THA', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(219, 'French Southern Territories', 'TF', 'ATF', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(220, 'Togo', 'TG', 'TGO', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(221, 'Chad', 'TD', 'TCD', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(222, 'Turks and Caicos Islands', 'TC', 'TCA', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(223, 'Libya', 'LY', 'LBY', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(224, 'Vatican', 'VA', 'VAT', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(225, 'Saint Vincent and the Grenadines', 'VC', 'VCT', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(226, 'United Arab Emirates', 'AE', 'ARE', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(227, 'Andorra', 'AD', 'AND', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(228, 'Antigua and Barbuda', 'AG', 'ATG', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(229, 'Afghanistan', 'AF', 'AFG', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(230, 'Anguilla', 'AI', 'AIA', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(231, 'U.S. Virgin Islands', 'VI', 'VIR', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(232, 'Iceland', 'IS', 'ISL', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(233, 'Iran', 'IR', 'IRN', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(234, 'Armenia', 'AM', 'ARM', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(235, 'Albania', 'AL', 'ALB', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(236, 'Angola', 'AO', 'AGO', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(237, 'Antarctica', 'AQ', 'ATA', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(238, 'American Samoa', 'AS', 'ASM', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(239, 'Argentina', 'AR', 'ARG', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(240, 'Australia', 'AU', 'AUS', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(241, 'Austria', 'AT', 'AUT', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(242, 'Aruba', 'AW', 'ABW', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(243, 'India', 'IN', 'IND', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(244, 'Aland Islands', 'AX', 'ALA', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(245, 'Azerbaijan', 'AZ', 'AZE', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(246, 'Ireland', 'IE', 'IRL', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(247, 'Indonesia', 'ID', 'IDN', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(248, 'Ukraine', 'UA', 'UKR', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(249, 'Qatar', 'QA', 'QAT', '2020-06-01 22:58:32', '2020-06-01 22:58:32'),
(250, 'Mozambique', 'MZ', 'MOZ', '2020-06-01 22:58:32', '2020-06-01 22:58:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nombre del archivo',
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'URL del documento',
  `documentable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `documentable_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `documents`
--

INSERT INTO `documents` (`id`, `file`, `url`, `documentable_type`, `documentable_id`, `created_at`, `updated_at`, `note`, `user_id`) VALUES
(1, '/var/www/vhosts/ventonic.com/dev.ventonic.com/storage/app/documents/a.txt', 'storage/documents/a.txt', 'App\\Negotiation', 126, '2020-08-05 20:30:19', '2020-08-05 20:30:19', 'txt a', NULL),
(2, '/var/www/vhosts/ventonic.com/dev.ventonic.com/storage/app/documents/a.txt', 'storage/documents/a.txt', 'App\\Contact', 33, '2020-08-06 09:28:44', '2020-08-06 09:28:44', 'Documento de texto a. Primer doc del contacto.', NULL),
(3, '/var/www/vhosts/ventonic.com/dev.ventonic.com/storage/app/documents/a.txt', 'storage/documents/a.txt', 'App\\Contact', 33, '2020-08-06 09:28:44', '2020-08-06 09:28:44', 'Documento de texto a. Primer doc del contacto.', NULL),
(4, '/var/www/vhosts/ventonic.com/dev.ventonic.com/storage/app/documents/aaaa.pdf', 'storage/documents/aaaa.pdf', 'App\\Contact', 33, '2020-08-06 09:28:44', '2020-08-06 09:28:44', 'Documento de texto a. Primer doc del contacto.', NULL),
(5, '/var/www/vhosts/ventonic.com/dev.ventonic.com/storage/app/documents/aaaa.docx', 'storage/documents/aaaa.docx', 'App\\Contact', 33, '2020-08-06 09:29:58', '2020-08-06 09:29:58', 'Segundos documentos', NULL),
(6, '/var/www/vhosts/ventonic.com/dev.ventonic.com/storage/app/documents/b.txt', 'storage/documents/b.txt', 'App\\Contact', 33, '2020-08-06 09:29:58', '2020-08-06 09:29:58', 'Segundos documentos', NULL),
(7, '/var/www/vhosts/ventonic.com/dev.ventonic.com/storage/app/documents/a.txt', 'storage/documents/a.txt', 'App\\Contact', 33, '2020-08-06 09:32:44', '2020-08-06 09:32:44', 'Nota de prueba', NULL),
(8, '/var/www/vhosts/ventonic.com/dev.ventonic.com/storage/app/documents/b.txt', 'storage/documents/b.txt', 'App\\Contact', 33, '2020-08-06 09:32:44', '2020-08-06 09:32:44', 'Nota de prueba', NULL),
(9, '/var/www/vhosts/ventonic.com/dev.ventonic.com/storage/app/documents/wallpaperflare.com_wallpaper.jpg', 'storage/documents/wallpaperflare.com_wallpaper.jpg', 'App\\Contact', 6, '2020-08-14 02:37:19', '2020-08-14 02:37:19', 'Wallpaper', 9),
(10, 'https://ventonic-dev.s3.eu-west-3.amazonaws.com/6d550466-7d2c-49b4-8688-d563e0524e08/Curr%C3%ADculum%20Enfermer%C3%ADa.pdf', 'https://ventonic-dev.s3.eu-west-3.amazonaws.com/6d550466-7d2c-49b4-8688-d563e0524e08/Curr%C3%ADculum%20Enfermer%C3%ADa.pdf', 'App\\Negotiation', 142, '2020-10-08 11:12:05', '2020-10-08 11:12:05', 'Curriculum', 14),
(11, 'https://ventonic-dev.s3.eu-west-3.amazonaws.com/da01276f-bdab-4635-98f4-2dba5e65c357/aaaaaa.txt', 'https://ventonic-dev.s3.eu-west-3.amazonaws.com/da01276f-bdab-4635-98f4-2dba5e65c357/aaaaaa.txt', 'App\\Negotiation', 132, '2020-10-08 12:17:22', '2020-10-08 12:17:22', 'Doc A', 15),
(12, 'https://ventonic-dev.s3.eu-west-3.amazonaws.com/bd34c317-c173-4b47-b1ed-1b770586390d/CitaTr%C3%A1fico.pdf', 'https://ventonic-dev.s3.eu-west-3.amazonaws.com/bd34c317-c173-4b47-b1ed-1b770586390d/CitaTr%C3%A1fico.pdf', 'App\\Contact', 176, '2020-10-12 11:12:46', '2020-10-12 11:12:46', 'Cita para reunión con funcionario', 18),
(13, 'https://ventonic-dev.s3.eu-west-3.amazonaws.com/bd34c317-c173-4b47-b1ed-1b770586390d/CitaTr%C3%A1fico.pdf', 'https://ventonic-dev.s3.eu-west-3.amazonaws.com/bd34c317-c173-4b47-b1ed-1b770586390d/CitaTr%C3%A1fico.pdf', 'App\\Negotiation', 148, '2020-10-12 17:51:00', '2020-10-12 17:51:00', 'Cita para iniciar trámite de permiso de conducir', 18),
(14, 'https://ventonic-dev.s3.eu-west-3.amazonaws.com/31031137-fbe0-4bc4-b9a0-5d28ed65291a/bbbbbbbbbb.txt', 'https://ventonic-dev.s3.eu-west-3.amazonaws.com/31031137-fbe0-4bc4-b9a0-5d28ed65291a/bbbbbbbbbb.txt', 'App\\Negotiation', 150, '2020-10-14 09:38:39', '2020-10-14 09:38:39', 'Nota para el documento', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emails`
--

CREATE TABLE `emails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `to_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `emailable_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emailable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `destination_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `emails`
--

INSERT INTO `emails` (`id`, `subject`, `message`, `from_user_id`, `to_user_id`, `created_at`, `updated_at`, `emailable_type`, `emailable_id`, `destination_email`) VALUES
(1, 'Hola Negociaciones 01', '<p>Mail Hola Negociaciones 01</p>', 15, 187, '2020-10-13 11:24:53', '2020-10-13 11:24:53', 'App\\Negotiation', 134, 'testtristest@gmail.com'),
(2, 'Hola Negociaciones 01', '<p>Mail Hola Negociaciones 01</p>', 15, 187, '2020-10-13 11:25:04', '2020-10-13 11:25:04', 'App\\Negotiation', 134, 'testtristest@gmail.com'),
(3, 'Hola Negociaciones 01', '<p>Mail Hola Negociaciones 01</p>', 15, 187, '2020-10-13 11:25:05', '2020-10-13 11:25:05', 'App\\Negotiation', 134, 'testtristest@gmail.com'),
(4, 'Hola Negociaciones 01', '<p>Mail Hola Negociaciones 01</p>', 15, 187, '2020-10-13 11:26:00', '2020-10-13 11:26:00', 'App\\Negotiation', 134, 'testtristest@gmail.com'),
(5, 'Hola Negociaciones 01', '<p>Mail Hola Negociaciones 01</p>', 15, 187, '2020-10-13 11:26:00', '2020-10-13 11:26:00', 'App\\Negotiation', 134, 'testtristest@gmail.com'),
(6, 'Hola Negociaciones 01', '<p>Mail Hola Negociaciones 01</p><p>&nbsp;</p><p>&nbsp;</p>', 15, 187, '2020-10-13 11:29:04', '2020-10-13 11:29:04', 'App\\Negotiation', 134, 'testtristest@gmail.com'),
(7, 'Hola Negociaciones 01', '<p>Mail Hola Negociaciones 01</p><p>&nbsp;</p><p>&nbsp;</p><p>Para poder enviar emails desde Ventonic tiene que vincular su cuenta Gmail. Abra la sección Email para iniciar el asistente de sincronización.</p><p>&nbsp;</p><p>&nbsp;</p>', 15, 187, '2020-10-13 11:29:41', '2020-10-13 11:29:41', 'App\\Negotiation', 134, 'testtristest@gmail.com'),
(8, 'Contactos Mail prueba 01', '<p>Contactos Mail prueba 01</p>', 15, 187, '2020-10-13 11:36:05', '2020-10-13 11:36:05', 'App\\Contact', 177, 'testtristest@gmail.com'),
(9, 'Contactos Mail prueba 01', '<p>Contactos Mail prueba 01</p>', 15, 187, '2020-10-13 11:36:06', '2020-10-13 11:36:06', 'App\\Contact', 177, 'testtristest@gmail.com'),
(10, 'Contactos Mail prueba 01', '<p>Contactos Mail prueba 01</p>', 15, 187, '2020-10-13 11:36:11', '2020-10-13 11:36:11', 'App\\Contact', 177, 'testtristest@gmail.com'),
(11, 'Contactos Mail prueba 01', '<p>Contactos Mail prueba 01</p>', 15, 187, '2020-10-13 11:36:21', '2020-10-13 11:36:21', 'App\\Contact', 177, 'testtristest@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `email_messages`
--

CREATE TABLE `email_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_nro` int(11) NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `references` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message_at` datetime NOT NULL COMMENT 'fecha del mensaje',
  `from` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'arreglo de objetos de quién(es) envía(n) el correo',
  `to` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'arreglo de objetos de quién(es) recibe(n) el correo',
  `cc` longtext COLLATE utf8mb4_unicode_ci COMMENT 'arreglo de objetos de quién(es) recibe(n) una copia del correo',
  `bcc` longtext COLLATE utf8mb4_unicode_ci COMMENT 'arreglo de objetos de quién(es) recibe(n) una copia oculta del correo',
  `reply_to` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'arreglo de objetos de direcciones de correo a los cuales responder',
  `sender` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Datos de la persona que envía el correo',
  `attachments` longtext COLLATE utf8mb4_unicode_ci COMMENT 'registra los archivos adjuntos al mensaje',
  `read` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'condición para determinar si el mensaje fue leído',
  `folder_type` enum('inbox','trash','sent','junk','drafts','spam','archive','starred') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'inbox = bandeja de entrada, trash = papelera, sent = enviado, junk = basura, drafts = borradores, spam = no deseado, archive = archivado, starred = correo marcado como favorito',
  `labels` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'etiquetas de correo separadas por coma. Valores a permitir: personal, company, important, private',
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'cuerpo del mensaje del correo electrónico',
  `body_text` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'cuerpo del mensaje del correo electrónico',
  `favorite` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'determina si un mensaje esta marcado como favorito',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha y hora en la que el registro fue eliminado',
  `email_setting_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `email_messages`
--

INSERT INTO `email_messages` (`id`, `message_id`, `message_nro`, `subject`, `references`, `message_at`, `from`, `to`, `cc`, `bcc`, `reply_to`, `sender`, `attachments`, `read`, `folder_type`, `labels`, `body`, `body_text`, `favorite`, `deleted_at`, `email_setting_id`, `created_at`, `updated_at`) VALUES
(8, '181dc22d2b71d017f6345f30847917e3@dev.ventonic.com', 3, 'Hola 012 adjuntos', NULL, '2020-10-13 09:51:42', '[{\"personal\":\"Empresa\",\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"mail\":\"testtristest@gmail.com\",\"full\":\"Empresa <testtristest@gmail.com>\"}]', '[{\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"personal\":false,\"mail\":\"testtristest@gmail.com\",\"full\":\"testtristest@gmail.com\"}]', NULL, NULL, '[{\"personal\":\"Empresa\",\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"mail\":\"testtristest@gmail.com\",\"full\":\"Empresa <testtristest@gmail.com>\"}]', '[{\"personal\":\"Empresa\",\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"mail\":\"testtristest@gmail.com\",\"full\":\"Empresa <testtristest@gmail.com>\"}]', '[{},{}]', 0, 'inbox', NULL, '<!DOCTYPE html>\r\n<html>\r\n    <head>\r\n        <title>Ventonic</title>\r\n    </head>\r\n    <body>\r\n        Hola 012 adjuntos\r\n    </body>\r\n</html>\r\n\r\n', '0', 0, NULL, 3, '2020-10-13 11:38:15', '2020-10-13 11:38:15'),
(9, 'd50a81f40a831b5dde3ee575f6830736@dev.ventonic.com', 2, 'Hola 012', NULL, '2020-10-13 09:45:03', '[{\"personal\":\"Empresa\",\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"mail\":\"testtristest@gmail.com\",\"full\":\"Empresa <testtristest@gmail.com>\"}]', '[{\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"personal\":false,\"mail\":\"testtristest@gmail.com\",\"full\":\"testtristest@gmail.com\"}]', NULL, NULL, '[{\"personal\":\"Empresa\",\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"mail\":\"testtristest@gmail.com\",\"full\":\"Empresa <testtristest@gmail.com>\"}]', '[{\"personal\":\"Empresa\",\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"mail\":\"testtristest@gmail.com\",\"full\":\"Empresa <testtristest@gmail.com>\"}]', '[]', 0, 'inbox', NULL, '<!DOCTYPE html>\r\n<html>\r\n    <head>\r\n        <title>Ventonic</title>\r\n    </head>\r\n    <body>\r\n        Hola 012\r\n    </body>\r\n</html>\r\n\r\n', '0', 0, NULL, 3, '2020-10-13 11:38:15', '2020-10-13 11:38:15'),
(10, '48a95f5806614f0fd05119106187f53a@dev.ventonic.com', 1, 'Hola 11', NULL, '2020-10-13 09:26:31', '[{\"personal\":\"Vendedor\",\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"mail\":\"testtristest@gmail.com\",\"full\":\"Vendedor <testtristest@gmail.com>\"}]', '[{\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"personal\":false,\"mail\":\"testtristest@gmail.com\",\"full\":\"testtristest@gmail.com\"}]', NULL, NULL, '[{\"personal\":\"Vendedor\",\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"mail\":\"testtristest@gmail.com\",\"full\":\"Vendedor <testtristest@gmail.com>\"}]', '[{\"personal\":\"Vendedor\",\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"mail\":\"testtristest@gmail.com\",\"full\":\"Vendedor <testtristest@gmail.com>\"}]', '[]', 0, 'inbox', NULL, '<!DOCTYPE html>\r\n<html>\r\n    <head>\r\n        <title>Ventonic</title>\r\n    </head>\r\n    <body>\r\n        Hola 11\r\n    </body>\r\n</html>\r\n\r\n', '0', 0, NULL, 3, '2020-10-13 11:38:15', '2020-10-13 11:38:15'),
(11, 'eyJpdiI6ImY1S2tZaklFNTVIalRGYk1WbDAwZkE9PSIsInZhbHVlIjoiZE41c1crUTJBZlVpVFgyaFI4SUdkOUJZRTdVVW1FcTFYNUVGM1loSWtQcz0iLCJtYWMiOiI0YjM4YTU4OTA2M2EwMWRiMThiNzk2YmYwZTI1ODY2MDQzYjdmNjk5NDgzYWE4MTk3NTI5OWYyMWZjODEyNjMwIn0=', 1, 'Hola 013', '', '2020-10-13 11:47:56', '[{\"full\":\"Empresa <empresa4@ventonic.com>\",\"host\":\"ventonic.com\",\"mail\":\"empresa4@ventonic.com\",\"mailbox\":\"empresa4\",\"personal\":\"Empresa\"}]', '[{\"full\":\"<testtristest@gmail.com>\",\"host\":\"gmail.com\",\"mail\":\"testtristest@gmail.com\",\"mailbox\":\"testtristest\",\"personal\":\"\"}]', NULL, NULL, '[{\"full\":\"Empresa <empresa4@ventonic.com>\",\"host\":\"ventonic.com\",\"mail\":\"empresa4@ventonic.com\",\"mailbox\":\"empresa4\",\"personal\":\"Empresa\"}]', '[{\"full\":\"Empresa <empresa4@ventonic.com>\",\"host\":\"ventonic.com\",\"mail\":\"empresa4@ventonic.com\",\"mailbox\":\"empresa4\",\"personal\":\"Empresa\"}]', NULL, 1, 'sent', NULL, 'Hola 013', 'Hola 013', 0, NULL, 3, '2020-10-13 11:47:56', '2020-10-18 17:53:46'),
(23, '1b14681d3db668f932fc39a546051626@ventonic.com', 5, 'Hola 022', NULL, '2020-10-16 13:30:37', '[{\"mailbox\":\"empresa4\",\"host\":\"ventonic.com\",\"personal\":false,\"mail\":\"empresa4@ventonic.com\",\"full\":\"empresa4@ventonic.com\"}]', '[{\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"personal\":false,\"mail\":\"testtristest@gmail.com\",\"full\":\"testtristest@gmail.com\"}]', NULL, NULL, '[{\"mailbox\":\"empresa4\",\"host\":\"ventonic.com\",\"personal\":false,\"mail\":\"empresa4@ventonic.com\",\"full\":\"empresa4@ventonic.com\"}]', '[{\"mailbox\":\"empresa4\",\"host\":\"ventonic.com\",\"personal\":false,\"mail\":\"empresa4@ventonic.com\",\"full\":\"empresa4@ventonic.com\"}]', '[]', 0, 'inbox', NULL, 'Hola 022\r\n', 'Hola 022\r\n', 0, NULL, 6, '2020-10-16 11:53:23', '2020-10-16 11:53:23'),
(24, '91bf92e4d25aa7500d70f176e5892373@ventonic.com', 4, 'Hola 021', NULL, '2020-10-16 13:29:51', '[{\"mailbox\":\"empresa4\",\"host\":\"ventonic.com\",\"personal\":false,\"mail\":\"empresa4@ventonic.com\",\"full\":\"empresa4@ventonic.com\"}]', '[{\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"personal\":false,\"mail\":\"testtristest@gmail.com\",\"full\":\"testtristest@gmail.com\"}]', NULL, NULL, '[{\"mailbox\":\"empresa4\",\"host\":\"ventonic.com\",\"personal\":false,\"mail\":\"empresa4@ventonic.com\",\"full\":\"empresa4@ventonic.com\"}]', '[{\"mailbox\":\"empresa4\",\"host\":\"ventonic.com\",\"personal\":false,\"mail\":\"empresa4@ventonic.com\",\"full\":\"empresa4@ventonic.com\"}]', '[]', 0, 'inbox', NULL, 'Hola 021\r\n', 'Hola 021\r\n', 0, NULL, 6, '2020-10-16 11:53:23', '2020-10-16 11:53:23'),
(25, 'cd6e3924f7e55aad6b99e7b9934f9c1c@dev.ventonic.com', 3, 'Nueva postulacion recibida', NULL, '2020-10-16 10:03:05', '[{\"personal\":\"Ventonic\",\"mailbox\":\"info\",\"host\":\"ventonic.com\",\"mail\":\"info@ventonic.com\",\"full\":\"Ventonic <info@ventonic.com>\"}]', '[{\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"personal\":false,\"mail\":\"testtristest@gmail.com\",\"full\":\"testtristest@gmail.com\"}]', NULL, NULL, '[{\"personal\":\"Ventonic\",\"mailbox\":\"info\",\"host\":\"ventonic.com\",\"mail\":\"info@ventonic.com\",\"full\":\"Ventonic <info@ventonic.com>\"}]', '[{\"personal\":\"Ventonic\",\"mailbox\":\"info\",\"host\":\"ventonic.com\",\"mail\":\"info@ventonic.com\",\"full\":\"Ventonic <info@ventonic.com>\"}]', '[]', 0, 'inbox', NULL, '<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\r\n</head>\r\n<body style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; background-color: #f8fafc; color: #74787e; height: 100%; hyphens: auto; line-height: 1.4; margin: 0; -moz-hyphens: auto; -ms-word-break: break-all; width: 100% !important; -webkit-hyphens: auto; -webkit-text-size-adjust: none; word-break: break-word;\">\r\n<style>\r\n@media  only screen and (max-width: 600px) {\r\n.inner-body {\r\nwidth: 100% !important;\r\n}\r\n\r\n.footer {\r\nwidth: 100% !important;\r\n}\r\n}\r\n\r\n@media  only screen and (max-width: 500px) {\r\n.button {\r\nwidth: 100% !important;\r\n}\r\n}\r\n</style>\r\n<table class=\"wrapper\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" role=\"presentation\" style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; background-color: #f8fafc; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;\"><tr>\r\n<td align=\"center\" style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box;\">\r\n<table class=\"content\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" role=\"presentation\" style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;\">\r\n<tr>\r\n<td class=\"header\" style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; padding: 25px 0; text-align: center;\">\r\n<a href=\"https://dev.ventonic.com\" style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; color: #bbbfc3; font-size: 19px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 white;\">\r\nVentonic\r\n</a>\r\n</td>\r\n</tr>\r\n<!-- Email Body --><tr>\r\n<td class=\"body\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; background-color: #ffffff; border-bottom: 1px solid #edeff2; border-top: 1px solid #edeff2; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;\">\r\n<table class=\"inner-body\" align=\"center\" width=\"570\" cellpadding=\"0\" cellspacing=\"0\" role=\"presentation\" style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; background-color: #ffffff; margin: 0 auto; padding: 0; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;\">\r\n<!-- Body content --><tr>\r\n<td class=\"content-cell\" style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; padding: 35px;\">\r\n<h1 style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; color: #3d4852; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;\">Hola Vendedor,</h1>\r\n<p style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; color: #3d4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\">Se ha inscrito en la Oportunidad Productos para quirófanos</p>\r\n<p style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; color: #3d4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\">Puede seguir es estado de su candidatura desde la plataforma de Ventonic en el apartado Oportunidades/Mis candidaturas.</p>\r\n<p style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; color: #3d4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\">Recibe un cordial saludo,<br>\r\nEquipo Ventonic</p>\r\n\r\n\r\n\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box;\">\r\n<table class=\"footer\" align=\"center\" width=\"570\" cellpadding=\"0\" cellspacing=\"0\" role=\"presentation\" style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; margin: 0 auto; padding: 0; text-align: center; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;\"><tr>\r\n<td class=\"content-cell\" align=\"center\" style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; padding: 35px;\">\r\n<p style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box; line-height: 1.5em; margin-top: 0; color: #aeaeae; font-size: 12px; text-align: center;\">© 2020 Ventonic. All rights reserved.</p>\r\n\r\n</td>\r\n</tr></table>\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr></table>\r\n</body>\r\n</html>\r\n', '[Ventonic](https://dev.ventonic.com)\r\n\r\n# Hola Vendedor,\r\n\r\nSe ha inscrito en la Oportunidad Productos para quirófanos\r\n\r\nPuede seguir es estado de su candidatura desde la plataforma de Ventonic en el apartado Oportunidades/Mis candidaturas.\r\n\r\nRecibe un cordial saludo,\r\nEquipo Ventonic\r\n\r\n© 2020 Ventonic. All rights reserved.\r\n\r\n', 0, NULL, 6, '2020-10-16 11:53:23', '2020-10-16 11:53:23'),
(26, 'CAB_HEjVBQLqfmRxTVOsSW4Nr0X-nc6rW81ynU4CD1gQhAYd6nA@mail.gmail.com', 2, 'Hola 008', NULL, '2020-10-15 14:23:12', '[{\"personal\":\"Desarrollo - Software Outsourcing\",\"mailbox\":\"desarrollo\",\"host\":\"softwareoutsourcing.es\",\"mail\":\"desarrollo@softwareoutsourcing.es\",\"full\":\"Desarrollo - Software Outsourcing <desarrollo@softwareoutsourcing.es>\"}]', '[{\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"personal\":false,\"mail\":\"testtristest@gmail.com\",\"full\":\"testtristest@gmail.com\"}]', NULL, NULL, '[{\"personal\":\"Desarrollo - Software Outsourcing\",\"mailbox\":\"desarrollo\",\"host\":\"softwareoutsourcing.es\",\"mail\":\"desarrollo@softwareoutsourcing.es\",\"full\":\"Desarrollo - Software Outsourcing <desarrollo@softwareoutsourcing.es>\"}]', '[{\"personal\":\"Desarrollo - Software Outsourcing\",\"mailbox\":\"desarrollo\",\"host\":\"softwareoutsourcing.es\",\"mail\":\"desarrollo@softwareoutsourcing.es\",\"full\":\"Desarrollo - Software Outsourcing <desarrollo@softwareoutsourcing.es>\"}]', '[]', 0, 'inbox', NULL, '<div dir=\"ltr\">Hola 008<br clear=\"all\"><div><div dir=\"ltr\" class=\"gmail_signature\" data-smartmail=\"gmail_signature\"><div dir=\"ltr\"><div><div dir=\"ltr\"><div><p class=\"MsoNormal\"><br></p><div dir=\"ltr\"><br></div><div dir=\"ltr\"><img src=\"https://drive.google.com/a/softwareoutsourcing.es/uc?id=1ddZCkvWMoRGGkP-vWrwuSUm-F3hrB9SZ&amp;export=download\"><br></div><div dir=\"ltr\"></div><p class=\"MsoNormal\">SOFTWARE OUTSOURCING<span></span></p>\r\n\r\n<p class=\"MsoNormal\">Equipo de Desarrollo<span></span></p>\r\n\r\n<p class=\"MsoNormal\"><a href=\"mailto:desarrollo@softwareoutsourcing.es\" target=\"_blank\"><span style=\"color:rgb(5,99,193)\">desarrollo@softwareoutsourcing.es</span></a><span></span></p></div></div></div></div></div></div></div>\r\n', 'Hola 008\r\n\r\n\r\n\r\n\r\nSOFTWARE OUTSOURCING\r\n\r\nEquipo de Desarrollo\r\n\r\ndesarrollo@softwareoutsourcing.es\r\n', 0, NULL, 6, '2020-10-16 11:53:23', '2020-10-16 11:53:23'),
(27, 'CAMkakwHCWPrkh6hfy=QCmAkFbBckxJEJ3_RNCjFUTBonnyaVRA@mail.gmail.com', 1, 'Hola 007', NULL, '2020-10-15 14:21:16', '[{\"personal\":\"Usuario M\",\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"mail\":\"testtristest@gmail.com\",\"full\":\"Usuario M <testtristest@gmail.com>\"}]', '[{\"mailbox\":\"empresa4\",\"host\":\"ventonic.com\",\"personal\":false,\"mail\":\"empresa4@ventonic.com\",\"full\":\"empresa4@ventonic.com\"}]', NULL, NULL, '[{\"personal\":\"Usuario M\",\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"mail\":\"testtristest@gmail.com\",\"full\":\"Usuario M <testtristest@gmail.com>\"}]', '[{\"personal\":\"Usuario M\",\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"mail\":\"testtristest@gmail.com\",\"full\":\"Usuario M <testtristest@gmail.com>\"}]', '[]', 0, 'inbox', NULL, '<div dir=\"ltr\">Hola 007</div>\r\n', 'Hola 007\r\n', 0, NULL, 6, '2020-10-16 11:53:23', '2020-10-16 11:53:23'),
(30, 'CAMkakwH5Bte908O5Vd7+fNW-ZTBJV_kmHaDxAo7+gAf09OguSA@mail.gmail.com', 2, 'Hola 0018 respuesta', NULL, '2020-10-18 19:25:38', '[{\"personal\":\"Usuario M\",\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"mail\":\"testtristest@gmail.com\",\"full\":\"Usuario M <testtristest@gmail.com>\"}]', '[{\"personal\":\"Usuario M\",\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"mail\":\"testtristest@gmail.com\",\"full\":\"Usuario M <testtristest@gmail.com>\"}]', NULL, NULL, '[{\"personal\":\"Usuario M\",\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"mail\":\"testtristest@gmail.com\",\"full\":\"Usuario M <testtristest@gmail.com>\"}]', '[{\"personal\":\"Usuario M\",\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"mail\":\"testtristest@gmail.com\",\"full\":\"Usuario M <testtristest@gmail.com>\"}]', '{\"f_kgfdqn310\":{},\"f_kgfdr4kf1\":{},\"f_kgfdr81t2\":{}}', 0, 'inbox', NULL, '<div dir=\"ltr\"><div dir=\"ltr\">Hola 0018 respuesta<br></div></div>\r\n', 'Hola 0018 respuesta\r\n', 0, NULL, 3, '2020-10-18 17:56:20', '2020-10-18 17:56:20'),
(31, '6efb46f3e8d73ea41003bffe42467f03@dev.ventonic.com', 1, 'Hola 0018', NULL, '2020-10-18 17:13:40', '[{\"personal\":\"Vendedor\",\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"mail\":\"testtristest@gmail.com\",\"full\":\"Vendedor <testtristest@gmail.com>\"}]', '[{\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"personal\":false,\"mail\":\"testtristest@gmail.com\",\"full\":\"testtristest@gmail.com\"}]', NULL, NULL, '[{\"personal\":\"Vendedor\",\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"mail\":\"testtristest@gmail.com\",\"full\":\"Vendedor <testtristest@gmail.com>\"}]', '[{\"personal\":\"Vendedor\",\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"mail\":\"testtristest@gmail.com\",\"full\":\"Vendedor <testtristest@gmail.com>\"}]', '[{},{},{}]', 0, 'inbox', NULL, '<!DOCTYPE html>\r\n<html>\r\n    <head>\r\n        <title>Ventonic</title>\r\n    </head>\r\n    <body>\r\n        Hola 0018\r\n    </body>\r\n</html>\r\n\r\n', '0', 0, NULL, 3, '2020-10-18 17:56:20', '2020-10-18 17:56:20'),
(36, 'Ir8QEqOmW6AWw04o3lNS3w.0@notifications.google.com', 3, 'Alerta de seguridad', NULL, '2020-10-19 03:06:18', '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[{\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"personal\":false,\"mail\":\"testtristest@gmail.com\",\"full\":\"testtristest@gmail.com\"}]', NULL, NULL, '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', NULL, 0, 'inbox', NULL, '<!DOCTYPE html><html lang=\"en\"><head><meta name=\"format-detection\" content=\"email=no\"/><meta name=\"format-detection\" content=\"date=no\"/><style nonce=\"QtARKfZ3S37kuZKKMaZllg\">.awl a {color: #FFFFFF; text-decoration: none;} .abml a {color: #000000; font-family: Roboto-Medium,Helvetica,Arial,sans-serif; font-weight: bold; text-decoration: none;} .adgl a {color: rgba(0, 0, 0, 0.87); text-decoration: none;} .afal a {color: #b0b0b0; text-decoration: none;} @media screen and (min-width: 600px) {.v2sp {padding: 6px 30px 0px;} .v2rsp {padding: 0px 10px;}} @media screen and (min-width: 600px) {.mdv2rw {padding: 40px 40px;}} </style><link href=\"//fonts.googleapis.com/css?family=Google+Sans\" rel=\"stylesheet\" type=\"text/css\"/></head><body style=\"margin: 0; padding: 0;\" bgcolor=\"#FFFFFF\"><table width=\"100%\" height=\"100%\" style=\"min-width: 348px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" lang=\"en\"><tr height=\"32\" style=\"height: 32px;\"><td></td></tr><tr align=\"center\"><td><div itemscope itemtype=\"//schema.org/EmailMessage\"><div itemprop=\"action\" itemscope itemtype=\"//schema.org/ViewAction\"><link itemprop=\"url\" href=\"https://accounts.google.com/AccountChooser?Email=testtristest@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1603076778000?rfn%3D127%26rfnc%3D1%26eid%3D-3310019876262288460%26et%3D0\"/><meta itemprop=\"name\" content=\"¡Repasemos!\"/></div></div><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"padding-bottom: 20px; max-width: 516px; min-width: 220px;\"><tr><td width=\"8\" style=\"width: 8px;\"></td><td><div style=\"border-style: solid; border-width: thin; border-color:#dadce0; border-radius: 8px; padding: 40px 20px;\" align=\"center\" class=\"mdv2rw\"><img src=\"https://www.gstatic.com/images/branding/googlelogo/2x/googlelogo_color_74x24dp.png\" width=\"74\" height=\"24\" aria-hidden=\"true\" style=\"margin-bottom: 16px;\" alt=\"Google\"><div style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom: thin solid #dadce0; color: rgba(0,0,0,0.87); line-height: 32px; padding-bottom: 24px;text-align: center; word-break: break-word;\"><div style=\"font-size: 24px;\">Se ha concedido el acceso a tu cuenta&nbsp;de&nbsp;Google a <a>Ventonic Testing</a> </div><table align=\"center\" style=\"margin-top:8px;\"><tr style=\"line-height: normal;\"><td align=\"right\" style=\"padding-right:8px;\"><img width=\"20\" height=\"20\" style=\"width: 20px; height: 20px; vertical-align: sub; border-radius: 50%;;\" src=\"https://www.gstatic.com/accountalerts/email/anonymous_profile_photo.png\" alt=\"\"></td><td><a style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.87); font-size: 14px; line-height: 20px;\">testtristest@gmail.com</a></td></tr></table> </div><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 14px; color: rgba(0,0,0,0.87); line-height: 20px;padding-top: 20px; text-align: left;\"><br>Si no has concedido este acceso, revisa la actividad y protege tu cuenta.<div style=\"padding-top: 32px; text-align: center;\"><a href=\"https://accounts.google.com/AccountChooser?Email=testtristest@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1603076778000?rfn%3D127%26rfnc%3D1%26eid%3D-3310019876262288460%26et%3D0\" target=\"_blank\" link-id=\"main-button-link\" style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif; line-height: 16px; color: #ffffff; font-weight: 400; text-decoration: none;font-size: 14px;display:inline-block;padding: 10px 24px;background-color: #4184F3; border-radius: 5px; min-width: 90px;\">Comprobar actividad</a></div></div><div style=\"padding-top: 20px; font-size: 12px; line-height: 16px; color: #5f6368; letter-spacing: 0.3px; text-align: center\">Si lo prefieres, ve directamente a:<br><a style=\"color: rgba(0, 0, 0, 0.87);text-decoration: inherit;\">https://myaccount.google.com/notifications</a></div></div><div style=\"text-align: left;\"><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\"><div>Te hemos enviado este correo electrónico para informarte de cambios importantes en tu cuenta y en los servicios de Google.</div><div style=\"direction: ltr;\">&copy; 2020 Google LLC, <a class=\"afal\" style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\">1600 Amphitheatre Parkway, Mountain View, CA 94043, USA</a></div></div></div></td><td width=\"8\" style=\"width: 8px;\"></td></tr></table></td></tr><tr height=\"32\" style=\"height: 32px;\"><td></td></tr></table></body></html>', '[image: Google]\r\nSe ha concedido el acceso a tu cuenta de Google a Ventonic Testing\r\n\r\n\r\ntesttristest@gmail.com\r\n\r\nSi no has concedido este acceso, revisa la actividad y protege tu cuenta.\r\nComprobar actividad\r\n<https://accounts.google.com/AccountChooser?Email=testtristest@gmail.com&continue=https://myaccount.google.com/alert/nt/1603076778000?rfn%3D127%26rfnc%3D1%26eid%3D-3310019876262288460%26et%3D0>\r\nSi lo prefieres, ve directamente a:\r\nhttps://myaccount.google.com/notifications\r\nTe hemos enviado este correo electrónico para informarte de cambios\r\nimportantes en tu cuenta y en los servicios de Google.\r\n© 2020 Google LLC, 1600 Amphitheatre Parkway, Mountain View, CA 94043, USA\r\n', 0, NULL, 3, '2020-10-19 14:33:42', '2020-10-19 14:33:42'),
(37, 'CAMkakwEAsvOFJ64sAW-Q6=sYeJDAfqAgCtP7jCZzrETotv_teA@mail.gmail.com', 2, 'self email', NULL, '2020-10-18 22:30:03', '[{\"personal\":\"Usuario M\",\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"mail\":\"testtristest@gmail.com\",\"full\":\"Usuario M <testtristest@gmail.com>\"}]', '[{\"personal\":\"Usuario M\",\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"mail\":\"testtristest@gmail.com\",\"full\":\"Usuario M <testtristest@gmail.com>\"}]', NULL, NULL, '[{\"personal\":\"Usuario M\",\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"mail\":\"testtristest@gmail.com\",\"full\":\"Usuario M <testtristest@gmail.com>\"}]', '[{\"personal\":\"Usuario M\",\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"mail\":\"testtristest@gmail.com\",\"full\":\"Usuario M <testtristest@gmail.com>\"}]', NULL, 0, 'inbox', NULL, '<div dir=\"ltr\">Correo de prueba enviado a mi mismo para comprobar descarga</div>\r\n', 'Correo de prueba enviado a mi mismo para comprobar descarga\r\n', 0, NULL, 3, '2020-10-19 14:33:42', '2020-10-19 14:33:42'),
(38, 'b118dbfa5f6b5c345cbedbfcf77cac68@dev.ventonic.com', 1, 'Hola un destinatario', NULL, '2020-10-18 18:08:19', '[{\"personal\":\"Vendedor\",\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"mail\":\"testtristest@gmail.com\",\"full\":\"Vendedor <testtristest@gmail.com>\"}]', '[{\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"personal\":false,\"mail\":\"testtristest@gmail.com\",\"full\":\"testtristest@gmail.com\"}]', NULL, NULL, '[{\"personal\":\"Vendedor\",\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"mail\":\"testtristest@gmail.com\",\"full\":\"Vendedor <testtristest@gmail.com>\"}]', '[{\"personal\":\"Vendedor\",\"mailbox\":\"testtristest\",\"host\":\"gmail.com\",\"mail\":\"testtristest@gmail.com\",\"full\":\"Vendedor <testtristest@gmail.com>\"}]', NULL, 0, 'inbox', NULL, '<!DOCTYPE html>\r\n<html>\r\n    <head>\r\n        <title>Ventonic</title>\r\n    </head>\r\n    <body>\r\n        Hola un destinatario\r\n    </body>\r\n</html>\r\n\r\n', '0', 0, NULL, 3, '2020-10-19 14:33:42', '2020-10-19 14:33:42'),
(49, 'CAPwVSWjBG815p5m0afEL4qvsQ0YxDo+fpAVwbyEcukWpyiJrhQ@mail.gmail.com', 11, 'PRUEBA', NULL, '2020-10-19 10:10:40', '[{\"personal\":\"Dayron Armas\",\"mailbox\":\"darmasbenitez\",\"host\":\"gmail.com\",\"mail\":\"darmasbenitez@gmail.com\",\"full\":\"Dayron Armas <darmasbenitez@gmail.com>\"}]', '[{\"mailbox\":\"cdvaltovalor\",\"host\":\"gmail.com\",\"personal\":false,\"mail\":\"cdvaltovalor@gmail.com\",\"full\":\"cdvaltovalor@gmail.com\"}]', NULL, NULL, '[{\"personal\":\"Dayron Armas\",\"mailbox\":\"darmasbenitez\",\"host\":\"gmail.com\",\"mail\":\"darmasbenitez@gmail.com\",\"full\":\"Dayron Armas <darmasbenitez@gmail.com>\"}]', '[{\"personal\":\"Dayron Armas\",\"mailbox\":\"darmasbenitez\",\"host\":\"gmail.com\",\"mail\":\"darmasbenitez@gmail.com\",\"full\":\"Dayron Armas <darmasbenitez@gmail.com>\"}]', '[]', 0, 'inbox', NULL, '<div dir=\"ltr\">Hola<div><br></div><div>Te envío este email de pruebas</div><div><br></div><div>Un saludo</div></div>\r\n', 'Hola\r\n\r\nTe envío este email de pruebas\r\n\r\nUn saludo\r\n', 0, NULL, 10, '2020-10-19 21:45:48', '2020-10-19 21:45:48'),
(50, 'S8BZwWyTXCisT1GNPBmecg.0@notifications.google.com', 10, 'Alerta de seguridad crítica', NULL, '2020-10-15 22:52:06', '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[{\"mailbox\":\"cdvaltovalor\",\"host\":\"gmail.com\",\"personal\":false,\"mail\":\"cdvaltovalor@gmail.com\",\"full\":\"cdvaltovalor@gmail.com\"}]', NULL, NULL, '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[]', 0, 'inbox', NULL, '<!DOCTYPE html><html lang=\"en\"><head><meta name=\"format-detection\" content=\"email=no\"/><meta name=\"format-detection\" content=\"date=no\"/><style nonce=\"B1y2ziPu4mpFQRS6kUfSIQ\">.awl a {color: #FFFFFF; text-decoration: none;} .abml a {color: #000000; font-family: Roboto-Medium,Helvetica,Arial,sans-serif; font-weight: bold; text-decoration: none;} .adgl a {color: rgba(0, 0, 0, 0.87); text-decoration: none;} .afal a {color: #b0b0b0; text-decoration: none;} @media screen and (min-width: 600px) {.v2sp {padding: 6px 30px 0px;} .v2rsp {padding: 0px 10px;}} @media screen and (min-width: 600px) {.mdv2rw {padding: 40px 40px;}} </style><link href=\"//fonts.googleapis.com/css?family=Google+Sans\" rel=\"stylesheet\" type=\"text/css\"/></head><body style=\"margin: 0; padding: 0;\" bgcolor=\"#FFFFFF\"><table width=\"100%\" height=\"100%\" style=\"min-width: 348px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" lang=\"en\"><tr height=\"32\" style=\"height: 32px;\"><td></td></tr><tr align=\"center\"><td><div itemscope itemtype=\"//schema.org/EmailMessage\"><div itemprop=\"action\" itemscope itemtype=\"//schema.org/ViewAction\"><link itemprop=\"url\" href=\"https://accounts.google.com/AccountChooser?Email=cdvaltovalor@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1602802326307?rfn%3D28%26rfnc%3D1%26eid%3D3747022850820934529%26et%3D0\"/><meta itemprop=\"name\" content=\"¡Repasemos!\"/></div></div><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"padding-bottom: 20px; max-width: 516px; min-width: 220px;\"><tr><td width=\"8\" style=\"width: 8px;\"></td><td><div style=\"border-style: solid; border-width: thin; border-color:#dadce0; border-radius: 8px; padding: 40px 20px;\" align=\"center\" class=\"mdv2rw\"><img src=\"https://www.gstatic.com/images/branding/googlelogo/2x/googlelogo_color_74x24dp.png\" width=\"74\" height=\"24\" aria-hidden=\"true\" style=\"margin-bottom: 16px;\" alt=\"Google\"><div style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom: thin solid #dadce0; color: rgba(0,0,0,0.87); line-height: 32px; padding-bottom: 24px;text-align: center; word-break: break-word;\"><div style=\"font-size: 24px;\">Se ha activado el acceso de las aplicaciones poco seguras </div><table align=\"center\" style=\"margin-top:8px;\"><tr style=\"line-height: normal;\"><td align=\"right\" style=\"padding-right:8px;\"><img width=\"20\" height=\"20\" style=\"width: 20px; height: 20px; vertical-align: sub; border-radius: 50%;;\" src=\"https://www.gstatic.com/accountalerts/email/anonymous_profile_photo.png\" alt=\"\"></td><td><a style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.87); font-size: 14px; line-height: 20px;\">cdvaltovalor@gmail.com</a></td></tr></table> </div><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 14px; color: rgba(0,0,0,0.87); line-height: 20px;padding-top: 20px; text-align: left;\">Se ha activado el acceso de las aplicaciones poco seguras a tu cuenta de Google cdvaltovalor@gmail.com. Si no lo has modificado tú, deberías comprobar qué ha sucedido.<div style=\"padding-top: 32px; text-align: center;\"><a href=\"https://accounts.google.com/AccountChooser?Email=cdvaltovalor@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1602802326307?rfn%3D28%26rfnc%3D1%26eid%3D3747022850820934529%26et%3D0\" target=\"_blank\" link-id=\"main-button-link\" style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif; line-height: 16px; color: #ffffff; font-weight: 400; text-decoration: none;font-size: 14px;display:inline-block;padding: 10px 24px;background-color: #4184F3; border-radius: 5px; min-width: 90px;\">Comprobar actividad</a></div></div><div style=\"padding-top: 20px; font-size: 12px; line-height: 16px; color: #5f6368; letter-spacing: 0.3px; text-align: center\">Si lo prefieres, ve directamente a:<br><a style=\"color: rgba(0, 0, 0, 0.87);text-decoration: inherit;\">https://myaccount.google.com/notifications</a></div></div><div style=\"text-align: left;\"><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\"><div>Te hemos enviado este correo electrónico para informarte de cambios importantes en tu cuenta y en los servicios de Google.</div><div style=\"direction: ltr;\">&copy; 2020 Google LLC, <a class=\"afal\" style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\">1600 Amphitheatre Parkway, Mountain View, CA 94043, USA</a></div></div></div></td><td width=\"8\" style=\"width: 8px;\"></td></tr></table></td></tr><tr height=\"32\" style=\"height: 32px;\"><td></td></tr></table></body></html>', '[image: Google]\r\nSe ha activado el acceso de las aplicaciones poco seguras\r\n\r\n\r\ncdvaltovalor@gmail.com\r\nSe ha activado el acceso de las aplicaciones poco seguras a tu cuenta de\r\nGoogle cdvaltovalor@gmail.com. Si no lo has modificado tú, deberías\r\ncomprobar qué ha sucedido.\r\nComprobar actividad\r\n<https://accounts.google.com/AccountChooser?Email=cdvaltovalor@gmail.com&continue=https://myaccount.google.com/alert/nt/1602802326307?rfn%3D28%26rfnc%3D1%26eid%3D3747022850820934529%26et%3D0>\r\nSi lo prefieres, ve directamente a:\r\nhttps://myaccount.google.com/notifications\r\nTe hemos enviado este correo electrónico para informarte de cambios\r\nimportantes en tu cuenta y en los servicios de Google.\r\n© 2020 Google LLC, 1600 Amphitheatre Parkway, Mountain View, CA 94043, USA\r\n', 0, NULL, 10, '2020-10-19 21:45:48', '2020-10-19 21:45:48'),
(51, 'APK9r09UOiaLBaovN1Lu4A.0@notifications.google.com', 9, 'Alerta de seguridad crítica', NULL, '2020-10-15 22:51:02', '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[{\"mailbox\":\"cdvaltovalor\",\"host\":\"gmail.com\",\"personal\":false,\"mail\":\"cdvaltovalor@gmail.com\",\"full\":\"cdvaltovalor@gmail.com\"}]', NULL, NULL, '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[]', 0, 'inbox', NULL, '<!DOCTYPE html><html lang=\"en\"><head><meta name=\"format-detection\" content=\"email=no\"/><meta name=\"format-detection\" content=\"date=no\"/><style nonce=\"9njHvQ9jpUoz02gjPuj6Kg\">.awl a {color: #FFFFFF; text-decoration: none;} .abml a {color: #000000; font-family: Roboto-Medium,Helvetica,Arial,sans-serif; font-weight: bold; text-decoration: none;} .adgl a {color: rgba(0, 0, 0, 0.87); text-decoration: none;} .afal a {color: #b0b0b0; text-decoration: none;} @media screen and (min-width: 600px) {.v2sp {padding: 6px 30px 0px;} .v2rsp {padding: 0px 10px;}} @media screen and (min-width: 600px) {.mdv2rw {padding: 40px 40px;}} </style><link href=\"//fonts.googleapis.com/css?family=Google+Sans\" rel=\"stylesheet\" type=\"text/css\"/></head><body style=\"margin: 0; padding: 0;\" bgcolor=\"#FFFFFF\"><table width=\"100%\" height=\"100%\" style=\"min-width: 348px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" lang=\"en\"><tr height=\"32\" style=\"height: 32px;\"><td></td></tr><tr align=\"center\"><td><div itemscope itemtype=\"//schema.org/EmailMessage\"><div itemprop=\"action\" itemscope itemtype=\"//schema.org/ViewAction\"><link itemprop=\"url\" href=\"https://accounts.google.com/AccountChooser?Email=cdvaltovalor@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1602802262000?rfn%3D27%26rfnc%3D1%26eid%3D-8422853785834777485%26et%3D0\"/><meta itemprop=\"name\" content=\"¡Repasemos!\"/></div></div><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"padding-bottom: 20px; max-width: 516px; min-width: 220px;\"><tr><td width=\"8\" style=\"width: 8px;\"></td><td><div style=\"border-style: solid; border-width: thin; border-color:#dadce0; border-radius: 8px; padding: 40px 20px;\" align=\"center\" class=\"mdv2rw\"><img src=\"https://www.gstatic.com/images/branding/googlelogo/2x/googlelogo_color_74x24dp.png\" width=\"74\" height=\"24\" aria-hidden=\"true\" style=\"margin-bottom: 16px;\" alt=\"Google\"><div style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom: thin solid #dadce0; color: rgba(0,0,0,0.87); line-height: 32px; padding-bottom: 24px;text-align: center; word-break: break-word;\"><div style=\"text-align: center; padding-bottom: 16px; line-height:0;\"><img height=\"33\" src=\"https://www.gstatic.com/images/icons/material/system/2x/error_red_36dp.png\"></div><div style=\"font-size: 24px;\">Se ha bloqueado un intento de inicio de&nbsp;sesión </div><table align=\"center\" style=\"margin-top:8px;\"><tr style=\"line-height: normal;\"><td align=\"right\" style=\"padding-right:8px;\"><img width=\"20\" height=\"20\" style=\"width: 20px; height: 20px; vertical-align: sub; border-radius: 50%;;\" src=\"https://www.gstatic.com/accountalerts/email/anonymous_profile_photo.png\" alt=\"\"></td><td><a style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.87); font-size: 14px; line-height: 20px;\">cdvaltovalor@gmail.com</a></td></tr></table> </div><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 14px; color: rgba(0,0,0,0.87); line-height: 20px;padding-top: 20px; text-align: left;\">Alguien acaba de usar tu contraseña para intentar iniciar sesión en tu cuenta desde una aplicación que no es de Google. Aunque Google ha bloqueado el acceso, deberías averiguar qué ha pasado. Revisa la actividad de la cuenta y comprueba que solo tú tienes acceso a ella.<div style=\"padding-top: 32px; text-align: center;\"><a href=\"https://accounts.google.com/AccountChooser?Email=cdvaltovalor@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1602802262000?rfn%3D27%26rfnc%3D1%26eid%3D-8422853785834777485%26et%3D0\" target=\"_blank\" link-id=\"main-button-link\" style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif; line-height: 16px; color: #ffffff; font-weight: 400; text-decoration: none;font-size: 14px;display:inline-block;padding: 10px 24px;background-color: #D94235; border-radius: 5px; min-width: 90px;\">Comprobar actividad</a></div></div><div style=\"padding-top: 20px; font-size: 12px; line-height: 16px; color: #5f6368; letter-spacing: 0.3px; text-align: center\">Si lo prefieres, ve directamente a:<br><a style=\"color: rgba(0, 0, 0, 0.87);text-decoration: inherit;\">https://myaccount.google.com/notifications</a></div></div><div style=\"text-align: left;\"><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\"><div>Te hemos enviado este correo electrónico para informarte de cambios importantes en tu cuenta y en los servicios de Google.</div><div style=\"direction: ltr;\">&copy; 2020 Google LLC, <a class=\"afal\" style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\">1600 Amphitheatre Parkway, Mountain View, CA 94043, USA</a></div></div></div></td><td width=\"8\" style=\"width: 8px;\"></td></tr></table></td></tr><tr height=\"32\" style=\"height: 32px;\"><td></td></tr></table></body></html>', '[image: Google]\r\nSe ha bloqueado un intento de inicio de sesión\r\n\r\n\r\ncdvaltovalor@gmail.com\r\nAlguien acaba de usar tu contraseña para intentar iniciar sesión en tu\r\ncuenta desde una aplicación que no es de Google. Aunque Google ha bloqueado\r\nel acceso, deberías averiguar qué ha pasado. Revisa la actividad de la\r\ncuenta y comprueba que solo tú tienes acceso a ella.\r\nComprobar actividad\r\n<https://accounts.google.com/AccountChooser?Email=cdvaltovalor@gmail.com&continue=https://myaccount.google.com/alert/nt/1602802262000?rfn%3D27%26rfnc%3D1%26eid%3D-8422853785834777485%26et%3D0>\r\nSi lo prefieres, ve directamente a:\r\nhttps://myaccount.google.com/notifications\r\nTe hemos enviado este correo electrónico para informarte de cambios\r\nimportantes en tu cuenta y en los servicios de Google.\r\n© 2020 Google LLC, 1600 Amphitheatre Parkway, Mountain View, CA 94043, USA\r\n', 0, NULL, 10, '2020-10-19 21:45:48', '2020-10-19 21:45:48'),
(52, 'hzb-s1gbi56g21mf0_ofjA.0@notifications.google.com', 8, 'Alerta de seguridad', NULL, '2020-10-15 22:49:49', '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[{\"mailbox\":\"cdvaltovalor\",\"host\":\"gmail.com\",\"personal\":false,\"mail\":\"cdvaltovalor@gmail.com\",\"full\":\"cdvaltovalor@gmail.com\"}]', NULL, NULL, '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[]', 0, 'inbox', NULL, '<!DOCTYPE html><html lang=\"en\"><head><meta name=\"format-detection\" content=\"email=no\"/><meta name=\"format-detection\" content=\"date=no\"/><style nonce=\"eE0dcfWXc3laXP1kol4Tcg\">.awl a {color: #FFFFFF; text-decoration: none;} .abml a {color: #000000; font-family: Roboto-Medium,Helvetica,Arial,sans-serif; font-weight: bold; text-decoration: none;} .adgl a {color: rgba(0, 0, 0, 0.87); text-decoration: none;} .afal a {color: #b0b0b0; text-decoration: none;} @media screen and (min-width: 600px) {.v2sp {padding: 6px 30px 0px;} .v2rsp {padding: 0px 10px;}} @media screen and (min-width: 600px) {.mdv2rw {padding: 40px 40px;}} </style><link href=\"//fonts.googleapis.com/css?family=Google+Sans\" rel=\"stylesheet\" type=\"text/css\"/></head><body style=\"margin: 0; padding: 0;\" bgcolor=\"#FFFFFF\"><table width=\"100%\" height=\"100%\" style=\"min-width: 348px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" lang=\"en\"><tr height=\"32\" style=\"height: 32px;\"><td></td></tr><tr align=\"center\"><td><div itemscope itemtype=\"//schema.org/EmailMessage\"><div itemprop=\"action\" itemscope itemtype=\"//schema.org/ViewAction\"><link itemprop=\"url\" href=\"https://accounts.google.com/AccountChooser?Email=cdvaltovalor@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1602802189135?rfn%3D2%26rfnc%3D1%26eid%3D6401102667882870246%26et%3D0\"/><meta itemprop=\"name\" content=\"¡Repasemos!\"/></div></div><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"padding-bottom: 20px; max-width: 516px; min-width: 220px;\"><tr><td width=\"8\" style=\"width: 8px;\"></td><td><div style=\"border-style: solid; border-width: thin; border-color:#dadce0; border-radius: 8px; padding: 40px 20px;\" align=\"center\" class=\"mdv2rw\"><img src=\"https://www.gstatic.com/images/branding/googlelogo/2x/googlelogo_color_74x24dp.png\" width=\"74\" height=\"24\" aria-hidden=\"true\" style=\"margin-bottom: 16px;\" alt=\"Google\"><div style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom: thin solid #dadce0; color: rgba(0,0,0,0.87); line-height: 32px; padding-bottom: 24px;text-align: center; word-break: break-word;\"><div style=\"font-size: 24px;\">Se ha cambiado la dirección de correo electrónico de contacto&nbsp;de </div><table align=\"center\" style=\"margin-top:8px;\"><tr style=\"line-height: normal;\"><td align=\"right\" style=\"padding-right:8px;\"><img width=\"20\" height=\"20\" style=\"width: 20px; height: 20px; vertical-align: sub; border-radius: 50%;;\" src=\"https://www.gstatic.com/accountalerts/email/anonymous_profile_photo.png\" alt=\"\"></td><td><a style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.87); font-size: 14px; line-height: 20px;\">cdvaltovalor@gmail.com</a></td></tr></table> </div><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 14px; color: rgba(0,0,0,0.87); line-height: 20px;padding-top: 20px; text-align: left;\">La dirección de correo electrónico de recuperación de tu cuenta ha cambiado. Si no la modificaste tú, deberías comprobar qué ha sucedido.<div style=\"padding-top: 32px; text-align: center;\"><a href=\"https://accounts.google.com/AccountChooser?Email=cdvaltovalor@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1602802189135?rfn%3D2%26rfnc%3D1%26eid%3D6401102667882870246%26et%3D0\" target=\"_blank\" link-id=\"main-button-link\" style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif; line-height: 16px; color: #ffffff; font-weight: 400; text-decoration: none;font-size: 14px;display:inline-block;padding: 10px 24px;background-color: #4184F3; border-radius: 5px; min-width: 90px;\">Comprobar actividad</a></div></div><div style=\"padding-top: 20px; font-size: 12px; line-height: 16px; color: #5f6368; letter-spacing: 0.3px; text-align: center\">Si lo prefieres, ve directamente a:<br><a style=\"color: rgba(0, 0, 0, 0.87);text-decoration: inherit;\">https://myaccount.google.com/notifications</a></div></div><div style=\"text-align: left;\"><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\"><div>Te hemos enviado este correo electrónico para informarte de cambios importantes en tu cuenta y en los servicios de Google.</div><div style=\"direction: ltr;\">&copy; 2020 Google LLC, <a class=\"afal\" style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\">1600 Amphitheatre Parkway, Mountain View, CA 94043, USA</a></div></div></div></td><td width=\"8\" style=\"width: 8px;\"></td></tr></table></td></tr><tr height=\"32\" style=\"height: 32px;\"><td></td></tr></table></body></html>', '[image: Google]\r\nSe ha cambiado la dirección de correo electrónico de contacto de\r\n\r\n\r\ncdvaltovalor@gmail.com\r\nLa dirección de correo electrónico de recuperación de tu cuenta ha\r\ncambiado. Si no la modificaste tú, deberías comprobar qué ha sucedido.\r\nComprobar actividad\r\n<https://accounts.google.com/AccountChooser?Email=cdvaltovalor@gmail.com&continue=https://myaccount.google.com/alert/nt/1602802189135?rfn%3D2%26rfnc%3D1%26eid%3D6401102667882870246%26et%3D0>\r\nSi lo prefieres, ve directamente a:\r\nhttps://myaccount.google.com/notifications\r\nTe hemos enviado este correo electrónico para informarte de cambios\r\nimportantes en tu cuenta y en los servicios de Google.\r\n© 2020 Google LLC, 1600 Amphitheatre Parkway, Mountain View, CA 94043, USA\r\n', 0, NULL, 10, '2020-10-19 21:45:48', '2020-10-19 21:45:48');
INSERT INTO `email_messages` (`id`, `message_id`, `message_nro`, `subject`, `references`, `message_at`, `from`, `to`, `cc`, `bcc`, `reply_to`, `sender`, `attachments`, `read`, `folder_type`, `labels`, `body`, `body_text`, `favorite`, `deleted_at`, `email_setting_id`, `created_at`, `updated_at`) VALUES
(53, 'HF2EiG026nFrLasOxkTwWQ.0@notifications.google.com', 7, 'Alerta de seguridad', NULL, '2020-10-15 22:49:34', '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[{\"mailbox\":\"cdvaltovalor\",\"host\":\"gmail.com\",\"personal\":false,\"mail\":\"cdvaltovalor@gmail.com\",\"full\":\"cdvaltovalor@gmail.com\"}]', NULL, NULL, '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[]', 0, 'inbox', NULL, '<!DOCTYPE html><html lang=\"en\"><head><meta name=\"format-detection\" content=\"email=no\"/><meta name=\"format-detection\" content=\"date=no\"/><style nonce=\"LB264lVEwA+zMvYnhNDkaQ\">.awl a {color: #FFFFFF; text-decoration: none;} .abml a {color: #000000; font-family: Roboto-Medium,Helvetica,Arial,sans-serif; font-weight: bold; text-decoration: none;} .adgl a {color: rgba(0, 0, 0, 0.87); text-decoration: none;} .afal a {color: #b0b0b0; text-decoration: none;} @media screen and (min-width: 600px) {.v2sp {padding: 6px 30px 0px;} .v2rsp {padding: 0px 10px;}} @media screen and (min-width: 600px) {.mdv2rw {padding: 40px 40px;}} </style><link href=\"//fonts.googleapis.com/css?family=Google+Sans\" rel=\"stylesheet\" type=\"text/css\"/></head><body style=\"margin: 0; padding: 0;\" bgcolor=\"#FFFFFF\"><table width=\"100%\" height=\"100%\" style=\"min-width: 348px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" lang=\"en\"><tr height=\"32\" style=\"height: 32px;\"><td></td></tr><tr align=\"center\"><td><div itemscope itemtype=\"//schema.org/EmailMessage\"><div itemprop=\"action\" itemscope itemtype=\"//schema.org/ViewAction\"><link itemprop=\"url\" href=\"https://accounts.google.com/AccountChooser?Email=cdvaltovalor@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1602802174067?rfn%3D4%26rfnc%3D1%26eid%3D5950416117012570454%26et%3D0\"/><meta itemprop=\"name\" content=\"¡Repasemos!\"/></div></div><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"padding-bottom: 20px; max-width: 516px; min-width: 220px;\"><tr><td width=\"8\" style=\"width: 8px;\"></td><td><div style=\"border-style: solid; border-width: thin; border-color:#dadce0; border-radius: 8px; padding: 40px 20px;\" align=\"center\" class=\"mdv2rw\"><img src=\"https://www.gstatic.com/images/branding/googlelogo/2x/googlelogo_color_74x24dp.png\" width=\"74\" height=\"24\" aria-hidden=\"true\" style=\"margin-bottom: 16px;\" alt=\"Google\"><div style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom: thin solid #dadce0; color: rgba(0,0,0,0.87); line-height: 32px; padding-bottom: 24px;text-align: center; word-break: break-word;\"><div style=\"font-size: 24px;\">El teléfono de recuperación ha&nbsp;cambiado </div><table align=\"center\" style=\"margin-top:8px;\"><tr style=\"line-height: normal;\"><td align=\"right\" style=\"padding-right:8px;\"><img width=\"20\" height=\"20\" style=\"width: 20px; height: 20px; vertical-align: sub; border-radius: 50%;;\" src=\"https://www.gstatic.com/accountalerts/email/anonymous_profile_photo.png\" alt=\"\"></td><td><a style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.87); font-size: 14px; line-height: 20px;\">cdvaltovalor@gmail.com</a></td></tr></table> </div><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 14px; color: rgba(0,0,0,0.87); line-height: 20px;padding-top: 20px; text-align: left;\">El teléfono de recuperación de tu cuenta ha cambiado. Si no lo has modificado tú, deberías comprobar qué ha pasado.<div style=\"padding-top: 32px; text-align: center;\"><a href=\"https://accounts.google.com/AccountChooser?Email=cdvaltovalor@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1602802174067?rfn%3D4%26rfnc%3D1%26eid%3D5950416117012570454%26et%3D0\" target=\"_blank\" link-id=\"main-button-link\" style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif; line-height: 16px; color: #ffffff; font-weight: 400; text-decoration: none;font-size: 14px;display:inline-block;padding: 10px 24px;background-color: #4184F3; border-radius: 5px; min-width: 90px;\">Comprobar actividad</a></div></div><div style=\"padding-top: 20px; font-size: 12px; line-height: 16px; color: #5f6368; letter-spacing: 0.3px; text-align: center\">Si lo prefieres, ve directamente a:<br><a style=\"color: rgba(0, 0, 0, 0.87);text-decoration: inherit;\">https://myaccount.google.com/notifications</a></div></div><div style=\"text-align: left;\"><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\"><div>Te hemos enviado este correo electrónico para informarte de cambios importantes en tu cuenta y en los servicios de Google.</div><div style=\"direction: ltr;\">&copy; 2020 Google LLC, <a class=\"afal\" style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\">1600 Amphitheatre Parkway, Mountain View, CA 94043, USA</a></div></div></div></td><td width=\"8\" style=\"width: 8px;\"></td></tr></table></td></tr><tr height=\"32\" style=\"height: 32px;\"><td></td></tr></table></body></html>', '[image: Google]\r\nEl teléfono de recuperación ha cambiado\r\n\r\n\r\ncdvaltovalor@gmail.com\r\nEl teléfono de recuperación de tu cuenta ha cambiado. Si no lo has\r\nmodificado tú, deberías comprobar qué ha pasado.\r\nComprobar actividad\r\n<https://accounts.google.com/AccountChooser?Email=cdvaltovalor@gmail.com&continue=https://myaccount.google.com/alert/nt/1602802174067?rfn%3D4%26rfnc%3D1%26eid%3D5950416117012570454%26et%3D0>\r\nSi lo prefieres, ve directamente a:\r\nhttps://myaccount.google.com/notifications\r\nTe hemos enviado este correo electrónico para informarte de cambios\r\nimportantes en tu cuenta y en los servicios de Google.\r\n© 2020 Google LLC, 1600 Amphitheatre Parkway, Mountain View, CA 94043, USA\r\n', 0, NULL, 10, '2020-10-19 21:45:48', '2020-10-19 21:45:48'),
(54, '0uoxwmjKg7A34Yegaa4sWg.0@notifications.google.com', 6, 'Alerta de seguridad', NULL, '2020-10-15 22:48:52', '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[{\"mailbox\":\"cdvaltovalor\",\"host\":\"gmail.com\",\"personal\":false,\"mail\":\"cdvaltovalor@gmail.com\",\"full\":\"cdvaltovalor@gmail.com\"}]', NULL, NULL, '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[]', 0, 'inbox', NULL, '<!DOCTYPE html><html lang=\"en\"><head><meta name=\"format-detection\" content=\"email=no\"/><meta name=\"format-detection\" content=\"date=no\"/><style nonce=\"9Wu7mjTyoJaZ2W5N0NXMXg\">.awl a {color: #FFFFFF; text-decoration: none;} .abml a {color: #000000; font-family: Roboto-Medium,Helvetica,Arial,sans-serif; font-weight: bold; text-decoration: none;} .adgl a {color: rgba(0, 0, 0, 0.87); text-decoration: none;} .afal a {color: #b0b0b0; text-decoration: none;} @media screen and (min-width: 600px) {.v2sp {padding: 6px 30px 0px;} .v2rsp {padding: 0px 10px;}} @media screen and (min-width: 600px) {.mdv2rw {padding: 40px 40px;}} </style><link href=\"//fonts.googleapis.com/css?family=Google+Sans\" rel=\"stylesheet\" type=\"text/css\"/></head><body style=\"margin: 0; padding: 0;\" bgcolor=\"#FFFFFF\"><table width=\"100%\" height=\"100%\" style=\"min-width: 348px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" lang=\"en\"><tr height=\"32\" style=\"height: 32px;\"><td></td></tr><tr align=\"center\"><td><div itemscope itemtype=\"//schema.org/EmailMessage\"><div itemprop=\"action\" itemscope itemtype=\"//schema.org/ViewAction\"><link itemprop=\"url\" href=\"https://accounts.google.com/AccountChooser?Email=cdvaltovalor@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1602802132000?rfn%3D31%26rfnc%3D1%26eid%3D-4763420686354084227%26et%3D0\"/><meta itemprop=\"name\" content=\"¡Repasemos!\"/></div></div><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"padding-bottom: 20px; max-width: 516px; min-width: 220px;\"><tr><td width=\"8\" style=\"width: 8px;\"></td><td><div style=\"border-style: solid; border-width: thin; border-color:#dadce0; border-radius: 8px; padding: 40px 20px;\" align=\"center\" class=\"mdv2rw\"><img src=\"https://www.gstatic.com/images/branding/googlelogo/2x/googlelogo_color_74x24dp.png\" width=\"74\" height=\"24\" aria-hidden=\"true\" style=\"margin-bottom: 16px;\" alt=\"Google\"><div style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom: thin solid #dadce0; color: rgba(0,0,0,0.87); line-height: 32px; padding-bottom: 24px;text-align: center; word-break: break-word;\"><div style=\"font-size: 24px;\">Se ha iniciado sesión desde un dispositivo nuevo en </div><table align=\"center\" style=\"margin-top:8px;\"><tr style=\"line-height: normal;\"><td align=\"right\" style=\"padding-right:8px;\"><img width=\"20\" height=\"20\" style=\"width: 20px; height: 20px; vertical-align: sub; border-radius: 50%;;\" src=\"https://www.gstatic.com/accountalerts/email/anonymous_profile_photo.png\" alt=\"\"></td><td><a style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.87); font-size: 14px; line-height: 20px;\">cdvaltovalor@gmail.com</a></td></tr></table> </div><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 14px; color: rgba(0,0,0,0.87); line-height: 20px;padding-top: 20px; text-align: center;\">Se ha iniciado sesión en tu cuenta de Google desde un dispositivo nuevo (Mac). Te hemos enviado este correo electrónico para comprobar que la has iniciado tú.<div style=\"padding-top: 32px; text-align: center;\"><a href=\"https://accounts.google.com/AccountChooser?Email=cdvaltovalor@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1602802132000?rfn%3D31%26rfnc%3D1%26eid%3D-4763420686354084227%26et%3D0\" target=\"_blank\" link-id=\"main-button-link\" style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif; line-height: 16px; color: #ffffff; font-weight: 400; text-decoration: none;font-size: 14px;display:inline-block;padding: 10px 24px;background-color: #4184F3; border-radius: 5px; min-width: 90px;\">Comprobar actividad</a></div></div><div style=\"padding-top: 20px; font-size: 12px; line-height: 16px; color: #5f6368; letter-spacing: 0.3px; text-align: center\">Si lo prefieres, ve directamente a:<br><a style=\"color: rgba(0, 0, 0, 0.87);text-decoration: inherit;\">https://myaccount.google.com/notifications</a></div></div><div style=\"text-align: left;\"><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\"><div>Te hemos enviado este correo electrónico para informarte de cambios importantes en tu cuenta y en los servicios de Google.</div><div style=\"direction: ltr;\">&copy; 2020 Google LLC, <a class=\"afal\" style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\">1600 Amphitheatre Parkway, Mountain View, CA 94043, USA</a></div></div></div></td><td width=\"8\" style=\"width: 8px;\"></td></tr></table></td></tr><tr height=\"32\" style=\"height: 32px;\"><td></td></tr></table></body></html>', '[image: Google]\r\nSe ha iniciado sesión desde un dispositivo nuevo en\r\n\r\n\r\ncdvaltovalor@gmail.com\r\nSe ha iniciado sesión en tu cuenta de Google desde un dispositivo nuevo\r\n(Mac). Te hemos enviado este correo electrónico para comprobar que la has\r\niniciado tú.\r\nComprobar actividad\r\n<https://accounts.google.com/AccountChooser?Email=cdvaltovalor@gmail.com&continue=https://myaccount.google.com/alert/nt/1602802132000?rfn%3D31%26rfnc%3D1%26eid%3D-4763420686354084227%26et%3D0>\r\nSi lo prefieres, ve directamente a:\r\nhttps://myaccount.google.com/notifications\r\nTe hemos enviado este correo electrónico para informarte de cambios\r\nimportantes en tu cuenta y en los servicios de Google.\r\n© 2020 Google LLC, 1600 Amphitheatre Parkway, Mountain View, CA 94043, USA\r\n', 0, NULL, 10, '2020-10-19 21:45:48', '2020-10-19 21:45:48'),
(55, 'gTNNntwoe8G704DpjFcezg.0@notifications.google.com', 5, 'Alerta de seguridad', NULL, '2020-10-15 22:42:47', '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[{\"mailbox\":\"cdvaltovalor\",\"host\":\"gmail.com\",\"personal\":false,\"mail\":\"cdvaltovalor@gmail.com\",\"full\":\"cdvaltovalor@gmail.com\"}]', NULL, NULL, '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[]', 0, 'inbox', NULL, '<!DOCTYPE html><html lang=\"en\"><head><meta name=\"format-detection\" content=\"email=no\"/><meta name=\"format-detection\" content=\"date=no\"/><style nonce=\"BUY5J4lPUJI5zbqcRuAvqQ\">.awl a {color: #FFFFFF; text-decoration: none;} .abml a {color: #000000; font-family: Roboto-Medium,Helvetica,Arial,sans-serif; font-weight: bold; text-decoration: none;} .adgl a {color: rgba(0, 0, 0, 0.87); text-decoration: none;} .afal a {color: #b0b0b0; text-decoration: none;} @media screen and (min-width: 600px) {.v2sp {padding: 6px 30px 0px;} .v2rsp {padding: 0px 10px;}} @media screen and (min-width: 600px) {.mdv2rw {padding: 40px 40px;}} </style><link href=\"//fonts.googleapis.com/css?family=Google+Sans\" rel=\"stylesheet\" type=\"text/css\"/></head><body style=\"margin: 0; padding: 0;\" bgcolor=\"#FFFFFF\"><table width=\"100%\" height=\"100%\" style=\"min-width: 348px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" lang=\"en\"><tr height=\"32\" style=\"height: 32px;\"><td></td></tr><tr align=\"center\"><td><div itemscope itemtype=\"//schema.org/EmailMessage\"><div itemprop=\"action\" itemscope itemtype=\"//schema.org/ViewAction\"><link itemprop=\"url\" href=\"https://accounts.google.com/RecoverAccount?fpOnly=1&amp;source=ancp&amp;Email=cdvaltovalor@gmail.com&amp;et=0\"/><meta itemprop=\"name\" content=\"¡Repasemos!\"/></div></div><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"padding-bottom: 20px; max-width: 516px; min-width: 220px;\"><tr><td width=\"8\" style=\"width: 8px;\"></td><td><div style=\"border-style: solid; border-width: thin; border-color:#dadce0; border-radius: 8px; padding: 40px 20px;\" align=\"center\" class=\"mdv2rw\"><img src=\"https://www.gstatic.com/images/branding/googlelogo/2x/googlelogo_color_74x24dp.png\" width=\"74\" height=\"24\" aria-hidden=\"true\" style=\"margin-bottom: 16px;\" alt=\"Google\"><div style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom: thin solid #dadce0; color: rgba(0,0,0,0.87); line-height: 32px; padding-bottom: 24px;text-align: center; word-break: break-word;\"><div style=\"font-size: 24px;\">Se ha cambiado tu contraseña </div><table align=\"center\" style=\"margin-top:8px;\"><tr style=\"line-height: normal;\"><td align=\"right\" style=\"padding-right:8px;\"><img width=\"20\" height=\"20\" style=\"width: 20px; height: 20px; vertical-align: sub; border-radius: 50%;;\" src=\"https://www.gstatic.com/accountalerts/email/anonymous_profile_photo.png\" alt=\"\"></td><td><a style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.87); font-size: 14px; line-height: 20px;\">cdvaltovalor@gmail.com</a></td></tr></table> </div><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 14px; color: rgba(0,0,0,0.87); line-height: 20px;padding-top: 20px; text-align: left;\">Se ha cambiado la contraseña de tu cuenta de Google cdvaltovalor@gmail.com. Si no lo has hecho tú, deberías <a href=\"https://accounts.google.com/RecoverAccount?fpOnly=1&amp;source=ancp&amp;Email=cdvaltovalor@gmail.com&amp;et=0\" data-meta-key=\"recover-account\" style=\"text-decoration: none; color: #4285F4;\" target=\"_blank\">recuperar la cuenta</a>.</div><div style=\"padding-top: 20px; font-size: 12px; line-height: 16px; color: #5f6368; letter-spacing: 0.3px; text-align: center\">Si lo prefieres, ve directamente a:<br><a style=\"color: rgba(0, 0, 0, 0.87);text-decoration: inherit;\">https://myaccount.google.com/notifications</a></div></div><div style=\"text-align: left;\"><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\"><div>Te hemos enviado este correo electrónico para informarte de cambios importantes en tu cuenta y en los servicios de Google.</div><div style=\"direction: ltr;\">&copy; 2020 Google LLC, <a class=\"afal\" style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\">1600 Amphitheatre Parkway, Mountain View, CA 94043, USA</a></div></div></div></td><td width=\"8\" style=\"width: 8px;\"></td></tr></table></td></tr><tr height=\"32\" style=\"height: 32px;\"><td></td></tr></table></body></html>', '[image: Google]\r\nSe ha cambiado tu contraseña\r\n\r\n\r\ncdvaltovalor@gmail.com\r\nSe ha cambiado la contraseña de tu cuenta de Google cdvaltovalor@gmail.com.\r\nSi no lo has hecho tú, deberías recuperar la cuenta\r\n<https://accounts.google.com/RecoverAccount?fpOnly=1&source=ancp&Email=cdvaltovalor@gmail.com&et=0>\r\n.\r\nSi lo prefieres, ve directamente a:\r\nhttps://myaccount.google.com/notifications\r\nTe hemos enviado este correo electrónico para informarte de cambios\r\nimportantes en tu cuenta y en los servicios de Google.\r\n© 2020 Google LLC, 1600 Amphitheatre Parkway, Mountain View, CA 94043, USA\r\n', 0, NULL, 10, '2020-10-19 21:45:48', '2020-10-19 21:45:48'),
(56, 'K6_WbncC_74VECfVcZv5_A.0@notifications.google.com', 4, 'Alerta de seguridad', NULL, '2020-10-15 22:40:42', '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[{\"mailbox\":\"cdvaltovalor\",\"host\":\"gmail.com\",\"personal\":false,\"mail\":\"cdvaltovalor@gmail.com\",\"full\":\"cdvaltovalor@gmail.com\"}]', NULL, NULL, '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[]', 0, 'inbox', NULL, '<!DOCTYPE html><html lang=\"en\"><head><meta name=\"format-detection\" content=\"email=no\"/><meta name=\"format-detection\" content=\"date=no\"/><style nonce=\"cLrIfMV7zONSS7KXJLHJyQ\">.awl a {color: #FFFFFF; text-decoration: none;} .abml a {color: #000000; font-family: Roboto-Medium,Helvetica,Arial,sans-serif; font-weight: bold; text-decoration: none;} .adgl a {color: rgba(0, 0, 0, 0.87); text-decoration: none;} .afal a {color: #b0b0b0; text-decoration: none;} @media screen and (min-width: 600px) {.v2sp {padding: 6px 30px 0px;} .v2rsp {padding: 0px 10px;}} @media screen and (min-width: 600px) {.mdv2rw {padding: 40px 40px;}} </style><link href=\"//fonts.googleapis.com/css?family=Google+Sans\" rel=\"stylesheet\" type=\"text/css\"/></head><body style=\"margin: 0; padding: 0;\" bgcolor=\"#FFFFFF\"><table width=\"100%\" height=\"100%\" style=\"min-width: 348px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" lang=\"en\"><tr height=\"32\" style=\"height: 32px;\"><td></td></tr><tr align=\"center\"><td><div itemscope itemtype=\"//schema.org/EmailMessage\"><div itemprop=\"action\" itemscope itemtype=\"//schema.org/ViewAction\"><link itemprop=\"url\" href=\"https://accounts.google.com/RecoverAccount?fpOnly=1&amp;source=ancp&amp;Email=cdvaltovalor@gmail.com&amp;et=0\"/><meta itemprop=\"name\" content=\"¡Repasemos!\"/></div></div><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"padding-bottom: 20px; max-width: 516px; min-width: 220px;\"><tr><td width=\"8\" style=\"width: 8px;\"></td><td><div style=\"border-style: solid; border-width: thin; border-color:#dadce0; border-radius: 8px; padding: 40px 20px;\" align=\"center\" class=\"mdv2rw\"><img src=\"https://www.gstatic.com/images/branding/googlelogo/2x/googlelogo_color_74x24dp.png\" width=\"74\" height=\"24\" aria-hidden=\"true\" style=\"margin-bottom: 16px;\" alt=\"Google\"><div style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom: thin solid #dadce0; color: rgba(0,0,0,0.87); line-height: 32px; padding-bottom: 24px;text-align: center; word-break: break-word;\"><div style=\"font-size: 24px;\">Se ha cambiado tu contraseña </div><table align=\"center\" style=\"margin-top:8px;\"><tr style=\"line-height: normal;\"><td align=\"right\" style=\"padding-right:8px;\"><img width=\"20\" height=\"20\" style=\"width: 20px; height: 20px; vertical-align: sub; border-radius: 50%;;\" src=\"https://www.gstatic.com/accountalerts/email/anonymous_profile_photo.png\" alt=\"\"></td><td><a style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.87); font-size: 14px; line-height: 20px;\">cdvaltovalor@gmail.com</a></td></tr></table> </div><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 14px; color: rgba(0,0,0,0.87); line-height: 20px;padding-top: 20px; text-align: left;\">Se ha cambiado la contraseña de tu cuenta de Google cdvaltovalor@gmail.com. Si no lo has hecho tú, deberías <a href=\"https://accounts.google.com/RecoverAccount?fpOnly=1&amp;source=ancp&amp;Email=cdvaltovalor@gmail.com&amp;et=0\" data-meta-key=\"recover-account\" style=\"text-decoration: none; color: #4285F4;\" target=\"_blank\">recuperar la cuenta</a>.</div><div style=\"padding-top: 20px; font-size: 12px; line-height: 16px; color: #5f6368; letter-spacing: 0.3px; text-align: center\">Si lo prefieres, ve directamente a:<br><a style=\"color: rgba(0, 0, 0, 0.87);text-decoration: inherit;\">https://myaccount.google.com/notifications</a></div></div><div style=\"text-align: left;\"><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\"><div>Te hemos enviado este correo electrónico para informarte de cambios importantes en tu cuenta y en los servicios de Google.</div><div style=\"direction: ltr;\">&copy; 2020 Google LLC, <a class=\"afal\" style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\">1600 Amphitheatre Parkway, Mountain View, CA 94043, USA</a></div></div></div></td><td width=\"8\" style=\"width: 8px;\"></td></tr></table></td></tr><tr height=\"32\" style=\"height: 32px;\"><td></td></tr></table></body></html>', '[image: Google]\r\nSe ha cambiado tu contraseña\r\n\r\n\r\ncdvaltovalor@gmail.com\r\nSe ha cambiado la contraseña de tu cuenta de Google cdvaltovalor@gmail.com.\r\nSi no lo has hecho tú, deberías recuperar la cuenta\r\n<https://accounts.google.com/RecoverAccount?fpOnly=1&source=ancp&Email=cdvaltovalor@gmail.com&et=0>\r\n.\r\nSi lo prefieres, ve directamente a:\r\nhttps://myaccount.google.com/notifications\r\nTe hemos enviado este correo electrónico para informarte de cambios\r\nimportantes en tu cuenta y en los servicios de Google.\r\n© 2020 Google LLC, 1600 Amphitheatre Parkway, Mountain View, CA 94043, USA\r\n', 0, NULL, 10, '2020-10-19 21:45:48', '2020-10-19 21:45:48'),
(57, 'oZiFQubOF0OGJprzeBNzog.0@notifications.google.com', 3, 'Tu cuenta de Google se ha recuperado correctamente', NULL, '2020-10-15 22:40:42', '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[{\"mailbox\":\"cdvaltovalor\",\"host\":\"gmail.com\",\"personal\":false,\"mail\":\"cdvaltovalor@gmail.com\",\"full\":\"cdvaltovalor@gmail.com\"}]', NULL, NULL, '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[]', 0, 'inbox', NULL, '<!DOCTYPE html><html lang=\"en\"><head><meta name=\"format-detection\" content=\"email=no\"/><meta name=\"format-detection\" content=\"date=no\"/><style nonce=\"srneC7wjl8un6KDZo4YfaQ\">.awl a {color: #FFFFFF; text-decoration: none;} .abml a {color: #000000; font-family: Roboto-Medium,Helvetica,Arial,sans-serif; font-weight: bold; text-decoration: none;} .adgl a {color: rgba(0, 0, 0, 0.87); text-decoration: none;} .afal a {color: #b0b0b0; text-decoration: none;} @media screen and (min-width: 600px) {.v2sp {padding: 6px 30px 0px;} .v2rsp {padding: 0px 10px;}} @media screen and (min-width: 600px) {.mdv2rw {padding: 40px 40px;}} </style><link href=\"//fonts.googleapis.com/css?family=Google+Sans\" rel=\"stylesheet\" type=\"text/css\"/></head><body style=\"margin: 0; padding: 0;\" bgcolor=\"#FFFFFF\"><table width=\"100%\" height=\"100%\" style=\"min-width: 348px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" lang=\"en\"><tr height=\"32\" style=\"height: 32px;\"><td></td></tr><tr align=\"center\"><td><div itemscope itemtype=\"//schema.org/EmailMessage\"><div itemprop=\"action\" itemscope itemtype=\"//schema.org/ViewAction\"><link itemprop=\"url\" href=\"https://accounts.google.com/AccountChooser?Email=cdvaltovalor@gmail.com&amp;continue=https://myaccount.google.com/secure-account?utm_source%3Demail%26utm_medium%3Demail%26utm_campaign%3Dph%26src%3D14%26aneid%3D8374089924596838415\"/><meta itemprop=\"name\" content=\"¡Repasemos!\"/></div></div><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"padding-bottom: 20px; max-width: 516px; min-width: 220px;\"><tr><td width=\"8\" style=\"width: 8px;\"></td><td><div style=\"border-style: solid; border-width: thin; border-color:#dadce0; border-radius: 8px; padding: 40px 20px;\" align=\"center\" class=\"mdv2rw\"><img src=\"https://www.gstatic.com/images/branding/googlelogo/2x/googlelogo_color_74x24dp.png\" width=\"74\" height=\"24\" aria-hidden=\"true\" style=\"margin-bottom: 16px;\" alt=\"Google\"><div style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom: thin solid #dadce0; color: rgba(0,0,0,0.87); line-height: 32px; padding-bottom: 24px;text-align: center; word-break: break-word;\"><div style=\"font-size: 24px;\">La cuenta se ha recuperado correctamente </div><table align=\"center\" style=\"margin-top:8px;\"><tr style=\"line-height: normal;\"><td align=\"right\" style=\"padding-right:8px;\"><img width=\"20\" height=\"20\" style=\"width: 20px; height: 20px; vertical-align: sub; border-radius: 50%;;\" src=\"https://www.gstatic.com/accountalerts/email/anonymous_profile_photo.png\" alt=\"\"></td><td><a style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.87); font-size: 14px; line-height: 20px;\">cdvaltovalor@gmail.com</a></td></tr></table> </div><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 14px; color: rgba(0,0,0,0.87); line-height: 20px;padding-top: 20px; text-align: left;\"><h3>Tu cuenta está activa de nuevo</h3>Si crees que perdiste el acceso a tu cuenta debido a cambios realizados por otra persona, te recomendamos que <a href=\"https://accounts.google.com/AccountChooser?Email=cdvaltovalor@gmail.com&amp;continue=https://myaccount.google.com/secure-account?utm_source%3Demail%26utm_medium%3Demail%26utm_campaign%3Dph%26src%3D14%26aneid%3D8374089924596838415\" style=\"text-decoration: none; color: #4285F4;\" target=\"_blank\">revises y protejas tu cuenta</a>.</div></div><div style=\"text-align: left;\"><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\"><div>Te hemos enviado este correo electrónico para informarte de cambios importantes en tu cuenta y en los servicios de Google.</div><div style=\"direction: ltr;\">&copy; 2020 Google LLC, <a class=\"afal\" style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\">1600 Amphitheatre Parkway, Mountain View, CA 94043, USA</a></div></div></div></td><td width=\"8\" style=\"width: 8px;\"></td></tr></table></td></tr><tr height=\"32\" style=\"height: 32px;\"><td></td></tr></table></body></html>', '[image: Google]\r\nLa cuenta se ha recuperado correctamente\r\n\r\n\r\ncdvaltovalor@gmail.com\r\nTu cuenta está activa de nuevoSi crees que perdiste el acceso a tu cuenta\r\ndebido a cambios realizados por otra persona, te recomendamos que revises y\r\nprotejas tu cuenta\r\n<https://accounts.google.com/AccountChooser?Email=cdvaltovalor@gmail.com&continue=https://myaccount.google.com/secure-account?utm_source%3Demail%26utm_medium%3Demail%26utm_campaign%3Dph%26src%3D14%26aneid%3D8374089924596838415>\r\n.\r\nTe hemos enviado este correo electrónico para informarte de cambios\r\nimportantes en tu cuenta y en los servicios de Google.\r\n© 2020 Google LLC, 1600 Amphitheatre Parkway, Mountain View, CA 94043, USA\r\n', 0, NULL, 10, '2020-10-19 21:45:48', '2020-10-19 21:45:48'),
(58, 'FyIyyzzR7nSCu6vX_MOOrg.0@notifications.google.com', 2, 'Ayuda a reforzar la seguridad de tu cuenta de Google', NULL, '2020-10-07 01:43:15', '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[{\"mailbox\":\"cdvaltovalor\",\"host\":\"gmail.com\",\"personal\":false,\"mail\":\"cdvaltovalor@gmail.com\",\"full\":\"cdvaltovalor@gmail.com\"}]', NULL, NULL, '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[{\"personal\":\"Google\",\"mailbox\":\"no-reply\",\"host\":\"accounts.google.com\",\"mail\":\"no-reply@accounts.google.com\",\"full\":\"Google <no-reply@accounts.google.com>\"}]', '[]', 0, 'inbox', NULL, '<!DOCTYPE html><html lang=\"en\"><head><meta name=\"format-detection\" content=\"email=no\"/><meta name=\"format-detection\" content=\"date=no\"/><style nonce=\"M+C7e20eBPTjMQrV9Y0w/g\">.awl a {color: #FFFFFF; text-decoration: none;} .abml a {color: #000000; font-family: Roboto-Medium,Helvetica,Arial,sans-serif; font-weight: bold; text-decoration: none;} .adgl a {color: rgba(0, 0, 0, 0.87); text-decoration: none;} .afal a {color: #b0b0b0; text-decoration: none;} @media screen and (min-width: 600px) {.v2sp {padding: 6px 30px 0px;} .v2rsp {padding: 0px 10px;}} @media screen and (min-width: 600px) {.mdv2rw {padding: 40px 40px;}} </style><link href=\"//fonts.googleapis.com/css?family=Google+Sans\" rel=\"stylesheet\" type=\"text/css\"/></head><body style=\"margin: 0; padding: 0;\" bgcolor=\"#FFFFFF\"><table width=\"100%\" height=\"100%\" style=\"min-width: 348px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" lang=\"en\"><tr height=\"32\" style=\"height: 32px;\"><td></td></tr><tr align=\"center\"><td><div itemscope itemtype=\"//schema.org/EmailMessage\"><div itemprop=\"action\" itemscope itemtype=\"//schema.org/ViewAction\"><link itemprop=\"url\" href=\"https://accounts.google.com/AccountChooser?Email=cdvaltovalor@gmail.com&amp;continue=https://myaccount.google.com/security-checkup?utm_source%3Dgoogle%26utm_medium%3Demail%26utm_campaign%3Dsap%26aneid%3D-2459444774288153956%26sea%3D18%26rfn%3D1602034995781%26anexp%3Dsapef-a1--saphpraf-f1--saprf-original--saprfsm-const\"/><meta itemprop=\"name\" content=\"¡Repasemos!\"/></div></div><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"padding-bottom: 20px; max-width: 516px; min-width: 220px;\"><tr><td width=\"8\" style=\"width: 8px;\"></td><td><div style=\"border-style: solid; border-width: thin; border-color:#dadce0; border-radius: 8px; padding: 40px 20px;\" align=\"center\" class=\"mdv2rw\"><img src=\"https://www.gstatic.com/images/branding/googlelogo/2x/googlelogo_color_74x24dp.png\" width=\"74\" height=\"24\" aria-hidden=\"true\" style=\"margin-bottom: 16px;\" alt=\"Google\"><div style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom: thin solid #dadce0; color: rgba(0,0,0,0.87); line-height: 32px; padding-bottom: 24px;padding-bottom: 32px;text-align: center; word-break: break-word;\"><div style=\"font-size: 24px;\"><table style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;font-size: 24px; line-height: 28px; text-align: center; width: 100%;\"><tr><td><a><img width=\"103\" height=\"90\" src=\"https://www.gstatic.com/accountalerts/email/sa_shield_yellow_161017_103x90@2.png\" style=\"width: 103px; height: 90px;\" alt=\"\"/></a></td></tr><tr><td style=\"font-family: inherit;\">Añade opciones para que podamos saber que eres tú</td></tr></table></div><table align=\"center\" style=\"margin-top:8px;\"><tr style=\"line-height: normal;\"><td align=\"right\" style=\"padding-right:8px;\"><img width=\"20\" height=\"20\" style=\"width: 20px; height: 20px; vertical-align: sub; border-radius: 50%;;\" src=\"https://www.gstatic.com/accountalerts/email/anonymous_profile_photo.png\" alt=\"\"></td><td><a style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.87); font-size: 14px; line-height: 20px;\">cdvaltovalor@gmail.com</a></td></tr></table></div><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 14px; color: rgba(0,0,0,0.87); line-height: 20px;padding-top: 20px; text-align: left;\"><table style=\"font-size: 14px; letter-spacing: 0.2; line-height: 20px; text-align: center;\"><tr><td style=\"padding-bottom: 24px; text-align: start;\">Los usuarios con más formas de demostrar su identidad tienen menos probabilidades de perder el acceso a su cuenta o de que se la&nbsp;pirateen.<div style=\"height: 13px;\"></div>Añade más formas de demostrar tu identidad y descubre otras recomendaciones de seguridad personalizadas en la <a href=\"https://accounts.google.com/AccountChooser?Email=cdvaltovalor@gmail.com&amp;continue=https://myaccount.google.com/security-checkup?utm_source%3Dgoogle%26utm_medium%3Demail%26utm_campaign%3Dsap%26aneid%3D-2459444774288153956%26sea%3D18%26rfn%3D1602034995781%26anexp%3Dsapef-a1--saphpraf-f1--saprf-original--saprfsm-const\" target=\"_blank\" link-id=\"content-main-link\">revisión de&nbsp;seguridad</a>.</td></tr><tr><td><a href=\"https://accounts.google.com/AccountChooser?Email=cdvaltovalor@gmail.com&amp;continue=https://myaccount.google.com/security-checkup?utm_source%3Dgoogle%26utm_medium%3Demail%26utm_campaign%3Dsap%26aneid%3D-2459444774288153956%26sea%3D18%26rfn%3D1602034995781%26anexp%3Dsapef-a1--saphpraf-f1--saprf-original--saprfsm-const\" target=\"_blank\" data-meta-key=\"go-to-sa\" link-id=\"main-button-link\" style=\"font-family: &#39;Google Sans&#39;,Roboto,RobotoDraft,Helvetica,Arial,sans-serif; line-height: 16px; color: #ffffff; font-weight: 400; text-decoration: none;font-size: 13px;display:inline-block;padding: 6px 24px;background-color: #4184F3; border-radius: 5px; min-width: 90px;\">Revisar la seguridad</a></td></tr><tr style=\"color: rgba(0, 0, 0, 0.54); font-size: 12px; line-height: 150%; text-align: center;\"><td style=\"padding-top: 12px\">Si lo prefieres, ve directamente a:<br><a class=\"adgl\" style=\"color: rgba(0, 0, 0, 0.87);text-decoration: inherit;\">https://myaccount.google.com/security-checkup</a></td></tr></table></div></div><div style=\"text-align: center;\"><div style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\"><div>Te hemos enviado este correo electrónico para informarte de cambios importantes en tu cuenta y en los servicios de Google.</div><div style=\"direction: ltr;\">&copy; 2020 Google LLC, <a class=\"afal\" style=\"font-family: Roboto-Regular,Helvetica,Arial,sans-serif;color: rgba(0,0,0,0.54); font-size: 11px; line-height: 18px; padding-top: 12px; text-align: center;\">1600 Amphitheatre Parkway, Mountain View, CA 94043, USA</a></div></div></div></td><td width=\"8\" style=\"width: 8px;\"></td></tr></table></td></tr><tr height=\"32\" style=\"height: 32px;\"><td></td></tr></table></body></html>', '[image: Google]\r\n\r\n\r\n\r\nAñade opciones para que podamos saber que eres tú\r\n\r\n\r\ncdvaltovalor@gmail.com\r\n\r\n\r\nLos usuarios con más formas de demostrar su identidad tienen menos\r\nprobabilidades de perder el acceso a su cuenta o de que se la pirateen.\r\nAñade más formas de demostrar tu identidad y descubre otras recomendaciones\r\nde seguridad personalizadas en la revisión de seguridad\r\n<https://accounts.google.com/AccountChooser?Email=cdvaltovalor@gmail.com&continue=https://myaccount.google.com/security-checkup?utm_source%3Dgoogle%26utm_medium%3Demail%26utm_campaign%3Dsap%26aneid%3D-2459444774288153956%26sea%3D18%26rfn%3D1602034995781%26anexp%3Dsapef-a1--saphpraf-f1--saprf-original--saprfsm-const>\r\n.\r\nRevisar la seguridad\r\n<https://accounts.google.com/AccountChooser?Email=cdvaltovalor@gmail.com&continue=https://myaccount.google.com/security-checkup?utm_source%3Dgoogle%26utm_medium%3Demail%26utm_campaign%3Dsap%26aneid%3D-2459444774288153956%26sea%3D18%26rfn%3D1602034995781%26anexp%3Dsapef-a1--saphpraf-f1--saprf-original--saprfsm-const>\r\nSi lo prefieres, ve directamente a:\r\nhttps://myaccount.google.com/security-checkup\r\nTe hemos enviado este correo electrónico para informarte de cambios\r\nimportantes en tu cuenta y en los servicios de Google.\r\n© 2020 Google LLC, 1600 Amphitheatre Parkway, Mountain View, CA 94043, USA\r\n', 0, NULL, 10, '2020-10-19 21:45:48', '2020-10-19 21:45:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `email_settings`
--

CREATE TABLE `email_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `incoming_server_host` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `incoming_server_port` int(11) NOT NULL,
  `outgoing_server_host` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `outgoing_server_port` int(11) NOT NULL,
  `protocol` enum('imap','pop3') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'imap',
  `encryption` enum('false','ssl','tls','notls','starttls') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ssl',
  `validate_cert` tinyint(1) NOT NULL DEFAULT '1',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `download_time` int(11) NOT NULL DEFAULT '10' COMMENT 'tiempo establecido para la descarga de correos cada cierto tiempo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `email_settings`
--

INSERT INTO `email_settings` (`id`, `incoming_server_host`, `incoming_server_port`, `outgoing_server_host`, `outgoing_server_port`, `protocol`, `encryption`, `validate_cert`, `name`, `email`, `username`, `password`, `user_id`, `created_at`, `updated_at`, `download_time`) VALUES
(3, 'pop.gmail.com', 995, 'smtp.gmail.com', 587, 'pop3', 'ssl', 1, 'Empresa4', 'testtristest@gmail.com', 'testtristest@gmail.com', 'eyJpdiI6IjBhU1hoazFTTEY3c05IMkg4dnZYZWc9PSIsInZhbHVlIjoiMDM2ZjllS3RyeGlkMUlZSURhUWxFZz09IiwibWFjIjoiZDRlZGNiNTJjYmI1ZDM4NDFjMzY1N2QwYjAyN2M1MTFhYjQ0NzU1ZTMzMmIwMzQzNGQwMmQ5NTk4Y2Q4N2M3YyJ9', 15, '2020-10-13 11:38:09', '2020-10-18 17:56:17', 10),
(6, 'pop.gmail.com', 995, 'smtp.gmail.com', 465, 'pop3', 'ssl', 1, 'Vendedor Test', 'testtristest@gmail.com', 'testtristest@gmail.com', 'eyJpdiI6IlVsTDZMRUdsSFo3eEhtZVVEK0Zaemc9PSIsInZhbHVlIjoiUFZvZFUyOUorTW8zbjdpcXFiU2Zzdz09IiwibWFjIjoiOWJkYjk4ZGEyOTY4OTE0ZTJjNDQyMGZiN2Y0NzdmODg5ZTA3NTRiZGZiMTY5ZWRhNTllZDlkOWYzOTY4MTJhYiJ9', 187, '2020-10-16 11:53:20', '2020-10-16 11:53:20', 10),
(10, 'imap.gmail.com', 993, 'smtp.gmail.com', 587, 'imap', 'ssl', 1, 'DAYRON', 'cdvaltovalor@gmail.com', 'cdvaltovalor@gmail.com', 'eyJpdiI6InZnelhwaFp1b1NaM2puMDJISjJjUmc9PSIsInZhbHVlIjoielQ3N0tOWWsrZmJBYWs4ZzM3UEZuQnNLdlJxVHAwQzFsQVBPMU5lTVlLdz0iLCJtYWMiOiI1M2M0NzYwNjA2NTk0MDNlZWE1MzgxN2RiMjM5YjliZTdlYmI3MDMzNjI5YmE2MDI5ZWZmMmIxNmZiNDUyM2ExIn0=', 14, '2020-10-19 21:45:47', '2020-10-19 21:45:47', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mailable` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nombre con el cual se va a identificar la plantilla',
  `module_class` text COLLATE utf8mb4_unicode_ci COMMENT 'Clase a la cual se va a asociar la plantilla',
  `module_name` text COLLATE utf8mb4_unicode_ci COMMENT 'Nombre del módulo. Ej: app (se refiere a las plantillas del núcleo de la aplicación),\n                      oportunidades, contactos',
  `type` enum('C','N','E','O') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Define el tipo de la plantilla. Ej. (C)ampaña, (N)otificación, (E)vento, (O)tro',
  `subject` text COLLATE utf8mb4_unicode_ci,
  `html_template` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_template` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `module` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `email_templates`
--

INSERT INTO `email_templates` (`id`, `mailable`, `name`, `module_class`, `module_name`, `type`, `subject`, `html_template`, `text_template`, `created_at`, `updated_at`, `module`) VALUES
(3, 'App\\Mail\\Generic', 'Plantilla genérica', NULL, NULL, 'N', 'Ventonic', '<p>{{ subject }}</p><p>{{ msg }}</p><p>Saludos, {{ fromUserName }}.</p>', '{{ subject }}\\n\\n{{ msg }}\\n\\n Saludos, {{ fromUserName }}', '2020-09-07 00:50:01', '2020-09-07 00:50:01', 'General'),
(4, 'App\\Mail\\Negotiation', 'Plantilla de negociaciones', NULL, NULL, 'N', 'Negociación', '<!doctype html><html lang=\"es\"><head><meta charset=\"UTF-8\"><meta name=\"viewport\" content=\"width=device-width, user-scalable=no, initial-scale=1.0\"><title>Negociación con {{ fromUserName }}</title></head><body><p>{{ subject }}</p><p>{{ msg }}</p><p>Saludos, {{ fromUserName }}.</p></body></html>', NULL, '2020-09-07 00:50:01', '2020-09-07 00:50:01', 'Negociaciones'),
(5, 'App\\Mail\\NuevaInvitacionRecibida', 'Plantilla de invitaciones a grupos recibida', NULL, NULL, 'N', 'Invitación a grupo', '<!doctype html><html lang=\"es\"><head><meta charset=\"UTF-8\"><meta name=\"viewport\" content=\"width=device-width, user-scalable=no, initial-scale=1.0\"><title>Nueva Invitación de grupo</title></head><body><p>Hola! Has sido invitado a unirte al grupo {{ name_group }}</p><p>Si deseas unirte ve a la siguiente url para <a class=\"text-primary\" href=\"{{ url(env(\"APP_URL\").\"/registro\") }}\">\n                                                    registrarte\n                                                </a>en nuestra plataforma! Una vez registrado encontrarás la invitación en tu perfil.</p><p>Saludos, Equipo Ventonic.</p></body></html>', NULL, '2020-09-07 00:50:01', '2020-09-07 00:50:01', 'Grupos'),
(6, 'App\\Mail\\GroupInvitation', 'Plantilla de nueva invitaciones a grupos enviadas', NULL, NULL, 'N', 'Nueva invitación recibida', '<!doctype html><html lang=\"es\"><head><meta charset=\"UTF-8\"><meta name=\"viewport\" content=\"width=device-width, user-scalable=no, initial-scale=1.0\"><title>Nueva Invitación de grupo</title></head><body><p>¡Hola {{ name }}! Ha sido invitado a unirse al grupo {{ groupName }}</p><p>Si desea unirse haga click en <a href=\"{{ url }}\">este enlace</a> para registrarse en nuestra plataforma. Una vez registrado encontrarás la invitación en tu perfil.</p></body></html>', NULL, '2020-09-07 00:50:01', '2020-09-07 00:50:01', 'Grupos'),
(7, 'App\\Mail\\Auth\\VerifyEmail', 'Plantilla para la verificación de correo', NULL, NULL, 'N', 'Verificar dirección de correo', '<!doctype html><html lang=\"es\"><head><meta charset=\"UTF-8\"><meta name=\"viewport\" content=\"width=device-width, user-scalable=no, initial-scale=1.0\"><title>Verificar dirección de correo</title></head><body><p>¡Hola {{ name }}!</p><p>Haga clic en el siguiente botón para verificar su dirección de correo electrónico.</p><p><a href=\"{{ url }}\" style=\"margin:0 auto\">Verificar dirección de correo</a></p><p>Si tiene problemas para hacer clic en el botón \"Verificar dirección de correo\", copie y pegue la URL a continuación en su navegador web:<br><a href=\"{{ url }}\" target=\"_blank\">{{ url }}</a></p><p>Si no ha creado una cuenta, no se requiere ninguna otra acción.</p></body></html>', NULL, '2020-09-07 00:50:01', '2020-09-07 00:50:01', 'Acceso'),
(8, 'App\\Mail\\Auth\\WelcomeEmail', 'Plantilla de bienvenida a la aplicación', NULL, NULL, 'N', 'Bienvenido a {{ appName }}', '<!doctype html><html lang=\"es\"><head><meta charset=\"UTF-8\"><meta name=\"viewport\" content=\"width=device-width, user-scalable=no, initial-scale=1.0\"><title>Bienvenida</title></head><body><p>¡Bienvenido(a) {{ userName }}!, has sido verificado correctamente en nuestro sistema.</p><p>Ya puede hacer uso de todas las funcionalidades.</p><p>¡Gracias por usar nuestra aplicación!</p><p>Este correo es enviado de manera automática por la aplicación y no está siendo monitoreado. Por favor, no responda a este correo.</p></body></html>', NULL, '2020-09-07 00:50:01', '2020-09-07 00:50:01', 'Acceso'),
(9, 'App\\Mail\\Auth\\ResetPasswordEmail', 'Plantilla de reinicio de contraseña', NULL, NULL, 'N', 'Notificación de restablecimiento de contraseña', '<!doctype html><html lang=\"es\"><head><meta charset=\"UTF-8\"><meta name=\"viewport\" content=\"width=device-width, user-scalable=no, initial-scale=1.0\"><title>Notificación de restablecimiento de contraseña</title></head><body><p>Recibió este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta.</p><p><a href=\"{{ url }}\" target=\"_blank\">Restablecer la contraseña</a></p><p>Este enlace de restablecimiento de contraseña caducará en  {{ count }} minutos.</p><p>¡Gracias por usar nuestra aplicación!</p><p>Este correo es enviado de manera automática por la aplicación y no está siendo monitoreado. Por favor, no responda a este correo.</p></body></html>', NULL, '2020-09-07 00:50:01', '2020-09-07 00:50:01', 'Acceso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Título del evento',
  `start_at` datetime NOT NULL COMMENT 'fecha de inicio del evento',
  `end_at` datetime NOT NULL COMMENT 'fecha final del evento',
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nota o descripción del evento',
  `private` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category` enum('B','W','P','O') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'O' COMMENT 'categoría del evento. (B)usiness, (W)ork, (P)ersonal, (O)thers',
  `place` text COLLATE utf8mb4_unicode_ci COMMENT 'Lugar del evento',
  `eventable_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eventable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `external_key` text COLLATE utf8mb4_unicode_ci COMMENT 'Identificador de eventos asociados a un calendario externo',
  `external_calendar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'texto que identifica al calendario externos. Ej. gCalendar, iCal, outlook, etc'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `events`
--

INSERT INTO `events` (`id`, `title`, `start_at`, `end_at`, `notes`, `private`, `user_id`, `created_at`, `updated_at`, `category`, `place`, `eventable_type`, `eventable_id`, `external_key`, `external_calendar`) VALUES
(1017, 'Evento Hola 01', '2020-10-14 10:30:00', '2020-10-14 11:30:00', 'Hola 01 - hoy', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 13, '6uein1ft82dbukpdvhg3d3n2o3', 'gCalendar'),
(1018, 'Tarea S19, Calendario 02', '2020-09-19 00:00:00', '2020-09-19 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 14, '5qdut5s5sh27buf96i181i1213', 'gCalendar'),
(1019, 'Año Nuevo', '2019-01-01 00:00:00', '2019-01-01 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190101_60o30cr474o30c1g60o30dr56c', 'gCalendar'),
(1020, 'Epifanía del Señor', '2019-01-06 00:00:00', '2019-01-06 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190106_60o30cr4c4o30c1g60o30dr56c', 'gCalendar'),
(1021, 'Miércoles de Ceniza', '2019-03-06 00:00:00', '2019-03-06 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190306_60o30e9k6so30c1g60o30dr56c', 'gCalendar'),
(1022, 'Cambio de Horario de Verano', '2019-03-31 00:00:00', '2019-03-31 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190331_60o30c9o60o30dpj6oqj0dr56c', 'gCalendar'),
(1023, 'Domingo de Ramos', '2019-04-14 00:00:00', '2019-04-14 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190414_60o30e9k70o30c1g60o30dr56c', 'gCalendar'),
(1024, 'Viernes Santo', '2019-04-19 00:00:00', '2019-04-19 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190419_60o30cr4cco30c1g60o30dr56c', 'gCalendar'),
(1025, 'Domingo de Pascua', '2019-04-21 00:00:00', '2019-04-21 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190421_60o32e1n6ko30c1g60o30dr56c', 'gCalendar'),
(1026, 'Día del trabajador', '2019-05-01 00:00:00', '2019-05-01 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190501_60o30cr4cgo30c1g60o30dr56c', 'gCalendar'),
(1027, 'El Dia de la Madre', '2019-05-05 00:00:00', '2019-05-05 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190505_60o30or16go30e1g60o30dr56c', 'gCalendar'),
(1028, 'Domingo de Pentecostés', '2019-06-09 00:00:00', '2019-06-09 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190609_60o30e9k74o30c1g60o30dr56c', 'gCalendar'),
(1029, 'La Asunción de la Virgen', '2019-08-15 00:00:00', '2019-08-15 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190815_60o30cr574o30c1g60o30dr56c', 'gCalendar'),
(1030, 'Día de la Hispanidad', '2019-10-12 00:00:00', '2019-10-12 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20191012_60o30cr4coo30c1g60o30dr56c', 'gCalendar'),
(1031, 'Cambio de horario de invierno', '2019-10-27 00:00:00', '2019-10-27 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20191027_60o30c9o64o30dpj6oqj0dr56c', 'gCalendar'),
(1032, 'La Inmaculada Concepción', '2019-12-08 00:00:00', '2019-12-08 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20191208_60o30cr56co30c1g60o30dr56c', 'gCalendar'),
(1033, 'Nochebuena', '2019-12-24 00:00:00', '2019-12-24 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20191224_60o30e9kc4o30c1g60o30dr56c', 'gCalendar'),
(1034, 'Navidad', '2019-12-25 00:00:00', '2019-12-25 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20191225_60o30cr56ko30c1g60o30dr56c', 'gCalendar'),
(1035, 'Día de la Sagrada Familia', '2019-12-29 00:00:00', '2019-12-29 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20191229_60o30e9k6oo30c1g60o30dr56c', 'gCalendar'),
(1036, 'Nochevieja', '2019-12-31 00:00:00', '2019-12-31 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20191231_60o30e9kc8o30c1g60o30dr56c', 'gCalendar'),
(1037, 'Año Nuevo', '2020-01-01 00:00:00', '2020-01-01 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200101_60o30cr474o30c1g60o30dr56g', 'gCalendar'),
(1038, 'Epifanía del Señor', '2020-01-06 00:00:00', '2020-01-06 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200106_60o30cr4c4o30c1g60o30dr56g', 'gCalendar'),
(1039, 'Cambio de Horario de Verano', '2020-03-29 00:00:00', '2020-03-29 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200329_60o30c9o60o30dpj6oqj0dr56g', 'gCalendar'),
(1040, 'Domingo de Ramos', '2020-04-05 00:00:00', '2020-04-05 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200405_60o30e9k70o30c1g60o30dr56g', 'gCalendar'),
(1041, 'Viernes Santo', '2020-04-10 00:00:00', '2020-04-10 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200410_60o30cr4cco30c1g60o30dr56g', 'gCalendar'),
(1042, 'Domingo de Pascua', '2020-04-12 00:00:00', '2020-04-12 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200412_60o32e1n6ko30c1g60o30dr56g', 'gCalendar'),
(1043, 'Día del trabajador', '2020-05-01 00:00:00', '2020-05-01 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200501_60o30cr4cgo30c1g60o30dr56g', 'gCalendar'),
(1044, 'El Dia de la Madre', '2020-05-03 00:00:00', '2020-05-03 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200503_60o30or16go30e1g60o30dr56g', 'gCalendar'),
(1045, 'Domingo de Pentecostés', '2020-05-31 00:00:00', '2020-05-31 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200531_60o30e9k74o30c1g60o30dr56g', 'gCalendar'),
(1046, 'La Asunción de la Virgen', '2020-08-15 00:00:00', '2020-08-15 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200815_60o30cr574o30c1g60o30dr56g', 'gCalendar'),
(1047, 'Día de la Hispanidad', '2020-10-12 00:00:00', '2020-10-12 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20201012_60o30cr4coo30c1g60o30dr56g', 'gCalendar'),
(1048, 'Cambio de horario de invierno', '2020-10-25 00:00:00', '2020-10-25 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20201025_60o30c9o64o30dpj6oqj0dr56g', 'gCalendar'),
(1049, 'La Inmaculada Concepción', '2020-12-08 00:00:00', '2020-12-08 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20201208_60o30cr56co30c1g60o30dr56g', 'gCalendar'),
(1050, 'Nochebuena', '2020-12-24 00:00:00', '2020-12-24 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20201224_60o30e9kc4o30c1g60o30dr56g', 'gCalendar'),
(1051, 'Navidad', '2020-12-25 00:00:00', '2020-12-25 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20201225_60o30cr56ko30c1g60o30dr56g', 'gCalendar'),
(1052, 'Día de la Sagrada Familia', '2020-12-27 00:00:00', '2020-12-27 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20201227_60o30e9k6oo30c1g60o30dr56g', 'gCalendar'),
(1053, 'Nochevieja', '2020-12-31 00:00:00', '2020-12-31 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20201231_60o30e9kc8o30c1g60o30dr56g', 'gCalendar'),
(1054, 'Año Nuevo', '2021-01-01 00:00:00', '2021-01-01 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210101_60o30cr474o30c1g60o30dr56k', 'gCalendar'),
(1055, 'Epifanía del Señor', '2021-01-06 00:00:00', '2021-01-06 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210106_60o30cr4c4o30c1g60o30dr56k', 'gCalendar'),
(1056, 'Miércoles de Ceniza', '2021-02-17 00:00:00', '2021-02-17 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210217_60o30e9k6so30c1g60o30dr56k', 'gCalendar'),
(1057, 'Cambio de Horario de Verano', '2021-03-28 00:00:00', '2021-03-28 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210328_60o30c9o60o30dpj6oqj0dr56k', 'gCalendar'),
(1058, 'Domingo de Ramos', '2021-03-28 00:00:00', '2021-03-28 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210328_60o30e9k70o30c1g60o30dr56k', 'gCalendar'),
(1059, 'Viernes Santo', '2021-04-02 00:00:00', '2021-04-02 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210402_60o30cr4cco30c1g60o30dr56k', 'gCalendar'),
(1060, 'Domingo de Pascua', '2021-04-04 00:00:00', '2021-04-04 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210404_60o32e1n6ko30c1g60o30dr56k', 'gCalendar'),
(1061, 'Día del trabajador', '2021-05-01 00:00:00', '2021-05-01 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210501_60o30cr4cgo30c1g60o30dr56k', 'gCalendar'),
(1062, 'El Dia de la Madre', '2021-05-02 00:00:00', '2021-05-02 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210502_60o30or16go30e1g60o30dr56k', 'gCalendar'),
(1063, 'Domingo de Pentecostés', '2021-05-23 00:00:00', '2021-05-23 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210523_60o30e9k74o30c1g60o30dr56k', 'gCalendar'),
(1064, 'La Asunción de la Virgen', '2021-08-15 00:00:00', '2021-08-15 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210815_60o30cr574o30c1g60o30dr56k', 'gCalendar'),
(1065, 'al trasladar el descanso laboral del 15 de agosto', '2021-08-16 00:00:00', '2021-08-16 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210816_60o30cr5c4o30c1g60o30dr56k', 'gCalendar'),
(1066, 'Día de la Hispanidad', '2021-10-12 00:00:00', '2021-10-12 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20211012_60o30cr4coo30c1g60o30dr56k', 'gCalendar'),
(1067, 'Cambio de horario de invierno', '2021-10-31 00:00:00', '2021-10-31 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20211031_60o30c9o64o30dpj6oqj0dr56k', 'gCalendar'),
(1068, 'La Inmaculada Concepción', '2021-12-08 00:00:00', '2021-12-08 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20211208_60o30cr56co30c1g60o30dr56k', 'gCalendar'),
(1069, 'Nochebuena', '2021-12-24 00:00:00', '2021-12-24 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20211224_60o30e9kc4o30c1g60o30dr56k', 'gCalendar'),
(1070, 'Navidad', '2021-12-25 00:00:00', '2021-12-25 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20211225_60o30cr56ko30c1g60o30dr56k', 'gCalendar'),
(1071, 'Día de la Sagrada Familia', '2021-12-26 00:00:00', '2021-12-26 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20211226_60o30e9k6oo30c1g60o30dr56k', 'gCalendar'),
(1072, 'Nochevieja', '2021-12-31 00:00:00', '2021-12-31 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20211231_60o30e9kc8o30c1g60o30dr56k', 'gCalendar'),
(1073, 'Virgen de la Victoria (Melilla)', '2019-09-08 00:00:00', '2019-09-08 23:59:59', 'Festivo o celebración en: Melilla', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190908_60o30cr6c4o30c1g60o30dr56c', 'gCalendar'),
(1074, 'Nuestra Señora de la Bien Aparecida (Cantabria)', '2019-09-15 00:00:00', '2019-09-15 23:59:59', 'Festivo o celebración en: Cantabria', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190915_60o30cr6coo30c1g60o30dr56c', 'gCalendar'),
(1075, 'Día de Melilla (Melilla)', '2019-09-17 00:00:00', '2019-09-17 23:59:59', 'Festivo o celebración en: Melilla', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190917_60o30cr6c8o30c1g60o30dr56c', 'gCalendar'),
(1076, 'Dia de San Isidro (Madrid)', '2020-05-15 00:00:00', '2020-05-15 23:59:59', 'Festivo o celebración en: Madrid', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200515_60o30ob360o30c1g60o30dr56g', 'gCalendar'),
(1077, 'Día de la Ciudad Autónoma de Ceuta (Ceuta)', '2020-09-02 00:00:00', '2020-09-02 23:59:59', 'Festivo o celebración en: Ceuta', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200902_60o30cr66ko30c1g60o30dr56g', 'gCalendar'),
(1078, 'Día de Navarra (Navarra)', '2020-12-03 00:00:00', '2020-12-03 23:59:59', 'Festivo o celebración en: Navarra', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20201203_60o30cr6cco30c1g60o30dr56g', 'gCalendar'),
(1079, 'Dia de las Islas Baleares (Baleares)', '2021-03-01 00:00:00', '2021-03-01 23:59:59', 'Festivo o celebración en: Baleares', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210301_60o30d1g6ko30c1g60o30dr56k', 'gCalendar'),
(1080, 'Dia de San Isidro (Madrid)', '2021-05-15 00:00:00', '2021-05-15 23:59:59', 'Festivo o celebración en: Madrid', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210515_60o30ob360o30c1g60o30dr56k', 'gCalendar'),
(1081, 'Día Nacional de Cataluña (Cataluña)', '2021-09-11 00:00:00', '2021-09-11 23:59:59', 'Festivo o celebración en: Cataluña', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210911_60o30cr6cko30c1g60o30dr56k', 'gCalendar'),
(1082, 'Lunes siguiente a la Epifanía del Señor (festivo regional)', '2019-01-07 00:00:00', '2019-01-07 23:59:59', 'Festivo o celebración en: Andalucía, Aragón, Asturias, Canarias, Castilla y León, Extremadura, Murcia, Navarra, Ceuta, Madrid, Melilla', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190107_60o30cr4c8o30c1g60o30dr56c', 'gCalendar'),
(1083, 'El día de San Valero (Zaragoza)', '2019-01-29 00:00:00', '2019-01-29 23:59:59', 'Festivo o celebración en: Zaragoza', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190129_60o32d9h68o30c1g60o30dr56c', 'gCalendar'),
(1084, 'Día de Andalucía (Andalucía)', '2019-02-28 00:00:00', '2019-02-28 23:59:59', 'Festivo o celebración en: Andalucía', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190228_60o30cr5c8o30c1g60o30dr56c', 'gCalendar'),
(1085, 'Día de Castilla y León (Castilla y León)', '2019-04-23 00:00:00', '2019-04-23 23:59:59', 'Festivo o celebración en: Castilla y León', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190423_60o30or16co30c1g60o30dr56c', 'gCalendar'),
(1086, 'Día de Nuestra Señora de África (Ceuta)', '2019-08-05 00:00:00', '2019-08-05 23:59:59', 'Festivo o celebración en: Ceuta', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190805_60o30cr66go30c1g60o30dr56c', 'gCalendar'),
(1087, 'Día de Asturias (Asturias)', '2019-09-08 00:00:00', '2019-09-08 23:59:59', 'Festivo o celebración en: Asturias', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190908_60o30cr66oo30c1g60o30dr56c', 'gCalendar'),
(1088, 'Día Nacional de Cataluña (Cataluña)', '2019-09-11 00:00:00', '2019-09-11 23:59:59', 'Festivo o celebración en: Cataluña', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190911_60o30cr6cko30c1g60o30dr56c', 'gCalendar'),
(1089, 'Día de Castilla y León (Castilla y León)', '2020-04-23 00:00:00', '2020-04-23 23:59:59', 'Festivo o celebración en: Castilla y León', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200423_60o30or16co30c1g60o30dr56g', 'gCalendar'),
(1090, 'Día de la Communidad Madrid (Madrid)', '2020-05-02 00:00:00', '2020-05-02 23:59:59', 'Festivo o celebración en: Madrid', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200502_60o30d1g74o30c1g60o30dr56g', 'gCalendar'),
(1091, 'Día de las Letras Gallegas (Galicia)', '2021-05-17 00:00:00', '2021-05-17 23:59:59', 'Festivo o celebración en: Galicia', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210517_60o30cr6cgo30c1g60o30dr56k', 'gCalendar'),
(1092, 'San Jorge. Día de Aragón (Aragón)', '2019-04-23 00:00:00', '2019-04-23 23:59:59', 'Festivo o celebración en: Aragón', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190423_60o30cr5cco30c1g60o30dr56c', 'gCalendar'),
(1093, 'Día de la Communidad Madrid (Madrid)', '2019-05-02 00:00:00', '2019-05-02 23:59:59', 'Festivo o celebración en: Madrid', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190502_60o30d1g74o30c1g60o30dr56c', 'gCalendar'),
(1094, 'Día de Extremadura (Extremadura)', '2019-09-08 00:00:00', '2019-09-08 23:59:59', 'Festivo o celebración en: Extremadura', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190908_60o30cr670o30c1g60o30dr56c', 'gCalendar'),
(1095, 'Virgen de la Victoria Observado (Melilla)', '2019-09-09 00:00:00', '2019-09-09 23:59:59', 'Festivo o celebración en: Melilla', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190909_60o30cr6c4o30e1g60o30dr56c', 'gCalendar'),
(1096, 'Día de Navarra (Navarra)', '2019-12-03 00:00:00', '2019-12-03 23:59:59', 'Festivo o celebración en: Navarra', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20191203_60o30cr6cco30c1g60o30dr56c', 'gCalendar'),
(1097, 'El día de San Valero (Zaragoza)', '2020-01-29 00:00:00', '2020-01-29 23:59:59', 'Festivo o celebración en: Zaragoza', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200129_60o32d9h68o30c1g60o30dr56g', 'gCalendar'),
(1098, 'Día Nacional de Cataluña (Cataluña)', '2020-09-11 00:00:00', '2020-09-11 23:59:59', 'Festivo o celebración en: Cataluña', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200911_60o30cr6cko30c1g60o30dr56g', 'gCalendar'),
(1099, 'Día de la Comunidad Valenciana (Valenciana)', '2020-10-09 00:00:00', '2020-10-09 23:59:59', 'Festivo o celebración en: Valenciana', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20201009_60o30d1g60o30c1g60o30dr56g', 'gCalendar'),
(1100, 'Día de Castilla y León (Castilla y León)', '2021-04-23 00:00:00', '2021-04-23 23:59:59', 'Festivo o celebración en: Castilla y León', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210423_60o30or16co30c1g60o30dr56k', 'gCalendar'),
(1101, 'Día de la Región de Castilla-La Mancha (Castilla-La Mancha)', '2021-05-31 00:00:00', '2021-05-31 23:59:59', 'Festivo o celebración en: Castilla-La Mancha', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210531_60o30d1g70o30c1g60o30dr56k', 'gCalendar'),
(1102, 'Día de la Región de Castilla-La Mancha (Castilla-La Mancha)', '2019-05-31 00:00:00', '2019-05-31 23:59:59', 'Festivo o celebración en: Castilla-La Mancha', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190531_60o30d1g70o30c1g60o30dr56c', 'gCalendar'),
(1103, 'Cincomarzada (Zaragoza)', '2021-03-05 00:00:00', '2021-03-05 23:59:59', 'Festivo o celebración en: Zaragoza', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210305_60o32d9h6co30c1g60o30dr56k', 'gCalendar'),
(1104, 'San Antonio (Ceuta)', '2021-06-13 00:00:00', '2021-06-13 23:59:59', 'Festivo o celebración en: Ceuta', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210613_60o30cr66co30c1g60o30dr56k', 'gCalendar'),
(1105, 'Día de las Instituciones (Cantabria)', '2021-07-28 00:00:00', '2021-07-28 23:59:59', 'Festivo o celebración en: Cantabria', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210728_60o30cr5cko30c1g60o30dr56k', 'gCalendar'),
(1106, 'Día de la Comunidad Valenciana (Valenciana)', '2021-10-09 00:00:00', '2021-10-09 23:59:59', 'Festivo o celebración en: Valenciana', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20211009_60o30d1g60o30c1g60o30dr56k', 'gCalendar'),
(1107, 'Lunes siguiente a la Día de Extremadura (Extremadura)', '2019-09-09 00:00:00', '2019-09-09 23:59:59', 'Festivo o celebración en: Extremadura', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190909_60o30cr674o30c1g60o30dr56c', 'gCalendar'),
(1108, 'Día de Andalucía (Andalucía)', '2020-02-28 00:00:00', '2020-02-28 23:59:59', 'Festivo o celebración en: Andalucía', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200228_60o30cr5c8o30c1g60o30dr56g', 'gCalendar'),
(1109, 'Cincomarzada (Zaragoza)', '2020-03-05 00:00:00', '2020-03-05 23:59:59', 'Festivo o celebración en: Zaragoza', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200305_60o32d9h6co30c1g60o30dr56g', 'gCalendar'),
(1110, 'Festividad del Día de Canarias (Canarias)', '2020-05-30 00:00:00', '2020-05-30 23:59:59', 'Festivo o celebración en: Canarias', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200530_60o30d1g6oo30c1g60o30dr56g', 'gCalendar'),
(1111, 'Día de las Instituciones (Cantabria)', '2020-07-28 00:00:00', '2020-07-28 23:59:59', 'Festivo o celebración en: Cantabria', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200728_60o30cr5cko30c1g60o30dr56g', 'gCalendar'),
(1112, 'Virgen de la Victoria (Melilla)', '2020-09-08 00:00:00', '2020-09-08 23:59:59', 'Festivo o celebración en: Melilla', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200908_60o30cr6c4o30c1g60o30dr56g', 'gCalendar'),
(1113, 'El día de San Valero (Zaragoza)', '2021-01-29 00:00:00', '2021-01-29 23:59:59', 'Festivo o celebración en: Zaragoza', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210129_60o32d9h68o30c1g60o30dr56k', 'gCalendar'),
(1114, 'Festividad del Día de Canarias (Canarias)', '2021-05-30 00:00:00', '2021-05-30 23:59:59', 'Festivo o celebración en: Canarias', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210530_60o30d1g6oo30c1g60o30dr56k', 'gCalendar'),
(1115, 'Día de Extremadura (Extremadura)', '2021-09-08 00:00:00', '2021-09-08 23:59:59', 'Festivo o celebración en: Extremadura', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210908_60o30cr670o30c1g60o30dr56k', 'gCalendar'),
(1116, 'Día de Melilla (Melilla)', '2021-09-17 00:00:00', '2021-09-17 23:59:59', 'Festivo o celebración en: Melilla', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210917_60o30cr6c8o30c1g60o30dr56k', 'gCalendar'),
(1117, 'Día de Navarra (Navarra)', '2021-12-03 00:00:00', '2021-12-03 23:59:59', 'Festivo o celebración en: Navarra', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20211203_60o30cr6cco30c1g60o30dr56k', 'gCalendar'),
(1118, 'San Antonio (Ceuta)', '2019-06-13 00:00:00', '2019-06-13 23:59:59', 'Festivo o celebración en: Ceuta', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190613_60o30cr66co30c1g60o30dr56c', 'gCalendar'),
(1119, 'Día de la Toma (Granada)', '2020-01-02 00:00:00', '2020-01-02 23:59:59', 'Festivo o celebración en: Granada', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200102_60o32e356go30c1g60o30dr56g', 'gCalendar'),
(1120, 'Día de la Región de Murcia (Murcia)', '2020-06-09 00:00:00', '2020-06-09 23:59:59', 'Festivo o celebración en: Murcia', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200609_60o30cr5coo30c1g60o30dr56g', 'gCalendar'),
(1121, 'Día de la Toma (Granada)', '2021-01-02 00:00:00', '2021-01-02 23:59:59', 'Festivo o celebración en: Granada', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210102_60o32e356go30c1g60o30dr56k', 'gCalendar'),
(1122, 'San Jorge. Día de Aragón (Aragón)', '2021-04-23 00:00:00', '2021-04-23 23:59:59', 'Festivo o celebración en: Aragón', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210423_60o30cr5cco30c1g60o30dr56k', 'gCalendar'),
(1123, 'Día de la Ciudad Autónoma de Ceuta (Ceuta)', '2021-09-02 00:00:00', '2021-09-02 23:59:59', 'Festivo o celebración en: Ceuta', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210902_60o30cr66ko30c1g60o30dr56k', 'gCalendar'),
(1124, 'Virgen de la Victoria (Melilla)', '2021-09-08 00:00:00', '2021-09-08 23:59:59', 'Festivo o celebración en: Melilla', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210908_60o30cr6c4o30c1g60o30dr56k', 'gCalendar'),
(1125, 'Nuestra Señora de la Bien Aparecida (Cantabria)', '2021-09-15 00:00:00', '2021-09-15 23:59:59', 'Festivo o celebración en: Cantabria', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210915_60o30cr6coo30c1g60o30dr56k', 'gCalendar'),
(1126, 'Lunes posterior a la Segunda Fiesta de Navidad (Baleares)', '2021-12-27 00:00:00', '2021-12-27 23:59:59', 'Festivo o celebración en: Baleares', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20211227_60o30cr56oo32c1g60o30dr56k', 'gCalendar'),
(1127, 'Día de la Toma (Granada)', '2019-01-02 00:00:00', '2019-01-02 23:59:59', 'Festivo o celebración en: Granada', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190102_60o32e356go30c1g60o30dr56c', 'gCalendar'),
(1128, 'Dia de San Isidro (Madrid)', '2019-05-15 00:00:00', '2019-05-15 23:59:59', 'Festivo o celebración en: Madrid', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190515_60o30ob360o30c1g60o30dr56c', 'gCalendar'),
(1129, 'Día de la Ciudad Autónoma de Ceuta (Ceuta)', '2019-09-02 00:00:00', '2019-09-02 23:59:59', 'Festivo o celebración en: Ceuta', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190902_60o30cr66ko30c1g60o30dr56c', 'gCalendar'),
(1130, 'Lunes siguiente a la Día de Asturias (Asturias)', '2019-09-09 00:00:00', '2019-09-09 23:59:59', 'Festivo o celebración en: Asturias', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190909_60o30cr66so30c1g60o30dr56c', 'gCalendar'),
(1131, 'Día de Extremadura (Extremadura)', '2020-09-08 00:00:00', '2020-09-08 23:59:59', 'Festivo o celebración en: Extremadura', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200908_60o30cr670o30c1g60o30dr56g', 'gCalendar'),
(1132, 'Nuestra Señora de la Bien Aparecida (Cantabria)', '2020-09-15 00:00:00', '2020-09-15 23:59:59', 'Festivo o celebración en: Cantabria', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200915_60o30cr6coo30c1g60o30dr56g', 'gCalendar'),
(1133, 'Día de Melilla (Melilla)', '2020-09-17 00:00:00', '2020-09-17 23:59:59', 'Festivo o celebración en: Melilla', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200917_60o30cr6c8o30c1g60o30dr56g', 'gCalendar'),
(1134, 'Día de Andalucía (Andalucía)', '2021-02-28 00:00:00', '2021-02-28 23:59:59', 'Festivo o celebración en: Andalucía', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210228_60o30cr5c8o30c1g60o30dr56k', 'gCalendar'),
(1135, 'Día de la Communidad Madrid (Madrid)', '2021-05-03 00:00:00', '2021-05-03 23:59:59', 'Festivo o celebración en: Madrid', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210503_60o30d1g74o30e1g60o30dr56k', 'gCalendar'),
(1136, 'Día de la Región de Murcia (Murcia)', '2021-06-09 00:00:00', '2021-06-09 23:59:59', 'Festivo o celebración en: Murcia', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210609_60o30cr5coo30c1g60o30dr56k', 'gCalendar'),
(1137, 'Día de la Rioja (La Rioja)', '2021-06-09 00:00:00', '2021-06-09 23:59:59', 'Festivo o celebración en: La Rioja', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210609_60o30cr664o30c1g60o30dr56k', 'gCalendar'),
(1138, 'Cincomarzada (Zaragoza)', '2019-03-05 00:00:00', '2019-03-05 23:59:59', 'Festivo o celebración en: Zaragoza', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190305_60o32d9h6co30c1g60o30dr56c', 'gCalendar'),
(1139, 'Día de las Letras Gallegas (Galicia)', '2019-05-17 00:00:00', '2019-05-17 23:59:59', 'Festivo o celebración en: Galicia', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190517_60o30cr6cgo30c1g60o30dr56c', 'gCalendar'),
(1140, 'Día de la Comunidad Valenciana (Valenciana)', '2019-10-09 00:00:00', '2019-10-09 23:59:59', 'Festivo o celebración en: Valenciana', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20191009_60o30d1g60o30c1g60o30dr56c', 'gCalendar'),
(1141, 'Lunes siguiente a La Inmaculada Concepción (festivo regional)', '2019-12-09 00:00:00', '2019-12-09 23:59:59', 'Festivo o celebración en: Andalucía, Aragón, Asturias, Cantabria, Castilla y León, Extremadura, Madrid, La Rioja, Melilla', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20191209_60o30cr56go32c1g60o30dr56c', 'gCalendar'),
(1142, 'San Jorge. Día de Aragón (Aragón)', '2020-04-23 00:00:00', '2020-04-23 23:59:59', 'Festivo o celebración en: Aragón', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200423_60o30cr5cco30c1g60o30dr56g', 'gCalendar'),
(1143, 'Día de Nuestra Señora de África (Ceuta)', '2021-08-05 00:00:00', '2021-08-05 23:59:59', 'Festivo o celebración en: Ceuta', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210805_60o30cr66go30c1g60o30dr56k', 'gCalendar'),
(1144, 'Día de la Rioja (La Rioja)', '2020-06-09 00:00:00', '2020-06-09 23:59:59', 'Festivo o celebración en: La Rioja', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200609_60o30cr664o30c1g60o30dr56g', 'gCalendar'),
(1145, 'Día de Asturias (Asturias)', '2020-09-08 00:00:00', '2020-09-08 23:59:59', 'Festivo o celebración en: Asturias', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200908_60o30cr66oo30c1g60o30dr56g', 'gCalendar'),
(1146, 'Día de Asturias (Asturias)', '2021-09-08 00:00:00', '2021-09-08 23:59:59', 'Festivo o celebración en: Asturias', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210908_60o30cr66oo30c1g60o30dr56k', 'gCalendar'),
(1147, 'Día de San Valentín', '2019-02-14 00:00:00', '2019-02-14 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190214_60o32eb16go30c1g60o30dr56c', 'gCalendar'),
(1148, 'Día de San Valentín', '2020-02-14 00:00:00', '2020-02-14 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20200214_60o32eb16go30c1g60o30dr56g', 'gCalendar'),
(1149, 'Día de San Valentín', '2021-02-14 00:00:00', '2021-02-14 23:59:59', '', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20210214_60o32eb16go30c1g60o30dr56k', 'gCalendar'),
(1150, 'Día de la Región de Murcia (Murcia)', '2019-06-09 00:00:00', '2019-06-09 23:59:59', 'Festivo o celebración en: Murcia', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190609_60o30cr5coo30c1g60o30dr56c', 'gCalendar'),
(1151, 'Día de la Rioja (La Rioja)', '2019-06-09 00:00:00', '2019-06-09 23:59:59', 'Festivo o celebración en: La Rioja', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190609_60o30cr664o30c1g60o30dr56c', 'gCalendar'),
(1152, 'descanso laboral correspondiente a Día de la Región de Murcia (Murcia)', '2019-06-10 00:00:00', '2019-06-10 23:59:59', 'Festivo o celebración en: Murcia', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190610_60o30cr5coo30e1g60o30dr56c', 'gCalendar'),
(1153, 'descanso laboral correspondiente a Día de la Rioja (La Rioja)', '2019-06-10 00:00:00', '2019-06-10 23:59:59', 'Festivo o celebración en: La Rioja', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190610_60o30cr664o30e1g60o30dr56c', 'gCalendar'),
(1154, 'Lunes de Pentecostés (festivo regional)', '2019-06-10 00:00:00', '2019-06-10 23:59:59', 'Festivo o celebración en: Barcelona, Gerona', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190610_60o30cr570o30c1g60o30dr56c', 'gCalendar'),
(1155, 'Corpus Christi (festivo regional)', '2019-06-20 00:00:00', '2019-06-20 23:59:59', 'Festivo o celebración en: Castilla-La Mancha, Granada', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190620_60o30ob2coo36c1g60o30dr56c', 'gCalendar'),
(1156, 'Sant Magí (Tarragona)', '2019-08-19 00:00:00', '2019-08-19 23:59:59', 'Festivo o celebración en: Tarragona', 1, 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42', 'O', NULL, 'App\\GoogleCalendar', 16, '20190819_60o32ob26go32c1g60o30dr56c', 'gCalendar'),
(1157, 'San Ildefonso (Toledo)', '2020-01-23 00:00:00', '2020-01-23 23:59:59', 'Festivo o celebración en: Toledo', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200123_60o32ob26oo30c1g60o30dr56g', 'gCalendar'),
(1158, 'Martes de Carnaval (festivo regional)', '2020-02-25 00:00:00', '2020-02-25 23:59:59', 'Festivo o celebración en: Badajoz, La Coruña, Las Palmas, Lugo, Santa Cruz De Tenerife, Orense', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200225_60o32o9p64o30c1g60o30dr56g', 'gCalendar'),
(1159, 'San Pedro Regalado (Valladolid)', '2020-05-13 00:00:00', '2020-05-13 23:59:59', 'Festivo o celebración en: Valladolid', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200513_60o32ob2c4o30c1g60o30dr56g', 'gCalendar'),
(1160, 'Lunes de Pentecostés (festivo regional)', '2020-06-01 00:00:00', '2020-06-01 23:59:59', 'Festivo o celebración en: Barcelona, Gerona', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200601_60o30cr570o30c1g60o30dr56g', 'gCalendar'),
(1161, 'Eid al-Adha (festivo regional)', '2020-07-31 00:00:00', '2020-07-31 23:59:59', 'Festivo o celebración en: Ceuta, Melilla', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200731_60o30ob364o30c1g60o30db164', 'gCalendar'),
(1162, 'Virgen de la Antigua (Guadalajara)', '2020-09-08 00:00:00', '2020-09-08 23:59:59', 'Festivo o celebración en: Guadalajara', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200908_60o32ob1c4o30c1g60o30dr56g', 'gCalendar'),
(1163, 'Santa Teresa de Jesús (Ávila)', '2020-10-15 00:00:00', '2020-10-15 23:59:59', 'Festivo o celebración en: Ávila', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20201015_60o32ob260o30c1g60o30dr56g', 'gCalendar'),
(1164, 'Lunes de Pentecostés (festivo regional)', '2021-05-24 00:00:00', '2021-05-24 23:59:59', 'Festivo o celebración en: Barcelona, Gerona', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20210524_60o30cr570o30c1g60o30dr56k', 'gCalendar'),
(1165, 'Corpus Christi (Castilla-La Mancha)', '2021-06-03 00:00:00', '2021-06-03 23:59:59', 'Festivo o celebración en: Castilla-La Mancha', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20210603_60o30ob2coo30c1g60o30dr56k', 'gCalendar'),
(1166, 'Lunes de Pascua (festivo regional)', '2019-04-22 00:00:00', '2019-04-22 23:59:59', 'Festivo o celebración en: Baleares, Cantabria, Castilla-La Mancha, Cataluña, Valenciana, Navarra, País Vasco, La Rioja', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20190422_60o30d1g64o32c1g60o30dr56c', 'gCalendar'),
(1167, 'Fiestas de las Vaquillas (Teruel)', '2019-07-13 00:00:00', '2019-07-13 23:59:59', 'Festivo o celebración en: Teruel', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20190713_60o32ob274o32c1g60o30dr56c', 'gCalendar'),
(1168, 'Virgen Blanca (Álava)', '2019-08-05 00:00:00', '2019-08-05 23:59:59', 'Festivo o celebración en: Álava', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20190805_60o32o9p60o30c1g60o30dr56c', 'gCalendar'),
(1169, 'San Sebastián (Guipúzcoa)', '2020-01-20 00:00:00', '2020-01-20 23:59:59', 'Festivo o celebración en: Guipúzcoa', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200120_60o32ob26co30c1g60o30dr56g', 'gCalendar'),
(1170, 'El día de Vicente Mártir (Valencia)', '2020-01-22 00:00:00', '2020-01-22 23:59:59', 'Festivo o celebración en: Valencia', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200122_60o32d9h6go30c1g60o30dr56g', 'gCalendar'),
(1171, 'Día de San Jorge (Cáceres)', '2020-04-23 00:00:00', '2020-04-23 23:59:59', 'Festivo o celebración en: Cáceres', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200423_60o30or3c8o32c1g60o30dr56g', 'gCalendar'),
(1172, 'San Segundo (Ávila)', '2020-05-02 00:00:00', '2020-05-02 23:59:59', 'Festivo o celebración en: Ávila', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200502_60o32ob1coo30c1g60o30dr56g', 'gCalendar'),
(1173, 'Virgen de Alarcos (Ciudad Real)', '2020-06-01 00:00:00', '2020-06-01 23:59:59', 'Festivo o celebración en: Ciudad Real', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200601_60o32ob16so30c1g60o30dr56g', 'gCalendar'),
(1174, 'San Juan de Sahagún (Salamanca)', '2020-06-12 00:00:00', '2020-06-12 23:59:59', 'Festivo o celebración en: Salamanca', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200612_60o32ob364o30c1g60o30dr56g', 'gCalendar'),
(1175, 'Fiestas de las Vaquillas (Teruel)', '2020-07-13 00:00:00', '2020-07-13 23:59:59', 'Festivo o celebración en: Teruel', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200713_60o32ob274o30c1g60o30dr56g', 'gCalendar'),
(1176, 'Virgen Blanca (Álava)', '2020-08-05 00:00:00', '2020-08-05 23:59:59', 'Festivo o celebración en: Álava', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200805_60o32o9p60o30c1g60o30dr56g', 'gCalendar'),
(1177, 'Virgen del Mar (Almería)', '2020-08-29 00:00:00', '2020-08-29 23:59:59', 'Festivo o celebración en: Almería', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200829_60o32o9p6ko30c1g60o30dr56g', 'gCalendar'),
(1178, 'San Antolín (Palencia)', '2020-09-02 00:00:00', '2020-09-02 23:59:59', 'Festivo o celebración en: Palencia', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200902_60o32ob2coo30c1g60o30dr56g', 'gCalendar'),
(1179, 'Nuestra Señora de la Cinta (Huelva)', '2020-09-08 00:00:00', '2020-09-08 23:59:59', 'Festivo o celebración en: Huelva', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200908_60o32o9pc8o30c1g60o30dr56g', 'gCalendar'),
(1180, 'Romería de la Virgen de la Fuensanta (Murcia)', '2020-09-15 00:00:00', '2020-09-15 23:59:59', 'Festivo o celebración en: Murcia', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200915_60o32o9pcoo30c1g60o30dr56g', 'gCalendar'),
(1181, 'Santa Tecla (Tarragona)', '2020-09-23 00:00:00', '2020-09-23 23:59:59', 'Festivo o celebración en: Tarragona', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200923_60o32ob26ko30c1g60o30dr56g', 'gCalendar'),
(1182, 'Virgen del Rosario (festivo regional)', '2020-10-07 00:00:00', '2020-10-07 23:59:59', 'Festivo o celebración en: La Coruña, Cádiz', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20201007_60o32o9p6go30c1g60o30dr56g', 'gCalendar'),
(1183, 'San Martín (Orense)', '2020-11-11 00:00:00', '2020-11-11 23:59:59', 'Festivo o celebración en: Orense', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20201111_60o32ob360o30c1g60o30dr56g', 'gCalendar'),
(1184, 'Día de la Constitución Española (festivo regional)', '2020-12-06 00:00:00', '2020-12-06 23:59:59', 'Festivo o celebración en: Andalucía, Aragón, Asturias, Baleares, Canarias, Castilla y León, Extremadura, La Rioja, Madrid, Murcia, Navarra, Ceuta, Melilla', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20201206_60o30cr568o32c1g60o30dr56g', 'gCalendar'),
(1185, 'Virgen Blanca (Álava)', '2021-08-05 00:00:00', '2021-08-05 23:59:59', 'Festivo o celebración en: Álava', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20210805_60o32o9p60o30c1g60o30dr56k', 'gCalendar'),
(1186, 'Santa Leocadia (Toledo)', '2021-12-09 00:00:00', '2021-12-09 23:59:59', 'Festivo o celebración en: Toledo', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20211209_60o32ob26so32c1g60o30dr56k', 'gCalendar'),
(1187, 'San Esteban (festivo regional)', '2021-12-26 00:00:00', '2021-12-26 23:59:59', 'Festivo o celebración en: Baleares, Cataluña', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20211226_60o30cr56so30c1g60o30dr56k', 'gCalendar'),
(1188, 'San Esteban (festivo regional)', '2019-12-26 00:00:00', '2019-12-26 23:59:59', 'Festivo o celebración en: Baleares, Cataluña', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20191226_60o30cr56so32c1g60o30dr56c', 'gCalendar'),
(1189, 'Las Candelas (Palencia)', '2020-02-02 00:00:00', '2020-02-02 23:59:59', 'Festivo o celebración en: Palencia', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200202_60o32ob2cko30c1g60o30dr56g', 'gCalendar'),
(1190, 'descanso laboral correspondiente a Las Candelas (Palencia)', '2020-02-03 00:00:00', '2020-02-03 23:59:59', 'Festivo o celebración en: Palencia', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200203_60o32ob2cko30e1g60o30dr56g', 'gCalendar'),
(1191, 'Lunes de Pascua (festivo regional)', '2020-04-13 00:00:00', '2020-04-13 23:59:59', 'Festivo o celebración en: Baleares, País Vasco, Cantabria, Cataluña, La Rioja, Navarra, Valenciana', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200413_60o30d1g64o30c1g60o30dr56g', 'gCalendar'),
(1192, 'Sermón de las Tortillas (Teruel)', '2020-04-14 00:00:00', '2020-04-14 23:59:59', 'Festivo o celebración en: Teruel', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200414_60o32ob270o30c1g60o30dr56g', 'gCalendar'),
(1193, 'San Anastasi (Lérida)', '2020-05-11 00:00:00', '2020-05-11 23:59:59', 'Festivo o celebración en: Lérida', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200511_60o32ob374o30c1g60o30dr56g', 'gCalendar'),
(1194, 'Día de la Región de Castilla-La Mancha (Castilla-La Mancha)', '2020-05-31 00:00:00', '2020-05-31 23:59:59', 'Festivo o celebración en: Castilla-La Mancha', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200531_60o30d1g70o32c1g60o30dr56g', 'gCalendar'),
(1195, 'Festividad de la Hiniesta (Zamora)', '2020-06-01 00:00:00', '2020-06-01 23:59:59', 'Festivo o celebración en: Zamora', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200601_60o32ob2cgo30c1g60o30dr56g', 'gCalendar'),
(1196, 'San Pedro (festivo regional)', '2020-06-29 00:00:00', '2020-06-29 23:59:59', 'Festivo o celebración en: Burgos, Castellón, Segovia, Zamora', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200629_60o32ob16co30c1g60o30dr56g', 'gCalendar'),
(1197, 'Toma de Málaga por los Reyes Católicos (Málaga)', '2020-08-19 00:00:00', '2020-08-19 23:59:59', 'Festivo o celebración en: Málaga', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200819_60o32o9p6so30c1g60o30dr56g', 'gCalendar'),
(1198, 'Sant Magí (Tarragona)', '2020-08-19 00:00:00', '2020-08-19 23:59:59', 'Festivo o celebración en: Tarragona', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200819_60o32ob26go30c1g60o30dr56g', 'gCalendar'),
(1199, 'Viernes Semana Grande (Vizcaya)', '2020-08-28 00:00:00', '2020-08-28 23:59:59', 'Festivo o celebración en: Vizcaya', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200828_60o32ob1cco30c1g60o30dr56g', 'gCalendar'),
(1200, 'Día Festivo Nuestra Señora de San Lorenzo (Valladolid)', '2020-09-08 00:00:00', '2020-09-08 23:59:59', 'Festivo o celebración en: Valladolid', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200908_60o32ob2cco30c1g60o30dr56g', 'gCalendar'),
(1201, 'Sermón de las Tortillas (Teruel)', '2021-04-14 00:00:00', '2021-04-14 23:59:59', 'Festivo o celebración en: Teruel', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20210414_60o32ob270o32c1g60o30dr56k', 'gCalendar'),
(1202, 'Sant Magí (Tarragona)', '2021-08-19 00:00:00', '2021-08-19 23:59:59', 'Festivo o celebración en: Tarragona', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20210819_60o32ob26go32c1g60o30dr56k', 'gCalendar'),
(1203, 'Santa Tecla (Tarragona)', '2021-09-23 00:00:00', '2021-09-23 23:59:59', 'Festivo o celebración en: Tarragona', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20210923_60o32ob26ko32c1g60o30dr56k', 'gCalendar'),
(1204, 'Eid al-Adha (festivo regional)', '2019-08-12 00:00:00', '2019-08-12 23:59:59', 'Festivo o celebración en: Ceuta, Melilla', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20190812_60o30ob364o30c1g60o30db160', 'gCalendar'),
(1205, 'Santa Tecla (Tarragona)', '2019-09-23 00:00:00', '2019-09-23 23:59:59', 'Festivo o celebración en: Tarragona', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20190923_60o32ob26ko32c1g60o30dr56c', 'gCalendar'),
(1206, 'Lunes de la Fiesta de la Magdalena (Castellón)', '2020-03-16 00:00:00', '2020-03-16 23:59:59', 'Festivo o celebración en: Castellón', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200316_60o32ob1cko30c1g60o30dr56g', 'gCalendar'),
(1207, 'Santa Faz (Alicante)', '2020-04-23 00:00:00', '2020-04-23 23:59:59', 'Festivo o celebración en: Alicante', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200423_60o32o9p68o30c1g60o30dr56g', 'gCalendar'),
(1208, 'San Antonio (Ceuta)', '2020-06-13 00:00:00', '2020-06-13 23:59:59', 'Festivo o celebración en: Ceuta', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200613_60o30cr66co32c1g60o30dr56g', 'gCalendar');
INSERT INTO `events` (`id`, `title`, `start_at`, `end_at`, `notes`, `private`, `user_id`, `created_at`, `updated_at`, `category`, `place`, `eventable_type`, `eventable_id`, `external_key`, `external_calendar`) VALUES
(1209, 'Curpillos (Burgos)', '2020-06-19 00:00:00', '2020-06-19 23:59:59', 'Festivo o celebración en: Burgos', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200619_60o32ob168o30c1g60o30dr56g', 'gCalendar'),
(1210, 'Fiestas Colombinas (Huelva)', '2020-08-03 00:00:00', '2020-08-03 23:59:59', 'Festivo o celebración en: Huelva', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200803_60o32o9pc4o30c1g60o30dr56g', 'gCalendar'),
(1211, 'Virgen de los Llanos (Albacete)', '2020-09-08 00:00:00', '2020-09-08 23:59:59', 'Festivo o celebración en: Albacete', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200908_60o32o9ocko30c1g60o30dr56g', 'gCalendar'),
(1212, 'Viernes de Feria (Guadalajara)', '2020-09-18 00:00:00', '2020-09-18 23:59:59', 'Festivo o celebración en: Guadalajara', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200918_60o32ob1c8o30c1g60o30dr56g', 'gCalendar'),
(1213, 'San Miguel (Lérida)', '2020-09-29 00:00:00', '2020-09-29 23:59:59', 'Festivo o celebración en: Lérida', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200929_60o32ob3c4o30c1g60o30dr56g', 'gCalendar'),
(1214, 'Santa Catalina (Jaén)', '2020-11-25 00:00:00', '2020-11-25 23:59:59', 'Festivo o celebración en: Jaén', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20201125_60o32o9pcco30c1g60o30dr56g', 'gCalendar'),
(1215, 'Día de la Constitución Española (festivo regional)', '2020-12-07 00:00:00', '2020-12-07 23:59:59', 'Festivo o celebración en: Andalucía, Aragón, Asturias, Baleares, Canarias, Castilla y León, Extremadura, La Rioja, Madrid, Murcia, Navarra, Ceuta, Melilla', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20201207_60o30cr568o34c1g60o30dr56g', 'gCalendar'),
(1216, 'Santa Leocadia (Toledo)', '2020-12-09 00:00:00', '2020-12-09 23:59:59', 'Festivo o celebración en: Toledo', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20201209_60o32ob26so30c1g60o30dr56g', 'gCalendar'),
(1217, 'Sermón de las Tortillas (Teruel)', '2019-04-14 00:00:00', '2019-04-14 23:59:59', 'Festivo o celebración en: Teruel', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20190414_60o32ob270o32c1g60o30dr56c', 'gCalendar'),
(1218, 'Festividad del Día de Canarias (Canarias)', '2019-05-30 00:00:00', '2019-05-30 23:59:59', 'Festivo o celebración en: Canarias', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20190530_60o30d1g6oo32c1g60o30dr56c', 'gCalendar'),
(1219, 'Día de la Constitución Española', '2019-12-06 00:00:00', '2019-12-06 23:59:59', '', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20191206_60o30cr568o36c1g60o30dr56c', 'gCalendar'),
(1220, 'Santa Leocadia (Toledo)', '2019-12-09 00:00:00', '2019-12-09 23:59:59', 'Festivo o celebración en: Toledo', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20191209_60o32ob26so32c1g60o30dr56c', 'gCalendar'),
(1221, 'San Julian (Cuenca)', '2020-01-28 00:00:00', '2020-01-28 23:59:59', 'Festivo o celebración en: Cuenca', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200128_60o32ob36oo30c1g60o30dr56g', 'gCalendar'),
(1222, 'Dia de las Islas Baleares (Baleares)', '2020-03-01 00:00:00', '2020-03-01 23:59:59', 'Festivo o celebración en: Baleares', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200301_60o30d1g6ko32c1g60o30dr56g', 'gCalendar'),
(1223, 'Estatuto de Autonomía de la Ciudad de Melilla (Melilla)', '2020-03-13 00:00:00', '2020-03-13 23:59:59', 'Festivo o celebración en: Melilla', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200313_60o32o9p6oo30c1g60o30dr56g', 'gCalendar'),
(1224, 'San Vicente Ferrer (Valencia)', '2020-04-20 00:00:00', '2020-04-20 23:59:59', 'Festivo o celebración en: Valencia', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200420_60o32ob2c8o30c1g60o30dr56g', 'gCalendar'),
(1225, 'Feria de San Fernando (Cáceres)', '2020-05-29 00:00:00', '2020-05-29 23:59:59', 'Festivo o celebración en: Cáceres', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200529_60o32ob264o30c1g60o30dr56g', 'gCalendar'),
(1226, 'Virgen de la Luz (Cuenca)', '2020-06-01 00:00:00', '2020-06-01 23:59:59', 'Festivo o celebración en: Cuenca', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200601_60o32ob3cco30c1g60o30dr56g', 'gCalendar'),
(1227, 'Virgen de la Capilla (Jaén)', '2020-06-11 00:00:00', '2020-06-11 23:59:59', 'Festivo o celebración en: Jaén', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200611_60o32o9p74o30c1g60o30dr56g', 'gCalendar'),
(1228, 'Fogueres (Alicante)', '2020-06-22 00:00:00', '2020-06-22 23:59:59', 'Festivo o celebración en: Alicante', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200622_60o32o9p6co30c1g60o30dr56g', 'gCalendar'),
(1229, 'San Benito (Pontevedra)', '2020-07-11 00:00:00', '2020-07-11 23:59:59', 'Festivo o celebración en: Pontevedra', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200711_60o32ob160o30c1g60o30dr56g', 'gCalendar'),
(1230, 'Día de Nuestra Señora de África (Ceuta)', '2020-08-05 00:00:00', '2020-08-05 23:59:59', 'Festivo o celebración en: Ceuta', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200805_60o30cr66go32c1g60o30dr56g', 'gCalendar'),
(1231, 'San Saturio (Soria)', '2020-10-02 00:00:00', '2020-10-02 23:59:59', 'Festivo o celebración en: Soria', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20201002_60o32ob36ko30c1g60o30dr56g', 'gCalendar'),
(1232, 'San Frutos (Segovia)', '2020-10-25 00:00:00', '2020-10-25 23:59:59', 'Festivo o celebración en: Segovia', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20201025_60o32ob3cgo30c1g60o30dr56g', 'gCalendar'),
(1233, 'descanso laboral correspondiente a San Frutos (Segovia)', '2020-10-26 00:00:00', '2020-10-26 23:59:59', 'Festivo o celebración en: Segovia', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20201026_60o32ob3cgo30e1g60o30dr56g', 'gCalendar'),
(1234, 'Sant Narcís (Gerona)', '2020-10-29 00:00:00', '2020-10-29 23:59:59', 'Festivo o celebración en: Gerona', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20201029_60o32ob174o30c1g60o30dr56g', 'gCalendar'),
(1235, 'San Ildefonso (Toledo)', '2021-01-23 00:00:00', '2021-01-23 23:59:59', 'Festivo o celebración en: Toledo', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20210123_60o32ob26oo32c1g60o30dr56k', 'gCalendar'),
(1236, 'Lunes de Pascua (festivo regional)', '2021-04-05 00:00:00', '2021-04-05 23:59:59', 'Festivo o celebración en: Baleares, País Vasco, Cantabria, Cataluña, La Rioja, Navarra, Valenciana', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20210405_60o30d1g64o30c1g60o30dr56k', 'gCalendar'),
(1237, 'Fiestas de las Vaquillas (Teruel)', '2021-07-13 00:00:00', '2021-07-13 23:59:59', 'Festivo o celebración en: Teruel', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20210713_60o32ob274o32c1g60o30dr56k', 'gCalendar'),
(1238, 'Virgen de los Llanos (Albacete)', '2021-09-08 00:00:00', '2021-09-08 23:59:59', 'Festivo o celebración en: Albacete', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20210908_60o32o9ocko30c1g60o30dr56k', 'gCalendar'),
(1239, 'San Ildefonso (Toledo)', '2019-01-23 00:00:00', '2019-01-23 23:59:59', 'Festivo o celebración en: Toledo', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20190123_60o32ob26oo32c1g60o30dr56c', 'gCalendar'),
(1240, 'Dia de las Islas Baleares (Baleares)', '2019-03-01 00:00:00', '2019-03-01 23:59:59', 'Festivo o celebración en: Baleares', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20190301_60o30d1g6ko34c1g60o30dr56c', 'gCalendar'),
(1241, 'Jueves Santo (festivo regional)', '2019-04-18 00:00:00', '2019-04-18 23:59:59', 'Festivo o celebración en: Andalucía, Aragón, Asturias, Baleares, País Vasco, Canarias, Castilla-La Mancha, Castilla y León, Ceuta, Extremadura, Galicia, Madrid, Melilla, Murcia, Navarra, La Rioja', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20190418_60o30d1g6co36c1g60o30dr56c', 'gCalendar'),
(1242, 'Virgen de los Llanos (Albacete)', '2019-09-08 00:00:00', '2019-09-08 23:59:59', 'Festivo o celebración en: Albacete', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20190908_60o32o9ocko30c1g60o30dr56c', 'gCalendar'),
(1243, 'San Vicente (Huesca)', '2020-01-22 00:00:00', '2020-01-22 23:59:59', 'Festivo o celebración en: Huesca', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200122_60o32o9pcgo30c1g60o30dr56g', 'gCalendar'),
(1244, 'Lunes de Carnaval (festivo regional)', '2020-02-24 00:00:00', '2020-02-24 23:59:59', 'Festivo o celebración en: Cádiz, Santa Cruz De Tenerife', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200224_60o32ob268o30c1g60o30dr56g', 'gCalendar'),
(1245, 'Miércoles de Feria (Sevilla)', '2020-04-09 00:00:00', '2020-04-09 23:59:59', 'Festivo o celebración en: Sevilla', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200409_60o32ob36co30c1g60o30dr56g', 'gCalendar'),
(1246, 'San Prudencio (Álava)', '2020-04-28 00:00:00', '2020-04-28 23:59:59', 'Festivo o celebración en: Álava', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200428_60o32o9ocoo30c1g60o30dr56g', 'gCalendar'),
(1247, 'Día de las Letras Gallegas (Galicia)', '2020-05-17 00:00:00', '2020-05-17 23:59:59', 'Festivo o celebración en: Galicia', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200517_60o30cr6cgo32c1g60o30dr56g', 'gCalendar'),
(1248, 'Jueves La Saca (Soria)', '2020-06-25 00:00:00', '2020-06-25 23:59:59', 'Festivo o celebración en: Soria', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200625_60o32ob36go30c1g60o30dr56g', 'gCalendar'),
(1249, 'San Ignacio de Loyola (festivo regional)', '2020-07-31 00:00:00', '2020-07-31 23:59:59', 'Festivo o celebración en: Guipúzcoa, Vizcaya', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200731_60o32ob170o30c1g60o30dr56g', 'gCalendar'),
(1250, 'San Lorenzo (Huesca)', '2020-08-10 00:00:00', '2020-08-10 23:59:59', 'Festivo o celebración en: Huesca', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200810_60o32ob164o30c1g60o30dr56g', 'gCalendar'),
(1251, 'La Octava de la Virgen del Prado (Ciudad Real)', '2020-08-22 00:00:00', '2020-08-22 23:59:59', 'Festivo o celebración en: Ciudad Real', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200822_60o32ob16go30c1g60o30dr56g', 'gCalendar'),
(1252, 'Día de la Victoria (Málaga)', '2020-09-08 00:00:00', '2020-09-08 23:59:59', 'Festivo o celebración en: Málaga', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200908_60o32o9p70o30c1g60o30dr56g', 'gCalendar'),
(1253, 'Virgen de Guadalupe (Córdoba)', '2020-09-08 00:00:00', '2020-09-08 23:59:59', 'Festivo o celebración en: Córdoba', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200908_60o32ob16ko30c1g60o30dr56g', 'gCalendar'),
(1254, 'Virgen de la Vega (Salamanca)', '2020-09-08 00:00:00', '2020-09-08 23:59:59', 'Festivo o celebración en: Salamanca', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200908_60o32ob368o30c1g60o30dr56g', 'gCalendar'),
(1255, 'La Mercè (Barcelona)', '2020-09-24 00:00:00', '2020-09-24 23:59:59', 'Festivo o celebración en: Barcelona', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200924_60o32ob1cgo30c1g60o30dr56g', 'gCalendar'),
(1256, 'San Froilán (festivo regional)', '2020-10-05 00:00:00', '2020-10-05 23:59:59', 'Festivo o celebración en: León, Lugo', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20201005_60o32ob36so30c1g60o30dr56g', 'gCalendar'),
(1257, 'San Rafael (Córdoba)', '2020-10-24 00:00:00', '2020-10-24 23:59:59', 'Festivo o celebración en: Córdoba', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20201024_60o32ob16oo30c1g60o30dr56g', 'gCalendar'),
(1258, 'La Almudena (Madrid)', '2020-11-09 00:00:00', '2020-11-09 23:59:59', 'Festivo o celebración en: Madrid', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20201109_60o32ob3c8o30c1g60o30dr56g', 'gCalendar'),
(1259, 'San Esteban (festivo regional)', '2020-12-26 00:00:00', '2020-12-26 23:59:59', 'Festivo o celebración en: Baleares, Cataluña', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20201226_60o30cr56so30c1g60o30dr56g', 'gCalendar'),
(1260, 'San Juan (festivo regional)', '2019-06-24 00:00:00', '2019-06-24 23:59:59', 'Festivo o celebración en: Almería, Badajoz, Las Palmas, León', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20190624_60o32ob370o34c1g60o30dr56c', 'gCalendar'),
(1261, 'Día del Pendón (Almería)', '2020-12-26 00:00:00', '2020-12-26 23:59:59', 'Festivo o celebración en: Almería', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20201226_60o32ob660o30c1g60o30dr56g', 'gCalendar'),
(1262, 'San Juan (festivo regional)', '2021-06-24 00:00:00', '2021-06-24 23:59:59', 'Festivo o celebración en: Almería, Badajoz, Las Palmas, León', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20210624_60o32ob370o34c1g60o30dr56k', 'gCalendar'),
(1263, 'Día de Todos los Santos (festivo regional)', '2020-11-01 00:00:00', '2020-11-01 23:59:59', 'Festivo o celebración en: Andalucía, Aragón, Asturias, Castilla y León, Extremadura, Madrid', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20201101_60o30cr564o34c1g60o30dr56g', 'gCalendar'),
(1264, 'Día de Todos los Santos (festivo regional)', '2020-11-02 00:00:00', '2020-11-02 23:59:59', 'Festivo o celebración en: Andalucía, Aragón, Asturias, Castilla y León, Extremadura, Madrid', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20201102_60o30cr564o36c1g60o30dr56g', 'gCalendar'),
(1265, 'San José (festivo regional)', '2019-03-19 00:00:00', '2019-03-19 23:59:59', 'Festivo o celebración en: Valenciana, Galicia, Murcia, Navarra, País Vasco', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20190319_60o30d1g68o36c1g60o30dr56c', 'gCalendar'),
(1266, 'La revetlla de Sant Joan (festivo regional)', '2019-06-24 00:00:00', '2019-06-24 23:59:59', 'Festivo o celebración en: Cataluña, Albacete', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20190624_60o30d1g6go3ac1g60o30dr56c', 'gCalendar'),
(1267, 'Santiago Apóstol (festivo regional)', '2019-07-25 00:00:00', '2019-07-25 23:59:59', 'Festivo o celebración en: Galicia, Cantabria, País Vasco', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20190725_60o30d1gc4o36c1g60o30dr56c', 'gCalendar'),
(1268, 'San José (festivo regional)', '2020-03-19 00:00:00', '2020-03-19 23:59:59', 'Festivo o celebración en: País Vasco, Castilla-La Mancha, Galicia, Murcia, Navarra, Valenciana', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 16, '20200319_60o30d1g68o32c1g60o30dr56g', 'gCalendar'),
(1269, 'Recordatorio día 17, tarea 01', '2020-09-17 00:00:00', '2020-09-17 23:59:59', 'Realizar la tarea 01del día 17', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 17, '04u7k0rgn90t8sr1us4nq1ah87', 'gCalendar'),
(1270, 'Evento 02', '2020-10-10 00:00:00', '2020-10-10 23:59:59', 'Recordar Evento 02', 1, 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43', 'O', NULL, 'App\\GoogleCalendar', 17, '05g9i3b2dc23i2eqbmghbfd3in', 'gCalendar'),
(1272, 'Año Nuevo', '2019-01-01 00:00:00', '2019-01-01 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190101_60o30cr474o30c1g60o30dr56c', 'gCalendar'),
(1273, 'Epifanía del Señor', '2019-01-06 00:00:00', '2019-01-06 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190106_60o30cr4c4o30c1g60o30dr56c', 'gCalendar'),
(1274, 'Miércoles de Ceniza', '2019-03-06 00:00:00', '2019-03-06 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190306_60o30e9k6so30c1g60o30dr56c', 'gCalendar'),
(1275, 'Cambio de Horario de Verano', '2019-03-31 00:00:00', '2019-03-31 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190331_60o30c9o60o30dpj6oqj0dr56c', 'gCalendar'),
(1276, 'Domingo de Ramos', '2019-04-14 00:00:00', '2019-04-14 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190414_60o30e9k70o30c1g60o30dr56c', 'gCalendar'),
(1277, 'Viernes Santo', '2019-04-19 00:00:00', '2019-04-19 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190419_60o30cr4cco30c1g60o30dr56c', 'gCalendar'),
(1278, 'Domingo de Pascua', '2019-04-21 00:00:00', '2019-04-21 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190421_60o32e1n6ko30c1g60o30dr56c', 'gCalendar'),
(1279, 'Día del trabajador', '2019-05-01 00:00:00', '2019-05-01 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190501_60o30cr4cgo30c1g60o30dr56c', 'gCalendar'),
(1280, 'El Dia de la Madre', '2019-05-05 00:00:00', '2019-05-05 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190505_60o30or16go30e1g60o30dr56c', 'gCalendar'),
(1281, 'Domingo de Pentecostés', '2019-06-09 00:00:00', '2019-06-09 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190609_60o30e9k74o30c1g60o30dr56c', 'gCalendar'),
(1282, 'La Asunción de la Virgen', '2019-08-15 00:00:00', '2019-08-15 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190815_60o30cr574o30c1g60o30dr56c', 'gCalendar'),
(1283, 'Día de la Hispanidad', '2019-10-12 00:00:00', '2019-10-12 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20191012_60o30cr4coo30c1g60o30dr56c', 'gCalendar'),
(1284, 'Cambio de horario de invierno', '2019-10-27 00:00:00', '2019-10-27 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20191027_60o30c9o64o30dpj6oqj0dr56c', 'gCalendar'),
(1285, 'La Inmaculada Concepción', '2019-12-08 00:00:00', '2019-12-08 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20191208_60o30cr56co30c1g60o30dr56c', 'gCalendar'),
(1286, 'Nochebuena', '2019-12-24 00:00:00', '2019-12-24 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20191224_60o30e9kc4o30c1g60o30dr56c', 'gCalendar'),
(1287, 'Navidad', '2019-12-25 00:00:00', '2019-12-25 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20191225_60o30cr56ko30c1g60o30dr56c', 'gCalendar'),
(1288, 'Día de la Sagrada Familia', '2019-12-29 00:00:00', '2019-12-29 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20191229_60o30e9k6oo30c1g60o30dr56c', 'gCalendar'),
(1289, 'Nochevieja', '2019-12-31 00:00:00', '2019-12-31 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20191231_60o30e9kc8o30c1g60o30dr56c', 'gCalendar'),
(1290, 'Año Nuevo', '2020-01-01 00:00:00', '2020-01-01 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200101_60o30cr474o30c1g60o30dr56g', 'gCalendar'),
(1291, 'Epifanía del Señor', '2020-01-06 00:00:00', '2020-01-06 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200106_60o30cr4c4o30c1g60o30dr56g', 'gCalendar'),
(1292, 'Cambio de Horario de Verano', '2020-03-29 00:00:00', '2020-03-29 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200329_60o30c9o60o30dpj6oqj0dr56g', 'gCalendar'),
(1293, 'Domingo de Ramos', '2020-04-05 00:00:00', '2020-04-05 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200405_60o30e9k70o30c1g60o30dr56g', 'gCalendar'),
(1294, 'Viernes Santo', '2020-04-10 00:00:00', '2020-04-10 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200410_60o30cr4cco30c1g60o30dr56g', 'gCalendar'),
(1295, 'Domingo de Pascua', '2020-04-12 00:00:00', '2020-04-12 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200412_60o32e1n6ko30c1g60o30dr56g', 'gCalendar'),
(1296, 'Día del trabajador', '2020-05-01 00:00:00', '2020-05-01 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200501_60o30cr4cgo30c1g60o30dr56g', 'gCalendar'),
(1297, 'El Dia de la Madre', '2020-05-03 00:00:00', '2020-05-03 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200503_60o30or16go30e1g60o30dr56g', 'gCalendar'),
(1298, 'Domingo de Pentecostés', '2020-05-31 00:00:00', '2020-05-31 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200531_60o30e9k74o30c1g60o30dr56g', 'gCalendar'),
(1299, 'La Asunción de la Virgen', '2020-08-15 00:00:00', '2020-08-15 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200815_60o30cr574o30c1g60o30dr56g', 'gCalendar'),
(1300, 'Día de la Hispanidad', '2020-10-12 00:00:00', '2020-10-12 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20201012_60o30cr4coo30c1g60o30dr56g', 'gCalendar'),
(1301, 'Cambio de horario de invierno', '2020-10-25 00:00:00', '2020-10-25 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20201025_60o30c9o64o30dpj6oqj0dr56g', 'gCalendar'),
(1302, 'La Inmaculada Concepción', '2020-12-08 00:00:00', '2020-12-08 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20201208_60o30cr56co30c1g60o30dr56g', 'gCalendar'),
(1303, 'Nochebuena', '2020-12-24 00:00:00', '2020-12-24 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20201224_60o30e9kc4o30c1g60o30dr56g', 'gCalendar'),
(1304, 'Navidad', '2020-12-25 00:00:00', '2020-12-25 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20201225_60o30cr56ko30c1g60o30dr56g', 'gCalendar'),
(1305, 'Día de la Sagrada Familia', '2020-12-27 00:00:00', '2020-12-27 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20201227_60o30e9k6oo30c1g60o30dr56g', 'gCalendar'),
(1306, 'Nochevieja', '2020-12-31 00:00:00', '2020-12-31 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20201231_60o30e9kc8o30c1g60o30dr56g', 'gCalendar'),
(1307, 'Año Nuevo', '2021-01-01 00:00:00', '2021-01-01 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210101_60o30cr474o30c1g60o30dr56k', 'gCalendar'),
(1308, 'Epifanía del Señor', '2021-01-06 00:00:00', '2021-01-06 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210106_60o30cr4c4o30c1g60o30dr56k', 'gCalendar'),
(1309, 'Miércoles de Ceniza', '2021-02-17 00:00:00', '2021-02-17 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210217_60o30e9k6so30c1g60o30dr56k', 'gCalendar'),
(1310, 'Cambio de Horario de Verano', '2021-03-28 00:00:00', '2021-03-28 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210328_60o30c9o60o30dpj6oqj0dr56k', 'gCalendar'),
(1311, 'Domingo de Ramos', '2021-03-28 00:00:00', '2021-03-28 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210328_60o30e9k70o30c1g60o30dr56k', 'gCalendar'),
(1312, 'Viernes Santo', '2021-04-02 00:00:00', '2021-04-02 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210402_60o30cr4cco30c1g60o30dr56k', 'gCalendar'),
(1313, 'Domingo de Pascua', '2021-04-04 00:00:00', '2021-04-04 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210404_60o32e1n6ko30c1g60o30dr56k', 'gCalendar'),
(1314, 'Día del trabajador', '2021-05-01 00:00:00', '2021-05-01 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210501_60o30cr4cgo30c1g60o30dr56k', 'gCalendar'),
(1315, 'El Dia de la Madre', '2021-05-02 00:00:00', '2021-05-02 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210502_60o30or16go30e1g60o30dr56k', 'gCalendar'),
(1316, 'Domingo de Pentecostés', '2021-05-23 00:00:00', '2021-05-23 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210523_60o30e9k74o30c1g60o30dr56k', 'gCalendar'),
(1317, 'La Asunción de la Virgen', '2021-08-15 00:00:00', '2021-08-15 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210815_60o30cr574o30c1g60o30dr56k', 'gCalendar'),
(1318, 'al trasladar el descanso laboral del 15 de agosto', '2021-08-16 00:00:00', '2021-08-16 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210816_60o30cr5c4o30c1g60o30dr56k', 'gCalendar'),
(1319, 'Día de la Hispanidad', '2021-10-12 00:00:00', '2021-10-12 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20211012_60o30cr4coo30c1g60o30dr56k', 'gCalendar'),
(1320, 'Cambio de horario de invierno', '2021-10-31 00:00:00', '2021-10-31 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20211031_60o30c9o64o30dpj6oqj0dr56k', 'gCalendar'),
(1321, 'La Inmaculada Concepción', '2021-12-08 00:00:00', '2021-12-08 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20211208_60o30cr56co30c1g60o30dr56k', 'gCalendar'),
(1322, 'Nochebuena', '2021-12-24 00:00:00', '2021-12-24 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20211224_60o30e9kc4o30c1g60o30dr56k', 'gCalendar'),
(1323, 'Navidad', '2021-12-25 00:00:00', '2021-12-25 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20211225_60o30cr56ko30c1g60o30dr56k', 'gCalendar'),
(1324, 'Día de la Sagrada Familia', '2021-12-26 00:00:00', '2021-12-26 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20211226_60o30e9k6oo30c1g60o30dr56k', 'gCalendar'),
(1325, 'Nochevieja', '2021-12-31 00:00:00', '2021-12-31 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20211231_60o30e9kc8o30c1g60o30dr56k', 'gCalendar'),
(1326, 'Virgen de la Victoria (Melilla)', '2019-09-08 00:00:00', '2019-09-08 23:59:59', 'Festivo o celebración en: Melilla', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190908_60o30cr6c4o30c1g60o30dr56c', 'gCalendar'),
(1327, 'Nuestra Señora de la Bien Aparecida (Cantabria)', '2019-09-15 00:00:00', '2019-09-15 23:59:59', 'Festivo o celebración en: Cantabria', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190915_60o30cr6coo30c1g60o30dr56c', 'gCalendar'),
(1328, 'Día de Melilla (Melilla)', '2019-09-17 00:00:00', '2019-09-17 23:59:59', 'Festivo o celebración en: Melilla', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190917_60o30cr6c8o30c1g60o30dr56c', 'gCalendar'),
(1329, 'Dia de San Isidro (Madrid)', '2020-05-15 00:00:00', '2020-05-15 23:59:59', 'Festivo o celebración en: Madrid', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200515_60o30ob360o30c1g60o30dr56g', 'gCalendar'),
(1330, 'Día de la Ciudad Autónoma de Ceuta (Ceuta)', '2020-09-02 00:00:00', '2020-09-02 23:59:59', 'Festivo o celebración en: Ceuta', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200902_60o30cr66ko30c1g60o30dr56g', 'gCalendar'),
(1331, 'Día de Navarra (Navarra)', '2020-12-03 00:00:00', '2020-12-03 23:59:59', 'Festivo o celebración en: Navarra', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20201203_60o30cr6cco30c1g60o30dr56g', 'gCalendar'),
(1332, 'Dia de las Islas Baleares (Baleares)', '2021-03-01 00:00:00', '2021-03-01 23:59:59', 'Festivo o celebración en: Baleares', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210301_60o30d1g6ko30c1g60o30dr56k', 'gCalendar'),
(1333, 'Dia de San Isidro (Madrid)', '2021-05-15 00:00:00', '2021-05-15 23:59:59', 'Festivo o celebración en: Madrid', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210515_60o30ob360o30c1g60o30dr56k', 'gCalendar'),
(1334, 'Día Nacional de Cataluña (Cataluña)', '2021-09-11 00:00:00', '2021-09-11 23:59:59', 'Festivo o celebración en: Cataluña', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210911_60o30cr6cko30c1g60o30dr56k', 'gCalendar'),
(1335, 'Lunes siguiente a la Epifanía del Señor (festivo regional)', '2019-01-07 00:00:00', '2019-01-07 23:59:59', 'Festivo o celebración en: Andalucía, Aragón, Asturias, Canarias, Castilla y León, Extremadura, Murcia, Navarra, Ceuta, Madrid, Melilla', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190107_60o30cr4c8o30c1g60o30dr56c', 'gCalendar'),
(1336, 'El día de San Valero (Zaragoza)', '2019-01-29 00:00:00', '2019-01-29 23:59:59', 'Festivo o celebración en: Zaragoza', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190129_60o32d9h68o30c1g60o30dr56c', 'gCalendar'),
(1337, 'Día de Andalucía (Andalucía)', '2019-02-28 00:00:00', '2019-02-28 23:59:59', 'Festivo o celebración en: Andalucía', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190228_60o30cr5c8o30c1g60o30dr56c', 'gCalendar'),
(1338, 'Día de Castilla y León (Castilla y León)', '2019-04-23 00:00:00', '2019-04-23 23:59:59', 'Festivo o celebración en: Castilla y León', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190423_60o30or16co30c1g60o30dr56c', 'gCalendar'),
(1339, 'Día de Nuestra Señora de África (Ceuta)', '2019-08-05 00:00:00', '2019-08-05 23:59:59', 'Festivo o celebración en: Ceuta', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190805_60o30cr66go30c1g60o30dr56c', 'gCalendar'),
(1340, 'Día de Asturias (Asturias)', '2019-09-08 00:00:00', '2019-09-08 23:59:59', 'Festivo o celebración en: Asturias', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190908_60o30cr66oo30c1g60o30dr56c', 'gCalendar'),
(1341, 'Día Nacional de Cataluña (Cataluña)', '2019-09-11 00:00:00', '2019-09-11 23:59:59', 'Festivo o celebración en: Cataluña', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190911_60o30cr6cko30c1g60o30dr56c', 'gCalendar'),
(1342, 'Día de Castilla y León (Castilla y León)', '2020-04-23 00:00:00', '2020-04-23 23:59:59', 'Festivo o celebración en: Castilla y León', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200423_60o30or16co30c1g60o30dr56g', 'gCalendar'),
(1343, 'Día de la Communidad Madrid (Madrid)', '2020-05-02 00:00:00', '2020-05-02 23:59:59', 'Festivo o celebración en: Madrid', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200502_60o30d1g74o30c1g60o30dr56g', 'gCalendar'),
(1344, 'Día de las Letras Gallegas (Galicia)', '2021-05-17 00:00:00', '2021-05-17 23:59:59', 'Festivo o celebración en: Galicia', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210517_60o30cr6cgo30c1g60o30dr56k', 'gCalendar'),
(1345, 'San Jorge. Día de Aragón (Aragón)', '2019-04-23 00:00:00', '2019-04-23 23:59:59', 'Festivo o celebración en: Aragón', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190423_60o30cr5cco30c1g60o30dr56c', 'gCalendar'),
(1346, 'Día de la Communidad Madrid (Madrid)', '2019-05-02 00:00:00', '2019-05-02 23:59:59', 'Festivo o celebración en: Madrid', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190502_60o30d1g74o30c1g60o30dr56c', 'gCalendar'),
(1347, 'Día de Extremadura (Extremadura)', '2019-09-08 00:00:00', '2019-09-08 23:59:59', 'Festivo o celebración en: Extremadura', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190908_60o30cr670o30c1g60o30dr56c', 'gCalendar'),
(1348, 'Virgen de la Victoria Observado (Melilla)', '2019-09-09 00:00:00', '2019-09-09 23:59:59', 'Festivo o celebración en: Melilla', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190909_60o30cr6c4o30e1g60o30dr56c', 'gCalendar'),
(1349, 'Día de Navarra (Navarra)', '2019-12-03 00:00:00', '2019-12-03 23:59:59', 'Festivo o celebración en: Navarra', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20191203_60o30cr6cco30c1g60o30dr56c', 'gCalendar'),
(1350, 'El día de San Valero (Zaragoza)', '2020-01-29 00:00:00', '2020-01-29 23:59:59', 'Festivo o celebración en: Zaragoza', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200129_60o32d9h68o30c1g60o30dr56g', 'gCalendar'),
(1351, 'Día Nacional de Cataluña (Cataluña)', '2020-09-11 00:00:00', '2020-09-11 23:59:59', 'Festivo o celebración en: Cataluña', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200911_60o30cr6cko30c1g60o30dr56g', 'gCalendar'),
(1352, 'Día de la Comunidad Valenciana (Valenciana)', '2020-10-09 00:00:00', '2020-10-09 23:59:59', 'Festivo o celebración en: Valenciana', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20201009_60o30d1g60o30c1g60o30dr56g', 'gCalendar'),
(1353, 'Día de Castilla y León (Castilla y León)', '2021-04-23 00:00:00', '2021-04-23 23:59:59', 'Festivo o celebración en: Castilla y León', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210423_60o30or16co30c1g60o30dr56k', 'gCalendar'),
(1354, 'Día de la Región de Castilla-La Mancha (Castilla-La Mancha)', '2021-05-31 00:00:00', '2021-05-31 23:59:59', 'Festivo o celebración en: Castilla-La Mancha', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210531_60o30d1g70o30c1g60o30dr56k', 'gCalendar'),
(1355, 'Día de la Región de Castilla-La Mancha (Castilla-La Mancha)', '2019-05-31 00:00:00', '2019-05-31 23:59:59', 'Festivo o celebración en: Castilla-La Mancha', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190531_60o30d1g70o30c1g60o30dr56c', 'gCalendar'),
(1356, 'Cincomarzada (Zaragoza)', '2021-03-05 00:00:00', '2021-03-05 23:59:59', 'Festivo o celebración en: Zaragoza', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210305_60o32d9h6co30c1g60o30dr56k', 'gCalendar'),
(1357, 'San Antonio (Ceuta)', '2021-06-13 00:00:00', '2021-06-13 23:59:59', 'Festivo o celebración en: Ceuta', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210613_60o30cr66co30c1g60o30dr56k', 'gCalendar'),
(1358, 'Día de las Instituciones (Cantabria)', '2021-07-28 00:00:00', '2021-07-28 23:59:59', 'Festivo o celebración en: Cantabria', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210728_60o30cr5cko30c1g60o30dr56k', 'gCalendar'),
(1359, 'Día de la Comunidad Valenciana (Valenciana)', '2021-10-09 00:00:00', '2021-10-09 23:59:59', 'Festivo o celebración en: Valenciana', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20211009_60o30d1g60o30c1g60o30dr56k', 'gCalendar'),
(1360, 'Lunes siguiente a la Día de Extremadura (Extremadura)', '2019-09-09 00:00:00', '2019-09-09 23:59:59', 'Festivo o celebración en: Extremadura', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190909_60o30cr674o30c1g60o30dr56c', 'gCalendar'),
(1361, 'Día de Andalucía (Andalucía)', '2020-02-28 00:00:00', '2020-02-28 23:59:59', 'Festivo o celebración en: Andalucía', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200228_60o30cr5c8o30c1g60o30dr56g', 'gCalendar'),
(1362, 'Cincomarzada (Zaragoza)', '2020-03-05 00:00:00', '2020-03-05 23:59:59', 'Festivo o celebración en: Zaragoza', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200305_60o32d9h6co30c1g60o30dr56g', 'gCalendar'),
(1363, 'Festividad del Día de Canarias (Canarias)', '2020-05-30 00:00:00', '2020-05-30 23:59:59', 'Festivo o celebración en: Canarias', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200530_60o30d1g6oo30c1g60o30dr56g', 'gCalendar'),
(1364, 'Día de las Instituciones (Cantabria)', '2020-07-28 00:00:00', '2020-07-28 23:59:59', 'Festivo o celebración en: Cantabria', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200728_60o30cr5cko30c1g60o30dr56g', 'gCalendar'),
(1365, 'Virgen de la Victoria (Melilla)', '2020-09-08 00:00:00', '2020-09-08 23:59:59', 'Festivo o celebración en: Melilla', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200908_60o30cr6c4o30c1g60o30dr56g', 'gCalendar'),
(1366, 'El día de San Valero (Zaragoza)', '2021-01-29 00:00:00', '2021-01-29 23:59:59', 'Festivo o celebración en: Zaragoza', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210129_60o32d9h68o30c1g60o30dr56k', 'gCalendar'),
(1367, 'Festividad del Día de Canarias (Canarias)', '2021-05-30 00:00:00', '2021-05-30 23:59:59', 'Festivo o celebración en: Canarias', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210530_60o30d1g6oo30c1g60o30dr56k', 'gCalendar'),
(1368, 'Día de Extremadura (Extremadura)', '2021-09-08 00:00:00', '2021-09-08 23:59:59', 'Festivo o celebración en: Extremadura', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210908_60o30cr670o30c1g60o30dr56k', 'gCalendar'),
(1369, 'Día de Melilla (Melilla)', '2021-09-17 00:00:00', '2021-09-17 23:59:59', 'Festivo o celebración en: Melilla', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210917_60o30cr6c8o30c1g60o30dr56k', 'gCalendar'),
(1370, 'Día de Navarra (Navarra)', '2021-12-03 00:00:00', '2021-12-03 23:59:59', 'Festivo o celebración en: Navarra', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20211203_60o30cr6cco30c1g60o30dr56k', 'gCalendar'),
(1371, 'San Antonio (Ceuta)', '2019-06-13 00:00:00', '2019-06-13 23:59:59', 'Festivo o celebración en: Ceuta', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190613_60o30cr66co30c1g60o30dr56c', 'gCalendar'),
(1372, 'Día de la Toma (Granada)', '2020-01-02 00:00:00', '2020-01-02 23:59:59', 'Festivo o celebración en: Granada', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200102_60o32e356go30c1g60o30dr56g', 'gCalendar'),
(1373, 'Día de la Región de Murcia (Murcia)', '2020-06-09 00:00:00', '2020-06-09 23:59:59', 'Festivo o celebración en: Murcia', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200609_60o30cr5coo30c1g60o30dr56g', 'gCalendar'),
(1374, 'Día de la Toma (Granada)', '2021-01-02 00:00:00', '2021-01-02 23:59:59', 'Festivo o celebración en: Granada', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210102_60o32e356go30c1g60o30dr56k', 'gCalendar'),
(1375, 'San Jorge. Día de Aragón (Aragón)', '2021-04-23 00:00:00', '2021-04-23 23:59:59', 'Festivo o celebración en: Aragón', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210423_60o30cr5cco30c1g60o30dr56k', 'gCalendar'),
(1376, 'Día de la Ciudad Autónoma de Ceuta (Ceuta)', '2021-09-02 00:00:00', '2021-09-02 23:59:59', 'Festivo o celebración en: Ceuta', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210902_60o30cr66ko30c1g60o30dr56k', 'gCalendar'),
(1377, 'Virgen de la Victoria (Melilla)', '2021-09-08 00:00:00', '2021-09-08 23:59:59', 'Festivo o celebración en: Melilla', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210908_60o30cr6c4o30c1g60o30dr56k', 'gCalendar'),
(1378, 'Nuestra Señora de la Bien Aparecida (Cantabria)', '2021-09-15 00:00:00', '2021-09-15 23:59:59', 'Festivo o celebración en: Cantabria', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210915_60o30cr6coo30c1g60o30dr56k', 'gCalendar'),
(1379, 'Lunes posterior a la Segunda Fiesta de Navidad (Baleares)', '2021-12-27 00:00:00', '2021-12-27 23:59:59', 'Festivo o celebración en: Baleares', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20211227_60o30cr56oo32c1g60o30dr56k', 'gCalendar'),
(1380, 'Día de la Toma (Granada)', '2019-01-02 00:00:00', '2019-01-02 23:59:59', 'Festivo o celebración en: Granada', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190102_60o32e356go30c1g60o30dr56c', 'gCalendar'),
(1381, 'Dia de San Isidro (Madrid)', '2019-05-15 00:00:00', '2019-05-15 23:59:59', 'Festivo o celebración en: Madrid', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190515_60o30ob360o30c1g60o30dr56c', 'gCalendar'),
(1382, 'Día de la Ciudad Autónoma de Ceuta (Ceuta)', '2019-09-02 00:00:00', '2019-09-02 23:59:59', 'Festivo o celebración en: Ceuta', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190902_60o30cr66ko30c1g60o30dr56c', 'gCalendar'),
(1383, 'Lunes siguiente a la Día de Asturias (Asturias)', '2019-09-09 00:00:00', '2019-09-09 23:59:59', 'Festivo o celebración en: Asturias', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190909_60o30cr66so30c1g60o30dr56c', 'gCalendar'),
(1384, 'Día de Extremadura (Extremadura)', '2020-09-08 00:00:00', '2020-09-08 23:59:59', 'Festivo o celebración en: Extremadura', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200908_60o30cr670o30c1g60o30dr56g', 'gCalendar'),
(1385, 'Nuestra Señora de la Bien Aparecida (Cantabria)', '2020-09-15 00:00:00', '2020-09-15 23:59:59', 'Festivo o celebración en: Cantabria', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200915_60o30cr6coo30c1g60o30dr56g', 'gCalendar'),
(1386, 'Día de Melilla (Melilla)', '2020-09-17 00:00:00', '2020-09-17 23:59:59', 'Festivo o celebración en: Melilla', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200917_60o30cr6c8o30c1g60o30dr56g', 'gCalendar'),
(1387, 'Día de Andalucía (Andalucía)', '2021-02-28 00:00:00', '2021-02-28 23:59:59', 'Festivo o celebración en: Andalucía', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210228_60o30cr5c8o30c1g60o30dr56k', 'gCalendar'),
(1388, 'Día de la Communidad Madrid (Madrid)', '2021-05-03 00:00:00', '2021-05-03 23:59:59', 'Festivo o celebración en: Madrid', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210503_60o30d1g74o30e1g60o30dr56k', 'gCalendar'),
(1389, 'Día de la Región de Murcia (Murcia)', '2021-06-09 00:00:00', '2021-06-09 23:59:59', 'Festivo o celebración en: Murcia', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210609_60o30cr5coo30c1g60o30dr56k', 'gCalendar'),
(1390, 'Día de la Rioja (La Rioja)', '2021-06-09 00:00:00', '2021-06-09 23:59:59', 'Festivo o celebración en: La Rioja', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210609_60o30cr664o30c1g60o30dr56k', 'gCalendar'),
(1391, 'Cincomarzada (Zaragoza)', '2019-03-05 00:00:00', '2019-03-05 23:59:59', 'Festivo o celebración en: Zaragoza', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190305_60o32d9h6co30c1g60o30dr56c', 'gCalendar'),
(1392, 'Día de las Letras Gallegas (Galicia)', '2019-05-17 00:00:00', '2019-05-17 23:59:59', 'Festivo o celebración en: Galicia', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190517_60o30cr6cgo30c1g60o30dr56c', 'gCalendar'),
(1393, 'Día de la Comunidad Valenciana (Valenciana)', '2019-10-09 00:00:00', '2019-10-09 23:59:59', 'Festivo o celebración en: Valenciana', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20191009_60o30d1g60o30c1g60o30dr56c', 'gCalendar'),
(1394, 'Lunes siguiente a La Inmaculada Concepción (festivo regional)', '2019-12-09 00:00:00', '2019-12-09 23:59:59', 'Festivo o celebración en: Andalucía, Aragón, Asturias, Cantabria, Castilla y León, Extremadura, Madrid, La Rioja, Melilla', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20191209_60o30cr56go32c1g60o30dr56c', 'gCalendar'),
(1395, 'San Jorge. Día de Aragón (Aragón)', '2020-04-23 00:00:00', '2020-04-23 23:59:59', 'Festivo o celebración en: Aragón', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200423_60o30cr5cco30c1g60o30dr56g', 'gCalendar'),
(1396, 'Día de Nuestra Señora de África (Ceuta)', '2021-08-05 00:00:00', '2021-08-05 23:59:59', 'Festivo o celebración en: Ceuta', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210805_60o30cr66go30c1g60o30dr56k', 'gCalendar'),
(1397, 'Día de la Rioja (La Rioja)', '2020-06-09 00:00:00', '2020-06-09 23:59:59', 'Festivo o celebración en: La Rioja', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200609_60o30cr664o30c1g60o30dr56g', 'gCalendar'),
(1398, 'Día de Asturias (Asturias)', '2020-09-08 00:00:00', '2020-09-08 23:59:59', 'Festivo o celebración en: Asturias', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200908_60o30cr66oo30c1g60o30dr56g', 'gCalendar'),
(1399, 'Día de Asturias (Asturias)', '2021-09-08 00:00:00', '2021-09-08 23:59:59', 'Festivo o celebración en: Asturias', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210908_60o30cr66oo30c1g60o30dr56k', 'gCalendar'),
(1400, 'Día de San Valentín', '2019-02-14 00:00:00', '2019-02-14 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190214_60o32eb16go30c1g60o30dr56c', 'gCalendar'),
(1401, 'Día de San Valentín', '2020-02-14 00:00:00', '2020-02-14 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200214_60o32eb16go30c1g60o30dr56g', 'gCalendar');
INSERT INTO `events` (`id`, `title`, `start_at`, `end_at`, `notes`, `private`, `user_id`, `created_at`, `updated_at`, `category`, `place`, `eventable_type`, `eventable_id`, `external_key`, `external_calendar`) VALUES
(1402, 'Día de San Valentín', '2021-02-14 00:00:00', '2021-02-14 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210214_60o32eb16go30c1g60o30dr56k', 'gCalendar'),
(1403, 'Día de la Región de Murcia (Murcia)', '2019-06-09 00:00:00', '2019-06-09 23:59:59', 'Festivo o celebración en: Murcia', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190609_60o30cr5coo30c1g60o30dr56c', 'gCalendar'),
(1404, 'Día de la Rioja (La Rioja)', '2019-06-09 00:00:00', '2019-06-09 23:59:59', 'Festivo o celebración en: La Rioja', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190609_60o30cr664o30c1g60o30dr56c', 'gCalendar'),
(1405, 'descanso laboral correspondiente a Día de la Región de Murcia (Murcia)', '2019-06-10 00:00:00', '2019-06-10 23:59:59', 'Festivo o celebración en: Murcia', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190610_60o30cr5coo30e1g60o30dr56c', 'gCalendar'),
(1406, 'descanso laboral correspondiente a Día de la Rioja (La Rioja)', '2019-06-10 00:00:00', '2019-06-10 23:59:59', 'Festivo o celebración en: La Rioja', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190610_60o30cr664o30e1g60o30dr56c', 'gCalendar'),
(1407, 'Lunes de Pentecostés (festivo regional)', '2019-06-10 00:00:00', '2019-06-10 23:59:59', 'Festivo o celebración en: Barcelona, Gerona', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190610_60o30cr570o30c1g60o30dr56c', 'gCalendar'),
(1408, 'Corpus Christi (festivo regional)', '2019-06-20 00:00:00', '2019-06-20 23:59:59', 'Festivo o celebración en: Castilla-La Mancha, Granada', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190620_60o30ob2coo36c1g60o30dr56c', 'gCalendar'),
(1409, 'Sant Magí (Tarragona)', '2019-08-19 00:00:00', '2019-08-19 23:59:59', 'Festivo o celebración en: Tarragona', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190819_60o32ob26go32c1g60o30dr56c', 'gCalendar'),
(1410, 'San Ildefonso (Toledo)', '2020-01-23 00:00:00', '2020-01-23 23:59:59', 'Festivo o celebración en: Toledo', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200123_60o32ob26oo30c1g60o30dr56g', 'gCalendar'),
(1411, 'Martes de Carnaval (festivo regional)', '2020-02-25 00:00:00', '2020-02-25 23:59:59', 'Festivo o celebración en: Badajoz, La Coruña, Las Palmas, Lugo, Santa Cruz De Tenerife, Orense', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200225_60o32o9p64o30c1g60o30dr56g', 'gCalendar'),
(1412, 'San Pedro Regalado (Valladolid)', '2020-05-13 00:00:00', '2020-05-13 23:59:59', 'Festivo o celebración en: Valladolid', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200513_60o32ob2c4o30c1g60o30dr56g', 'gCalendar'),
(1413, 'Lunes de Pentecostés (festivo regional)', '2020-06-01 00:00:00', '2020-06-01 23:59:59', 'Festivo o celebración en: Barcelona, Gerona', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200601_60o30cr570o30c1g60o30dr56g', 'gCalendar'),
(1414, 'Eid al-Adha (festivo regional)', '2020-07-31 00:00:00', '2020-07-31 23:59:59', 'Festivo o celebración en: Ceuta, Melilla', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200731_60o30ob364o30c1g60o30db164', 'gCalendar'),
(1415, 'Virgen de la Antigua (Guadalajara)', '2020-09-08 00:00:00', '2020-09-08 23:59:59', 'Festivo o celebración en: Guadalajara', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200908_60o32ob1c4o30c1g60o30dr56g', 'gCalendar'),
(1416, 'Santa Teresa de Jesús (Ávila)', '2020-10-15 00:00:00', '2020-10-15 23:59:59', 'Festivo o celebración en: Ávila', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20201015_60o32ob260o30c1g60o30dr56g', 'gCalendar'),
(1417, 'Lunes de Pentecostés (festivo regional)', '2021-05-24 00:00:00', '2021-05-24 23:59:59', 'Festivo o celebración en: Barcelona, Gerona', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210524_60o30cr570o30c1g60o30dr56k', 'gCalendar'),
(1418, 'Corpus Christi (Castilla-La Mancha)', '2021-06-03 00:00:00', '2021-06-03 23:59:59', 'Festivo o celebración en: Castilla-La Mancha', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210603_60o30ob2coo30c1g60o30dr56k', 'gCalendar'),
(1419, 'Lunes de Pascua (festivo regional)', '2019-04-22 00:00:00', '2019-04-22 23:59:59', 'Festivo o celebración en: Baleares, Cantabria, Castilla-La Mancha, Cataluña, Valenciana, Navarra, País Vasco, La Rioja', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190422_60o30d1g64o32c1g60o30dr56c', 'gCalendar'),
(1420, 'Fiestas de las Vaquillas (Teruel)', '2019-07-13 00:00:00', '2019-07-13 23:59:59', 'Festivo o celebración en: Teruel', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190713_60o32ob274o32c1g60o30dr56c', 'gCalendar'),
(1421, 'Virgen Blanca (Álava)', '2019-08-05 00:00:00', '2019-08-05 23:59:59', 'Festivo o celebración en: Álava', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190805_60o32o9p60o30c1g60o30dr56c', 'gCalendar'),
(1422, 'San Sebastián (Guipúzcoa)', '2020-01-20 00:00:00', '2020-01-20 23:59:59', 'Festivo o celebración en: Guipúzcoa', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200120_60o32ob26co30c1g60o30dr56g', 'gCalendar'),
(1423, 'El día de Vicente Mártir (Valencia)', '2020-01-22 00:00:00', '2020-01-22 23:59:59', 'Festivo o celebración en: Valencia', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200122_60o32d9h6go30c1g60o30dr56g', 'gCalendar'),
(1424, 'Día de San Jorge (Cáceres)', '2020-04-23 00:00:00', '2020-04-23 23:59:59', 'Festivo o celebración en: Cáceres', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200423_60o30or3c8o32c1g60o30dr56g', 'gCalendar'),
(1425, 'San Segundo (Ávila)', '2020-05-02 00:00:00', '2020-05-02 23:59:59', 'Festivo o celebración en: Ávila', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200502_60o32ob1coo30c1g60o30dr56g', 'gCalendar'),
(1426, 'Virgen de Alarcos (Ciudad Real)', '2020-06-01 00:00:00', '2020-06-01 23:59:59', 'Festivo o celebración en: Ciudad Real', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200601_60o32ob16so30c1g60o30dr56g', 'gCalendar'),
(1427, 'San Juan de Sahagún (Salamanca)', '2020-06-12 00:00:00', '2020-06-12 23:59:59', 'Festivo o celebración en: Salamanca', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200612_60o32ob364o30c1g60o30dr56g', 'gCalendar'),
(1428, 'Fiestas de las Vaquillas (Teruel)', '2020-07-13 00:00:00', '2020-07-13 23:59:59', 'Festivo o celebración en: Teruel', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200713_60o32ob274o30c1g60o30dr56g', 'gCalendar'),
(1429, 'Virgen Blanca (Álava)', '2020-08-05 00:00:00', '2020-08-05 23:59:59', 'Festivo o celebración en: Álava', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200805_60o32o9p60o30c1g60o30dr56g', 'gCalendar'),
(1430, 'Virgen del Mar (Almería)', '2020-08-29 00:00:00', '2020-08-29 23:59:59', 'Festivo o celebración en: Almería', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200829_60o32o9p6ko30c1g60o30dr56g', 'gCalendar'),
(1431, 'San Antolín (Palencia)', '2020-09-02 00:00:00', '2020-09-02 23:59:59', 'Festivo o celebración en: Palencia', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200902_60o32ob2coo30c1g60o30dr56g', 'gCalendar'),
(1432, 'Nuestra Señora de la Cinta (Huelva)', '2020-09-08 00:00:00', '2020-09-08 23:59:59', 'Festivo o celebración en: Huelva', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200908_60o32o9pc8o30c1g60o30dr56g', 'gCalendar'),
(1433, 'Romería de la Virgen de la Fuensanta (Murcia)', '2020-09-15 00:00:00', '2020-09-15 23:59:59', 'Festivo o celebración en: Murcia', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200915_60o32o9pcoo30c1g60o30dr56g', 'gCalendar'),
(1434, 'Santa Tecla (Tarragona)', '2020-09-23 00:00:00', '2020-09-23 23:59:59', 'Festivo o celebración en: Tarragona', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200923_60o32ob26ko30c1g60o30dr56g', 'gCalendar'),
(1435, 'Virgen del Rosario (festivo regional)', '2020-10-07 00:00:00', '2020-10-07 23:59:59', 'Festivo o celebración en: La Coruña, Cádiz', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20201007_60o32o9p6go30c1g60o30dr56g', 'gCalendar'),
(1436, 'San Martín (Orense)', '2020-11-11 00:00:00', '2020-11-11 23:59:59', 'Festivo o celebración en: Orense', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20201111_60o32ob360o30c1g60o30dr56g', 'gCalendar'),
(1437, 'Día de la Constitución Española (festivo regional)', '2020-12-06 00:00:00', '2020-12-06 23:59:59', 'Festivo o celebración en: Andalucía, Aragón, Asturias, Baleares, Canarias, Castilla y León, Extremadura, La Rioja, Madrid, Murcia, Navarra, Ceuta, Melilla', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20201206_60o30cr568o32c1g60o30dr56g', 'gCalendar'),
(1438, 'Virgen Blanca (Álava)', '2021-08-05 00:00:00', '2021-08-05 23:59:59', 'Festivo o celebración en: Álava', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210805_60o32o9p60o30c1g60o30dr56k', 'gCalendar'),
(1439, 'Santa Leocadia (Toledo)', '2021-12-09 00:00:00', '2021-12-09 23:59:59', 'Festivo o celebración en: Toledo', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20211209_60o32ob26so32c1g60o30dr56k', 'gCalendar'),
(1440, 'San Esteban (festivo regional)', '2021-12-26 00:00:00', '2021-12-26 23:59:59', 'Festivo o celebración en: Baleares, Cataluña', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20211226_60o30cr56so30c1g60o30dr56k', 'gCalendar'),
(1441, 'San Esteban (festivo regional)', '2019-12-26 00:00:00', '2019-12-26 23:59:59', 'Festivo o celebración en: Baleares, Cataluña', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20191226_60o30cr56so32c1g60o30dr56c', 'gCalendar'),
(1442, 'Las Candelas (Palencia)', '2020-02-02 00:00:00', '2020-02-02 23:59:59', 'Festivo o celebración en: Palencia', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200202_60o32ob2cko30c1g60o30dr56g', 'gCalendar'),
(1443, 'descanso laboral correspondiente a Las Candelas (Palencia)', '2020-02-03 00:00:00', '2020-02-03 23:59:59', 'Festivo o celebración en: Palencia', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200203_60o32ob2cko30e1g60o30dr56g', 'gCalendar'),
(1444, 'Lunes de Pascua (festivo regional)', '2020-04-13 00:00:00', '2020-04-13 23:59:59', 'Festivo o celebración en: Baleares, País Vasco, Cantabria, Cataluña, La Rioja, Navarra, Valenciana', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200413_60o30d1g64o30c1g60o30dr56g', 'gCalendar'),
(1445, 'Sermón de las Tortillas (Teruel)', '2020-04-14 00:00:00', '2020-04-14 23:59:59', 'Festivo o celebración en: Teruel', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200414_60o32ob270o30c1g60o30dr56g', 'gCalendar'),
(1446, 'San Anastasi (Lérida)', '2020-05-11 00:00:00', '2020-05-11 23:59:59', 'Festivo o celebración en: Lérida', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200511_60o32ob374o30c1g60o30dr56g', 'gCalendar'),
(1447, 'Día de la Región de Castilla-La Mancha (Castilla-La Mancha)', '2020-05-31 00:00:00', '2020-05-31 23:59:59', 'Festivo o celebración en: Castilla-La Mancha', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200531_60o30d1g70o32c1g60o30dr56g', 'gCalendar'),
(1448, 'Festividad de la Hiniesta (Zamora)', '2020-06-01 00:00:00', '2020-06-01 23:59:59', 'Festivo o celebración en: Zamora', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200601_60o32ob2cgo30c1g60o30dr56g', 'gCalendar'),
(1449, 'San Pedro (festivo regional)', '2020-06-29 00:00:00', '2020-06-29 23:59:59', 'Festivo o celebración en: Burgos, Castellón, Segovia, Zamora', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200629_60o32ob16co30c1g60o30dr56g', 'gCalendar'),
(1450, 'Toma de Málaga por los Reyes Católicos (Málaga)', '2020-08-19 00:00:00', '2020-08-19 23:59:59', 'Festivo o celebración en: Málaga', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200819_60o32o9p6so30c1g60o30dr56g', 'gCalendar'),
(1451, 'Sant Magí (Tarragona)', '2020-08-19 00:00:00', '2020-08-19 23:59:59', 'Festivo o celebración en: Tarragona', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200819_60o32ob26go30c1g60o30dr56g', 'gCalendar'),
(1452, 'Viernes Semana Grande (Vizcaya)', '2020-08-28 00:00:00', '2020-08-28 23:59:59', 'Festivo o celebración en: Vizcaya', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200828_60o32ob1cco30c1g60o30dr56g', 'gCalendar'),
(1453, 'Día Festivo Nuestra Señora de San Lorenzo (Valladolid)', '2020-09-08 00:00:00', '2020-09-08 23:59:59', 'Festivo o celebración en: Valladolid', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200908_60o32ob2cco30c1g60o30dr56g', 'gCalendar'),
(1454, 'Sermón de las Tortillas (Teruel)', '2021-04-14 00:00:00', '2021-04-14 23:59:59', 'Festivo o celebración en: Teruel', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210414_60o32ob270o32c1g60o30dr56k', 'gCalendar'),
(1455, 'Sant Magí (Tarragona)', '2021-08-19 00:00:00', '2021-08-19 23:59:59', 'Festivo o celebración en: Tarragona', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210819_60o32ob26go32c1g60o30dr56k', 'gCalendar'),
(1456, 'Santa Tecla (Tarragona)', '2021-09-23 00:00:00', '2021-09-23 23:59:59', 'Festivo o celebración en: Tarragona', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210923_60o32ob26ko32c1g60o30dr56k', 'gCalendar'),
(1457, 'Eid al-Adha (festivo regional)', '2019-08-12 00:00:00', '2019-08-12 23:59:59', 'Festivo o celebración en: Ceuta, Melilla', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190812_60o30ob364o30c1g60o30db160', 'gCalendar'),
(1458, 'Santa Tecla (Tarragona)', '2019-09-23 00:00:00', '2019-09-23 23:59:59', 'Festivo o celebración en: Tarragona', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190923_60o32ob26ko32c1g60o30dr56c', 'gCalendar'),
(1459, 'Lunes de la Fiesta de la Magdalena (Castellón)', '2020-03-16 00:00:00', '2020-03-16 23:59:59', 'Festivo o celebración en: Castellón', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200316_60o32ob1cko30c1g60o30dr56g', 'gCalendar'),
(1460, 'Santa Faz (Alicante)', '2020-04-23 00:00:00', '2020-04-23 23:59:59', 'Festivo o celebración en: Alicante', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200423_60o32o9p68o30c1g60o30dr56g', 'gCalendar'),
(1461, 'San Antonio (Ceuta)', '2020-06-13 00:00:00', '2020-06-13 23:59:59', 'Festivo o celebración en: Ceuta', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200613_60o30cr66co32c1g60o30dr56g', 'gCalendar'),
(1462, 'Curpillos (Burgos)', '2020-06-19 00:00:00', '2020-06-19 23:59:59', 'Festivo o celebración en: Burgos', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200619_60o32ob168o30c1g60o30dr56g', 'gCalendar'),
(1463, 'Fiestas Colombinas (Huelva)', '2020-08-03 00:00:00', '2020-08-03 23:59:59', 'Festivo o celebración en: Huelva', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200803_60o32o9pc4o30c1g60o30dr56g', 'gCalendar'),
(1464, 'Virgen de los Llanos (Albacete)', '2020-09-08 00:00:00', '2020-09-08 23:59:59', 'Festivo o celebración en: Albacete', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200908_60o32o9ocko30c1g60o30dr56g', 'gCalendar'),
(1465, 'Viernes de Feria (Guadalajara)', '2020-09-18 00:00:00', '2020-09-18 23:59:59', 'Festivo o celebración en: Guadalajara', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200918_60o32ob1c8o30c1g60o30dr56g', 'gCalendar'),
(1466, 'San Miguel (Lérida)', '2020-09-29 00:00:00', '2020-09-29 23:59:59', 'Festivo o celebración en: Lérida', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200929_60o32ob3c4o30c1g60o30dr56g', 'gCalendar'),
(1467, 'Santa Catalina (Jaén)', '2020-11-25 00:00:00', '2020-11-25 23:59:59', 'Festivo o celebración en: Jaén', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20201125_60o32o9pcco30c1g60o30dr56g', 'gCalendar'),
(1468, 'Día de la Constitución Española (festivo regional)', '2020-12-07 00:00:00', '2020-12-07 23:59:59', 'Festivo o celebración en: Andalucía, Aragón, Asturias, Baleares, Canarias, Castilla y León, Extremadura, La Rioja, Madrid, Murcia, Navarra, Ceuta, Melilla', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20201207_60o30cr568o34c1g60o30dr56g', 'gCalendar'),
(1469, 'Santa Leocadia (Toledo)', '2020-12-09 00:00:00', '2020-12-09 23:59:59', 'Festivo o celebración en: Toledo', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20201209_60o32ob26so30c1g60o30dr56g', 'gCalendar'),
(1470, 'Sermón de las Tortillas (Teruel)', '2019-04-14 00:00:00', '2019-04-14 23:59:59', 'Festivo o celebración en: Teruel', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190414_60o32ob270o32c1g60o30dr56c', 'gCalendar'),
(1471, 'Festividad del Día de Canarias (Canarias)', '2019-05-30 00:00:00', '2019-05-30 23:59:59', 'Festivo o celebración en: Canarias', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20190530_60o30d1g6oo32c1g60o30dr56c', 'gCalendar'),
(1472, 'Día de la Constitución Española', '2019-12-06 00:00:00', '2019-12-06 23:59:59', '', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20191206_60o30cr568o36c1g60o30dr56c', 'gCalendar'),
(1473, 'Santa Leocadia (Toledo)', '2019-12-09 00:00:00', '2019-12-09 23:59:59', 'Festivo o celebración en: Toledo', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20191209_60o32ob26so32c1g60o30dr56c', 'gCalendar'),
(1474, 'San Julian (Cuenca)', '2020-01-28 00:00:00', '2020-01-28 23:59:59', 'Festivo o celebración en: Cuenca', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200128_60o32ob36oo30c1g60o30dr56g', 'gCalendar'),
(1475, 'Dia de las Islas Baleares (Baleares)', '2020-03-01 00:00:00', '2020-03-01 23:59:59', 'Festivo o celebración en: Baleares', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200301_60o30d1g6ko32c1g60o30dr56g', 'gCalendar'),
(1476, 'Estatuto de Autonomía de la Ciudad de Melilla (Melilla)', '2020-03-13 00:00:00', '2020-03-13 23:59:59', 'Festivo o celebración en: Melilla', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200313_60o32o9p6oo30c1g60o30dr56g', 'gCalendar'),
(1477, 'San Vicente Ferrer (Valencia)', '2020-04-20 00:00:00', '2020-04-20 23:59:59', 'Festivo o celebración en: Valencia', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200420_60o32ob2c8o30c1g60o30dr56g', 'gCalendar'),
(1478, 'Feria de San Fernando (Cáceres)', '2020-05-29 00:00:00', '2020-05-29 23:59:59', 'Festivo o celebración en: Cáceres', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200529_60o32ob264o30c1g60o30dr56g', 'gCalendar'),
(1479, 'Virgen de la Luz (Cuenca)', '2020-06-01 00:00:00', '2020-06-01 23:59:59', 'Festivo o celebración en: Cuenca', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200601_60o32ob3cco30c1g60o30dr56g', 'gCalendar'),
(1480, 'Virgen de la Capilla (Jaén)', '2020-06-11 00:00:00', '2020-06-11 23:59:59', 'Festivo o celebración en: Jaén', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200611_60o32o9p74o30c1g60o30dr56g', 'gCalendar'),
(1481, 'Fogueres (Alicante)', '2020-06-22 00:00:00', '2020-06-22 23:59:59', 'Festivo o celebración en: Alicante', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200622_60o32o9p6co30c1g60o30dr56g', 'gCalendar'),
(1482, 'San Benito (Pontevedra)', '2020-07-11 00:00:00', '2020-07-11 23:59:59', 'Festivo o celebración en: Pontevedra', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200711_60o32ob160o30c1g60o30dr56g', 'gCalendar'),
(1483, 'Día de Nuestra Señora de África (Ceuta)', '2020-08-05 00:00:00', '2020-08-05 23:59:59', 'Festivo o celebración en: Ceuta', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20200805_60o30cr66go32c1g60o30dr56g', 'gCalendar'),
(1484, 'San Saturio (Soria)', '2020-10-02 00:00:00', '2020-10-02 23:59:59', 'Festivo o celebración en: Soria', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20201002_60o32ob36ko30c1g60o30dr56g', 'gCalendar'),
(1485, 'San Frutos (Segovia)', '2020-10-25 00:00:00', '2020-10-25 23:59:59', 'Festivo o celebración en: Segovia', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20201025_60o32ob3cgo30c1g60o30dr56g', 'gCalendar'),
(1486, 'descanso laboral correspondiente a San Frutos (Segovia)', '2020-10-26 00:00:00', '2020-10-26 23:59:59', 'Festivo o celebración en: Segovia', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20201026_60o32ob3cgo30e1g60o30dr56g', 'gCalendar'),
(1487, 'Sant Narcís (Gerona)', '2020-10-29 00:00:00', '2020-10-29 23:59:59', 'Festivo o celebración en: Gerona', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20201029_60o32ob174o30c1g60o30dr56g', 'gCalendar'),
(1488, 'San Ildefonso (Toledo)', '2021-01-23 00:00:00', '2021-01-23 23:59:59', 'Festivo o celebración en: Toledo', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210123_60o32ob26oo32c1g60o30dr56k', 'gCalendar'),
(1489, 'Lunes de Pascua (festivo regional)', '2021-04-05 00:00:00', '2021-04-05 23:59:59', 'Festivo o celebración en: Baleares, País Vasco, Cantabria, Cataluña, La Rioja, Navarra, Valenciana', 1, 15, '2020-10-18 20:03:51', '2020-10-18 20:03:51', 'O', NULL, 'App\\GoogleCalendar', 8, '20210405_60o30d1g64o30c1g60o30dr56k', 'gCalendar'),
(1490, 'Fiestas de las Vaquillas (Teruel)', '2021-07-13 00:00:00', '2021-07-13 23:59:59', 'Festivo o celebración en: Teruel', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20210713_60o32ob274o32c1g60o30dr56k', 'gCalendar'),
(1491, 'Virgen de los Llanos (Albacete)', '2021-09-08 00:00:00', '2021-09-08 23:59:59', 'Festivo o celebración en: Albacete', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20210908_60o32o9ocko30c1g60o30dr56k', 'gCalendar'),
(1492, 'San Ildefonso (Toledo)', '2019-01-23 00:00:00', '2019-01-23 23:59:59', 'Festivo o celebración en: Toledo', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20190123_60o32ob26oo32c1g60o30dr56c', 'gCalendar'),
(1493, 'Dia de las Islas Baleares (Baleares)', '2019-03-01 00:00:00', '2019-03-01 23:59:59', 'Festivo o celebración en: Baleares', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20190301_60o30d1g6ko34c1g60o30dr56c', 'gCalendar'),
(1494, 'Jueves Santo (festivo regional)', '2019-04-18 00:00:00', '2019-04-18 23:59:59', 'Festivo o celebración en: Andalucía, Aragón, Asturias, Baleares, País Vasco, Canarias, Castilla-La Mancha, Castilla y León, Ceuta, Extremadura, Galicia, Madrid, Melilla, Murcia, Navarra, La Rioja', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20190418_60o30d1g6co36c1g60o30dr56c', 'gCalendar'),
(1495, 'Virgen de los Llanos (Albacete)', '2019-09-08 00:00:00', '2019-09-08 23:59:59', 'Festivo o celebración en: Albacete', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20190908_60o32o9ocko30c1g60o30dr56c', 'gCalendar'),
(1496, 'San Vicente (Huesca)', '2020-01-22 00:00:00', '2020-01-22 23:59:59', 'Festivo o celebración en: Huesca', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20200122_60o32o9pcgo30c1g60o30dr56g', 'gCalendar'),
(1497, 'Lunes de Carnaval (festivo regional)', '2020-02-24 00:00:00', '2020-02-24 23:59:59', 'Festivo o celebración en: Cádiz, Santa Cruz De Tenerife', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20200224_60o32ob268o30c1g60o30dr56g', 'gCalendar'),
(1498, 'Miércoles de Feria (Sevilla)', '2020-04-09 00:00:00', '2020-04-09 23:59:59', 'Festivo o celebración en: Sevilla', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20200409_60o32ob36co30c1g60o30dr56g', 'gCalendar'),
(1499, 'San Prudencio (Álava)', '2020-04-28 00:00:00', '2020-04-28 23:59:59', 'Festivo o celebración en: Álava', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20200428_60o32o9ocoo30c1g60o30dr56g', 'gCalendar'),
(1500, 'Día de las Letras Gallegas (Galicia)', '2020-05-17 00:00:00', '2020-05-17 23:59:59', 'Festivo o celebración en: Galicia', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20200517_60o30cr6cgo32c1g60o30dr56g', 'gCalendar'),
(1501, 'Jueves La Saca (Soria)', '2020-06-25 00:00:00', '2020-06-25 23:59:59', 'Festivo o celebración en: Soria', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20200625_60o32ob36go30c1g60o30dr56g', 'gCalendar'),
(1502, 'San Ignacio de Loyola (festivo regional)', '2020-07-31 00:00:00', '2020-07-31 23:59:59', 'Festivo o celebración en: Guipúzcoa, Vizcaya', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20200731_60o32ob170o30c1g60o30dr56g', 'gCalendar'),
(1503, 'San Lorenzo (Huesca)', '2020-08-10 00:00:00', '2020-08-10 23:59:59', 'Festivo o celebración en: Huesca', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20200810_60o32ob164o30c1g60o30dr56g', 'gCalendar'),
(1504, 'La Octava de la Virgen del Prado (Ciudad Real)', '2020-08-22 00:00:00', '2020-08-22 23:59:59', 'Festivo o celebración en: Ciudad Real', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20200822_60o32ob16go30c1g60o30dr56g', 'gCalendar'),
(1505, 'Día de la Victoria (Málaga)', '2020-09-08 00:00:00', '2020-09-08 23:59:59', 'Festivo o celebración en: Málaga', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20200908_60o32o9p70o30c1g60o30dr56g', 'gCalendar'),
(1506, 'Virgen de Guadalupe (Córdoba)', '2020-09-08 00:00:00', '2020-09-08 23:59:59', 'Festivo o celebración en: Córdoba', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20200908_60o32ob16ko30c1g60o30dr56g', 'gCalendar'),
(1507, 'Virgen de la Vega (Salamanca)', '2020-09-08 00:00:00', '2020-09-08 23:59:59', 'Festivo o celebración en: Salamanca', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20200908_60o32ob368o30c1g60o30dr56g', 'gCalendar'),
(1508, 'La Mercè (Barcelona)', '2020-09-24 00:00:00', '2020-09-24 23:59:59', 'Festivo o celebración en: Barcelona', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20200924_60o32ob1cgo30c1g60o30dr56g', 'gCalendar'),
(1509, 'San Froilán (festivo regional)', '2020-10-05 00:00:00', '2020-10-05 23:59:59', 'Festivo o celebración en: León, Lugo', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20201005_60o32ob36so30c1g60o30dr56g', 'gCalendar'),
(1510, 'San Rafael (Córdoba)', '2020-10-24 00:00:00', '2020-10-24 23:59:59', 'Festivo o celebración en: Córdoba', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20201024_60o32ob16oo30c1g60o30dr56g', 'gCalendar'),
(1511, 'La Almudena (Madrid)', '2020-11-09 00:00:00', '2020-11-09 23:59:59', 'Festivo o celebración en: Madrid', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20201109_60o32ob3c8o30c1g60o30dr56g', 'gCalendar'),
(1512, 'San Esteban (festivo regional)', '2020-12-26 00:00:00', '2020-12-26 23:59:59', 'Festivo o celebración en: Baleares, Cataluña', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20201226_60o30cr56so30c1g60o30dr56g', 'gCalendar'),
(1513, 'San Juan (festivo regional)', '2019-06-24 00:00:00', '2019-06-24 23:59:59', 'Festivo o celebración en: Almería, Badajoz, Las Palmas, León', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20190624_60o32ob370o34c1g60o30dr56c', 'gCalendar'),
(1514, 'Día del Pendón (Almería)', '2020-12-26 00:00:00', '2020-12-26 23:59:59', 'Festivo o celebración en: Almería', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20201226_60o32ob660o30c1g60o30dr56g', 'gCalendar'),
(1515, 'San Juan (festivo regional)', '2021-06-24 00:00:00', '2021-06-24 23:59:59', 'Festivo o celebración en: Almería, Badajoz, Las Palmas, León', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20210624_60o32ob370o34c1g60o30dr56k', 'gCalendar'),
(1516, 'Día de Todos los Santos (festivo regional)', '2020-11-01 00:00:00', '2020-11-01 23:59:59', 'Festivo o celebración en: Andalucía, Aragón, Asturias, Castilla y León, Extremadura, Madrid', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20201101_60o30cr564o34c1g60o30dr56g', 'gCalendar'),
(1517, 'Día de Todos los Santos (festivo regional)', '2020-11-02 00:00:00', '2020-11-02 23:59:59', 'Festivo o celebración en: Andalucía, Aragón, Asturias, Castilla y León, Extremadura, Madrid', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20201102_60o30cr564o36c1g60o30dr56g', 'gCalendar'),
(1518, 'San José (festivo regional)', '2019-03-19 00:00:00', '2019-03-19 23:59:59', 'Festivo o celebración en: Valenciana, Galicia, Murcia, Navarra, País Vasco', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20190319_60o30d1g68o36c1g60o30dr56c', 'gCalendar'),
(1519, 'La revetlla de Sant Joan (festivo regional)', '2019-06-24 00:00:00', '2019-06-24 23:59:59', 'Festivo o celebración en: Cataluña, Albacete', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20190624_60o30d1g6go3ac1g60o30dr56c', 'gCalendar'),
(1520, 'Santiago Apóstol (festivo regional)', '2019-07-25 00:00:00', '2019-07-25 23:59:59', 'Festivo o celebración en: Galicia, Cantabria, País Vasco', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20190725_60o30d1gc4o36c1g60o30dr56c', 'gCalendar'),
(1521, 'San José (festivo regional)', '2020-03-19 00:00:00', '2020-03-19 23:59:59', 'Festivo o celebración en: País Vasco, Castilla-La Mancha, Galicia, Murcia, Navarra, Valenciana', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 8, '20200319_60o30d1g68o32c1g60o30dr56g', 'gCalendar'),
(1522, 'Tarea S19, Calendario 02', '2020-09-19 00:00:00', '2020-09-19 23:59:59', '', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 10, '5qdut5s5sh27buf96i181i1213', 'gCalendar'),
(1523, 'Recordatorio día 17, tarea 01', '2020-09-17 00:00:00', '2020-09-17 23:59:59', 'Realizar la tarea 01del día 17', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 12, '04u7k0rgn90t8sr1us4nq1ah87', 'gCalendar'),
(1524, 'Evento 02', '2020-10-10 00:00:00', '2020-10-10 23:59:59', 'Recordar Evento 02', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 12, '05g9i3b2dc23i2eqbmghbfd3in', 'gCalendar'),
(1525, 'Ey', '2020-10-13 09:30:00', '2020-10-13 10:30:00', '', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 12, '3aathhbc1i3km806ahu2gis6hb', 'gCalendar'),
(1526, 'Evento Hola 01', '2020-10-14 10:30:00', '2020-10-14 11:30:00', 'Hola 01 - hoy', 1, 15, '2020-10-18 20:03:52', '2020-10-18 20:03:52', 'O', NULL, 'App\\GoogleCalendar', 11, '6uein1ft82dbukpdvhg3d3n2o3', 'gCalendar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `google_calendars`
--

CREATE TABLE `google_calendars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nombre del calendario',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'Descripción del calendario',
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Color asignado al calendario',
  `google_id` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Identificador del calendario en google',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `google_calendars`
--

INSERT INTO `google_calendars` (`id`, `name`, `description`, `color`, `google_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Calendario 03', NULL, '#fa573c', 'j50tsksqcoj6f29tt209bj6qjo@group.calendar.google.com', 187, '2020-10-14 11:43:25', '2020-10-14 11:43:25'),
(2, 'Primario', NULL, '#9fe1e7', 'testtristest@gmail.com', 187, '2020-10-14 11:43:25', '2020-10-14 11:43:25'),
(3, 'Calendario 02', NULL, '#cd74e6', 'lkilqb3qgo3vp788llhnj5sdak@group.calendar.google.com', 187, '2020-10-14 11:43:25', '2020-10-14 11:43:25'),
(4, 'Cumpleaños', 'Muestra los cumpleaños, los aniversarios y otros eventos de tus contactos de Google.', '#92e1c0', 'addressbook#contacts@group.v.calendar.google.com', 187, '2020-10-14 11:43:25', '2020-10-15 08:04:52'),
(5, 'Festivos en España', 'Festivos y celebraciones de España', '#16a765', 'es.spain#holiday@group.v.calendar.google.com', 187, '2020-10-14 11:43:25', '2020-10-15 08:04:52'),
(6, 'Primario', NULL, '#9fe1e7', 'topdev.venezuela@gmail.com', 8, '2020-10-15 01:43:45', '2020-10-15 01:43:45'),
(7, 'Diplomado de Redes Sociales Única', NULL, '#263238', 'classroom115276541661140157847@group.calendar.google.com', 8, '2020-10-15 01:43:45', '2020-10-15 01:43:45'),
(8, 'Festivos en España', 'Festivos y celebraciones de España', '#16a765', 'es.spain#holiday@group.v.calendar.google.com', 15, '2020-10-15 08:04:15', '2020-10-15 08:04:15'),
(9, 'Cumpleaños', 'Muestra los cumpleaños, los aniversarios y otros eventos de tus contactos de Google.', '#92e1c0', 'addressbook#contacts@group.v.calendar.google.com', 15, '2020-10-15 08:04:15', '2020-10-15 08:04:15'),
(10, 'Calendario 02', NULL, '#cd74e6', 'lkilqb3qgo3vp788llhnj5sdak@group.calendar.google.com', 15, '2020-10-15 08:04:15', '2020-10-15 08:04:15'),
(11, 'Calendario 03', NULL, '#fa573c', 'j50tsksqcoj6f29tt209bj6qjo@group.calendar.google.com', 15, '2020-10-15 08:04:15', '2020-10-15 08:04:15'),
(12, 'Primario', NULL, '#9fe1e7', 'testtristest@gmail.com', 15, '2020-10-15 08:04:15', '2020-10-15 08:04:15'),
(13, 'Calendario 03', NULL, '#fa573c', 'j50tsksqcoj6f29tt209bj6qjo@group.calendar.google.com', 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42'),
(14, 'Calendario 02', NULL, '#cd74e6', 'lkilqb3qgo3vp788llhnj5sdak@group.calendar.google.com', 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42'),
(15, 'Cumpleaños', 'Muestra los cumpleaños, los aniversarios y otros eventos de tus contactos de Google.', '#92e1c0', 'addressbook#contacts@group.v.calendar.google.com', 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42'),
(16, 'Festivos en España', 'Festivos y celebraciones de España', '#16a765', 'es.spain#holiday@group.v.calendar.google.com', 17, '2020-10-18 19:25:42', '2020-10-18 19:25:42'),
(17, 'Primario', NULL, '#9fe1e7', 'testtristest@gmail.com', 17, '2020-10-18 19:25:43', '2020-10-18 19:25:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nombre del Grupo',
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Id del usario que crea el grupo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id`, `name`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Grupo para Andrés', 9, '2020-06-22 09:40:55', '2020-06-22 09:40:55'),
(2, 'Grupo de Trabajo', 22, '2020-07-22 13:00:44', '2020-07-22 13:00:44'),
(3, 'ventonic', 8, '2020-07-22 20:02:31', '2020-07-22 20:02:31'),
(4, 'Empresas vendedor2', 16, '2020-07-23 15:34:42', '2020-07-23 15:34:42'),
(5, 'Alfa', 9, '2020-09-15 11:48:39', '2020-09-15 11:48:39'),
(6, 'GRUPO-PRUEBA', 14, '2020-10-19 22:37:37', '2020-10-19 22:40:41'),
(7, 'GRUPO 2 DE PRUEBA', 14, '2020-10-19 22:41:33', '2020-10-19 22:41:33'),
(8, 'Prueba iiii', 18, '2020-10-19 23:54:38', '2020-10-19 23:54:38'),
(9, 'PRUEBA IV', 18, '2020-10-19 23:55:18', '2020-10-19 23:55:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group_negotiation`
--

CREATE TABLE `group_negotiation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `negotiation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `group_negotiation`
--

INSERT INTO `group_negotiation` (`id`, `group_id`, `negotiation_id`, `created_at`, `updated_at`) VALUES
(1, 3, 128, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group_user`
--

CREATE TABLE `group_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Id del grupo de usuario',
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Id del usario que crea el grupo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `group_user`
--

INSERT INTO `group_user` (`id`, `group_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 9, '2020-07-22 19:57:30', '2020-07-22 19:57:30'),
(2, 3, 9, '2020-07-23 12:48:08', '2020-07-23 12:48:08'),
(3, 4, 9, '2020-07-23 15:43:30', '2020-07-23 15:43:30'),
(4, 5, 18, '2020-09-15 11:49:49', '2020-09-15 11:49:49'),
(5, 6, 18, '2020-10-20 00:37:26', '2020-10-20 00:37:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invitations`
--

CREATE TABLE `invitations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendiente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `invitations`
--

INSERT INTO `invitations` (`id`, `group_id`, `user_id`, `token`, `status`, `created_at`, `updated_at`, `email`) VALUES
(1, 1, NULL, 'tOH0QAsr3qgWLoyDeMpJ', 'aceptada', '2020-07-22 12:46:19', '2020-07-23 15:43:30', 'Vendedorventon@Gmail.Com'),
(2, 1, NULL, 'hv8BuksQV7m65wRIp3gO', 'pendiente', '2020-07-22 12:57:53', '2020-07-22 12:57:53', 'Vendedorventon@Gmail.Com'),
(3, 2, NULL, '9r8IUqsSoX1AVExzMv3f', 'aceptada', '2020-07-22 13:00:44', '2020-07-22 19:57:30', 'empresa1@ventonic.com'),
(4, 3, NULL, 'fjoEeqgJGd4nYXMutvyl', 'aceptada', '2020-07-22 20:02:31', '2020-07-23 12:48:08', 'empresa1@ventonic.com'),
(5, 4, NULL, 'YIq5L23C9gw8HicQNfSu', 'aceptada', '2020-07-23 15:34:42', '2020-07-23 21:59:34', 'empresa1@ventonic.com'),
(6, 4, NULL, '3ajfBo4ebGDVwnNkROtP', 'aceptada', '2020-07-23 15:34:49', '2020-07-27 13:21:34', 'empresa1@ventonic.com'),
(7, 5, NULL, 'EA94UtKzDGbvlFRe5a8Q', 'aceptada', '2020-09-15 11:48:39', '2020-09-20 10:32:22', 'vendedor3@ventonic.com'),
(8, 6, NULL, 'G9mzVKjhDxQwk0O34nAl', 'pendiente', '2020-10-19 22:37:37', '2020-10-19 22:37:37', 'vendedor3@ventonic.com'),
(9, 7, NULL, 'ywdqP9ijnZrMfFKYl7vE', 'pendiente', '2020-10-19 22:41:33', '2020-10-19 22:41:33', 'vendedor5@ventonic.com'),
(10, 8, NULL, 'MparcnuW9LPFSXvIYR5x', 'pendiente', '2020-10-19 23:54:38', '2020-10-19 23:54:38', 'empresa3@ventonic.com'),
(11, 9, NULL, '1TJkFMHw7DNrtlZYyGV0', 'pendiente', '2020-10-19 23:55:18', '2020-10-19 23:55:18', 'empresa3@ventonic.com'),
(12, 9, NULL, 'rN2uf0e35ma78v9DRCPX', 'pendiente', '2020-10-19 23:55:51', '2020-10-19 23:55:51', 'cdvaltovalor@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_functions`
--

CREATE TABLE `job_functions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `job_functions`
--

INSERT INTO `job_functions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Administración', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(2, 'Análisis', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(3, 'Arte/Creatividad', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(4, 'Atención al cliente', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(5, 'Atención médica', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(6, 'Cadena de abastecimiento', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(7, 'Ciencias', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(8, 'Compras', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(9, 'Consultoría', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(10, 'Contabilidad/Auditorías', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(11, 'Control de calidad', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(12, 'Desarrollo empresarial', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(13, 'Diseño', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(14, 'Distribución', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(15, 'Educación', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(16, 'Estrategia/planificación', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(17, 'Finanzas', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(18, 'Formación', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(19, 'Gestión', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(20, 'Gestión de productos', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(21, 'Gestión de proyectos', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(22, 'Ingeniería', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(23, 'Investigación', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(24, 'Legal', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(25, 'Marketing', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(26, 'Manufactura', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(27, 'Negocios', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(28, 'Producción', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(29, 'Publicidad', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(30, 'Recursos humanos', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(31, 'Redacción y Revisión', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(32, 'Relaciones públicas', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(33, 'Tecnología de la información', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(34, 'Ventas', '2020-10-15 18:36:13', '2020-10-15 18:36:13'),
(35, 'Otros', '2020-10-15 18:36:13', '2020-10-15 18:36:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_types`
--

CREATE TABLE `job_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `job_types`
--

INSERT INTO `job_types` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Empleado de tiempo completo', NULL, NULL),
(2, 'Empleado de medio tiempo', NULL, NULL),
(3, 'Freelancer / Contratista', NULL, NULL),
(4, 'Pasante', NULL, NULL),
(5, 'Consultor', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unreaded` tinyint(1) NOT NULL DEFAULT '1',
  `chat_room_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`id`, `message`, `user_id`, `created_at`, `updated_at`, `unreaded`, `chat_room_id`) VALUES
(1, 'Buenos dias', 9, '2020-08-29 00:31:28', '2020-10-15 15:11:07', 0, 34),
(2, 'Estas disponible', 9, '2020-08-29 00:37:57', '2020-10-15 15:11:07', 0, 34),
(3, 'Hola', 8, '2020-09-08 09:21:37', '2020-10-20 07:14:12', 0, 34),
(4, 'Hola', 9, '2020-09-08 09:30:59', '2020-10-15 15:11:07', 0, 35),
(5, 'Buenos días', 9, '2020-09-08 09:31:24', '2020-10-15 15:11:07', 0, 35),
(6, 'Buenos dias', 8, '2020-09-08 09:48:54', '2020-10-20 07:14:12', 0, 35),
(7, 'Estás disponible?', 9, '2020-09-08 09:52:21', '2020-10-15 15:11:07', 0, 35),
(8, 'Sí, estoy disponible', 8, '2020-09-08 09:53:21', '2020-10-20 07:14:12', 0, 34),
(9, 'No leo la frase de \"Sí, estoy disponible\"', 9, '2020-09-08 09:54:04', '2020-10-15 15:11:07', 0, 35),
(10, 'Hola, he visto tu perfil y me gustaría contar contigo para cerrar ventas a través de las llamadas que lleguen a mi web', 9, '2020-09-20 10:30:34', '2020-10-15 15:11:07', 0, 36),
(11, 'Hola, gracias por contactar. ¡¡Estupendo!!', 18, '2020-09-20 10:31:09', '2020-10-19 14:58:40', 0, 36),
(12, 'Necesitaría tu PIN de vendedor para generar el widget Call Me', 9, '2020-09-20 10:31:48', '2020-10-15 15:11:07', 0, 36),
(13, 'Lo puedes encontrar en tu perfil de Ventonic', 9, '2020-09-20 10:32:08', '2020-10-15 15:11:07', 0, 36),
(14, 'Existe un botón \"Copiar mi PIN\"', 9, '2020-09-20 10:33:10', '2020-10-15 15:11:07', 0, 36),
(15, 'bd34c317-c173-4b47-b1ed-1b770586390d', 18, '2020-09-20 10:33:27', '2020-10-19 14:58:40', 0, 36),
(16, 'Ahí tienes', 18, '2020-09-20 10:33:31', '2020-10-19 14:58:40', 0, 36),
(17, 'Hola, he visto tu perfil y me gustaría contar contigo para cerrar ventas a través de las llamadas que lleguen a mi web', 9, '2020-09-20 11:47:37', '2020-10-15 15:11:07', 0, 39),
(18, 'Hola, gracias por contactar. ¡¡Estupendo!!', 18, '2020-09-20 11:48:00', '2020-10-19 14:58:40', 0, 36),
(19, 'hola', 15, '2020-09-30 10:49:58', '2020-10-19 15:45:30', 0, 40),
(20, 'qué tal', 17, '2020-09-30 10:50:22', '2020-10-19 15:04:20', 0, 40),
(21, 'bien', 15, '2020-09-30 10:50:50', '2020-10-19 15:45:30', 0, 40),
(22, 'he visto tu perfil y me gustaría saber algo más acerca de él', 15, '2020-09-30 10:53:04', '2020-10-19 15:45:30', 0, 40),
(23, 'qué necesitas saber?', 17, '2020-09-30 10:53:45', '2020-10-19 15:04:20', 0, 40),
(24, 'puedes detallarme tus últimos trabajos?', 15, '2020-09-30 10:59:04', '2020-10-19 15:45:30', 0, 40),
(25, 'Saludos', 8, '2020-10-01 22:39:40', '2020-10-20 07:14:12', 0, 35),
(27, 'Hola muy buenas. Pues me parece genial. En que puedo ayudaros?', 18, '2020-10-02 10:10:21', '2020-10-19 14:58:40', 0, NULL),
(32, 'Hola 02', 15, '2020-10-05 07:47:20', '2020-10-19 15:45:30', 0, 40),
(33, 'Hola de nuevo', 17, '2020-10-05 07:47:45', '2020-10-19 15:04:20', 0, 40),
(34, 'alguna novedad', 15, '2020-10-05 07:48:11', '2020-10-19 15:45:30', 0, 40),
(35, 'Reportaré novedades al final de la mañana, ok?', 17, '2020-10-05 07:48:42', '2020-10-19 15:04:20', 0, 40),
(38, 'Hola', 15, '2020-10-08 21:17:06', '2020-10-19 15:45:30', 0, 48),
(39, '¿Qué hay?', 187, '2020-10-08 21:17:30', '2020-10-19 15:04:17', 0, 48),
(40, 'Vi su perfil en la aplicación', 15, '2020-10-08 21:18:09', '2020-10-19 15:45:30', 0, 48),
(41, 'Me alegro, ¿en qué puedo ayudarle?', 187, '2020-10-08 21:18:31', '2020-10-19 15:04:17', 0, 48),
(42, '¿qué disponibilidad tiene?', 15, '2020-10-08 21:19:04', '2020-10-19 15:45:30', 0, 48),
(52, 'Hola, muy buenas. Me encantaría agenda una reunión para presentarte una propuesta.', 14, '2020-10-15 15:12:29', '2020-10-19 15:23:53', 0, 49),
(53, 'Hola, buen día!', 18, '2020-10-15 15:13:03', '2020-10-19 14:58:40', 0, 49),
(54, 'Pues me encantaría que hablásemos', 18, '2020-10-15 15:13:16', '2020-10-19 14:58:40', 0, 49),
(55, '¿Te parecería bien  lunes 17:00 H?', 18, '2020-10-15 15:13:55', '2020-10-19 14:58:40', 0, 49),
(56, 'listo', 9, '2020-10-20 07:14:05', '2020-10-20 07:14:05', 1, 52);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_04_27_094348_create_cache_table', 1),
(5, '2020_04_27_094404_create_sessions_table', 1),
(6, '2020_04_27_125317_create_seller_profiles_table', 1),
(7, '2020_04_27_125403_create_company_profiles_table', 1),
(8, '2020_04_27_192934_create_questions_table', 1),
(9, '2020_04_27_211736_add_field_answered_to_seller_profiles', 1),
(10, '2020_04_27_211843_add_field_answered_to_company_profiles', 1),
(11, '2020_04_28_110847_change_fields_to_seller_profiles_table', 1),
(12, '2020_04_28_135737_add_field_notified_to_seller_profiles_table', 1),
(13, '2020_04_28_135803_add_field_notified_to_company_profiles_table', 1),
(14, '2020_05_01_100456_create_seller_answered_surveys_table', 1),
(15, '2020_05_01_112854_create_company_answered_surveys_table', 1),
(16, '2020_05_01_133929_add_field_last_login_to_users_table', 1),
(17, '2020_05_05_195431_create_messages_table', 1),
(18, '2020_05_07_140152_add_field_photo_to_company_profiles_table', 1),
(19, '2020_05_07_184004_create_websockets_statistics_entries_table', 1),
(20, '2020_05_17_215317_create_ubication_oportunitys_table', 1),
(21, '2020_05_17_220010_create_job_types_table', 1),
(22, '2020_05_17_220424_create_time_zone_oportunitys_table', 1),
(23, '2020_05_17_220602_create_sector_oportunitys_table', 1),
(24, '2020_05_17_220731_create_profesions_table', 1),
(26, '2020_05_17_221226_create_skills_table', 1),
(27, '2020_05_17_221357_create_oportunitys_table', 1),
(28, '2020_05_17_221750_create_aplicants_table', 1),
(31, '2020_05_22_055329_create_aplicants_table', 4),
(40, '2020_05_17_221000_create_type_oportunitys_table', 5),
(41, '2020_05_22_044652_create_status_oportunitys_table', 5),
(42, '2020_05_22_045600_create_oportunitys_table', 5),
(43, '2020_05_25_175304_create_aptitudes_table', 5),
(44, '2020_05_30_222255_create_status_postulations_table', 5),
(45, '2020_05_30_223139_create_aplicants_table', 5),
(46, '2020_06_01_163945_create_negociations_table', 5),
(47, '2020_06_01_182317_create_countries_table', 5),
(48, '2020_06_01_184037_create_status_negociations_table', 5),
(49, '2020_06_01_185244_create_negociations_company_table', 5),
(50, '2020_06_01_190501_create_contacts_table', 5),
(51, '2020_06_02_144134_create_events_table', 6),
(52, '2020_06_03_111554_change_fields_to_events_table', 7),
(53, '2020_06_04_145113_create_notifications_table', 7),
(54, '2020_06_06_091113_add_field_place_to_events_table', 7),
(55, '2020_06_07_052739_create_websockets_statistics_entries_table', 8),
(56, '2020_06_09_024021_create_negociation_type_table', 8),
(57, '2020_06_09_030033_create_negociation_note_table', 8),
(58, '2020_06_09_030114_create_negociation_contact_table', 8),
(59, '2020_06_09_030416_create_negociation_event_table', 8),
(60, '2020_06_11_183355_create_groups_table', 9),
(61, '2020_06_11_184015_create_group_user_table', 9),
(62, '2020_06_12_044816_create_contact_group_user_table', 9),
(63, '2020_06_12_074859_create_module_labels_table', 9),
(64, '2020_06_12_081326_create_user_module_labels_table', 9),
(65, '2020_06_12_082207_create_notes_table', 10),
(66, '2020_06_12_174707_add_field_to_contacts', 10),
(67, '2020_06_14_004441_create_contact_group_table', 10),
(68, '2020_06_12_082207_create_todos_table', 11),
(69, '2020_06_17_055814_create_invitations_table', 12),
(70, '2020_06_09_180928_create_chat_rooms_table', 13),
(71, '2020_06_09_181123_create_chat_room_user_table', 13),
(72, '2020_06_09_181302_add_field_to_messages_table', 13),
(73, '2020_06_22_165950_change_events_notes_field', 14),
(74, '2020_06_24_210924_change_fields_to_invitations_table', 15),
(75, '2020_06_24_212824_change_field_user_id_to_invitations_table', 15),
(76, '2020_06_26_175509_delete_old_negotiations_tables', 16),
(77, '2020_06_26_201149_create_negotiation_types_table', 16),
(78, '2020_06_27_020406_create_negotiation_statuses_table', 16),
(79, '2020_06_27_021423_create_negotiations_table', 16),
(80, '2020_06_27_025544_change_module_labels_field', 16),
(81, '2020_07_06_140548_add_deadline_to_negotiations', 17),
(82, '2020_07_07_220930_change_negotiations_amount_field', 18),
(83, '2020_07_08_015048_create_email_settings_table', 19),
(85, '2020_07_10_003633_create_negotiation_user_table', 21),
(86, '2020_07_09_015743_create_email_messages_table', 22),
(87, '2020_07_27_043014_update_notes_table', 23),
(88, '2020_07_27_045740_add_fields_to_events_table', 23),
(89, '2020_07_27_051340_add_field_group_id_to_negotiations_table', 23),
(90, '2020_07_27_055852_create_documents_table', 23),
(91, '2020_07_27_060232_create_emails_table', 23),
(92, '2020_07_27_200913_create_group_negotiation_table', 24),
(93, '2020_07_27_214218_add_field_uuid_to_users_table', 24),
(94, '2020_07_25_111938_add_won_status_date_to_negotiations_table', 25),
(95, '2020_07_29_010610_create_negotiation_process_table', 25),
(96, '2020_07_29_053047_add_field_emailable_to_emails_table', 26),
(97, '2020_07_30_053405_add_field_note_to_documents_table', 27),
(98, '2020_07_28_104539_create_apps_table', 28),
(99, '2020_07_28_105034_create_widget_table', 28),
(100, '2020_07_28_105145_create_widget_data_table', 28),
(101, '2020_08_03_120815_change_field_note_to_documents_table', 28),
(102, '2020_08_03_143318_create_call_results_table', 28),
(103, '2020_08_03_144314_create_call_events_table', 28),
(104, '2020_08_03_152108_create_task_queues_table', 28),
(105, '2020_08_03_152329_create_task_priorities_table', 28),
(106, '2020_08_03_152413_create_task_types_table', 28),
(107, '2020_08_03_154335_create_tasks_table', 28),
(108, '2020_08_03_214100_add_field_user_id_to_tasks_table', 28),
(109, '2020_08_03_214119_add_field_user_id_to_call_events_table', 28),
(110, '2020_08_06_022634_add_image_to_apps', 29),
(111, '2020_08_06_054252_add_field_destination_email_to_emails_table', 30),
(112, '2020_08_07_191027_add_file_to_apps_table', 31),
(113, '2020_08_12_190845_create_contact_types_table', 32),
(114, '2020_08_12_191210_add_field_contact_type_id_to_contacts_table', 32),
(115, '2020_08_13_030956_add_field_expire_at_to_oportunitys_table', 33),
(116, '2020_08_13_231123_add_field_user_id_to_documents_table', 34),
(117, '2020_08_14_004534_add_unique_fields_to_widget_table', 34),
(118, '2020_08_17_014524_add_field_conversion_to_negotiation_process_table', 35),
(119, '2020_08_17_052218_create_negotiation_process_history_table', 35),
(120, '2020_08_17_052239_create_negotiation_statuses_history_table', 35),
(121, '2020_08_18_031500_add_fields_for_change_image_to_contacts_table', 36),
(122, '2020_08_18_072340_add_field_is_admin_to_users_table', 36),
(123, '2018_10_10_000000_create_mail_templates_table', 37),
(124, '2020_08_25_224311_create_email_templates_table', 37),
(125, '2020_09_07_000638_add_file_module_to_email_templates_table', 38),
(126, '2020_09_12_155328_add_files_to_oportunitys_table', 39),
(127, '2020_09_16_005410_add_dash_demo_to_users_table', 39),
(128, '2020_09_10_013938_create_calendar_settings_table', 40),
(129, '2020_09_23_155300_create_google_calendars_table', 41),
(130, '2020_09_23_155401_add_field_external_key_to_events_table', 41),
(131, '2020_09_29_005913_add_fields_external_key_and_external_contact_to_contacts_table', 42),
(132, '2020_09_29_031655_change_app_type_field_to_calendar_settings_table', 43),
(133, '2020_10_15_171946_create_job_functions_table', 44),
(134, '2020_10_18_171907_add_field_download_time_to_email_settings_table', 45);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `module_labels`
--

CREATE TABLE `module_labels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `labels` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `module_labels`
--

INSERT INTO `module_labels` (`id`, `module`, `labels`, `created_at`, `updated_at`) VALUES
(1, 'Todos', '[{\"id\":1,\"label\":\"Personal\"},{\"id\":2,\"label\":\"Trabajo\"},{\"id\":3,\"label\":\"Llamada\"},{\"id\":4,\"label\":\"Proyecto\"}]', '2020-06-30 01:57:37', NULL),
(2, 'Negotiations', NULL, '2020-06-30 01:57:37', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negotiations`
--

CREATE TABLE `negotiations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `contact_id` bigint(20) UNSIGNED NOT NULL,
  `neg_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `neg_status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `neg_process_id` bigint(20) DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `won_status_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `negotiations`
--

INSERT INTO `negotiations` (`id`, `user_id`, `contact_id`, `neg_type_id`, `neg_status_id`, `neg_process_id`, `title`, `description`, `amount`, `active`, `created_at`, `updated_at`, `deadline`, `won_status_date`) VALUES
(1, 9, 9, 1, 3, 1, 'Negociación de prueba', 'La primera negociación!', 3560.76, 0, '2020-06-30 10:14:39', '2020-06-30 10:16:40', NULL, NULL),
(3, 9, 6, 1, 3, 1, 'Test!', 'This is the third test!', 3650.87, 0, '2020-07-13 07:12:58', '2020-07-15 03:52:11', '2020-07-13', NULL),
(4, 9, 6, 3, 3, 2, 'Test de bug', 'Creo que identifiqué un BUG, sigo haciendo pruebas!', 500, 1, '2020-06-30 10:18:33', '2020-07-01 11:28:17', NULL, NULL),
(5, 9, 9, 1, 3, 1, 'Compra Pc', 'Compra de Pc', 1000, 0, '2020-07-03 04:08:22', '2020-07-03 05:14:33', NULL, NULL),
(6, 9, 99, 3, 3, 2, 'Vel quibusdam molestiae illo quas.', 'Aut debitis enim mollitia voluptatum. Dolores qui dolorem odio accusantium.', 48824.84, 1, '2020-06-27 10:00:00', '2020-07-11 04:10:05', '2020-07-31', NULL),
(7, 9, 101, 3, 1, 2, 'Adipisci quia fugit ab.', 'Est non quidem et est. Corrupti rerum mollitia id sed at eos non.', 2803.83, 1, '2020-06-27 10:00:00', '2020-07-11 04:10:05', '2020-07-31', '2020-08-17 21:00:49'),
(8, 9, 117, 2, 3, 1, 'Est exercitationem quia repellat magnam nostrum.', 'Laborum itaque et magni quia id. Similique dolor maxime recusandae repellat quis rem.', 88565.64, 1, '2020-06-27 10:00:00', '2020-07-13 07:11:13', '2020-07-31', NULL),
(9, 9, 145, 2, 3, 6, 'Dignissimos consequatur consequatur quidem autem aut.', 'Itaque aliquam et in ratione magni. Soluta et neque cumque ratione.', 32553.62, 1, '2020-06-27 10:00:00', '2020-07-11 04:10:06', '2020-07-31', NULL),
(10, 9, 126, 3, 2, 1, 'Unde aut nihil rerum cupiditate fugiat ut voluptatem.', 'Est earum natus ut repudiandae repellendus. Rerum sed nostrum enim voluptatem dolores molestiae.', 1467.81, 1, '2020-06-27 10:00:00', '2020-07-11 04:10:06', '2020-07-31', '2020-08-17 21:00:54'),
(11, 9, 27, 2, 3, 1, 'Nostrum reiciendis sit quia impedit.', 'Provident iure nihil fuga eum. Quo odit velit sed. Tempora dolor minus laboriosam ex veritatis.', 27235.62, 1, '2020-06-28 10:00:00', '2020-07-11 04:10:06', '2020-07-31', NULL),
(12, 9, 126, 2, 1, 6, 'Est adipisci minima dolores cupiditate ducimus enim.', 'Vero neque placeat non recusandae voluptates eius. Autem amet et sed est. Odit magnam ducimus vel.', 80511.17, 1, '2020-06-28 10:00:00', '2020-07-11 04:10:06', '2020-07-31', '2020-08-17 21:00:49'),
(13, 9, 62, 3, 1, 3, 'Porro sint eum sit fugiat quia quisquam non.', 'Animi asperiores modi sed doloribus eveniet reprehenderit quo. Ut laboriosam non earum rerum.', 45145.19, 1, '2020-06-28 10:00:00', '2020-07-11 04:10:06', '2020-07-31', '2020-08-17 21:00:49'),
(14, 9, 59, 3, 3, 1, 'Corrupti molestiae aliquid saepe natus.', 'Qui odit in dolores quia. Expedita facilis eum reiciendis earum.', 45466.8, 1, '2020-06-28 10:00:00', '2020-07-11 04:10:06', '2020-07-31', NULL),
(15, 9, 75, 1, 1, 4, 'Voluptates qui accusamus id quam rem.', 'Est esse et beatae quam. Ad unde repellendus id. Eum quia dolorem vitae non rerum.', 13601.34, 1, '2020-06-28 10:00:00', '2020-07-11 04:10:06', '2020-07-31', '2020-08-17 21:00:49'),
(16, 9, 139, 2, 2, 6, 'Magni libero itaque repellat.', 'Explicabo ut laborum laudantium molestiae rerum itaque. Qui aut et quia vitae aliquam id.', 93055.1, 1, '2020-07-13 07:11:57', '2020-08-21 20:14:34', '2020-07-31', '2020-08-21 20:14:34'),
(17, 9, 120, 2, 2, 1, 'Ipsum qui quas qui dicta consequatur odio.', 'Explicabo ad qui non magni neque ea. Hic qui alias qui pariatur voluptas asperiores quas.', 74326.3, 1, '2020-06-29 10:00:00', '2020-07-11 04:10:06', '2020-07-31', '2020-08-17 21:00:54'),
(18, 9, 9, 1, 2, 5, 'Magnam expedita dolorem ut corrupti officia.', 'Et qui error vel fugit aut commodi nihil. Labore et voluptas quod et qui odio ex pariatur.', 41696.08, 1, '2020-06-29 10:00:00', '2020-07-11 04:10:06', '2020-07-31', '2020-08-17 21:00:54'),
(19, 9, 35, 3, 1, 3, 'Fuga laboriosam aspernatur autem consequatur excepturi facere.', 'Molestias sint nam provident voluptas. Labore vel soluta laborum deserunt sed.', 46558.88, 1, '2020-06-29 10:00:00', '2020-07-11 04:10:06', '2020-07-31', '2020-08-17 21:00:49'),
(20, 9, 138, 3, 2, 1, 'In recusandae laudantium aut sunt et debitis repellendus.', 'Officia repellat beatae est. Ut quidem hic impedit. Et nisi non enim quis est dolor quos.', 38040.93, 1, '2020-06-29 10:00:00', '2020-07-11 04:10:06', '2020-07-31', '2020-08-17 21:00:54'),
(21, 9, 68, 3, 3, 5, 'Et deserunt est consequatur ea non culpa.', 'Eius a id porro sunt aspernatur qui rerum. Nobis exercitationem excepturi fugiat.', 1802.02, 1, '2020-06-30 10:00:00', '2020-07-11 04:10:06', '2020-07-31', NULL),
(22, 9, 47, 2, 2, 1, 'Vitae dicta enim aut fugiat voluptatem sapiente.', 'Eum ut nulla iure. Quia tenetur reprehenderit exercitationem doloremque dolores sequi.', 34667.05, 1, '2020-06-30 10:00:00', '2020-07-11 04:10:06', '2020-07-31', '2020-08-17 21:00:54'),
(23, 9, 9, 1, 2, 6, 'Repellat corporis corporis vel quo voluptatem doloremque.', 'Dolore ut id placeat minima iure. Temporibus dolorem in voluptatibus sint.', 907.88, 1, '2020-06-30 10:00:00', '2020-07-11 04:10:06', '2020-07-31', '2020-08-17 21:00:54'),
(24, 9, 100, 1, 1, 6, 'Officiis dolorem aut occaecati dolores qui est quaerat modi.', 'Est adipisci dolores cupiditate consequatur repellendus. Consequatur eveniet quas eaque harum qui.', 68146.16, 1, '2020-06-30 10:00:00', '2020-07-11 04:10:06', '2020-07-31', '2020-08-17 21:00:49'),
(25, 9, 16, 1, 1, 5, 'A voluptatem sit est et impedit qui.', 'A perspiciatis et quidem veniam. Quidem eum ducimus repellendus qui ut quae alias.', 19385.65, 1, '2020-06-30 10:00:00', '2020-07-11 04:10:06', '2020-07-31', '2020-08-17 21:00:49'),
(28, 9, 48, 3, 3, 2, 'Tempore et nesciunt sit perferendis.', 'Maiores officia atque unde sed explicabo maxime. Alias omnis quis nulla nihil.', 57660.44, 1, '2020-07-02 10:00:00', '2020-07-11 04:10:06', '2020-07-31', NULL),
(29, 9, 146, 3, 2, 5, 'Cupiditate consequatur error explicabo mollitia at soluta sit sint.', 'Soluta voluptate assumenda quam unde molestiae qui. Nihil numquam assumenda maxime repellendus.', 69900.06, 1, '2020-07-02 10:00:00', '2020-07-11 04:10:06', '2020-07-31', '2020-08-17 21:00:54'),
(30, 9, 128, 2, 3, 5, 'Consequatur saepe repellendus est qui voluptates qui ut fugiat.', 'Numquam blanditiis eligendi quis. Rerum quo omnis et. Excepturi consectetur vel et.', 11821.64, 1, '2020-07-02 10:00:00', '2020-07-11 04:10:06', '2020-07-31', NULL),
(31, 9, 27, 2, 1, 3, 'Reprehenderit et consequuntur nobis molestias ipsum ut a.', 'At et et provident perspiciatis iste facere mollitia. Nobis magnam rerum iste ipsum animi.', 66978.99, 1, '2020-07-03 10:00:00', '2020-07-11 04:10:06', '2020-07-31', '2020-08-17 21:00:49'),
(32, 9, 129, 2, 1, 1, 'Non aut ut et sunt molestiae amet laboriosam.', 'In natus deleniti ea id reiciendis consectetur dolorem. Ullam accusantium adipisci amet cum.', 18640.63, 1, '2020-07-03 10:00:00', '2020-07-11 04:10:06', '2020-07-31', '2020-08-17 21:00:49'),
(33, 9, 12, 1, 2, 6, 'Perferendis est non aut.', 'Non et quod quibusdam sit. Accusantium quia minima officiis eveniet.', 20042.28, 1, '2020-07-03 10:00:00', '2020-07-11 04:10:06', '2020-07-31', '2020-08-17 21:00:54'),
(35, 9, 151, 2, 3, 1, 'Repellat provident accusamus repudiandae fugit commodi totam et.', 'Voluptatem ut placeat ut. Quia rerum aliquam qui voluptatem facere.', 52556.03, 1, '2020-07-04 10:00:00', '2020-07-11 04:10:07', '2020-07-31', NULL),
(36, 9, 49, 2, 1, 3, 'Ut architecto praesentium officiis vel et.', 'Itaque explicabo ad ut. Voluptatum ut cum sit rerum maiores enim. Deserunt eveniet qui voluptates.', 32403.91, 1, '2020-07-04 10:00:00', '2020-07-11 04:10:07', '2020-07-31', '2020-08-17 21:00:49'),
(37, 9, 158, 3, 2, 6, 'Ut dolorum inventore rerum iste nulla.', 'Praesentium non consequuntur est ut. Voluptas cumque quae esse in omnis.', 38530.58, 1, '2020-07-04 10:00:00', '2020-07-11 04:10:07', '2020-07-31', '2020-08-17 21:00:54'),
(38, 9, 128, 1, 1, 6, 'Officiis possimus occaecati aut neque optio eum voluptatibus.', 'Rerum cum vitae assumenda. Nobis eum inventore ut praesentium facilis suscipit.', 41240.12, 1, '2020-07-04 10:00:00', '2020-07-11 04:10:07', '2020-07-31', '2020-08-17 21:00:49'),
(39, 9, 110, 3, 2, 3, 'Labore dolores sunt eveniet quos laborum pariatur facere.', 'Facere labore nam et. Eius maiores nemo repudiandae magnam. Eos modi aut porro.', 51680.42, 1, '2020-07-04 10:00:00', '2020-07-11 04:10:07', '2020-07-31', '2020-08-17 21:00:54'),
(40, 9, 115, 2, 2, 2, 'Mollitia velit ut impedit sed.', 'Dolores nisi quia consequuntur est fugiat aut omnis omnis. Architecto commodi ipsa error.', 38698.3, 1, '2020-07-04 10:00:00', '2020-07-11 04:10:07', '2020-07-31', '2020-08-17 21:00:54'),
(41, 9, 68, 2, 1, 2, 'Ut repellat nemo quaerat.', 'Optio quo vel quia laudantium. Voluptatibus neque eaque qui debitis voluptate.', 33566.12, 1, '2020-07-04 10:00:00', '2020-07-11 04:10:07', '2020-07-31', '2020-08-17 21:00:49'),
(42, 9, 101, 1, 1, 6, 'Et non enim labore laudantium rerum.', 'Nobis placeat sit dignissimos ut qui et. Ea possimus consequatur aut aut.', 44007.57, 1, '2020-07-04 10:00:00', '2020-07-11 04:10:07', '2020-07-31', '2020-08-17 21:00:49'),
(43, 9, 112, 1, 3, 3, 'Et id omnis provident velit qui veniam nesciunt.', 'Doloribus fuga veniam eaque rem distinctio. Molestias cumque est a culpa consectetur vero.', 74709.71, 1, '2020-07-04 10:00:00', '2020-07-11 04:10:07', '2020-07-31', NULL),
(44, 9, 47, 3, 1, 6, 'Nulla aut sit ad temporibus.', 'Et velit aut odit. Hic eligendi repellendus aperiam porro qui distinctio cumque voluptatum.', 59004.73, 1, '2020-07-05 10:00:00', '2020-07-11 04:10:07', '2020-07-31', '2020-08-17 21:00:49'),
(45, 9, 93, 1, 3, 6, 'Dolore quia voluptatem sint ratione quos.', 'Fugit voluptatum ut sit. In velit molestiae sunt et ut fuga. Eveniet qui qui eum quia iste autem.', 12175.22, 1, '2020-07-05 10:00:00', '2020-07-11 04:10:07', '2020-07-31', NULL),
(46, 9, 35, 3, 3, 1, 'Rerum non voluptas nihil ullam vitae odit.', 'Minus distinctio quia qui molestias quo soluta et consequuntur. Vitae doloremque excepturi sequi.', 14238.14, 1, '2020-07-05 10:00:00', '2020-07-11 04:10:07', '2020-07-31', NULL),
(47, 9, 41, 3, 1, 2, 'Qui at adipisci exercitationem expedita tempore ipsum quas.', 'Sit porro explicabo delectus numquam. Et molestias velit sunt rerum ullam eos quia dicta.', 10400.41, 1, '2020-07-05 10:00:00', '2020-07-11 04:10:07', '2020-07-31', '2020-08-17 21:00:49'),
(48, 9, 145, 2, 3, 1, 'Assumenda pariatur deserunt ipsam exercitationem sit mollitia sit.', 'Id aliquam nihil non ut. Dolores omnis quia aut a. Minus qui quis harum et.', 65309.59, 1, '2020-07-05 10:00:00', '2020-07-11 04:10:07', '2020-07-31', NULL),
(49, 9, 41, 2, 3, 6, 'Modi et blanditiis libero quia nesciunt.', 'Et maxime et non et eos. Non assumenda perspiciatis sequi.', 75066.12, 1, '2020-07-05 10:00:00', '2020-07-11 04:10:07', '2020-07-31', NULL),
(50, 9, 110, 2, 3, 4, 'Laboriosam error quo id.', 'Suscipit qui fugiat quis officia. Est maxime possimus fugit et.', 19816.8, 1, '2020-07-05 10:00:00', '2020-07-11 04:10:07', '2020-07-31', NULL),
(51, 9, 45, 3, 3, 6, 'Accusantium nisi deleniti alias optio in quasi dolor tempora.', 'Ut cumque ea nulla eligendi ut est natus autem. Occaecati distinctio id nobis sunt quas.', 45201.95, 1, '2020-07-05 10:00:00', '2020-07-11 04:10:07', '2020-07-31', NULL),
(52, 9, 141, 1, 3, 2, 'Asperiores ut consectetur incidunt cupiditate autem omnis.', 'Aut aut omnis veritatis sit fuga consequuntur tempora. Distinctio inventore dolor quia ab.', 89829.28, 1, '2020-07-05 10:00:00', '2020-07-11 04:10:07', '2020-07-31', NULL),
(53, 9, 75, 3, 3, 3, 'Laudantium unde quae quod non architecto aut ipsa.', 'Est tempora commodi sint nulla in quibusdam nesciunt dolore. Est sit ratione consectetur.', 84624.4, 1, '2020-07-05 10:00:00', '2020-07-11 04:10:07', '2020-07-31', NULL),
(54, 9, 43, 2, 1, 6, 'Aspernatur ratione illo voluptatem rerum quam et ullam et.', 'Iusto perferendis rerum ab ut amet voluptas. Dolorum tempora ipsum aspernatur voluptatem quam.', 17600.3, 1, '2020-07-05 10:00:00', '2020-07-11 04:10:07', '2020-07-31', '2020-08-17 21:00:49'),
(55, 9, 117, 2, 2, 4, 'Quo et voluptatibus enim temporibus modi voluptatem voluptatibus dolores.', 'Sed consequuntur totam ipsum quasi molestias. Aliquid quis doloribus aut placeat dolor.', 22257.37, 1, '2020-07-05 10:00:00', '2020-07-11 04:10:07', '2020-07-31', '2020-08-17 21:00:54'),
(56, 9, 44, 1, 3, 6, 'Non voluptate facere nisi incidunt sapiente commodi quasi.', 'Provident laboriosam dolor tempore rerum voluptate nemo. Et aut officia possimus ratione quis.', 65852.62, 1, '2020-07-05 10:00:00', '2020-07-11 04:10:07', '2020-07-31', NULL),
(57, 9, 74, 2, 3, 5, 'Dolor quis sit repellendus sed.', 'Accusamus ut numquam sit modi. Doloremque quisquam labore aperiam esse.', 50705.08, 1, '2020-07-05 10:00:00', '2020-07-11 04:10:07', '2020-07-31', NULL),
(58, 9, 51, 1, 2, 4, 'Tempore temporibus ea nisi ut dolorem rerum quo.', 'Id ea consequatur veniam. Eum quod nobis est magnam. Placeat eos dolores qui facilis.', 94374.17, 1, '2020-07-06 10:00:00', '2020-07-11 04:10:07', '2020-07-31', '2020-08-17 21:00:54'),
(59, 9, 80, 2, 2, 2, 'Quas ex sunt occaecati ut dolorem consequatur.', 'Temporibus quam sunt et. Unde modi ut voluptatem et facilis perspiciatis.', 3480.33, 1, '2020-07-06 10:00:00', '2020-07-11 04:10:07', '2020-07-31', '2020-08-17 21:00:54'),
(60, 9, 160, 3, 2, 4, 'Neque vitae quis voluptatem consequuntur iure et ea.', 'Modi dolorem consequatur quia aliquid id mollitia atque corrupti. Ea soluta neque veritatis qui.', 37328.45, 1, '2020-07-06 10:00:00', '2020-07-11 04:10:07', '2020-07-31', '2020-08-17 21:00:54'),
(61, 9, 46, 2, 2, 6, 'Facere voluptatem et repellat.', 'Autem aut voluptatem eum molestias. In corrupti unde sit omnis. Voluptas ex eaque deserunt minus.', 5700.94, 1, '2020-07-06 10:00:00', '2020-07-11 04:10:07', '2020-07-31', '2020-08-17 21:00:54'),
(62, 9, 128, 2, 2, 5, 'Est cumque distinctio dolores nesciunt aut ex.', 'Tempore enim et laudantium est. Ut alias quis rerum sunt quae.', 63363.88, 1, '2020-07-06 10:00:00', '2020-07-11 04:10:07', '2020-07-31', '2020-08-17 21:00:54'),
(63, 9, 1, 1, 2, 3, 'Incidunt vitae dolorum quo iure sunt.', 'Voluptatem aspernatur officia quos eum a qui. Non sapiente ut possimus est.', 99498.1, 1, '2020-07-06 10:00:00', '2020-07-11 04:10:07', '2020-07-31', '2020-08-17 21:00:54'),
(64, 9, 83, 3, 1, 4, 'Aliquam ad sit ut in quis velit.', 'Dolore consectetur ea id iure fugiat illo. Omnis hic aut et.', 21102.99, 1, '2020-07-06 10:00:00', '2020-07-11 04:10:07', '2020-07-31', '2020-08-17 21:00:49'),
(65, 9, 127, 3, 1, 5, 'Neque in est animi voluptates sequi provident alias.', 'Culpa doloremque qui aliquid cumque. Fugit sit quisquam neque error. Enim vitae ab non nulla iure.', 85917.14, 1, '2020-07-06 10:00:00', '2020-07-11 04:10:07', '2020-07-31', '2020-08-17 21:00:49'),
(66, 9, 25, 2, 3, 5, 'Dolore non iusto est sed.', 'Numquam nisi temporibus quia sint vero. Et ipsum suscipit in rem ducimus quia nesciunt.', 82192.19, 1, '2020-07-06 10:00:00', '2020-07-11 04:10:08', '2020-07-31', NULL),
(67, 9, 148, 3, 3, 2, 'Qui quis distinctio est minima.', 'Culpa quis explicabo nihil aut. Occaecati excepturi debitis ullam vero laboriosam porro.', 55938.48, 1, '2020-07-06 10:00:00', '2020-07-14 20:52:11', '2020-07-31', NULL),
(68, 9, 57, 1, 1, 2, 'Commodi consequuntur quasi repudiandae ab distinctio.', 'Assumenda ea enim id esse. Cumque aut fuga fugit et sed. Et ipsa et facilis quis ratione et qui.', 17496.73, 1, '2020-07-06 10:00:00', '2020-07-11 04:10:08', '2020-07-31', '2020-08-17 21:00:49'),
(69, 9, 148, 2, 1, 5, 'Eligendi quasi recusandae ullam ipsam quos assumenda quas tempora.', 'Aut temporibus quia eum quisquam ut. Asperiores magnam tempora aut.', 64519.6, 1, '2020-07-06 10:00:00', '2020-07-11 04:10:08', '2020-07-31', '2020-08-17 21:00:49'),
(70, 9, 105, 1, 1, 1, 'Molestiae alias molestias voluptatem fuga ea omnis sequi dolorem.', 'Quasi vel est vitae rem commodi voluptas. Saepe quia incidunt necessitatibus minima nulla.', 31810.34, 1, '2020-07-06 10:00:00', '2020-07-11 04:10:08', '2020-07-31', '2020-08-17 21:00:49'),
(71, 9, 68, 1, 1, 6, 'Ut voluptatibus ut et ipsum.', 'Ex quia totam mollitia aspernatur. Dolor quo officiis sed placeat quis consectetur.', 18988.36, 1, '2020-07-06 10:00:00', '2020-07-11 04:10:08', '2020-07-31', '2020-08-17 21:00:49'),
(72, 9, 132, 3, 2, 5, 'Autem dolorem aut id enim voluptatum.', 'Non earum omnis reprehenderit sit. Ut vel totam itaque molestias atque.', 75071.22, 1, '2020-07-06 10:00:00', '2020-07-11 04:10:08', '2020-07-31', '2020-08-17 21:00:54'),
(73, 9, 113, 2, 3, 2, 'Voluptatem sunt quidem quibusdam.', 'Sunt quod rerum aperiam voluptatem quia ipsam velit. Debitis iste nemo qui dignissimos enim autem.', 64309.49, 1, '2020-07-06 10:00:00', '2020-07-11 04:10:08', '2020-07-31', NULL),
(74, 9, 12, 3, 2, 6, 'Eos beatae magni in vero commodi quia.', 'Quas aut mollitia eos tempore non. Eligendi natus vero minus rerum.', 68310.57, 1, '2020-07-06 10:00:00', '2020-07-11 04:10:08', '2020-07-31', '2020-08-17 21:00:54'),
(75, 9, 12, 1, 1, 5, 'Pariatur ut ut quam tempora et omnis.', 'Sequi minus amet dolores quisquam aut. Qui illum est omnis error facilis.', 51340.47, 1, '2020-07-06 10:00:00', '2020-07-11 04:10:08', '2020-07-31', '2020-08-17 21:00:49'),
(76, 9, 26, 2, 1, 3, 'Dolorem fuga aut et similique molestiae.', 'Nulla ex autem corrupti earum. Ut ipsam commodi autem molestiae recusandae.', 67074.7, 1, '2020-07-06 10:00:00', '2020-07-11 04:10:08', '2020-07-31', '2020-08-17 21:00:49'),
(77, 9, 97, 3, 1, 2, 'Velit ipsa animi voluptate quo.', 'Eius dolorem expedita magni nulla. Alias rerum sed voluptatem consequatur vel. Qui sed esse qui.', 66748.39, 1, '2020-07-06 10:00:00', '2020-07-11 04:10:08', '2020-07-31', '2020-08-17 21:00:49'),
(78, 9, 61, 1, 3, 4, 'Qui cumque laboriosam est.', 'Nulla sint tenetur autem iste nihil. Ipsa maiores ut rerum cupiditate aspernatur.', 4376, 1, '2020-07-07 10:00:00', '2020-07-11 04:10:08', '2020-07-31', NULL),
(79, 9, 77, 3, 1, 5, 'Et rerum accusamus cupiditate autem sunt aut aut sed.', 'Quia dolores doloribus odit magni ad. Quidem est deleniti quasi. Qui rerum et et odit.', 80206.77, 1, '2020-07-07 10:00:00', '2020-07-11 04:10:08', '2020-07-31', '2020-08-17 21:00:49'),
(80, 9, 110, 1, 1, 3, 'Ea sint nulla aliquid et nihil.', 'Qui velit tempora quo quam quod odio. Quidem amet cupiditate sunt odio eveniet ipsa velit amet.', 67076.31, 0, '2020-07-07 10:00:00', '2020-08-15 01:06:49', '2020-07-31', '2020-08-17 21:00:49'),
(81, 9, 69, 3, 1, 2, 'Autem sed veniam voluptatum.', 'Omnis aspernatur quisquam similique quis aut. Aut labore et enim provident.', 95037.17, 1, '2020-07-07 10:00:00', '2020-07-14 20:52:19', '2020-07-31', '2020-08-17 21:00:49'),
(82, 9, 109, 1, 3, 2, 'Autem eos molestiae voluptates ut rerum qui.', 'Non excepturi dolorum ut veniam. Nobis animi ut et. Enim dolores laboriosam quas et.', 18583.41, 1, '2020-07-07 10:00:00', '2020-07-11 04:10:08', '2020-07-31', NULL),
(83, 9, 46, 2, 3, 1, 'Nam labore voluptates accusantium iure velit.', 'Sed sed ut et qui. Iusto sit omnis itaque laborum sit labore qui.', 44360.14, 1, '2020-07-07 10:00:00', '2020-07-11 04:10:08', '2020-07-31', NULL),
(84, 9, 54, 2, 3, 6, 'Labore consequatur non reiciendis rerum reiciendis quis.', 'Vitae qui non laborum ut molestias ipsam assumenda. Saepe cupiditate cupiditate fugiat quia.', 27682.89, 1, '2020-07-07 10:00:00', '2020-07-11 04:10:08', '2020-07-31', NULL),
(85, 9, 84, 3, 2, 4, 'Et sed dolores omnis ut hic quod.', 'Quia rerum asperiores molestiae corrupti accusantium ratione. Et molestiae tenetur quia molestias.', 91270.11, 1, '2020-07-07 10:00:00', '2020-07-11 04:10:08', '2020-07-31', '2020-08-17 21:00:54'),
(86, 9, 152, 2, 2, 2, 'Sequi vel enim rerum porro et veritatis veritatis.', 'Provident assumenda corporis quasi. Velit dolorem dolores et aut. Eius quis sunt sed in.', 73419.78, 1, '2020-07-07 10:00:00', '2020-07-11 04:10:08', '2020-07-31', '2020-08-17 21:00:54'),
(87, 9, 131, 2, 2, 4, 'Iste facilis ut labore doloribus culpa praesentium.', 'Molestias eveniet aut recusandae impedit. Suscipit doloremque aliquid quo qui.', 5852.93, 1, '2020-07-07 10:00:00', '2020-07-11 04:10:08', '2020-07-31', '2020-08-17 21:00:54'),
(88, 9, 61, 3, 3, 6, 'Quaerat nihil deserunt mollitia qui ipsam eum.', 'Sunt ut consequatur sit odit. Nulla ducimus consequatur assumenda sed ipsum ut natus.', 80559.85, 1, '2020-07-07 10:00:00', '2020-07-11 04:10:08', '2020-07-31', NULL),
(89, 9, 51, 2, 1, 4, 'Omnis dolorem sit animi autem voluptatem voluptatum voluptas.', 'Distinctio quis qui laudantium velit accusamus harum vitae. Explicabo voluptates iste ex eveniet.', 81827.12, 1, '2020-07-07 10:00:00', '2020-07-11 04:10:08', '2020-07-31', '2020-08-17 21:00:49'),
(90, 9, 119, 3, 3, 6, 'Eaque et quos tempora.', 'Perspiciatis sit suscipit qui alias. Eum nemo temporibus consequuntur eum velit quasi aut.', 38453.39, 1, '2020-07-08 10:00:00', '2020-07-11 04:10:08', '2020-07-31', NULL),
(91, 9, 35, 2, 3, 4, 'Est qui odit recusandae cupiditate hic.', 'Et sed et ipsa. Quidem et possimus magnam aut. Aut quis nulla quis aspernatur impedit.', 1920.18, 1, '2020-07-08 10:00:00', '2020-07-11 04:10:08', '2020-07-31', NULL),
(92, 9, 152, 1, 2, 4, 'Eligendi natus accusantium iste dignissimos commodi repellat at.', 'Et iure nisi quam dolor nulla. Non explicabo ab omnis magnam temporibus quibusdam.', 5593.68, 1, '2020-07-09 10:00:00', '2020-07-11 04:10:08', '2020-07-31', '2020-08-17 21:00:54'),
(93, 9, 59, 3, 2, 6, 'Molestias quibusdam ex sit sit aut.', 'Voluptate aut dignissimos et qui est ducimus. Sint sint quia laudantium non aut ipsa.', 19614.05, 1, '2020-07-09 10:00:00', '2020-07-11 04:10:08', '2020-07-31', '2020-08-17 21:00:54'),
(94, 9, 40, 1, 3, 2, 'Aut minus tempora expedita et vero et.', 'Veritatis expedita enim expedita quidem. Ut aliquam velit ut voluptatem.', 37472.2, 1, '2020-07-09 10:00:00', '2020-07-14 20:52:53', '2020-07-31', NULL),
(95, 9, 90, 3, 3, 1, 'Dolore tempora voluptatem dolore omnis vitae sit ut.', 'Laudantium nisi dolor nihil consequatur. Veritatis quod quasi excepturi ut reiciendis.', 58216.96, 1, '2020-07-09 10:00:00', '2020-07-11 04:10:08', '2020-07-31', NULL),
(96, 9, 78, 3, 1, 2, 'Numquam fugit quae necessitatibus ad dolorem aliquam non.', 'Qui aut iste iure asperiores et nihil sint. Sunt accusamus omnis est aspernatur.', 62776.38, 1, '2020-07-09 10:00:00', '2020-07-11 04:10:08', '2020-07-31', '2020-08-17 21:00:49'),
(97, 9, 38, 2, 1, 3, 'Sed consequatur facere minima.', 'Porro corporis pariatur autem vitae. Eos et corrupti expedita est. Et ut qui sint eaque assumenda.', 10250.76, 1, '2020-07-09 10:00:00', '2020-07-11 04:10:08', '2020-07-31', '2020-08-17 21:00:49'),
(98, 9, 56, 3, 2, 4, 'Recusandae repellat est ea tempora.', 'Quia vel quas neque est velit aliquid. Nobis architecto hic alias mollitia.', 8288.76, 1, '2020-07-09 10:00:00', '2020-07-11 04:10:08', '2020-07-31', '2020-08-17 21:00:54'),
(99, 9, 124, 3, 3, 1, 'Veniam numquam reiciendis autem.', 'Rerum voluptas mollitia ipsam. Corporis blanditiis nesciunt deserunt id odit.', 14100, 1, '2020-07-09 10:00:00', '2020-07-11 04:10:08', '2020-07-31', NULL),
(100, 9, 150, 1, 2, 2, 'Consectetur est odio et rerum.', 'Cumque eos consequatur vel sed. Delectus voluptas error harum. Voluptate vel odit et quidem fugit.', 31227.23, 1, '2020-07-09 10:00:00', '2020-07-11 04:10:09', '2020-07-31', '2020-08-17 21:00:54'),
(101, 9, 55, 2, 3, 6, 'Commodi est necessitatibus facere minus at aliquid quidem accusantium.', 'Autem enim quo autem et soluta. Exercitationem autem consequuntur ab at.', 29547.55, 1, '2020-07-09 10:00:00', '2020-07-21 09:38:10', '2020-07-31', NULL),
(102, 9, 24, 1, 2, 4, 'Veniam itaque doloremque explicabo beatae consequatur vel et est.', 'Inventore laborum quia aliquid hic magni quod esse voluptatum. Quasi laborum dolorum nam neque.', 8828.29, 1, '2020-07-09 10:00:00', '2020-07-11 04:10:09', '2020-07-31', '2020-08-17 21:00:54'),
(103, 9, 28, 3, 1, 2, 'Placeat sint explicabo quaerat vero.', 'Ipsum autem modi rerum qui itaque atque. Tenetur quidem nihil perspiciatis.', 7765.99, 1, '2020-07-09 10:00:00', '2020-07-14 20:52:56', '2020-07-31', '2020-08-17 21:00:49'),
(104, 9, 11, 2, 2, 4, 'Quia molestiae nihil adipisci maxime facere.', 'Ab omnis vitae eligendi. Minus sequi maiores maiores cupiditate ipsam. Quisquam hic aperiam et et.', 86499.35, 1, '2020-07-09 10:00:00', '2020-07-11 04:10:09', '2020-07-31', '2020-08-17 21:00:54'),
(105, 9, 153, 3, 3, 1, 'Facilis commodi debitis recusandae odio sit ab iste est.', 'Dolores molestiae adipisci inventore. Cum iusto consequatur ut nisi. Rerum amet maiores rerum in.', 39221.85, 1, '2020-07-09 10:00:00', '2020-07-11 04:10:09', '2020-07-31', NULL),
(106, 9, 103, 3, 3, 5, 'Non iure voluptas facilis minus accusantium.', 'Molestiae excepturi et ea laborum. Hic quia nulla et temporibus eos.', 82066.19, 1, '2020-07-09 10:00:00', '2020-07-11 04:10:09', '2020-07-31', NULL),
(107, 9, 62, 1, 2, 3, 'Itaque excepturi eos sequi.', 'Aut accusantium a illo saepe. Non voluptas ab vero consequatur. Tempore hic impedit tempora harum.', 84089.8, 1, '2020-07-09 10:00:00', '2020-07-11 04:10:09', '2020-07-31', '2020-08-17 21:00:54'),
(108, 9, 77, 1, 1, 4, 'Maxime delectus nihil reiciendis consequatur eius optio ut.', 'At iste est optio consequatur reprehenderit rem rem. Recusandae et ducimus et consequuntur hic.', 16704.88, 1, '2020-07-09 10:00:00', '2020-07-11 04:10:09', '2020-07-31', '2020-08-17 21:00:49'),
(109, 9, 16, 1, 2, 1, 'Eaque quia nisi tempora consectetur voluptatem odit in.', 'Et consequatur corporis nobis asperiores qui. Nihil debitis eum consequatur deleniti quo.', 94400.35, 1, '2020-07-09 10:00:00', '2020-07-11 04:10:09', '2020-07-31', '2020-08-17 21:00:54'),
(110, 9, 134, 2, 1, 4, 'Nemo molestiae quod laudantium.', 'Sed vel vero rem est. Non omnis ut inventore reiciendis.', 15342.92, 1, '2020-07-09 10:00:00', '2020-07-11 04:10:09', '2020-07-31', '2020-08-17 21:00:49'),
(111, 9, 61, 3, 3, 1, 'Quo aut facilis voluptas dolorum sit at asperiores.', 'Amet quo quo incidunt recusandae est. Repellat ut qui eveniet. In et ut corrupti et ducimus et.', 71691.15, 1, '2020-07-09 10:00:00', '2020-07-11 04:10:09', '2020-07-31', NULL),
(112, 9, 132, 2, 3, 4, 'Odio officia quidem aperiam rerum consectetur.', 'Et maiores ullam nisi velit eius quis. Odit minima quod mollitia officiis provident neque aliquam.', 44900.34, 1, '2020-07-10 10:00:00', '2020-07-11 04:10:09', '2020-07-31', NULL),
(113, 9, 139, 3, 2, 3, 'Corporis sequi incidunt vitae debitis sapiente explicabo.', 'Sed quibusdam qui laudantium libero officia quia. Nobis praesentium est a.', 83421.75, 0, '2020-07-10 10:00:00', '2020-08-15 00:38:25', '2020-07-31', '2020-08-17 21:00:54'),
(114, 9, 3, 1, 1, 1, 'Possimus quia quos pariatur sed nesciunt dolorum enim quo.', 'Illum cumque aut ut ullam nobis laudantium. Impedit sint dicta blanditiis non ea rerum.', 32978.02, 1, '2020-07-10 10:00:00', '2020-07-11 04:10:09', '2020-07-31', '2020-08-17 21:00:49'),
(115, 9, 2, 3, 1, 2, 'Aut quia adipisci voluptatem nulla quas.', 'Voluptas omnis id et odio. Tempora sed laudantium sit reprehenderit.', 76725.64, 1, '2020-07-10 10:00:00', '2020-07-11 04:10:09', '2020-07-31', '2020-08-17 21:00:49'),
(116, 9, 37, 3, 3, 2, 'Nesciunt rerum corporis nihil et unde eos.', 'Ut molestias corrupti est illo tempore ut eos. Eum alias necessitatibus dolor natus.', 31252.95, 1, '2020-07-10 10:00:00', '2020-07-11 04:10:09', '2020-07-31', NULL),
(117, 9, 157, 3, 1, 1, 'Omnis asperiores similique temporibus error et id.', 'Voluptatum ullam maiores est enim. Dignissimos non repellendus eaque saepe.', 8534.92, 1, '2020-07-10 10:00:00', '2020-07-11 04:10:09', '2020-07-31', '2020-08-17 21:00:49'),
(118, 9, 42, 1, 1, 6, 'Corrupti ipsum fugit ut.', 'Ipsum sunt quod rerum est. Molestiae sit quisquam qui perspiciatis. Incidunt id magnam est et.', 55902.83, 1, '2020-07-10 10:00:00', '2020-08-15 00:38:40', '2020-07-31', '2020-08-17 21:00:49'),
(119, 9, 80, 2, 2, 6, 'Natus beatae iste aspernatur corporis omnis.', 'Sunt non cumque dolor nam. Rerum magni est ea nemo. Dolor ad temporibus est excepturi placeat odio.', 73924.41, 1, '2020-07-10 10:00:00', '2020-07-21 09:38:04', '2020-07-31', '2020-08-17 21:00:54'),
(120, 9, 142, 2, 1, 1, 'Reiciendis esse esse ipsum est aut architecto.', 'Esse qui soluta nostrum. Perferendis eum aperiam nihil ab.', 7798.1, 1, '2020-07-10 10:00:00', '2020-07-11 04:10:09', '2020-07-31', '2020-08-17 21:00:49'),
(121, 9, 14, 2, 2, 2, 'Aut saepe velit impedit sunt blanditiis.', 'Non officiis eos reiciendis in suscipit. Rerum amet voluptatem natus.', 4848.75, 1, '2020-07-10 10:00:00', '2020-07-11 04:10:09', '2020-07-31', '2020-08-17 21:00:54'),
(122, 9, 110, 3, 1, 5, 'Maxime iste corrupti a explicabo et consectetur.', 'Alias rerum velit sit et cupiditate nihil facilis sit. Tenetur illum velit perspiciatis et et qui.', 76621.88, 1, '2020-07-10 10:00:00', '2020-07-11 04:10:09', '2020-07-31', '2020-08-17 21:00:49'),
(123, 9, 122, 3, 2, 2, 'Nam adipisci quia alias ut tenetur dolores maiores porro.', 'Excepturi totam error vitae. Perspiciatis quibusdam et saepe assumenda.', 75358.1, 1, '2020-07-10 10:00:00', '2020-07-11 04:10:09', '2020-07-31', '2020-08-17 21:00:54'),
(125, 9, 17, 1, 1, 6, 'Apartamento de la avenida', 'Interesado en la venta del apartamento de la abuela.', 47900, 1, '2020-07-20 18:56:30', '2020-08-20 09:19:48', '2020-08-14', NULL),
(126, 9, 20, 2, 3, 2, 'Compra de Equipos', 'Compra de servidor y estaciones de trabajo', 20000, 1, '2020-07-29 09:41:48', '2020-08-20 17:09:09', '2020-07-23', NULL),
(127, 9, 6, 1, 3, 2, 'Compra de PCs', 'Compra de Pc', 30000, 1, '2020-08-15 01:11:09', '2020-09-15 11:34:51', '2020-08-21', NULL),
(128, 8, 1, 1, 3, 1, 'Desarrollo', 'Desarrollo de plan de ventas', 2000, 1, '2020-08-29 00:35:56', '2020-08-29 00:35:56', '2020-10-01', NULL),
(129, 14, 168, 1, 2, 1, 'Venta de material escolar', 'Concebir acuerdo mutuo', 3000, 1, '2020-10-01 06:49:31', '2020-10-15 16:44:44', '2020-10-08', NULL),
(130, 14, 172, 1, 2, 4, 'Venta de literatura', 'Libros de texto escolar', 4000, 1, '2020-10-01 13:18:19', '2020-10-15 16:44:23', '2020-10-22', NULL),
(131, 15, 178, 1, 1, 6, 'Contratación 108 02', 'Contratación NuevoContacto 108', 10000, 1, '2020-10-05 16:46:58', '2020-10-09 19:01:39', '2020-10-05', '2020-10-09 19:01:39'),
(132, 15, 180, 3, 3, 6, 'Licitación 029', 'Licitación NuevaEmpresa 029', 35000, 1, '2020-10-05 16:49:24', '2020-10-09 19:02:25', '2020-10-15', '2020-10-09 19:02:25'),
(133, 15, 177, 2, 2, 6, 'Compras 107', 'Compras NuevoContacto 107', 7000, 1, '2020-10-05 16:51:03', '2020-10-05 17:49:18', '2020-10-06', NULL),
(134, 15, 178, 1, 3, 6, 'Contratación 108 01', 'Contratación NuevoContacto 108', 29000, 1, '2020-10-05 17:42:57', '2020-10-09 19:01:27', '2020-10-05', NULL),
(135, 14, 185, 1, 3, 4, 'CIERRE POR LIQUIDACIÓN', 'HOTEL 5 ESTRELLAS', 260000, 1, '2020-10-07 01:56:37', '2020-10-15 16:42:23', '2020-11-16', NULL),
(136, 14, 181, 2, 2, 5, 'COMPRA DE INMOBILIARIA', 'INMOBILIARIA EN QUIEBRA', 50000, 1, '2020-10-07 01:59:18', '2020-10-15 16:40:11', '2020-10-27', NULL),
(137, 14, 169, 3, 1, 6, 'COSECHA DE PATATAS', 'CAMPO GRANDE', 23000, 1, '2020-10-07 02:00:50', '2020-10-08 11:09:15', '2020-10-07', '2020-10-08 11:09:15'),
(138, 187, 186, 2, 3, 2, 'Compras 051 SL', 'Negociación 051 SL', 85000, 1, '2020-10-07 18:17:58', '2020-10-07 18:17:58', '2020-10-15', NULL),
(139, 187, 187, 1, 3, 5, 'Contratación 009 PF', 'Descripción 009 PF', 50000, 1, '2020-10-07 18:20:31', '2020-10-07 18:20:31', '2020-12-16', NULL),
(140, 187, 189, 1, 3, 3, 'Contratación 991 SL', 'Descripción 991 SL', 115000, 1, '2020-10-07 18:25:08', '2020-10-07 18:25:08', '2021-03-17', NULL),
(141, 14, 184, 1, 1, 6, 'Contrato MaTeriales Construcción', 'Contratación empresa árabe', 26000, 0, '2020-10-08 09:50:07', '2020-10-08 17:30:08', '2020-10-23', '2020-10-08 11:08:47'),
(142, 14, 169, 3, 3, 2, 'Maquinaria Agrícola', 'Actualización parque automotriz', 6000, 1, '2020-10-08 09:52:41', '2020-10-08 09:52:41', '2020-10-19', NULL),
(143, 14, 172, 3, 3, 2, 'Potabilizadoras', 'Venta de potabilizadoras', 120000, 1, '2020-10-08 09:59:09', '2020-10-15 17:00:33', '2020-10-21', NULL),
(144, 14, 169, 1, 3, 1, 'Venta de cristalería', 'Venta de cristalería de coches', 50000, 1, '2020-10-08 16:58:44', '2020-10-15 16:51:45', '2020-11-25', NULL),
(145, 14, 170, 2, 3, 3, 'Cosecha de Vino Bodega', 'Alimento animal', 6000, 1, '2020-10-08 17:00:23', '2020-10-15 17:45:28', '2020-12-31', NULL),
(146, 14, 168, 1, 3, 6, 'Venta de literatura', 'Venta de libros y folios', 42100, 1, '2020-10-09 09:56:39', '2020-10-15 16:43:18', '2020-12-31', NULL),
(147, 14, 171, 2, 1, 6, 'Contrato Materiales Laboratorio Clínico', 'Venta de cemento', 50000, 1, '2020-10-09 10:01:27', '2020-10-15 16:40:39', '2020-10-30', '2020-10-15 16:40:39'),
(148, 18, 176, 1, 1, 2, 'COMPRA DE INMOBILIARIA', 'COMPRAR INMOBILIARIAS DE A CORUÑA', 260000, 1, '2020-10-12 11:31:16', '2020-10-14 06:53:50', '2020-10-31', NULL),
(149, 18, 191, 2, 2, 6, 'COSECHA DE PATATAS', 'Cosecha de patatas', 50000, 1, '2020-10-12 11:32:15', '2020-10-14 06:48:10', '2020-12-31', '2020-10-14 06:48:10'),
(150, 13, 194, 2, 3, 2, 'Idea de negocio', 'Idea de negocio para 2021', 58000, 1, '2020-10-14 07:07:49', '2020-10-14 07:07:49', '2020-11-18', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negotiation_process`
--

CREATE TABLE `negotiation_process` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tipo de negociacion',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `conversion` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Identifica la conversión de la negociación'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `negotiation_process`
--

INSERT INTO `negotiation_process` (`id`, `name`, `created_at`, `updated_at`, `conversion`) VALUES
(1, 'Posibles Clientes', NULL, NULL, 0),
(2, 'Potencial Cliente', NULL, NULL, 0),
(3, 'En Contacto', NULL, NULL, 0),
(4, 'Reunión / Sesión', NULL, NULL, 0),
(5, 'En Negociación / Seguimiento', NULL, NULL, 0),
(6, 'Venta / Cerrado', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negotiation_process_history`
--

CREATE TABLE `negotiation_process_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `negotiation_process_id` bigint(20) UNSIGNED DEFAULT NULL,
  `negotiation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `negotiation_process_history`
--

INSERT INTO `negotiation_process_history` (`id`, `negotiation_process_id`, `negotiation_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(2, 1, 3, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(3, 2, 4, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(4, 1, 5, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(5, 2, 6, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(6, 2, 7, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(7, 1, 8, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(8, 6, 9, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(9, 1, 10, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(10, 1, 11, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(11, 6, 12, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(12, 3, 13, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(13, 1, 14, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(14, 4, 15, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(16, 1, 17, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(17, 5, 18, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(18, 3, 19, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(19, 1, 20, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(20, 5, 21, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(21, 1, 22, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(22, 6, 23, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(23, 6, 24, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(24, 5, 25, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(25, 2, 28, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(26, 5, 29, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(27, 5, 30, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(28, 3, 31, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(29, 1, 32, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(30, 6, 33, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(31, 1, 35, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(32, 3, 36, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(33, 6, 37, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(34, 6, 38, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(35, 3, 39, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(36, 2, 40, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(37, 2, 41, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(38, 6, 42, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(39, 3, 43, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(40, 6, 44, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(41, 6, 45, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(42, 1, 46, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(43, 2, 47, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(44, 1, 48, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(45, 6, 49, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(46, 4, 50, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(47, 6, 51, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(48, 2, 52, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(49, 3, 53, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(50, 6, 54, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(51, 4, 55, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(52, 6, 56, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(53, 5, 57, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(54, 4, 58, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(55, 2, 59, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(56, 4, 60, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(57, 6, 61, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(58, 5, 62, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(59, 3, 63, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(60, 4, 64, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(61, 5, 65, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(62, 5, 66, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(63, 2, 67, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(64, 2, 68, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(65, 5, 69, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(66, 1, 70, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(67, 6, 71, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(68, 5, 72, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(69, 2, 73, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(70, 6, 74, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(71, 5, 75, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(72, 3, 76, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(73, 2, 77, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(74, 4, 78, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(75, 5, 79, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(76, 3, 80, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(77, 2, 81, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(78, 2, 82, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(79, 1, 83, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(80, 6, 84, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(81, 4, 85, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(82, 2, 86, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(83, 4, 87, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(84, 6, 88, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(85, 4, 89, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(86, 6, 90, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(87, 4, 91, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(88, 4, 92, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(89, 6, 93, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(90, 2, 94, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(91, 1, 95, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(92, 2, 96, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(93, 3, 97, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(94, 4, 98, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(95, 1, 99, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(96, 2, 100, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(97, 6, 101, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(98, 4, 102, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(99, 2, 103, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(100, 4, 104, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(101, 1, 105, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(102, 5, 106, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(103, 3, 107, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(104, 4, 108, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(105, 1, 109, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(106, 4, 110, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(107, 1, 111, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(108, 4, 112, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(109, 3, 113, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(110, 1, 114, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(111, 2, 115, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(112, 2, 116, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(113, 1, 117, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(114, 6, 118, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(115, 6, 119, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(116, 1, 120, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(117, 2, 121, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(118, 5, 122, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(119, 2, 123, '2020-08-17 21:13:52', '2020-08-17 21:13:52'),
(123, 2, 127, '2020-08-20 09:19:43', '2020-08-20 09:19:43'),
(124, 6, 125, '2020-08-20 09:19:48', '2020-08-20 09:19:48'),
(125, 2, 126, '2020-08-20 17:09:09', '2020-08-20 17:09:09'),
(126, 6, 16, '2020-08-21 20:14:34', '2020-08-21 20:14:34'),
(127, 1, 128, '2020-08-29 00:35:56', '2020-08-29 00:35:56'),
(132, 6, 133, '2020-10-05 16:51:03', '2020-10-05 16:51:03'),
(133, 6, 134, '2020-10-05 17:42:57', '2020-10-05 17:42:57'),
(134, 6, 131, '2020-10-05 17:49:02', '2020-10-05 17:49:02'),
(137, 6, 137, '2020-10-07 02:00:50', '2020-10-07 02:00:50'),
(138, 2, 138, '2020-10-07 18:17:58', '2020-10-07 18:17:58'),
(139, 5, 139, '2020-10-07 18:20:31', '2020-10-07 18:20:31'),
(140, 3, 140, '2020-10-07 18:25:08', '2020-10-07 18:25:08'),
(142, 2, 142, '2020-10-08 09:52:41', '2020-10-08 09:52:41'),
(146, 6, 141, '2020-10-08 11:08:47', '2020-10-08 11:08:47'),
(153, 6, 147, '2020-10-09 10:01:42', '2020-10-09 10:01:42'),
(154, 6, 146, '2020-10-09 10:02:05', '2020-10-09 10:02:05'),
(156, 6, 132, '2020-10-09 19:02:25', '2020-10-09 19:02:25'),
(161, 6, 149, '2020-10-14 06:48:10', '2020-10-14 06:48:10'),
(167, 2, 148, '2020-10-14 06:53:50', '2020-10-14 06:53:50'),
(168, 2, 150, '2020-10-14 07:07:49', '2020-10-14 07:07:49'),
(169, 5, 136, '2020-10-15 16:37:52', '2020-10-15 16:37:52'),
(172, 4, 135, '2020-10-15 16:42:23', '2020-10-15 16:42:23'),
(174, 4, 130, '2020-10-15 16:43:36', '2020-10-15 16:43:36'),
(175, 1, 129, '2020-10-15 16:44:44', '2020-10-15 16:44:44'),
(177, 1, 144, '2020-10-15 16:51:45', '2020-10-15 16:51:45'),
(186, 2, 143, '2020-10-15 17:00:22', '2020-10-15 17:00:22'),
(192, 3, 145, '2020-10-15 17:45:28', '2020-10-15 17:45:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negotiation_statuses`
--

CREATE TABLE `negotiation_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `negotiation_statuses`
--

INSERT INTO `negotiation_statuses` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Exitosa', '2020-06-30 02:00:51', NULL),
(2, 'Perdida', '2020-06-30 02:00:51', NULL),
(3, 'En proceso', '2020-06-30 02:00:51', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negotiation_statuses_history`
--

CREATE TABLE `negotiation_statuses_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `negotiation_status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `negotiation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `negotiation_statuses_history`
--

INSERT INTO `negotiation_statuses_history` (`id`, `negotiation_status_id`, `negotiation_id`, `created_at`, `updated_at`) VALUES
(1, 1, 7, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(2, 1, 12, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(3, 1, 13, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(4, 1, 15, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(5, 1, 19, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(6, 1, 24, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(7, 1, 25, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(8, 1, 31, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(9, 1, 32, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(10, 1, 36, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(11, 1, 38, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(12, 1, 41, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(13, 1, 42, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(14, 1, 44, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(15, 1, 47, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(16, 1, 54, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(17, 1, 64, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(18, 1, 65, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(19, 1, 68, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(20, 1, 69, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(21, 1, 70, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(22, 1, 71, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(23, 1, 75, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(24, 1, 76, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(25, 1, 77, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(26, 1, 79, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(27, 1, 80, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(28, 1, 81, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(29, 1, 89, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(30, 1, 96, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(31, 1, 97, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(32, 1, 103, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(33, 1, 108, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(34, 1, 110, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(35, 1, 114, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(36, 1, 115, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(37, 1, 117, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(38, 1, 118, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(39, 1, 120, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(40, 1, 122, '2020-08-17 21:10:30', '2020-08-17 21:10:30'),
(64, 2, 10, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(65, 2, 16, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(66, 2, 17, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(67, 2, 18, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(68, 2, 20, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(69, 2, 22, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(70, 2, 23, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(71, 2, 29, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(72, 2, 33, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(73, 2, 37, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(74, 2, 39, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(75, 2, 40, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(76, 2, 55, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(77, 2, 58, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(78, 2, 59, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(79, 2, 60, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(80, 2, 61, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(81, 2, 62, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(82, 2, 63, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(83, 2, 72, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(84, 2, 74, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(85, 2, 85, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(86, 2, 86, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(87, 2, 87, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(88, 2, 92, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(89, 2, 93, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(90, 2, 98, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(91, 2, 100, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(92, 2, 102, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(93, 2, 104, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(94, 2, 107, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(95, 2, 109, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(96, 2, 113, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(97, 2, 119, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(98, 2, 121, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(99, 2, 123, '2020-08-17 21:10:58', '2020-08-17 21:10:58'),
(100, 1, 125, '2020-08-20 09:19:48', '2020-08-20 09:19:48'),
(101, 3, 128, '2020-08-29 00:35:56', '2020-08-29 00:35:56'),
(102, 3, 127, '2020-09-15 11:34:51', '2020-09-15 11:34:51'),
(106, 3, 132, '2020-10-05 16:49:24', '2020-10-05 16:49:24'),
(108, 3, 134, '2020-10-05 17:42:57', '2020-10-05 17:42:57'),
(109, 1, 131, '2020-10-05 17:49:02', '2020-10-05 17:49:02'),
(110, 2, 133, '2020-10-05 17:49:18', '2020-10-05 17:49:18'),
(114, 3, 138, '2020-10-07 18:17:58', '2020-10-07 18:17:58'),
(115, 3, 139, '2020-10-07 18:20:31', '2020-10-07 18:20:31'),
(116, 3, 140, '2020-10-07 18:25:08', '2020-10-07 18:25:08'),
(118, 3, 142, '2020-10-08 09:52:41', '2020-10-08 09:52:41'),
(122, 1, 141, '2020-10-08 11:08:47', '2020-10-08 11:08:47'),
(123, 1, 137, '2020-10-08 11:09:15', '2020-10-08 11:09:15'),
(124, 2, 136, '2020-10-08 11:09:37', '2020-10-08 11:09:37'),
(126, 3, 144, '2020-10-08 16:58:44', '2020-10-08 16:58:44'),
(127, 3, 145, '2020-10-08 17:00:23', '2020-10-08 17:00:23'),
(131, 1, 147, '2020-10-09 10:01:42', '2020-10-09 10:01:42'),
(138, 2, 149, '2020-10-14 06:47:47', '2020-10-14 06:47:47'),
(143, 1, 148, '2020-10-14 06:53:24', '2020-10-14 06:53:24'),
(144, 3, 150, '2020-10-14 07:07:49', '2020-10-14 07:07:49'),
(145, 3, 135, '2020-10-15 16:42:02', '2020-10-15 16:42:02'),
(146, 2, 129, '2020-10-15 16:42:33', '2020-10-15 16:42:33'),
(147, 3, 146, '2020-10-15 16:43:18', '2020-10-15 16:43:18'),
(148, 2, 130, '2020-10-15 16:44:01', '2020-10-15 16:44:01'),
(149, 3, 143, '2020-10-15 17:00:33', '2020-10-15 17:00:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negotiation_types`
--

CREATE TABLE `negotiation_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `negotiation_types`
--

INSERT INTO `negotiation_types` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Contratación', '2020-06-30 02:00:24', NULL),
(2, 'Compras', '2020-06-30 02:00:24', NULL),
(3, 'Licitación', '2020-06-30 02:00:24', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negotiation_user`
--

CREATE TABLE `negotiation_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `negotiation_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `negotiation_user`
--

INSERT INTO `negotiation_user` (`id`, `negotiation_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 128, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notes`
--

CREATE TABLE `notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `noteable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noteable_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `notes`
--

INSERT INTO `notes` (`id`, `description`, `noteable_type`, `noteable_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Llamar al vendedor Andres', 'App\\Negotiation', 126, 9, '2020-07-29 07:15:43', '2020-07-29 07:15:43'),
(2, 'Solicitar presupuesto de desarrollo web', 'App\\Negotiation', 126, 9, '2020-07-29 07:16:35', '2020-07-29 07:16:35'),
(3, 'Alfonso prefiere expandirlo', 'App\\Negotiation', 126, 9, '2020-07-29 10:21:18', '2020-07-29 10:21:18'),
(4, '<p>Actividad de prueba</p>', 'App\\Negotiation', 126, 9, '2020-08-05 20:30:51', '2020-08-05 20:30:51'),
(5, '<p>Primera actividad.</p>', 'App\\Contact', 33, 9, '2020-08-06 09:26:20', '2020-08-06 09:26:20'),
(6, '<p>Enviar informe</p>', 'App\\Contact', 6, 9, '2020-08-14 02:33:58', '2020-08-14 02:33:58'),
(7, '<p>Nota de actividad 01</p>', 'App\\Negotiation', 131, 15, '2020-10-05 17:48:51', '2020-10-05 17:48:51'),
(8, '<p>He ido a sus oficinas y los he conocido.</p>', 'App\\Negotiation', 132, 15, '2020-10-08 12:13:31', '2020-10-08 12:13:31'),
(9, '<p>Convenir tiempo de contrato</p><ol><li>Particular&nbsp;</li><li>Colectivo</li></ol><ul><li>Hasta 3</li><li>más de 3</li></ul><p><a href=\"trello.com/b/Pc60yaMd/ventonic\">trello.com/b/Pc60yaMd/ventonic</a></p><p>&nbsp;</p><p>&nbsp;</p><figure class=\"table\"><table><tbody><tr><td>Persona</td><td>Ciudad</td><td>Traslado</td><td>Dinero</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure><p>&nbsp;</p>', 'App\\Contact', 176, 18, '2020-10-12 11:12:10', '2020-10-12 11:12:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('0041b657-6a9d-4ccb-9589-ec32635b2c06', 'App\\Notifications\\ChatRoom', 'App\\User', 18, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Empresa\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Necesitar\\u00eda tu PIN de vendedor para generar el widget Call Me\",\"time\":\"Hace 0 segundos\"}', '2020-09-20 10:32:35', '2020-09-20 10:31:48', '2020-09-20 10:32:35'),
('0625f832-8ded-42e3-bf4c-511d8ae5ec63', 'App\\Notifications\\ChatRoom', 'App\\User', 187, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Empresa\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Hola\",\"time\":\"Hace 0 segundos\"}', '2020-10-08 21:17:18', '2020-10-08 21:17:06', '2020-10-08 21:17:18'),
('0f7dfeca-ca35-4044-886f-02e1bfa8bcf0', 'App\\Notifications\\ChatRoom', 'App\\User', 18, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Empresa DAYRON.COM\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Hola Muy buenas deseo que negociemos\",\"time\":\"Hace 0 segundos\"}', '2020-10-02 10:09:31', '2020-10-02 09:35:35', '2020-10-02 10:09:31'),
('146b2ebe-443a-4520-a77b-0bd7fe8c908f', 'App\\Notifications\\ChatRoom', 'App\\User', 15, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Vendedor\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"\\u00bfQu\\u00e9 hay?\",\"time\":\"Hace 0 segundos\"}', '2020-10-08 21:37:14', '2020-10-08 21:17:30', '2020-10-08 21:37:14'),
('16a2df38-8225-4b20-878c-2df3edb77cb9', 'App\\Notifications\\ChatRoom', 'App\\User', 17, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Empresa\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"bien\",\"time\":\"Hace 1 segundo\"}', '2020-09-30 10:53:30', '2020-09-30 10:50:51', '2020-09-30 10:53:30'),
('1c820713-9630-4f2a-aa8e-7a778862868c', 'App\\Notifications\\ChatRoom', 'App\\User', 18, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Empresa DAYRON.COM\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Hola c\\u00f3mo te va\",\"time\":\"Hace 0 segundos\"}', '2020-10-09 11:01:29', '2020-10-08 10:14:15', '2020-10-09 11:01:29'),
('23e3cb2e-65fc-4764-97b0-d72e76c0c597', 'App\\Notifications\\ChatRoom', 'App\\User', 187, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Empresa\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Vi su perfil en la aplicaci\\u00f3n\",\"time\":\"Hace 0 segundos\"}', '2020-10-08 21:18:17', '2020-10-08 21:18:09', '2020-10-08 21:18:17'),
('2af8f171-5201-4c0e-b824-3a255f7e9f99', 'App\\Notifications\\ChatRoom', 'App\\User', 17, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Empresa\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Hola 02\",\"time\":\"Hace 0 segundos\"}', '2020-10-05 07:47:32', '2020-10-05 07:47:20', '2020-10-05 07:47:32'),
('34f52e91-bfc8-4004-8714-0e5b64d5d828', 'App\\Notifications\\ChatRoom', 'App\\User', 9, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Vendedor\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Buenos dias\",\"time\":\"Hace 0 segundos\"}', '2020-09-08 09:53:30', '2020-09-08 09:48:54', '2020-09-08 09:53:30'),
('3666da2f-5927-4c59-b3ec-985aeb0eeefd', 'App\\Notifications\\CompanyAplicantOportunity', 'App\\User', 14, '{\"aplicantName\":\"PERFIL\",\"oportunityName\":\"Venta de equipos para salas UVI\",\"sellerName\":\"PERFIL\",\"time\":\"Hace 0 segundos\"}', NULL, '2020-10-15 23:28:51', '2020-10-15 23:28:51'),
('408828fe-f43f-4609-b6f7-450df403de9f', 'App\\Notifications\\CompanyAplicantOportunity', 'App\\User', 14, '{\"aplicantName\":\"PERFIL\",\"oportunityName\":\"Material quir\\u00fargico desechable\",\"sellerName\":\"PERFIL\",\"time\":\"Hace 0 segundos\"}', NULL, '2020-10-15 17:47:39', '2020-10-15 17:47:39'),
('4177da62-6093-4172-9ca1-6435132a458f', 'App\\Notifications\\ChatRoom', 'App\\User', 14, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Vendedor\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Me especializo en el Sector Sanidad\",\"time\":\"Hace 0 segundos\"}', '2020-10-05 09:34:18', '2020-10-02 11:41:04', '2020-10-05 09:34:18'),
('44e58fc0-ac5d-405b-9879-500a0e3136c5', 'App\\Notifications\\ChatRoom', 'App\\User', 17, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Empresa\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"puedes detallarme tus \\u00faltimos trabajos?\",\"time\":\"Hace 0 segundos\"}', '2020-09-30 11:01:55', '2020-09-30 10:59:04', '2020-09-30 11:01:55'),
('4caadeb6-3365-4cc7-b679-042b5474ef66', 'App\\Notifications\\ChatRoom', 'App\\User', 15, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Vendedor\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Hola de nuevo\",\"time\":\"Hace 0 segundos\"}', '2020-10-05 07:51:18', '2020-10-05 07:47:45', '2020-10-05 07:51:18'),
('4e3cc494-c3a1-4683-877f-cbf3f918f762', 'App\\Notifications\\ChatRoom', 'App\\User', 9, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Vendedor\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Ah\\u00ed tienes\",\"time\":\"Hace 0 segundos\"}', '2020-09-20 10:37:08', '2020-09-20 10:33:31', '2020-09-20 10:37:08'),
('4e6c5ae2-a73f-4cff-819f-2bdc47db91d3', 'App\\Notifications\\ChatRoom', 'App\\User', 9, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Vendedor\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Hola\",\"time\":\"Hace 0 segundos\"}', '2020-09-08 09:29:53', '2020-09-08 09:21:37', '2020-09-08 09:29:53'),
('5820138d-5eaf-45b2-8a28-b45ac22129a8', 'App\\Notifications\\NewInvitationGroup', 'App\\User', 188, '{\"icon\":\"icon-users\",\"title\":\"Nuevo mensaje de PERFIL\",\"link\":\"https:\\/\\/dev.ventonic.com\\/grupos\\/confirmar\\/ywdqP9ijnZrMfFKYl7vE\",\"text\":\"Invitaci\\u00f3n a ser parte del grupo GRUPO 2 DE PRUEBA\",\"time\":\"Hace 0 segundos\"}', NULL, '2020-10-19 22:41:33', '2020-10-19 22:41:33'),
('60cadbfe-7ee0-4339-a07d-9f8fe980ce32', 'App\\Notifications\\ChatRoom', 'App\\User', 8, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Empresa\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"No leo la frase de \\\"S\\u00ed, estoy disponible\\\"\",\"time\":\"Hace 0 segundos\"}', '2020-09-08 09:54:15', '2020-09-08 09:54:04', '2020-09-08 09:54:15'),
('6480fc60-5e7e-435f-b949-780ac8295229', 'App\\Notifications\\ChatRoom', 'App\\User', 14, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de PERFIL\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"\\u00bfTe parecer\\u00eda bien  lunes 17:00 H?\",\"time\":\"Hace 0 segundos\"}', '2020-10-15 15:15:39', '2020-10-15 15:13:55', '2020-10-15 15:15:39'),
('6a6dfad9-9bda-4b71-a37a-6849ee6619e7', 'App\\Notifications\\ChatRoom', 'App\\User', 14, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de PERFIL\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Pues me encantar\\u00eda que habl\\u00e1semos\",\"time\":\"Hace 0 segundos\"}', '2020-10-15 15:15:39', '2020-10-15 15:13:16', '2020-10-15 15:15:39'),
('6c433688-cf90-4840-a515-780461f8a16b', 'App\\Notifications\\ChatRoom', 'App\\User', 15, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Vendedor\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"qu\\u00e9 tal\",\"time\":\"Hace 0 segundos\"}', '2020-09-30 10:50:37', '2020-09-30 10:50:22', '2020-09-30 10:50:37'),
('6cc7bc38-6833-42af-baec-82ac3201a6f4', 'App\\Notifications\\ChatRoom', 'App\\User', 15, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Vendedor\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Reportar\\u00e9 novedades al final de la ma\\u00f1ana, ok?\",\"time\":\"Hace 0 segundos\"}', '2020-10-05 07:51:18', '2020-10-05 07:48:42', '2020-10-05 07:51:18'),
('7130b46c-3716-4a78-83c9-2bd6aef88b7a', 'App\\Notifications\\ChatRoom', 'App\\User', 9, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Vendedor\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"S\\u00ed, estoy disponible\",\"time\":\"Hace 0 segundos\"}', '2020-09-08 09:53:30', '2020-09-08 09:53:21', '2020-09-08 09:53:30'),
('7434ef8f-c1d4-46c0-985a-db386b2f91e1', 'App\\Notifications\\NewInvitationGroup', 'App\\User', 18, '{\"icon\":\"icon-users\",\"title\":\"Nuevo mensaje de PERFIL\",\"link\":\"https:\\/\\/dev.ventonic.com\\/grupos\\/confirmar\\/G9mzVKjhDxQwk0O34nAl\",\"text\":\"Invitaci\\u00f3n a ser parte del grupo XXXXXXXXX\",\"time\":\"Hace 0 segundos\"}', NULL, '2020-10-19 22:37:37', '2020-10-19 22:37:37'),
('783a8329-8913-4435-a1c4-c505b7114102', 'App\\Notifications\\ChatRoom', 'App\\User', 18, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Empresa\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Hola, he visto tu perfil y me gustar\\u00eda contar contigo para cerrar ventas a trav\\u00e9s de las llamadas que lleguen a mi web\",\"time\":\"Hace 0 segundos\"}', '2020-09-20 10:30:39', '2020-09-20 10:30:34', '2020-09-20 10:30:39'),
('7ccdc50f-2e83-44a3-8fa7-bd57d3424d51', 'App\\Notifications\\NewInvitationGroup', 'App\\User', 14, '{\"icon\":\"icon-users\",\"title\":\"Nuevo mensaje de PERFIL\",\"link\":\"https:\\/\\/dev.ventonic.com\\/grupos\\/confirmar\\/1TJkFMHw7DNrtlZYyGV0\",\"text\":\"Invitaci\\u00f3n a ser parte del grupo PRUEBA IV\",\"time\":\"Hace 0 segundos\"}', NULL, '2020-10-19 23:55:19', '2020-10-19 23:55:19'),
('81e72a51-62c0-4e46-a9d6-0aad9526832f', 'App\\Notifications\\ChatRoom', 'App\\User', 18, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Empresa DAYRON.COM\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Me especializo en el Sector Sanidad\",\"time\":\"Hace 0 segundos\"}', '2020-10-05 10:19:48', '2020-10-05 09:34:42', '2020-10-05 10:19:48'),
('8ee9f882-338d-46fc-93a9-7c7b950e8f64', 'App\\Notifications\\NewInvitationGroup', 'App\\User', 14, '{\"icon\":\"icon-users\",\"title\":\"Nuevo mensaje de PERFIL\",\"link\":\"https:\\/\\/dev.ventonic.com\\/grupos\\/confirmar\\/MparcnuW9LPFSXvIYR5x\",\"text\":\"Invitaci\\u00f3n a ser parte del grupo Prueba iiii\",\"time\":\"Hace 0 segundos\"}', NULL, '2020-10-19 23:54:38', '2020-10-19 23:54:38'),
('969ce425-ae0c-464e-9bca-11f45441e054', 'App\\Notifications\\ChatRoom', 'App\\User', 17, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Empresa\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"he visto tu perfil y me gustar\\u00eda saber algo m\\u00e1s acerca de \\u00e9l\",\"time\":\"Hace 0 segundos\"}', '2020-09-30 10:53:30', '2020-09-30 10:53:04', '2020-09-30 10:53:30'),
('98ed7dc1-5132-4e7d-9438-575d9295866a', 'App\\Notifications\\ChatRoom', 'App\\User', 8, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Empresa\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Buenos dias\",\"time\":\"Hace 0 segundos\"}', '2020-08-29 00:32:49', '2020-08-29 00:31:28', '2020-08-29 00:32:49'),
('9cf4a1cc-9f74-4628-8a26-5cbb20a88a98', 'App\\Notifications\\CompanyAplicantOportunity', 'App\\User', 14, '{\"aplicantName\":\"PERFIL\",\"oportunityName\":\"Productos para quir\\u00f3fanos\",\"sellerName\":\"PERFIL\",\"time\":\"Hace 0 segundos\"}', NULL, '2020-10-15 23:49:13', '2020-10-15 23:49:13'),
('9d8ea76a-d243-47e3-bc8a-8872ae5e2061', 'App\\Notifications\\ChatRoom', 'App\\User', 9, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Vendedor\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Hola, gracias por contactar. \\u00a1\\u00a1Estupendo!!\",\"time\":\"Hace 0 segundos\"}', '2020-09-20 10:37:08', '2020-09-20 10:31:09', '2020-09-20 10:37:08'),
('9d94ff22-3a7f-4e30-a7ad-c1c31b173b07', 'App\\Notifications\\ChatRoom', 'App\\User', 15, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Vendedor\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"qu\\u00e9 necesitas saber?\",\"time\":\"Hace 0 segundos\"}', '2020-09-30 11:13:13', '2020-09-30 10:53:45', '2020-09-30 11:13:13'),
('a46ad76b-0437-4a18-a6e8-46c1422d9670', 'App\\Notifications\\ChatRoom', 'App\\User', 8, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Empresa\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Buenos d\\u00edas\",\"time\":\"Hace 0 segundos\"}', '2020-09-08 09:31:31', '2020-09-08 09:31:24', '2020-09-08 09:31:31'),
('a48d98d8-78f3-4a2d-9307-8dafeca0dd0c', 'App\\Notifications\\ChatRoom', 'App\\User', 18, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de PERFIL\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Hola, muy buenas. Me encantar\\u00eda agenda una reuni\\u00f3n para presentarte una propuesta.\",\"time\":\"Hace 0 segundos\"}', '2020-10-15 15:12:45', '2020-10-15 15:12:29', '2020-10-15 15:12:45'),
('a554a595-8928-415d-a346-4c650af9599b', 'App\\Notifications\\ChatRoom', 'App\\User', 14, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de PERFIL\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Hola, buen d\\u00eda!\",\"time\":\"Hace 0 segundos\"}', '2020-10-15 15:15:39', '2020-10-15 15:13:03', '2020-10-15 15:15:39'),
('ac27c183-eecf-4610-95b2-7aad61e7af2f', 'App\\Notifications\\ChatRoom', 'App\\User', 8, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Empresa\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Estas disponible\",\"time\":\"Hace 0 segundos\"}', '2020-09-08 09:31:31', '2020-08-29 00:37:57', '2020-09-08 09:31:31'),
('adbd4d85-5c7d-4002-b62a-55891b0ad0b8', 'App\\Notifications\\ChatRoom', 'App\\User', 17, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Empresa\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"hola\",\"time\":\"Hace 0 segundos\"}', '2020-09-30 10:50:11', '2020-09-30 10:49:58', '2020-09-30 10:50:11'),
('b107c2ee-2fed-427e-ab1e-426e949c96af', 'App\\Notifications\\ChatRoom', 'App\\User', 9, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Vendedor\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"bd34c317-c173-4b47-b1ed-1b770586390d\",\"time\":\"Hace 0 segundos\"}', '2020-09-20 10:37:08', '2020-09-20 10:33:27', '2020-09-20 10:37:08'),
('b1f59d9f-5c57-49f8-b07e-c9a19437adeb', 'App\\Notifications\\ChatRoom', 'App\\User', 22, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Empresa\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"listo\",\"time\":\"Hace 0 segundos\"}', NULL, '2020-10-20 07:14:05', '2020-10-20 07:14:05'),
('b9039b0e-6c79-40dc-ba3b-f2a587a6065d', 'App\\Notifications\\ChatRoom', 'App\\User', 14, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Vendedor\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Hola muy buenas. Me parece ganial. C\\u00f3mo puedo ayudaros?\",\"time\":\"Hace 0 segundos\"}', '2020-10-05 09:34:18', '2020-10-02 10:12:46', '2020-10-05 09:34:18'),
('bbefc40d-b2ee-463e-aeaf-ed51fbf9e8c2', 'App\\Notifications\\ChatRoom', 'App\\User', 187, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Empresa\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"\\u00bfqu\\u00e9 disponibilidad tiene?\",\"time\":\"Hace 0 segundos\"}', '2020-10-08 21:19:18', '2020-10-08 21:19:04', '2020-10-08 21:19:18'),
('c08b944b-7054-412c-929d-023e07d64535', 'App\\Notifications\\ChatRoom', 'App\\User', 15, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Vendedor\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Me alegro, \\u00bfen qu\\u00e9 puedo ayudarle?\",\"time\":\"Hace 0 segundos\"}', '2020-10-08 21:37:14', '2020-10-08 21:18:31', '2020-10-08 21:37:14'),
('c9bfd882-1ae9-44f2-a482-3157f138571c', 'App\\Notifications\\ChatRoom', 'App\\User', 18, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Empresa\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Hola, he visto tu perfil y me gustar\\u00eda contar contigo para cerrar ventas a trav\\u00e9s de las llamadas que lleguen a mi web\",\"time\":\"Hace 0 segundos\"}', '2020-09-20 11:47:44', '2020-09-20 11:47:37', '2020-09-20 11:47:44'),
('cc796fe5-0b9e-4948-8c6a-b4413f88a051', 'App\\Notifications\\ChatRoom', 'App\\User', 17, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Empresa\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"alguna novedad\",\"time\":\"Hace 0 segundos\"}', '2020-10-16 19:57:28', '2020-10-05 07:48:11', '2020-10-16 19:57:28'),
('d2700a77-d50e-4e97-9649-f9e1a4f2c573', 'App\\Notifications\\ChatRoom', 'App\\User', 18, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Empresa\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Lo puedes encontrar en tu perfil de Ventonic\",\"time\":\"Hace 0 segundos\"}', '2020-09-20 10:32:35', '2020-09-20 10:32:08', '2020-09-20 10:32:35'),
('d9d7024f-57d5-4d82-ab6f-1ea48f21eaea', 'App\\Notifications\\WidgetDataNotification', 'App\\User', 16, '{\"icon\":\"icon-server\",\"title\":\"Nuevo Call Me de Empresa\",\"text\":\"Se ha generado un nuevo Call Me\",\"link\":\"\\/widget\\/widgetsData\",\"time\":\"Hace 0 segundos\"}', '2020-09-28 15:54:54', '2020-08-29 00:18:41', '2020-09-28 15:54:54'),
('d9f8b52b-26a4-4add-aa60-a76071ad07bc', 'App\\Notifications\\ChatRoom', 'App\\User', 9, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Vendedor\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Hola, gracias por contactar. \\u00a1\\u00a1Estupendo!!\",\"time\":\"Hace 0 segundos\"}', '2020-09-20 11:48:08', '2020-09-20 11:48:00', '2020-09-20 11:48:08'),
('de2e2d26-d422-4fc3-a510-1c91790cb74f', 'App\\Notifications\\NewInvitationGroup', 'App\\User', 18, '{\"icon\":\"icon-users\",\"title\":\"Nuevo mensaje de Empresa\",\"link\":\"https:\\/\\/dev.ventonic.com\\/grupos\\/confirmar\\/EA94UtKzDGbvlFRe5a8Q\",\"text\":\"Invitaci\\u00f3n a ser parte del grupo Alfa\",\"time\":\"Hace 0 segundos\"}', '2020-09-15 11:49:39', '2020-09-15 11:48:41', '2020-09-15 11:49:39'),
('e17a0c47-01ab-4fb9-9ea2-1748aaf2bd5e', 'App\\Notifications\\ChatRoom', 'App\\User', 14, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Vendedor\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Y trabajo de forma telem\\u00e1tica\",\"time\":\"Hace 0 segundos\"}', '2020-10-05 09:34:18', '2020-10-02 11:41:14', '2020-10-05 09:34:18'),
('eb1957b7-d2d0-4943-b963-2b8e72418838', 'App\\Notifications\\CompanyAplicantOportunity', 'App\\User', 14, '{\"aplicantName\":\"PERFIL\",\"oportunityName\":\"Productos para quir\\u00f3fanos\",\"sellerName\":\"Vendedor\",\"time\":\"Hace 0 segundos\"}', NULL, '2020-10-16 10:03:05', '2020-10-16 10:03:05'),
('ebb06e27-13de-49d9-b811-e4bd53f92a7d', 'App\\Notifications\\ChatRoom', 'App\\User', 8, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Empresa\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Est\\u00e1s disponible?\",\"time\":\"Hace 0 segundos\"}', '2020-09-08 09:54:15', '2020-09-08 09:52:21', '2020-09-08 09:54:15'),
('f44bf762-84e2-44a1-9647-34b1534fb81b', 'App\\Notifications\\ChatRoom', 'App\\User', 14, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Vendedor\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"\\u00bfPuedes decirme tu email?\",\"time\":\"Hace 0 segundos\"}', '2020-10-05 09:34:18', '2020-10-02 11:42:16', '2020-10-05 09:34:18'),
('f4becfb9-f787-4d45-8456-5bc2dd306c45', 'App\\Notifications\\ChatRoom', 'App\\User', 9, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Vendedor\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Saludos\",\"time\":\"Hace 0 segundos\"}', '2020-10-02 10:38:10', '2020-10-01 22:39:40', '2020-10-02 10:38:10'),
('fbb45e4d-1ec2-471f-ac90-96ccf69bf722', 'App\\Notifications\\CompanyAplicantOportunity', 'App\\User', 14, '{\"aplicantName\":\"PERFIL\",\"oportunityName\":\"PRODUCTOS DE LIMPIEZA Y DESINFECCI\\u00d3N\",\"sellerName\":\"PERFIL\",\"time\":\"Hace 0 segundos\"}', NULL, '2020-10-15 23:56:03', '2020-10-15 23:56:03'),
('fc5e608c-943a-4fe8-b9c7-50c73b002fb1', 'App\\Notifications\\WidgetDataNotification', 'App\\User', 9, '{\"icon\":\"icon-server\",\"title\":\"Nuevo Call Me de Vendedor\",\"text\":\"Se ha generado un nuevo Call Me\",\"link\":\"\\/widget\\/widgetsData\",\"time\":\"Hace 0 segundos\"}', '2020-08-29 00:18:53', '2020-08-29 00:18:40', '2020-08-29 00:18:53'),
('fcba8938-0497-4e41-92a3-7500de8d3c06', 'App\\Notifications\\ChatRoom', 'App\\User', 18, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Empresa\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Existe un bot\\u00f3n \\\"Copiar mi PIN\\\"\",\"time\":\"Hace 0 segundos\"}', '2020-09-20 10:33:17', '2020-09-20 10:33:10', '2020-09-20 10:33:17'),
('fee2b809-f259-44a5-a9e3-002d1a8b2ea9', 'App\\Notifications\\ChatRoom', 'App\\User', 8, '{\"icon\":\"icon-message-square\",\"title\":\"Nuevo mensaje de Empresa\",\"link\":\"https:\\/\\/dev.ventonic.com\\/chat\",\"text\":\"Hola\",\"time\":\"Hace 0 segundos\"}', '2020-09-08 09:31:31', '2020-09-08 09:30:59', '2020-09-08 09:31:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oportunitys`
--

CREATE TABLE `oportunitys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `job_type_id` bigint(20) UNSIGNED NOT NULL,
  `ubication_oportunity_id` bigint(20) UNSIGNED NOT NULL,
  `status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `skills` longtext COLLATE utf8mb4_unicode_ci,
  `functions` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sectors` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `antiguedad` int(11) DEFAULT NULL,
  `ubication` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expire_at` date DEFAULT NULL COMMENT 'Fecha de vencimiento de la oportunidad',
  `amount` double(10,2) DEFAULT '0.00' COMMENT 'Valor del producto servicio importe',
  `leads` int(11) DEFAULT '0' COMMENT 'Nro de Leads',
  `is_funnel` tinyint(1) DEFAULT '0' COMMENT 'Embudo de ventas SI  NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oportunitys`
--

INSERT INTO `oportunitys` (`id`, `user_id`, `job_type_id`, `ubication_oportunity_id`, `status_id`, `title`, `description`, `cargo`, `skills`, `functions`, `sectors`, `antiguedad`, `ubication`, `image`, `email_contact`, `web`, `created_at`, `updated_at`, `expire_at`, `amount`, `leads`, `is_funnel`) VALUES
(1, 9, 2, 2, 2, 'Analista de Sistemas', '<p>Se solicita Analista de Sistemas</p>', 'Analista de Sistemas', '2,3,5', 'Analista de Sistemas', '3,4,6', NULL, 'Malaga', NULL, NULL, NULL, '2020-05-31 09:09:26', '2020-05-31 09:09:26', NULL, 0.00, 0, 0),
(2, 9, 4, 3, 1, 'Analista contable', '<p>Analista contable</p>', 'Analista contable', '3,4,6', 'Analista contable', '2,4,6', NULL, 'Barcelona', NULL, NULL, NULL, '2020-05-31 09:10:12', '2020-05-31 09:10:12', NULL, 0.00, 0, 0),
(3, 9, 4, 3, 2, 'Programador', '<p>Programador</p>', 'Programador', '3,5', 'Programador', '3,6', NULL, 'Malaga', NULL, NULL, NULL, '2020-05-31 09:11:04', '2020-05-31 09:11:04', NULL, 0.00, 0, 0),
(4, 9, 5, 3, 2, 'Personal Sanitario', '<p>Se solicita&nbsp;Personal Sanitario</p>', 'Personal Sanitario', '2,4,5', 'Personal Sanitario', '2,4,5', NULL, 'Malaga', NULL, NULL, NULL, '2020-05-31 09:11:57', '2020-05-31 09:11:57', NULL, 0.00, 0, 0),
(5, 9, 4, 1, 3, 'Comentarista deportivo', '<p>Se solicita&nbsp;Comentarista deportivo</p>', 'Comentarista deportivo', '3,5,6', 'Comentarista deportivo', '2,4', NULL, 'Barcelona', NULL, NULL, NULL, '2020-05-31 09:12:51', '2020-05-31 09:13:07', NULL, 0.00, 0, 0),
(6, 13, 4, 2, 2, 'Contador', 'Se solicita Contador', 'Contador', '3,4,5', 'Contador', '2,4,5', NULL, 'Barcelon', NULL, NULL, NULL, '2020-05-31 09:15:45', '2020-05-31 09:15:45', NULL, 0.00, 0, 0),
(7, 13, 2, 2, 2, 'Publicista', '<p>Publicista</p>', 'Publicista', '3,6', 'Publicista', '2,3,5', NULL, 'Barcelona', NULL, NULL, NULL, '2020-05-31 09:16:30', '2020-05-31 09:16:30', NULL, 0.00, 0, 0),
(8, 13, 1, 3, 3, 'Comentarista', '<p><br />\r\nComentarista</p>', 'Comentarista', '2,5', 'Comentarista', '2,4,5', NULL, 'Barcelona', NULL, NULL, NULL, '2020-05-31 09:17:22', '2020-05-31 09:17:38', NULL, 0.00, 0, 0),
(9, 9, 1, 1, 2, 'Nueva', '<p>analista</p>', 'analista', '4,7', 'analista', '2,4,6', NULL, 'MALAGA', NULL, NULL, NULL, '2020-06-02 02:35:01', '2020-06-02 02:35:01', NULL, 0.00, 0, 0),
(10, 9, 2, 2, 2, 'oportunidad de empleo', '<p>Se solicita personal</p>', 'analista contable', '2', 'Analista contable', '2,3,6', NULL, 'Malaga', NULL, NULL, NULL, '2020-06-02 12:47:28', '2020-06-02 12:47:52', NULL, 0.00, 0, 0),
(11, 9, 3, 2, 2, 'programador', '<p>programador</p>', 'programador', '2,3,5', 'programador', '3,4', NULL, 'malaga', NULL, NULL, NULL, '2020-06-02 21:56:00', '2020-06-02 21:56:31', NULL, 0.00, 0, 0),
(12, 14, 1, 1, 1, 'Productos para restaurantes', 'Cierre de ventas de diferentes productos para trabajo en quir&oacute;fano', 'Director', '3,5,16', 'Ventas, Comercial', '115', NULL, 'A Coruña, A coruña, España', NULL, 'dayronarmasbenitez@gmail.com', NULL, '2020-10-05 17:19:55', '2020-10-05 17:39:00', '2020-10-22', 15000.00, 20, 0),
(13, 14, 1, 1, 1, 'Productos para quirófanos', 'Cierre de ventas de diferentes productos para trabajo en quir&oacute;fano', 'Director', '3,5,16', 'Ventas, Comercial', '114,115', NULL, 'A Coruña, A coruña, España', NULL, 'dayronarmasbenitez@gmail.com', NULL, '2020-10-05 17:22:40', '2020-10-05 17:38:20', '2020-10-20', 20000.00, 50, 1),
(14, 14, 1, 1, 2, 'Productos para quirófanos', '<ol>\r\n	<li><strong>Cierre de ventas de productos</strong></li>\r\n</ol>', 'Director', '1,2,4', 'Ventas, comercial, marketing', '62', NULL, 'A Coruña, A Coruña. España', NULL, 'dayronarmasbenitez@gmail.com', NULL, '2020-10-05 17:36:54', '2020-10-05 17:36:54', NULL, 15000.00, 20, 0),
(15, 14, 1, 1, 1, 'Venta de maquinaria agrícola', '<p>Cerrar ventas de maquinaria agr&iacute;cola</p>', 'Director', '3', 'Venta', '3', NULL, 'País Vasco, España', NULL, 'darmasbenitez@gmail.com', NULL, '2020-10-08 11:03:48', '2020-10-15 14:26:22', NULL, 2599.00, 50, 0),
(16, 14, 3, 2, 3, 'Venta de Potabilizadoras de agua', '<p>Venta directa a empresas de potabilizadora de agua</p>', 'Gerente', '5', 'Venta', '73', NULL, 'Barcelona, España', NULL, 'darmasbenitez@gmail.com', NULL, '2020-10-08 11:06:27', '2020-10-15 14:26:14', NULL, 3499.00, 0, 0),
(17, 14, 2, 1, 4, 'Venta de Cemento', 'Cierre de venta a importante grupo empresarial de Galicia', 'Director', '2', 'Ventas, comercial', '24,25', NULL, 'A Coruña, A coruña, España', NULL, 'darmasbenitez@gmail.com', NULL, '2020-10-09 10:30:59', '2020-10-15 14:26:06', '2020-10-30', 130000.00, 0, 0),
(18, 14, 1, 1, 4, 'Material quirúrgico desechable', '<p>Cierre de venta a sector de alta demanda</p>', 'Gerente', '1,2,4', 'Administrativo', '81,115', NULL, 'Pontevedra, Galicia, España', NULL, 'xxxxx@gmail.com', NULL, '2020-10-15 14:38:13', '2020-10-15 23:23:14', NULL, 6200.00, 15, 0),
(19, 14, 1, 1, 4, 'Venta de equipos para salas UVI', 'Deseo una persona responsable con mucha &eacute;tica profesional y dominio de las caracter&iacute;sticas de los equipos', 'Comercial', '1,2,4', '2,7,18', '115', NULL, 'Madrid, Madrid, España', NULL, 'xxxxxx@gmail.com', NULL, '2020-10-15 23:26:15', '2020-10-15 23:50:57', NULL, 55125.00, 10, 0),
(20, 14, 1, 1, 2, 'PRODUCTOS DE LIMPIEZA Y DESINFECCIÓN', '<p>PRODUCTOS ALTAMENTE T&Oacute;XICOS</p>', 'ADMINISTRATIVO', '3,5,6', '1,2,25', '115', NULL, 'MADRID, MADRID, ESPAÑA', NULL, 'XXXXX@HOTMAIL.COM', NULL, '2020-10-15 23:54:52', '2020-10-15 23:54:52', NULL, 3500.00, 30, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesions`
--

CREATE TABLE `profesions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sector_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `profesions`
--

INSERT INTO `profesions` (`id`, `sector_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Administrador de Empresas', NULL, NULL),
(2, 1, 'Contador publico', NULL, NULL),
(3, 2, 'Ing. Produccion Animal', NULL, NULL),
(4, 2, 'Ing. Agrónomo', NULL, NULL),
(5, 3, 'Ing. Tecnología de los Alimentos', NULL, NULL),
(6, 3, 'Ayudante de Cocina', NULL, NULL),
(7, 3, 'Chef', NULL, NULL),
(8, 4, 'Comunity Manager', NULL, NULL),
(9, 4, 'Reportero Gráfico', NULL, NULL),
(10, 5, 'Agente de inmobialiario', NULL, NULL),
(11, 5, 'Arquitecto', NULL, NULL),
(12, 6, 'Especialista en control de inventarios', NULL, NULL),
(13, 6, 'Almacenista', NULL, NULL),
(14, 7, 'Vendedor', NULL, NULL),
(15, 8, 'Maestro de Obra', NULL, NULL),
(16, 8, 'Minero', NULL, NULL),
(17, 9, 'Entrenador Personal', NULL, NULL),
(18, 9, 'Futbolista Profesional', NULL, NULL),
(19, 10, 'Profesor Filososofia y Lenguas', NULL, NULL),
(20, 10, 'Lcdo. Educacion Especial', NULL, NULL),
(21, 11, 'Ing. Petroleo', NULL, NULL),
(22, 11, 'Ing. Quimico', NULL, NULL),
(23, 12, 'Corredor de Seguros', NULL, NULL),
(24, 13, 'Guía Turistico', NULL, NULL),
(25, 13, 'Especialista en Idiomas', NULL, NULL),
(26, 14, 'Diseñador Gráfico', NULL, NULL),
(27, 14, 'Desarrollador Web', NULL, NULL),
(28, 15, 'Ing. ed Ambiente y Recursos Naturales', NULL, NULL),
(29, 16, 'Ing. Metalurgico', NULL, NULL),
(30, 17, 'Capitan de Navio', NULL, NULL),
(31, 18, 'Soldador', NULL, NULL),
(32, 18, 'Operador de maquinaria de corte', NULL, NULL),
(33, 19, 'Medico Cirujano', NULL, NULL),
(34, 19, 'Lcda. Enfermería', NULL, NULL),
(35, 19, 'Bionalista', NULL, NULL),
(36, 19, 'Otorrinolaringologo', NULL, NULL),
(37, 20, 'Consultor empresarial', NULL, NULL),
(38, 21, 'Ing. Telecomunicaciones', NULL, NULL),
(39, 21, 'Ingeniero de software de ordenador', NULL, NULL),
(40, 21, 'Ingeniero de software de ordenador', NULL, NULL),
(41, 21, 'Especialista en ciberseguridad', NULL, NULL),
(42, 22, 'Diseñadora de pieles e interiores', NULL, NULL),
(43, 22, 'Modelo Profesional', NULL, NULL),
(44, 23, 'Transportista', NULL, NULL),
(45, 23, 'Conductor', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `option_type` enum('E','V') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(E)mpresa, (V)endedor',
  `selection_type` enum('U','M') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(U)nica, (M)ultiple',
  `priority` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `questions`
--

INSERT INTO `questions` (`id`, `option_type`, `selection_type`, `priority`, `name`, `options`, `status`, `created_at`, `updated_at`) VALUES
(1, 'E', 'U', 1, 'Sector al que te dedicas', '\"[\\\"SECTOR ADMINISTRACI\\\\u00d3N Y GESTI\\\\u00d3N (OFICINAS Y DESPACHOS)\\\",\\\"SECTOR AGRICULTURA Y GANADER\\\\u00cdA\\\",\\\"SECTOR INDUSTRIA ALIMENTARIA\\\",\\\"SECTOR DE INFOPRODUCTOS DIGITALES\\\",\\\"SECTOR INMOBILIARIO\\\",\\\"SECTOR GRANDES ALMACENES\\\",\\\"SECTOR COMERCIO\\\",\\\"SECTOR CONSTRUCCI\\\\u00d3N E INDUSTRIAS EXTRACTIVAS\\\",\\\"SECTOR ACTIVIDADES F\\\\u00cdSICO-DEPORTIVAS\\\",\\\"SECTOR EDUCACI\\\\u00d3N\\\",\\\"SECTOR ENERG\\\\u00cdA Y AGUA\\\",\\\"SECTOR FINANZAS Y SEGUROS\\\",\\\"SECTOR HOSTELER\\\\u00cdA Y TURISMO\\\",\\\"SECTOR INFORMACI\\\\u00d3N, COMUNICACI\\\\u00d3N Y ARTES GR\\\\u00c1FICAS\\\",\\\"SECTOR SERVICIOS MEDIOAMBIENTALES\\\",\\\"SECTOR METAL\\\",\\\"SECTOR PESCA Y ACUICULTURA\\\",\\\"SECTOR INDUSTRIA QU\\\\u00cdMICA Y VIDRIO\\\",\\\"SECTOR SANIDAD\\\",\\\"SECTOR SERVICIOS A LAS EMPRESAS\\\",\\\"SECTOR DE TELECOMUNICACIONES\\\",\\\"SECTOR TEXTIL, CONFECCI\\\\u00d3N Y PIEL\\\",\\\"SECTOR TRANSPORTE Y LOG\\\\u00cdSTICA\\\"]\"', 1, '2020-05-19 19:06:03', '2020-05-19 19:06:03'),
(2, 'V', 'U', 1, 'Años de experiencia en ventas', '\"[\\\"Menos de 1 a\\\\u00f1o\\\",\\\"Entre 1 y 3 a\\\\u00f1os\\\",\\\"Entre 3 y 5 a\\\\u00f1os\\\",\\\"M\\\\u00e1s de 5 a\\\\u00f1os\\\"]\"', 1, '2020-05-19 19:06:03', '2020-05-19 19:06:03'),
(3, 'V', 'M', 2, 'Selecciona la/s opciones dónde tienes experiencia demostrable', '\"[\\\"Tengo experiencia vendiendo por tel\\\\u00e9fono productos f\\\\u00edsicos.\\\",\\\"Tengo experiencia vendiendo por tel\\\\u00e9fono servicios (consultor\\\\u00eda, infoproductos).\\\",\\\"Tengo experiencia vendiendo a puerta fr\\\\u00eda.\\\",\\\"Tengo experiencia como vendedor trabajando en un lugar f\\\\u00edsico.\\\",\\\"Tengo experiencia con visitas presenciales a empresas.\\\"]\"', 1, '2020-05-19 19:06:03', '2020-05-19 19:06:03'),
(4, 'V', 'U', 3, 'Ahora mismo cuál sería tu disponibilidad', '\"[\\\"Por las ma\\\\u00f1anas\\\",\\\"Por las tardes\\\",\\\"A tiempo completo\\\",\\\"No tengo disponibilidad\\\"]\"', 1, '2020-05-19 19:06:03', '2020-05-19 19:06:03'),
(5, 'V', 'U', 4, '¿Qué tipo de colaboración te interesa?', '\"[\\\"Por comisi\\\\u00f3n exclusivamente\\\",\\\"Un fijo mensual y una comisi\\\\u00f3n\\\"]\"', 1, '2020-05-19 19:06:03', '2020-05-19 19:06:03'),
(6, 'V', 'M', 5, '¿Con qué CRM tienes experiencia?', '\"[\\\"Hubspot\\\",\\\"Zoho\\\",\\\"SumaCRM\\\",\\\"Infusionsoft\\\",\\\"ActiveCampaign\\\",\\\"Pipedrive\\\",\\\"Close.io\\\",\\\"Salesforce\\\"]\"', 1, '2020-05-19 19:06:03', '2020-05-19 19:06:03'),
(7, 'V', 'U', 7, 'Sector al que te dedicas', '\"[\\\"SECTOR ADMINISTRACI\\\\u00d3N Y GESTI\\\\u00d3N (OFICINAS Y DESPACHOS)\\\",\\\"SECTOR AGRICULTURA Y GANADER\\\\u00cdA\\\",\\\"SECTOR INDUSTRIA ALIMENTARIA\\\",\\\"SECTOR DE INFOPRODUCTOS DIGITALES\\\",\\\"SECTOR INMOBILIARIO\\\",\\\"SECTOR GRANDES ALMACENES\\\",\\\"SECTOR COMERCIO\\\",\\\"SECTOR CONSTRUCCI\\\\u00d3N E INDUSTRIAS EXTRACTIVAS\\\",\\\"SECTOR ACTIVIDADES F\\\\u00cdSICO-DEPORTIVAS\\\",\\\"SECTOR EDUCACI\\\\u00d3N\\\",\\\"SECTOR ENERG\\\\u00cdA Y AGUA\\\",\\\"SECTOR FINANZAS Y SEGUROS\\\",\\\"SECTOR HOSTELER\\\\u00cdA Y TURISMO\\\",\\\"SECTOR INFORMACI\\\\u00d3N, COMUNICACI\\\\u00d3N Y ARTES GR\\\\u00c1FICAS\\\",\\\"SECTOR SERVICIOS MEDIOAMBIENTALES\\\",\\\"SECTOR METAL\\\",\\\"SECTOR PESCA Y ACUICULTURA\\\",\\\"SECTOR INDUSTRIA QU\\\\u00cdMICA Y VIDRIO\\\",\\\"SECTOR SANIDAD\\\",\\\"SECTOR SERVICIOS A LAS EMPRESAS\\\",\\\"SECTOR DE TELECOMUNICACIONES\\\",\\\"SECTOR TEXTIL, CONFECCI\\\\u00d3N Y PIEL\\\",\\\"SECTOR TRANSPORTE Y LOG\\\\u00cdSTICA\\\"]\"', 1, '2020-05-19 15:06:03', '2020-10-19 20:29:44'),
(8, 'V', 'U', 6, 'Ventas anuales', '\"[\\\"< 25.000\\\\u20ac\\\",\\\"25.000\\\\u20ac - 250.000\\\\u20ac\\\",\\\"A tiempo completo\\\",\\\"250.000\\\\u20ac - 1.000.000\\\\u20ac\\\"]\"', 1, '2020-10-19 20:29:44', '2020-10-19 20:29:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sector_oportunitys`
--

CREATE TABLE `sector_oportunitys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sector_oportunitys`
--

INSERT INTO `sector_oportunitys` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Administración gubernamental', NULL, NULL),
(2, 'Aeronáutica/ Aviación', NULL, NULL),
(3, 'Agricultura', NULL, NULL),
(4, 'Alimentación y bebidas', NULL, NULL),
(5, 'Almacenamiento', NULL, NULL),
(6, 'Animación', NULL, NULL),
(7, 'Apuestas y casinos', NULL, NULL),
(8, 'Arquitectura y planificación', NULL, NULL),
(9, 'Artes escénicas', NULL, NULL),
(10, 'Artesanía', NULL, NULL),
(11, 'Artículos de consumo', NULL, NULL),
(12, 'Artículos de lujo y joyas', NULL, NULL),
(13, 'Artículos deportivos', NULL, NULL),
(14, 'Atención a la salud mental', NULL, NULL),
(15, 'Atención sanitaria y hospitalaria', NULL, NULL),
(16, 'Automatización industrial', NULL, NULL),
(17, 'Banca', NULL, NULL),
(18, 'Banca de inversiones', NULL, NULL),
(19, 'Bellas Artes', NULL, NULL),
(20, 'Bibliotecas', NULL, NULL),
(21, 'Bienes inmobiliarios', NULL, NULL),
(22, 'Biotecnología', NULL, NULL),
(23, 'Capital de riesgo y capital privado', NULL, NULL),
(24, 'Construcción', NULL, NULL),
(25, 'Construcción naval', NULL, NULL),
(26, 'Consultoría de estrategia y operaciones', NULL, NULL),
(27, 'Contabilidad', NULL, NULL),
(28, 'Cosmética', NULL, NULL),
(29, 'Cristal, cerámica y hormigón', NULL, NULL),
(30, 'Cumplimiento de la ley', NULL, NULL),
(31, 'Departamento de defensa y del espacio exterior', NULL, NULL),
(32, 'Deportes', NULL, NULL),
(33, 'Derecho', NULL, NULL),
(34, 'Desarrollo de programación', NULL, NULL),
(35, 'Desarrollo y comercio exterior', NULL, NULL),
(36, 'Diseño', NULL, NULL),
(37, 'Diseño gráfico', NULL, NULL),
(38, 'Dotación y selección de personal', NULL, NULL),
(39, 'E-learning', NULL, NULL),
(40, 'Educación primaria/secundaria', NULL, NULL),
(41, 'Ejército', NULL, NULL),
(42, 'Electrónica de consumo', NULL, NULL),
(43, 'Embalaje y contenedores', NULL, NULL),
(44, 'Energía renovable y medio ambiente', NULL, NULL),
(45, 'Enseñanza superior', NULL, NULL),
(46, 'Entretenimiento', NULL, NULL),
(47, 'Envío de paquetes y carga', NULL, NULL),
(48, 'Equipos informáticos', NULL, NULL),
(49, 'Escritura y edición', NULL, NULL),
(50, 'Filantropía', NULL, NULL),
(51, 'Formación personal y capacitación', NULL, NULL),
(52, 'Fotografía', NULL, NULL),
(53, 'Gabinetes estratégicos', NULL, NULL),
(54, 'Ganadería', NULL, NULL),
(55, 'Gestión de inversiones', NULL, NULL),
(56, 'Gestión de organizaciones sin ánimo de lucro', NULL, NULL),
(57, 'Gestión educativa', NULL, NULL),
(58, 'Hostelería', NULL, NULL),
(59, 'Importación y exportación', NULL, NULL),
(60, 'Imprenta', NULL, NULL),
(61, 'Industria aeroespacial y aviación', NULL, NULL),
(62, 'Industria farmacéutica', NULL, NULL),
(63, 'Industria textil y moda', NULL, NULL),
(64, 'Ingeniería civil', NULL, NULL),
(65, 'Ingeniería industrial o mecánica', NULL, NULL),
(66, 'Instalaciones y servicios recreativos', NULL, NULL),
(67, 'Instituciones religiosas', NULL, NULL),
(68, 'Interconexión en red', NULL, NULL),
(69, 'Internet', NULL, NULL),
(70, 'Investigación', NULL, NULL),
(71, 'Investigación de mercado', NULL, NULL),
(72, 'Judicial', NULL, NULL),
(73, 'Lácteos', NULL, NULL),
(74, 'Logística y cadena de suministro', NULL, NULL),
(75, 'Manufactura eléctrica/electrónica', NULL, NULL),
(76, 'Manufactura ferroviaria', NULL, NULL),
(77, 'Maquinaria', NULL, NULL),
(78, 'Marketing y publicidad', NULL, NULL),
(79, 'Material y equipo de negocios', NULL, NULL),
(80, 'Materiales de construcción', NULL, NULL),
(81, 'Medicina alternativa', NULL, NULL),
(82, 'Medios de comunicación en línea', NULL, NULL),
(83, 'Medios de difusión', NULL, NULL),
(84, 'Mercados de capital', NULL, NULL),
(85, 'Minería y metalurgia', NULL, NULL),
(86, 'Mobiliario', NULL, NULL),
(87, 'Museos e instituciones', NULL, NULL),
(88, 'Música', NULL, NULL),
(89, 'Nanotecnología', NULL, NULL),
(90, 'Naval', NULL, NULL),
(91, 'Ocio, viajes y turismo', NULL, NULL),
(92, 'Oficina ejecutiva', NULL, NULL),
(93, 'Oficina legislativa', NULL, NULL),
(94, 'Organización cívica y social', NULL, NULL),
(95, 'Organización política', NULL, NULL),
(96, 'Películas y cine', NULL, NULL),
(97, 'Periódicos', NULL, NULL),
(98, 'Petróleo y energía', NULL, NULL),
(99, 'Piscicultura', NULL, NULL),
(100, 'Plásticos', NULL, NULL),
(101, 'Política pública', NULL, NULL),
(102, 'Producción alimentaria', NULL, NULL),
(103, 'Producción multimedia', NULL, NULL),
(104, 'Productos de papel y forestales', NULL, NULL),
(105, 'Productos químicos', NULL, NULL),
(106, 'Profesiones médicas', NULL, NULL),
(107, 'Protección civil', NULL, NULL),
(108, 'Publicaciones', NULL, NULL),
(109, 'Recaudación de fondos', NULL, NULL),
(110, 'Recursos humanos', NULL, NULL),
(111, 'Relaciones gubernamentales', NULL, NULL),
(112, 'Relaciones públicas y comunicaciones', NULL, NULL),
(113, 'Resolución de conflictos por terceras partes', NULL, NULL),
(114, 'Restaurantes', NULL, NULL),
(115, 'Sanidad, bienestar y ejercicio', NULL, NULL),
(116, 'Sector automovilístico', NULL, NULL),
(117, 'Sector textil', NULL, NULL),
(118, 'Seguridad del ordenador y de las redes', NULL, NULL),
(119, 'Seguridad e investigaciones', NULL, NULL),
(120, 'Seguros', NULL, NULL),
(121, 'Semiconductores', NULL, NULL),
(122, 'Servicio al consumidor', NULL, NULL),
(123, 'Servicio de información', NULL, NULL),
(124, 'Servicios de eventos', NULL, NULL),
(125, 'Servicios financieros', NULL, NULL),
(126, 'Servicios infraestructurales', NULL, NULL),
(127, 'Servicios jurídicos', NULL, NULL),
(128, 'Servicios médicos', NULL, NULL),
(129, 'Servicios medioambientales', NULL, NULL),
(130, 'Servicios para el individuo y la familia', NULL, NULL),
(131, 'Servicios públicos', NULL, NULL),
(132, 'Servicios y tecnología de la información', NULL, NULL),
(133, 'Software', NULL, NULL),
(134, 'Subcontrataciones/Offshoring', NULL, NULL),
(135, 'Supermercados', NULL, NULL),
(136, 'Tabacos', NULL, NULL),
(137, 'Tecnología inalámbrica', NULL, NULL),
(138, 'Telecomunicaciones', NULL, NULL),
(139, 'Traducción y localización', NULL, NULL),
(140, 'Transporte por carretera o ferrocarril', NULL, NULL),
(141, 'Venta al por mayor', NULL, NULL),
(142, 'Venta al por menor', NULL, NULL),
(143, 'Veterinaria', NULL, NULL),
(144, 'Videojuegos', NULL, NULL),
(145, 'Vídeos y licores', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seller_answered_surveys`
--

CREATE TABLE `seller_answered_surveys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `option_index` int(11) NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `seller_answered_surveys`
--

INSERT INTO `seller_answered_surveys` (`id`, `option_index`, `question_id`, `user_id`, `created_at`, `updated_at`) VALUES
(32, 0, 2, 22, '2020-06-22 09:03:38', '2020-06-22 09:03:38'),
(33, 2, 3, 22, '2020-06-22 09:03:38', '2020-06-22 09:03:38'),
(34, 2, 4, 22, '2020-06-22 09:03:38', '2020-06-22 09:03:38'),
(35, 1, 5, 22, '2020-06-22 09:03:38', '2020-06-22 09:03:38'),
(36, 4, 6, 22, '2020-06-22 09:03:38', '2020-06-22 09:03:38'),
(42, 0, 2, 8, '2020-07-01 05:18:31', '2020-07-01 05:18:31'),
(43, 0, 3, 8, '2020-07-01 05:18:31', '2020-07-01 05:18:31'),
(44, 1, 4, 8, '2020-07-01 05:18:31', '2020-07-01 05:18:31'),
(45, 1, 5, 8, '2020-07-01 05:18:31', '2020-07-01 05:18:31'),
(46, 1, 6, 8, '2020-07-01 05:18:31', '2020-07-01 05:18:31'),
(47, 0, 2, 183, '2020-09-08 10:38:16', '2020-09-08 10:38:16'),
(48, 0, 3, 183, '2020-09-08 10:38:16', '2020-09-08 10:38:16'),
(49, 1, 3, 183, '2020-09-08 10:38:16', '2020-09-08 10:38:16'),
(50, 2, 4, 183, '2020-09-08 10:38:16', '2020-09-08 10:38:16'),
(51, 0, 5, 183, '2020-09-08 10:38:16', '2020-09-08 10:38:16'),
(52, 0, 6, 183, '2020-09-08 10:38:17', '2020-09-08 10:38:17'),
(53, 4, 6, 183, '2020-09-08 10:38:17', '2020-09-08 10:38:17'),
(54, 3, 2, 17, '2020-10-05 07:45:59', '2020-10-05 07:45:59'),
(55, 0, 3, 17, '2020-10-05 07:45:59', '2020-10-05 07:45:59'),
(56, 2, 4, 17, '2020-10-05 07:45:59', '2020-10-05 07:45:59'),
(57, 0, 5, 17, '2020-10-05 07:45:59', '2020-10-05 07:45:59'),
(58, 0, 6, 17, '2020-10-05 07:45:59', '2020-10-05 07:45:59'),
(59, 1, 6, 17, '2020-10-05 07:45:59', '2020-10-05 07:45:59'),
(60, 2, 6, 17, '2020-10-05 07:45:59', '2020-10-05 07:45:59'),
(61, 3, 6, 17, '2020-10-05 07:45:59', '2020-10-05 07:45:59'),
(62, 4, 6, 17, '2020-10-05 07:45:59', '2020-10-05 07:45:59'),
(63, 5, 6, 17, '2020-10-05 07:45:59', '2020-10-05 07:45:59'),
(64, 6, 6, 17, '2020-10-05 07:45:59', '2020-10-05 07:45:59'),
(65, 7, 6, 17, '2020-10-05 07:45:59', '2020-10-05 07:45:59'),
(71, 2, 2, 187, '2020-10-08 20:33:03', '2020-10-08 20:33:03'),
(72, 0, 3, 187, '2020-10-08 20:33:03', '2020-10-08 20:33:03'),
(73, 2, 3, 187, '2020-10-08 20:33:03', '2020-10-08 20:33:03'),
(74, 2, 4, 187, '2020-10-08 20:33:03', '2020-10-08 20:33:03'),
(75, 0, 5, 187, '2020-10-08 20:33:03', '2020-10-08 20:33:03'),
(76, 1, 6, 187, '2020-10-08 20:33:03', '2020-10-08 20:33:03'),
(77, 3, 6, 187, '2020-10-08 20:33:03', '2020-10-08 20:33:03'),
(78, 4, 6, 187, '2020-10-08 20:33:03', '2020-10-08 20:33:03'),
(108, 1, 2, 16, '2020-10-14 09:19:45', '2020-10-14 09:19:45'),
(109, 0, 3, 16, '2020-10-14 09:19:45', '2020-10-14 09:19:45'),
(110, 0, 4, 16, '2020-10-14 09:19:45', '2020-10-14 09:19:45'),
(111, 0, 5, 16, '2020-10-14 09:19:45', '2020-10-14 09:19:45'),
(112, 0, 6, 16, '2020-10-14 09:19:45', '2020-10-14 09:19:45'),
(113, 1, 6, 16, '2020-10-14 09:19:45', '2020-10-14 09:19:45'),
(114, 0, 7, 16, '2020-10-14 09:19:45', '2020-10-14 09:19:45'),
(115, 1, 7, 16, '2020-10-14 09:19:45', '2020-10-14 09:19:45'),
(116, 2, 7, 16, '2020-10-14 09:19:45', '2020-10-14 09:19:45'),
(117, 3, 7, 16, '2020-10-14 09:19:45', '2020-10-14 09:19:45'),
(118, 4, 7, 16, '2020-10-14 09:19:45', '2020-10-14 09:19:45'),
(119, 5, 7, 16, '2020-10-14 09:19:45', '2020-10-14 09:19:45'),
(120, 7, 7, 16, '2020-10-14 09:19:45', '2020-10-14 09:19:45'),
(121, 8, 7, 16, '2020-10-14 09:19:45', '2020-10-14 09:19:45'),
(122, 9, 7, 16, '2020-10-14 09:19:45', '2020-10-14 09:19:45'),
(164, 0, 2, 18, '2020-10-15 14:17:06', '2020-10-15 14:17:06'),
(165, 0, 3, 18, '2020-10-15 14:17:06', '2020-10-15 14:17:06'),
(166, 0, 4, 18, '2020-10-15 14:17:06', '2020-10-15 14:17:06'),
(167, 0, 5, 18, '2020-10-15 14:17:06', '2020-10-15 14:17:06'),
(168, 0, 6, 18, '2020-10-15 14:17:06', '2020-10-15 14:17:06'),
(169, 18, 7, 18, '2020-10-15 14:17:06', '2020-10-15 14:17:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seller_profiles`
--

CREATE TABLE `seller_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone_mobil` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_home` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` double(8,2) NOT NULL DEFAULT '0.00' COMMENT 'Estatus completado',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `answered` longtext COLLATE utf8mb4_unicode_ci,
  `phone_mobil_country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_home_country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notified` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `seller_profiles`
--

INSERT INTO `seller_profiles` (`id`, `phone_mobil`, `phone_home`, `photo`, `video`, `linkedin`, `status`, `user_id`, `created_at`, `updated_at`, `answered`, `phone_mobil_country`, `phone_home_country`, `notified`) VALUES
(1, '424762126', NULL, 'storage/files/5ebe4a7caec0b6.44026109.png', 'storage/files/5efb05a4104df4.69428494.mp4', NULL, 75.00, 8, '2020-05-13 10:43:32', '2020-06-30 09:28:04', '\"[{\\\"question_id\\\":\\\"2\\\",\\\"option_index\\\":\\\"0\\\"},{\\\"question_id\\\":\\\"3\\\",\\\"option_index\\\":\\\"0\\\"},{\\\"question_id\\\":\\\"4\\\",\\\"option_index\\\":\\\"1\\\"},{\\\"question_id\\\":\\\"5\\\",\\\"option_index\\\":\\\"1\\\"},{\\\"question_id\\\":\\\"6\\\",\\\"option_index\\\":\\\"1\\\"}]\"', '+34', '+34', 0),
(2, '424762126', NULL, 'storage/files/5ebb98ff907162.86981403.jpg', NULL, NULL, 62.50, 16, '2020-05-13 10:51:43', '2020-10-14 09:19:45', '\"[{\\\"question_id\\\":\\\"2\\\",\\\"option_index\\\":\\\"1\\\"},{\\\"question_id\\\":\\\"3\\\",\\\"option_index\\\":\\\"0\\\"},{\\\"question_id\\\":\\\"4\\\",\\\"option_index\\\":\\\"0\\\"},{\\\"question_id\\\":\\\"5\\\",\\\"option_index\\\":\\\"0\\\"},{\\\"question_id\\\":\\\"6\\\",\\\"option_index\\\":\\\"0\\\"},{\\\"question_id\\\":\\\"6\\\",\\\"option_index\\\":\\\"1\\\"},{\\\"question_id\\\":\\\"7\\\",\\\"option_index\\\":\\\"0\\\"},{\\\"question_id\\\":\\\"7\\\",\\\"option_index\\\":\\\"1\\\"},{\\\"question_id\\\":\\\"7\\\",\\\"option_index\\\":\\\"2\\\"},{\\\"question_id\\\":\\\"7\\\",\\\"option_index\\\":\\\"3\\\"},{\\\"question_id\\\":\\\"7\\\",\\\"option_index\\\":\\\"4\\\"},{\\\"question_id\\\":\\\"7\\\",\\\"option_index\\\":\\\"5\\\"},{\\\"question_id\\\":\\\"7\\\",\\\"option_index\\\":\\\"7\\\"},{\\\"question_id\\\":\\\"7\\\",\\\"option_index\\\":\\\"8\\\"},{\\\"question_id\\\":\\\"7\\\",\\\"option_index\\\":\\\"9\\\"}]\"', '+34', '+34', 0),
(3, 'XXXXXXXXX', NULL, 'storage/files/5f88261d96ca18.33777123.png', NULL, NULL, 62.50, 18, '2020-05-13 10:55:49', '2020-10-15 14:17:06', '\"[{\\\"question_id\\\":\\\"2\\\",\\\"option_index\\\":\\\"0\\\"},{\\\"question_id\\\":\\\"3\\\",\\\"option_index\\\":\\\"0\\\"},{\\\"question_id\\\":\\\"4\\\",\\\"option_index\\\":\\\"0\\\"},{\\\"question_id\\\":\\\"5\\\",\\\"option_index\\\":\\\"0\\\"},{\\\"question_id\\\":\\\"6\\\",\\\"option_index\\\":\\\"0\\\"},{\\\"question_id\\\":\\\"7\\\",\\\"option_index\\\":\\\"18\\\"}]\"', '+34', '+34', 0),
(5, '666666666', '999999999', NULL, NULL, 'www.AndrésLinkedIn.es', 75.00, 22, '2020-06-22 09:03:38', '2020-06-22 09:03:38', '\"[{\\\"question_id\\\":\\\"2\\\",\\\"option_index\\\":\\\"0\\\"},{\\\"question_id\\\":\\\"3\\\",\\\"option_index\\\":\\\"2\\\"},{\\\"question_id\\\":\\\"4\\\",\\\"option_index\\\":\\\"2\\\"},{\\\"question_id\\\":\\\"5\\\",\\\"option_index\\\":\\\"1\\\"},{\\\"question_id\\\":\\\"6\\\",\\\"option_index\\\":\\\"4\\\"}]\"', '+34', '+34', 0),
(6, '634560984', NULL, NULL, NULL, NULL, 50.00, 183, '2020-09-08 10:36:15', '2020-09-08 10:38:16', '\"[{\\\"question_id\\\":\\\"2\\\",\\\"option_index\\\":\\\"0\\\"},{\\\"question_id\\\":\\\"3\\\",\\\"option_index\\\":\\\"0\\\"},{\\\"question_id\\\":\\\"3\\\",\\\"option_index\\\":\\\"1\\\"},{\\\"question_id\\\":\\\"4\\\",\\\"option_index\\\":\\\"2\\\"},{\\\"question_id\\\":\\\"5\\\",\\\"option_index\\\":\\\"0\\\"},{\\\"question_id\\\":\\\"6\\\",\\\"option_index\\\":\\\"0\\\"},{\\\"question_id\\\":\\\"6\\\",\\\"option_index\\\":\\\"4\\\"}]\"', '+34', '+34', 0),
(7, '666666665', NULL, NULL, NULL, NULL, 50.00, 17, '2020-10-05 07:45:59', '2020-10-05 07:45:59', '\"[{\\\"question_id\\\":\\\"2\\\",\\\"option_index\\\":\\\"3\\\"},{\\\"question_id\\\":\\\"3\\\",\\\"option_index\\\":\\\"0\\\"},{\\\"question_id\\\":\\\"4\\\",\\\"option_index\\\":\\\"2\\\"},{\\\"question_id\\\":\\\"5\\\",\\\"option_index\\\":\\\"0\\\"},{\\\"question_id\\\":\\\"6\\\",\\\"option_index\\\":\\\"0\\\"},{\\\"question_id\\\":\\\"6\\\",\\\"option_index\\\":\\\"1\\\"},{\\\"question_id\\\":\\\"6\\\",\\\"option_index\\\":\\\"2\\\"},{\\\"question_id\\\":\\\"6\\\",\\\"option_index\\\":\\\"3\\\"},{\\\"question_id\\\":\\\"6\\\",\\\"option_index\\\":\\\"4\\\"},{\\\"question_id\\\":\\\"6\\\",\\\"option_index\\\":\\\"5\\\"},{\\\"question_id\\\":\\\"6\\\",\\\"option_index\\\":\\\"6\\\"},{\\\"question_id\\\":\\\"6\\\",\\\"option_index\\\":\\\"7\\\"}]\"', '+34', '+34', 0),
(8, '666666119', NULL, NULL, NULL, NULL, 50.00, 187, '2020-10-05 11:30:55', '2020-10-08 20:33:03', '\"[{\\\"question_id\\\":\\\"2\\\",\\\"option_index\\\":\\\"2\\\"},{\\\"question_id\\\":\\\"3\\\",\\\"option_index\\\":\\\"0\\\"},{\\\"question_id\\\":\\\"3\\\",\\\"option_index\\\":\\\"2\\\"},{\\\"question_id\\\":\\\"4\\\",\\\"option_index\\\":\\\"2\\\"},{\\\"question_id\\\":\\\"5\\\",\\\"option_index\\\":\\\"0\\\"},{\\\"question_id\\\":\\\"6\\\",\\\"option_index\\\":\\\"1\\\"},{\\\"question_id\\\":\\\"6\\\",\\\"option_index\\\":\\\"3\\\"},{\\\"question_id\\\":\\\"6\\\",\\\"option_index\\\":\\\"4\\\"}]\"', '+34', '+34', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `skills`
--

CREATE TABLE `skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profesion_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status_oportunitys`
--

CREATE TABLE `status_oportunitys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `status_oportunitys`
--

INSERT INTO `status_oportunitys` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'no publicada', NULL, NULL),
(2, 'activa', NULL, NULL),
(3, 'cancelada', NULL, NULL),
(4, 'cerrada', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status_postulations`
--

CREATE TABLE `status_postulations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `status_postulations`
--

INSERT INTO `status_postulations` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'inscrito', NULL, NULL),
(2, 'en proceso', NULL, NULL),
(3, 'seleccionado', NULL, NULL),
(4, 'descartado', NULL, NULL),
(5, 'cancelado', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `tasked_at` date NOT NULL,
  `tasked_time` time NOT NULL,
  `remember_type` char(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'E' COMMENT 'tipo de recordatorio: (E)mail, (S)MS, etc',
  `remember_at` date NOT NULL,
  `remember_time` time NOT NULL,
  `task_queue_id` bigint(20) UNSIGNED DEFAULT NULL,
  `task_priority_id` bigint(20) UNSIGNED DEFAULT NULL,
  `task_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `contact_id` bigint(20) UNSIGNED DEFAULT NULL,
  `taskable_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taskable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `tasked_at`, `tasked_time`, `remember_type`, `remember_at`, `remember_time`, `task_queue_id`, `task_priority_id`, `task_type_id`, `contact_id`, `taskable_type`, `taskable_id`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Presupuesto', '<p>Enviar presupuesto</p>', '2020-08-13', '00:00:00', 'E', '2020-08-13', '00:00:00', 1, 2, 1, 26, 'App\\Contact', 6, '2020-08-14 02:47:11', '2020-08-14 02:47:11', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `task_priorities`
--

CREATE TABLE `task_priorities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `task_priorities`
--

INSERT INTO `task_priorities` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Ninguna', NULL, NULL),
(2, 'Baja', NULL, NULL),
(3, 'Media', NULL, NULL),
(4, 'Alta', NULL, NULL),
(5, 'Urgente', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `task_queues`
--

CREATE TABLE `task_queues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `task_queues`
--

INSERT INTO `task_queues` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Ventonic', NULL, NULL),
(2, 'Correo propio', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `task_types`
--

CREATE TABLE `task_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `task_types`
--

INSERT INTO `task_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Otros', NULL, NULL),
(2, 'Presupuesto', NULL, NULL),
(3, 'Llamada', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `time_zone_oportunitys`
--

CREATE TABLE `time_zone_oportunitys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `time_zone_oportunitys`
--

INSERT INTO `time_zone_oportunitys` (`id`, `description`, `details`, `created_at`, `updated_at`) VALUES
(1, 'Cualquier zona horaria', NULL, NULL, NULL),
(2, 'Zona horaria especificada', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `todos`
--

CREATE TABLE `todos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `todos` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `todos`
--

INSERT INTO `todos` (`id`, `user_id`, `todos`, `created_at`, `updated_at`) VALUES
(1, 9, '[{\"id\":\"054eh\",\"title\":\"test con .env\",\"description\":\"test usando .env para la ruta\",\"filters\":{\"starred\":false,\"important\":false,\"completed\":true,\"trashed\":true},\"labels\":[]},{\"id\":\"173fj\",\"title\":\"3ra nota!\",\"description\":\"notas continuas\",\"filters\":{\"starred\":true,\"important\":true,\"completed\":false,\"trashed\":false},\"labels\":[]},{\"id\":\"c5004\",\"title\":\"dos notas\",\"description\":\"segunda nota\",\"filters\":{\"starred\":false,\"important\":true,\"completed\":false,\"trashed\":false},\"labels\":[1,2,4]},{\"id\":\"i980h\",\"title\":\"una nota\",\"description\":\"1 nota\",\"filters\":{\"starred\":false,\"important\":false,\"completed\":false,\"trashed\":false},\"labels\":[]},{\"id\":\"7818j\",\"title\":\"Test 6\",\"description\":\"4 etiquetas\",\"filters\":{\"starred\":false,\"important\":false,\"completed\":false,\"trashed\":false},\"labels\":[1,2,3,4]},{\"id\":\"16eaa\",\"title\":\"test 5\",\"description\":\"dos etiquetas\",\"filters\":{\"starred\":false,\"important\":false,\"completed\":false,\"trashed\":false},\"labels\":[1,2]},{\"id\":\"jc1je\",\"title\":\"Test 44\",\"description\":\"3 etiquetas\",\"filters\":{\"starred\":false,\"important\":false,\"completed\":true,\"trashed\":false},\"labels\":[1,2,3]},{\"id\":\"ih39h\",\"title\":\"Test 3\",\"description\":\"Una etiqueta\",\"filters\":{\"starred\":false,\"important\":false,\"completed\":false,\"trashed\":false},\"labels\":[1]},{\"id\":\"ec8j3\",\"title\":\"test 2\",\"description\":\"test sin etiquetas\",\"filters\":{\"starred\":false,\"important\":false,\"completed\":false,\"trashed\":false},\"labels\":[]},{\"id\":\"iifdg\",\"title\":\"sales\",\"description\":\"salessss\",\"filters\":{\"starred\":true,\"important\":true,\"completed\":true,\"trashed\":false},\"labels\":[]},{\"id\":\"508jc\",\"title\":\"ventonic\",\"description\":\"ventonic\",\"filters\":{\"starred\":true,\"important\":false,\"completed\":false,\"trashed\":false},\"labels\":[]},{\"id\":\"c39fb\",\"title\":\"test\",\"description\":\"test\",\"filters\":{\"starred\":true,\"important\":false,\"completed\":false,\"trashed\":false},\"labels\":[]}]', '2020-06-18 13:43:14', '2020-10-01 15:52:37'),
(2, 8, '[{\"id\":\"j625j\",\"title\":\"Prueba #9\",\"description\":\"testttt\",\"filters\":{\"starred\":true,\"important\":false,\"completed\":false,\"trashed\":false},\"labels\":[1,2,3,4]},{\"id\":\"1231b\",\"title\":\"Prueba #8\",\"description\":\"Más pruebas!!!\",\"filters\":{\"starred\":true,\"important\":true,\"completed\":false,\"trashed\":false},\"labels\":[1,3]},{\"id\":\"52731\",\"title\":\"Prueba #7\",\"description\":\"Pruebaaaaaaaaaa\",\"filters\":{\"starred\":true,\"important\":true,\"completed\":false,\"trashed\":false},\"labels\":[1,2,3,4]},{\"id\":\"b839a\",\"title\":\"Prueba #6\",\"description\":\"Pruebaaaaaa\",\"filters\":{\"starred\":false,\"important\":false,\"completed\":false,\"trashed\":false},\"labels\":[]},{\"id\":\"f1447\",\"title\":\"Prueba #5\",\"description\":\"Pruebaaaa\",\"filters\":{\"starred\":false,\"important\":false,\"completed\":false,\"trashed\":false},\"labels\":[]},{\"id\":\"ba621\",\"title\":\"Prueba #4\",\"description\":\"Pruebaaaaa\",\"filters\":{\"starred\":false,\"important\":false,\"completed\":false,\"trashed\":false},\"labels\":[]},{\"id\":\"6dj72\",\"title\":\"Prueba #3\",\"description\":\"prueba\",\"filters\":{\"starred\":true,\"important\":true,\"completed\":false,\"trashed\":false},\"labels\":[]},{\"id\":\"953e5\",\"title\":\"Prueba #2\",\"description\":\"Prueba\",\"filters\":{\"starred\":true,\"important\":true,\"completed\":false,\"trashed\":false},\"labels\":[]},{\"id\":\"d71a0\",\"title\":\"Prueba #1\",\"description\":\"Estoy como usuario vendedor\",\"filters\":{\"starred\":true,\"important\":true,\"completed\":false,\"trashed\":false},\"labels\":[1,3,2,4]}]', '2020-06-18 13:51:05', '2020-06-30 11:36:42'),
(3, 13, '[{\"id\":\"bd734\",\"title\":\"Llamar por telefono\",\"description\":\"llamar por telefono a vendedores\",\"filters\":{\"starred\":false,\"important\":false,\"completed\":false,\"trashed\":false},\"labels\":[1]}]', '2020-08-27 15:10:03', '2020-08-27 15:10:16'),
(4, 14, '[{\"id\":\"1ib9c\",\"title\":\"Churrasco con Fernando\",\"description\":\"Comprar churrasco\",\"filters\":{\"starred\":false,\"important\":true,\"completed\":true,\"trashed\":false},\"labels\":[4]},{\"id\":\"e0357\",\"title\":\"Misa de comunión\",\"description\":\"Misa del hijo de Luis\",\"filters\":{\"starred\":true,\"important\":false,\"completed\":false,\"trashed\":false},\"labels\":[1]},{\"id\":\"h91ih\",\"title\":\"Esquemas en Dashboard\",\"description\":\"Preguntar a A&C sobre el gráfico de estadísticas de ventas\",\"filters\":{\"starred\":true,\"important\":true,\"completed\":false,\"trashed\":false},\"labels\":[2]}]', '2020-09-30 11:08:42', '2020-10-09 19:47:39'),
(5, 15, '[{\"id\":\"fhb7e\",\"title\":\"Dentista martes 14:00\",\"description\":\"Revisión dentista\",\"filters\":{\"starred\":false,\"important\":false,\"completed\":false,\"trashed\":false},\"labels\":[1]},{\"id\":\"3adja\",\"title\":\"Reunión lunes 8:00\",\"description\":\"Prospección semana anterior. \\nPrevisión semana entrante. \",\"filters\":{\"starred\":false,\"important\":false,\"completed\":false,\"trashed\":false},\"labels\":[2]}]', '2020-10-05 16:42:27', '2020-10-05 16:43:27'),
(6, 187, '[{\"id\":\"h9d0i\",\"title\":\"Nota 04\",\"description\":\"Cuarta nota\",\"filters\":{\"starred\":true,\"important\":true,\"completed\":false,\"trashed\":false},\"labels\":[4]},{\"id\":\"489a1\",\"title\":\"Nota 05\",\"description\":\"Quinta nota\",\"filters\":{\"starred\":false,\"important\":false,\"completed\":false,\"trashed\":true},\"labels\":[1,4]},{\"id\":\"5f4gd\",\"title\":\"Nota 01\",\"description\":\"Primera nota\",\"filters\":{\"starred\":false,\"important\":true,\"completed\":false,\"trashed\":false},\"labels\":[2]}]', '2020-10-07 09:10:59', '2020-10-07 09:51:13'),
(7, 18, '[{\"id\":\"f8465\",\"title\":\"Liquidar crédito en ABANCA\",\"description\":\"Reajustar crédito \",\"filters\":{\"starred\":false,\"important\":true,\"completed\":false,\"trashed\":false},\"labels\":[4,2]},{\"id\":\"95715\",\"title\":\"ANULAR CONTRATACIÓN\",\"description\":\"Plantear nuevas condiciones del contrato, sino anularlo\",\"filters\":{\"starred\":true,\"important\":false,\"completed\":false,\"trashed\":false},\"labels\":[2,3]},{\"id\":\"g47h0\",\"title\":\"Reunión con Ana Laura\",\"description\":\"Reunión para prepara lanzamiento\",\"filters\":{\"starred\":true,\"important\":false,\"completed\":false,\"trashed\":false},\"labels\":[1]},{\"id\":\"4f7ge\",\"title\":\"Cumpleaños de tía\",\"description\":\"Preparativos para el cumpleaños\",\"filters\":{\"starred\":false,\"important\":true,\"completed\":false,\"trashed\":false},\"labels\":[1]},{\"id\":\"f14e0\",\"title\":\"Describir la gráfica de ventas en Dashboard\",\"description\":\"Describir el funcionamiento y las ventajas de las gfráficas diseñadas  en el dashboard\",\"filters\":{\"starred\":false,\"important\":false,\"completed\":true,\"trashed\":false},\"labels\":[]}]', '2020-10-09 19:50:06', '2020-10-09 20:04:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_oportunitys`
--

CREATE TABLE `type_oportunitys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `type_oportunitys`
--

INSERT INTO `type_oportunitys` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Publica un empleo', NULL, NULL),
(2, 'Ayuda a alguien que conoces a encontrar candidatos', NULL, NULL),
(3, 'Comparte un enlace que encontraste (Fuera de Torre).', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubication_oportunitys`
--

CREATE TABLE `ubication_oportunitys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ubication_oportunitys`
--

INSERT INTO `ubication_oportunitys` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Remoto - cualquier parte', NULL, NULL),
(2, 'Remoto - dentro de un pais - region', NULL, NULL),
(3, 'Ubicacion fisica/oficina', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('V','E') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'V',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL COMMENT 'Último acceso registrado',
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Determina si el usuario es administrador',
  `dash_demo` tinyint(1) DEFAULT '0' COMMENT 'Si esta en demo la vista de dash'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `type`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `last_login`, `uuid`, `is_admin`, `dash_demo`) VALUES
(8, 'Vendedor', 'Uno', 'vendedor1@ventonic.com', 'V', 0, '2020-04-28 02:14:18', '$2y$10$Zv8W/aa3Tfffa9DEFE0Hxev6vqGTntc5ENUP9pxlLXMBor1sTA84G', 'xuz2ksMUwM1Hc1lfxpt90WHSJa8q89Zgg5OjvfpNr3JvhIPrlkoALPxmFJHf', '2020-04-28 02:13:36', '2020-10-20 05:31:39', '2020-10-20 05:21:46', '9b312239-5719-492c-a704-99d5e4afddd9', 0, 1),
(9, 'Empresa', 'Uno', 'empresa1@ventonic.com', 'E', 1, '2020-04-28 02:21:56', '$2y$10$f6K3l6.4QsfC/Q7mZjJtYOxXV1VjmVhtWM2BLDl69tSeSN17D.eFa', 'Dqoyqitupv244h6w8v7u8d3kn8hDxjts7YyIbZCvVwL545YDZzjFJ40Tc5YM', '2020-04-28 02:21:15', '2020-10-20 05:31:59', '2020-10-20 05:31:59', '4e5454f9-fc47-4e06-87a8-b34bb3a25aa1', 0, 1),
(13, 'Empresa', 'Dos', 'empresa2@ventonic.com', 'E', 0, '2020-04-29 12:05:47', '$2y$10$qj4jH7NjDuzlS9WjOCphLOkXaMUZ1QvNOpDcAAZhScI28AtSPgpya', NULL, '2020-04-29 12:05:11', '2020-10-15 15:34:57', '2020-10-15 14:56:50', '31031137-fbe0-4bc4-b9a0-5d28ed65291a', 0, 0),
(14, 'PERFIL', 'PRUEBA', 'empresa3@ventonic.com', 'E', 1, '2020-04-29 17:13:33', '$2y$10$K.MN4G3j1jxZmluo5QT45Ok8hlCpOD6xkjsUmBroJzFhdLo5JP4fi', 'k22JFYy1wULnOQNksYAP8fNMsjWRTiaY6vhsj07ofU26yu26nCZLncDddfrJ', '2020-04-29 17:13:06', '2020-10-20 01:10:50', '2020-10-20 01:10:50', '6d550466-7d2c-49b4-8688-d563e0524e08', 0, 1),
(15, 'Empresa', 'Cuatro', 'empresa4@ventonic.com', 'E', 1, '2020-04-29 23:55:41', '$2y$10$qj4jH7NjDuzlS9WjOCphLOkXaMUZ1QvNOpDcAAZhScI28AtSPgpya', NULL, '2020-04-29 23:55:13', '2020-10-19 11:48:44', '2020-10-19 11:48:44', 'da01276f-bdab-4635-98f4-2dba5e65c357', 0, 1),
(16, 'Vendedor', 'Dos', 'vendedor2@ventonic.com', 'V', 1, '2020-04-30 00:04:06', '$2y$10$qj4jH7NjDuzlS9WjOCphLOkXaMUZ1QvNOpDcAAZhScI28AtSPgpya', NULL, '2020-04-30 00:03:55', '2020-10-19 15:22:58', '2020-10-19 15:22:58', 'b14388b1-3e41-444c-9835-6898007a7777', 0, 0),
(17, 'Vendedor', 'Cuatro', 'vendedor4@ventonic.com', 'V', 1, '2020-04-30 01:23:35', '$2y$10$qj4jH7NjDuzlS9WjOCphLOkXaMUZ1QvNOpDcAAZhScI28AtSPgpya', NULL, '2020-04-30 01:22:18', '2020-10-19 14:26:07', '2020-10-19 14:26:07', '6cd4603c-73af-4bbd-bb36-ffa99d16f343', 0, 0),
(18, 'PERFIL', 'PRUEBA', 'vendedor3@ventonic.com', 'V', 0, '2020-04-30 02:29:57', '$2y$10$qj4jH7NjDuzlS9WjOCphLOkXaMUZ1QvNOpDcAAZhScI28AtSPgpya', NULL, '2020-04-30 02:27:22', '2020-10-20 01:10:40', '2020-10-20 00:35:35', 'bd34c317-c173-4b47-b1ed-1b770586390d', 0, 1),
(22, 'Andrés', 'Vendedor', 'Vendedorventon@Gmail.Com', 'V', 0, '2020-06-22 09:02:09', '$2y$10$Qyr/nr0.21f3xDqB4O7WSeAAP9jJgIQESNIN/NtEpHB9oZbIVTZV2', NULL, '2020-06-22 09:01:29', '2020-07-27 22:58:16', '2020-07-22 12:58:49', '35165eb5-5faa-4180-9edd-4fb08ee8c8d5', 0, 0),
(23, 'Seth Oberbrunner', NULL, 'khalil93@example.com', 'V', 0, '2020-07-11 02:56:08', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'czC1ne9nVJ', '2020-07-11 02:56:08', '2020-07-27 22:58:16', NULL, '351856c4-0884-42b5-b48b-9e7fa2957e40', 0, 0),
(24, 'Colten Bins', NULL, 'sawayn.heber@example.com', 'V', 0, '2020-07-11 02:56:08', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'wZDYUPdptF', '2020-07-11 02:56:08', '2020-07-27 22:58:16', NULL, '82d7d422-74d4-44c7-8687-063efe114e38', 0, 0),
(25, 'Adrienne Little', NULL, 'kane.pouros@example.com', 'V', 0, '2020-07-11 02:56:08', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ArJf5YG2HD', '2020-07-11 02:56:08', '2020-07-27 22:58:16', NULL, '8979b2da-d75a-4985-9a82-c8c9b5397561', 0, 0),
(26, 'Mrs. Alanis Sporer', NULL, 'rsawayn@example.net', 'V', 0, '2020-07-11 02:56:08', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'nUHcQsZHxM', '2020-07-11 02:56:08', '2020-07-27 22:58:16', NULL, 'eb92690a-3e86-4e25-aaa1-f47c105e5706', 0, 0),
(27, 'Dr. Kassandra Cruickshank MD', NULL, 'kenneth.medhurst@example.com', 'V', 0, '2020-07-11 02:56:08', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3GQGyvl8sn', '2020-07-11 02:56:08', '2020-07-27 22:58:16', NULL, '892f4849-a005-4f72-878c-2ff66f93e4dc', 0, 0),
(28, 'Nash Parisian III', NULL, 'nina10@example.com', 'V', 0, '2020-07-11 02:56:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'he6xDboxMQ', '2020-07-11 02:56:09', '2020-07-27 22:58:16', NULL, 'e2d7906c-f28d-4f97-8e69-ec666ebca568', 0, 0),
(29, 'Dr. Carli Farrell I', NULL, 'zkoelpin@example.org', 'V', 0, '2020-07-11 02:56:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Jm0lEe089i', '2020-07-11 02:56:09', '2020-07-27 22:58:16', NULL, '57323ef5-56ce-4bc1-a5fe-8af6d5e50f35', 0, 0),
(30, 'Shaniya Fahey', NULL, 'annabelle72@example.net', 'V', 0, '2020-07-11 02:56:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'wXnsnKCsjo', '2020-07-11 02:56:09', '2020-07-27 22:58:16', NULL, '5c4e08b9-a16e-407b-8438-602bfe6573ef', 0, 0),
(31, 'Dr. Vernice Conroy V', NULL, 'chloe.kerluke@example.org', 'V', 0, '2020-07-11 02:56:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'rkKdSXu9LN', '2020-07-11 02:56:09', '2020-07-27 22:58:17', NULL, '2405a1e9-6046-4b4d-add0-3113fdb5397c', 0, 0),
(32, 'Prof. Beatrice Jenkins I', NULL, 'unique99@example.org', 'V', 0, '2020-07-11 02:56:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'yr4eVC1lux', '2020-07-11 02:56:09', '2020-07-27 22:58:17', NULL, '5bccb9f3-5fd4-4a2b-b809-2f56f0c68d7a', 0, 0),
(33, 'Mona Dietrich IV', NULL, 'thamill@example.com', 'V', 0, '2020-07-11 02:56:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'UWgB8T514k', '2020-07-11 02:56:09', '2020-07-27 22:58:17', NULL, '94074737-8dcf-4175-93f6-97a25253f08c', 0, 0),
(34, 'Bryce Trantow', NULL, 'theresa.rippin@example.net', 'V', 0, '2020-07-11 02:56:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'uQAcdwD1hK', '2020-07-11 02:56:09', '2020-07-27 22:58:17', NULL, '1863f048-3e56-4e7d-81e4-bc681f3fc12a', 0, 0),
(35, 'Selmer Rice', NULL, 'etremblay@example.org', 'V', 0, '2020-07-11 02:56:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '9gQxwoA8PS', '2020-07-11 02:56:09', '2020-07-27 22:58:17', NULL, 'a61ae359-61fb-436e-9d83-8ebe6c7366f7', 0, 0),
(36, 'Jace McDermott', NULL, 'skiles.margaretta@example.org', 'V', 0, '2020-07-11 02:56:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '7Nypgz0s46', '2020-07-11 02:56:09', '2020-07-27 22:58:17', NULL, '4f9065c8-b8e9-41e0-8c19-764447ad5c21', 0, 0),
(37, 'Lindsay Herman', NULL, 'destiny.klocko@example.com', 'V', 0, '2020-07-11 02:56:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'UEgubWONAa', '2020-07-11 02:56:09', '2020-07-27 22:58:17', NULL, '68a5b73c-056c-4f66-9029-633bf4ba204b', 0, 0),
(38, 'Elvie O\'Keefe', NULL, 'izabella.feil@example.com', 'V', 0, '2020-07-11 02:56:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 's5I5Dr9SFB', '2020-07-11 02:56:09', '2020-07-27 22:58:17', NULL, 'f1f195d5-e82c-4a40-b854-0d0ee52c0f81', 0, 0),
(39, 'Mario Stanton', NULL, 'eabernathy@example.net', 'V', 0, '2020-07-11 02:56:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1TWWcsvgDh', '2020-07-11 02:56:09', '2020-07-27 22:58:17', NULL, '12e42e90-7332-4dd3-b2ef-ce894f66b81f', 0, 0),
(40, 'Vallie Kunde', NULL, 'francesco35@example.com', 'V', 0, '2020-07-11 02:56:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'RiCt8SSx1T', '2020-07-11 02:56:09', '2020-07-27 22:58:17', NULL, '4abcf7bd-feb0-4014-b937-df08e72a134b', 0, 0),
(41, 'Joanne Schmitt', NULL, 'janderson@example.org', 'V', 0, '2020-07-11 02:56:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'tAe2DizQJC', '2020-07-11 02:56:09', '2020-07-27 22:58:17', NULL, 'ee531cf5-d26b-463d-bf71-add5718ada15', 0, 0),
(42, 'Lindsay Rath', NULL, 'grimes.lois@example.com', 'V', 0, '2020-07-11 02:56:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'XENUb0sB5o', '2020-07-11 02:56:09', '2020-07-27 22:58:17', NULL, '97e40330-62f4-4f1c-b4ec-01d30118c80e', 0, 0),
(43, 'Era Huels', NULL, 'ihackett@example.net', 'V', 0, '2020-07-11 02:56:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2CGfF9YSky', '2020-07-11 02:56:09', '2020-07-27 22:58:17', NULL, '186492e6-9840-428d-82ae-6bbaf4bb3636', 0, 0),
(44, 'Ms. Myah Tillman', NULL, 'iconsidine@example.net', 'V', 0, '2020-07-11 02:56:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'BpMJWqUmGb', '2020-07-11 02:56:09', '2020-07-27 22:58:17', NULL, '417e17f6-c534-449a-a47c-b6a40b2783c4', 0, 0),
(45, 'Stewart Smitham', NULL, 'ogusikowski@example.org', 'V', 0, '2020-07-11 02:56:10', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'OhLLpNPn5M', '2020-07-11 02:56:10', '2020-07-27 22:58:17', NULL, 'ff953528-8c1c-4dff-847f-c0877e2aa80d', 0, 0),
(46, 'Trisha Lehner', NULL, 'dluettgen@example.net', 'V', 0, '2020-07-11 02:56:10', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'RQI3A1BxPG', '2020-07-11 02:56:10', '2020-07-27 22:58:17', NULL, '2aaea67a-0195-4cd2-a8aa-a5498c52cd7a', 0, 0),
(47, 'Ethel Lesch', NULL, 'qdach@example.net', 'V', 0, '2020-07-11 02:56:10', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'qNOmM0lx8p', '2020-07-11 02:56:10', '2020-07-27 22:58:17', NULL, 'cc573393-9734-499f-9092-2b11b7894b7d', 0, 0),
(48, 'Prof. Sarai Schaden V', NULL, 'ibatz@example.com', 'V', 0, '2020-07-11 02:56:10', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'HCr7CSA5bN', '2020-07-11 02:56:10', '2020-07-27 22:58:17', NULL, 'c6df0589-ec5e-4a3e-a3ce-3298cdaec0be', 0, 0),
(49, 'Kasandra Huels DDS', NULL, 'vida22@example.org', 'V', 0, '2020-07-11 02:56:10', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'TrbDuzODk2', '2020-07-11 02:56:10', '2020-07-27 22:58:17', NULL, '313d1f63-647f-4278-8872-a57a766b18c9', 0, 0),
(50, 'Hilda Paucek V', NULL, 'patricia.lubowitz@example.net', 'V', 0, '2020-07-11 02:56:10', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'K8MnJbSIR7', '2020-07-11 02:56:10', '2020-07-27 22:58:17', NULL, 'c8874737-20d3-40fd-80c4-28a3b5be97ac', 0, 0),
(51, 'Angelica Ondricka', NULL, 'casper31@example.com', 'V', 0, '2020-07-11 02:56:10', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pIPN5vh2eY', '2020-07-11 02:56:10', '2020-07-27 22:58:17', NULL, 'f6e4a8fa-375b-4260-932a-8597d7857b99', 0, 0),
(52, 'Jasmin Upton', NULL, 'cummerata.doyle@example.net', 'V', 0, '2020-07-11 02:56:10', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'hYA4EOx1Rr', '2020-07-11 02:56:10', '2020-07-27 22:58:17', NULL, '9885f4ad-7434-411c-afaf-24b55a22d3d2', 0, 0),
(53, 'Tess Boyer', NULL, 'horace.leannon@example.com', 'V', 0, '2020-07-11 02:56:10', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'APsHUzNHxx', '2020-07-11 02:56:10', '2020-07-27 22:58:17', NULL, '3d4af3ce-3e02-44e5-b9f4-8dc03855b715', 0, 0),
(54, 'Tatum Rice', NULL, 'robbie50@example.com', 'V', 0, '2020-07-11 02:56:10', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'XlcOH31YlA', '2020-07-11 02:56:10', '2020-07-27 22:58:17', NULL, 'db740dd9-19a4-44b0-816e-d6c87061f391', 0, 0),
(55, 'Baylee Mosciski', NULL, 'konopelski.margarett@example.com', 'V', 0, '2020-07-11 02:56:11', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'BOLKVv4Igq', '2020-07-11 02:56:11', '2020-07-27 22:58:17', NULL, '701697fb-f249-44b5-a0ef-9f73c1f1621c', 0, 0),
(56, 'Sven Ernser', NULL, 'dhermiston@example.com', 'V', 0, '2020-07-11 02:56:11', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'GhqGDDiX1b', '2020-07-11 02:56:11', '2020-07-27 22:58:17', NULL, '3bcf1ed7-2381-4a6d-a62d-223608c1d81a', 0, 0),
(57, 'Tomasa Torp DDS', NULL, 'purdy.demarco@example.com', 'V', 0, '2020-07-11 02:56:11', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'KM179sAwQF', '2020-07-11 02:56:11', '2020-07-27 22:58:17', NULL, 'e1e14e90-60e1-4aa5-9dee-ec0fa24eadc7', 0, 0),
(58, 'Prof. Romaine Wisoky', NULL, 'hudson.antone@example.net', 'V', 0, '2020-07-11 02:56:11', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'qHLs6O67Cc', '2020-07-11 02:56:11', '2020-07-27 22:58:17', NULL, 'f021acaa-4bba-4869-9294-2cf418bdb74f', 0, 0),
(59, 'Prof. Karolann Wyman Jr.', NULL, 'egrady@example.com', 'V', 0, '2020-07-11 02:56:11', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'bUmOEcrhoH', '2020-07-11 02:56:11', '2020-07-27 22:58:17', NULL, '9237974b-e511-4037-9975-37c586660540', 0, 0),
(60, 'Prof. Dax Durgan', NULL, 'gschroeder@example.net', 'V', 0, '2020-07-11 02:56:11', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2Kk9692NEH', '2020-07-11 02:56:11', '2020-07-27 22:58:17', NULL, '9a10c970-df30-45fe-aef6-c98082d9b396', 0, 0),
(61, 'Julius Stamm', NULL, 'darrel55@example.org', 'V', 0, '2020-07-11 02:56:11', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'iL10DRfzRI', '2020-07-11 02:56:11', '2020-07-27 22:58:17', NULL, 'ea352663-2789-4742-981c-8fa3b94a1c20', 0, 0),
(62, 'Julien Lubowitz I', NULL, 'guy86@example.com', 'V', 0, '2020-07-11 02:56:11', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'dcNM9GNxt4', '2020-07-11 02:56:11', '2020-07-27 22:58:17', NULL, 'd5de5357-74eb-4c93-b342-866c3c69e262', 0, 0),
(63, 'Della Considine', NULL, 'elueilwitz@example.com', 'V', 0, '2020-07-11 02:56:11', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'som22Fmdzs', '2020-07-11 02:56:11', '2020-07-27 22:58:17', NULL, '05765a6e-4a52-447f-82c8-37cac1674f18', 0, 0),
(64, 'Mrs. Sandy Upton', NULL, 'jerde.benton@example.com', 'V', 0, '2020-07-11 02:56:11', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'BoMw5qq3ta', '2020-07-11 02:56:11', '2020-07-27 22:58:18', NULL, 'e9c72ab6-94b0-4c5d-ac2c-4b704f4425fc', 0, 0),
(65, 'Alysson Larkin DDS', NULL, 'veum.eriberto@example.com', 'V', 0, '2020-07-11 02:56:11', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'DNIfP4wxAl', '2020-07-11 02:56:11', '2020-07-27 22:58:18', NULL, '168f1d13-1a30-47c0-a6fb-f253a79457d4', 0, 0),
(66, 'Celine Littel', NULL, 'quinten39@example.org', 'V', 0, '2020-07-11 02:56:11', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '9AAdVawuk9', '2020-07-11 02:56:11', '2020-07-27 22:58:18', NULL, 'b51ad3e8-2db8-444a-a8c0-8ee68587511b', 0, 0),
(67, 'Rachel Jerde DVM', NULL, 'dickens.elliot@example.com', 'V', 0, '2020-07-11 02:56:11', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'rmlzaFtUsh', '2020-07-11 02:56:11', '2020-07-27 22:58:18', NULL, 'feb636da-8142-4670-acc2-d410c3b3c3ad', 0, 0),
(68, 'Alycia Shields', NULL, 'wshanahan@example.com', 'V', 0, '2020-07-11 02:56:11', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ZFXQjXsFVo', '2020-07-11 02:56:11', '2020-07-27 22:58:18', NULL, '64fa0e78-ab30-42e8-8b3e-8323c79d5f58', 0, 0),
(69, 'Cesar Rippin', NULL, 'rey63@example.org', 'V', 0, '2020-07-11 02:56:11', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'AoK7hpSOXk', '2020-07-11 02:56:11', '2020-07-27 22:58:18', NULL, 'c4a832d4-1935-4c49-9892-e677a1b192a3', 0, 0),
(70, 'Lane O\'Kon', NULL, 'kennedi80@example.com', 'V', 0, '2020-07-11 02:56:12', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Hu5akEGBao', '2020-07-11 02:56:12', '2020-07-27 22:58:18', NULL, 'ae064d13-2a35-41ca-81cd-4491f37f703b', 0, 0),
(71, 'Ottis Kuvalis', NULL, 'ykutch@example.net', 'V', 0, '2020-07-11 02:56:12', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'vVzgtzR0vg', '2020-07-11 02:56:12', '2020-07-27 22:58:18', NULL, '920833cd-bec5-416d-a24c-505d125bcb48', 0, 0),
(72, 'Garth Heller', NULL, 'christiansen.jedidiah@example.com', 'V', 0, '2020-07-11 02:56:12', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '9WUMYRvAZE', '2020-07-11 02:56:12', '2020-07-27 22:58:18', NULL, 'f131272f-8b88-4433-a9b2-f7b8ea819b0e', 0, 0),
(73, 'Dr. Cora Grady V', NULL, 'zstiedemann@example.com', 'V', 0, '2020-07-11 02:56:12', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'o4cnKvR5Dv', '2020-07-11 02:56:12', '2020-07-27 22:58:18', NULL, '020f1ce9-57af-4799-b81a-add1518b85cd', 0, 0),
(74, 'Francesca Hagenes', NULL, 'anne32@example.net', 'V', 0, '2020-07-11 02:56:12', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'nKYc7Lsi8f', '2020-07-11 02:56:12', '2020-07-27 22:58:18', NULL, '35439e82-05ce-4334-83fd-73a39d166168', 0, 0),
(75, 'Annette Schmeler V', NULL, 'maci.beahan@example.net', 'V', 0, '2020-07-11 02:56:12', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0W5t6UXwtg', '2020-07-11 02:56:12', '2020-07-27 22:58:18', NULL, '9f27d2e3-172d-495d-be46-9cb589c8f146', 0, 0),
(76, 'Miss Joannie Herman', NULL, 'talia.huel@example.net', 'V', 0, '2020-07-11 02:56:12', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'i7S46cPrZe', '2020-07-11 02:56:12', '2020-07-27 22:58:18', NULL, 'd98f5b2c-b916-433b-ac75-3fbbc5c29560', 0, 0),
(77, 'Winifred Ruecker', NULL, 'cschamberger@example.com', 'V', 0, '2020-07-11 02:56:12', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'o8eV8IoRCV', '2020-07-11 02:56:12', '2020-07-27 22:58:18', NULL, 'b36ec8e7-d545-425c-acf5-bd47fff3e0fe', 0, 0),
(78, 'Sabina Keeling', NULL, 'cartwright.juanita@example.com', 'V', 0, '2020-07-11 02:56:12', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'srQXKmFZrI', '2020-07-11 02:56:12', '2020-07-27 22:58:18', NULL, 'f80efa46-6d13-4a04-8400-66df06902a19', 0, 0),
(79, 'Lilian Grimes', NULL, 'gupton@example.org', 'V', 0, '2020-07-11 02:56:12', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'xWlbKh6x2Z', '2020-07-11 02:56:12', '2020-07-27 22:58:18', NULL, 'f49990b3-b674-4349-a240-a4760742add1', 0, 0),
(80, 'Gwendolyn Sporer', NULL, 'obailey@example.org', 'V', 0, '2020-07-11 02:56:12', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'JTuE2qq9rV', '2020-07-11 02:56:12', '2020-07-27 22:58:18', NULL, 'c5cf36c2-6221-4417-9cdd-9fb88d98cf8f', 0, 0),
(81, 'Miss Vicky Keeling DDS', NULL, 'stehr.elvie@example.net', 'V', 0, '2020-07-11 02:56:12', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'tIhxkyZqsY', '2020-07-11 02:56:12', '2020-07-27 22:58:18', NULL, 'c3fd0793-3c96-4af4-9277-385495fa5aef', 0, 0),
(82, 'Prof. Deondre Quitzon', NULL, 'emely.koch@example.com', 'V', 0, '2020-07-11 02:56:12', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'qb3gIzRHzc', '2020-07-11 02:56:12', '2020-07-27 22:58:18', NULL, '88c5cfc6-ce6c-4661-af9c-231685d78c7c', 0, 0),
(83, 'Keegan Fadel', NULL, 'natalie56@example.net', 'V', 0, '2020-07-11 02:56:12', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'YXQEwBxqBV', '2020-07-11 02:56:12', '2020-07-27 22:58:18', NULL, 'b6149169-cd81-45fa-a1a9-1cc60f49f0e8', 0, 0),
(84, 'Maximus Ziemann', NULL, 'heidenreich.danny@example.net', 'V', 0, '2020-07-11 02:56:12', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'koG4EauMjr', '2020-07-11 02:56:12', '2020-07-27 22:58:18', NULL, 'f4d71835-04bc-4136-b1a1-3c084e6a3b0e', 0, 0),
(85, 'Halie Haley', NULL, 'white.cooper@example.org', 'V', 0, '2020-07-11 02:56:13', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'hc0ElUMBS4', '2020-07-11 02:56:13', '2020-07-27 22:58:18', NULL, 'd4f5c9b4-0f4b-4776-8c8a-b38982fcafa4', 0, 0),
(86, 'Dr. Lacey Stiedemann', NULL, 'daphne85@example.net', 'V', 0, '2020-07-11 02:56:13', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'uOh5dYO0ij', '2020-07-11 02:56:13', '2020-07-27 22:58:18', NULL, '306db7d4-2927-4b25-90e3-15b7711b33d0', 0, 0),
(87, 'Shaina Weber', NULL, 'kamryn65@example.net', 'V', 0, '2020-07-11 02:56:13', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'DfzCJ9KT8S', '2020-07-11 02:56:13', '2020-07-27 22:58:18', NULL, '6bea9fee-857a-41c4-a042-96d61953c83f', 0, 0),
(88, 'Prof. Polly Hodkiewicz II', NULL, 'sauer.paul@example.org', 'V', 0, '2020-07-11 02:56:13', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'D4CgPRPA3y', '2020-07-11 02:56:13', '2020-07-27 22:58:18', NULL, 'abb44ab5-fe6c-4b95-886d-894b67703c32', 0, 0),
(89, 'Landen Wiegand', NULL, 'hbarrows@example.org', 'V', 0, '2020-07-11 02:56:13', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'HxSztQ4sZA', '2020-07-11 02:56:13', '2020-07-27 22:58:18', NULL, '33929a89-ecfb-4ddc-b7eb-73d350b8c36d', 0, 0),
(90, 'Prof. Cedrick Bins I', NULL, 'strosin.sharon@example.com', 'V', 0, '2020-07-11 02:56:13', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'AQkzpHuWmC', '2020-07-11 02:56:13', '2020-07-27 22:58:18', NULL, 'a4e7139c-8232-4998-b9e5-626d61fab31c', 0, 0),
(91, 'Dr. Hester Wolf Sr.', NULL, 'floy.stokes@example.com', 'V', 0, '2020-07-11 02:56:13', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'DSbLDEeIaF', '2020-07-11 02:56:13', '2020-07-27 22:58:18', NULL, '729c5a98-4cfd-4032-8a30-c53fbd303732', 0, 0),
(92, 'Twila Nicolas', NULL, 'qwisoky@example.net', 'V', 0, '2020-07-11 02:56:13', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '7VGjGnQG0K', '2020-07-11 02:56:13', '2020-07-27 22:58:18', NULL, '6f7143f4-0509-44e9-a41f-fc974816cf10', 0, 0),
(93, 'Carissa Satterfield', NULL, 'leila.jones@example.net', 'V', 0, '2020-07-11 02:56:13', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Zs4pE5Mn4O', '2020-07-11 02:56:13', '2020-07-27 22:58:18', NULL, '2a750910-8071-4b50-977f-8a1c37b94850', 0, 0),
(94, 'Dr. Orrin Miller III', NULL, 'lhand@example.net', 'V', 0, '2020-07-11 02:56:13', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'CYQF9nAlqt', '2020-07-11 02:56:13', '2020-07-27 22:58:18', NULL, 'fcf8ee0b-e25c-4490-b652-e7603c2a00bd', 0, 0),
(95, 'Shea Prosacco', NULL, 'roberto14@example.org', 'V', 0, '2020-07-11 02:56:13', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'aydXmTyqmO', '2020-07-11 02:56:13', '2020-07-27 22:58:18', NULL, '2976dc90-4135-4226-a177-875622ba113e', 0, 0),
(96, 'Christa Nienow Jr.', NULL, 'rgusikowski@example.com', 'V', 0, '2020-07-11 02:56:13', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'bKtE0Wad4I', '2020-07-11 02:56:13', '2020-07-27 22:58:18', NULL, '403d1625-6725-44e5-97e8-75e036b483c9', 0, 0),
(97, 'Mario Abbott', NULL, 'renner.barry@example.org', 'V', 0, '2020-07-11 02:56:14', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'rdF3qBXegf', '2020-07-11 02:56:14', '2020-07-27 22:58:19', NULL, '3212a380-2dc3-4c95-ab78-d545940fb695', 0, 0),
(98, 'Julia Toy DDS', NULL, 'moconner@example.org', 'V', 0, '2020-07-11 02:56:14', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'V2cGHbWDIp', '2020-07-11 02:56:14', '2020-07-27 22:58:19', NULL, '587231d2-7551-40d5-b377-989c9fdf19ed', 0, 0),
(99, 'Fredy Reinger', NULL, 'jody09@example.net', 'V', 0, '2020-07-11 02:56:14', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'b6KMY80EoD', '2020-07-11 02:56:14', '2020-07-27 22:58:19', NULL, '809217a1-78a2-4cf5-941a-17d01e653ff3', 0, 0),
(100, 'Hassan Weimann', NULL, 'zackary.langworth@example.com', 'V', 0, '2020-07-11 02:56:14', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'rKEFBkdpia', '2020-07-11 02:56:14', '2020-07-27 22:58:19', NULL, '5cb112b7-9be4-41a4-8561-cdd91b82a906', 0, 0),
(101, 'Bettye Wyman', NULL, 'nprosacco@example.com', 'V', 0, '2020-07-11 02:56:14', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'NLDKPlIaVe', '2020-07-11 02:56:14', '2020-07-27 22:58:19', NULL, '82066b85-947e-4f81-ab10-85d0870be9a1', 0, 0),
(102, 'Lorine Altenwerth Sr.', NULL, 'domenick26@example.com', 'V', 0, '2020-07-11 02:56:14', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'BW8eRkN8kZ', '2020-07-11 02:56:14', '2020-07-27 22:58:19', NULL, '8cf452a8-b8a3-4fef-89d6-061187eb7ebb', 0, 0),
(103, 'Ernest Towne', NULL, 'hackett.silas@example.net', 'V', 0, '2020-07-11 02:56:14', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'hT8VJGSoDC', '2020-07-11 02:56:14', '2020-07-27 22:58:19', NULL, '9bbc2245-0fd0-45b2-ab59-1929ed7bc0ab', 0, 0),
(104, 'Wilbert Buckridge', NULL, 'yoshiko91@example.com', 'V', 0, '2020-07-11 02:56:14', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'J8sJL4NPgB', '2020-07-11 02:56:14', '2020-07-27 22:58:19', NULL, '84971e58-aa62-4e8b-92d2-259d9d2900af', 0, 0),
(105, 'Cade Kirlin I', NULL, 'sbogisich@example.net', 'V', 0, '2020-07-11 02:56:14', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'c9aiu1GN37', '2020-07-11 02:56:14', '2020-07-27 22:58:19', NULL, 'ba6e36d4-fd97-46ba-a2c4-cbfddf5a8fa7', 0, 0),
(106, 'Dr. Theodore Gleason Jr.', NULL, 'ygoyette@example.org', 'V', 0, '2020-07-11 02:56:14', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'cFligs5m0j', '2020-07-11 02:56:14', '2020-07-27 22:58:19', NULL, 'fb18ec70-00ee-4a58-b730-7a5874f70065', 0, 0),
(107, 'Moises Ernser DDS', NULL, 'dillon84@example.net', 'V', 0, '2020-07-11 02:56:14', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'L2iySb1ZmD', '2020-07-11 02:56:14', '2020-07-27 22:58:19', NULL, '2899d3fb-7e82-4842-9e9f-475ef811cbed', 0, 0),
(108, 'Verda Feest', NULL, 'michael.effertz@example.org', 'V', 0, '2020-07-11 02:56:14', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'GusEFHS6CD', '2020-07-11 02:56:14', '2020-07-27 22:58:19', NULL, '665b76bf-6485-4045-8c3d-17017fb1c09e', 0, 0),
(109, 'Chelsey Koch', NULL, 'hallie28@example.net', 'V', 0, '2020-07-11 02:56:14', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '9Tg2Y3XYKt', '2020-07-11 02:56:14', '2020-07-27 22:58:19', NULL, '76d12429-2b1a-459c-95b1-99eeb3d03b78', 0, 0),
(110, 'Magnolia Hamill', NULL, 'kabshire@example.net', 'V', 0, '2020-07-11 02:56:14', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'CSIU7aHgrG', '2020-07-11 02:56:14', '2020-07-27 22:58:19', NULL, '0dc22b5e-7239-4753-8ac2-f386377a9a6e', 0, 0),
(111, 'Prof. Dillan Dach', NULL, 'acassin@example.org', 'V', 0, '2020-07-11 02:56:14', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'nrsCtpnFBG', '2020-07-11 02:56:14', '2020-07-27 22:58:19', NULL, '203a4987-bed3-4fe2-af53-06bf151535cd', 0, 0),
(112, 'Reva Kovacek', NULL, 'alexanne97@example.net', 'V', 0, '2020-07-11 02:56:14', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'yrGzwhFfTr', '2020-07-11 02:56:14', '2020-07-27 22:58:19', NULL, '3f6def22-c442-4ba0-9616-f4ff46752596', 0, 0),
(113, 'Kiera Russel DDS', NULL, 'kacey.hoeger@example.net', 'V', 0, '2020-07-11 02:56:15', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'BOqH2YFrRA', '2020-07-11 02:56:15', '2020-07-27 22:58:19', NULL, '95a82b7e-0d05-4d4b-9be4-0b9a5982993f', 0, 0),
(114, 'Alysha Flatley', NULL, 'wallace86@example.net', 'V', 0, '2020-07-11 02:56:15', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'NWGpJjlqHz', '2020-07-11 02:56:15', '2020-07-27 22:58:19', NULL, '41b933db-0e78-4d97-8636-ea1caad9cef1', 0, 0),
(115, 'Mrs. Athena Tillman', NULL, 'harry.hessel@example.com', 'V', 0, '2020-07-11 02:56:15', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'qxEPf8Y9TF', '2020-07-11 02:56:15', '2020-07-27 22:58:19', NULL, '6b2094b9-42e9-4b9e-b328-805834f2a391', 0, 0),
(116, 'Mrs. Luz Kautzer', NULL, 'sigrid.smitham@example.net', 'V', 0, '2020-07-11 02:56:15', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'T2FD17xanV', '2020-07-11 02:56:15', '2020-07-27 22:58:19', NULL, 'ddcad56a-85cd-4d4a-85b0-a40130076073', 0, 0),
(117, 'Trent Corkery MD', NULL, 'lora30@example.com', 'V', 0, '2020-07-11 02:56:15', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '4UsN0Tc1IT', '2020-07-11 02:56:15', '2020-07-27 22:58:19', NULL, '12346af7-c4c0-4691-9816-d6310cefb40f', 0, 0),
(118, 'Stanford Barton', NULL, 'juanita85@example.com', 'V', 0, '2020-07-11 02:56:15', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'qMHfPouDHW', '2020-07-11 02:56:15', '2020-07-27 22:58:19', NULL, '5820b651-2e66-45a9-b4ad-2f525c90e328', 0, 0),
(119, 'Samanta McKenzie', NULL, 'jbechtelar@example.com', 'V', 0, '2020-07-11 02:56:15', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'df8uMOnCVO', '2020-07-11 02:56:15', '2020-07-27 22:58:19', NULL, '9f1070fd-d362-42b0-9501-dc74f4292022', 0, 0),
(120, 'Miss Danyka Sauer', NULL, 'lleannon@example.org', 'V', 0, '2020-07-11 02:56:15', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2IiuKPx8Iv', '2020-07-11 02:56:15', '2020-07-27 22:58:19', NULL, 'a238fb1d-1a78-433d-860a-a0ec7aaf50bc', 0, 0),
(121, 'Mr. Hardy Brown III', NULL, 'ferry.loma@example.org', 'V', 0, '2020-07-11 02:56:15', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'XYzWHYacEA', '2020-07-11 02:56:15', '2020-07-27 22:58:19', NULL, '3d4a726b-3b10-4a81-8d9c-88421c4a74dd', 0, 0),
(122, 'Dr. Berenice White', NULL, 'tanner79@example.net', 'V', 0, '2020-07-11 02:56:15', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Rr5qSIbxa1', '2020-07-11 02:56:15', '2020-07-27 22:58:19', NULL, 'f09b0228-aa5f-4575-9311-eebc9174d0ef', 0, 0),
(123, 'Jayde Nicolas', NULL, 'wellington.nader@example.org', 'V', 0, '2020-07-11 02:56:15', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ljGdwy5la8', '2020-07-11 02:56:15', '2020-07-27 22:58:19', NULL, 'b3ffd84e-f969-45f4-bf89-93663cf671b3', 0, 0),
(124, 'Keagan Pfeffer', NULL, 'maria.breitenberg@example.net', 'V', 0, '2020-07-11 02:56:15', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2mlnTizZbw', '2020-07-11 02:56:15', '2020-07-27 22:58:19', NULL, 'cdbb71f1-b2fd-4f81-ae2d-f4eacabc655f', 0, 0),
(125, 'Buck Schimmel', NULL, 'fjacobson@example.net', 'V', 0, '2020-07-11 02:56:16', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'jdHWESxc40', '2020-07-11 02:56:16', '2020-07-27 22:58:19', NULL, 'e20b2539-5cc1-437c-8f86-cda9fa2b7932', 0, 0),
(126, 'Carlie Crist DDS', NULL, 'jalen98@example.com', 'V', 0, '2020-07-11 02:56:16', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'UhfZBXWJ71', '2020-07-11 02:56:16', '2020-07-27 22:58:19', NULL, '9108d6d9-3019-4d3e-8ebd-507b97424811', 0, 0),
(127, 'Prof. Stone Ruecker IV', NULL, 'ilene.green@example.org', 'V', 0, '2020-07-11 02:56:16', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'OIoBDaLPH1', '2020-07-11 02:56:16', '2020-07-27 22:58:19', NULL, '87a84ace-f948-4515-b632-9c7b0c9a8bfe', 0, 0),
(128, 'Lilyan Orn', NULL, 'buckridge.cecelia@example.org', 'V', 0, '2020-07-11 02:56:16', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'icFtlV8wYv', '2020-07-11 02:56:16', '2020-07-27 22:58:19', NULL, '88404bd7-c162-471c-a878-379e52246e0e', 0, 0),
(129, 'Kennedi VonRueden', NULL, 'keven53@example.org', 'V', 0, '2020-07-11 02:56:16', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ChatSaJJHv', '2020-07-11 02:56:16', '2020-07-27 22:58:19', NULL, '6763a67b-1d7d-453f-8c46-f546b816c051', 0, 0),
(130, 'Wilton Renner', NULL, 'doyle.cristina@example.com', 'V', 0, '2020-07-11 02:56:16', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'KQslsBJEDO', '2020-07-11 02:56:16', '2020-07-27 22:58:19', NULL, '4eb9e5e3-5941-4ff6-8998-0fef1130001b', 0, 0),
(131, 'Miss Krista Mohr', NULL, 'ffritsch@example.org', 'V', 0, '2020-07-11 02:56:16', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'o5BCm2gteJ', '2020-07-11 02:56:16', '2020-07-27 22:58:19', NULL, 'b2981458-fba2-456e-b4a5-a88173e09c05', 0, 0),
(132, 'Mrs. Desiree Jaskolski', NULL, 'marquardt.ally@example.org', 'V', 0, '2020-07-11 02:56:16', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'XfdqzghdHV', '2020-07-11 02:56:16', '2020-07-27 22:58:19', NULL, '0285da3b-7398-474f-9671-1470723b2e79', 0, 0),
(133, 'Ms. Gerda Dach MD', NULL, 'ohilpert@example.org', 'V', 0, '2020-07-11 02:56:16', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'eSzsQ02VXh', '2020-07-11 02:56:16', '2020-07-27 22:58:19', NULL, '9e7ae19b-0558-4ce5-afaf-7fd0f4d687f2', 0, 0),
(134, 'Mr. Leon Gerlach IV', NULL, 'jewell47@example.net', 'V', 0, '2020-07-11 02:56:16', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'r5xH34KqOl', '2020-07-11 02:56:16', '2020-07-27 22:58:20', NULL, '4760927d-c5ca-4540-ae71-a58c16843b56', 0, 0),
(135, 'Alia Quigley', NULL, 'keichmann@example.net', 'V', 0, '2020-07-11 02:56:16', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'FyIM8PtYHi', '2020-07-11 02:56:16', '2020-07-27 22:58:20', NULL, 'd7b189e9-e6f8-490b-ba2b-c30536830a01', 0, 0),
(136, 'Tiara Rau', NULL, 'pmoore@example.org', 'V', 0, '2020-07-11 02:56:16', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ZXx8w9DYha', '2020-07-11 02:56:16', '2020-07-27 22:58:20', NULL, 'e69389e0-c86d-4c0a-b20c-08d7a33753aa', 0, 0),
(137, 'Florence Hartmann', NULL, 'adalberto32@example.net', 'V', 0, '2020-07-11 02:56:16', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'fUxyv3xbrh', '2020-07-11 02:56:16', '2020-07-27 22:58:20', NULL, '0c5e3a8e-bb1e-4e06-9b0f-775fe80ac4f4', 0, 0),
(138, 'Mr. Sven Hyatt', NULL, 'kailyn.nolan@example.org', 'V', 0, '2020-07-11 02:56:16', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'sCpRiJJGdF', '2020-07-11 02:56:16', '2020-07-27 22:58:20', NULL, '4c96e958-869f-4904-a8cf-28a1bacb812a', 0, 0),
(139, 'Katrine Luettgen', NULL, 'ambrose64@example.com', 'V', 0, '2020-07-11 02:56:16', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'gvhJnX8Xx0', '2020-07-11 02:56:16', '2020-07-27 22:58:20', NULL, '8237a6dd-a991-44bd-b6ff-c2f34ca4d348', 0, 0),
(140, 'Gregorio Considine', NULL, 'larkin.zita@example.com', 'V', 0, '2020-07-11 02:56:16', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'gwRSNqpfNJ', '2020-07-11 02:56:16', '2020-07-27 22:58:20', NULL, 'f4e50f73-7edf-44ff-b1f5-1ad350532d05', 0, 0),
(141, 'Kacie Boyer', NULL, 'declan68@example.net', 'V', 0, '2020-07-11 02:56:16', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'z5TVgR553a', '2020-07-11 02:56:16', '2020-07-27 22:58:20', NULL, '4120c68e-1bbb-4fa4-98a4-cd90f4f47915', 0, 0),
(142, 'Prof. Ena Gutkowski II', NULL, 'ukreiger@example.org', 'V', 0, '2020-07-11 02:56:16', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '8wL6jU68nt', '2020-07-11 02:56:16', '2020-07-27 22:58:20', NULL, '380e47a4-0d40-4d23-af98-106dc151ab1d', 0, 0),
(143, 'Napoleon Fay', NULL, 'xstanton@example.net', 'V', 0, '2020-07-11 02:56:16', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'cEvFvnz5hX', '2020-07-11 02:56:16', '2020-07-27 22:58:20', NULL, '50299054-aa8c-4d8b-9411-d37a00c6e572', 0, 0),
(144, 'Coty Bogan', NULL, 'abdul28@example.net', 'V', 0, '2020-07-11 02:56:16', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Tcizp3c5PA', '2020-07-11 02:56:16', '2020-07-27 22:58:20', NULL, '935d8591-f25e-473f-aac7-c4b9767df96b', 0, 0),
(145, 'Eldridge Will', NULL, 'asawayn@example.net', 'V', 0, '2020-07-11 02:56:16', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '9pciKAnPjX', '2020-07-11 02:56:16', '2020-07-27 22:58:20', NULL, '7ffd950f-e446-4393-b1fc-e35c8973df47', 0, 0),
(146, 'Myah Dare', NULL, 'cfeil@example.net', 'V', 0, '2020-07-11 02:56:16', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'o2WDjvRuGG', '2020-07-11 02:56:16', '2020-07-27 22:58:20', NULL, '6ef08d7c-7bab-4fb7-88f6-50e09d539849', 0, 0),
(147, 'Nolan Morar', NULL, 'nettie.schuster@example.com', 'V', 0, '2020-07-11 02:56:17', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'hJfZUHwlsh', '2020-07-11 02:56:17', '2020-07-27 22:58:20', NULL, '7d4ced30-2a53-4de0-840e-cb22994800f8', 0, 0),
(148, 'Piper Littel', NULL, 'jacobson.harley@example.net', 'V', 0, '2020-07-11 02:56:17', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'A1cUtPOIwo', '2020-07-11 02:56:17', '2020-07-27 22:58:20', NULL, 'f85ea766-f56c-4f59-8e11-c53debb0d5c0', 0, 0),
(149, 'Dr. Gonzalo Leuschke III', NULL, 'morissette.tomasa@example.net', 'V', 0, '2020-07-11 02:56:17', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'MSTEVu04Dz', '2020-07-11 02:56:17', '2020-07-27 22:58:20', NULL, '74c25877-edd3-4f9b-9635-e07988cf5411', 0, 0),
(150, 'Hilda D\'Amore', NULL, 'rowan40@example.net', 'V', 0, '2020-07-11 02:56:17', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '5ojcPZ2pkq', '2020-07-11 02:56:17', '2020-07-27 22:58:20', NULL, '29f9151a-f07f-4f31-b053-c1f1f19e70db', 0, 0),
(151, 'Roslyn Doyle III', NULL, 'zdubuque@example.org', 'V', 0, '2020-07-11 02:56:17', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'HPkfuJKZd5', '2020-07-11 02:56:17', '2020-07-27 22:58:20', NULL, 'ad86f7b9-f4bf-4f1d-9f84-3d7ebc759054', 0, 0),
(152, 'Melany Rogahn III', NULL, 'boyer.chaya@example.net', 'V', 0, '2020-07-11 02:56:17', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'oNBmp31bp1', '2020-07-11 02:56:17', '2020-07-27 22:58:20', NULL, 'a5ac2a0e-0cc6-4c53-a369-0cbdd8ebce69', 0, 0),
(153, 'Dr. Cristopher Feil', NULL, 'schultz.margarette@example.net', 'V', 0, '2020-07-11 02:56:17', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '5RHzvBFlty', '2020-07-11 02:56:17', '2020-07-27 22:58:20', NULL, 'd57f1590-ee84-4e92-928a-ccff7863a41b', 0, 0),
(154, 'Edmond Robel', NULL, 'earlene13@example.org', 'V', 0, '2020-07-11 02:56:17', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'fVGQUPDhEB', '2020-07-11 02:56:17', '2020-07-27 22:58:20', NULL, 'c3b5240a-02d4-4168-b1d1-73cb6022974a', 0, 0),
(155, 'Prof. Nicolas Hackett III', NULL, 'delta.connelly@example.org', 'V', 0, '2020-07-11 02:56:17', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'TVF36mYTdx', '2020-07-11 02:56:17', '2020-07-27 22:58:20', NULL, '988266ff-de7e-4d4f-80ca-14cbaa8dabd3', 0, 0),
(156, 'Brenda Schmidt', NULL, 'metz.angelina@example.org', 'V', 0, '2020-07-11 02:56:17', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'TISLqv39hZ', '2020-07-11 02:56:17', '2020-07-27 22:58:20', NULL, '431fd66d-37e0-4cb0-ad64-d22ff052ffcc', 0, 0),
(157, 'Terrell Roob', NULL, 'ppredovic@example.org', 'V', 0, '2020-07-11 02:56:17', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'xQX0R7A6Fc', '2020-07-11 02:56:17', '2020-07-27 22:58:20', NULL, 'f4942a7a-9795-4bd8-8ae8-99cfebea8c39', 0, 0),
(158, 'Nelle Zulauf', NULL, 'lacey.balistreri@example.org', 'V', 0, '2020-07-11 02:56:17', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1TGIY4k8x6', '2020-07-11 02:56:17', '2020-07-27 22:58:20', NULL, '22dbcef5-5ab9-4356-b064-f3a318efbc5c', 0, 0),
(159, 'Paige Pfeffer', NULL, 'huels.jazlyn@example.com', 'V', 0, '2020-07-11 02:56:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'hbT28LIo8K', '2020-07-11 02:56:31', '2020-07-27 22:58:20', NULL, '021fb068-a47e-4d2e-92cc-891a72dd1684', 0, 0),
(160, 'Tremaine Huel', NULL, 'stanton.elizabeth@example.org', 'V', 0, '2020-07-11 02:56:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'P3rtHh5Fux', '2020-07-11 02:56:31', '2020-07-27 22:58:20', NULL, 'b509824e-bba9-4f67-90fc-5ab8eb9ea9e6', 0, 0),
(161, 'Jefferey Schiller', NULL, 'demarco70@example.org', 'V', 0, '2020-07-11 02:56:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'DciNfYljuG', '2020-07-11 02:56:31', '2020-07-27 22:58:20', NULL, 'd9c66d2a-3927-49f4-88dd-4bce78435b20', 0, 0),
(162, 'Kobe Goodwin', NULL, 'hbogan@example.net', 'V', 0, '2020-07-11 02:56:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'KNGnlURliF', '2020-07-11 02:56:31', '2020-07-27 22:58:20', NULL, '9d97fe02-7f98-4d7c-979b-32a9de2e3d4a', 0, 0),
(163, 'Mr. Clemens Pagac', NULL, 'wfahey@example.com', 'V', 0, '2020-07-11 02:56:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'PZ8zRgvIXJ', '2020-07-11 02:56:31', '2020-07-27 22:58:20', NULL, '82850602-f48b-484c-90c2-ca5021565f76', 0, 0),
(164, 'Clint Towne', NULL, 'terry.amely@example.net', 'V', 0, '2020-07-11 02:56:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'akd2sJrOoJ', '2020-07-11 02:56:31', '2020-07-27 22:58:20', NULL, '0f134248-2b4e-4b21-91ec-7a11fef07530', 0, 0),
(165, 'Prof. Kaleigh Watsica', NULL, 'znolan@example.org', 'V', 0, '2020-07-11 02:56:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'zGBNyMBBAc', '2020-07-11 02:56:31', '2020-07-27 22:58:20', NULL, 'adfcfc2d-c86d-43f0-8244-441acb2dcc90', 0, 0),
(166, 'Niko Kozey', NULL, 'elynch@example.com', 'V', 0, '2020-07-11 02:56:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'dGLSaUXxrZ', '2020-07-11 02:56:31', '2020-07-27 22:58:20', NULL, 'adee6bcf-af1c-4c72-b85c-48f704cba01a', 0, 0),
(167, 'Maci Gulgowski Jr.', NULL, 'ehand@example.net', 'V', 0, '2020-07-11 02:56:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '9I7CAkqIJe', '2020-07-11 02:56:31', '2020-07-27 22:58:20', NULL, '4e77a140-aa49-46ca-8c2a-6eadd11cf173', 0, 0),
(168, 'Dr. Zack Franecki DDS', NULL, 'xframi@example.net', 'V', 0, '2020-07-11 02:56:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'sCUmSWr2pR', '2020-07-11 02:56:31', '2020-07-27 22:58:20', NULL, '2b5010b9-8bc6-4ff0-8a11-bfac7bc5253f', 0, 0),
(169, 'Ruby Brown', NULL, 'erdman.clay@example.com', 'V', 0, '2020-07-11 02:56:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ccb7AQVvPH', '2020-07-11 02:56:31', '2020-07-27 22:58:21', NULL, 'ff7ea01c-03dc-4b92-9b69-bd593edede34', 0, 0),
(170, 'Shaylee Wuckert', NULL, 'iluettgen@example.net', 'V', 0, '2020-07-11 02:56:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'jXOaXsmZ9j', '2020-07-11 02:56:31', '2020-07-27 22:58:21', NULL, 'de34ae3a-ba54-4d58-970c-52de40e8d998', 0, 0),
(171, 'Prof. Kathleen Leuschke', NULL, 'ofeil@example.com', 'V', 0, '2020-07-11 02:56:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'HnajerdbBg', '2020-07-11 02:56:31', '2020-07-27 22:58:21', NULL, 'dd69e71c-d31e-428e-a139-b9816319a837', 0, 0),
(172, 'Mr. Jamie Shanahan', NULL, 'gerlach.jermain@example.com', 'V', 0, '2020-07-11 02:56:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '9wC4b1lx6y', '2020-07-11 02:56:31', '2020-07-27 22:58:21', NULL, '6d2b8ec6-c86c-458a-b122-0dffbe4b1098', 0, 0),
(173, 'Mr. Loyal Jacobs Jr.', NULL, 'stamm.tara@example.com', 'V', 0, '2020-07-11 02:56:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '06r6z83BHv', '2020-07-11 02:56:31', '2020-07-27 22:58:21', NULL, '121abc46-f652-4b6f-8ce3-7e2b6cf00450', 0, 0),
(174, 'Brennon Harris', NULL, 'runolfsson.schuyler@example.com', 'V', 0, '2020-07-11 02:56:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ybB36scU8o', '2020-07-11 02:56:55', '2020-07-27 22:58:21', NULL, '2f27ed98-c7e3-4cc8-83db-a9ad30210a84', 0, 0),
(175, 'Kole Ebert', NULL, 'jkoepp@example.org', 'V', 0, '2020-07-11 02:56:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'oh7h4N1BH9', '2020-07-11 02:56:55', '2020-07-27 22:58:21', NULL, '7501edec-7751-4c78-b52b-196dcd18a3fa', 0, 0),
(176, 'Grant Miller', NULL, 'jerde.mavis@example.org', 'V', 0, '2020-07-11 02:56:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'MbkG01Ce41', '2020-07-11 02:56:55', '2020-07-27 22:58:21', NULL, '65881ac3-2706-48ba-99ae-513832ea97b1', 0, 0),
(177, 'Emil Bashirian', NULL, 'yessenia53@example.net', 'V', 0, '2020-07-11 02:56:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '7GZTkdj5HL', '2020-07-11 02:56:55', '2020-07-27 22:58:21', NULL, 'b7536d2f-0c20-46de-b121-52e07f648c15', 0, 0),
(178, 'Aliya Gaylord', NULL, 'schumm.tony@example.com', 'V', 0, '2020-07-11 02:56:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'wVDY3KlJqc', '2020-07-11 02:56:55', '2020-07-27 22:58:21', NULL, 'e6bdb094-ee9e-43d2-b318-9a2d4ca462d6', 0, 0),
(179, 'Empresa test 01', NULL, 'testtristest@gmx.es', 'E', 0, NULL, '$2y$10$8TiUVEMP7wDC4kb8alkehOFlfuwGMY0rbuufilOEflNWBz7NRt.bq', NULL, '2020-08-07 09:40:24', '2020-08-07 09:40:24', NULL, '76adce9d-7719-46df-ba3e-cd9f57ef85fc', 0, 0),
(180, 'Vendedor', 'Test 01', 'testtristest@tutanota.com', 'V', 0, NULL, '$2y$10$90tKAitx/5ljIXy3gNlFtOi4VE4vHiL2mEsgDOCBUYVRX8x038XmS', NULL, '2020-08-07 09:49:21', '2020-08-07 09:49:21', NULL, '81d11610-2fb6-4759-9425-db2bf25387ae', 0, 0),
(181, 'Nick', 'Cohen', 'ncohen@dev.com', 'V', 0, '2020-08-18 14:29:24', '$2y$10$bjnjeQtPN6f.91d11FbxNeOVLzhlm633FKbpUBUeTKTUqt9lPYDIS', NULL, '2020-08-18 14:29:24', NULL, NULL, '933f2d04-c7bf-4d70-93c8-bbbf7720c7df', 0, 0),
(182, 'Admin', 'Admin', 'admin@ventonic.com', 'V', 1, '2020-08-18 14:29:24', '$2y$10$36dThKflj9rA8ImDKDc7quP1zTi.EHex.a/Jq4ts7u8e3CZdpFmn2', NULL, '2020-08-18 14:29:24', '2020-10-16 10:10:25', '2020-10-16 10:10:25', 'b25e7c0d-6826-43b3-a61e-6c147fcae191', 1, 0),
(183, 'Josué', 'López', 'josu.lop@hotmail.com', 'V', 1, '2020-09-08 10:35:31', '$2y$10$mcjxw3xttAQhiNpOvPN3yusOWv3s1KSMqSzgKJhYLTJFy89Bs43QS', 'Td2ln0LUkRYiAsuszUuCYhoxP7VdJXe870txNZR6sor5ClNRQ4oyJ00DN1Ap', '2020-09-08 10:35:15', '2020-10-15 16:04:51', '2020-10-15 16:04:51', '9011f9e6-b3fa-4e7b-9036-883969fafdf6', 0, 0),
(184, 'Ismael', 'Bastida', 'ismael@alfonsoychristian.com', 'V', 1, '2020-09-08 11:51:00', '$2y$10$elLrK4Nf9ntDrfFdZ/3dV..9YRwUBuNufhYdQ1u7KjEadGp7RP7jy', NULL, '2020-09-08 11:50:42', '2020-09-08 11:51:00', '2020-09-08 11:50:44', 'f79a113d-9a07-4887-bca0-ebabf4ff434e', 0, 0),
(185, 'Everilda', 'Zazo', 'e.zazo@hotmail.com', 'V', 0, '2020-09-08 12:18:33', '$2y$10$fxztZ.ZPRxjyCa60n1j1.OiEOOjTeKpU.tJSsbFXmu5x82KiqG9P.', NULL, '2020-09-08 12:16:32', '2020-09-08 12:41:33', '2020-09-08 12:16:33', '58159e36-bff3-45eb-b037-fb439db20ed1', 0, 0),
(186, 'Josep', 'Lobo', 'sistemaslobo@gmail.com', 'V', 0, '2020-10-05 11:30:17', '$2y$10$BVQNJQuaSbM6Vw68DpqLPud6NfUEQmaYxv7sbSBOTfFW7tOh66.Ka', NULL, '2020-09-09 18:01:25', '2020-10-19 20:36:45', '2020-10-19 20:36:36', '2e5e5e88-68b9-4183-9dbc-1ba4e777dc5a', 0, 0),
(187, 'Vendedor', 'Testtristest 01', 'testtristest@gmail.com', 'V', 1, '2020-10-05 11:30:17', '$2y$10$naPmwuc8g1GUOvGp9b48RerGSi.Lr4A101qmkiuAqMdo5LHGQZky6', NULL, '2020-10-05 11:23:32', '2020-10-16 18:47:05', '2020-10-16 18:47:05', '45d1b4fc-2fe5-48f9-b533-2823000f6c39', 0, 0),
(188, 'Dayron5', 'Armas5', 'vendedor5@ventonic.com', 'V', 0, '2020-10-05 11:00:00', '$2y$10$63G5O0tZCZ8mg2bpPPsmnOvesLTJKFn4rREDota.9oliv5oZnbv..', 'lKiHXCz0XFP6LrYE4eDPUOl87O6TQMKBzHOkJmfbhbaXJWbi13JN29swnX7U', '2020-10-15 08:28:29', '2020-10-15 10:32:06', '2020-10-15 10:31:15', 'cbb7c1b6-79af-4a81-84c8-ca7e00cedd34', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_module_labels`
--

CREATE TABLE `user_module_labels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Id del usario que crea el grupo',
  `module_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Id del módulo al que le crearán las etiquetas',
  `labels` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user_module_labels`
--

INSERT INTO `user_module_labels` (`id`, `user_id`, `module_id`, `labels`, `created_at`, `updated_at`) VALUES
(1, 9, 2, '{\"processes\":[{\"id\":1,\"title\":\"Posibles Clientes\"},{\"id\":2,\"title\":\"Potencial Cliente\"},{\"id\":3,\"title\":\"En Contacto\"},{\"id\":4,\"title\":\"Reuni\\u00f3n \\/ Sesi\\u00f3n\"},{\"id\":5,\"title\":\"En Negociaci\\u00f3n \\/ Seguimiento\"},{\"id\":6,\"title\":\"Venta \\/ Cerrado\"}]}', '2020-06-30 01:59:48', NULL),
(2, 13, 2, '{\"processes\":[{\"id\":1,\"title\":\"Posibles Clientes\"},{\"id\":2,\"title\":\"Potencial Cliente\"},{\"id\":3,\"title\":\"En Contacto\"},{\"id\":4,\"title\":\"Reuni\\u00f3n \\/ Sesi\\u00f3n\"},{\"id\":5,\"title\":\"En Negociaci\\u00f3n \\/ Seguimiento\"},{\"id\":6,\"title\":\"Venta \\/ Cerrado\"}]}', '2020-07-12 16:38:54', NULL),
(3, 8, 2, '{\"processes\":[{\"id\":1,\"title\":\"Posibles Clientes\"},{\"id\":2,\"title\":\"Potencial Cliente\"},{\"id\":3,\"title\":\"En Contacto\"},{\"id\":4,\"title\":\"Reuni\\u00f3n \\/ Sesi\\u00f3n\"},{\"id\":5,\"title\":\"En Negociaci\\u00f3n \\/ Seguimiento\"},{\"id\":6,\"title\":\"Venta \\/ Cerrado\"}]}', '2020-07-13 09:58:08', NULL),
(4, 183, 2, '{\"processes\":[{\"id\":1,\"title\":\"Posibles Clientes\"},{\"id\":2,\"title\":\"Potencial Cliente\"},{\"id\":3,\"title\":\"En Contacto\"},{\"id\":4,\"title\":\"Reuni\\u00f3n \\/ Sesi\\u00f3n\"},{\"id\":5,\"title\":\"En Negociaci\\u00f3n \\/ Seguimiento\"},{\"id\":6,\"title\":\"Venta \\/ Cerrado\"}]}', '2020-09-08 11:00:29', '2020-09-08 11:00:29'),
(5, 185, 2, '{\"processes\":[{\"id\":1,\"title\":\"Posibles Clientes\"},{\"id\":2,\"title\":\"Potencial Cliente\"},{\"id\":3,\"title\":\"En Contacto\"},{\"id\":4,\"title\":\"Reuni\\u00f3n \\/ Sesi\\u00f3n\"},{\"id\":5,\"title\":\"En Negociaci\\u00f3n \\/ Seguimiento\"},{\"id\":6,\"title\":\"Venta \\/ Cerrado\"}]}', '2020-09-08 12:27:06', '2020-09-08 12:27:06'),
(6, 14, 2, '{\"processes\":[{\"id\":1,\"title\":\"Posibles Clientes\"},{\"id\":2,\"title\":\"Potencial Cliente\"},{\"id\":3,\"title\":\"En Contacto\"},{\"id\":4,\"title\":\"Reuni\\u00f3n \\/ Sesi\\u00f3n\"},{\"id\":5,\"title\":\"En Negociaci\\u00f3n \\/ Seguimiento\"},{\"id\":6,\"title\":\"Venta \\/ Cerrado\"}]}', '2020-09-28 10:54:08', '2020-09-28 10:54:08'),
(7, 17, 2, '{\"processes\":[{\"id\":1,\"title\":\"Posibles Clientes\"},{\"id\":2,\"title\":\"Potencial Cliente\"},{\"id\":3,\"title\":\"En Contacto\"},{\"id\":4,\"title\":\"Reuni\\u00f3n \\/ Sesi\\u00f3n\"},{\"id\":5,\"title\":\"En Negociaci\\u00f3n \\/ Seguimiento\"},{\"id\":6,\"title\":\"Venta \\/ Cerrado\"}]}', '2020-09-30 11:01:43', '2020-09-30 11:01:43'),
(8, 18, 2, '{\"processes\":[{\"id\":1,\"title\":\"Posibles Clientes\"},{\"id\":2,\"title\":\"Potencial Cliente\"},{\"id\":3,\"title\":\"En Contacto\"},{\"id\":4,\"title\":\"Reuni\\u00f3n \\/ Sesi\\u00f3n\"},{\"id\":5,\"title\":\"En Negociaci\\u00f3n \\/ Seguimiento\"},{\"id\":6,\"title\":\"Venta \\/ Cerrado\"}]}', '2020-10-02 18:42:49', '2020-10-02 18:42:49'),
(9, 15, 2, '{\"processes\":[{\"id\":1,\"title\":\"Posibles Clientes\"},{\"id\":2,\"title\":\"Potencial Cliente\"},{\"id\":3,\"title\":\"En Contacto\"},{\"id\":4,\"title\":\"Reuni\\u00f3n \\/ Sesi\\u00f3n\"},{\"id\":5,\"title\":\"En Negociaci\\u00f3n \\/ Seguimiento\"},{\"id\":6,\"title\":\"Venta \\/ Cerrado\"}]}', '2020-10-05 09:34:34', '2020-10-05 09:34:34'),
(10, 187, 2, '{\"processes\":[{\"id\":1,\"title\":\"Posibles Clientes\"},{\"id\":2,\"title\":\"Potencial Cliente\"},{\"id\":3,\"title\":\"En Contacto\"},{\"id\":4,\"title\":\"Reuni\\u00f3n \\/ Sesi\\u00f3n\"},{\"id\":5,\"title\":\"En Negociaci\\u00f3n \\/ Seguimiento\"},{\"id\":6,\"title\":\"Venta \\/ Cerrado\"}]}', '2020-10-05 17:38:14', '2020-10-05 17:38:14'),
(11, 182, 2, '{\"processes\":[{\"id\":1,\"title\":\"Posibles Clientes\"},{\"id\":2,\"title\":\"Potencial Cliente\"},{\"id\":3,\"title\":\"En Contacto\"},{\"id\":4,\"title\":\"Reuni\\u00f3n \\/ Sesi\\u00f3n\"},{\"id\":5,\"title\":\"En Negociaci\\u00f3n \\/ Seguimiento\"},{\"id\":6,\"title\":\"Venta \\/ Cerrado\"}]}', '2020-10-06 14:05:13', '2020-10-06 14:05:13'),
(12, 16, 2, '{\"processes\":[{\"id\":1,\"title\":\"Posibles Clientes\"},{\"id\":2,\"title\":\"Potencial Cliente\"},{\"id\":3,\"title\":\"En Contacto\"},{\"id\":4,\"title\":\"Reuni\\u00f3n \\/ Sesi\\u00f3n\"},{\"id\":5,\"title\":\"En Negociaci\\u00f3n \\/ Seguimiento\"},{\"id\":6,\"title\":\"Venta \\/ Cerrado\"}]}', '2020-10-14 06:45:18', '2020-10-14 06:45:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `websockets_statistics_entries`
--

CREATE TABLE `websockets_statistics_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peak_connection_count` int(11) NOT NULL,
  `websocket_message_count` int(11) NOT NULL,
  `api_message_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `widget`
--

CREATE TABLE `widget` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id_referred` int(11) DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `script` longtext COLLATE utf8mb4_unicode_ci,
  `parameters` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `widget`
--

INSERT INTO `widget` (`id`, `app_id`, `user_id`, `name`, `user_id_referred`, `url`, `token`, `script`, `parameters`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 9, 'Widget Vendedor Uno', 8, 'www.aaa.es', '95891baf-be5b-491c-9a58-ba6436f3605e', NULL, NULL, 1, '2020-08-04 10:06:06', '2020-08-04 10:06:06'),
(4, 1, 9, 'Vendedor Uno', 8, 'www.ventonic.com/minishop', '875bf7a5-b861-420c-bd38-dd39dc78a46c', NULL, NULL, 1, '2020-08-28 19:34:10', '2020-08-28 19:34:10'),
(5, 1, 9, 'Botas - Vendedor Tres', 18, 'www.ventonic.com/minishop', '0ac367b2-d5b0-46ee-a77c-a12fe6489eb7', NULL, NULL, 1, '2020-09-20 10:49:24', '2020-09-20 10:49:24'),
(7, 1, 9, 'Botas - Vended. 3', 18, 'www.ventonic.com/minishop2', '9024bae5-1894-452e-93d5-4d2b500e7009', NULL, NULL, 1, '2020-09-20 11:55:32', '2020-09-20 11:55:32'),
(8, 1, 15, 'Widget Empresa Cuatro', 17, 'www.WidgetEmpresaCuatro.com', '1ba2c4ca-7231-4c38-b992-9b4690196edd', NULL, NULL, 1, '2020-10-05 09:41:57', '2020-10-05 09:41:57'),
(9, 1, 15, 'Widget Empresa Cuatro 02', 17, 'www.WidgetEmpresaCuatro02.com', '71fa219e-0833-48f3-8a00-c7055d2cc654', NULL, NULL, 1, '2020-10-05 09:45:41', '2020-10-05 09:45:41'),
(10, 1, 15, 'Widget Empresa Cuatro 03', 17, 'www.WidgetEmpresaCuatro03.com', '37ed474d-6716-4a8c-8f39-2ee94cec36c0', NULL, NULL, 1, '2020-10-05 10:13:51', '2020-10-05 10:13:51'),
(11, 1, 15, 'Widget Empresa Cuatro 04', 187, 'www.WidgetEmpresaCuatro04.com', '3d9e392b-90fe-4bf7-8ed0-7413bcabceef', NULL, NULL, 0, '2020-10-08 10:21:35', '2020-10-08 10:32:45'),
(12, 1, 15, 'Widget 19-10', 17, 'www.19diez.com', '7f4b522b-4277-403f-9f38-1e4cf2581745', NULL, NULL, 1, '2020-10-19 14:50:52', '2020-10-19 14:50:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `widget_data`
--

CREATE TABLE `widget_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `widget_id` int(10) UNSIGNED NOT NULL,
  `origin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info_data` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `widget_data`
--

INSERT INTO `widget_data` (`id`, `widget_id`, `origin`, `info_data`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'http://localhost', '{\"phone\":\"2742212552\"}', 1, '2020-08-19 02:21:43', '2020-08-19 02:21:43'),
(2, 1, 'http://localhost', '{\"phone\":\"964590229\"}', 1, '2020-08-19 18:40:49', '2020-08-19 18:40:49'),
(7, 1, 'https://ventonic.com', '{\"phone\":\"964590229\"}', 1, '2020-08-28 18:13:09', '2020-08-28 18:13:09'),
(8, 1, 'https://ventonic.com', '{\"phone\":\"964590229\"}', 1, '2020-08-28 18:13:21', '2020-08-28 18:13:21'),
(9, 1, 'http://localhost', '{\"phone\":\"666666666\"}', 1, '2020-08-28 18:18:39', '2020-08-28 18:18:39'),
(10, 1, 'http://localhost', '{\"phone\":\"666666666\"}', 1, '2020-08-28 18:25:03', '2020-08-28 18:25:03'),
(11, 1, 'http://localhost', '{\"phone\":\"666666666\"}', 1, '2020-08-28 18:26:54', '2020-08-28 18:26:54'),
(12, 1, 'https://ventonic.com', '{\"phone\":\"964590229\"}', 1, '2020-08-28 18:27:50', '2020-08-28 18:27:50'),
(14, 4, 'http://localhost', '{\"phone\":\"964590229\"}', 1, '2020-08-28 19:34:42', '2020-08-28 19:34:42'),
(15, 4, 'http://localhost', '{\"phone\":\"964590229\"}', 1, '2020-08-28 19:42:30', '2020-08-28 19:42:30');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aplicants`
--
ALTER TABLE `aplicants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aplicants_user_id_foreign` (`user_id`),
  ADD KEY `aplicants_oportunity_id_foreign` (`oportunity_id`),
  ADD KEY `aplicants_status_postulations_id_foreign` (`status_postulations_id`);

--
-- Indices de la tabla `apps`
--
ALTER TABLE `apps`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `aptitudes`
--
ALTER TABLE `aptitudes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD UNIQUE KEY `cache_key_unique` (`key`);

--
-- Indices de la tabla `calendar_settings`
--
ALTER TABLE `calendar_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `calendar_settings_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `call_events`
--
ALTER TABLE `call_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `call_events_contact_id_foreign` (`contact_id`),
  ADD KEY `call_events_call_result_id_foreign` (`call_result_id`),
  ADD KEY `call_events_calleventable_type_calleventable_id_index` (`calleventable_type`,`calleventable_id`),
  ADD KEY `call_events_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `call_results`
--
ALTER TABLE `call_results`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `chat_rooms`
--
ALTER TABLE `chat_rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_rooms_origenable_type_origenable_id_index` (`origenable_type`,`origenable_id`);

--
-- Indices de la tabla `chat_room_user`
--
ALTER TABLE `chat_room_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_room_user_chat_room_id_foreign` (`chat_room_id`),
  ADD KEY `chat_room_user_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `company_answered_surveys`
--
ALTER TABLE `company_answered_surveys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_answered_surveys_question_id_foreign` (`question_id`),
  ADD KEY `company_answered_surveys_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `company_profiles`
--
ALTER TABLE `company_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_profiles_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_country_id_foreign` (`country_id`),
  ADD KEY `contacts_user_id_foreign` (`user_id`),
  ADD KEY `contacts_contact_type_id_foreign` (`contact_type_id`),
  ADD KEY `contacts_change_image_user_id_foreign` (`change_image_user_id`);

--
-- Indices de la tabla `contact_group`
--
ALTER TABLE `contact_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_group_contact_id_foreign` (`contact_id`),
  ADD KEY `contact_group_group_id_foreign` (`group_id`);

--
-- Indices de la tabla `contact_group_user`
--
ALTER TABLE `contact_group_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_group_user_contact_id_foreign` (`contact_id`),
  ADD KEY `contact_group_user_group_user_id_foreign` (`group_user_id`);

--
-- Indices de la tabla `contact_types`
--
ALTER TABLE `contact_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_documentable_type_documentable_id_index` (`documentable_type`,`documentable_id`),
  ADD KEY `documents_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emails_from_user_id_foreign` (`from_user_id`),
  ADD KEY `emails_to_user_id_foreign` (`to_user_id`),
  ADD KEY `emails_emailable_type_emailable_id_index` (`emailable_type`,`emailable_id`);

--
-- Indices de la tabla `email_messages`
--
ALTER TABLE `email_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_messages_email_setting_id_foreign` (`email_setting_id`);

--
-- Indices de la tabla `email_settings`
--
ALTER TABLE `email_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_settings_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_user_id_foreign` (`user_id`),
  ADD KEY `events_eventable_type_eventable_id_index` (`eventable_type`,`eventable_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `google_calendars`
--
ALTER TABLE `google_calendars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `google_calendars_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groups_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `group_negotiation`
--
ALTER TABLE `group_negotiation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_negotiation_group_id_foreign` (`group_id`),
  ADD KEY `group_negotiation_negotiation_id_foreign` (`negotiation_id`);

--
-- Indices de la tabla `group_user`
--
ALTER TABLE `group_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_user_group_id_foreign` (`group_id`),
  ADD KEY `group_user_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invitations_group_id_foreign` (`group_id`),
  ADD KEY `invitations_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `job_functions`
--
ALTER TABLE `job_functions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `job_types`
--
ALTER TABLE `job_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_user_id_foreign` (`user_id`),
  ADD KEY `messages_chat_room_id_foreign` (`chat_room_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `module_labels`
--
ALTER TABLE `module_labels`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `negotiations`
--
ALTER TABLE `negotiations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `negotiations_user_id_foreign` (`user_id`),
  ADD KEY `negotiations_contact_id_foreign` (`contact_id`),
  ADD KEY `negotiations_neg_type_id_foreign` (`neg_type_id`),
  ADD KEY `negotiations_neg_status_id_foreign` (`neg_status_id`);

--
-- Indices de la tabla `negotiation_process`
--
ALTER TABLE `negotiation_process`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `negotiation_process_history`
--
ALTER TABLE `negotiation_process_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `negotiation_process_history_negotiation_process_id_foreign` (`negotiation_process_id`),
  ADD KEY `negotiation_process_history_negotiation_id_foreign` (`negotiation_id`);

--
-- Indices de la tabla `negotiation_statuses`
--
ALTER TABLE `negotiation_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `negotiation_statuses_history`
--
ALTER TABLE `negotiation_statuses_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `negotiation_statuses_history_negotiation_status_id_foreign` (`negotiation_status_id`),
  ADD KEY `negotiation_statuses_history_negotiation_id_foreign` (`negotiation_id`);

--
-- Indices de la tabla `negotiation_types`
--
ALTER TABLE `negotiation_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `negotiation_user`
--
ALTER TABLE `negotiation_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `negotiation_user_negotiation_id_foreign` (`negotiation_id`),
  ADD KEY `negotiation_user_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notes_noteable_type_noteable_id_index` (`noteable_type`,`noteable_id`),
  ADD KEY `notes_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indices de la tabla `oportunitys`
--
ALTER TABLE `oportunitys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oportunitys_user_id_foreign` (`user_id`),
  ADD KEY `oportunitys_job_type_id_foreign` (`job_type_id`),
  ADD KEY `oportunitys_ubication_oportunity_id_foreign` (`ubication_oportunity_id`),
  ADD KEY `oportunitys_status_id_foreign` (`status_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `profesions`
--
ALTER TABLE `profesions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profesions_sector_id_foreign` (`sector_id`);

--
-- Indices de la tabla `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sector_oportunitys`
--
ALTER TABLE `sector_oportunitys`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seller_answered_surveys`
--
ALTER TABLE `seller_answered_surveys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_answered_surveys_question_id_foreign` (`question_id`),
  ADD KEY `seller_answered_surveys_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `seller_profiles`
--
ALTER TABLE `seller_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_profiles_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indices de la tabla `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `skills_profesion_id_foreign` (`profesion_id`);

--
-- Indices de la tabla `status_oportunitys`
--
ALTER TABLE `status_oportunitys`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `status_postulations`
--
ALTER TABLE `status_postulations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_task_queue_id_foreign` (`task_queue_id`),
  ADD KEY `tasks_task_priority_id_foreign` (`task_priority_id`),
  ADD KEY `tasks_task_type_id_foreign` (`task_type_id`),
  ADD KEY `tasks_contact_id_foreign` (`contact_id`),
  ADD KEY `tasks_taskable_type_taskable_id_index` (`taskable_type`,`taskable_id`),
  ADD KEY `tasks_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `task_priorities`
--
ALTER TABLE `task_priorities`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `task_queues`
--
ALTER TABLE `task_queues`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `task_types`
--
ALTER TABLE `task_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `time_zone_oportunitys`
--
ALTER TABLE `time_zone_oportunitys`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `todos_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `type_oportunitys`
--
ALTER TABLE `type_oportunitys`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ubication_oportunitys`
--
ALTER TABLE `ubication_oportunitys`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `user_module_labels`
--
ALTER TABLE `user_module_labels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_module_labels_user_id_foreign` (`user_id`),
  ADD KEY `user_module_labels_module_id_foreign` (`module_id`);

--
-- Indices de la tabla `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `widget`
--
ALTER TABLE `widget`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `widget_user_id_user_id_referred_url_unique` (`user_id`,`user_id_referred`,`url`),
  ADD KEY `widget_app_id_foreign` (`app_id`);

--
-- Indices de la tabla `widget_data`
--
ALTER TABLE `widget_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `widget_data_widget_id_foreign` (`widget_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aplicants`
--
ALTER TABLE `aplicants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `apps`
--
ALTER TABLE `apps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `aptitudes`
--
ALTER TABLE `aptitudes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `calendar_settings`
--
ALTER TABLE `calendar_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `call_events`
--
ALTER TABLE `call_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `call_results`
--
ALTER TABLE `call_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `chat_rooms`
--
ALTER TABLE `chat_rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `chat_room_user`
--
ALTER TABLE `chat_room_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `company_answered_surveys`
--
ALTER TABLE `company_answered_surveys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `company_profiles`
--
ALTER TABLE `company_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT de la tabla `contact_group`
--
ALTER TABLE `contact_group`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contact_group_user`
--
ALTER TABLE `contact_group_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contact_types`
--
ALTER TABLE `contact_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT de la tabla `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `emails`
--
ALTER TABLE `emails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `email_messages`
--
ALTER TABLE `email_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `email_settings`
--
ALTER TABLE `email_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1527;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `google_calendars`
--
ALTER TABLE `google_calendars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `group_negotiation`
--
ALTER TABLE `group_negotiation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `group_user`
--
ALTER TABLE `group_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `invitations`
--
ALTER TABLE `invitations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `job_functions`
--
ALTER TABLE `job_functions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `job_types`
--
ALTER TABLE `job_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT de la tabla `module_labels`
--
ALTER TABLE `module_labels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `negotiations`
--
ALTER TABLE `negotiations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT de la tabla `negotiation_process`
--
ALTER TABLE `negotiation_process`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `negotiation_process_history`
--
ALTER TABLE `negotiation_process_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT de la tabla `negotiation_statuses`
--
ALTER TABLE `negotiation_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `negotiation_statuses_history`
--
ALTER TABLE `negotiation_statuses_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT de la tabla `negotiation_types`
--
ALTER TABLE `negotiation_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `negotiation_user`
--
ALTER TABLE `negotiation_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `oportunitys`
--
ALTER TABLE `oportunitys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `profesions`
--
ALTER TABLE `profesions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `sector_oportunitys`
--
ALTER TABLE `sector_oportunitys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT de la tabla `seller_answered_surveys`
--
ALTER TABLE `seller_answered_surveys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT de la tabla `seller_profiles`
--
ALTER TABLE `seller_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `status_oportunitys`
--
ALTER TABLE `status_oportunitys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `status_postulations`
--
ALTER TABLE `status_postulations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `task_priorities`
--
ALTER TABLE `task_priorities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `task_queues`
--
ALTER TABLE `task_queues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `task_types`
--
ALTER TABLE `task_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `time_zone_oportunitys`
--
ALTER TABLE `time_zone_oportunitys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `todos`
--
ALTER TABLE `todos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `type_oportunitys`
--
ALTER TABLE `type_oportunitys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ubication_oportunitys`
--
ALTER TABLE `ubication_oportunitys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT de la tabla `user_module_labels`
--
ALTER TABLE `user_module_labels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `widget`
--
ALTER TABLE `widget`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `widget_data`
--
ALTER TABLE `widget_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aplicants`
--
ALTER TABLE `aplicants`
  ADD CONSTRAINT `aplicants_oportunity_id_foreign` FOREIGN KEY (`oportunity_id`) REFERENCES `oportunitys` (`id`),
  ADD CONSTRAINT `aplicants_status_postulations_id_foreign` FOREIGN KEY (`status_postulations_id`) REFERENCES `status_postulations` (`id`),
  ADD CONSTRAINT `aplicants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `calendar_settings`
--
ALTER TABLE `calendar_settings`
  ADD CONSTRAINT `calendar_settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `call_events`
--
ALTER TABLE `call_events`
  ADD CONSTRAINT `call_events_call_result_id_foreign` FOREIGN KEY (`call_result_id`) REFERENCES `call_results` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `call_events_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `call_events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `chat_room_user`
--
ALTER TABLE `chat_room_user`
  ADD CONSTRAINT `chat_room_user_chat_room_id_foreign` FOREIGN KEY (`chat_room_id`) REFERENCES `chat_rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_room_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `company_answered_surveys`
--
ALTER TABLE `company_answered_surveys`
  ADD CONSTRAINT `company_answered_surveys_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `company_answered_surveys_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `company_profiles`
--
ALTER TABLE `company_profiles`
  ADD CONSTRAINT `company_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_change_image_user_id_foreign` FOREIGN KEY (`change_image_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `contacts_contact_type_id_foreign` FOREIGN KEY (`contact_type_id`) REFERENCES `contact_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contacts_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `contacts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `contact_group`
--
ALTER TABLE `contact_group`
  ADD CONSTRAINT `contact_group_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `contact_group_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `contact_group_user`
--
ALTER TABLE `contact_group_user`
  ADD CONSTRAINT `contact_group_user_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `contact_group_user_group_user_id_foreign` FOREIGN KEY (`group_user_id`) REFERENCES `group_user` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `emails`
--
ALTER TABLE `emails`
  ADD CONSTRAINT `emails_from_user_id_foreign` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `emails_to_user_id_foreign` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `email_messages`
--
ALTER TABLE `email_messages`
  ADD CONSTRAINT `email_messages_email_setting_id_foreign` FOREIGN KEY (`email_setting_id`) REFERENCES `email_settings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `email_settings`
--
ALTER TABLE `email_settings`
  ADD CONSTRAINT `email_settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `google_calendars`
--
ALTER TABLE `google_calendars`
  ADD CONSTRAINT `google_calendars_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `group_negotiation`
--
ALTER TABLE `group_negotiation`
  ADD CONSTRAINT `group_negotiation_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_negotiation_negotiation_id_foreign` FOREIGN KEY (`negotiation_id`) REFERENCES `negotiations` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `group_user`
--
ALTER TABLE `group_user`
  ADD CONSTRAINT `group_user_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `group_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `invitations`
--
ALTER TABLE `invitations`
  ADD CONSTRAINT `invitations_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invitations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_chat_room_id_foreign` FOREIGN KEY (`chat_room_id`) REFERENCES `chat_rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `negotiations`
--
ALTER TABLE `negotiations`
  ADD CONSTRAINT `negotiations_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `negotiations_neg_status_id_foreign` FOREIGN KEY (`neg_status_id`) REFERENCES `negotiation_statuses` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `negotiations_neg_type_id_foreign` FOREIGN KEY (`neg_type_id`) REFERENCES `negotiation_types` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `negotiations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `negotiation_process_history`
--
ALTER TABLE `negotiation_process_history`
  ADD CONSTRAINT `negotiation_process_history_negotiation_id_foreign` FOREIGN KEY (`negotiation_id`) REFERENCES `negotiations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `negotiation_process_history_negotiation_process_id_foreign` FOREIGN KEY (`negotiation_process_id`) REFERENCES `negotiation_process` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `negotiation_statuses_history`
--
ALTER TABLE `negotiation_statuses_history`
  ADD CONSTRAINT `negotiation_statuses_history_negotiation_id_foreign` FOREIGN KEY (`negotiation_id`) REFERENCES `negotiations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `negotiation_statuses_history_negotiation_status_id_foreign` FOREIGN KEY (`negotiation_status_id`) REFERENCES `negotiation_statuses` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `negotiation_user`
--
ALTER TABLE `negotiation_user`
  ADD CONSTRAINT `negotiation_user_negotiation_id_foreign` FOREIGN KEY (`negotiation_id`) REFERENCES `negotiations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `negotiation_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `oportunitys`
--
ALTER TABLE `oportunitys`
  ADD CONSTRAINT `oportunitys_job_type_id_foreign` FOREIGN KEY (`job_type_id`) REFERENCES `job_types` (`id`),
  ADD CONSTRAINT `oportunitys_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status_oportunitys` (`id`),
  ADD CONSTRAINT `oportunitys_ubication_oportunity_id_foreign` FOREIGN KEY (`ubication_oportunity_id`) REFERENCES `ubication_oportunitys` (`id`),
  ADD CONSTRAINT `oportunitys_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `profesions`
--
ALTER TABLE `profesions`
  ADD CONSTRAINT `profesions_sector_id_foreign` FOREIGN KEY (`sector_id`) REFERENCES `sector_oportunitys` (`id`);

--
-- Filtros para la tabla `seller_answered_surveys`
--
ALTER TABLE `seller_answered_surveys`
  ADD CONSTRAINT `seller_answered_surveys_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `seller_answered_surveys_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `seller_profiles`
--
ALTER TABLE `seller_profiles`
  ADD CONSTRAINT `seller_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `skills_profesion_id_foreign` FOREIGN KEY (`profesion_id`) REFERENCES `profesions` (`id`);

--
-- Filtros para la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_task_priority_id_foreign` FOREIGN KEY (`task_priority_id`) REFERENCES `task_priorities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_task_queue_id_foreign` FOREIGN KEY (`task_queue_id`) REFERENCES `task_queues` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_task_type_id_foreign` FOREIGN KEY (`task_type_id`) REFERENCES `task_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `todos`
--
ALTER TABLE `todos`
  ADD CONSTRAINT `todos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `user_module_labels`
--
ALTER TABLE `user_module_labels`
  ADD CONSTRAINT `user_module_labels_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `module_labels` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_module_labels_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `widget`
--
ALTER TABLE `widget`
  ADD CONSTRAINT `widget_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`),
  ADD CONSTRAINT `widget_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `widget_data`
--
ALTER TABLE `widget_data`
  ADD CONSTRAINT `widget_data_widget_id_foreign` FOREIGN KEY (`widget_id`) REFERENCES `widget` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
