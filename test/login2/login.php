<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./vars.css">
    <link rel="stylesheet" href="./login.css">

    <title>Main</title>
</head>

<body>
    <main>
        <img src="img/logo.png" alt="Logo" id="logo">

        <form method="POST" action="login.post.php">
            <input id="id" type="text" name="username" placeholder="아이디" required />
            <input id="pw" type="password" name="password" placeholder="비밀번호" required />
            <div class="login-check">
                <input type="checkbox">
                로그인 유지
            </div>
            <div class="find">
                <a href="find_id.php">아이디 찾기</a> | <a href="find_password.php">비밀번호 찾기</a>
            </div>
            <button type="submit" class="round-box" id="login">로그인</button>
            <button class="round-box" id="join"><a href="signup.php">회원가입</a></button>
            
        </form>
        <!-- 로고 이미지 삽입 -->
        
    </main>
</body>

</html>
