<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <title>MatchBreak</title>

    <!-- 사진 추가 -->
    <div class="image-container">
        <img src="img/match.jpg" alt="Match Image">
    </div>
</head>
<style>
    body {
        background-color: #D7EDD8;
    }

    .controls {
        margin-bottom: 20px;
    }

    .image-container {
        margin: 20px 0;
        text-align: center;
    }

    .image-container img {
        max-width: 50%;
        /* 이미지 크기를 50%로 줄임 */
        height: auto;
    }
</style>
</head>

<body>
    <?php require_once("inc/header.php"); ?>

    <main class="login_wrapper member">

        <form name="login_form" method="POST" action="login.post.php">
            <div class="ID_wrapper">
                <fieldset class="ID_field-container">
                    <input type="text" placeholder="ID." class="ID_field_text" name="id" />
                </fieldset>
            </div>
            <div class="FW_wrapper">
                <fieldset class="FW_field-container">
                    <input type="password" placeholder="PW." class="FW_field_text" name="pass" />
                </fieldset>
            </div>
            </a>
            <div class="login_keep_wrapper">
                <div class="all_keep_check">
                    <input type="checkbox" class="input_all_keep">
                    <lavel for="all_keep" class="all_keep_text"> 로그인 유지 </lavel>
                </div>
            </div>
            <div class="find_wrapper">
                <ul>
                    <a href="find_id.php">
                        <li> <span>아이디 찾기</span> </li>
                    </a>
                    <a href="find_pw.php">
                        <li class="none_border"> <span>비밀번호 찾기</span> </li>
                    </a>
                </ul>
            </div>
            <div class="finish_login_wrapper">
                <button class="finish_login" onclick="login()">
                    <span class="finish_login_title"> LOGIN </span>
                </button>
                <div class="find_wrapper">
            <ul>
                <a href="sign_up.php">
                    <li> <span>회원가입</span>
                    </li>
                </a>

            </div>
        </form>

        <!-- class="find_text" -->

        <div class="login_member_non_member"></div>

    </main>

    <?php require_once("inc/footer.php"); ?>

    <script src="https://kit.fontawesome.com/73fbcb87e6.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script src="../js/hot_issue.js"></script>
    <script src="js/member.js"></script>
</body>

</html>