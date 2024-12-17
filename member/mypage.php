<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/matchbreak/inc/session.php');
    require($_SERVER['DOCUMENT_ROOT']."/matchbreak/inc/db.php");

    $user_id = null;
    $user_name = null;
    if (isset($_SESSION['member_id'])) {
        $user_id = $_SESSION['member_id'];
        $user_name = $_SESSION['member_name'];
    } else {
        echo "<script> window.location.replace('/matchbreak/member/login.php'); </script>";
    }

    $query = "SELECT * FROM members WHERE id = ?";
    $result = db_select($query, [$user_id]);

    $phone = substr($result[0]['phone'], 0, 3)."-".substr($result[0]['phone'], 3, 4)."-".substr($result[0]['phone'], 7, 4);
    $major = $result[0]['major'];

    $matches_query = "SELECT * FROM matches_applied WHERE member_id = ?";
    $matches_result = db_select($matches_query, [$user_id]);

    function match_list($rs) {
        // var_dump($rs);
        $list_return = array();

        foreach ($rs as $value) {
            $q = "SELECT * FROM matches WHERE matchID = ?";
            $r = db_select($q, [$value['match_id']]);

            $date = $r[0]['matchDate'];
            $start_time = $r[0]['startTime'];
            $end_time = $r[0]['endTime'];

            $date_conv = substr($date, 0, 4)."-".substr($date, 4, 2)."-".substr($date, 6, 2);
            $start_time_conv = substr($start_time, 0, 2).":".substr($start_time, 2, 2);
            $end_time_conv = substr($end_time, 0, 2).":".substr($end_time, 2, 2);

            $add = array($date_conv, $start_time_conv, $end_time_conv);
            array_push($list_return, $add);
        }
        for ($i = 0; $i < count($rs); $i++) {
            
        }
        return $list_return;
    }

    $match_list = match_list($matches_result);
    
?>

<DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' href='/matchbreak/css/root.css' type='text/css'>
        <link rel='stylesheet' href='/matchbreak/css/base.css' type='text/css'>
        <link rel=stylesheet href='/matchbreak/css/mypage.css' type='text/css'>
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
                <div class='tier-box'>
                    <div class='mypage-texts2'>
                        <div class='mypage-inner'>
                            <div class='profile-box'>
                                <img src='/matchbreak/img/profil_pics.svg' class='profile'>
                                <div class='mypage-texts'>
                                    <span><?=$user_name?> 님</span>
                                    <span>매치브레이크에 오신 것을 환영합니다.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='information-box'>
                    <div class='information-container'>
                        <div class="information-item">
                            <span>성별</span> 
                            <div class="information-style">
                                <?php if ($result[0]['gender'] == 'm'): ?>
                                    남성
                                <?php elseif ($result[0]['gender'] == 'f'): ?>
                                    여성
                                <?php else: ?>
                                    비공개
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="information-item">
                            <span>매칭횟수</span>
                            <div class="information-style"><?=count($matches_result)?>회</div>
                        </div>
                    </div>
                    <div class='information-container'>
                        <div class="information-item">
                            <span>전화번호</span>
                            <div class="information-style"><?=$phone?></div>
                        </div>
                        <div class="information-item">
                            <span>학과</span>
                            <div class="information-style"><?=$major?></div>
                        </div>
                    </div>
                    <div class='button-wrapper'>
                        <a href='/matchbreak/member/mypage_edit.php'>
                            <button class="edit-button">수정</button>
                        </a>
                    </div>
                    
                </div>
                <div class='badge-texts'>
                    <span>매치 목록</span>
                </div>
                <div class='tier-box2'>
                    <div class="bage-item">
                            <span>순번</span>
                            <span>날짜</span>
                            <span>시간</span>  
                    </div>
                </div>
                <div class='badge-box2'>
                    <?php if (count($matches_result) == 0): ?>
                        <div class="mid-box">
                            <span>참여한 매치가 없습니다</span>
                        </div>
                    <?php else: ?>
                        <?php for ($i = 0; $i < count($match_list); $i++): ?>
                            <div class="bage-item2">
                                <span><?=$i + 1?></span>
                                <span><?=$match_list[$i][0]?></span>
                                <span><?=$match_list[$i][1]?> ~ <?=$match_list[$i][2]?></span>  
                            </div>
                        <?php endfor; ?>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </body>
</html>