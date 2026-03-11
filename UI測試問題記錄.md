# UI 測試問題記錄

> 記錄日期：2025-03-10

## 問題 1：API 302 重定向 / ERR_TOO_MANY_REDIRECTS（阻塞所有功能）

### 現象
- 登入 API 請求返回 302 重定向
- 控制台：`ERR_TOO_MANY_REDIRECTS`
- shoujia、登入等所有 API 均無法正常使用

### 根本原因
**宝塔「防跨站攻擊」** 將 PHP 的 `open_basedir` 限制為 `/www/wwwroot/old/backend-php/public/:/tmp/`，導致：

1. `index.php` 無法讀取 `application/admin/command/Install/install.lock` → 重定向到 install.php
2. `require thinkphp/start.php` 失敗 → thinkphp 在 `public/` 外
3. 所有依賴 application、thinkphp 的請求均失敗

### 解決方案（必須在宝塔完成）

**方式一：關閉防跨站（推薦）**

1. 宝塔 → 網站 → mxtrx.top → 設置
2. 網站目錄 → 將 **防跨站攻擊** 關閉
3. 保存 → 重載 PHP

**方式二：修改 .user.ini 的 open_basedir**

網站運行目錄下的 `public/.user.ini`  currently 為：
```
open_basedir=/www/wwwroot/old/backend-php/public/:/tmp/
```

需改為（允許讀取 thinkphp、application）：
```
open_basedir=/www/wwwroot/old/backend-php/:/tmp/
```

操作步驟：
1. 宝塔 → 文件 → 進入 `/www/wwwroot/old/backend-php/public/`
2. 編輯 `.user.ini`，將 `public/` 改為 `backend-php/`（即整段改為 `/www/wwwroot/old/backend-php/:/tmp/`）
3. 保存後，宝塔 → PHP → 重載配置 或 重啟 PHP-FPM

### 已嘗試的代碼修復
- 新增 `public/.installed` 並修改 index.php 的安裝檢查邏輯 → 可繞過 install.lock 檢查，但 `require thinkphp/start.php` 仍因 open_basedir 失敗
- **結論**：必須在宝塔調整 open_basedir，無法僅靠代碼修復

---

## 問題 2：登入頁面 API 調用方式

### 現狀
- 登入頁面已正確使用 `this.$u.api.index.login(account, password)`
- API 定義：`vm.$u.post("/user/login", {account, password})`
- 攔截器已設置 `Content-Type: application/x-www-form-urlencoded`
- baseUrl 生產環境：`window.location.origin + '/index.php/api'` ✅

### 待驗證（API 正常後）
- uView post 是否正確將 `{account, password}` 序列化為 form-urlencoded

---

## 問題 3：其他發現

- WebSocket (socket.io) 連接失敗：302 → 可能需配置 Nginx 支援
- 首頁顯示 `common.plsLogin` 未翻譯 → i18n key 可能缺失
- 登入頁面為舊版樣式（含 APP download、Language 等）→ 可能 H5 編譯自不同分支

---

## 修復優先級

1. **【必須】** 在宝塔完成 open_basedir / 防跨站 配置
2. 完成後重新測試：登入、註冊、錢包、OTC、充值提現
