<?php
    if(!session_id()) {
        session_start();
    }

    unset($_SESSION['member_id']);
    unset($_SESSION['member_name']);

    // 세션 변수 초기화
    $_SESSION = [];
    
    // 세션 쿠키 삭제
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(), 
            '', 
            time() - 42000, 
            $params["path"], 
            $params["domain"], 
            $params["secure"], 
            $params["httponly"]
        );
    }
    
    // 세션 파괴
    session_destroy();    
?>

<script>
    alert("로그아웃 하였습니다.");
    location.replace('/matchbreak/index.php');
</script>