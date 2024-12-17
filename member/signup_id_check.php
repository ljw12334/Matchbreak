<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/matchbreak/inc/session.php');
require($_SERVER['DOCUMENT_ROOT'] . '/matchbreak/inc/db.php');

// JSON 헤더 설정
header('Content-Type: application/json; charset=utf-8');

// 로그 파일 경로 설정
$log_file = $_SERVER['DOCUMENT_ROOT'] . '/matchbreak/logs/signup_id_check.log';

// 로그 작성 함수
function write_log($message) {
    global $log_file;
    error_log(date('[Y-m-d H:i:s] ') . $message . PHP_EOL, 3, $log_file);
}

try {
    // POST로 받은 데이터
    $check_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;

    if (!$check_id) {
        write_log('POST 데이터가 유효하지 않음: id = ' . json_encode($check_id));
        echo json_encode(['success' => false, 'message' => '아이디를 입력해주세요.']);
        exit;
    }

    write_log("요청 데이터 - check_id: $check_id");

    // `members` 테이블에서 해당 유저가 있는지 확인
    $query = "SELECT * FROM members WHERE id = :check_id";
    $params = [':check_id' => $check_id];
    $user_info = db_select($query, $params);

    if (!$user_info) {
        $check_form = check_id($check_id);
        if ($check_form === 'DONE') {
            echo json_encode(['success' => true, 'message' => '사용 가능한 ID입니다.']);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => $check_form]);
            exit;
        }
    } else {
        echo json_encode(['success' => false, 'message' => '이미 존재하는 ID입니다.']);
        exit;
    }
    
} catch (Exception $e) {
    write_log('오류: ' . $e->getMessage());
    echo json_encode(['success' => false, 'message' => '알 수 없는 이유로 확인에 실패했습니다.']);
}

function check_id($str){
    // 첫글자 아이디 체크
    if(!preg_match("/^[a-z]/i", $str)) {
        return "아이디의 첫글자는 영문이어야 합니다.";
    }
    
    if(preg_match("/[^a-z0-9-_]/i", $str)) {
        return "아이디는 영문, 숫자, -, _ 만 사용할 수 있습니다.";
    }
    
    $len = strlen($str);
    if($len >= 8 && $len <=20){
        return "DONE";
    }else{
        return "아이디는 8자~20자 이어야 합니다.";
    }
}