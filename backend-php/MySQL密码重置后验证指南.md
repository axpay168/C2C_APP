# MySQL密码重置后验证指南

## ✅ MySQL Root密码已重置

- **MySQL Root密码**：`123456` ✅ 已重置

## 🔍 重要说明

**MySQL Root密码** 和 **数据库用户密码** 是不同的：

- **MySQL Root密码**：`123456`（用于管理MySQL服务）
- **数据库用户密码**：`cZBYPH2XD4YM3yfX`（用于应用程序连接数据库）

项目使用的是数据库用户 `hkex02`，密码是 `cZBYPH2XD4YM3yfX`，这个密码不需要更改。

## 📋 验证步骤

### 第一步：确认MySQL服务已启动

1. **登录宝塔面板**
2. **进入"软件商店"**
3. **找到"MySQL"**
4. **点击"设置" → "服务"**
5. **确认服务状态为"运行中"**

### 第二步：验证数据库用户密码

在宝塔面板中：

1. **进入"数据库"管理**
2. **找到数据库 `hkex02`**
3. **点击"管理"或"phpMyAdmin"**
4. **使用以下信息登录**：
   - **用户名**：`hkex02`
   - **密码**：`cZBYPH2XD4YM3yfX`

如果能够登录，说明数据库用户密码正确。

### 第三步：测试数据库连接

访问测试文件：
```
http://MXTRX.TOP/test_db.php
```

**预期结果**：
- ✅ 数据库连接成功
- ✅ FastAdmin表数量：约48个
- ✅ 管理员账号存在：admin

## 🔧 如果数据库连接仍然失败

### 问题1：MySQL服务未启动

**解决方法**：
1. 在宝塔面板中启动MySQL服务
2. 等待服务完全启动（通常需要几秒钟）
3. 再次测试连接

### 问题2：数据库用户密码错误

如果数据库用户 `hkex02` 的密码不是 `cZBYPH2XD4YM3yfX`，需要：

**方法A：在宝塔面板中修改密码**

1. **进入"数据库"管理**
2. **找到数据库 `hkex02`**
3. **点击"改密"按钮**
4. **设置新密码为**：`cZBYPH2XD4YM3yfX`
5. **点击"提交"**

**方法B：使用MySQL命令行修改**

```sql
-- 使用root登录MySQL（密码：123456）
mysql -u root -p123456

-- 修改用户密码
ALTER USER 'hkex02'@'localhost' IDENTIFIED BY 'cZBYPH2XD4YM3yfX';
FLUSH PRIVILEGES;
EXIT;
```

### 问题3：数据库未创建

如果数据库 `hkex02` 不存在：

1. **在宝塔面板中创建数据库**
2. **数据库名**：`hkex02`
3. **用户名**：`hkex02`
4. **密码**：`cZBYPH2XD4YM3yfX`
5. **导入SQL文件**（参考：`数据库重建指南.md`）

### 问题4：MySQL Socket连接问题

如果使用 `127.0.0.1` 连接失败，可以尝试使用 `localhost` 或 socket 连接。

修改 `application/database.php`：

```php
// 尝试使用 localhost
'hostname' => 'localhost',

// 或使用 socket（需要知道socket路径）
'dsn' => 'mysql:unix_socket=/tmp/mysql.sock;dbname=hkex02',
```

## 📊 当前配置

### 数据库配置（application/database.php）

```php
'database' => 'hkex02',
'username' => 'hkex02',
'password' => 'cZBYPH2XD4YM3yfX',
'hostname' => '127.0.0.1',
'charset'  => 'utf8mb4',
```

### MySQL Root密码

- **密码**：`123456`

### 数据库用户密码

- **用户名**：`hkex02`
- **密码**：`cZBYPH2XD4YM3yfX`

## ✅ 验证检查清单

- [ ] MySQL服务状态为"运行中"
- [ ] 可以使用root密码（123456）登录MySQL
- [ ] 数据库 `hkex02` 已创建
- [ ] 数据库用户 `hkex02` 存在
- [ ] 数据库用户密码为 `cZBYPH2XD4YM3yfX`
- [ ] 可以访问phpMyAdmin
- [ ] 访问 `http://MXTRX.TOP/test_db.php` 显示连接成功

## 🎯 完成标志

当以下条件都满足时，说明配置正确：

1. ✅ MySQL服务运行中
2. ✅ 可以使用root密码（123456）管理MySQL
3. ✅ 访问 `http://MXTRX.TOP/test_db.php` 显示"数据库连接成功"
4. ✅ 可以访问后台登录页面
5. ✅ 可以使用 admin/123456 登录后台

---

**提示**：如果MySQL服务已启动但连接仍然失败，请检查数据库用户密码是否正确。
