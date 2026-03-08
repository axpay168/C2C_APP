#!/bin/bash
# 数据库重建脚本
# 用于重新创建数据库并导入数据

echo "=========================================="
echo "数据库重建脚本"
echo "=========================================="
echo ""

# 颜色定义
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m'

# 数据库配置
DB_NAME="hkex02"
DB_USER="hkex02"
DB_PASS="cZBYPH2XD4YM3yfX"
DB_HOST="127.0.0.1"
DB_PORT="3306"

# SQL文件
SQL_FILE1="数据库前端/hkex_sm_com_20240321_230819.sql"
SQL_FILE2="数据库前端/hkex_sm_com_20240321_231454.sql"

echo -e "${YELLOW}数据库配置信息：${NC}"
echo "  数据库名: $DB_NAME"
echo "  用户名: $DB_USER"
echo "  主机: $DB_HOST:$DB_PORT"
echo ""

# 检查SQL文件
echo -e "${YELLOW}[1/5] 检查SQL文件...${NC}"
if [ ! -f "$SQL_FILE1" ]; then
    echo -e "${RED}✗ SQL文件1不存在: $SQL_FILE1${NC}"
    exit 1
fi
if [ ! -f "$SQL_FILE2" ]; then
    echo -e "${RED}✗ SQL文件2不存在: $SQL_FILE2${NC}"
    exit 1
fi
echo -e "${GREEN}✓ SQL文件检查通过${NC}"
echo ""

# 检查MySQL连接
echo -e "${YELLOW}[2/5] 检查MySQL连接...${NC}"
MYSQL_CMD="mysql -h $DB_HOST -P $DB_PORT -u root -p"

# 尝试连接（需要root密码）
echo "请输入MySQL root密码以创建数据库和用户："
read -s ROOT_PASS

MYSQL_ROOT_CMD="mysql -h $DB_HOST -P $DB_PORT -u root -p$ROOT_PASS"

# 测试root连接
$MYSQL_ROOT_CMD -e "SELECT 1;" 2>/dev/null
if [ $? -ne 0 ]; then
    echo -e "${RED}✗ MySQL root连接失败${NC}"
    echo "请检查MySQL服务是否运行，或root密码是否正确"
    exit 1
fi
echo -e "${GREEN}✓ MySQL连接成功${NC}"
echo ""

# 创建数据库
echo -e "${YELLOW}[3/5] 创建数据库和用户...${NC}"

# 删除现有数据库（如果存在）
echo "删除现有数据库（如果存在）..."
$MYSQL_ROOT_CMD -e "DROP DATABASE IF EXISTS \`$DB_NAME\`;" 2>/dev/null

# 创建数据库
echo "创建数据库 $DB_NAME..."
$MYSQL_ROOT_CMD <<EOF
CREATE DATABASE IF NOT EXISTS \`$DB_NAME\` 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;
EOF

if [ $? -ne 0 ]; then
    echo -e "${RED}✗ 创建数据库失败${NC}"
    exit 1
fi
echo -e "${GREEN}✓ 数据库创建成功${NC}"

# 创建用户并授权
echo "创建用户 $DB_USER..."
$MYSQL_ROOT_CMD <<EOF
DROP USER IF EXISTS '$DB_USER'@'localhost';
CREATE USER '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASS';
GRANT ALL PRIVILEGES ON \`$DB_NAME\`.* TO '$DB_USER'@'localhost';
FLUSH PRIVILEGES;
EOF

if [ $? -ne 0 ]; then
    echo -e "${RED}✗ 创建用户失败${NC}"
    exit 1
fi
echo -e "${GREEN}✓ 用户创建成功${NC}"
echo ""

# 导入SQL文件
echo -e "${YELLOW}[4/5] 导入SQL文件...${NC}"

MYSQL_USER_CMD="mysql -h $DB_HOST -P $DB_PORT -u $DB_USER -p$DB_PASS $DB_NAME"

echo "导入SQL文件1: $SQL_FILE1"
$MYSQL_USER_CMD < "$SQL_FILE1" 2>&1 | grep -v "Warning" | grep -v "Using a password"
if [ ${PIPESTATUS[0]} -eq 0 ]; then
    echo -e "${GREEN}✓ SQL文件1导入成功${NC}"
else
    echo -e "${YELLOW}⚠ SQL文件1导入可能有问题，请检查${NC}"
fi

echo ""
echo "导入SQL文件2: $SQL_FILE2"
$MYSQL_USER_CMD < "$SQL_FILE2" 2>&1 | grep -v "Warning" | grep -v "Using a password"
if [ ${PIPESTATUS[0]} -eq 0 ]; then
    echo -e "${GREEN}✓ SQL文件2导入成功${NC}"
else
    echo -e "${YELLOW}⚠ SQL文件2导入可能有问题，请检查${NC}"
fi
echo ""

# 验证导入结果
echo -e "${YELLOW}[5/5] 验证导入结果...${NC}"
TABLE_COUNT=$($MYSQL_USER_CMD -e "SHOW TABLES;" 2>/dev/null | wc -l)
FA_TABLE_COUNT=$($MYSQL_USER_CMD -e "SHOW TABLES LIKE 'fa_%';" 2>/dev/null | wc -l)

if [ $TABLE_COUNT -gt 1 ]; then
    echo -e "${GREEN}✓ 数据库表数量: $((TABLE_COUNT - 1))${NC}"
    echo -e "${GREEN}✓ FastAdmin表数量: $((FA_TABLE_COUNT - 1))${NC}"
    
    # 检查关键表
    echo ""
    echo "检查关键表："
    $MYSQL_USER_CMD -e "SHOW TABLES LIKE 'fa_%';" 2>/dev/null | grep -E "fa_admin|fa_config|fa_user" && echo -e "${GREEN}✓ 关键表存在${NC}" || echo -e "${YELLOW}⚠ 部分关键表可能缺失${NC}"
else
    echo -e "${RED}✗ 数据库表数量异常${NC}"
fi

echo ""
echo "=========================================="
echo -e "${GREEN}数据库重建完成！${NC}"
echo "=========================================="
echo ""
echo "数据库信息："
echo "  数据库名: $DB_NAME"
echo "  用户名: $DB_USER"
echo "  密码: $DB_PASS"
echo ""
echo "下一步："
echo "  1. 测试数据库连接"
echo "  2. 访问后台: http://MXTRX.TOP/buSRxMqJOo.php/index/login"
echo "  3. 默认账号: admin / 123456"
echo ""
