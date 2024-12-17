<?php
require ('calendar.php');
$selected = isset($_GET["date"]) ? $_GET["date"] : date("Ymd");
?>
<link rel=stylesheet href='select_match.css' type='text/css'>

테스트
<div class='round-box'>
    
</div>
<?php set_resdays(); ?>

<div class='round-box'>
    <div class='match-inner'>
        <span>14:00 - 16:00</span>
        <span>0/12</span>
        <button class='match-apply-button'>신청하기</button>
    </div>
</div>

<div class='round-box'>
    <div class='match-inner'>
        <span>14:00 - 16:00</span>
        <span>0/12</span>
        <button class='match-apply-button'>신청하기</button>
    </div>
</div>

<div class='round-box'>
    <div class='match-inner'>
        <span>14:00 - 16:00</span>
        <span>0/12</span>
        <button class='match-apply-button'>신청하기</button>
    </div>
</div>


