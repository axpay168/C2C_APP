<?php
/**
 * 查詢可用邀請碼
 * 訪問：http://your-domain/index.php/query_invite_code.php
 */

// 引入 ThinkPHP
define('APP_PATH', __DIR__ . '/../application/');
define('ROOT_PATH', __DIR__ . '/../');
require __DIR__ . '/../thinkphp/start.php';

use think\Db;

try {
    // 查詢所有用戶的邀請碼
    $users = Db::name('user')
        ->field('id, username, email, mobile, code, createtime')
        ->where('status', 'normal')
        ->where('code', '<>', '')
        ->order('id', 'asc')
        ->select();
    
    header('Content-Type: text/html; charset=utf-8');
    echo "<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>可用邀請碼查詢</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #333; border-bottom: 2px solid #0076fa; padding-bottom: 10px; }
        .code-item { background: #f9f9f9; padding: 15px; margin: 10px 0; border-radius: 5px; border-left: 4px solid #0076fa; }
        .code { font-size: 24px; font-weight: bold; color: #0076fa; margin: 10px 0; }
        .info { color: #666; font-size: 14px; }
        .no-data { text-align: center; padding: 40px; color: #999; }
        .test-code { background: #fff3cd; border-left-color: #ffc107; }
        .test-code .code { color: #856404; }
    </style>
</head>
<body>
    <div class='container'>
        <h1>📋 可用邀請碼列表</h1>";
    
    if (empty($users)) {
        echo "<div class='no-data'>
            <p>❌ 目前沒有可用的邀請碼</p>
            <p>請先註冊一個用戶，該用戶的 code 字段值就是邀請碼</p>
        </div>";
    } else {
        echo "<p>找到 <strong>" . count($users) . "</strong> 個用戶的邀請碼：</p>";
        
        foreach ($users as $user) {
            $isTest = ($user['id'] == 1 || strpos($user['username'], 'test') !== false || strpos($user['username'], 'admin') !== false);
            $class = $isTest ? 'code-item test-code' : 'code-item';
            
            echo "<div class='{$class}'>";
            echo "<div class='code'>邀請碼：{$user['code']}</div>";
            echo "<div class='info'>";
            echo "用戶ID: {$user['id']}<br>";
            echo "用戶名: " . ($user['username'] ?: '未設置') . "<br>";
            if ($user['email']) echo "郵箱: {$user['email']}<br>";
            if ($user['mobile']) echo "手機: {$user['mobile']}<br>";
            if ($user['createtime']) echo "創建時間: " . date('Y-m-d H:i:s', $user['createtime']) . "<br>";
            echo "</div>";
            echo "</div>";
        }
        
        // 顯示第一個邀請碼作為推薦
        $firstCode = $users[0]['code'];
        echo "<div style='background: #d4edda; padding: 20px; margin-top: 20px; border-radius: 5px; border-left: 4px solid #28a745;'>";
        echo "<h3 style='margin-top: 0; color: #155724;'>✅ 推薦測試邀請碼</h3>";
        echo "<div style='font-size: 32px; font-weight: bold; color: #155724; margin: 15px 0;'>{$firstCode}</div>";
        echo "<p style='color: #155724; margin-bottom: 0;'>這是第一個用戶的邀請碼，可以直接用於測試註冊功能</p>";
        echo "</div>";
    }
    
    echo "</div></body></html>";
    
} catch (\Exception $e) {
    header('Content-Type: text/html; charset=utf-8');
    echo "<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>錯誤</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .error { background: #f8d7da; color: #721c24; padding: 20px; border-radius: 5px; border-left: 4px solid #dc3545; }
    </style>
</head>
<body>
    <div class='error'>
        <h2>❌ 查詢失敗</h2>
        <p><strong>錯誤信息：</strong>{$e->getMessage()}</p>
        <p><strong>文件：</strong>{$e->getFile()}</p>
        <p><strong>行號：</strong>{$e->getLine()}</p>
    </div>
</body>
</html>";
}
