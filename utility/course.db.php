<?php
/*--------------------
      得点の取得
----------------------*/
function get_scores_by_zdid($zdid) {
  $pdo = db_init();
  $sql = "SELECT * FROM sc_scores
          JOIN sc_exams
          ON sc_scores.exam_id = sc_exams.id
          JOIN sc_students
          ON sc_scores.student_id = sc_students.id
          WHERE tested_at < CURDATE()
            AND sc_students.zdid = ?
          ORDER BY tested_at";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$zdid]);
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function get_scores_by_exam_id($examId) {
  $pdo = db_init();
  $sql = "SELECT score, name from sc_scores
          JOIN sc_students
          ON sc_scores.student_id = sc_students.id
          WHERE exam_id = ?
          ORDER BY student_id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$examId]);
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_scores_by_student_id($studentId) {
  $pdo = db_init();
  $sql = "SELECT score from sc_scores
          WHERE student_id = ?
          ORDER BY exam_id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$studentId]);
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $resultSet = [];
  foreach($result as $item) {
    $resultSet[] = $item["score"];
  }
  return $resultSet;
}

function get_scores() {
  $pdo = db_init();
  $sql = "SELECT id, name FROM sc_students";
  $stmt = $pdo->query($sql);
  $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if(count($students) == 0) {
    return null;
  }

  $resultSet = [];
  $result["name"] = "";
  $reslut["scores"] = [];
  foreach($students as $student) {
    $result["name"] = $student['name'];
    $result["scores"] = get_scores_by_student_id($student["id"]);
    $resultSet[] = $result;
  }
  return $resultSet;
}

/*--------------------
 得点のアップデート
----------------------*/
function update_score($studentId, $examId, $score) {
  $pdo = db_init();
  $sql = "DELETE FROM sc_scores WHERE student_id = ? AND exam_id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$studentId, $examId]);

  $sql = "INSERT INTO sc_scores VALUES (NULL, ?, ?, ?)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$examId, $studentId, $score]);
}

function update_scores($scoreList, $examId) {
  $pdo = db_init();
  $sql = "DELETE FROM sc_scores WHERE exam_id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$examId]);

  $count = count($scoreList);
  $sql = "INSERT INTO sc_scores (exam_id, student_id, score) VALUES ";
  $params = [];
  for($i = 0; $i < $count; $i++) {
    if($i != $count - 1) {
      $sql .= "(?, ?, ?), ";
    } else {
      $sql .= "(?, ?, ?)"; 
    }

    $params[] = $examId;
    $params[] = $i + 1; // studentId
    $params[] = $scoreList[$i];
  }

  $stmt = $pdo->prepare($sql);
  $stmt->execute($params);
}


/*------------------
   全得点を0点にする
-------------------*/
function all_scores_to_zero() {
  $exams = get_exams();
  $students = get_students();

  $pdo = db_init();
  $sql = "TRUNCATE TABLE sc_scores";
  $pdo->exec($sql);

  $sql = "INSERT INTO sc_scores VALUES (NULL, ?, ?, 0)";
  $stmt = $pdo->prepare($sql);
  foreach($exams as $exam) {
    foreach($students as $student) {
      $stmt->execute([$exam["id"], $student["id"]]);
    }
  }
}


/*-------------------
    試験日程テーブル
--------------------*/
function get_exams() {
  $pdo = db_init();
  $sql = "SELECT * FROM sc_exams";
  $stmt = $pdo->query($sql);
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function update_exams($id, $testedAt, $title, $fullscore, $summery) {
  $pdo = db_init();
  $sql = "UPDATE sc_exams 
          SET tested_at = ?, title = ?, fullscore = ?, summery = ?
          WHERE id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$testedAt, $title, $fullscore, $summery, $id]);
}


/*-----------------
    生徒テーブル
------------------*/
function get_students() {
  $pdo = db_init();
  $sql = "SELECT * FROM sc_students";
  $stmt = $pdo->query($sql);
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_student_name($id) {
  $pdo = db_init();
  $sql = "SELECT name FROM sc_students WHERE id = ?";
  $stmt = $pdo->query($sql);
  $info = $stmt->fetch(PDO::FETCH_ASSOC);
  return $info["name"];
}

function reset_students() {
  $pdo = db_init();
  $sql = "TRUNCATE TABLE sc_students";
  $pdo->exec($sql);
}

function insert_student($zdid, $pass, $name) {
  $hashed = hash('sha256', $pass);
  $pdo = db_init();
  $sql = "INSERT INTO sc_students VALUES (NULL, ?, ?, ?)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$zdid, $hashed, $name]);
}

function insert_students($students) {
  $params = [];
  foreach($students as $student){
    $params[] = $student["zdid"];
    $params[] = hash("sha256", $student["pass"]);
    $params[] = $student["name"];
  }

  $pdo = $pdo = db_init();
  $sql = "INSERT INTO sc_students (zdid, pass, name) VALUES ";
  $count = count($students);
  for($i = 0; $i < $count; $i++) {
    if($i != $count - 1) {
      $sql .= "(?, ?, ?), ";
    } else {
      $sql .= "(?, ?, ?)"; 
    }
  }

  $stmt = $pdo->prepare($sql);
  $stmt->execute($params);
}

function get_student_by_zdid($zdid) {
  $pdo = db_init();
  $stmt = $pdo->prepare("SELECT * FROM sc_students WHERE zdid = ?");
  $stmt->execute([$zdid]);
  return $stmt->fetch(PDO::FETCH_ASSOC);
}

/*--------------------
    講師テーブル
--------------------*/
function get_teacher_by_zdid($zdid) {
  $pdo = db_init();
  $stmt = $pdo->prepare("SELECT * FROM sc_teachers WHERE zdid = ?");
  $stmt->execute([$zdid]);
  return $stmt->fetch(PDO::FETCH_ASSOC);
}