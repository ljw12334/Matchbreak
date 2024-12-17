<link rel="stylesheet" href="style.css">

<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>

        <?php function set_calendar($date = 0) {
        	if(!$date){
        		$date = date('Y-m-d');
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
        	<table class="calendar-table">
        		<thead>
        			<tr>
        				<th class="sunday">일</th>
        				<th>월</th>
        				<th>화</th>
        				<th>수</th>
        				<th>목</th>
        				<th>금</th>
        				<th class="saturday">토</th>
        			</tr>
        		</thead>
        		<tbody>
        			<?php for($i = 0; $i < $total_week; $i++){ ?>
        			<tr>
        				<?php for($j = 0; $j < 7; $j++){ ?>
        					<?php
        					if($j == 0)
        						$add_class = "sunday";
        					else if($j == 6)
        						$add_class = "saturday";
        					else
        						$add_class = "";
        					?>
        					<?php if(!(($i == 0 && $j < $start_week) || (($i+1) == $total_week && $j > $last_week))){
        						$today = date('j')==$day?"today":"";
        						echo "<td class='".$add_class."'><span class='".$today."'>".$day++."</span></td>";
        					} else {
        						if($i == 0){
        							echo "<td class='".$add_class."'><span class='another-month'>".($before_max_day-$start_week+$j+1)."</span></td>";
        						}else{
        							echo "<td class='".$add_class."'><span class='another-month'>".$after_min_day++."</span></td>";
        						}
        					} ?>
        				<?php } ?>
        			</tr>
        			<?php } ?>
        		</tbody>
        	</table>
        	<?php
        }
        ?>

        <div style="width:400px; height:auto; border-radius:10px; box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px; padding: 20px;">
            <?php set_calendar(); ?>
        </div>

    </body>
</html>