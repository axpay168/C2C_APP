#!/bin/bash
# 数据库导入脚本

echo "=========================================="
echo "数据库导入脚本"
echo "=========================================="
echo ""

# 颜色定义
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m'

# 后端数据库配置
BACKEND_DB="hkex02"
BACKEND_USER="hkex02"
BACKEND_PASS="cZBYPH2XD4YM3yfX"

# 前端数据库配置
FRONTEND_DB="hkex01"
FRONTEND_USER="hkex01"
FRONTEND_PASS="HKECTnm8YhSpArR5"

# SQL文件路径
SQL_FILE1="数据库前端/hkex_sm_com_20240321_230819.sql"
SQL_FILE2="数据库前端/hkex_sm_com_20240321_231454.sql"

echo -e "${YELLOW}分析SQL文件...${NC}"
echo "SQL文件1: $SQL_FILE1"
echo "SQL文件2: $SQL_FILE2"
echo ""

# 检查SQL文件是否存在
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

# 分析SQL文件内容（判断是前端还是后端）
echo -e "${YELLOW}分析SQL文件内容...${NC}"
if grep -q "fa_admin\|fa_config\|fa_auth" "$SQL_FILE1"; then
    echo "SQL文件1包含FastAdmin框架表，属于后端数据库"
    BACKEND_SQL1="$SQL_FILE1"
else
    echo "SQL文件1可能是前端数据库"
    FRONTEND_SQL1="$SQL_FILE1"
fi

if grep -q "fa_admin\|fa_config\|fa_auth" "$SQL_FILE2"; then
    echo "SQL文件2包含FastAdmin框架表，属于后端数据库"
    BACKEND_SQL2="$SQL_FILE2"
else
    echo "SQL文件2可能是前端数据库"
    FRONTEND_SQL2="$SQL_FILE2"
fi

echo ""

# 导入后端数据库
echo -e "${YELLOW}[1/2] 导入后端数据库 (hkex02)...${NC}"

# 尝试使用TCP连接（宝塔环境）
MYSQL_HOST="127.0.0.1"
MYSQL_PORT="3306"

# 测试连接
echo "测试MySQL连接..."
mysql -h "$MYSQL_HOST" -P "$MYSQL_PORT" -u "$BACKEND_USER" -p"$BACKEND_PASS" -e "SELECT 1;" "$BACKEND_DB" 2>&1 | grep -v "Warning" > /dev/null
if [ $? -ne 0 ]; then
    echo "尝试使用默认socket连接..."
    mysql -u "$BACKEND_USER" -p"$BACKEND_PASS" -e "SELECT 1;" "$BACKEND_DB" 2>&1 | grep -v "Warning" > /dev/null
    if [ $? -ne 0 ]; then
        echo -e "${RED}✗ 无法连接到MySQL服务器${NC}"
        echo "请检查："
        echo "  1. MySQL服务是否运行"
        echo "  2. 数据库用户权限是否正确"
        echo "  3. 可以在宝塔面板中手动导入SQL文件"
        exit 1
    fi
    MYSQL_CMD="mysql -u $BACKEND_USER -p$BACKEND_PASS"
else
    MYSQL_CMD="mysql -h $MYSQL_HOST -P $MYSQL_PORT -u $BACKEND_USER -p$BACKEND_PASS"
fi

if [ -n "$BACKEND_SQL1" ]; then
    echo "导入SQL文件1到后端数据库..."
    $MYSQL_CMD "$BACKEND_DB" < "$BACKEND_SQL1" 2>&1 | grep -v "Warning" || echo "文件1导入完成"
fi

if [ -n "$BACKEND_SQL2" ]; then
    echo "导入SQL文件2到后端数据库..."
    $MYSQL_CMD "$BACKEND_DB" < "$BACKEND_SQL2" 2>&1 | grep -v "Warning" || echo "文件2导入完成"
fi

# 如果两个文件都是后端，都导入
if [ -z "$BACKEND_SQL1" ] && [ -z "$BACKEND_SQL2" ]; then
    echo "两个SQL文件都导入到后端数据库..."
    $MYSQL_CMD "$BACKEND_DB" < "$SQL_FILE1" 2>&1 | grep -v "Warning" || echo "文件1导入完成"
    $MYSQL_CMD "$BACKEND_DB" < "$SQL_FILE2" 2>&1 | grep -v "Warning" || echo "文件2导入完成"
fi

echo -e "${GREEN}✓ 后端数据库导入完成${NC}"
echo ""

# 检查表数量
TABLE_COUNT=$($MYSQL_CMD "$BACKEND_DB" -e "SHOW TABLES;" 2>/dev/null | wc -l)
if [ $TABLE_COUNT -gt 0 ]; then
    echo "后端数据库表数量: $((TABLE_COUNT - 1))"
else
    echo -e "${YELLOW}⚠ 无法获取表数量，可能导入失败${NC}"
fi
echo ""

# 导入前端数据库（如果有）
if [ -n "$FRONTEND_SQL1" ] || [ -n "$FRONTEND_SQL2" ]; then
    echo -e "${YELLOW}[2/2] 导入前端数据库 (hkex01)...${NC}"
    if [ -n "$FRONTEND_SQL1" ]; then
        mysql -u "$FRONTEND_USER" -p"$FRONTEND_PASS" "$FRONTEND_DB" < "$FRONTEND_SQL1" 2>&1 | grep -v "Warning" || echo "导入完成"
    fi
    if [ -n "$FRONTEND_SQL2" ]; then
        mysql -u "$FRONTEND_USER" -p"$FRONTEND_PASS" "$FRONTEND_DB" < "$FRONTEND_SQL2" 2>&1 | grep -v "Warning" || echo "导入完成"
    fi
    echo -e "${GREEN}✓ 前端数据库导入完成${NC}"
else
    echo -e "${YELLOW}[2/2] 前端数据库${NC}"
    echo "未发现前端数据库SQL文件，跳过"
fi

echo ""
echo "=========================================="
echo -e "${GREEN}数据库导入完成！${NC}"
echo "=========================================="
echo ""
echo "数据库配置:"
echo "  后端数据库: $BACKEND_DB"
echo "  前端数据库: $FRONTEND_DB"
echo ""
