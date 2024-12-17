<link rel="stylesheet" href="calendar.css">

<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>

		<?php function set_resdays() { // Reservation days, 예약 일자
			$link = "/matchbreak/test/calendar/base.php";
			/*
			현재 날짜를 가져와서 앞으로 10일간의 날짜를 계산해
			[YYYY-mm-dd, 요일] 의 형태로 리스트에 추가한다
			*/
			$selected = isset($_GET["date"]) ? $_GET["date"] : date("Ymd");

			$days = []; // 일자들을 담을 리스트
			$now_month = date("m");

			for ($i = 0; $i < 10; $i++) {

				$day = strtotime("+".$i." days");

				$w = date("w", $day); // $day의 요일을 정수로 표현 (0: 일요일 ~ 6: 토요일)
				$date_of_week = ""; //요일을 한국어 문자로 담을 변수
				switch($w) {
					case 0:
						$date_of_week = "일";
						break;
					case 1:
						$date_of_week = "월";
						break;
					case 2:
						$date_of_week = "화";
						break;
					case 3:
						$date_of_week = "수";
						break;
					case 4:
						$date_of_week = "목";
						break;
					case 5:
						$date_of_week = "금";
						break;
					case 6:
						$date_of_week = "토";
						break;
				}

				$days[] = [$day, $date_of_week]; // 배열 마지막에 요소 추가

			}
			
			// foreach ($days as $v) { // 배열에 잘 담겼나 확인
			// 	echo $v[0]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$v[1]."<br>";
			// }
			echo "<div class='container-resdays-outer'>";
				echo "<div class='container-resdays'>"; //div0 op
			
					$isFirst = true;
					$isMonthChanged = false;
					foreach ($days as $d) {
						if ($now_month != date("m", $d[0])) {
							$isMonthChanged = true;
							echo "<div class='v-line'></div>";
						}
					
						echo "<div class='v-box'>"; // div1 op
					
							echo "<span>"; // span1 op
					
							if ($isFirst || $isMonthChanged) {
								echo intval(date("m", $d[0]))."월"; // intval(value) : 01, 02, 03..등 앞에 붙는 0 제거
								if ($isFirst) $isFirst = false;
							} 
							echo "</span>"; //span1 cs
					
							$class = "'";
							if ($d[1] == "일") $class = " sunday'";
							else if ($d[1] == "토") $class = " saturday'";

							echo "<a href='".$link."?date=".date("Ymd", $d[0])."'>";

								// 선택된 날짜 칸의 클래스를 date-box-selected로 함
								if ($selected == date("Ymd", $d[0])) {
									$class = " today'";
									echo "<div class='date-box-selected".$class."'>"; // div2 op (1)

								} else { // 아닐 경우 date-box로 함
									echo "<div class='date-box".$class."'>"; // div2 op (2)
								}
									echo intval(date("d", $d[0]))."<br>".$d[1];
							
								echo "</div>"; // div2 cs
							echo "</a>";
						
						echo "</div>"; // div1 cs
						$now_month = date("m", $d[0]);
						$isMonthChanged = false;
					}
				echo "</div>"; //div0 cs
			echo "</div>";
			echo "<div class='match-day-text'>".intval(substr($selected, 4, 2))."월 ".intval(substr($selected, 6, 2))."일 매치"."</div>";
		}
		?>

<?php function set_calendar($date = 0) {
        	if(!$date){
        		$date = date('Y-m-d', time());
        	}
        	$tmp = explode('-',$date);
        	$year = $tmp[0];
        	$month = $tmp[1];
        
        	$max_day = date('t',strtotime($date));
        	$start_week = date('w',strtotime($year.'-'.$month.'-01'));
        	$total_week = ceil(($max_day+$start_week)/7);
        	$last_week = date('w',strtotime($year.'-'.$month.'-'.$max_day));
        	$before_max_day = date('t',strtotime($year.'-'.$month.' -1 month'));
        	$after_min_day = 1;
        
        	$day = 1;

        	?>
        	<div class="calendar">
				<div class="days">
					<div><span class="sunday">일</span></div>
					<div><span>월</span></div>
					<div><span>화</span></div>
					<div><span>수</span></div>
					<div><span>목</span></div>
					<div><span>금</span></div>
					<div><span class="saturday">토</span></div>
				</div>
        		<?php for($i = 0; $i < $total_week; $i++){ ?>
        			<div>
        				<?php for($j = 0; $j < 7; $j++){ ?>
        					<?php
        					if($j == 0)
        						$add_class = " class='sunday'";
        					else if($j == 6)
        						$add_class = " class='saturday'";
        					else
        						$add_class = "";
        					?>
        					<?php if(!(($i == 0 && $j < $start_week) || (($i+1) == $total_week && $j > $last_week))){
        						$today = date('j') == $day ? " class='today'" : "";
        						echo "<div".$add_class."><span".$today.">".$day++."</span></div>";
        					} else {
        						if($i == 0){
        							echo "<div".$add_class."><span class='past-day'>".($before_max_day-$start_week+$j+1)."</span></div>";
        						}else{
        							echo "<div".$add_class."><span class='past-day'>".$after_min_day++."</span></div>";
        						}
        					} ?>
        				<?php } ?>
        			</div>
        		<?php } ?>
        	</div>
        	<?php
        }
        ?>
    </body>
</html>