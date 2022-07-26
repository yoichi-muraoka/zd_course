<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/zd_course/utility/include.php";
auth_confirm("teacher");

$teacher = $_SESSION["login"];

$id = $_GET["id"];
if(!isset($id)) {
  header("Location: schedule.php");
  return;
}

if($_SERVER["REQUEST_METHOD"] === "POST") {
  $examId = $_POST["exam_id"];
  $num = $_POST["num"];
  $sentence = $_POST["sentence"];
  $answer = $_POST["answer"];
  $rightAnswer = $_POST["right_answer"];
  $score = $_POST["score"];

  try {
    update_question($examId, $num, $sentence, $answer, $rightAnswer, $score, $id);
    header("Location: examPreview.php?exam_id={$examId}");
    return;
  }
  catch (PDOException $e) {
    echo $e->getMessage();
    echo "<p>申し訳ありませんが、しばらく時間をおいてからアクセスしてください</p>";
    exit;
  }
}


try {
  $question = get_question($id);
  $exams = get_exams(); // 試験一覧
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
  <title>設問登録</title>
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
    <form action="" method="post">
      <h2>設問の追加</h2>
      <p>単元:
        <select name="exam_id">
          <?php foreach($exams as $exam): ?>
            <option value="<?php echo $exam["id"]; ?>"
                   <?php echo $question["exam_id"] == $exam["id"] ? "selected" : "" ?> >
              <?php echo $exam["title"]; ?>
            </option>
          <?php endforeach; ?>
        </select>
      </p>
      <p>設問番号:
        <select name="num">
          <?php for($i = 1; $i <= 15; $i++): ?>
            <option <?php echo $i == $question["num"] ? "selected" : "" ?>>
            <?php echo $i; ?></option>
          <?php endfor; ?>
        </select>
      </p>
      <p>配点:
        <select name="score">
          <?php for($i = 1; $i <= 10; $i++): ?>
            <option value="<?php echo $i; ?>" <?php echo $i == $question["score"] ? "selected" : "" ?>>
            <?php echo $i; ?>点</option>
          <?php endfor; ?>
        </select>
      </p>
      <p>問題文:<br>
        <textarea name="sentence" class="w-100 h-10em lh-1"><?php echo $question["sentence"]; ?></textarea>
      </p>
      <p>解答欄:<br>
        <textarea name="answer" class="w-100 h-10em lh-1"><?php echo $question["answer"]; ?></textarea>
      </p>
      <p>正答:
        <input type="text" name="right_answer" class="w-100" value="<?php echo $question["right_answer"]; ?>">
      </p>
      <p>
        <input type="submit" class="btn btn-primary" value="更新">
        <a href="examPreview.php?exam_id=<?php echo $question["exam_id"]; ?>" class="btn btn-success">キャンセル</a>
      </p>
    </form>
  </main>
</div>
<script src="/zd_course/js/jquery-2.1.4.min.js"></script>
<script src="/zd_course/js/bootstrap.min.js"></script>
</body>
</html>