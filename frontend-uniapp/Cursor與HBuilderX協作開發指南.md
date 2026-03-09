# Cursor 與 HBuilderX 協作開發指南

## 📋 基礎準備工作確認

### ✅ 已完成的準備工作

1. **目錄結構一致**
   - Cursor 和 HBuilderX 都開啟同一個專案目錄
   - 專案路徑：`C:\Users\lkkab\Desktop\file\old\frontend-uniapp`

2. **依賴已安裝**
   - ✅ `node_modules` 目錄存在
   - ✅ 所有依賴（echarts、ethers、tronweb、vue-i18n）已安裝

3. **編譯成功**
   - ✅ HBuilderX 編譯成功
   - ✅ 輸出目錄：`unpackage/dist/build/web`
   - ✅ 編譯輸出檔案完整

---

## 🚀 HBuilderX H5 預覽設置

### 方法一：運行到瀏覽器（推薦 - 支持熱更新）

這是**最佳方式**，支持實時預覽和熱更新：

#### 步驟：

1. **在 HBuilderX 中開啟專案**
   - 確保專案已正確載入

2. **運行到瀏覽器**
   - 點擊工具欄的「運行」按鈕
   - 或選單：**運行 → 運行到瀏覽器 → Chrome**（或其他瀏覽器）
   - 或快捷鍵：`Ctrl + R`（Windows）

3. **自動啟動開發伺服器**
   - HBuilderX 會自動啟動開發伺服器
   - 預設端口：`8080`
   - 瀏覽器會自動打開：`http://localhost:8080`

4. **實時預覽**
   - 修改代碼後，HBuilderX 會自動重新編譯
   - 瀏覽器會自動刷新顯示最新內容
   - **支持熱更新**，無需手動刷新

#### 優點：
- ✅ 支持熱更新，修改即時可見
- ✅ 自動重新編譯
- ✅ 開發體驗最佳

#### 注意事項：
- 確保端口 8080 未被占用
- 如果端口被占用，HBuilderX 會自動使用其他端口

---

### 方法二：預覽編譯後的靜態文件

如果方法一無法使用，可以使用此方法：

#### 步驟：

1. **編譯專案**
   - 在 HBuilderX 中：**發行 → 網站-H5**
   - 等待編譯完成

2. **預覽靜態文件**
   - 在 HBuilderX 中：**運行 → 運行到瀏覽器 → 選擇瀏覽器**
   - 或直接打開：`unpackage/dist/build/web/index.html`

3. **手動刷新**
   - 修改代碼後，需要重新編譯
   - 然後手動刷新瀏覽器

#### 缺點：
- ❌ 不支持熱更新
- ❌ 需要手動重新編譯和刷新

---

## 🔄 開發工作流程

### 推薦工作流程（實時預覽）

```
1. 在 HBuilderX 中啟動「運行到瀏覽器」
   ↓
2. 瀏覽器自動打開預覽頁面
   ↓
3. 在 Cursor 中修改代碼
   ↓
4. HBuilderX 自動檢測變更並重新編譯
   ↓
5. 瀏覽器自動刷新顯示最新內容
   ↓
6. 重複步驟 3-5
```

### 工作流程詳解

#### 步驟 1：啟動開發伺服器

在 HBuilderX 中：
1. 點擊工具欄的「運行」按鈕
2. 選擇「運行到瀏覽器 → Chrome」
3. 等待編譯完成，瀏覽器自動打開

#### 步驟 2：在 Cursor 中編寫代碼

1. 在 Cursor 中打開專案
2. 修改任何 `.vue`、`.js`、`.css` 文件
3. 保存文件（`Ctrl + S`）

#### 步驟 3：自動更新

- HBuilderX 會自動檢測文件變更
- 自動重新編譯
- 瀏覽器自動刷新顯示最新內容

---

## ⚙️ 配置說明

### HBuilderX 運行配置

#### 檢查運行配置：

1. **工具 → 設定 → 執行時設定**
2. **檢查以下配置**：
   - Node.js 路徑：應指向 Node.js 安裝目錄
   - npm 路徑：應指向 npm 可執行文件
   - 瀏覽器：選擇預設瀏覽器

#### 開發伺服器配置

已在 `vue.config.js` 中配置：
```javascript
devServer: {
  host: '0.0.0.0',        // 允許外部訪問
  port: 8080,             // 預設端口
  allowedHosts: 'all',    // 允許所有主機
  disableHostCheck: true  // 禁用主機檢查
}
```

### manifest.json H5 配置

已在 `manifest.json` 中配置：
```json
"h5": {
  "template": "template.h5.html",
  "router": {
    "mode": "hash",
    "base": "h5/"
  },
  "devServer": {
    "https": false
  }
}
```

---

## 🛠️ 常見問題排除

### 問題 1：無法啟動開發伺服器

**解決方案**：
1. 檢查端口 8080 是否被占用
2. 檢查 Node.js 是否正確安裝
3. 檢查 HBuilderX 的 Node.js 路徑配置

### 問題 2：瀏覽器不自動刷新

**解決方案**：
1. 確認 HBuilderX 的「運行到瀏覽器」功能正常
2. 檢查瀏覽器控制台是否有錯誤
3. 嘗試手動刷新瀏覽器

### 問題 3：修改代碼後沒有更新

**解決方案**：
1. 確認文件已保存（`Ctrl + S`）
2. 檢查 HBuilderX 是否正在運行
3. 查看 HBuilderX 的編譯日誌
4. 嘗試手動觸發編譯：在 HBuilderX 中點擊「運行」按鈕

### 問題 4：端口被占用

**解決方案**：
1. 關閉占用端口的程序
2. 或修改 `vue.config.js` 中的端口號：
   ```javascript
   devServer: {
     port: 8081  // 改為其他端口
   }
   ```

---

## 📝 快速參考

### 快捷鍵

- **HBuilderX 運行到瀏覽器**：`Ctrl + R`
- **Cursor 保存文件**：`Ctrl + S`
- **瀏覽器刷新**：`F5` 或 `Ctrl + R`

### 重要路徑

- **專案目錄**：`C:\Users\lkkab\Desktop\file\old\frontend-uniapp`
- **編譯輸出**：`unpackage/dist/build/web`
- **開發伺服器**：`http://localhost:8080`

### 檢查清單

開發前確認：
- [ ] HBuilderX 已開啟專案
- [ ] Cursor 已開啟同一個專案目錄
- [ ] `node_modules` 已安裝
- [ ] HBuilderX 的「運行到瀏覽器」功能正常
- [ ] 瀏覽器可以正常打開預覽頁面

---

## 🎯 最佳實踐

1. **始終使用「運行到瀏覽器」模式**
   - 支持熱更新，開發效率最高

2. **保持兩個編輯器同步**
   - Cursor 用於編寫代碼
   - HBuilderX 用於運行和預覽

3. **定期檢查編譯日誌**
   - 在 HBuilderX 底部查看編譯日誌
   - 及時發現和解決問題

4. **使用瀏覽器開發者工具**
   - 按 `F12` 打開開發者工具
   - 檢查控制台錯誤
   - 使用 Network 標籤檢查資源載入

---

## 📚 相關文件

- `編譯問題記錄.md` - 編譯問題記錄
- `HBuilderX編譯指南.md` - HBuilderX 編譯指南
- `編譯成功說明.md` - 編譯成功說明
