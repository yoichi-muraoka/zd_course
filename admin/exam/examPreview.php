<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/zd_course/utility/include.php";
auth_confirm("teacher");

$teacher = $_SESSION["login"];

$examId = $_GET["exam_id"];
if(!isset($examId)) {
  header("Location: schedule.php");
  return;
}

try {
  $questionList = get_questions($examId);
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
      <a href="/zd_course/admin/exam/examAdd.php?exam_id=<?php echo $examId; ?>" class="btn btn-primary">問題の追加</a>
      <a href="/zd_course/admin/exam/schedule.php" class="btn btn-success">試験日程に戻る</a>
    </p>
    <hr>
    <?php foreach($questionList as $question): ?>
      <section>
        <h2>問<?php echo $question["num"]; ?></h2>
        <?php echo $question["sentence"]; ?>
        <h3>答え</h3>
        <?php echo $question["answer"]; ?>
        <p>
          正解: <?php echo $question["right_answer"]; ?>　
          配点: <?php echo $question["score"]; ?>
        </p>
        <p><a href="examEdit.php?id=<?php echo $question["id"]; ?>" class="btn btn-warning">編集</a></p>
        <hr>
      </section>
    <?php endforeach; ?>
  </main>
</div>
<script src="/zd_course/js/jquery-2.1.4.min.js"></script>
<script src="/zd_course/js/bootstrap.min.js"></script>
<script>
// 問題文中のHTMLタグを表示
function htmlToReference() {
  $('pre.html-code').each(function() {
    const html = $(this).html();
    $(this).text(html);
  });
}

$(document).ready(function() {
  htmlToReference();
});
</script>
</body>
</html>