<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/matchbreak/inc/session.php');

if (!isset($_SESSION['member_id'])) {
    echo "<script> window.location.replace('/matchbreak/member/login.php'); </script>";
}




$date = $_POST["date"];
$start_time = $_POST["start-time"];
$end_time = $_POST["end-time"];

$start_time_conv = substr($start_time, 0, 2).":".substr($start_time, 2, 2);
$end_time_conv = substr($end_time, 0, 2).":".substr($end_time, 2, 2);
?>

<DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' href='/matchbreak/css/root.css' type='text/css'>
        <link rel='stylesheet' href='/matchbreak/css/base.css' type='text/css'>
        <link rel='stylesheet' href='/matchbreak/css/match_insert.css' type='text/css'>
        <title>기본틀</title>
    </head>
    <body>
        <header>
            <input type='checkbox' id='menuicon'>
            <label for='menuicon'>
                <span></span>
                <span></span>
                <span></span>
            </label>
            <div class='sidebar'>
                
            </div>
            <label for="menuicon">
                <div class='blind'></div>
            </label>

            <div id='logo-top'>
                <a href="/matchbreak/index.php">
                    <img src='/matchbreak/img/match_logo.svg'>
                </a>
            </div>
            
            <a href='/matchbreak/member/mypage.php'>
                <img id='profil' src='/matchbreak/img/profil.svg'>
            </a>
        </header>
        <main>
            <div class='container'>
                <!-- <img src="/matchbreak/inc/qr.php?url=https://naver.com" width="200"> -->
                <div class="round-box">
                    <div class="inner-round-box">
                        <h3><?=intval(substr($date, 4, 2))."월 ".intval(substr($date, 6, 2))."일 매치"?></h3>
                        <hr>
                        시작 시간: <?=$start_time_conv?>
                        <br>
                        종료 시간: <?=$end_time_conv?>
                    </div>
                    신청하시겠습니까?<br>
                    <span>
                        ※ 신청 후에는 취소가 어렵습니다
                    </span>
                    <div class="horizontal-flex">
                        <button onclick="history.back()" class="match-button match-cancel">취소</button>
                        <form method="POST" action="match_insert_post.php">
                            <input type="hidden" name="date" value="<?=$date?>">
                            <input type="hidden" name="start-time" value="<?=$start_time?>">
                            <input type="hidden" name="end-time" value="<?=$end_time?>">
                            <button class="match-button match-confirm" type="submit">신청하기</button>
                        </form>
                    </div>

                </div>
                <?php 
                    // echo phpinfo();
                    // print_r(get_loaded_extensions());
                ?>
                
            </div>
        </main>
    </body>
</html>