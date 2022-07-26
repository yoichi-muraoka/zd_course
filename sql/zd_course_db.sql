-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2022 年 7 朁E20 日 13:36
-- サーバのバージョン： 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zd_course_db`
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
(1, '2022-07-21', 'IT技術基礎', 50, '全問選択式問題\r\n・コンピュータとプログラム\r\n・プログラムとアルゴリズム\r\n・インターネットの基礎知識'),
(2, '2022-07-26', 'Java', 50, '穴埋め問題 (一部選択問題あり)\r\n・変数と演算子\r\n・分岐処理(if文)と反復処理(for文)\r\n・配列\r\n・メソッド\r\n・継承、インターフェース'),
(3, '2021-04-20', 'HTML / CSS', 50, '選択式問題 (一部穴埋め問題あり)\r\n・DOCTYPE宣言\r\n・テーブル、リンク、画像のタグ、フォーム\r\n・ボックスモデル'),
(4, '2021-04-28', 'JavaScript', 50, '穴埋め問題 (一部選択問題あり)\r\n・変数と演算子\r\n・分岐処理(if文)と反復処理(for文)\r\n・配列\r\n・関数\r\n・jQueryのメソッド名(選択式)'),
(5, '2022-05-31', 'Servlet / MySQL', 50, '・SELECT文によるデータ取得(穴埋め)\r\n・入力値の取得と型変換(選択問題)\r\n・フォワードとリダイレクト(選択問題)\r\n・PreparedStatementとSQLの実行・変数と演算子(選択問題)'),
(6, '2022-06-01', 'Linux / Git', 50, '全問選択式問題\r\n・Linuxコマンド(ファイル、ディレクトリの操作)\r\n　細かいオプションは暗記不要\r\n・Gitの基本用語');

-- --------------------------------------------------------

--
-- テーブルの構造 `sc_questions`
--

CREATE TABLE `sc_questions` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `sentence` varchar(5000) DEFAULT NULL,
  `answer` varchar(500) DEFAULT NULL,
  `right_answer` varchar(100) DEFAULT NULL,
  `score` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `sc_questions`
--

INSERT INTO `sc_questions` (`id`, `exam_id`, `num`, `sentence`, `answer`, `right_answer`, `score`) VALUES
(1, 2, 1, '<p>次のプログラムを実行すると、どのように表示されるか答えてください。</p>\r\n<pre>\r\nSystem.out.println(10 / 4);\r\n</pre>', '<input type=\"number\" step=\"0.1\" value=\"0\">', '2', 5),
(2, 2, 3, '<p>次の空欄Aに当てはまる記述を答えてください。(全て小文字で記述すること)</p>\r\n<pre>\r\nlong x = 20;\r\nint y = <span class=\"answer-blank \">A</span> x;\r\n<span class=\"answer-blank \">B</span> z = y / 2.5;\r\n</pre>', '<input type=\"text\" placeholder=\"空欄A\">', '(int)', 5),
(3, 2, 4, '<p>次の空欄Bに当てはまる記述を答えてください。(全て小文字で記述すること)</p>\r\n<pre>\r\nlong x = 20;\r\nint y = <span class=\"answer-blank \">A</span> x;\r\n<span class=\"answer-blank \">B</span> z = y / 2.5;\r\n</pre>', '<input type=\"text\" placeholder=\"空欄B\">', 'double', 5),
(4, 2, 5, '<p>入力された点数scoreが60以上の場合、「合格」と表示させたい。次の空欄A に当てはまる演算子を答えてください。</p>\r\n<pre>\r\nScanner scanner = new Scanner(System.in);\r\nint score = scanner.nextInt();\r\nif (score  <span class=\"answer-blank \">A</span>  60) {\r\n    System.out.println(\"合格\");\r\n}\r\n</pre>', '<input type=\"text\" placeholder=\"空欄A\">', '>=', 5),
(5, 2, 6, '<p>「りんご みかん バナナ 」と表示させたい。次の空欄A に当てはまる記述を答えてください。</p>\r\n<pre>\r\nString[] items = {\"りんご\", \"みかん\", \"バナナ\"};\r\nfor(  <span class=\"answer-blank \">A</span>  ) {\r\n  System.out.print(item + \" \");\r\n}\r\n</pre>', '<input type=\"text\" placeholder=\"空欄A\">', 'String item : items', 5),
(6, 1, 1, '<p>コンピュータの５大装置について書かれた以下の文章を読み、空欄A, Bに入るものを選択してください。</p>\r\n<pre>\r\n（　A　）装置はプログラムに記述された命令の解釈・実行と他の装置の（　A　）を行い、\r\n（　B　）装置は算術（　B　）や論理（　B　）などのデータ処理を行う。\r\nこの二つは現代のコンピュータ製品では中央処理装置（CPU：Central Processing Unit）として\r\n一つの半導体チップ（マイクロプロセッサ/MPU）にまとめられるのが一般的となっている。(引用元: IT用語辞典)\r\n</pre>\r\n<p>選択肢</p>\r\n<pre>\r\n1. A: 記憶　B: 制御\r\n2. A: 制御　B: 演算\r\n3. A: 入力　B: 演算\r\n4. A: 演算　B: 制御\r\n5. A: 制御　B: 記憶\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"5\" step=\"1\" value=\"1\">', '2', 5),
(7, 1, 2, '<p>コンピュータの５大装置について書かれた以下の文章を読み、空欄A, Bに入るものを選択してください。</p>\r\n<pre>\r\n（　A　）装置は外部からデータを送り込むための装置で、人間による操作をコンピュータに伝えるマウスやキーボード、\r\nペンタブレットなどのほか、外部の情報を取り込んでデジタルデータとしてコンピュータに伝送するイメージスキャナやマイク、カメラなどがある。\r\n（　B　）装置はコンピュータ内部のデータを外部に取り出すための装置で、ディスプレイやスピーカー、プリンタなどが該当する。(引用元: IT用語辞典)\r\n</pre>\r\n<p>選択肢</p>\r\n<pre>\r\n1. A: 出力　B: 入力\r\n2. A: 制御　B: 演算\r\n3. A: 入力　B: 出力\r\n4. A: 制御　B: 出力\r\n5. A: 入力　B: 記憶\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"5\" step=\"1\" value=\"1\">', '3', 5),
(8, 2, 7, '<p>BMI値を算出するメソッドcalcBmi() を定義したい。次の空欄A に当てはまる記述を答えてください。(全て小文字で記述すること)</p>\r\n<pre>\r\npublic static  <span class=\"answer-blank \">A</span>  calcBmi(double height, double weight) {\r\n    return weight / (height * height);\r\n}\r\n</pre>', '<input type=\"text\" placeholder=\"空欄A\">', 'double', 5),
(9, 2, 8, '<p>クラスを<b>継承する</b>際に使用するキーワードとして正しいものを次の中から1つ選んでください。</p>\r\n<pre>\r\n1. takes　　2.inherits　　3.implements　　4.extends\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"4\" value=\"1\" step=\"1\">', '4', 5),
(10, 2, 9, '<p>インターフェースを<b>実装する</b>際に使用するキーワードとして正しいものを次の中から1つ選んでください。</p>\r\n<pre>\r\n1. takes　　2.inherits　　3.implements　　4.extends\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"4\" value=\"1\" step=\"1\">', '3', 5),
(11, 2, 2, '<p>次のプログラムを実行すると、どのように表示されるか答えてください。</p>\r\n<pre>\r\nSystem.out.println(10 % 4);\r\n</pre>', '<input type=\"number\" step=\"0.1\" value=\"0\">', '2', 5),
(12, 2, 10, '<p>インターフェースに関する説明として<b>間違っているもの</b>を次の中から１つ選んでください。</p>\r\n<pre>\r\n1. フィールドやメソッドは全て自動的に public になる。\r\n2. メソッドはabstractを付けなくても自動的に抽象メソッドになる。\r\n3. フィールドは定数しか定義できない。\r\n4. 1つのクラスで複数のインターフェースを同時に実装することはできない。\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"4\" value=\"1\" step=\"1\">', '4', 5),
(13, 1, 3, '<p>プログラムについて書かれた以下の文章を読み、空欄A, Bに入るものを選択してください。</p>\r\n<pre>\r\nプログラミング言語で記述されたソースコードを、コンピュータが理解することのできる（　A　）に\r\n変換する作業のことを（　B　）と呼ぶ。\r\n</pre>\r\n<p>選択肢</p>\r\n<pre>\r\n1. A: 自然言語　　B: コンバート\r\n2. A: 自然言語　　B: コンパイル\r\n3. A: 機械語　　　B: コンバート\r\n4. A: 機械語　　　B: コンパイル\r\n5. A: コンパイラ　B: コンパイル\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"5\" step=\"1\" value=\"1\">', '4', 5),
(14, 1, 4, '<p>情報の単位について書かれた以下の文章を読み、空欄A, Bに入るものを選択してください。</p>\r\n<pre>\r\n（　A　）とは、情報量の単位の一つで、8（　B　）のこと。\r\n2進数で8桁の数を表すことができる情報量で、256種類（2の8乗）の異なる状態を表現することができる。(引用元: IT用語辞典)\r\n</pre>\r\n<p>選択肢</p>\r\n<pre>\r\n1. A: イント　　　B: ダブル\r\n2. A: バイト　　　B: ビット\r\n3. A: イント　　　B: バイト\r\n4. A: バイト　　　B: イント\r\n5. A: テラバイト　B: ギガバイト\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"5\" step=\"1\" value=\"1\">', '2', 5),
(15, 1, 5, '<p>アルゴリズムについて書かれた以下の文章を読み、空欄A, Bに入るものを選択してください。</p>\r\n<pre>\r\n（アルゴリズムとは）ある特定の問題を解いたり、課題を解決したりするための計算手順や処理手順のこと。\r\nこれを図式化したものが（　A　）であり、コンピューターで処理するための具体的な手順を記述したものが（　B　）である。(引用元: デジタル大辞泉)\r\n</pre>\r\n<p>選択肢</p>\r\n<pre>\r\n1. A: プログラム　　　B: 自然言語\r\n2. A: プログラム　　　B: フローチャート\r\n3. A: フローチャート　B: アルゴリズム\r\n4. A: フローチャート　B: プログラム\r\n5. A: 疑似言語　　　　B: フローチャート\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"5\" step=\"1\" value=\"1\">', '4', 5),
(16, 1, 6, '<p>アルゴリズムについて書かれた以下の文章を読み、空欄A, B, Cに入るものを選択してください。</p>\r\n<pre>\r\n命令が実行される流れを定めたものを制御構造と呼ぶ。\r\nこの制御構造のうち、命令の出現順・記述順の通りに順番に命令を実行するものを（　A　）構造と呼ぶ。\r\nまた、条件によって実行する命令の流れがいくつかに枝分かれするものは（　B　）構造と呼ばれ、\r\n同じ命令の流れを繰り返し実行するものは（　C　）構造と呼ばれる。(引用・参考: IT用語辞典)\r\n</pre>\r\n<p>選択肢</p>\r\n<pre>\r\n1. A: ストレート　B: スイッチ　　C: ワイル\r\n2. A: ストレート　B: セパレート　C: ループ\r\n3. A: 順次　　　　B: 分岐　　　　C: 反復\r\n4. A: 順次　　　　B: 分解　　　　C: 結合\r\n5. A: 標準　　　　B: スイッチ　　C: 包括\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"5\" step=\"1\" value=\"1\">', '3', 5),
(17, 1, 7, '<p>インターネットについて書かれた以下の文章を読み、空欄A, Bに入るものを選択してください。</p>\r\n<pre>\r\n（　A　）とは、世界規模で相互接続するコンピュータや通信機器同士のネットワークである。\r\nこのネットワーク上で動作する仕組みとして、（　B　）や eメールが存在する。\r\n</pre>\r\n<p>選択肢</p>\r\n<pre>\r\n1. A: ホームページ　　B: ECサイト\r\n2. A: ウェブ　　　　　B: B to B\r\n3. A: ウェブ　　　　　B: インターネット\r\n4. A: インターネット　B: B to C\r\n5. A: インターネット　B: ウェブ\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"5\" step=\"1\" value=\"1\">', '5', 5),
(18, 1, 8, '<p>クライアント・サーバーシステムについて書かれた以下の文章を読み、空欄A, Bに入るものを選択してください。</p>\r\n<pre>\r\n他のコンピュータやソフトウェアから機能や情報の提供を受けるコンピュータやソフトウェアのことを（　A　）と呼ぶ。\r\nまた、機能や情報を提供する側のコンピュータやソフトウェアを（　B　）と呼ぶ。\r\nこのようにサーバーとクライアントで構成されるシステムを「クライアント・サーバーシステム」という。(引用・参考: IT用語辞典)\r\n</pre>\r\n<p>選択肢</p>\r\n<pre>\r\n1. A: サーバー　　　B: クライアント\r\n2. A: サーバー　　　B: ウェブサイト\r\n3. A: クライアント　B: サーバー\r\n4. A: クライアント　B: ウェブサイト\r\n5. A: カスタマー　　B: カスタマーサービス\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"5\" step=\"1\" value=\"1\">', '3', 5),
(19, 1, 9, '<p>クライアント・サーバーシステムについて書かれた以下の文章を読み、空欄A, Bに入るものを選択してください。</p>\r\n<pre>\r\nサーバーとクライアントで構成されるシステムを「クライアント・サーバーシステム」という。\r\nこのシステムにおいては、クライアントがサーバーに（　A　）を送り、サーバーがこれに応じて処理を行い、\r\n結果を（　B　）する、という形で一連の処理が進められる。(引用・参考: IT用語辞典)\r\n</pre>\r\n<p>選択肢</p>\r\n<pre>\r\n1. A: リクエスト　B: レスポンス\r\n2. A: リクエスト　B: コール\r\n3. A: レスポンス　B: リクエスト\r\n4. A: レスポンス　B: コール\r\n5. A: コール　　　B: レスポンス\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"5\" step=\"1\" value=\"1\">', '1', 5),
(20, 1, 10, '<p>インターネットについて書かれた以下の文章を読み、空欄A, Bに入るものを選択してください。</p>\r\n<pre>\r\nインターネットに接続されたコンピュータや通信機器の一台ごとに割り当てられた識別番号を（　A　）と呼ぶ。\r\nただし（　A　）は数字の羅列で表現されるため、人間には覚えたり書き表したりしにくく、読み間違いや入力ミスも起こりやすい。\r\nこのため、「www.example.com」のようにアルファベットや記号を組み合わせた分かりやすい識別名をつけられる仕組みが考案された。\r\nこの仕組みは（　B　）と呼ばれる。(引用・参考: IT用語辞典)\r\n</pre>\r\n<p>選択肢</p>\r\n<pre>\r\n1. A: IPアドレス　B: ポート番号\r\n2. A: IPアドレス　B: DNS（Domain Name System）\r\n3. A: ポート番号　B: IPアドレス\r\n4. A: ドメイン　　B: DNS（Domain Name System）\r\n5. A: ドメイン　　B: IPアドレス\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"5\" step=\"1\" value=\"1\">', '2', 5),
(21, 3, 1, '<p>HTMLは何の略称か、以下から選択してください。</p>\r\n<pre>\r\n1. HyperText Makeup Language\r\n2. HyperText Markup Language\r\n3. HyperText Mashup Language\r\n4. HyperText Mockup Language\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"4\" value=\"1\" step=\"1\">', '2', 5),
(22, 3, 2, '<p>以下はテーブルを作成するタグの例です。A、B、C、Dに当てはまるタグを答えてください。Cは見出しセル用のタグ、Dは通常のセル用のタグが入ります。</p>\r\n<pre>\r\n＜ A ＞\r\n    ＜ B ＞\r\n        ＜ C ＞見出しセル1＜/ C ＞\r\n        ＜ D ＞データセル1＜/ D ＞\r\n    ＜/ B ＞\r\n    ＜ B ＞\r\n        ＜ C ＞見出しセル2＜/ C ＞\r\n        ＜ D ＞データセル2＜/ D ＞\r\n    ＜/ B ＞\r\n＜/ A ＞\r\n</pre>\r\n<p>選択肢</p>\r\n<pre>\r\n1. A: table　　B: row　　C: th　　D: td\r\n2. A: table　　B: row　　C: td　　D: th\r\n3. A: table　　B: tr　 　C: th　　D: td\r\n4. A: table　　B: tr　 　C: td　　D: th\r\n</pre>\r\n', '<input type=\"number\" min=\"1\" max=\"4\" step=\"1\" value=\"1\">', '3', 5),
(23, 3, 3, '<p>以下の「会社概要」という文字列に対し、about.htmlへのリンクを設定する場合、〇〇〇〇に当てはまる記述を答えてください。(全て小文字で記述すること)</p>\r\n<pre class=\"html-code\">\r\n<p> 詳しくは<a  〇〇〇〇=\"about.html\"> 会社概要 </a> をご覧ください。</p> \r\n</pre>', '<input type=\"text\">', 'href', 5),
(24, 3, 4, '<p>猫の画像(cat.jpg)を表示させる場合、〇〇〇に当てはまる記述を答えてください。(全て小文字で記述すること)</p>\r\n<pre class=\"html-code\">\r\n<img 〇〇〇=\"cat.jpg\" alt=\"猫\">\r\n</pre>', '<input type=\"text\">', 'src', 5),
(25, 3, 5, '<p>氏名の入力欄と送信ボタンをもつフォームを作成する場合、〇〇〇〇〇〇に当てはまる記述を答えてください。(全て小文字で記述すること)</p>\r\n<pre class=\"html-code\">\r\n<form>\r\n    <p>氏名：<input type=\"text\" name=\"name\"></p>\r\n    <p><input type=\"〇〇〇〇〇〇\" value=\"送信する\"></p>\r\n</form>\r\n</pre>', '<input type=\"text\">', 'submit', 5),
(26, 3, 6, '<p>CSSファイルを読み込む場合、〇〇〇〇に当てはまる記述を答えてください。(全て小文字で記述すること)</p>\r\n<pre class=\"html-code\">\r\n<link rel=\"stylesheet\" 〇〇〇〇=\"css/style.css\">\r\n</pre>', '<input type=\"text\">', 'href', 5),
(27, 3, 7, '<p>h1要素の文字色を赤色に設定する場合、〇〇〇〇〇に当てはまる記述を答えてください。(全て小文字で記述すること)</p>\r\n<pre>\r\nh1 {\r\n    〇〇〇〇〇: #f00;\r\n}\r\n</pre>', '<input type=\"text\">', 'color', 5),
(28, 3, 8, '<pre class=\"html-code\">\r\n<h1 id=\"foo\">見出しA</h1>\r\n</pre>\r\n\r\n<p>上記HTMLの見出しAを装飾する場合、セレクタとして適切なものを以下から選んでください。</p>\r\n<pre>\r\n（１）.foo\r\n（２）#foo\r\n（３）h1.foo\r\n（４）#foo h1\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"4\" step=\"1\" value=\"1\">', '2', 5),
(29, 3, 9, '<pre class=\"html-code\">\r\n<div class=\"bar\">\r\n   <h2>見出しB</h2>\r\n</div>\r\n</pre>\r\n\r\n<p>上記HTMLの見出しBを装飾する場合、セレクタとして適切なものを以下から選んでください。</p>\r\n<pre>\r\n（１）#bar h2\r\n（２）.bar h2\r\n（３）h2.bar\r\n（４）h2 .bar\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"4\" step=\"1\" value=\"1\">', '2', 5),
(30, 3, 10, '<pre class=\"html-code\">\r\n<p class=\"buzz\">文章C</p>\r\n</pre>\r\n\r\n<p>上記HTMLの文章Cを装飾する場合、セレクタとして適切なものを以下から選んでください。</p>\r\n<pre>\r\n（１）.buzz p\r\n（２）#buzz p\r\n（３）p#buzz\r\n（４）.buzz\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"4\" step=\"1\" value=\"1\">', '4', 5),
(31, 4, 1, '<p>次のプログラムを実行すると、どのように表示されるか答えてください。</p>\r\n<pre>\r\nconsole.log(10 / 4);\r\n</pre>', '<input type=\"number\" step=\"0.1\" value=\"0\">', '2.5', 5),
(32, 4, 2, '<p>次のプログラムを実行すると、どのように表示されるか答えてください。</p>\r\n<pre>\r\nconsole.log(10 % 4);\r\n</pre>', '<input type=\"number\" step=\"0.1\" value=\"0\">', '2', 5),
(33, 4, 3, '<p>入力された点数scoreが60以上の場合、「合格」と表示させたい。次の空欄A に当てはまる演算子を答えてください。</p>\r\n<pre>\r\nconst score = $(\"#score\").val();\r\nif (score  <span class=\"answer-blank \">A</span>  60) {\r\n    console.log(\"合格\");\r\n}\r\n</pre>', '<input type=\"text\" placeholder=\"空欄A\">', '>=', 5),
(34, 4, 4, '<p>入力された数値numが3の倍数の場合、「3の倍数」と表示させたい。空欄Aに当てはまる記述を答えてください。</p>\r\n<pre>\r\nconst num = $(\"#num\").val();\r\nif ( <span class=\"answer-blank \">A</span>  == 0) {\r\n    console.log(\"3の倍数\");\r\n}\r\n</pre>', '<input type=\"text\" placeholder=\"空欄A\">', 'num % 3', 5),
(35, 4, 5, '<p>配列items内の要素を全て表示させたい。空欄Aに当てはまる記述を答えてください。</p>\r\n<pre>\r\nconst items = [\"りんご\", \"みかん\", \"バナナ\"];\r\nfor(let <span class=\"answer-blank \">A</span>  of items) {\r\n    console.log(item)\r\n}\r\n</pre>', '<input type=\"text\" placeholder=\"空欄A\">', 'item', 5),
(36, 4, 6, '<p>配列price内の要素の合計値を計算したい。空欄Aに当てはまる演算子を答えてください。</p>\r\n<pre>\r\nconst price = [100, 200, 150];\r\nlet total = 0;\r\nfor(let i = 0; i < price.length; i++) {\r\n   total <span class=\"answer-blank \">A</span>  price[i];\r\n}\r\n\r\nconsole.log(\"合計: \" + total)\r\n</pre>', '<input type=\"text\" placeholder=\"空欄A\">', '+=', 5),
(37, 4, 7, '<p>BMI値を算出する関数calcBmi() を定義したい。空欄Aに当てはまる記述を答えてください。</p>\r\n<pre>\r\n<span class=\"answer-blank \">A</span> calcBmi(height, weight) {\r\n    return weight / (height * height);\r\n}\r\n</pre>', '<input type=\"text\" placeholder=\"空欄A\">', 'function', 5),
(38, 4, 8, '<p>要素の属性値を操作するためのjQueryのメソッドを次の中から1つ選んでください。</p>\r\n<p>選択肢</p>\r\n<pre>\r\n1. src　　2. attr　　3. setAttribute　　4. click\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"4\" step=\"1\" value=\"1\">', '2', 5),
(39, 4, 9, '<p>要素を徐々に非表示にするためのjQueryのメソッドを次の中から1つ選んでください。</p>\r\n<p>選択肢</p>\r\n<pre>\r\n1. fadeIn　　2. fadeOut　　3. stepIn　　4. stepOut\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"4\" step=\"1\" value=\"1\">', '2', 5),
(40, 4, 10, '<p>一定時間ごとに処理を行うためのJavaScriptのメソッドを次の中から1つ選んでください。</p>\r\n<p>選択肢</p>\r\n<pre>\r\n1. setRepeat　　2. setTimeout　　3. setInterval　　4. setSteps\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"4\" step=\"1\" value=\"1\">', '3', 5),
(41, 5, 1, '<p>以下はmembersテーブルから会員データを取得するためのSQL文です。空欄Aに当てはまる記述を答えてください。(全て<b>大文字</b>で記述すること)</p>\r\n<pre>\r\n<span class=\"answer-blank \">A</span> * FROM members;\r\n</pre>', '<input type=\"text\" placeholder=\"空欄A\">', 'SELECT', 5),
(42, 5, 2, '<p>以下はmembersテーブルから1990年1月1日以降に生まれた会員のデータを取得するためのSQL文です。<b>空欄B</b>に当てはまる記述を答えてください。(全て<b>大文字</b>で記述すること)</p>\r\n<pre>\r\n<span class=\"answer-blank\">A</span> * FROM members\r\n<span class=\"answer-blank\">B</span> birthday >= \'1990-01-01\';\r\n</pre>', '<input type=\"text\" placeholder=\"空欄B\">', 'WHERE', 5),
(43, 5, 3, '<p>以下はmembersテーブルから住所に「区」という文字を含む会員のデータを取得するためのSQL文です。<b>空欄C</b>に当てはまる記述を答えてください。(全て<b>大文字</b>で記述すること)</p>\r\n<pre>\r\n<span class=\"answer-blank\">A</span> * FROM members\r\n<span class=\"answer-blank\">B</span> address <span class=\"answer-blank\">C</span> \'%区%\';\r\n</pre>', '<input type=\"text\" placeholder=\"空欄C\">', 'LIKE', 5),
(44, 5, 4, '<p>以下はmembersテーブルとmember_typesテーブルを連携させてデータを取得するためのSQL文です。<b>空欄B</b>に当てはまる記述を答えてください。(全て<b>大文字</b>で記述すること)</p>\r\n<pre>\r\n<span class=\"answer-blank\">A</span> * FROM members\r\n<span class=\"answer-blank\">B</span> member_types\r\n<span class=\"answer-blank\">C</span> members.type_id = member_types.id;\r\n</pre>', '<input type=\"text\" placeholder=\"空欄B\">', 'JOIN', 5),
(45, 5, 5, '<p>以下はmembersテーブル内の会員数を会員種別ごとに数えるためのSQL文です。<b>空欄B</b>に当てはまる記述を答えてください。(全て<b>大文字</b>で記述すること)</p>\r\n<pre>\r\n<span class=\"answer-blank\">A</span> type_id, COUNT(*) FROM members\r\n<span class=\"answer-blank\">B</span> BY type_id;\r\n</pre>', '<input type=\"text\" placeholder=\"空欄B\">', 'GROUP', 5),
(46, 5, 6, '<p>以下はmembersテーブル内の会員データを年齢の若い順(生年月日の降順)に取得するためのSQL文です。<b>空欄B</b>に当てはまる記述を答えてください。(全て<b>大文字</b>で記述すること)</p>\r\n<pre>\r\n<span class=\"answer-blank\">A</span> * FROM members\r\n<span class=\"answer-blank\">B</span> BY birthday <span class=\"answer-blank\">C</span>;\r\n</pre>', '<input type=\"text\" placeholder=\"空欄B\">', 'ORDER', 5),
(47, 5, 7, '<p>以下はフォームから取得した名前と年齢をデータベースに追加するためのJavaのソースコードです。</p>\r\n<b>AddMemberServlet.java</b>\r\n<pre>\r\n... 中略 ...\r\n\r\n// フォームから名前と年齢を取得する\r\nString name = request.getParameter(\"name\");\r\n<span class=\"answer-blank\">A</span> strAge = request.getParameter(\"age\");\r\n\r\n// 年齢を整数に変換する\r\nInteger age = <span class=\"answer-blank\">B</span>.parseInt(strAge);\r\n\r\n// DaoFactoryを使い、MemberDaoImplを生成し、データを追加する\r\nMemberDao dao = DaoFactory.createMemberDao();\r\ndao.add(name, age);\r\n\r\n// 追加完了画面を表示する\r\nrequest.<span class=\"answer-blank\">C</span>(\"/WEB-INF/view/addMemberDone.jsp\")\r\n         .<span class=\"answer-blank\">D</span>(request, response);\r\n\r\n... 以下略 ...\r\n</pre>\r\n\r\n<b>MemberDaoImpl.java</b>\r\n<pre>\r\n... 中略 ...\r\n\r\n// 会員情報(名前と年齢)を追加するメソッド\r\n@Override\r\npublic void add(String name, Integer age) {\r\n   try(Connection con = ds.getConnection) {\r\n      String sql = \"INSERT INTO members VALUES (NULL,?,?)\";\r\n      <span class=\"answer-blank\">E</span> stmt = con.<span class=\"answer-blank\">F</span>(sql);\r\n      stmt.setString(1, name);\r\n      stmt.setObject(2, age, Types.INTEGER);\r\n      stmt.<span class=\"answer-blank\">G</span>();\r\n   }\r\n}\r\n\r\n... 以下略 ...\r\n</pre>\r\n\r\n<p>-------------------</p>\r\n\r\n<p><b>問題:</b> フォームから取得した年齢を整数に変換したい場合、「AddMemberServlet.java」の空欄A, Bに入る適切な語句を選択してください。</p>\r\n<p>選択肢</p>\r\n<pre>\r\n1. A: String　B: int\r\n2. A: String　B: String\r\n3. A: String　B: Double\r\n4. A: String　B: Integer\r\n5. A: String　B: integer\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"5\" step=\"1\" value=\"1\">', '4', 5),
(48, 5, 8, '<p>問7の「AddMemberServlet.java」の空欄を埋める問題です。追加完了画面(addMemberDone.jsp)を表示させる場合、空欄C, Dに入る適切な語句を選択してください。</p>\r\n<p>選択肢</p>\r\n<pre>\r\n1. C: getParameter　　　　　D: getRequestDispatcher\r\n2. C: getParameter　　　　　D: forward\r\n3. C: getRequestDispatcher　D: getParameter\r\n4. C: getRequestDispatcher　D: forward\r\n5. C: getRequestDispatcher　D: redirect\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"5\" step=\"1\" value=\"1\">', '4', 5),
(49, 5, 9, '<p>問7の「MemberDaoImpl.java」の空欄を埋める問題です。変数sql内のSQL文をSQLインジェクションを回避して安全に実行したい場合、空欄E, Fに入る適切な語句を選択してください。</p>\r\n<p>選択肢</p>\r\n<pre>\r\n1. E: PreparedStatement　F: prepareStatement\r\n2. E: PreparedStatement　F: PreparedStatement\r\n3. E: preparedStatement　F: prepareStatement\r\n4. E: prepareStatement　 F: preparedStatement\r\n5. E: prepareStatement　 F: PreparedStatement\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"5\" step=\"1\" value=\"1\">', '1', 5),
(50, 5, 10, '<p>問7の「MemberDaoImpl.java」の空欄を埋める問題です。変数sql内のSQL文を実行する場合、空欄Gに入る適切な語句を選択してください。</p>\r\n<p>選択肢</p>\r\n<pre>\r\n1. executeQuery\r\n2. executeUpdate\r\n3. setQuery\r\n4. executeInsert\r\n5. run\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"5\" step=\"1\" value=\"1\">', '2', 5),
(51, 6, 1, '<p>以下はtaroディレクトリ内の内容を表示するためのLinuxコマンドです。次の空欄Aに入る語句を答えてください。</p>\r\n<pre>\r\n$ <span class=\"answer-blank \">A</span> -al /home/taro\r\n</pre>\r\n\r\n<p>選択肢</p>\r\n<pre>\r\n1. show　　2. look　　3. ls　　4. preview\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"4\" value=\"1\" step=\"1\">', '3', 5),
(52, 6, 2, '<p>以下はcssディレクトリを作成するためのLinuxコマンドです。次の空欄Aに入る語句を答えてください。</p>\r\n<pre>\r\n$ <span class=\"answer-blank \">A</span> css\r\n</pre>\r\n\r\n<p>選択肢</p>\r\n<pre>\r\n1. create　　2. make　　3. mkdir　　4. touch\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"4\" value=\"1\" step=\"1\">', '3', 5),
(53, 6, 3, '<p>以下はcssディレクトリに移動し、style.cssを作成するためのLinuxコマンドです。次の空欄A, Bに入る語句を答えてください。</p>\r\n<pre>\r\n$ <span class=\"answer-blank \">A</span> css\r\n$ <span class=\"answer-blank \">B</span> style.css\r\n</pre>\r\n\r\n<p>選択肢</p>\r\n<pre>\r\n1. A: cd　B: create\r\n2. A: cd　B: touch\r\n3. A: mv　B: create\r\n4. A: mv　B: touch\r\n5. A: ls　B: mkdir\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"5\" step=\"1\" value=\"1\">', '2', 5),
(54, 6, 4, '<p>以下はstyle.cssを複製してcommon.cssというファイルを作成するためのLinuxコマンドです。次の空欄Aに入る語句を答えてください。</p>\r\n<pre>\r\n$ <span class=\"answer-blank \">A</span> style.css common.css\r\n</pre>\r\n\r\n<p>選択肢</p>\r\n<pre>\r\n1. clone　　2. copy　　3. cp　　4. touch\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"4\" step=\"1\" value=\"1\">', '3', 5),
(55, 6, 5, '<p>以下は拡張子が.cssのファイルをアーカイブ化して圧縮するためのLinuxコマンドです。次の空欄Aに入る語句を答えてください。</p>\r\n<pre>\r\n$ <span class=\"answer-blank \">A</span> -z -cvf css.tar.gz *.css\r\n</pre>\r\n\r\n<p>選択肢</p>\r\n<pre>\r\n1. archive　　2. zip　　3. tar　　4. squash\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"4\" step=\"1\" value=\"1\">', '3', 5),
(56, 6, 6, '<p>以下は拡張子が.cssのファイルを削除するためのLinuxコマンドです。次の空欄Aに入る語句を答えてください。</p>\r\n<pre>\r\n$ <span class=\"answer-blank \">A</span>  *.css\r\n</pre>\r\n\r\n<p>選択肢</p>\r\n<pre>\r\n1. del　　2. delete　　3. rm　　4. remove\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"4\" step=\"1\" value=\"1\">', '3', 5),
(57, 6, 7, '<p>Gitの問題です。リポジトリに作業内容を記録する操作のことを何と呼ぶか答えてください。</p>\r\n<p>選択肢</p>\r\n<pre>\r\n1. コミット　　2. コラボレート　　3. レコーディング　　4. アド\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"4\" value=\"1\" step=\"1\">', '1', 5),
(58, 6, 8, '<p>Gitの問題です。ブランチを統合する操作を何と呼ぶか答えてください。</p>\r\n<p>選択肢</p>\r\n<pre>\r\n1. チェックイン　　2. チェックアウト　　3. マージ　　4. コンバイン\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"4\" value=\"1\" step=\"1\">', '3', 5),
(59, 6, 9, '<p>Gitの問題です。ローカルリポジトリからリモートリポジトリへブランチをアップロードすることを何と呼ぶか答えてください。</p>\r\n<p>選択肢</p>\r\n<pre>\r\n1. プッシュ　　2. フェッチ　　3. プル　　4. マージ\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"4\" value=\"1\" step=\"1\">', '1', 5),
(60, 6, 10, '<p>Gitの問題です。Gitの管理から除外するファイルやフォルダを指定するための設定ファイルを以下から選択してください。</p>\r\n<p>選択肢</p>\r\n<pre>\r\n1. .gitsettings　　2. .gitignore　　3. .gitfiles　　4. .gitlist\r\n</pre>', '<input type=\"number\" min=\"1\" max=\"4\" value=\"1\" step=\"1\">', '2', 5);

-- --------------------------------------------------------

--
-- テーブルの構造 `sc_scores`
--

CREATE TABLE `sc_scores` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  `submitted_at` date DEFAULT NULL,
  `answers` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `sc_scores`
--

INSERT INTO `sc_scores` (`id`, `exam_id`, `student_id`, `score`, `submitted_at`, `answers`) VALUES
(3, 1, 3, 0, NULL, NULL),
(4, 1, 4, 0, NULL, NULL),
(5, 1, 5, 0, NULL, NULL),
(8, 2, 3, 0, NULL, NULL),
(9, 2, 4, 0, NULL, NULL),
(10, 2, 5, 0, NULL, NULL),
(13, 3, 3, 0, NULL, NULL),
(14, 3, 4, 0, NULL, NULL),
(15, 3, 5, 0, NULL, NULL),
(16, 4, 1, 0, NULL, NULL),
(17, 4, 2, 0, NULL, NULL),
(18, 4, 3, 0, NULL, NULL),
(19, 4, 4, 0, NULL, NULL),
(20, 4, 5, 0, NULL, NULL),
(21, 5, 1, 0, NULL, NULL),
(23, 5, 3, 0, NULL, NULL),
(24, 5, 4, 0, NULL, NULL),
(25, 5, 5, 0, NULL, NULL),
(27, 6, 2, 0, NULL, NULL),
(28, 6, 3, 0, NULL, NULL),
(29, 6, 4, 0, NULL, NULL),
(30, 6, 5, 0, NULL, NULL),
(32, 6, 1, 0, '2022-05-31', NULL),
(37, 1, 1, 0, '2022-05-31', '{\"6\":\"\",\"7\":\"\"}'),
(39, 2, 1, 0, NULL, NULL),
(44, 5, 2, 0, '2022-06-01', '{}'),
(45, 2, 2, 15, '2022-06-01', '{\"1\":\"2\",\"2\":\"(int)\",\"3\":\"double\",\"4\":\"\",\"5\":\"String item : items\"}'),
(48, 1, 2, 40, '2022-06-02', '{\"6\":\"2\",\"7\":\"3\",\"13\":\"4\",\"14\":\"2\",\"15\":\"3\",\"16\":\"3\",\"17\":\"4\",\"18\":\"3\",\"19\":\"1\",\"20\":\"2\"}'),
(49, 3, 2, 5, '2022-06-03', '{\"21\":\"1\"}'),
(50, 3, 1, 50, '2022-07-06', '{\"21\":\"2\",\"22\":\"3\",\"23\":\"href\",\"24\":\"src\",\"25\":\"submit\",\"26\":\"href\",\"27\":\"color\",\"28\":\"2\",\"29\":\"2\",\"30\":\"4\"}');

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
(1, 'zd1A01', '88d4266fd4e6338d13b845fcf289579d209c897823b9217da3e161936f031589', 'Taro\r'),
(2, 'zd1A02', '88d4266fd4e6338d13b845fcf289579d209c897823b9217da3e161936f031589', 'Jiro\r'),
(3, 'zd1A03', '88d4266fd4e6338d13b845fcf289579d209c897823b9217da3e161936f031589', 'Hanako\r'),
(4, 'zd1A04', '88d4266fd4e6338d13b845fcf289579d209c897823b9217da3e161936f031589', 'Yoko\r');

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
(1, 'zdis56', 'e792ec48b511068744cb5018c2a309d7860becfcda5e00adceabbb2df54e59d8', '村岡 羊一'),
(2, 'zdis57', 'cc63035884240018085bacc74951562e2035a89ed724ea0c52b12008c0118c8b', '古川 みゆき');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sc_exams`
--
ALTER TABLE `sc_exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sc_questions`
--
ALTER TABLE `sc_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sc_scores`
--
ALTER TABLE `sc_scores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sc_students`
--
ALTER TABLE `sc_students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `zdid` (`zdid`);

--
-- Indexes for table `sc_teachers`
--
ALTER TABLE `sc_teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `zdid` (`zdid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sc_exams`
--
ALTER TABLE `sc_exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sc_questions`
--
ALTER TABLE `sc_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `sc_scores`
--
ALTER TABLE `sc_scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `sc_students`
--
ALTER TABLE `sc_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sc_teachers`
--
ALTER TABLE `sc_teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
