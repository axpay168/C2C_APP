@echo off
chcp 65001 >nul
cd /d "%~dp0"

echo 正在檢查 Node.js...
where npm >nul 2>&1
if %ERRORLEVEL% neq 0 (
    echo.
    echo [錯誤] 未找到 npm，請先安裝 Node.js：
    echo 1. 下載 https://nodejs.org/
    echo 2. 安裝時勾選 "Add to PATH"
    echo 3. 重新開啟此視窗後再執行
    pause
    exit /b 1
)

echo 執行 npm install...
call npm install
if %ERRORLEVEL% neq 0 (
    echo npm install 失敗
    pause
    exit /b 1
)

echo.
echo 依賴安裝完成，請在 HBuilderX 中再次執行：發行 - 網站-H5
pause
