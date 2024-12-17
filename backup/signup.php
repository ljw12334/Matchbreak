<?php
session_start(); // 세션 시작
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='/matchbreak/css/root.css' type='text/css'>
    <link rel="stylesheet" href="/matchbreak/css/signup.css" type='text/css'>

    <title>회원가입 - MatchBreak</title>
</head>

<body>

    <div class="signup-container">

        <a href="/matchbreak/index.php">
            <img src="/matchbreak/img/match_logo.svg" alt="Logo" id="logo-top">
        </a>

        <h3>회원정보 입력</h3>

        <form action="register_process.php" method="POST">
            <div id="id-container">
                <input type="text" name="user_id" placeholder="아이디" required>
                <button type="button" class="duplicate-check">중복확인</button>
            </div>
            <input type="password" name="password" placeholder="비밀번호" required>
            <input type="password" name="confirm_password" placeholder="비밀번호 확인" required>
            
            <input type="text" name="name" placeholder="이름" required>
            
            <!-- 성별 선택 -->
            <select name="gender" id="gender" required>
                <option value="M" selected>남성</option>
                <option value="F">여성</option>
                <option value="N">비공개</option>
            </select>
            
            
            <!-- 전화번호 입력 -->
            <input type="tel" name="phone" placeholder="전화번호" pattern="^010\d{4}\d{4}$" required>
            
            
            <!-- 생년월일 입력 -->
            <input type="date" name="birth_date" placeholder="생년월일" required>
            
            <button type="submit" class="signup-button">회원가입</button>
        </form>
    </div>

</body>

</html>