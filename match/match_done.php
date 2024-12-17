<?php
    require($_SERVER['DOCUMENT_ROOT']."/matchbreak/inc/db.php");
    require_once($_SERVER['DOCUMENT_ROOT'].'/matchbreak/inc/session.php');

    $user_id = null;
    $user_name = null;
    if (isset($_SESSION['member_id'])) {
        $user_id = $_SESSION['member_id'];
        $user_name = $_SESSION['member_name'];
    }

    $query = "SELECT * FROM matches WHERE matchID = ?";
    $result = db_select($query, [$_COOKIE['match_done_id']]);
    if (!$result) {
        $message = "유효하지 않은 요청입니다.";
        echo "<script>alert('$message'); window.location.replace('/matchbreak/index.php'); </script>";
        exit;
    }

    $column_name = array('member1','member2', 'member3', 'member4', 'member5', 'member6', 'member7', 'member8', 'member9', 'member10', 'member11', 'member12');
    $users_name = array();
    for ($i = 0; $i < 12; $i++) {
        if ($result[0][$column_name[$i]] === null) {
            array_push($users_name, "");
            continue;   
        }
        $q = "SELECT * FROM members WHERE id = ?";
        $r = db_select($q, [$result[0][$column_name[$i]]]);

        array_push($users_name, $r[0]['name']);
    }

    $date = $result[0]['matchDate'];
    $start_time = $result[0]['startTime'];
    $end_time = $result[0]['endTime'];

    $date_conv = intval(substr($date, 4, 2))."월 ".intval(substr($date, 6, 2))."일";
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

            <!-- <img src="https://localhost/matchbreak/inc/qr.php?url=http://urll.kr/ofaBUC" width="200"> -->
            <div class="round-box">
                신청이 완료되었습니다.
                    <div class="inner-round-box">
                        
                        <h3><?=intval(substr($date, 4, 2))."월 ".intval(substr($date, 6, 2))."일 매치"?></h3>
                        <hr>
                        시작 시간: <?=$start_time_conv?>
                        <br>
                        종료 시간: <?=$end_time_conv?>
                    </div>
                    <div class="inner-round-box">
                        <h3>멤버</h3>
                        <hr>
                        <table>
                        <tr>
                            <td><?=$users_name[0]?></td>
                            <td><?=$users_name[1]?></td>
                        </tr>
                        <tr>
                            <td><?=$users_name[2]?></td>
                            <td><?=$users_name[3]?></td>
                        </tr>
                        <tr>
                            <td><?=$users_name[4]?></td>
                            <td><?=$users_name[5]?></td>
                        </tr>
                        <tr>
                            <td><?=$users_name[6]?></td>
                            <td><?=$users_name[7]?></td>
                        </tr>
                        <tr>
                            <td><?=$users_name[8]?></td>
                            <td><?=$users_name[9]?></td>
                        </tr>
                        <tr>
                            <td><?=$users_name[10]?></td>
                            <td><?=$users_name[11]?></td>
                        </tr>
                    </table>
                    </div>
                    
                    
                    <button onclick="window.location.replace('/matchbreak/index.php')" class="match-button match-confirm">확인</button>

            </div>
        </main>
    </body>
</html>