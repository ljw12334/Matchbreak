<?php
require($_SERVER['DOCUMENT_ROOT']."/matchbreak/inc/db.php");
$selected = isset($_GET["date"]) ? $_GET["date"] : date("Ymd");

$query = "SELECT * FROM matches WHERE matchDate = ?";
$result = db_select($query, [$selected]);

if (!$result) {
    $times = array(
        array('1400', '1600'),
        array('1600', '1800'),
        array('1800', '2000')
    );

    foreach ($times as $t) {
        $insert_query = "INSERT INTO matches (matchDate, startTime, endTime) VALUES (?, ?, ?)";
        $insert_result = db_insert($insert_query, [$selected, $t[0], $t[1]]);
        if (!$insert_result) {
            $message = "알 수 없는 에러가 발생하였습니다.";
            echo "<script>alert('$message'); history.back(); </script>";
            exit;
        }
    }
}
?>