-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2019 at 07:26 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `backend_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(10) UNSIGNED NOT NULL,
  `is_consultancy` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8_unicode_ci,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `is_consultancy`, `title`, `slug_url`, `description`, `logo`, `meta_title`, `meta_keyword`, `meta_description`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Consumer', '', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. <br />\r\n<br />\r\nNulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. <br />\r\n<br />\r\nMaecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt.   Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla.   <br />\r\n<br />\r\nVestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc.</p>', '1549978476_consumers.jpeg', 'Consumer', 'Consumer', 'Consumer', 1, '2019-04-27 09:52:37', NULL),
(2, 1, 'Dashboarding & Decision Support', '', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo  ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis  dis parturient montes, nascetur ridiculus mus. Donec quam felis,  ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa  quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate  eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae,  justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.  Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend  tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac,  enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.  Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean  imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper  ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem  quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam  nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec  odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis  faucibus. Nullam quis ante.</p>', 'brand_images_2.png', 'Dashboarding & Decision Support', 'Dashboarding & Decision Support', 'Dashboarding & Decision Support', 1, '2019-04-27 09:52:37', NULL),
(3, 2, 'Ghana Data Hub', '', '<p>Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed  fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed  consequat, leo eget bibendum sodales, augue velit cursus nunc, quis  gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum  purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam  accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla.  Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere  cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet  nec, imperdiet iaculis, ipsum. Sed aliquam ultrices mauris. Integer ante  arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent  adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus.  Vestibulum volutpat pretium libero. Cras id dui.</p>', '1549902429_datahub.jpg', 'Ghana Data Hub', 'Ghana Data Hub', 'Ghana Data Hub', 1, '2019-04-27 09:52:37', NULL),
(4, 1, 'Data Warehouse Optimization', '', '<p>Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed  fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed  consequat, leo eget bibendum sodales, augue velit cursus nunc, quis  gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum  purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam  accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla.  Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere  cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet  nec, imperdiet iaculis, ipsum. Sed aliquam ultrices mauris. Integer ante  arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent  adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus.  Vestibulum volutpat pretium libero. Cras id dui.</p>', 'brand_images_4.png', 'Data Warehouse Optimization', 'Data Warehouse Optimization', 'Data Warehouse Optimization', 1, '2019-04-27 09:52:37', NULL),
(5, 1, 'Business Intelligence & Analytics', '', '<p>Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed  fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed  consequat, leo eget bibendum sodales, augue velit cursus nunc, quis  gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum  purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam  accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla.  Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere  cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet  nec, imperdiet iaculis, ipsum. Sed aliquam ultrices mauris. Integer ante  arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent  adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus.  Vestibulum volutpat pretium libero. Cras id dui.</p>', 'brand_images_5.png', 'Business Intelligence & Analytics', 'Business Intelligence & Analytics', 'Business Intelligence & Analytics', 1, '2019-04-27 09:52:37', NULL),
(6, 2, 'Agriculture', '', '', '1549901937_agri.jpg', 'Agriculture', 'Agriculture', 'Agriculture', 1, '2019-04-27 09:52:37', NULL),
(7, 2, 'Climate', '', '', '1549901913_climate1.png', 'climate', 'climate', 'climate', 1, '2019-04-27 09:52:37', NULL),
(8, 2, 'Manufacturing', '', '<p>Manufacturing</p>', '1549900005_manufacture2.png', 'Manufacturing', 'Manufacturing', 'Manufacturing', 1, '2019-04-27 09:52:37', NULL),
(9, 2, 'Ecosystem', '', '<p>Ecosystem</p>', '1549900093_ecosystem2.jpg', 'Ecosystem', 'Ecosystem', 'Ecosystem', 1, '2019-04-27 09:52:37', NULL),
(10, 2, 'Education', '', '<p>Education</p>', '1549901870_education1.jpg', 'Education', 'Education', 'Education', 1, '2019-04-27 09:52:37', NULL),
(11, 2, 'Energy', '', '<p>Energy</p>', '1549900076_energy2.JPG', 'Energy', 'Energy', 'Energy', 1, '2019-04-27 09:52:37', NULL),
(12, 2, 'Finance', '', '<p>Finance</p>', '1549978507_finance.jpeg', 'Finance', 'Finance', 'Finance', 1, '2019-04-27 09:52:37', NULL),
(13, 2, 'Health', '', '<p>Health</p>', '1549978575_health.jpeg', 'Health', 'Health', 'Health', 1, '2019-04-27 09:52:37', NULL),
(14, 2, 'Local Government', '', '<p>Local Government</p>', '1549979668_local-govt.jpeg', 'Local Government', 'Local Government', 'Local Government', 1, '2019-04-27 09:52:37', NULL),
(15, 2, 'Maritime', '', '<p>Maritime</p>', '1549899981_martime1.jpg', 'Maritime', 'Maritime', 'Maritime', 1, '2019-04-27 09:52:37', NULL),
(16, 2, 'Ocean', '', '<p>Ocean</p>', '1549899962_ocean2.jpeg', 'Ocean', 'Ocean', 'Ocean', 1, '2019-04-27 09:52:37', NULL),
(17, 2, 'Law', '', '<p>Law</p>', '1549979572_localgovt.jpeg', 'LAW', 'Law', 'Law', 1, '2019-04-27 09:52:37', NULL),
(18, 2, 'Science & Research', '', '<p>Science &amp; Research</p>', '1549978730_research.jpeg', 'Science & Research', 'Science & Research', 'Science & Research', 1, '2019-04-27 09:52:37', NULL),
(19, 1, 'Reporting & Data Provisioning', '', '<p>Reporting &amp; Data Provisioning</p>', 'brand_images_31.png', 'Reporting & Data Provisioning', 'Reporting & Data Provisioning', 'Reporting & Data Provisioning', 1, '2019-04-27 09:52:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8_unicode_ci,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `title`, `slug_url`, `description`, `meta_title`, `meta_keyword`, `meta_description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Home', 'home', '<p>Home description goes here</p>', 'Homewdwdw', 'wdwd', 'wdwdw', 1, NULL, '2019-04-30 23:24:56');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dataset`
--

CREATE TABLE `tbl_dataset` (
  `fld_dataset_id` int(11) NOT NULL,
  `fld_category_id` int(11) NOT NULL,
  `fld_dataset_title` varchar(500) NOT NULL,
  `fld_shortdescription` text NOT NULL,
  `fld_dataset_desc` text NOT NULL,
  `fld_dataset_created_date` date NOT NULL,
  `fld_dataset_updated_date` date NOT NULL,
  `fld_dataset_publisher` varchar(500) DEFAULT NULL,
  `fld_dataset_unique_identifier` varchar(500) DEFAULT NULL,
  `fld_dataset_maintainer` varchar(500) DEFAULT NULL,
  `fld_dataset_maintainer_email` varchar(500) DEFAULT NULL,
  `fld_dataset_public_access` varchar(500) DEFAULT NULL,
  `fld_dataset_data_fupdate` varchar(500) DEFAULT NULL,
  `fld_dataset_bureau_code` varchar(500) DEFAULT NULL,
  `fld_dataset_metadata_context` varchar(500) DEFAULT NULL,
  `fld_dataset_schema_version` varchar(500) DEFAULT NULL,
  `fld_dataset_catalog_describedby` varchar(500) DEFAULT NULL,
  `fld_dataset_data_quality` varchar(500) DEFAULT NULL,
  `fld_dataset_data_dictionary` varchar(500) DEFAULT NULL,
  `fld_dataset_harvest_object_id` varchar(500) DEFAULT NULL,
  `fld_dataset_harvest_sId` varchar(500) DEFAULT NULL,
  `fld_dataset_harvest_stitle` varchar(500) DEFAULT NULL,
  `fld_dataset_license` varchar(500) DEFAULT NULL,
  `fld_dataset_metadata_type` varchar(500) DEFAULT NULL,
  `fld_dataset_program_code` varchar(500) DEFAULT NULL,
  `fld_dataset_related_documents` varchar(500) DEFAULT NULL,
  `fld_dataset_source_datajson` varchar(500) DEFAULT NULL,
  `fld_dataset_source_hash` varchar(500) DEFAULT NULL,
  `fld_dataset_source_schema` varchar(500) DEFAULT NULL,
  `fld_dataset_spatial` varchar(500) DEFAULT NULL,
  `fld_dataset_image` varchar(255) DEFAULT NULL,
  `fld_brand_docs` varchar(255) DEFAULT NULL,
  `fld_infographic` varchar(255) DEFAULT NULL,
  `infographic_dataset` varchar(255) DEFAULT NULL,
  `topic` varchar(255) DEFAULT NULL,
  `source_url` varchar(500) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `fld_dataset_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dataset`
--

INSERT INTO `tbl_dataset` (`fld_dataset_id`, `fld_category_id`, `fld_dataset_title`, `fld_shortdescription`, `fld_dataset_desc`, `fld_dataset_created_date`, `fld_dataset_updated_date`, `fld_dataset_publisher`, `fld_dataset_unique_identifier`, `fld_dataset_maintainer`, `fld_dataset_maintainer_email`, `fld_dataset_public_access`, `fld_dataset_data_fupdate`, `fld_dataset_bureau_code`, `fld_dataset_metadata_context`, `fld_dataset_schema_version`, `fld_dataset_catalog_describedby`, `fld_dataset_data_quality`, `fld_dataset_data_dictionary`, `fld_dataset_harvest_object_id`, `fld_dataset_harvest_sId`, `fld_dataset_harvest_stitle`, `fld_dataset_license`, `fld_dataset_metadata_type`, `fld_dataset_program_code`, `fld_dataset_related_documents`, `fld_dataset_source_datajson`, `fld_dataset_source_hash`, `fld_dataset_source_schema`, `fld_dataset_spatial`, `fld_dataset_image`, `fld_brand_docs`, `fld_infographic`, `infographic_dataset`, `topic`, `source_url`, `language`, `fld_dataset_status`) VALUES
(1, 1, 'Fruit and Vegetable Prices updfate', 'How much do fruits and vegetables cost? ERS estimated average prices for 153 commonly consumed fresh and processed fruits and vegetables.', '<p>How much do fruits and vegetables cost? ERS estimated average prices for 153 commonly consumed fresh and processed fruits and vegetables.</p>', '2014-04-01', '2018-02-04', 'Economic Research Service, U.S. Department of Agriculture', 'USDA-ERS-00071', 'Hayden Stewart', 'hstewart@ers.usda.gov', 'public', '', '005:13', 'https://project-open-data.cio.gov/v1.1/schema/data.jsonld', 'https://project-open-data.cio.gov/v1.1/schema', 'https://project-open-data.cio.gov/v1.1/schema/catalog.json', '', 'http://www.ers.usda.gov/data-products/fruit-and-vegetable-prices/documentation.aspx', '1f2fb7b4-5bfc-4dfe-8a1c-07aea3746a70', '50ca39af-9ddb-466d-8cf3-84d67a204346', 'USDA JSON', 'https://creativecommons.org/publicdomain/zero/1.0/', '', '005:041', '', 'True', '09355fcd7326009d823c8b71d451c1fe12dce085', '1.1', '', '6f1e53572859d8df89f385fcaae98f145ac1c827ce6401.pdf', '6f1e53572859d8df89f385fcaae98f145ac1c827d2b8c1.json', '', NULL, NULL, NULL, NULL, 1),
(4, 15, 'Facts and Figures 2015', 'Data about health issues', '', '2018-04-19', '2018-04-19', 'Ministry Of Health Ghana', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'http://www.moh.gov.gh/wp-content/uploads/2017/07/Facts-and-figures-2015.pdf', '', 'http://www.moh.gov.gh/wp-content/uploads/2017/07/Facts-and-figures-2015.pdf', '', '06e60b107f5999d41fab25b39b4749665ad8d8c452a024.pdf', 'b68fb3ab495a1a7454776887de4fea355ad8d9917d7444.pdf', '', NULL, NULL, NULL, NULL, 1),
(5, 15, 'Holistic Assessment of Ghana Health Sector 2015', 'Holistic Assessment of the Health Sector Programme of Work 2015', '', '2018-04-19', '2018-04-19', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'e2f27c81ddff79e6ef5acefed96475c25ae70d56eee4b5.pdf', NULL, '', NULL, NULL, NULL, NULL, 1),
(30, 20, 'International Impact of Automation Feb-2018', 'Pwc Report on the impact of automation', '<p>Artificial intelligence (AI), robotics and other forms of &lsquo;smart automation&rsquo; are advancing at a rapid pace and have the potential to bring great benefits to the economy, by boosting productivity and creating new and better products and services.&nbsp;</p>', '2019-02-21', '2019-02-21', 'PWC', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'd6ca68969d1591bff405803a3d2296d75c6ea9a3eaa5830.pdf', '1b3dac6fa641b0959b2747112913144f5c6ea7750a95a.pdf', '079b982b83c4ae8ad06f61dad5a604925c6f28a60d79c30.png', NULL, 'Will Robots really steal our Jobs', 'https://www.pwc.co.uk/economic-services/assets/international-impact-of-automation-feb-2018.pdf', 'English', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'sunny', 'sunnypatel477@gmail.com', '2019-04-24 18:30:00', '$2y$10$GRs5.1YRNVtAEphU9n0ImuHCwCmrP2JEUfM.kq41mrTTtRkPafwGK', 'GHc8UG3Im0s0dja2D7d9NeIa3jjmOOZjgfda5EBbmGHmf8VAOwrhyIvQv3xM', 1, 1, NULL, '2019-04-26 04:21:03'),
(2, 'sunny', 'sunny@gmail.com', NULL, '$2y$10$TA1NHKpYQqJSxBrs3wf5NeDTFrtGIujW3hk/Sf0bYB8GIBz2kx4Sy', NULL, 1, 1, '2019-04-26 03:47:43', '2019-04-26 07:12:02'),
(3, 'sunny', 'sunnypatel477@gmail.com', NULL, '$2y$10$ZeMOOloBCtXyJFOCa48Y5.u6OKzdaZHcklXc3esWKfGZiWLnmCMiK', NULL, 1, -1, '2019-04-26 03:50:19', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_dataset`
--
ALTER TABLE `tbl_dataset`
  ADD PRIMARY KEY (`fld_dataset_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_dataset`
--
ALTER TABLE `tbl_dataset`
  MODIFY `fld_dataset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
