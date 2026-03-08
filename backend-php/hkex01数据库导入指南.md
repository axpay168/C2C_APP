# hkex01 前端数据库导入指南

## 📋 SQL文件分析

### 文件信息对比

| 文件 | 大小 | 修改时间 | MD5 | 说明 |
|------|------|----------|-----|------|
| `hkex_sm_com_20240321_230819.sql` | 1.1M | 2024-03-05 15:33 | ae1ad401... | 第一个SQL文件 |
| `hkex_sm_com_20240321_231454.sql` | 1.1M | 2024-03-05 15:25 | ccb1e43b... | 第二个SQL文件 |

### 文件内容

两个SQL文件都包含：
- ✅ FastAdmin框架核心表（fa_admin, fa_config等）
- ✅ 业务功能表（fa_user, fa_order等）
- ✅ 48个数据表
- ⚠️ 数据内容可能不同（MD5不同）

## 🎯 hkex01 前端数据库导入建议

### 重要说明

**uni-app前端通常不需要独立数据库**，因为：
- 前端通过HTTP API调用后端接口
- 所有数据操作由后端FastAdmin处理
- 前端只负责展示和用户交互

### 如果前端确实需要数据库

如果您的项目架构中前端需要独立数据库，建议：

**导入第一个SQL文件**：
- 文件：`数据库前端/hkex_sm_com_20240321_230819.sql`
- 时间：2024-03-05 15:33（较新）
- 建议：作为前端数据库的基础数据

## 📝 导入步骤

### 在宝塔面板中导入

1. **登录宝塔面板**
2. **进入"数据库"管理**
3. **找到数据库 `hkex01`**
4. **点击右侧的"导入"按钮**
5. **选择文件**：`数据库前端/hkex_sm_com_20240321_230819.sql`
6. **点击"开始导入"**
7. **等待导入完成**

### 使用命令行导入（SSH权限）

```bash
cd /www/wwwroot/hkex-sm.com
mysql -u hkex01 -p'HKECTnm8YhSpArR5' hkex01 < "数据库前端/hkex_sm_com_20240321_230819.sql"
```

## ✅ 验证导入

导入完成后，在phpMyAdmin中检查：

```sql
-- 查看表列表
SHOW TABLES LIKE 'fa_%';

-- 检查表数量
SELECT COUNT(*) FROM information_schema.tables 
WHERE table_schema = 'hkex01' 
AND table_name LIKE 'fa_%';

-- 检查管理员账号
SELECT * FROM fa_admin WHERE username='admin';
```

## ⚠️ 注意事项

1. **前端数据库通常不需要**
   - uni-app前端通过API调用后端
   - 如果不需要，可以不导入

2. **如果导入**
   - 建议导入第一个SQL文件（较新）
   - 两个文件内容相似但数据可能不同

3. **数据库配置**
   - 前端uni-app通过API调用后端
   - 不需要直接连接数据库
   - API地址已配置为：`http://MXTRX.TOP/api`

## 📊 数据库分配总结

### hkex02（后端数据库）- 必须导入
- ✅ 导入两个SQL文件
- ✅ FastAdmin后端使用
- ✅ 配置文件：`application/database.php`

### hkex01（前端数据库）- 可选导入
- ⚠️ 通常不需要导入
- ⚠️ 如需导入：选择第一个SQL文件
- ⚠️ `hkex_sm_com_20240321_230819.sql`

---

**建议**：先只导入后端数据库（hkex02），测试系统运行。如果前端确实需要独立数据库，再导入前端数据库（hkex01）。
