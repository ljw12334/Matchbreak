<?php
require_once("contents.import.php");
session_start(); // 세션 시작
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <title>MatchBreak</title>

  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMv7j5P7Xk5sDYs5Hl6tBjG6a0jX9K5F/tZ6ro0" crossorigin="anonymous">

  <style>
    body {
      background-color: #D7EDD8;
      margin: 0;
      padding: 0;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
      background-color: #fff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .image-container img {
      max-width: 100px;
      height: auto;
    }

    .mypage-button {
      font-size: 18px;
      color: #333;
      text-decoration: none;
      display: flex;
      align-items: center;
    }

    .mypage-button i {
      margin-right: 8px;
    }

    .mypage-button:hover {
      color: #0073e6;
    }

    .calendar-container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
      width: 80vw; /* 크기를 80vw로 조정하여 로그인 후와 동일하게 설정 */
      margin: 0 auto;
    }

    .calendar {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      grid-gap: 15px; /* 캘린더 간격을 적당히 조정 */
      border: 1px solid #333;
      border-radius: 10px;
      padding: 20px; /* 캘린더 내부 여백 조정 */
      text-align: center;
      background-color: #fff;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      margin-top: 10px;
    }

    .calendar-day {
      padding: 20px;
      font-size: 18px;
      border: none;
      background-color: #0073e6;
      color: white;
      border-radius: 10px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .calendar-day:hover {
      background-color: #005bb5;
    }

    .calendar-day:disabled {
      background-color: #ccc;
      color: #666;
      cursor: not-allowed;
    }

    .disabled-calendar-message {
      color: red;
      font-size: 18px;
      margin-top: 10px;
      text-align: center;
    }
  </style>
</head>

<body>

  <div class="header">
    <div class="image-container">
      <img src="img/match.jpg" alt="Match Image">
    </div>

    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>
      <a href="mypage.php" class="mypage-button">
        <i class="fas fa-user-circle"></i> 마이페이지
      </a>
      <a href="logout.php" class="mypage-button">
        <i class="fas fa-sign-out-alt"></i> 로그아웃
      </a>
    <?php else : ?>
      <a href="login.php" class="mypage-button">
        <i class="fas fa-user-circle"></i> 로그인
      </a>
    <?php endif; ?>
  </div>

  <div class="calendar-container">
    <div id="calendar" class="calendar"></div>
  </div>

  <script>
    function generateCalendar() {
      const calendar = document.getElementById("calendar");
      const today = new Date(); // 현재 날짜
      const daysToShow = 21; // 3주간의 날짜

      calendar.innerHTML = '';

      // 요일 배열
      const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

      // 요일 헤더 추가
      daysOfWeek.forEach(day => {
        const dayElement = document.createElement('div');
        dayElement.textContent = day;
        dayElement.style.fontWeight = 'bold';
        calendar.appendChild(dayElement);
      });

      // 오늘 날짜부터 21일 동안의 날짜 추가
      for (let i = 0; i < daysToShow; i++) {
        const currentDay = new Date(today);
        currentDay.setDate(today.getDate() + i); // 날짜를 하루씩 증가시킴

        const dayElement = document.createElement('button');
        dayElement.className = 'calendar-day';
        dayElement.textContent = currentDay.getDate();

        // 현재 요일을 가져와서 올바른 위치에 맞추기
        if (i === 0) {
          const emptySlots = currentDay.getDay(); // 오늘 요일의 인덱스 (0:일요일, 6:토요일)
          for (let j = 0; j < emptySlots; j++) {
            const emptyElement = document.createElement('div');
            calendar.appendChild(emptyElement); // 비어있는 슬롯 추가
          }
        }

        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>
          // 로그인 후 날짜 선택 가능
          dayElement.onclick = function() {
            const selectedDate = currentDay.toISOString().split('T')[0]; // YYYY-MM-DD 형식
            window.location.href = "select_time.php?date=" + selectedDate;
          };
        <?php else : ?>
          // 로그인 전에는 버튼 비활성화
          dayElement.disabled = true;
        <?php endif; ?>

        calendar.appendChild(dayElement);
      }

      <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) : ?>
        // 로그인 전 메시지
        const message = document.createElement('p');
        message.textContent = "로그인 후 날짜를 선택할 수 있습니다.";
        message.className = 'disabled-calendar-message';
        calendar.appendChild(message);
      <?php endif; ?>
    }

    window.onload = generateCalendar;
  </script>

</body>

</html>
