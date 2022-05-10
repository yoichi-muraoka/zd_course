<?php
session_start();
require_once "../utility/include.php";

// 生徒情報
$student = $_SESSION["login"];

auth_confirm();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Java Course</title>
  <link rel="stylesheet" href="/zd_course/css/styles.css">
</head>
<body>
<header class="admin-header">
  <div class="container">
    <nav class="navbar navbar-default">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <h1><?php echo COURSE_NAME; ?> 
          <span style="font-size: 0.5em;">
          [<?php echo COURSE_START . ' ～ ' . COURSE_END; ?>]
          </span>
        </h1>
      </div>
      <div class="collapse navbar-collapse" id="mynavbar">
        <ul class="nav navbar-nav navbar-right mt10">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="glyphicon glyphicon-user"></span>
              [<?php h($student["zdid"]); ?>]
              <?php h($student["name"]); ?>さん
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="/zd_course/logout.php">ログアウト</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</header>
<div class="container admin-container">
  <main>
    <h2>コース運営</h2>
    <ul>
      <li><a href="https://s21.studirus.com" target="_blank">Studirus</a></li>
      <li><a href="<?php echo COURSE_GOOGLE_DRIVE_URL; ?>" target="_blank">Google Drive</a></li>
      <li><a href="<?php echo COURSE_TEMP_CODE_URL; ?>" target="_blank">Temp Code (コードの一時共有)</a></li>
      <li><a href="/zd_course/student/exam/" target="_blank">小テスト日程／得点</a></li>
      <li><a href="/zd_course/student/intro/" target="_blank">自己紹介</a></li>
    </ul>
    <h2>その他</h2>
    <ul>
      <li><a href="https://www.udemy.com/ja/" target="_blank">Udemy</a></li>
      <li><a href="https://dotinstall.com/" target="_blank">ドットインストール</a></li>
      <li><a href="https://prog-8.com/" target="_blank">Progate</a></li>
      <li><a href="https://pronuncian.com/sounds" target="_blank">発音とスペリング参考</a></li>
      <li><a href="https://dokojava.jp/sources/Main.java" target="_blank">dokojava：環境構築をせずに簡単なコードが試せるサービス</li>
      <li><a href="https://sukkiri.jp/books/sukkiri_java3" target="_blank">書籍紹介：スッキリわかるJava入門</li>
    </ul>
  </main>
</div>
<script src="/zd_course/js/jquery-2.1.4.min.js"></script>
<script src="/zd_course/js/bootstrap.min.js"></script>
</body>
</html>