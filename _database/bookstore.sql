-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Ned 28. led 2024, 17:48
-- Verze serveru: 10.4.32-MariaDB
-- Verze PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Databáze: `bookstore`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `author_firstname` varchar(100) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `author_surname` varchar(100) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `image` varchar(150) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `price` float NOT NULL,
  `pieces` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Vypisuji data pro tabulku `book`
--

INSERT INTO `book` (`id`, `title`, `author_firstname`, `author_surname`, `description`, `image`, `price`, `pieces`) VALUES
(1, 'Harry Potter a Kámen mudrců', 'Joanne K.', 'Rowlingová', 'První rok v Bardavicích. Až do svých jedenáctých narozenin si o sobě Harry myslel, že je jen obyčejný chlapec. Pak ale dostal soví poštou dopis, kterým byl zván ke studiu na prestižní soukromé Škole čar a kouzel v Bradavicích, a jeho život se rázem proměnil. Leccos se dozvídá o minulosti svých zemřelých rodičů, získá pár dobrých kamarádů, naučí se mistrovsky hrát famfrpál a kvůli Kameni mudrců podstoupí smrtelný souboj se zloduchem Voldemortem...', 'harry-potter-and-the-philosopher-s-stone.jpg', 350, 8),
(2, 'Harry Potter a Tajemná komnata', 'Joanne K.', 'Rowlingová', 'Harry si za uplynulé léto prožil ty nejhorší narozeniny v životě, dostal několik zlověstných varování od domácího skřítka Dobbyho a od Dursleyových ho nakonec musel zachránit Ron Weasley v kouzelném létajícím autě. Na chodbách bradavické školy pak Harry slyší podivný šepot – a útoky na sebe nenechají dlouho čekat. Několik studentů zdánlivě zkamení a Dobbyho předpovědi se začínají vyplňovat…', 'harry-potter-and-the-chamber-of-secrets.jpg', 350, 9),
(3, 'Harry Potter a vězeň z Azkabanu', 'Joanne K.', 'Rowlingová', 'Ze tmy se vyřítí Záchranný autobus a se skřípěním zastavím přímo před Harrym Potterem. Začíná další neobyčejný rok v Bradavicích. Sirius Black, masový vrah a následovník Lorda Voldemorta, je na útěku a proslýchá se, že má spadeno právě na Harryho. Na první hodině jasnovidectví profesorka Trelawneyová v Harryho čajových lístcích spatří znamení smrti. Ale ze všeho nejděsivější jsou mozkomorové, kteří hlídají školní pozemky. Jejich polibek vysaje člověku duši…', 'harry-potter-and-the-prisoner-of-azkaban.jpg', 350, 9),
(4, 'Harry Potter a Ohnivý pohár', 'Joanne K.', 'Rowlingová', 'V Bradavicích se bude konat Turnaj tří kouzelníků. Zúčastnit se ho smí jen studenti, kterým už bylo sedmnáct let, a tak Harry Potter zatím alespoň sní o tom, že turnaj jednou vyhraje. Jenže když o Halloweenu Ohnivý pohár vyřkne své rozhodnutí, Harry s úžasem zjistí, že je mezi vybranými. Čekají ho smrtící úkoly, draci a temní čarodějové, ale s pomocí svých nejlepších přátel Rona a Hermiony to Harry možná… přežije.', 'harry-potter-and-the-goblet-of-fire.jpg', 350, 8),
(5, 'Harry Potter a Fénixův řád', 'Joanne K.', 'Rowlingová', 'Do Bradavic přišly temné časy. Po útoku mozkomorů na bratrance Dudleyho Harry ví, že Voldemort udělá cokoli, jen aby ho našel. Mnozí jeho návrat popírají, ale Harry přesto není sám: na Grimmauldově náměstí se schází tajný řád, který chce bojovat proti temným silám. Harry se musí od profesora Snapea naučit, jak se chránit před Voldemortovými útoky na jeho duši. Jenže Pán zla je den ode dne silnější a Harrymu dochází čas…', 'harry-potter-and-the-order-of-the-phoenix.jpg', 350, 9),
(6, 'Harry Potter a princ dvojí krve', 'Joanne K.', 'Rowlingová', 'Moc Lorda Voldemorta stále roste a smrtijedi působí spoušť ve světě mudlů i kouzelníků. Když Harry Potter objeví starou učebnici lektvarů patřící tajemnému princi dvojí krve, spoléhá na její kouzla i přes varování svých kamarádů. Profesor Brumbál poodhaluje Voldemortovu minulost a s Harryho pomocí se snaží odkrýt tajemství jeho nesmrtelnosti. Jenže zlo se dere k moci stále silněji, neštěstí se blíží a Bradavice už nikdy nebudou jako dřív.', 'harry-potter-and-the-half-blood-prince.jpg', 439, 8),
(7, 'Harry Potter a relikvie smrti', 'Joanne K.', 'Rowlingová', 'Věrní kamarádi Harry, Ron a Hermiona do posledního ročníku bradavické školy nenastoupí. Musí splnit nelehký úkol, který moudrý ředitel školy Albus Brumbál již nemůže dokončit. Společně se vydávají hledat tajemné viteály, do kterých Pán zla roztříštil svou duši. Zničení viteálů je tak jedinou šancí, jak nad ním zvítězit. Na trojici kamarádů číhají na cestě nebezpečné nástrahy, ale ani v těch nejtemnějších úkrytech neztrácejí podporu svých přátel.', 'harry-potter-and-the-deathly-hallows.jpg', 539, 9),
(8, 'Vinnetou', 'Karl', 'May', 'Nesmrtelná dobrodružství Vinnetoua, rudého gentlemana, a Old Shatterhanda přinášíme v převyprávění Vítězslava Kocourka. Kniha je plná romantiky a věčného souboje dobra se zlem uprostřed divoké, nezkrotné přírody. Ukazuje obraz indiánů, původních obyvatel Ameriky, v nesmlouvavých soubojích s bílými dobyvateli. Příběh doprovází nepřekonatelné ilustrace Zdeňka Buriana. ', 'vinnetou.jpg', 290, 7);

-- --------------------------------------------------------

--
-- Struktura tabulky `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `registered` tinyint(1) DEFAULT NULL,
  `firstname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `surname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `city` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `zip_code` int(11) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `order_data`
--

CREATE TABLE `order_data` (
  `order_id` int(11) NOT NULL,
  `order_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `client_id` int(11) NOT NULL,
  `transport` enum('CP','PPL','GLS') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `payment` enum('CASH','CARD') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `order_status` enum('NEW','PACK','SHIP','PAID') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'NEW'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nickname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('USER','ADMIN') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `user_client_id`
--

CREATE TABLE `user_client_id` (
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
-- Indexy pro tabulku `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `user_client_id`
--
ALTER TABLE `user_client_id`
  ADD PRIMARY KEY (`user_id`) USING BTREE,
  ADD KEY `client_id` (`client_id`);

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
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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

--
-- Omezení pro tabulku `user_client_id`
--
ALTER TABLE `user_client_id`
  ADD CONSTRAINT `user_client_id_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_client_id_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`);
COMMIT;

