#!/bin/bash
# 项目重启脚本

echo "=========================================="
echo "项目重启脚本"
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

echo -e "${YELLOW}[1/6] 清理运行时缓存...${NC}"
if [ -d "runtime" ]; then
    find runtime -type f -name "*.php" -delete 2>/dev/null
    find runtime -type d -name "cache" -exec rm -rf {} + 2>/dev/null
    echo -e "${GREEN}✓ 缓存清理完成${NC}"
else
    echo -e "${YELLOW}⚠ runtime目录不存在${NC}"
fi
echo ""

echo -e "${YELLOW}[2/6] 检查文件权限...${NC}"
if [ -d "runtime" ]; then
    chmod -R 755 runtime/ 2>/dev/null
    echo -e "${GREEN}✓ runtime权限已设置${NC}"
fi
if [ -d "public/uploads" ]; then
    chmod -R 755 public/uploads/ 2>/dev/null
    echo -e "${GREEN}✓ uploads权限已设置${NC}"
fi
echo ""

echo -e "${YELLOW}[3/6] 检查PHP-FPM服务...${NC}"
# 检测PHP版本
PHP_VERSION=$(php -v | head -1 | grep -oP '\d+\.\d+' | head -1)
if [ -n "$PHP_VERSION" ]; then
    echo "检测到PHP版本: $PHP_VERSION"
    
    # 尝试重启PHP-FPM（根据版本）
    if systemctl is-active --quiet php-fpm-${PHP_VERSION//./} 2>/dev/null; then
        echo "重启PHP-FPM ${PHP_VERSION}..."
        systemctl restart php-fpm-${PHP_VERSION//./} 2>/dev/null && echo -e "${GREEN}✓ PHP-FPM已重启${NC}" || echo -e "${YELLOW}⚠ PHP-FPM重启失败，可能需要手动操作${NC}"
    elif systemctl is-active --quiet php${PHP_VERSION//./}-fpm 2>/dev/null; then
        echo "重启PHP-FPM ${PHP_VERSION}..."
        systemctl restart php${PHP_VERSION//./}-fpm 2>/dev/null && echo -e "${GREEN}✓ PHP-FPM已重启${NC}" || echo -e "${YELLOW}⚠ PHP-FPM重启失败，可能需要手动操作${NC}"
    elif systemctl is-active --quiet php-fpm 2>/dev/null; then
        echo "重启PHP-FPM..."
        systemctl restart php-fpm 2>/dev/null && echo -e "${GREEN}✓ PHP-FPM已重启${NC}" || echo -e "${YELLOW}⚠ PHP-FPM重启失败，可能需要手动操作${NC}"
    else
        echo -e "${YELLOW}⚠ 未检测到PHP-FPM服务，请手动重启${NC}"
    fi
else
    echo -e "${YELLOW}⚠ 无法检测PHP版本${NC}"
fi
echo ""

echo -e "${YELLOW}[4/6] 检查Nginx服务...${NC}"
if systemctl is-active --quiet nginx 2>/dev/null; then
    echo "重启Nginx..."
    systemctl restart nginx 2>/dev/null
    if [ $? -eq 0 ]; then
        echo -e "${GREEN}✓ Nginx已重启${NC}"
    else
        echo -e "${RED}✗ Nginx重启失败${NC}"
        echo "尝试重载配置..."
        nginx -s reload 2>/dev/null && echo -e "${GREEN}✓ Nginx配置已重载${NC}" || echo -e "${RED}✗ Nginx重载失败${NC}"
    fi
elif command -v nginx >/dev/null 2>&1; then
    echo -e "${YELLOW}⚠ Nginx服务未运行或无法通过systemctl管理${NC}"
    echo "尝试重载配置..."
    nginx -s reload 2>/dev/null && echo -e "${GREEN}✓ Nginx配置已重载${NC}" || echo -e "${YELLOW}⚠ 请手动重启Nginx${NC}"
else
    echo -e "${YELLOW}⚠ 未检测到Nginx${NC}"
fi
echo ""

echo -e "${YELLOW}[5/6] 检查Apache服务...${NC}"
if systemctl is-active --quiet apache2 2>/dev/null; then
    echo "重启Apache..."
    systemctl restart apache2 2>/dev/null && echo -e "${GREEN}✓ Apache已重启${NC}" || echo -e "${RED}✗ Apache重启失败${NC}"
elif systemctl is-active --quiet httpd 2>/dev/null; then
    echo "重启Apache..."
    systemctl restart httpd 2>/dev/null && echo -e "${GREEN}✓ Apache已重启${NC}" || echo -e "${RED}✗ Apache重启失败${NC}"
else
    echo -e "${GREEN}✓ Apache未运行（可能使用Nginx）${NC}"
fi
echo ""

echo -e "${YELLOW}[6/6] 检查服务状态...${NC}"
echo "PHP版本:"
php -v | head -1
echo ""
echo "服务状态:"
if systemctl is-active --quiet nginx 2>/dev/null; then
    echo -e "${GREEN}✓ Nginx: 运行中${NC}"
elif command -v nginx >/dev/null 2>&1; then
    echo -e "${YELLOW}⚠ Nginx: 状态未知${NC}"
else
    echo -e "${RED}✗ Nginx: 未安装或未运行${NC}"
fi

if systemctl is-active --quiet apache2 2>/dev/null || systemctl is-active --quiet httpd 2>/dev/null; then
    echo -e "${GREEN}✓ Apache: 运行中${NC}"
else
    echo -e "${GREEN}✓ Apache: 未运行${NC}"
fi

PHP_FPM_STATUS="未检测到"
if systemctl is-active --quiet php-fpm-82 2>/dev/null; then
    PHP_FPM_STATUS="运行中 (8.2)"
elif systemctl is-active --quiet php82-php-fpm 2>/dev/null; then
    PHP_FPM_STATUS="运行中 (8.2)"
elif systemctl is-active --quiet php-fpm 2>/dev/null; then
    PHP_FPM_STATUS="运行中"
fi
echo -e "${GREEN}✓ PHP-FPM: $PHP_FPM_STATUS${NC}"
echo ""

echo "=========================================="
echo -e "${GREEN}项目重启完成！${NC}"
echo "=========================================="
echo ""
echo "项目信息:"
echo "  项目路径: $PROJECT_PATH"
echo "  后台入口: http://MXTRX.TOP/buSRxMqJOo.php/index/login"
echo "  API地址: http://MXTRX.TOP/api"
echo ""
echo "如果服务未正常重启，请在宝塔面板中手动操作："
echo "  1. 进入'软件商店'"
echo "  2. 找到'Nginx'或'Apache' → '设置' → '服务' → '重启'"
echo "  3. 找到'PHP' → '设置' → '服务' → '重启'"
echo ""
