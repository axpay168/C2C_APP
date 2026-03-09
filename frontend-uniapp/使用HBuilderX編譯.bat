@echo off
chcp 65001 >nul
setlocal

:: ========== 使用 HBuilderX 編譯 old 專案（無需 npm）==========
:: 問題記錄：見 編譯問題記錄.md

set "PROJECT_DIR=%~dp0"
set "PROJECT_DIR=%PROJECT_DIR:~0,-1%"

:: 方式 1：自動搜尋 HBuilderX
set "HBUILDERX_PATH="
for %%P in (
    "C:\Program Files\HBuilderX"
    "C:\Program Files (x86)\HBuilderX"
    "D:\HBuilderX"
    "C:\HBuilderX"
    "%USERPROFILE%\HBuilderX"
) do (
    if exist "%%~P\cli.exe" (
        set "HBUILDERX_PATH=%%~P"
        goto :found
    )
)

:: 方式 2：從環境變數讀取（可手動設定）
if defined HBUILDERX_PATH (
    if exist "%HBUILDERX_PATH%\cli.exe" goto :found
)

:: 未找到 HBuilderX
echo.
echo [錯誤] 未找到 HBuilderX，請選擇以下方式之一：
echo.
echo 方式 A - 設定環境變數後重試：
echo   set HBUILDERX_PATH=您的HBuilderX安裝路徑
echo   例：set HBUILDERX_PATH=D:\HBuilderX
echo.
echo 方式 B - 修改本腳本第 22 行，加入您的 HBuilderX 路徑
echo.
echo 方式 C - 使用 HBuilderX 圖形介面手動編譯（推薦，最穩定）：
echo   1. 先開啟 HBuilderX 編輯器
echo   2. 檔案→匯入→從本地目錄匯入，選擇：%PROJECT_DIR%
echo   3. 右鍵專案→發行→網站-H5
echo   4. 編譯完成後產出在 unpackage\dist\build\h5\
echo.
echo 方式 D - 使用已編譯的 static-h5（無需編譯）：
echo   直接使用 static-h5\ 目錄，或複製到後端 public/h5/
echo.
pause
exit /b 1

:found
echo [找到] HBuilderX: %HBUILDERX_PATH%
echo [專案] %PROJECT_DIR%
echo [編譯] 開始編譯 H5...
echo.

"%HBUILDERX_PATH%\cli.exe" uniapp:compile --platform h5 --project "%PROJECT_DIR%"

if %ERRORLEVEL% neq 0 (
    echo.
    echo [提示] 若 cli 參數不同，請改用 HBuilderX 圖形介面：發行 → 網站-H5
    echo.
    pause
    exit /b 1
)

echo.
echo [完成] 編譯產出：unpackage\dist\build\h5\
pause
exit /b 0
