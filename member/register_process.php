<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/matchbreak/inc/session.php');
include '../inc/db.php'; // Include the modified db.php

// 회원가입 폼이 제출되었을 때 처리
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 폼 입력 값 받기 및 정리
    $user_id = trim($_POST['user_id']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $name = trim($_POST['name']);
    $gender = $_POST['gender']; // gender 값 받기
    $phone = $_POST['phone'];
    $major = $_POST['major'];

    // 비밀번호 일치 여부 확인
    if ($password !== $confirm_password) {
        $message = "비밀번호가 일치하지 않습니다.";
        echo "<script>alert('$message'); history.back(); </script>";
        exit;
    }

    // 비밀번호 해싱
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // 사용자 아이디 중복 확인
    $query = "SELECT * FROM members WHERE id = ?";
    $existing_user = db_select($query, [$user_id]);

    if ($existing_user) {
        $message = "이미 존재하는 아이디입니다.";
        echo "<script>alert('$message'); history.back(); </script>";
        exit;
    }

    // 새로운 사용자 데이터 삽입
    $query = "INSERT INTO members (id, pw, name, gender, phone, major) VALUES (?, ?, ?, ?, ?, ?)";
    $result = db_insert($query, [$user_id, $hashed_password, $name, $gender, $phone, $major]);

    if ($result) {
        // 회원가입 성공 시 메인 페이지로 리디렉션
        $message = "회원가입이 완료되었습니다.";
        echo "<script>alert('$message'); window.location.replace('/matchbreak/member/login.php'); </script>";
        exit;
    } else {
        $message = "회원가입 실패.관리자에게 문의하세요.";
        echo "<script>alert('$message'); history.back(); </script>";
        exit;
    }
}
?>
