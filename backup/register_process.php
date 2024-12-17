<?php
session_start();
include '../inc/db.php'; // Include the modified db.php

// 회원가입 폼이 제출되었을 때 처리
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 폼 입력 값 받기 및 정리
    $user_id = trim($_POST['user_id']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $name = trim($_POST['name']);
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $birth_date = $_POST['birth_date'];

    // 비밀번호 일치 여부 확인
    if ($password !== $confirm_password) {
        echo "비밀번호가 일치하지 않습니다.";
        exit;
    }

    // 비밀번호 해싱
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // 사용자 아이디 중복 확인
    $query = "SELECT * FROM members WHERE id = ?";
    $existing_user = db_select($query, [$user_id]);

    if ($existing_user) {
        echo "이미 존재하는 아이디입니다.";
        exit;
    }

    // 새로운 사용자 데이터 삽입
    $query = "INSERT INTO members (id, pw, name, gender, phone, birth) VALUES (?, ?, ?, ?, ?, ?)";
    $result = db_insert($query, [$user_id, $hashed_password, $name, $gender, $phone, $birth_date]);

    if ($result) {
        // 회원가입 성공 시 메인 페이지로 리디렉션
        echo "회원가입 성공. 로그인 해주세요..";
        header('/matchbreak/member/login.php');
        exit;
    } else {

    }
}
?>
