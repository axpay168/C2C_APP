# 修復後台登錄出現「另存為」下載

## 原因
伪静态規則 `rewrite ^(.*)$ /index.php?s=$1` 會對所有不存在的路徑生效，包括 `buSRxMqJOo.php/index/login`。  
導致請求被錯誤 rewrite，服務器返回的內容被當成下載，出現「另存為 login」。

## 修復
在宝塔 → 網站 → MXTRX.TOP → **伪静态** 中，將規則改為以下內容：

```nginx
location / {
    set $rewrite 1;
    # 若請求已包含 .php，不要 rewrite，交給 PHP 處理
    if ($uri ~ "\.php") {
        set $rewrite 0;
    }
    if (!-e $request_filename) {
        set $rewrite "${rewrite}1";
    }
    if ($rewrite = "11") {
        rewrite ^(.*)$ /index.php?s=$1 last;
    }
}
```

## 說明
- `buSRxMqJOo.php/index/login` 含有 `.php`，不再被 rewrite
- 僅對不存在的靜態路徑進行 rewrite
- 保存後重載 Nginx 使配置生效
