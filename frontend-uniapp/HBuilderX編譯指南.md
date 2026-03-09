# old 專案編譯指南（HBuilderX，無需 npm）

## 推薦方式：HBuilderX 圖形介面（最穩定）

專案 `編譯修復說明.md` 指出：npm 編譯有 recyclableRender 錯誤，**建議使用 HBuilderX**。

### 步驟

1. **開啟 HBuilderX**
2. **匯入專案**
   - 選單：檔案 → 匯入 → 從本地目錄匯入
   - 選擇：`frontend-uniapp` 目錄（本目錄）
3. **發行 H5**
   - 在左側專案樹中，右鍵點擊專案
   - 選擇：發行 → 網站-H5
4. **編譯產出**
   - 輸出目錄：`unpackage/dist/build/h5/`
   - 部署時可複製到：`../backend-php/public/h5/`

---

## 方式二：命令列（cli.exe）

若 HBuilderX 已安裝且路徑已知：

```batch
:: 設定 HBuilderX 路徑（請改為您的實際路徑）
set HBUILDERX_PATH=D:\HBuilderX

"%HBUILDERX_PATH%\cli.exe" uniapp:compile --platform h5 --project "專案完整路徑"
```

或直接執行：`使用HBuilderX編譯.bat`（腳本會嘗試自動搜尋 HBuilderX）

**注意**：部分 CLI 指令需要 HBuilderX 編輯器已開啟。

---

## 方式三：使用已編譯 static-h5（無需編譯）

專案內含 `static-h5/` 目錄，為已編譯好的 H5 靜態檔。

- **用途**：可直接部署，無需編譯
- **位置**：`static-h5/`
- **部署**：複製到 `../backend-php/public/h5/` 即可

適用於：快速測試、對接 API、不需改動前端程式碼時。

---

## 問題排除（見 編譯問題記錄.md）

| 問題 | 對應方式 |
|------|----------|
| npm 未安裝 | 使用 HBuilderX 或 static-h5 |
| recyclableRender 錯誤 | 改用 HBuilderX 編譯 |
| 找不到 HBuilderX | 手動指定路徑或使用圖形介面 |
