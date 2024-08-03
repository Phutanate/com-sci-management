-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2024 at 08:20 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `com-sci-management`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_year`
--

CREATE TABLE `academic_year` (
  `ay_id` int(11) NOT NULL COMMENT 'id',
  `ay_year` int(4) NOT NULL COMMENT 'ปีการศึกษา',
  `delete_flag` int(11) NOT NULL DEFAULT 0 COMMENT 'สถานะลบ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='ข้อมูลปีการศึกษา';

--
-- Dumping data for table `academic_year`
--

INSERT INTO `academic_year` (`ay_id`, `ay_year`, `delete_flag`) VALUES
(1, 2560, 0),
(2, 2561, 0),
(3, 2562, 0),
(4, 2563, 0),
(5, 2564, 0),
(6, 2565, 0),
(7, 2566, 0),
(8, 2567, 0),
(9, 2568, 0);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL COMMENT 'id',
  `name_full_thai` varchar(150) NOT NULL COMMENT 'ชื่อเต็ม TH',
  `name_less_thai` varchar(50) NOT NULL COMMENT 'ชื่อย่อ TH',
  `name_full_english` varchar(150) DEFAULT NULL COMMENT 'ชื่อเต็ม EN',
  `name_less_english` varchar(50) DEFAULT NULL COMMENT 'ชื่อย่อ EN',
  `degree_id` int(11) DEFAULT NULL COMMENT 'id degree'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='ข้อมูลหลักสูตร';

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `name_full_thai`, `name_less_thai`, `name_full_english`, `name_less_english`, `degree_id`) VALUES
(1, 'ครุศาสตรบัณฑิต', 'ค.บ.', 'Bachelor of Education', 'B.Ed.', 1),
(2, 'วิทยาศาสตรบัณฑิต', 'วท.บ.', 'Bachelor of Science', 'B.Sc.', 1),
(3, 'นิติศาสตรบัณฑิต', 'น.บ.', 'Bachelor of Laws', 'LL.B.', 1),
(4, 'รัฐประศาสนศาสตรบัณฑิต', 'รป.บ.', 'Bachelor of Public Administration', 'B.P.A.', 1),
(5, 'ศิลปศาสตรบัณฑิต', 'ศศ.บ.', 'Bachelor of Liberal Arts', 'B.A.', 1),
(6, 'บัญชีบัณฑิต', 'บช.บ.', 'Bachelor of Accountancy', 'B.Acc.', 1),
(7, 'นิเทศศาสตรบัณฑิต', 'นศ.บ.', 'Bachelor of Communication Arts', 'B.A.(Communication Arts)', 1),
(8, 'เศรษฐศาสตรบัณฑิต', 'ศ.บ.', 'Bachelor of Economics', 'B.Econ.', 1),
(9, 'บริหารธุรกิจบัณฑิต', 'บธ.บ.', 'Bachelor of Business Administration', 'B.B.A.', 1),
(10, 'ครุศาสตรมหาบัณฑิต', 'ค.ม.', 'Master of Education', 'M.Ed.', 2),
(11, 'ศิลปศาสตรมหาบัณฑิต', 'ศศ.ม', 'Master of Arts', 'M.A.', 2),
(12, 'รัฐประศาสนศาสตรมหาบัณฑิต', 'รป.ม.', 'Master of Public Administration', 'M.P.A.', 2),
(13, 'ปรัชญาดุษฎีบัณฑิต', 'ปร.ด.', 'Doctor of Philosophy', 'Ph.D.', 3),
(14, 'ประกาศนียบัณฑิต', 'ป.บัณฑิต', 'Graduate Diploma Program (Teaching Profession)', 'Grad. Dip.', 4),
(15, 'พยาบาลศาสตรบัณฑิต', 'พย.บ.', 'Bachelor of Nursing', 'B.N.S.', 1),
(16, 'ศิลปกรรมศาสตรบัณฑิต', 'ศป.บ.', 'Bachelor of Fine Arts', 'B.F.A.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `degree`
--

CREATE TABLE `degree` (
  `degree_id` int(11) NOT NULL COMMENT 'id',
  `name_in_thai` varchar(150) NOT NULL COMMENT 'ชื่อ TH',
  `name_in_english` varchar(150) DEFAULT NULL COMMENT 'ชื่อ EN'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='ข้อมูลระดับการศึกษา';

--
-- Dumping data for table `degree`
--

INSERT INTO `degree` (`degree_id`, `name_in_thai`, `name_in_english`) VALUES
(1, 'ปริญญาตรี', 'Bachelor'),
(2, 'ปริญญาโท', 'Master'),
(3, 'ปริญญาเอก', 'Doctorate'),
(4, 'บัณฑิตศึกษา', 'Graduate');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` int(11) NOT NULL COMMENT 'id',
  `code` int(11) NOT NULL COMMENT 'code คณะ',
  `name_in_thai` varchar(150) NOT NULL COMMENT 'ชื่อ TH',
  `name_in_english` varchar(150) NOT NULL COMMENT 'ชื่อ EN',
  `delete_flag` int(11) NOT NULL DEFAULT 0 COMMENT 'สถานะลบ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='ข้อมูลคณะ';

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `code`, `name_in_thai`, `name_in_english`, `delete_flag`) VALUES
(1, 0, 'ครุศาสตร์', 'Education', 0),
(2, 0, 'วิทยาศาสตร์', 'Science', 0),
(3, 0, 'มนุษยศาสตร์และสังคมศาสตร์', 'Humanities and Social Sciences', 0),
(4, 0, 'วิทยาการจัดการ', 'Management Science', 0),
(5, 0, 'เทคโนโลยีอุตสาหกรรม', 'Industrial Technology', 0),
(6, 0, 'เทคโนโลยีการเกษตร', 'Agricultural Technology', 0),
(7, 0, 'พยาบาลศาสตร์', 'Nursing Science', 0),
(8, 0, 'บัณฑิตวิทยาลัย', 'Graduate School', 0);

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `gender_id` int(11) NOT NULL COMMENT 'id',
  `gender_name_th` varchar(255) NOT NULL COMMENT 'ชื่อเพศ TH',
  `gender_name_en` varchar(255) DEFAULT NULL COMMENT 'ชื่อเพศ EN',
  `delete_flag` int(11) NOT NULL DEFAULT 0 COMMENT 'สถานะลบ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='ข้อมูลเพศ';

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`gender_id`, `gender_name_th`, `gender_name_en`, `delete_flag`) VALUES
(1, 'ชาย', 'male', 0),
(2, 'หญิง', 'female', 0);

-- --------------------------------------------------------

--
-- Table structure for table `major`
--

CREATE TABLE `major` (
  `major_id` int(11) NOT NULL COMMENT 'id',
  `code` int(11) NOT NULL COMMENT 'code สาขา',
  `name_in_thai` varchar(150) NOT NULL COMMENT 'ชื่อ TH',
  `name_in_english` varchar(150) NOT NULL COMMENT 'ชื่อ EN',
  `faculty_id` int(11) DEFAULT NULL COMMENT 'id faculty คณะ',
  `course_id` int(11) DEFAULT NULL COMMENT 'id course หลักสูตร',
  `delete_flag` int(11) NOT NULL DEFAULT 0 COMMENT 'สถานะลบ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='ข้อมูลสาขา';

--
-- Dumping data for table `major`
--

INSERT INTO `major` (`major_id`, `code`, `name_in_thai`, `name_in_english`, `faculty_id`, `course_id`, `delete_flag`) VALUES
(1, 0, 'ภาษาไทย', 'Thai Language', 1, 1, 0),
(2, 0, 'คณิตศาสตร์', 'Mathematics', 1, 1, 0),
(3, 0, 'สังคมศึกษา', 'Social Studies', 1, 1, 0),
(4, 0, 'ศิลปศึกษา', 'Art Education', 1, 1, 0),
(5, 0, 'ดนตรีศึกษา', 'Department of Music Education', 1, 1, 0),
(6, 0, 'นาฏศิลป์', 'Department of Dramatic Arts', 1, 1, 0),
(7, 0, 'พลศึกษา', 'Department of Physical Education', 1, 1, 0),
(8, 0, 'เทคโนโลยีและนวัตกรรมการศึกษา', 'Technology and Educational Innovation', 1, 1, 0),
(9, 0, 'วิทยาศาสตร์ทั่วไป', 'Department of General Science', 1, 1, 0),
(10, 0, 'ฟิสิกส์', 'Physics', 1, 1, 0),
(11, 0, 'ภาษาอังกฤษ', 'English', 1, 1, 0),
(12, 0, 'การศึกษาปฐมวัย', 'Early Childhood Education', 1, 1, 0),
(13, 0, 'เคมี', 'Chemical', 2, 2, 0),
(14, 0, 'คณิตศาสตร์', 'Mathematics', 2, 2, 0),
(15, 0, 'เทคโนโลยีสารสนเทศ', 'Information Technology', 2, 2, 0),
(16, 0, 'ชีววิทยา', 'Biology', 2, 2, 0),
(17, 0, 'วิทยาการคอมพิวเตอร์', 'Computer Science', 2, 2, 0),
(18, 0, 'วิทยาศาสตร์การกีฬา', 'Sports Science', 2, 2, 0),
(19, 0, 'ออกแบบแฟชั่นและธุรกิจสิ่งทอ', 'Fashion Design and Textile Business', 2, 2, 0),
(20, 0, 'วิทยาศาสตร์สิ่งแวดล้อม', 'Environmental Science', 2, 2, 0),
(21, 0, 'สถิติและวิทยาการสารสนเทศ', 'Statistics and Information Science', 2, 2, 0),
(22, 0, 'สาธารณสุขศาสตร์', 'Public Health', 2, 2, 0),
(23, 0, 'เทคโนโลยีภูมิสารสนเทศและภูมิศาสตร์', 'Geospatial and Geography Technology', 2, 2, 0),
(24, 0, 'ภาษาไทย', 'Thai Language', 3, 5, 0),
(25, 0, 'ภาษาอังกฤษธุระกิจ', 'Business English', 3, 5, 0),
(26, 0, 'ภาษาอังกฤษ', 'English', 3, 5, 0),
(27, 0, 'นิติศาสตร์', 'Jurisprudence', 3, 3, 0),
(28, 0, 'รัฐประศาสนศาสตร์', 'Public Administration', 3, 4, 0),
(29, 0, 'ดนตรีสากล', 'International Music', 3, 5, 0),
(30, 0, 'การพัฒนาสังคม', 'social development', 3, 5, 0),
(31, 0, 'ศิลปะดิจิทัล', 'Digital Art', 3, 16, 0),
(32, 0, 'บรรณารักษศาสตร์', 'Library Science', 3, 5, 0),
(33, 0, 'ดุริยางคศิลป์', 'Musical Performance Skills', 3, 5, 0),
(34, 0, 'การบัญชี', 'Accounting', 4, 6, 0),
(35, 0, 'การสื่อสารมวลชน', 'Journalism', 4, 7, 0),
(36, 0, 'การท่องเที่ยวและการโรงแรม', 'Tourism and Hotels', 4, 5, 0),
(37, 0, 'เศรษฐศาสตร์', 'Economics', 4, 8, 0),
(38, 0, 'การเงินและการธนาคาร', 'Finance and Banking', 4, 9, 0),
(39, 0, 'การจัดการ', 'Management', 4, 9, 0),
(40, 0, 'การตลาด', 'Marketing', 4, 9, 0),
(41, 0, 'การบริหารทรัพยากรมนุษย์', 'Human Resource Management', 4, 9, 0),
(42, 0, 'คอมพิวเตอร์ธุรกิจ', 'Business Computer', 4, 9, 0),
(43, 0, 'สถาปัตยกรรม', 'Architecture', 5, 2, 0),
(44, 0, 'เทคโนโลยีการจัดการอุตสาหกรรม', 'Industry Management Technology', 5, 2, 0),
(45, 0, 'เทคโนโลยีก่อสร้าง', 'Construction Technology', 5, 2, 0),
(46, 0, 'เทคโนโลยีวิศวกรรมไฟฟ้า', 'Electrical Engineering Technology', 5, 2, 0),
(47, 0, 'เทคโนโลยีเซรามิกส์', 'Ceramics Technology', 5, 2, 0),
(48, 0, 'อิเล็กทรอกนิกส์สื่อสาร', 'Electronic Communication', 5, 2, 0),
(49, 0, 'การออกแบบผลิตภัณฑ์อุตสาหกรรม', 'Industrial Product Design', 5, 2, 0),
(50, 0, 'เกษตรศาสตร์', 'Agricultural Science', 6, 2, 0),
(51, 0, 'ประมง', 'Fishing', 6, 2, 0),
(52, 0, 'สัตวศาสตร์', 'Animal Science', 6, 2, 0),
(53, 0, 'พยาบาลศาสตร', 'Nursing Science', 7, 15, 0),
(54, 0, 'หลักสูตรและการจัดการเรียนรู้', 'Curriculum and Learning Management', 1, 10, 0),
(55, 0, 'การบริหารการศึกษา', 'Education Administration', 1, 10, 0),
(56, 0, 'วิจัยและประเมินผล', 'Research and Evaluation', 1, 10, 0),
(57, 0, 'ดนตรีศึกษา', 'Music Education', 1, 10, 0),
(58, 0, 'การบริหารการศึกษา', 'Education Executive', 1, 13, 0),
(59, 0, 'วิชาชีพครู', 'teaching profession', 1, 14, 0),
(60, 0, 'ภาษาอังกฤษ', 'English Language', 3, 11, 0),
(61, 0, 'รัฐประศาสนศาสตร์', 'Public Administration', 3, 12, 0),
(62, 0, 'ภาวะผู้นำเพื่อการพัฒนาวิชาชีพ', 'Leadership for Professional Development', 8, 13, 0);

-- --------------------------------------------------------

--
-- Table structure for table `prefix`
--

CREATE TABLE `prefix` (
  `prefix_id` int(11) NOT NULL COMMENT 'id',
  `prefix_name_th` varchar(255) NOT NULL COMMENT 'คำนำหน้าชื่อ TH',
  `prefix_name_en` varchar(255) DEFAULT NULL COMMENT 'คำนำหน้าชื่อ EN',
  `delete_flag` int(11) NOT NULL DEFAULT 0 COMMENT 'สถานะลบ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='ข้อมูลคำนำหน้าชื่อ';

--
-- Dumping data for table `prefix`
--

INSERT INTO `prefix` (`prefix_id`, `prefix_name_th`, `prefix_name_en`, `delete_flag`) VALUES
(1, 'นาย', 'Mr.', 0),
(2, 'นาง', 'Mrs.', 0),
(3, 'นางสาว', 'Miss', 0),
(4, 'ดร.', 'Dr.', 0),
(5, 'ศ.ดร.', 'Prof. Dr.', 0),
(6, 'อ.', 'Lecturer', 0),
(7, 'รศ.ดร.', 'Assoc. Prof. Dr.', 0),
(8, 'ผศ.ดร.', 'Asst. Prof. Dr.', 0),
(9, 'ศ.', 'Prof.', 0),
(10, 'อ.ดร.', 'Lecturer Dr.', 0),
(11, 'อาจารย์', 'Lecturer', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `std_id` int(11) NOT NULL COMMENT 'id',
  `gender_id` int(11) DEFAULT NULL COMMENT 'id gender เพศ',
  `prefix_id` int(11) DEFAULT NULL COMMENT 'id prefix คำนำหน้าชื่อ',
  `std_fname_th` varchar(255) NOT NULL COMMENT 'ชื่อ TH',
  `std_lname_th` varchar(255) NOT NULL COMMENT 'นามสกุล TH',
  `std_fname_en` varchar(255) DEFAULT NULL COMMENT 'ชื่อ EN',
  `std_lname_en` varchar(255) DEFAULT NULL COMMENT 'นามสกุล EN',
  `ay_id` int(11) NOT NULL DEFAULT 0 COMMENT 'id acdemic_year ปีการศึกษา',
  `faculty_id` int(11) DEFAULT 2 COMMENT 'id faculty คณะ',
  `major_id` int(11) DEFAULT 17 COMMENT 'id major สาขา',
  `std_status` int(11) NOT NULL COMMENT 'สถานะการศึกษา',
  `std_number_id` varchar(12) DEFAULT NULL COMMENT 'รหัสประจำตัวนักศึกษา',
  `delete_flag` int(11) NOT NULL DEFAULT 0 COMMENT 'สถานะลบ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='ข้อมูลนักศึกษา';

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`std_id`, `gender_id`, `prefix_id`, `std_fname_th`, `std_lname_th`, `std_fname_en`, `std_lname_en`, `ay_id`, `faculty_id`, `major_id`, `std_status`, `std_number_id`, `delete_flag`) VALUES
(1, 2, 3, 'กฤติยาภรณ์', 'สีหา', 'Kritiyaporn', 'Seeha', 4, 2, 17, 1, '630112230027', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_adviser`
--

CREATE TABLE `student_adviser` (
  `std_avs_id` int(11) NOT NULL COMMENT 'id',
  `ay_id` int(11) DEFAULT NULL COMMENT 'id student นักศึกษา',
  `tc_id` int(11) DEFAULT NULL COMMENT 'id teacher อาจารย์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='ข้อมูลอาจาร์ที่ปรึกษา';

--
-- Dumping data for table `student_adviser`
--

INSERT INTO `student_adviser` (`std_avs_id`, `ay_id`, `tc_id`) VALUES
(1, 4, 1),
(2, 4, 7);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `tc_id` int(11) NOT NULL COMMENT 'id',
  `gender_id` int(11) DEFAULT NULL COMMENT 'id gender เพศ',
  `prefix_id` int(11) DEFAULT NULL COMMENT 'id prefix คำนำหน้าชื่อ',
  `tc_fname_th` varchar(255) NOT NULL COMMENT 'ชื่อ TH',
  `tc_lname_th` varchar(255) NOT NULL COMMENT 'นามสกุล TH',
  `tc_fname_en` varchar(255) DEFAULT NULL COMMENT 'ชื่อ EN',
  `tc_lname_en` varchar(255) DEFAULT NULL COMMENT 'นามสกุล EN',
  `tp_id` int(11) DEFAULT NULL COMMENT 'id teacher_position ตำแหน่งอาจารย์',
  `delete_flag` int(11) NOT NULL DEFAULT 0 COMMENT 'สถานะลบ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='ข้อมูลอาจารย์';

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`tc_id`, `gender_id`, `prefix_id`, `tc_fname_th`, `tc_lname_th`, `tc_fname_en`, `tc_lname_en`, `tp_id`, `delete_flag`) VALUES
(1, 1, 11, 'สกรณ์', 'บุษบง', 'Zagon', 'Bussabong', 1, 0),
(2, 1, 8, 'สมศักดิ์', 'จีวัฒนา', 'Somsak', 'Jiwatana', 2, 0),
(3, 2, 4, 'ทิพวัลย์', 'แสนคำ', 'Thippawan', 'Saenkham', 2, 0),
(4, 1, 11, 'สมพร', 'กระออมแก้ว', 'Somporn', 'Kraomkaew', 2, 0),
(5, 1, 11, 'วิชชา', 'ภัทรนิธิคุณากร', 'Wicha', 'Phatthanithikunakorn', 2, 0),
(6, 2, 4, 'ณปภัช', 'วรรณตรง', 'Napaphat', 'Wannarong', 2, 0),
(7, 1, 11, 'ชลัท', 'รังสิมาเทวัญ', 'Chalat', 'Rungsimatewan', 2, 0),
(8, 1, 11, 'วราวุธ', 'จอสูงเนิน', 'Warawut', 'Josungnoen', 2, 0),
(9, 1, 4, 'ชาติวุฒิ', 'ธนาจิรันธร', 'Chatwut', 'Thanajirunthon', 2, 0),
(10, 1, 4, 'ณัฐพล', 'แสนคำ', 'Natthaphon', 'Saenkham', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_position`
--

CREATE TABLE `teacher_position` (
  `tp_id` int(11) NOT NULL COMMENT 'id',
  `tp_name_th` varchar(255) NOT NULL COMMENT 'ชื่อตำแหน่ง TH',
  `tp_name_en` varchar(255) NOT NULL COMMENT 'ชื่อตำแหน่ง EN',
  `delete_flag` int(11) NOT NULL DEFAULT 0 COMMENT 'สถานะลบ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='ข้อมูลตำแหน่งอาจารย์';

--
-- Dumping data for table `teacher_position`
--

INSERT INTO `teacher_position` (`tp_id`, `tp_name_th`, `tp_name_en`, `delete_flag`) VALUES
(1, 'หัวหน้าสาขาวิชา', 'Head of Department', 0),
(2, 'อาจารย์ประจำสาขาวิชา', 'Professor of the Department', 0);

-- --------------------------------------------------------

--
-- Table structure for table `thesis`
--

CREATE TABLE `thesis` (
  `ts_id` int(11) NOT NULL COMMENT 'id',
  `ts_name_th` text NOT NULL COMMENT 'หัวข้อปริญญานิพนธ์ TH',
  `ts_name_en` text NOT NULL COMMENT 'หัวข้อปริญญานิพนธ์ EN',
  `ay_id` int(11) NOT NULL COMMENT 'id academic_yeaer ปีการศึกษา',
  `ts_gt_id` int(11) NOT NULL COMMENT 'id thesis_grouptype ประเภทกลุ่มโครงงาน',
  `ts_status_1` int(11) NOT NULL DEFAULT 0 COMMENT 'สถานะ กำลังดำเนินการโครงงาน 1',
  `ts_status_date_1` date DEFAULT NULL COMMENT 'วันที่ กำลังดำเนินการโครงงาน 1',
  `ts_status_note_1` text DEFAULT NULL COMMENT 'รายลละเอียด กำลังดำเนินการโครงงาน 1',
  `ts_status_2` int(11) NOT NULL DEFAULT 0 COMMENT 'สถานะ สอบโครงงาน 1 ผ่าน',
  `ts_status_date_2` date DEFAULT NULL COMMENT 'วันที่ สอบโครงงาน 1 ผ่าน',
  `ts_status_note_2` text DEFAULT NULL COMMENT 'หมายเหตุ สอบโครงงาน 1 ผ่าน',
  `ts_status_3` int(11) NOT NULL DEFAULT 0 COMMENT 'สถานะ กำลังดำเนินการโครงงาน 2',
  `ts_status_date_3` date DEFAULT NULL COMMENT 'วันที่ กำลังดำเนินการโครงงาน 2',
  `ts_status_note_3` text DEFAULT NULL COMMENT 'หมายเหตุ กำลังดำเนินการโครงงาน 2',
  `ts_status_4` int(11) NOT NULL DEFAULT 0 COMMENT 'สถานะ สอบโครงงาน 2 ผ่าน ',
  `ts_status_date_4` date DEFAULT NULL COMMENT 'วันที่ สอบโครงงาน 2 ผ่าน ',
  `ts_status_note_4` text DEFAULT NULL COMMENT 'หมายเหตุ สอบโครงงาน 2 ผ่าน ',
  `delete_flag` int(11) NOT NULL DEFAULT 0 COMMENT 'สถานะบ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='ข้อมูลปริญญานิพนธ์';

--
-- Dumping data for table `thesis`
--

INSERT INTO `thesis` (`ts_id`, `ts_name_th`, `ts_name_en`, `ay_id`, `ts_gt_id`, `ts_status_1`, `ts_status_date_1`, `ts_status_note_1`, `ts_status_2`, `ts_status_date_2`, `ts_status_note_2`, `ts_status_3`, `ts_status_date_3`, `ts_status_note_3`, `ts_status_4`, `ts_status_date_4`, `ts_status_note_4`, `delete_flag`) VALUES
(1, 'ระบบพัฒนาการจัดการสาขาวิทยาการคอมพิวเตอร์ มหาวิทยาลัยราชภัฎบุรีรัมย์', 'Computer Science Management Development System Buriram Rajabhat University', 4, 1, 1, '2023-01-01', '', 1, '2023-01-07', '', 1, '2023-01-08', '', 0, '0000-00-00', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `thesis_adviser`
--

CREATE TABLE `thesis_adviser` (
  `ts_avs_id` int(11) NOT NULL COMMENT 'id',
  `ts_id` int(11) DEFAULT NULL COMMENT 'id thesis ปริญญานิพนธ์',
  `tc_id` int(11) DEFAULT NULL COMMENT 'id teacher อาจารย์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='ข้อมูลอาจารย์ที่ปรึกษาปริญญานิพนธ์';

--
-- Dumping data for table `thesis_adviser`
--

INSERT INTO `thesis_adviser` (`ts_avs_id`, `ts_id`, `tc_id`) VALUES
(1, 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `thesis_grouptype`
--

CREATE TABLE `thesis_grouptype` (
  `ts_gt_id` int(11) NOT NULL COMMENT 'id',
  `ts_gt_name` varchar(255) NOT NULL COMMENT 'ชื่อประเภทกลุ่มโครงงาน',
  `ts_gt_number` int(11) NOT NULL COMMENT 'จำนวนคนต่อกลุม',
  `delete_flag` int(11) NOT NULL DEFAULT 0 COMMENT 'สถานะลบ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='ข้อมูลประเภทกลุ่มโครงงาน';

--
-- Dumping data for table `thesis_grouptype`
--

INSERT INTO `thesis_grouptype` (`ts_gt_id`, `ts_gt_name`, `ts_gt_number`, `delete_flag`) VALUES
(1, 'รายบุคคล', 1, 0),
(2, 'กลุ่ม', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `thesis_student`
--

CREATE TABLE `thesis_student` (
  `ts_std_id` int(11) NOT NULL COMMENT 'id',
  `ts_id` int(11) NOT NULL COMMENT 'id thesis ปริญญานิพนธ์',
  `std_id` int(11) NOT NULL COMMENT 'id student นักศึกษา'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='ข้อมูลนักศึกษาเจ้าของปริญญานิพนธ์';

--
-- Dumping data for table `thesis_student`
--

INSERT INTO `thesis_student` (`ts_std_id`, `ts_id`, `std_id`) VALUES
(3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'id',
  `user_username` varchar(255) NOT NULL COMMENT 'ชื่อผู้ใช้',
  `user_password` text NOT NULL COMMENT 'รหัสผ่าน',
  `user_fname` varchar(255) NOT NULL COMMENT 'ชื่อ',
  `user_lname` varchar(255) NOT NULL COMMENT 'นามสกุล',
  `user_email` varchar(255) NOT NULL COMMENT 'อีเมลล์',
  `delete_flag` int(11) NOT NULL DEFAULT 0 COMMENT 'สถานะลบ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='ข้อมูลผู้ใช้';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_username`, `user_password`, `user_fname`, `user_lname`, `user_email`, `delete_flag`) VALUES
(1, 'admin', '$2y$10$gkkdGMiXBJLSgPW.dhWkPOvXOzFas0/jCMcOL8I4Wi2wFnmOrG.a2', 'admin', 'admin', 'admin@admin.com', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_year`
--
ALTER TABLE `academic_year`
  ADD PRIMARY KEY (`ay_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `fk_course_degree` (`degree_id`);

--
-- Indexes for table `degree`
--
ALTER TABLE `degree`
  ADD PRIMARY KEY (`degree_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexes for table `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`major_id`),
  ADD KEY `fk_major_course` (`course_id`),
  ADD KEY `fk_major_faculty` (`faculty_id`);

--
-- Indexes for table `prefix`
--
ALTER TABLE `prefix`
  ADD PRIMARY KEY (`prefix_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`std_id`),
  ADD KEY `fk_std_faculty` (`faculty_id`),
  ADD KEY `fk_std_major` (`major_id`),
  ADD KEY `fk_std_gender` (`gender_id`),
  ADD KEY `fk_std_prefix` (`prefix_id`),
  ADD KEY `fk_std_ay` (`ay_id`);

--
-- Indexes for table `student_adviser`
--
ALTER TABLE `student_adviser`
  ADD PRIMARY KEY (`std_avs_id`),
  ADD KEY `fk_avs_tc` (`tc_id`),
  ADD KEY `fk_avs_ay` (`ay_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`tc_id`),
  ADD KEY `fk_tc_gender` (`gender_id`),
  ADD KEY `fk_tc_prefix` (`prefix_id`);

--
-- Indexes for table `teacher_position`
--
ALTER TABLE `teacher_position`
  ADD PRIMARY KEY (`tp_id`);

--
-- Indexes for table `thesis`
--
ALTER TABLE `thesis`
  ADD PRIMARY KEY (`ts_id`),
  ADD KEY `fk_ts_gt` (`ts_gt_id`);

--
-- Indexes for table `thesis_adviser`
--
ALTER TABLE `thesis_adviser`
  ADD PRIMARY KEY (`ts_avs_id`),
  ADD KEY `fk_tstc_ts` (`ts_id`),
  ADD KEY `fk_tstc_tc` (`tc_id`);

--
-- Indexes for table `thesis_grouptype`
--
ALTER TABLE `thesis_grouptype`
  ADD PRIMARY KEY (`ts_gt_id`);

--
-- Indexes for table `thesis_student`
--
ALTER TABLE `thesis_student`
  ADD PRIMARY KEY (`ts_std_id`),
  ADD KEY `fk_tstd_ts` (`ts_id`),
  ADD KEY `fk_tstd_std` (`std_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_year`
--
ALTER TABLE `academic_year`
  MODIFY `ay_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `gender_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prefix`
--
ALTER TABLE `prefix`
  MODIFY `prefix_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `std_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_adviser`
--
ALTER TABLE `student_adviser`
  MODIFY `std_avs_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `tc_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `teacher_position`
--
ALTER TABLE `teacher_position`
  MODIFY `tp_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `thesis`
--
ALTER TABLE `thesis`
  MODIFY `ts_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `thesis_adviser`
--
ALTER TABLE `thesis_adviser`
  MODIFY `ts_avs_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `thesis_grouptype`
--
ALTER TABLE `thesis_grouptype`
  MODIFY `ts_gt_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `thesis_student`
--
ALTER TABLE `thesis_student`
  MODIFY `ts_std_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `fk_course_degree` FOREIGN KEY (`degree_id`) REFERENCES `degree` (`degree_id`);

--
-- Constraints for table `major`
--
ALTER TABLE `major`
  ADD CONSTRAINT `fk_major_course` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `fk_major_faculty` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_std_ay` FOREIGN KEY (`ay_id`) REFERENCES `academic_year` (`ay_id`),
  ADD CONSTRAINT `fk_std_faculty` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`),
  ADD CONSTRAINT `fk_std_gender` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`gender_id`),
  ADD CONSTRAINT `fk_std_major` FOREIGN KEY (`major_id`) REFERENCES `major` (`major_id`),
  ADD CONSTRAINT `fk_std_prefix` FOREIGN KEY (`prefix_id`) REFERENCES `prefix` (`prefix_id`);

--
-- Constraints for table `student_adviser`
--
ALTER TABLE `student_adviser`
  ADD CONSTRAINT `fk_avs_ay` FOREIGN KEY (`ay_id`) REFERENCES `academic_year` (`ay_id`),
  ADD CONSTRAINT `fk_avs_tc` FOREIGN KEY (`tc_id`) REFERENCES `teacher` (`tc_id`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `fk_tc_gender` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`gender_id`),
  ADD CONSTRAINT `fk_tc_prefix` FOREIGN KEY (`prefix_id`) REFERENCES `prefix` (`prefix_id`);

--
-- Constraints for table `thesis`
--
ALTER TABLE `thesis`
  ADD CONSTRAINT `fk_ts_gt` FOREIGN KEY (`ts_gt_id`) REFERENCES `thesis_grouptype` (`ts_gt_id`);

--
-- Constraints for table `thesis_adviser`
--
ALTER TABLE `thesis_adviser`
  ADD CONSTRAINT `fk_tstc_tc` FOREIGN KEY (`tc_id`) REFERENCES `teacher` (`tc_id`),
  ADD CONSTRAINT `fk_tstc_ts` FOREIGN KEY (`ts_id`) REFERENCES `thesis` (`ts_id`);

--
-- Constraints for table `thesis_student`
--
ALTER TABLE `thesis_student`
  ADD CONSTRAINT `fk_tstd_std` FOREIGN KEY (`std_id`) REFERENCES `student` (`std_id`),
  ADD CONSTRAINT `fk_tstd_ts` FOREIGN KEY (`ts_id`) REFERENCES `thesis` (`ts_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
