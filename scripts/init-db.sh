#!/bin/bash
# 數據庫初始化腳本 - 需在伺服器上執行
# 用法: ./init-db.sh [數據庫名] [用戶名] [密碼]
# 範例: ./init-db.sh hkex_old root yourpassword

DB_NAME="${1:-hkex_old}"
DB_USER="${2:-root}"
DB_PASS="${3:-}"

SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
SQL_FILE="$SCRIPT_DIR/../db/schema_full.sql"

if [ ! -f "$SQL_FILE" ]; then
  echo "錯誤: 找不到 $SQL_FILE"
  exit 1
fi

echo "創建數據庫: $DB_NAME"
mysql -u "$DB_USER" ${DB_PASS:+-p"$DB_PASS"} -e "CREATE DATABASE IF NOT EXISTS \`$DB_NAME\` DEFAULT CHARSET utf8mb4;"

echo "導入 SQL..."
mysql -u "$DB_USER" ${DB_PASS:+-p"$DB_PASS"} "$DB_NAME" < "$SQL_FILE"

echo "完成。請修改 backend-php/application/database.php 中的 database 為: $DB_NAME"
