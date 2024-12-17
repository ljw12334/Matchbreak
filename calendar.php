<?php //require_once("matchbreak/contents.import.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <link rel="stylesheet" href="calendar.css">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <title>MatchBreak</title>
  <!-- 사진 추가 -->
  <div class="image-container">
    <!-- <img src="img/match.jpg" alt="Match Image"> -->
  </div>
  <style>
    body {
      background-color: #D7EDD8;
    }
  </style>
</head>

<body>
  <?php //require_once("inc/header.php"); ?>
  <div class="calendar-container">
    <div class="controls">
      <!-- 연도 선택 -->
      <label for="year-select">Year:</label>
      <select id="year-select" onchange="generateCalendar()">
        <?php
        // 현재 연도 기준으로 10년간의 선택지를 제공
        $currentTime = date("Ymd");
        $currentYear = substr($currentTime,0,4);
        $currentMonth = substr($currentTime,4,2);
        $currentDay = substr($currentTime,6,2);
        for ($year = $currentYear; $year >= $currentYear - 10; $year--) {
          echo "<option value='$year'>$year</option>";
        }
        ?>
      </select>

      <!-- 월 선택 -->
      <label for="month-select">Month:</label>
      <select id="month-select" onchange="generateCalendar()">
        <?php
        // 1월부터 12월까지 선택지를 제공
        for ($month = 1; $month <= 12; $month++) {
          $monthName = $month."월";
          echo "<option value='$month'";
          if ($month == $currentMonth) {
            echo " selected";
          }
          echo ">$monthName</option>";
        }
        ?>
      </select>
    </div>
    <div id="calendar" class="calendar">
    </div>
  </div>

  <?php //require_once("inc/footer.php"); ?>

  <script>
    function daysInMonth(month, year) {
      return new Date(year, month, 0).getDate(); // 해당 월의 마지막 날을 반환
    }

    function generateCalendar() {
      const calendar = document.getElementById("calendar");
      const year = document.getElementById("year-select").value;
      const month = document.getElementById("month-select").value;

      // 해당 월의 일수 계산
      const days = daysInMonth(month, year);

      // 기존의 캘린더 내용 제거
      calendar.innerHTML = '';

      // 요일 표시
      const daysOfWeek = ['일', '월', '화', '수', '목', '금', '토'];
      daysOfWeek.forEach(day => {
        const dayElement = document.createElement('div');
        dayElement.textContent = day;
        calendar.appendChild(dayElement);
      });

      // 1일의 요일 계산
      const firstDay = new Date(year, month - 1, 1).getDay();

      // 1일 앞에 빈 칸 추가
      for (let i = 0; i < firstDay; i++) {
        const emptyElement = document.createElement('div');
        calendar.appendChild(emptyElement);
      }


      // 날짜 생성
      for (let day = 1; day <= days; day++) {
        let dayElement;
        currentDay = <?=$currentDay?>;
        
        if (day < currentDay) {
          dayElement = document.createElement('div');
          dayElement.className = 'calendar-past';
        } else {
          dayElement = document.createElement('button');
          dayElement.className = 'calendar-day';
          dayElement.onclick = function() {
          alert(`${year}년 ${month}월 ${day}일을 선택하셨습니다.`);
        };
        }
        dayElement.textContent = day;
        calendar.appendChild(dayElement);
      }
    }

    // 페이지 로드 시 초기 캘린더 생성
    window.onload = generateCalendar;
  </script>
</body>

</html>