<?php
/**
 * 数据库连接测试文件
 * 访问: http://MXTRX.TOP/test_db.php
 */

header('Content-Type: text/html; charset=utf-8');

echo "<h2>数据库连接测试</h2>";
echo "<hr>";

try {
    $pdo = new PDO(
        'mysql:host=127.0.0.1;dbname=hkex02',
        'hkex02',
        'cZBYPH2XD4YM3yfX'
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<p style='color: green;'>✓ 数据库连接成功！</p>";
    
    // 检查表数量
    $stmt = $pdo->query("SHOW TABLES LIKE 'fa_%'");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "<p><strong>FastAdmin表数量:</strong> " . count($tables) . "</p>";
    
    if (count($tables) > 0) {
        echo "<p><strong>前10个表:</strong> " . implode(', ', array_slice($tables, 0, 10)) . "...</p>";
    }
    
    // 检查管理员账号
    echo "<hr><h3>管理员账号检查</h3>";
    $stmt = $pdo->query("SELECT id, username, nickname, email, status FROM fa_admin WHERE username='admin'");
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($admin) {
        echo "<p style='color: green;'>✓ 管理员账号存在</p>";
        echo "<ul>";
        echo "<li><strong>ID:</strong> " . $admin['id'] . "</li>";
        echo "<li><strong>用户名:</strong> " . $admin['username'] . "</li>";
        echo "<li><strong>昵称:</strong> " . $admin['nickname'] . "</li>";
        echo "<li><strong>邮箱:</strong> " . ($admin['email'] ?: '未设置') . "</li>";
        echo "<li><strong>状态:</strong> " . $admin['status'] . "</li>";
        echo "</ul>";
    } else {
        echo "<p style='color: red;'>✗ 管理员账号不存在</p>";
    }
    
    // 检查关键表
    echo "<hr><h3>关键表数据检查</h3>";
    $key_tables = [
        'fa_config' => '配置表',
        'fa_user' => '用户表',
        'fa_admin_log' => '管理员日志表',
        'fa_auth_rule' => '权限规则表'
    ];
    
    foreach ($key_tables as $table => $name) {
        try {
            $stmt = $pdo->query("SELECT COUNT(*) as cnt FROM `$table`");
            $count = $stmt->fetch(PDO::FETCH_ASSOC);
            echo "<p><strong>$name ($table):</strong> " . $count['cnt'] . " 条记录</p>";
        } catch (Exception $e) {
            echo "<p style='color: orange;'>⚠ $name ($table): 表不存在或查询失败</p>";
        }
    }
    
    // 检查数据库信息
    echo "<hr><h3>数据库信息</h3>";
    $stmt = $pdo->query("SELECT DATABASE() as db_name");
    $db_info = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<p><strong>当前数据库:</strong> " . $db_info['db_name'] . "</p>";
    
    $stmt = $pdo->query("SELECT COUNT(*) as total_tables FROM information_schema.tables WHERE table_schema = 'hkex02'");
    $total = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<p><strong>总表数量:</strong> " . $total['total_tables'] . "</p>";
    
    echo "<hr>";
    echo "<p style='color: green;'><strong>✓ 数据库导入验证完成！</strong></p>";
    echo "<p><a href='/buSRxMqJOo.php/index/login' target='_blank'>访问后台登录页面</a></p>";
    
} catch(Exception $e) {
    echo "<p style='color: red;'>✗ 数据库连接失败</p>";
    echo "<p><strong>错误信息:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<hr>";
    echo "<h3>可能的原因：</h3>";
    echo "<ul>";
    echo "<li>MySQL服务未运行</li>";
    echo "<li>数据库未创建</li>";
    echo "<li>数据库用户或密码错误</li>";
    echo "<li>数据库连接配置错误</li>";
    echo "</ul>";
    echo "<p>请检查：</p>";
    echo "<ol>";
    echo "<li>在宝塔面板中确认MySQL服务正在运行</li>";
    echo "<li>确认数据库 hkex02 已创建</li>";
    echo "<li>确认数据库用户 hkex02 存在且有权限</li>";
    echo "<li>检查 application/database.php 配置文件</li>";
    echo "</ol>";
}
?>
