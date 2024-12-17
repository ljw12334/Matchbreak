<?php

require ($_SERVER['DOCUMENT_ROOT'].'/matchbreak/inc/calendar/calendar.php');
$selected = isset($_GET["date"]) ? $_GET["date"] : date("Ymd");

require_once($_SERVER['DOCUMENT_ROOT'].'/matchbreak/inc/match/match_creation.php');

$column_null = array(0, 0, 0);
$times = array(
    array('1400', '1600'),
    array('1600', '1800'),
    array('1800', '2000')
);

$query = "SELECT * FROM matches WHERE matchDate = ? AND startTime = ? AND endTime = ?";
for ($i = 0; $i < 3; $i++) {

    $result = db_select($query, [$selected, $times[$i][0], $times[$i][1]]);

    for ($j = 1; $j <= 12; $j++) {
        $column_name = 'member'.$j;
        if ($result[0][$column_name] != null) {
            $column_null[$i]++;
        }
    }
}


?>
<link rel='stylesheet' href='/matchbreak/css/select_match.css' type='text/css'>

<?php set_resdays(); ?>

<?php if ($user_id == null): ?>
    <button class="big-button" onclick="window.location.replace('/matchbreak/member/login.php');">로그인 후 이용 가능합니다</button>
<?php endif; ?>

<div class='round-box'>
    <form method="POST" action="/matchbreak/match/match_insert.php">
        <input type="hidden" name="date" value="<?=$selected?>">
        <input type="hidden" name="start-time" value="1400">
        <input type="hidden" name="end-time" value="1600">
        <div class='match-inner'>
            <span>14:00 - 16:00</span>
            <span><?=$column_null[0]?>/12</span>
            <?php if ($user_id != null): ?>
                <button type="submit" class='match-apply-button'>신청하기</button>
            <?php else: ?>
                <button type="submit" class='match-apply-button-off'>신청하기</button>
            <?php endif; ?>
        </div>
    </form>
</div>

<div class='round-box'>
    <form method="POST" action="/matchbreak/match/match_insert.php">
        <input type="hidden" name="date" value="<?=$selected?>">
        <input type="hidden" name="start-time" value="1600">
        <input type="hidden" name="end-time" value="1800">
        <div class='match-inner'>
            <span>16:00 - 18:00</span>
            <span><?=$column_null[1]?>/12</span>
            <?php if ($user_id != null): ?>
                <button type="submit" class='match-apply-button'>신청하기</button>
            <?php else: ?>
                <button type="submit" class='match-apply-button-off'>신청하기</button>
            <?php endif; ?>
        </div>
    </form>
</div>

<div class='round-box'>
    <form method="POST" action="/matchbreak/match/match_insert.php">
        <input type="hidden" name="date" value="<?=$selected?>">
        <input type="hidden" name="start-time" value="1800">
        <input type="hidden" name="end-time" value="2000">
        <div class='match-inner'>
            <span>18:00 - 20:00</span>
            <span><?=$column_null[2]?>/12</span>
            <?php if ($user_id != null): ?>
                <button type="submit" class='match-apply-button'>신청하기</button>
            <?php else: ?>
                <button type="submit" class='match-apply-button-off'>신청하기</button>
            <?php endif; ?>
        </div>
    </form>
</div>


