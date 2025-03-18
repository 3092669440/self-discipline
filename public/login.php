<?php
session_start();
if(isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登 录 - 自律成就系统</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="auth-container glassmorphism">
    <div class="logo">🌟</div>
    <h1>欢迎回来</h1>
    <form action="includes/auth.php" method="POST">
        <input type="hidden" name="action" value="login">
        <div class="form-group">
            <input type="text" name="username" placeholder="用户名" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="密码" required>
        </div>
        <button type="submit" class="btn-gradient">登 录</button>
    </form>
    <div class="auth-footer">
        新用户？ <a href="register.php">立即注册</a>
    </div>
</div>
</body>
</html>
