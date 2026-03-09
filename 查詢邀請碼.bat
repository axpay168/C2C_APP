@echo off
chcp 65001 >nul
echo ========================================
echo 查詢數據庫中的邀請碼
echo ========================================
echo.

REM 嘗試使用 MySQL 客戶端查詢
mysql -h 127.0.0.1 -u old -pfRiTc2bjFtBbSMHC old -e "SELECT id, username, email, code, status FROM fa_user WHERE code IS NOT NULL AND code != '' ORDER BY id ASC LIMIT 10;" 2>nul

if %errorlevel% neq 0 (
    echo.
    echo [錯誤] 無法連接到數據庫或 MySQL 客戶端未安裝
    echo.
    echo 請使用以下方法之一：
    echo 1. 訪問網頁：http://your-domain/index.php/query_invite_code.php
    echo 2. 使用數據庫管理工具（如 phpMyAdmin、Navicat）執行以下 SQL：
    echo.
    echo    SELECT id, username, email, code, status 
    echo    FROM fa_user 
    echo    WHERE code IS NOT NULL AND code != '' 
    echo    ORDER BY id ASC 
    echo    LIMIT 10;
    echo.
    echo 3. 如果數據庫中沒有邀請碼，可以手動創建：
    echo    UPDATE fa_user SET code = '123456' WHERE id = 1;
    echo.
)

pause
