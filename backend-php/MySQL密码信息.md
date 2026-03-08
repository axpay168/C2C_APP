# MySQL密码信息

## 🔑 MySQL Root密码

- **密码**：`Aa1998122300 `（注意：末尾有一个空格）

## 📋 数据库用户信息

- **数据库名**：`hkex02`
- **用户名**：`hkex02`
- **密码**：`cZBYPH2XD4YM3yfX`

## 🔧 使用MySQL Root密码

### 命令行连接MySQL

```bash
mysql -u root -p'Aa1998122300 ' -h 127.0.0.1
```

### 修改数据库用户密码（如果需要）

```sql
ALTER USER 'hkex02'@'localhost' IDENTIFIED BY 'cZBYPH2XD4YM3yfX';
FLUSH PRIVILEGES;
```

### 创建数据库用户（如果不存在）

```sql
CREATE USER 'hkex02'@'localhost' IDENTIFIED BY 'cZBYPH2XD4YM3yfX';
GRANT ALL PRIVILEGES ON `hkex02`.* TO 'hkex02'@'localhost';
FLUSH PRIVILEGES;
```

## ✅ 验证步骤

### 1. 测试Root连接

```bash
mysql -u root -p'Aa1998122300 ' -h 127.0.0.1 -e "SELECT 1;"
```

### 2. 测试数据库用户连接

访问：
```
http://MXTRX.TOP/test_db.php
```

或使用命令行：
```bash
php -r "try { \$pdo = new PDO('mysql:host=127.0.0.1;dbname=hkex02', 'hkex02', 'cZBYPH2XD4YM3yfX'); echo '连接成功'; } catch(Exception \$e) { echo '连接失败: ' . \$e->getMessage(); }"
```

## 📝 注意事项

1. **Root密码末尾有空格**：`Aa1998122300 `（注意空格）
2. **数据库用户密码**：`cZBYPH2XD4YM3yfX`（没有空格）
3. **项目使用数据库用户**：`hkex02`，不是root用户

## 🎯 项目配置

项目配置文件 `application/database.php` 使用：
- **数据库名**：`hkex02`
- **用户名**：`hkex02`
- **密码**：`cZBYPH2XD4YM3yfX`
- **主机**：`127.0.0.1`

---

**提示**：Root密码用于管理MySQL服务，项目使用数据库用户hkex02连接数据库。
