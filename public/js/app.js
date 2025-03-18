// 初始化 Chart.js
let progressChart = null;

// 打卡功能处理
document.querySelectorAll('.checkin-btn').forEach(btn => {
    btn.addEventListener('click', async function() {
        const type = this.dataset.type;
        const content = prompt('请输入打卡内容（可选）:');

        try {
            const response = await fetch('/api/checkin.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    type,
                    content: content || ''
                })
            });

            const result = await response.json();

            if (result.success) {
                showNotification('打卡成功！🎉');
                updateRankBadges(result.ranks);
                refreshChart();
            } else {
                showNotification(`失败：${result.message}`, 'error');
            }
        } catch (error) {
            showNotification('网络错误，请稍后重试', 'error');
        }
    });
});

// 更新等级徽章
function updateRankBadges({ stars, moons, suns }) {
    const rankContainer = document.querySelector('.rank-progress');
    rankContainer.innerHTML = '';

    // 生成星星
    for (let i = 0; i < stars; i++) {
        const star = document.createElement('div');
        star.className = 'rank-item star animate__animated animate__bounceIn';
        rankContainer.appendChild(star);
    }

    // 生成月亮
    if (moons > 0) {
        const moon = document.createElement('div');
        moon.className = 'rank-item moon animate__animated animate__flipInY';
        moon.textContent = `×${moons}`;
        rankContainer.appendChild(moon);
    }

    // 生成太阳
    if (suns > 0) {
        const sun = document.createElement('div');
        sun.className = 'rank-item sun animate__animated animate__rubberBand';
        sun.textContent = `×${suns}`;
        rankContainer.appendChild(sun);
    }
}

// 初始化统计图表
async function initChart() {
    const ctx = document.getElementById('progressChart').getContext('2d');

    const data = await fetch('/api/stats.php?range=week')
        .then(res => res.json());

    progressChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.labels,
            datasets: [{
                label: '打卡次数',
                data: data.values,
                borderColor: '#6C5CE7',
                tension: 0.4,
                fill: true,
                backgroundColor: 'rgba(108, 92, 231, 0.1)'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
}

// 刷新图表数据
async function refreshChart() {
    const data = await fetch('/api/stats.php?range=week')
        .then(res => res.json());

    progressChart.data.labels = data.labels;
    progressChart.data.datasets[0].data = data.values;
    progressChart.update();
}

// 显示通知
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.textContent = message;

    document.body.appendChild(notification);
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// 页面加载初始化
document.addEventListener('DOMContentLoaded', () => {
    initChart();
    // 每日励志语录
    fetch('/api/quote.php')
        .then(res => res.json())
        .then(data => {
            document.querySelector('.quote').textContent = `" ${data.quote} "`;
        });
});
