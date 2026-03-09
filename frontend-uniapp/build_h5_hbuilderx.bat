@echo off
chcp 65001 >nul
setlocal

set "PROJECT_DIR=%~dp0"
set "PROJECT_DIR=%PROJECT_DIR:~0,-1%"

set "HBUILDERX_PATH="
for %%P in ("C:\Program Files\HBuilderX" "C:\Program Files (x86)\HBuilderX" "D:\HBuilderX" "C:\HBuilderX" "%USERPROFILE%\HBuilderX") do (
    if exist "%%~P\cli.exe" (
        set "HBUILDERX_PATH=%%~P"
        goto :found
    )
)

if defined HBUILDERX_PATH if exist "%HBUILDERX_PATH%\cli.exe" goto :found

echo [Error] HBuilderX not found. Please:
echo 1. Set: set HBUILDERX_PATH=YourPath
echo 2. Or use HBuilderX GUI: Import project -^> Right-click -^> Publish -^> H5
echo 3. Or use static-h5 folder (no build needed)
pause
exit /b 1

:found
echo [Found] HBuilderX: %HBUILDERX_PATH%
"%HBUILDERX_PATH%\cli.exe" uniapp:compile --platform h5 --project "%PROJECT_DIR%"
pause
