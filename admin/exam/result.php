<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/zd_course/utility/include.php";
auth_confirm("teacher");

$teacher = $_SESSION["login"];

// 結果の更新
if($_SERVER["REQUEST_METHOD"] === "POST") {
  $examId = $_POST["exam_id"];
  $scores = explode("\n", $_POST["scores"]);

  try {
    update_scores($scores, $examId);
  }
  catch (PDOException $e) {
    echo $e->getMessage();
    echo "<p>申し訳ありませんが、しばらく時間をおいてからアクセスしてください</p>";
    exit;
  }
}

// 結果一覧
try {
  $examList = get_exams();
  $scoreList = get_scores();
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
      <a href="/zd_course/admin/exam/schedule.php" class="btn btn-primary">科目リストの更新</a>
      <a href="/zd_course/admin/students/register.php" class="btn btn-primary">生徒リストの更新</a>
    </p>
    <hr>
    <h2>得点の更新</h2>
    <p><a class="btn btn-info" href="scores.csv" download="scores.csv">テンプレートCSV</a></p>
    <form action="" id="form" method="post" class="form">
      <select id="exam_id" name="exam_id">
        <?php foreach($examList as $exam): ?>
        <option value="<?php h($exam["id"]); ?>"><?php h($exam["title"]); ?></option>
        <?php endforeach; ?>
      </select>
      <input type="hidden" id="scores" name="scores">
      <input type="file" class="file_input">
    </form>

    <h2>結果一覧</h2>
    <table class="table">
      <tr>
        <th>科目 ≫</th>
        <?php foreach($examList as $exam): ?>
        <th><?php h($exam["title"]); ?></th>
        <?php endforeach; ?>
      </tr>

      <?php foreach($scoreList as $item): ?>
      <tr>
        <td><?php h($item["name"]) ?></td>
        <?php foreach($item["scores"] as $score): ?>
        <td><?php h($score); ?></td>
        <?php endforeach; ?>
      </tr>
      <?php endforeach; ?>
    </table>
  </main>
</div>
<script src="/zd_course/js/jquery-2.1.4.min.js"></script>
<script src="/zd_course/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
  let reader = new FileReader();
  reader.addEventListener('load', function(){
    $('#scores').val(reader.result);
    $("#form").submit();
  });

  $('.file_input').change(function(){
      reader.readAsText(this.files[0], 'UTF-8');
  });
});
</script>
</body>
</html>