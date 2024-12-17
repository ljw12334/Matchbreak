<link rel="stylesheet" href="calendar.css">

<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>

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

        <div style="width:400px; height:auto; border-radius:10px; box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px; padding: 20px;">
            <?php set_calendar(); ?>
        </div>


    </body>
</html>