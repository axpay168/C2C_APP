@echo off
chcp 65001 >nul
cd /d "%~dp0"

echo ========================================
echo HBuilderX 依賴問題修復腳本
echo ========================================
echo.

echo [步驟 1] 檢查 node_modules 是否存在...
if exist "node_modules" (
    echo ✓ node_modules 已存在
    echo.
    echo 如果編譯仍有問題，請嘗試刪除 node_modules 後重新安裝：
    echo   rmdir /s /q node_modules
    echo   npm install
    pause
    exit /b 0
) else (
    echo ✗ node_modules 不存在，需要安裝依賴
    echo.
)

echo [步驟 2] 尋找 npm...
echo.

REM 啟用延遲變數擴展
setlocal enabledelayedexpansion

REM 檢查常見的 Node.js 安裝路徑
set "NPM_PATH="
if exist "C:\Program Files\nodejs\npm.cmd" (
    set "NPM_PATH=C:\Program Files\nodejs\npm.cmd"
    echo ✓ 找到 npm: C:\Program Files\nodejs\npm.cmd
    goto :found_npm
)
if exist "C:\Program Files (x86)\nodejs\npm.cmd" (
    set "NPM_PATH=C:\Program Files (x86)\nodejs\npm.cmd"
    echo ✓ 找到 npm: C:\Program Files (x86)\nodejs\npm.cmd
    goto :found_npm
)
if exist "%APPDATA%\npm\npm.cmd" (
    set "NPM_PATH=%APPDATA%\npm\npm.cmd"
    echo ✓ 找到 npm: %APPDATA%\npm\npm.cmd
    goto :found_npm
)
if exist "%LOCALAPPDATA%\Programs\nodejs\npm.cmd" (
    set "NPM_PATH=%LOCALAPPDATA%\Programs\nodejs\npm.cmd"
    echo ✓ 找到 npm: %LOCALAPPDATA%\Programs\nodejs\npm.cmd
    goto :found_npm
)

REM 嘗試使用 where 命令查找
where npm.cmd >nul 2>&1
if %ERRORLEVEL% equ 0 (
    for /f "delims=" %%i in ('where npm.cmd') do (
        set "NPM_PATH=%%i"
        echo ✓ 找到 npm: %%i
        goto :found_npm
    )
)

:found_npm
if not defined NPM_PATH (
    echo ✗ 未找到 npm
    echo.
    echo 請選擇以下方案之一：
    echo.
    echo [方案 A] 在 HBuilderX 中安裝依賴：
    echo   1. 開啟 HBuilderX
    echo   2. 選單：工具 → 插件安裝 → npm 安裝
    echo   3. 或在 HBuilderX 終端執行：npm install
    echo.
    echo [方案 B] 手動安裝 Node.js：
    echo   1. 下載：https://nodejs.org/
    echo   2. 安裝時勾選 "Add to PATH"
    echo   3. 重新開啟此視窗後執行
    echo.
    echo [方案 C] 使用 HBuilderX 內建 Node.js：
    echo   檢查 HBuilderX 安裝目錄下的 plugins\node\node.exe
    echo   使用該路徑執行 npm install
    echo.
    pause
    exit /b 1
)

echo.
echo [步驟 3] 執行 npm install...
echo.
call "%NPM_PATH%" install
if %ERRORLEVEL% neq 0 (
    echo.
    echo ✗ npm install 失敗
    echo.
    echo 請嘗試：
    echo   1. 檢查網路連線
    echo   2. 清除 npm 快取：npm cache clean --force
    echo   3. 使用淘寶鏡像：npm install --registry=https://registry.npmmirror.com
    echo.
    pause
    exit /b 1
)

echo.
echo ========================================
echo ✓ 依賴安裝完成！
echo ========================================
echo.
echo 現在可以在 HBuilderX 中執行：發行 → 網站-H5
echo.
pause
