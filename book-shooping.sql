-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2024 at 10:42 AM
-- Server version: 8.0.33
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book-shooping`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `published_date` date NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `average_rating` decimal(3,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `description`, `image_url`, `published_date`, `isbn`, `created_at`, `updated_at`, `average_rating`) VALUES
(332, 'To Kill a Mockingbird', 'Harper Lee', 'A novel about the serious issues of rape and racial inequality, it is also full of warmth and humor.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/To_Kill_a_Mockingbird_%28first_edition_cover%29.jpg/220px-To_Kill_a_Mockingbird_%28first_edition_cover%29.jpg', '1960-07-11', '9780061120084', '2024-07-18 15:13:35', '2024-07-18 15:29:22', 4.00),
(333, '1984', 'George Orwell', 'A dystopian social science fiction novel and cautionary tale about the dangers of totalitarianism.', 'https://upload.wikimedia.org/wikipedia/en/5/51/1984_first_edition_cover.jpg', '1949-06-08', '9780451524935', '2024-07-18 15:13:35', '2024-07-18 15:30:55', 0.00),
(334, 'Pride and Prejudice', 'Jane Austen', 'A romantic novel that charts the emotional development of the protagonist Elizabeth Bennet.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/17/PrideAndPrejudiceTitlePage.jpg/220px-PrideAndPrejudiceTitlePage.jpg', '1813-01-28', '9781503290563', '2024-07-18 15:13:35', '2024-07-18 15:32:13', 0.00),
(335, 'The Great Gatsby', 'F. Scott Fitzgerald', 'A novel that critiques the disillusionment and moral decay of society during the 1920s.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7a/The_Great_Gatsby_Cover_1925_Retouched.jpg/220px-The_Great_Gatsby_Cover_1925_Retouched.jpg', '1925-04-10', '9780743273565', '2024-07-18 15:13:35', '2024-07-18 15:33:04', 0.00),
(336, 'Moby-Dick', 'Herman Melville', 'A novel about the voyage of the whaling ship Pequod and its captain, Ahab, who is intent on pursuing the white whale Moby Dick.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/36/Moby-Dick_FE_title_page.jpg/220px-Moby-Dick_FE_title_page.jpg', '1851-11-14', '9781503280786', '2024-07-18 15:13:35', '2024-07-18 15:35:39', 0.00),
(337, 'War and Peace', 'Leo Tolstoy', 'A historical novel that tells the story of five families during the Napoleonic wars.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/af/Tolstoy_-_War_and_Peace_-_first_edition%2C_1869.jpg/220px-Tolstoy_-_War_and_Peace_-_first_edition%2C_1869.jpg', '1869-01-01', '9780199232765', '2024-07-18 15:13:35', '2024-07-18 15:37:07', 0.00),
(338, 'Crime and Punishment', 'Fyodor Dostoevsky', 'A novel about the mental anguish and moral dilemmas of an impoverished ex-student in St. Petersburg.', 'https://upload.wikimedia.org/wikipedia/en/thumb/4/4b/Crimeandpunishmentcover.png/220px-Crimeandpunishmentcover.png', '1866-01-01', '9780140449136', '2024-07-18 15:13:35', '2024-07-18 15:38:49', 0.00),
(339, 'The Catcher in the Rye', 'J.D. Salinger', 'A novel about teenage rebellion and angst.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/89/The_Catcher_in_the_Rye_%281951%2C_first_edition_cover%29.jpg/220px-The_Catcher_in_the_Rye_%281951%2C_first_edition_cover%29.jpg', '1951-07-16', '9780316769488', '2024-07-18 15:13:35', '2024-07-18 15:39:45', 0.00),
(340, 'The Hobbit', 'J.R.R. Tolkien', 'A fantasy novel about the quest of home-loving Bilbo Baggins to win a share of the treasure guarded by Smaug the dragon.', 'https://upload.wikimedia.org/wikipedia/en/thumb/4/4a/TheHobbit_FirstEdition.jpg/220px-TheHobbit_FirstEdition.jpg', '1937-09-21', '9780547928227', '2024-07-18 15:13:35', '2024-07-18 15:40:46', 0.00),
(341, 'Fahrenheit 451', 'Ray Bradbury', 'A dystopian novel about a future American society where books are outlawed and \"firemen\" burn any that are found.', 'https://upload.wikimedia.org/wikipedia/en/thumb/d/db/Fahrenheit_451_1st_ed_cover.jpg/220px-Fahrenheit_451_1st_ed_cover.jpg', '1953-10-19', '9781451673319', '2024-07-18 15:13:35', '2024-07-18 15:42:00', 0.00),
(342, 'Jane Eyre', 'Charlotte Bronte', 'A novel that follows the experiences of its eponymous heroine, including her growth to adulthood and her love for Mr. Rochester.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9b/Jane_Eyre_title_page.jpg/220px-Jane_Eyre_title_page.jpg', '1847-10-16', '9780141441146', '2024-07-18 15:13:35', '2024-07-18 15:42:44', 0.00),
(343, 'The Lord of the Rings', 'J.R.R. Tolkien', 'An epic high-fantasy novel that follows the quest to destroy the One Ring.', 'https://upload.wikimedia.org/wikipedia/en/thumb/e/e9/First_Single_Volume_Edition_of_The_Lord_of_the_Rings.gif/220px-First_Single_Volume_Edition_of_The_Lord_of_the_Rings.gif', '1954-07-29', '9780544003415', '2024-07-18 15:13:35', '2024-07-18 15:43:17', 0.00),
(344, 'Brave New World', 'Aldous Huxley', 'A dystopian novel that anticipates developments in reproductive technology, sleep-learning technology, psychological manipulation, and classical conditioning.', 'https://upload.wikimedia.org/wikipedia/en/thumb/6/62/BraveNewWorld_FirstEdition.jpg/220px-BraveNewWorld_FirstEdition.jpg', '1932-01-01', '9780060850524', '2024-07-18 15:13:35', '2024-07-18 15:50:51', 0.00),
(345, 'The Brothers Karamazov', 'Fyodor Dostoevsky', 'A philosophical novel that enters deeply into the ethical debates of God, free will, and morality.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2d/Dostoevsky-Brothers_Karamazov.jpg/220px-Dostoevsky-Brothers_Karamazov.jpg', '1880-01-01', '9780374528379', '2024-07-18 15:13:35', '2024-07-18 15:51:41', 0.00),
(346, 'One Hundred Years of Solitude', 'Gabriel Garcia Marquez', 'A multi-generational story about the Buendía family, whose patriarch founded the town of Macondo.', 'https://upload.wikimedia.org/wikipedia/en/thumb/a/a0/Cien_a%C3%B1os_de_soledad_%28book_cover%2C_1967%29.jpg/220px-Cien_a%C3%B1os_de_soledad_%28book_cover%2C_1967%29.jpg', '1967-06-05', '9780060883287', '2024-07-18 15:13:35', '2024-07-18 15:52:26', 0.00),
(347, 'Catch-22', 'Joseph Heller', 'A satirical novel set during World War II, the story follows Captain John Yossarian, a U.S. Army Air Force B-25 bombardier.', 'https://upload.wikimedia.org/wikipedia/en/thumb/9/99/Catch22.jpg/220px-Catch22.jpg', '1961-11-10', '9781451626650', '2024-07-18 15:13:35', '2024-07-18 15:53:06', 0.00),
(348, 'The Alchemist', 'Paulo Coelho', 'A novel that tells the story of a young shepherd named Santiago and his journey to the pyramids of Egypt.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c4/TheAlchemist.jpg/220px-TheAlchemist.jpg', '1988-01-01', '9780061122415', '2024-07-18 15:13:35', '2024-07-18 15:53:50', 0.00),
(349, 'The Grapes of Wrath', 'John Steinbeck', 'A novel about the economic hardship faced by tenant farmers displaced from Oklahoma during the Great Depression.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/The_Grapes_of_Wrath_%281939_1st_ed_cover%29.jpg/220px-The_Grapes_of_Wrath_%281939_1st_ed_cover%29.jpg', '1939-04-14', '9780143039433', '2024-07-18 15:13:35', '2024-07-18 15:54:37', 0.00),
(350, 'Wuthering Heights', 'Emily Bronte', 'A novel that follows the life of Heathcliff and his love for Catherine Earnshaw.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/64/Houghton_Lowell_1238.5_%28A%29_-_Wuthering_Heights%2C_1847.jpg/200px-Houghton_Lowell_1238.5_%28A%29_-_Wuthering_Heights%2C_1847.jpg', '1847-12-01', '9780141439556', '2024-07-18 15:13:35', '2024-07-18 15:55:38', 0.00),
(351, 'The Book Thief', 'Markus Zusak', 'A historical novel about a young girl living in Nazi Germany who steals books and shares them with others.', 'https://upload.wikimedia.org/wikipedia/en/thumb/8/8f/The_Book_Thief_by_Markus_Zusak_book_cover.jpg/220px-The_Book_Thief_by_Markus_Zusak_book_cover.jpg', '2005-03-14', '9780375842207', '2024-07-18 15:13:35', '2024-07-18 15:56:47', 0.00),
(352, 'The Chronicles of Narnia', 'C.S. Lewis', 'A series of seven fantasy novels that follows the adventures of children in the magical land of Narnia.', 'https://upload.wikimedia.org/wikipedia/en/thumb/c/cb/The_Chronicles_of_Narnia_box_set_cover.jpg/220px-The_Chronicles_of_Narnia_box_set_cover.jpg', '1950-10-16', '9780066238500', '2024-07-18 15:13:35', '2024-07-18 15:58:23', 0.00),
(353, 'Little Women', 'Louisa May Alcott', 'A novel that follows the lives of the four March sisters as they grow up during the American Civil War.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f9/Houghton_AC85.A%E2%84%93194L.1869_pt.2aa_-_Little_Women%2C_title.jpg/200px-Houghton_AC85.A%E2%84%93194L.1869_pt.2aa_-_Little_Women%2C_title.jpg', '1868-09-30', '9780147514011', '2024-07-18 15:13:35', '2024-07-18 15:58:54', 0.00),
(354, 'Slaughterhouse-Five', 'Kurt Vonnegut', 'A science fiction-infused anti-war novel about the World War II experiences and journeys through time of Billy Pilgrim.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Slaughterhouse-Five_%28first_edition%29_-_Kurt_Vonnegut.jpg/220px-Slaughterhouse-Five_%28first_edition%29_-_Kurt_Vonnegut.jpg', '1969-03-31', '9780440180296', '2024-07-18 15:13:35', '2024-07-18 15:59:30', 0.00),
(355, 'Anna Karenina', 'Leo Tolstoy', 'A novel that tells of the doomed love affair between the sensuous and rebellious Anna and the dashing officer, Count Vronsky.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c7/AnnaKareninaTitle.jpg/220px-AnnaKareninaTitle.jpg', '1877-01-01', '9780143035008', '2024-07-18 15:13:35', '2024-07-18 16:00:02', 0.00),
(356, 'The Odyssey', 'Homer', 'An ancient Greek epic poem that follows the adventures of Odysseus as he returns home from the Trojan War.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/Odyssey-crop.jpg/220px-Odyssey-crop.jpg', '0800-01-01', '9780140268867', '2024-07-18 15:13:35', '2024-07-18 16:01:57', 0.00),
(357, 'Madame Bovary', 'Gustave Flaubert', 'A novel that focuses on a doctor\'s wife, Emma Bovary, who has adulterous affairs and lives beyond her means.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9f/Madame_Bovary_1857_%28hi-res%29.jpg/220px-Madame_Bovary_1857_%28hi-res%29.jpg', '1857-04-15', '9780140449129', '2024-07-18 15:13:35', '2024-07-18 16:03:12', 0.00),
(358, 'Don Quixote', 'Miguel de Cervantes', 'A Spanish novel about a nobleman who reads so many chivalric romances that he loses his sanity and decides to become a knight-errant.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Title_page_first_edition_Don_Quijote.jpg/250px-Title_page_first_edition_Don_Quijote.jpg', '1605-01-16', '9780060934347', '2024-07-18 15:13:35', '2024-07-18 16:03:52', 0.00),
(359, 'Ulysses', 'James Joyce', 'A modernist novel that chronicles the appointments and encounters of Leopold Bloom in Dublin in the course of an ordinary day.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ab/JoyceUlysses2.jpg/220px-JoyceUlysses2.jpg', '1922-02-02', '9780199535675', '2024-07-18 15:13:35', '2024-07-18 16:04:24', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `book_category`
--

CREATE TABLE `book_category` (
  `book_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `book_category`
--

INSERT INTO `book_category` (`book_id`, `category_id`, `created_at`, `updated_at`) VALUES
(332, 1, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(333, 1, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(334, 1, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(335, 1, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(336, 1, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(337, 1, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(338, 1, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(339, 1, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(341, 1, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(342, 1, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(343, 1, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(344, 1, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(345, 1, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(346, 1, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(347, 1, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(348, 1, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(349, 1, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(350, 1, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(351, 1, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(353, 1, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(354, 1, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(355, 1, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(356, 1, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(357, 1, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(358, 1, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(359, 1, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(354, 2, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(340, 3, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(343, 3, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(352, 3, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(337, 4, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(349, 4, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(351, 4, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(334, 5, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(342, 5, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(350, 5, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(353, 5, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(355, 5, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(357, 5, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(333, 6, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(341, 6, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(344, 6, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(338, 7, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(345, 7, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(336, 8, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(340, 8, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(352, 8, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(356, 8, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(358, 8, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(346, 9, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(348, 9, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(359, 9, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(332, 10, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(335, 10, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(339, 10, '2024-07-18 16:34:27', '2024-07-18 16:34:27'),
(347, 10, '2024-07-18 16:34:27', '2024-07-18 16:34:27');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Classics', '2024-07-18 16:23:14', '2024-07-18 16:23:14'),
(2, 'Science Fiction', '2024-07-14 22:25:35', '2024-07-18 16:22:36'),
(3, 'Fantasy', '2024-07-14 22:25:35', '2024-07-18 16:22:57'),
(4, 'Historical Fiction', '2024-07-14 22:25:35', '2024-07-18 16:23:01'),
(5, 'Romance', '2024-07-14 22:25:35', '2024-07-18 16:23:26'),
(6, 'Dystopian', '2024-07-18 16:23:43', '2024-07-18 16:23:43'),
(7, 'Philosophy', '2024-07-18 16:24:02', '2024-07-18 16:24:02'),
(8, 'Adventure', '2024-07-14 22:25:35', '2024-07-18 16:24:27'),
(9, 'Literature', '2024-07-18 16:24:47', '2024-07-18 16:24:47'),
(10, 'Drama', '2024-07-14 22:25:35', '2024-07-18 16:24:57'),
(214, 'Non-Fiction', '2024-07-14 22:25:35', '2024-07-14 22:25:35'),
(215, 'Science', '2024-07-14 22:25:35', '2024-07-14 22:25:35'),
(216, 'Math', '2024-07-14 22:25:35', '2024-07-14 22:25:35'),
(217, 'History', '2024-07-14 22:25:35', '2024-07-14 22:25:35'),
(218, 'Biography', '2024-07-14 22:25:35', '2024-07-14 22:25:35'),
(222, 'Mystery', '2024-07-14 22:25:35', '2024-07-14 22:25:35'),
(223, 'Horror', '2024-07-14 22:25:35', '2024-07-14 22:25:35'),
(224, 'Thriller', '2024-07-14 22:25:35', '2024-07-14 22:25:35'),
(226, 'Poetry', '2024-07-14 22:25:35', '2024-07-14 22:25:35'),
(228, 'Self-Help', '2024-07-14 22:25:35', '2024-07-14 22:25:35'),
(229, 'Health', '2024-07-14 22:25:35', '2024-07-14 22:25:35'),
(230, 'Travel', '2024-07-14 22:25:35', '2024-07-14 22:25:35'),
(231, 'Children\'s', '2024-07-14 22:25:35', '2024-07-14 22:25:35'),
(232, 'Religion', '2024-07-14 22:25:35', '2024-07-14 22:25:35'),
(233, 'Spirituality', '2024-07-14 22:25:35', '2024-07-14 22:25:35'),
(234, 'Humor', '2024-07-14 22:25:35', '2024-07-14 22:25:35'),
(235, 'Business', '2024-07-14 22:25:35', '2024-07-14 22:25:35'),
(236, 'Education', '2024-07-14 22:25:35', '2024-07-14 22:25:35'),
(237, 'Cooking', '2024-07-14 22:25:35', '2024-07-14 22:25:35'),
(238, 'Art', '2024-07-14 22:25:35', '2024-07-14 22:25:35'),
(239, 'Music', '2024-07-14 22:25:35', '2024-07-14 22:25:35'),
(240, 'Sports', '2024-07-14 22:25:35', '2024-07-14 22:25:35'),
(241, 'Politics', '2024-07-14 22:25:35', '2024-07-14 22:25:35'),
(242, 'Technology', '2024-07-14 22:25:35', '2024-07-14 22:25:35');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `book_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `rating` int NOT NULL,
  `review` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`book_id`, `user_id`, `rating`, `review`, `created_at`, `updated_at`) VALUES
(212, 19, 2, 'This is a review for book 212 by user 19', '2024-07-14 22:25:37', '2024-07-14 22:25:37'),
(213, 19, 2, 'This is a review for book 213 by user 19', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(213, 22, 4, 'wasqtasdtgfsdgsg', '2024-07-19 12:03:23', '2024-07-19 12:03:23'),
(214, 19, 5, 'This is a review for book 214 by user 19', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(214, 20, 1, 'This is a review for book 214 by user 20', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(215, 18, 1, 'This is a review for book 215 by user 18', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(215, 19, 4, 'This is a review for book 215 by user 19', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(215, 20, 2, 'This is a review for book 215 by user 20', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(215, 21, 4, 'This is a review for book 215 by user 21', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(216, 18, 5, 'This is a review for book 216 by user 18', '2024-07-14 22:25:37', '2024-07-14 22:25:37'),
(216, 19, 2, 'This is a review for book 216 by user 19', '2024-07-14 22:25:37', '2024-07-14 22:25:37'),
(216, 20, 5, 'This is a review for book 216 by user 20', '2024-07-14 22:25:37', '2024-07-14 22:25:37'),
(216, 21, 4, 'This is a review for book 216 by user 21', '2024-07-14 22:25:37', '2024-07-14 22:25:37'),
(217, 18, 3, 'This is a review for book 217 by user 18', '2024-07-14 22:25:37', '2024-07-14 22:25:37'),
(217, 20, 1, 'This is a review for book 217 by user 20', '2024-07-14 22:25:37', '2024-07-14 22:25:37'),
(217, 21, 2, 'This is a review for book 217 by user 21', '2024-07-14 22:25:37', '2024-07-14 22:25:37'),
(218, 18, 3, 'This is a review for book 218 by user 18', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(219, 19, 1, 'This is a review for book 219 by user 19', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(219, 20, 4, 'This is a review for book 219 by user 20', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(219, 21, 1, 'This is a review for book 219 by user 21', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(220, 18, 4, 'This is a review for book 220 by user 18', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(220, 19, 1, 'This is a review for book 220 by user 19', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(220, 20, 1, 'This is a review for book 220 by user 20', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(220, 21, 4, 'This is a review for book 220 by user 21', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(221, 21, 4, 'This is a review for book 221 by user 21', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(222, 18, 1, 'This is a review for book 222 by user 18', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(222, 19, 1, 'This is a review for book 222 by user 19', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(222, 20, 2, 'This is a review for book 222 by user 20', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(222, 21, 4, 'This is a review for book 222 by user 21', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(223, 18, 5, 'This is a review for book 223 by user 18', '2024-07-14 22:25:37', '2024-07-14 22:25:37'),
(223, 20, 5, 'This is a review for book 223 by user 20', '2024-07-14 22:25:37', '2024-07-14 22:25:37'),
(223, 21, 5, 'This is a review for book 223 by user 21', '2024-07-14 22:25:37', '2024-07-14 22:25:37'),
(224, 19, 2, 'This is a review for book 224 by user 19', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(224, 20, 2, 'This is a review for book 224 by user 20', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(225, 18, 4, 'This is a review for book 225 by user 18', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(225, 20, 1, 'This is a review for book 225 by user 20', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(226, 18, 2, 'This is a review for book 226 by user 18', '2024-07-14 22:25:37', '2024-07-14 22:25:37'),
(226, 19, 2, 'This is a review for book 226 by user 19', '2024-07-14 22:25:37', '2024-07-14 22:25:37'),
(226, 21, 2, 'This is a review for book 226 by user 21', '2024-07-14 22:25:37', '2024-07-14 22:25:37'),
(227, 18, 5, 'This is a review for book 227 by user 18', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(227, 19, 5, 'This is a review for book 227 by user 19', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(227, 20, 4, 'This is a review for book 227 by user 20', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(227, 21, 2, 'This is a review for book 227 by user 21', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(228, 18, 2, 'This is a review for book 228 by user 18', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(228, 19, 5, 'This is a review for book 228 by user 19', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(228, 20, 4, 'This is a review for book 228 by user 20', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(229, 18, 2, 'This is a review for book 229 by user 18', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(229, 20, 5, 'This is a review for book 229 by user 20', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(230, 19, 3, 'This is a review for book 230 by user 19', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(230, 21, 5, 'This is a review for book 230 by user 21', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(231, 18, 5, 'This is a review for book 231 by user 18', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(231, 20, 1, 'This is a review for book 231 by user 20', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(232, 18, 1, 'This is a review for book 232 by user 18', '2024-07-14 22:25:37', '2024-07-14 22:25:37'),
(232, 19, 4, 'This is a review for book 232 by user 19', '2024-07-14 22:25:37', '2024-07-14 22:25:37'),
(232, 20, 5, 'This is a review for book 232 by user 20', '2024-07-14 22:25:37', '2024-07-14 22:25:37'),
(232, 21, 3, 'This is a review for book 232 by user 21', '2024-07-14 22:25:37', '2024-07-14 22:25:37'),
(233, 21, 5, 'This is a review for book 233 by user 21', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(234, 18, 2, 'This is a review for book 234 by user 18', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(234, 20, 2, 'This is a review for book 234 by user 20', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(234, 21, 5, 'This is a review for book 234 by user 21', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(235, 18, 5, 'This is a review for book 235 by user 18', '2024-07-14 22:25:37', '2024-07-14 22:25:37'),
(235, 19, 2, 'This is a review for book 235 by user 19', '2024-07-14 22:25:37', '2024-07-14 22:25:37'),
(235, 21, 1, 'This is a review for book 235 by user 21', '2024-07-14 22:25:37', '2024-07-14 22:25:37'),
(236, 21, 4, 'This is a review for book 236 by user 21', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(237, 20, 4, 'This is a review for book 237 by user 20', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(237, 21, 4, 'This is a review for book 237 by user 21', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(238, 18, 4, 'This is a review for book 238 by user 18', '2024-07-14 22:25:37', '2024-07-14 22:25:37'),
(238, 19, 3, 'This is a review for book 238 by user 19', '2024-07-14 22:25:37', '2024-07-14 22:25:37'),
(238, 20, 1, 'This is a review for book 238 by user 20', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(238, 21, 1, 'This is a review for book 238 by user 21', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(239, 18, 2, 'This is a review for book 239 by user 18', '2024-07-14 22:25:37', '2024-07-14 22:25:37'),
(239, 20, 2, 'This is a review for book 239 by user 20', '2024-07-14 22:25:37', '2024-07-14 22:25:37'),
(239, 21, 3, 'This is a review for book 239 by user 21', '2024-07-14 22:25:37', '2024-07-14 22:25:37'),
(240, 18, 1, 'This is a review for book 240 by user 18', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(240, 19, 4, 'This is a review for book 240 by user 19', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(241, 18, 3, 'This is a review for book 241 by user 18', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(241, 19, 5, 'This is a review for book 241 by user 19', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(241, 20, 1, 'This is a review for book 241 by user 20', '2024-07-14 22:25:36', '2024-07-14 22:25:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(18, 'Mukarram Sajjad', 'mukarram_sajjad', 'mukarram_sajjad@example.com', '$2y$10$VusjXmqK4SAyRXhUVdXk4.7izVlHkLFfYEtnDgwEX41gou2YWoq2q', '2024-07-14 22:25:35', '2024-07-18 02:08:38'),
(19, 'Jane Smith', 'janesmith', 'janesmith@example.com', '$2y$10$QAVvzLNxtI2gUJ1S.toIteXRX2pNUSwFnKk0xH1kbr64a7VFEYcmm', '2024-07-14 22:25:35', '2024-07-14 22:25:35'),
(20, 'Alice Johnson', 'alicejohnson', 'alicejohnson@example.com', '$2y$10$mtEvi3UreSw1i23nlAMzbOWP1B2lc3e8D8pgTvlB5TToWZDI3YPDG', '2024-07-14 22:25:35', '2024-07-14 22:25:35'),
(21, 'Bob Brown', 'bobbrown', 'bobbrown@example.com', '$2y$10$0vYOQjdfX0rXivC4RH1vjuOuBJWQCFlmgycy7cQxndbrJ6cQjcZs6', '2024-07-14 22:25:36', '2024-07-14 22:25:36'),
(22, 'Ali Hassan', 'ali_hassan', 'ihassanali57@gmail.com', '$2y$10$A/D7BlFihU2Mxpa6kTHKPegRObvzfgFwGhlaUbpDzZu3vn0IRuXMq', '2024-07-14 22:30:48', '2024-07-14 22:30:48'),
(23, 'Hamza Anwaar', 'hamza_anwaar', 'hamza_anwaar@gmail.com', '$2y$10$.WbRDuCiRtfwVOAsJDWs6uT.k/fN4OHU4VNwf03Qs.8y5NCaQvZ9a', '2024-07-14 23:06:26', '2024-07-14 23:06:26'),
(24, 'M Afzal', 'm_afzal', 'm_hammad@gmail.com', '$2y$10$klKzQcJvEeXWzI2EfEptcO2ggh/YeY7gQQD97fC3UbMn6lhMmkUjK', '2024-07-18 02:36:33', '2024-07-18 02:40:47');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `user_id` bigint UNSIGNED NOT NULL,
  `book_id` bigint UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`user_id`, `book_id`, `created_at`, `updated_at`) VALUES
(18, 332, '2024-07-18 15:29:03', '2024-07-18 15:29:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- Indexes for table `book_category`
--
ALTER TABLE `book_category`
  ADD PRIMARY KEY (`category_id`,`book_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`book_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`user_id`,`book_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=360;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_category`
--
ALTER TABLE `book_category`
  ADD CONSTRAINT `book_category_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
