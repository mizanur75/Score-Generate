-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 09, 2024 at 09:29 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `axis_proj`
--

-- --------------------------------------------------------

--
-- Table structure for table `analysis`
--

DROP TABLE IF EXISTS `analysis`;
CREATE TABLE IF NOT EXISTS `analysis` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `Month_Name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `total_of_credit_transactions_amount` varchar(100) DEFAULT NULL,
  `total_of_cash_withdrawals_amount` varchar(100) DEFAULT NULL,
  `total_no_of_cheque_bounce_inward` varchar(100) DEFAULT NULL,
  `total_no_cheque_bounce_outward` varchar(100) DEFAULT NULL,
  `total_no_technical_cheque_bounce` varchar(100) DEFAULT NULL,
  `total_no_non_technical_cheque_bounce` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `analysis`
--

INSERT INTO `analysis` (`id`, `Month_Name`, `total_of_credit_transactions_amount`, `total_of_cash_withdrawals_amount`, `total_no_of_cheque_bounce_inward`, `total_no_cheque_bounce_outward`, `total_no_technical_cheque_bounce`, `total_no_non_technical_cheque_bounce`) VALUES
(1, 'Oct-2022', '29110519.25', '100000', '0', '8', '0', '0'),
(2, 'Nov-2022', '40329678.26', '105043.8', '0', '4', '0', '0'),
(3, 'Dec-2022', '44665688.52', '100000', '1', '5', '0', '1'),
(4, 'Jan-2023', '43580662.08', '100000', '0', '3', '0', '0'),
(5, 'Feb-2023', '39719358.92', '100000', '0', '7', '0', '0'),
(6, 'Mar-2023', '56410139.69', '100000', '0', '10', '0', '0'),
(7, 'Apr-2023', '34764512.22', '100000', '0', '5', '0', '0'),
(8, 'May-2023', '51665658.89', '100000', '0', '2', '0', '0'),
(9, 'Jun-2023', '53274043.88', '100000', '0', '6', '0', '0'),
(10, 'Jul-2023', '44410852.22', '100000', '0', '6', '0', '0'),
(11, 'Aug-2023', '43997414.63', '100000', '0', '10', '0', '0'),
(12, 'Sep-2023', '22268446.73', '100000', '0', '7', '0', '0'),
(13, 'Oct-2023', '45857793.67', '100000', '0', '8', '0', '0'),
(14, NULL, '550054768.96', '1305043.8', '1', '81', '0', '1');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_category_master`
--

DROP TABLE IF EXISTS `attribute_category_master`;
CREATE TABLE IF NOT EXISTS `attribute_category_master` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Model_Name` varchar(255) DEFAULT NULL,
  `Attribute` varchar(255) DEFAULT NULL,
  `Value_of_Attribute` varchar(255) DEFAULT NULL,
  `Assigned_Category` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Attribute` (`Attribute`(250)),
  KEY `Value_of_Attribute` (`Value_of_Attribute`(250))
) ENGINE=MyISAM AUTO_INCREMENT=173 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attribute_category_master`
--

INSERT INTO `attribute_category_master` (`id`, `Model_Name`, `Attribute`, `Value_of_Attribute`, `Assigned_Category`) VALUES
(1, '1', 'Business_Constitution', 'LIMITED LIABILITY', '5'),
(2, '1', 'Business_Constitution', 'PUBLIC LIMITED', '5'),
(3, '1', 'Business_Constitution', 'HUF', '5'),
(4, '1', 'Business_Constitution', 'HOUSE WIFE', '5'),
(5, '1', 'Business_Constitution', 'PARTNERSHIP', '4'),
(6, '1', 'Business_Constitution', 'SELF EMPLOYED PROFESSIONAL', '4'),
(7, '1', 'Business_Constitution', 'OTHERS', '3'),
(8, '1', 'Business_Constitution', 'Pvt Ltd', '3'),
(9, '1', 'Business_Constitution', 'SELF EMPLOYED NON PROFESSIONAL', '2'),
(10, '1', 'Gender', 'Male', '3'),
(11, '1', 'Gender', 'Female', '2'),
(12, '1', 'ELIGIBILITY_PROGRAM', 'LLP', '5'),
(13, '1', 'ELIGIBILITY_PROGRAM', 'PE', '5'),
(14, '1', 'ELIGIBILITY_PROGRAM', 'BTS', '5'),
(15, '1', 'ELIGIBILITY_PROGRAM', 'CPM', '4'),
(16, '1', 'ELIGIBILITY_PROGRAM', 'SAL', '4'),
(17, '1', 'ELIGIBILITY_PROGRAM', 'PRP', '4'),
(18, '1', 'ELIGIBILITY_PROGRAM', 'SALHL', '4'),
(19, '1', 'ELIGIBILITY_PROGRAM', 'CAIP', '3'),
(20, '1', 'ELIGIBILITY_PROGRAM', 'CMAP', '2'),
(21, '1', 'ELIGIBILITY_PROGRAM', 'ABP', '2'),
(22, '1', 'ELIGIBILITY_PROGRAM', 'RGM', '2'),
(23, '1', 'ELIGIBILITY_PROGRAM', 'MTP', '2'),
(24, '1', 'ELIGIBILITY_PROGRAM', 'SELFCP', '2'),
(25, '1', 'ELIGIBILITY_PROGRAM', 'GR', '2'),
(26, '1', 'ELIGIBILITY_PROGRAM', 'CAP', '2'),
(27, '1', 'ELIGIBILITY_PROGRAM', 'LATERNG', '2'),
(28, '1', 'ELIGIBILITY_PROGRAM', 'SELFCMA', '2'),
(29, '1', 'ELIGIBILITY_PROGRAM', 'GP', '2'),
(30, '1', 'ELIGIBILITY_PROGRAM', 'SELFCA', '2'),
(31, '1', 'ELIGIBILITY_PROGRAM', 'GRP', '2'),
(32, '1', 'ELIGIBILITY_PROGRAM', 'GPM', '2'),
(33, '1', 'ELIGIBILITY_PROGRAM', 'SELFEMP', '2'),
(34, '1', 'ELIGIBILITY_PROGRAM', 'SENP', '2'),
(35, '1', 'RELATIONSHIP', 'SPOUSE', '2'),
(36, '1', 'RELATIONSHIP', 'BRO_SIBLIN', '2'),
(37, '1', 'RELATIONSHIP', 'WIFE', '2'),
(38, '1', 'RELATIONSHIP', 'HUSBAND', '2'),
(39, '1', 'RELATIONSHIP', 'BROTHER', '2'),
(40, '1', 'RELATIONSHIP', 'FAMILY_MEM', '2'),
(41, '1', 'RELATIONSHIP', 'SIBLING', '2'),
(42, '1', 'RELATIONSHIP', 'DISTANT_RE', '2'),
(43, '1', 'RELATIONSHIP', 'SISTER', '2'),
(44, '1', 'RELATIONSHIP', 'SON', '4'),
(45, '1', 'RELATIONSHIP', 'DAUGHTER', '4'),
(46, '1', 'RELATIONSHIP', 'HOLDING', '5'),
(47, '1', 'RELATIONSHIP', 'DIRECTOR', '5'),
(48, '1', 'RELATIONSHIP', 'PARTNER', '5'),
(49, '1', 'RELATIONSHIP', 'PROPREITOR', '5'),
(50, '1', 'RELATIONSHIP', 'BUSINESS', '5'),
(51, '1', 'RELATIONSHIP', 'SHAREHOLD', '5'),
(52, '1', 'channel', 'UBS', '5'),
(53, '1', 'channel', 'CROSS SELLING', '5'),
(54, '1', 'channel', 'REFERRAL PARTNER', '4'),
(55, '1', 'channel', '(DSA)DIRECT SELLING AGENT', '3'),
(56, '1', 'DEAL_EXISTING_CUSTOMER', 'N', '2'),
(57, '1', 'product_id', 'LAP_INST', '5'),
(58, '1', 'product_id', 'HL_PMR', '5'),
(59, '1', 'product_id', 'CF_IN', '5'),
(60, '1', 'product_id', 'LAP_INFRML', '5'),
(61, '1', 'product_id', 'HL_INFRML', '5'),
(62, '1', 'product_id', 'CF_CF', '4'),
(63, '1', 'product_id', 'CPP', '4'),
(64, '1', 'product_id', 'CPP_PRIME', '4'),
(65, '1', 'product_id', 'HL', '3'),
(66, '1', 'product_id', 'HL_PRIME', '3'),
(67, '1', 'product_id', 'HE', '2'),
(68, '1', 'loan_sector_type', 'AGRICULTURE', '1'),
(69, '1', 'loan_sector_type', 'PSL WEAKER BY CASTE', '1'),
(70, '1', 'loan_sector_type', 'PSL WEAKER BY LAND', '1'),
(71, '1', 'loan_sector_type', 'PRIORITY SECTOR LENDING', '2'),
(72, '1', 'loan_sector_type', 'NON PRIORITY SECTOR LENDING', '3'),
(73, '1', 'loan_sector_type', 'OTHER PSL', '4'),
(74, '1', 'loan_sector_type', 'HOUSING', '4'),
(75, '1', 'loan_sector_type', 'EDUCATION LOAN', '5'),
(76, '1', 'company_category', 'CAT C', '2'),
(77, '1', 'company_category', 'CAT A', '5'),
(78, '1', 'company_category', 'CAT B', '4'),
(79, '1', 'property_status', 'OCCUPIED BY FAMILY OR FRIEND', '2'),
(80, '1', 'property_status', 'SELF OCCUPIED', '3'),
(81, '1', 'property_status', 'LEASED OR RENTED', '3'),
(82, '1', 'property_status', 'VACANT', '4'),
(83, '1', 'property_status', 'UNDER CONSTRUCTION', '5'),
(84, '1', 'PROP_TYPE_DESC', 'Land', '5'),
(85, '1', 'PROP_TYPE_DESC', 'Shop', '5'),
(86, '1', 'PROP_TYPE_DESC', 'Independent house', '4'),
(87, '1', 'PROP_TYPE_DESC', 'Duplex', '4'),
(88, '1', 'PROP_TYPE_DESC', 'Apartment', '3'),
(89, '1', 'PROP_TYPE_DESC', 'Mix Usage Building', '3'),
(90, '1', 'PROP_TYPE_DESC', 'Mix Usage land', '3'),
(91, '1', 'PROP_TYPE_DESC', 'Mix Usage Unit', '3'),
(92, '1', 'PROP_TYPE_DESC', 'Builder Floor', '2'),
(93, '1', 'PROP_TYPE_DESC', 'BUILDER FLAT G+2/3/4', '2'),
(94, '1', 'PROP_TYPE_DESC', 'Industrial building', '2'),
(95, '1', 'PROP_TYPE_DESC', 'Industrial Land', '2'),
(96, '1', 'PROP_TYPE_DESC', 'Industrial unit', '2'),
(97, '1', 'PROP_TYPE_DESC', 'BUNGALOW', '2'),
(98, '1', 'PROP_TYPE_DESC', 'Condos', '2'),
(99, '1', 'district', '339', '2'),
(100, '1', 'district', '172', '2'),
(101, '1', 'district', '49', '2'),
(102, '1', 'district', '285', '2'),
(103, '1', 'district', '554', '2'),
(104, '1', 'district', '233', '2'),
(105, '1', 'district', '162', '3'),
(106, '1', 'district', '355', '3'),
(107, '1', 'district', '343', '3'),
(108, '1', 'district', '8', '3'),
(109, '1', 'district', '102', '3'),
(110, '1', 'district', '606', '3'),
(111, '1', 'district', '559', '3'),
(112, '1', 'district', '667', '3'),
(113, '1', 'district', '466', '3'),
(114, '1', 'district', '127', '3'),
(115, '1', 'district', '160', '3'),
(116, '1', 'district', '344', '3'),
(117, '1', 'district', '600', '3'),
(118, '1', 'district', '292', '3'),
(119, '1', 'district', '439', '3'),
(120, '1', 'district', '650', '3'),
(121, '1', 'district', '152', '3'),
(122, '1', 'district', '461', '3'),
(123, '1', 'district', '166', '3'),
(124, '1', 'district', '561', '3'),
(125, '1', 'district', '513', '3'),
(126, '1', 'district', '16', '3'),
(127, '1', 'district', '123', '3'),
(128, '1', 'district', '440', '3'),
(129, '1', 'district', '122', '3'),
(130, '1', 'district', '0', '3'),
(131, '1', 'district', '125', '3'),
(132, '1', 'DISTRICT', '133', '4'),
(133, '1', 'DISTRICT', '620', '4'),
(134, '1', 'DISTRICT', '460', '4'),
(135, '1', 'DISTRICT', '13', '4'),
(136, '1', 'DISTRICT', '496', '4'),
(137, '1', 'DISTRICT', '129', '4'),
(138, '1', 'DISTRICT', '148', '4'),
(139, '1', 'DISTRICT', '130', '4'),
(140, '1', 'DISTRICT', '9', '4'),
(141, '1', 'DISTRICT', '145', '4'),
(142, '1', 'DISTRICT', '602', '4'),
(143, '1', 'DISTRICT', '489', '4'),
(144, '1', 'DISTRICT', '21', '5'),
(145, '1', 'DISTRICT', '306', '5'),
(146, '1', 'DISTRICT', '232', '5'),
(147, '1', 'DISTRICT', '319', '5'),
(148, '1', 'DISTRICT', '157', '5'),
(149, '1', 'DISTRICT', '712', '5'),
(150, '1', 'DISTRICT', '469', '5'),
(151, '1', 'DISTRICT', '474', '5'),
(152, '1', 'DISTRICT', '26', '5'),
(153, '1', 'DISTRICT', '688', '5'),
(154, '1', 'DISTRICT', '589', '5'),
(155, '1', 'DISTRICT', '567', '5'),
(156, '1', 'DISTRICT', '485', '5'),
(157, '1', 'DISTRICT', '470', '5'),
(158, '1', 'DISTRICT', '336', '5'),
(159, '1', 'DISTRICT', '325', '5'),
(160, '1', 'DISTRICT', '25', '5'),
(161, '1', 'DISTRICT', '24', '5'),
(162, '1', 'EDU_DETAIL', 'DOC', '5'),
(163, '1', 'EDU_DETAIL', 'PG', '5'),
(164, '1', 'EDU_DETAIL', 'PRO', '5'),
(165, '1', 'EDU_DETAIL', 'OTH', '4'),
(166, '1', 'EDU_DETAIL', 'UG', '3'),
(167, '1', 'EDU_DETAIL', 'DPLM', '2'),
(168, '1', 'EDU_DETAIL', 'GRAD', '2'),
(169, '1', 'EDU_DETAIL', 'HG_SCHOOL', '2'),
(170, '1', 'industry_type', 'Manufacturing Services', '2'),
(171, '1', 'city_state', 'Kolkata', '2'),
(172, '1', 'Loan_Product_Sub_Proct_Type', 'BL', '3');

-- --------------------------------------------------------

--
-- Table structure for table `custdata`
--

DROP TABLE IF EXISTS `custdata`;
CREATE TABLE IF NOT EXISTS `custdata` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Account_ID_Ref_ID` varchar(255) DEFAULT NULL,
  `Business_Constitution` varchar(255) DEFAULT NULL,
  `Gender` varchar(255) DEFAULT NULL,
  `No_of_Co_applicants` varchar(255) DEFAULT NULL,
  `No_of_Dependents` varchar(255) DEFAULT NULL,
  `Industry_Type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Loan_Tenure` varchar(255) DEFAULT NULL,
  `Total_Work_Experience` varchar(255) DEFAULT NULL,
  `Qualification` varchar(255) DEFAULT NULL,
  `Relationship_between_applicant_and_coapplicant` varchar(255) DEFAULT NULL,
  `Channel` varchar(255) DEFAULT NULL,
  `Esixting_New_Customer_Flag` varchar(255) DEFAULT NULL,
  `Loan_Product_Sub_Proct_Type` varchar(255) DEFAULT NULL,
  `Loan_Type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `PIN_City_State` varchar(255) DEFAULT NULL,
  `Date_of_Birth` varchar(255) DEFAULT NULL,
  `CIBIL` varchar(255) DEFAULT NULL,
  `Fixed_Obligations_to_Income_Ratio` varchar(255) DEFAULT NULL,
  `EMI_to_other_banks` varchar(255) DEFAULT NULL,
  `Debt_Burden_Ratio` varchar(255) DEFAULT NULL,
  `Category_of_the_company` varchar(255) DEFAULT NULL,
  `Eligibility_program` varchar(255) DEFAULT NULL,
  `abb` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `custdata`
--

INSERT INTO `custdata` (`id`, `Account_ID_Ref_ID`, `Business_Constitution`, `Gender`, `No_of_Co_applicants`, `No_of_Dependents`, `Industry_Type`, `Loan_Tenure`, `Total_Work_Experience`, `Qualification`, `Relationship_between_applicant_and_coapplicant`, `Channel`, `Esixting_New_Customer_Flag`, `Loan_Product_Sub_Proct_Type`, `Loan_Type`, `PIN_City_State`, `Date_of_Birth`, `CIBIL`, `Fixed_Obligations_to_Income_Ratio`, `EMI_to_other_banks`, `Debt_Burden_Ratio`, `Category_of_the_company`, `Eligibility_program`, `abb`) VALUES
(1, 'Ref001', 'Pvt Ltd', 'Male', '2', '3', 'Manufacturing Services', '60', '10', 'Under Graduate', 'WIFE', 'DSA', 'N', 'BL', 'WC', 'Kolkata', '13-03-1976', '690', '0.2', '0.1', '0.25', 'Cat B', 'General', '636,949.04');

-- --------------------------------------------------------

--
-- Table structure for table `customer_gst`
--

DROP TABLE IF EXISTS `customer_gst`;
CREATE TABLE IF NOT EXISTS `customer_gst` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ref_id` varchar(50) NOT NULL,
  `abb_l12mo` varchar(50) NOT NULL,
  `abb_tot` varchar(50) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `pan_number` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer_gst`
--

INSERT INTO `customer_gst` (`id`, `ref_id`, `abb_l12mo`, `abb_tot`, `account_number`, `pan_number`, `created_at`) VALUES
(1, 'Ref001', '636,949.04', '617,782.89', '', '', '2024-04-22 05:07:17');

-- --------------------------------------------------------

--
-- Table structure for table `data_analysis`
--

DROP TABLE IF EXISTS `data_analysis`;
CREATE TABLE IF NOT EXISTS `data_analysis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ref_id` varchar(50) DEFAULT NULL,
  `b2b_iv` varchar(50) DEFAULT NULL,
  `b2c_liv` varchar(50) DEFAULT NULL,
  `b2c_siv` varchar(50) DEFAULT NULL,
  `export_iv` varchar(50) DEFAULT NULL,
  `sci_gst` varchar(50) DEFAULT NULL,
  `tax_zero_outware` varchar(50) DEFAULT NULL,
  `tax_nill_outware` varchar(50) DEFAULT NULL,
  `tax_paid_in_credit` varchar(50) DEFAULT NULL,
  `latest_fy_iv` varchar(50) DEFAULT NULL,
  `pre_fy_iv` varchar(50) DEFAULT NULL,
  `total_iv_flag` varchar(50) DEFAULT NULL,
  `compare_tiv` varchar(50) DEFAULT NULL,
  `compare_ttv` varchar(50) DEFAULT NULL,
  `payment_null_0` varchar(50) DEFAULT NULL,
  `late_fee_null_0` varchar(50) DEFAULT NULL,
  `credit_transaction_amount` varchar(50) DEFAULT NULL,
  `cheque_bounce_outward` varchar(50) DEFAULT NULL,
  `cheque_bounce_inward` varchar(50) DEFAULT NULL,
  `tech_cheque_bounce_inward` varchar(50) DEFAULT NULL,
  `non_tech_cheque_bounce_inward` varchar(50) DEFAULT NULL,
  `cash_withdrawal` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_analysis`
--

INSERT INTO `data_analysis` (`id`, `ref_id`, `b2b_iv`, `b2c_liv`, `b2c_siv`, `export_iv`, `sci_gst`, `tax_zero_outware`, `tax_nill_outware`, `tax_paid_in_credit`, `latest_fy_iv`, `pre_fy_iv`, `total_iv_flag`, `compare_tiv`, `compare_ttv`, `payment_null_0`, `late_fee_null_0`, `credit_transaction_amount`, `cheque_bounce_outward`, `cheque_bounce_inward`, `tech_cheque_bounce_inward`, `non_tech_cheque_bounce_inward`, `cash_withdrawal`) VALUES
(1, 'Ref001', '7', '0', '2', '0', '0', '0', '0', '0', '970446204.58', '951379215.76', '0', '1', '3', '20', '20', '8', '3', '1', '0', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `derived_gstr1_periodical_summary`
--

DROP TABLE IF EXISTS `derived_gstr1_periodical_summary`;
CREATE TABLE IF NOT EXISTS `derived_gstr1_periodical_summary` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `ref_id` varchar(30) NOT NULL DEFAULT 'Ref001',
  `month` varchar(30) DEFAULT NULL,
  `b2b_iv_by_total_value` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `b2c_liv_by_total_value` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `b2c_siv_by_total_value` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Export_Iv` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Total_TV` varchar(100) DEFAULT NULL,
  `Total_Iv` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `derived_gstr1_periodical_summary`
--

INSERT INTO `derived_gstr1_periodical_summary` (`id`, `ref_id`, `month`, `b2b_iv_by_total_value`, `b2c_liv_by_total_value`, `b2c_siv_by_total_value`, `Export_Iv`, `Total_TV`, `Total_Iv`) VALUES
(1, 'Ref001', '2022-04-30', '0.15025618158172116', NULL, '0.8622596272867455', '0', '60015890.64', '105172067.09'),
(2, 'Ref001', '2022-05-31', '0.12038692353641313', NULL, '0.8900932076037467', '0', '54833751.62', '97047116.72'),
(3, 'Ref001', '2022-06-30', '0.1605951871414447', NULL, '0.8554550427551842', '0', '65019416.05', '109682637.03'),
(4, 'Ref001', '2022-07-31', '0.13643791196590616', NULL, '0.875486893633684', '0', '61299955.44', '107068107.68'),
(5, 'Ref001', '2022-08-31', '0.12632787812057933', NULL, '0.8823226322852997', '0', '60571229.22', '103849200.55'),
(6, 'Ref001', '2022-09-30', '0.2666025866696528', NULL, '0.7412854914718494', '0', '58643804.58', '101639673.9'),
(7, 'Ref001', '2022-10-31', '0.200122194870284', NULL, '0.8190206325364466', '0', '64013188.07', '110969011.78'),
(8, 'Ref001', '2022-11-30', '0.14096242858808927', NULL, '0.8749622455985775', '0', '59596349.03', '101505052.54'),
(9, 'Ref001', '2022-12-31', '0.20338839116480553', NULL, '0.8019095204602119', '0', '66335849.99', '114446348.47'),
(10, 'Ref001', '2023-01-31', '0.09454079169577632', NULL, '0.9253833178639373', '0', '63901582.05', '116217077.76'),
(11, 'Ref001', '2023-02-28', '0.047786690895400157', NULL, '0.9562921898883331', '0', '57799548.51', '108129333.36'),
(12, 'Ref001', '2023-03-31', '0.046299953689601554', NULL, '0.9548627908337078', '0', '44402898.54', '81239832.23'),
(13, 'Ref001', '2023-04-30', '0.1460585324998334', NULL, '0.8584313011427845', '0', '46960246.07', '85109006.35'),
(14, 'Ref001', '2023-05-31', '0.22902598661463283', NULL, '0.7743028628633716', '0', '53542945.34', '97447070.57'),
(15, 'Ref001', '2023-06-30', '0.0605919857884896', NULL, '0.9486433007052267', '0', '59509546.44', '110836680.67'),
(16, 'Ref001', '2023-07-31', '0.1343974766166274', NULL, '0.867254209629338', '0', '70324543.07', '132238747.24'),
(17, 'Ref001', '2023-08-31', '0.1311152067449526', NULL, '0.8708065720462906', '0', '63991210.77', '119036905.31'),
(18, 'Ref001', '2023-09-30', '0.09116633988793119', NULL, '0.9098852957226421', '0', '62783304.26', '116582881.72'),
(19, 'Ref001', '2023-10-31', '0.31682819438298543', NULL, '0.6840479192237726', '0', '62846059.17', '115539205.44'),
(20, 'Ref001', '2023-11-30', '0.18098243590778365', NULL, '0.8206736455689647', '0', '44145757.83', '78905441.45'),
(21, 'Ref001', '2023-12-31', '0.23170955028017645', NULL, '0.7716139767482053', '0', '66415236.37', '114750265.83');

-- --------------------------------------------------------

--
-- Table structure for table `excel_datas`
--

DROP TABLE IF EXISTS `excel_datas`;
CREATE TABLE IF NOT EXISTS `excel_datas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `wholesale_business` varchar(200) DEFAULT NULL,
  `retail_business` varchar(200) DEFAULT NULL,
  `others` varchar(200) DEFAULT NULL,
  `gross_turnover24` varchar(200) DEFAULT NULL,
  `gross_turnover23` varchar(200) DEFAULT NULL,
  `net_revenue24` varchar(200) DEFAULT NULL,
  `net_revenue23` varchar(200) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `excel_datas`
--

INSERT INTO `excel_datas` (`id`, `wholesale_business`, `retail_business`, `others`, `gross_turnover24`, `gross_turnover23`, `net_revenue24`, `net_revenue23`, `created_at`) VALUES
(1, '0', '0', '0', '970446204.58', '1256965459.11', '530518849.32', '716433463.74', '2024-01-24 11:03:53'),
(2, NULL, NULL, NULL, '970446204.58', '1256965459.11', '530518849.32', '716433463.74', '2024-01-24 11:12:24'),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-28 10:13:39'),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-28 10:15:44'),
(5, '0', '0', '0', '970446204.58', '1256965459.11', '530518849.32', NULL, '2024-03-28 10:23:41');

-- --------------------------------------------------------

--
-- Table structure for table `gstr1_periodical_summary`
--

DROP TABLE IF EXISTS `gstr1_periodical_summary`;
CREATE TABLE IF NOT EXISTS `gstr1_periodical_summary` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `ref_id` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Ref001',
  `Month_Name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Total_Invoice_Value` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Total_Taxable_Value` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `B2B_Invoice_Value` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `B2C_Large_Invoice_Value` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `B2C_Small_Invoice_Value` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Export_Invoice_Value` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `gstr1_periodical_summary`
--

INSERT INTO `gstr1_periodical_summary` (`id`, `ref_id`, `Month_Name`, `Total_Invoice_Value`, `Total_Taxable_Value`, `B2B_Invoice_Value`, `B2C_Large_Invoice_Value`, `B2C_Small_Invoice_Value`, `Export_Invoice_Value`) VALUES
(1, 'Ref001', 'Apr-22', '105172067.09', '60015890.64', '15802753.21', NULL, '90685627.37', '0'),
(2, 'Ref001', 'May-22', '97047116.72', '54833751.62', '11683203.82', NULL, '86380979.41', '0'),
(3, 'Ref001', 'Jun-22', '109682637.03', '65019416.05', '17614503.62', NULL, '93828564.95', '0'),
(4, 'Ref001', 'Jul-22', '107068107.68', '61299955.44', '14608149.05', NULL, '93736725', '0'),
(5, 'Ref001', 'Aug-22', '103849200.55', '60571229.22', '13119049.15', NULL, '91628499.99', '0'),
(6, 'Ref001', 'Sep-22', '101639673.9', '58643804.58', '27097399.97', NULL, '75344015.62', '0'),
(7, 'Ref001', 'Oct-22', '110969011.78', '64013188.07', '22207362.2', NULL, '90885910.22', '0'),
(8, 'Ref001', 'Nov-22', '101505052.54', '59596349.03', '14308398.72', NULL, '88813088.71', '0'),
(9, 'Ref001', 'Dec-22', '114446348.47', '66335849.99', '23277058.69', NULL, '91775616.42', '0'),
(10, 'Ref001', 'Jan-23', '116217077.76', '63901582.05', '10987254.54', NULL, '107545345.01', '0'),
(11, 'Ref001', 'Feb-23', '108129333.36', '57799548.51', '5167143.03', NULL, '103403236.99', '0'),
(12, 'Ref001', 'Mar-23', '81239832.23', '44402898.54', '3761400.47', NULL, '77572892.93', '0'),
(13, 'Ref001', 'Apr-23', '85109006.35', '46960246.07', '12430896.57', NULL, '73060235.06', '0'),
(14, 'Ref001', 'May-23', '97447070.57', '53542945.34', '22317911.48', NULL, '75453545.72', '0'),
(15, 'Ref001', 'Jun-23', '110836680.67', '59509546.44', '6715814.58', NULL, '105144474.59', '0'),
(16, 'Ref001', 'Jul-23', '132238747.24', '70324543.07', '17772553.94', NULL, '114684610.22', '0'),
(17, 'Ref001', 'Aug-23', '119036905.31', '63991210.77', '15607548.45', NULL, '103658119.46', '0'),
(18, 'Ref001', 'Sep-23', '116582881.72', '62783304.26', '10628434.62', NULL, '106077049.81', '0'),
(19, 'Ref001', 'Oct-23', '115539205.44', '62846059.17', '36606077.84', NULL, '79034353.07', '0'),
(20, 'Ref001', 'Nov-23', '78905441.45', '44145757.83', '14280499', NULL, '64755616.29', '0'),
(21, 'Ref001', 'Dec-23', '114750265.83', '66415236.37', '26588732.49', NULL, '88542908.95', '0');

-- --------------------------------------------------------

--
-- Table structure for table `gstr3b_periodical_summary`
--

DROP TABLE IF EXISTS `gstr3b_periodical_summary`;
CREATE TABLE IF NOT EXISTS `gstr3b_periodical_summary` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `ref_id` varchar(30) DEFAULT NULL,
  `Month_Name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `SGST` varchar(100) DEFAULT NULL,
  `CGST` varchar(100) DEFAULT NULL,
  `IGST` varchar(100) DEFAULT NULL,
  `Total_Tax_Zero_rated_Outward_taxable_supplies` varchar(100) DEFAULT NULL,
  `Total_Tax_nill_rated_Outward_taxable_supplies` varchar(100) DEFAULT NULL,
  `Total_Tax_Paid` varchar(100) DEFAULT NULL,
  `Tax_paid_In_Credit` varchar(100) DEFAULT NULL,
  `Interest_Payment` varchar(100) DEFAULT NULL,
  `Late_Fee` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `gstr3b_periodical_summary`
--

INSERT INTO `gstr3b_periodical_summary` (`id`, `ref_id`, `Month_Name`, `SGST`, `CGST`, `IGST`, `Total_Tax_Zero_rated_Outward_taxable_supplies`, `Total_Tax_nill_rated_Outward_taxable_supplies`, `Total_Tax_Paid`, `Tax_paid_In_Credit`, `Interest_Payment`, `Late_Fee`) VALUES
(1, 'Ref001', 'Apr-22', '0', '0', '0', NULL, NULL, '4', '20', NULL, NULL),
(2, 'Ref001', 'May-22', '0', '0', '0', NULL, NULL, '5', '15', NULL, NULL),
(3, 'Ref001', 'Jun-22', '2', '0', '0', NULL, NULL, '2', '6', NULL, NULL),
(4, 'Ref001', 'Jul-22', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Ref001', 'Aug-22', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Ref001', 'Sep-22', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Ref001', 'Oct-22', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Ref001', 'Nov-22', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Ref001', 'Dec-22', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Ref001', 'Jan-23', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Ref001', 'Feb-23', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Ref001', 'Mar-23', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Ref001', 'Apr-23', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'Ref001', 'May-23', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Ref001', 'Jun-23', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Ref001', 'Jul-23', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Ref001', 'Aug-23', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'Ref001', 'Sep-23', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'Ref001', 'Oct-23', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'Ref001', 'Nov-23', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `scaled_inputs`
--

DROP TABLE IF EXISTS `scaled_inputs`;
CREATE TABLE IF NOT EXISTS `scaled_inputs` (
  `id` int NOT NULL DEFAULT '0',
  `cat_Business_Constitution` varchar(255) DEFAULT NULL,
  `cat_gender` varchar(255) DEFAULT NULL,
  `cat_no_of_Coapp` int NOT NULL DEFAULT '0',
  `No_of_Dependents` int NOT NULL DEFAULT '0',
  `CAT_loan_tenure` int NOT NULL DEFAULT '0',
  `CAT_YearExp` int NOT NULL DEFAULT '0',
  `cat_eligibility` varchar(255) DEFAULT NULL,
  `cat_qualification` varchar(255) DEFAULT NULL,
  `cat_cibil` int NOT NULL DEFAULT '0',
  `cat_relation` varchar(255) DEFAULT NULL,
  `cat_channel` varchar(255) DEFAULT NULL,
  `cat_exist_customer` varchar(255) DEFAULT NULL,
  `cat_company` varchar(255) DEFAULT NULL,
  `cat_loan_type` varchar(255) DEFAULT NULL,
  `cat_industry_type` varchar(255) DEFAULT NULL,
  `cat_city_state` varchar(255) DEFAULT NULL,
  `cat_lpsp` varchar(255) DEFAULT NULL,
  `CAT_foir` int NOT NULL DEFAULT '0',
  `cat_bank_emi` varchar(255) DEFAULT NULL,
  `cat_age` int NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `scaled_inputs`
--

INSERT INTO `scaled_inputs` (`id`, `cat_Business_Constitution`, `cat_gender`, `cat_no_of_Coapp`, `No_of_Dependents`, `CAT_loan_tenure`, `CAT_YearExp`, `cat_eligibility`, `cat_qualification`, `cat_cibil`, `cat_relation`, `cat_channel`, `cat_exist_customer`, `cat_company`, `cat_loan_type`, `cat_industry_type`, `cat_city_state`, `cat_lpsp`, `CAT_foir`, `cat_bank_emi`, `cat_age`) VALUES
(1, '3', '3', 5, 3, 4, 4, '1', '1', 1, '2', '1', '2', '4', '1', '2', '2', '3', 2, '0.1', 3);

-- --------------------------------------------------------

--
-- Table structure for table `scaled_outputs`
--

DROP TABLE IF EXISTS `scaled_outputs`;
CREATE TABLE IF NOT EXISTS `scaled_outputs` (
  `cat_Business_Constitution_1` int NOT NULL DEFAULT '0',
  `cat_Business_Constitution_2` int NOT NULL DEFAULT '0',
  `cat_Business_Constitution_3` int NOT NULL DEFAULT '0',
  `cat_Business_Constitution_4` int NOT NULL DEFAULT '0',
  `cat_Business_Constitution_5` int NOT NULL DEFAULT '0',
  `cat_gender_1` int NOT NULL DEFAULT '0',
  `cat_gender_2` int NOT NULL DEFAULT '0',
  `cat_gender_3` int NOT NULL DEFAULT '0',
  `cat_no_of_Coapp_1` int NOT NULL DEFAULT '0',
  `cat_no_of_Coapp_2` int NOT NULL DEFAULT '0',
  `cat_no_of_Coapp_3` int NOT NULL DEFAULT '0',
  `cat_no_of_Coapp_4` int NOT NULL DEFAULT '0',
  `cat_no_of_Coapp_5` int NOT NULL DEFAULT '0',
  `No_of_Dependents_1` int NOT NULL DEFAULT '0',
  `No_of_Dependents_2` int NOT NULL DEFAULT '0',
  `No_of_Dependents_3` int NOT NULL DEFAULT '0',
  `No_of_Dependents_4` int NOT NULL DEFAULT '0',
  `cat_industry_type_1` int NOT NULL DEFAULT '0',
  `cat_industry_type_2` int NOT NULL DEFAULT '0',
  `cat_industry_type_3` int NOT NULL DEFAULT '0',
  `cat_industry_type_4` int NOT NULL DEFAULT '0',
  `cat_industry_type_5` int NOT NULL DEFAULT '0',
  `CAT_loan_tenure_1` int NOT NULL DEFAULT '0',
  `CAT_loan_tenure_2` int NOT NULL DEFAULT '0',
  `CAT_loan_tenure_3` int NOT NULL DEFAULT '0',
  `CAT_loan_tenure_4` int NOT NULL DEFAULT '0',
  `CAT_loan_tenure_5` int NOT NULL DEFAULT '0',
  `CAT_YearExp_1` int NOT NULL DEFAULT '0',
  `CAT_YearExp_2` int NOT NULL DEFAULT '0',
  `CAT_YearExp_3` int NOT NULL DEFAULT '0',
  `CAT_YearExp_4` int NOT NULL DEFAULT '0',
  `CAT_YearExp_5` int NOT NULL DEFAULT '0',
  `cat_eligibility_1` int NOT NULL DEFAULT '0',
  `cat_eligibility_2` int NOT NULL DEFAULT '0',
  `cat_eligibility_3` int NOT NULL DEFAULT '0',
  `cat_eligibility_4` int NOT NULL DEFAULT '0',
  `cat_eligibility_5` int NOT NULL DEFAULT '0',
  `cat_qualification_1` int NOT NULL DEFAULT '0',
  `cat_qualification_2` int NOT NULL DEFAULT '0',
  `cat_qualification_3` int NOT NULL DEFAULT '0',
  `cat_qualification_4` int NOT NULL DEFAULT '0',
  `cat_qualification_5` int NOT NULL DEFAULT '0',
  `cat_relation_1` int NOT NULL DEFAULT '0',
  `cat_relation_2` int NOT NULL DEFAULT '0',
  `cat_relation_3` int NOT NULL DEFAULT '0',
  `cat_relation_4` int NOT NULL DEFAULT '0',
  `cat_relation_5` int NOT NULL DEFAULT '0',
  `cat_channel_1` int NOT NULL DEFAULT '0',
  `cat_channel_2` int NOT NULL DEFAULT '0',
  `cat_channel_3` int NOT NULL DEFAULT '0',
  `cat_channel_4` int NOT NULL DEFAULT '0',
  `cat_channel_5` int NOT NULL DEFAULT '0',
  `cat_exist_customer_1` int NOT NULL DEFAULT '0',
  `cat_exist_customer_2` int NOT NULL DEFAULT '0',
  `cat_lpsp_1` int NOT NULL DEFAULT '0',
  `cat_lpsp_2` int NOT NULL DEFAULT '0',
  `cat_lpsp_3` int NOT NULL DEFAULT '0',
  `cat_lpsp_4` int NOT NULL DEFAULT '0',
  `cat_lpsp_5` int NOT NULL DEFAULT '0',
  `cat_loan_type_1` int NOT NULL DEFAULT '0',
  `cat_loan_type_2` int NOT NULL DEFAULT '0',
  `cat_loan_type_3` int NOT NULL DEFAULT '0',
  `cat_loan_type_4` int NOT NULL DEFAULT '0',
  `cat_loan_type_5` int NOT NULL DEFAULT '0',
  `cat_company_1` int NOT NULL DEFAULT '0',
  `cat_company_2` int NOT NULL DEFAULT '0',
  `cat_company_3` int NOT NULL DEFAULT '0',
  `cat_company_4` int NOT NULL DEFAULT '0',
  `cat_company_5` int NOT NULL DEFAULT '0',
  `cat_city_state_1` int NOT NULL DEFAULT '0',
  `cat_city_state_2` int NOT NULL DEFAULT '0',
  `cat_city_state_3` int NOT NULL DEFAULT '0',
  `cat_city_state_4` int NOT NULL DEFAULT '0',
  `cat_city_state_5` int NOT NULL DEFAULT '0',
  `cat_cibil_1` int NOT NULL DEFAULT '0',
  `cat_cibil_2` int NOT NULL DEFAULT '0',
  `cat_cibil_3` int NOT NULL DEFAULT '0',
  `cat_age_1` int NOT NULL DEFAULT '0',
  `cat_age_2` int NOT NULL DEFAULT '0',
  `cat_age_3` int NOT NULL DEFAULT '0',
  `cat_age_4` int NOT NULL DEFAULT '0',
  `cat_age_5` int NOT NULL DEFAULT '0',
  `CAT_foir_1` int NOT NULL DEFAULT '0',
  `CAT_foir_2` int NOT NULL DEFAULT '0',
  `CAT_foir_3` int NOT NULL DEFAULT '0',
  `CAT_foir_4` int NOT NULL DEFAULT '0',
  `CAT_foir_5` int NOT NULL DEFAULT '0',
  `cat_bank_emi` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `scaled_outputs`
--

INSERT INTO `scaled_outputs` (`cat_Business_Constitution_1`, `cat_Business_Constitution_2`, `cat_Business_Constitution_3`, `cat_Business_Constitution_4`, `cat_Business_Constitution_5`, `cat_gender_1`, `cat_gender_2`, `cat_gender_3`, `cat_no_of_Coapp_1`, `cat_no_of_Coapp_2`, `cat_no_of_Coapp_3`, `cat_no_of_Coapp_4`, `cat_no_of_Coapp_5`, `No_of_Dependents_1`, `No_of_Dependents_2`, `No_of_Dependents_3`, `No_of_Dependents_4`, `cat_industry_type_1`, `cat_industry_type_2`, `cat_industry_type_3`, `cat_industry_type_4`, `cat_industry_type_5`, `CAT_loan_tenure_1`, `CAT_loan_tenure_2`, `CAT_loan_tenure_3`, `CAT_loan_tenure_4`, `CAT_loan_tenure_5`, `CAT_YearExp_1`, `CAT_YearExp_2`, `CAT_YearExp_3`, `CAT_YearExp_4`, `CAT_YearExp_5`, `cat_eligibility_1`, `cat_eligibility_2`, `cat_eligibility_3`, `cat_eligibility_4`, `cat_eligibility_5`, `cat_qualification_1`, `cat_qualification_2`, `cat_qualification_3`, `cat_qualification_4`, `cat_qualification_5`, `cat_relation_1`, `cat_relation_2`, `cat_relation_3`, `cat_relation_4`, `cat_relation_5`, `cat_channel_1`, `cat_channel_2`, `cat_channel_3`, `cat_channel_4`, `cat_channel_5`, `cat_exist_customer_1`, `cat_exist_customer_2`, `cat_lpsp_1`, `cat_lpsp_2`, `cat_lpsp_3`, `cat_lpsp_4`, `cat_lpsp_5`, `cat_loan_type_1`, `cat_loan_type_2`, `cat_loan_type_3`, `cat_loan_type_4`, `cat_loan_type_5`, `cat_company_1`, `cat_company_2`, `cat_company_3`, `cat_company_4`, `cat_company_5`, `cat_city_state_1`, `cat_city_state_2`, `cat_city_state_3`, `cat_city_state_4`, `cat_city_state_5`, `cat_cibil_1`, `cat_cibil_2`, `cat_cibil_3`, `cat_age_1`, `cat_age_2`, `cat_age_3`, `cat_age_4`, `cat_age_5`, `CAT_foir_1`, `CAT_foir_2`, `CAT_foir_3`, `CAT_foir_4`, `CAT_foir_5`, `cat_bank_emi`) VALUES
(0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, '0.1');

-- --------------------------------------------------------

--
-- Table structure for table `variable_coefficient`
--

DROP TABLE IF EXISTS `variable_coefficient`;
CREATE TABLE IF NOT EXISTS `variable_coefficient` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `coefficient` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `variable_coefficient`
--

INSERT INTO `variable_coefficient` (`id`, `name`, `coefficient`) VALUES
(1, 'cat_Business_Constitution_1', '5.896'),
(2, 'cat_Business_Constitution_2', '18.330999999997'),
(3, 'cat_Business_Constitution_3', '-12.067'),
(4, 'cat_Business_Constitution_4', '-8.211'),
(5, 'cat_Business_Constitution_5', '-3.94'),
(6, 'cat_gender_1', '-6.504'),
(7, 'cat_gender_2', '3.0719999999998'),
(8, 'cat_gender_3', '3.4409999999958'),
(9, 'cat_no_of_Coapp_1', '-5.504'),
(10, 'cat_no_of_Coapp_2', '3.804'),
(11, 'cat_no_of_Coapp_3', '-2.005'),
(12, 'cat_no_of_Coapp_4', '14.953'),
(13, 'cat_no_of_Coapp_5', '-11.239000000003'),
(14, 'No_of_Dependents_1', '32.591999999993'),
(15, 'No_of_Dependents_2', '5.279'),
(16, 'No_of_Dependents_3', '-7.6660000000003'),
(17, 'No_of_Dependents_4', '-30.196'),
(18, 'cat_industry_type_1', '-9.3339999999999'),
(19, 'cat_industry_type_2', '16.371999999999'),
(20, 'cat_industry_type_3', '2.8710000000003'),
(21, 'cat_industry_type_4', '-3.6909999999998'),
(22, 'cat_industry_type_5', '-6.209'),
(23, 'CAT_loan_tenure_1', '68.372'),
(24, 'CAT_loan_tenure_2', '10.957'),
(25, 'CAT_loan_tenure_3', '-4.6029999999999'),
(26, 'CAT_loan_tenure_4', '-35.548000000004'),
(27, 'CAT_loan_tenure_5', '-39.169'),
(28, 'CAT_YearExp_1', '-0.307'),
(29, 'CAT_YearExp_2', '14.737'),
(30, 'CAT_YearExp_3', '1.38'),
(31, 'CAT_YearExp_4', '-3.6630000000005'),
(32, 'CAT_YearExp_5', '-12.137999999999'),
(33, 'cat_eligibility_1', '27.225'),
(34, 'cat_eligibility_2', '15.918000000001'),
(35, 'cat_eligibility_3', '3.852'),
(36, 'cat_eligibility_4', '-34.158'),
(37, 'cat_eligibility_5', '-12.828'),
(38, 'cat_qualification_1', '-7.0400000000001'),
(39, 'cat_qualification_2', '12.28'),
(40, 'cat_qualification_3', '13.972'),
(41, 'cat_qualification_4', '-3.4579999999999'),
(42, 'cat_qualification_5', '-15.745'),
(43, 'cat_relation_1', '13.361'),
(44, 'cat_relation_2', '-8.035'),
(45, 'cat_relation_3', '1.1549999999986'),
(46, 'cat_relation_4', '-1.59'),
(47, 'cat_relation_5', '-4.882'),
(48, 'cat_channel_1', '13.772'),
(49, 'cat_channel_2', '-10.881'),
(50, 'cat_channel_3', '-1.0900000000019'),
(51, 'cat_channel_4', '0.07499999999991'),
(52, 'cat_channel_5', '-1.867'),
(53, 'cat_exist_customer_1', '28.710999999998'),
(54, 'cat_exist_customer_2', '-28.702000000002'),
(55, 'cat_lpsp_1', '28.418'),
(56, 'cat_lpsp_2', '-13.997'),
(57, 'cat_lpsp_3', '2.1050000000006'),
(58, 'cat_lpsp_4', '-6.859'),
(59, 'cat_lpsp_5', '-9.658'),
(60, 'cat_loan_type_1', '-4.194'),
(61, 'cat_loan_type_2', '14.567'),
(62, 'cat_loan_type_3', '-21.003000000006'),
(63, 'cat_loan_type_4', '12.276'),
(64, 'cat_loan_type_5', '-1.637'),
(65, 'cat_company_1', '1.602'),
(66, 'cat_company_2', '5.183'),
(67, 'cat_company_3', '0.96899999999859'),
(68, 'cat_company_4', '0.185'),
(69, 'cat_company_5', '-7.93'),
(70, 'cat_city_state_1', '56.276999999996'),
(71, 'cat_city_state_2', '12.201'),
(72, 'cat_city_state_3', '8.7390000000009'),
(73, 'cat_city_state_4', '-39.719'),
(74, 'cat_city_state_5', '-37.489'),
(75, 'cat_cibil_1', '41.399'),
(76, 'cat_cibil_2', '5.9390000000001'),
(77, 'cat_cibil_3', '-47.328999999998'),
(78, 'cat_age_1', '-0.077000000001845'),
(79, 'cat_age_2', '5.116'),
(80, 'cat_age_3', '8.6010000000003'),
(81, 'cat_age_4', '2.9030000000005'),
(82, 'cat_age_5', '-16.534'),
(87, 'CAT_foir_1', '-31.238'),
(88, 'CAT_foir_2', '9.205'),
(89, 'CAT_foir_3', '9.1609999999983'),
(90, 'CAT_foir_4', '4.8719999999999'),
(91, 'CAT_foir_5', '-2.5970000000005'),
(93, 'cat_bank_emi', '-27.9379876');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
