#!/bin/bash
# 快速修复404错误脚本

echo "=========================================="
echo "404错误快速修复检查"
echo "=========================================="
echo ""

# 颜色定义
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m'

# 检查文件是否存在
echo -e "${YELLOW}[1/4] 检查文件...${NC}"
if [ -f "public/buSRxMqJOo.php" ]; then
    echo -e "${GREEN}✓ 后台入口文件存在: public/buSRxMqJOo.php${NC}"
else
    echo -e "${RED}✗ 后台入口文件不存在${NC}"
    exit 1
fi

if [ -f "public/index.php" ]; then
    echo -e "${GREEN}✓ 前台入口文件存在: public/index.php${NC}"
else
    echo -e "${RED}✗ 前台入口文件不存在${NC}"
fi
echo ""

# 检查目录结构
echo -e "${YELLOW}[2/4] 检查目录结构...${NC}"
echo "项目根目录: $(pwd)"
echo "public目录: $(pwd)/public"
echo "文件列表:"
ls -la public/ | grep -E "\.php$|index\.html" | head -5
echo ""

# 检查Nginx配置（如果可访问）
echo -e "${YELLOW}[3/4] 检查Nginx配置位置...${NC}"
if [ -d "/www/server/panel/vhost/nginx" ]; then
    echo "Nginx配置文件目录: /www/server/panel/vhost/nginx"
    echo "配置文件列表:"
    ls -la /www/server/panel/vhost/nginx/*.conf 2>/dev/null | tail -3 || echo "无法列出配置文件"
else
    echo -e "${YELLOW}⚠ 未找到Nginx配置目录${NC}"
fi
echo ""

# 提供修复建议
echo -e "${YELLOW}[4/4] 修复建议...${NC}"
echo ""
echo "=========================================="
echo -e "${GREEN}检查完成！${NC}"
echo "=========================================="
echo ""
echo -e "${YELLOW}⚠ 404错误通常由以下原因造成：${NC}"
echo ""
echo "1. 网站根目录配置错误"
echo "   ❌ 错误: /www/wwwroot/hkex-sm.com/"
echo "   ✅ 正确: /www/wwwroot/hkex-sm.com/public"
echo ""
echo "2. Nginx配置文件中root指令错误"
echo "   需要在Nginx配置文件中设置:"
echo "   root /www/wwwroot/hkex-sm.com/public;"
echo ""
echo "3. PHP-FPM配置问题"
echo "   需要确认fastcgi_pass路径正确"
echo ""
echo "=========================================="
echo "修复步骤（在宝塔面板中）："
echo "=========================================="
echo ""
echo "1. 登录宝塔面板"
echo "2. 进入 '网站' → 找到 MXTRX.TOP → '设置'"
echo "3. 在 '网站目录' 标签中："
echo "   - 网站目录: /www/wwwroot/hkex-sm.com/public"
echo "   - 运行目录: /public 或留空"
echo "4. 在 '配置文件' 标签中检查："
echo "   - root /www/wwwroot/hkex-sm.com/public;"
echo "   - location ~ \.php$ 配置正确"
echo "5. 点击 '保存' 并 '重载配置'"
echo "6. 重启网站或Nginx服务"
echo ""
echo "详细说明请查看: 修复404错误指南.md"
echo ""
