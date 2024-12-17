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
    <div class="div">
        <div class="rectangle-6"></div>
        <div class="rectangle-7"></div>
        <form method="POST" action="login.php">
            <input class="input-id" type="text" name="username" placeholder="아이디" required />
            <input class="input-password" type="password" name="password" placeholder="비밀번호" required />
            <div class="div4">로그인 유지</div>
            <div class="div5"><a href="find_id.php">아이디 찾기</a> | <a href="find_password.php">비밀번호 찾기</a></div>
            <button type="submit" class="rectangle-8">로그인</button>
            <a href="signup.php" class="rectangle-9">회원가입</a>
        </form>
        <!-- 로고 이미지 삽입 -->
        <img src="img/logo.png" alt="Logo" class="image-34">
    </div>
</body>

</html>
