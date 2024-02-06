-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-02-06 04:47:54
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `floral_shop`
--

-- --------------------------------------------------------

--
-- 資料表結構 `categories`
--

CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `categories`
--

INSERT INTO `categories` (`categories_id`, `name`, `parent`, `description`) VALUES
(1, '鮮花類', 0, '子項目包括：小型盆花、中大型盆花、單枝花束'),
(2, '植栽類', 0, '子項目包括：小型植栽、中大型植栽、多肉植物'),
(3, '園藝花卉資材', 0, '子項目包括：植物盆器、園藝工具、包裝&布置材料'),
(4, '小型盆花', 1, '盆花約莫少於寬20公分x高20cm，以放在桌上的花卉盆栽為主'),
(5, '中大型盆花', 1, '盆花約莫大於寬20公分x高20cm，以放在地上的花卉盆栽為主'),
(6, '單枝花束', 1, '單支花束'),
(7, '小型植栽', 2, '植栽約莫少於寬20公分x高20cm，以放在桌上的植栽盆栽為主'),
(8, '中大型植栽', 2, '植栽約莫大於寬20公分x高20cm，以放在桌上的植栽盆栽為主'),
(9, '多肉植物', 2, '多肉植物'),
(10, '植物盆器', 3, '用於栽種植物的盆器'),
(11, '園藝工具', 3, '栽種植物會用的到園藝工具'),
(12, '包裝&布置材料', 3, '將花卉、植栽送禮時會使用的相關配件、裝飾');

-- --------------------------------------------------------

--
-- 資料表結構 `color_list`
--

CREATE TABLE `color_list` (
  `color_list_id` int(11) NOT NULL,
  `color_name` varchar(255) NOT NULL,
  `color_english` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `color_list`
--

INSERT INTO `color_list` (`color_list_id`, `color_name`, `color_english`) VALUES
(1, '紅色', 'red'),
(2, '橙色', 'orange'),
(3, '黃色', 'yellow'),
(4, '綠色', 'green'),
(5, '藍色', 'blue'),
(6, '紫色', 'purple'),
(7, '粉紅色', 'pink'),
(8, '棕色', 'brown'),
(9, '灰色', 'grey'),
(10, '黑色', 'black'),
(11, '白色', 'white'),
(12, '其他', 'other');

-- --------------------------------------------------------

--
-- 資料表結構 `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `intro` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `min_capacity` int(11) NOT NULL,
  `max_capacity` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `course`
--

INSERT INTO `course` (`course_id`, `store_id`, `category_id`, `name`, `intro`, `location`, `price`, `min_capacity`, `max_capacity`, `created_at`) VALUES
(1, 3, 1, '韓系乾燥花束製作', '歡迎參加我們的韓系乾燥花束製作課程！這堂課將教導您如何選擇適合的花材，以及製作出擁有濃厚韓風風格的精美花束。我們將分享製作過程中的技巧和訣竅，包括花材的層次搭配、包裝技術等，讓您能輕鬆打造出獨一無二的乾燥花藝品。無論您是初學者還是有一定經驗的花藝愛好者，都能在這堂課中獲得滿足感和成就感。透過豐富多彩的花束，帶著層層美好，為生活增添一抹花香。', '新北市板橋區文化路二段50號', 2000, 4, 8, '2024-01-01 03:59:00'),
(2, 1, 1, '花材的選擇和保養', '這堂課將深入探討花材的選擇和保養方法。我們將介紹各種花材的特性，教您如何根據花束主題和場合挑選適合的花材，同時分享保養花材的實用技巧，讓您的花藝作品能保持長久的美麗。歡迎喜愛花卉的您一同參與，提升花材運用的技能，打造出更為迷人的花藝品。透過深入的學習，您將成為花材的鑑賞家，為每一束花都找到最適合的展現方式。', '桃園市中壢區中華路二段150號', 1800, 6, 10, '2024-01-23 02:56:26'),
(3, 5, 2, '室內植物佈置技巧', '在這堂課中，我們將分享室內植物佈置的設計技巧，讓您的家居空間更添綠意。從植物的選擇到擺放的技巧，我們將一一教授，讓您能打造出清新、舒適的室內環境。無論您的住宅大小，都能透過這堂課學到創意無窮的植物佈置方式。透過專業指導，您將掌握室內植物的美學搭配，為居家環境帶來自然和諧之美。', '台中市葉綠區綠意路78號', 1500, 6, 8, '2024-01-22 02:56:43'),
(4, 4, 3, '新年花束「繽紛祝福」', '迎接新年的到來，我們特別舉辦這場充滿節慶氛圍的花束製作課程。課程將以「繽紛祝福」為主題，教導您如何運用多彩的花材，打造一束充滿歡樂和祝福的新年花束。歡迎一家大小一同參與，一起用花朵為新的一年送上美好祝福。透過這堂課，您將親手製作出獨一無二的新年花束，為家人和朋友帶來溫馨和喜悅。', '高雄市歡樂區文藝路168號', 800, 6, 12, '2024-01-21 13:29:38'),
(5, 2, 2, '鹿角蕨上板手作課程', '這堂手作課程將帶您走進植物藝術的奇妙世界，教導您如何在實木板上巧妙地搭配鹿角蕨，創造出具有自然美感的藝術品。我們會提供所需的材料和工具，並指導您製作出獨一無二的鹿角蕨藝術品，讓您感受植物與藝術的完美結合。這堂課不僅讓您學到手作技巧，更能感受到大自然的美好與和諧。', '台北市中正區忠孝東路一段100號', 1800, 5, 10, '2024-01-10 09:47:25'),
(6, 1, 1, '親子花藝工作坊', '歡迎親子一同來參與我們的花藝工作坊！這是一場適合親子共學的課程，我們將提供親子們各種有趣的花材和教材，讓您們一同體驗花藝的樂趣。透過手作，不僅可以增進親子感情，還能一同創造美麗的花藝作品。歡迎父母攜帶孩子一同參與，共度美好時光！', '桃園市中壢區中華路二段150號', 1200, 5, 15, '2024-01-25 08:15:00'),
(7, 3, 1, '團體花藝體驗', '歡迎團體報名體驗我們的花藝課程！這堂課程特別適合團隊合作，一同感受花藝的樂趣。我們提供專業的指導和各種花材，讓您和您的團隊一同創造獨特的花藝作品。歡笑、合作、美麗，一場團體花藝體驗，為您的團隊建立美好的回憶！', '新北市板橋區文化路二段50號', 2500, 8, 20, '2024-01-26 10:30:00'),
(8, 2, 1, '花束賀卡動手做', '歡迎加入我們的花束賀卡製作課程！在這堂課中，您將學習如何巧妙結合花束和賀卡的設計，創造出精緻的花束賀卡。這是一個適合初學者的課程，我們將提供所有必要的材料和教學，讓您能輕鬆完成獨一無二的作品，為您的心意添加花香和美麗。歡迎喜愛手作的您一同參與！', '台北市中正區忠孝東路一段100號', 1000, 4, 12, '2024-01-27 14:45:00'),
(9, 4, 1, '色彩繽紛插花課', '這是一場彩虹般的插花饗宴！我們將提供各種豐富多彩的花材，讓您嘗試不同的色彩組合，創作出屬於自己的繽紛花藝。這堂課程適合喜愛色彩的朋友，無論您是初學者還是有經驗的花藝師，都能在這場插花之旅中找到樂趣！', '高雄市花田區彩虹路88號', 1800, 6, 15, '2024-01-26 01:48:08'),
(10, 5, 1, '花束和花籃的製作', '歡迎加入我們的花束和花籃製作課程！在這堂課中，您將學習如何巧妙組合各種花材，製作出精美的花束和花籃。這是一個適合所有花藝愛好者的課程，我們將分享各種裝飾和包裝技巧，讓您的花束和花籃更顯獨特。歡迎喜愛花藝的您一同參與，讓生活充滿花香和美麗！', '台中市花博區花卉路99號', 2200, 7, 18, '2024-01-26 01:48:27'),
(11, 2, 2, '多肉植物入門指南', '歡迎參加多肉植物入門指南課程！在這堂課中，我們將帶您深入認識多肉植物的世界。學習多肉植物的種類、生長環境和護理技巧，讓您成為多肉植物的愛好者。透過實作，您將親自動手製作獨特的多肉盆栽，成為您家中的小綠植。無論您是初學者還是已經有一些經驗，都能在這裡找到學習和分享的樂趣。讓我們一同迎接多肉植物的美好吧！', '台北市中正區忠孝東路一段100號', 1300, 4, 10, '2024-01-20 11:30:00'),
(12, 3, 2, '園藝新手指南', '歡迎參加園藝新手指南課程！這是一場適合花園新手的實作課程，我們將帶您認識基本的園藝技巧和知識。從選擇植物、播種到護理，您將親自動手參與每一個步驟。透過這堂課，您不僅可以打好園藝的基本功，還能帶著自己親手種植的小植物回家。無論您是花園初學者還是想要學習園藝的愛好者，都歡迎參加！', '新北市板橋區文化路二段50號', 1200, 5, 15, '2024-01-19 10:00:00'),
(13, 4, 3, 'DIY情人節花束', '在這個浪漫的季節，歡迎來參加我們的DIY情人節花束課程！這是一場讓您親手製作愛意十足的花束的課程。我們將提供各種美麗的鮮花和裝飾材料，讓您可以根據自己的喜好搭配出獨一無二的花束。無論是送給摯愛的人還是製作成精美的禮物，都能在這裡找到花藝的樂趣。讓愛在花束中綻放吧！', '台北市花博區綠園路32號', 1600, 5, 12, '2024-01-23 11:00:00'),
(14, 4, 2, '盆栽探索：植物的奇幻之旅', '歡迎參與盆栽探索課程！這是一場充滿奇幻色彩的植物之旅，帶您深入了解植物的神奇世界。透過實作，我們將一起發現每種植物的獨特之處，學習如何搭配不同植物，打造獨一無二的盆栽藝術品。無論您是初學者還是有一些經驗的植物愛好者，都能在這個課程中找到樂趣和啟發。讓我們一同啟程，探索植物的神奇奇妙之處吧！', '台北市植物區花海街45巷7號', 1200, 5, 15, '2024-01-23 10:30:00'),
(15, 5, 2, '手作盆栽樂趣大公開', '歡迎參與我們的手作盆栽樂趣大公開課程！這是一場讓您親自動手打造盆栽的課程，學習製作屬於自己的植物小天地。透過專業指導，您將學到盆栽的基本技巧、植物選擇和護理方法。無論您是初學者還是有一些經驗的植物愛好者，都能在這個課程中找到樂趣。讓我們一同享受植物的奇妙之旅吧！', '台中市葉綠區綠意路78號', 1500, 6, 12, '2024-01-22 09:15:00'),
(16, 1, 2, '打造夢幻花園：設計與呵護', '歡迎參加打造夢幻花園課程！在這堂課中，我們將教您如何設計並呵護您的夢幻花園。從植物的選擇、搭配到園藝技巧，讓您的花園成為一個令人驚嘆的視覺享受。透過實際操作，您將學到如何打造具有獨特風格的花園，使每一個角落都充滿生命力。不論您是花園新手還是有經驗的園藝愛好者，都能在這裡找到啟發和樂趣。讓我們一同開始夢幻花園的冒險吧！', '桃園市中壢區中華路二段150號', 1800, 6, 10, '2024-01-21 14:45:00'),
(17, 3, 3, '秋季花藝：彩葉綻放', '隨著秋天的到來，一同來感受秋季花藝的獨特之美吧！我們將教您如何運用彩葉和秋季花卉，打造出充滿豐富色彩的花藝作品。這是一場充滿溫暖和感恩氛圍的課程，讓您在花束的製作中感受到秋天的浪漫。無論您是花藝愛好者還是初學者，都歡迎參加這個秋季的花藝之旅！', '新北市板橋區文化路二段50號', 1800, 5, 10, '2024-01-19 14:30:00'),
(18, 4, 3, '畢業典禮花束親手做', '畢業季節到了，一同來親手製作屬於畢業典禮的花束吧！我們將提供各種校園風的花材，讓您可以動手製作出精緻的畢業典禮花束。這不僅是一份感動的禮物，更是對畢業生的美好祝福。讓我們一同在花束中訴說對畢業生的祝福和鼓勵，共同度過這個特別的時刻！', '台北市花博區綠園路32號', 1500, 4, 8, '2024-01-18 10:00:00'),
(19, 1, 4, '婚禮花藝設計工作坊', '歡迎參加我們的婚禮花藝設計工作坊！這是一場專為夢想中婚禮的花藝愛好者所設計的課程。我們將教導您如何根據不同婚禮風格選擇花材，設計出獨一無二的花藝裝飾。透過實作，您將學到婚禮花藝的專業技巧，讓每一場婚禮都充滿浪漫和美麗的花卉擺設。讓我們一同為新人的大日子創造出難忘的花藝藝術吧！', '桃園市中壢區中華路二段150號', 2500, 5, 12, '2024-01-18 14:30:00'),
(20, 2, 4, '餐會花藝藝術體驗', '在這個美食與花藝相結合的餐會花藝藝術體驗中，我們將帶您進入花藝的美妙世界。透過花藝的巧手，為餐會營造出浪漫、溫馨的氛圍。我們將提供各種適合擺設在餐桌上的花材，讓您可以根據場合和主題打造獨特的花藝藝術品。讓美食和花卉相輔相成，為您的餐會增添別緻風采！', '台北市中正區忠孝東路一段100號', 1800, 6, 10, '2024-01-17 12:45:00'),
(22, 4, 4, '餐點花藝之美', '在這堂餐點花藝之美課程中，我們將教您如何將花卉融入到美味的餐點中。透過花卉的巧妙搭配，為餐點增添視覺和味覺的享受。我們將提供各種適合擺設在餐桌上的花材，讓您可以動手製作出獨特的餐點花藝藝術品。讓美食和花卉共舞，為您的餐桌帶來獨特的風采！', '台北市植物區花海街45巷7號', 2000, 2, 12, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 資料表結構 `course_category`
--

CREATE TABLE `course_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `course_category`
--

INSERT INTO `course_category` (`category_id`, `category_name`) VALUES
(1, '花藝基礎課程'),
(2, '植栽相關課程'),
(3, '節慶主題課程'),
(4, '進階商業課程');

-- --------------------------------------------------------

--
-- 資料表結構 `course_datetime`
--

CREATE TABLE `course_datetime` (
  `date_id` int(11) NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `course_datetime`
--

INSERT INTO `course_datetime` (`date_id`, `start_datetime`, `end_datetime`) VALUES
(1, '2024-06-05 09:00:00', '2024-06-05 12:00:00'),
(2, '2024-06-12 09:00:00', '2024-06-12 12:00:00'),
(3, '2024-07-06 13:00:00', '2024-07-06 16:00:00'),
(4, '2024-07-13 14:00:00', '2024-07-13 17:00:00'),
(5, '2024-08-10 09:00:00', '2024-08-10 13:00:00'),
(6, '2024-08-02 14:00:00', '2024-08-02 17:00:00'),
(7, '2024-06-28 18:00:00', '2024-06-28 20:00:00'),
(8, '2024-06-15 17:00:00', '2024-06-15 20:00:00'),
(9, '2024-10-12 10:30:00', '2024-10-12 13:30:00'),
(10, '2024-10-20 14:30:00', '2024-10-20 17:30:00'),
(11, '2024-10-25 12:00:00', '2024-10-25 15:00:00'),
(12, '2024-11-02 08:00:00', '2024-11-02 11:00:00'),
(13, '2024-11-10 13:00:00', '2024-11-10 16:00:00'),
(14, '2024-11-15 09:30:00', '2024-11-15 12:30:00'),
(15, '2024-11-22 14:00:00', '2024-11-22 17:00:00'),
(16, '2024-11-30 16:30:00', '2024-11-30 19:30:00'),
(17, '2024-12-05 10:00:00', '2024-12-05 13:00:00'),
(18, '2024-12-12 11:30:00', '2024-12-12 14:30:00'),
(19, '2024-12-20 18:00:00', '2024-12-20 21:00:00'),
(20, '2024-12-25 15:30:00', '2024-12-25 18:30:00'),
(21, '2025-01-02 12:00:00', '2025-01-02 15:00:00'),
(22, '2025-01-10 09:00:00', '2025-01-10 12:00:00'),
(23, '2025-01-15 14:30:00', '2025-01-15 17:30:00'),
(24, '2025-01-22 17:00:00', '2025-01-22 20:00:00'),
(25, '2025-01-30 13:30:00', '2025-01-30 16:30:00'),
(28, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 資料表結構 `course_favorite`
--

CREATE TABLE `course_favorite` (
  `favorite_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `course_favorite`
--

INSERT INTO `course_favorite` (`favorite_id`, `course_id`, `member_id`, `added_at`) VALUES
(1, 1, 1, '2024-01-23 08:00:00'),
(2, 4, 2, '2024-01-23 09:00:00'),
(3, 2, 3, '2024-01-23 10:00:00'),
(4, 2, 4, '2024-01-23 11:00:00'),
(5, 1, 5, '2024-01-23 12:00:00');

-- --------------------------------------------------------

--
-- 資料表結構 `course_image`
--

CREATE TABLE `course_image` (
  `image_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `is_thumbnail` tinyint(1) NOT NULL DEFAULT 0,
  `is_banner` tinyint(1) NOT NULL DEFAULT 0,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `course_image`
--

INSERT INTO `course_image` (`image_id`, `course_id`, `is_thumbnail`, `is_banner`, `image_url`) VALUES
(1, 1, 0, 0, 'public/images/img_course_01.png'),
(2, 1, 1, 0, 'public/images/img_course_02.png'),
(3, 2, 1, 0, 'public/images/img_course_03.png'),
(4, 3, 1, 0, 'public/images/img_course_04.png'),
(5, 4, 1, 0, 'public/images/img_course_05.png'),
(6, 1, 0, 1, 'public/images/img_banner_01.png');

-- --------------------------------------------------------

--
-- 資料表結構 `course_info_date`
--

CREATE TABLE `course_info_date` (
  `course_id` int(11) NOT NULL,
  `date_id` int(11) NOT NULL,
  `period` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `course_info_date`
--

INSERT INTO `course_info_date` (`course_id`, `date_id`, `period`) VALUES
(1, 1, 1),
(6, 1, 1),
(1, 2, 1),
(6, 2, 1),
(1, 3, 2),
(6, 3, 2),
(1, 4, 2),
(6, 4, 2),
(2, 5, NULL),
(7, 5, NULL),
(3, 6, NULL),
(8, 6, NULL),
(4, 7, NULL),
(9, 7, NULL),
(5, 8, NULL),
(10, 8, NULL),
(11, 9, NULL),
(12, 10, NULL),
(13, 11, NULL),
(14, 12, NULL),
(15, 13, NULL),
(16, 14, NULL),
(17, 15, NULL),
(18, 16, NULL),
(19, 17, NULL),
(20, 18, NULL),
(22, 20, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `course_news`
--

CREATE TABLE `course_news` (
  `news_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `news_title` varchar(255) NOT NULL,
  `news_content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `course_news`
--

INSERT INTO `course_news` (`news_id`, `course_id`, `news_title`, `news_content`, `created_at`) VALUES
(1, 1, '新課程上線！', '我們推出了一門全新的課程，專為初學者設計。歡迎大家參加！', '2024-01-12 12:00:03'),
(2, 1, '重要通知：上課地點調整', '由於場地調整，請注意新的上課地點。', '2024-01-13 13:00:06'),
(3, 1, '課程開始倒數！', '課程即將開始，請確保您已經完成準備工作。', '2024-01-22 14:00:09'),
(4, 2, '花藝工作坊推出優惠！', '購買花藝工作坊課程，即可享有特別優惠價格。', '2024-01-18 11:00:03'),
(5, 3, '最後一天報名課程！', '課程即將截止報名，請趕快報名參加。', '2024-01-16 08:25:37');

-- --------------------------------------------------------

--
-- 資料表結構 `course_order`
--

CREATE TABLE `course_order` (
  `order_id` int(11) NOT NULL,
  `order_number` varchar(17) NOT NULL,
  `course_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `order_status` int(1) NOT NULL,
  `reservation_date` datetime NOT NULL,
  `payment_date` datetime DEFAULT NULL,
  `canceled_date` datetime DEFAULT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `payment_method` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `course_order`
--

INSERT INTO `course_order` (`order_id`, `order_number`, `course_id`, `member_id`, `order_status`, `reservation_date`, `payment_date`, `canceled_date`, `coupon_id`, `payment_method`) VALUES
(1, 'C2024011812345678', 2, 1, 3, '2024-01-18 18:28:27', '2024-01-18 19:22:30', NULL, NULL, 1),
(2, 'C2024011886772522', 1, 2, 3, '2024-01-18 12:08:54', '2024-01-18 12:10:58', NULL, 4, 2),
(3, 'C2024011873852459', 1, 3, 3, '2024-01-19 14:25:05', '2024-01-19 14:50:04', NULL, NULL, 3),
(4, 'C2024011874852286', 5, 4, 4, '2024-01-19 17:04:28', NULL, '2024-01-20 00:00:00', 5, NULL),
(5, 'C2024011895867412', 5, 5, 4, '2024-01-17 11:12:42', NULL, '2024-01-18 00:00:00', 6, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `course_qa`
--

CREATE TABLE `course_qa` (
  `qa_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `answer` text DEFAULT NULL,
  `answered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `course_qa`
--

INSERT INTO `course_qa` (`qa_id`, `course_id`, `member_id`, `question`, `created_at`, `answer`, `answered_at`) VALUES
(1, 1, 1, '請問老師這堂課初學者也可以簡單上手嗎?', '2024-01-23 12:12:05', NULL, NULL),
(2, 1, 2, '課程材料包含在費用中嗎？', '2024-01-23 13:13:06', '是的，課程費用已包含所需材料費用。', '2024-01-23 20:15:05'),
(3, 3, 2, '課程結束後是否能取得相關證書？', '2024-01-23 16:21:33', NULL, NULL),
(4, 4, 3, '若我無法參加特定日期的課程，是否可以更改？', '2024-01-22 18:14:25', '是的，您可以提前通知我們進行日期調整。', '2024-01-23 09:05:02'),
(5, 5, 3, '課程取消後是否能獲得全額退款？', '2024-01-21 15:07:05', NULL, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `course_rating`
--

CREATE TABLE `course_rating` (
  `review_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `course_rating`
--

INSERT INTO `course_rating` (`review_id`, `course_id`, `member_id`, `rating`, `comment`, `created_at`) VALUES
(1, 1, 1, 4, '教學非常細心，使得初學者也能夠輕鬆理解和上手。', '2024-01-23 08:00:00'),
(2, 4, 2, 5, '課程內容非常豐富，老師互動良好，絕對值得參加。', '2024-01-23 09:00:01'),
(3, 2, 3, 4, '老師知識深厚，雖然有些地方稍難，但仍然受益匪淺。', '2024-01-23 10:00:02'),
(4, 2, 4, 5, '課程氛圍很好，學到了許多實用的技巧和創意搭配。', '2024-01-23 11:00:03'),
(5, 1, 5, 3, '內容相對較淺，適合想要入門的學員，建議提供更多進階內容。', '2024-01-23 12:00:04');

-- --------------------------------------------------------

--
-- 資料表結構 `custom_orders`
--

CREATE TABLE `custom_orders` (
  `sid` int(11) NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `shipping_id` int(11) DEFAULT NULL,
  `sender_name` varchar(255) DEFAULT NULL,
  `sender_tel` varchar(255) DEFAULT NULL,
  `recipient_name` varchar(255) DEFAULT NULL,
  `recipient_tel` varchar(255) DEFAULT NULL,
  `recipient_address` varchar(255) DEFAULT NULL,
  `payment_method` int(11) DEFAULT NULL,
  `shipping_method` int(11) DEFAULT NULL,
  `shipping_status` int(11) DEFAULT NULL,
  `order_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `custom_orders`
--

INSERT INTO `custom_orders` (`sid`, `order_id`, `order_date`, `delivery_date`, `member_id`, `store_id`, `shipping_id`, `sender_name`, `sender_tel`, `recipient_name`, `recipient_tel`, `recipient_address`, `payment_method`, `shipping_method`, `shipping_status`, `order_status`) VALUES
(48, 'F2024013187029306', '2024-01-31 00:00:00', '2024-02-01', 2, 3, NULL, NULL, NULL, NULL, NULL, '大地', 1, NULL, NULL, NULL),
(49, 'F2024013122505516', '2024-01-02 08:15:45', '2024-01-05', 5, 1, 2, '李小美', '0921123456', '張大雄', '0922333444', '台北市中正區xx路1號', 1, 1, 0, 1),
(50, 'F2024013152108261', '2024-01-08 14:30:22', '2024-01-12', 12, 3, 1, '王大力', '0939876543', '陳小花', '0987654321', '新北市板橋區yy街2號', 2, 1, 0, 2),
(51, 'F2024013193024763', '2024-01-14 09:45:17', '2024-01-20', 8, 5, 2, '林阿杰', '0912345678', '鄭小娟', '0957123456', '高雄市三民區zz路3號', 3, 2, 1, 1),
(52, 'F2024013128799033', '2024-01-20 18:22:55', '2024-01-25', 20, 10, 1, '張小鈴', '0928765432', '劉阿強', '0918234567', '桃園市中壢區xx街4號', 2, 1, 0, 1),
(53, 'F2024013134920882', '2024-01-26 12:48:30', '2024-01-30', 15, 7, 2, '陳大明', '0954321890', '曾小芳', '0923123456', '台中市西屯區yy路5號', 1, 2, 1, 2),
(54, 'F2024013178207313', '2024-02-01 07:05:11', '2024-02-05', 3, 22, 1, '許小青', '0987654321', '張小英', '0932123456', '新竹市東區zz街6號', 3, 1, 0, 1),
(55, 'F2024013196273924', '2024-02-07 15:18:44', '2024-02-12', 18, 15, 2, '黃小明', '0923456789', '吳小美', '0976543210', '嘉義市西區yy路8號', 1, 2, 1, 2),
(56, 'F2024013156747682', '2024-02-13 11:35:29', '2024-02-18', 10, 8, 1, '劉大勇', '0956789012', '林小翠', '0945612345', '南投市南區xx街10號', 2, 1, 0, 1),
(57, 'F2024013174916641', '2024-02-19 14:52:56', '2024-02-23', 23, 13, 2, '吳小華', '0923456123', '張大春', '0909786543', '屏東市東區zz路12號', 3, 2, 1, 1),
(58, 'F2024013114340161', '2024-02-25 10:10:10', '2024-02-28', 6, 18, 1, '陳大志', '0976123456', '林小琪', '0912456789', '基隆市仁愛區xx街15號', 1, 1, 0, 2),
(59, 'F2024013116950888', '2024-03-02 18:24:00', '2024-03-07', 14, 11, 2, '李小芳', '0932567890', '許大德', '0921234876', '苗栗市西區yy路14號', 2, 1, 0, 1),
(60, 'F2024013131733957', '2024-03-08 12:30:45', '2024-03-12', 17, 4, 1, '張大發', '0987654321', '黃小玲', '0945678901', '彰化市北區zz街18號', 3, 2, 1, 2),
(61, 'F2024013197817127', '2024-03-14 09:45:22', '2024-03-19', 9, 21, 2, '許小青', '0912345678', '林大明', '0976123456', '新竹市東區xx街20號', 1, 1, 0, 1),
(62, 'F2024013123883765', '2024-03-20 18:22:30', '2024-03-25', 21, 9, 1, '黃小美', '0923456123', '吳大勇', '0909786543', '嘉義市西區yy路22號', 2, 1, 0, 1),
(63, 'F2024013185967449', '2024-03-26 12:48:17', '2024-03-30', 11, 16, 2, '林小華', '0954321890', '陳大春', '0923123456', '台中市西屯區yy路24號', 3, 2, 1, 2),
(64, 'F2024020174342103', '2024-02-01 00:00:00', '2024-02-12', 33, 2, NULL, NULL, NULL, NULL, NULL, 'dddddjjkjkk', 2, NULL, NULL, NULL),
(65, 'F2024020172162614', '2024-02-01 14:29:00', '2024-02-23', 1, 2, NULL, NULL, NULL, NULL, NULL, 'wwww', 1, NULL, NULL, NULL);

--
-- 觸發器 `custom_orders`
--
DELIMITER $$
CREATE TRIGGER `before_insert_table_custom_orders` BEFORE INSERT ON `custom_orders` FOR EACH ROW BEGIN

    SET NEW.order_id = CONCAT('F',DATE_FORMAT(NOW(), '%Y%m%d'), LPAD(FLOOR(10000000 + RAND() * 90000000), 8, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- 資料表結構 `custom_products`
--

CREATE TABLE `custom_products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_stock` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `custom_products`
--

INSERT INTO `custom_products` (`product_id`, `product_name`, `product_stock`) VALUES
(1, '玫瑰', 1),
(2, '向日葵', 2),
(3, '百合', 2),
(4, '鬱金香', 1),
(5, '康乃馨', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `custom_product_list`
--

CREATE TABLE `custom_product_list` (
  `sid` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `products_url` varchar(255) NOT NULL,
  `product_color` int(11) NOT NULL,
  `product_stock` int(1) NOT NULL,
  `product_price` int(11) NOT NULL,
  `store_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `custom_product_list`
--

INSERT INTO `custom_product_list` (`sid`, `product_id`, `products_url`, `product_color`, `product_stock`, `product_price`, `store_id`) VALUES
(35, '1', 'img/pinkrose.png', 7, 1, 8888, 1),
(55, '2', 'img/sunflower.jpg', 6, 1, 2, 5),
(56, '2', 'img/sunflower.jpg', 5, 2, 1, 5),
(57, '1', 'img/carnation.jpg', 5, 1, 111, 39),
(58, '1', 'img/carnation.jpg', 4, 2, 33, 39),
(64, '1', 'https://images.unsplash.com/photo-1503135935062-b7d1f5a0690f?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 8, 1, 2, 10),
(65, '1', 'https://images.unsplash.com/photo-1503135935062-b7d1f5a0690f?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 3, 2, 3, 10),
(73, '4', 'img/tulip.jpg', 6, 2, 111, 51),
(74, '4', 'img/tulip.jpg', 2, 1, 343, 51),
(75, '4', 'img/tulip.jpg', 7, 2, 4544, 51),
(76, '4', 'img/tulip.jpg', 11, 1, 222, 51),
(77, '4', 'img/tulip.jpg', 6, 1, 222, 51),
(78, '4', 'img/tulip.jpg', 2, 2, 88, 6),
(79, '4', 'img/carnation.jpg', 3, 2, 1, 4),
(80, '4', 'img/tulip.jpg', 4, 1, 22, 6);

-- --------------------------------------------------------

--
-- 資料表結構 `custom_stock_status`
--

CREATE TABLE `custom_stock_status` (
  `stock_id` int(1) NOT NULL,
  `stock_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `custom_stock_status`
--

INSERT INTO `custom_stock_status` (`stock_id`, `stock_name`) VALUES
(1, '上架中'),
(2, '未上架');

-- --------------------------------------------------------

--
-- 資料表結構 `custom_templates`
--

CREATE TABLE `custom_templates` (
  `sid` int(11) NOT NULL,
  `template_id` varchar(255) DEFAULT NULL,
  `template_name` varchar(255) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `occ_id` int(11) DEFAULT NULL,
  `stock_status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `custom_templates`
--

INSERT INTO `custom_templates` (`sid`, `template_id`, `template_name`, `store_id`, `color_id`, `role_id`, `occ_id`, `stock_status`) VALUES
(1, 'T20240131001', '聖誕花環', 20, 8, 7, 8, 1),
(2, 'T20240131002', '畢業花束', 16, 3, 2, 3, 1),
(3, 'T20240131003', '經典花束1', 25, 12, 8, 3, 2),
(4, 'T20240131004', '經典花束2', 4, 8, 7, 8, 2),
(5, 'T20240131005', '情人節玫瑰束', 11, 4, 1, 6, 1),
(6, 'T20240131006', '生日驚喜花束', 8, 3, 4, 1, 2),
(7, 'T20240131007', '慶祝花束', 2, 3, 7, 2, 1),
(8, 'T20240131008', '感謝之花', 12, 11, 2, 8, 2),
(9, 'T20240131009', '婚禮花束', 14, 10, 3, 1, 1),
(10, 'T20240131010', '友情之花', 6, 1, 7, 3, 1);

--
-- 觸發器 `custom_templates`
--
DELIMITER $$
CREATE TRIGGER `before_insert_custom_templates` BEFORE INSERT ON `custom_templates` FOR EACH ROW BEGIN
    DECLARE last_date VARCHAR(8);
    DECLARE last_count INT;

    -- 取得目前最後一筆記錄的日期
    SET last_date = (SELECT SUBSTRING(template_id, 2, 8) FROM custom_templates ORDER BY template_id DESC LIMIT 1);

    -- 判斷日期是否與今天相同，以便遞增編號
    IF last_date IS NULL OR last_date <> DATE_FORMAT(NOW(), '%Y%m%d') THEN
        SET NEW.template_id = CONCAT('T', DATE_FORMAT(NOW(), '%Y%m%d'), '001');
    ELSE
        -- 取得目前最後一筆記錄的編號部分，並轉換為整數
        SET last_count = CAST(SUBSTRING((SELECT template_id FROM custom_templates ORDER BY template_id DESC LIMIT 1), 10) AS SIGNED);

        -- 遞增編號，並填補至三位數
        SET NEW.template_id = CONCAT('T', DATE_FORMAT(NOW(), '%Y%m%d'), LPAD(last_count + 1, 3, '0'));
    END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- 資料表結構 `custom_template_detail`
--

CREATE TABLE `custom_template_detail` (
  `sid` int(11) NOT NULL,
  `template_id` varchar(255) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `position_top` int(11) DEFAULT NULL,
  `position_left` int(11) DEFAULT NULL,
  `z_index` int(11) DEFAULT NULL,
  `rotate` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `custom_template_detail`
--

INSERT INTO `custom_template_detail` (`sid`, `template_id`, `product_id`, `color_id`, `position_top`, `position_left`, `z_index`, `rotate`) VALUES
(1, 'T20240131001', 1, 1, NULL, NULL, NULL, NULL),
(2, 'T20240131001', 1, 2, NULL, NULL, NULL, NULL),
(3, 'T20240131001', 2, 2, NULL, NULL, NULL, NULL),
(4, 'T20240131001', 2, 3, NULL, NULL, NULL, NULL),
(5, 'T20240131002', 3, 3, NULL, NULL, NULL, NULL),
(6, 'T20240131002', 3, 4, NULL, NULL, NULL, NULL),
(7, 'T20240131003', 4, 5, NULL, NULL, NULL, NULL),
(8, 'T20240131003', 4, 4, NULL, NULL, NULL, NULL),
(9, 'T20240131003', 5, 5, NULL, NULL, NULL, NULL),
(10, 'T20240131003', 5, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `intro_flower`
--

CREATE TABLE `intro_flower` (
  `flower_id` int(5) NOT NULL,
  `flower_name` varchar(50) NOT NULL,
  `flower_engname` varchar(50) NOT NULL,
  `flower_lang` varchar(50) NOT NULL,
  `flower_intro` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `intro_flower`
--

INSERT INTO `intro_flower` (`flower_id`, `flower_name`, `flower_engname`, `flower_lang`, `flower_intro`) VALUES
(1, '孤挺花', 'Amaryllis', '決心與創新成就', '花朵如燃燒的火焰，傳達著堅定的意志，象徵著不屈不撓的精神。'),
(2, '銀蓮花', 'Anemone', '期待', '柔美花瓣彷彿舞動的思念，蘊含著對未來的憧憬與無窮的期待。'),
(3, '蘋果花', 'Apple Blossoms', '選擇、知識與啟迪', '如春天的微風中綻放，象徵著智慧與充實的人生選擇。'),
(4, '紫菀', 'Asters', '優雅與耐心', '綻放的花束中散發著優雅，花朵細緻如星辰，教人感受到無盡的耐心。'),
(5, '風鈴草', 'Bellflower', '感激', '柔軟花瓣如舞動長裙，表達對生命的感激，細緻的花朵彷彿悄悄說著謝意。'),
(6, '山茶花', 'Camellia', '命運', '簡約而高雅，花心如命運的轉折，綻放出深沉的美麗，寓意著人生的起承轉合。'),
(7, '鐵線蓮', 'Clematis', '智力與心智之美', '纖細的花瓣交織著智慧之美，彷彿心靈的綻放，充滿思索與深沈。'),
(8, '金雞菊', 'Coreopsis', '永保喜悅', '花朵如陽光灑落，象徵著永恆的喜悅，給人正面積極的力量。'),
(9, '番紅花', 'Crocus', '歡喜', '冬天的盡頭迎來的第一抹顏色，象徵著歡喜和希望，為生命注入新的活力。'),
(10, '水仙花', 'Daffodil', '重生和新開始', '瓶插的黃金花語，寓意著重生和嶄新的開始，為人生注入勇氣與希望。'),
(11, '大理花', 'Dahlia', '自尊', '豐盛的花瓣彷彿展現自尊的風采，散發著自信與堅持。'),
(12, '北美靛藍', 'False Indigo', '沉浸與直覺', '藍色的花朵如同沉浸在深邃的夢境，象徵著靈感的啟發和直覺的力量。'),
(13, '勿忘我', 'Forget-Me-Nots', '永恆的記憶', '小巧的花朵帶有深深的藍色，象徵著永恆不忘的記憶和真摯的感情。'),
(14, '香水草', 'Garden Heliotrope', '奉獻與夢想實現', '花香四溢的香水草代表著對夢想的堅持與奉獻的精神。'),
(15, '非洲菊', 'Gerbera Daisy', '純潔、歡喜和天真', '艷麗的花瓣展現出純潔歡喜的氛圍，彷彿充滿天真的童心。'),
(16, '唐菖蒲', 'Gladiola', '性格的力量和道德正直', '高聳的花穗代表著性格的力量，象徵著道德正直與堅強。'),
(17, '大岩桐', 'Gloxinia', '一見鍾情與驕傲的精神', '華麗的花形展現出一見鍾情的美感，散發著自信與優雅。'),
(18, '朱槿花/扶桑花', 'Hibiscus', '美麗與幸福', '艷紅的花瓣如夏日的陽光，象徵著美麗與幸福的生活。'),
(19, '金銀花/忍冬花', 'Honeysuckle', '家庭幸福和情感奉獻', '芬芳的金銀花散發出家庭的幸福氛圍，象徵著情感的奉獻。'),
(20, '風信子', 'Hyacinth', '遊戲', '多彩的風信子花瓣彷彿是一場春日的遊戲，帶來歡樂與輕松的氛圍。'),
(21, '繡球花', 'Hydrangea', '感激和理解', '繁複的花球如感激之心綻放，象徵著理解和感激的情感。'),
(22, '鳶尾花', 'Iris', '彩虹與訊息', '鳶尾花瓣猶如彩虹，傳達著美好的訊息和祝福。'),
(23, '紫丁香', 'Lilac', '愛的初感動', '芬芳的紫丁香散發著愛的初感動，帶來浪漫的氛圍。'),
(24, '百合花', 'Lily', '威嚴與美德', '高雅的百合花象徵著威嚴和美德，展現出高貴的氛圍。'),
(25, '玉蘭花', 'Magnolia', '高貴和自尊', '華麗的玉蘭花代表著高貴和自尊，散發出迷人的氛圍。'),
(26, '牽牛花', 'Morning Glory', '情感和決心', '早晨綻放的牽牛花象徵著情感和堅定的決心，帶來愉悅的感覺。'),
(27, '旱金蓮', 'Nasturtium', '成功與征服', '火紅色的旱金蓮代表成功與征服，散發著積極的能量。'),
(28, '三色堇', 'Pansy', '甜美的想法', '彩色的三色堇猶如甜美的想法，帶來愉悅和輕鬆的心情。'),
(29, '芍藥', 'Peony', '豐盛和慈悲', '豐盈的芍藥花象徵著豐盛和慈悲，綻放出華麗的氛圍。'),
(30, '天藍繡球', 'Phlox', '和睦與和諧', '多彩的天藍繡球花形成和諧的花球，象徵著和睦與團結。'),
(31, '報春花', 'Primrose', '年輕的愛', '報春花花語表達著年輕的愛，猶如春天的陽光，充滿希望與活力。'),
(32, '玫瑰', 'Rose', '愛情', '玫瑰花是愛情的象徵，花瓣如愛戀的心靈，彰顯濃濃的浪漫氛圍。'),
(33, '藍睡蓮', 'Sacred Lotus', '開悟', '藍睡蓮代表著心靈的開悟，花瓣展開如心靈的智慧與寧靜。'),
(34, '金魚草', 'Snapdragon', '仁慈與善心', '金魚草花語象徵著仁慈和善心，花形狀如金魚，給人溫暖與關懷。'),
(35, '香碗豆', 'Sweet Pea', '極樂', '香碗豆花代表著極樂的情感，芬芳的香氣帶來愉悅的心情。'),
(36, '西洋石竹', 'Sweet William', '英勇，「給我一個微笑」', '西洋石竹花語表達著英勇與微笑的美好，象徵著積極向前的生活態度。'),
(37, '矮龍膽', 'Trumpet Gentian', '力量和療癒', '矮龍膽花代表著力量和療癒，花朵猶如吹響的號角，帶來正面的能量。'),
(38, '晚香玉', 'Tuberose', '危險的愉悅', '晚香玉花語表達危險的愉悅，花香濃郁，散發著神秘的氛圍。'),
(39, '鬱金香', 'Tulip', '友誼與感激', '鬱金香花語象徵著友誼與感激，花型優雅，為特別的人帶來美好祝福。'),
(40, '香鈴草', 'Venice Mallow', '細緻、轉瞬即逝之美', '香鈴草花語表達著細緻而轉瞬即逝的美，彷彿是瞬間的幸福。'),
(41, '紫羅蘭', 'Violet', '信仰和中庸', '紫羅蘭花代表著信仰和中庸，小巧的花朵散發出清新的香氣，寓意著內在的寧靜。');

-- --------------------------------------------------------

--
-- 資料表結構 `intro_flower_color`
--

CREATE TABLE `intro_flower_color` (
  `flower_color_id` int(5) NOT NULL,
  `flower_id` int(5) NOT NULL,
  `color_list_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `intro_flower_color`
--

INSERT INTO `intro_flower_color` (`flower_color_id`, `flower_id`, `color_list_id`) VALUES
(1, 1, 1),
(2, 1, 6),
(3, 1, 11),
(4, 2, 11),
(5, 2, 5),
(6, 2, 1),
(7, 3, 12),
(8, 4, 6),
(9, 5, 11),
(10, 5, 7),
(11, 5, 6),
(12, 6, 1),
(13, 6, 11),
(14, 6, 7),
(15, 7, 11),
(16, 7, 7),
(17, 7, 6),
(18, 8, 3),
(19, 9, 6),
(20, 10, 11),
(21, 10, 3),
(22, 11, 7),
(23, 11, 1),
(24, 11, 3),
(25, 12, 5),
(26, 13, 5),
(27, 14, 6),
(28, 14, 11),
(29, 15, 1),
(30, 15, 7),
(31, 15, 11),
(32, 15, 3),
(33, 16, 11),
(34, 16, 1),
(35, 16, 3),
(36, 16, 6),
(37, 17, 5),
(38, 17, 7),
(39, 17, 1),
(40, 17, 11),
(41, 18, 1),
(42, 19, 12),
(43, 20, 5),
(44, 20, 11),
(45, 20, 3),
(46, 20, 1),
(47, 21, 5),
(48, 21, 7),
(49, 22, 5),
(50, 22, 3),
(51, 22, 1),
(52, 22, 11),
(53, 23, 6),
(54, 24, 11),
(55, 24, 3),
(56, 24, 7),
(57, 25, 11),
(58, 26, 1),
(59, 26, 5),
(60, 26, 11),
(61, 26, 6),
(62, 27, 3),
(63, 27, 2),
(64, 27, 1),
(65, 28, 11),
(66, 28, 3),
(67, 28, 6),
(68, 28, 5),
(69, 29, 3),
(70, 29, 6),
(71, 29, 1),
(72, 29, 7),
(73, 30, 6),
(74, 30, 11),
(75, 30, 7),
(76, 31, 12),
(77, 32, 1),
(78, 32, 7),
(79, 32, 11),
(80, 33, 5),
(81, 34, 7),
(82, 34, 6),
(83, 35, 6),
(84, 36, 1),
(85, 36, 7),
(86, 36, 11),
(87, 37, 5),
(88, 38, 11),
(89, 39, 1),
(90, 39, 3),
(91, 39, 11),
(92, 39, 7),
(93, 40, 11),
(94, 41, 6);

-- --------------------------------------------------------

--
-- 資料表結構 `intro_flower_image`
--

CREATE TABLE `intro_flower_image` (
  `flower_image_id` int(5) NOT NULL,
  `flower_id` int(5) NOT NULL,
  `image_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `intro_flower_image`
--

INSERT INTO `intro_flower_image` (`flower_image_id`, `flower_id`, `image_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 6),
(7, 7, 7),
(8, 8, 8),
(9, 9, 9),
(10, 10, 10),
(11, 11, 11),
(12, 12, 12),
(13, 13, 13),
(14, 14, 14),
(15, 15, 15),
(16, 16, 16),
(17, 17, 17),
(18, 18, 18),
(19, 19, 19),
(20, 20, 20),
(21, 21, 21),
(22, 22, 22),
(23, 23, 23),
(24, 24, 24),
(25, 25, 25),
(26, 26, 26),
(27, 27, 27),
(28, 28, 28),
(29, 29, 29),
(30, 30, 30),
(31, 31, 31),
(32, 32, 32),
(33, 33, 33),
(34, 34, 34),
(35, 35, 35),
(36, 36, 36),
(37, 37, 37),
(38, 38, 38),
(39, 39, 39),
(40, 40, 40),
(41, 41, 41);

-- --------------------------------------------------------

--
-- 資料表結構 `intro_flower_occ`
--

CREATE TABLE `intro_flower_occ` (
  `flower_occ_id` int(5) NOT NULL,
  `flower_id` int(5) NOT NULL,
  `occ_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `intro_flower_occ`
--

INSERT INTO `intro_flower_occ` (`flower_occ_id`, `flower_id`, `occ_id`) VALUES
(1, 1, 2),
(2, 1, 6),
(3, 2, 1),
(4, 2, 5),
(5, 3, 3),
(6, 3, 8),
(7, 4, 1),
(8, 4, 4),
(9, 5, 5),
(10, 6, 2),
(11, 6, 3),
(12, 7, 6),
(13, 7, 7),
(14, 8, 1),
(15, 8, 7),
(16, 9, 3),
(17, 9, 4),
(18, 10, 2),
(19, 10, 3),
(20, 11, 1),
(21, 11, 2),
(22, 12, 3),
(23, 12, 6),
(24, 13, 2),
(25, 13, 8),
(26, 14, 3),
(27, 14, 7),
(28, 15, 1),
(29, 15, 2),
(30, 16, 2),
(31, 16, 1),
(32, 17, 2),
(33, 17, 1),
(34, 18, 2),
(35, 18, 3),
(36, 19, 1),
(37, 19, 3),
(38, 20, 1),
(39, 20, 2),
(40, 21, 1),
(41, 21, 6),
(42, 22, 2),
(43, 22, 7),
(44, 23, 2),
(45, 23, 3),
(46, 24, 1),
(47, 24, 4),
(48, 25, 2),
(49, 25, 1),
(50, 26, 1),
(51, 26, 2),
(52, 27, 6),
(53, 27, 7),
(54, 28, 1),
(55, 28, 6),
(56, 29, 1),
(57, 29, 3),
(58, 30, 6),
(59, 30, 7),
(60, 31, 2),
(61, 31, 3),
(62, 32, 2),
(63, 32, 8),
(64, 33, 7),
(65, 34, 1),
(66, 34, 5),
(67, 35, 2),
(68, 35, 1),
(69, 36, 7),
(70, 37, 7),
(71, 37, 5),
(72, 38, 2),
(73, 39, 2),
(74, 39, 6),
(75, 40, 1),
(76, 40, 6),
(77, 41, 7);

-- --------------------------------------------------------

--
-- 資料表結構 `intro_flower_role`
--

CREATE TABLE `intro_flower_role` (
  `flower_role_id` int(5) NOT NULL,
  `flower_id` int(5) NOT NULL,
  `role_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `intro_flower_role`
--

INSERT INTO `intro_flower_role` (`flower_role_id`, `flower_id`, `role_id`) VALUES
(1, 1, 5),
(2, 1, 6),
(3, 2, 2),
(4, 2, 3),
(5, 3, 9),
(6, 4, 1),
(7, 4, 4),
(8, 5, 3),
(9, 5, 7),
(10, 6, 5),
(11, 6, 9),
(12, 7, 2),
(13, 7, 3),
(14, 8, 8),
(15, 9, 5),
(16, 9, 8),
(17, 10, 5),
(18, 10, 9),
(19, 11, 2),
(20, 11, 5),
(21, 12, 3),
(22, 12, 2),
(23, 13, 5),
(24, 13, 8),
(25, 14, 9),
(26, 14, 2),
(27, 15, 7),
(28, 15, 5),
(29, 16, 5),
(30, 16, 8),
(31, 17, 5),
(32, 17, 2),
(33, 18, 5),
(34, 18, 9),
(35, 19, 8),
(36, 19, 9),
(37, 20, 5),
(38, 20, 2),
(39, 21, 2),
(40, 21, 8),
(41, 22, 2),
(42, 22, 5),
(43, 23, 5),
(44, 23, 9),
(45, 24, 8),
(46, 24, 4),
(47, 25, 5),
(48, 25, 1),
(49, 26, 3),
(50, 26, 5),
(51, 27, 3),
(52, 27, 6),
(53, 28, 3),
(54, 28, 2),
(55, 29, 8),
(56, 29, 9),
(57, 30, 2),
(58, 30, 3),
(59, 31, 5),
(60, 31, 7),
(61, 32, 5),
(62, 32, 9),
(63, 33, 2),
(64, 33, 8),
(65, 34, 2),
(66, 34, 8),
(67, 35, 5),
(68, 35, 2),
(69, 36, 2),
(70, 36, 3),
(71, 37, 2),
(72, 37, 8),
(73, 38, 5),
(74, 38, 9),
(75, 39, 2),
(76, 39, 5),
(77, 40, 2),
(78, 40, 3),
(79, 41, 2),
(80, 41, 8);

-- --------------------------------------------------------

--
-- 資料表結構 `intro_flower_season`
--

CREATE TABLE `intro_flower_season` (
  `flower_season_id` int(5) NOT NULL,
  `flower_id` int(5) NOT NULL,
  `season_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `intro_flower_season`
--

INSERT INTO `intro_flower_season` (`flower_season_id`, `flower_id`, `season_id`) VALUES
(1, 1, 4),
(2, 2, 1),
(3, 3, 1),
(4, 4, 3),
(5, 5, 2),
(6, 6, 4),
(7, 7, 1),
(8, 8, 2),
(9, 9, 1),
(10, 10, 4),
(11, 11, 3),
(12, 12, 1),
(13, 13, 1),
(14, 14, 2),
(15, 15, 2),
(16, 16, 2),
(17, 17, 2),
(18, 18, 2),
(19, 19, 2),
(20, 20, 1),
(21, 21, 2),
(22, 22, 1),
(23, 23, 1),
(24, 24, 2),
(25, 25, 1),
(26, 26, 2),
(27, 27, 2),
(28, 28, 1),
(29, 29, 1),
(30, 30, 2),
(31, 31, 1),
(32, 32, 5),
(33, 33, 2),
(34, 34, 2),
(35, 35, 1),
(36, 36, 1),
(37, 36, 2),
(38, 37, 2),
(39, 38, 2),
(40, 39, 1),
(41, 40, 2),
(42, 41, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `intro_image`
--

CREATE TABLE `intro_image` (
  `image_id` int(5) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `intro_image`
--

INSERT INTO `intro_image` (`image_id`, `image`) VALUES
(1, 'img001.jpg'),
(2, 'img002.jpg'),
(3, 'img003.jpg'),
(4, 'img004.jpg'),
(5, 'img005.jpg'),
(6, 'img006.jpg'),
(7, 'img007.jpg'),
(8, 'img008.jpg'),
(9, 'img009.jpg'),
(10, 'img010.jpg'),
(11, 'img011.jpg'),
(12, 'img012.jpg'),
(13, 'img013.jpg'),
(14, 'img014.jpg'),
(15, 'img015.jpg'),
(16, 'img016.jpg'),
(17, 'img017.jpg'),
(18, 'img018.jpg'),
(19, 'img019.jpg'),
(20, 'img020.jpg'),
(21, 'img021.jpg'),
(22, 'img022.jpg'),
(23, 'img023.jpg'),
(24, 'img024.jpg'),
(25, 'img025.jpg'),
(26, 'img026.jpg'),
(27, 'img027.jpg'),
(28, 'img028.jpg'),
(29, 'img029.jpg'),
(30, 'img030.jpg'),
(31, 'img031.jpg'),
(32, 'img032.jpg'),
(33, 'img033.jpg'),
(34, 'img034.jpg'),
(35, 'img035.jpg'),
(36, 'img036.jpg'),
(37, 'img037.jpg'),
(38, 'img038.jpg'),
(39, 'img039.jpg'),
(40, 'img040.jpg'),
(41, 'img041.jpg');

-- --------------------------------------------------------

--
-- 資料表結構 `intro_occ`
--

CREATE TABLE `intro_occ` (
  `occ_id` int(5) NOT NULL,
  `occ` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `intro_occ`
--

INSERT INTO `intro_occ` (`occ_id`, `occ`) VALUES
(1, '生日慶祝'),
(2, '情人節'),
(3, '新婚喜慶'),
(4, '母親節'),
(5, '慰問安慰'),
(6, '感謝禮物'),
(7, '慶祝祝賀'),
(8, '紀念日');

-- --------------------------------------------------------

--
-- 資料表結構 `intro_role`
--

CREATE TABLE `intro_role` (
  `role_id` int(5) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `intro_role`
--

INSERT INTO `intro_role` (`role_id`, `role`) VALUES
(1, '長輩'),
(2, '朋友'),
(3, '同學'),
(4, '師長'),
(5, '戀人'),
(6, '工作伙伴'),
(7, '新生嬰兒'),
(8, '親人生日'),
(9, '新婚夫婦');

-- --------------------------------------------------------

--
-- 資料表結構 `intro_season`
--

CREATE TABLE `intro_season` (
  `season_id` int(5) NOT NULL,
  `season` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `intro_season`
--

INSERT INTO `intro_season` (`season_id`, `season`) VALUES
(1, '春'),
(2, '夏'),
(3, '秋'),
(4, '冬'),
(5, '其他');

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `join_date` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `city` varchar(20) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`member_id`, `name`, `email`, `join_date`, `password`, `phone`, `city`, `address`, `district`) VALUES
(1, '姚依婷', 'dzhao@gmail.com', '2022-01-12', '$2y$10$d31g58CoXSdQqX51w5VK1OJ4GC4bMWLxoQbQXDTf/m/lYTZWQBy0u', '0903377259', '台南市', '大坪巷3段36號', '安定區'),
(2, '董佩君', 'yangdong@example.org', '2021-11-02', 'm7sFxyFP)7', '0955490246', '苗栗縣', '復興路7號', '三義鄉'),
(3, '時惠婷', 'na66@example.net', '2022-02-19', '*yqCNB4kq8', '0949087338', '台中市', '學府街710號', '梧棲區'),
(4, '顏惠婷', 'guiyingjiang@example.net', '2019-09-23', '@9hkV^tYiH', '0992519408', '彰化縣', '新莊巷947號', '永靖鄉'),
(5, '李惠如', 'shaowei@gmail.com', '2019-08-04', '1tHA4hPjE%', '0968099967', '屏東縣', '古亭路77號', '瑪家鄉'),
(6, '高怡萱', 'zhangjing@example.net', '2022-09-05', 'jOIR+Eqe_4', '0956027392', '高雄市', '自立街2號', '內門區'),
(7, '曹雅慧', 'wei12@gmail.com', '2022-09-03', '!L0DmLEyv!', '0996924145', '屏東縣', '文昌巷7號', '新園鄉'),
(8, '唐郁雯', 'jie02@example.net', '2019-06-29', '@4J*e2ia!6', '0955665056', '台東縣', '光華路66號', '蘭嶼鄉'),
(9, '趙婉婷', 'leikang@example.org', '2021-05-16', '%!Oum1Nk#D', '0923341932', '高雄市', '淡水巷6段73號', '杉林區'),
(10, '梁淑娟', 'xiulanqian@example.org', '2023-12-17', 'ro5tNDxn%!', '0969411791', '嘉義縣', '民權街52號', '中埔鄉'),
(11, '張琬婷', 'lei31@example.net', '2021-03-24', '(7GX)1Hoyf', '0911836915', '苗栗縣', '永和路36號', '大湖鄉'),
(12, '黎俊賢', 'hlu@example.org', '2023-12-08', '$5W(gD0hb9', '0949974630', '高雄市', '延平路1號', '大寮區'),
(13, '李承翰', 'leishao@example.org', '2021-01-31', '*4&rnPpv$Y', '0972783429', '高雄市', '五福路57號', '岡山區'),
(14, '張冠霖', 'oxiao@example.org', '2020-04-25', '&36Ra2_L+*', '0935328623', '新北市', '三民街88號', '貢寮區'),
(15, '李俊宏', 'jinglai@gmail.com', '2020-08-28', 'WTR^DUui!3', '0923902585', '台南市', '太平街567號', '新營區'),
(16, '張筱涵', 'tao62@example.net', '2020-11-23', 'O$6G2&xzJ4', '0995055766', '雲林縣', '永安巷1號', '斗南鎮'),
(17, '吳馨儀', 'yfeng@example.org', '2023-06-01', 'l^62nOnp2n', '0989391452', '新竹縣', '大安路85號', '五峰鄉'),
(18, '夏雅婷', 'wye@gmail.com', '2023-02-23', 'I07Soaq8+f', '0907298314', '台南市', '自立街8號', '南化區'),
(19, '張惠婷', 'yanxiao@example.net', '2022-12-28', '7j7J0r+__Q', '0991421822', '澎湖縣', '福安街492號', '馬公市'),
(20, '唐雅萍', 'guiying51@example.net', '2022-12-18', '+MSzOeZt92', '0928470393', '新竹縣', '永寧街520號', '新埔鎮'),
(21, '張佩君', 'juansong@example.org', '2022-02-19', 'vCk^2TEhx(', '0941866164', '花蓮縣', '中正路6段26號', '吉安鄉'),
(22, '段淑慧', 'oding@gmail.com', '2021-09-09', 'q1ZYcy1k%c', '0992127413', '新北市', '西門街3段13號', '平溪區'),
(23, '倪鈺婷', 'jie69@example.net', '2021-02-15', '$8cVMm(%Pu', '0900424604', '桃園市', '土城街89號', '中壢區'),
(24, '蕭郁婷', 'jun77@example.org', '2020-11-14', 'h5M6*3Csp@', '0946546675', '台北市', '景美街603號', '士林區'),
(25, '胡美琪', 'luna@example.net', '2021-07-05', 'y&iR2(RxJ&', '0974989103', '彰化縣', '大智街7號', '二水鄉'),
(26, '程雅慧', 'xqian@example.org', '2021-03-23', ')3l!IdFwhy', '0904765315', '嘉義市', '石牌巷9號', '西區'),
(27, '蔣美琪', 'shenguiying@example.org', '2023-07-03', ')2iLHwn35)', '0956812725', '苗栗縣', '新莊巷7號', '三義鄉'),
(28, '湯淑華', 'kjia@gmail.com', '2023-12-23', '#$XSiNdzO8', '0928008996', '彰化縣', '新埔路5號', '福興鄉'),
(29, '周思穎', 'taochao@example.net', '2022-10-10', 'Ld_1OnhC2E', '0978042787', '南海島', '忠孝路6段14號', '南沙群島'),
(30, '晉彥廷', 'xiulanlong@gmail.com', '2020-03-10', 'x934ZKvlR@', '0965641620', '台中市', '中山路9段486號', '西屯區'),
(31, '郭佳穎', 'wenjun@gmail.com', '2022-05-31', 'a%9F9AKrZw', '0948085717', '台中市', '廣慈路248號', '大里區'),
(32, '王志豪', 'gqiao@example.org', '2024-01-18', 'M^&0Ev3*HX', '0983531574', '花蓮縣', '國凱八德巷6號', '光復鄉'),
(33, '劉承翰', 'juanzou@gmail.com', '2020-08-05', 'g7pZESi%%V', '0976329312', '南投縣', '育英巷4段8號', '中寮鄉'),
(34, '夏威廷', 'hzeng@example.org', '2022-01-05', '1TP9EBe3(t', '0952581894', '苗栗縣', '新生巷3段16號', '苑裡鎮'),
(35, '蔡志偉', 'jie93@example.org', '2019-11-09', '38hfCl5!_4', '0968982335', '桃園市', '光華街376號', '桃園區'),
(36, '李雅筑', 'yong79@gmail.com', '2022-06-01', '^t@ETUyK7G', '0970625436', '桃園市', '福安路4號', '大溪區'),
(37, '張雅慧', 'yaojie@example.org', '2021-07-17', 'DkK5NojuT)', '0994654601', '台中市', '文昌街75號', '清水區'),
(38, '周家豪', 'jiehe@example.net', '2023-07-22', '$*$4PIu^$5', '0995085377', '高雄市', '動物園路397號', '鼓山區'),
(39, '伍佩君', 'nazhong@example.org', '2021-02-07', '8MeYLc+m_(', '0976702810', '台中市', '中興巷1號', '西區'),
(40, '楊羽', 'kmo@gmail.com', '2022-07-22', 'TW9TLl8p+o', '0901786658', '台南市', '光明巷70號', '六甲區'),
(41, '劉怡安', 'juanxia@gmail.com', '2020-12-04', '_9MPX_lTiP', '0990602222', '彰化縣', '民享巷6號', '北斗鎮'),
(42, '王淑貞', 'linli@example.org', '2023-02-01', 'p$y!9Um&ci', '0955916839', '高雄市', '中華街72號', '鳳山區'),
(43, '楊雅慧', 'leiliang@example.org', '2020-12-28', 'Yu70XAa1q#', '0993062938', '台東縣', '新興巷2號', '綠島鄉'),
(44, '羅依婷', 'cqiao@gmail.com', '2021-05-26', '!H*PdYQj_8', '0940347517', '台南市', '正義巷3號', '東山區'),
(45, '沈冠霖', 'shixiulan@example.net', '2019-11-02', '^8l*SzHoCT', '0992615020', '高雄市', '土城巷4段637號', '大社區'),
(46, '朱威廷', 'daiwei@gmail.com', '2023-02-23', 'Q(F&4H^qqA', '0920303780', '台南市', '淡水路78號', '六甲區'),
(47, '劉淑貞', 'maoming@gmail.com', '2023-09-27', '%*5J0h^3V*', '0907428243', '台南市', '大同路940號', '新化區'),
(48, '楊佩珊', 'gang42@gmail.com', '2023-04-12', 'o@1Xh&e7y2', '0970149002', '南投縣', '中山街2號', '鹿谷鄉'),
(49, '蘆嘉玲', 'liqin@example.org', '2020-11-24', '^3$JKDrN4g', '0918655159', '台南市', '五福巷7段71號', '南化區'),
(50, '陳惠婷', 'tao50@gmail.com', '2020-02-11', '0(2WFSXup&', '0987615832', '苗栗縣', '正義巷895號', '獅潭鄉'),
(51, '吳筱涵', 'taogong@example.org', '2022-07-10', '9mIYURLm@5', '0924236500', '高雄市', '國凱八德路31號', '六龜區'),
(52, '楊雅筑', 'pinghe@example.org', '2020-05-06', '&9f0FcQj7t', '0972680211', '花蓮縣', '延平巷2段71號', '花蓮市'),
(53, '張宜庭', 'liyuan@example.org', '2021-10-01', '6m7xQ60s_i', '0916313039', '彰化縣', '萬隆路3號', '埤頭鄉'),
(54, '仇柏翰', 'zdai@gmail.com', '2020-07-02', 'LpTg5LLr_y', '0914045564', '台南市', '府中街224號', '關廟區'),
(55, '戴俊傑', 'yiping@example.net', '2020-12-29', '18UGl&Ap^Y', '0967651371', '台南市', '福德路5號', '安定區'),
(56, '葉佳穎', 'xiapan@example.net', '2021-06-01', 'd9k(XAWs*D', '0915871719', '高雄市', '長春巷508號', '六龜區'),
(57, '王彥廷', 'yxue@gmail.com', '2023-03-22', '#7!9_PFrrQ', '0996553500', '台南市', '德路688號', '歸仁區'),
(58, '吳怡如', 'dingqiang@example.net', '2022-06-19', ')9T3CeSAD!', '0967910205', '高雄市', '永和巷9號', '岡山區'),
(59, '周雅婷', 'laiping@gmail.com', '2023-06-19', '547P#Q1t#n', '0909823394', '屏東縣', '雙連路7號', '鹽埔鄉'),
(60, '陶冠宇', 'yong09@gmail.com', '2020-06-27', 'S3B4c*kH@&', '0937319762', '苗栗縣', '動物園巷86號', '通霄鎮'),
(61, '王佳玲', 'fmeng@example.org', '2021-07-19', '_aot3HOdH0', '0914401824', '台南市', '中正街6號', '楠西區'),
(62, '蔣雅涵', 'duyang@example.org', '2022-08-11', '70aHF1uu(M', '0913739299', '宜蘭縣', '中山路439號', '羅東鎮'),
(63, '白宗翰', 'yong10@example.org', '2019-03-04', 'e%MQCi((#3', '0937528196', '連江縣', '自立路4段42號', '東引鄉'),
(64, '丁依婷', 'yankong@gmail.com', '2022-10-18', 'kPq0Uj+i*W', '0900121532', '宜蘭縣', '新莊巷975號', '冬山鄉'),
(65, '鄭郁雯', 'cfan@gmail.com', '2022-09-18', 'fv!EGE0O^4', '0913130743', '新北市', '大安路78號', '淡水區'),
(66, '張威廷', 'ping85@example.org', '2020-05-09', 'M41Y*1pu!_', '0900209522', '台中市', '新生巷60號', '后里區'),
(67, '劉雅琪', 'oma@gmail.com', '2020-09-11', '#0HXtugw!8', '0934492361', '台南市', '忠孝巷53號', '楠西區'),
(68, '余雅雯', 'xiuying17@example.net', '2022-12-13', '78!VgxPg!7', '0907175094', '彰化縣', '龍山寺街6號', '埤頭鄉'),
(69, '劉瑋婷', 'jiangjuan@example.org', '2019-10-23', ')4_*CU0xP_', '0940368382', '花蓮縣', '民享巷1段6號', '豐濱鄉'),
(70, '張怡君', 'jun53@example.net', '2019-05-06', 'XN77nnSe*z', '0994981039', '新北市', '新店巷2號', '三芝區'),
(71, '趙羽', 'jiedong@gmail.com', '2023-10-20', 'Ei80I2fM@l', '0907977700', '高雄市', '華興街8號', '岡山區'),
(72, '王靜宜', 'ping04@example.org', '2019-10-11', '$&8XfbC2R@', '0905447644', '台南市', '自立巷23號', '白河區'),
(73, '莊宇軒', 'yanpeng@example.net', '2019-07-02', '#5B3LLUwdq', '0988045524', '嘉義縣', '仁愛街3段63號', '大林鎮'),
(74, '趙羽', 'qiangshi@example.org', '2021-01-21', 'g)6OsgFpCR', '0934985272', '台中市', '景美街705號', '烏日區'),
(75, '王佳玲', 'yangao@example.net', '2022-04-29', '$3QGkyJTH(', '0930470283', '苗栗縣', '東湖巷985號', '獅潭鄉'),
(76, '趙瑋婷', 'tgao@example.org', '2021-05-26', 'yKt7COdt_7', '0928947074', '台中市', '大安路4號', '外埔區'),
(77, '蔔威廷', 'taopan@gmail.com', '2019-02-24', '*Or7L(gz3v', '0933936455', '宜蘭縣', '民富街6號', '三星鄉'),
(78, '王郁婷', 'weifang@example.net', '2019-03-04', 'Ys0uvUxNA#', '0902754735', '桃園市', '育英街76號', '楊梅區'),
(79, '李冠廷', 'liduan@gmail.com', '2023-06-22', '&oMD5*k$c4', '0932440496', '台中市', '民族街9號', '沙鹿區'),
(80, '馮雅涵', 'wwen@example.net', '2020-03-23', 'gS43R$Ie)g', '0917657398', '金門縣', '光明路41號', '烈嶼鄉'),
(81, '邢淑娟', 'minhao@example.net', '2019-10-04', 'P44*4MfNTn', '0945274533', '雲林縣', '自由巷801號', '四湖鄉'),
(82, '衡家瑜', 'chao76@example.org', '2019-12-21', '2A6&Trah!f', '0965155760', '台中市', '民生巷37號', '豐原區'),
(83, '黃淑華', 'li50@gmail.com', '2019-12-19', 'J!6KVKwZmp', '0917145233', '新北市', '關渡巷909號', '板橋區'),
(84, '韓懿', 'jingliang@gmail.com', '2020-07-01', 'tc8JA3dzY^', '0943688943', '屏東縣', '東湖路45號', '瑪家鄉'),
(85, '王羽', 'hzhu@gmail.com', '2022-04-21', '*J1LD&Voa$', '0950908477', '花蓮縣', '民有街9段45號', '光復鄉'),
(86, '任淑玲', 'mindeng@gmail.com', '2023-12-13', 'F(9F9n9pfw', '0920634174', '屏東縣', '民享街945號', '高樹鄉'),
(87, '韓雅琪', 'minlong@gmail.com', '2020-08-29', '$TxApUtLh9', '0975462552', '雲林縣', '中央路326號', '臺西鄉'),
(88, '黃郁雯', 'qfang@example.org', '2020-02-17', '%_e7GaQf83', '0923752553', '彰化縣', '淡水巷11號', '二林鎮'),
(89, '郭雅惠', 'yanjiang@example.net', '2020-10-03', 'Vu50zKt0N&', '0948152938', '台南市', '長安街12號', '關廟區'),
(90, '蒲宇軒', 'gangpeng@example.net', '2021-05-30', 'aUwD7Riiu#', '0934408166', '南海島', '土城巷5段419號', '東沙群島'),
(91, '張嘉玲', 'yeyang@example.net', '2023-08-09', 'i67nIPYo+r', '0933087324', '台北市', '博愛街82號', '信義區'),
(92, '孫思穎', 'chao47@gmail.com', '2022-01-29', ')uu^QVUy9f', '0929257893', '彰化縣', '劍南路22號', '線西鄉'),
(93, '吳建宏', 'wzhong@example.net', '2021-06-04', ')8zB%MkJTf', '0945632190', '南投縣', '東湖街759號', '埔里鎮'),
(94, '鄒嘉玲', 'yang59@example.org', '2022-10-23', '9i!y42AlZ(', '0959347422', '雲林縣', '民富路175號', '北港鎮'),
(95, '練彥廷', 'vlu@example.org', '2023-03-31', '&v%N1iRt*p', '0943415918', '屏東縣', '劍南巷20號', '恆春鎮'),
(96, '楊雅惠', 'huangmin@gmail.com', '2020-08-06', '#6&Nq%gx)L', '0947039325', '台中市', '文化巷8段766號', '大安區'),
(97, '李心怡', 'changyan@example.org', '2020-11-14', '6mQ)neSD$n', '0956867570', '花蓮縣', '光明街157號', '富里鄉'),
(98, '何中山', 'gang42@example.org', '2020-11-11', 'r4u!SACj%(', '0940954113', '新北市', '民治路7段9號', '深坑區'),
(99, '高琬婷', 'maoxiulan@example.org', '2020-08-20', '$0)xo5KtC3', '0992943120', '屏東縣', '芝山巷4號', '長治鄉'),
(100, '葉俊宏', 'cuijie@example.net', '2022-12-02', ')95(UcAf0E', '0921900431', '台中市', '三民巷952號', '霧峰區'),
(101, '李雅涵', 'kangwei@example.net', '2021-07-05', '@mxQv6LuE9', '0993234278', '高雄市', '仁愛街371號', '鳥松區'),
(102, '彭宗翰', 'yan54@gmail.com', '2020-11-07', '!DJ)fFmPG3', '0948652067', '新北市', '五福街7段404號', '石門區'),
(103, '耿怡如', 'myi@example.org', '2020-02-04', '1S7JjGKId^', '0975298966', '高雄市', '奇岩路9段616號', '湖內區'),
(104, '陳佳穎', 'minglei@example.org', '2021-04-02', 'DWe@5QsKq#', '0909320630', '南投縣', '土城路14號', '名間鄉'),
(105, '潘建宏', 'jiajie@example.org', '2023-06-06', '+lLko5X#3v', '0934304860', '新北市', '新興街6段7號', '樹林區'),
(106, '周怡伶', 'liyang@example.net', '2021-10-21', 'K*16d(*s6A', '0981485396', '南海島', '南巷96號', '東沙群島'),
(107, '陳婷婷', 'yongfan@example.org', '2020-04-27', '24TtmN!0!9', '0973381543', '屏東縣', '蘆洲巷90號', '麟洛鄉'),
(108, '張怡婷', 'epeng@gmail.com', '2019-04-04', 'M7*7JjkRrv', '0956500395', '宜蘭縣', '關渡巷957號', '羅東鎮'),
(109, '李淑貞', 'huna@example.org', '2024-01-17', '_boQ1@6U7o', '0973166885', '宜蘭縣', '信義街518號', '大同鄉'),
(110, '董怡安', 'taohuang@example.org', '2023-05-23', 'y3CGDbCN+*', '0966678681', '高雄市', '新埔路4號', '燕巢區'),
(111, '李飛', 'qiang22@gmail.com', '2021-04-29', 'X4ZSRFyg@Y', '0940639861', '新竹市', '光明路65號', '北區'),
(112, '韓佳穎', 'liaogang@gmail.com', '2022-12-10', '01F1V^Xi+t', '0940882181', '新竹縣', '永安巷118號', '峨眉鄉'),
(113, '佘詩涵', 'rjia@gmail.com', '2023-01-12', '%XFk1DskK8', '0923814443', '澎湖縣', '大坪路4段7號', '西嶼鄉'),
(114, '王宜庭', 'junfu@example.org', '2020-08-14', 'I2HNRJ#p$m', '0980241909', '台東縣', '劍潭路6段1號', '大武鄉'),
(115, '曾惠雯', 'fzhao@example.org', '2022-01-06', '#58Vrdl8*7', '0934570939', '台北市', '自立巷60號', '南港區'),
(116, '許威廷', 'dingyong@example.net', '2020-10-15', '@hBfOIx1Z6', '0925026369', '新竹縣', '明德路804號', '湖口鄉'),
(117, '牟佳慧', 'weifan@example.net', '2022-07-23', 'Vo5XKlYnb*', '0928724381', '台北市', '民治路9段7號', '信義區'),
(118, '葉郁雯', 'jun21@gmail.com', '2021-01-02', 'XfhXLR5M^8', '0964929285', '新北市', '頂福州街5段904號', '永和區'),
(119, '蘭靜宜', 'dengxia@example.net', '2023-09-05', 'm4+6K7_t@+', '0948135114', '南投縣', '新生路1段911號', '中寮鄉'),
(120, '甄雅惠', 'gang53@example.net', '2021-08-17', 'S6YQcCEM$p', '0965344780', '苗栗縣', '民族路7號', '銅鑼鄉'),
(121, '孫雅婷', 'pingmeng@example.org', '2021-11-02', '*qo8$0NXx2', '0926324004', '基隆市', '新莊巷1號', '暖暖區'),
(122, '蕭柏翰', 'jun45@example.net', '2019-12-23', '#5vDkImxF+', '0923234942', '苗栗縣', '文化路9號', '竹南鎮'),
(123, '奚雅涵', 'xiakang@gmail.com', '2019-07-21', '4Z7EJgz$(b', '0975135991', '苗栗縣', '自強巷9號', '苗栗市'),
(124, '葛志豪', 'liming@example.org', '2022-03-19', '@M9ENe!&o$', '0931431225', '苗栗縣', '和街街164號', '獅潭鄉'),
(125, '姚飛', 'czeng@gmail.com', '2022-06-06', '@#*1EIv2*!', '0922370394', '南投縣', '德街3段23號', '魚池鄉'),
(126, '段婷婷', 'yang81@example.org', '2019-07-22', 'C8lI_5ve+a', '0958762809', '台中市', '中正路2號', '豐原區'),
(127, '王郁婷', 'ihe@example.net', '2021-12-31', 'K4oj%CHi#a', '0980024350', '台中市', '永和街845號', '大里區'),
(128, '譚家豪', 'pingdai@gmail.com', '2021-02-11', 'nc6Px4eA)(', '0951658426', '台中市', '芝山街32號', '大肚區'),
(129, '曹怡君', 'minmeng@example.net', '2021-01-25', '_jO87Xgn!#', '0996169600', '台中市', '景美巷5段9號', '中區'),
(130, '劉筱涵', 'lujun@example.org', '2019-08-17', '_XrJ27Cpaj', '0988163532', '彰化縣', '北投巷12號', '大村鄉'),
(131, '梁俊賢', 'ijia@example.net', '2022-05-23', 'Z74AaOv7*c', '0921694192', '高雄市', '民權路60號', '美濃區'),
(132, '李怡君', 'lilai@example.net', '2019-12-25', 'O79sGRGy0%', '0961573881', '澎湖縣', '和街街5段991號', '七美鄉'),
(133, '徐宜君', 'jie67@example.org', '2020-05-12', 'U1HNi&Dy%l', '0981305750', '台南市', '長安巷37號', '鹽水區'),
(134, '張美玲', 'ming73@example.net', '2019-06-30', 't4e9Mn4eH^', '0939645201', '台東縣', '四維街3號', '成功鎮'),
(135, '王佳穎', 'lwan@example.net', '2020-06-15', 'y)e21MlH)4', '0949891401', '高雄市', '明德路6段686號', '大樹區'),
(136, '劉靜怡', 'fwan@example.org', '2023-03-20', '+j6PGdn(_F', '0909957614', '連江縣', '永安巷1號', '南竿鄉'),
(137, '劉佳樺', 'chaomo@example.org', '2021-02-16', 'H98EGskxP+', '0913940365', '台北市', '芝山路759號', '信義區'),
(138, '劉志偉', 'pingchen@example.org', '2021-12-27', '_Z8pIs9!Id', '0971660527', '嘉義市', '士林巷72號', '東區'),
(139, '劉婷婷', 'ming79@example.org', '2022-12-10', 'Ig5)VDo7(*', '0945863877', '屏東縣', '文昌街4號', '新園鄉'),
(140, '張飛', 'huwei@example.org', '2023-09-01', 'NQ9PqYzt#b', '0969741248', '新北市', '博愛街4段39號', '五股區'),
(141, '郭彥廷', 'yyu@example.org', '2024-01-02', 'qd^0MHVr!r', '0959430178', '桃園市', '天母路8段189號', '復興區'),
(142, '黃雅萍', 'xiuyingshen@example.net', '2019-04-13', '%F*2J+fB*O', '0901304208', '台南市', '光華街865號', '七股區'),
(143, '王志偉', 'gang63@example.org', '2022-05-04', '^To3PIbg*4', '0996368874', '台東縣', '平和路7號', '海端鄉'),
(144, '鄭飛', 'qiang84@gmail.com', '2019-02-07', '$Db7GwBFsc', '0948090942', '苗栗縣', '淡水巷4號', '三義鄉'),
(145, '謝淑娟', 'dengchao@example.org', '2021-07-01', 'r70mB*5t@8', '0979989462', '台南市', '北投街83號', '麻豆區'),
(146, '蕭志豪', 'leigong@gmail.com', '2022-04-01', '1w8Koksv)B', '0926462860', '新北市', '西門路16號', '泰山區'),
(147, '李詩涵', 'natan@example.org', '2023-10-12', 'z(Gr4xBxq5', '0903625582', '高雄市', '文山巷797號', '林園區'),
(148, '周怡如', 'xiuying95@gmail.com', '2021-05-25', 'k^2wnWkeHX', '0939159733', '台南市', '象山路9號', '後壁區'),
(149, '任雅雯', 'juanxu@gmail.com', '2023-11-08', '_b6uVylG6V', '0946424543', '雲林縣', '德路430號', '土庫鎮'),
(150, '錢靜宜', 'junlong@example.org', '2019-02-15', 'l*2UXahdn0', '0999980480', '南投縣', '水源巷11號', '集集鎮'),
(151, '楊懿', 'jing86@example.org', '2021-04-01', 'jiB3@cJcm@', '0957192244', '雲林縣', '民族巷181號', '二崙鄉'),
(152, '劉佩君', 'yanghou@gmail.com', '2022-03-12', '$@!fXjzzn5', '0902447218', '高雄市', '新埔巷10號', '茂林區'),
(153, '羅馨儀', 'yong06@gmail.com', '2023-07-04', 'E$7(Si*zH^', '0940931309', '雲林縣', '新生路421號', '大埤鄉'),
(154, '王雅慧', 'yong87@example.net', '2022-07-20', '0A!stApi+u', '0919932893', '南投縣', '北投巷54號', '國姓鄉'),
(155, '江思穎', 'kma@gmail.com', '2020-01-04', '#1+7asZreA', '0987426371', '宜蘭縣', '民族巷1號', '蘇澳鎮'),
(156, '賀俊傑', 'yanzhang@example.net', '2022-02-21', 'y#0kCP%dsA', '0914713313', '雲林縣', '淡水街2號', '土庫鎮'),
(157, '董家瑜', 'leitang@example.net', '2022-12-01', 'W3A4ernn+n', '0910726702', '金門縣', '西門街148號', '金寧鄉'),
(158, '高志豪', 'gtian@example.net', '2019-02-25', '^7M1iidvDk', '0934680820', '高雄市', '大同巷2段95號', '那瑪夏'),
(159, '鄭雅惠', 'rguo@example.org', '2022-03-24', '&+q0UmPzTy', '0970760015', '高雄市', '民享巷52號', '永安區'),
(160, '陳志宏', 'xuyan@example.net', '2019-09-05', '$X0Gkz1T+l', '0973240962', '新北市', '育英街770號', '貢寮區'),
(161, '孫依婷', 'xfu@example.net', '2019-05-02', 'J3Z&zRFo_9', '0908353443', '屏東縣', '芝山路402號', '東港鎮'),
(162, '吳惠如', 'ccai@example.org', '2020-02-02', 'wu2aVKVb%e', '0949961665', '桃園市', '淡水路9段279號', '龜山區'),
(163, '杜淑華', 'wlei@example.net', '2022-07-16', 'Ws1N+FUg@%', '0976189801', '台中市', '延平巷9號', '大里區'),
(164, '邵羽', 'junhou@example.org', '2022-07-28', 'o!&3UNn5%j', '0931588895', '台北市', '莒光巷1段19號', '大安區'),
(165, '何筱涵', 'guiying21@example.org', '2021-06-12', ')VXvMfI!4d', '0939247385', '台南市', '五福路6號', '將軍區'),
(166, '王信宏', 'liuyong@gmail.com', '2021-01-26', '#ZIHOc(kF3', '0973549810', '桃園市', '明德路821號', '復興區'),
(167, '伊雅雯', 'min24@gmail.com', '2022-02-15', '(P!AT1w^7y', '0976146288', '台中市', '中華巷873號', '新社區'),
(168, '張俊傑', 'yiming@example.net', '2023-06-29', ')18FTjm4+d', '0992381173', '新北市', '延平街7段8號', '三重區'),
(169, '祖思穎', 'hejing@example.net', '2020-07-07', '#g2IrEw@U0', '0945186108', '宜蘭縣', '中華路25號', '南澳鄉'),
(170, '王琬婷', 'ftan@example.org', '2020-08-10', 'EQjV+3Yck*', '0986538986', '嘉義縣', '昆陽路9號', '新港鄉'),
(171, '盧靜宜', 'shaoli@gmail.com', '2022-11-07', 'zf1D7b#^c%', '0977398221', '新竹縣', '中山街5段839號', '湖口鄉'),
(172, '王雅玲', 'qiangtan@gmail.com', '2020-10-19', '$4XTo@YuG@', '0966671752', '雲林縣', '天母街928號', '元長鄉'),
(173, '馬佳慧', 'fwang@example.net', '2022-10-31', ')lFoHSqRn8', '0939289646', '桃園市', '平和街745號', '八德區'),
(174, '張欣怡', 'wenxiulan@gmail.com', '2022-01-13', 'O#zc0SWfTf', '0931607653', '高雄市', '成功巷9號', '大樹區'),
(175, '周惠雯', 'leigao@gmail.com', '2019-08-29', '($Y7+kyuL3', '0964519853', '彰化縣', '新北投巷2號', '二林鎮'),
(176, '廖雅筑', 'qianggu@example.org', '2021-04-05', '0lLm5qkE(S', '0916474488', '高雄市', '林森巷5號', '小港區'),
(177, '吳琬婷', 'lei45@example.net', '2019-02-12', '6aQ5nQ2Sy)', '0910839257', '新竹縣', '成功路445號', '新豐鄉'),
(178, '葉懿', 'kongtao@example.net', '2022-09-10', ')8I9H7Yh10', '0939608800', '屏東縣', '新莊巷2號', '九如鄉'),
(179, '羅怡萱', 'fangguo@example.net', '2019-10-18', '&#2Y6yxiU5', '0902062346', '桃園市', '復興路2段3號', '蘆竹區'),
(180, '孫承翰', 'ahao@example.net', '2019-08-02', '*7UIpBkpnJ', '0998147869', '花蓮縣', '文山路40號', '花蓮市'),
(181, '李詩涵', 'daichao@gmail.com', '2019-06-01', '%q4S(ZNg6%', '0923115303', '台中市', '新埔路160號', '西屯區'),
(182, '張佩珊', 'fanping@example.net', '2021-09-19', '_gp2XysFaQ', '0976095730', '台東縣', '北投路6段68號', '金峰鄉'),
(183, '王惠婷', 'chao45@gmail.com', '2023-07-11', 'd1dZlzhq#r', '0928652514', '宜蘭縣', '明德巷614號', '五結鄉'),
(184, '姜淑慧', 'hchang@gmail.com', '2021-11-06', '*8sTe4DrPc', '0996163232', '苗栗縣', '永寧街71號', '獅潭鄉'),
(185, '葉志宏', 'fzhou@example.org', '2022-01-05', '(I(9LFkuvH', '0959218374', '連江縣', '正義路8號', '南竿鄉'),
(186, '薛雅玲', 'fang33@gmail.com', '2022-12-02', 'n7zTXuV4@h', '0908668769', '雲林縣', '小碧潭街726號', '臺西鄉'),
(187, '孫雅玲', 'nding@gmail.com', '2021-09-13', ')iU4KU_lvC', '0918931936', '嘉義縣', '雙連街5段2號', '番路鄉'),
(188, '楊惠如', 'weilong@example.org', '2022-06-16', 'f8ryTn0x%C', '0925111124', '台中市', '石牌街2號', '霧峰區'),
(189, '林雅芳', 'na56@gmail.com', '2023-10-18', '!Ix3kExeU3', '0999576337', '彰化縣', '大仁路9段94號', '埤頭鄉'),
(190, '劉哲瑋', 'jie39@example.net', '2021-11-20', 'QS0O*GTr)Z', '0900571935', '高雄市', '新莊街7號', '旗津區'),
(191, '連琬婷', 'xia83@gmail.com', '2023-03-07', 'RI2n$Ht(Z^', '0986818342', '台中市', '國凱八德路6段6號', '北區'),
(192, '吳志豪', 'yong57@example.net', '2019-05-31', 'VL4cH^0me!', '0946101852', '台北市', '廣慈巷630號', '南港區'),
(193, '胡鈺婷', 'lei61@example.org', '2021-11-01', ')083cvBo1p', '0937651654', '新北市', '大仁路4段638號', '烏來區'),
(194, '黃冠宇', 'taoguo@example.net', '2019-02-08', 'vk30Hexj_0', '0939238748', '台中市', '民富巷66號', '南屯區'),
(195, '閻依婷', 'mtao@gmail.com', '2023-05-23', '5)3o&TFsdA', '0974960862', '雲林縣', '太平街3段7號', '斗六市'),
(196, '鄭淑慧', 'xiahe@example.org', '2020-06-05', 'QRe08Ci*H&', '0908852594', '南投縣', '廣慈街87號', '魚池鄉'),
(197, '李依婷', 'liangli@example.net', '2019-03-12', 'N7VlkOiz!t', '0981198894', '台南市', '大安巷60號', '左鎮區'),
(198, '陶雅婷', 'taotao@gmail.com', '2022-05-28', 'NQDZR2sm&_', '0965873565', '新竹市', '關渡街1號', '東區'),
(199, '胡淑貞', 'leijie@example.net', '2020-04-13', '_mXpE(LN3L', '0936976760', '屏東縣', '莒光巷417號', '車城鄉'),
(200, '姚信宏', 'ideng@example.net', '2022-09-25', '$#TmlS8^)0', '0951734946', '台北市', '大仁巷6段32號', '大同區'),
(201, '劉美琪', 'xiama@gmail.com', '2021-05-17', 'P&2Epupg^&', '0969830198', '連江縣', '五福巷6號', '南竿鄉'),
(202, '謝家瑋', 'guiyingfu@gmail.com', '2023-05-22', 's1G9DJ)zh#', '0976027085', '桃園市', '和街巷9段5號', '復興區'),
(203, '徐冠廷', 'jing23@gmail.com', '2019-09-13', '+^bHHJm+06', '0988361012', '台南市', '關渡巷9段24號', '柳營區'),
(204, '吳佳穎', 'chaomo@gmail.com', '2023-09-21', '0E%7OSe$$&', '0955110545', '新竹縣', '太平街37號', '五峰鄉'),
(205, '劉雅萍', 'qiaoping@gmail.com', '2019-02-10', 'g&9C3nzf_0', '0976277070', '新北市', '公園街18號', '新店區'),
(206, '汪怡伶', 'gaofang@gmail.com', '2019-05-01', 'cczP2XDu!J', '0987546232', '台東縣', '大同街58號', '成功鎮'),
(207, '陳慧君', 'mingfu@example.net', '2023-10-28', '0a6KPbSc*B', '0972757581', '嘉義縣', '民治巷85號', '水上鄉'),
(208, '劉雅筑', 'weiwei@example.org', '2022-10-15', '!07HS7b13C', '0991769809', '新竹縣', '古亭路2號', '湖口鄉'),
(209, '劉佳玲', 'tao69@example.net', '2023-04-29', '+mc#XqefV3', '0984682245', '花蓮縣', '民有街7段1號', '富里鄉'),
(210, '李佳慧', 'qiangzhang@gmail.com', '2021-02-06', 'Cl2LcbwME)', '0914510730', '桃園市', '長安街658號', '新屋區'),
(211, '侯惠雯', 'mingzhang@example.org', '2019-08-10', 'C(4$&Ksgl%', '0926504737', '台中市', '新生街7段3號', '太平區'),
(212, '吳沖', 'dfu@example.net', '2020-06-27', 'C8#3cJQt#1', '0918815189', '嘉義縣', '松山街924號', '東石鄉'),
(213, '孫雅筑', 'guiyingxiang@example.org', '2020-09-03', 'sj7Rv8q**r', '0963048967', '新竹縣', '新莊巷6號', '尖石鄉'),
(214, '哈柏翰', 'guiying43@example.org', '2019-06-06', 'p(9D+Udb!3', '0916613905', '苗栗縣', '土城街91號', '通霄鎮'),
(215, '張家豪', 'li02@example.org', '2024-01-13', '$P1EZA$ytv', '0967851178', '新竹縣', '大橋頭巷82號', '五峰鄉'),
(216, '範羽', 'li68@gmail.com', '2019-02-07', 'Ea4gBqmlF&', '0980566748', '新北市', '民族街743號', '貢寮區'),
(217, '劉佳蓉', 'guiyingduan@example.net', '2022-05-26', '(%Hk(oW990', '0934778112', '台中市', '萬隆巷22號', '外埔區'),
(218, '高惠婷', 'dlu@gmail.com', '2019-05-03', '+7&#6lWzJC', '0998892250', '金門縣', '新北投街222號', '金城鎮'),
(219, '胡依婷', 'min26@example.org', '2020-11-16', '!(6tpFItAR', '0981394907', '台北市', '新北投街9段993號', '北投區'),
(220, '翁美玲', 'kcui@example.net', '2022-03-13', ')FBl^DI34q', '0982903333', '南投縣', '中央巷184號', '水里鄉'),
(221, '羅怡萱', 'jingjin@example.org', '2021-09-24', 'e306@FB1&o', '0981343662', '高雄市', '萬隆街5號', '美濃區'),
(222, '劉家豪', 'fangtian@example.net', '2022-08-23', '%r4Geo87RO', '0914806797', '新北市', '龍山寺路6段843號', '瑞芳區'),
(223, '閻飛', 'fqin@example.org', '2021-11-27', '&0&RgIa&(U', '0932959836', '台東縣', '景美巷9號', '卑南鄉'),
(224, '薛庭瑋', 'gujuan@example.org', '2023-09-14', 'Nm8sHegK#a', '0996287174', '台南市', '淡水路2號', '歸仁區'),
(225, '寧家豪', 'longping@gmail.com', '2019-11-18', 'fp8GKtJX6)', '0902717216', '屏東縣', '大安街4號', '東港鎮'),
(226, '華傑克', 'nafan@example.net', '2019-11-26', ')0xQ229sGl', '0988679002', '台中市', '公園巷9段992號', '大雅區'),
(227, '賈詩涵', 'li83@gmail.com', '2023-12-25', 'x4ttIywp)!', '0922113235', '花蓮縣', '中央街8號', '壽豐鄉'),
(228, '劉雅萍', 'ming38@example.net', '2023-08-27', '@(8j2Owcik', '0954601089', '高雄市', '新生街894號', '前金區'),
(229, '蔣中山', 'weiqiao@example.org', '2020-02-28', 'n_6GX&ndn&', '0926743952', '台南市', '雙連巷414號', '西港區'),
(230, '謝雅芳', 'kduan@gmail.com', '2022-11-02', 'Zk4BE4Pby*', '0911504568', '高雄市', '光復街1段2號', '大寮區'),
(231, '徐瑋婷', 'juanwan@example.net', '2020-02-01', 'yfUbUnwd^8', '0978572717', '屏東縣', '劍潭路9號', '高樹鄉'),
(232, '張家瑋', 'gangzhou@example.org', '2022-05-04', '&2E7TToSrp', '0907500671', '台東縣', '雙連路15號', '大武鄉'),
(233, '李惠雯', 'jie51@example.net', '2023-11-17', 'd38lVGb8$j', '0989972459', '新竹縣', '士林街400號', '北埔鄉'),
(234, '李美琪', 'fangcui@example.net', '2019-03-18', 'Nk9l)qHhh#', '0943209758', '台南市', '水源巷18號', '歸仁區'),
(235, '廖淑惠', 'btao@example.org', '2020-07-23', 'sA0VriK9^K', '0982911694', '嘉義縣', '土城街215號', '東石鄉'),
(236, '王婉婷', 'jhan@example.net', '2022-12-15', '#t@#D!h6t7', '0978122478', '宜蘭縣', '東興街256號', '壯圍鄉'),
(237, '白雅芳', 'yanglai@example.net', '2023-10-29', '3TxmBory%5', '0917343111', '屏東縣', '長安路724號', '高樹鄉'),
(238, '李雅雯', 'minglong@example.net', '2019-06-07', 'W+6QP9Smb4', '0975278046', '金門縣', '東興街7段3ˊˊ6號', '烈嶼鄉'),
(239, '張志豪', 'li09@example.net', '2022-11-12', '5zX9mdYy$V', '0950308139', '新北市', '自由街423號', '石門區'),
(240, '劉佳樺', 'zengchao@gmail.com', '2020-02-20', '$U%HNCbGn2', '0937042614', '台南市', '東湖街3段4號', '六甲區'),
(249, '王曉明', 'aaa@qq.com', '0000-00-00', '', '0912345678', '高雄市', '五福路', '東沙群島');

-- --------------------------------------------------------

--
-- 資料表結構 `member_coupon`
--

CREATE TABLE `member_coupon` (
  `coupon_id` int(11) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `expiration_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `member_coupon`
--

INSERT INTO `member_coupon` (`coupon_id`, `coupon_code`, `discount_amount`, `expiration_date`) VALUES
(1, 'COUPON_10', 10.00, 21),
(2, 'COUPON_50', 50.00, 7),
(3, 'COUPON_10', 10.00, 21),
(4, 'COUPON_30', 30.00, 14),
(5, 'COUPON_30', 30.00, 14),
(6, 'COUPON_30', 30.00, 14),
(7, 'COUPON_10', 10.00, 21),
(8, 'COUPON_10', 10.00, 21),
(9, 'COUPON_30', 30.00, 14),
(10, 'COUPON_30', 30.00, 14),
(11, 'COUPON_50', 50.00, 7),
(12, 'COUPON_30', 30.00, 14),
(13, 'COUPON_10', 10.00, 21),
(14, 'COUPON_10', 10.00, 21),
(15, 'COUPON_10', 10.00, 21),
(16, 'COUPON_10', 10.00, 21),
(17, 'COUPON_50', 50.00, 7),
(18, 'COUPON_10', 10.00, 21),
(19, 'COUPON_30', 30.00, 14),
(20, 'COUPON_30', 30.00, 14),
(21, 'COUPON_10', 10.00, 21),
(22, 'COUPON_50', 50.00, 7),
(23, 'COUPON_30', 30.00, 14),
(24, 'COUPON_50', 50.00, 7),
(25, 'COUPON_50', 50.00, 7),
(26, 'COUPON_50', 50.00, 7),
(27, 'COUPON_30', 30.00, 14),
(28, 'COUPON_50', 50.00, 7),
(29, 'COUPON_10', 10.00, 21),
(30, 'COUPON_50', 50.00, 7),
(31, 'COUPON_50', 50.00, 7),
(32, 'COUPON_50', 50.00, 7),
(33, 'COUPON_10', 10.00, 21),
(34, 'COUPON_30', 30.00, 14),
(35, 'COUPON_30', 30.00, 14),
(36, 'COUPON_50', 50.00, 7),
(37, 'COUPON_50', 50.00, 7),
(38, 'COUPON_30', 30.00, 14),
(39, 'COUPON_50', 50.00, 7),
(40, 'COUPON_10', 10.00, 21),
(41, 'COUPON_30', 30.00, 14),
(42, 'COUPON_50', 50.00, 7),
(43, 'COUPON_10', 10.00, 21),
(44, 'COUPON_50', 50.00, 7),
(45, 'COUPON_10', 10.00, 21),
(46, 'COUPON_50', 50.00, 7),
(47, 'COUPON_10', 10.00, 21),
(48, 'COUPON_50', 50.00, 7),
(49, 'COUPON_50', 50.00, 7),
(50, 'COUPON_10', 10.00, 21),
(51, 'COUPON_50', 50.00, 7),
(52, 'COUPON_10', 10.00, 21),
(53, 'COUPON_10', 10.00, 21),
(54, 'COUPON_30', 30.00, 14),
(55, 'COUPON_30', 30.00, 14),
(56, 'COUPON_30', 30.00, 14),
(57, 'COUPON_10', 10.00, 21),
(58, 'COUPON_10', 10.00, 21),
(59, 'COUPON_50', 50.00, 7),
(60, 'COUPON_10', 10.00, 21),
(61, 'COUPON_10', 10.00, 21),
(62, 'COUPON_10', 10.00, 21),
(63, 'COUPON_50', 50.00, 7),
(64, 'COUPON_50', 50.00, 7),
(65, 'COUPON_50', 50.00, 7),
(66, 'COUPON_10', 10.00, 21),
(67, 'COUPON_10', 10.00, 21),
(68, 'COUPON_10', 10.00, 21),
(69, 'COUPON_10', 10.00, 21),
(70, 'COUPON_10', 10.00, 21),
(71, 'COUPON_30', 30.00, 14),
(72, 'COUPON_50', 50.00, 7),
(73, 'COUPON_10', 10.00, 21),
(74, 'COUPON_30', 30.00, 14),
(75, 'COUPON_30', 30.00, 14),
(76, 'COUPON_50', 50.00, 7),
(77, 'COUPON_50', 50.00, 7),
(78, 'COUPON_50', 50.00, 7),
(79, 'COUPON_30', 30.00, 14),
(80, 'COUPON_50', 50.00, 7),
(81, 'COUPON_50', 50.00, 7),
(82, 'COUPON_30', 30.00, 14),
(83, 'COUPON_30', 30.00, 14),
(84, 'COUPON_30', 30.00, 14),
(85, 'COUPON_30', 30.00, 14),
(86, 'COUPON_50', 50.00, 7),
(87, 'COUPON_10', 10.00, 21),
(88, 'COUPON_30', 30.00, 14),
(89, 'COUPON_10', 10.00, 21),
(90, 'COUPON_50', 50.00, 7),
(91, 'COUPON_50', 50.00, 7),
(92, 'COUPON_50', 50.00, 7),
(93, 'COUPON_10', 10.00, 21),
(94, 'COUPON_30', 30.00, 14),
(95, 'COUPON_50', 50.00, 7),
(96, 'COUPON_30', 30.00, 14),
(97, 'COUPON_10', 10.00, 21),
(98, 'COUPON_10', 10.00, 21),
(99, 'COUPON_10', 10.00, 21),
(100, 'COUPON_50', 50.00, 7),
(101, 'COUPON_30', 30.00, 14),
(102, 'COUPON_50', 50.00, 7),
(103, 'COUPON_10', 10.00, 21),
(104, 'COUPON_10', 10.00, 21),
(105, 'COUPON_30', 30.00, 14),
(106, 'COUPON_10', 10.00, 21),
(107, 'COUPON_50', 50.00, 7),
(108, 'COUPON_30', 30.00, 14),
(109, 'COUPON_50', 50.00, 7),
(110, 'COUPON_10', 10.00, 21),
(111, 'COUPON_30', 30.00, 14),
(112, 'COUPON_50', 50.00, 7),
(113, 'COUPON_50', 50.00, 7),
(114, 'COUPON_10', 10.00, 21),
(115, 'COUPON_30', 30.00, 14),
(116, 'COUPON_50', 50.00, 7),
(117, 'COUPON_30', 30.00, 14),
(118, 'COUPON_30', 30.00, 14),
(119, 'COUPON_50', 50.00, 7),
(120, 'COUPON_30', 30.00, 14),
(121, 'COUPON_50', 50.00, 7),
(122, 'COUPON_10', 10.00, 21),
(123, 'COUPON_30', 30.00, 14),
(124, 'COUPON_50', 50.00, 7),
(125, 'COUPON_10', 10.00, 21),
(126, 'COUPON_50', 50.00, 7),
(127, 'COUPON_50', 50.00, 7),
(128, 'COUPON_50', 50.00, 7),
(129, 'COUPON_10', 10.00, 21),
(130, 'COUPON_50', 50.00, 7),
(131, 'COUPON_10', 10.00, 21),
(132, 'COUPON_50', 50.00, 7),
(133, 'COUPON_50', 50.00, 7),
(134, 'COUPON_30', 30.00, 14),
(135, 'COUPON_10', 10.00, 21),
(136, 'COUPON_50', 50.00, 7),
(137, 'COUPON_30', 30.00, 14),
(138, 'COUPON_10', 10.00, 21),
(139, 'COUPON_50', 50.00, 7),
(140, 'COUPON_30', 30.00, 14),
(141, 'COUPON_10', 10.00, 21),
(142, 'COUPON_30', 30.00, 14),
(143, 'COUPON_50', 50.00, 7),
(144, 'COUPON_10', 10.00, 21),
(145, 'COUPON_50', 50.00, 7),
(146, 'COUPON_10', 10.00, 21),
(147, 'COUPON_30', 30.00, 14),
(148, 'COUPON_10', 10.00, 21),
(149, 'COUPON_50', 50.00, 7),
(150, 'COUPON_10', 10.00, 21),
(151, 'COUPON_10', 10.00, 21),
(152, 'COUPON_30', 30.00, 14),
(153, 'COUPON_10', 10.00, 21),
(154, 'COUPON_10', 10.00, 21),
(155, 'COUPON_30', 30.00, 14),
(156, 'COUPON_10', 10.00, 21),
(157, 'COUPON_10', 10.00, 21),
(158, 'COUPON_50', 50.00, 7),
(159, 'COUPON_30', 30.00, 14),
(160, 'COUPON_30', 30.00, 14),
(161, 'COUPON_10', 10.00, 21),
(162, 'COUPON_10', 10.00, 21),
(163, 'COUPON_30', 30.00, 14),
(164, 'COUPON_50', 50.00, 7),
(165, 'COUPON_10', 10.00, 21),
(166, 'COUPON_50', 50.00, 7),
(167, 'COUPON_30', 30.00, 14),
(168, 'COUPON_10', 10.00, 21),
(169, 'COUPON_30', 30.00, 14),
(170, 'COUPON_30', 30.00, 14),
(171, 'COUPON_50', 50.00, 7),
(172, 'COUPON_50', 50.00, 7),
(173, 'COUPON_10', 10.00, 21),
(174, 'COUPON_30', 30.00, 14),
(175, 'COUPON_30', 30.00, 14),
(176, 'COUPON_30', 30.00, 14),
(177, 'COUPON_30', 30.00, 14),
(178, 'COUPON_10', 10.00, 21),
(179, 'COUPON_50', 50.00, 7),
(180, 'COUPON_50', 50.00, 7),
(181, 'COUPON_30', 30.00, 14),
(182, 'COUPON_10', 10.00, 21),
(183, 'COUPON_10', 10.00, 21),
(184, 'COUPON_10', 10.00, 21),
(185, 'COUPON_10', 10.00, 21),
(186, 'COUPON_50', 50.00, 7),
(187, 'COUPON_50', 50.00, 7),
(188, 'COUPON_30', 30.00, 14),
(189, 'COUPON_50', 50.00, 7),
(190, 'COUPON_10', 10.00, 21),
(191, 'COUPON_30', 30.00, 14),
(192, 'COUPON_10', 10.00, 21),
(193, 'COUPON_50', 50.00, 7),
(194, 'COUPON_30', 30.00, 14),
(195, 'COUPON_30', 30.00, 14),
(196, 'COUPON_10', 10.00, 21),
(197, 'COUPON_30', 30.00, 14),
(198, 'COUPON_50', 50.00, 7),
(199, 'COUPON_30', 30.00, 14),
(200, 'COUPON_50', 50.00, 7),
(201, 'COUPON_50', 50.00, 7),
(202, 'COUPON_10', 10.00, 21),
(203, 'COUPON_30', 30.00, 14),
(204, 'COUPON_50', 50.00, 7),
(205, 'COUPON_30', 30.00, 14),
(206, 'COUPON_50', 50.00, 7),
(207, 'COUPON_10', 10.00, 21),
(208, 'COUPON_50', 50.00, 7),
(209, 'COUPON_30', 30.00, 14),
(210, 'COUPON_50', 50.00, 7),
(211, 'COUPON_30', 30.00, 14),
(212, 'COUPON_10', 10.00, 21),
(213, 'COUPON_10', 10.00, 21),
(214, 'COUPON_30', 30.00, 14),
(215, 'COUPON_50', 50.00, 7),
(216, 'COUPON_50', 50.00, 7),
(217, 'COUPON_10', 10.00, 21),
(218, 'COUPON_30', 30.00, 14),
(219, 'COUPON_30', 30.00, 14),
(220, 'COUPON_50', 50.00, 7),
(221, 'COUPON_30', 30.00, 14),
(222, 'COUPON_30', 30.00, 14),
(223, 'COUPON_50', 50.00, 7),
(224, 'COUPON_50', 50.00, 7),
(225, 'COUPON_30', 30.00, 14),
(226, 'COUPON_50', 50.00, 7),
(227, 'COUPON_10', 10.00, 21),
(228, 'COUPON_10', 10.00, 21),
(229, 'COUPON_30', 30.00, 14),
(230, 'COUPON_10', 10.00, 21),
(231, 'COUPON_30', 30.00, 14),
(232, 'COUPON_50', 50.00, 7),
(233, 'COUPON_10', 10.00, 21),
(234, 'COUPON_30', 30.00, 14),
(235, 'COUPON_50', 50.00, 7),
(236, 'COUPON_30', 30.00, 14),
(237, 'COUPON_10', 10.00, 21),
(238, 'COUPON_30', 30.00, 14),
(239, 'COUPON_30', 30.00, 14),
(240, 'COUPON_50', 50.00, 7),
(241, 'COUPON_30', 30.00, 14),
(242, 'COUPON_50', 50.00, 7),
(243, 'COUPON_10', 10.00, 21),
(244, 'COUPON_50', 50.00, 7),
(245, 'COUPON_50', 50.00, 7),
(246, 'COUPON_50', 50.00, 7),
(247, 'COUPON_30', 30.00, 14),
(248, 'COUPON_30', 30.00, 14),
(249, 'COUPON_30', 30.00, 14),
(250, 'COUPON_30', 30.00, 14),
(251, 'COUPON_50', 50.00, 7),
(252, 'COUPON_50', 50.00, 7),
(253, 'COUPON_10', 10.00, 21),
(254, 'COUPON_50', 50.00, 7),
(255, 'COUPON_30', 30.00, 14),
(256, 'COUPON_30', 30.00, 14),
(257, 'COUPON_30', 30.00, 14),
(258, 'COUPON_10', 10.00, 21),
(259, 'COUPON_10', 10.00, 21),
(260, 'COUPON_50', 50.00, 7),
(261, 'COUPON_50', 50.00, 7),
(262, 'COUPON_30', 30.00, 14),
(263, 'COUPON_30', 30.00, 14),
(264, 'COUPON_10', 10.00, 21),
(265, 'COUPON_30', 30.00, 14),
(266, 'COUPON_10', 10.00, 21),
(267, 'COUPON_30', 30.00, 14),
(268, 'COUPON_30', 30.00, 14),
(269, 'COUPON_50', 50.00, 7),
(270, 'COUPON_50', 50.00, 7),
(271, 'COUPON_30', 30.00, 14),
(272, 'COUPON_10', 10.00, 21),
(273, 'COUPON_30', 30.00, 14),
(274, 'COUPON_30', 30.00, 14),
(275, 'COUPON_50', 50.00, 7),
(276, 'COUPON_30', 30.00, 14),
(277, 'COUPON_10', 10.00, 21),
(278, 'COUPON_10', 10.00, 21),
(279, 'COUPON_10', 10.00, 21),
(280, 'COUPON_50', 50.00, 7),
(281, 'COUPON_10', 10.00, 21),
(282, 'COUPON_50', 50.00, 7),
(283, 'COUPON_50', 50.00, 7),
(284, 'COUPON_10', 10.00, 21),
(285, 'COUPON_30', 30.00, 14),
(286, 'COUPON_50', 50.00, 7),
(287, 'COUPON_10', 10.00, 21),
(288, 'COUPON_50', 50.00, 7),
(289, 'COUPON_30', 30.00, 14),
(290, 'COUPON_10', 10.00, 21),
(291, 'COUPON_30', 30.00, 14),
(292, 'COUPON_50', 50.00, 7),
(293, 'COUPON_30', 30.00, 14),
(294, 'COUPON_10', 10.00, 21),
(295, 'COUPON_10', 10.00, 21),
(296, 'COUPON_50', 50.00, 7),
(297, 'COUPON_30', 30.00, 14),
(298, 'COUPON_30', 30.00, 14),
(299, 'COUPON_50', 50.00, 7),
(300, 'COUPON_50', 50.00, 7),
(301, 'COUPON_10', 10.00, 21),
(302, 'COUPON_10', 10.00, 21),
(303, 'COUPON_30', 30.00, 14),
(304, 'COUPON_30', 30.00, 14),
(305, 'COUPON_30', 30.00, 14),
(306, 'COUPON_30', 30.00, 14),
(307, 'COUPON_30', 30.00, 14),
(308, 'COUPON_50', 50.00, 7),
(309, 'COUPON_30', 30.00, 14),
(310, 'COUPON_30', 30.00, 14),
(311, 'COUPON_50', 50.00, 7),
(312, 'COUPON_50', 50.00, 7),
(313, 'COUPON_50', 50.00, 7),
(314, 'COUPON_30', 30.00, 14),
(315, 'COUPON_10', 10.00, 21),
(316, 'COUPON_30', 30.00, 14),
(317, 'COUPON_10', 10.00, 21),
(318, 'COUPON_10', 10.00, 21),
(319, 'COUPON_50', 50.00, 7),
(320, 'COUPON_50', 50.00, 7),
(321, 'COUPON_50', 50.00, 7),
(322, 'COUPON_30', 30.00, 14),
(323, 'COUPON_30', 30.00, 14),
(324, 'COUPON_10', 10.00, 21),
(325, 'COUPON_10', 10.00, 21),
(326, 'COUPON_30', 30.00, 14),
(327, 'COUPON_10', 10.00, 21),
(328, 'COUPON_50', 50.00, 7),
(329, 'COUPON_10', 10.00, 21),
(330, 'COUPON_30', 30.00, 14),
(331, 'COUPON_50', 50.00, 7),
(332, 'COUPON_10', 10.00, 21),
(333, 'COUPON_50', 50.00, 7),
(334, 'COUPON_10', 10.00, 21),
(335, 'COUPON_50', 50.00, 7),
(336, 'COUPON_30', 30.00, 14),
(337, 'COUPON_30', 30.00, 14),
(338, 'COUPON_10', 10.00, 21),
(339, 'COUPON_30', 30.00, 14),
(340, 'COUPON_50', 50.00, 7),
(341, 'COUPON_30', 30.00, 14),
(342, 'COUPON_30', 30.00, 14),
(343, 'COUPON_10', 10.00, 21),
(344, 'COUPON_30', 30.00, 14),
(345, 'COUPON_30', 30.00, 14),
(346, 'COUPON_30', 30.00, 14),
(347, 'COUPON_10', 10.00, 21),
(348, 'COUPON_30', 30.00, 14),
(349, 'COUPON_10', 10.00, 21),
(350, 'COUPON_50', 50.00, 7),
(351, 'COUPON_10', 10.00, 21),
(352, 'COUPON_10', 10.00, 21),
(353, 'COUPON_10', 10.00, 21),
(354, 'COUPON_50', 50.00, 7),
(355, 'COUPON_30', 30.00, 14),
(356, 'COUPON_50', 50.00, 7),
(357, 'COUPON_50', 50.00, 7),
(358, 'COUPON_50', 50.00, 7),
(359, 'COUPON_50', 50.00, 7),
(360, 'COUPON_30', 30.00, 14),
(361, 'COUPON_50', 50.00, 7),
(362, 'COUPON_30', 30.00, 14),
(363, 'COUPON_50', 50.00, 7),
(364, 'COUPON_10', 10.00, 21),
(365, 'COUPON_10', 10.00, 21),
(366, 'COUPON_50', 50.00, 7),
(367, 'COUPON_50', 50.00, 7),
(368, 'COUPON_10', 10.00, 21),
(369, 'COUPON_30', 30.00, 14),
(370, 'COUPON_50', 50.00, 7),
(371, 'COUPON_30', 30.00, 14),
(372, 'COUPON_10', 10.00, 21),
(373, 'COUPON_30', 30.00, 14),
(374, 'COUPON_10', 10.00, 21),
(375, 'COUPON_50', 50.00, 7),
(376, 'COUPON_10', 10.00, 21),
(377, 'COUPON_50', 50.00, 7),
(378, 'COUPON_50', 50.00, 7),
(379, 'COUPON_30', 30.00, 14),
(380, 'COUPON_30', 30.00, 14),
(381, 'COUPON_50', 50.00, 7),
(382, 'COUPON_30', 30.00, 14),
(383, 'COUPON_10', 10.00, 21),
(384, 'COUPON_30', 30.00, 14),
(385, 'COUPON_50', 50.00, 7),
(386, 'COUPON_30', 30.00, 14),
(387, 'COUPON_50', 50.00, 7),
(388, 'COUPON_50', 50.00, 7),
(389, 'COUPON_30', 30.00, 14),
(390, 'COUPON_50', 50.00, 7),
(391, 'COUPON_30', 30.00, 14),
(392, 'COUPON_50', 50.00, 7),
(393, 'COUPON_10', 10.00, 21),
(394, 'COUPON_50', 50.00, 7),
(395, 'COUPON_10', 10.00, 21),
(396, 'COUPON_30', 30.00, 14),
(397, 'COUPON_30', 30.00, 14),
(398, 'COUPON_10', 10.00, 21),
(399, 'COUPON_30', 30.00, 14),
(400, 'COUPON_10', 10.00, 21),
(401, 'COUPON_30', 30.00, 14),
(402, 'COUPON_10', 10.00, 21),
(403, 'COUPON_30', 30.00, 14),
(404, 'COUPON_50', 50.00, 7),
(405, 'COUPON_50', 50.00, 7),
(406, 'COUPON_50', 50.00, 7),
(407, 'COUPON_10', 10.00, 21),
(408, 'COUPON_50', 50.00, 7),
(409, 'COUPON_10', 10.00, 21),
(410, 'COUPON_50', 50.00, 7),
(411, 'COUPON_50', 50.00, 7),
(412, 'COUPON_50', 50.00, 7),
(413, 'COUPON_50', 50.00, 7),
(414, 'COUPON_10', 10.00, 21),
(415, 'COUPON_50', 50.00, 7),
(416, 'COUPON_50', 50.00, 7),
(417, 'COUPON_10', 10.00, 21),
(418, 'COUPON_50', 50.00, 7),
(419, 'COUPON_50', 50.00, 7),
(420, 'COUPON_50', 50.00, 7),
(421, 'COUPON_10', 10.00, 21),
(422, 'COUPON_30', 30.00, 14),
(423, 'COUPON_10', 10.00, 21),
(424, 'COUPON_30', 30.00, 14),
(425, 'COUPON_10', 10.00, 21),
(426, 'COUPON_30', 30.00, 14),
(427, 'COUPON_50', 50.00, 7),
(428, 'COUPON_10', 10.00, 21),
(429, 'COUPON_50', 50.00, 7),
(430, 'COUPON_30', 30.00, 14),
(431, 'COUPON_30', 30.00, 14),
(432, 'COUPON_50', 50.00, 7),
(433, 'COUPON_30', 30.00, 14),
(434, 'COUPON_50', 50.00, 7),
(435, 'COUPON_50', 50.00, 7),
(436, 'COUPON_10', 10.00, 21),
(437, 'COUPON_30', 30.00, 14),
(438, 'COUPON_30', 30.00, 14),
(439, 'COUPON_30', 30.00, 14),
(440, 'COUPON_30', 30.00, 14),
(441, 'COUPON_50', 50.00, 7),
(442, 'COUPON_10', 10.00, 21),
(443, 'COUPON_30', 30.00, 14),
(444, 'COUPON_10', 10.00, 21),
(445, 'COUPON_50', 50.00, 7),
(446, 'COUPON_30', 30.00, 14),
(447, 'COUPON_30', 30.00, 14),
(448, 'COUPON_50', 50.00, 7),
(449, 'COUPON_10', 10.00, 21),
(450, 'COUPON_50', 50.00, 7),
(451, 'COUPON_10', 10.00, 21),
(452, 'COUPON_30', 30.00, 14),
(453, 'COUPON_10', 10.00, 21),
(454, 'COUPON_30', 30.00, 14),
(455, 'COUPON_50', 50.00, 7),
(456, 'COUPON_30', 30.00, 14),
(457, 'COUPON_10', 10.00, 21),
(458, 'COUPON_30', 30.00, 14),
(459, 'COUPON_50', 50.00, 7),
(460, 'COUPON_50', 50.00, 7),
(461, 'COUPON_50', 50.00, 7),
(462, 'COUPON_10', 10.00, 21),
(463, 'COUPON_50', 50.00, 7),
(464, 'COUPON_50', 50.00, 7),
(465, 'COUPON_30', 30.00, 14),
(466, 'COUPON_30', 30.00, 14),
(467, 'COUPON_30', 30.00, 14),
(468, 'COUPON_30', 30.00, 14),
(469, 'COUPON_50', 50.00, 7),
(470, 'COUPON_30', 30.00, 14),
(471, 'COUPON_10', 10.00, 21),
(472, 'COUPON_30', 30.00, 14),
(473, 'COUPON_10', 10.00, 21),
(474, 'COUPON_10', 10.00, 21),
(475, 'COUPON_50', 50.00, 7),
(476, 'COUPON_10', 10.00, 21),
(477, 'COUPON_50', 50.00, 7),
(478, 'COUPON_10', 10.00, 21),
(479, 'COUPON_30', 30.00, 14),
(480, 'COUPON_30', 30.00, 14),
(481, 'COUPON_30', 30.00, 14),
(482, 'COUPON_50', 50.00, 7),
(483, 'COUPON_30', 30.00, 14),
(484, 'COUPON_10', 10.00, 21),
(485, 'COUPON_10', 10.00, 21),
(486, 'COUPON_10', 10.00, 21),
(487, 'COUPON_50', 50.00, 7),
(488, 'COUPON_10', 10.00, 21),
(489, 'COUPON_30', 30.00, 14),
(490, 'COUPON_30', 30.00, 14),
(491, 'COUPON_50', 50.00, 7),
(492, 'COUPON_50', 50.00, 7),
(493, 'COUPON_30', 30.00, 14),
(494, 'COUPON_30', 30.00, 14),
(495, 'COUPON_30', 30.00, 14),
(496, 'COUPON_10', 10.00, 21),
(497, 'COUPON_50', 50.00, 7),
(498, 'COUPON_30', 30.00, 14),
(499, 'COUPON_30', 30.00, 14),
(500, 'COUPON_10', 10.00, 21),
(501, 'COUPON_10', 10.00, 21),
(502, 'COUPON_10', 10.00, 21),
(503, 'COUPON_30', 30.00, 7),
(505, 'COUPON_10', 10.00, 21),
(506, 'COUPON_10', 10.00, 21),
(507, 'COUPON_10', 10.00, 21),
(508, 'COUPON_10', 10.00, 21),
(509, 'COUPON_10', 10.00, 21),
(510, 'COUPON_20', 20.00, 14),
(511, 'COUPON_10', 10.00, 21),
(513, 'COUPON_10', 10.00, 21);

-- --------------------------------------------------------

--
-- 資料表結構 `member_user_coupon`
--

CREATE TABLE `member_user_coupon` (
  `sid` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `is_redeemed` tinyint(1) DEFAULT 0,
  `get_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `member_user_coupon`
--

INSERT INTO `member_user_coupon` (`sid`, `member_id`, `coupon_id`, `is_redeemed`, `get_time`) VALUES
(1, 16, 245, 1, '2024-01-18 09:20:16'),
(2, 96, 258, 1, '2024-01-18 09:20:16'),
(3, 130, 252, 1, '2024-01-18 09:20:16'),
(4, 180, 154, 1, '2024-01-18 09:20:16'),
(5, 152, 16, 1, '2024-01-18 09:20:16'),
(6, 7, 112, 1, '2024-01-18 09:20:16'),
(7, 190, 400, 1, '2024-01-18 09:20:16'),
(8, 175, 237, 1, '2024-01-18 09:20:16'),
(9, 213, 328, 1, '2024-01-18 09:20:16'),
(10, 166, 214, 1, '2024-01-18 09:20:16'),
(11, 11, 258, 1, '2024-01-18 09:20:16'),
(12, 29, 99, 1, '2024-01-18 09:20:16'),
(13, 185, 361, 1, '2024-01-18 09:20:16'),
(14, 23, 223, 1, '2024-01-18 09:20:16'),
(15, 246, 442, 1, '2024-01-18 09:20:16'),
(16, 68, 287, 1, '2024-01-18 09:20:16'),
(17, 220, 302, 1, '2024-01-18 09:20:16'),
(18, 121, 437, 1, '2024-01-18 09:20:16'),
(19, 210, 55, 1, '2024-01-18 09:20:16'),
(20, 108, 146, 1, '2024-01-18 09:20:16'),
(21, 72, 213, 1, '2024-01-18 09:20:16'),
(22, 81, 486, 1, '2024-01-18 09:20:16'),
(23, 102, 429, 1, '2024-01-18 09:20:16'),
(24, 110, 104, 1, '2024-01-18 09:20:16'),
(25, 135, 409, 1, '2024-01-18 09:20:16'),
(26, 85, 5, 1, '2024-01-18 09:20:16'),
(27, 157, 324, 1, '2024-01-18 09:20:16'),
(28, 158, 363, 1, '2024-01-18 09:20:16'),
(29, 160, 327, 1, '2024-01-18 09:20:16'),
(30, 21, 181, 1, '2024-01-18 09:20:16'),
(31, 159, 311, 1, '2024-01-18 09:20:16'),
(32, 148, 255, 1, '2024-01-18 09:20:16'),
(33, 30, 4, 1, '2024-01-18 09:20:16'),
(34, 102, 356, 1, '2024-01-18 09:20:16'),
(35, 183, 172, 1, '2024-01-18 09:20:16'),
(36, 83, 332, 1, '2024-01-18 09:20:16'),
(37, 125, 456, 1, '2024-01-18 09:20:16'),
(38, 87, 327, 1, '2024-01-18 09:20:16'),
(39, 5, 477, 1, '2024-01-18 09:20:16'),
(40, 169, 71, 1, '2024-01-18 09:20:16'),
(41, 210, 18, 1, '2024-01-18 09:20:16'),
(42, 89, 116, 1, '2024-01-18 09:20:16'),
(43, 166, 471, 1, '2024-01-18 09:20:16'),
(44, 59, 315, 1, '2024-01-18 09:20:16'),
(45, 112, 323, 1, '2024-01-18 09:20:16'),
(46, 58, 364, 1, '2024-01-18 09:20:16'),
(47, 13, 2, 1, '2024-01-18 09:20:16'),
(48, 142, 427, 1, '2024-01-18 09:20:16'),
(49, 217, 43, 1, '2024-01-18 09:20:16'),
(50, 170, 493, 1, '2024-01-18 09:20:16'),
(51, 200, 359, 1, '2024-01-18 09:20:16'),
(52, 192, 80, 1, '2024-01-18 09:20:16'),
(53, 46, 359, 1, '2024-01-18 09:20:16'),
(54, 69, 51, 1, '2024-01-18 09:20:16'),
(55, 42, 123, 1, '2024-01-18 09:20:16'),
(56, 20, 35, 1, '2024-01-18 09:20:16'),
(57, 187, 409, 1, '2024-01-18 09:20:16'),
(58, 130, 229, 1, '2024-01-18 09:20:16'),
(59, 210, 210, 1, '2024-01-18 09:20:16'),
(60, 137, 284, 1, '2024-01-18 09:20:16'),
(61, 179, 18, 1, '2024-01-18 09:20:16'),
(62, 239, 279, 1, '2024-01-18 09:20:16'),
(63, 215, 281, 1, '2024-01-18 09:20:16'),
(64, 45, 355, 1, '2024-01-18 09:20:16'),
(65, 106, 445, 1, '2024-01-18 09:20:16'),
(66, 26, 111, 1, '2024-01-18 09:20:16'),
(67, 66, 190, 1, '2024-01-18 09:20:16'),
(68, 192, 85, 1, '2024-01-18 09:20:16'),
(69, 158, 13, 1, '2024-01-18 09:20:16'),
(70, 187, 486, 1, '2024-01-18 09:20:16'),
(71, 93, 133, 1, '2024-01-18 09:20:16'),
(72, 239, 79, 1, '2024-01-18 09:20:16'),
(73, 27, 488, 1, '2024-01-18 09:20:16'),
(74, 49, 168, 1, '2024-01-18 09:20:16'),
(75, 68, 173, 1, '2024-01-18 09:20:16'),
(76, 192, 151, 1, '2024-01-18 09:20:16'),
(77, 208, 232, 1, '2024-01-18 09:20:16'),
(78, 116, 324, 1, '2024-01-18 09:20:16'),
(79, 177, 321, 1, '2024-01-18 09:20:16'),
(80, 79, 122, 1, '2024-01-18 09:20:16'),
(81, 141, 238, 1, '2024-01-18 09:20:16'),
(82, 116, 142, 1, '2024-01-18 09:20:16'),
(83, 178, 171, 1, '2024-01-18 09:20:16'),
(84, 210, 97, 1, '2024-01-18 09:20:16'),
(85, 160, 124, 1, '2024-01-18 09:20:16'),
(86, 78, 456, 1, '2024-01-18 09:20:16'),
(87, 88, 247, 1, '2024-01-18 09:20:16'),
(88, 73, 403, 1, '2024-01-18 09:20:16'),
(89, 1, 191, 1, '2024-01-18 09:20:16'),
(90, 83, 469, 1, '2024-01-18 09:20:16'),
(91, 47, 257, 1, '2024-01-18 09:20:16'),
(92, 121, 295, 1, '2024-01-18 09:20:16'),
(93, 205, 255, 1, '2024-01-18 09:20:16'),
(94, 217, 34, 1, '2024-01-18 09:20:16'),
(95, 194, 144, 1, '2024-01-18 09:20:16'),
(96, 58, 243, 1, '2024-01-18 09:20:16'),
(97, 98, 492, 1, '2024-01-18 09:20:16'),
(98, 215, 475, 1, '2024-01-18 09:20:16'),
(99, 237, 40, 1, '2024-01-18 09:20:16'),
(100, 112, 366, 1, '2024-01-18 09:20:16'),
(101, 217, 485, 1, '2024-01-18 09:20:16'),
(102, 122, 75, 1, '2024-01-18 09:20:16'),
(103, 52, 102, 1, '2024-01-18 09:20:16'),
(104, 124, 395, 1, '2024-01-18 09:20:16'),
(105, 211, 102, 1, '2024-01-18 09:20:16'),
(106, 232, 445, 1, '2024-01-18 09:20:16'),
(107, 33, 494, 1, '2024-01-18 09:20:16'),
(108, 151, 167, 1, '2024-01-18 09:20:16'),
(109, 35, 53, 1, '2024-01-18 09:20:16'),
(110, 51, 455, 1, '2024-01-18 09:20:16'),
(111, 124, 47, 1, '2024-01-18 09:20:16'),
(112, 91, 137, 1, '2024-01-18 09:20:16'),
(113, 131, 491, 1, '2024-01-18 09:20:16'),
(114, 128, 382, 1, '2024-01-18 09:20:16'),
(115, 164, 125, 1, '2024-01-18 09:20:16'),
(116, 41, 299, 1, '2024-01-18 09:20:16'),
(117, 168, 480, 1, '2024-01-18 09:20:16'),
(118, 54, 311, 1, '2024-01-18 09:20:16'),
(119, 66, 476, 1, '2024-01-18 09:20:16'),
(120, 1, 251, 1, '2024-01-18 09:20:16'),
(121, 101, 26, 1, '2024-01-18 09:20:16'),
(122, 86, 280, 1, '2024-01-18 09:20:16'),
(123, 46, 85, 1, '2024-01-18 09:20:16'),
(124, 7, 224, 1, '2024-01-18 09:20:16'),
(125, 175, 328, 1, '2024-01-18 09:20:16'),
(126, 37, 416, 1, '2024-01-18 09:20:16'),
(127, 157, 300, 1, '2024-01-18 09:20:16'),
(128, 38, 424, 1, '2024-01-18 09:20:16'),
(129, 221, 437, 1, '2024-01-18 09:20:16'),
(130, 16, 412, 1, '2024-01-18 09:20:16'),
(131, 216, 252, 1, '2024-01-18 09:20:16'),
(132, 63, 264, 1, '2024-01-18 09:20:16'),
(133, 185, 279, 1, '2024-01-18 09:20:16'),
(134, 201, 152, 1, '2024-01-18 09:20:16'),
(135, 163, 42, 1, '2024-01-18 09:20:16'),
(136, 69, 390, 1, '2024-01-18 09:20:16'),
(137, 81, 433, 1, '2024-01-18 09:20:16'),
(138, 47, 340, 1, '2024-01-18 09:20:16'),
(139, 74, 181, 1, '2024-01-18 09:20:16'),
(140, 214, 220, 1, '2024-01-18 09:20:16'),
(141, 11, 247, 1, '2024-01-18 09:20:16'),
(142, 76, 172, 1, '2024-01-18 09:20:16'),
(143, 129, 426, 1, '2024-01-18 09:20:16'),
(144, 30, 382, 1, '2024-01-18 09:20:16'),
(145, 87, 153, 1, '2024-01-18 09:20:16'),
(146, 101, 334, 1, '2024-01-18 09:20:16'),
(147, 55, 492, 1, '2024-01-18 09:20:16'),
(148, 22, 222, 1, '2024-01-18 09:20:16'),
(149, 129, 484, 1, '2024-01-18 09:20:16'),
(150, 125, 41, 1, '2024-01-18 09:20:16'),
(151, 110, 300, 1, '2024-01-18 09:20:16'),
(152, 33, 407, 1, '2024-01-18 09:20:16'),
(153, 59, 115, 1, '2024-01-18 09:20:16'),
(154, 69, 474, 1, '2024-01-18 09:20:16'),
(155, 145, 258, 1, '2024-01-18 09:20:16'),
(156, 24, 407, 1, '2024-01-18 09:20:16'),
(157, 121, 304, 1, '2024-01-18 09:20:16'),
(158, 151, 116, 1, '2024-01-18 09:20:16'),
(159, 184, 1, 1, '2024-01-18 09:20:16'),
(160, 179, 440, 1, '2024-01-18 09:20:16'),
(161, 201, 477, 1, '2024-01-18 09:20:16'),
(162, 240, 288, 1, '2024-01-18 09:20:16'),
(163, 40, 361, 1, '2024-01-18 09:20:16'),
(164, 3, 119, 1, '2024-01-18 09:20:16'),
(165, 108, 149, 1, '2024-01-18 09:20:16'),
(166, 235, 401, 1, '2024-01-18 09:20:16'),
(167, 191, 20, 1, '2024-01-18 09:20:16'),
(168, 1, 46, 1, '2024-01-18 09:20:16'),
(169, 243, 38, 1, '2024-01-18 09:20:16'),
(170, 119, 360, 1, '2024-01-18 09:20:16'),
(171, 199, 286, 1, '2024-01-18 09:20:16'),
(172, 170, 461, 1, '2024-01-18 09:20:16'),
(173, 120, 445, 1, '2024-01-18 09:20:16'),
(174, 224, 327, 1, '2024-01-18 09:20:16'),
(175, 8, 375, 1, '2024-01-18 09:20:16'),
(176, 96, 444, 1, '2024-01-18 09:20:16'),
(177, 178, 135, 1, '2024-01-18 09:20:16'),
(178, 201, 236, 1, '2024-01-18 09:20:16'),
(179, 84, 381, 1, '2024-01-18 09:20:16'),
(180, 168, 258, 1, '2024-01-18 09:20:16'),
(181, 107, 115, 1, '2024-01-18 09:20:16'),
(182, 24, 480, 1, '2024-01-18 09:20:16'),
(183, 31, 292, 1, '2024-01-18 09:20:16'),
(184, 214, 303, 1, '2024-01-18 09:20:16'),
(185, 5, 399, 1, '2024-01-18 09:20:16'),
(186, 128, 456, 1, '2024-01-18 09:20:16'),
(187, 136, 277, 1, '2024-01-18 09:20:16'),
(188, 244, 451, 1, '2024-01-18 09:20:16'),
(189, 83, 201, 1, '2024-01-18 09:20:16'),
(190, 158, 219, 1, '2024-01-18 09:20:16'),
(191, 228, 242, 1, '2024-01-18 09:20:16'),
(192, 187, 86, 1, '2024-01-18 09:20:16'),
(193, 149, 117, 1, '2024-01-18 09:20:16'),
(194, 200, 50, 1, '2024-01-18 09:20:16'),
(195, 31, 405, 1, '2024-01-18 09:20:16'),
(196, 51, 56, 1, '2024-01-18 09:20:16'),
(197, 225, 352, 1, '2024-01-18 09:20:16'),
(198, 204, 458, 1, '2024-01-18 09:20:16'),
(199, 63, 449, 1, '2024-01-18 09:20:16'),
(200, 210, 57, 1, '2024-01-18 09:20:16'),
(201, 40, 162, 1, '2024-01-18 09:20:16'),
(202, 218, 159, 1, '2024-01-18 09:20:16'),
(203, 236, 338, 1, '2024-01-18 09:20:16'),
(204, 119, 168, 1, '2024-01-18 09:20:16'),
(205, 144, 90, 1, '2024-01-18 09:20:16'),
(206, 111, 125, 1, '2024-01-18 09:20:16'),
(207, 184, 429, 1, '2024-01-18 09:20:16'),
(208, 41, 103, 1, '2024-01-18 09:20:16'),
(209, 83, 490, 1, '2024-01-18 09:20:16'),
(210, 99, 129, 1, '2024-01-18 09:20:16'),
(211, 144, 160, 1, '2024-01-18 09:20:16'),
(212, 177, 165, 1, '2024-01-18 09:20:16'),
(213, 162, 308, 1, '2024-01-18 09:20:16'),
(214, 245, 292, 1, '2024-01-18 09:20:16'),
(215, 146, 102, 1, '2024-01-18 09:20:16'),
(216, 76, 448, 1, '2024-01-18 09:20:16'),
(217, 17, 295, 1, '2024-01-18 09:20:16'),
(218, 94, 105, 1, '2024-01-18 09:20:16'),
(219, 99, 310, 1, '2024-01-18 09:20:16'),
(220, 187, 387, 1, '2024-01-18 09:20:16'),
(221, 34, 245, 1, '2024-01-18 09:20:16'),
(222, 68, 93, 1, '2024-01-18 09:20:16'),
(223, 129, 463, 1, '2024-01-18 09:20:16'),
(224, 123, 42, 1, '2024-01-18 09:20:16'),
(225, 50, 156, 1, '2024-01-18 09:20:16'),
(226, 157, 213, 1, '2024-01-18 09:20:16'),
(227, 125, 129, 1, '2024-01-18 09:20:16'),
(228, 216, 190, 1, '2024-01-18 09:20:16'),
(229, 132, 276, 1, '2024-01-18 09:20:16'),
(230, 67, 158, 1, '2024-01-18 09:20:16'),
(231, 248, 413, 1, '2024-01-18 09:20:16'),
(232, 59, 125, 1, '2024-01-18 09:20:16'),
(233, 194, 320, 1, '2024-01-18 09:20:16'),
(234, 88, 113, 1, '2024-01-18 09:20:16'),
(235, 36, 438, 1, '2024-01-18 09:20:16'),
(236, 160, 211, 1, '2024-01-18 09:20:16'),
(237, 196, 130, 1, '2024-01-18 09:20:16'),
(238, 174, 46, 1, '2024-01-18 09:20:16'),
(239, 105, 426, 1, '2024-01-18 09:20:16'),
(240, 102, 229, 1, '2024-01-18 09:20:16'),
(241, 17, 52, 1, '2024-01-18 09:20:16'),
(242, 127, 304, 1, '2024-01-18 09:20:16'),
(243, 133, 105, 1, '2024-01-18 09:20:16'),
(244, 222, 64, 1, '2024-01-18 09:20:16'),
(245, 200, 283, 1, '2024-01-18 09:20:16'),
(246, 6, 334, 1, '2024-01-18 09:20:16'),
(247, 180, 369, 1, '2024-01-18 09:20:16'),
(248, 176, 461, 1, '2024-01-18 09:20:16'),
(249, 206, 424, 1, '2024-01-18 09:20:16'),
(250, 97, 357, 1, '2024-01-18 09:20:16'),
(251, 19, 268, 1, '2024-01-18 09:20:16'),
(252, 116, 495, 1, '2024-01-18 09:20:16'),
(253, 177, 7, 1, '2024-01-18 09:20:16'),
(254, 82, 232, 1, '2024-01-18 09:20:16'),
(255, 7, 460, 1, '2024-01-18 09:20:16'),
(256, 138, 161, 1, '2024-01-18 09:20:16'),
(257, 24, 149, 1, '2024-01-18 09:20:16'),
(258, 44, 282, 1, '2024-01-18 09:20:16'),
(259, 108, 230, 1, '2024-01-18 09:20:16'),
(260, 69, 335, 1, '2024-01-18 09:20:16'),
(261, 114, 395, 1, '2024-01-18 09:20:16'),
(262, 173, 152, 1, '2024-01-18 09:20:16'),
(263, 137, 355, 1, '2024-01-18 09:20:16'),
(264, 88, 108, 1, '2024-01-18 09:20:16'),
(265, 214, 367, 1, '2024-01-18 09:20:16'),
(266, 178, 233, 1, '2024-01-18 09:20:16'),
(267, 92, 354, 1, '2024-01-18 09:20:16'),
(268, 228, 139, 1, '2024-01-18 09:20:16'),
(269, 245, 193, 1, '2024-01-18 09:20:16'),
(270, 137, 250, 1, '2024-01-18 09:20:16'),
(271, 7, 21, 1, '2024-01-18 09:20:16'),
(272, 247, 63, 1, '2024-01-18 09:20:16'),
(273, 121, 313, 1, '2024-01-18 09:20:16'),
(274, 211, 181, 1, '2024-01-18 09:20:16'),
(275, 106, 273, 1, '2024-01-18 09:20:16'),
(276, 193, 228, 1, '2024-01-18 09:20:16'),
(277, 185, 146, 1, '2024-01-18 09:20:16'),
(278, 211, 99, 1, '2024-01-18 09:20:16'),
(279, 80, 187, 1, '2024-01-18 09:20:16'),
(280, 145, 403, 1, '2024-01-18 09:20:16'),
(281, 38, 112, 1, '2024-01-18 09:20:16'),
(282, 186, 308, 1, '2024-01-18 09:20:16'),
(283, 157, 263, 1, '2024-01-18 09:20:16'),
(284, 51, 33, 1, '2024-01-18 09:20:16'),
(285, 201, 83, 1, '2024-01-18 09:20:16'),
(286, 88, 258, 1, '2024-01-18 09:20:16'),
(287, 26, 230, 1, '2024-01-18 09:20:16'),
(288, 9, 73, 1, '2024-01-18 09:20:16'),
(289, 172, 22, 1, '2024-01-18 09:20:16'),
(290, 70, 124, 1, '2024-01-18 09:20:16'),
(291, 52, 381, 1, '2024-01-18 09:20:16'),
(292, 240, 296, 1, '2024-01-18 09:20:16'),
(293, 230, 317, 1, '2024-01-18 09:20:16'),
(294, 164, 85, 1, '2024-01-18 09:20:16'),
(295, 103, 380, 1, '2024-01-18 09:20:16'),
(296, 163, 175, 1, '2024-01-18 09:20:16'),
(297, 244, 138, 1, '2024-01-18 09:20:16'),
(298, 196, 2, 1, '2024-01-18 09:20:16'),
(299, 238, 236, 1, '2024-01-18 09:20:16'),
(300, 219, 7, 1, '2024-01-18 09:20:16'),
(301, 63, 83, 1, '2024-01-18 09:20:16'),
(302, 179, 433, 1, '2024-01-18 09:20:16'),
(303, 89, 423, 1, '2024-01-18 09:20:16'),
(304, 215, 55, 1, '2024-01-18 09:20:16'),
(305, 14, 461, 1, '2024-01-18 09:20:16'),
(306, 46, 75, 1, '2024-01-18 09:20:16'),
(307, 64, 43, 1, '2024-01-18 09:20:16'),
(308, 233, 16, 1, '2024-01-18 09:20:16'),
(309, 169, 368, 1, '2024-01-18 09:20:16'),
(310, 169, 62, 1, '2024-01-18 09:20:16'),
(311, 73, 234, 1, '2024-01-18 09:20:16'),
(312, 116, 1, 1, '2024-01-18 09:20:16'),
(313, 67, 255, 1, '2024-01-18 09:20:16'),
(314, 144, 135, 1, '2024-01-18 09:20:16'),
(315, 222, 189, 1, '2024-01-18 09:20:16'),
(316, 223, 468, 1, '2024-01-18 09:20:16'),
(317, 113, 478, 1, '2024-01-18 09:20:16'),
(318, 108, 338, 1, '2024-01-18 09:20:16'),
(319, 134, 468, 1, '2024-01-18 09:20:16'),
(320, 78, 345, 1, '2024-01-18 09:20:16'),
(321, 222, 449, 1, '2024-01-18 09:20:16'),
(322, 100, 108, 1, '2024-01-18 09:20:16'),
(323, 125, 115, 1, '2024-01-18 09:20:16'),
(324, 221, 4, 1, '2024-01-18 09:20:16'),
(325, 241, 299, 1, '2024-01-18 09:20:16'),
(326, 245, 159, 1, '2024-01-18 09:20:16'),
(327, 70, 316, 1, '2024-01-18 09:20:16'),
(328, 129, 314, 1, '2024-01-18 09:20:16'),
(329, 114, 13, 1, '2024-01-18 09:20:16'),
(330, 182, 327, 1, '2024-01-18 09:20:16'),
(331, 231, 104, 1, '2024-01-18 09:20:16'),
(332, 17, 255, 1, '2024-01-18 09:20:16'),
(333, 230, 465, 1, '2024-01-18 09:20:16'),
(334, 76, 224, 1, '2024-01-18 09:20:16'),
(335, 97, 434, 1, '2024-01-18 09:20:16'),
(336, 200, 194, 1, '2024-01-18 09:20:16'),
(337, 81, 312, 1, '2024-01-18 09:20:16'),
(338, 211, 304, 1, '2024-01-18 09:20:16'),
(339, 41, 388, 1, '2024-01-18 09:20:16'),
(340, 146, 396, 1, '2024-01-18 09:20:16'),
(341, 148, 357, 1, '2024-01-18 09:20:16'),
(342, 148, 5, 1, '2024-01-18 09:20:16'),
(343, 22, 405, 1, '2024-01-18 09:20:16'),
(344, 245, 374, 1, '2024-01-18 09:20:16'),
(345, 140, 204, 1, '2024-01-18 09:20:16'),
(346, 25, 414, 1, '2024-01-18 09:20:16'),
(347, 184, 376, 1, '2024-01-18 09:20:16'),
(348, 139, 497, 1, '2024-01-18 09:20:16'),
(349, 184, 378, 1, '2024-01-18 09:20:16'),
(350, 71, 321, 1, '2024-01-18 09:20:16'),
(351, 74, 252, 1, '2024-01-18 09:20:16'),
(352, 223, 105, 1, '2024-01-18 09:20:16'),
(353, 236, 24, 1, '2024-01-18 09:20:16'),
(354, 55, 256, 1, '2024-01-18 09:20:16'),
(355, 142, 380, 1, '2024-01-18 09:20:16'),
(356, 194, 206, 1, '2024-01-18 09:20:16'),
(357, 204, 6, 1, '2024-01-18 09:20:16'),
(358, 130, 100, 1, '2024-01-18 09:20:16'),
(359, 7, 459, 1, '2024-01-18 09:20:16'),
(360, 169, 65, 1, '2024-01-18 09:20:16'),
(361, 140, 142, 1, '2024-01-18 09:20:16'),
(362, 247, 183, 1, '2024-01-18 09:20:16'),
(363, 90, 305, 1, '2024-01-18 09:20:16'),
(364, 199, 476, 1, '2024-01-18 09:20:16'),
(365, 184, 348, 1, '2024-01-18 09:20:16'),
(366, 163, 237, 1, '2024-01-18 09:20:16'),
(367, 80, 113, 1, '2024-01-18 09:20:16'),
(368, 176, 419, 1, '2024-01-18 09:20:16'),
(369, 205, 199, 1, '2024-01-18 09:20:16'),
(370, 99, 333, 1, '2024-01-18 09:20:16'),
(371, 119, 250, 1, '2024-01-18 09:20:16'),
(372, 235, 213, 1, '2024-01-18 09:20:16'),
(373, 222, 266, 1, '2024-01-18 09:20:16'),
(374, 34, 142, 1, '2024-01-18 09:20:16'),
(375, 190, 66, 1, '2024-01-18 09:20:16'),
(376, 141, 156, 1, '2024-01-18 09:20:16'),
(377, 240, 321, 1, '2024-01-18 09:20:16'),
(378, 135, 138, 1, '2024-01-18 09:20:16'),
(379, 126, 230, 1, '2024-01-18 09:20:16'),
(380, 147, 493, 1, '2024-01-18 09:20:16'),
(381, 149, 71, 1, '2024-01-18 09:20:16'),
(382, 239, 53, 1, '2024-01-18 09:20:16'),
(383, 158, 352, 1, '2024-01-18 09:20:16'),
(384, 242, 297, 1, '2024-01-18 09:20:16'),
(385, 194, 105, 1, '2024-01-18 09:20:16'),
(386, 162, 463, 1, '2024-01-18 09:20:16'),
(387, 28, 221, 1, '2024-01-18 09:20:16'),
(388, 152, 114, 1, '2024-01-18 09:20:16'),
(389, 166, 31, 1, '2024-01-18 09:20:16'),
(390, 102, 324, 1, '2024-01-18 09:20:16'),
(391, 32, 92, 1, '2024-01-18 09:20:16'),
(392, 223, 93, 1, '2024-01-18 09:20:16'),
(393, 123, 83, 1, '2024-01-18 09:20:16'),
(394, 170, 491, 1, '2024-01-18 09:20:16'),
(395, 52, 459, 1, '2024-01-18 09:20:16'),
(396, 103, 436, 1, '2024-01-18 09:20:16'),
(397, 34, 195, 1, '2024-01-18 09:20:16'),
(398, 241, 324, 1, '2024-01-18 09:20:16'),
(399, 249, 214, 1, '2024-01-18 09:20:16'),
(400, 90, 115, 1, '2024-01-18 09:20:16'),
(401, 239, 451, 1, '2024-01-18 09:20:16'),
(402, 82, 200, 1, '2024-01-18 09:20:16'),
(403, 225, 339, 1, '2024-01-18 09:20:16'),
(404, 176, 419, 1, '2024-01-18 09:20:16'),
(405, 222, 396, 1, '2024-01-18 09:20:16'),
(406, 237, 17, 1, '2024-01-18 09:20:16'),
(407, 115, 316, 1, '2024-01-18 09:20:16'),
(408, 165, 297, 1, '2024-01-18 09:20:16'),
(409, 233, 389, 1, '2024-01-18 09:20:16'),
(410, 131, 84, 1, '2024-01-18 09:20:16'),
(411, 107, 464, 1, '2024-01-18 09:20:16'),
(412, 23, 104, 1, '2024-01-18 09:20:16'),
(413, 148, 35, 1, '2024-01-18 09:20:16'),
(414, 40, 150, 1, '2024-01-18 09:20:16'),
(415, 183, 472, 1, '2024-01-18 09:20:16'),
(416, 249, 82, 1, '2024-01-18 09:20:16'),
(417, 187, 291, 1, '2024-01-18 09:20:16'),
(418, 86, 487, 1, '2024-01-18 09:20:16'),
(419, 50, 71, 1, '2024-01-18 09:20:16'),
(420, 4, 280, 1, '2024-01-18 09:20:16'),
(421, 162, 387, 1, '2024-01-18 09:20:16'),
(422, 160, 472, 1, '2024-01-18 09:20:16'),
(423, 199, 326, 1, '2024-01-18 09:20:16'),
(424, 250, 127, 1, '2024-01-18 09:20:16'),
(425, 156, 480, 1, '2024-01-18 09:20:16'),
(426, 7, 233, 1, '2024-01-18 09:20:16'),
(427, 193, 188, 1, '2024-01-18 09:20:16'),
(428, 31, 375, 1, '2024-01-18 09:20:16'),
(429, 208, 84, 1, '2024-01-18 09:20:16'),
(430, 204, 25, 1, '2024-01-18 09:20:16'),
(431, 116, 372, 1, '2024-01-18 09:20:16'),
(432, 132, 113, 1, '2024-01-18 09:20:16'),
(433, 218, 290, 1, '2024-01-18 09:20:16'),
(434, 55, 3, 1, '2024-01-18 09:20:16'),
(435, 149, 420, 1, '2024-01-18 09:20:16'),
(436, 232, 369, 1, '2024-01-18 09:20:16'),
(437, 182, 151, 1, '2024-01-18 09:20:16'),
(438, 5, 430, 1, '2024-01-18 09:20:16'),
(439, 49, 210, 1, '2024-01-18 09:20:16'),
(440, 200, 480, 1, '2024-01-18 09:20:16'),
(441, 32, 479, 1, '2024-01-18 09:20:16'),
(442, 227, 130, 1, '2024-01-18 09:20:16'),
(443, 84, 89, 1, '2024-01-18 09:20:16'),
(444, 194, 468, 1, '2024-01-18 09:20:16'),
(445, 197, 323, 1, '2024-01-18 09:20:16'),
(446, 156, 6, 1, '2024-01-18 09:20:16'),
(447, 160, 436, 1, '2024-01-18 09:20:16'),
(448, 75, 428, 1, '2024-01-18 09:20:16'),
(449, 194, 432, 1, '2024-01-18 09:20:16'),
(450, 28, 294, 1, '2024-01-18 09:20:16'),
(451, 4, 22, 1, '2024-01-18 09:20:16'),
(452, 17, 136, 1, '2024-01-18 09:20:16'),
(453, 235, 338, 1, '2024-01-18 09:20:16'),
(454, 78, 441, 1, '2024-01-18 09:20:16'),
(455, 43, 127, 1, '2024-01-18 09:20:16'),
(456, 242, 393, 1, '2024-01-18 09:20:16'),
(457, 78, 240, 1, '2024-01-18 09:20:16'),
(458, 162, 310, 1, '2024-01-18 09:20:16'),
(459, 133, 130, 1, '2024-01-18 09:20:16'),
(460, 229, 97, 1, '2024-01-18 09:20:16'),
(461, 128, 116, 1, '2024-01-18 09:20:16'),
(462, 128, 230, 1, '2024-01-18 09:20:16'),
(463, 123, 286, 1, '2024-01-18 09:20:16'),
(464, 19, 196, 1, '2024-01-18 09:20:16'),
(465, 55, 212, 1, '2024-01-18 09:20:16'),
(466, 175, 162, 1, '2024-01-18 09:20:16'),
(467, 67, 101, 1, '2024-01-18 09:20:16'),
(468, 33, 16, 1, '2024-01-18 09:20:16'),
(469, 57, 137, 1, '2024-01-18 09:20:16'),
(470, 160, 176, 1, '2024-01-18 09:20:16'),
(471, 103, 58, 1, '2024-01-18 09:20:16'),
(472, 87, 265, 1, '2024-01-18 09:20:16'),
(473, 238, 40, 1, '2024-01-18 09:20:16'),
(474, 159, 410, 1, '2024-01-18 09:20:16'),
(475, 110, 184, 1, '2024-01-18 09:20:16'),
(476, 199, 318, 1, '2024-01-18 09:20:16'),
(477, 196, 158, 1, '2024-01-18 09:20:16'),
(478, 244, 32, 1, '2024-01-18 09:20:16'),
(479, 110, 133, 1, '2024-01-18 09:20:16'),
(480, 51, 139, 1, '2024-01-18 09:20:16'),
(481, 242, 35, 1, '2024-01-18 09:20:16'),
(482, 222, 315, 1, '2024-01-18 09:20:16'),
(483, 164, 444, 1, '2024-01-18 09:20:16'),
(484, 46, 339, 1, '2024-01-18 09:20:16'),
(485, 120, 438, 1, '2024-01-18 09:20:16'),
(486, 76, 164, 1, '2024-01-18 09:20:16'),
(487, 34, 215, 1, '2024-01-18 09:20:16'),
(488, 249, 236, 1, '2024-01-18 09:20:16'),
(489, 100, 262, 1, '2024-01-18 09:20:16'),
(490, 94, 344, 1, '2024-01-18 09:20:16'),
(491, 67, 169, 1, '2024-01-18 09:20:16'),
(492, 227, 210, 1, '2024-01-18 09:20:16'),
(493, 63, 123, 1, '2024-01-18 09:20:16'),
(494, 59, 169, 1, '2024-01-18 09:20:16'),
(495, 216, 490, 1, '2024-01-18 09:20:16'),
(496, 158, 204, 1, '2024-01-18 09:20:16'),
(497, 79, 477, 1, '2024-01-18 09:20:16'),
(498, 9, 367, 1, '2024-01-18 09:20:16'),
(499, 57, 476, 1, '2024-01-18 09:20:16'),
(500, 44, 348, 1, '2024-01-18 09:20:16');

-- --------------------------------------------------------

--
-- 資料表結構 `order_status`
--

CREATE TABLE `order_status` (
  `order_status_id` int(11) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `order_status`
--

INSERT INTO `order_status` (`order_status_id`, `order_status`) VALUES
(1, '未出貨'),
(2, '已出貨'),
(3, '未付款'),
(4, '已付款'),
(5, '未確認'),
(6, '已確認'),
(7, '取消訂單');

-- --------------------------------------------------------

--
-- 資料表結構 `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `payment_method` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_method`) VALUES
(1, '信用卡'),
(2, 'Line Pay'),
(3, '現金');

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`product_id`, `name`, `categories_id`, `price`, `size`, `created_at`, `updated_at`, `description`) VALUES
(1, '仙客來', 4, 100, '20cmx20cm', '2012-05-20 08:30:00', '2014-07-10 10:25:00', '優雅的仙客來，散發著芬芳。'),
(2, '鬱金香', 4, 120, '18cmx22cm', '2015-09-10 14:22:00', '2017-02-26 16:50:00', '華麗的鬱金香，色彩繽紛美麗。'),
(3, '蝴蝶蘭', 4, 80, '22cmx18cm', '2018-02-25 10:45:00', '2020-05-22 11:32:00', '精緻的蝴蝶蘭，如同蝴蝶翩翩。'),
(4, '青春之歌', 4, 150, '19cmx21cm', '2011-07-14 18:12:00', '2013-03-28 21:15:00', '青春之歌，綻放著青春的活力。'),
(5, '櫻花樹', 4, 90, '21cmx19cm', '2019-03-05 09:55:00', NULL, '迷人的櫻花樹，春天的象徵。'),
(6, '迷你康乃馨', 4, 75, '20cmx18cm', '2013-11-30 12:30:00', '2015-04-14 13:10:00', '迷你康乃馨，小巧可愛。'),
(7, '迎春花', 4, 110, '18cmx20cm', '2010-08-19 16:40:00', '2012-08-02 18:40:00', '迎春花的芬芳，迎接新的開始。'),
(8, '小葉翠蘭', 4, 95, '19cmx20cm', '2016-04-28 20:18:00', '2018-10-03 22:18:00', '小葉翠蘭，翠綠優雅。'),
(9, '金心蘭', 4, 130, '20cmx19cm', '2017-10-15 11:27:00', NULL, '金心蘭，心意滿滿的幸福。'),
(10, '翡翠之戀', 4, 88, '15cmx20cm', '2014-06-02 14:05:00', '2015-08-22 15:35:00', '翡翠之戀，清新綠意。'),
(11, '金不換', 5, 300, '25cm x 30cm', '2016-05-18 14:05:00', '2016-05-23 21:11:00', '翠綠葉，適合室內種植。'),
(12, '蝴蝶蘭', 5, 500, '40cm x 55cm', '2018-11-23 14:05:00', '2018-11-29 00:46:00', '優雅花姿，受歡迎的室內花卉。'),
(13, '玉蘭', 5, 800, '22cm x 40cm', '2017-09-01 14:05:00', '2017-09-11 10:27:00', '香氣芬芳，美麗的庭園樹木。'),
(14, '櫻花樹', 5, 1200, '30cm x 50cm', '2019-07-06 14:05:00', '2019-07-14 15:45:00', '粉嫩花海，春季浪漫盛放。'),
(15, '仙人球', 5, 200, '35cm x 45cm', '2021-02-13 14:05:00', '2021-02-23 00:05:00', '多肉球狀植物，易於管理。'),
(16, '薰衣草', 5, 100, '28cm x 60cm', '2016-03-10 14:05:00', '2016-03-15 22:33:00', '宜人芬芳，適合室內或花園。'),
(17, '美人蕉', 5, 400, '20cm x 35cm', '2015-11-07 14:05:00', '2015-11-15 17:02:00', '大葉翠綠，為庭園增添熱帶風情。'),
(18, '金露梅', 5, 500, '45cm x 58cm', '2023-09-17 14:05:00', '2023-09-26 14:13:00', '金黃花朵，耐旱的美麗樹木。'),
(19, '銀葉榕', 5, 300, '50cm x 48cm', '2022-04-05 14:05:00', '2022-04-12 06:59:00', '葉片銀白，室內綠化的優選。'),
(20, '萬年青', 5, 200, '55cm x 20cm', '2014-12-12 14:05:00', '2014-12-20 10:42:00', '翠綠葉片，耐陰的室內植物。'),
(21, '鐵線蕨', 7, 150, '20cm x 20cm', '2017-04-21 14:05:00', '2017-04-30 00:36:00', '綠葉植物，葉片細長，適合陰暗環境。'),
(22, '銀葉草', 7, 80, '15cm x 15cm', '2015-08-30 14:05:00', '2015-09-07 08:26:00', '灰綠葉片，易栽培的室內植物。'),
(23, '萬年青', 7, 120, '20cm x 20cm', '2018-08-13 14:05:00', '2018-08-22 07:12:00', '翠綠葉，耐陰，適合室內種植。'),
(24, '綠萱', 7, 90, '15cm x 15cm', '2014-06-10 14:05:00', '2014-06-15 21:35:00', '葉片豐滿，適合陽光充足的環境。'),
(25, '蘇鐵樹', 7, 200, '15cm x 20cm', '2019-03-16 14:05:00', '2019-03-25 17:20:00', '葉片特殊形狀，易於識別的盆栽。'),
(26, '紫羅蘭', 7, 60, '15cm x 15cm', '2020-11-02 14:05:00', '2020-11-09 07:09:00', '迷人花朵，適合室內裝飾。'),
(27, '龍舌蘭', 7, 180, '15cm x 20cm', '2021-12-01 14:05:00', '2021-12-11 05:24:00', '多肉植物，耐旱且易護理。'),
(28, '仙人球', 7, 100, '20cm x 20cm', '2022-05-23 14:05:00', '2022-06-01 23:16:00', '球形多肉植物，適合室內擺設。'),
(29, '蕨類植物', 7, 70, '20cm x 15cm', '2018-01-27 14:05:00', '2018-02-02 03:55:00', '葉片翠綠，增添自然風格。'),
(30, '時計草', 7, 50, '10cm x 10cm', '2016-06-26 14:05:00', '2016-07-01 14:18:00', '小巧室內植物，容易管理的綠化選擇。'),
(31, '小葉紫檀盆', 8, 250, '25cm x 30cm', '2015-04-19 14:05:00', '2015-04-29 18:54:00', '美觀多肉植栽，適合室內裝飾。'),
(32, '細葉石蓮', 8, 180, '22cm x 40cm', '2020-10-22 14:05:00', '2020-11-02 00:45:00', '細緻葉片，室內盆栽的理想選擇。'),
(33, '綠寶石仙人球', 8, 120, '20cm x 25cm', '2015-02-14 14:05:00', '2015-02-24 07:28:00', '多肉球形植物，易於管理。'),
(34, '迷你竹子', 8, 200, '30cm x 50cm', '2019-10-05 14:05:00', '2019-10-14 08:15:00', '迷人小型竹子，適合室內種植。'),
(35, '小型薰衣草', 8, 150, '35cm x 45cm', '2014-10-28 14:05:00', '2014-11-07 17:47:00', '迷人香氣，室內綠化的佳品。'),
(36, '小型龍舌蘭', 8, 160, '28cm x 60cm', '2017-01-08 14:05:00', '2017-01-17 02:29:00', '小巧多肉，適合陽光充足處。'),
(37, '迷你玫瑰', 8, 230, '20cm x 35cm', '2022-01-15 14:05:00', '2022-01-22 19:17:00', '精緻花朵，室內裝飾的亮點。'),
(38, '迷你綠萱', 8, 140, '40cm x 55cm', '2016-12-09 14:05:00', '2016-12-21 08:45:00', '小型翠綠葉，適合擺放在桌上。'),
(39, '迷你鳳梨樹', 8, 190, '50cm x 48cm', '2023-02-25 14:05:00', '2023-03-27 05:30:00', '迷人小型樹木，室內綠化首選。'),
(40, '小型菠蘿蜜樹', 8, 210, '55cm x 20cm', '2020-03-27 14:05:00', '2020-04-03 18:22:00', '小型熱帶樹木，增添自然風情。'),
(41, '虎皮蘭', 9, 120, '10cm x 15cm', '2021-10-14 14:05:00', '2021-10-22 21:09:00', '美觀多肉植栽，適合室內裝飾。'),
(42, '石蓮花', 9, 90, '8cm x 10cm', '2015-12-07 14:05:00', '2015-12-17 16:12:00', '細緻葉片，室內盆栽的理想選擇。'),
(43, '玉露', 9, 150, '12cm x 18cm', '2018-04-26 14:05:00', '2018-05-05 23:58:00', '多肉植物，葉片形狀獨特迷人。'),
(44, '仙人球', 9, 80, '6cm x 8cm', '2016-07-25 14:05:00', '2016-08-03 10:15:00', '多肉球形植物，易於管理。'),
(45, '多肉菊', 9, 100, '7cm x 9cm', '2019-05-28 14:05:00', '2019-06-07 13:26:00', '美麗花朵，適合室內種植。'),
(46, '珠翠玉', 9, 110, '5cm x 7cm', '2014-08-11 14:05:00', '2014-08-20 02:14:00', '小巧多肉，室內綠化的好選擇。'),
(47, '蟲蟲草', 9, 130, '9cm x 12cm', '2020-07-24 14:05:00', '2020-08-01 09:36:00', '玲瓏花姿，增添室內風格。'),
(48, '多肉櫻桃', 9, 95, '10cm x 14cm', '2015-06-17 14:05:00', '2015-06-23 08:09:00', '多肉植物，果實形狀似櫻桃。'),
(49, '蘭花仙人掌', 9, 140, '8cm x 11cm', '2017-08-20 14:05:00', '2017-08-29 03:52:00', '多肉植物，花朵似蘭花。'),
(50, '轉盤仙人掌', 9, 75, '6cm x 9cm', '2018-03-04 14:05:00', '2018-03-12 05:47:00', '迷人形狀，適合室內種植。'),
(51, '玻璃花盆', 10, 700, '25cm x 25cm', '2016-09-30 14:05:00', '2016-10-10 18:15:00', '透明設計，適合各種植物擺設。'),
(52, '陶瓷盆', 10, 500, '30cm x 30cm', '2023-05-19 14:05:00', '2023-05-30 10:29:00', '古典陶瓷製，質感獨特。'),
(53, '塑料花盆', 10, 350, '22cm x 22cm', '2019-01-10 14:05:00', '2019-01-20 12:03:00', '輕巧耐用，適合室外種植。'),
(54, '金屬植物盆', 10, 800, '40cm x 40cm', '2021-03-03 14:05:00', '2021-03-11 16:40:00', '簡約設計，耐久性高。'),
(55, '纖維盆', 10, 450, '35cm x 35cm', '2014-09-13 14:05:00', '2014-09-23 01:27:00', '輕便材質，適合移動使用。'),
(56, '陶土盆', 10, 600, '45cm x 45cm', '2020-12-18 14:05:00', '2020-12-25 07:59:00', '古樸陶土風格，適合庭院擺設。'),
(57, '木質花盆', 10, 900, '60cm x 60cm', '2015-03-21 14:05:00', '2015-03-28 14:15:00', '天然木材製，環保美觀。'),
(58, '石頭盆', 10, 950, '70cm x 70cm', '2018-02-22 14:05:00', '2018-03-02 02:51:00', '天然石材，質感堅固。'),
(59, '塑膠盆', 10, 400, '25cm x 25cm', '2017-06-04 14:05:00', '2017-06-13 03:52:00', '簡單實用，適合多種植物。'),
(60, '石膏花盆', 10, 750, '55cm x 55cm', '2016-01-06 14:05:00', '2016-01-16 21:36:00', '輕盈質地，適合室內裝飾。'),
(61, '園藝花枝剪', 11, 450, '20cm x 15cm', '2020-02-11 14:05:00', '2020-02-17 15:43:00', '專業剪枝工具'),
(62, '園藝粗枝剪', 11, 720, '25cm x 8cm', '2023-07-31 14:05:00', '2023-08-07 18:04:00', '強力粗枝剪'),
(63, '園藝肥料', 11, 550, '30cm x 10cm', '2014-07-15 14:05:00', '2014-07-19 22:17:00', '高效肥料'),
(64, '園藝紗網', 11, 180, '50cm x 50cm', '2019-09-02 14:05:00', '2019-09-08 05:50:00', '多功能紗網'),
(65, '園藝手套', 11, 280, '30cmx30cm', '2022-08-12 14:05:00', '2022-08-19 11:02:00', '舒適保護手套'),
(66, '澆水器', 11, 320, '35cm x 15cm', '2015-01-29 14:05:00', '2015-02-06 09:26:00', '方便澆水工具'),
(67, '洞洞置物架', 11, 650, '60cm x 40cm', '2018-10-08 14:05:00', '2018-10-17 18:22:00', '實用洞洞置物架'),
(68, '劍山', 11, 480, '28cm x 5cm', '2017-11-15 14:05:00', '2017-11-25 01:34:00', '用於插花'),
(69, '不鏽鋼手鏟', 11, 180, '20cm x 7cm', '2016-04-23 14:05:00', '2016-04-30 09:18:00', '耐用手持鏟'),
(70, '插花海綿', 11, 800, '30cm x 15cm', '2020-05-30 14:05:00', '2020-06-07 03:14:00', '有利於固定和支撐花材，同時其開孔型的發泡也可提供花朵所需的水份。'),
(71, '花卉造型娃娃', 12, 180, '15cm x 15cm', '2015-10-31 14:05:00', '2015-11-04 17:56:00', '可愛繽紛，適合裝飾花束。'),
(72, '花卉緞帶', 12, 90, '12cm x 12cm', '2021-06-08 14:05:00', '2021-06-16 19:09:00', '色彩豐富，為花束增添華麗感。'),
(73, '花卉氣球', 12, 120, '直徑20cm', '2014-11-26 14:05:00', '2014-12-01 11:58:00', '透明氣球搭配花朵裝飾，營造浪漫氛圍。'),
(74, '包裝花盒', 12, 250, '30cm x 30cm', '2019-04-18 14:05:00', '2019-04-27 04:23:00', '精緻包裝，適合送禮佳品。'),
(75, '花卉包裝紙', 12, 80, '25cm x 25cm', '2016-02-28 14:05:00', '2016-03-08 21:51:00', '色彩繽紛，為花束增添層次感。'),
(76, '花卉網袋', 12, 60, '18cm x 18cm', '2018-06-14 14:05:00', '2018-06-23 07:35:00', '簡約實用，保護花卉不受損。'),
(77, '花貼紙', 12, 50, '10cm x 10cm', '2017-02-01 14:05:00', '2017-02-08 12:48:00', '多款造型，可隨心黏貼在花束上。'),
(78, '花卉襯墊', 12, 150, '40cm x 40cm', '2015-07-03 14:05:00', '2015-07-10 14:33:00', '柔軟質感，保護花束不變形。'),
(79, '花束袋', 12, 70, '15cm x 15cm', '2020-08-27 14:05:00', '2020-09-03 08:10:00', '簡易包裝，方便攜帶。'),
(81, '23', 4, 345, '345', '2024-02-01 14:30:55', '0000-00-00 00:00:00', '34'),
(82, '345', 12, 345, '345', '2024-02-01 14:31:04', '2024-02-01 14:31:45', '35'),
(83, 'dfgdfg', 3, 34, '444cv', '2024-02-01 14:34:41', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- 資料表結構 `product_cart`
--

CREATE TABLE `product_cart` (
  `product_cart_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `product_cart`
--

INSERT INTO `product_cart` (`product_cart_id`, `member_id`, `product_id`, `order_quantity`) VALUES
(1, 1, 1, 9),
(2, 2, 22, 4),
(3, 3, 8, 7),
(4, 4, 43, 2),
(5, 5, 7, 10),
(6, 6, 31, 3),
(7, 7, 17, 8),
(8, 8, 3, 5),
(9, 9, 35, 1),
(10, 10, 15, 6),
(11, 11, 14, 3),
(12, 12, 29, 9),
(13, 13, 48, 2),
(14, 14, 36, 7),
(15, 15, 49, 8),
(16, 16, 12, 10),
(17, 17, 25, 6),
(18, 18, 50, 5),
(19, 19, 28, 1),
(20, 20, 46, 4),
(21, 21, 38, 8),
(22, 22, 21, 7),
(23, 23, 26, 2),
(24, 24, 44, 9),
(25, 25, 42, 10),
(26, 26, 10, 3),
(27, 27, 47, 1),
(28, 28, 41, 6),
(29, 29, 33, 5),
(30, 30, 20, 4),
(31, 31, 40, 7),
(32, 32, 30, 2),
(33, 33, 23, 9),
(34, 34, 37, 8),
(35, 35, 9, 10),
(36, 36, 32, 1),
(37, 37, 6, 3),
(38, 38, 16, 4),
(39, 39, 5, 5),
(40, 40, 11, 6),
(41, 41, 24, 9),
(42, 42, 45, 7),
(43, 43, 18, 2),
(44, 44, 19, 8),
(45, 45, 4, 10),
(46, 46, 2, 3),
(47, 47, 13, 1),
(48, 48, 27, 5),
(49, 49, 39, 6),
(50, 50, 34, 4);

-- --------------------------------------------------------

--
-- 資料表結構 `product_color`
--

CREATE TABLE `product_color` (
  `sid` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color_list_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `product_color`
--

INSERT INTO `product_color` (`sid`, `product_id`, `color_list_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 2, 4),
(5, 3, 5),
(6, 3, 6),
(7, 4, 7),
(8, 4, 8),
(9, 5, 9),
(10, 5, 10),
(11, 6, 11),
(12, 6, 12),
(13, 7, 1),
(14, 7, 2),
(15, 8, 3),
(16, 8, 4),
(17, 9, 5),
(18, 9, 6),
(19, 10, 7),
(20, 10, 8),
(21, 11, 9),
(22, 11, 10),
(23, 12, 11),
(24, 12, 12),
(25, 13, 1),
(26, 13, 2),
(27, 14, 3),
(28, 14, 4),
(29, 15, 5),
(30, 15, 6),
(31, 16, 7),
(32, 16, 8),
(33, 17, 9),
(34, 17, 10),
(35, 18, 11),
(36, 18, 12),
(37, 19, 1),
(38, 19, 2),
(39, 20, 3),
(40, 20, 4),
(41, 21, 5),
(42, 21, 6),
(43, 22, 7),
(44, 22, 8),
(45, 23, 9),
(46, 23, 10),
(47, 24, 11),
(48, 24, 12),
(49, 25, 12),
(50, 25, 3);

-- --------------------------------------------------------

--
-- 資料表結構 `product_favorite`
--

CREATE TABLE `product_favorite` (
  `sid` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `product_favorite`
--

INSERT INTO `product_favorite` (`sid`, `product_id`, `member_id`, `created_at`) VALUES
(1, 1, 1, '2012-05-20 08:30:00'),
(2, 1, 2, '2015-09-10 14:22:00'),
(3, 1, 3, '2018-02-25 10:45:00'),
(4, 2, 4, '2011-07-14 18:12:00'),
(5, 2, 5, '2019-03-05 09:55:00'),
(6, 2, 6, '2013-11-30 12:30:00'),
(7, 3, 7, '2010-08-19 16:40:00'),
(8, 3, 8, '2016-04-28 20:18:00'),
(9, 3, 9, '2017-10-15 11:27:00'),
(10, 4, 10, '2014-06-02 14:05:00'),
(11, 4, 1, '2010-12-08 08:45:00'),
(12, 4, 2, '2013-02-22 19:30:00'),
(13, 5, 3, '2016-08-07 22:15:00'),
(14, 5, 4, '2011-04-15 17:40:00'),
(15, 5, 5, '2019-01-18 09:12:00'),
(16, 6, 6, '2014-03-21 14:55:00'),
(17, 6, 7, '2017-06-12 12:10:00'),
(18, 6, 8, '2010-11-27 15:28:00'),
(19, 7, 9, '2018-07-14 18:46:00'),
(20, 7, 10, '2012-09-22 23:30:00'),
(21, 7, 1, '2015-10-01 10:15:00'),
(22, 8, 2, '2013-12-18 08:50:00'),
(23, 8, 3, '2016-01-30 16:22:00'),
(24, 8, 4, '2019-08-01 21:05:00'),
(25, 9, 5, '2012-11-09 07:40:00'),
(26, 9, 6, '2015-04-14 13:25:00'),
(27, 9, 7, '2017-12-03 19:18:00'),
(28, 10, 8, '2011-06-05 11:33:00'),
(29, 10, 9, '2014-09-21 14:20:00'),
(30, 10, 10, '2018-10-11 18:10:00'),
(31, 11, 1, '2013-01-22 09:45:00'),
(32, 11, 2, '2016-02-03 22:30:00'),
(33, 11, 3, '2019-05-15 15:05:00'),
(34, 12, 4, '2012-07-10 08:40:00'),
(35, 12, 5, '2015-11-28 19:55:00'),
(36, 12, 6, '2018-04-22 11:22:00'),
(37, 13, 7, '2013-06-30 14:40:00'),
(38, 13, 8, '2016-08-14 17:18:00'),
(39, 13, 9, '2010-03-09 10:45:00'),
(40, 14, 10, '2017-04-25 21:30:00'),
(41, 14, 1, '2014-01-02 14:55:00'),
(42, 14, 2, '2011-12-15 08:20:00'),
(43, 15, 3, '2015-03-20 12:35:00'),
(44, 15, 4, '2018-09-10 18:10:00'),
(45, 15, 5, '2010-05-22 11:45:00'),
(46, 16, 6, '2013-08-11 16:30:00'),
(47, 16, 7, '2016-10-05 09:55:00'),
(48, 16, 8, '2019-02-28 20:40:00'),
(49, 17, 9, '2012-03-18 14:05:00'),
(50, 17, 10, '2015-06-22 17:30:00');

-- --------------------------------------------------------

--
-- 資料表結構 `product_image`
--

CREATE TABLE `product_image` (
  `sid` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `is_thumbnail` int(11) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `product_image`
--

INSERT INTO `product_image` (`sid`, `product_id`, `is_thumbnail`, `image_url`) VALUES
(1, 1, 1, 'image1.jpg'),
(2, 1, 0, 'image2.jpg'),
(3, 1, 0, 'image3.jpg'),
(4, 2, 1, 'image4.jpg'),
(5, 2, 0, 'image5.jpg'),
(6, 2, 0, 'image6.jpg'),
(7, 3, 1, 'image7.jpg'),
(8, 3, 0, 'image8.jpg'),
(9, 3, 0, 'image9.jpg'),
(10, 4, 1, 'image10.jpg'),
(11, 4, 0, 'image11.jpg'),
(12, 4, 0, 'image12.jpg'),
(13, 5, 1, 'image13.jpg'),
(14, 5, 0, 'image14.jpg'),
(15, 5, 0, 'image15.jpg'),
(16, 6, 1, 'image16.jpg'),
(17, 6, 0, 'image17.jpg'),
(18, 6, 0, 'image18.jpg'),
(19, 7, 1, 'image19.jpg'),
(20, 7, 0, 'image20.jpg'),
(21, 7, 0, 'image21.jpg'),
(22, 8, 1, 'image22.jpg'),
(23, 8, 0, 'image23.jpg'),
(24, 8, 0, 'image24.jpg'),
(25, 9, 1, 'image25.jpg'),
(26, 9, 0, 'image26.jpg'),
(27, 9, 0, 'image27.jpg'),
(28, 10, 1, 'image28.jpg'),
(29, 10, 0, 'image29.jpg'),
(30, 10, 0, 'image30.jpg'),
(31, 11, 1, 'image31.jpg'),
(32, 11, 0, 'image32.jpg'),
(33, 11, 0, 'image33.jpg'),
(34, 12, 1, 'image34.jpg'),
(35, 12, 0, 'image35.jpg'),
(36, 12, 0, 'image36.jpg'),
(37, 13, 1, 'image37.jpg'),
(38, 13, 0, 'image38.jpg'),
(39, 13, 0, 'image39.jpg'),
(40, 14, 1, 'image40.jpg'),
(41, 14, 0, 'image41.jpg'),
(42, 14, 0, 'image42.jpg'),
(43, 15, 1, 'image43.jpg'),
(44, 15, 0, 'image44.jpg'),
(45, 15, 0, 'image45.jpg'),
(46, 16, 1, 'image46.jpg'),
(47, 16, 0, 'image47.jpg'),
(48, 16, 0, 'image48.jpg'),
(49, 17, 1, 'image49.jpg'),
(50, 17, 0, 'image50.jpg');

-- --------------------------------------------------------

--
-- 資料表結構 `product_order`
--

CREATE TABLE `product_order` (
  `product_order_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `order_date` datetime NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `recipient` varchar(255) DEFAULT NULL,
  `shipping_address` varchar(255) DEFAULT NULL,
  `payment_id` int(11) NOT NULL,
  `order_status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `product_order`
--

INSERT INTO `product_order` (`product_order_id`, `member_id`, `coupon_id`, `order_date`, `shipping_id`, `recipient`, `shipping_address`, `payment_id`, `order_status_id`) VALUES
(1, 1, 3, '2013-12-05 12:30:00', 1, '芙莉蓮', '台北市信義區松高路', 1, 1),
(2, 2, 2, '2018-02-15 08:45:00', 1, '費倫', '新北市板橋區文化路', 2, 2),
(3, 3, 1, '2016-01-29 17:20:00', 1, '修塔爾克', '高雄市左營區博愛二路', 1, 1),
(4, 4, NULL, '2014-10-30 09:18:00', 1, '贊恩', '台中市西屯區青海路', 2, 2),
(5, 5, 1, '2012-08-19 14:56:00', 1, '欣梅爾', '桃園市中壢區環北路', 1, 1),
(6, 6, 3, '2015-02-16 21:40:00', 1, '海塔', '台南市東區裕忠路', 2, 2),
(7, 7, NULL, '2010-07-04 11:22:00', 1, '艾冉', '彰化縣彰化市中正路', 1, 1),
(8, 8, 2, '2011-12-30 18:10:00', 1, '修拉哈特', '新竹市東區光復路', 2, 2),
(9, 9, NULL, '2021-01-01 04:37:00', 1, '七崩賢', '嘉義市西區中山路', 1, 1),
(10, 10, 1, '2019-04-15 23:55:00', 1, '阿烏拉', '基隆市中正區義一路', 2, 2),
(11, 11, 2, '2013-08-29 06:12:00', 1, '坂田銀時', '新竹縣竹北市文化路', 1, 1),
(12, 12, 3, '2016-10-07 13:28:00', 1, '志村新八', '雲林縣斗六市大同路', 2, 2),
(13, 13, 3, '2014-01-25 09:03:00', 1, '神樂', '南投縣南投市中正路', 1, 1),
(14, 14, 1, '2013-01-01 15:45:00', 1, '桂小太郎', '花蓮縣花蓮市中山路', 2, 2),
(15, 15, NULL, '2022-08-10 20:11:00', 1, '沖田總悟', '宜蘭縣宜蘭市康樂路', 1, 1),
(16, 16, 2, '2017-07-23 03:26:00', 1, '土方十四郎', '澎湖縣馬公市新店路', 2, 2),
(17, 17, 2, '2011-11-07 08:57:00', 1, '神樂麗', '屏東縣屏東市和平路', 1, 1),
(18, 18, 1, '2013-03-18 16:33:00', 1, '近藤勳', '金門縣金城鎮民生路', 2, 2),
(19, 19, 3, '2012-05-18 22:48:00', 1, NULL, NULL, 1, 1),
(20, 20, NULL, '2017-04-01 05:14:00', 1, NULL, NULL, 2, 2),
(21, 21, NULL, '2020-01-21 10:38:00', 1, NULL, NULL, 1, 1),
(22, 22, 2, '2014-12-04 14:02:00', 1, NULL, NULL, 2, 2),
(23, 23, 3, '2018-08-09 19:50:00', 1, NULL, NULL, 1, 1),
(24, 24, 1, '2014-09-14 01:58:00', 1, NULL, NULL, 2, 2),
(25, 25, NULL, '2015-02-08 07:32:00', 2, NULL, NULL, 1, 1),
(26, 26, NULL, '2019-04-05 13:47:00', 2, NULL, NULL, 2, 2),
(27, 27, 2, '2023-12-31 22:05:00', 2, NULL, NULL, 3, 1),
(28, 28, 1, '2014-01-28 04:23:00', 2, NULL, NULL, 1, 2),
(29, 29, 3, '2017-02-13 11:09:00', 2, '漩渦鳴人', '基隆市仁愛區南榮路', 2, 1),
(30, 30, NULL, '2010-11-04 16:47:00', 2, '宇智波佐助', '新竹市北區中正路', 3, 2),
(31, 31, 3, '2015-11-01 02:34:00', 2, '春野櫻', '台南市北區成功路', 1, 1),
(32, 32, 1, '2016-01-29 17:20:00', 2, '我愛羅', '台北市大安區忠孝東路', 2, 2),
(33, 33, 2, '2018-10-16 23:57:00', 2, '自來也', '高雄市前鎮區民權二路', 3, 1),
(34, 34, NULL, '2012-06-25 18:25:00', 2, '日向雛田', '桃園市龜山區文化二路', 1, 2),
(35, 35, 2, '2011-09-10 02:52:00', 2, '旗木卡卡西', '彰化縣北斗鎮中山路', 2, 1),
(36, 36, 1, '2022-07-04 07:19:00', 2, '綱手', '嘉義市東區忠孝路', 3, 2),
(37, 37, NULL, '2014-04-30 14:36:00', 2, '藥師兜', '屏東縣潮州鎮光復路', 1, 1),
(38, 38, 3, '2012-12-23 20:50:00', 2, '奈良鹿丸', '台中市南區建國北路', 2, 2),
(39, 39, 1, '2014-01-20 06:05:00', 2, '大蛇丸', '雲林縣虎尾鎮中山路', 3, 1),
(40, 40, NULL, '2022-12-22 12:14:00', 2, '犬塚牙', '台東縣成功鎮中興路', 1, 2),
(41, 41, 3, '2016-05-16 01:31:00', 2, '洛伊德佛傑', '新北市三峽區復興路', 2, 1),
(42, 42, 2, '2018-07-27 09:08:00', 2, '安妮亞佛傑', '新竹縣湖口鄉中山路', 3, 2),
(43, 43, 1, '2017-02-27 15:43:00', 2, '約兒佛傑', '高雄市鳳山區文化路', 1, 1),
(44, 44, NULL, '2011-06-06 21:56:00', 2, '彭德佛傑', '台南市永康區中正路', 2, 2),
(45, 45, 2, '2023-10-25 03:12:00', 2, '達米安戴斯蒙德', '台中市豐原區中山路', 3, 1),
(46, 46, 3, '2015-06-15 09:30:00', 2, '貝琪布萊克貝爾', '彰化縣和美鎮民族路', 1, 2),
(47, 47, 1, '2013-04-09 16:05:00', 2, NULL, NULL, 2, 1),
(48, 48, NULL, '2013-11-16 22:19:00', 2, NULL, NULL, 3, 2),
(49, 49, NULL, '2013-12-07 03:13:00', 2, NULL, NULL, 2, 2),
(50, 50, 1, '2014-12-07 03:13:00', 2, NULL, NULL, 3, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `product_order_detail`
--

CREATE TABLE `product_order_detail` (
  `product_order_detail_id` int(11) NOT NULL,
  `product_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `order_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `product_order_detail`
--

INSERT INTO `product_order_detail` (`product_order_detail_id`, `product_order_id`, `product_id`, `order_quantity`, `order_number`) VALUES
(1, 1, 1, 45, 'P20240123001'),
(2, 2, 2, 25, 'P20240123002'),
(3, 2, 3, 3, 'P20240123003'),
(4, 3, 4, 6, 'P20240123004'),
(5, 3, 5, 3, 'P20240123005'),
(6, 3, 6, 56, 'P20240123006'),
(7, 4, 7, 23, 'P20240123007'),
(8, 4, 8, 12, 'P20240123008'),
(9, 4, 9, 2, 'P20240123009'),
(10, 4, 10, 45, 'P20240123010'),
(11, 5, 11, 1, 'P20240123011'),
(12, 5, 12, 3, 'P20240123012'),
(13, 5, 13, 5, 'P20240123013'),
(14, 5, 14, 7, 'P20240123014'),
(15, 5, 15, 9, 'P20240123015'),
(16, 6, 16, 2, 'P20240123016'),
(17, 7, 17, 4, 'P20240123017'),
(18, 7, 18, 6, 'P20240123018'),
(19, 8, 19, 8, 'P20240123019'),
(20, 8, 20, 10, 'P20240123020'),
(21, 8, 21, 11, 'P20240123021'),
(22, 9, 22, 13, 'P20240123022'),
(23, 9, 23, 15, 'P20240123023'),
(24, 9, 24, 17, 'P20240123024'),
(25, 9, 25, 19, 'P20240123025'),
(26, 10, 26, 21, 'P20240123026'),
(27, 10, 27, 23, 'P20240123027'),
(28, 10, 28, 25, 'P20240123028'),
(29, 10, 29, 27, 'P20240123029'),
(30, 10, 30, 29, 'P20240123030'),
(31, 11, 31, 12, 'P20240123031'),
(32, 12, 32, 14, 'P20240123032'),
(33, 12, 33, 16, 'P20240123033'),
(34, 13, 34, 18, 'P20240123034'),
(35, 13, 35, 20, 'P20240123035'),
(36, 13, 36, 22, 'P20240123036'),
(37, 14, 37, 24, 'P20240123037'),
(38, 14, 38, 26, 'P20240123038'),
(39, 14, 39, 28, 'P20240123039'),
(40, 14, 40, 30, 'P20240123040'),
(41, 15, 41, 32, 'P20240123041'),
(42, 15, 42, 34, 'P20240123042'),
(43, 15, 43, 36, 'P20240123043'),
(44, 15, 44, 38, 'P20240123044'),
(45, 15, 45, 40, 'P20240123045'),
(46, 16, 46, 42, 'P20240123046'),
(47, 17, 47, 44, 'P20240123047'),
(48, 17, 48, 46, 'P20240123048'),
(49, 18, 49, 48, 'P20240123049'),
(50, 18, 50, 50, 'P20240123050');

-- --------------------------------------------------------

--
-- 資料表結構 `product_review`
--

CREATE TABLE `product_review` (
  `product_review_id` int(11) NOT NULL,
  `product_order_detail_id` int(11) NOT NULL,
  `star_rating` int(11) NOT NULL,
  `text_review` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `product_review`
--

INSERT INTO `product_review` (`product_review_id`, `product_order_detail_id`, `star_rating`, `text_review`, `created_at`) VALUES
(1, 1, 1, NULL, '2020-06-07 03:14:00'),
(2, 2, 4, '質量優良，耐用性強。', '2015-11-04 17:56:00'),
(3, 3, 2, '造型時尚，符合潮流。', '2021-06-16 19:09:00'),
(4, 4, 5, '多功能設計，實用性高。', '2014-12-01 11:58:00'),
(5, 5, 3, '經濟實惠，性價比高。', '2019-04-27 04:23:00'),
(6, 6, 1, NULL, '2016-03-08 21:51:00'),
(7, 7, 2, '操作簡單，適合初學者。', '2018-06-23 07:35:00'),
(8, 8, 5, '視覺吸引，搭配裝飾性好。', '2017-02-08 12:48:00'),
(9, 9, 3, '環保材料，符合綠色生活。', '2015-07-10 14:33:00'),
(10, 10, 4, '產品設計新穎，引人注目。', '2020-09-03 08:10:00'),
(11, 11, 2, '安全可靠，使用放心。', '2022-05-06 05:02:00'),
(12, 12, 5, NULL, '2020-05-30 14:05:00'),
(13, 13, 1, NULL, '2015-10-31 14:05:00'),
(14, 14, 3, '精湛工藝，品質保證。', '2021-06-08 14:05:00'),
(15, 15, 4, '靈活適應各種場合。', '2014-11-26 14:05:00'),
(16, 16, 5, '提供舒適體驗，符合人體工學。', '2019-04-18 14:05:00'),
(17, 17, 2, '具有創新功能，獨特性強。', '2016-02-28 14:05:00'),
(18, 18, 3, '操作流暢，使用感良好。', '2018-06-14 14:05:00'),
(19, 19, 1, '強大性能，滿足需求。', '2017-02-01 14:05:00'),
(20, 20, 4, '精細包裝，送禮首選。', '2015-07-03 14:05:00'),
(21, 21, 1, '高度耐用，長壽命。', '2020-08-27 14:05:00'),
(22, 22, 3, '高效節能，環保理念。', '2022-04-29 14:05:00'),
(23, 23, 5, '簡約時尚，簡單易配。', '2022-04-12 06:59:00'),
(24, 24, 4, '高度便捷，提升生活品質。', '2014-12-20 10:42:00'),
(25, 25, 2, '操作靈敏，反應迅速。', '2017-04-30 00:36:00'),
(26, 26, 5, NULL, '2015-09-07 08:26:00'),
(27, 27, 1, '輕松搭配，增添居家氛圍。', '2018-08-22 07:12:00'),
(28, 28, 3, '防水防潮，適用多環境。', '2014-06-15 21:35:00'),
(29, 29, 4, '低噪音設計，使用安靜。', '2019-03-25 17:20:00'),
(30, 30, 2, NULL, '2020-11-09 07:09:00'),
(31, 31, 5, NULL, '2021-12-11 05:24:00'),
(32, 32, 3, NULL, '2022-06-01 23:16:00'),
(33, 33, 1, '高效省力，提高工作效率。', '2018-02-02 03:55:00'),
(34, 34, 4, '外觀美觀，增添空間氛圍。', '2016-07-01 14:18:00'),
(35, 35, 2, '高度靈活，滿足不同需求。', '2015-04-29 18:54:00'),
(36, 36, 5, '超值套裝，物超所值。', '2020-11-02 00:45:00'),
(37, 37, 3, '高度可靠，品質保障。', '2015-02-24 07:28:00'),
(38, 38, 1, '耐用性強，使用壽命長。', '2019-10-14 08:15:00'),
(39, 39, 4, '產品精良，細節考究。', '2014-11-07 17:47:00'),
(40, 40, 2, '精緻工藝，品質一流。', '2017-01-17 02:29:00'),
(41, 41, 3, '配色考究，搭配性佳。', '2022-01-22 19:17:00'),
(42, 42, 5, NULL, '2016-05-23 21:11:00'),
(43, 43, 1, NULL, '2018-11-29 00:46:00'),
(44, 44, 4, NULL, '2017-09-11 10:27:00'),
(45, 45, 2, '質感出眾，展現品味。', '2019-07-14 15:45:00'),
(46, 46, 5, '有效解決問題，實用性強。', '2021-02-23 00:05:00'),
(47, 47, 3, '穩定性佳，使用安全。', '2016-03-15 22:33:00'),
(48, 48, 1, '創新科技，引領潮流。', '2015-11-15 17:02:00'),
(49, 49, 4, '易於清潔，保持衛生。', '2023-09-26 14:13:00'),
(50, 50, 2, '高效充電，省時省力。', '2024-04-29 18:54:00');

-- --------------------------------------------------------

--
-- 資料表結構 `product_store`
--

CREATE TABLE `product_store` (
  `sid` int(11) NOT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `store_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `product_store`
--

INSERT INTO `product_store` (`sid`, `product_id`, `store_id`) VALUES
(1, '1', '1'),
(2, '1', '2'),
(3, '1', '3'),
(4, '1', '4'),
(5, '1', '5'),
(6, '2', '2'),
(7, '2', '3'),
(8, '2', '4'),
(9, '2', '5'),
(10, '2', '6'),
(11, '3', '3'),
(12, '3', '4'),
(13, '3', '5'),
(14, '3', '6'),
(15, '3', '7'),
(16, '4', '4'),
(17, '4', '5'),
(18, '4', '6'),
(19, '4', '7'),
(20, '4', '8'),
(21, '5', '1'),
(22, '5', '2'),
(23, '5', '3'),
(24, '5', '4'),
(25, '5', '5'),
(26, '6', '2'),
(27, '6', '3'),
(28, '6', '4'),
(29, '6', '5'),
(30, '6', '6'),
(31, '7', '3'),
(32, '7', '4'),
(33, '7', '5'),
(34, '7', '6'),
(35, '7', '7'),
(36, '8', '4'),
(37, '8', '5'),
(38, '8', '6'),
(39, '8', '7'),
(40, '8', '8'),
(41, '9', '1'),
(42, '9', '2'),
(43, '9', '3'),
(44, '9', '4'),
(45, '9', '5'),
(46, '10', '2'),
(47, '10', '3'),
(48, '10', '4'),
(49, '10', '5'),
(50, '10', '6');

-- --------------------------------------------------------

--
-- 資料表結構 `shipping`
--

CREATE TABLE `shipping` (
  `shipping_id` int(11) NOT NULL,
  `shipping_method` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `shipping`
--

INSERT INTO `shipping` (`shipping_id`, `shipping_method`) VALUES
(1, '宅配'),
(2, '自取');

-- --------------------------------------------------------

--
-- 資料表結構 `store`
--

CREATE TABLE `store` (
  `store_id` int(11) NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `store_account` varchar(255) NOT NULL,
  `store_password` varchar(255) NOT NULL,
  `store_intro` varchar(255) DEFAULT NULL,
  `store_address` varchar(255) DEFAULT NULL,
  `store_path` varchar(255) DEFAULT NULL,
  `store_email` varchar(255) DEFAULT NULL,
  `store_tel` varchar(255) DEFAULT NULL,
  `sub_date` date DEFAULT NULL,
  `sub_id` int(11) DEFAULT NULL,
  `permission_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `store`
--

INSERT INTO `store` (`store_id`, `store_name`, `store_account`, `store_password`, `store_intro`, `store_address`, `store_path`, `store_email`, `store_tel`, `sub_date`, `sub_id`, `permission_id`) VALUES
(1, 'admin', 'admin', '$2y$10$4XFIdw2B91YcnDWe8gJDMeeEJY9CI2ItSki1SwXJCoxpT3OKkuiBS', 'manager', '桃園市中壢區中華路二段150號', 'https://www.emeraldfloral.com', 'admin@gmail.com', '0911-111-1111', '2024-01-01', 4, 1),
(2, '花姿妍', 'store02', '$2y$10$XBxNRIfEwmdLNP5.X48BMO1BgXFuHlql3bDE20fqM95HOylfwDOw6', 'springbreeze', '台北市大安區忠孝東路一段123號', 'https://www.springbreeze.com', 'testemail1@example.com', '0921-234-567', '2024-01-06', 2, 2),
(3, '春之調', 'store03', '$2y$10$VkBLLq6WMLP1YUzkVNL9y.JGxSUuv4pUgBJn2aGsC5ZRK29j38Zia', 'flowercastle', '新北市板橋區文化路456巷78號', 'https://www.flowercastle.com', 'samplemail2@gmail.com', '0934-567-890', '2024-01-07', 1, 2),
(4, '花語藝', 'store04', '$2y$10$mzCzbaBs1wj3rEtjpL1guOlDjY7s1sXkuJ39WrDPreJQt4gQ2KwHm', 'cloudflorist', '台中市西屯區惠來路234號', 'https://www.cloudflorist.com', 'demo.email3@yahoo.com', '0987-123-456', '2024-01-07', 3, 2),
(5, '綻放花藝', 'store05', '$2y$10$yfBsDnFokbduP6steh9tTOlKZH/CZe0QtJzYVmzl9y5zh736mI/tS', 'emeraldfloral', '高雄市前鎮區中山東路56巷78號', 'https://www.emeraldfloral.com', 'usermail4@hotmail.com', '0912-345-678', '2024-01-07', 2, 2),
(6, '翠綠花苑', 'sample2024', '8AlphaBeta$', 'flowercottage', '桃園市中壢區中正路890號', 'https://www.flowercottage.com', 'example.email5@outlook.com', '0978-654-321', '2024-01-08', 1, 2),
(7, '花漾坊', 'account12', 'Test2022!', 'flowermoment', '台南市東區崇善路12巷34號', 'https://www.flowermoment.com', 'mockmail6@mail.com', '0943-210-987', '2024-01-08', 3, 2),
(8, '花意濃', 'securePass8', '@ccount567', 'flowerlanguage', '彰化縣彰化市光復路56號', 'https://www.flowerlanguage.com', 'testuser7@protonmail.com', '0965-432-109', '2024-01-08', 2, 2),
(9, '花卉匯', 'login2023', 'P@ssword45', 'floristmatchmaker', '基隆市信義區中正路789號', 'https://www.matchmaker.com', 'dummyemail8@icloud.com', '0901-876-543', '2024-01-09', 1, 2),
(10, '花間藝術', 'access22', '16DemoUser#', 'fragrantblossoms', '新竹市東區光復路34巷56號', 'https://www.blossoms.com', 'maildemo9@live.com', '0956-789-012', '2024-01-09', 2, 2),
(11, '星夢花苑', '3UserDemo', '3AccessPass', 'flowerlovestory', '嘉義市西區公園路789號', 'https://www.lovestory.com', 'userexample10@gmail.com', '0990-123-456', '2024-01-09', 3, 2),
(12, '花影時光', 'alphaBeta45', 'User789!abc', 'stellarnursery', '新北市三重區重新路234號', 'https://www.stellarnursery.com', 'testmail11@yahoo.com.tw', '0911-234-567', '2024-01-10', 1, 2),
(13, '花千谷', '789testUser', 'PassWord22$', 'flowerfullday', '高雄市左營區博愛路56號', 'https://www.fullbloom.com', 'sample.email12@hotmail.com', '0976-543-210', '2024-01-10', 2, 2),
(14, '花翩翩', 'pass123word', 'Secure2024@', 'gardenofflowers', '台中市北屯區北平路78號', 'https://www.gardenofflowers.com', 'demo.mail13@outlook.com', '0923-456-789', '2024-01-10', 3, 2),
(15, '花韻閣', '2024DemoUser', 'Demo#User2023', 'dreamyflowers', '台南市中西區民權路12巷34號', 'https://www.dreamyflowers.com', 'user.test14@mail.com', '0945-678-901', '2024-01-11', 2, 2),
(16, '花之舞', 'myAcc0unt', '789MyAcc!', 'colorfulbloom', '桃園市龜山區文青路890號', 'https://www.colorfulbloom.com', 'example15@protonmail.com', '0980-123-456', '2024-01-11', 1, 2),
(17, '花藝空間', 'userPass456', 'P@ss456Word', 'flowerwander', '台東縣台東市中華路56號', 'https://www.wanderlustflowers.com', 'mock.email16@icloud.com', '0932-345-678', '2024-01-11', 3, 2),
(18, '繽紛花屋', '2023example', 'Example2023$', 'melodyofpetals', '宜蘭縣宜蘭市和平路78號', 'https://www.melodyofpetals.com', 'testuser17@live.com', '0998-765-432', '2024-01-12', 2, 2),
(19, '花開時節', 'demoUser321', 'User@Demo321', 'gardenretreat', '花蓮縣花蓮市博愛街234號', 'https://www.gardenretreat.com', 'dummy.mail18@gmail.com', '0910-987-654', '2024-01-12', 1, 2),
(20, '美好花房', 'accessPass88', '123Acc!Word', 'cityofflowers', '苗栗縣苗栗市民生路56號', 'https://www.cityofflowers.com', 'mailtest19@yahoo.com', '0954-321-098', '2024-01-12', 3, 2),
(21, '花馨藝庭', 'secureAcc45', 'Secur3Pass', 'bloomingspectacle', '金門縣金城鎮民生路78號', 'https://www.bloomingfireworks.com', 'user.sample20@hotmail.com', '0967-890-123', '2024-01-13', 2, 2),
(22, '花意蕾', 'alphaDemo22', 'Alpha22Demo$', 'treasureofblossoms', '屏東縣屏東市大同路12號', 'https://www.treasureofblossoms.com', 'examplemail21@outlook.com', '0939-012-345', '2024-01-13', 1, 2),
(23, '花翠園', 'test2023User', 'TestUser2023!', 'enchantedfloraljourney', '澎湖縣馬公市民生路34號', 'https://www.floraljourney.com', 'demomail22@mail.com', '0906-543-210', '2024-01-13', 3, 2),
(24, '花羽韻', '123PassDemo', '1234#PassDemo', 'whispersofpetals', '基隆市中正區和平路890號', 'https://www.whispersofpetals.com', 'test.email23@protonmail.com', '0981-234-567', '2024-01-14', 2, 2),
(25, '花綻放', 'mySecure1', 'MySecur1ty', 'joyfulbouquet', '新竹市北區光華路56號', 'https://www.joyfulbouquet.com', 'userdummy24@icloud.com', '0924-567-890', '2024-01-15', 3, 2),
(26, '花謠詩', 'userAccount7', 'UserAcc7ount', 'bloomsofaffection', '嘉義市東區中山路78號', 'https://www.bloomsofaffection.com', 'mailuser25@live.com', '0977-890-123', '2024-01-15', 1, 2),
(27, '花之境', 'sampleDemo88', 'SampleDemo88@', 'harmonyofflowers', '南投縣南投市民權路234號', 'https://www.harmonyofflowers.com', 'sampletest26@gmail.com', '0942-345-678', '2024-01-15', 2, 2),
(28, '花樂府', '2024PassWord', '2024Pass!Word', 'fragrantavenue', '台北市中正區仁愛路12巷34號', 'https://www.fragrantavenue.com', 'demomail27@yahoo.com.tw', '0955-678-901', '2024-01-16', 1, 2),
(29, '花漫遊', 'secureTest1', 'S3cureT3st1', 'melodiousblossoms', '台東縣成功鎮中山路56號', 'https://www.melodiousblossoms.com', 'email.test28@hotmail.com', '0919-012-345', '2024-01-16', 3, 2),
(30, '花意婉', 'user12345678', 'User1234!5678', 'dreamgateflowers', '宜蘭縣羅東鎮公園路78號', 'https://www.dreamgateflowers.com', 'user.example29@outlook.com', '0966-543-210', '2024-01-16', 2, 2),
(31, '花境雅庭', 'passWordTest', '789P@ssWord', 'pureblossomgarden', '花蓮縣壽豐鄉中正路890號', 'https://www.pureblossomgarden.com', 'maildemo30@mail.com', '0992-345-678', '2024-01-17', 3, 2),
(32, '花韻坊', 'alpha789Beta', 'Alpha789Bet@#', 'starseedflorals', '苗栗縣頭份市文明路56號', 'https://www.starseedflorals.com', 'sample.user31@protonmail.com', '0913-456-789', '2024-01-17', 1, 2),
(33, '花意盎然', 'test2022Acc', 'Test2022Acc!', 'blossomgala', '金門縣金湖鎮中正路78號', 'https://www.blossomgala.com', 'emailmock32@icloud.com', '0986-789-012', '2024-01-17', 2, 2),
(34, '花夢蕾', '45DemoUser', 'Demo45!User', 'elegantfloralharmony', '屏東縣恆春鎮民生路234號', 'https://www.elegantfloralharmony.com', 'testmail33@live.com', '0941-234-567', '2024-01-18', 3, 2),
(35, '花姿悅', 'secure123Pass', 'Secur3P@ss', 'poeticpetalverse', '澎湖縣白沙鄉和平路56號', 'https://www.poeticpetalverse.com', 'userdummy34@gmail.com', '0974-567-890', '2024-01-18', 2, 2),
(36, '花樹時光', 'login2024Acc', 'L0gin2024A@', 'danceofpetals', '基隆市仁愛區中華路78號', 'https://www.danceofpetals.com', 'example.mail35@yahoo.com', '0938-901-234', '2024-01-18', 1, 2),
(37, '花夢境', 'myPass789', 'Myp@ss789', 'colorfultunefulblooms', '新竹市香山區民權路12號', 'https://www.colorfultunefulblooms.com', 'demomail36@hotmail.com', '0951-234-567', '2024-01-19', 3, 2),
(38, '花蔚藝術', 'userDemo2022', 'UserDemo2022!', 'symphonyofflowerlanguage', '嘉義市西區文化路34號', 'https://www.symphonyofflowerlanguage.com', 'testuser37@outlook.com', '0926-567-890', '2024-01-19', 2, 2),
(39, '花心曲', '2023Secure', '2023S3cure', 'fantasyofflowers', '南投縣埔里鎮博愛街890號', 'https://www.fantasyofflowers.com', 'mailsample38@mail.com', '0909-012-345', '2024-01-19', 1, 2),
(40, '花瑩藝庭', 'alpha456beta', 'Alpha!456Beta', 'nightblooms', '台北市萬華區中山路56號', 'https://www.nightblooms.com', 'user.demo39@protonmail.com', '0964-567-890', '2024-01-20', 3, 2),
(41, '花影樓', 'demo789user', 'Demo789User@', 'secretgardenofflowers', '台東縣池上鄉民生路78號', 'https://www.secretgardenofflowers.com', 'exampledummy40@icloud.com', '0997-890-123', '2024-01-20', 2, 2),
(42, '花音響', 'access123Pass', 'Access1!23Pass', 'allureofblossoms', '宜蘭縣冬山鄉仁愛路234號', 'https://www.allureofblossoms.com', 'test.email41@live.com', '0915-678-901', '2024-01-20', 1, 2),
(43, '花幻夢', 'mySecureDemo', 'MyS3cureD3mo', 'journeythroughpetals', '花蓮縣光復鄉公園路56號', 'https://www.journeythroughpetals.com', 'samplemail42@gmail.com', '0940-123-456', '2024-01-21', 3, 2),
(44, '花心曲', '2022testUser', '2022T3stUser', 'taleofflowerlanguage', '苗栗縣苑裡鎮民權路78號', 'https://www.taleofflowerlanguage.com', 'demo.email43@yahoo.com.tw', '0983-456-789', '2024-01-21', 2, 2),
(45, '花樂章', 'passWord789', 'Pass789!Word', 'enchantingdreamsofblossoms', '金門縣烈嶼鄉中正路890號', 'https://www.enchantingdreamsofblossoms.com', 'usermail44@hotmail.com', '0936-789-012', '2024-01-22', 1, 2),
(46, '花意梵', 'secure456acc', 'Secur456eAcc', 'gardenofblessings', '屏東縣車城鄉和平路56號', 'https://www.gardenofblessings.com', 'example.email45@outlook.com', '0959-012-345', '2024-01-22', 3, 2),
(47, '花語薈', 'alphaPass789', 'AlphaP@ss789', 'miraculousfloralmessages', '澎湖縣西嶼鄉民生路78號', 'https://www.miraculousfloralmessages.com', 'mockmail46@mail.com', '0902-345-678', '2024-01-22', 2, 2),
(48, '花舞姿', 'user12345acc', 'User123!45A', 'emotionallivingflowers', '基隆市安樂區中華路234號', 'https://www.emotionallivingflowers.com', 'testuser47@protonmail.com', '0968-901-234', '2024-01-23', 1, 2),
(49, '花夢語', 'myDemo789', 'MyDemo789!', 'melodiclanguageofflowers', '新竹市東區光華路56號', 'https://www.melodiclanguageofflowers.com', 'dummyemail48@icloud.com', '0993-456-789', '2024-01-23', 2, 2),
(50, '花綺夢', 'accPass2022', 'Acc!Pass2022', 'encounterwithfragrance', '嘉義市東區博愛街78號', 'https://www.encounterwithfragrance.com', 'maildemo49@live.com', '0925-678-901', '2024-01-23', 3, 2),
(51, '花繽紛', 'testUser1234', 'T3stUser1234', 'Blossom Harmony', '南投縣魚池鄉文化路890號', 'https://www.blossomharmony.com', 'userexample50@gmail.com', '0972-345-678', '2024-01-06', 2, 2),
(52, '花香坊', '2023SecurePass', '2023S3cur3P@ss', 'Petal Dreams', '台北市松山區民權路56號', 'https://www.petaldreams.com', 'testmail51@yahoo.com', '0917-890-123', '2024-01-07', 2, 2),
(53, '花影誼', 'alphaDemo456', 'Alpha!D3mo456', 'Fragrance Encounter', '台東縣太麻里鄉公園路78號', 'https://www.fragranceencounter.com', 'sample.email52@hotmail.com', '0949-012-345', '2024-01-07', 3, 2),
(54, '花香滿座', 'passWordDemo1', 'PassWordD3mo1', 'Affectionate Blooms', '宜蘭縣頭城鎮仁愛路234號', 'https://www.affectionateblooms.com', 'demo.mail53@outlook.com', '0982-345-678', '2024-01-07', 3, 2),
(55, '花藝家', 'user789Demo', 'User789D3mo', 'Floral Whispers', '花蓮縣秀林鄉博愛街56號', 'https://www.floralwhispers.com', 'user.test54@mail.com', '0935-678-901', '2024-01-08', 1, 2),
(56, '花間曲', 'secureTest123', 'Secur3T3st123', 'Blooming Fantasy', '苗栗縣三義鄉民生路78號', 'https://www.bloomingfantasy.com', 'example55@protonmail.com', '0996-789-012', '2024-01-08', 1, 2),
(57, '花夢實', 'alpha1234beta', 'Alpha!123Beta', 'Melodic Gardens', '金門縣金寧鄉中正路890號', 'https://www.melodickgardens.com', 'mock.email56@icloud.com', '0918-901-234', '2024-01-08', 2, 2),
(58, '花蕊舞', '2022userPass', '2022U$erPass', 'Garden Spectacle', '屏東縣枋寮鄉和平路56號', 'https://www.gardenspectacle.com', 'testuser57@live.com', '0963-456-789', '2024-01-09', 1, 2),
(59, '花之樂', 'pass789word', 'Pass789!Word', 'Secret Blossom Retreat', '澎湖縣湖西鄉民生路78號', 'https://www.secretblossomretreat.com', 'dummy.mail58@gmail.com', '0948-901-234', '2024-01-09', 2, 2),
(60, '花枝俏', 'demo456Acc', 'Demo456!Acc', 'Enchanted Floral Avenue', '基隆市中山區中華路234號', 'https://www.enchantedfloralavenue.com', 'mailtest59@yahoo.com', '0971-234-567', '2024-01-09', 1, 2),
(61, '花幻影', 'accessDemo123', 'AccessD3mo123@', 'Joyful Floral Gala', '新竹市南區光復路56號', 'https://www.joyfulfloralgala.com.com', 'user.sample60@hotmail.com', '0904-567-890', '2024-01-10', 3, 2);

-- --------------------------------------------------------

--
-- 資料表結構 `store_permission`
--

CREATE TABLE `store_permission` (
  `permission_id` int(11) NOT NULL,
  `permission_position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `store_permission`
--

INSERT INTO `store_permission` (`permission_id`, `permission_position`) VALUES
(1, '管理者'),
(2, '賣家');

-- --------------------------------------------------------

--
-- 資料表結構 `store_stock_quantity`
--

CREATE TABLE `store_stock_quantity` (
  `stock_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_current_quantity` int(11) NOT NULL,
  `purchase_quantity` int(11) NOT NULL,
  `purchase_time` date NOT NULL,
  `store_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `store_stock_quantity`
--

INSERT INTO `store_stock_quantity` (`stock_id`, `product_id`, `product_name`, `product_current_quantity`, `purchase_quantity`, `purchase_time`, `store_id`) VALUES
(1, 1, '非洲堇', 550, 600, '2024-01-01', 2),
(2, 2, '玫瑰丹薇粉', 500, 550, '2024-01-01', 2),
(3, 3, '絲纓花科', 450, 500, '2024-01-01', 2),
(4, 4, '白烏帽子', 400, 450, '2024-01-01', 3),
(5, 5, '園藝剪刀', 350, 400, '2024-01-01', 3);

-- --------------------------------------------------------

--
-- 資料表結構 `store_sub`
--

CREATE TABLE `store_sub` (
  `sub_id` int(11) NOT NULL,
  `sub_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `store_sub`
--

INSERT INTO `store_sub` (`sub_id`, `sub_name`, `price`) VALUES
(1, '1個月', 100),
(2, '6個月', 500),
(3, '12個月', 1000),
(4, '永久', 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- 資料表索引 `color_list`
--
ALTER TABLE `color_list`
  ADD PRIMARY KEY (`color_list_id`);

--
-- 資料表索引 `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `fk_c_category_id` (`category_id`),
  ADD KEY `fk_c_store_id` (`store_id`);

--
-- 資料表索引 `course_category`
--
ALTER TABLE `course_category`
  ADD PRIMARY KEY (`category_id`);

--
-- 資料表索引 `course_datetime`
--
ALTER TABLE `course_datetime`
  ADD PRIMARY KEY (`date_id`);

--
-- 資料表索引 `course_favorite`
--
ALTER TABLE `course_favorite`
  ADD PRIMARY KEY (`favorite_id`),
  ADD KEY `fk_c_favorite_course_id` (`course_id`),
  ADD KEY `fk_c_favorite_member_id` (`member_id`);

--
-- 資料表索引 `course_image`
--
ALTER TABLE `course_image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `fk_c_image_course_id` (`course_id`);

--
-- 資料表索引 `course_info_date`
--
ALTER TABLE `course_info_date`
  ADD PRIMARY KEY (`date_id`,`course_id`) USING BTREE,
  ADD KEY `fk_c_info_date_course_id` (`course_id`);

--
-- 資料表索引 `course_news`
--
ALTER TABLE `course_news`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `fk_c_news_course_id` (`course_id`);

--
-- 資料表索引 `course_order`
--
ALTER TABLE `course_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_c_order_course_id` (`course_id`),
  ADD KEY `fk_c_order_member_id` (`member_id`),
  ADD KEY `fk_c_order_status_id` (`order_status`),
  ADD KEY `fk_c_order_payment_id` (`payment_method`),
  ADD KEY `fk_c_order_coupon_id` (`coupon_id`);

--
-- 資料表索引 `course_qa`
--
ALTER TABLE `course_qa`
  ADD PRIMARY KEY (`qa_id`),
  ADD KEY `fk_c_qa_course_id` (`course_id`),
  ADD KEY `fk_c_qa_member_id` (`member_id`);

--
-- 資料表索引 `course_rating`
--
ALTER TABLE `course_rating`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `fk_c_rating_course_id` (`course_id`),
  ADD KEY `fk_c_rating_member_id` (`member_id`);

--
-- 資料表索引 `custom_orders`
--
ALTER TABLE `custom_orders`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `payment_method` (`payment_method`),
  ADD KEY `fk_cu_shipping_id` (`shipping_id`),
  ADD KEY `fk_cu_order_status` (`order_status`),
  ADD KEY `fk_cu_member_id` (`member_id`),
  ADD KEY `fk_cu_store_id` (`store_id`),
  ADD KEY `fk_cu_shipping_method` (`shipping_method`);

--
-- 資料表索引 `custom_products`
--
ALTER TABLE `custom_products`
  ADD PRIMARY KEY (`product_id`);

--
-- 資料表索引 `custom_product_list`
--
ALTER TABLE `custom_product_list`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `idx_cu_store_id` (`store_id`),
  ADD KEY `fk_cp_stock_id` (`product_stock`);

--
-- 資料表索引 `custom_stock_status`
--
ALTER TABLE `custom_stock_status`
  ADD PRIMARY KEY (`stock_id`);

--
-- 資料表索引 `custom_templates`
--
ALTER TABLE `custom_templates`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `color_id` (`color_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `occ_id` (`occ_id`),
  ADD KEY `stock_status` (`stock_status`),
  ADD KEY `template_id` (`template_id`);

--
-- 資料表索引 `custom_template_detail`
--
ALTER TABLE `custom_template_detail`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `fk_td_template_id` (`template_id`),
  ADD KEY `fk_td_color_id` (`color_id`),
  ADD KEY `fk_td_product_id` (`product_id`);

--
-- 資料表索引 `intro_flower`
--
ALTER TABLE `intro_flower`
  ADD PRIMARY KEY (`flower_id`);

--
-- 資料表索引 `intro_flower_color`
--
ALTER TABLE `intro_flower_color`
  ADD PRIMARY KEY (`flower_color_id`),
  ADD KEY `flower_id` (`flower_id`);

--
-- 資料表索引 `intro_flower_image`
--
ALTER TABLE `intro_flower_image`
  ADD PRIMARY KEY (`flower_image_id`),
  ADD KEY `image_id` (`image_id`),
  ADD KEY `flower_id` (`flower_id`);

--
-- 資料表索引 `intro_flower_occ`
--
ALTER TABLE `intro_flower_occ`
  ADD PRIMARY KEY (`flower_occ_id`),
  ADD KEY `flower_id` (`flower_id`),
  ADD KEY `occ_id` (`occ_id`);

--
-- 資料表索引 `intro_flower_role`
--
ALTER TABLE `intro_flower_role`
  ADD PRIMARY KEY (`flower_role_id`),
  ADD KEY `flower_id` (`flower_id`),
  ADD KEY `role_id` (`role_id`);

--
-- 資料表索引 `intro_flower_season`
--
ALTER TABLE `intro_flower_season`
  ADD PRIMARY KEY (`flower_season_id`),
  ADD KEY `flower_id` (`flower_id`),
  ADD KEY `season_id` (`season_id`);

--
-- 資料表索引 `intro_image`
--
ALTER TABLE `intro_image`
  ADD PRIMARY KEY (`image_id`);

--
-- 資料表索引 `intro_occ`
--
ALTER TABLE `intro_occ`
  ADD PRIMARY KEY (`occ_id`);

--
-- 資料表索引 `intro_role`
--
ALTER TABLE `intro_role`
  ADD PRIMARY KEY (`role_id`);

--
-- 資料表索引 `intro_season`
--
ALTER TABLE `intro_season`
  ADD PRIMARY KEY (`season_id`);

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- 資料表索引 `member_coupon`
--
ALTER TABLE `member_coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- 資料表索引 `member_user_coupon`
--
ALTER TABLE `member_user_coupon`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `coupon_id` (`coupon_id`);

--
-- 資料表索引 `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`order_status_id`);

--
-- 資料表索引 `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `categories_id` (`categories_id`);

--
-- 資料表索引 `product_cart`
--
ALTER TABLE `product_cart`
  ADD PRIMARY KEY (`product_cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- 資料表索引 `product_color`
--
ALTER TABLE `product_color`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `color_list_id` (`color_list_id`);

--
-- 資料表索引 `product_favorite`
--
ALTER TABLE `product_favorite`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `product_id` (`product_id`);

--
-- 資料表索引 `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `product_id` (`product_id`);

--
-- 資料表索引 `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`product_order_id`),
  ADD KEY `shipping_id` (`shipping_id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `order_status_id` (`order_status_id`);

--
-- 資料表索引 `product_order_detail`
--
ALTER TABLE `product_order_detail`
  ADD PRIMARY KEY (`product_order_detail_id`),
  ADD KEY `product_order_id` (`product_order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- 資料表索引 `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`product_review_id`),
  ADD KEY `product_order_detail_id` (`product_order_detail_id`);

--
-- 資料表索引 `product_store`
--
ALTER TABLE `product_store`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `product_id` (`product_id`);

--
-- 資料表索引 `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`shipping_id`);

--
-- 資料表索引 `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`),
  ADD KEY `permission_id` (`permission_id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- 資料表索引 `store_permission`
--
ALTER TABLE `store_permission`
  ADD PRIMARY KEY (`permission_id`);

--
-- 資料表索引 `store_stock_quantity`
--
ALTER TABLE `store_stock_quantity`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `store_id` (`store_id`);

--
-- 資料表索引 `store_sub`
--
ALTER TABLE `store_sub`
  ADD PRIMARY KEY (`sub_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `color_list`
--
ALTER TABLE `color_list`
  MODIFY `color_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `course_datetime`
--
ALTER TABLE `course_datetime`
  MODIFY `date_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `course_favorite`
--
ALTER TABLE `course_favorite`
  MODIFY `favorite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `course_image`
--
ALTER TABLE `course_image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `course_news`
--
ALTER TABLE `course_news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `course_order`
--
ALTER TABLE `course_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `course_qa`
--
ALTER TABLE `course_qa`
  MODIFY `qa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `course_rating`
--
ALTER TABLE `course_rating`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `custom_orders`
--
ALTER TABLE `custom_orders`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `custom_products`
--
ALTER TABLE `custom_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `custom_product_list`
--
ALTER TABLE `custom_product_list`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `custom_templates`
--
ALTER TABLE `custom_templates`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `custom_template_detail`
--
ALTER TABLE `custom_template_detail`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `intro_flower`
--
ALTER TABLE `intro_flower`
  MODIFY `flower_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `intro_flower_color`
--
ALTER TABLE `intro_flower_color`
  MODIFY `flower_color_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `intro_flower_image`
--
ALTER TABLE `intro_flower_image`
  MODIFY `flower_image_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `intro_flower_occ`
--
ALTER TABLE `intro_flower_occ`
  MODIFY `flower_occ_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `intro_flower_role`
--
ALTER TABLE `intro_flower_role`
  MODIFY `flower_role_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `intro_flower_season`
--
ALTER TABLE `intro_flower_season`
  MODIFY `flower_season_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `intro_image`
--
ALTER TABLE `intro_image`
  MODIFY `image_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `intro_occ`
--
ALTER TABLE `intro_occ`
  MODIFY `occ_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `intro_role`
--
ALTER TABLE `intro_role`
  MODIFY `role_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `intro_season`
--
ALTER TABLE `intro_season`
  MODIFY `season_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member_coupon`
--
ALTER TABLE `member_coupon`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=514;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member_user_coupon`
--
ALTER TABLE `member_user_coupon`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=501;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_status`
--
ALTER TABLE `order_status`
  MODIFY `order_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_cart`
--
ALTER TABLE `product_cart`
  MODIFY `product_cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_color`
--
ALTER TABLE `product_color`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_favorite`
--
ALTER TABLE `product_favorite`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_image`
--
ALTER TABLE `product_image`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_order`
--
ALTER TABLE `product_order`
  MODIFY `product_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_order_detail`
--
ALTER TABLE `product_order_detail`
  MODIFY `product_order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_review`
--
ALTER TABLE `product_review`
  MODIFY `product_review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shipping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `store_permission`
--
ALTER TABLE `store_permission`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `store_stock_quantity`
--
ALTER TABLE `store_stock_quantity`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `store_sub`
--
ALTER TABLE `store_sub`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `fk_c_category_id` FOREIGN KEY (`category_id`) REFERENCES `course_category` (`category_id`),
  ADD CONSTRAINT `fk_c_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`);

--
-- 資料表的限制式 `course_favorite`
--
ALTER TABLE `course_favorite`
  ADD CONSTRAINT `fk_c_favorite_course_id` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `fk_c_favorite_member_id` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

--
-- 資料表的限制式 `course_image`
--
ALTER TABLE `course_image`
  ADD CONSTRAINT `fk_c_image_course_id` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- 資料表的限制式 `course_info_date`
--
ALTER TABLE `course_info_date`
  ADD CONSTRAINT `fk_c_info_date_course_id` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `fk_c_info_date_date_id` FOREIGN KEY (`date_id`) REFERENCES `course_datetime` (`date_id`);

--
-- 資料表的限制式 `course_news`
--
ALTER TABLE `course_news`
  ADD CONSTRAINT `fk_c_news_course_id` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- 資料表的限制式 `course_order`
--
ALTER TABLE `course_order`
  ADD CONSTRAINT `fk_c_order_coupon_id` FOREIGN KEY (`coupon_id`) REFERENCES `member_coupon` (`coupon_id`),
  ADD CONSTRAINT `fk_c_order_course_id` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `fk_c_order_member_id` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`),
  ADD CONSTRAINT `fk_c_order_payment_id` FOREIGN KEY (`payment_method`) REFERENCES `payment` (`payment_id`),
  ADD CONSTRAINT `fk_c_order_status_id` FOREIGN KEY (`order_status`) REFERENCES `order_status` (`order_status_id`);

--
-- 資料表的限制式 `course_qa`
--
ALTER TABLE `course_qa`
  ADD CONSTRAINT `fk_c_qa_course_id` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `fk_c_qa_member_id` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

--
-- 資料表的限制式 `course_rating`
--
ALTER TABLE `course_rating`
  ADD CONSTRAINT `fk_c_rating_course_id` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `fk_c_rating_member_id` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

--
-- 資料表的限制式 `custom_orders`
--
ALTER TABLE `custom_orders`
  ADD CONSTRAINT `fk_cu_member_id` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`),
  ADD CONSTRAINT `fk_cu_order_status` FOREIGN KEY (`order_status`) REFERENCES `order_status` (`order_status_id`),
  ADD CONSTRAINT `fk_cu_payment_method` FOREIGN KEY (`payment_method`) REFERENCES `payment` (`payment_id`),
  ADD CONSTRAINT `fk_cu_shipping_method` FOREIGN KEY (`shipping_method`) REFERENCES `shipping` (`shipping_id`),
  ADD CONSTRAINT `fk_cu_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`);

--
-- 資料表的限制式 `custom_product_list`
--
ALTER TABLE `custom_product_list`
  ADD CONSTRAINT `fk_cp_stock_id` FOREIGN KEY (`product_stock`) REFERENCES `custom_stock_status` (`stock_id`),
  ADD CONSTRAINT `fk_cp_store_id` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`);

--
-- 資料表的限制式 `custom_templates`
--
ALTER TABLE `custom_templates`
  ADD CONSTRAINT `custom_templates_ibfk_1` FOREIGN KEY (`color_id`) REFERENCES `color_list` (`color_list_id`),
  ADD CONSTRAINT `custom_templates_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `intro_role` (`role_id`),
  ADD CONSTRAINT `custom_templates_ibfk_3` FOREIGN KEY (`occ_id`) REFERENCES `intro_occ` (`occ_id`),
  ADD CONSTRAINT `custom_templates_ibfk_4` FOREIGN KEY (`stock_status`) REFERENCES `custom_stock_status` (`stock_id`);

--
-- 資料表的限制式 `custom_template_detail`
--
ALTER TABLE `custom_template_detail`
  ADD CONSTRAINT `fk_td_color_id` FOREIGN KEY (`color_id`) REFERENCES `color_list` (`color_list_id`),
  ADD CONSTRAINT `fk_td_product_id` FOREIGN KEY (`product_id`) REFERENCES `custom_products` (`product_id`),
  ADD CONSTRAINT `fk_td_template_id` FOREIGN KEY (`template_id`) REFERENCES `custom_templates` (`template_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
