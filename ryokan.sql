-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-05-09 08:51:37
-- サーバのバージョン： 10.4.21-MariaDB
-- PHP のバージョン: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `ryokan`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `good`
--

CREATE TABLE `good` (
  `id` int(32) NOT NULL COMMENT 'ID',
  `user_id` int(32) DEFAULT NULL COMMENT 'ユーザID',
  `name_id` int(32) DEFAULT NULL COMMENT '旅館名所ID',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '登録日時',
  `updataed_at` datetime DEFAULT NULL ON UPDATE current_timestamp() COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `good`
--

INSERT INTO `good` (`id`, `user_id`, `name_id`, `created_at`, `updataed_at`) VALUES
(6, 2, 1, '2022-05-09 07:58:41', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `ryokan`
--

CREATE TABLE `ryokan` (
  `id` int(32) NOT NULL COMMENT 'ID',
  `prefectures` varchar(32) DEFAULT NULL COMMENT '都道府県',
  `name` varchar(128) NOT NULL COMMENT '旅館の名称',
  `description` varchar(255) NOT NULL COMMENT '概要',
  `introduction` varchar(512) NOT NULL COMMENT '紹介文',
  `access` varchar(512) NOT NULL COMMENT 'アクセス',
  `image` varchar(255) NOT NULL COMMENT '旅館の写真',
  `up_file1` varchar(32) NOT NULL COMMENT 'イメージ画像',
  `up_file2` varchar(32) NOT NULL COMMENT 'イメージ画像',
  `up_file3` varchar(32) NOT NULL COMMENT 'イメージ画像',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '登録日時',
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp() COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `ryokan`
--

INSERT INTO `ryokan` (`id`, `prefectures`, `name`, `description`, `introduction`, `access`, `image`, `up_file1`, `up_file2`, `up_file3`, `created_at`, `updated_at`) VALUES
(1, '福岡県', '二日市温泉　大丸別荘', 'テスト', 'テスト', 'テスト', 'hutukaithi.jpg', 'hutukaithi2.jpg', 'hutukaithi3.jpg', 'hutukaithi4.jpg', '2022-05-07 01:50:08', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(32) NOT NULL COMMENT 'ID',
  `name` varchar(128) DEFAULT NULL COMMENT 'ユーザネーム',
  `email` varchar(128) DEFAULT NULL COMMENT 'メールアドレス',
  `password` varchar(128) NOT NULL COMMENT 'パスワード',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '登録日時',
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp() COMMENT '更新日時',
  `role` int(32) NOT NULL DEFAULT 0 COMMENT 'ロール'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `role`) VALUES
(2, 'テスト', 'test@co.jp', '$2y$10$4n8kDsPnvxdCbxHsHUk8PeUQMpdN7mLmPI9bFbiZXyuDVyFqOSppG', '0000-00-00 00:00:00', '2022-05-07 01:52:40', 0),
(3, '田中', 'tanaka@co.jp', '$2y$10$UilW9DJ0MlrmFEqK/WSIAuqYWuFkalfvXwk.QRYbTtQ2XJFDUSpfu', '0000-00-00 00:00:00', '2022-05-07 01:46:38', 1),
(4, '佐藤', 'sato@co.jp', '$2y$10$imLeq9nVQAWYWO3Xa.FYfOf27hxOJwqkywTWAocCHBy0YR04RCpOG', '2022-05-08 14:53:36', NULL, 0),
(5, 'サンプル', 'sample@gmail.com', '$2y$10$K.OXvRqEl3Hx5.5OQJuphO7VtLTr2Mhx/ggy9HbL7b07CGKrI8dxO', '2022-05-09 15:38:21', NULL, 0);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `good`
--
ALTER TABLE `good`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`user_id`,`name_id`);

--
-- テーブルのインデックス `ryokan`
--
ALTER TABLE `ryokan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`name`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`name`,`email`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `good`
--
ALTER TABLE `good`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=7;

--
-- テーブルの AUTO_INCREMENT `ryokan`
--
ALTER TABLE `ryokan`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
