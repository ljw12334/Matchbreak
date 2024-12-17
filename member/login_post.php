<?php
ob_start(); // 출력 버퍼링 시작

session_start(); // 세션 시작

require_once($_SERVER['DOCUMENT_ROOT']."/matchbreak/inc/db.php");

$login_id = isset($_POST['id']) ? $_POST['id'] : null;
$login_pw = isset($_POST['pw']) ? $_POST['pw'] : null;
$login_keep = isset($_POST['keep-login']) ? $_POST['keep-login'] : false;
$is_match_password = null;

// 파라미터 체크
if ($login_id == null){
    echo("<script>alert('아이디를 입력해주세요.');</script>");
    // header("Location: login.php");
    exit();

} else if ($login_pw == null) {
    echo("<script>alert('비밀번호를 입력해주세요.');</script>");
    // header("Location: login.php");
    exit();

}

echo ("<script>alert('입력한 아이디 :'+$login_id +'입력한 비번 :'+$login_pw);</script>");


// 회원 데이터
$member_data = db_select("select * from members where id = ?;", array($login_id));
// var_dump($member_data);

// 회원 데이터가 없다면
if (!$member_data){
    $message = "아이디 혹은 비밀번호가 일치하지 않습니다.";
    echo "<script>alert('$message'); window.location.href = 'login.php';</script>";
    exit();
} 

// 비밀번호 일치 여부 검증
$is_match_password = password_verify($login_pw, $member_data[0]['pw']);

// 비밀번호 불일치
if ($is_match_password === false){
    $message = "아이디 혹은 비밀번호가 일치하지 않습니다.";
    echo "<script>alert('$message'); window.location.href = 'login.php';</script>";
    exit();
}

// 세션 파일 포함
require_once($_SERVER['DOCUMENT_ROOT']."/matchbreak/inc/session.php");

// 로그인 세션 설정
$_SESSION['member_id'] = $member_data[0]['id']; // 세션에 회원 아이디 저장
$_SESSION['member_name'] = $member_data[0]['name']; // 세션에 회원 이름 저장

ob_end_flush(); // 출력 버퍼 종료 후 내용 출력

// 메인 페이지로 리디렉션
header("Location: /matchbreak/index.php");
exit();
?>