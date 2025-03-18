-- 用户表
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 打卡记录表
CREATE TABLE IF NOT EXISTS records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    type ENUM('健身', '学习', '自定义') NOT NULL,
    content VARCHAR(255),
    date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 成长体系表
CREATE TABLE IF NOT EXISTS growth (
    user_id INT PRIMARY KEY,
    streak_days INT DEFAULT 0 COMMENT '连续打卡天数',
    stars INT DEFAULT 0 COMMENT '当前星星数量',
    moons INT DEFAULT 0 COMMENT '当前月亮数量',
    suns INT DEFAULT 0 COMMENT '当前太阳数量',
    last_checkin DATE COMMENT '最后打卡日期',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 励志语录表
CREATE TABLE IF NOT EXISTS quotes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    author VARCHAR(100)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 初始数据
INSERT INTO quotes (content, author) VALUES
('每天进步1%，一年后你会强大37倍', '原子习惯'),
('伟大不是一次卓越的行为，而是习惯的产物', '亚里士多德'),
('成功是日复一日的小努力积累起来的', '罗伯特·科利尔'),
('不要等待，时机永远不会刚刚好', '拿破仑·希尔'),
('你最大的对手不是别人，是昨天的自己', NULL);

-- 索引优化
CREATE INDEX idx_records_user ON records(user_id);
CREATE INDEX idx_records_date ON records(date);
