<?php
// 数据库配置通过环境变量获取
$dbConfig = parse_url(getenv('DATABASE_URL'));
define('DB_HOST', $dbConfig['host']);
define('DB_USER', $dbConfig['user']);
define('DB_PASS', $dbConfig['pass']);
define('DB_NAME', ltrim($dbConfig['path'], '/'));
?>
