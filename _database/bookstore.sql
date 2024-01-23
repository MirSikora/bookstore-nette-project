-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pon 22. led 2024, 15:36
-- Verze serveru: 10.4.32-MariaDB
-- Verze PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `bookstore`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author_firstname` varchar(100) NOT NULL,
  `author_surname` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `pieces` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `book`
--

INSERT INTO `book` (`id`, `title`, `author_firstname`, `author_surname`, `description`, `price`, `pieces`) VALUES
(1, 'Harry Potter a Kámen mudrců', 'Joanne K.', 'Rowlingová', 'První rok v Bardavicích. Až do svých jedenáctých narozenin si o sobě Harry myslel, že je jen obyčejný chlapec. Pak ale dostal soví poštou dopis, kterým byl zván ke studiu na prestižní soukromé Škole čar a kouzel v Bradavicích, a jeho život se rázem proměnil. Leccos se dozvídá o minulosti svých zemřelých rodičů, získá pár dobrých kamarádů, naučí se mistrovsky hrát famfrpál a kvůli Kameni mudrců podstoupí smrtelný souboj se zloduchem Voldemortem...', 350, 10),
(2, 'Harry Potter a Tajemná komnata', 'Joanne K.', 'Rowlingová', 'Harry si za uplynulé léto prožil ty nejhorší narozeniny v životě, dostal několik zlověstných varování od domácího skřítka Dobbyho a od Dursleyových ho nakonec musel zachránit Ron Weasley v kouzelném létajícím autě. Na chodbách bradavické školy pak Harry slyší podivný šepot – a útoky na sebe nenechají dlouho čekat. Několik studentů zdánlivě zkamení a Dobbyho předpovědi se začínají vyplňovat…', 350, 8),
(3, 'Harry Potter a vězeň z Azkabanu', 'Joanne K.', 'Rowlingová', 'Ze tmy se vyřítí Záchranný autobus a se skřípěním zastavím přímo před Harrym Potterem. Začíná další neobyčejný rok v Bradavicích. Sirius Black, masový vrah a následovník Lorda Voldemorta, je na útěku a proslýchá se, že má spadeno právě na Harryho. Na první hodině jasnovidectví profesorka Trelawneyová v Harryho čajových lístcích spatří znamení smrti. Ale ze všeho nejděsivější jsou mozkomorové, kteří hlídají školní pozemky. Jejich polibek vysaje člověku duši…', 350, 7),
(4, 'Harry Potter a Ohnivý pohár', 'Joanne K.', 'Rowlingová', 'V Bradavicích se bude konat Turnaj tří kouzelníků. Zúčastnit se ho smí jen studenti, kterým už bylo sedmnáct let, a tak Harry Potter zatím alespoň sní o tom, že turnaj jednou vyhraje. Jenže když o Halloweenu Ohnivý pohár vyřkne své rozhodnutí, Harry s úžasem zjistí, že je mezi vybranými. Čekají ho smrtící úkoly, draci a temní čarodějové, ale s pomocí svých nejlepších přátel Rona a Hermiony to Harry možná… přežije.', 350, 6),
(5, 'Harry Potter a Fénixův řád', 'Joanne K.', 'Rowlingová', 'Do Bradavic přišly temné časy. Po útoku mozkomorů na bratrance Dudleyho Harry ví, že Voldemort udělá cokoli, jen aby ho našel. Mnozí jeho návrat popírají, ale Harry přesto není sám: na Grimmauldově náměstí se schází tajný řád, který chce bojovat proti temným silám. Harry se musí od profesora Snapea naučit, jak se chránit před Voldemortovými útoky na jeho duši. Jenže Pán zla je den ode dne silnější a Harrymu dochází čas…', 350, 9),
(6, 'Harry Potter a princ dvojí krve', 'Joanne K.', 'Rowlingová', 'Moc Lorda Voldemorta stále roste a smrtijedi působí spoušť ve světě mudlů i kouzelníků. Když Harry Potter objeví starou učebnici lektvarů patřící tajemnému princi dvojí krve, spoléhá na její kouzla i přes varování svých kamarádů. Profesor Brumbál poodhaluje Voldemortovu minulost a s Harryho pomocí se snaží odkrýt tajemství jeho nesmrtelnosti. Jenže zlo se dere k moci stále silněji, neštěstí se blíží a Bradavice už nikdy nebudou jako dřív.', 439, 6),
(7, 'Harry Potter a relikvie smrti', 'Joanne K.', 'Rowlingová', 'Věrní kamarádi Harry, Ron a Hermiona do posledního ročníku bradavické školy nenastoupí. Musí splnit nelehký úkol, který moudrý ředitel školy Albus Brumbál již nemůže dokončit. Společně se vydávají hledat tajemné viteály, do kterých Pán zla roztříštil svou duši. Zničení viteálů je tak jedinou šancí, jak nad ním zvítězit. Na trojici kamarádů číhají na cestě nebezpečné nástrahy, ale ani v těch nejtemnějších úkrytech neztrácejí podporu svých přátel.', 539, 5),
(8, 'Vinnetou', 'Karl', 'May', 'Nesmrtelná dobrodružství Vinnetoua, rudého gentlemana, a Old Shatterhanda přinášíme v převyprávění Vítězslava Kocourka. Kniha je plná romantiky a věčného souboje dobra se zlem uprostřed divoké, nezkrotné přírody. Ukazuje obraz indiánů, původních obyvatel Ameriky, v nesmlouvavých soubojích s bílými dobyvateli. Příběh doprovází nepřekonatelné ilustrace Zdeňka Buriana. ', 290, 10);

-- --------------------------------------------------------

--
-- Struktura tabulky `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `registered` enum('NO','YES') NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `order_data`
--

CREATE TABLE `order_data` (
  `order_id` int(11) NOT NULL,
  `order_number` varchar(50) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `client_id` int(11) NOT NULL,
  `transport` enum('CP','PPL','GLS') NOT NULL,
  `payment` enum('CASH','CARD') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_number` varchar(50) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexy pro tabulku `order_data`
--
ALTER TABLE `order_data`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_number` (`order_number`),
  ADD KEY `client_id` (`client_id`) USING BTREE;

--
-- Indexy pro tabulku `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_number` (`order_number`) USING BTREE,
  ADD KEY `book_id` (`book_id`) USING BTREE;

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pro tabulku `order_data`
--
ALTER TABLE `order_data`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pro tabulku `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `order_data`
--
ALTER TABLE `order_data`
  ADD CONSTRAINT `order_data_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`);

--
-- Omezení pro tabulku `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`),
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`order_number`) REFERENCES `order_data` (`order_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
