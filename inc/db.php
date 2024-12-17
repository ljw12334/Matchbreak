<?php
// DEBUG 상수를 초기화
if (!defined('DEBUG')) {
    define('DEBUG', false); // 기본값을 false로 설정
}

function db_get_pdo()
{
    static $pdo = null;
    
    if ($pdo === null) {
        $host = getenv('DB_HOST') ?: 'localhost';
        $port = getenv('DB_PORT') ?: '3306';
        $dbname = getenv('DB_NAME') ?: 'matchbreak';
        $charset = 'utf8mb4';
        $username = getenv('DB_USER') ?: 'root';
        $db_pw = getenv('DB_PASS') ?: '';

        try {
            $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";
            $pdo = new PDO($dsn, $username, $db_pw);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log("데이터베이스 연결 실패: " . $e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT'] . '/matchbreak/logs/db_error.log');
            exit('데이터베이스 연결에 문제가 발생했습니다.');
        }
    }

    return $pdo;
}

// 데이터 조회 함수
function db_select($query, $param = array())
{
    $pdo = db_get_pdo();
    try {
        $st = $pdo->prepare($query);
        $st->execute($param);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("DB Select Error: " . $e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT'] . '/matchbreak/logs/db_error.log');
        throw $e;
    }
}

// 데이터 삽입 함수
function db_insert($query, $param = array())
{
    $pdo = db_get_pdo();
    try {
        if (defined('DEBUG') && DEBUG) {
            error_log("Query: " . $query);
            error_log("Params: " . print_r($param, true));
        }
        $st = $pdo->prepare($query);
        $st->execute($param);
        // return $pdo->lastInsertId();
        return true;
    } catch (PDOException $e) {
        error_log("DB Insert Error: " . $e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT'] . '/matchbreak/logs/db_error.log');
        return false;
    }
}

// 데이터 업데이트 함수
function db_update($query, $param = array())
{
    $pdo = db_get_pdo();
    try {
        if (defined('DEBUG') && DEBUG) {
            error_log("Query: " . $query);
            error_log("Params: " . print_r($param, true));
        }
        $st = $pdo->prepare($query);
        return $st->execute($param); // 성공 여부 반환
    } catch (PDOException $e) {
        error_log("DB Update Error: " . $e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT'] . '/matchbreak/logs/db_error.log');
        return false;
    }
}

// 데이터 삭제 함수
function db_delete($query, $param = array())
{
    $pdo = db_get_pdo();
    try {
        if (defined('DEBUG') && DEBUG) {
            error_log("Query: " . $query);
            error_log("Params: " . print_r($param, true));
        }
        $st = $pdo->prepare($query);
        return $st->execute($param); // 성공 여부 반환
    } catch (PDOException $e) {
        error_log("DB Delete Error: " . $e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT'] . '/matchbreak/logs/db_error.log');
        return false;
    }
}
?>
