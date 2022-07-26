<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/zd_course/utility/include.php";
auth_confirm("teacher");

$teacher = $_SESSION["login"];

// 生徒ID, 試験ID
$studentId = $_GET["student_id"];
$examId = $_GET["exam_id"];
if(!isset($studentId) || !isset($examId)) {
  header("Location: index.php");
  return;
}

try {
  // 生徒IDを元に生徒氏名を取得
  $studentName = get_student_name($studentId);
  // 試験IDを元にテスト問題を取得
  $exam = get_exam_by_id($examId);
  $questionList = get_questions($examId);
  // 生徒ID, 試験IDを元に得点と解答を取得
  $score = get_score($examId, $studentId);
  // 未受験の場合
  if($score["answers"] == null) {
    send_redirect("result.php", false);
  }
  // 解答を配列に連想変換 [問題番号 => 解答]
  $answers = json_decode($score["answers"], true);
}
catch(PDOException $e) {
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
  <title>生徒の答案</title>
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
    <div class="exam-result">
      <div>
        <h1><?php echo $exam["title"]; ?> <span class="student-name">[ <?php echo $studentName; ?> ]</span></h1>
        <p>実施日: <?php echo $exam["tested_at"]; ?></p>
      </div>
      <p><span><?php echo $score["score"]; ?></span>点</p>
    </div>
    <div class="edit-score-buttons">
      <button id="edit-score" class="btn btn-warning">得点を修正する</button>
      <button id="edit-status" class="btn btn-danger">未受験状態にする</button>
      <form action="resultEditSubmit.php" method="post">
        <input type="hidden" name="student_id" value="<?php echo $studentId; ?>">
        <input type="hidden" name="exam_id" value="<?php echo $examId; ?>">
        <div class="edit-score hide">
          修正後の得点: <input type="number" name="edited_score" min="0" step="1" value="<?php echo $score["score"]; ?>">
          <input type="submit" class="btn btn-secondary" name="edit_score" value="得点修正を確定する">
        </div>
        <div class="edit-status hide">
          <label>
            <input type="checkbox" id="edit-status-check">
            解答と得点を削除し、未受験状態にする
          </label>
          <input type="submit" class="btn btn-secondary hide" name="edit_status" value="状態変更を確定する">
        </div>
      </form>
    </div>

  <?php foreach($questionList as $question): ?>
    <section class="q-section" data-question-id="<?php echo $question["id"]; ?>">
      <h2>問<?php echo $question["num"]; ?></h2>
        <p>配点: <?php echo $question["score"]; ?></p>
        <?php echo $question["sentence"]; ?>
        <h3 class="answer" data-answer="<?php echo $answers[$question["id"]]; ?>">生徒の答え</h3>
        <?php echo $question["answer"]; ?>
        <h3 class="right-answer">正解</h3>
        <input type="text" readonly value="<?php echo $question["right_answer"]; ?>">
        <hr>
      </section>
      <?php endforeach; ?>
    <a class="btn btn-primary" href="result.php">戻る</a>
  </main>
</div>
<script src="/zd_course/js/jquery-2.1.4.min.js"></script>
<script src="/zd_course/js/bootstrap.min.js"></script>
<script>
/**
 * 解答を解答欄に入れていく
 */
function setAnswers() {
  $('.q-section').each(function() {
    const answer = $(this).find('.answer').attr('data-answer');
    console.log(answer)
    $(this).find('input:not([readonly])').val(answer).attr('readonly', 'readonly');
    // 正解・不正解で色分け
    if(answer.replace(/\s+/g, '') == $(this).find('.right-answer + input').val().replace(/\s+/g, '')) {
      $(this).find('.answer + input').addClass('correct').after('<span>✓</span>');
      $(this).find('.right-answer, .right-answer + input').hide();
    } else {
      $(this).find('.answer + input').addClass('incorrect').after('<span>✗</span>');
    }
  });
}

$(document).ready(function() {
  // 解答を解答欄に入れていく
  setAnswers();

  // ボタンの有効化
  $('#edit-score, #edit-status').click(function() {
    $('.' + $(this).attr('id')).toggleClass('hide');
    $('#edit-status-check').prop('checked', false);
  });

  $('#edit-status-check').change(function() {
    if($(this).prop('checked')) {
      $(this).parent().next().removeClass('hide');
    } else {
      $(this).parent().next().addClass('hide');
    }
  });
});
</script>
</body>
</html>