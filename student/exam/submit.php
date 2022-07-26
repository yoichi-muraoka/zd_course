<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/zd_course/utility/include.php";
auth_confirm("student");

if(!is_post()) {
  send_redirect("student/exam");
}

// 必要なデータの取り出し
$loginUser = $_SESSION["login"];
$examId = $_POST["exam_id"];
$jsonAnswers = $_POST["answers"];

try {
  // 正答の取得
  $questions = get_questions($examId);

  // 解答を配列に連想変換 [問題番号 => 解答]
  $answers = json_decode($jsonAnswers, true);

  // 解答と正答との比較⇒得点を算出
  $totalScore = 0;
  foreach($questions as $question) {
    // 正答と解答をトリムして比較
    $rightAnswer = str_replace(" ", "", $question["right_answer"]);
    $answer = str_replace(" ", "", $answers[$question["id"]]);
    if($rightAnswer === $answer) {
      $totalScore += $question["score"];
    }
  }

  // データベースに得点, 解答を登録
  update_score($loginUser["id"], $examId, $totalScore, date("Y-m-d"), $jsonAnswers);

  // リダイレクト
  send_redirect("finished.php?exam_id=" . $examId, false);
} catch(PDOException $e) {
  echo $e->getMessage();
  echo "<p>申し訳ありませんが、しばらく時間をおいてからアクセスしてください</p>";
  exit;
}