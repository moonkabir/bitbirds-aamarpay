-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 07, 2021 at 09:24 AM
-- Server version: 10.2.36-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bitbirdc_resellerclub_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `emailAddr` varchar(255) NOT NULL,
  `address1` varchar(100) CHARACTER SET utf8 NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `telNo` int(15) NOT NULL,
  `zip` int(11) NOT NULL,
  `tran_id` varchar(255) NOT NULL,
  `checksum` varchar(255) NOT NULL,
  `redirecturl` varchar(255) NOT NULL,
  `accountingCurrencyAmount` int(11) NOT NULL,
  `sellingCurrencyAmount` int(11) NOT NULL,
  `description` varchar(250) CHARACTER SET utf32 NOT NULL,
  `debitnoteids` varchar(255) NOT NULL,
  `invoiceids` varchar(255) NOT NULL,
  `transactiontype` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL,
  `userId` varchar(250) NOT NULL,
  `transid` varchar(255) CHARACTER SET utf32 NOT NULL,
  `paymenttypeid` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `name`, `emailAddr`, `address1`, `city`, `state`, `country`, `telNo`, `zip`, `tran_id`, `checksum`, `redirecturl`, `accountingCurrencyAmount`, `sellingCurrencyAmount`, `description`, `debitnoteids`, `invoiceids`, `transactiontype`, `usertype`, `userId`, `transid`, `paymenttypeid`, `created_at`, `updated_at`) VALUES
(1, 'Khondoker Ali Asgor Pavel', 'bitbirdsltd@gmail.com', 'BDBL Bhaban (3rd Floor-West), 12 Kawran Bazar', 'Dhaka', 'Dhaka', 'BD', 1873873008, 1215, '0A10BIMB3L', '15fecfe8616b83e35b2dd15c87b7bb95', 'https://manage.resellerclub.com/servlet/TestCustomPaymentAuthCompletedServlet', 1, 100, 'Test Transaction Payment', '4,5,6', '1,2,3', 'ResellerPayment', 'reseller', '459046', 'Payment-Test-1', '109666', '2021-02-06 10:41:16', '2021-02-06 10:41:16'),
(2, 'Khondoker Ali Asgor Pavel', 'bitbirdsltd@gmail.com', 'BDBL Bhaban (3rd Floor-West), 12 Kawran Bazar', 'Dhaka', 'Dhaka', 'BD', 1873873008, 1215, 'FECAIES1XV', '15fecfe8616b83e35b2dd15c87b7bb95', 'https://manage.resellerclub.com/servlet/TestCustomPaymentAuthCompletedServlet', 1, 100, 'Test Transaction Payment', '4,5,6', '1,2,3', 'ResellerPayment', 'reseller', '459046', 'Payment-Test-1', '109666', '2021-02-06 10:45:01', '2021-02-06 10:45:01');

-- --------------------------------------------------------

--
-- Table structure for table `post_payment`
--

CREATE TABLE `post_payment` (
  `id` int(11) NOT NULL,
  `tran_id` varchar(250) NOT NULL,
  `mer_txnid` varchar(250) NOT NULL,
  `amount` int(11) NOT NULL,
  `cus_name` varchar(250) NOT NULL,
  `cus_email` varchar(250) NOT NULL,
  `cus_add1` varchar(250) NOT NULL,
  `cus_add2` varchar(250) NOT NULL,
  `cus_city` varchar(250) NOT NULL,
  `cus_state` varchar(250) NOT NULL,
  `cus_phone` varchar(250) NOT NULL,
  `description` varchar(250) CHARACTER SET utf16 NOT NULL,
  `pay_status` varchar(250) NOT NULL,
  `status_code` int(11) NOT NULL,
  `cardnumber` varchar(250) NOT NULL,
  `approval_code` int(11) NOT NULL,
  `payment_processor` varchar(250) NOT NULL,
  `bank_trxid` varchar(250) NOT NULL,
  `payment_type` varchar(250) NOT NULL,
  `error_code` varchar(250) NOT NULL,
  `date_processed` varchar(250) NOT NULL,
  `rec_amount` float NOT NULL,
  `processing_charge` float NOT NULL,
  `ip` varchar(250) NOT NULL,
  `verify_status` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

--
-- Dumping data for table `post_payment`
--

INSERT INTO `post_payment` (`id`, `tran_id`, `mer_txnid`, `amount`, `cus_name`, `cus_email`, `cus_add1`, `cus_add2`, `cus_city`, `cus_state`, `cus_phone`, `description`, `pay_status`, `status_code`, `cardnumber`, `approval_code`, `payment_processor`, `bank_trxid`, `payment_type`, `error_code`, `date_processed`, `rec_amount`, `processing_charge`, `ip`, `verify_status`, `created_at`, `updated_at`) VALUES
(1, 'AAM1612608077216330', '0A10BIMB3L', 100, 'Khondoker Ali Asgor Pavel', 'bitbirdsltd@gmail.com', 'BDBL Bhaban (3rd Floor-West), 12 Kawran Bazar', 'https://manage.resellerclub.com/servlet/TestCustomPaymentAuthCompletedServlet', 'Dhaka', 'Payment-Test-1', '1873873008', 'test_description', 'Successful', 2, '01826323538', 6, 'bKash', '6ED4FIJ1G)', 'bKash-bKash', '0000', '2021-02-06 16:41:23', 97.9, 2.1, '103.239.6.90', 'PENDING', '2021-02-06 10:41:25', '2021-02-06 10:41:25'),
(2, 'AAM1612608149216121', '01FUTU748B', 100, 'Khondoker Ali Asgor Pavel', 'bitbirdsltd@gmail.com', 'BDBL Bhaban (3rd Floor-West), 12 Kawran Bazar', 'https://manage.resellerclub.com/servlet/TestCustomPaymentAuthCompletedServlet', 'Dhaka', 'AddFund-Test-1', '1873873008', 'test_description', 'Successful', 2, '01826323538', 6, 'bKash', '6ED4FIJ1G)', 'bKash-bKash', '0000', '2021-02-06 16:42:40', 97.9, 2.1, '103.239.6.90', 'PENDING', '2021-02-06 10:42:42', '2021-02-06 10:42:42'),
(3, 'AAM1612608302216529', 'FECAIES1XV', 100, 'Khondoker Ali Asgor Pavel', 'bitbirdsltd@gmail.com', 'BDBL Bhaban (3rd Floor-West), 12 Kawran Bazar', 'https://manage.resellerclub.com/servlet/TestCustomPaymentAuthCompletedServlet', 'Dhaka', 'Payment-Test-1', '1873873008', 'test_description', 'Successful', 2, '01826323538', 6, 'bKash', '6ED4FIJ1G)', 'bKash-bKash', '0000', '2021-02-06 16:45:13', 97.9, 2.1, '103.239.6.90', 'PENDING', '2021-02-06 10:45:15', '2021-02-06 10:45:15'),
(4, 'AAM1612609182216624', 'MT7H4HW0EI', 100, 'Khondoker Ali Asgor Pavel', 'bitbirdsltd@gmail.com', 'BDBL Bhaban (3rd Floor-West), 12 Kawran Bazar', 'https://manage.resellerclub.com/servlet/TestCustomPaymentAuthCompletedServlet', '1.18', 'Payment-Test-1', '1873873008', 'test_description', 'Successful', 2, '01826323538', 6, 'bKash', '6ED4FIJ1G)', 'bKash-bKash', '0000', '2021-02-06 16:59:50', 97.9, 2.1, '103.239.6.90', 'PENDING', '2021-02-06 10:59:51', '2021-02-06 10:59:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_payment`
--
ALTER TABLE `post_payment`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post_payment`
--
ALTER TABLE `post_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
