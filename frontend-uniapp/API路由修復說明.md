# API 路由修復說明

## 🐛 問題：Cannot POST /api/user/register

### 問題描述
當輸入邀請碼 `123456` 並點擊註冊時，出現錯誤：
```
Cannot POST /api/user/register
```

### 原因分析
1. **API 路徑不正確**：
   - 前端請求：`/api/user/register`
   - 後端需要：`/index.php/api/user/register`

2. **HBuilderX H5 預覽環境**：
   - HBuilderX H5 預覽使用本地服務器（通常是 `localhost` 或 `127.0.0.1`）
   - 需要完整的後端 API 地址，包括 `/index.php/api` 前綴

3. **baseUrl 配置問題**：
   - 當前配置在本地環境可能返回 `/api`（需要代理）
   - 但 HBuilderX H5 預覽沒有配置代理，導致請求失敗

---

## ✅ 已實施的修復

### 1. 改進 baseUrl 配置邏輯

**修改前**：
```javascript
if (process.env.NODE_ENV === 'development') return '/api';
```

**修改後**：
```javascript
// 檢查是否在 HBuilderX H5 預覽環境
if (typeof window !== 'undefined' && window.location) {
    const hostname = window.location.hostname;
    
    if (hostname === 'localhost' || hostname === '127.0.0.1') {
        // HBuilderX H5 預覽，使用完整後端地址
        return 'http://127.0.0.1/index.php/api';
    }
    
    // 生產環境使用當前域名
    return window.location.origin + '/index.php/api';
}
```

### 2. 添加調試日誌

在 `http.interceptor.js` 中添加：
```javascript
const baseUrl = getBaseUrl();
console.log('[HTTP] API Base URL:', baseUrl);
```

---

## 🔧 需要確認的配置

### 1. 後端服務地址

請確認你的後端服務地址：
- **本地開發**：`http://127.0.0.1` 或 `http://localhost`
- **生產環境**：`https://mxtrx.top`

### 2. 修改 baseUrl（如果需要）

如果後端不在 `127.0.0.1`，請修改 `frontend-uniapp/common/http.interceptor.js` 中的：

```javascript
// 修改這一行為你的實際後端地址
return 'http://127.0.0.1/index.php/api';
```

例如，如果後端在 `http://localhost:8080`：
```javascript
return 'http://localhost:8080/index.php/api';
```

---

## 🧪 測試步驟

### 1. 檢查 Console 日誌

打開瀏覽器開發者工具（F12），查看 Console：
- 應該看到：`[HTTP] API Base URL: http://127.0.0.1/index.php/api`

### 2. 檢查 Network 請求

在 Network 標籤中：
- 請求 URL 應該是：`http://127.0.0.1/index.php/api/user/register`
- 不是：`/api/user/register`

### 3. 測試註冊

1. 輸入郵箱：`test@example.com`
2. 輸入密碼：`123456`
3. 輸入確認密碼：`123456`
4. 輸入邀請碼：`123456`
5. 點擊「註冊」

**預期結果**：
- ✅ 不再出現 "Cannot POST" 錯誤
- ✅ API 請求成功發送到後端
- ✅ 顯示註冊成功或後端返回的錯誤訊息

---

## 📝 如果仍然失敗

### 檢查 1：後端服務是否運行

確認後端 PHP 服務正在運行：
- 訪問：`http://127.0.0.1/index.php/api/user/login`（應該返回 JSON 響應）

### 檢查 2：CORS 跨域問題

如果出現 CORS 錯誤，需要在後端添加 CORS 頭：
```php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
```

### 檢查 3：修改 baseUrl

如果後端地址不同，請告訴我你的後端地址，我會幫你修改配置。

---

## 🚀 現在請測試

1. **重新編譯 H5**（在 HBuilderX 中）
2. **打開瀏覽器開發者工具**（F12）
3. **查看 Console**：
   - 應該看到 `[HTTP] API Base URL: ...`
4. **測試註冊**：
   - 輸入邀請碼 `123456`
   - 點擊註冊
5. **查看 Network 標籤**：
   - 檢查請求 URL 是否正確
   - 檢查響應狀態碼

請告訴我：
1. Console 中顯示的 API Base URL 是什麼？
2. Network 中請求的完整 URL 是什麼？
3. 是否還有 "Cannot POST" 錯誤？
