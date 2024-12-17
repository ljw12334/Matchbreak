<?php
include('/phpqrcode/qrlib.php');

// URL 파라미터 검사 및 처리
if (isset($_GET['url'])) {
    $url = $_GET['url'];  // URL 파라미터 받기
    header('Content-Type: image/png');  // 콘텐츠 타입을 이미지 PNG로 설정
    $size = 10;
    $margin = 2;
    QRcode::png($url, null, QR_ECLEVEL_L, $size, $margin);   // QR 코드 생성 및 출력
} else {
    echo "URL 파라미터가 필요합니다.";
}
?>