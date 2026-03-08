# 新伺服器 Cursor 指示（接手 old 專案）

> 將以下內容複製給新伺服器上的 Cursor，讓 AI 繼續完成未完成工作。

---

## 專案背景

這是一個 **海外 C2C 交易平台** 專案（代號 `old`），技術棧：PHP（FastAdmin/ThinkPHP 5）+ uni-app（Vue 2）+ MySQL。  
已從舊伺服器打包並推送到 `git@github.com:axpay168/old.git`，包含數據庫導出與部署文檔。

---

## 專案路徑

```
/www/wwwroot/old/
```

---

## 已完成工作

1. **後台登入**：Nginx 已配置 pathinfo，後台可登入。
2. **H5 API**：前端 API 已改為使用當前域名（mxtrx.top），不再指向 hkex-sm.com / 149.104.29.96。
3. **H5 編譯相關**：已調整 `package.json` 的 `build:h5`，加入 `UNI_CLI_CONTEXT`、`UNI_INPUT_DIR`，並將 `@vue/cli-plugin-babel` 降級為 4.5.19。
4. **數據庫**：已導出完整數據到 `db/old_full.sql`。
5. **部署文檔**：已建立 `部署說明.md`，包含數據庫、Nginx、前後端部署步驟。

---

## 尚未完成 / 需在新伺服器完成的工作

1. **執行部署**：按 `部署說明.md` 完成數據庫導入、`composer install`、Nginx 配置、權限設置。
2. **修改 API 域名**：若新伺服器使用新域名，需在 `frontend-uniapp` 中將 API 基礎地址改為新域名。
3. **H5 編譯**：npm build 可能仍有 `recyclableRender` 錯誤，可優先使用 HBuilderX 編譯，或嘗試 `UNI_CLI_CONTEXT=$(pwd) UNI_INPUT_DIR=$(pwd) npm run build:h5`。
4. **驗證功能**：登錄、交易、充值提現、後台管理等，確保在新環境運行正常。

---

## 重要檔案位置

| 說明 | 路徑 |
|------|------|
| 數據庫配置 | `backend-php/application/database.php` |
| API 基礎地址 | `frontend-uniapp` 內 `config`、`store`、`utils` 等 |
| 後台入口 | `backend-php/public/index.php` 或自訂 `buSRxMqJOo.php` |
| H5 編譯說明 | `frontend-uniapp/编译修复说明.md` |
| 部署說明 | `部署說明.md` |
| 數據庫完整導出 | `db/old_full.sql` |

---

## 數據庫資訊（部署用）

- 庫名：`old`
- 用戶：`old`
- 密碼：`fRiTc2bjFtBbSMHC`
- 表前綴：`fa_`

---

## 請 Cursor 協助的具體任務

1. 根據 `部署說明.md` 完成新伺服器部署（數據庫、Nginx、PHP、前端編譯）。
2. 將前端 API 基礎地址改為當前域名（若與 mxtrx.top 不同）。
3. 若 H5 編譯失敗，協助排查或改用 HBuilderX 編譯方式。
4. 驗證後台、H5 頁面、API 調用是否正常，並回報結果。
