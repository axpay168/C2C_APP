@echo off
chcp 65001 >nul
cd /d "%~dp0"

echo ========================================
echo 驗證 npm 依賴安裝狀態
echo ========================================
echo.

echo [檢查 1] node_modules 目錄是否存在...
if exist "node_modules" (
    echo ✓ node_modules 目錄存在
) else (
    echo ✗ node_modules 目錄不存在
    echo   請先執行：npm install
    echo.
    pause
    exit /b 1
)

echo.
echo [檢查 2] 檢查必需的依賴包...
echo.

set "ALL_OK=1"

if exist "node_modules\echarts" (
    echo ✓ echarts 已安裝
) else (
    echo ✗ echarts 未安裝
    set "ALL_OK=0"
)

if exist "node_modules\ethers" (
    echo ✓ ethers 已安裝
) else (
    echo ✗ ethers 未安裝
    set "ALL_OK=0"
)

if exist "node_modules\tronweb" (
    echo ✓ tronweb 已安裝
) else (
    echo ✗ tronweb 未安裝
    set "ALL_OK=0"
)

if exist "node_modules\vue-i18n" (
    echo ✓ vue-i18n 已安裝
) else (
    echo ✗ vue-i18n 未安裝
    set "ALL_OK=0"
)

echo.
echo ========================================
if %ALL_OK% equ 1 (
    echo ✓ 所有依賴已正確安裝！
    echo.
    echo 現在可以在 HBuilderX 中執行：發行 → 網站-H5
) else (
    echo ✗ 部分依賴未安裝
    echo.
    echo 請執行以下命令重新安裝：
    echo   npm install
    echo.
    echo 或在 HBuilderX 終端中執行：
    echo   npm install
)
echo ========================================
echo.

REM 顯示依賴版本（如果 npm 可用）
where npm.cmd >nul 2>&1
if %ERRORLEVEL% equ 0 (
    echo [額外資訊] 檢查 package.json 中的依賴版本...
    echo.
    if exist "package.json" (
        echo 預期安裝的依賴：
        findstr /C:"echarts" /C:"ethers" /C:"tronweb" package.json | findstr /V "devDependencies"
    )
)

echo.
pause
