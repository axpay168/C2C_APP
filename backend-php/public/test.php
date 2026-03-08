<?php
/**
 * 項目功能測試腳本
 * 訪問: http://您的域名/test.php
 */

header('Content-Type: text/html; charset=utf-8');
echo "<h1>項目功能測試</h1>";

// 1. PHP 版本檢查
echo "<h2>1. PHP 環境檢查</h2>";
echo "PHP 版本: " . PHP_VERSION . "<br>";
echo "PHP SAPI: " . php_sapi_name() . "<br>";

// 2. 必要擴展檢查
echo "<h2>2. PHP 擴展檢查</h2>";
$required_extensions = ['pdo', 'pdo_mysql', 'curl', 'json', 'mbstring', 'fileinfo'];
foreach ($required_extensions as $ext) {
    $loaded = extension_loaded($ext);
    echo ($loaded ? "✓" : "✗") . " $ext: " . ($loaded ? "已加載" : "未加載") . "<br>";
}

// 3. 數據庫連接測試
echo "<h2>3. 數據庫連接測試</h2>";
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=old', 'old', 'fRiTc2bjFtBbSMHC');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✓ 數據庫連接成功<br>";
    
    // 檢查表
    $stmt = $pdo->query("SELECT COUNT(*) as cnt FROM information_schema.tables WHERE table_schema='old'");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "✓ 數據表數量: " . $result['cnt'] . "<br>";
    
    // 檢查管理員
    $stmt = $pdo->query("SELECT COUNT(*) as cnt FROM fa_admin");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "✓ 管理員數量: " . $result['cnt'] . "<br>";
    
} catch (Exception $e) {
    echo "✗ 數據庫連接失敗: " . $e->getMessage() . "<br>";
}

// 4. 文件權限檢查
echo "<h2>4. 文件權限檢查</h2>";
$dirs = [
    '../runtime' => 'runtime',
    '../application/runtime' => 'application/runtime',
    'uploads' => 'public/uploads',
];
foreach ($dirs as $path => $name) {
    $exists = is_dir($path);
    $writable = $exists && is_writable($path);
    echo ($exists ? "✓" : "✗") . " $name 目錄: " . ($exists ? ($writable ? "存在且可寫" : "存在但不可寫") : "不存在") . "<br>";
}

// 5. Composer 檢查
echo "<h2>5. Composer 依賴檢查</h2>";
$vendor_exists = file_exists('../vendor/autoload.php');
echo ($vendor_exists ? "✓" : "✗") . " vendor/autoload.php: " . ($vendor_exists ? "存在" : "不存在") . "<br>";

// 6. ThinkPHP 框架檢查
echo "<h2>6. ThinkPHP 框架檢查</h2>";
$thinkphp_exists = file_exists('../thinkphp/start.php');
echo ($thinkphp_exists ? "✓" : "✗") . " thinkphp/start.php: " . ($thinkphp_exists ? "存在" : "不存在") . "<br>";

// 7. H5 前端檢查
echo "<h2>7. H5 前端檢查</h2>";
$h5_index = file_exists('h5/index.html');
echo ($h5_index ? "✓" : "✗") . " h5/index.html: " . ($h5_index ? "存在" : "不存在") . "<br>";

echo "<hr>";
echo "<p><strong>測試完成！</strong> 如果所有項目都顯示 ✓，說明環境配置正確。</p>";
echo "<p>請訪問以下地址進行功能測試：</p>";
echo "<ul>";
echo "<li>後台入口: <a href='buSRxMqJOo.php'>buSRxMqJOo.php</a> 或 <a href='index.php/admin/index/login'>index.php/admin/index/login</a></li>";
echo "<li>H5 前端: <a href='h5/'>h5/</a></li>";
echo "<li>API 測試: <a href='index.php/api/index/index'>index.php/api/index/index</a></li>";
echo "</ul>";
