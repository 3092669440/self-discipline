<?php
require_once __DIR__ . '/includes/auth.php';
checkLogin();

// 获取用户数据
$user = getUserData($_SESSION['user_id']);
$stats = getProgressStats($_SESSION['user_id']);
$rank = calculateRank($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<!-- 在 dashboard.php 的 head 部分添加 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- 头部元信息 -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="dashboard-container">
    <!-- 侧边栏 -->
    <aside class="sidebar">
        <div class="user-card">
            <div class="avatar"><?= $rank['current_badge'] ?></div>
            <h3><?= htmlspecialchars($user['username']) ?></h3>
            <div class="rank-progress">
                <div class="rank-item star" data-count="<?= $rank['stars'] ?>"></div>
                <div class="rank-item moon" data-count="<?= $rank['moons'] ?>"></div>
                <div class="rank-item sun" data-count="<?= $rank['suns'] ?>"></div>
            </div>
        </div>
        <nav>
            <a href="dashboard.php" class="active"><i class="icon-home"></i> 今日打卡</a>
            <a href="stats.php"><i class="icon-chart"></i> 数据统计</a>
            <a href="profile.php"><i class="icon-user"></i> 个人中心</a>
        </nav>
    </aside>

    <!-- 主内容区 -->
    <main>
        <div class="checkin-card glassmorphism">
            <h2>📅 今日自律目标</h2>
            <div class="quote"><?= getDailyQuote() ?></div>
            <div class="checkin-options">
                <button class="checkin-btn fitness" data-type="健身">🏋️ 健身打卡</button>
                <button class="checkin-btn study" data-type="学习">📚 学习打卡</button>
                <button class="checkin-btn custom" data-type="自定义">✨ 自定义目标</button>
            </div>
        </div>

        <div class="stats-card glassmorphism">
            <h3>📈 本周成就进度</h3>
            <canvas id="progressChart"></canvas>
        </div>
    </main>
</div>

<script src="js/app.js"></script>
</body>
</html>
