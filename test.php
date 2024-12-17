<?php
function calculateDayOfWeek($year, $month, $day) {
    // 1월과 2월은 작년의 13, 14로 변경
    if ($month < 3) {
        $month += 12;
        $year -= 1;
    }

    $q = $day;
    $m = $month;
    $K = $year % 100; // 년도의 마지막 두 자리
    $J = floor($year / 100); // 년도의 첫 두 자리

    // Zeller의 합
    $h = ($q + floor((13 * ($m + 1)) / 5) + $K + floor($K / 4) + floor($J / 4) - 2 * $J) % 7;

    // 요일을 0=일요일, 1=월요일로 변환
    $h = ($h + 5) % 7;

    // 요일 반환
    return $h;
}
$days = ["일", "월", "화", "수", "목", "금", "토"];
?>

<DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel=stylesheet href='base.css' type='text/css'>
        <title>기본틀</title>
    </head>
    <body>
        <header>
            <div id="menu-toggle">
                <input type="checkbox">

                <span></span>
                <span></span>
                <span></span>
            </div>
            <div>
                <img id="logo-top" src="img/logo_green.png">
            </div>
        </header>
        <main>
            <div class="container">
                테스트
                <div class="round-box">
                    <?php
                    // 예시: 2024년 10월 23일의 요일 계산
                    $year = date("Y");
                    $month = date("m");
                    $day = date("d");

                    $dayOfWeek = calculateDayOfWeek($year, $month, $day);

                    // 요일 매핑
                    echo "2024년 10월 23일은 " . $days[$dayOfWeek] . "요일입니다.";
                    ?>
                    <div class="date-container">
                        <div class="day">일</div>
                        <div class="day">월</div>
                        <div class="day">화</div>
                        <div class="day">수</div>
                        <div class="day">목</div>
                        <div class="day">금</div>
                        <div class="day">토</div>
                    </div>
                    <div class="date-container">
                        <div class="date-btn">1</div>
                        <div class="date-btn">2</div>
                        <div class="date-btn">3</div>
                        <div class="date-btn">4</div>
                        <div class="date-btn">5</div>
                        <div class="date-btn">6</div>
                        <div class="date-btn">7</div>
                    </div>
                    <div class="date-container">
                        <?php
                        $day_plus = 0;
                        for ($i = 0; $i < 7; $i++) {
                            if ($i < $daysOfWeek) {
                                echo "<div class='date-none'></div>";
                            } else {
                                echo "<div class='date-btn'>".$day + $day_plus."</div>";
                            }
                            $day_plus++;
                        }
                        ?>
                    </div>




                </div>
            </div>
            
        </main>
    </body>
</html>