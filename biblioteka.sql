-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 28 Lis 2022, 18:45
-- Wersja serwera: 10.4.25-MariaDB
-- Wersja PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `biblioteka`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admini`
--

CREATE TABLE `admini` (
  `id_admin` int(11) NOT NULL,
  `login` text COLLATE utf8_polish_ci NOT NULL,
  `haslo` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `admini`
--

INSERT INTO `admini` (`id_admin`, `login`, `haslo`) VALUES
(1, 'root', '$2y$10$oh/WHv3TIUEtpQmIwuUun.ZIxpX8DI37qix1EG3n1OVDQvGn5h/pq');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `autorzy`
--

CREATE TABLE `autorzy` (
  `id_autor` int(11) NOT NULL,
  `nazwa` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `autorzy`
--

INSERT INTO `autorzy` (`id_autor`, `nazwa`) VALUES
(1, 'anieli'),
(5, 'macia'),
(6, 'Adam Mickiewicz'),
(7, 'student'),
(8, 'Charles L. Whitfield'),
(9, 'Scott Galloway'),
(10, 'Kinga Paruzel'),
(11, 'Laila Shukri'),
(12, 'Agnieszka Samolej'),
(13, 'Kurmaz');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `id_kategoria` int(11) NOT NULL,
  `nazwa` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `kategorie`
--

INSERT INTO `kategorie` (`id_kategoria`, `nazwa`) VALUES
(1, 'romans'),
(3, 'horror'),
(4, 'poemat'),
(5, 'dramat'),
(6, 'psychologiczne'),
(7, ''),
(8, 'rozwój'),
(9, 'techniczne'),
(10, ''),
(11, 'obyczajowe'),
(12, 'kulinarne');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ksiazki`
--

CREATE TABLE `ksiazki` (
  `id_ksiazka` int(11) NOT NULL,
  `tytul` text COLLATE utf8_polish_ci NOT NULL,
  `id_kategoria` int(11) NOT NULL,
  `id_autor` int(11) NOT NULL,
  `rok_wydania` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `ksiazki`
--

INSERT INTO `ksiazki` (`id_ksiazka`, `tytul`, `id_kategoria`, `id_autor`, `rok_wydania`) VALUES
(25, 'Zadbaj o swoje wewnętrzne dziecko', 6, 8, 2021),
(26, 'Pan Tadeusz', 4, 6, 1990),
(27, 'Jak rozmawiać z psem', 8, 12, 2020),
(29, 'Ilustrowana biblioteka wiedzy - technika', 9, 8, 2007),
(30, 'Perska zazdrość', 11, 11, 2016),
(31, 'Jestem żoną szejka', 11, 11, 2017),
(32, 'Pij zielone', 12, 10, 2015),
(33, 'Fit słodkości', 12, 10, 2017),
(34, 'Ballady i romanse', 1, 6, 1995),
(35, 'Dziady cz. 2', 4, 6, 1998),
(36, 'PKM', 8, 13, 1700);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id_uzytkownik` int(11) NOT NULL,
  `login` text COLLATE utf8_polish_ci NOT NULL,
  `haslo` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id_uzytkownik`, `login`, `haslo`) VALUES
(1, 'maciek', '$2y$10$QIlEcc2CeoexOEQnPhnfQOACiwatc1YtnliLxmkMPBRQJ66vpVZru'),
(4, 'adam', '$2y$10$O0zo4aJDwn5wrNFX2LE/eOeFwqucSYbDkvTPFejVs86TormNtA8UG'),
(5, 'asia123', '$2y$10$TLdriSL2vnzo1ty7biD2eev04jzSpWErMZr3g9t2EedHTavvXki8O'),
(6, 'asia1222', '$2y$10$vmEpG.D4KKuJ7KvSj0t9JerrhjeVdSbc9pM1/wUNGU05eM8W5d4Lu');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wypozyczenia`
--

CREATE TABLE `wypozyczenia` (
  `id_wypozyczenia` int(11) NOT NULL,
  `id_uzytkownik` int(11) NOT NULL,
  `id_ksiazka` int(11) NOT NULL,
  `data_wypozyczenia` date NOT NULL,
  `data_oddania` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `wypozyczenia`
--

INSERT INTO `wypozyczenia` (`id_wypozyczenia`, `id_uzytkownik`, `id_ksiazka`, `data_wypozyczenia`, `data_oddania`) VALUES
(11, 6, 34, '2022-11-28', '2022-11-28');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admini`
--
ALTER TABLE `admini`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeksy dla tabeli `autorzy`
--
ALTER TABLE `autorzy`
  ADD PRIMARY KEY (`id_autor`);

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id_kategoria`);

--
-- Indeksy dla tabeli `ksiazki`
--
ALTER TABLE `ksiazki`
  ADD PRIMARY KEY (`id_ksiazka`),
  ADD KEY `id_kategoria` (`id_kategoria`),
  ADD KEY `id_autor` (`id_autor`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id_uzytkownik`);

--
-- Indeksy dla tabeli `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  ADD PRIMARY KEY (`id_wypozyczenia`),
  ADD KEY `id_uzytkownik` (`id_uzytkownik`,`id_ksiazka`),
  ADD KEY `id_ksiazka` (`id_ksiazka`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `admini`
--
ALTER TABLE `admini`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `autorzy`
--
ALTER TABLE `autorzy`
  MODIFY `id_autor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id_kategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `ksiazki`
--
ALTER TABLE `ksiazki`
  MODIFY `id_ksiazka` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id_uzytkownik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  MODIFY `id_wypozyczenia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `ksiazki`
--
ALTER TABLE `ksiazki`
  ADD CONSTRAINT `ksiazki_ibfk_1` FOREIGN KEY (`id_kategoria`) REFERENCES `kategorie` (`id_kategoria`),
  ADD CONSTRAINT `ksiazki_ibfk_2` FOREIGN KEY (`id_autor`) REFERENCES `autorzy` (`id_autor`);

--
-- Ograniczenia dla tabeli `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  ADD CONSTRAINT `wypozyczenia_ibfk_1` FOREIGN KEY (`id_ksiazka`) REFERENCES `ksiazki` (`id_ksiazka`),
  ADD CONSTRAINT `wypozyczenia_ibfk_2` FOREIGN KEY (`id_uzytkownik`) REFERENCES `uzytkownicy` (`id_uzytkownik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
