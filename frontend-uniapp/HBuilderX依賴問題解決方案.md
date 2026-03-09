# HBuilderX 編譯依賴問題解決方案

## 問題描述

在 HBuilderX 中發行 H5 時出現以下錯誤：
```
文件查找失敗：'echarts' at main.js:20
文件查找失敗：'ethers' at pages\index\index.vue:25
文件查找失敗：'tronweb' at pages\index\index.vue:524
```

## 根本原因

專案使用了 npm 依賴包（echarts、ethers、tronweb），但 `node_modules` 目錄不存在，導致 HBuilderX 編譯時無法找到這些模組。

## 解決方案（按推薦順序）

### 方案 A：在 HBuilderX 中安裝依賴（最簡單）

1. **開啟 HBuilderX**
2. **開啟專案**：檔案 → 開啟目錄 → 選擇 `frontend-uniapp` 目錄
3. **安裝依賴**：
   - 方法 1：選單 → 工具 → 插件安裝 → npm 安裝
   - 方法 2：在 HBuilderX 底部終端中執行：
     ```bash
     npm install
     ```
4. **等待安裝完成**（可能需要幾分鐘）
5. **重新編譯**：發行 → 網站-H5

### 方案 B：使用修復腳本（自動尋找 npm）

1. **執行腳本**：雙擊 `修復HBuilderX依賴問題.bat`
2. **腳本會自動**：
   - 檢查 `node_modules` 是否存在
   - 尋找系統中的 npm
   - 執行 `npm install`
3. **安裝完成後**：在 HBuilderX 中重新執行「發行 → 網站-H5」

### 方案 C：手動指定 npm 路徑

如果 npm 不在系統 PATH 中，可以手動指定：

1. **找到 Node.js 安裝路徑**（常見位置）：
   - `C:\Program Files\nodejs\`
   - `C:\Program Files (x86)\nodejs\`
   - `%APPDATA%\npm\`
   - `%LOCALAPPDATA%\Programs\nodejs\`

2. **在專案目錄執行**：
   ```cmd
   "C:\Program Files\nodejs\npm.cmd" install
   ```
   （請替換為實際路徑）

3. **或使用 HBuilderX 內建 Node.js**：
   - 檢查：`HBuilderX安裝目錄\plugins\node\node.exe`
   - 如果存在，使用該 Node.js 執行 npm install

### 方案 D：配置 HBuilderX Node.js 路徑

如果 HBuilderX 無法找到 Node.js：

1. **開啟 HBuilderX**
2. **設定**：工具 → 設定 → 執行時設定
3. **配置 Node.js 路徑**：指定 Node.js 安裝目錄
4. **重新啟動 HBuilderX**
5. **執行 npm install**

### 方案 E：使用淘寶鏡像（加速安裝）

如果安裝速度慢或失敗，可以使用國內鏡像：

```cmd
npm install --registry=https://registry.npmmirror.com
```

或在專案根目錄創建 `.npmrc` 文件：
```
registry=https://registry.npmmirror.com
```

## 驗證安裝

安裝完成後，檢查以下目錄是否存在：
- `frontend-uniapp/node_modules/echarts/`
- `frontend-uniapp/node_modules/ethers/`
- `frontend-uniapp/node_modules/tronweb/`

## 如果仍然失敗

### 替代方案：使用已編譯版本

專案中包含 `static-h5/` 目錄，為已編譯好的 H5 靜態檔：
- 可直接部署，無需編譯
- 位置：`frontend-uniapp/static-h5/`
- 部署：複製到 `../backend-php/public/h5/` 即可

### 檢查清單

- [ ] Node.js 已安裝
- [ ] npm 可以執行（在終端輸入 `npm -v` 測試）
- [ ] 專案目錄中有 `package.json`
- [ ] 已執行 `npm install`
- [ ] `node_modules` 目錄存在
- [ ] HBuilderX 已重新載入專案

## 相關文件

- `編譯問題記錄.md` - 其他編譯問題記錄
- `HBuilderX編譯指南.md` - HBuilderX 編譯完整指南
- `修復HBuilderX依賴問題.bat` - 自動修復腳本
