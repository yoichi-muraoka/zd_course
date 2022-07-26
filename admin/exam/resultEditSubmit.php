<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/zd_course/utility/include.php";
auth_confirm("teacher");

// GETメソッドの場合、リダイレクト
if(!is_post()) {
  send_redirect("result.php", false);
}

$studentId = $_POST["student_id"];
$examId = $_POST["exam_id"];
$editedScore = $_POST["edited_score"];

if(isset($_POST["edit_score"])) {
  // 得点の更新
  fix_score($studentId, $examId, $editedScore);
}
else {
  // 未受験状態に設定
  reset_score($studentId, $examId);
}

send_redirect("result.php", false);