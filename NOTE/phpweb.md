# PHP 網頁程式結構

## 認證

- 一般以 `SESSION` 變數作為認證用

```php=
if (exist($_SESSION['LoginID'])&&!empty($_SESSION['LoginID']))
authorized
else
not authorized
// not authorized 時通常都是先顯示錯誤訊息，並等待一段時間 (2~5 秒 )
後再重新顯示登入畫面
```

> 此 SESSION 變數可有兩個定義途徑
>
> - 由 index.php 或 login.php 等程式針對使用者所輸入的 ID 與 Password 來驗證
> - 由另一個系統透過資料庫或是其他機制，將已通過認證的使用者資料寫入共用資料庫，並以一個 key 來傳遞該筆資料的索引，本系統再透過所收到的 key 來取得使用者資料

---

## 變數處理

- **順序**
  - $\_GET -> $\_POST -> $\_COOKIE -> $\_SESSION -> $\_SERVER
- 如果由網頁所傳遞過來的變數少，可直接用 `$_GET['var_name']` 或`$_POST['var_name']` 來取得
- 如果較多，則可用下列方式取得:

```php=
if (isset($_POST) && count($_POST)) {
    extract($_POST, EXTR_OVERWRITE);
}
else {
    // In case of mixed GET and POST, we may have both GET
    // and POST variables. Only $_POST variable is extracted.
    if (isset($_GET) && count($_GET)) {
        extract($_GET, EXTR_OVERWRITE);
    }
}
if (isset($_SESSION) && count($_SESSION))
    extract($_SESSION, EXTR_OVERWRITE);
```

---

## 授權

- 一般是透過使用者 ID ，從授權資料庫或是授權伺服器取得用戶授權

```php=
$sqlcmd = "SELECT privilege FROM userpriv WHERE loginid='$LoginID'";
$rs = querydb($sqlcmd, $db_conn);
if (count($rs) < 0) die(" 您無權限 ");
$UserPriv = $rs[0]['privilege'];
if ($UserPriv >= '3' && isset($DelUser) && !empty($DelUser)) {
    $sqlcmd = "UPDATE user SET valid='N' WHERE seqno='$DelUser'";
    $result = updatedb($sqlcmd, $db_conn);
}
```

---

## 資料處理

- 授權後，即可進行資料處理
- 先確認資料已傳過來，並符合所設定資料規則，如是否為空字串，是否為純數字，是否為合法之 email 帳號

```php=
if (isset($Confirm)) { // 確認按鈕
    if (!isset($Name) || empty($Name))
        $ErrMsg = ' 姓名不可為空白 \n';n';
    if (!isset($Phone) || empty($Phone))
        $ErrMsg = ' 電話不可為空白 \n';n';
    if (empty($ErrMsg)) { // 資料經初步檢核沒問題
        $Name = addslashes(htmlspecialchars($Name));
        $Phone = addslashes(htmlspecialchars($Phone));
        $sqlcmd="UPDATE namelist SET name='$Name', phone=". "'$Phone' WHERE cid='$cid'";
        $result = updatedb($sqlcmd, $db_conn);
        header("Location: contactlist.php");
    }
}
```

---

## 資料顯示

- 資料顯示前，應重新自資料庫中讀取欲顯示的資料，否則剛剛存入或更新過的資料不會顯示出來

---

## PHP 關聯陣列的操作 (Operations on Associative Array)

### 參考資源

- **PHP 陣列參考**：
  - [W3Schools PHP Array Reference](https://www.w3schools.com/php/php_ref_array.asp)

### 遍歷關聯陣列 (Loop Through an Associative Array)

#### 使用 `foreach` 遍歷

- **語法**：
  - `foreach ($array as $key => $value)`：用於遍歷關聯陣列，其中 `$key` 是鍵，`$value` 是值。
- **範例**：
  ```php
  $age = array("Peter" => "35", "Ben" => "37", "Joe" => "43");
  foreach ($age as $Name => $Age) {
      echo $Name . "'s age is " . $Age . ".<br />";
  }
  ```
- **輸出**：
  - Peter’s age is 35.
  - Ben’s age is 37.
  - Joe’s age is 43.

### 從關聯陣列提取值 (Extract Values from Associative Array)

- 使用 `extract()` 函數
  - 功能：
    - 將數組中的鍵值對導入到當前符號表中，鍵作為變數名，值作為變數值。
  - 語法：
    - `extract(array &$array, int $flags = EXTR_OVERWRITE, string $prefix = NULL)`
  - 警告：
    - 不要在不受信任的數據（例如用戶輸入，如 `$_GET`、`$_FILES`）上使用 `extract()`，以避免安全風險。
  - 適用性：
    - 適合關聯數組；對於索引數組，除非使用 `EXTR_PREFIX_ALL` 或`EXTR_PREFIX_INVALID`，否則無法有效提取。
- `extract()` 的標誌 (Flags)
  - 標誌列表：
    - `EXTR_OVERWRITE`
      - 如果有衝突，覆蓋現有變數。
    - `EXTR_SKIP`
      - 如果有衝突，不覆蓋現有變數。
    - `EXTR_PREFIX_SAME`
      - 如果有衝突，為變數名添加前綴。
    - `EXTR_PREFIX_ALL`
      - 為所有變數名添加前綴。
    - `EXTR_PREFIX_INVALID`
      - 僅為無效或數字變數名添加前綴。
    - `EXTR_IF_EXISTS`
      - 僅在當前符號表中已存在該變數時覆蓋，否則不處理（適用於從 `$_REQUEST` 中提取已定義變數）。
    - `EXTR_PREFIX_IF_EXISTS`
      - 僅在當前符號表中存在非前綴版本的變數時創建前綴變數名。
    - 預設
      - 如果未指定標誌，假設為 `EXTR_OVERWRITE`。
