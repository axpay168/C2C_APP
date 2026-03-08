# 海外 C2C 交易平台 - 重構版 (old 專案)

> 基於 hkex-sm.com 源碼作為「需求文檔」和「邏輯參考」的完整重構專案  
> 技術棧：PHP (FastAdmin/ThinkPHP) + uni-app (Vue.js) + MySQL

---

## 📋 專案目標

打造一個**全開源可二開**、**健壯可維護**的海外 C2C（點對點）交易平台，重點對接 **bbank 交易所**，支援多語言、充值提現、OTC 交易等核心功能。

---

## 🏗 功能架構

### 後端 (PHP - FastAdmin/ThinkPHP)

| 模塊 | 說明 | 參考目錄 |
|------|------|----------|
| 用戶模塊 | 註冊/登入/找回密碼/實名認證 | `application/api/controller/User.php` |
| 交易模塊 | 掛單/撮合/成交 | `application/api/` |
| 錢包模塊 | 餘額查詢/充值/提現 | `application/common/` |
| 交易所對接 | bbank API 集成 | `application/common/library/exchange/` |
| 後台管理 | FastAdmin CRUD | `application/admin/` |

### 前端 (uni-app - Vue.js)

| 模塊 | 說明 | 參考目錄 |
|------|------|----------|
| 通用頁面 | 登入/註冊/找回密碼 | `pages/common/` |
| 首頁模塊 | 首頁/交易大廳/買賣 | `pages/index/` |
| 設置模塊 | 個人中心/錢包/提現 | `pages/setting/` |
| 多語言 | 15 種語言支援 | `common/locales/` |

### 數據庫 (MySQL)

| 分類 | 核心表 | 說明 |
|------|--------|------|
| 用戶 | fa_user, fa_user_group | 用戶主表、用戶組 |
| 訂單 | fa_order, fa_dtrecod | 掛單、成交記錄 |
| 資金 | fa_recharge, fa_withdrawal | 充值、提現 |
| 銀行 | fa_bank, fa_wallt | 銀行卡、鏈上地址 |
| 系統 | fa_config, fa_admin | 配置、管理員 |

---

## 📁 目錄結構

```
old/
├── backend-php/           # PHP 後端 (FastAdmin)
│   ├── application/       # 業務邏輯
│   │   ├── admin/         # 後台管理
│   │   ├── api/           # API 接口
│   │   └── common/        # 公共庫、交易所對接
│   ├── addons/            # 插件
│   ├── public/            # 入口、靜態資源、H5
│   └── config/            # 配置
├── frontend-uniapp/       # uni-app 前端
│   ├── pages/             # 頁面
│   ├── components/        # 組件
│   └── common/locales/    # 多語言
├── db/                    # 數據庫腳本
│   └── schema.sql         # 建表 SQL
└── docs/                  # 文檔
```

---

## 🔧 技術棧

| 層 | 技術 |
|----|------|
| 後端 | PHP 7.4+, FastAdmin (ThinkPHP 5), MySQL 5.7+ |
| 前端 | uni-app (Vue 2), uView UI, HBuilderX |
| 數據庫 | MySQL 8.0, 表前綴 `fa_` |
| 部署 | Nginx, PHP-FPM |

---

## 🚀 快速開始

### 前端：靜態獨立運行（不依賴 HBuilderX）

```bash
cd frontend-uniapp
npm install --legacy-peer-deps
npm run start
```

瀏覽器訪問 http://localhost:8082 即可。使用 `static-h5/` 內預置的編譯結果，無需 HBuilderX，適合先靜態測試與完善。詳見 [運行和部署指南](./運行和部署指南.md)。

### 1. 後端啟動

```bash
cd /www/wwwroot/old/backend-php
composer install
# 配置 .env 或 application/database.php
# 執行 public/index.php 或配置 Nginx 指向 public/
```

### 2. 前端開發

```bash
cd /www/wwwroot/old/frontend-uniapp
npm install
npm run dev:h5
# 或使用 HBuilderX 打開項目 → 運行到瀏覽器
```

### 3. 數據庫初始化

```bash
mysql -u root -p < db/schema.sql
```

### 4. H5 編譯部署

- **HBuilderX**（推薦）：發行 → 網站-H5 行動版 → 輸出到 `backend-php/public/h5/`
- **npm**：若專案已配置 `@dcloudio/vue-cli-plugin-uni`，可 `npm run build:h5`
- 詳見 [運行和部署指南](./運行和部署指南.md)、[HBuilderX操作指南](./docs/HBuilderX操作指南.md)

---

## 📊 數據流

```
用戶 → uni-app H5 → PHP API (public/index.php)
                         ↓
                    ThinkPHP Router
                         ↓
              api/controller (User, Order, Balance...)
                         ↓
              common/library (ExchangeGateway, BbankProvider)
                         ↓
                    MySQL (fa_*)
```

---

## 📦 依賴

### 後端
- FastAdmin (ThinkPHP 5.x)
- Composer 依賴見 `composer.json`

### 前端
- uni-app
- Vue 2
- uView UI (可選)

---

## 📄 相關文檔

- [hkex-sm.com 源碼](../../hkex-sm.com/) - 需求與邏輯參考
- [new_h 專案](../../new_h/) - bbank 對接、重構思路
- [source-project-analysis](../../new_h/docs/source-project-analysis.md) - 源碼分析報告

---

## 💎 重構原則

- **重構 > 修復**：以源碼為「產品原型」，編寫乾淨可維護代碼
- **技術棧一致**：後端 PHP、前端 uni-app，保持與原專案對齊
- **bbank 對接**：重點重構交易所 API 模塊，預留 ExchangeGateway 架構

---

*文檔更新：2025-03-07*
