-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2013 at 02:54 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `education`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) DEFAULT NULL,
  `username` varchar(80) DEFAULT NULL,
  `password` varchar(80) DEFAULT NULL,
  `fname` varchar(40) DEFAULT NULL,
  `lname` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`tid`, `type`, `username`, `password`, `fname`, `lname`) VALUES
(1, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'User'),
(2, 2, 'su', '0b180078d994cb2b5ed89d7ce8e7eea2', 'Super', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE IF NOT EXISTS `advertisements` (
  `adID` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(80) DEFAULT NULL,
  `npID` tinyint(4) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `cols` int(11) DEFAULT NULL,
  `cms` int(11) DEFAULT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `rate` int(11) DEFAULT NULL,
  `article` varchar(80) DEFAULT NULL,
  `matter` text,
  `delStatus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`adID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`adID`, `location`, `npID`, `subject`, `cols`, `cms`, `date`, `rate`, `article`, `matter`, `delStatus`) VALUES
(1, 'Trivandrum2', 1, 'New Course Arrived2', 2, 2, '2013-06-07', 2000, '1370517192_avatar.png', 'ksdjfbsdjkvbfasjdfn;askjdfng;adksjnk;', 0);

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE IF NOT EXISTS `branches` (
  `branchID` int(11) NOT NULL AUTO_INCREMENT,
  `branch` varchar(80) DEFAULT NULL,
  `delStatus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`branchID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branchID`, `branch`, `delStatus`) VALUES
(1, 'Trivandrum', 0),
(2, 'Cochin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comID` int(11) NOT NULL AUTO_INCREMENT,
  `postID` int(11) DEFAULT NULL,
  `comment` text,
  `empID` int(11) DEFAULT '0',
  `email` varchar(80) DEFAULT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `time` varchar(8) NOT NULL DEFAULT '00:00:00',
  `delStatus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comID`, `postID`, `comment`, `empID`, `email`, `date`, `time`, `delStatus`) VALUES
(1, 1, 'Bloc is project and exercise oriented. We give you exercises and reading, and you tie these concepts into a personal project that you''ll be working on throughout the course.', 3, 'user@riya.travel', '2013-05-30', '12:21:34', 0),
(2, 1, 'Bloc''s curriculum is structured. We have an opinion about the order in which you should learn a topic, and we have you stick to that. ', 3, 'user@riya.travel', '2013-05-30', '12:28:01', 0),
(3, 1, 'As a Bloc student you have the ability to book 1-on-1 time with any mentor on our staff. There is no limit to amount of time that you can book.', 3, 'user@riya.travel', '2013-05-30', '12:28:14', 0),
(4, 1, 'We''ll provide you with a full refund if you drop out within the first week. If you drop out after the first week, we''ll stop all subsequent charges and revoke your access once that 2-week cycle is finished.', 3, 'user@riya.travel', '2013-05-30', '12:28:19', 0),
(5, 1, 'dethsrt', 3, 'user@riya.travel', '2013-06-15', '12:07:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `conID` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(50) DEFAULT NULL,
  `delStatus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`conID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`conID`, `country`, `delStatus`) VALUES
(1, 'Australia', 0),
(2, 'Canada', 0),
(3, 'New Zealand', 0),
(4, 'Singapore', 0),
(5, 'Switzerland', 0),
(6, 'United Kingdom', 0);

-- --------------------------------------------------------

--
-- Table structure for table `country-program`
--

CREATE TABLE IF NOT EXISTS `country-program` (
  `cpID` int(11) NOT NULL AUTO_INCREMENT,
  `conID` tinyint(4) DEFAULT NULL,
  `pgmID` tinyint(4) DEFAULT NULL,
  `delStatus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cpID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `country-program`
--

INSERT INTO `country-program` (`cpID`, `conID`, `pgmID`, `delStatus`) VALUES
(1, 3, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `deptID` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`deptID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`deptID`, `department`) VALUES
(1, 'Counselling'),
(2, 'Documentation'),
(3, 'Sales'),
(4, 'Visa');

-- --------------------------------------------------------

--
-- Table structure for table `document_list`
--

CREATE TABLE IF NOT EXISTS `document_list` (
  `docID` int(11) NOT NULL AUTO_INCREMENT,
  `document` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`docID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `document_list`
--

INSERT INTO `document_list` (`docID`, `document`) VALUES
(1, '10th & 12th Mark List'),
(2, 'Bachelor''s Degree'),
(3, 'Diploma Certificate'),
(4, 'Master''s Degree'),
(5, 'Passport Copy'),
(6, 'Academic/Work Reference Letter'),
(7, 'Experience Certificate'),
(8, 'Statement of Purpose'),
(9, 'Copies of IELTS'),
(10, 'Bank Statement');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `empID` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `branchID` tinyint(4) DEFAULT NULL,
  `deptID` tinyint(4) DEFAULT NULL,
  `designation` varchar(30) DEFAULT NULL,
  `gender` varchar(1) NOT NULL DEFAULT '0',
  `fname` varchar(40) DEFAULT NULL,
  `lname` varchar(40) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(80) DEFAULT NULL,
  `confirm` varchar(80) DEFAULT NULL,
  `dob` date NOT NULL DEFAULT '0000-00-00',
  `photo` varchar(80) DEFAULT NULL,
  `areaCode` varchar(5) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `conCode` varchar(5) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `skype` varchar(80) DEFAULT NULL,
  `gtalk` varchar(80) DEFAULT NULL,
  `holdStatus` tinyint(4) DEFAULT '0',
  `delStatus` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`empID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`empID`, `date`, `branchID`, `deptID`, `designation`, `gender`, `fname`, `lname`, `username`, `password`, `confirm`, `dob`, `photo`, `areaCode`, `phone`, `conCode`, `mobile`, `email`, `skype`, `gtalk`, `holdStatus`, `delStatus`) VALUES
(1, '2013-05-23', 1, 2, 'Doc Officer', '1', 'Docmtn', 'User', 'dd', '1aabac6d068eef6a7bad3fdf50a05cc8', '1aabac6d068eef6a7bad3fdf50a05cc8', '1990-05-12', '1369467177_pass1.jpg', '0471', '2456335', '91', '9878986545', 'test@email.com', NULL, NULL, 0, 0),
(2, '2013-05-23', 1, 4, 'Technical Staff', '1', 'Visa', 'User', 'vd', '8f7d15a8d28ec153835ef4bfc428d5e4', '8f7d15a8d28ec153835ef4bfc428d5e4', '1985-07-12', '1370243157_pass1.jpg', '0471', '405201', '91', '9946206206', 'vivek.sahu@riya.travel', NULL, NULL, 0, 0),
(3, '2013-05-23', 1, 1, 'Counsellor', '1', 'Counsellor', 'Trv', 'cd_trv', '6865aeb3a9ed28f9a79ec454b259e5d0', '6865aeb3a9ed28f9a79ec454b259e5d0', '1985-07-12', '1369472155_tvmuser.png', '0471', '4521323', '91', '9865465465', 'tvm_user@riya.travel', NULL, NULL, 0, 0),
(4, '2013-05-23', 2, 1, 'Counsellor', '1', 'Counsellor', 'Cok', 'cd_cok', '6865aeb3a9ed28f9a79ec454b259e5d0', '6865aeb3a9ed28f9a79ec454b259e5d0', '1982-01-01', '1371414104_1369467878_Pass2.jpg', '0471', '2464646', '91', '9865464546', 'cok_user@email.com', NULL, NULL, 0, 0),
(5, '2013-06-22', 2, 3, 'Sales Officer', '1', 'Sales', 'User', 'sd', '6226f7cbe59e99a90b5cef6f94f966fd', '6226f7cbe59e99a90b5cef6f94f966fd', '1975-06-18', '1371881446_Pass2.jpg', '0471', '4053122', '91', '9865464654', 'sales@gmail.com', 'sales@gmail.com', 'sales@gmail.com', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE IF NOT EXISTS `enquiries` (
  `enqID` int(11) NOT NULL AUTO_INCREMENT,
  `empID` int(11) DEFAULT NULL,
  `country` tinyint(4) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `studName` varchar(80) DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `program` varchar(150) DEFAULT NULL,
  `marks` tinyint(4) DEFAULT NULL,
  `class` tinyint(4) DEFAULT NULL,
  `bScore` decimal(2,1) DEFAULT NULL,
  `remarks` text,
  `allocated` tinyint(4) NOT NULL DEFAULT '0',
  `allocatedStaff` tinyint(4) DEFAULT NULL,
  `delStatus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`enqID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`enqID`, `empID`, `country`, `level`, `date`, `studName`, `contact`, `program`, `marks`, `class`, `bScore`, `remarks`, `allocated`, `allocatedStaff`, `delStatus`) VALUES
(1, 3, 3, 'Under Graduate', '2013-06-26', 'Ratheesh S', '9895685954', 'MBA in Marketing', 88, 2, 6.2, 'Inquired about Other NZ programs also.', 1, 3, 0),
(2, 3, 1, 'Post Graduate', '2013-06-26', 'Laxmi Rajeev', '9864613264', 'PG Diploma in Commerce', 0, 0, 6.7, 'Reference from Riya Employee - Arun', 1, 4, 0),
(3, 3, 3, 'Post Graduate', '2013-07-02', 'Ravi Shanker', '9865458964', 'Masters in Computer', 0, 0, 0.0, 'Enquiry about the fees and intake of  some Universities in NZ', 0, NULL, 0),
(4, 3, 3, 'Post Graduate', '2013-07-04', 'Rakesh', '9864613264', 'Master of Arts in Economics', 0, 0, 6.8, 'Call the student on July 06th', 1, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `eventID` int(11) NOT NULL AUTO_INCREMENT,
  `eventType` tinyint(4) DEFAULT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `empID` int(11) DEFAULT NULL,
  `branchID` tinyint(4) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `eventDate` date NOT NULL DEFAULT '0000-00-00',
  `eventTime` varchar(20) DEFAULT NULL,
  `delegates` varchar(255) DEFAULT NULL,
  `staffID` tinyint(4) DEFAULT NULL,
  `staffs` varchar(255) DEFAULT NULL,
  `session` tinyint(4) DEFAULT NULL,
  `duration` decimal(2,0) DEFAULT NULL,
  `expNum` varchar(10) DEFAULT NULL,
  `quest1` text,
  `quest2` text,
  `quest3` text,
  `quest4` text,
  `remarks` text,
  `acceptStatus` tinyint(4) NOT NULL DEFAULT '0',
  `comStatus` tinyint(4) NOT NULL DEFAULT '0',
  `delStatus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`eventID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventID`, `eventType`, `date`, `empID`, `branchID`, `title`, `eventDate`, `eventTime`, `delegates`, `staffID`, `staffs`, `session`, `duration`, `expNum`, `quest1`, `quest2`, `quest3`, `quest4`, `remarks`, `acceptStatus`, `comStatus`, `delStatus`) VALUES
(1, 0, '2013-06-12', 3, 1, 'Title of the Seminar', '2013-06-19', '03:00 PM - 04:00 PM', 'del1,del2,del3', 3, 'stf1,stf2', 1, 1, 'Above 100', 'Describe your target audience. Who is likely to attend?', 'Is there any specific topic you would like to address in the Seminar?', 'What are your hope for this Seminar?', 'What type of publicity will you use?', 'Remarks (if any)', 0, 0, 0),
(2, 1, '2013-06-14', 3, 1, 'Mathrubhumi Fair', '2013-06-29', '09:30 AM - 05:30 PM', 'Ravi Shanker,Raj Kumar', 3, 'Mahesh', 2, 3, 'Not Sure', 'Describe your target audience. Who is likely to attend?', 'Is there any specific topic you would like to address in the Seminar?', 'What are your hope for this Seminar?', 'What type of publicity will you use?', 'Describe your target audience. Who is likely to attend? Is there any specific topic you would like to address in the Seminar? What are your hope for this Seminar? What type of publicity will you use?', 0, 0, 0),
(3, 0, '2013-06-26', 3, 1, 'Colloquium 2013', '2013-07-01', '10:30 AM - 11:30 AM', 'Chandrashekar,Shyamlal', 3, 'Abhinav', 1, 1, 'Above 100', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English.', 0, 0, 0),
(4, 1, '2013-06-26', 3, 1, 'Illuminati 2013', '2013-07-05', '11:00 AM - 02:30 PM', 'Anil Kumar', 3, 'Arun Kumar', 2, 1, 'Not Sure', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable.', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable.', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable.', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable.', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable.', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `event_centre`
--

CREATE TABLE IF NOT EXISTS `event_centre` (
  `orgID` int(11) NOT NULL AUTO_INCREMENT,
  `eventID` int(11) DEFAULT NULL,
  `eventCentre` varchar(255) DEFAULT NULL,
  `organizer` varchar(255) DEFAULT NULL,
  `addr1` varchar(150) DEFAULT NULL,
  `addr2` varchar(150) DEFAULT NULL,
  `city` varchar(80) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `pincode` int(11) DEFAULT NULL,
  `conPerson` varchar(80) DEFAULT NULL,
  `conEmail` varchar(80) DEFAULT NULL,
  `conNumber` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`orgID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `event_centre`
--

INSERT INTO `event_centre` (`orgID`, `eventID`, `eventCentre`, `organizer`, `addr1`, `addr2`, `city`, `state`, `pincode`, `conPerson`, `conEmail`, `conNumber`) VALUES
(1, 1, 'MIR College', '', 'sdjfhkj', 'sdfkj', 'city', '10', 789768, 'person', 'test@email.com', '9809856482'),
(2, 2, 'Museum', 'Mathrubhumi', 'Museum Campus', 'Trivandrum', 'Trivandrum', '10', 695458, 'Kapil', 'test@email.com', '9854564564'),
(3, 3, 'Maharajas College', '', 'Maharajas College', 'Vazhuthacaud', 'Trivandrum', '10', 695504, 'Varghese', 'varghese@email.com', '+91 9865458621'),
(4, 4, 'Mohandas Engineering College', 'Pvt. College Association', 'Anad P O', 'Nedumangad', 'Trivandrum', '10', 695458, 'Sreejith', 'sreejith@email.com', '+91 9865458621');

-- --------------------------------------------------------

--
-- Table structure for table `event_cost`
--

CREATE TABLE IF NOT EXISTS `event_cost` (
  `costID` int(11) NOT NULL AUTO_INCREMENT,
  `eventID` int(11) DEFAULT NULL,
  `basicCost` int(11) DEFAULT NULL,
  `amounts` varchar(255) DEFAULT NULL,
  `particulars` varchar(255) DEFAULT NULL,
  `avUnits` varchar(30) DEFAULT NULL,
  `avOthers` varchar(80) DEFAULT NULL,
  `meals` varchar(30) DEFAULT NULL,
  `accomodation` varchar(30) DEFAULT NULL,
  `transportation` varchar(30) DEFAULT NULL,
  `transOthers` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`costID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `event_cost`
--

INSERT INTO `event_cost` (`costID`, `eventID`, `basicCost`, `amounts`, `particulars`, `avUnits`, `avOthers`, `meals`, `accomodation`, `transportation`, `transOthers`) VALUES
(1, 1, 5000, '3000,1500,500', 'Venue,Student Database,Others', '1,4,2', 'AV Others', '1,3,4', '2', '4,2,5', 'trans others'),
(2, 2, 12000, '10000,2000', 'Venue,Flex', '1,4,2', 'av others', '1', '', '2', 'trans others'),
(3, 3, 10000, '7500,2500', 'Venue,Student Database', '1,4,2,5', '', '', '', '2', ''),
(4, 4, 15000, '10000,3000,2000', 'Venue,Student Database,Others', '1,4,2,5', 'AV Others', '1,3', '', '2,5', 'Trans Others');

-- --------------------------------------------------------

--
-- Table structure for table `event_feedback`
--

CREATE TABLE IF NOT EXISTS `event_feedback` (
  `fbID` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `eventID` int(11) DEFAULT NULL,
  `attendees` int(11) DEFAULT NULL,
  `venueArrange` tinyint(4) DEFAULT NULL,
  `venueRating` tinyint(4) DEFAULT NULL,
  `eventExpMet` tinyint(4) DEFAULT NULL,
  `eventRating` tinyint(4) DEFAULT NULL,
  `dbCollected` int(11) DEFAULT NULL,
  `overallCmnts` text,
  `comntRating` tinyint(4) DEFAULT NULL,
  `availTrans` varchar(50) DEFAULT NULL,
  `availAmts` varchar(100) DEFAULT NULL,
  `vehicle` varchar(10) DEFAULT NULL,
  `carType` varchar(10) DEFAULT NULL,
  `transOthers` varchar(150) DEFAULT NULL,
  `otherCost` int(11) DEFAULT NULL,
  `availAcco` varchar(20) DEFAULT NULL,
  `roomType` tinyint(4) DEFAULT NULL,
  `food` tinyint(4) NOT NULL DEFAULT '0',
  `accoRate` int(11) DEFAULT NULL,
  `overallRating` decimal(2,1) DEFAULT NULL,
  `grandTotal` int(11) DEFAULT NULL,
  PRIMARY KEY (`fbID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `event_feedback`
--

INSERT INTO `event_feedback` (`fbID`, `date`, `eventID`, `attendees`, `venueArrange`, `venueRating`, `eventExpMet`, `eventRating`, `dbCollected`, `overallCmnts`, `comntRating`, `availTrans`, `availAmts`, `vehicle`, `carType`, `transOthers`, `otherCost`, `availAcco`, `roomType`, `food`, `accoRate`, `overallRating`, `grandTotal`) VALUES
(1, '2013-06-14', 2, 222, 1, 8, 1, 8, 80, 'Describe your target audience. Who is likely to attend? Is there any specific topic you would like to address in the Seminar? What are your hope for this Seminar? What type of publicity will you use?', 8, '2,5', ',,500,,150,', 'Owned', 'Diesel', '', 0, 'Single Room', 2, 0, 500, 8.0, 13150);

-- --------------------------------------------------------

--
-- Table structure for table `follow_up`
--

CREATE TABLE IF NOT EXISTS `follow_up` (
  `fwID` int(11) NOT NULL AUTO_INCREMENT,
  `empID` int(11) DEFAULT NULL,
  `studID` int(11) DEFAULT NULL,
  `response` tinyint(4) NOT NULL DEFAULT '0',
  `notes` text,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `time` varchar(10) NOT NULL DEFAULT '00:00:00',
  `delStatus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fwID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `follow_up`
--

INSERT INTO `follow_up` (`fwID`, `empID`, `studID`, `response`, `notes`, `date`, `time`, `delStatus`) VALUES
(1, 3, 1, 0, 'This is a test message!', '2013-05-28', '15:43:03', 0),
(2, 3, 1, 1, 'This is a second message!', '2013-05-28', '15:44:18', 0),
(3, 3, 1, 0, 'This is the third message...\r\n', '2013-05-28', '15:52:33', 0),
(4, 3, 1, 1, 'Want an interactive website? Wouldn''t it be nice if the readers of a website could leave comments, tips or impressions about the site or a specific article? With blogs, they can! Posting comments is one of the most exciting features of blogs.', '2013-05-28', '17:04:12', 0),
(5, 3, 1, 0, 'A blog is also a good way to keep track of articles on a site. A lot of blogs feature an archive based on dates (like a monthly or yearly archive). The front page of a blog may feature a calendar of dates linked to daily archives. Archives can also be based on categories featuring all the articles related to a specific category.', '2013-05-28', '17:13:48', 0),
(6, 3, 1, 0, 'It does not stop there; you can also archive your posts by author or alphabetically. The possibilities are endless. This ability to organize and present articles in a composed fashion is much of what makes blogging a popular personal publishing tool.', '2013-05-28', '17:14:05', 0),
(7, 3, 1, 1, 'Person A writes something on their blog.', '2013-05-28', '17:15:02', 0),
(8, 3, 1, 0, 'Person B wants to comment on Person A''s blog, but wants her own readers to see what she had to say, and be able to comment on her own blog', '2013-05-28', '17:15:13', 0),
(9, 3, 1, 1, 'Person B posts on her own blog and sends a trackback to Person A''s blog', '2013-05-28', '17:15:21', 0),
(10, 3, 1, 0, 'Person A''s blog receives the trackback, and displays it as a comment to the original post. This comment contains a link to Person B''s post', '2013-05-28', '17:15:29', 0),
(11, 3, 1, 0, 'To enable trackbacks and pingbacks, in the Disscussion Settings of your Administration Panels, select these items under ''Default article settings', '2013-05-28', '17:25:56', 0),
(12, 3, 1, 0, 'In contrast, here is a well-structured, "Pretty" Permalink which could link to the same article, once the installation is configured to modify permalinks:', '2013-05-28', '17:26:15', 0),
(13, 3, 2, 0, 'Student Joined on June 25th', '2013-06-25', '15:19:57', 0),
(14, 4, 2, 0, 'Assigned to COK', '2013-06-25', '15:22:57', 0),
(15, 3, 1, 0, 'Disscussion Settings of your Administration Panels, select these items under ''Default article settings', '2013-06-25', '19:00:52', 0),
(16, 3, 1, 1, 'This ability to organize and present articles in a composed fashion is much of what makes blogging a popular personal publishing tool.', '2013-06-25', '19:01:11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE IF NOT EXISTS `forums` (
  `subID` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) DEFAULT NULL,
  `empID` int(11) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `time` varchar(10) DEFAULT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  `dislikes` int(11) NOT NULL DEFAULT '0',
  `anonymous` int(11) DEFAULT NULL,
  `delStatus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`subID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `forums`
--

INSERT INTO `forums` (`subID`, `subject`, `empID`, `email`, `date`, `time`, `likes`, `dislikes`, `anonymous`, `delStatus`) VALUES
(1, 'Why should I take this course as opposed to trying to work through books or tutorials?', 3, 'user@riya.travel', '2013-06-12', '17:15:50', 3, 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `forum_comments`
--

CREATE TABLE IF NOT EXISTS `forum_comments` (
  `comID` int(11) NOT NULL AUTO_INCREMENT,
  `subID` int(11) DEFAULT NULL,
  `comment` text,
  `empID` int(11) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `time` varchar(10) DEFAULT NULL,
  `delStatus` tinyint(4) NOT NULL DEFAULT '0',
  `interest` tinyint(4) NOT NULL DEFAULT '0',
  `anonymous` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `forum_comments`
--

INSERT INTO `forum_comments` (`comID`, `subID`, `comment`, `empID`, `email`, `date`, `time`, `delStatus`, `interest`, `anonymous`) VALUES
(1, 1, 'google google', 1, 'eshdgf@email.com', '2013-06-17', '10:58:35', 0, 1, 1),
(2, 1, 'Bloc is project and exercise oriented. We give you exercises and reading, and you tie these concepts into a personal project that you''ll be working on throughout the course.', 4, 'cok_user@email.com', '2013-06-17', '12:58:25', 0, 0, 0),
(3, 1, 'Bloc''s curriculum is structured. We have an opinion about the order in which you should learn a topic, and we have you stick to that. ', 3, 'tvm_user@riya.travel', '2013-06-17', '12:59:13', 0, 0, 0),
(4, 1, 'As a Bloc student you have the ability to book 1-on-1 time with any mentor on our staff. There is no limit to amount of time that you can book.', 3, 'tvm_user@riya.travel', '2013-06-17', '15:11:02', 0, 0, 1),
(5, 1, 'We''ll provide you with a full refund if you drop out within the first week. If you drop out after the first week, we''ll stop all subsequent charges and revoke your access once that 2-week cycle is finished.', 2, 'cok_user@email.com', '2013-06-17', '15:12:12', 0, 0, 0),
(6, 1, 'drgsdrgt', 3, 'tvm_user@riya.travel', '2013-07-02', '15:23:49', 0, 0, 0),
(7, 1, 'asdfsdgdfgj yukoyuioty tyu tryurtyu', 3, 'tvm_user@riya.travel', '2013-07-02', '15:24:23', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ielts_centres`
--

CREATE TABLE IF NOT EXISTS `ielts_centres` (
  `centreID` int(11) NOT NULL AUTO_INCREMENT,
  `centreName` varchar(150) DEFAULT NULL,
  `referID` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`centreID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ielts_centres`
--

INSERT INTO `ielts_centres` (`centreID`, `centreName`, `referID`) VALUES
(1, 'Centre 1', NULL),
(2, 'Centre 2', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `institutions`
--

CREATE TABLE IF NOT EXISTS `institutions` (
  `insID` int(11) NOT NULL AUTO_INCREMENT,
  `conID` tinyint(4) NOT NULL,
  `institution` varchar(255) DEFAULT NULL,
  `insType` tinyint(4) DEFAULT NULL,
  `delStatus` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`insID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=186 ;

--
-- Dumping data for table `institutions`
--

INSERT INTO `institutions` (`insID`, `conID`, `institution`, `insType`, `delStatus`) VALUES
(1, 1, 'Australian Catholic University', 1, 0),
(2, 1, 'Australian National University', 1, 0),
(3, 1, 'Bond University', 1, 0),
(4, 1, 'Central Queensland University', 1, 0),
(5, 1, 'Charles Darwin University', 1, 0),
(6, 1, 'Charles Sturt University', 1, 0),
(7, 1, 'Curtin University of Technology', 1, 0),
(8, 1, 'Deakin University', 1, 0),
(9, 1, 'Edith Cowan University', 1, 0),
(10, 1, 'Flinders University', 1, 0),
(11, 1, 'Griffith University', 1, 0),
(12, 1, 'James Cook University', 1, 0),
(13, 1, 'La Trobe University', 1, 0),
(14, 1, 'Macquarie University', 1, 0),
(15, 1, 'Monash University', 1, 0),
(16, 1, 'Murdoch University', 1, 0),
(17, 1, 'Queensland University of Technology', 1, 0),
(18, 1, 'RMIT University', 1, 0),
(19, 1, 'Southern Cross University', 1, 0),
(20, 1, 'Swinburne University of Technology', 1, 0),
(21, 1, 'University of Adelaide', 1, 0),
(22, 1, 'University of Ballarat', 1, 0),
(23, 1, 'University of Canberra', 1, 0),
(24, 1, 'University of Melbourne', 1, 0),
(25, 1, 'University of New England', 1, 0),
(26, 1, 'University of New South Wales', 1, 0),
(27, 1, 'University of Newcastle', 1, 0),
(28, 1, 'University of Notre Dame', 1, 0),
(29, 1, 'University of Queensland', 1, 0),
(30, 1, 'University of South Australia', 1, 0),
(31, 1, 'University of Southern Queensland', 1, 0),
(32, 1, 'University of Sydney', 1, 0),
(33, 1, 'University of Tasmania', 1, 0),
(34, 1, 'University of Technology Sydney', 1, 0),
(35, 1, 'University of the Sunshine Coast', 1, 0),
(36, 1, 'University of Western Australia', 1, 0),
(37, 1, 'University of Western Sydney', 1, 0),
(38, 1, 'University of Wollongong', 1, 0),
(39, 1, 'Victoria University', 1, 0),
(40, 2, 'Carleton University', 1, 0),
(41, 2, 'Concordia University', 1, 0),
(42, 2, 'Dalhousie University', 1, 0),
(43, 2, 'Fairleigh Dickinson University', 1, 0),
(44, 2, 'Grant MacEwan University', 1, 0),
(45, 2, 'Mc Gill University', 1, 0),
(46, 2, 'Mc Master University', 1, 0),
(47, 2, 'Memorial University of Newfoundland', 1, 0),
(48, 2, 'Royal Roads University', 1, 0),
(49, 2, 'Ryerson University', 1, 0),
(50, 2, 'Simon Fraser University', 1, 0),
(51, 2, 'Thompson Rivers University', 1, 0),
(52, 2, 'University of Alberta', 1, 0),
(53, 2, 'University of British Columbia', 1, 0),
(54, 2, 'University of Calgary', 1, 0),
(55, 2, 'University of Guelph', 1, 0),
(56, 2, 'University of Lethbridge', 1, 0),
(57, 2, 'University of Manitoba', 1, 0),
(58, 2, 'University of Ottawa', 1, 0),
(59, 2, 'University of Prince Edward Island', 1, 0),
(60, 2, 'University of Saskatchewan', 1, 0),
(61, 2, 'University of Sherbrooke', 1, 0),
(62, 2, 'University of Toronto', 1, 0),
(63, 2, 'University of Victoria', 1, 0),
(64, 2, 'University of Waterloo', 1, 0),
(65, 2, 'University of Western Ontario', 1, 0),
(66, 2, 'Vancouver Island University', 1, 0),
(67, 2, 'York University', 1, 0),
(68, 2, 'Kwantlen Polytechnic University', 1, 0),
(69, 2, 'Algonquin College', 2, 0),
(70, 2, 'Bow Valley College', 2, 0),
(71, 2, 'Cambrian College of Applied Arts & Technology', 2, 0),
(72, 2, 'Camosun College', 2, 0),
(73, 2, 'Centennial College of Applied Arts & Technology', 2, 0),
(74, 2, 'College of New Caledonia', 2, 0),
(75, 2, 'College of the Rockies', 2, 0),
(76, 2, 'Columbia College', 2, 0),
(77, 2, 'Conestoga College', 2, 0),
(78, 2, 'Confederation College of Applied Arts & Technology', 2, 0),
(79, 2, 'Douglas College', 2, 0),
(80, 2, 'Durham College', 2, 0),
(81, 2, 'Fanshawe College of Applied Arts & Technology', 2, 0),
(82, 2, 'George Brown College', 2, 0),
(83, 2, 'Georgian College of Applied Arts & Technology', 2, 0),
(84, 2, 'Humber College Institute of Tech & Advanced Learning', 2, 0),
(85, 2, 'Lambton College of Applied Arts & Technology', 2, 0),
(86, 2, 'Loyalist College of Applied Arts & Technology', 2, 0),
(87, 2, 'Medicine Hat College', 2, 0),
(88, 2, 'Mohawk College of Applied Arts & Technology', 2, 0),
(89, 2, 'Niagara College', 2, 0),
(90, 2, 'North Island College', 2, 0),
(91, 2, 'Northern College', 2, 0),
(92, 2, 'Northern Lights College', 2, 0),
(93, 2, 'Okanagan College', 2, 0),
(94, 2, 'Red River College of Applied Arts, Science & Technology', 2, 0),
(95, 2, 'Selkirk College', 2, 0),
(96, 2, 'Seneca College of Applied Arts & Technology', 2, 0),
(97, 2, 'St. Lawrence College', 2, 0),
(98, 2, 'St. Clair College of Applied Arts & Technology', 2, 0),
(99, 2, 'Vancouver Community College', 2, 0),
(100, 2, 'Northern Alberta Institute of Technology', 3, 0),
(101, 2, 'Sheridan Institute of Technology & Advanced Learning', 3, 0),
(102, 3, 'Canterbury University', 1, 0),
(103, 3, 'Lincoln University', 1, 0),
(104, 3, 'Massey University', 1, 0),
(105, 3, 'Otago University', 1, 0),
(106, 3, 'University of Auckland', 1, 0),
(107, 3, 'Victoria University', 1, 0),
(108, 3, 'EDENZ Colleges', 2, 0),
(109, 3, 'Christchurch Polytechnic Institute of Technology [CPIT]', 3, 0),
(110, 3, 'Eastern Institute of Technology [EIT]', 3, 0),
(111, 3, 'Manukau Institute of Technology [MIT]', 3, 0),
(112, 3, 'Nelson Marlborough Institute of Technology [NMIT]', 3, 0),
(113, 3, 'Unitec Institute of Technology [UIT]', 3, 0),
(114, 3, 'WaiarikiÂ Institute of Technology', 3, 0),
(115, 3, 'Wellington Institute of Technology [WelTech]', 3, 0),
(116, 4, 'JCU Singapore', 1, 0),
(117, 4, 'Asian Educational Consortium', 2, 0),
(118, 4, 'Nanyang Institute of Management', 3, 0),
(119, 4, 'Informatics Academy', 3, 0),
(120, 4, 'East Asia Institute of Management', 3, 0),
(121, 6, 'Anglia Ruskin University', 1, 0),
(122, 6, 'Bangor University', 1, 0),
(123, 6, 'Bath Spa University', 1, 0),
(124, 6, 'Birkbeck, University Of London', 1, 0),
(125, 6, 'Birmingham City University', 1, 0),
(126, 6, 'Brunel University ', 1, 0),
(127, 6, 'Cardiff Metropolitan University', 1, 0),
(128, 6, 'City University London', 1, 0),
(129, 6, 'Coventry University', 1, 0),
(130, 6, 'Edge Hill University', 1, 0),
(131, 6, 'Edinburgh Napier University', 1, 0),
(132, 6, 'Glasgow Caledonian University', 1, 0),
(133, 6, 'Heriot-Watt University', 1, 0),
(134, 6, 'Keele University', 1, 0),
(135, 6, 'Leeds Metropolitan University', 1, 0),
(136, 6, 'Liverpool John Moores University', 1, 0),
(137, 6, 'London South Bank University', 1, 0),
(138, 6, 'Loughborough University', 1, 0),
(139, 6, 'Manchester Metropolitan University', 1, 0),
(140, 6, 'Middlesex University', 1, 0),
(141, 6, 'Newcastle University', 1, 0),
(142, 6, 'Northumbria University', 1, 0),
(143, 6, 'Oxford Brookes University', 1, 0),
(144, 6, 'Plymouth University', 1, 0),
(145, 6, 'Queen Margaret University', 1, 0),
(146, 6, 'Queen Mary, University Of London', 1, 0),
(147, 6, 'Roehampton University', 1, 0),
(148, 6, 'Sheffield Hallam University', 1, 0),
(149, 6, 'Swansea University', 1, 0),
(150, 6, 'Teesside University', 1, 0),
(151, 6, 'University Of Bedfordshire', 1, 0),
(152, 6, 'University Of Central Lancashire', 1, 0),
(153, 6, 'University Of Chester', 1, 0),
(154, 6, 'University Of East Anglia', 1, 0),
(155, 6, 'University Of East London', 1, 0),
(156, 6, 'University Of Exeter', 1, 0),
(157, 6, 'University Of Glamorgan', 1, 0),
(158, 6, 'University Of Glasgow', 1, 0),
(159, 6, 'University Of Gloucestershire', 1, 0),
(160, 6, 'University Of Hertfordshire', 1, 0),
(161, 6, 'University Of Kent', 1, 0),
(162, 6, 'University Of Leeds', 1, 0),
(163, 6, 'University Of Leicester', 1, 0),
(164, 6, 'University Of Portsmouth', 1, 0),
(165, 6, 'University Of Salford', 1, 0),
(166, 6, 'University Of Southampton', 1, 0),
(167, 6, 'University Of Stirling', 1, 0),
(168, 6, 'University Of Strathclyde', 1, 0),
(169, 6, 'University Of Sunderland', 1, 0),
(170, 6, 'University Of Surrey', 1, 0),
(171, 6, 'University Of The West Of England', 1, 0),
(172, 6, 'University of Ulster', 1, 0),
(173, 6, 'University of Wales, Trinity Saint David London Campus', 1, 0),
(174, 6, 'University Of West London', 1, 0),
(175, 6, 'University Of Westminster', 1, 0),
(176, 6, 'University Of Wolverhampton', 1, 0),
(177, 3, 'Auckland University of Technology [AUT]', 1, 0),
(178, 3, 'Bay of Plenty [BOP]', 3, 0),
(179, 3, 'North Tec', 3, 0),
(180, 3, 'Otago Polytechnic', 3, 0),
(181, 3, 'Southern Institute of Technology [SIT]', 3, 0),
(182, 3, 'Universal College of Learning [UCOL]', 3, 0),
(183, 3, 'University of Waikato', 1, 0),
(184, 3, 'Whitireia Institute', 3, 0),
(185, 3, 'Waikato Institute of Technology [WinTec]', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `instn-subpgm`
--

CREATE TABLE IF NOT EXISTS `instn-subpgm` (
  `isID` int(11) NOT NULL AUTO_INCREMENT,
  `insID` int(11) DEFAULT NULL,
  `pgmID` int(11) DEFAULT NULL,
  `spID` int(11) DEFAULT NULL,
  `delStatus` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`isID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=229 ;

--
-- Dumping data for table `instn-subpgm`
--

INSERT INTO `instn-subpgm` (`isID`, `insID`, `pgmID`, `spID`, `delStatus`) VALUES
(1, 102, 1, 22, 0),
(2, 102, 1, 14, 0),
(3, 102, 3, 12, 0),
(4, 109, 1, 17, 0),
(5, 109, 1, 15, 0),
(6, 108, 1, 17, 0),
(7, 110, 1, 11, 0),
(8, 103, 1, 22, 0),
(9, 104, 1, 21, 0),
(10, 104, 1, 4, 0),
(11, 104, 1, 7, 0),
(12, 111, 1, 16, 0),
(13, 112, 1, 15, 0),
(14, 112, 1, 16, 0),
(15, 105, 1, 3, 0),
(16, 105, 1, 9, 0),
(17, 105, 1, 22, 0),
(18, 113, 1, 16, 0),
(19, 106, 1, 3, 0),
(20, 106, 1, 9, 0),
(21, 106, 1, 13, 0),
(22, 106, 1, 18, 0),
(23, 106, 1, 22, 0),
(24, 107, 1, 2, 0),
(25, 107, 1, 6, 0),
(26, 107, 1, 8, 0),
(27, 107, 1, 10, 0),
(28, 107, 1, 11, 0),
(29, 107, 1, 13, 0),
(30, 107, 1, 15, 0),
(31, 107, 1, 19, 0),
(32, 107, 1, 20, 0),
(33, 114, 1, 17, 0),
(34, 115, 1, 1, 0),
(35, 177, 2, 23, 0),
(36, 177, 2, 24, 0),
(37, 177, 2, 25, 0),
(38, 177, 2, 26, 0),
(39, 177, 2, 27, 0),
(40, 177, 2, 28, 0),
(41, 177, 2, 29, 0),
(42, 177, 2, 30, 0),
(43, 177, 2, 31, 0),
(44, 177, 2, 32, 0),
(46, 178, 2, 33, 0),
(47, 178, 2, 34, 0),
(48, 178, 2, 35, 0),
(49, 109, 2, 26, 0),
(50, 109, 2, 45, 0),
(51, 109, 2, 49, 0),
(52, 110, 2, 44, 0),
(53, 110, 2, 58, 0),
(54, 104, 2, 26, 0),
(55, 104, 2, 42, 0),
(56, 104, 2, 60, 0),
(57, 104, 2, 63, 0),
(58, 104, 2, 64, 0),
(59, 111, 2, 57, 0),
(60, 112, 2, 53, 0),
(61, 179, 2, 37, 0),
(62, 179, 2, 46, 0),
(63, 179, 2, 52, 0),
(64, 180, 2, 61, 0),
(65, 181, 2, 38, 0),
(66, 181, 2, 51, 0),
(67, 182, 2, 39, 0),
(68, 182, 2, 40, 0),
(69, 182, 2, 57, 0),
(70, 106, 2, 27, 0),
(71, 107, 2, 26, 0),
(72, 114, 2, 47, 0),
(73, 114, 2, 48, 0),
(74, 114, 2, 54, 0),
(75, 114, 2, 55, 0),
(76, 114, 2, 59, 0),
(77, 183, 2, 41, 0),
(78, 115, 2, 24, 0),
(79, 115, 2, 50, 0),
(80, 184, 2, 36, 0),
(81, 185, 2, 43, 0),
(82, 185, 2, 56, 0),
(83, 185, 2, 62, 0),
(84, 102, 15, 544, 0),
(85, 102, 15, 543, 0),
(86, 102, 15, 545, 0),
(87, 102, 15, 546, 0),
(88, 102, 15, 547, 0),
(89, 102, 15, 548, 0),
(90, 102, 15, 549, 0),
(91, 102, 15, 550, 0),
(92, 102, 15, 551, 0),
(93, 102, 15, 552, 0),
(94, 102, 15, 553, 0),
(95, 102, 15, 554, 0),
(96, 102, 15, 555, 0),
(97, 102, 15, 556, 0),
(98, 102, 15, 557, 0),
(99, 102, 15, 558, 0),
(100, 102, 15, 559, 0),
(101, 102, 15, 560, 0),
(102, 102, 15, 561, 0),
(103, 102, 15, 562, 0),
(104, 102, 15, 563, 0),
(105, 102, 15, 564, 0),
(106, 102, 15, 565, 0),
(107, 102, 15, 566, 0),
(108, 102, 15, 567, 0),
(109, 102, 15, 568, 0),
(110, 102, 15, 569, 0),
(111, 102, 15, 570, 0),
(112, 102, 15, 571, 0),
(113, 102, 15, 572, 0),
(114, 102, 15, 573, 0),
(115, 102, 15, 574, 0),
(116, 102, 15, 575, 0),
(117, 102, 15, 506, 0),
(118, 102, 15, 507, 0),
(119, 102, 15, 508, 0),
(120, 102, 15, 509, 0),
(121, 102, 15, 510, 0),
(122, 102, 15, 511, 0),
(123, 102, 15, 512, 0),
(124, 102, 15, 513, 0),
(125, 102, 15, 514, 0),
(126, 102, 15, 515, 0),
(127, 102, 15, 516, 0),
(128, 102, 15, 517, 0),
(129, 102, 15, 518, 0),
(130, 102, 15, 519, 0),
(131, 102, 15, 520, 0),
(132, 102, 15, 521, 0),
(133, 102, 15, 522, 0),
(134, 102, 15, 523, 0),
(135, 102, 15, 524, 0),
(136, 102, 15, 525, 0),
(137, 102, 15, 526, 0),
(138, 102, 15, 527, 0),
(139, 102, 15, 528, 0),
(140, 102, 15, 529, 0),
(141, 102, 15, 530, 0),
(142, 102, 15, 531, 0),
(143, 102, 15, 532, 0),
(144, 102, 15, 533, 0),
(145, 102, 15, 534, 0),
(146, 102, 15, 535, 0),
(147, 102, 15, 536, 0),
(148, 102, 15, 537, 0),
(149, 102, 15, 538, 0),
(150, 102, 15, 539, 0),
(151, 102, 15, 540, 0),
(152, 102, 15, 541, 0),
(153, 102, 15, 542, 0),
(154, 102, 15, 576, 0),
(155, 102, 15, 577, 0),
(156, 102, 15, 578, 0),
(157, 102, 15, 579, 0),
(158, 102, 15, 580, 0),
(159, 102, 15, 581, 0),
(160, 102, 15, 582, 0),
(161, 102, 15, 583, 0),
(162, 102, 15, 584, 0),
(163, 102, 15, 585, 0),
(164, 102, 15, 586, 0),
(165, 102, 15, 587, 0),
(166, 102, 15, 588, 0),
(167, 102, 15, 589, 0),
(168, 102, 15, 590, 0),
(169, 102, 15, 591, 0),
(170, 102, 15, 592, 0),
(171, 102, 15, 593, 0),
(172, 102, 15, 594, 0),
(173, 102, 15, 595, 0),
(174, 102, 15, 596, 0),
(175, 102, 15, 597, 0),
(176, 102, 15, 598, 0),
(177, 102, 15, 599, 0),
(178, 102, 15, 600, 0),
(179, 102, 15, 601, 0),
(180, 102, 15, 602, 0),
(181, 102, 15, 603, 0),
(182, 102, 15, 604, 0),
(183, 102, 15, 605, 0),
(184, 102, 15, 606, 0),
(185, 102, 15, 607, 0),
(186, 102, 15, 608, 0),
(187, 102, 15, 609, 0),
(188, 102, 15, 610, 0),
(189, 102, 15, 611, 0),
(190, 102, 15, 612, 0),
(191, 102, 15, 613, 0),
(192, 102, 15, 614, 0),
(193, 102, 15, 615, 0),
(194, 102, 15, 616, 0),
(195, 102, 15, 617, 0),
(196, 102, 15, 618, 0),
(197, 102, 15, 619, 0),
(198, 102, 15, 620, 0),
(199, 102, 15, 621, 0),
(200, 102, 15, 622, 0),
(201, 102, 15, 623, 0),
(202, 102, 15, 624, 0),
(203, 102, 15, 625, 0),
(204, 102, 15, 626, 0),
(205, 102, 15, 627, 0),
(206, 102, 15, 628, 0),
(207, 102, 15, 629, 0),
(208, 102, 15, 630, 0),
(209, 102, 15, 631, 0),
(210, 102, 15, 632, 0),
(211, 102, 15, 633, 0),
(212, 102, 15, 634, 0),
(213, 102, 15, 635, 0),
(214, 102, 15, 636, 0),
(215, 102, 15, 637, 0),
(216, 102, 15, 638, 0),
(217, 102, 15, 639, 0),
(218, 102, 15, 640, 0),
(219, 102, 15, 641, 0),
(220, 102, 15, 642, 0),
(221, 102, 15, 643, 0),
(222, 102, 15, 644, 0),
(223, 102, 15, 645, 0),
(224, 102, 15, 646, 0),
(225, 102, 15, 647, 0),
(226, 102, 15, 648, 0),
(227, 102, 15, 649, 0),
(228, 102, 15, 650, 0);

-- --------------------------------------------------------

--
-- Table structure for table `log_report`
--

CREATE TABLE IF NOT EXISTS `log_report` (
  `logID` int(11) NOT NULL AUTO_INCREMENT,
  `loginUserID` tinyint(4) DEFAULT NULL,
  `loginType` tinyint(4) DEFAULT NULL,
  `loginDate` date NOT NULL DEFAULT '0000-00-00',
  `loginTime` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`logID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `newspapers`
--

CREATE TABLE IF NOT EXISTS `newspapers` (
  `npid` int(11) NOT NULL AUTO_INCREMENT,
  `newspaper` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`npid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `newspapers`
--

INSERT INTO `newspapers` (`npid`, `newspaper`) VALUES
(1, 'Malayala Manorama'),
(2, 'Mathrubhumi'),
(3, 'The Hindu'),
(4, 'Times of India'),
(5, 'Deccan Chronicle'),
(6, 'The New Indian Express');

-- --------------------------------------------------------

--
-- Table structure for table `offer_letters`
--

CREATE TABLE IF NOT EXISTS `offer_letters` (
  `reqID` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `assignedBy` int(11) DEFAULT NULL,
  `assignedTo` int(11) DEFAULT NULL,
  `studID` int(11) DEFAULT NULL,
  `pgmID` int(11) DEFAULT NULL,
  `subPgmID` int(11) DEFAULT NULL,
  `pgmOthers` varchar(255) DEFAULT NULL,
  `conID` int(11) DEFAULT NULL,
  `offerMode` tinyint(4) NOT NULL DEFAULT '0',
  `insID` int(11) DEFAULT NULL,
  `delStatus` tinyint(4) NOT NULL DEFAULT '0',
  `reqStatus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`reqID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `offer_letters`
--

INSERT INTO `offer_letters` (`reqID`, `date`, `assignedBy`, `assignedTo`, `studID`, `pgmID`, `subPgmID`, `pgmOthers`, `conID`, `offerMode`, `insID`, `delStatus`, `reqStatus`) VALUES
(1, '2013-07-05', NULL, NULL, 1, 3, 106, '', 3, 1, 102, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pgm-con-ins`
--

CREATE TABLE IF NOT EXISTS `pgm-con-ins` (
  `piID` int(11) NOT NULL AUTO_INCREMENT,
  `pgmID` tinyint(4) DEFAULT NULL,
  `conID` tinyint(4) DEFAULT NULL,
  `insID` int(11) DEFAULT NULL,
  `delStatus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`piID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `pgm-con-ins`
--

INSERT INTO `pgm-con-ins` (`piID`, `pgmID`, `conID`, `insID`, `delStatus`) VALUES
(1, 1, 3, 102, 0),
(2, 1, 3, 109, 0),
(3, 1, 3, 108, 0),
(4, 1, 3, 110, 0),
(5, 1, 3, 103, 0),
(6, 1, 3, 104, 0),
(7, 1, 3, 111, 0),
(8, 1, 3, 112, 0),
(9, 1, 3, 105, 0),
(10, 1, 3, 113, 0),
(11, 1, 3, 106, 0),
(12, 1, 3, 107, 0),
(13, 1, 3, 114, 0),
(14, 1, 3, 115, 0),
(15, 2, 3, 177, 0),
(16, 15, 3, 102, 0),
(17, 5, 3, 102, 0),
(18, 8, 3, 102, 0),
(19, 12, 3, 102, 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `postID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `post` text,
  `empID` int(11) DEFAULT '0',
  `email` varchar(80) DEFAULT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `time` varchar(8) NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`postID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postID`, `title`, `post`, `empID`, `email`, `date`, `time`) VALUES
(1, 'Why should I take this course as opposed to trying to work through books or tutorials?', 'For the same reasons that you would go to a university instead of a library. If you want to work with other people, under experienced guidance, in a structured environment, then Bloc might be for you.', 3, 'user@riya.travel', '2013-05-30', '11:02:00'),
(2, ' How to add a new button to firefox navigation toolbar?', 'Okay here are the details. I want to add a new button to firefox, the purpose of that button is that when i type something in the address bar in firefox and click that button in navigation toolbar, that must serve the purpose of "I am feeling lucky button on google homepage". Any super genius here?', 3, 'user@riya.travel', '2013-05-30', '11:39:56'),
(3, 'Today, we are bringing a Firefox guide that anyone can follow to create a custom button in navigation toolbar.', 'Today, we are bringing a Firefox guide that anyone can follow to create a custom button in navigation toolbar. Along with visible buttons in navigation toolbar, there is a list of other buttons having different functionalities provided in Firefox which can be added anywhere on toolbar and can be customized according to your needs.', 3, 'user@riya.travel', '2013-05-30', '11:41:23'),
(4, 'Since the buttonâ€™s position and behavior can be changed without requiring any extra knowledge?', 'Since the buttonâ€™s position and behavior can be changed without requiring any extra knowledge, one can easily build a new extension that behaves as directed, sits in defined position, while being highly customizable. This post covers how to create a simple extension â€“ a toolbar button that will provide a simple functionality.', 3, 'user@riya.travel', '2013-05-30', '11:56:27');

-- --------------------------------------------------------

--
-- Table structure for table `prodetails`
--

CREATE TABLE IF NOT EXISTS `prodetails` (
  `pdID` int(11) NOT NULL AUTO_INCREMENT,
  `isID` int(11) DEFAULT NULL,
  `intake` varchar(50) DEFAULT NULL,
  `fees` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`pdID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=217 ;

--
-- Dumping data for table `prodetails`
--

INSERT INTO `prodetails` (`pdID`, `isID`, `intake`, `fees`) VALUES
(1, 1, 'Feb-July', '$19000'),
(2, 4, 'Feb-July', '$15400'),
(3, 5, 'Feb-July', '$15400'),
(4, 6, 'Oct, Dec, Feb, July', '$13300'),
(5, 7, 'Feb-July', '$13500'),
(6, 8, NULL, '$23500'),
(7, 9, 'February', '$18800'),
(8, 10, 'Feb-July', '$19900'),
(9, 11, 'Feb-July', '$19900'),
(10, 12, 'Feb-July', '$15250'),
(11, 13, 'Feb-July', '$16400'),
(12, 14, 'Feb-July', '$16400'),
(13, 17, NULL, '$17800'),
(14, 16, NULL, '$19000'),
(15, 18, 'Feb-July', '$16000'),
(16, 22, NULL, '$27,840 - 28,100'),
(17, 23, NULL, '$23500'),
(18, 24, NULL, '$25700'),
(19, 25, NULL, '$30300'),
(20, 26, NULL, '$20200'),
(21, 27, NULL, '$38600'),
(22, 28, NULL, '$19600'),
(23, 29, NULL, '$19600'),
(24, 30, NULL, '$19600'),
(25, 31, NULL, '$20200'),
(26, 32, NULL, '$18900'),
(27, 33, 'Feb/July/Oct', '$16926'),
(28, 34, 'Mar/July/Nov', '$14500'),
(29, 35, 'March', '$21600'),
(30, 37, 'March/July', '$21600'),
(31, 36, 'March/July', '$20600'),
(32, 38, 'March', '$20600'),
(33, 39, 'March', '$20600'),
(34, 40, 'March', '$20600'),
(35, 41, 'March', '$21600'),
(36, 42, 'March', '$20500'),
(37, 43, 'March/July', '$21600'),
(38, 44, 'March', '$21600'),
(39, 47, 'Feb', '$14625'),
(40, 46, 'Feb', ''),
(41, 48, 'Feb/July', ''),
(42, 49, 'Feb', '$17460'),
(43, 50, 'Feb', '$16940'),
(44, 51, 'Feb', '$16940'),
(45, 52, 'Feb', '$16000'),
(46, 53, 'Feb', '$16000'),
(47, 54, 'Feb', '$21300'),
(48, 55, 'Feb', '$21300'),
(49, 56, 'Feb/ July', '$21300'),
(50, 57, 'Feb', '$24600'),
(51, 58, 'Feb', '$24600'),
(52, 59, 'Feb', '$18400'),
(53, 60, 'Feb/ July', '$17000'),
(54, 61, 'Feb/ July', '$18000'),
(55, 62, 'Feb', '$14600'),
(56, 63, 'Feb/ July', '$17000'),
(57, 64, 'Feb', ''),
(58, 65, 'Feb', ''),
(59, 66, 'Feb/Mar/Jun/Jul', ''),
(60, 67, 'Feb', '$16800'),
(61, 68, 'Feb/ July', '$16800'),
(62, 69, 'Feb', '$14200'),
(63, 70, '', '$23290'),
(64, 71, '', '$23500'),
(65, 76, 'Feb/July', '$16926'),
(66, 75, 'Feb/July', '$16926'),
(67, 74, 'Feb/July', '$16926'),
(68, 73, 'Feb', ''),
(69, 72, 'Feb', ''),
(70, 78, 'March', '$17900'),
(71, 79, 'March', '$17900'),
(72, 80, 'Feb', '$15500'),
(73, 81, 'Feb/July', '$17575'),
(74, 82, 'Feb', '$16975'),
(75, 83, 'March', '$17575'),
(76, 84, 'Feb/July', '$22,400 '),
(77, 85, 'Feb/July', '$22,400'),
(78, 86, 'Feb/July', '$22,400'),
(79, 87, 'Feb/July', '$22,400'),
(80, 88, 'Feb/July', '$22,400'),
(81, 89, 'Feb/July', '$22,400'),
(82, 90, 'Feb/July', '$22,400'),
(83, 91, 'Feb/July', '$22,400'),
(84, 92, 'Feb/July', '$22,800'),
(85, 93, 'Feb/July', '$22,800'),
(86, 94, 'Feb/July', '$22,800'),
(87, 95, 'Feb/July', '$22,800'),
(88, 96, 'Feb/July', '$22,800'),
(89, 97, 'Feb/July', '$27,100'),
(90, 98, 'Feb/July', '$22,800'),
(91, 99, 'Feb/July', '$22,800'),
(92, 100, 'Feb/July', '$27,100'),
(93, 101, 'Feb/July', '$22,800'),
(94, 102, 'Feb/July', '$22,800'),
(95, 103, 'Feb/July', '$24,500'),
(96, 104, 'Feb/July', '$20,700'),
(97, 105, 'Feb/July', '$32,000'),
(98, 106, 'Feb/July', '$27,100'),
(99, 107, 'Feb/July', '$27,100'),
(100, 108, 'Feb/July', '$22,800'),
(101, 109, 'Feb/July', '$22,800'),
(102, 110, 'Feb/July', '$27,100'),
(103, 111, 'Feb/July', '$22,800'),
(104, 112, 'Feb/July', '$22,800'),
(105, 113, 'Feb/July', '$22,800'),
(106, 114, 'Feb/July', '$22,400'),
(107, 115, 'Feb/July', '$27,100'),
(108, 116, 'Feb/July', '$27,100'),
(109, 117, 'Feb/July', '$26,100'),
(110, 118, 'Feb/July', '$26,100'),
(111, 119, 'Feb/July', '$26,100'),
(112, 120, 'Feb/July', '$26,100'),
(113, 121, 'Feb/July', '$26,100'),
(114, 122, 'Feb/July', '$26,100'),
(115, 123, 'Feb/July', '$26,100'),
(116, 124, 'Feb/July', '$26,100'),
(117, 125, 'Feb/July', '$26,100'),
(118, 126, 'Feb/July', '$26,100'),
(119, 127, 'Feb/July', '$26,100'),
(120, 128, 'Feb/July', '$26,100'),
(121, 129, 'Feb/July', '$26,100'),
(122, 130, 'Feb/July', '$26,100'),
(123, 131, 'Feb/July', '$26,100'),
(124, 132, 'Feb/July', '$26,100'),
(125, 133, 'Feb/July', '$26,100'),
(126, 134, 'Feb/July', '$26,100'),
(127, 135, 'Feb/July', '$26,100'),
(128, 136, 'Feb/July', '$26,100'),
(129, 137, 'Feb/July', '$26,100'),
(130, 138, 'Feb/July', '$26,100'),
(131, 139, 'Feb/July', '$26,100'),
(132, 140, 'Feb/July', '$26,100'),
(133, 135, 'Feb/July', '$26,100'),
(134, 141, 'Feb/July', '$26,100'),
(135, 142, 'Feb/July', '$26,100'),
(136, 143, 'Feb/July', '$26,100'),
(137, 144, 'Feb/July', '$26,100'),
(138, 145, 'Feb/July', '$26,100'),
(139, 146, 'Feb/July', '$26,100'),
(140, 147, 'Feb/July', '$26,100'),
(141, 148, 'Feb/July', '$26,100'),
(142, 149, 'Feb/July', '$26,100'),
(143, 150, 'Feb/July', '$26,100'),
(144, 151, 'Feb/July', '$26,100'),
(145, 152, 'Feb/July', '$26,100'),
(146, 153, 'Feb/July', '$26,100'),
(147, 154, 'July', '$22,800'),
(148, 155, 'July', '$22,800'),
(149, 156, 'July', '$22,800'),
(150, 157, 'July', '$22,800'),
(151, 158, 'July', '$22,800'),
(152, 159, 'July', '$22,800'),
(153, 160, 'July', '$22,800'),
(154, 161, 'July', '$22,800'),
(155, 162, 'July', '$22,800'),
(156, 163, 'July', '$22,800'),
(157, 164, 'July', '$22,800'),
(158, 165, 'July', '$22,800'),
(159, 166, 'July', '$22,800'),
(160, 167, 'July', '$22,800'),
(161, 168, 'July', '$22,800'),
(162, 169, 'July', '$22,800'),
(163, 170, 'July', '$22,800'),
(164, 171, 'July', '$22,800'),
(165, 172, 'July', '$22,800'),
(166, 173, 'July', '$22,800'),
(167, 174, 'July', '$22,800'),
(168, 175, 'July', '$22,800'),
(169, 176, 'July', '$22,800'),
(170, 177, 'July', '$22,800'),
(171, 178, 'July', '$22,800'),
(172, 179, 'July', '$22,800'),
(173, 180, 'July', '$22,800'),
(174, 181, 'July', '$22,800'),
(175, 182, 'July', '$22,800'),
(176, 183, 'July', '$22,800'),
(177, 184, 'July', '$22,800'),
(178, 185, 'July', '$22,800'),
(179, 186, 'July', '$22,800'),
(180, 187, 'July', '$24,500'),
(181, 188, 'July', '$24,500'),
(182, 189, 'July', '$32,800'),
(183, 190, 'July', '$24,500'),
(184, 191, 'Feb/July', '$26,100'),
(185, 192, 'Feb/July', '$26,100'),
(186, 193, 'Feb/July', '$26,100'),
(187, 194, 'Feb/July', '$26,100'),
(188, 195, 'Feb/July', '$26,100'),
(189, 196, 'Feb/July', '$26,100'),
(190, 197, 'Feb/July', '$26,100'),
(191, 198, 'Feb/July', '$26,100'),
(192, 199, 'Feb/July', '$26,100'),
(193, 200, 'Feb/July', '$26,100'),
(194, 201, 'Feb/July', '$26,100'),
(195, 202, 'Feb/July', '$26,100'),
(196, 203, 'Feb/July', '$26,100'),
(197, 204, 'Feb/July', '$26,100'),
(198, 205, 'Feb/July', '$26,100'),
(199, 206, 'Feb/July', '$26,100'),
(200, 207, 'Feb/July', '$26,100'),
(201, 208, 'Feb/July', '$26,100'),
(202, 209, 'Feb/July', '$26,100'),
(203, 210, 'Feb/July', '$26,100'),
(204, 211, 'Feb/July', '$26,100'),
(205, 212, 'Feb/July', '$26,100'),
(206, 213, 'Feb/July', '$26,100'),
(207, 214, 'Feb/July', '$26,100'),
(208, 215, 'Feb/July', '$26,100'),
(209, 216, 'Feb/July', '$26,100'),
(210, 217, 'Feb/July', '$26,100'),
(211, 218, 'Feb/July', '$26,100'),
(212, 219, 'Feb/July', '$26,100'),
(213, 220, 'Feb/July', '$26,100'),
(214, 221, 'Feb/July', '$26,100'),
(215, 1, '1', '1'),
(216, 1, '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE IF NOT EXISTS `programs` (
  `pgmID` int(11) NOT NULL AUTO_INCREMENT,
  `program` varchar(255) DEFAULT NULL,
  `delStatus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pgmID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`pgmID`, `program`, `delStatus`) VALUES
(1, 'Commerce', 0),
(2, 'Animation', 0),
(3, 'Business', 0),
(4, 'Information Technology', 0),
(5, 'Engineering', 0),
(6, 'Horticulture', 0),
(7, 'Hospitality', 0),
(8, 'Law', 0),
(9, 'Logistics', 0),
(10, 'Health', 0),
(11, 'Social Work', 0),
(12, 'Science', 0),
(13, 'Languages', 0),
(14, 'Banking & Finance', 0),
(15, 'Arts', 0),
(16, 'Fashion Technolgy', 0),
(17, 'Fine Arts', 0),
(18, 'Education', 0),
(19, 'Music', 0);

-- --------------------------------------------------------

--
-- Table structure for table `qualifications`
--

CREATE TABLE IF NOT EXISTS `qualifications` (
  `qid` int(11) NOT NULL AUTO_INCREMENT,
  `qualification` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`qid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `qualifications`
--

INSERT INTO `qualifications` (`qid`, `qualification`) VALUES
(1, 'Xth'),
(2, 'XIIth'),
(3, 'Diploma'),
(4, 'Degree'),
(5, 'Masters'),
(6, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE IF NOT EXISTS `reminders` (
  `remID` int(11) NOT NULL AUTO_INCREMENT,
  `empID` int(11) DEFAULT NULL,
  `studID` int(11) DEFAULT NULL,
  `reminder` text,
  `remDate` date NOT NULL DEFAULT '0000-00-00',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `delStatus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`remID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `reminders`
--

INSERT INTO `reminders` (`remID`, `empID`, `studID`, `reminder`, `remDate`, `date`, `delStatus`) VALUES
(1, 3, 1, 'Call the student for document change!', '2013-07-15', '2013-05-29', 0),
(2, 3, 2, 'Call Anu @ 11am', '2013-07-10', '2013-05-29', 0),
(3, 3, 1, 'Document collection', '2013-07-24', '2013-05-29', 0),
(4, 3, 2, 'Document Collection', '2013-07-31', '2013-05-29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `stateID` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(50) NOT NULL,
  PRIMARY KEY (`stateID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`stateID`, `state`) VALUES
(1, 'Andhra Pradesh'),
(2, 'Assam'),
(3, 'Arunachal Pradesh'),
(4, 'Gujrat'),
(5, 'Bihar'),
(6, 'Haryana'),
(7, 'Himachal Pradesh'),
(8, 'Jammu & Kashmir'),
(9, 'Karnataka'),
(10, 'Kerala'),
(11, 'Madhya Pradesh'),
(12, 'Maharashtra'),
(13, 'Manipur'),
(14, 'Meghalaya'),
(15, 'Mizoram'),
(16, 'Nagaland'),
(17, 'Orissa'),
(18, 'Punjab'),
(19, 'Rajasthan'),
(20, 'Sikkim'),
(21, 'Tamil Nadu'),
(22, 'Tripura'),
(23, 'Uttar Pradesh'),
(24, 'West Bengal'),
(25, 'Delhi'),
(26, 'Goa'),
(27, 'Pondicherry'),
(28, 'Lakshadweep'),
(29, 'Daman & Diu'),
(30, 'Dadra & Nagar'),
(31, 'Chandigarh'),
(32, 'Andaman & Nicobar'),
(33, 'Uttaranchal'),
(34, 'Jharkhand'),
(35, 'Chattisgarh');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `studID` int(11) NOT NULL AUTO_INCREMENT,
  `empID` int(11) DEFAULT NULL,
  `regNo` varchar(7) DEFAULT NULL,
  `branchID` tinyint(4) DEFAULT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `gender` varchar(1) NOT NULL DEFAULT '0',
  `fname` varchar(40) DEFAULT NULL,
  `lname` varchar(40) DEFAULT NULL,
  `dob` date DEFAULT '0000-00-00',
  `photo` varchar(80) DEFAULT NULL,
  `married` tinyint(4) NOT NULL DEFAULT '0',
  `spName` varchar(80) DEFAULT NULL,
  `spOccupation` varchar(150) DEFAULT NULL,
  `gdName` varchar(80) DEFAULT NULL,
  `gdOccupation` varchar(80) DEFAULT NULL,
  `program` tinyint(4) DEFAULT NULL,
  `subProgram` int(11) DEFAULT NULL,
  `pgmOthers` varchar(150) DEFAULT NULL,
  `country` tinyint(4) DEFAULT NULL,
  `lastInc` int(11) DEFAULT NULL,
  `convertStatus` tinyint(4) NOT NULL DEFAULT '0',
  `delStatus` tinyint(4) NOT NULL DEFAULT '0',
  `ddStatus` tinyint(4) NOT NULL DEFAULT '0',
  `vdStatus` tinyint(4) NOT NULL DEFAULT '0',
  `sdStatus` tinyint(4) NOT NULL DEFAULT '0',
  `offerLetter` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`studID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studID`, `empID`, `regNo`, `branchID`, `date`, `gender`, `fname`, `lname`, `dob`, `photo`, `married`, `spName`, `spOccupation`, `gdName`, `gdOccupation`, `program`, `subProgram`, `pgmOthers`, `country`, `lastInc`, `convertStatus`, `delStatus`, `ddStatus`, `vdStatus`, `sdStatus`, `offerLetter`) VALUES
(1, 3, 'RE06131', 1, '2013-06-24', '1', 'Vineeth', 'S', '1990-12-12', '1372072712_Pass2.jpg', 0, '', '', 'Sreenivasan', 'Actor', 3, 106, '', 3, 1, 0, 0, 1, 0, 0, 1),
(2, 4, 'RE06132', 2, '2013-06-25', '2', 'Laxmi', 'Rajeev', '1992-02-05', '1372163863_avatar.png', 1, 'Rajeev', 'Bank Officer', 'Ramachandran', 'Administrator', 1, 653, '', 3, 2, 0, 0, 1, 0, 0, 0),
(3, 3, 'RE07133', 1, '2013-07-05', '1', 'Rakesh', 'S', '1990-02-05', '1372998995_Pass2.jpg', 0, '', '', 'Satheesh', 'Administrator', 15, 623, '', 3, 3, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stud_chklist`
--

CREATE TABLE IF NOT EXISTS `stud_chklist` (
  `clID` int(11) NOT NULL AUTO_INCREMENT,
  `svID` int(11) DEFAULT NULL,
  `dType` tinyint(4) DEFAULT NULL,
  `income_proof` tinyint(4) DEFAULT NULL,
  `sponsor` tinyint(4) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `relation` varchar(50) DEFAULT NULL,
  `gd_sal_state` tinyint(4) DEFAULT NULL,
  `affidavit` tinyint(4) DEFAULT NULL,
  `ca_state1` tinyint(4) DEFAULT NULL,
  `gd_passport` tinyint(4) DEFAULT NULL,
  `comp_regn` tinyint(4) DEFAULT NULL,
  `partnership` tinyint(4) DEFAULT NULL,
  `bal_sheet` tinyint(4) DEFAULT NULL,
  `it_returns` tinyint(4) DEFAULT NULL,
  `ca_state2` tinyint(4) DEFAULT NULL,
  `rental_agrmnt` tinyint(4) DEFAULT NULL,
  `rent_recpt` tinyint(4) DEFAULT NULL,
  `sp_sal_state` tinyint(4) DEFAULT NULL,
  `sp_passport` tinyint(4) DEFAULT NULL,
  `visa` tinyint(4) DEFAULT NULL,
  `otherProof` tinyint(4) DEFAULT NULL,
  `other_proof` varchar(255) DEFAULT NULL,
  `income_proof_attach` varchar(80) DEFAULT NULL,
  `gd_sal_state_attach` varchar(80) DEFAULT NULL,
  `affidavit_attach` varchar(80) DEFAULT NULL,
  `ca_state1_attach` varchar(80) DEFAULT NULL,
  `gd_passport_attach` varchar(80) DEFAULT NULL,
  `comp_regn_attach` varchar(80) DEFAULT NULL,
  `partnership_attach` varchar(80) DEFAULT NULL,
  `bal_sheet_attach` varchar(80) DEFAULT NULL,
  `it_returns_attach` varchar(80) DEFAULT NULL,
  `ca_state2_attach` varchar(80) DEFAULT NULL,
  `rental_argmnt_attach` varchar(80) DEFAULT NULL,
  `rent_recpt_attach` varchar(80) DEFAULT NULL,
  `sp_sal_state_attach` varchar(80) DEFAULT NULL,
  `sp_passport_attach` varchar(80) DEFAULT NULL,
  `visa_attach` varchar(80) DEFAULT NULL,
  `other_proof_attach` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`clID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `stud_chklist`
--

INSERT INTO `stud_chklist` (`clID`, `svID`, `dType`, `income_proof`, `sponsor`, `name`, `relation`, `gd_sal_state`, `affidavit`, `ca_state1`, `gd_passport`, `comp_regn`, `partnership`, `bal_sheet`, `it_returns`, `ca_state2`, `rental_agrmnt`, `rent_recpt`, `sp_sal_state`, `sp_passport`, `visa`, `otherProof`, `other_proof`, `income_proof_attach`, `gd_sal_state_attach`, `affidavit_attach`, `ca_state1_attach`, `gd_passport_attach`, `comp_regn_attach`, `partnership_attach`, `bal_sheet_attach`, `it_returns_attach`, `ca_state2_attach`, `rental_argmnt_attach`, `rent_recpt_attach`, `sp_sal_state_attach`, `sp_passport_attach`, `visa_attach`, `other_proof_attach`) VALUES
(1, 7, 0, 1, 1, 'Sp Name', 'Uncle', 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, -1, 'Other IP Doc', '1372675834_1star.png', '1372675834_2star.png', '1372675834_3star.png', '1372675834_4star.png', '1372675834_arrow-blue.png', '', '', '', '', '', '', '', '', '', '', '1372675834_arrow-bright.png'),
(2, 8, 3, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, -1, 'Other Rental Doc', '', '', '', '', '', '', '', '', '', '', '1372676963_1star.png', '1372676963_2star.png', '', '', '', '1372676963_3star.png'),
(3, 9, 2, 0, 0, '', '', 0, 0, 0, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, -1, 'Other Business Doc', '', '', '', '', '', '1372677169_1star.png', '1372677169_2star.png', '1372677169_3star.png', '1372677169_4star.png', '1372677169_arrow-blue.png', '', '', '', '', '', '1372677169_arrow-bright.png'),
(4, 10, 4, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, -1, 'Other SA Doc', '', '', '', '', '', '', '', '', '', '', '', '', '1372678336_1star.png', '1372678336_2star.png', '1372678336_3star.png', '1372678336_4star.png'),
(5, 11, 1, 1, 2, 'Gd Name', 'Uncle', 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, -1, 'Other IP Doc', '1372678469_1star.png', '1372678469_2star.png', '1372678469_3star.png', '1372678469_4star.png', '1372678469_arrow-bright.png', '', '', '', '', '', '', '', '', '', '', '1372678469_arrow-light.png');

-- --------------------------------------------------------

--
-- Table structure for table `stud_contact`
--

CREATE TABLE IF NOT EXISTS `stud_contact` (
  `conID` int(11) NOT NULL AUTO_INCREMENT,
  `studID` int(11) DEFAULT NULL,
  `conCode` varchar(2) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `areaCode` varchar(5) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `addr1` varchar(80) DEFAULT NULL,
  `addr2` varchar(80) DEFAULT NULL,
  `addr3` varchar(80) DEFAULT NULL,
  `pincode` int(6) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `state` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`conID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `stud_contact`
--

INSERT INTO `stud_contact` (`conID`, `studID`, `conCode`, `mobile`, `areaCode`, `phone`, `email`, `addr1`, `addr2`, `addr3`, `pincode`, `district`, `state`) VALUES
(1, 1, '91', '9854654654', '0471', '2246555', 'vineeth@email.com', 'Victor Bhavan', 'Karamana', 'Trivandrum', 695504, 'Thiruvananthapuram', 10),
(2, 2, '91', '9854654654', '0471', '2246555', 'vineeth@email.com', 'Victor Bhavan', 'Karamana', 'Trivandrum', 695504, 'Thiruvananthapuram', 10),
(3, 3, '91', '9854654654', '0471', '2246555', 'rakesh@email.com', 'address1', 'address2', 'address3', 695504, 'Thiruvananthapuram', 10);

-- --------------------------------------------------------

--
-- Table structure for table `stud_docs`
--

CREATE TABLE IF NOT EXISTS `stud_docs` (
  `tbID` int(11) NOT NULL AUTO_INCREMENT,
  `studID` int(11) DEFAULT NULL,
  `empID` int(11) DEFAULT NULL,
  `docID` tinyint(4) DEFAULT NULL,
  `uploads` varchar(150) DEFAULT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `delStatus` tinyint(4) NOT NULL DEFAULT '0',
  `verify` tinyint(4) NOT NULL DEFAULT '0',
  `verifyDate` date NOT NULL DEFAULT '0000-00-00',
  `reason` text,
  PRIMARY KEY (`tbID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `stud_docs`
--

INSERT INTO `stud_docs` (`tbID`, `studID`, `empID`, `docID`, `uploads`, `date`, `delStatus`, `verify`, `verifyDate`, `reason`) VALUES
(1, 1, 3, 1, '1372162382_raj.jpg', '2013-06-25', 0, 1, '2013-06-28', NULL),
(2, 1, 3, 2, '1372411254_link-broken_green.png', '2013-06-28', 0, 1, '2013-06-28', NULL),
(3, 1, 3, 5, '1372162716_avatar.png', '2013-06-25', 0, 1, '2013-06-28', NULL),
(4, 1, 3, 6, '1372399988_pic.jpg', '2013-06-28', 0, 1, '2013-06-28', NULL),
(5, 1, 3, 7, '1372420844_loading.gif', '2013-06-28', 0, 1, '2013-06-28', NULL),
(6, 1, 3, 8, '1372928873_allocate_orange.png', '2013-07-04', 0, 1, '2013-07-04', 'doc not clear'),
(7, 1, 3, 9, '1372420884_raj.jpg', '2013-06-28', 0, 1, '2013-06-28', NULL),
(8, 1, 3, 10, '1372400090_edu_db.jpg', '2013-06-28', 0, 1, '2013-06-28', NULL),
(9, 2, 4, 1, '1372415569_link-add-icon.png', '2013-06-28', 0, 0, '0000-00-00', NULL),
(10, 2, 4, 3, NULL, '0000-00-00', 0, 0, '0000-00-00', NULL),
(11, 2, 4, 5, '1372415732_pic.jpg', '2013-06-28', 0, 0, '0000-00-00', NULL),
(12, 2, 4, 8, NULL, '0000-00-00', 0, 0, '0000-00-00', NULL),
(13, 2, 4, 9, NULL, '0000-00-00', 0, 0, '0000-00-00', NULL),
(14, 2, 4, 10, NULL, '0000-00-00', 0, 0, '0000-00-00', NULL),
(15, 3, 3, 1, '1372999082_1star.png', '2013-07-05', 0, 0, '0000-00-00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stud_education`
--

CREATE TABLE IF NOT EXISTS `stud_education` (
  `eduID` int(11) NOT NULL AUTO_INCREMENT,
  `studID` int(11) DEFAULT NULL,
  `qid` tinyint(4) DEFAULT NULL,
  `otherQlfn` varchar(150) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `stream` varchar(150) DEFAULT NULL,
  `institution` varchar(255) DEFAULT NULL,
  `marks` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`eduID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `stud_education`
--

INSERT INTO `stud_education` (`eduID`, `studID`, `qid`, `otherQlfn`, `year`, `stream`, `institution`, `marks`) VALUES
(1, 1, 1, '', 2006, 'Common', 'EMS School', '88'),
(2, 1, 2, '', 2008, 'Science', 'BMS School', '80'),
(3, 1, 4, '', 2011, 'BBA', 'PMS College', '78'),
(4, 2, 1, NULL, 2007, 'Common', 'ABC School', '80'),
(5, 2, 2, NULL, 2009, 'Commerce', 'BCD School', '75'),
(6, 2, 6, 'Certification', 2012, 'Accountancy', 'AMS College', '72'),
(7, 3, 1, '', 2007, 'Common', 'EMS School', '88'),
(8, 3, 2, '', 2009, 'Commerce', 'BMS School', '78'),
(9, 3, 4, '', 2012, 'BA Economics', 'PMS College', '72');

-- --------------------------------------------------------

--
-- Table structure for table `stud_employment`
--

CREATE TABLE IF NOT EXISTS `stud_employment` (
  `emID` int(11) NOT NULL AUTO_INCREMENT,
  `studID` int(11) DEFAULT NULL,
  `companies` varchar(80) DEFAULT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `wdFrom` varchar(15) DEFAULT NULL,
  `wdTo` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`emID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `stud_employment`
--

INSERT INTO `stud_employment` (`emID`, `studID`, `companies`, `designation`, `wdFrom`, `wdTo`) VALUES
(1, 1, 'Iridiyum', 'Business Executive', '16-06-2011', '15-06-2012'),
(2, 1, 'Iridiyum', 'Business Executive', '16-06-2012', '15-06-2013');

-- --------------------------------------------------------

--
-- Table structure for table `stud_finance`
--

CREATE TABLE IF NOT EXISTS `stud_finance` (
  `fdID` int(11) NOT NULL AUTO_INCREMENT,
  `svID` int(11) DEFAULT NULL,
  `finMode` tinyint(4) DEFAULT NULL,
  `loan_sanc_letter` tinyint(4) DEFAULT NULL,
  `loan_property` tinyint(4) DEFAULT NULL,
  `fd_bank_letter` tinyint(4) DEFAULT NULL,
  `fd_receipt` tinyint(4) DEFAULT NULL,
  `sav_bank_letter` tinyint(4) DEFAULT NULL,
  `sav_bank_state` tinyint(4) DEFAULT NULL,
  `otherFinance` tinyint(4) DEFAULT NULL,
  `other_finance` varchar(255) DEFAULT NULL,
  `doc_lic` varchar(255) DEFAULT NULL,
  `doc_pf` varchar(255) DEFAULT NULL,
  `doc_gl` varchar(255) DEFAULT NULL,
  `doc_others` varchar(255) DEFAULT NULL,
  `loan_sanc_letter_attach` varchar(80) DEFAULT NULL,
  `loan_property_attach` varchar(80) DEFAULT NULL,
  `fd_bank_letter_attach` varchar(80) DEFAULT NULL,
  `fd_receipt_attach` varchar(80) DEFAULT NULL,
  `sav_bank_letter_attach` varchar(80) DEFAULT NULL,
  `sav_bank_state_attach` varchar(80) DEFAULT NULL,
  `other_finance_attach` varchar(80) DEFAULT NULL,
  `doc_lic_attach` varchar(80) DEFAULT NULL,
  `doc_pf_attach` varchar(80) DEFAULT NULL,
  `doc_gl_attach` varchar(80) DEFAULT NULL,
  `doc_others_attach` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`fdID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `stud_finance`
--

INSERT INTO `stud_finance` (`fdID`, `svID`, `finMode`, `loan_sanc_letter`, `loan_property`, `fd_bank_letter`, `fd_receipt`, `sav_bank_letter`, `sav_bank_state`, `otherFinance`, `other_finance`, `doc_lic`, `doc_pf`, `doc_gl`, `doc_others`, `loan_sanc_letter_attach`, `loan_property_attach`, `fd_bank_letter_attach`, `fd_receipt_attach`, `sav_bank_letter_attach`, `sav_bank_state_attach`, `other_finance_attach`, `doc_lic_attach`, `doc_pf_attach`, `doc_gl_attach`, `doc_others_attach`) VALUES
(1, 1, 1, 1, 1, 0, 0, 0, 0, -1, 'Other loan document', '', '', '', '', '1372671097_1star.png', '1372671097_2star.png', '', '', '', '', '1372671097_3star.png', '', '', '', ''),
(2, 2, 2, 0, 0, 1, 1, 0, 0, -1, 'Other FD Doc', '', '', '', '', '', '', '1372671177_1star.png', '1372671177_2star.png', '', '', '1372671177_3star.png', '', '', '', ''),
(3, 3, 3, 0, 0, 0, 0, 1, 1, -1, 'Other savings document', '', '', '', '', '', '', '', '', '1372671413_1star.png', '1372671413_2star.png', '1372671413_3star.png', '', '', '', ''),
(4, 4, 7, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', 'Anyother document', '', '', '', '', '', '', '', '', '', '', '1372671451_4star.png'),
(5, 5, 4, 0, 0, 0, 0, 0, 0, 0, '', 'LIC Doc', '', '', '', '', '', '', '', '', '', '', '1372671527_add.png', '', '', ''),
(6, 6, 5, 0, 0, 0, 0, 0, 0, 0, '', '', 'Provident Fund', '', '', '', '', '', '', '', '', '', '', '1372671578_arrow-blue.png', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `stud_others`
--

CREATE TABLE IF NOT EXISTS `stud_others` (
  `detID` int(11) NOT NULL AUTO_INCREMENT,
  `studID` int(11) DEFAULT NULL,
  `knowRE` tinyint(4) DEFAULT NULL,
  `knowOthers` varchar(80) DEFAULT NULL,
  `iCentre` tinyint(4) DEFAULT NULL,
  `referrer` varchar(80) DEFAULT NULL,
  `engTest` tinyint(4) DEFAULT NULL,
  `iScore` decimal(2,1) DEFAULT NULL,
  `listen` decimal(2,1) DEFAULT NULL,
  `read` decimal(2,1) DEFAULT NULL,
  `write` decimal(2,1) DEFAULT NULL,
  `speak` decimal(2,1) DEFAULT NULL,
  `iDate` date NOT NULL DEFAULT '0000-00-00',
  `proBy` tinyint(4) DEFAULT NULL,
  `assignEmpID` int(11) DEFAULT NULL,
  `suppID` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`detID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `stud_others`
--

INSERT INTO `stud_others` (`detID`, `studID`, `knowRE`, `knowOthers`, `iCentre`, `referrer`, `engTest`, `iScore`, `listen`, `read`, `write`, `speak`, `iDate`, `proBy`, `assignEmpID`, `suppID`) VALUES
(1, 1, 3, '', 2, 'Counsellor Cok', 1, 7.0, 7.5, 8.0, 6.5, 6.0, '2012-12-12', 2, 4, 2),
(2, 2, 1, '', 0, '', 2, 0.0, 0.0, 0.0, 0.0, 0.0, '0000-00-00', 1, 3, 0),
(3, 3, 1, '', 0, '', 1, 6.8, 8.0, 6.0, 6.4, 6.8, '2012-12-12', 2, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `stud_passport`
--

CREATE TABLE IF NOT EXISTS `stud_passport` (
  `passID` int(11) NOT NULL AUTO_INCREMENT,
  `studID` int(11) DEFAULT NULL,
  `passNum` varchar(15) DEFAULT NULL,
  `expiry` date NOT NULL DEFAULT '0000-00-00',
  `visaNum` varchar(15) DEFAULT NULL,
  `fromDate` date NOT NULL DEFAULT '0000-00-00',
  `toDate` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`passID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `stud_passport`
--

INSERT INTO `stud_passport` (`passID`, `studID`, `passNum`, `expiry`, `visaNum`, `fromDate`, `toDate`) VALUES
(1, 1, 'PASS2342', '2018-06-20', NULL, '0000-00-00', '0000-00-00'),
(2, 3, 'PASS2342', '2018-06-20', '', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `stud_visa`
--

CREATE TABLE IF NOT EXISTS `stud_visa` (
  `svID` int(11) NOT NULL AUTO_INCREMENT,
  `studID` int(11) NOT NULL,
  `assignedBy` tinyint(4) DEFAULT NULL,
  `assignedTo` tinyint(4) DEFAULT NULL,
  `date` date DEFAULT '0000-00-00',
  `branchID` tinyint(4) DEFAULT NULL,
  `delStatus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`svID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `stud_visa`
--

INSERT INTO `stud_visa` (`svID`, `studID`, `assignedBy`, `assignedTo`, `date`, `branchID`, `delStatus`) VALUES
(1, 1, 3, 2, '2013-07-01', 1, 0),
(2, 1, 3, 2, '2013-07-01', 1, 0),
(3, 1, 3, 2, '2013-07-01', 1, 0),
(4, 1, 3, 2, '2013-07-01', 1, 0),
(5, 1, 3, 2, '2013-07-01', 1, 0),
(6, 1, 3, 2, '2013-07-01', 1, 0),
(7, 1, 3, 2, '2013-07-01', 1, 0),
(8, 1, 3, 2, '2013-07-01', 1, 0),
(9, 1, 3, 2, '2013-07-01', 1, 0),
(10, 1, 3, 2, '2013-07-01', 1, 0),
(11, 1, 3, 2, '2013-07-01', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subprograms`
--

CREATE TABLE IF NOT EXISTS `subprograms` (
  `spID` int(11) NOT NULL AUTO_INCREMENT,
  `pgmID` tinyint(4) DEFAULT NULL,
  `subpgm` varchar(255) DEFAULT NULL,
  `level` tinyint(4) DEFAULT NULL,
  `delStatus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`spID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=880 ;

--
-- Dumping data for table `subprograms`
--

INSERT INTO `subprograms` (`spID`, `pgmID`, `subpgm`, `level`, `delStatus`) VALUES
(1, 1, 'Accounting Technician Diploma', 1, 0),
(2, 1, 'Post Graduate Diploma in Financial  Analysis', 3, 0),
(3, 1, 'Post Graduate Diploma in Commerce', 3, 0),
(4, 1, 'Post Graduate Diploma in Accounting', 3, 0),
(5, 1, 'MIT Diploma in Professional Accounting', 1, 0),
(6, 1, 'Master of Information Management', 3, 0),
(7, 1, 'Master of Finance', 3, 0),
(8, 1, 'Master of Commerce & Administration', 3, 0),
(9, 1, 'Master of Commerce ', 3, 0),
(10, 1, 'Master of Applied Finanace', 3, 0),
(11, 1, 'Graduate Diploma in Professional Accounting', 3, 0),
(12, 1, 'Graduate Diploma in Management', 3, 0),
(13, 1, 'Graduate Diploma in Commerce ', 3, 0),
(14, 1, 'Graduate Diploma in Accounting and Information Systems', 3, 0),
(15, 1, 'Graduate Diploma in Accounting', 3, 0),
(16, 1, 'Diploma in Professional Accountancy', 1, 0),
(17, 1, 'Diploma in Accounting', 1, 0),
(18, 1, 'Bachelor of Commerce (Honours)', 2, 0),
(19, 1, 'Bachelor of Commerce & Administration with Honours', 2, 0),
(20, 1, 'Bachelor of Commerce & Administration', 2, 0),
(21, 1, 'Bachelor of Accountancy', 2, 0),
(22, 1, 'Bachelor of Commerce', 2, 0),
(23, 2, 'Bachelor of Art  and Design (Honours)', 2, 0),
(24, 2, 'Bachelor of Creative Technologies', 2, 0),
(25, 2, 'Bachelor of Creative Technologies (Honours)', 2, 0),
(26, 2, 'Bachelor of Design', 2, 0),
(27, 2, 'Bachelor of Visual Arts', 2, 0),
(28, 2, 'Diploma in Graphic Communication', 1, 0),
(29, 2, 'Master of Art and Design', 3, 0),
(30, 2, 'Master of Arts Management', 3, 0),
(31, 2, 'Master of Creative Technologies', 3, 0),
(32, 2, 'Master of Design', 3, 0),
(33, 2, 'Bachelor of Computing Systems', 2, 0),
(34, 2, 'Diploma in Graphic Design', 1, 0),
(35, 2, 'Graduate Diploma in Computing', 3, 0),
(36, 2, 'Bachelor of Applied Arts (Visual Arts and Design)', 2, 0),
(37, 2, 'Bachelor of Applied Arts (Visual Arts)', 2, 0),
(38, 2, 'Bachelor of Applied Media Arts (Visual Media)', 2, 0),
(39, 2, 'Bachelor of Applied Visual Imaging', 2, 0),
(40, 2, 'Bachelor of Computer Graphic Design', 2, 0),
(41, 2, 'Bachelor of Computer Graphic Design (Honours)', 2, 0),
(42, 2, 'Bachelor of Design (Honours)', 2, 0),
(43, 2, 'Bachelor of Media Arts', 2, 0),
(44, 2, 'Bachelor of Visual Arts & Design', 2, 0),
(45, 2, 'Diploma in Advanced Computer Aided Design', 1, 0),
(46, 2, 'Diploma in Animation', 1, 0),
(47, 2, 'Diploma in Art and Design', 1, 0),
(48, 2, 'Diploma in Art and Design (Advanced)', 1, 0),
(49, 2, 'Diploma in Computer Aided Design', 1, 0),
(50, 2, 'Diploma in Creative Technologies', 1, 0),
(51, 2, 'Diploma in Digital Film', 1, 0),
(52, 2, 'Diploma in Digital Multi Media Production', 1, 0),
(53, 2, 'Diploma in Graphics and Multimedia', 1, 0),
(54, 2, 'Diploma in Multimedia, Internet & Web designing', 1, 0),
(55, 2, 'Diploma in Systems Design & Implimentation', 1, 0),
(56, 2, 'Diploma in Technology (Interior Design)', 1, 0),
(57, 2, 'Diploma in Visual Arts', 1, 0),
(58, 2, 'Diploma in Visual Arts & Design', 1, 0),
(59, 2, 'Diploma in Webmastery', 1, 0),
(60, 2, 'Graduate Diploma In Design', 3, 0),
(61, 2, 'Graduate Diploma in Design (Multi speciality)', 3, 0),
(62, 2, 'Master of Arts', 3, 0),
(63, 2, 'Master of Design Thesis only', 3, 0),
(64, 2, 'Post Graduate Diploma In Design', 3, 0),
(65, 3, 'Bachelor of Applied Business Studies', 2, 0),
(66, 3, 'Bachelor of Applied Management', 2, 0),
(67, 3, 'Bachelor of Business', 2, 0),
(68, 3, 'Bachelor of Business (Accountancy, Finance, Management & Marketing)', 2, 0),
(69, 3, 'Bachelor of Business Analysis (Finance)', 2, 0),
(70, 3, 'Bachelor of Business and Information Management', 2, 0),
(71, 3, 'Bachelor of Business Honours', 2, 0),
(72, 3, 'Bachelor of Business Information Systems', 2, 0),
(73, 3, 'Bachelor of Business Management', 2, 0),
(74, 3, 'Bachelor of Business Studies', 2, 0),
(75, 3, 'Bachelor of International Business', 2, 0),
(76, 3, 'Bachelor of Management Studies', 2, 0),
(77, 3, 'Diploma in Applied Business', 1, 0),
(78, 3, 'Diploma in Applied Human Resources Management', 1, 0),
(79, 3, 'Diploma in Applied Management', 1, 0),
(80, 3, 'Diploma in Applied Management (Human Resource)', 1, 0),
(81, 3, 'Diploma in Applied Marketing', 1, 0),
(82, 3, 'Diploma in Business', 1, 0),
(83, 3, 'Diploma in Business Administration', 1, 0),
(84, 3, 'Diploma in Business Studies', 1, 0),
(85, 3, 'Diploma in Human Resource Management', 1, 0),
(86, 3, 'Diploma in Human Resources', 1, 0),
(87, 3, 'Diploma in Integrated Marketing Communications', 1, 0),
(88, 3, 'Diploma in International Business', 1, 0),
(89, 3, 'Diploma in Management', 1, 0),
(90, 3, 'Diploma in Marketing', 1, 0),
(91, 3, 'Diploma in Tourism Management', 1, 0),
(92, 3, 'Graduate Diploma in Applied Business Studies', 3, 0),
(93, 3, 'Graduate Diploma in Business', 3, 0),
(94, 3, 'Graduate Diploma in Business Information Systems', 3, 0),
(95, 3, 'Graduate Diploma in Business Studies', 3, 0),
(96, 3, 'Graduate Diploma in Business Transformation and Change', 3, 0),
(97, 3, 'Graduate Diploma in Event Management', 3, 0),
(98, 3, 'Graduate Diploma in Human Resource Management', 3, 0),
(99, 3, 'Graduate Diploma in Innovation and Entrepreneurship', 3, 0),
(100, 3, 'Graduate Diploma in International Business', 3, 0),
(101, 3, 'Graduate Diploma in Management', 3, 0),
(102, 3, 'Graduate Diploma in Marketing', 3, 0),
(103, 3, 'Graduate Diploma in Project Management', 3, 0),
(104, 3, 'Graduate Diploma in Sales and Marketing', 3, 0),
(105, 3, 'Master of Business', 3, 0),
(106, 3, 'Master of Business Administration', 3, 0),
(107, 3, 'Master of Business Management', 3, 0),
(108, 3, 'Master of Business Studies', 3, 0),
(109, 3, 'Master of Management', 3, 0),
(110, 3, 'Master of Management Studies', 3, 0),
(111, 3, 'Master of Professional Business Studies', 3, 0),
(112, 3, 'Master of Public Management', 3, 0),
(113, 3, 'Master of Public Policy', 3, 0),
(114, 3, 'Master of Strategic Studies', 3, 0),
(115, 3, 'National Certificate in First Line Management', NULL, 0),
(116, 3, 'National Diploma in Business', 1, 0),
(117, 3, 'National Diploma in Business Administration', 1, 0),
(118, 3, 'New Zealand Diploma in Business', 1, 0),
(120, 3, 'NZIM Diploma in Management', 1, 0),
(121, 3, 'Postgraduate Diploma in Business', 3, 0),
(122, 3, 'Postgraduate Diploma in Business Administration', 3, 0),
(123, 3, 'Postgraduate Diploma in Business and Administration', 3, 0),
(124, 3, 'Postgraduate Diploma in Business Enterprise', 3, 0),
(125, 3, 'Postgraduate Diploma in Business Management', 3, 0),
(126, 3, 'Postgraduate Diploma in International Business', 3, 0),
(127, 3, 'Postgraduate Diploma in Public Management', 3, 0),
(128, 3, 'Postgraduate Diploma in Public Policy', 3, 0),
(129, 3, 'Postgraduate Diploma in Strategic Studies', 3, 0),
(130, 3, 'Weltec Diploma in Marketing', 1, 0),
(131, 4, 'Bachelor of Applied Information Systems', 2, 0),
(132, 4, 'Bachelor of Computer and Information Sciences', 2, 0),
(134, 4, 'Bachelor of Computer and Information Sciences (Honours)', 2, 0),
(135, 4, 'Bachelor of Computer Graphic Design', 2, 0),
(136, 4, 'Bachelor of Computer Graphic Design (Honours)', 2, 0),
(137, 4, 'Bachelor of Computing and Mathematical Sciences', 2, 0),
(138, 4, 'Bachelor of Computing Systems', 2, 0),
(139, 4, 'Bachelor of Information and Communication Technologies', 2, 0),
(140, 4, 'Bachelor of Information and Communications Technology (Applied)', 2, 0),
(141, 4, 'Bachelor of Information Sciences ', 2, 0),
(142, 4, 'Bachelor of Information Technology', 2, 0),
(143, 4, 'Bachelor of Mathematical Sciences', 2, 0),
(144, 4, 'BCA (Hons)', 2, 0),
(145, 4, 'Diploma in Computer Networking', 1, 0),
(146, 4, 'Diploma in Computer Servicing', 1, 0),
(147, 4, 'Diploma in Computing and Information Technology ', 1, 0),
(148, 4, 'Diploma in Computing Systems', 1, 0),
(149, 4, 'Diploma in Design Technology (CAD) ', 1, 0),
(150, 4, 'Diploma in Hardware and Operating Systems', 1, 0),
(151, 4, 'Diploma in Information and Communication Technology', 1, 0),
(152, 4, 'Diploma in Information and Communication Technology (Applied)', 1, 0),
(153, 4, 'Diploma in Information Design', 1, 0),
(154, 4, 'Diploma in Information Systems', 1, 0),
(155, 4, 'Diploma in Information Technology', 1, 0),
(156, 4, 'Diploma in Interactive Multimedia Development', 1, 0),
(157, 4, 'Diploma in Multimedia and Web Development', 1, 0),
(158, 4, 'Diploma in Networking & Communication Technology', 1, 0),
(159, 4, 'Diploma in Programming', 1, 0),
(160, 4, 'Doctor of Computing', 3, 0),
(161, 4, 'Graduate Certificate in Information Technology', NULL, 0),
(162, 4, 'Graduate Diploma in Computer and Information Sciences', 3, 0),
(163, 4, 'Graduate Diploma in Computer Science', 3, 0),
(164, 4, 'Graduate Diploma in Computing', 3, 0),
(165, 4, 'Graduate Diploma in Information and Communication Technologies', 3, 0),
(166, 4, 'Graduate Diploma in Information Assurance & Security?', 3, 0),
(167, 4, 'Graduate Diploma in Information Sciences ', 3, 0),
(168, 4, 'Graduate Diploma in Information Technology', 3, 0),
(169, 4, 'Graduate diploma in IT', 3, 0),
(170, 4, 'Graduate Diploma in Mathematical Sciences', 3, 0),
(171, 4, 'Graduate Diploma in Mechatronics', 3, 0),
(172, 4, 'Master of Computer and Information Sciences', 3, 0),
(173, 4, 'Master of Computer Graphic Design', 3, 0),
(174, 4, 'Master of Computer Sciences', 3, 0),
(175, 4, 'Master of Computing', 3, 0),
(176, 4, 'Master of Forensic Information Technology', 3, 0),
(177, 4, 'Master of Information Sciences ', 3, 0),
(178, 4, 'National diploma in computing', NULL, 0),
(179, 4, 'Post Graduate Diploma in Information Sciences ', 3, 0),
(180, 4, 'Post Graduate Diploma of Computer Graphic Design', 3, 0),
(181, 4, 'Postgraduate Diploma in Computer and Information Sciences', 3, 0),
(182, 4, 'Postgraduate Diploma in Computer Graphic Design', 3, 0),
(183, 4, 'Postgraduate Diploma in Computing', 3, 0),
(184, 5, 'Bachelor of Applied Technology (Automotive Engineering)', 2, 0),
(185, 5, 'Bachelor of Applied Technology (Electrotechnology)', 2, 0),
(186, 5, 'Bachelor of Engineering ', 2, 0),
(187, 5, 'Bachelor of Engineering (BE)/(BE (Hons)) (Electronics AND Computer Engineering)', 2, 0),
(188, 5, 'Bachelor of Engineering (Honours)', 2, 0),
(189, 5, 'Bachelor of Engineering Technology', 2, 0),
(190, 5, 'Bachelor of Engineering Technology (Electrotechnology)', 2, 0),
(191, 5, 'Bachelor of Engineering with Honours', 2, 0),
(192, 5, 'Bachelor of Technology', 2, 0),
(193, 5, 'Diploma in Advanced Computer Aided Design', 1, 0),
(194, 5, 'Diploma in Applied Computing Systems Engineering', 1, 0),
(195, 5, 'Diploma in Competitive Manufacturing', 1, 0),
(196, 5, 'Diploma in Computer Aided Design', 1, 0),
(197, 5, 'Diploma in Computer Integrated Manufacture', 1, 0),
(198, 5, 'Diploma in Electrical and Computer Engineering', 1, 0),
(199, 5, 'Diploma in Electrotechnology', 1, 0),
(200, 5, 'Diploma in Engineering', 1, 0),
(201, 5, 'Diploma in Engineering (Civil)', 1, 0),
(202, 5, 'Diploma in Engineering (Mechanical)', 1, 0),
(203, 5, 'Diploma in Software Engineering', 3, 0),
(204, 5, 'Graduate Diploma in Engineering ', 3, 0),
(205, 5, 'Graduate Diploma in Technology', 3, 0),
(206, 5, 'Master of Engineering', 3, 0),
(207, 5, 'Master of Engineering Management ', 3, 0),
(208, 5, 'Master of Engineering Studies', 3, 0),
(209, 5, 'Master of Technology', 3, 0),
(210, 5, 'National Certificate in Automotive Engg', NULL, 0),
(211, 5, 'National Certificate in Electrical Engineering (Electrician for Registration)', NULL, 0),
(212, 5, 'National Diploma in Engineering (Civil Engineering)', 1, 0),
(213, 5, 'National Diploma in Engineering (Electrotechnology) ', 1, 0),
(214, 5, 'National Diploma in Engineering (Mechanical engineering)', 1, 0),
(215, 5, 'National Diploma in Engineering (Mechanical)', 1, 0),
(216, 5, 'National Diploma in?Electrotechnology', 1, 0),
(217, 5, 'New Zealand Diploma in Civil Engineering?', 1, 0),
(218, 5, 'New Zealand Diploma in Engineering (Civil)', 1, 0),
(219, 5, 'Post Graduate Diploma in Technology', 3, 0),
(220, 5, 'Postgraduate Diploma in Engineering', 3, 0),
(221, 6, 'Bachelor of Wine Science', 2, 0),
(222, 6, 'Bachelor of Viticulture', 2, 0),
(223, 6, 'Diploma in Horticultural Management', 1, 0),
(224, 6, 'Diploma in Horticulture', 1, 0),
(225, 6, 'Diploma in viticulture & Winemaking', 1, 0),
(226, 6, 'National cert. In Horticulture (Advance)', NULL, 0),
(227, 6, 'National Certificate in Horticulture', NULL, 0),
(228, 6, 'National Certificate in Horticulture (Advance)', NULL, 0),
(229, 7, 'Bachelor of Applied Hospitality & Tourism Management', 2, 0),
(230, 7, 'Bachelor of Hospitality Management', 2, 0),
(231, 7, 'Bachelor of Hotel Management', 2, 0),
(232, 7, 'Bachelor of International Hospitality Management', 2, 0),
(233, 7, 'Diploma in Culinary Arts', 1, 0),
(234, 7, 'Diploma in Culinary Practice', 1, 0),
(235, 7, 'Diploma in Event Management', 1, 0),
(236, 7, 'Diploma in Hospitality Management', 1, 0),
(237, 7, 'Diploma in Hospitality Operations Supervision', 1, 0),
(238, 7, 'Diploma in Hotel and Tourism Management', 1, 0),
(239, 7, 'Diploma in Hotel Management', 1, 0),
(240, 7, 'Diploma in International Culinary Arts', 1, 0),
(241, 7, 'Diploma in International Tourism', 1, 0),
(242, 7, 'Diploma in Professional Cookery', 1, 0),
(243, 7, 'Master of International Hospitality Management', 3, 0),
(244, 7, 'Master of Professional Hospitality Studies', 3, 0),
(245, 7, 'National Certificate In Hospitality (Professional Cookery)', NULL, 0),
(246, 7, 'National Diploma in Business?', 1, 0),
(247, 7, 'National Diploma in Hospitality (Management)', 1, 0),
(248, 7, 'NZIM/ATTTO Diploma in Tourism Management', 1, 0),
(249, 7, 'Post Graduate Diploma in Hotel Management', 3, 0),
(250, 8, 'Bachelor of Laws\r\n', 2, 0),
(251, 8, 'Graduate Diploma in Law\r\n', 3, 0),
(252, 8, 'Master of Laws\r\n', 3, 0),
(253, 8, 'Master of Legal Studies \r\n', 3, 0),
(254, 8, 'Post Graduate Diploma in Law\r\n', 3, 0),
(255, 9, 'Diploma in Supply Chain Management\r\n', 1, 0),
(256, 9, 'Master of  Logistics & Supply Chain Management\r\n', 3, 0),
(257, 9, 'National Diploma in Logistics Operations\r\n', 1, 0),
(258, 9, 'Post Graduate Diploma in Logistics & Supply Chain Management\r\n', 3, 0),
(259, 10, 'Bachelor of Health Science', 2, 0),
(260, 10, 'Bachelor of Dental Surgery', 2, 0),
(261, 10, 'Bachelor of Dental Technology', 2, 0),
(262, 10, 'Bachelor of Health Science', 2, 0),
(263, 10, 'Bachelor of Health Science (Honours)', 2, 0),
(264, 10, 'Bachelor of Health Science (Medical Imaging)', 2, 0),
(265, 10, 'Bachelor of Health Science (Paramedic)', 2, 0),
(266, 10, 'Bachelor of Medical Laboratory Science', 2, 0),
(267, 10, 'Bachelor of Medicine and Bachelor of Surgery', 2, 0),
(268, 10, 'Bachelor of Midwifery', 2, 0),
(269, 10, 'Bachelor of Nursing', 2, 0),
(270, 10, 'Bachelor of Nursing (Honours)', 2, 0),
(271, 10, 'Bachelor of Nursing for Overseas regd nurses', 2, 0),
(272, 10, 'Bachelor of Nursing for Registered Nurses', 2, 0),
(273, 10, 'Bachelor of Nursing for Undergraduates', 2, 0),
(274, 10, 'Bachelor of Occupational Therapy', 2, 0),
(275, 10, 'Bachelor of Occupational Therapy Honours', 2, 0),
(276, 10, 'Bachelor of Optometry', 2, 0),
(277, 10, 'Bachelor of Pharmacy', 2, 0),
(278, 10, 'Bachelor of Physiotherapy', 2, 0),
(279, 10, 'Certificate in Contemporary NZ Nursing Practice', NULL, 0),
(280, 10, 'Certificate in Registered Nurse Competence', NULL, 0),
(281, 10, 'Certificate of Achievement in Registered Nurse Competency to Practise', NULL, 0),
(282, 10, 'Competancy Assessment Programme', NULL, 0),
(283, 10, 'Competency Assessment Programme for Overseas Registered Nurses ', NULL, 0),
(284, 10, 'Diploma in Mental Health Support Work', 1, 0),
(285, 10, 'Diploma in Natural and Complimentary Medicine ', 1, 0),
(286, 10, 'Diploma in Violence and Trauma Studies', 1, 0),
(287, 10, 'Graduate Diploma in Addictions', 3, 0),
(288, 10, 'Graduate Diploma in Health Sciences ', 3, 0),
(289, 10, 'Graduate Diploma in Psychosocial Studies', 3, 0),
(291, 10, 'Master of  Nursing', 3, 0),
(292, 10, 'Master of Community  Dentistry', 3, 0),
(293, 10, 'Master of Dental Surgery', 3, 0),
(294, 10, 'Master of Dental Technology', 3, 0),
(295, 10, 'Master of Emergency Management ', 3, 0),
(296, 10, 'Master of Health Management ', 3, 0),
(297, 10, 'Master of Health Practice', 3, 0),
(298, 10, 'Master of Health Science (Medical Radiation Technology)', 3, 0),
(299, 10, 'Master of Medical Science ', 3, 0),
(300, 10, 'Master of Midwifery', 3, 0),
(301, 10, 'Master of Nursing', 3, 0),
(302, 10, 'Master of Occupational Therapy', 3, 0),
(303, 10, 'Master of Osteopathy', 3, 0),
(304, 10, 'Master of Pharmacy Practice ', 3, 0),
(305, 10, 'Master of Philosophy', 3, 0),
(306, 10, 'Master of Physiotherapy', 3, 0),
(307, 10, 'Master of Public Health ', 3, 0),
(308, 10, 'National Certificate in Mental Health (Mental Health Support Work)', NULL, 0),
(309, 10, 'National Diploma in Mental Health (Mental Health Support Work)', 1, 0),
(310, 10, 'Nursing in New Zealand', NULL, 0),
(311, 10, 'Post Graduate Diploma in Clinical Dental Technology', 3, 0),
(312, 10, 'Post Graduate Diploma in Clinical Dentistry', 3, 0),
(313, 10, 'Post Graduate Diploma in Clinical Psychology', 3, 0),
(314, 10, 'Post Graduate Diploma in Community  Dentistry', 3, 0),
(315, 10, 'Post Graduate Diploma in Dental Technology', 3, 0),
(316, 10, 'Post Graduate Diploma in Health Science', 3, 0),
(317, 10, 'Post Graduate Diploma in Midwifery', 3, 0),
(318, 10, 'Post Graduate Diploma in Nursing', 3, 0),
(319, 10, 'Postgraduate Certificate In Health Science', 3, 0),
(320, 10, 'Postgraduate Diploma in Clinical Psychology ', 3, 0),
(321, 10, 'Postgraduate Diploma in Counselling Psychology', 3, 0),
(322, 10, 'Postgraduate Diploma in Dental Therapy', 3, 0),
(323, 10, 'Postgraduate Diploma in Health Psychology ', 3, 0),
(324, 10, 'Postgraduate Diploma in Health Science', 3, 0),
(325, 10, 'Postgraduate Diploma in Health Science (Medical Radiation Technology)', 3, 0),
(326, 10, 'Postgraduate Diploma in Medical Science ', 3, 0),
(327, 10, 'Postgraduate Diploma in Obstetrics and Medical Gynaecology ', 3, 0),
(328, 10, 'Postgraduate Diploma in Pharmacy Practice ', 3, 0),
(329, 10, 'Postgraduate Diploma in Physiotherapy', 3, 0),
(330, 10, 'Postgraduate Diploma in Public Health ', 3, 0),
(331, 10, 'Postgraduate Diploma in Science ', 3, 0),
(332, 10, 'Registered Nurse Competency Programme', NULL, 0),
(333, 11, 'Bachelor of Alcohol & Drug Studies', 2, 0),
(334, 11, 'Bachelor of Applied Social Science', 2, 0),
(335, 11, 'Bachelor of Applied Social Science (Counselling)', 2, 0),
(336, 11, 'Bachelor of Applied Social Science (Social Work)', 2, 0),
(337, 11, 'Bachelor of Applied Social Work', 2, 0),
(338, 11, 'Bachelor of Counselling', 2, 0),
(339, 11, 'Bachelor of Social Practice (Community Development)', 2, 0),
(340, 11, 'Bachelor of Social Practice (Counselling)', 2, 0),
(341, 11, 'Bachelor of Social Practice (Social Work)', 2, 0),
(342, 11, 'Bachelor of Social Work', 2, 0),
(343, 11, 'Diploma in Alcohol and Drug Studies', 1, 0),
(344, 11, 'Diploma in Applied Social Service (Speciality)', 1, 0),
(345, 11, 'Diploma in Counselling', 1, 0),
(346, 11, 'Diploma in Health Psychology', 1, 0),
(347, 11, 'Graduate Diploma in Addiction Studies', 3, 0),
(348, 11, 'Master of Social Practice', 3, 0),
(349, 11, 'Master of Social Work', 3, 0),
(350, 11, 'Master of Social Work (Applied)', 3, 0),
(351, 11, 'National Certificate in Social Services', NULL, 0),
(352, 11, 'Postgraduate Diploma in Social Practice', 3, 0),
(353, 11, 'Postgraduate Diploma in Social Work', 3, 0),
(354, 12, 'Bachelor in Veterinary Nursing', 2, 0),
(355, 12, 'Bachelor of Applied Science', 2, 0),
(356, 12, 'Bachelor of Applied Science (Honours)', 2, 0),
(357, 12, 'Bachelor of Applied Science (Human Biology)', 2, 0),
(358, 12, 'Bachelor of Applied Science (Medical Imaging Technology)', 2, 0),
(359, 12, 'Bachelor of Biomedical Science ', 2, 0),
(360, 12, 'Bachelor of Biomedical Science with Honours ', 2, 0),
(361, 12, 'Bachelor of Food Technology  (Honours)', 2, 0),
(362, 12, 'Bachelor of Medical Laboratory Science', 2, 0),
(363, 12, 'Bachelor of Science ', 2, 0),
(364, 12, 'Bachelor of Science & Technology', 2, 0),
(365, 12, 'Bachelor of Science (Honours)', 2, 0),
(366, 12, 'Bachelor of Science (Technology)', 2, 0),
(367, 12, 'Diploma in Applied Science', 1, 0),
(368, 12, 'Diploma in Science', 1, 0),
(369, 12, 'Diploma in Science & Technology', 1, 0),
(370, 12, 'Diploma in Veterinary Nursing', 1, 0),
(371, 12, 'Graduate Diploma in Applied Science', 3, 0),
(372, 12, 'Graduate Diploma in Biomedical Science ', 3, 0),
(373, 12, 'Graduate Diploma in Laboratory Technology', 3, 0),
(374, 12, 'Graduate Diploma in Science', 3, 0),
(375, 12, 'Master in Science', 3, 0),
(376, 12, 'Master of Applied Science', 3, 0),
(377, 12, 'Master of Biomedical Science', 3, 0),
(378, 12, 'Master of Health Sciences', 3, 0),
(379, 12, 'Master of Medical Laboratory Science', 3, 0),
(380, 12, 'Master of Science (Technology)', 3, 0),
(381, 12, 'Master of Science Communication', 3, 0),
(382, 12, 'Master of Veterinary Science', 3, 0),
(383, 12, 'National Certificate in Veterinary Nursing', NULL, 0),
(384, 12, 'National Diploma in Science', 1, 0),
(385, 12, 'Post graduate diploma in Veterinary Public Health', 3, 0),
(386, 12, 'Postgraduate Diploma in  Medical Laboratory Science', 3, 0),
(387, 12, 'Postgraduate Diploma in Applied Science', 3, 0),
(388, 12, 'Postgraduate Diploma in Health Management', 3, 0),
(389, 12, 'Postgraduate Diploma in Health Sciences', 3, 0),
(390, 12, 'Postgraduate Diploma in Science', 3, 0),
(506, 15, 'Bachelor of Arts with Honours in American Studies', 2, 0),
(507, 15, 'Bachelor of Arts with Honours in Ancient History', 2, 0),
(508, 15, 'Bachelor of Arts with Honours in Anthropology', 2, 0),
(509, 15, 'Bachelor of Arts with Honours in Art History and Theory', 2, 0),
(510, 15, 'Bachelor of Arts with Honours in Chinese', 2, 0),
(511, 15, 'Bachelor of Arts with Honours in Cinema Studies', 2, 0),
(512, 15, 'Bachelor of Arts with Honours in Classics (including Greek and Latin)', 2, 0),
(513, 15, 'Bachelor of Arts with Honours in Cultural Studies', 2, 0),
(514, 15, 'Bachelor of Arts with Honours in Diplomacy and International Relations', 2, 0),
(515, 15, 'Bachelor of Arts with Honours in Economics', 2, 0),
(516, 15, 'Bachelor of Arts with Honours in Education', 2, 0),
(517, 15, 'Bachelor of Arts with Honours in English', 2, 0),
(518, 15, 'Bachelor of Arts with Honours in European Studies', 2, 0),
(519, 15, 'Bachelor of Arts with Honours in French', 2, 0),
(520, 15, 'Bachelor of Arts with Honours in Gender Studies', 2, 0),
(521, 15, 'Bachelor of Arts with Honours in Geography', 2, 0),
(522, 15, 'Bachelor of Arts with Honours in German', 2, 0),
(523, 15, 'Bachelor of Arts with Honours in History', 2, 0),
(524, 15, 'Bachelor of Arts with Honours in History and Philosophy of Science', 2, 0),
(525, 15, 'Bachelor of Arts with Honours in Human Services', 2, 0),
(526, 15, 'Bachelor of Arts with Honours in Japanese', 2, 0),
(527, 15, 'Bachelor of Arts with Honours in Linguistics', 2, 0),
(528, 15, 'Bachelor of Arts with Honours in Maori ', 2, 0),
(529, 15, 'Bachelor of Arts with Honours in Mathematics', 2, 0),
(530, 15, 'Bachelor of Arts with Honours in Media and Communication', 2, 0),
(531, 15, 'Bachelor of Arts with Honours in Music', 2, 0),
(532, 15, 'Bachelor of Arts with Honours in Pacific Studies', 2, 0),
(533, 15, 'Bachelor of Arts with Honours in Philosophy', 2, 0),
(534, 15, 'Bachelor of Arts with Honours in Political Science', 2, 0),
(535, 15, 'Bachelor of Arts with Honours in Psychology', 2, 0),
(536, 15, 'Bachelor of Arts with Honours in Religious Studies', 2, 0),
(537, 15, 'Bachelor of Arts with Honours in Russian', 2, 0),
(538, 15, 'Bachelor of Arts with Honours in Social Work', 2, 0),
(539, 15, 'Bachelor of Arts with Honours in Sociology', 2, 0),
(540, 15, 'Bachelor of Arts with Honours in Spanish', 2, 0),
(541, 15, 'Bachelor of Arts with Honours in Statistics', 2, 0),
(542, 15, 'Bachelor of Arts with Honours in Theatre and Film Studies', 2, 0),
(543, 15, 'Bachelor of Arts in American Studies', 2, 0),
(544, 15, 'Bachelor of Arts in Anthropology', 2, 0),
(545, 15, 'Bachelor of Arts in Art History and Theory', 2, 0),
(546, 15, 'Bachelor of Arts in Chinese', 2, 0),
(547, 15, 'Bachelor of Arts in Classics (including Greek and Latin)', 2, 0),
(548, 15, 'Bachelor of Arts in Cultural Studies', 2, 0),
(549, 15, 'Bachelor of Arts in Economics', 2, 0),
(550, 15, 'Bachelor of Arts in Education', 2, 0),
(551, 15, 'Bachelor of Arts in English', 2, 0),
(552, 15, 'Bachelor of Arts in European Languages and Cultures', 2, 0),
(553, 15, 'Bachelor of Arts in European Union Studies', 2, 0),
(554, 15, 'Bachelor of Arts in French', 2, 0),
(555, 15, 'Bachelor of Arts in Gender Studies', 2, 0),
(556, 15, 'Bachelor of Arts in Geography', 2, 0),
(557, 15, 'Bachelor of Arts in German', 2, 0),
(558, 15, 'Bachelor of Arts in History', 2, 0),
(559, 15, 'Bachelor of Arts in Human Services', 2, 0),
(560, 15, 'Bachelor of Arts in Japanese', 2, 0),
(561, 15, 'Bachelor of Arts in Linguistics', 2, 0),
(562, 15, 'Bachelor of Arts in Management Science', 2, 0),
(563, 15, 'Bachelor of Arts in Maori and Indigenous Studies', 2, 0),
(564, 15, 'Bachelor of Arts in Mass Communication', 2, 0),
(565, 15, 'Bachelor of Arts in Mathematics', 2, 0),
(566, 15, 'Bachelor of Arts in Music', 2, 0),
(567, 15, 'Bachelor of Arts in Philosophy', 2, 0),
(568, 15, 'Bachelor of Arts in Political Science', 2, 0),
(569, 15, 'Bachelor of Arts in Psychology', 2, 0),
(570, 15, 'Bachelor of Arts in Religious Studies', 2, 0),
(571, 15, 'Bachelor of Arts in Russian', 2, 0),
(572, 15, 'Bachelor of Arts in Sociology', 2, 0),
(573, 15, 'Bachelor of Arts in Spanish', 2, 0),
(574, 15, 'Bachelor of Arts in Statistics', 2, 0),
(575, 15, 'Bachelor of Arts in Theatre and Film Studies', 2, 0),
(576, 15, 'Graduate Diploma in American Studies', 3, 0),
(577, 15, 'Graduate Diploma in Anthropology', 3, 0),
(578, 15, 'Graduate Diploma in Art History and Theory', 3, 0),
(579, 15, 'Graduate Diploma in Chinese', 3, 0),
(580, 15, 'Graduate Diploma in Classics (including Greek and Latin)', 3, 0),
(581, 15, 'Graduate Diploma in Cultural Studies', 3, 0),
(582, 15, 'Graduate Diploma in Economics', 3, 0),
(583, 15, 'Graduate Diploma in Education', 3, 0),
(584, 15, 'Graduate Diploma in English', 3, 0),
(585, 15, 'Graduate Diploma in European Languages and Cultures', 3, 0),
(586, 15, 'Graduate Diploma in European Union Studies', 3, 0),
(587, 15, 'Graduate Diploma in French', 3, 0),
(588, 15, 'Graduate Diploma in Gender Studies', 3, 0),
(589, 15, 'Graduate Diploma in Geography', 3, 0),
(590, 15, 'Graduate Diploma in German', 3, 0),
(591, 15, 'Graduate Diploma in History', 3, 0),
(592, 15, 'Graduate Diploma in Human Services', 3, 0),
(593, 15, 'Graduate Diploma in Japanese', 3, 0),
(594, 15, 'Graduate Diploma in Linguistics', 3, 0),
(595, 15, 'Graduate Diploma in Management Science', 3, 0),
(596, 15, 'Graduate Diploma in Maori and Indigenous Studies', 3, 0),
(597, 15, 'Graduate Diploma in Mass Communication', 3, 0),
(598, 15, 'Graduate Diploma in Mathematics', 3, 0),
(599, 15, 'Graduate Diploma in Music', 3, 0),
(600, 15, 'Graduate Diploma in Philosophy', 3, 0),
(601, 15, 'Graduate Diploma in Political Science', 3, 0),
(602, 15, 'Graduate Diploma in Psychology', 3, 0),
(603, 15, 'Graduate Diploma in Religious Studies', 3, 0),
(604, 15, 'Graduate Diploma in Russian', 3, 0),
(605, 15, 'Graduate Diploma in Sociology', 3, 0),
(606, 15, 'Graduate Diploma in Spanish', 3, 0),
(607, 15, 'Graduate Diploma in Statistics', 3, 0),
(608, 15, 'Graduate Diploma in Theatre and Film Studies', 3, 0),
(609, 15, 'Graduate Diploma in Business Administration', 3, 0),
(610, 15, 'Graduate Diploma in Economics', 3, 0),
(611, 15, 'Graduate Diploma in Forestry', 3, 0),
(612, 15, 'Graduate Diploma in Management', 3, 0),
(613, 15, 'Master of Arts in American Studies', 3, 0),
(614, 15, 'Master of Arts in Ancient History', 3, 0),
(615, 15, 'Master of Arts in Anthropology', 3, 0),
(616, 15, 'Master of Arts in Art History and Theory', 3, 0),
(617, 15, 'Master of Arts in Child and Family Psychology', 3, 0),
(618, 15, 'Master of Arts in Chinese', 3, 0),
(619, 15, 'Master of Arts in Cinema Studies', 3, 0),
(620, 15, 'Master of Arts in Classics (including Greek and Latin)', 3, 0),
(621, 15, 'Master of Arts in Cultural Studies', 3, 0),
(622, 15, 'Master of Arts in Diplomacy and International Relations', 3, 0),
(623, 15, 'Master of Arts in Economics', 3, 0),
(624, 15, 'Master of Arts in Education', 3, 0),
(625, 15, 'Master of Arts in English', 3, 0),
(626, 15, 'Master of Arts in European Studies', 3, 0),
(627, 15, 'Master of Arts in French', 3, 0),
(628, 15, 'Master of Arts in Gender Studies', 3, 0),
(629, 15, 'Master of Arts in Geography', 3, 0),
(630, 15, 'Master of Arts in German', 3, 0),
(631, 15, 'Master of Arts in History', 3, 0),
(632, 15, 'Master of Arts in History and Philosophy of Science', 3, 0),
(633, 15, 'Master of Arts in Human Services', 3, 0),
(634, 15, 'Master of Arts in Japanese', 3, 0),
(635, 15, 'Master of Arts in Linguistics', 3, 0),
(636, 15, 'Master of Arts in Maori ', 3, 0),
(637, 15, 'Master of Arts in Mathematics', 3, 0),
(638, 15, 'Master of Arts in Media and Communication', 3, 0),
(639, 15, 'Master of Arts in Music', 3, 0),
(640, 15, 'Master of Arts in Pacific Studies', 3, 0),
(641, 15, 'Master of Arts in Philosophy', 3, 0),
(642, 15, 'Master of Arts in Political Science', 3, 0),
(643, 15, 'Master of Arts in Psychology', 3, 0),
(644, 15, 'Master of Arts in Religious Studies', 3, 0),
(645, 15, 'Master of Arts in Russian', 3, 0),
(646, 15, 'Master of Arts in Social Work', 3, 0),
(647, 15, 'Master of Arts in Sociology', 3, 0),
(648, 15, 'Master of Arts in Spanish', 3, 0),
(649, 15, 'Master of Arts in Statistics', 3, 0),
(650, 15, 'Master of Arts in Theatre and Film Studies', 3, 0),
(651, 1, 'Bachelor of Commerce in Accounting and Information Systems', 2, 0),
(652, 1, 'Bachelor of Commerce in Computer Science', 2, 0),
(653, 1, 'Bachelor of Commerce in Economics', 2, 0),
(654, 1, 'Bachelor of Commerce in Finance', 2, 0),
(655, 1, 'Bachelor of Commerce in Management', 2, 0),
(656, 1, 'Bachelor of Commerce in Management Science', 2, 0),
(657, 1, 'Bachelor of Commerce in Accounting', 2, 0),
(658, 1, 'Bachelor of Commerce in Computer Systems and Networks', 2, 0),
(659, 1, 'Bachelor of Commerce in Human Resource Development', 2, 0),
(660, 1, 'Bachelor of Commerce in Information Systems', 2, 0),
(661, 1, 'Bachelor of Commerce in International Business', 2, 0),
(662, 1, 'Bachelor of Commerce in Marketing', 2, 0),
(663, 1, 'Bachelor of Commerce in Operations Management', 2, 0),
(664, 1, 'Bachelor of Commerce in Operations Research', 2, 0),
(665, 1, 'Bachelor of Commerce in Software Development', 2, 0),
(666, 1, 'Bachelor of Commerce in Strategic Management', 2, 0),
(667, 1, 'Bachelor of Commerce in Taxation and Accounting', 2, 0),
(668, 1, 'Bachelor of Commerce with Honours in Accounting and Information Systems', 2, 0),
(669, 1, 'Bachelor of Commerce with Honours in Computer Science', 2, 0),
(670, 1, 'Bachelor of Commerce with Honours in Economics', 2, 0),
(671, 1, 'Bachelor of Commerce with Honours in Finance', 2, 0),
(672, 1, 'Bachelor of Commerce with Honours in Management', 2, 0),
(673, 1, 'Bachelor of Commerce with Honours in Management Science', 2, 0),
(674, 1, 'Master of Commerce in Accounting and Information Systems', 3, 0),
(675, 1, 'Master of Commerce in Computer Science', 3, 0),
(676, 1, 'Master of Commerce in Economics', 3, 0),
(677, 1, 'Master of Commerce in Finance', 3, 0),
(678, 1, 'Master of Commerce in Management', 3, 0),
(679, 1, 'Master of Commerce in Management Science', 3, 0),
(680, 18, 'Bachelor of Education', 2, 0),
(681, 18, 'Physical Education', NULL, 0),
(682, 18, 'Bachelor of Teaching and Learning (Early Childhood)', 2, 0),
(683, 18, 'Bachelor of Teaching and Learning (Primary)', 2, 0),
(684, 18, 'Bachelor of Sport Coaching', 2, 0),
(685, 5, 'Bachelor of Engineering (Honours) in Chemical and Process', 2, 0),
(686, 5, 'Bachelor of Engineering (Honours) in Civil', 2, 0),
(687, 5, 'Bachelor of Engineering (Honours) in Computer', 2, 0),
(688, 5, 'Bachelor of Engineering (Honours) in Electrical and Electronic', 2, 0),
(689, 5, 'Bachelor of Engineering (Honours) in Forest', 2, 0),
(690, 5, 'Bachelor of Engineering (Honours) in Mechanical', 2, 0),
(691, 5, 'Bachelor of Engineering (Honours) in Mechatronics', 2, 0),
(692, 5, 'Bachelor of Engineering (Honours) in Natural Resources', 2, 0),
(693, 17, 'Bachelor of Fine Arts (Honours) in Film ', 2, 0),
(694, 17, 'Bachelor of Fine Arts (Honours) in Graphic Design', 2, 0),
(695, 17, 'Bachelor of Fine Arts (Honours) in Painting', 2, 0),
(696, 17, 'Bachelor of Fine Arts (Honours) in Photography', 2, 0),
(697, 17, 'Bachelor of Fine Arts (Honours) in Printmaking', 2, 0),
(698, 17, 'Bachelor of Fine Arts (Honours) in Sculpture', 2, 0),
(699, 17, 'Bachelor of Fine Arts (Honours) in Forestry Science & Ecology', 2, 0),
(700, 17, 'Bachelor of Fine Arts (Honours) in Bachelor of Laws', 2, 0),
(701, 17, 'Bachelor of Fine Arts (Honours) in Composition', 2, 0),
(702, 17, 'Bachelor of Fine Arts (Honours) in Digital Music', 2, 0),
(703, 17, 'Bachelor of Fine Arts (Honours) in Sonic Art and Recording Technology', 2, 0),
(704, 17, 'Bachelor of Fine Arts (Honours) in Music Education', 2, 0),
(705, 17, 'Bachelor of Fine Arts (Honours) in Music History', 2, 0),
(706, 17, 'Bachelor of Fine Arts (Honours) in Culture and Research', 2, 0),
(707, 17, 'Bachelor of Fine Arts (Honours) in Musicianship', 2, 0),
(708, 17, 'Bachelor of Fine Arts (Honours) in Performance (Instrument and voice)', 2, 0),
(709, 17, 'Master of Audiology', 3, 0),
(710, 17, 'Master of Business Administration (MBA)', 3, 0),
(711, 17, 'Master of Business Management (MBM)', 3, 0),
(712, 17, 'Master of Fine Arts in Film', 3, 0),
(713, 17, 'Master of Fine Arts in Graphic Design', 3, 0),
(714, 17, 'Master of Fine Arts in Painting', 3, 0),
(715, 17, 'Master of Fine Arts in Photography', 3, 0),
(716, 17, 'Master of Fine Arts in Printmaking', 3, 0),
(717, 17, 'Master of Fine Arts in Sculpture', 3, 0),
(718, 17, 'Master of Fine Arts (Creative Writing) ', 3, 0),
(719, 17, 'Master of Forestry Science ', 3, 0),
(720, 17, 'Master of Health Sciences ', 3, 0),
(721, 18, 'Graduate Diploma in Teaching and Learning (Early Childhood)', 3, 0),
(722, 18, 'Graduate Diploma in Teaching and Learning (Primary)', 33, 0),
(723, 18, 'Graduate Diploma in Teaching and Learning (Secondary)', 3, 0),
(724, 12, 'Bachelor of Science in Antarctic Studies', 2, 0),
(725, 12, 'Bachelor of Science in Astronomy', 2, 0),
(726, 12, 'Bachelor of Science in Biochemistry', 2, 0),
(727, 12, 'Bachelor of Science in Biological Sciences(undergraduate only', 2, 0),
(728, 12, 'Bachelor of Science in Biotechnology', 2, 0),
(729, 12, 'Bachelor of Science in Cellular and Molecular Biology', 2, 0),
(730, 12, 'Bachelor of Science in Chemistry                     ', 2, 0),
(731, 12, 'Bachelor of Science in Computational and Applied Mathematics', 2, 0),
(732, 12, 'Bachelor of Science in Computer Science', 2, 0),
(733, 12, 'Bachelor of Science in Electronics(undegraduate only)', 2, 0),
(734, 12, 'Bachelor of Science in Engineering Geology', 2, 0),
(735, 12, 'Bachelor of Science in Environmental Science ', 2, 0),
(736, 12, 'Bachelor of Science in Geography, Mathematics', 2, 0),
(737, 12, 'Bachelor of Science in Geology', 2, 0),
(738, 12, 'Bachelor of Science in Hazard and Disaster Management', 2, 0),
(739, 12, 'Bachelor of Science in Mathematical Physics', 2, 0),
(740, 12, 'Bachelor of Science in Mathematics and Philosophy', 2, 0),
(741, 12, 'Bachelor of Science in Mathematics and Statistics', 2, 0),
(742, 12, 'Bachelor of Science in Medical Physics', 2, 0),
(743, 12, 'Bachelor of Science in Medical Physics (Clinical)', 2, 0),
(744, 12, 'Bachelor of Science in Microbiology', 2, 0),
(745, 12, 'Bachelor of Science in Physics', 2, 0),
(746, 12, 'Bachelor of Science in Plant Biology', 2, 0),
(747, 12, 'Bachelor of Science in Psychology, Statistics', 2, 0),
(748, 12, 'Bachelor of Science in Speech & Language Therapy and Audiology', 2, 0),
(749, 12, 'Bachelor of Science in Zoology', 2, 0),
(750, 12, 'Bachelor of Science with Honours in Astronomy', 2, 0),
(751, 12, 'Bachelor of Science with Honours in Biochemistry', 2, 0),
(752, 12, 'Bachelor of Science with Honours in Biotechnology', 2, 0),
(753, 12, 'Bachelor of Science with Honours in Cellular and Molecular Biology', 2, 0),
(754, 12, 'Bachelor of Science with Honours in Chemistry', 2, 0),
(755, 12, 'Bachelor of Science with Honours in Computational and Applied Mathematics', 2, 0),
(756, 12, 'Bachelor of Science with Honours in Computer Science', 2, 0),
(757, 12, 'Bachelor of Science with Honours in Ecology', 2, 0),
(758, 12, 'Bachelor of Science with Honours in Economics', 2, 0),
(759, 12, 'Bachelor of Science with Honours in Engineering Geology', 2, 0),
(760, 12, 'Bachelor of Science with Honours in Environmental Science', 2, 0),
(761, 12, 'Bachelor of Science with Honours in Geography', 2, 0),
(762, 12, 'Bachelor of Science with Honours in Geology', 2, 0),
(763, 12, 'Bachelor of Science with Honours in Hazard and Disaster Management', 2, 0),
(764, 12, 'Bachelor of Science with Honours in Management Science', 2, 0),
(765, 12, 'Bachelor of Science with Honours in Mathematical Physics', 2, 0),
(766, 12, 'Bachelor of Science with Honours in Mathematics', 2, 0),
(767, 12, 'Bachelor of Science with Honours in Mathematics and Philosophy', 2, 0),
(768, 12, 'Bachelor of Science with Honours in Medical Physics', 2, 0),
(769, 12, 'Bachelor of Science with Honours in Microbiology', 2, 0),
(770, 12, 'Bachelor of Science with Honours in Physics', 2, 0),
(771, 12, 'Bachelor of Science with Honours in Plant Biology', 2, 0),
(772, 12, 'Bachelor of Science with Honours in Psychology', 2, 0),
(773, 12, 'Bachelor of Science with Honours in Statistics', 2, 0),
(774, 12, 'Bachelor of Science with Honours in Zoology', 2, 0),
(775, 12, 'Bachelor of Teaching and Learning with Honours ', 2, 0),
(776, 12, 'Graduate Diploma in Astronomy', 3, 0),
(777, 12, 'Graduate Diploma in Biochemistry', 3, 0),
(778, 12, 'Graduate Diploma in Biological Sciences', 3, 0),
(779, 12, 'Graduate Diploma in Chemistry', 3, 0),
(780, 12, 'Graduate Diploma in Computer Science', 3, 0),
(781, 12, 'Graduate Diploma in Economics', 3, 0),
(782, 12, 'Graduate Diploma in Electronics ', 3, 0),
(783, 12, 'Graduate Diploma in Ethics ', 3, 0),
(784, 12, 'Graduate Diploma in Finance', 3, 0),
(785, 12, 'Graduate Diploma in Geography', 3, 0),
(786, 12, 'Graduate Diploma in Geology', 3, 0),
(787, 12, 'Graduate Diploma in Linguistics', 3, 0),
(788, 12, 'Graduate Diploma in Management Science', 3, 0),
(789, 12, 'Graduate Diploma in Mathematics', 3, 0),
(790, 12, 'Graduate Diploma in Philosophy', 3, 0),
(791, 12, 'Graduate Diploma in Physics', 3, 0),
(792, 12, 'Graduate Diploma in Psychology', 3, 0),
(793, 12, 'Graduate Diploma in Statistics', 3, 0),
(794, 12, 'Master of Science in Applied Psychology', 3, 0),
(795, 12, 'Master of Science in Astronomy', 3, 0),
(796, 12, 'Master of Science in Biotechnology', 3, 0),
(797, 12, 'Master of Science in Cellular and Molecular Biology', 3, 0),
(798, 12, 'Master of Science in Chemistry', 3, 0),
(799, 12, 'Master of Science in Child and Family Psychology', 3, 0),
(800, 12, 'Master of Science in Computational and Applied Mathematics', 3, 0),
(801, 12, 'Master of Science in Computer Science', 3, 0),
(802, 12, 'Master of Science in Ecology', 3, 0),
(803, 12, 'Master of Science in Economics', 3, 0),
(804, 12, 'Master of Science in Engineering Geology', 3, 0),
(805, 12, 'Master of Science in Environmental Science', 3, 0),
(806, 12, 'Master of Science in Geography', 3, 0),
(807, 12, 'Master of Science in Geology', 3, 0),
(808, 12, 'Master of Science in Hazard and Disaster Management', 3, 0),
(809, 12, 'Master of Science in History and Philosophy of Science', 3, 0),
(810, 12, 'Master of Science in Management Science', 3, 0),
(811, 12, 'Master of Science in Mathematics', 3, 0),
(812, 12, 'Master of Science in Medical Physics', 3, 0),
(813, 12, 'Master of Science in Medical Physics (Clinical)', 3, 0),
(814, 12, 'Master of Science in Microbiology', 3, 0),
(815, 12, 'Master of Science in Philosophy', 3, 0),
(816, 12, 'Master of Science in Physics', 3, 0),
(817, 12, 'Master of Science in Plant Biology', 3, 0),
(818, 12, 'Master of Science in Psychology', 3, 0),
(819, 12, 'Master of Science in Seafood Sector: Management and Science', 3, 0),
(820, 12, 'Master of Science in Statistics', 3, 0),
(821, 12, 'Master of Science in Zoology', 3, 0),
(822, 12, 'Master of Social Work ', 3, 0),
(823, 12, 'Master of Social Work (Applied) ', 3, 0),
(824, 12, 'Master of Speech and Language Therapy ', 3, 0),
(825, 12, 'Postgraduate Diploma in Antarctic Studies ', 3, 0),
(826, 12, 'Postgraduate Diploma in Applied e-Teaching and Support ', 3, 0),
(827, 12, 'Postgraduate Diploma in Art Curatorship ', 3, 0),
(828, 12, 'Postgraduate Diploma in Business Management ', 3, 0),
(829, 12, 'Postgraduate Diploma in Child and Family Psychology ', 3, 0),
(830, 12, 'Postgraduate Diploma in Clinical Psychology ', 3, 0),
(831, 12, 'Postgraduate Diploma in Economics ', 3, 0),
(832, 12, 'Postgraduate Diploma in Education ', 3, 0),
(833, 12, 'Postgraduate Diploma in Education (e-Learning and Digital Technologies)', 3, 0),
(834, 12, 'Postgraduate Diploma in Education endorsed in Leadership ', 3, 0),
(835, 12, 'Postgraduate Diploma in Education endorsed in Literacy ', 3, 0),
(836, 12, 'Postgraduate Diploma in Engineering Geology ', 3, 0),
(837, 12, 'Postgraduate Diploma in Forestry ', 3, 0),
(838, 12, 'Postgraduate Diploma in Industrial and Organisational Psychology ', 3, 0),
(839, 12, 'Postgraduate Diploma in Science in Astronomy', 3, 0),
(840, 12, 'Postgraduate Diploma in Science in Biochemistry', 3, 0),
(841, 12, 'Postgraduate Diploma in Science in Biotechnology', 3, 0),
(842, 12, 'Postgraduate Diploma in Science in Cellular and Molecular Biology', 3, 0),
(843, 12, 'Postgraduate Diploma in Science in Chemistry', 3, 0),
(844, 12, 'Postgraduate Diploma in Science in Computational and Applied Mathematics', 3, 0),
(845, 12, 'Postgraduate Diploma in Science in Computer Science', 3, 0),
(846, 12, 'Postgraduate Diploma in Science in Ecology', 3, 0),
(847, 12, 'Postgraduate Diploma in Science in Economics', 3, 0),
(848, 12, 'Postgraduate Diploma in Science in Engineering Geology', 3, 0),
(849, 12, 'Postgraduate Diploma in Science in Environmental Science', 3, 0),
(850, 12, 'Postgraduate Diploma in Science in Geography', 3, 0),
(851, 12, 'Postgraduate Diploma in Science in Geology', 3, 0),
(852, 12, 'Postgraduate Diploma in Science in Hazard and Disaster Management', 3, 0),
(853, 12, 'Postgraduate Diploma in Science in History and Philosophy of Science', 3, 0),
(854, 12, 'Postgraduate Diploma in Science in Management Science', 3, 0),
(855, 12, 'Postgraduate Diploma in Science in Mathematics', 3, 0),
(856, 12, 'Postgraduate Diploma in Science in Medical Physics', 3, 0),
(857, 12, 'Postgraduate Diploma in Science in Microbiology', 3, 0),
(858, 12, 'Postgraduate Diploma in Science in Philosophy', 3, 0),
(859, 12, 'Postgraduate Diploma in Science in Physics', 3, 0),
(860, 12, 'Postgraduate Diploma in Science in Plant Biology', 3, 0),
(861, 12, 'Postgraduate Diploma in Science in Psychology', 3, 0),
(862, 12, 'Postgraduate Diploma in Science in Seafood Sector: Management and Science', 3, 0),
(863, 12, 'Postgraduate Diploma in Science in Statistics', 3, 0),
(864, 12, 'Postgraduate Diploma in Science in Zoology', 3, 0),
(865, 12, 'Postgraduate Diploma in Social Work ', 3, 0),
(866, 19, 'Bachelor of Music with Honours', 3, 0),
(867, 18, 'Master of Education with Certificate in Counselling', 3, 0),
(868, 8, 'Master of International Law and Politics', 3, 0),
(869, 8, 'Master of Laws (International Law and Politics)', 3, 0),
(870, 19, 'Master of Music in Composition', 3, 0),
(871, 19, 'Master of Music in Peformance', 3, 0),
(872, 5, 'Master of Engineering in Bioengineering', 3, 0),
(873, 5, 'Master of Engineering in Chemical and Process', 3, 0),
(874, 5, 'Master of Engineering in Civil', 3, 0),
(875, 5, 'Master of Engineering in Construction Management', 3, 0),
(876, 5, 'Master of Engineering in Electrical and Electronic', 3, 0),
(877, 5, 'Master of Engineering in Mechanical', 3, 0),
(878, 5, 'Master of Engineering in Fire Engineering', 3, 0),
(879, 5, 'Master of Engineering in Transportation', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `suppID` int(11) NOT NULL AUTO_INCREMENT,
  `supplier` varchar(150) DEFAULT NULL,
  `conPerson` varchar(50) DEFAULT NULL,
  `conNumber` varchar(20) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `chatID` varchar(80) DEFAULT NULL,
  `addr1` varchar(80) DEFAULT NULL,
  `addr2` varchar(80) DEFAULT NULL,
  `addr3` varchar(80) DEFAULT NULL,
  `delStatus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`suppID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`suppID`, `supplier`, `conPerson`, `conNumber`, `email`, `chatID`, `addr1`, `addr2`, `addr3`, `delStatus`) VALUES
(1, 'Supplier 1', 'Sandeep', '+91 9865458621', 'sandeep@email.com', 'sandeep@email.com', 'address1', 'address2', 'address3', 0),
(2, 'Supplier 2', 'Anand', '+91 9865458621', 'anand@email.com', 'anand@email.com', 'address1', 'address2', 'address3', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
