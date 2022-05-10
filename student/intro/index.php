<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/zd_course/utility/include.php";

// ログイン認証
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
        <h1>自己紹介</h1>
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
    <p>
    <a href="upload.php" class="btn btn-success">自己紹介をアップする</a>
    <a href="introduction.zip" class="btn btn-warning">自己紹介テンプレート</a>
    </p>
    <hr>
    <h2>自己紹介を見る</h2>
    <ul class="intro">
      <?php for($i = 1; $i <= 30; $i++): ?>
        <?php $idNum = $i < 10 ? "0" . $i : $i; ?>
        <li>
          <a href="s<?php h($idNum); ?>/index.html" target="_blank"><?php h($idNum); ?></a>
        </li>
        <?php endfor; ?>
    </ul>
  </main>
</div>
<script src="/zd_course/js/jquery-2.1.4.min.js"></script>
<script src="/zd_course/js/bootstrap.min.js"></script>
</body>
</html>