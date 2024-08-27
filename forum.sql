-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 17 Sty 2018, 20:18
-- Wersja serwera: 10.1.28-MariaDB
-- Wersja PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `forum`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`id`, `title`) VALUES
(8, 'Podzespoły komputerowe'),
(9, 'Peryferia i inny sprzęt'),
(10, 'Chłodzenie, podkręcanie'),
(11, 'Oprogramowanie'),
(12, 'Strefa gracza'),
(13, 'Luźne rozmowy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `description`) VALUES
(1, 'Administrator', 'Posiada pełne uprawnienia na forum'),
(2, 'Moderator', 'Może usuwać oraz edytować posty innych użytkowników. Może tworzyć również kategorie i podkategorię.'),
(3, 'Użytkownik', 'Użytkownik posiadający uprawnienia do tworzenia nowych tematów w istniejących kategoriach, oraz ich komentowania.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `posts`
--

INSERT INTO `posts` (`id`, `topic_id`, `content`, `date`, `user_id`) VALUES
(1, 1, 'Moim zdaniem uważam że to jest odpowiedź', '2018-01-16 02:22:26', 1),
(3, 4, 'Drugi komentarz', '2018-01-16 19:21:30', 1),
(47, 6, 'Moim zdaniem nie warto niczego zmieniać. Wzrost wydajności będzie minimalny', '2018-01-17 20:07:31', 10),
(48, 6, 'Potwierdzam Poprzednika ', '2018-01-17 20:08:23', 11);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `title`, `description`) VALUES
(16, 8, 'Procesory i płyty główne', 'Bo najważniejsza jest solidna podstawa!'),
(17, 8, '	Pamięci RAM', 'Pamięć DDR3 czy DDR4? Szybsze, a może lepiej pojemniejsze? Zapytasz tu o wszystko związane z RAM.'),
(18, 8, 'Karty graficzne', 'GeForce czy Radeon? Wybierz kartę graficzną dla siebie.'),
(19, 8, 'Komputery, zestawy komputerowe', 'Przymierzasz się do kupna nowego komputera? Masz jakieś wątpliwości? Podziel się nimi, a my postaramy się je rozwiać.'),
(20, 8, 'Dyski, dyskietki, pendrive czy srebrne krążki.', 'Dyski, dyskietki, pendrive czy srebrne krążki. Wszystko tylko tutaj.'),
(21, 9, 'Monitory i projektory', 'Masz problem z wyborem monitora? Dobrze trafiłeś, wspólnie na pewno coś wybierzemy.'),
(22, 9, 'Kino domowe, HDTV', 'Czyli jaki telewizor kupić i co zrobić, żeby podczas filmu mieć pierwszorzędny obraz i dźwięk.'),
(23, 9, 'Aparaty cyfrowe i kamery', 'Dyskusje na temat aparatów cyfrowych, kompaktowych, analogowych oraz kamerach cyfrowych.'),
(24, 9, 'Telefony komórkowe i smartfony', 'Wszystko co gra, dzwoni, pisze smsy i nie tylko.'),
(25, 10, 'Chłodzenie powietrzem', 'Pierwsza pomoc dla komputera, szczególnie w upalne dni.'),
(26, 10, 'Chłodzenie wodne i inne', 'Czy to woda, czy to azot... grunt, że skutecznie odprowadza ciepło.'),
(27, 10, 'Podkręcanie', 'Dział dla osób, które nie boją się ryzyka ani skutków poniesionych przez wykręcanie swoich maszynek do granic możliwości.'),
(28, 11, 'Aplikacje użytkowe i multimedia', 'Wszelakie programy, w tym biurowe, muzyczne oraz narzędzia do obróbki video.'),
(29, 11, 'Internet, sieci komputerowe, bezpieczeństwo', 'O sieciach dużych (globalnych) i małych (domowych).'),
(30, 12, 'Tematy ogólne  ', 'Miejsce na zbiorcze tematy poświęcone danym produkcjom.'),
(31, 12, 'Problemy z grami', 'Twoja gra nie działa? Partyjkę RTSa przerywa niespodziewany błąd? Odpowiedzi szukaj tutaj.'),
(32, 12, 'Konsole stacjonarne', 'Co wybrać, w co zagrać, jak rozwiązać problem sprzętowy/programowy? - Znajdziesz o tym tutaj.'),
(33, 11, 'Grafika 2D, 3D i animacja', 'Rozmowy o grafice dwuwymiarowej, modelach przestrzennych i animacji komputerowej.'),
(34, 13, 'Ogólnie o IT', 'Dyskusja na różne tematy dotyczące świata komputerów, sprzętu i oprogramowania.'),
(35, 13, 'Sport i motoryzacja', 'Dla fanów piłki nożnej, koszykówki, tenisa i wszystkiego, co zasilane jest silnikiem spalinowym.'),
(36, 13, 'Filmy, seriale i muzyka', 'Ulubione miejsce kinomaniaków i audiofilów.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` longtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `topics`
--

INSERT INTO `topics` (`id`, `subcategory_id`, `title`, `content`, `user_id`, `date`) VALUES
(1, 1, 'Testowy Tytuł', 'Testowa treść', 1, '2018-01-10 00:00:00'),
(2, 1, 'Testowy Tytuł', 'Testowa treść', 1, '2018-01-10 00:00:00'),
(3, 1, 'To jest mój nowy temat', 'Lorem Ipsum jest tekstem stosowanym jako przykładowy wypełniacz w przemyśle poligraficznym. Został po raz pierwszy użyty w XV w. przez nieznanego drukarza do wypełnienia tekstem próbnej książki. Pięć wieków później zaczął być używany przemyśle elektronicznym, pozostając praktycznie niezmienionym. Spopularyzował się w latach 60. XX w. wraz z publikacją arkuszy Letrasetu, zawierających fragmenty Lorem Ipsum, a ostatnio z zawierającym różne wersje Lorem Ipsum oprogramowaniem przeznaczonym do realizacji druków na komputerach osobistych, jak Aldus PageMaker', 1, '2018-01-16 17:37:38'),
(4, 3, 'Czy CRT da radę dzisiaj?', 'Witam,\r\nChciałby o coś zapytać.\r\nCzy monitory CRT dają jeszcze radę w dzisiejszych czasach?', 1, '2018-01-16 17:51:58'),
(5, 4, 'iPhone - inwestycja w dobry telefon czy szpan ?', 'Telefony z definicji nie są dobrą inwestycją z uwagi na szybki spadek na wartości. Produkty Apple&#039;a tracą na niej nieco wolniej; z uwagi np. na kategorię cenową.\r\n\r\n&quot;Szpan&quot; - z pewnością istnieje spora grupa użytkowników produktów tego producenta, dla których &quot;pokazanie się&quot; jest wartością nadrzędną. Szczególnie w naszym kraju, gdzie stosunek przeciętnych zarobków do cen produktów Apple&#039;a jest zaporowy, a zakup traktowany jest jako manifest swojej majętności. W bogatszych krajach zachodu, tego typu dywagacje zazwyczaj schodzą na dalszy plan.\r\n\r\nCzy &quot;dobry&quot; - zależy, pod jakim względem. Jeśli &quot;kupujesz&quot; ogółem pojętą filozofię iOS&#039;a (tzn. spełnia twoje wymagania), a koszt nie jest jakimkolwiek problemem, to jest to jak najbardziej dobry wybór.', 1, '2018-01-16 18:20:58'),
(6, 16, 'Wymiana procesora AMD.', 'Witam Serdecznie!\r\n\r\nPosiadam procesor AMD Athlon X2 5000 na płycie Foxconn M61PMV. Chciałem wymienić procesor na AMD Phenom X4 9650, czy będzie konieczne doinstalowanie jakichś sterowników?\r\n\r\nPozdrawiam Serdecznie. ;]', 1, '2018-01-17 19:42:52'),
(7, 16, 'Wymiana procesora, plyty głównej, ramu, czy warto?', 'Witam Wszystkich!\r\n\r\nModernizuje swój PC i zastanawiam sie czy warto również wymieniać procesor, ram, plyte główna.\r\nPodzespoly w chwili obecnej.\r\n\r\nPC podzespoły:\r\nObudowa:\r\nCooler master haf 912 +\r\n\r\nCPU:\r\nIntel Core i5 2500K 4,4 GHz\r\nW przyszlosci na i5 8400 lub jakaś starsza konstrukcje np. 7600k.\r\n\r\nkarta graficzna:\r\nGigabyte GTX 670 2bg oc X3\r\nW przyszłości GTX 1060 3gb/6gb lub Jakis radek.\r\ndyski twarde:\r\nPlextor M5S 128GB\r\nWD Blue WD10EZEX 1TB\r\n\r\npłyta główna:\r\nASUS P8P67 LE - Rewizja B3\r\nW przyszlosci zależy od cpu.\r\n\r\npamięć RAM:\r\nKingston HyperX Blu 2x2GB DDR3-1600, GeIL Enhance DDR3 1750MHz CL9 (2x2)\r\nW przyszłości DDR4 2400hz\r\n\r\nZasilacz:\r\nOCZ+80 600W\r\n\r\nI teraz pytania: \r\nCzy warto wymieniać procek czy sie jeszcze wstrzymać? Moze poczekać na nowe Ryzeny ponieważ nowa plyta do intela jest droga.\r\n\r\nCzy obecne ddr3 jest sens sprzedawać i kupować ddr4. Ddr4 maja jakaś większą przewage nad ddr3 w grach?\r\n\r\nZamierzam wydać 900zl procek, 900zl karta, ram 500zl plyta glowna 400zl.\r\nMogą jescze max 300zl dorzucić.\r\n\r\nEwentualnie wymienić karte i jeszcze z 4miesiace odczekać, tylko nie wiem czy do podzespołów jest sens wymieniać sama kartę.\r\n\r\nJakie macie propozycje? ', 1, '2018-01-17 19:44:53'),
(13, 16, 'asdasd', 'asdasda', 1, '2018-01-17 19:49:52'),
(14, 17, 'podkręcenie na 2400MHz', 'Posiadam płytę AsRock B250M-HDV + pamięci GoodRam Iridium DDR4 1 kość 8GB 2133MHz, widziałem, że w BIOS&#039;ie mogę zmienić taktowanie na 2400MHz, czy trzeba podnosić napięcie, albo zmieniać CL? Nie znam się na tym, proszę powiedzieć czy kości bd stabilne po podniesieniu taktowania.', 1, '2018-01-17 20:10:45');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL,
  `register_date` datetime NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `group_id`, `register_date`, `last_login`) VALUES
(1, 'Administrator', '$2y$10$.oeutlfYiJflxKp3H/pPYOuKdKIIUHFNjGsMW.Rooiz9Z8A9mUh5m', 'arkadiusz.haduch@edu.uekat.pl', 3, '2018-01-12 12:21:21', '2018-01-17 20:10:16'),
(10, 'Arczi14', '$2y$10$.oeutlfYiJflxKp3H/pPYOuKdKIIUHFNjGsMW.Rooiz9Z8A9mUh5m', 'arek01996@gmail.commm', 1, '2018-01-17 20:04:12', '2018-01-17 20:04:24'),
(11, 'Moderator', '$2y$10$.oeutlfYiJflxKp3H/pPYOuKdKIIUHFNjGsMW.Rooiz9Z8A9mUh5m', 'czeslaw@wp.pl', 2, '2018-01-17 20:07:46', '2018-01-17 20:07:52'),
(12, 'Krzys', '$2y$10$.oeutlfYiJflxKp3H/pPYOuKdKIIUHFNjGsMW.Rooiz9Z8A9mUh5m', 'krzys@wp.pl', 1, '2018-01-17 20:09:50', NULL);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_name` (`group_name`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT dla tabeli `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT dla tabeli `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
