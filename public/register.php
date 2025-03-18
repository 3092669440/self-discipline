<?php
session_start();
if(isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<!-- 类似登录页结构，修改表单字段 -->
<form action="includes/auth.php" method="POST">
    <input type="hidden" name="action" value="register">
    <div class="form-group">
        <input type="text" name="username" placeholder="用户名" required>
    </div>
    <div class="form-group">
        <input type="email" name="email" placeholder="邮箱" required>
    </div>
    <div class="form-group">
        <input type="password" name="password" placeholder="密码" required>
    </div>
    <button type="submit" class="btn-gradient">注 册</button>
</form>
