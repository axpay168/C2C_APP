-- ========================================
-- 查詢數據庫中的邀請碼
-- ========================================

-- 查詢所有有邀請碼的用戶
SELECT 
    id AS '用戶ID',
    username AS '用戶名',
    email AS '郵箱',
    mobile AS '手機',
    code AS '邀請碼',
    status AS '狀態',
    FROM_UNIXTIME(createtime) AS '創建時間'
FROM fa_user 
WHERE code IS NOT NULL 
  AND code != '' 
ORDER BY id ASC 
LIMIT 20;

-- ========================================
-- 獲取第一個可用的邀請碼（推薦用於測試）
-- ========================================
SELECT code AS '推薦邀請碼'
FROM fa_user 
WHERE code IS NOT NULL 
  AND code != '' 
  AND status = 'normal'
ORDER BY id ASC 
LIMIT 1;

-- ========================================
-- 如果沒有邀請碼，可以手動創建測試邀請碼
-- ========================================
-- 更新現有用戶的邀請碼（例如：更新 ID 為 1 的用戶）
-- UPDATE fa_user SET code = '123456' WHERE id = 1;

-- 或者插入一個測試用戶（僅用於開發測試）
-- INSERT INTO fa_user (username, password, code, status, createtime) 
-- VALUES ('testuser', '', '123456', 'normal', UNIX_TIMESTAMP());
