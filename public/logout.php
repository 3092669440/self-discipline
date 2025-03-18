<?php
// 确保会话安全关闭
session_start();

// 清除所有会话变量
$_SESSION = array();

// 销毁会话 Cookie
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

// 彻底销毁会话
session_destroy();

// 防止缓存
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// 重定向到登录页
header("Location: login.php");
exit;
?>
