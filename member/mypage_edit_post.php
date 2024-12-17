<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/matchbreak/inc/session.php');
include '../inc/db.php'; // Include the modified db.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 폼 입력 값 받기 및 정리
    $user_id = $_POST['id'];
    $name = trim($_POST['name']);
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $major = $_POST['major'];

    $query_update = "UPDATE members SET name = ?, gender = ?, phone = ?, major = ? WHERE id = ?";
    $result_update = db_update($query_update, [$name, $gender, $phone, $major, $user_id]);
    if (!$result_update) {
        $message = "오류가 발생하여 수정하지 못했습니다.";
        echo "<script>alert('$message'); history.back(); </script>";
        exit;
    }

    $_SESSION['member_name'] = $name; // 세션에 회원 이름 저장

    $message = "수정이 완료되었습니다.";
    echo "<script>alert('$message'); window.location.replace('/matchbreak/member/mypage.php'); </script>";
    exit;
}
?>
