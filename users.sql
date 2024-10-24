-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Okt 24. 10:01
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `web`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `Stilus` int(11) NOT NULL,
  `theme` varchar(10) DEFAULT 'light'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `Stilus`, `theme`) VALUES
(1, 'teszt', '$2y$10$/CTIpiruU/lZsvHBYx04U.YmRVuUVIvQs9bLhy.mv4tEXzZv6w1Fy', 'teszt1@gmail.com', 'user', 2, 'dark'),
(2, 'admin', '$2y$10$/CTIpiruU/lZsvHBYx04U.YmRVuUVIvQs9bLhy.mv4tEXzZv6w1Fy', 'admin@admin.hu', 'admin', 1, 'light'),
(3, 'Gergo', '$2y$10$bfFzMIiTMiux4ktzE2/9JOlnGV.to/KSxTde1EX420xj/Ullm/WK2', 'gergo@user.hu', 'user', 0, 'light'),
(5, 'win', '$2y$10$wFQW7MqjjXTucAmgL09nF.hMyuWTdqtn2V6BXOKv/im5GxQWxCF.G', 'win@gmail.com', 'user', 0, 'light'),
(6, 'os', '$2y$10$KR5f6b95l12T7PXs6it80.6LvgXBfF.5Vc2chcLqZPKcPEKXnrnQO', 'os@user.hu', 'user', 0, 'dark'),
(8, 'Peti01', '$2y$10$RdGiLp4MD9zQSrSUFAgi3eHRmtk3EMaacmgD8cKP7FSBqmBNfUmmy', 'peter@me.hu', 'user', 0, 'dark');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
