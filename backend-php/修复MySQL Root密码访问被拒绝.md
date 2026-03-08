# 修复MySQL Root密码访问被拒绝

## 🔍 问题诊断

错误信息：`(1045, "Access denied for user 'root'@'localhost' (using password: YES)")`

这说明：
- ✅ MySQL服务正在运行
- ❌ Root密码不正确或root用户权限有问题

## 🚀 解决方案

### 方法一：在宝塔面板中重置MySQL Root密码（推荐）

1. **登录宝塔面板**
2. **进入"软件商店"**
3. **找到"MySQL"**
4. **点击"设置"按钮**
5. **进入"设置"或"root密码"标签**
6. **点击"修改root密码"或"重置密码"**
7. **设置新密码为**：`123456`
8. **点击"提交"或"保存"**

### 方法二：使用宝塔面板的MySQL管理功能

1. **登录宝塔面板**
2. **进入"数据库"管理**
3. **查看MySQL root密码**（宝塔面板通常会显示）
4. **如果显示的不是123456，使用显示的密码**

### 方法三：使用MySQL安全模式重置密码

如果需要通过命令行重置：

1. **停止MySQL服务**（在宝塔面板中）
2. **使用安全模式启动MySQL**：
   ```bash
   mysqld_safe --skip-grant-tables &
   ```
3. **连接MySQL（无需密码）**：
   ```bash
   mysql -u root
   ```
4. **重置密码**：
   ```sql
   USE mysql;
   UPDATE user SET authentication_string=PASSWORD('123456') WHERE User='root';
   FLUSH PRIVILEGES;
   EXIT;
   ```
5. **重启MySQL服务**（在宝塔面板中）

### 方法四：使用宝塔面板的MySQL命令行

在宝塔面板中：

1. **进入"终端"或"SSH终端"**
2. **执行以下命令**（使用宝塔面板显示的MySQL root密码）：
   ```bash
   mysql -u root -p
   ```
3. **输入MySQL root密码**（可能是宝塔面板显示的密码，不是123456）
4. **如果连接成功，修改密码**：
   ```sql
   ALTER USER 'root'@'localhost' IDENTIFIED BY '123456';
   FLUSH PRIVILEGES;
   EXIT;
   ```

## 🔑 重要说明

### MySQL Root密码 vs 数据库用户密码

- **MySQL Root密码**：用于管理MySQL服务（当前问题所在）
- **数据库用户密码**：`hkex02` 用户的密码是 `cZBYPH2XD4YM3yfX`（项目使用）

**即使root密码有问题，数据库用户 `hkex02` 仍然可以正常连接数据库**（如果密码正确的话）。

## 📋 验证步骤

### 1. 验证MySQL Root密码

在宝塔面板中：

1. **进入"数据库"管理**
2. **查看MySQL root密码**（通常会显示）
3. **使用显示的密码测试连接**

### 2. 验证数据库用户连接

即使root密码有问题，也可以测试数据库用户 `hkex02`：

访问测试文件：
```
http://MXTRX.TOP/test_db.php
```

如果数据库用户密码正确，应该可以连接成功。

### 3. 在phpMyAdmin中测试

1. **进入"数据库"管理**
2. **找到数据库 `hkex02`**
3. **点击"管理"或"phpMyAdmin"**
4. **使用以下信息登录**：
   - **用户名**：`hkex02`
   - **密码**：`cZBYPH2XD4YM3yfX`

如果能够登录，说明数据库用户连接正常，root密码问题不影响项目运行。

## 🎯 优先处理事项

### 如果项目需要正常运行：

**优先检查数据库用户 `hkex02` 的连接**，而不是root密码：

1. **访问**：`http://MXTRX.TOP/test_db.php`
2. **如果连接成功**：说明项目可以正常运行，root密码问题可以稍后处理
3. **如果连接失败**：检查数据库用户 `hkex02` 的密码

### 如果需要管理MySQL：

**需要修复root密码**：

1. 在宝塔面板中重置MySQL root密码
2. 或使用宝塔面板显示的MySQL root密码

## ✅ 检查清单

- [ ] MySQL服务正在运行
- [ ] 在宝塔面板中查看MySQL root密码
- [ ] 测试数据库用户 `hkex02` 连接（优先）
- [ ] 如果项目可以运行，root密码问题可以稍后处理
- [ ] 如果需要管理MySQL，修复root密码

## 🔧 快速测试

### 测试数据库用户连接（不依赖root密码）

访问：
```
http://MXTRX.TOP/test_db.php
```

**如果显示"数据库连接成功"**：
- ✅ 项目可以正常运行
- ✅ root密码问题不影响项目
- ⏳ root密码可以稍后修复

**如果显示"数据库连接失败"**：
- ❌ 需要检查数据库用户 `hkex02` 的密码
- ❌ 可能需要修改数据库用户密码

---

**提示**：如果项目可以正常运行（test_db.php显示连接成功），root密码问题可以稍后处理。优先确保项目可以正常访问。
