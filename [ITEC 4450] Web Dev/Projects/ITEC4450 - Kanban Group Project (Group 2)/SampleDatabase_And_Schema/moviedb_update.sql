-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2025 at 10:57 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moviedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `actors`
--

CREATE TABLE `actors` (
  `actor_id` int(11) NOT NULL,
  `actor_name` varchar(100) NOT NULL,
  `bio` text NOT NULL,
  `birth_year` year(4) NOT NULL,
  `photo_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `actors`
--

INSERT INTO `actors` (`actor_id`, `actor_name`, `bio`, `birth_year`, `photo_url`) VALUES
(1, 'Tim Robbins', 'American actor known for The Shawshank Redemption, Mystic River, and Bull Durham.', '1958', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRtjrFadKU-s5X9GlZ5amta5qOIFJ2kNSvtRJ2La3iZKC74DWjvmQdVCdF7l0bKEOBnE6nYkNaIq-olc-rsre1OJau2vWBKTbV9NPizmkOt&s=10'),
(2, 'Morgan Freeman', 'Academy Award–winning actor known for The Shawshank Redemption, Se7en, and Million Dollar Baby.', '1937', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTXFUKyeD81fgzcH2hi80dCX8MfEDHdN9Ch5_MVdgBQ5-FsVW8H9naJ51KW_QFBWbwntrWGCTpdtIsCcL6mSHJaxlHC429jCQzf2IP5y9cG&s=10'),
(3, 'Pedro Pascal', 'Chilean–American actor known for The Last of Us, The Mandalorian, and Weapons (2025).', '1975', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSciERbuNl8Jp7UjLzLvZpYb_81Scl5zHse7E2dCONwJR4dFn91mErSihwBvgZuGUcGGEWMxvAZcHVgoQYuz5alk3HJPwR8QcN2b5ECklG2&s=10'),
(4, 'Frances McDormand', 'Multi–Oscar–winning actress known for Nomadland, Fargo, and Three Billboards Outside Ebbing, Missouri.', '1957', 'https://encrypted-tbn0.gstatic.com/licensed-image?q=tbn:ANd9GcSwWcNkLlg0Zj_VkLhcbKMY_BnIIPeADdt92nvPvnj8mraHYNRV1_AUc9BLZ-lWMVfKo_Arfr6c--HmbHJaOCJTtgEm9azhGvmqkSzAuK1bwMvM8oYapxxo5iJux9ssicuWEEUknBFyT5UT&s=19'),
(5, 'Timothée Chalamet', 'American actor known for Dune, Wonka, and Call Me by Your Name.', '1995', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRI_fwtICKQr8RG4VL4deW_QkcfVTHHlDKYc6_skkIIFr_6stohODED9cT5P2yddWQy3rlgfT69LcfG3nTrf9RyIr7UAYWRZBhGb-omdLwN&s=10'),
(6, 'Zendaya', 'American actress and singer known for Euphoria, Spider–Man: No Way Home, and Dune.', '1996', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTFZahRzZG-KUAGYJFw03EMHfPhzDlpQusXnkpyOPpMiaoL56h7DXA4JAMMXwmRrfL9oh60CWHTa8W57BNo3XmPL8WJRoeE7gW_Pp0ZjIoYew&s=10'),
(7, 'Cillian Murphy', 'Irish actor known for Oppenheimer, Peaky Blinders, and Inception.', '1976', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTe29ERSG0A0_HCaOUDm_CEsGJz7m32i5xQlTPhf1BbwCV1P-4TfMfHE0DiERUsoHetA5A3P5PwI958iqnvm-eprfvn6j6b_PP7EGlqjki3BA&s=10'),
(8, 'Tom Holland', 'British actor best known for his role as Spider–Man in the Marvel Cinematic Universe.', '1996', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSN1ieRsKqXhVoJWhA2ca_sx0tPn0C_mtYiTmerYBINXGGfkaPEU4iV1xl6stOZ9STwxud7c1CzUstGWP8JMaCViQSSqjViGKEvGdOJQNjj&s=10'),
(9, 'Robert Pattinson', 'English actor known for The Batman, Tenet, and The Lighthouse.', '1986', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSbJkEjC3Lt8aJ49Bfa9DZNaQp_HuaeG-dQblJDCU-ec9GK4PU0Z_Sgy1_BxwZdXYAmyTumMq658sr_Juu2imP3F4nvIU7aKWIb2BdL9srWDA&s=10'),
(10, 'Michelle Yeoh', 'Malaysian actress known for Everything Everywhere All at Once, Crouching Tiger, Hidden Dragon, and Crazy Rich Asians.', '1962', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ1nul7PmQ0pW2VKPqpM8I9sU2rBJIx45rx-SeC2STI_73vNH20kTcrpfjySTJdieZkoiyeAhnpYzYG_VVZeYTkHyGA1afjqreZASxde1S-&s=10'),
(11, 'Margot Robbie', 'Australian actress known for Barbie, I, Tonya, and The Wolf of Wall Street.', '1990', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSM5fyhTyWkisU4rmdcZbhO5ecMfvQQwlMtTB1BcVFkPTmJxHStJpiAtNOiRtkAsYccQHQL53emtMbyeA_wIuC0jcihSZdLSfJGsRR4yHvq&s=10'),
(12, 'Ryan Gosling', 'Canadian actor known for Barbie, La La Land, and Drive.', '1980', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQSEPm8uVaoeWGRqYqKKmaPF0ceZiJbPbhRlugLiPOkctSlri5fxxUrESdNh-ORkbCvIEPkBYklvwZFxFPNOpe0u9hYAI4b_yuKiwLdiGlSxQ&s=10');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genre_id` int(11) NOT NULL,
  `genre_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`genre_id`, `genre_name`) VALUES
(1, 'Action'),
(2, 'Horror'),
(3, 'Sci-Fi'),
(4, 'Thriller'),
(5, 'Drama'),
(6, 'Romance'),
(7, 'Comedy'),
(8, 'Western'),
(9, 'Crime'),
(10, 'Adventure'),
(11, 'Animation'),
(12, 'Fantasy');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `release_year` year(4) NOT NULL,
  `director` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `trailer_source` varchar(255) NOT NULL,
  `movie_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `title`, `genre_id`, `release_year`, `director`, `description`, `trailer_source`, `movie_image`) VALUES
(1, 'The Shawshank Redemption', 5, '1994', 'Frank Darabont', 'Two imprisoned men bond over years, finding solace and eventual redemption through acts of common decency.', 'https://www.youtube.com/watch?v=NmzuHjWmXOc', 'https://m.media-amazon.com/images/M/MV5BMDAyY2FhYjctNDc5OS00MDNlLThiMGUtY2UxYWVkNGY2ZjljXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg'),
(2, 'Weapons', 2, '2025', 'Zach Cregger', 'When all but one child from the same class mysteriously vanish on the same night at exactly the same time, a community is left questioning who or what is behind their disappearance.', 'https://www.youtube.com/watch?v=OpThntO9ixc', 'https://m.media-amazon.com/images/M/MV5BNTBhNWJjZWItYzY3NS00M2NkLThmOWYtYTlmNzBmN2UxZWFjXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg'),
(3, 'Nomadland', 5, '2020', 'Chloé Zhao', 'After losing everything in the recession, Fern embarks on a journey across the American West living as a modern-day van-dweller.', 'https://www.youtube.com/watch?v=6sxCFZ8_d84', 'https://m.media-amazon.com/images/M/MV5BZjE3OTU3YTctMWRjOS00MTJiLWJjYWItYzJiMjk0OGQ3MTY0XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg'),
(4, 'Dune Part Two', 10, '2024', 'Denis Villeneuve', 'Continuing the journey of Paul Atreides as he unites with Chani and the Fremen to exact revenge and secure the future of Arrakis.', 'https://www.youtube.com/watch?v=Way9Dexny3w', 'https://m.media-amazon.com/images/M/MV5BNTc0YmQxMjEtODI5MC00NjFiLTlkMWUtOGQ5NjFmYWUyZGJhXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg'),
(5, 'Spider-Man Across the Spider-Verse', 11, '2023', 'Joaquim Dos Santos', 'Miles Morales returns for an epic, genre-bending adventure across the Multiverse where he encounters new heroes and villains that challenge his stay in Spider-Verse.', 'https://www.youtube.com/watch?v=shW9i6k8cB0', 'https://m.media-amazon.com/images/M/MV5BNThiZjA3MjItZGY5Ni00ZmJhLWEwN2EtOTBlYTA4Y2E0M2ZmXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg'),
(6, 'Oppenheimer', 5, '2023', 'Christopher Nolan', 'A dramatization of the life of J. Robert Oppenheimer and his role in the creation of the atomic bomb and the moral consequences thereafter.', 'https://www.youtube.com/watch?v=uYPbbksJxIg', 'https://m.media-amazon.com/images/M/MV5BM2RmYmVmMzctMzc5Ny00MmNiLTgxMGUtYjk1ZDRhYjA2YTU0XkEyXkFqcGc@._V1_.jpg'),
(7, 'Spider-Man No Way Home', 1, '2021', 'Jon Watts', 'Spider-Man’s identity is revealed, bringing his Mentor’s world into danger, forcing him to seek help from Doctor Strange and face multiple multiverse threats.', 'https://www.youtube.com/watch?v=JfVOs4VSpmA', 'https://m.media-amazon.com/images/M/MV5BMmFiZGZjMmEtMTA0Ni00MzA2LTljMTYtZGI2MGJmZWYzZTQ2XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg'),
(8, 'Dune Part One', 10, '2021', 'Denis Villeneuve', 'Paul Atreides and his family navigate political intrigue and ancient prophecies on the desert planet Arrakis to ensure humanity’s future.', 'https://www.youtube.com/watch?v=n9xhJrPXop4', 'https://m.media-amazon.com/images/M/MV5BNWIyNmU5MGYtZDZmNi00ZjAwLWJlYjgtZTc0ZGIxMDE4ZGYwXkEyXkFqcGc@._V1_.jpg'),
(9, 'Top Gun Maverick', 1, '2022', 'Joseph Kosinski', 'Thirty years after the original, Maverick is a test pilot facing a new generation of danger and must train elite Top Gun graduates for a mission nobody else can handle.', 'https://www.youtube.com/watch?v=qSqVVswa420', 'https://m.media-amazon.com/images/M/MV5BMDBkZDNjMWEtOTdmMi00NmExLTg5MmMtNTFlYTJlNWY5YTdmXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg'),
(10, 'The Batman', 9, '2022', 'Matt Reeves', 'In his second year of fighting crime, Batman uncovers corruption in Gotham City while facing a mysterious killer known as The Riddler.', 'https://www.youtube.com/watch?v=mqqft2x_Aa4', 'https://m.media-amazon.com/images/M/MV5BMmU5NGJlMzAtMGNmOC00YjJjLTgyMzUtNjAyYmE4Njg5YWMyXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg'),
(11, 'Everything Everywhere All At Once', 7, '2022', 'Daniel Kwan & Daniel Scheinert', 'A laundromat owner gets swept into a multiversal adventure where she must connect with versions of herself from infinite realities to stop a powerful threat.', 'https://www.youtube.com/watch?v=wxN1T1uxQ2g', 'https://m.media-amazon.com/images/M/MV5BODQ4ZjdhNTYtYTQ3Mi00Mjk1LWFjYTgtMjY4ZWU4YmVkMjkyXkEyXkFqcGc@._V1_.jpg'),
(12, 'Barbie', 12, '2023', 'Greta Gerwig', 'When Barbie gets a sudden existential crisis in Barbie Land, she ventures into the real world to understand her purpose and empower herself.', 'https://www.youtube.com/watch?v=pBk4NYhWNMM', 'https://m.media-amazon.com/images/M/MV5BYjI3NDU0ZGYtYjA2YS00Y2RlLTgwZDAtYTE2YTM5ZjE1M2JlXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg'),
(13, 'Titanic', 6, '1997', 'James Cameron', 'A seventeen-year-old aristocrat falls in love with a kind but poor artist aboard the luxurious, ill-fated R.M.S. Titanic.', 'https://www.youtube.com/watch?v=kVrqfYjkTdQ', 'https://m.media-amazon.com/images/M/MV5BYzYyN2FiZmUtYWYzMy00MzViLWJkZTMtOGY1ZjgzNWMwN2YxXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `movie_actors`
--

CREATE TABLE `movie_actors` (
  `movie_id` int(11) NOT NULL,
  `actor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie_actors`
--

INSERT INTO `movie_actors` (`movie_id`, `actor_id`) VALUES
(1, 1),
(2, 3),
(3, 4),
(4, 5),
(4, 6),
(6, 7),
(7, 8),
(7, 6),
(8, 5),
(10, 9),
(11, 10),
(12, 11),
(12, 12),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `play_history`
--

CREATE TABLE `play_history` (
  `history_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `last_watched` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `play_history`
--

INSERT INTO `play_history` (`history_id`, `user_id`, `movie_id`, `last_watched`) VALUES
(1, 1, 2, '2025-11-14'),
(2, 1, 4, '2025-11-14'),
(3, 1, 10, '2025-11-14'),
(7, 2, 2, '2025-11-20'),
(8, 2, 2, '2025-11-20');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review_text` text NOT NULL,
  `rating` decimal(3,1) NOT NULL,
  `review_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `movie_id`, `user_id`, `review_text`, `rating`, `review_date`) VALUES
(1, 12, 1, 'amazing', 4.0, '2025-11-14'),
(2, 8, 1, 'bad', 1.0, '2025-11-14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `join_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `join_date`) VALUES
(1, 'test', '$2y$10$.Oc1D4bTbcGuCibTRsXan.s06Zrpp7y6rF1tZtqWiEFNKtkiugDrq', '2025-11-14'),
(2, 'tester', '$2y$10$nPaBp9bm7l3v4/XHlF/Nzu4dhsh.bTlpKrW3nCQaS2pvAEZtqsUpC', '2025-11-14');

-- --------------------------------------------------------

--
-- Table structure for table `watchlists`
--

CREATE TABLE `watchlists` (
  `watchlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `watchlists`
--

INSERT INTO `watchlists` (`watchlist_id`, `user_id`, `movie_id`, `date_added`) VALUES
(20, 2, 2, '2025-11-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`actor_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Indexes for table `movie_actors`
--
ALTER TABLE `movie_actors`
  ADD KEY `actor_id` (`actor_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `play_history`
--
ALTER TABLE `play_history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `user_id` (`user_id`,`movie_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `watchlists`
--
ALTER TABLE `watchlists`
  ADD PRIMARY KEY (`watchlist_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actors`
--
ALTER TABLE `actors`
  MODIFY `actor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `play_history`
--
ALTER TABLE `play_history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `watchlists`
--
ALTER TABLE `watchlists`
  MODIFY `watchlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`genre_id`);

--
-- Constraints for table `movie_actors`
--
ALTER TABLE `movie_actors`
  ADD CONSTRAINT `movie_actors_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`),
  ADD CONSTRAINT `movie_actors_ibfk_2` FOREIGN KEY (`actor_id`) REFERENCES `actors` (`actor_id`);

--
-- Constraints for table `play_history`
--
ALTER TABLE `play_history`
  ADD CONSTRAINT `play_history_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`),
  ADD CONSTRAINT `play_history_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `watchlists`
--
ALTER TABLE `watchlists`
  ADD CONSTRAINT `watchlists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `watchlists_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
