<?php
$date = $_GET["date"];
$start_time = $_GET["start-time"];
$end_time = $_GET["end-time"];
?>

<html> 
<head> 
</head> 
<body> 
<form id="post-form" method="post" action="match_insert.php"> 
    <input type="hidden" name="date" value="<?=$date?>">
    <input type="hidden" name="start-time" value="<?=$start_time?>">
    <input type="hidden" name="end-time" value="<?=$end_time?>">
</form>
<script type="text/javascript">
    this.document.getElementById("post-form").submit();
</script> 
</body> 
</html>