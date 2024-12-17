<?php
require($_SERVER['DOCUMENT_ROOT']."/matchbreak/inc/db.php");
require_once($_SERVER['DOCUMENT_ROOT'].'/matchbreak/inc/session.php');
if (!isset($_SESSION['member_id'])) {
    echo "<script> window.location.replace('/matchbreak/member/login.php'); </script>";
}


$date = $_POST["date"];
$start_time = $_POST["start-time"];
$end_time = $_POST["end-time"];

$start_time_conv = substr($start_time, 0, 2).":".substr($start_time, 2, 2);
$end_time_conv = substr($end_time, 0, 2).":".substr($end_time, 2, 2);

$query = "SELECT * FROM matches WHERE matchDate = ? AND startTime = ? AND endTime = ?";
$result = db_select($query, [$date, $start_time, $end_time]);

$user_id = $_SESSION['member_id'];
$match_id = $result[0]['matchID'];

if (!$result) {
    $message = "해당 매치가 존재하지 않습니다.";
    echo "<script>alert('$message'); window.location.replace('/matchbreak/index.php'); </script>";
    exit;
}

$query_select = "SELECT * FROM matches_applied WHERE match_id = ? AND member_id = ?";
$result_select = db_select($query_select, [$match_id, $user_id]);
if ($result_select) {
    $message = "이미 신청한 매치입니다.";
    echo "<script>alert('$message'); window.location.replace('/matchbreak/index.php'); </script>";
    exit;
}

$column = false;
for ($i = 1; $i <= 12; $i++) {
    $column_name = 'member'.$i;
    if ($result[0][$column_name] === null) {
        $column = $column_name;
        break;
    }
}
if (!$column) {
    $message = "인원이 가득 찼습니다.";
    echo "<script>alert('$message'); window.location.replace('/matchbreak/index.php'); </script>";
    exit;
}

$query_update = "UPDATE matches SET ".$column." = ? WHERE matchID = ?";
$result_update = db_update($query_update, [$user_id, $match_id]);
if (!$result_update) {
    $message = "신청 중 오류가 발생하였습니다.";
    echo "<script>alert('$message'); window.location.replace('/matchbreak/index.php'); </script>";
    exit;
}
$query_insert = "INSERT INTO matches_applied (match_id, member_id) VALUES (?, ?)";
$result_insert = db_insert($query_insert, [$match_id, $user_id]);
if (!$result_update) {
    $message = "신청 중 오류가 발생하였습니다.";
    echo "<script>alert('$message'); window.location.replace('/matchbreak/index.php'); </script>";
    exit;
}

setcookie('match_done_id', $match_id, time() + 300000, '/');
?>
<script>window.location.replace('/matchbreak/match/match_done.php'); </script>