<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/zd_course/utility/include.php";
auth_confirm("teacher");

$teacher = $_SESSION["login"];

// 結果の更新
if($_SERVER["REQUEST_METHOD"] === "POST") {
  $id = $_POST["id"];
  $testedAt = $_POST["tested_at"];
  $title = $_POST["title"];
  $fullscore = $_POST["fullscore"];
  $summery = $_POST["summery"];

  try {
    update_exams($id, $testedAt, $title, $fullscore, $summery);
  }
  catch (PDOException $e) {
    echo $e->getMessage();
    echo "<p>申し訳ありませんが、しばらく時間をおいてからアクセスしてください</p>";
    exit;
  }
}

try {
  $examList = get_exams();
}
catch (PDOException $e) {
  echo $e->getMessage();
  echo "<p>申し訳ありませんが、しばらく時間をおいてからアクセスしてください</p>";
  exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Scores</title>
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
              [<?php h($teacher["zdid"]); ?>]
              <?php h($teacher["name"]); ?>さん
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
      <a href="/zd_course/admin/exam/result.php" class="btn btn-primary">得点の入力</a>
      <a href="/zd_course/admin/students/register.php" class="btn btn-primary">生徒リストの更新</a>
    </p>
    <hr>
    <h2>小テストスケジュール</h2>
    <table class="table">
      <tr>
        <th>日付</th>
        <td>科目名</td>
        <td>満点</td>
        <td>内容</td>
        <td>操作</td>
      </tr>
      <?php foreach($examList as $exam): ?>
      <tr>
        <form action="" method="post" class="form">
          <td><input type="date" name="tested_at" value="<?php h($exam["tested_at"]); ?>"></td>
          <td><input type="text" name="title" value="<?php h($exam["title"]); ?>"></td>
          <td><input type="number" name="fullscore" value="<?php h($exam["fullscore"]); ?>"></td>
          <td><textarea name="summery" cols="50" rows="5"><?php h($exam["summery"]); ?></textarea></td>
          <td><input type="hidden" name="id" value="<?php h($exam["id"]); ?>">
              <input type="submit" class="btn btn-success" value="更新"></td>
        </form>
      </tr>
      <?php endforeach; ?>
    </table>
  </main>
</div>
<script src="/zd_course/js/jquery-2.1.4.min.js"></script>
<script src="/zd_course/js/bootstrap.min.js"></script>
</body>
</html>