-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 29-05-2020 a las 11:11:08
-- Versión del servidor: 10.3.22-MariaDB-cll-lve
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hojbdyav_transferdavid`
--
CREATE DATABASE IF NOT EXISTS `hojbdyav_transferdavid` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hojbdyav_transferdavid`;

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `leagues`
--

CREATE TABLE `leagues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `leagues`
--

INSERT INTO `leagues` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Primera División Española 2018/2019', NULL, NULL),
(2, 'Primera División Española 2017/2018', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matches`
--

CREATE TABLE `matches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_team_local` bigint(20) UNSIGNED NOT NULL,
  `id_team_visitor` bigint(20) UNSIGNED NOT NULL,
  `id_league` bigint(20) UNSIGNED NOT NULL,
  `journey` int(11) NOT NULL,
  `score_local` int(11) NOT NULL,
  `score_visitor` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `matches`
--

INSERT INTO `matches` (`id`, `id_team_local`, `id_team_visitor`, `id_league`, `journey`, `score_local`, `score_visitor`, `created_at`, `updated_at`) VALUES
(10, 1, 2, 1, 1, 7, 3, '2020-05-12 19:08:13', '2020-05-15 08:35:17'),
(23, 8, 2, 1, 2, 1, 1, '2020-05-14 09:15:07', '2020-05-14 09:15:07'),
(30, 1, 3, 1, 3, 3, 2, '2020-05-14 09:40:10', '2020-05-15 08:38:17'),
(31, 6, 7, 1, 5, 3, 3, '2020-05-14 09:41:39', '2020-05-14 09:41:39'),
(32, 6, 1, 1, 2, 3, 4, '2020-05-14 09:57:07', '2020-05-15 08:32:35'),
(33, 2, 8, 1, 3, 1, 3, '2020-05-14 10:00:19', '2020-05-14 10:00:19'),
(34, 1, 7, 1, 6, 1, 1, '2020-05-14 10:01:20', '2020-05-15 08:34:14'),
(35, 1, 3, 2, 1, 2, 3, '2020-05-14 12:34:02', '2020-05-14 12:34:40'),
(36, 7, 3, 1, 8, 2, 5, '2020-05-14 12:39:24', '2020-05-14 12:39:24'),
(38, 1, 3, 1, 5, 3, 4, '2020-05-15 09:41:39', '2020-05-15 09:41:39'),
(40, 8, 2, 1, 4, 1, 4, '2020-05-16 07:00:24', '2020-05-16 07:00:24'),
(41, 8, 2, 1, 12, 2, 7, '2020-05-16 07:01:58', '2020-05-16 07:01:58'),
(42, 6, 7, 1, 12, 2, 5, '2020-05-20 08:18:27', '2020-05-20 08:18:27'),
(43, 2, 1, 2, 2, 6, 6, '2020-05-21 11:58:26', '2020-05-21 11:58:26'),
(44, 8, 1, 2, 5, 2, 1, '2020-05-21 12:00:36', '2020-05-21 12:00:36'),
(45, 6, 7, 1, 3, 1, 2, '2020-05-23 07:09:24', '2020-05-23 07:09:24'),
(47, 1, 3, 1, 14, 2, 2, '2020-05-26 08:40:28', '2020-05-26 08:40:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2020_03_31_104849_create_team_table', 1),
(6, '2020_03_31_104913_create_player_table', 1),
(7, '2020_03_31_104938_create_league_table', 1),
(114, '2014_10_12_000000_create_users_table', 2),
(115, '2014_10_12_100000_create_password_resets_table', 2),
(116, '2019_08_19_000000_create_failed_jobs_table', 2),
(117, '2020_03_31_103405_create_notice_table', 2),
(118, '2020_03_31_112332_create_league_table', 2),
(119, '2020_03_31_113022_create_teams_table', 2),
(120, '2020_03_31_113056_create_players_table', 2),
(121, '2020_04_16_102910_create_participate_table', 2),
(122, '2020_04_16_104141_create_match_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notices`
--

CREATE TABLE `notices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(3000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `notices`
--

INSERT INTO `notices` (`id`, `id_user`, `title`, `subtitle`, `description`, `image`, `created_at`, `updated_at`) VALUES
(10, 1, 'Entrevista a Monchi en Sevilla', 'Reconoce que \"no\" es buen negociador y ofrece el resultado de las segundas opciones', 'Monchi, director general deportivo del Sevilla, está mostrando su cara más personal (en lo que al trabajo se refiere) en las masterclass impulsada por el club andaluz en las que desgrana su trabajo al frente de la Dirección deportiva. Incluso reconociendo que tiene un talón de Aquiles en cuanto a la contratación de jugadores, que es el momento de sentarse a negociar: \"No soy un buen negociador. Me falta un poco de frialdad, soy una persona muy sensible\". \"Aunque en 20 años de negociación algo he aprendido\", apostilla.\r\n\r\nY en esas dos décadas como director deportivo, el de San Fernando extrae algunos consejos que quiso compartir. El más importante es el de jamás acudir a firmar a un jugador sin otra alternativa. \"Si no puedes firmar a un jugador, pasas al siguiente de la lista. ¡Para eso hemos elaborado una lista de candidatos!\", afirma. \"No ir nunca a negociar entre la espada y la pared. Ir siempre con opciones porque pagas un sobreprecio al estar desesperado\", añadía.', 'storage/images/Xbq84qgIHsYwqXr7tDsuNIIO18vk5zco0g6pn97X.jpeg', '2020-05-12 07:45:25', '2020-05-12 07:45:25'),
(11, 1, 'El Valladolid aísla a dos jugadores', 'Los análisis no dejaron positivos en el test de PCR, pero sí en el serológico', 'Ronaldo Nazario, presidente del Real Valladolid, le contó este pasado viernes en una charla en Instagram a Alessandro Del Piero que los resultados de las pruebas de COVID-19 en el club blanquivioleta no habían dejando ningún positivo, por lo cual se sacó la conclusión de que este lunes todos los jugadores comenzarían el plan de trabajo preparado por el club y con oportuno cumplimiento del protocolo del CSD y LaLiga. No ha sido así y tres miembros de la entidad no han acudido al José Zorrilla.\r\n\r\nLas pruebas, realizadas en el caso del Real Valladolid el pasado miércoles, y que han sido exhaustivas en todos los clubes de LaLiga, no revelaron en efecto ningún positivo en el test de PCR, pero sí en el test serológico, según ha contado Radio MARCA Valladolid. Se trata de dos jugadores de la primera plantilla y un auxiliar que trabaja habitualmente a diario con el primer equipo. Su caso sería similar al de Álex Remiro, portero de la Real Sociedad, al de Yangel Herrera, centrocampista venezolano del Granada o al de varios jugadores del Atlético de Madrid. No así al de Lodi o Joel Robles, que sí dieron positivo en la prueba PCR.\r\n\r\nUno de esos futbolistas es Óscar Plano, que hizo pública esta situación a través de sus redes sociales. \"Hola a todos. Lo primero comentar que tanto mi familia como yo nos encontramos bien. En los resultados de las pruebas Covid-19, a pesar de dar negativo en el PCR, el test serológico indica que tengo restos de anticuerpos, por lo que por protocolo y precaución seguiré trabajando desde casa ¡Muchas gracias por vuestro apoyo y cariño y en nada estaré de vuelta!\"', 'storage/images/ngKMH7oeFVVf24xjsaQHprUZCiahSAf8VFkKDpdR.jpeg', '2020-05-12 07:47:54', '2020-05-12 07:47:54'),
(12, 1, 'Iñaki Williams y su ilusión por volver', 'Los leones repiten plan y no descansarán ya hasta el domingo', 'Iñaki Williams entrenó el domingo con inquietud. El plan de transición hacia la normalidad en los entrenamientos deja a los futbolistas en una situación especial. Durante los próximos días apenas coincidirán en Lezama. Verá de lejos a un grupo reducido de compañeros y con muchos tardará días en cruzarse. El ritmo de trabajo de la plantilla moverá los turnos de entrenamiento para que los leones, al menos, puedan verse las caras. \"Estoy con muchas ganas, hace mucha ilusión volver sentirte futbolista después de tantos días de ver a los compañeros, aunque no se les pueda dar un abrazo. Se agradece y espero que pronto podamos volver a entrenar de la mejor manera posible con normalidad\",explicó en El Partidazo de Movistar.\r\n\r\nEl delantero tiene cita de nuevo este lunes en Lezama con un plan de trabajo que será similar al de la víspera. Todas las rutinas están atadas desde la víspera: gimnasio, activación en el interior y trabajo de campo con los técnicos (Garitano y Ferreira) antes de pasar a las órdenes del preparador físico. \"La verdad es que el balón parecía cuadrado, en vez de redondo. Pierdes el tacto después de tanto tiempo sin tocar un balón, ha costado pero ha sido un bonito reencuentro\", señaló.\r\n\r\nEl rojiblanco espera con ganas el retorno de Liga porque este parón sanitario es casi tan largo como unas vacaciones. El 8 de mayo se cumplieron dos meses desde que el Athletic jugó su último partido ganando 1-4 al Valladolid, con Williams entre los goleadores. El bilbaíno confía en tener un buen regreso al campeonato y seguir estirando la racha de partidos consecutivos en Liga, que ya es de 146. La última vez que el Athletic disputó un partido de Liga sin minutos para Williams fue el 17 de abril de 2016.', 'storage/images/AJ03GWq7oT4TUPE9OyOVEX3AE1k0CrtWctpBzvdA.jpeg', '2020-05-12 07:51:01', '2020-05-12 07:51:01'),
(15, 1, 'Dos meses de Anfield: la locura del Atlético', 'Aquel día los rojiblancos soñaban con ganar todo tras apenar al campeón', 'Parece un mundo desde que aquel 11 de marzo el Atlético volviera a ser el Atlético de Simeone. Llegó a Anfield con el 1-0 de la ida y la incertidumbre de saber si podría resistir el acoso de los de Klopp, el vigente campeón de Europa y una máquina de hacer fútbol ofensivo. Más si cabe al calor de una hinchada que vive el mejor momento del club en décadas. El Atlético aguantó al ritmo que marcaron las paradas, hasta ocho, de Oblak, para llegar a una prórroga que forma parte de la leyenda del club. Los ingleses se pusieron 2-0, pero un doblete de Marcos Llorente y una diana de Morata dieron la vuelta al resultado. El Atlético estaba en cuartos de final y se desataba la locura.\r\n\r\nLos 3.000 hinchas rojiblancos que viajaron a la ciudad de The Beatles no eran conscientes de lo que les iba a pasar al regreso del sueño. La fiesta de The Cavern fue historia a la llegada a Madrid, ciudad que unos días después iba a declarar el estado de alarma. Los jugadores del Atlético no iban a ser ajenos a lo que se venía encima hasta el punto que lo último que hicieron con sus compañeros fue celebrar el histórico triunfo de Anfield. Se acabaron los entrenamientos y adiós al fútbol, las botas, el vestuario hasta que el pasado sábado 9 de mayo volvieron al trabajo de una forma totalmente diferente a la última vez que se vieron las caras en el Cerro.\r\n\r\nEl proceso de desescalada ha llevado a un día a día en el que los jugadores ven como se les toma la temperatura cuando llegan a entrenar. Apenas seis por campo y sin ningún tipo de contacto entre ellos, ni siquiera con los líderes del cuerpo técnico, Simeone y El Profe Ortega. Un balón para cada uno y sillas para cambiarse.Cualquier parecido con lo que había antes del 11 de marzo es pura coincidencia. No es el único cambio sufrido en un equipo que quiere volver a competir y ganarse sobre el césped una de las cuatro primeras plazas de LaLiga. Un puesto para la próxima Champions, en definitiva. Un billete a poder mantener la estabilidad económica pero también el pulso deportivo como gran objetivo si la competición se puede reanudar después de las semanas que esperan de desescalada.\r\n\r\nPorque aquella ilusión desbordada por meterse entre los ocho primeros, por estar a apenas cuatro partidos de una nueva final de Champions, ha virado en incertidumbre. En si se podrá jugar ese torneo que tantos sueños y desvelos ha provocado, en si el fútbol que viene (sin público, sin pasión, sin celebraciones) será igual que el que vivieron.', 'storage/images/Ltnh29uEXfSsHM1XiN5VAMz4gM6NPbruurGBzg5i.jpeg', '2020-05-12 08:09:04', '2020-05-12 08:09:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participates`
--

CREATE TABLE `participates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_league` bigint(20) UNSIGNED NOT NULL,
  `id_team` bigint(20) UNSIGNED NOT NULL,
  `pj` int(11) NOT NULL,
  `v` int(11) NOT NULL,
  `e` int(11) NOT NULL,
  `d` int(11) NOT NULL,
  `gf` int(11) NOT NULL,
  `gc` int(11) NOT NULL,
  `dg` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `participates`
--

INSERT INTO `participates` (`id`, `id_league`, `id_team`, `pj`, `v`, `e`, `d`, `gf`, `gc`, `dg`, `points`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 5, 6, -11, 10, 18, 9, 9, 7, NULL, '2020-05-26 08:40:28'),
(2, 2, 1, 3, 1, 0, 2, 9, 10, -1, 3, NULL, '2020-05-21 12:00:36'),
(3, 1, 2, 2, 11, -11, 2, 14, 5, 9, 22, NULL, '2020-05-16 07:01:58'),
(4, 2, 2, 1, 0, 1, 0, 6, 6, 0, 1, NULL, '2020-05-21 11:58:26'),
(5, 1, 6, 3, 2, -2, 3, 4, 11, -7, 4, '2020-05-15 08:01:55', '2020-05-25 14:29:34'),
(6, 1, 3, 2, 0, 0, 2, 4, 4, 0, 0, '2020-05-15 08:09:21', '2020-05-26 08:40:28'),
(7, 1, 7, 2, 2, 0, 0, 6, 2, 4, 6, '2020-05-15 08:34:14', '2020-05-23 07:09:24'),
(8, 1, 8, 2, 0, 0, 2, 3, 11, -8, 0, '2020-05-16 06:58:31', '2020-05-16 07:24:03'),
(9, 2, 8, 1, 1, 0, 0, 2, 1, 1, 3, '2020-05-21 12:00:36', '2020-05-21 12:00:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `players`
--

CREATE TABLE `players` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_team` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` int(11) NOT NULL,
  `player_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `players`
--

INSERT INTO `players` (`id`, `id_team`, `name`, `last_name`, `position`, `value`, `player_image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Karim', 'Benzema', 'Delantero', 32000000, 'storage/images/LVt0zih0DcinAI4FvNlxnNnUoZRUuZV4olaHmJAE.png', '2020-05-05 08:17:49', '2020-05-12 09:10:23'),
(3, 1, 'Thibaut', 'Courtois', 'Portero', 48000000, 'storage/images/BrOQBXiwRBsRFmYQwBV0njhN85JQbCSStZqRoKae.png', '2020-05-05 08:18:38', '2020-05-11 10:18:08'),
(4, 2, 'Marc-André', 'ter Stegen', 'Portero', 72000000, 'storage/images/a2MQrcKLyoQgNH5cMzwjMYIVAlRAkPzlA4crvcNs.png', '2020-05-05 08:21:08', '2020-05-05 08:21:08'),
(5, 3, 'Joaquín', 'Sánchez', 'Centrocampista', 1600000, 'storage/images/eMPa1ucEi00INZesr1p3aSZ6IJwLxKBCNY6gjWZt.png', '2020-05-05 08:24:41', '2020-05-06 08:53:53'),
(6, 3, 'Joel', 'Robles', 'Portero', 6000000, 'storage/images/TyaCcVObJjjCQ11KSFsoqKp6lkjGQM1f2eCJoyqH.png', '2020-05-05 08:25:55', '2020-05-05 08:25:55'),
(7, 2, 'Lionel', 'Messi', 'Delantero', 112000000, 'storage/images/y31QfAJdfaIb4VyXpJIng5gnhCeDC1sJenBpqfUn.png', '2020-05-05 09:01:27', '2020-05-05 09:01:27'),
(11, 1, 'Daniel', 'Carvajal', 'Defensa', 40000000, 'storage/images/fS6wt6RgTdydDPFxWNPWCG4mqZwQt7vvlfFVlm95.png', '2020-05-12 09:09:19', '2020-05-12 09:09:19'),
(12, 1, 'Raphaël', 'Varane', 'Defensa', 64000000, 'storage/images/SPezG1t9azqEKsqm66Eqd3JX8tbwDFPEprZwJO19.png', '2020-05-12 09:14:30', '2020-05-12 09:22:45'),
(13, 1, 'Ferland', 'Mendy', 'Defensa', 32000000, 'storage/images/X0nX6Hhec4xpz0PuwktmlewvfRlkjpD7rfNaj8Yf.png', '2020-05-12 09:15:43', '2020-05-12 09:15:43'),
(14, 1, 'Sergio', 'Ramos', 'Defensa', 14500000, 'storage/images/o1m0Q5ciYhtz1QLH4lGRygIpykOdLD1zz0Hir11A.png', '2020-05-12 09:24:13', '2020-05-12 09:24:13'),
(15, 1, 'Carlos Enrique', 'Casemiro', 'Centrocampista', 64000000, 'storage/images/8d0dPZCA50Ex08IHFAb2mp5Hebn9JQwI8MRwswsq.png', '2020-05-12 09:28:54', '2020-05-12 09:28:54'),
(16, 1, 'Luka', 'Modric', 'Centrocampista', 12000000, 'storage/images/g4Nsq1xOKL1XIhMs1hoA2KGFae72kxhgrvra4HWe.png', '2020-05-12 09:30:07', '2020-05-12 09:30:07'),
(17, 1, 'Toni', 'Kroos', 'Centrocampista', 48000000, 'storage/images/DtCsU4vjqp3N2rl53Nsee6v59mx0lY6HgPOIfGa0.png', '2020-05-12 09:31:05', '2020-05-12 09:31:05'),
(18, 1, 'Fede', 'Valverde', 'Centrocampista', 54000000, 'storage/images/5EOZiZ9qT6v4kvqbXZhCwT5R2ZFRgWifI6FfaOSF.png', '2020-05-12 09:31:57', '2020-05-12 09:31:57'),
(19, 1, 'Vinicius', 'Junior', 'Delantero', 45000000, 'storage/images/k8TJx2Qagguej4T98DOkNiL6g7yn05LhhyUfZKKz.png', '2020-05-12 09:33:18', '2020-05-12 09:33:18'),
(20, 6, 'Unai', 'Simón', 'Portero', 16000000, 'storage/images/3l5FeSJMEgQBOnBkO5UfmDwfdvrzn0oPJdFu3HVU.png', '2020-05-12 09:35:33', '2020-05-12 09:35:33'),
(21, 6, 'Ander', 'Capa', 'Defensa', 6000000, 'storage/images/3QVwNod86gGSIAnMz1dv4pLQJUSXJyyKrinrLscV.png', '2020-05-12 09:37:22', '2020-05-12 09:37:22'),
(22, 6, 'Íñigo', 'Córdoba', 'Centrocampista', 3200000, 'storage/images/RsXjcInerthrvUnKq9vUzjP1mFBMB240NFFe8hbF.png', '2020-05-12 09:38:32', '2020-05-12 09:38:32'),
(23, 6, 'Dani', 'Garcia', 'Centrocampista', 4800000, 'storage/images/xr3coyzQPgsdOA3dLihw02JR1o2AwznppJYov5jT.png', '2020-05-12 09:39:18', '2020-05-12 09:39:18'),
(24, 6, 'Íñigo', 'Martínez', 'Defensa', 25500000, 'storage/images/VojUMNreZmZHlI1ZUgYN3ScAn7MXagsjMhq8thwc.png', '2020-05-12 09:40:13', '2020-05-12 09:40:13'),
(25, 6, 'Iker', 'Muniaín', 'Centrocampista', 14000000, 'storage/images/jcT7yjwXZuI0N6KYrT5vJH5hsKFquaXYvsuZ7VJx.png', '2020-05-12 09:41:09', '2020-05-12 09:41:09'),
(26, 6, 'Raúl', 'García', 'Centrocampista', 6000000, 'storage/images/zZjFpYaUKPnaBExQQlM2k8qGvWZxBX3c1qdGDIV8.png', '2020-05-12 09:41:55', '2020-05-12 09:41:55'),
(27, 6, 'Unai', 'López', 'Centrocampista', 2400000, 'storage/images/Y3yFAvw18HwWOpoB0argmv9ehV55C41oPIYYZbmO.png', '2020-05-12 09:43:08', '2020-05-12 09:43:08'),
(28, 6, 'Iñaki', 'Williams', 'Delantero', 40000000, 'storage/images/mp9rsLmJu20x3eX9t4nA58LENLmXjUofOgOnkjv1.png', '2020-05-12 09:43:43', '2020-05-12 09:43:43'),
(29, 6, 'Yeray', 'Álvarez', 'Defensa', 24000000, 'storage/images/g6ZD6IBDYPgtHwdI8wHTvwO62RSYHYiRqS8Zk7Es.png', '2020-05-12 09:44:22', '2020-05-12 09:44:22'),
(30, 6, 'Yuri', 'Berchiche', 'Defensa', 16000000, 'storage/images/7mkBtV7ACuTf6S3kcDuv6bIMyqwVoUZejVmSxBUD.png', '2020-05-12 09:45:23', '2020-05-12 09:45:23'),
(31, 2, 'Arthur', 'Enrique', 'Centrocampista', 56000000, 'storage/images/AyEZprMeisH3mVAQr3F0xhdXEVduc321kGelwvml.png', '2020-05-12 09:48:00', '2020-05-12 09:48:00'),
(32, 2, 'Sergio', 'Busquets', 'Centrocampista', 28000000, 'storage/images/nq9y864ecDUghZfSgLx2aYPoxxJHjYBEJJmeEBtO.png', '2020-05-12 09:48:34', '2020-05-12 09:48:34'),
(33, 2, 'Frenkie', 'De Jong', 'Centrocampista', 72000000, 'storage/images/gAoQrehamyo2ywhfd7ZDDDWZyPAtkLRJ5rwuVAJi.png', '2020-05-12 09:49:10', '2020-05-12 09:49:10'),
(34, 2, 'Antoine', 'Griezmann', 'Delantero', 96000000, 'storage/images/jSr1X6JmsqwfrB0Wm8g3gFSVtVU93qDpRqWjGKFb.png', '2020-05-12 09:49:57', '2020-05-12 09:49:57'),
(35, 2, 'Clément', 'Lenglet', 'Defensa', 48000000, 'storage/images/Z7uMnZ3axKiTLYKOB8r24OLB1YOdJMvFMKxijyyA.png', '2020-05-12 09:50:46', '2020-05-12 09:50:46'),
(36, 2, 'Gerard', 'Piqué', 'Defensa', 20000000, 'storage/images/kqnjkSjA0aUqZOGNxSdn8Tj4vXsA50FDliAHPMYQ.png', '2020-05-12 09:51:20', '2020-05-12 09:51:20'),
(37, 2, 'Sergi', 'Roberto', 'Defensa', 40000000, 'storage/images/LzNXrz8h9OhZ8zrMrf55QnGizQ144f6B6RMgvCiD.png', '2020-05-12 09:52:01', '2020-05-12 09:52:01'),
(38, 2, 'Luis', 'Suárez', 'Delantero', 28000000, 'storage/images/cXRBmUgCr1Xy64ONfZ20xAtCgkITvkmPtMdb2IXn.png', '2020-05-12 09:52:43', '2020-05-12 09:52:43'),
(39, 2, 'Arturo', 'Vidal', 'Centrocampista', 11000000, 'storage/images/5Oqy1D3j00veh5RHvYzKTXvLPTP0kZ5JGI2nvsG5.png', '2020-05-12 09:53:24', '2020-05-12 09:53:24'),
(40, 3, 'Álex', 'Moreno', 'Defensa', 5500000, 'storage/images/gX4R2GkOVLxF268OteN0siLcpJSugxDTEfSSQorp.png', '2020-05-12 09:56:14', '2020-05-12 09:56:14'),
(41, 3, 'Marc', 'Bartra', 'Defensa', 17500000, 'storage/images/AFgRwVbWg5lyYqmk0ehrLMorheKqkxZqqmOiIz8b.png', '2020-05-12 09:58:17', '2020-05-12 09:58:17'),
(42, 3, 'Borja', 'Iglesias', 'Delantero', 14500000, 'storage/images/DqcSe0SaLh5WTHl5jx8mcOcsc8VJVJ5aB1dtCVAU.png', '2020-05-12 09:59:08', '2020-05-12 09:59:08'),
(43, 3, 'Sergio', 'Canales', 'Centrocampista', 20000000, 'storage/images/O0T5y6SzgpWbfmwlWFZ0s0G1xt6b0wKFN8qOXz6K.png', '2020-05-12 09:59:45', '2020-05-12 09:59:45'),
(44, 3, 'Emerson', 'Junior', 'Defensa', 18000000, 'storage/images/sKemOpjnFQKyEGGxhzg0jKc2Arr0A8buNUKKYYWA.png', '2020-05-12 10:00:52', '2020-05-12 10:00:52'),
(45, 3, 'Nabil', 'Fekir', 'Delantero', 32000000, 'storage/images/maUwFbdDtGZjso8uthiGAPtGvEqE69l9t0gaRKVE.png', '2020-05-12 10:01:34', '2020-05-12 10:01:34'),
(46, 3, 'Andrés', 'Guardado', 'Centrocampista', 3200000, 'storage/images/kfPEbr8eT8b1bLAD9T0VtReOnkDwSiNOyTLb6dqn.png', '2020-05-12 10:02:13', '2020-05-12 10:02:13'),
(47, 3, 'Loren', 'Morón', 'Delantero', 16000000, 'storage/images/PrW9ScBpSSaa2SWgbPQAl7xRvP7nFtVsG1xpcOsY.png', '2020-05-12 10:03:32', '2020-05-12 10:03:32'),
(48, 3, 'Aïssa', 'Mandi', 'Defensa', 16000000, 'storage/images/UXcHYAYvc5KA8XqzgOjPPmRCO8J72gDLVd8t1Fxa.png', '2020-05-12 10:04:18', '2020-05-12 10:04:18'),
(49, 7, 'Ángel', 'Correa', 'Delantero', 32000000, 'storage/images/cOLe8cW4pSCijLhixq0sgO5CEst6aX15QV93cQhp.png', '2020-05-12 10:05:59', '2020-05-12 10:05:59'),
(50, 7, 'Felipe Augusto', 'Monteiro', 'Defensa', 25500000, 'storage/images/aXP2u7950Iw7xRPNPGAccgZyAETZS0RShOFP5Gt1.png', '2020-05-12 10:06:58', '2020-05-12 10:06:58'),
(51, 7, 'João', 'Félix', 'Delantero', 81000000, 'storage/images/GYP30wSUXU931QDz7hLUpoFDzW2DmjzgQQ728024.png', '2020-05-12 10:07:50', '2020-05-12 10:07:50'),
(52, 7, 'Koke', 'Resurrección', 'Centrocampista', 48000000, 'storage/images/Iy0UsSNRoVMHhAET0gwntztNSbBwmilhwuzdBSpL.png', '2020-05-12 10:08:44', '2020-05-12 10:08:44'),
(53, 7, 'Renan', 'Lodi', 'Defensa', 31500000, 'storage/images/rEygp3Rz2II0G8FOTMKRaC6Afpkf5dCHpPIJU7Z1.png', '2020-05-12 10:09:39', '2020-05-12 10:09:39'),
(54, 7, 'Álvaro', 'Morata', 'Delantero', 36000000, 'storage/images/3I7aP4ubHmrnl2hEZxRGXIuvWSiqb0TZhmGGKIbz.png', '2020-05-12 10:10:25', '2020-05-12 10:10:25'),
(55, 7, 'Jan', 'Oblak', 'Portero', 80000000, 'storage/images/BgZSuxVQFQUHxLslDgLkxEOAlBpaouMv4F0KDmex.png', '2020-05-12 10:10:54', '2020-05-12 10:10:54'),
(56, 7, 'Saúl', 'Ñíguez', 'Centrocampista', 72000000, 'storage/images/SnazYz4P67q8726IbiQIlC4GkwIzgifiaWxKSCFo.png', '2020-05-12 10:11:33', '2020-05-12 10:11:33'),
(57, 7, 'Thomas', 'Partey', 'Centrocampista', 40000000, 'storage/images/eQaoE2835q6ilwSu7iP7yvAeEgZOmcC0nClFbDgz.png', '2020-05-12 10:12:33', '2020-05-12 10:12:33'),
(58, 7, 'Kieran', 'Trippier', 'Defensa', 28000000, 'storage/images/NitiPvJtajQQ8z7BmGyoMlOWFpIYdCz5gVS6OaXO.png', '2020-05-12 10:13:13', '2020-05-12 10:13:13'),
(59, 7, 'Vitolo', 'Machín', 'Centrocampista', 14500000, 'storage/images/9O2fAwkEPsjnigsKRz96cMWEMftzOa60bEu1KqQL.png', '2020-05-12 10:14:09', '2020-05-12 10:14:09'),
(60, 8, 'Oliver', 'Burke', 'Centrocampista', 4800000, 'storage/images/CWNZGTjYit96ZZ1IITaWE0IOjjO5AbLgUEyDlnKz.png', '2020-05-12 10:15:35', '2020-05-12 10:15:35'),
(61, 8, 'Joselu', 'Sanmartín', 'Delantero', 6000000, 'storage/images/rsmQlQ9xSam1ZMkLQdlWb6QJqJ79qKBDwGPgKVmf.png', '2020-05-12 10:16:35', '2020-05-12 10:16:35'),
(62, 8, 'Víctor', 'Laguardia', 'Defensa', 7000000, 'storage/images/Hst8AveVj9DPhjwX9FfHUcGAI74nJt1PGCLsIF9u.png', '2020-05-12 10:17:15', '2020-05-12 10:17:15'),
(63, 8, 'Lucas', 'Pérez', 'Delantero', 12000000, 'storage/images/D9S13NVVYpeWVpQt5wqM66Qm0bSlLX4qv95rY8W5.png', '2020-05-12 10:17:45', '2020-05-12 10:17:45'),
(64, 8, 'Martín', 'Aguirregabiria', 'Defensa', 4800000, 'storage/images/oRqBIdhUZhC6AlI1qoaH6zQjsavrTS9RLto5B5GD.png', '2020-05-12 10:19:22', '2020-05-12 10:19:22'),
(65, 8, 'Fernando', 'Pacheco', 'Portero', 14500000, 'storage/images/cRTpImTTwtGdc7cs2qTk0kXlUtMcg3J90PN4lk9A.png', '2020-05-12 10:19:56', '2020-05-12 10:19:56'),
(66, 8, 'Rodrigo', 'Ely', 'Defensa', 1600000, 'storage/images/yjJNORbRmInrz8fy12TPvF8qL0GeNn58eCrWNHCa.png', '2020-05-12 10:21:08', '2020-05-12 10:21:08'),
(67, 8, 'Rubén', 'Duarte', 'Defensa', 4800000, 'storage/images/OsfdNeQsGCW0Chf6eJ3PWW2gj5kFqYKmjXRdDho5.png', '2020-05-12 10:21:59', '2020-05-12 10:21:59'),
(68, 8, 'Tomás', 'Pina', 'Centrocampista', 2000000, 'storage/images/v05WkiLGhccrqdlzR0LxhIPyK25uEFww4YVysTvT.png', '2020-05-12 10:22:39', '2020-05-12 10:22:39'),
(69, 8, 'Aleix', 'Vidal', 'Centrocampista', 3500000, 'storage/images/x8Bzw9aqI3rxc5pNleWmpNaGLEhyWMWYAM2a1FsW.png', '2020-05-12 10:24:00', '2020-05-12 10:24:00'),
(70, 8, 'Ximo', 'Navarro', 'Defensa', 2000000, 'storage/images/wCB1WW2Fu0YFNsKRHnNLBrI3xiVWqyCxPRdByOj9.png', '2020-05-12 10:24:29', '2020-05-12 10:24:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fundation` int(11) NOT NULL,
  `stadium` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coach` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `review` varchar(2500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `web` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wallpaper` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `teams`
--

INSERT INTO `teams` (`id`, `name`, `image`, `fundation`, `stadium`, `coach`, `nationality`, `review`, `web`, `wallpaper`, `created_at`, `updated_at`) VALUES
(1, 'Real Madrid C.F', 'storage/images/dla5JzslIeT4hoo9OR44TcBw7h0XGtIhLdemSjP1.png', 1902, 'Santiago Bernabéu', 'Zinedine Zidane', 'España', 'El Real Madrid Club de Fútbol, más conocido simplemente como Real Madrid, es una entidad polideportiva con sede en Madrid, España. Fue declarada oficialmente registrada como club de fútbol por sus socios el 6 de marzo de 1902 con el objeto de la práctica y desarrollo de este deporte —si bien sus orígenes datan al año 1900,​ y su denominación de (Sociedad) Madrid Foot-ball Club a noviembre de 1901— siendo el quinto club fundado en la capital. Tuvo a Julián Palacios y los hermanos Juan Padrós y Carlos Padrós como principales valedores de su creación.\r\n\r\nIdentificado por su color blanco —del que recibe el apelativo de «blancos» o «merengues»—,​ es uno de los cuatro clubes profesionales de fútbol del país cuya entidad jurídica no es la de sociedad anónima deportiva (S. A. D.),​ ya que su propiedad recae en sus más de 100 000 socios. Otra salvedad comparte con el Athletic Club y el Fútbol Club Barcelona al participar sin interrupción en la máxima categoría de la Liga Nacional de Fútbol Profesional, la Primera División de España, desde su establecimiento en 1929.​ En ella posee los honores de haber sido el primer líder histórico de la competición,​ el de club con más títulos, y el de la máxima puntuación en una sola edición.', 'https://www.realmadrid.com/', 'storage/images/eaoH2nhVQ1TPkCXSa6A6F5NIlMQRTJkohHzITIM5.jpeg', '2020-05-05 08:06:18', '2020-05-12 09:06:30'),
(2, 'F.C Barcelona', 'storage/images/Qv4tLbJqhg6HsGIaYWQXfPmZIWFmUx2AKf4wb1Fd.png', 1899, 'Camp Nou', 'Quique Setién', 'España', 'holaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaaholaa', 'https://www.fcbarcelona.es/es/', 'storage/images/jSLk6ajtQaQKcPhSS6COpVUgmuQieogCy5rshHhh.jpeg', '2020-05-05 08:06:51', '2020-05-12 08:20:14'),
(3, 'Real Betis', 'storage/images/DydEMo8bI72OPLxCN3E4Dp5H36DgaeNFnV6F4xcy.png', 1900, 'Benito Villamarín', 'Joan Rubí', 'España', 'El Real Betis Balompié, también conocido como Real Betis o simplemente Betis, es una entidad polideportiva con sede en Sevilla, España. Fue fundada en septiembre de 1908 para la práctica del fútbol —aunque sus orígenes datan de 1907 y así consta como fecha fundacional por el propio club—, y oficialmente registrada el 1 de febrero de 1909.​ Desde sus orígenes sus principales cánticos son \"Viva er Betis\" y \" Viva er Betis manque pierda\".\r\n\r\nSu forma jurídica es la de sociedad anónima deportiva, y actualmente disputa la Primera División de España, la máxima competición a nivel de clubes de fútbol en España. En ella, su mayor registro es el de haberse proclamado vencedor en una ocasión de esta, que se suma a los dos títulos de Copa del Rey siendo uno de los únicos nueve equipos del país que han conseguido proclamarse vencedores de ambos torneos. Además destacan entre sus actuaciones en el campeonato de liga las producidas en las temporadas 1996-97 y 1934-35 donde consiguió realizar las mejores temporadas de un equipo andaluz en cuanto a registros estadísticos.', 'https://www.realbetisbalompie.es/', 'storage/images/2UjlD9Ky3hRTkZRAJ59EnJFDSpdR1wVmvHA7Po2r.jpeg', '2020-05-05 08:07:21', '2020-05-12 09:04:42'),
(6, 'Athletic Club de Bilbao', 'storage/images/FmBq11sij6GqkrHGJiS6WoRTERTbWjyOBt0GjqDU.png', 1898, 'San Mamés', 'Gaizka Garitano', 'España', 'El Athletic Club, popularmente conocido también como Athletic de Bilbao​ o simplemente Athletic, es un club de fútbol de la villa de Bilbao, País Vasco, España.\r\n \r\nFue fundado en 1898 y es, junto al Real Madrid Club de Fútbol y al Fútbol Club Barcelona, el único club que ha disputado todas las ediciones de la Primera División de España desde su creación en 1928. A su vez, es uno de los cuatro únicos clubes profesionales de España que no es una sociedad anónima deportiva, de manera que el gobierno del club recae en sus socios.\r\n\r\nLa particularidad más destacada del club vasco es su tradición de jugar únicamente con jugadores nacidos o formados futbolísticamente en Euskal Herria, tradición que surgió en 1912 y se ha mantenido desde entonces. También es reconocido históricamente por ser un club de cantera y trabajar en la formación de jóvenes futbolistas, siendo esta la principal fuente de abastecimiento de jugadores para el primer equipo.', 'https://www.athletic-club.eus/', 'storage/images/kQCVJteD0Nzl3c1Roej224sMIqmkuA8dfQ6jcvn0.jpeg', '2020-05-12 08:30:36', '2020-05-12 08:30:36'),
(7, 'Atlético de Madrid', 'storage/images/F2dWulTwet922CB1iwySmCT0GagT4xDst2IxELtl.png', 1903, 'Wanda Metropolitano', 'Diego Simeone', 'España', 'El Club Atlético de Madrid es un club de fútbol (antiguo club polideportivo) español de la ciudad de Madrid, fundado el 26 de abril de 1903. Compite actualmente en la Primera División de España y disputa sus partidos como local desde la temporada 2017/18, en el Estadio Metropolitano, con capacidad de 69.829 espectadores.\r\n\r\nEs uno de los clubes de fútbol españoles más laureados, superando la treintena entre títulos nacionales e internacionales. Su primer equipo masculino ha disputado 83 temporadas en el Campeonato Nacional de Liga de Primera División, siendo uno de los diez clubes participantes en la edición inaugural de 1929. Con diez títulos, es el tercer club más laureado de la competición y ocupa la tercera plaza histórica del campeonato. En la competición nacional de Copa (Copa del Rey desde 1977), ha logrado otros diez títulos, siendo finalista en nueve ediciones más. Además de los veinte títulos nacionales entre Liga y Copa, el club ha ganado dos títulos de Supercopa de España, junto con otros tres títulos predecesores de esta competición.​ A nivel continental, es uno de los ocho equipos europeos más laureados:​ ha disputado catorce ediciones de Copa de Europa/Liga de Campeones, alcanzando tres subcampeonatos, nueve de Recopa de Europa, logrando un título y dos subcampeonatos y veinticuatro de Copa UEFA/Liga Europa, logrando tres títulos. Además, se ha proclamado tricampeón de la Supercopa de Europa y campeón en 1974 de la Copa Intercontinental, siendo por ello uno de los clubes reconocidos por la FIFA como campeones del mundo.', 'https://www.atleticodemadrid.com/', 'storage/images/iKng9NPXWH4A2ijOnsz6yaT8QhlVFVf5oUZ7L8Ep.jpeg', '2020-05-12 08:39:46', '2020-05-14 09:43:09'),
(8, 'Alavés', 'storage/images/Bl6mpkkvNQ01PLvsAFDdZfRHAzOh3EFR5w7jjkiZ.png', 1921, 'Mendizorroza', 'Asier Garitano', 'España', 'El Deportivo Alavés, más conocido simplemente como Alavés, es un club de fútbol con sede en la ciudad de Vitoria, España. Fundado el 23 de enero de 1921 como Sport Friend\'s Club, participa, desde la temporada 2016-17, en la máxima categoría del fútbol español, la Primera División de España. Desde el 7 de febrero de 2010 ocupa el 26º puesto en su clasificación histórica.\r\n\r\nSu mayor logro deportivo tuvo lugar en el año 2001, cuando, en su debut en competición europea, fue subcampeón de la Copa de la UEFA —actual Liga Europa— tras perder frente al Liverpool Football Club por un gol de oro en la prórroga para un 5-4 final. Merced a dicha actuación se encuentra entre los veintiocho equipos españoles en haber disputado una competición internacional. En cuanto a títulos, ha logrado cinco campeonatos de liga en divisiones inferiores nacionales como mejores distinciones.', 'https://www.deportivoalaves.com/', 'storage/images/cortmuo15mR55cm4lGcbWzpEaZAOpsvPalxSCqi6.jpeg', '2020-05-12 08:42:35', '2020-05-14 09:43:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fav_team` int(11) NOT NULL,
  `user_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `last_name2`, `email`, `email_verified_at`, `password`, `fav_team`, `user_description`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'David', 'Cuevas', 'Herrero', 'd290397@hotmail.es', NULL, '$2y$10$TIK0ZJm76popCGnK6wZGKePSguKDhXFZDgHAqbDXXqDkNoqXvVrRm', 1, 'holaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'Administrador', 'RP2WrKUUwUjhuIfoffFDufpCRfoYgPq6i155TKOgNWjO96N50wuYl5XNZrKR', '2020-05-05 08:03:02', '2020-05-26 09:06:18'),
(2, 'Creador', 'cread', 'crea', 'creador@email.es', NULL, '$2y$10$0yDyolVpjlaQ2Sow0DGcW.QEcu3Zb1OTvSNNOyeguifesrzSZbnDC', 2, 'hola creador', 'Creador', NULL, '2020-05-07 06:17:26', '2020-05-28 06:35:38'),
(5, 'Estandar', 'este', 'andare', 'estandar@email.es', NULL, '$2y$10$pOMcroHgc/UT/nt4TBPrjeBZm1o7EElOAT22Rey5n8MdmTyB9fwKu', 1, 'hola estandar', 'Estándar', NULL, '2020-05-12 09:56:44', '2020-05-28 06:39:16'),
(15, 'profe', 'pro', 'pro', 'profesor@mail.es', NULL, '$2y$10$vuPPazW8Xwabm4wzBsWizOyc7GCVD.yk/5f/Tl/gYHBqJSchHCYle', 1, 'pro', 'Administrador', NULL, '2020-05-21 09:06:53', '2020-05-21 09:23:12');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `leagues`
--
ALTER TABLE `leagues`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matches_id_team_local_foreign` (`id_team_local`),
  ADD KEY `matches_id_team_visitor_foreign` (`id_team_visitor`),
  ADD KEY `matches_id_league_foreign` (`id_league`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notices_id_user_foreign` (`id_user`);

--
-- Indices de la tabla `participates`
--
ALTER TABLE `participates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participates_id_league_foreign` (`id_league`),
  ADD KEY `participates_id_team_foreign` (`id_team`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`),
  ADD KEY `players_id_team_foreign` (`id_team`);

--
-- Indices de la tabla `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `leagues`
--
ALTER TABLE `leagues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `matches`
--
ALTER TABLE `matches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT de la tabla `notices`
--
ALTER TABLE `notices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `participates`
--
ALTER TABLE `participates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `players`
--
ALTER TABLE `players`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `matches_id_league_foreign` FOREIGN KEY (`id_league`) REFERENCES `leagues` (`id`),
  ADD CONSTRAINT `matches_id_team_local_foreign` FOREIGN KEY (`id_team_local`) REFERENCES `teams` (`id`),
  ADD CONSTRAINT `matches_id_team_visitor_foreign` FOREIGN KEY (`id_team_visitor`) REFERENCES `teams` (`id`);

--
-- Filtros para la tabla `notices`
--
ALTER TABLE `notices`
  ADD CONSTRAINT `notices_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `participates`
--
ALTER TABLE `participates`
  ADD CONSTRAINT `participates_id_league_foreign` FOREIGN KEY (`id_league`) REFERENCES `leagues` (`id`),
  ADD CONSTRAINT `participates_id_team_foreign` FOREIGN KEY (`id_team`) REFERENCES `teams` (`id`);

--
-- Filtros para la tabla `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `players_id_team_foreign` FOREIGN KEY (`id_team`) REFERENCES `teams` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
