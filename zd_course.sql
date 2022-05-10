-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2021-02-28 20:14:30
-- サーバのバージョン： 10.4.17-MariaDB
-- PHP のバージョン: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `zd_course`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `sc_exams`
--

CREATE TABLE `sc_exams` (
  `id` int(11) NOT NULL,
  `tested_at` date NOT NULL,
  `title` varchar(50) NOT NULL,
  `fullscore` int(11) NOT NULL,
  `summery` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `sc_exams`
--

INSERT INTO `sc_exams` (`id`, `tested_at`, `title`, `fullscore`, `summery`) VALUES
(1, '2021-03-30', 'Javaプログラミング', 50, '・変数と演算子\r\n・分岐処理(if文)と反復処理(for文)\r\n・配列\r\n・メソッド\r\n・継承、インターフェース'),
(2, '2021-04-11', 'HTML/CSS', 50, '・DOCTYPE宣言\r\n・テーブル、リンク、画像のタグ、フォーム\r\n・ボックスモデル'),
(3, '2021-04-20', 'JavaScript', 50, '・変数と演算子\r\n・分岐処理(if文)と反復処理(for文)\r\n・配列\r\n・関数\r\n・jQueryのメソッド名(選択式)'),
(4, '2021-04-28', 'Servlet/MySQl', 50, '・SELECT文によるデータ取得\r\n・入力値の取得と型変換\r\n・フォワードとリダイレクト\r\n・PreparedStatementとSQLの実行'),
(5, '2021-05-10', 'Linux/Git', 50, '・Linuxコマンドの穴埋め\r\n　⇒ ファイル、ディレクトリの操作\r\n　　（細かいオプションは暗記不要）\r\n・Gitの基本用語(選択式)'),
(6, '2021-05-31', 'フレームワーク', 50, '・なし');

-- --------------------------------------------------------

--
-- テーブルの構造 `sc_scores`
--

CREATE TABLE `sc_scores` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `score` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `sc_scores`
--

INSERT INTO `sc_scores` (`id`, `exam_id`, `student_id`, `score`) VALUES
(1, 1, 1, 0),
(2, 1, 2, 0),
(3, 1, 3, 0),
(4, 1, 4, 0),
(5, 1, 5, 0),
(6, 1, 6, 0),
(7, 1, 7, 0),
(8, 1, 8, 0),
(9, 1, 9, 0),
(10, 1, 10, 0),
(11, 1, 11, 0),
(12, 1, 12, 0),
(13, 1, 13, 0),
(14, 1, 14, 0),
(15, 1, 15, 0),
(16, 1, 16, 0),
(17, 1, 17, 0),
(18, 1, 18, 0),
(19, 1, 19, 0),
(20, 1, 20, 0),
(21, 1, 21, 0),
(22, 1, 22, 0),
(23, 1, 23, 0),
(24, 1, 24, 0),
(25, 1, 25, 0),
(26, 1, 26, 0),
(27, 1, 27, 0),
(28, 1, 28, 0),
(29, 1, 29, 0),
(30, 1, 30, 0),
(31, 1, 31, 0),
(32, 2, 1, 0),
(33, 2, 2, 0),
(34, 2, 3, 0),
(35, 2, 4, 0),
(36, 2, 5, 0),
(37, 2, 6, 0),
(38, 2, 7, 0),
(39, 2, 8, 0),
(40, 2, 9, 0),
(41, 2, 10, 0),
(42, 2, 11, 0),
(43, 2, 12, 0),
(44, 2, 13, 0),
(45, 2, 14, 0),
(46, 2, 15, 0),
(47, 2, 16, 0),
(48, 2, 17, 0),
(49, 2, 18, 0),
(50, 2, 19, 0),
(51, 2, 20, 0),
(52, 2, 21, 0),
(53, 2, 22, 0),
(54, 2, 23, 0),
(55, 2, 24, 0),
(56, 2, 25, 0),
(57, 2, 26, 0),
(58, 2, 27, 0),
(59, 2, 28, 0),
(60, 2, 29, 0),
(61, 2, 30, 0),
(62, 2, 31, 0),
(63, 3, 1, 0),
(64, 3, 2, 0),
(65, 3, 3, 0),
(66, 3, 4, 0),
(67, 3, 5, 0),
(68, 3, 6, 0),
(69, 3, 7, 0),
(70, 3, 8, 0),
(71, 3, 9, 0),
(72, 3, 10, 0),
(73, 3, 11, 0),
(74, 3, 12, 0),
(75, 3, 13, 0),
(76, 3, 14, 0),
(77, 3, 15, 0),
(78, 3, 16, 0),
(79, 3, 17, 0),
(80, 3, 18, 0),
(81, 3, 19, 0),
(82, 3, 20, 0),
(83, 3, 21, 0),
(84, 3, 22, 0),
(85, 3, 23, 0),
(86, 3, 24, 0),
(87, 3, 25, 0),
(88, 3, 26, 0),
(89, 3, 27, 0),
(90, 3, 28, 0),
(91, 3, 29, 0),
(92, 3, 30, 0),
(93, 3, 31, 0),
(94, 4, 1, 0),
(95, 4, 2, 0),
(96, 4, 3, 0),
(97, 4, 4, 0),
(98, 4, 5, 0),
(99, 4, 6, 0),
(100, 4, 7, 0),
(101, 4, 8, 0),
(102, 4, 9, 0),
(103, 4, 10, 0),
(104, 4, 11, 0),
(105, 4, 12, 0),
(106, 4, 13, 0),
(107, 4, 14, 0),
(108, 4, 15, 0),
(109, 4, 16, 0),
(110, 4, 17, 0),
(111, 4, 18, 0),
(112, 4, 19, 0),
(113, 4, 20, 0),
(114, 4, 21, 0),
(115, 4, 22, 0),
(116, 4, 23, 0),
(117, 4, 24, 0),
(118, 4, 25, 0),
(119, 4, 26, 0),
(120, 4, 27, 0),
(121, 4, 28, 0),
(122, 4, 29, 0),
(123, 4, 30, 0),
(124, 4, 31, 0),
(125, 5, 1, 0),
(126, 5, 2, 0),
(127, 5, 3, 0),
(128, 5, 4, 0),
(129, 5, 5, 0),
(130, 5, 6, 0),
(131, 5, 7, 0),
(132, 5, 8, 0),
(133, 5, 9, 0),
(134, 5, 10, 0),
(135, 5, 11, 0),
(136, 5, 12, 0),
(137, 5, 13, 0),
(138, 5, 14, 0),
(139, 5, 15, 0),
(140, 5, 16, 0),
(141, 5, 17, 0),
(142, 5, 18, 0),
(143, 5, 19, 0),
(144, 5, 20, 0),
(145, 5, 21, 0),
(146, 5, 22, 0),
(147, 5, 23, 0),
(148, 5, 24, 0),
(149, 5, 25, 0),
(150, 5, 26, 0),
(151, 5, 27, 0),
(152, 5, 28, 0),
(153, 5, 29, 0),
(154, 5, 30, 0),
(155, 5, 31, 0),
(156, 6, 1, 0),
(157, 6, 2, 0),
(158, 6, 3, 0),
(159, 6, 4, 0),
(160, 6, 5, 0),
(161, 6, 6, 0),
(162, 6, 7, 0),
(163, 6, 8, 0),
(164, 6, 9, 0),
(165, 6, 10, 0),
(166, 6, 11, 0),
(167, 6, 12, 0),
(168, 6, 13, 0),
(169, 6, 14, 0),
(170, 6, 15, 0),
(171, 6, 16, 0),
(172, 6, 17, 0),
(173, 6, 18, 0),
(174, 6, 19, 0),
(175, 6, 20, 0),
(176, 6, 21, 0),
(177, 6, 22, 0),
(178, 6, 23, 0),
(179, 6, 24, 0),
(180, 6, 25, 0),
(181, 6, 26, 0),
(182, 6, 27, 0),
(183, 6, 28, 0),
(184, 6, 29, 0),
(185, 6, 30, 0),
(186, 6, 31, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `sc_students`
--

CREATE TABLE `sc_students` (
  `id` int(11) NOT NULL,
  `zdid` char(6) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `sc_students`
--

INSERT INTO `sc_students` (`id`, `zdid`, `pass`, `name`) VALUES
(1, 'zd2I01', 'f03c4411fe092b85b59ce219c94e5a8428973be70ab0fff4e266ab42876460f9', '石田 直也\r'),
(2, 'zd2I02', '5fe4d89892a00c8e3f2364cdd1d7132c53948c8c354cba1e2a0ea991d1c032a3', '伊藤 雄介\r'),
(3, 'zd2I03', '2a69b5546be224780948c257e4125fa9b2f20a9fc3073334db1ac02c8f5306cc', '内田 雄也\r'),
(4, 'zd2I04', 'a9a750d259d540f79cd0e83655261506964e182c0f2faa02067a30ff3e41f43a', '尾﨑 純平\r'),
(5, 'zd2I05', '94a706c739ea263cdfc97fb3d124d183d4d7596e7c37a69d74e97e3c80d98d5b', '小野 佑介\r'),
(6, 'zd2I06', '3a191e0acabac5077aa03fd9388c46f3d750b968f6d808ec09a64384cdfb19e7', '小幡 あさ子\r'),
(7, 'zd2I07', '5088a4860cdbe1cdf1bb8352b1b67a9d2c80655104f13ace068ef01b66cda089', '片山 弘基\r'),
(8, 'zd2I08', 'fe9d44432e75c41b53599b0a2a4af1102b5f9cebb6dcfae4cebfba8eb69bb0cd', '木戸 重行\r'),
(9, 'zd2I09', '8433bd3bc16b3110f0321cde7f7ed0c8fe099a237f37ca579e9b8a21641cc960', '木村 都\r'),
(10, 'zd2I10', '59947d0c2f450b2395bb4289f90df7f79e2c6c243dd71cb1c2a0dd992ca67633', '草野 泰志\r'),
(11, 'zd2I11', '73ce89f79a44124d720759d3a97d3bdc7f168d0d22bd04a288de8da3909dd89f', '黒川 修弘\r'),
(12, 'zd2I12', '00a1341e3d57e642f67cb842cf8d9357580e93a020aa320b96add4b7387cff27', '小山 未樹\r'),
(13, 'zd2I13', '2f6e7e3bcde3a7a6d670b90f6b9d10879f66cf0f4f34067854703eba813d3667', '近藤 悠介\r'),
(14, 'zd2I14', '3a1cba8087c4d3dd1b1376ce3d133d499b9e998b0625642b8dc295ccf63786c1', '関 友洋\r'),
(15, 'zd2I15', 'dcc8af732cb883b09d24201b0e03f0baf638574632ff2637376a3cc1c77b44bb', '髙野 亜由美\r'),
(16, 'zd2I16', '97dcb997ac4f49173d34523b5ff57ce288b39e3c45cf4412e9911df96028e95d', '武中 淳子\r'),
(17, 'zd2I17', '7f3d797ed59fc72228dafde27d192e3cda5cc956f4f10c24977eb642a487295a', '田中 美奈緒\r'),
(18, 'zd2I18', '229b5c5753a6571d82b0da56301006320f9866ad79c0f400ae978a2acb90f823', '飛田 菜々子\r'),
(19, 'zd2I19', '191f47a11a8f2ebb521c72ff37caf6ab847f558794f645dcf60f233d07b9b3e1', '豊島 政人\r'),
(20, 'zd2I20', '719e110ccd78d81c37fc3a3cdf810b30f741d291db374e9ce085bfc48051521e', '中川 一英\r'),
(21, 'zd2I21', '049f70c9f92c23f7ef5f4212eeee738dcf9c9dfceec4c07f13669e249ac48f2b', '深井 洋次郎\r'),
(22, 'zd2I22', '53a96774c175da8f640320ee118ff60a2abf0a6a41450e4a55b36a3cc2d22f16', '藤井 健人\r'),
(23, 'zd2I23', 'a60149b09dca25cd82f871ffdf11897968abe5828e7b31bf0811a89f4c8a01f3', '宮島 淳\r'),
(24, 'zd2I24', '44d6aa068b08235bc97dfc0d97e8fb905fb9623c7ae7070b960dd9466d5cdb01', '茂垣 真奈\r'),
(25, 'zd2I25', 'ef0192ac2f8a5d753070313728b1ec4d5a87ae7b78aa3b76182ab0bdc13bdffc', '安井 千季\r'),
(26, 'zd2I26', '558ed96e43adb6cf933a0769ffd608780d28dbf9541b47e3cb912f1ea5de244c', '山田 慶\r'),
(27, 'zd2I27', '1fea46f1b7136b4ec3a5e7dbf64f42c4edbf5b3331329289ec91a7843dc92b1e', '山本 紳二郎\r'),
(28, 'zd2I28', '772894842125029d14305f666d613d4a1dbb334a99be57a4215c785eb4621ce3', '吉田 照代\r'),
(29, 'zd2I29', '07b16aa63831c360909857467bf68d9db9bc17855571594e627820c0ef5815c8', '吉光 真香\r'),
(30, 'zd2I30', '53c874b3631a210e3e18939e96ae1f2506bcfb23408d7a8f21f10d05a68457c8', '渡辺 有子\r'),
(31, '', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855', '');

-- --------------------------------------------------------

--
-- テーブルの構造 `sc_teachers`
--

CREATE TABLE `sc_teachers` (
  `id` int(11) NOT NULL,
  `zdid` char(6) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `sc_teachers`
--

INSERT INTO `sc_teachers` (`id`, `zdid`, `pass`, `name`) VALUES
(1, 'zdis56', 'e792ec48b511068744cb5018c2a309d7860becfcda5e00adceabbb2df54e59d8', '村岡 羊一');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `sc_exams`
--
ALTER TABLE `sc_exams`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `sc_scores`
--
ALTER TABLE `sc_scores`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `sc_students`
--
ALTER TABLE `sc_students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `zdid` (`zdid`);

--
-- テーブルのインデックス `sc_teachers`
--
ALTER TABLE `sc_teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `zdid` (`zdid`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `sc_exams`
--
ALTER TABLE `sc_exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- テーブルの AUTO_INCREMENT `sc_scores`
--
ALTER TABLE `sc_scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- テーブルの AUTO_INCREMENT `sc_students`
--
ALTER TABLE `sc_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- テーブルの AUTO_INCREMENT `sc_teachers`
--
ALTER TABLE `sc_teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
