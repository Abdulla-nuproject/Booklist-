-- create database and tables, together with user data, for xml book lists - rss/xml assignment

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------

--
-- Table structure for table 'saved_books' 
--

DROP TABLE IF EXISTS `saved_books`;
CREATE TABLE IF NOT EXISTS `saved_books` (
  `bookID` varchar(16) NOT NULL,
  `memberID` mediumint(8) NOT NULL,
  `bookTitle` varchar(255) NOT NULL,
  `author` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `link` varchar(255) NOT NULL,
  `yearPublished` char(4) NOT NULL,
  `dateSaved` datetime NOT NULL,
  PRIMARY KEY  (`bookID`, `memberID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `memberID` mediumint(8) NOT NULL auto_increment,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lastLogin` datetime NOT NULL,
  PRIMARY KEY  (`memberID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
--
-- Data for table `members`
--
-- NOTE that the password field uses encryption, the passwords for each user is set to
-- the users FIRST NAME (in lowercase) then converted using the PHP password_hash function.
-- When logging in you'll need to use another password function to verify the password.


INSERT INTO `members` (`email`, `name`, `password`, `lastLogin`) VALUES
('peter@xml6034.com', 'Peter Jones', '$2y$10$Z0P0bDp0eLWyF623/UbwBuAm2lsD2hflJbyCrXE4tZp1PLAcZgrUe', null),
('fred@xml6034.com', 'Fred Smith', '$2y$10$2TkEtrnoGmPylIO15CBzKuYNhNYilg3vYxYVEBA9wGfzDgASO6Dxq', null),
('susan@xml6034.com', 'Susan Davis', '$2y$10$nxeZdoqCw0G0UoK3yKIVB.v.2jVm5ttKWckLPHhr8tU9xC/fvKb5e', null);

--
-- Constraints for table `saved_books`
--
ALTER TABLE `saved_books`
  ADD CONSTRAINT `books_fk_1` FOREIGN KEY (`memberID`) REFERENCES `members` (`memberID`);



