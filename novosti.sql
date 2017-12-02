CREATE DATABASE IF NOT EXISTS `novosti` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `novosti`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(17, 'Политика'),
(18, 'Общество'),
(19, 'Экономика'),
(20, 'Наука'),
(21, 'Культура'),
(22, 'Спорт');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `image` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `image`, `category_id`, `content`, `created_at`) VALUES
(5, 'Мое путеществие ', 'https://farm5.staticflickr.com/4133/4993247968_9f0ee73624.jpg', 18, '<p>Article nor prepare chicken you him now. Shy merits say advice ten before lovers innate add. She cordially behaviour can attempted estimable. Trees delay fancy noise manor do as an small. Felicity now law securing breeding likewise extended and. Roused either who favour why ham. </p><p>\r\n\r\n                Article nor prepare chicken you him now. Shy merits say advice ten before lovers innate add. She cordially behaviour can attempted estimable. Trees delay fancy noise manor do as an small. Felicity now law securing breeding likewise extended and. Roused either who favour why ham.</p>', '2017-02-15'),
(6, 'Очередь на отставку', 'https://cdn5.img.ria.ru/images/148802/63/1488026375.jpg', 17, 'МУРМАНСК, 15 фев – РИА Новости. Глава Карелии Александр Худилайнен, слухи об отставке которого ходили с начала февраля, в среду объявил о досрочном сложении полномочий. Указом президента РФ врио назначен глава Федеральной службы судебных приставов (ФССП) Артур Парфенчиков – уроженец и бывший прокурор Петрозаводска.', '2017-02-15'),
(7, 'Хакеры узнали, что WADA восемь лет ', 'https://cdn1.img.ria.ru/images/148806/88/1488068882.jpg', 22, 'Канадка, выступающая на соревнованиях по стендовой стрельбе, дважды (в 2009 и 2015 годах) получала от WADA разрешение на употребление тамоксифена. Этот препарат классифицируется как \"гормон и модулятор роста\" и входит в список запрещенных WADA веществ. Тамоксифен помогает набрать дополнительную мышечную массу и повышает уровень тестостерона в крови.', '2017-02-15'),
(8, 'Lamborghini отзывает 5,9 тысячи', 'https://cdn1.img.ria.ru/images/148808/28/1488082867.jpg', 19, 'Отзыв связан с неисправностью в топливной системе. Из-за данных неполадок автомобиль может загореться. На данный момент компании неизвестно о пострадавших из-за неисправности автомобилистах.\r\nОтзыв касается моделей Aventadors и Venenos. Как отмечает агентство, компания за всю историю выпустила лишь 12 суперкаров Venenos, их стоимость начинается от 4 миллионов долларов.', '2017-02-16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(2, 'uynann', 'uynann@mail.ru', '933b0fe7965a295ce4bc89b468e51eea');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;--
-- Database: `onetomany`
--
