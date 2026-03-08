#!/bin/bash
# 项目启动脚本

echo "=========================================="
echo "项目启动检查脚本"
echo "=========================================="
echo ""

# 颜色定义
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m'

# 项目路径
PROJECT_PATH="/www/wwwroot/hkex-sm.com"

cd "$PROJECT_PATH" || exit 1

# 检查结果统计
CHECKS_PASSED=0
CHECKS_FAILED=0
WARNINGS=0

echo -e "${YELLOW}[1/8] 检查项目文件...${NC}"
if [ -f "public/buSRxMqJOo.php" ]; then
    echo -e "${GREEN}✓ 后台入口文件存在${NC}"
    ((CHECKS_PASSED++))
else
    echo -e "${RED}✗ 后台入口文件不存在${NC}"
    ((CHECKS_FAILED++))
fi

if [ -f "public/index.php" ]; then
    echo -e "${GREEN}✓ 前台入口文件存在${NC}"
    ((CHECKS_PASSED++))
else
    echo -e "${YELLOW}⚠ 前台入口文件不存在${NC}"
    ((WARNINGS++))
fi

if [ -f "application/database.php" ]; then
    echo -e "${GREEN}✓ 数据库配置文件存在${NC}"
    ((CHECKS_PASSED++))
else
    echo -e "${RED}✗ 数据库配置文件不存在${NC}"
    ((CHECKS_FAILED++))
fi
echo ""

echo -e "${YELLOW}[2/8] 检查目录权限...${NC}"
if [ -d "runtime" ]; then
    if [ -w "runtime" ]; then
        echo -e "${GREEN}✓ runtime目录可写${NC}"
        chmod -R 755 runtime/ 2>/dev/null
        ((CHECKS_PASSED++))
    else
        echo -e "${RED}✗ runtime目录不可写${NC}"
        ((CHECKS_FAILED++))
    fi
else
    echo -e "${YELLOW}⚠ runtime目录不存在，正在创建...${NC}"
    mkdir -p runtime/{cache,temp,log} 2>/dev/null
    chmod -R 755 runtime/ 2>/dev/null
    ((WARNINGS++))
fi

if [ -d "public/uploads" ]; then
    if [ -w "public/uploads" ]; then
        echo -e "${GREEN}✓ uploads目录可写${NC}"
        chmod -R 755 public/uploads/ 2>/dev/null
        ((CHECKS_PASSED++))
    else
        echo -e "${YELLOW}⚠ uploads目录不可写，尝试修复...${NC}"
        chmod -R 755 public/uploads/ 2>/dev/null
        ((WARNINGS++))
    fi
else
    echo -e "${YELLOW}⚠ uploads目录不存在，正在创建...${NC}"
    mkdir -p public/uploads 2>/dev/null
    chmod -R 755 public/uploads/ 2>/dev/null
    ((WARNINGS++))
fi
echo ""

echo -e "${YELLOW}[3/8] 检查PHP环境...${NC}"
PHP_VERSION=$(php -v | head -1)
if [ -n "$PHP_VERSION" ]; then
    echo -e "${GREEN}✓ $PHP_VERSION${NC}"
    ((CHECKS_PASSED++))
    
    # 检查必需的PHP扩展
    echo "检查PHP扩展..."
    REQUIRED_EXTENSIONS=("pdo_mysql" "curl" "json" "mbstring" "openssl")
    for ext in "${REQUIRED_EXTENSIONS[@]}"; do
        if php -m | grep -q "^${ext}$"; then
            echo -e "${GREEN}  ✓ $ext${NC}"
        else
            echo -e "${RED}  ✗ $ext (缺失)${NC}"
            ((CHECKS_FAILED++))
        fi
    done
else
    echo -e "${RED}✗ PHP未安装或无法访问${NC}"
    ((CHECKS_FAILED++))
fi
echo ""

echo -e "${YELLOW}[4/8] 检查PHP-FPM服务...${NC}"
PHP_FPM_RUNNING=false
if systemctl is-active --quiet php-fpm-82 2>/dev/null; then
    echo -e "${GREEN}✓ PHP-FPM 8.2 正在运行${NC}"
    PHP_FPM_RUNNING=true
    ((CHECKS_PASSED++))
elif systemctl is-active --quiet php82-php-fpm 2>/dev/null; then
    echo -e "${GREEN}✓ PHP-FPM 8.2 正在运行${NC}"
    PHP_FPM_RUNNING=true
    ((CHECKS_PASSED++))
elif systemctl is-active --quiet php-fpm 2>/dev/null; then
    echo -e "${GREEN}✓ PHP-FPM 正在运行${NC}"
    PHP_FPM_RUNNING=true
    ((CHECKS_PASSED++))
else
    echo -e "${YELLOW}⚠ PHP-FPM服务状态未知（可能由宝塔面板管理）${NC}"
    echo "  请在宝塔面板中检查：软件商店 → PHP 8.2 → 设置 → 服务"
    ((WARNINGS++))
fi
echo ""

echo -e "${YELLOW}[5/8] 检查Web服务器...${NC}"
NGINX_RUNNING=false
APACHE_RUNNING=false

if systemctl is-active --quiet nginx 2>/dev/null; then
    echo -e "${GREEN}✓ Nginx 正在运行${NC}"
    NGINX_RUNNING=true
    ((CHECKS_PASSED++))
elif command -v nginx >/dev/null 2>&1; then
    if pgrep -x nginx >/dev/null; then
        echo -e "${GREEN}✓ Nginx 进程正在运行${NC}"
        NGINX_RUNNING=true
        ((CHECKS_PASSED++))
    else
        echo -e "${YELLOW}⚠ Nginx 未运行（可能由宝塔面板管理）${NC}"
        echo "  请在宝塔面板中启动：软件商店 → Nginx → 设置 → 服务 → 启动"
        ((WARNINGS++))
    fi
else
    echo -e "${YELLOW}⚠ Nginx 未检测到${NC}"
    ((WARNINGS++))
fi

if systemctl is-active --quiet apache2 2>/dev/null || systemctl is-active --quiet httpd 2>/dev/null; then
    echo -e "${GREEN}✓ Apache 正在运行${NC}"
    APACHE_RUNNING=true
    ((CHECKS_PASSED++))
else
    echo -e "${GREEN}✓ Apache 未运行（正常，如果使用Nginx）${NC}"
fi
echo ""

echo -e "${YELLOW}[6/8] 检查MySQL数据库连接...${NC}"
# 读取数据库配置
DB_CONFIG="application/database.php"
if [ -f "$DB_CONFIG" ]; then
    DB_NAME=$(grep -oP "'database'\s*=>\s*Env::get\('database.database',\s*'\\K[^']+" "$DB_CONFIG" 2>/dev/null | head -1)
    DB_USER=$(grep -oP "'username'\s*=>\s*Env::get\('database.username',\s*'\\K[^']+" "$DB_CONFIG" 2>/dev/null | head -1)
    DB_PASS=$(grep -oP "'password'\s*=>\s*Env::get\('database.password',\s*'\\K[^']+" "$DB_CONFIG" 2>/dev/null | head -1)
    
    if [ -n "$DB_NAME" ] && [ -n "$DB_USER" ] && [ -n "$DB_PASS" ]; then
        echo "数据库配置: $DB_NAME / $DB_USER"
        # 尝试连接数据库
        php -r "try { \$pdo = new PDO('mysql:host=127.0.0.1;dbname=$DB_NAME', '$DB_USER', '$DB_PASS'); echo 'success'; } catch(Exception \$e) { echo 'failed'; }" 2>/dev/null | grep -q "success"
        if [ $? -eq 0 ]; then
            echo -e "${GREEN}✓ 数据库连接成功${NC}"
            ((CHECKS_PASSED++))
        else
            echo -e "${RED}✗ 数据库连接失败${NC}"
            echo "  请检查："
            echo "    1. MySQL服务是否运行"
            echo "    2. 数据库是否已创建"
            echo "    3. 数据库用户和密码是否正确"
            ((CHECKS_FAILED++))
        fi
    else
        echo -e "${YELLOW}⚠ 无法读取数据库配置${NC}"
        ((WARNINGS++))
    fi
else
    echo -e "${RED}✗ 数据库配置文件不存在${NC}"
    ((CHECKS_FAILED++))
fi
echo ""

echo -e "${YELLOW}[7/8] 检查安装锁文件...${NC}"
if [ -f "application/admin/command/Install/install.lock" ]; then
    echo -e "${GREEN}✓ 安装锁文件存在（系统已安装）${NC}"
    ((CHECKS_PASSED++))
else
    echo -e "${YELLOW}⚠ 安装锁文件不存在${NC}"
    echo "  如果这是首次安装，请访问安装页面"
    ((WARNINGS++))
fi
echo ""

echo -e "${YELLOW}[8/8] 清理缓存...${NC}"
if [ -d "runtime/cache" ]; then
    find runtime/cache -type f -delete 2>/dev/null
    echo -e "${GREEN}✓ 缓存已清理${NC}"
    ((CHECKS_PASSED++))
fi
if [ -d "runtime/temp" ]; then
    find runtime/temp -type f -delete 2>/dev/null
    echo -e "${GREEN}✓ 临时文件已清理${NC}"
    ((CHECKS_PASSED++))
fi
echo ""

echo "=========================================="
echo "检查结果汇总"
echo "=========================================="
echo -e "${GREEN}通过: $CHECKS_PASSED${NC}"
echo -e "${RED}失败: $CHECKS_FAILED${NC}"
echo -e "${YELLOW}警告: $WARNINGS${NC}"
echo ""

if [ $CHECKS_FAILED -eq 0 ]; then
    echo -e "${GREEN}✓ 项目启动检查完成！${NC}"
    echo ""
    echo "项目访问地址："
    echo "  后台管理: http://MXTRX.TOP/buSRxMqJOo.php/index/login"
    echo "  API接口: http://MXTRX.TOP/api/index/index"
    echo "  前台入口: http://MXTRX.TOP/"
    echo ""
    if [ $WARNINGS -gt 0 ]; then
        echo -e "${YELLOW}⚠ 有 $WARNINGS 个警告，请查看上方详细信息${NC}"
    fi
else
    echo -e "${RED}✗ 发现 $CHECKS_FAILED 个错误，请修复后重试${NC}"
    echo ""
    echo "常见问题解决："
    echo "  1. 数据库连接失败 → 检查MySQL服务和数据库配置"
    echo "  2. PHP-FPM未运行 → 在宝塔面板中启动PHP-FPM服务"
    echo "  3. Nginx未运行 → 在宝塔面板中启动Nginx服务"
    echo "  4. 文件权限问题 → 检查runtime和uploads目录权限"
fi
echo ""
