<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/matchbreak/inc/session.php');
    require($_SERVER['DOCUMENT_ROOT']."/matchbreak/inc/db.php");

    $user_id = null;
    $user_name = null;
    if (isset($_SESSION['member_id'])) {
        $user_id = $_SESSION['member_id'];
        $user_name = $_SESSION['member_name'];
    }

    $query = "SELECT * FROM members WHERE id = ?";
    $result = db_select($query, [$user_id]);

    $name = $result[0]['name'];
    $gender = $result[0]['gender'];
    $phone = $result[0]['phone'];
    $major = $result[0]['major'];

    
?>

<DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' href='/matchbreak/css/root.css' type='text/css'>
        <link rel='stylesheet' href='/matchbreak/css/base.css' type='text/css'>
        <link rel="stylesheet" href="/matchbreak/css/mypage-edit.css">
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
                <div class='round-box'>
                    <h3>개인정보 수정</h3><br>
                    <form method="POST" action="mypage_edit_post.php">
                        <input type="hidden" name="id" value="<?= $user_id ?>">
                        <div class="double-holder">
                            <input class="input-small" type="text" name="name" placeholder="이름" required value="<?=$name?>">
                            <select name="gender" id="gender">
                                <?php if ($gender == 'm'): ?>
                                    <option value="male" selected>남성</option>
                                    <option value="female">여성</option>
                                    <option value="disable">비공개</option>
                                <?php elseif ($gender == 'f'): ?>
                                    <option value="male">남성</option>
                                    <option value="female" selected>여성</option>
                                    <option value="disable">비공개</option>
                                <?php else: ?>
                                    <option value="male">남성</option>
                                    <option value="female">여성</option>
                                    <option value="disable" selected>비공개</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <input class="input-box" type="tel" name="phone" placeholder="전화번호" pattern="^010\d{4}\d{4}$" required value="<?=$phone?>">
                        <input class="input-box" type="text" name="major" placeholder="학과" required value="<?=$major?>">

                        <button id="join" type="submit" class="round-box">수정</button>

                    </form>
                    <button id="cancel" class="round-box" onclick="history.back();">취소</button>
                </div>
                
            </div>
        </main>
    </body>
</html>