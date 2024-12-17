<?php
require_once("inc/db.php");

$login_id = isset($_POST['id']) ? $_POST['id'] : null;
$login_pw = isset($_POST['pass']) ? $_POST['pass'] : null;

// 파라미터 체크
if ($login_id == null || $login_pw == null){    
    echo("<script>alert('모두 입력하여 주세요.');</script>");
    // header("Location: login.php");
    exit();
}

echo ("<script>alert('입력한 아이디 :'+$login_id +'입력한 비번 :'+$login_pw);</script>");


// 회원 데이터
$member_data = db_select("select * from members where id = ? and p", array($login_id));
// var_dump($member_data);

// 회원 데이터가 없다면
if ($member_data == null || count($member_data) == 0){
    // 회원 데이터가 없는 경우
    $redirect_url = "login.php"; // 이동할 페이지 URL
    $message = "회원가입을 먼저하세요"; // 표시할 메시지
    echo "<script>alert('$message'); window.location.href = '$redirect_url';</script>";
    exit();
} else {
    // 회원 데이터가 있는 경우
    // 여기에 다음으로 수행할 작업을 추가할 수 있습니다.

}


// 비밀번호 일치 여부 검증
$is_match_password = password_verify($login_pw, $member_data[0]['pass']);
// var_dump($member_data[0]['pass']);
// var_dump($login_pw);

// var_dump($is_match_password);

// 비밀번호 불일치
if ($is_match_password === false){
    header("Location: login.php");
    exit();
}

require_once("inc/session.php");
$_SESSION['member_id'] = $member_data[0]['id'];

// var_dump($_SESSION['member_id']);

// 메인페이지로 이동
header("Location: index.php");

?>