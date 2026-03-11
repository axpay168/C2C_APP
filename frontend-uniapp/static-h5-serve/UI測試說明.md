# H5 靜態頁面 UI 測試說明

## 問題修復

原先 http://localhost:8082 顯示空白，原因如下：

1. **路由基準**：manifest 設定 `router.base: "h5/"`，應用需從 `/h5/` 路徑載入
2. **目錄結構**：`static-h5` 只放在根路徑，缺少對應 `/h5/` 的目錄
3. **依賴未安裝**：首次執行需先執行 `npm install`，`serve` 才會正常啟動

## 修復方案

1. 新增 `static-h5-serve/` 目錄結構，將 H5 內容放在 `h5/` 子目錄
2. 根路徑 `/` 會自動轉址到 `/h5/`
3. 調整 `package.json` 的 `start` 指令，改為啟動 `static-h5-serve`

## 啟動方式

```bash
cd /www/wwwroot/old/frontend-uniapp
npm install    # 若尚未安裝依賴
npm run start
```

瀏覽器訪問：**http://localhost:8082** 或 **http://localhost:8082/h5/**

## UI 測試檢查清單

| 項目 | 預期結果 |
|------|----------|
| 首頁載入 | 自動跳轉至登入頁（pages/common/login） |
| 登入表單 | 顯示帳號、密碼輸入框、記住密碼、登入按鈕 |
| 語言切換 | 右上角 Language 按鈕，點擊顯示語言選擇彈窗 |
| 靜態資源 | CSS、JS 正常載入，無 404 |
| 響應式 | 手機/桌面顯示正常 |

## 若為遠端伺服器

若本機不是執行環境，請改以伺服器 IP 或網域存取，例如：

- `http://YOUR_SERVER_IP:8082/h5/`
- `http://YOUR_DOMAIN:8082/h5/`

## 驗證指令（本機）

```bash
# 檢查服務是否監聽 8082
ss -tlnp | grep 8082

# 測試路徑
curl -I http://127.0.0.1:8082/        # 應 200，並有 redirect
curl -I http://127.0.0.1:8082/h5/     # 應 200
curl -I http://127.0.0.1:8082/h5/static/index.css  # 應 200
```
