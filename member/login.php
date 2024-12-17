<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='/matchbreak/css/root.css' type='text/css'>
    <link rel="stylesheet" href="/matchbreak/css/login.css">

    <title>매치브레이크</title>
</head>

<body>
    <main>
        <a href="/matchbreak/index.php">
            <img src="/matchbreak/img/match_logo.svg" alt="Logo" id="logo-top">
        </a>

        <form method="POST" action="login_post.php">
            <input id="id" type="text" name="id" placeholder="아이디" required />
            <input id="pw" type="password" name="pw" placeholder="비밀번호" required />
            <div class="login-check">
                <label for="keep-login">
                    <input id="keep-login" name="keep-login" type="checkbox">
                    로그인 유지
                </label>
                
            </div>
            <div class="find">
                <a href="find_id.php">아이디 찾기</a> | <a href="find_password.php">비밀번호 찾기</a>
            </div>
            <button type="submit" class="round-box" id="login">로그인</button>
            
        </form>
        <a href="signup.php">
            <button class="round-box" id="join">회원가입</button>
        </a>
        
    </main>
</body>

</html>
