# PHP Session

- http 是一個無狀態的協定
  - 每次連線都是獨立的，彼此之間無關連
- 使用 Session 可以串聯前後連線
- Session 和 cookie 類似，但 Session 資料是存放在伺服器端， cookie 是放在瀏覽器中，較不安全且易被修改

## 啟動 session

- 必須在還沒有任何輸出之前設定

```html,php=
<?php
    session_start();
?>
<html>
    <body>
        網頁內容
    </body>
</html>
```

## 設定 Session 變數

```php=
<?php
    session_start();
    $_SESSION['LoginID']='Admin';
?>
```

## 取得 session 變數內容

```php=
<?php
    session_start();
    echo $_SESSION['LoginID'];
?>
```

> 輸出為 'Admin'

## 刪除 Session

- 刪除 **單一** session 變數
  - `unset($_SESSION['LoginID']);`
- 刪除 **全部** session 變數
  - `session_destroy();`
  - `session_unset();`

## 輸出全部的 session 變數內容

- `print_r ($_SESSION);`
- `var_dump ($_SESSION);`

## 常用 session 函式

- `session_start` ：啟用一個新的或開啟正在使用中的 session 。
- `session_destroy` ：清除正在使用中的 session 。
- `session_name` ：取得正在使用中的名稱或將名稱更新為新的名稱。
- `session_module_name` ：取得或更新正在使用中的模組。
- `session_save_path` ：存取目前使用中的 session 路徑。
- `session_id` ：存取目前使用中的 id 。
- `session_decode` ：資料解碼，解碼成功回傳 true 。
- `session_encode` ：資料編碼，編碼成功回傳 true 。

## 範例：程式一

```php,html=
<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <body>
        <?php
            // Set session variables
            $_SESSION["favcolor"] = "green";
            $_SESSION["favanimal"] = "cat";
            echo "Session variables are set.";
        ?>
    </body>
</html>
```

## 範例：程式二

```php,html=
<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <body>
        <?php
            echo "Favorite color is " . $_SESSION["favcolor"] . ".<br>";
            echo "Favorite animal is " . $_SESSION["favanimal"] . ".";
        ?>
    </body>
</html>
```
