#!/bin/bash
# 测试数据库连接脚本

echo "=========================================="
echo "数据库连接测试"
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

echo -e "${YELLOW}测试数据库连接...${NC}"
echo "数据库: $DB_NAME"
echo "用户: $DB_USER"
echo "主机: $DB_HOST"
echo ""

# 测试连接
php -r "
try {
    \$pdo = new PDO('mysql:host=$DB_HOST;dbname=$DB_NAME', '$DB_USER', '$DB_PASS');
    \$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo '${GREEN}✓ 数据库连接成功${NC}\n';
    
    // 检查表数量
    \$stmt = \$pdo->query('SHOW TABLES LIKE \"fa_%\"');
    \$tables = \$stmt->fetchAll(PDO::FETCH_COLUMN);
    echo '${GREEN}✓ FastAdmin表数量: ' . count(\$tables) . '${NC}\n';
    
    // 检查管理员账号
    \$stmt = \$pdo->query('SELECT id, username, nickname, status FROM fa_admin WHERE username=\"admin\"');
    \$admin = \$stmt->fetch(PDO::FETCH_ASSOC);
    if (\$admin) {
        echo '${GREEN}✓ 管理员账号: ' . \$admin['username'] . ' / ' . \$admin['nickname'] . ' (状态: ' . \$admin['status'] . ')${NC}\n';
    } else {
        echo '${YELLOW}⚠ 管理员账号不存在${NC}\n';
    }
    
    // 检查配置表
    \$stmt = \$pdo->query('SELECT COUNT(*) as cnt FROM fa_config');
    \$config = \$stmt->fetch(PDO::FETCH_ASSOC);
    echo '${GREEN}✓ 配置表记录数: ' . \$config['cnt'] . '${NC}\n';
    
} catch(Exception \$e) {
    echo '${RED}✗ 数据库连接失败${NC}\n';
    echo '错误信息: ' . \$e->getMessage() . '\n';
    echo '\n可能的原因：\n';
    echo '  1. MySQL服务未运行\n';
    echo '  2. 数据库未创建\n';
    echo '  3. 数据库用户或密码错误\n';
    echo '  4. MySQL socket连接问题\n';
    echo '\n解决方法：\n';
    echo '  1. 在宝塔面板中启动MySQL服务\n';
    echo '  2. 确认数据库 hkex02 已创建\n';
    echo '  3. 确认数据库用户 hkex02 密码为 cZBYPH2XD4YM3yfX\n';
    echo '  4. 检查 application/database.php 配置\n';
}
"

echo ""
echo "=========================================="
echo "测试完成"
echo "=========================================="
echo ""
echo "如果连接成功，可以访问："
echo "  测试页面: http://MXTRX.TOP/test_db.php"
echo "  后台登录: http://MXTRX.TOP/buSRxMqJOo.php/index/login"
echo ""
