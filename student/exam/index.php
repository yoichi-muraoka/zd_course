<?php
session_start();
require_once "../../utility/include.php";

auth_confirm();

// 生徒情報
$student = $_SESSION["login"];

// 小テスト結果
try {
  $pdo = db_init();
  $sql = "SELECT * FROM sc_scores
          JOIN sc_exams
          ON sc_scores.exam_id = sc_exams.id
          WHERE tested_at <= CURDATE()
            AND student_id = ?
          ORDER BY tested_at";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([get_num_from_zdid($student["zdid"])]);
  $scoreList = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
  echo "<p>申し訳ありませんが、しばらく時間をおいてからアクセスしてください</p>";
  exit;
}

// 小テスト日程
try {
  $pdo = db_init();
  $sql = "SELECT * FROM sc_exams WHERE tested_at >= CURDATE()";
  $stmt = $pdo->query($sql);
  $examList = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
  // echo $e->getMessage();
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
        <h1>Scores</h1>
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
    <h2>小テスト結果</h2>
    <table class="table">
      <tr>
        <th>日付</th>
        <th>科目</th>
        <th>得点</th>
        <th>得点率</th>
      </tr>
      <?php foreach($scoreList as $score): ?>
      <tr>
        <td><?php h($score["tested_at"]); ?></td>
        <td><?php h($score["title"]); ?></td>
        <td>
          <?php h($score["score"]); ?> /
          <?php h($score["fullscore"]); ?>点
        </td>
        <td><?php echo percent($score["score"],$score["fullscore"]); ?>％</td>
      </tr>
      <?php endforeach; ?>
    </table>
    <h2>小テスト日程</h2>
    <table class="table">
      <tr>
        <th>日付</th>
        <th>科目</th>
        <th>内容</th>
      </tr>
      <?php foreach($examList as $exam): ?>
      <tr>
        <td><?php h($exam["tested_at"]); ?></td>
        <td><?php h($exam["title"]); ?></td>
        <td><?php echo nl2br($exam["summery"]); ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </main>
</div>
<script src="/zd_course/js/jquery-2.1.4.min.js"></script>
<script src="/zd_course/js/bootstrap.min.js"></script>
</body>
</html>