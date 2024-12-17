<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/matchbreak/inc/session.php');

    $user_id = null;
    $user_name = null;
    if (isset($_SESSION['member_id'])) {
        $user_id = $_SESSION['member_id'];
        $user_name = $_SESSION['member_name'];
    }

?>

<DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' href='/matchbreak/css/root.css' type='text/css'>
        <link rel='stylesheet' href='/matchbreak/css/base.css' type='text/css'>
        <title>매치브레이크</title>
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
                <div class='wrapper sidebar-profil'>
                    <a href="/matchbreak/member/mypage.php">
                        <img src='/matchbreak/img/profil_pics.svg' class='profil-pics'>
                        <?php if ($user_id == null): ?>
                            로그인하세요
                        <?php else: ?>
                            <?=$user_name?> 님
                        <?php endif; ?>
                    </a>
                    
                    

                </div>
                <a href="#">
                    <div class='sidebar-buttons'>
                        공지사항
                    </div>
                </a>
                <a href="#">
                    <div class='sidebar-buttons'>
                        문의하기
                    </div>
                </a>
                <a href="#">
                    <div class='sidebar-buttons'>
                        최근 전적 보기
                    </div>
                </a>
                <a href="/matchbreak/member/mypage.php">
                    <div class='sidebar-buttons'>
                        마이페이지
                    </div>
                </a>
                <?php if ($user_id != null): ?>
                    <a href="/matchbreak/member/logout.php">
                        <div class='sidebar-buttons sidebar-logout'>
                            로그아웃
                        </div>
                    </a>
                <?php endif; ?>
                
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
                <?php include (__DIR__.'/inc/calendar/select_match.php'); ?>
            </div>
        </main>
    </body>
</html>