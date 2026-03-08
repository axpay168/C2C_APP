# HBuilderX 操作指南 - old 專案

## 1. 打開專案

1. 啟動 HBuilderX
2. 文件 → 打開目錄 → 選擇 `/www/wwwroot/old/frontend-uniapp`
3. 等待專案載入完成

## 2. 運行 H5 開發調試

1. 菜單：**運行** → **運行到瀏覽器** → **Chrome**（或其他瀏覽器）
2. 首次運行會自動編譯，稍候在瀏覽器中打開
3. 預設地址：`http://localhost:8080`（或顯示的埠）

## 3. 編譯 H5 生產版

1. 菜單：**發行** → **網站-H5 行動版**
2. 選擇輸出目錄（建議 `unpackage/dist/build/h5`）
3. 等待編譯完成

## 4. 部署到後端 public/h5

編譯完成後，將 `unpackage/dist/build/h5/` 下所有文件複製到：
`/www/wwwroot/old/backend-php/public/h5/`

```bash
cd /www/wwwroot/old/frontend-uniapp
cp -r unpackage/dist/build/h5/* ../backend-php/public/h5/
```

## 5. API 地址配置

確保前端請求的 API 地址指向後端，在 `common/` 或 `config.js` 中配置：
- 開發：`http://localhost/old/backend-php/public/` 或對應 Nginx 配置
- 生產：`https://您的域名/api/`

## 6. 依賴安裝（若使用 npm）

若專案支援 npm 運行：
```bash
cd /www/wwwroot/old/frontend-uniapp
npm install
# 若有 dev:h5 腳本：npm run dev:h5
```

## 7. 常見問題

- **白屏**：檢查 API 地址、控制台錯誤
- **跨域**：後端需配置 CORS 或 Nginx 反向代理
- **無法控制 HBuilderX**：HBuilderX 為桌面 IDE，無法通過 CLI 自動操作，需手動點擊運行/發行
