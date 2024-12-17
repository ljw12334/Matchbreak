<?php //require_once("contents.import.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <title>MatchBreak</title>
  <!-- 사진 추가 -->
  <div class="image-container">
    <img src="img/match.jpg" alt="Match Image">
  </div>
  <style>
    body {
      background-color: #D7EDD8;
    }

    main {
      padding: 15px;
      margin: 0;
      padding: 0;
    }

    .calendar-container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .calendar {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      grid-gap: 10px;
      border: 1px solid #333;
      border-radius: 10px;
      padding: 20px;
      text-align: center;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-top: 20px;
    }

    .calendar-day {
      padding: 20px;
      border-radius: 5px;
      background-color: #f5f5f5;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .calendar-day:hover {
      background-color: #cfe8d5;
    }

    .calendar-header {
      grid-column: span 7;
      font-size: 24px;
      margin-bottom: 10px;
    }

    .controls {
      margin-bottom: 20px;
    }

    .image-container {
      margin: 20px 0;
      text-align: center;
    }

    .image-container img {
      max-width: 50%;
      height: auto;
    }

    /* 시간대 신청 */
    .time-slot {
            margin-bottom: 10px;
        }
        .time-slot button {
            margin-left: 10px;
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
        $currentYear = date("Y");
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
          $monthName = date("F", mktime(0, 0, 0, $month, 10)); // 월 이름을 영어로 표시
          echo "<option value='$month'>$monthName</option>";
        }
        ?>
      </select>
    </div>
    <div id="calendar" class="calendar">
    </div>
  </div>

  <h1>시간대 선택</h1>
    
    <?php
    // 시간대 배열 생성
    $timeSlots = [
        "14:00~16:00",
        "16:00~18:00",
        "18:00~20:00"
    ];

    // 폼 생성
    foreach ($timeSlots as $timeSlot) {
        echo "<div class='time-slot'>";
        echo "<span>$timeSlot</span>";
        echo "<form method='post' style='display:inline;'>";
        echo "<input type='hidden' name='time_slot' value='$timeSlot'>";
        echo "<button type='submit' name='submit'>신청하기</button>";
        echo "</form>";
        echo "</div>";
    }

    // 폼 제출 후 처리
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['time_slot'])) {
        $selectedTimeSlot = $_POST['time_slot'];
        echo "<p>$selectedTimeSlot 시간대 신청이 완료되었습니다.</p>";
    }
    ?>

  <?php //require_once("inc/footer.php"); ?>
  
</body>

<!-- 스크립트 -->
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
      const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
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
        const dayElement = document.createElement('button');
        dayElement.className = 'calendar-day';
        dayElement.textContent = day;
        dayElement.onclick = function() {
          alert(year + "년 " + month + "월 " + day + "일을 선택하셨습니다.");
        };
        calendar.appendChild(dayElement);
      }
    }

    // 페이지 로드 시 초기 캘린더 생성
    window.onload = generateCalendar;
</script>
