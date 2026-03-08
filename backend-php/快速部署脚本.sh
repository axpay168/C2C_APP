#!/bin/bash
# FastAdmin + uni-app 快速部署脚本
# 域名: MXTRX.TOP

echo "=========================================="
echo "FastAdmin + uni-app 部署脚本"
echo "=========================================="
echo ""

# 颜色定义
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# 1. 检查PHP版本
echo -e "${YELLOW}[1/6] 检查PHP环境...${NC}"
PHP_VERSION=$(php -r 'echo PHP_VERSION;')
echo "PHP版本: $PHP_VERSION"
if php -r 'exit(version_compare(PHP_VERSION, "7.2.0", ">=") ? 0 : 1);'; then
    echo -e "${GREEN}✓ PHP版本满足要求${NC}"
else
    echo -e "${RED}✗ PHP版本过低，需要 >= 7.2.0${NC}"
    exit 1
fi

# 2. 检查必需扩展
echo -e "${YELLOW}[2/6] 检查PHP扩展...${NC}"
REQUIRED_EXTENSIONS=("pdo_mysql" "curl" "json" "bcmath")
MISSING_EXTENSIONS=()
for ext in "${REQUIRED_EXTENSIONS[@]}"; do
    if php -m | grep -q "^$ext$"; then
        echo -e "${GREEN}✓ $ext 已安装${NC}"
    else
        echo -e "${RED}✗ $ext 未安装${NC}"
        MISSING_EXTENSIONS+=("$ext")
    fi
done

if [ ${#MISSING_EXTENSIONS[@]} -gt 0 ]; then
    echo -e "${RED}缺少必需扩展: ${MISSING_EXTENSIONS[*]}${NC}"
    exit 1
fi

# 3. 设置文件权限
echo -e "${YELLOW}[3/6] 设置文件权限...${NC}"
if [ -d "runtime" ]; then
    chmod -R 755 runtime/ 2>/dev/null
    echo -e "${GREEN}✓ runtime目录权限已设置${NC}"
fi

if [ -d "public/uploads" ]; then
    chmod -R 755 public/uploads/ 2>/dev/null
    echo -e "${GREEN}✓ public/uploads目录权限已设置${NC}"
fi

# 4. 检查Composer依赖
echo -e "${YELLOW}[4/6] 检查Composer依赖...${NC}"
if [ -d "vendor" ]; then
    echo -e "${GREEN}✓ vendor目录存在${NC}"
    if [ ! -f "composer.lock" ]; then
        echo -e "${YELLOW}⚠ composer.lock不存在，建议运行: composer install${NC}"
    fi
else
    echo -e "${YELLOW}⚠ vendor目录不存在，运行: composer install${NC}"
    read -p "是否现在安装依赖? (y/n): " -n 1 -r
    echo
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        composer install --no-dev
    fi
fi

# 5. 检查数据库连接
echo -e "${YELLOW}[5/6] 检查数据库连接...${NC}"
DB_HOST="127.0.0.1"
DB_NAME="hkex_sm_com"
DB_USER="hkex_sm_com"
DB_PASS="6cGHKTh8wsA3beze"

php -r "
try {
    \$pdo = new PDO('mysql:host=$DB_HOST;dbname=$DB_NAME', '$DB_USER', '$DB_PASS');
    echo '${GREEN}✓ 数据库连接成功${NC}\n';
} catch(Exception \$e) {
    echo '${RED}✗ 数据库连接失败: ' . \$e->getMessage() . '${NC}\n';
    echo '${YELLOW}请检查:${NC}\n';
    echo '  1. MySQL服务是否运行\n';
    echo '  2. 数据库是否已创建\n';
    echo '  3. 数据库用户权限是否正确\n';
    exit(1);
}
"

# 6. 检查安装锁
echo -e "${YELLOW}[6/6] 检查安装状态...${NC}"
if [ -f "application/admin/command/Install/install.lock" ]; then
    echo -e "${GREEN}✓ 安装锁文件存在，系统已安装${NC}"
else
    echo -e "${YELLOW}⚠ 安装锁文件不存在，需要访问安装页面${NC}"
    echo "访问: http://MXTRX.TOP/install.php"
fi

echo ""
echo "=========================================="
echo -e "${GREEN}部署检查完成！${NC}"
echo "=========================================="
echo ""
echo "下一步操作:"
echo "1. 确保MySQL服务运行并导入数据库"
echo "2. 配置Web服务器（Nginx/Apache）"
echo "3. 测试访问:"
echo "   - 后台: http://MXTRX.TOP/buSRxMqJOo.php/index/login"
echo "   - API: http://MXTRX.TOP/api/index/index"
echo "   - 前端: http://MXTRX.TOP/h5/"
echo ""
