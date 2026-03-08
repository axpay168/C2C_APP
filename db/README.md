# 數據庫初始化

## 核心表說明 (fa_ 前綴)

| 表名 | 說明 |
|------|------|
| fa_user | 用戶主表 |
| fa_user_money_log | 資金流水 |
| fa_order | 掛單/訂單 |
| fa_dtrecod | 成交記錄 |
| fa_recharge | 充值申請 |
| fa_withdrawal | 提現申請 |
| fa_bank | 銀行卡 |
| fa_config | 系統配置 |
| fa_admin | 管理員 |

## 初始化步驟

```bash
# 1. 創建數據庫
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS hkex_old DEFAULT CHARSET utf8mb4;"

# 2. 導入表結構與數據
# 完整數據（結構+數據）：
mysql -u root -p old < old_full.sql
# 僅結構：
mysql -u root -p old < schema_full.sql

# 3. 修改 backend-php/application/database.php 中的數據庫名、用戶、密碼
```

## 配置 backend-php

編輯 `application/database.php`:

```php
'database' => 'hkex_old',
'username' => 'root',
'password' => '您的密碼',
'prefix'   => 'fa_',
```
