<?php
/**
 * 快速查詢邀請碼腳本
 * 直接輸出 JSON 格式的邀請碼列表
 */

// 引入 ThinkPHP
define('APP_PATH', __DIR__ . '/../application/');
define('ROOT_PATH', __DIR__ . '/../');
require __DIR__ . '/../thinkphp/start.php';

use think\Db;

header('Content-Type: application/json; charset=utf-8');

try {
    // 查詢所有用戶的邀請碼
    $users = Db::name('user')
        ->field('id, username, email, mobile, code, createtime, status')
        ->where('code', '<>', '')
        ->where('code', 'not null')
        ->order('id', 'asc')
        ->select();
    
    $result = [
        'success' => true,
        'count' => count($users),
        'invite_codes' => [],
        'recommended_code' => null
    ];
    
    if (!empty($users)) {
        foreach ($users as $user) {
            $result['invite_codes'][] = [
                'code' => $user['code'],
                'user_id' => $user['id'],
                'username' => $user['username'] ?: '未設置',
                'email' => $user['email'] ?: '',
                'mobile' => $user['mobile'] ?: '',
                'status' => $user['status'],
                'create_time' => $user['createtime'] ? date('Y-m-d H:i:s', $user['createtime']) : ''
            ];
        }
        
        // 推薦第一個邀請碼
        $result['recommended_code'] = $users[0]['code'];
    }
    
    echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    
} catch (\Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine()
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}
