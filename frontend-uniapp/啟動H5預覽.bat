@echo off
chcp 65001 >nul
cd /d "%~dp0"

echo ========================================
echo HBuilderX H5 預覽啟動指南
echo ========================================
echo.

echo [說明]
echo 此腳本用於檢查 H5 預覽的準備工作
echo.
echo [步驟] 在 HBuilderX 中啟動預覽：
echo.
echo 1. 確保 HBuilderX 已開啟專案
echo 2. 點擊工具欄的「運行」按鈕
echo 3. 選擇「運行到瀏覽器 → Chrome」（或其他瀏覽器）
echo 4. 或使用快捷鍵：Ctrl + R
echo.
echo [預期結果]
echo - 瀏覽器會自動打開：http://localhost:8080
echo - 可以看到 H5 預覽頁面
echo - 修改代碼後會自動刷新
echo.

echo [檢查] 編譯輸出是否存在...
if exist "unpackage\dist\build\web\index.html" (
    echo ✓ 編譯輸出存在
    echo   位置：unpackage\dist\build\web\index.html
) else (
    echo ✗ 編譯輸出不存在
    echo   請先在 HBuilderX 中執行：發行 → 網站-H5
)

echo.
echo [檢查] node_modules 是否存在...
if exist "node_modules" (
    echo ✓ node_modules 存在
) else (
    echo ✗ node_modules 不存在
    echo   請先執行：npm install
)

echo.
echo ========================================
echo 準備工作檢查完成
echo ========================================
echo.
echo [重要提示]
echo 1. 在 HBuilderX 中使用「運行到瀏覽器」功能
echo 2. 這會啟動開發伺服器，支持熱更新
echo 3. 修改代碼後會自動重新編譯和刷新
echo.
echo [如果無法使用「運行到瀏覽器」]
echo 可以手動啟動 HTTP 伺服器預覽編譯後的靜態文件：
echo   cd unpackage\dist\build\web
echo   python -m http.server 8080
echo   或使用 serve：serve -l 8080
echo.
pause
