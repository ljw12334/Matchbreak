<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='/matchbreak/css/root.css' type='text/css'>
    <link rel="stylesheet" href="/matchbreak/css/signup_2.css">

    <title>매치브레이크</title>
</head>

<body>
    <main>
        <a href="/matchbreak/index.php">
            <img src="/matchbreak/img/match_logo.svg" alt="Logo" id="logo-top">
        </a>

        <form method="POST" action="register_process.php">
            <div class="double-holder">
                <input id="user_id" class="input-small" type="text" name="user_id" placeholder="아이디" required>
                <button type="button" class="duplicate-check" onclick="existing_id();">중복확인</button>
            </div>
            <input class="input-box" type="password" name="password" placeholder="비밀번호" required>
            <input class="input-box" type="password" name="confirm_password" placeholder="비밀번호 확인" required>
            
            <div class="double-holder">
                <input class="input-small" type="text" name="name" placeholder="이름" required>
                <select name="gender" id="gender">
                    <option value="male" selected>남성</option>
                    <option value="female">여성</option>
                    <option value="disable">비공개</option>
                </select>
            </div>

            <input class="input-box" type="tel" name="phone" placeholder="전화번호" pattern="^010\d{4}\d{4}$" required>
            <input class="input-box" type="text" name="major" placeholder="학과" required>

            <button id="join" type="submit" class="round-box">회원가입</button>
            
        </form>
        
    </main>
</body>

<script src="signup_id_check.js"></script>

</html>