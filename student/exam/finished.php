<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/zd_course/utility/include.php";
auth_confirm("student");

// 生徒情報
$loginUser = $_SESSION["login"];

// 試験ID
$examId = $_GET["exam_id"];
if(!isset($examId)) {
  header("Location: index.php");
  return;
}

try {
  // 試験IDを元にテスト問題を取得
  $exam = get_exam_by_id($examId);
  $questionList = get_questions($examId);
  // 生徒ID, 試験IDを元に得点と解答を取得
  $score = get_score($examId, $loginUser["id"]);
  // 解答を配列に連想変換 [問題番号 => 解答]
  $answers = json_decode($score["answers"], true);
} catch(PDOException $e) {
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
  <title>小テスト</title>
  <link rel="stylesheet" href="/zd_course/css/styles.css">
</head>
<body>
  <?php require_once $_SERVER["DOCUMENT_ROOT"] . "/zd_course/parts/header.php"; ?>

<div class="container admin-container">
  <main>
    <div class="exam-result">
      <div>
        <h1><?php echo $exam["title"]; ?></h1>
        <p>実施日: <?php echo $exam["tested_at"]; ?></p>
      </div>
      <p><span><?php echo $score["score"]; ?></span>点</p>
    </div>

  <?php foreach($questionList as $question): ?>
    <section class="q-section" data-question-id="<?php echo $question["id"]; ?>">
      <h2>問<?php echo $question["num"]; ?></h2>
        <p>配点: <?php echo $question["score"]; ?></p>
        <?php echo $question["sentence"]; ?>
        <h3 class="answer" data-answer="<?php echo $answers[$question["id"]]; ?>">あなたの答え</h3>
        <?php echo $question["answer"]; ?>
        <h3 class="right-answer">正解</h3>
        <input type="text" readonly value="<?php echo $question["right_answer"]; ?>">
        <hr>
      </section>
      <?php endforeach; ?>
    <a class="btn btn-primary" href="index.php">戻る</a>
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
  htmlToReference();
  setAnswers();
});
</script>
</body>
</html>