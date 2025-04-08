1. 請問網頁連結 `http://p9096.isrcttu.net/index.php?Assignment=HW2&StdNo=ui3a99`，在 index.php 中如何取得連線端傳過來之 Assignment 及 StdNo 的資料？

> 可以透過 `$_GET` 超級全域變數來取得網頁連結中傳遞的參數資料，例如 Assignment 和 StdNo。
> 這些參數是以查詢字串（query string）的形式附加在 URL 後面（例如 ?Assignment=HW2&StdNo=ui3a99），而 `$_GET` 會將這些參數解析為一個關聯陣列。
> 例如:
>
> ```php=
> <?php
>    $assignment = isset($_GET['Assignment']) ? $_GET['Assignment'] : '';
>    $stdNo = isset($_GET['StdNo']) ? $_GET['StdNo'] : '';
> ?>
> ```

2. 若 `$MyNumber` 之內容為 6 個數字的字串，請用 `substr` 函式將變數 `$MyNumber` 的 6 個數字 分別指定到 `$arrNum[0]`, `$arrNum[1]`, …, `$arrNum[5]`中。(6 分)

> ```php=
> <?php
>     $MyNumber = "123456";
>     $arrNum = [];
>
>     for ($i = 0; $i < 6; $i++) {
>         $arrNum[$i] = substr($MyNumber, $i, 1);
>     }
>
>     print_r($arrNum);
> ?>
> ```

3. 在 date 函式的 format string 中，’t’可以取得該月的天數，’w’可以取得所提供日期是星期幾，回應值是星期日為 0、星期一為 1，餘類推。請寫一程式判定程式執行時當月最後一天是星期幾。(8 分)
   提示：如果 `$datestr` 內容是’2020-04-27’
   `Date(‘Y-m-d’)` 可以取得程式執行時的日期，如 2020-04-27
   `strtotime($datestr)` 可以取得 `$datestr` 所提供之日期之時間(time 格式，00:00:00 的時間)
   `date(‘Y-m-d’, $timevalue)` 可以取得 `$timevalue` 的日期格式

> ```php=
> <?php
> // 取得當前日期（格式如 2025-04-06）
> $currentDate = date('Y-m-d');
>
> // 取得當月天數
> $daysInMonth = date('t'); // 't' 返回當月總天數，例如 30 或 31
>
> // 構建當月最後一天的日期（例如 2025-04-30）
> $lastDayOfMonth = date('Y-m') . '-' . $daysInMonth;
>
> // 將最後一天的日期轉為時間戳
> $timeValue = strtotime($lastDayOfMonth);
>
> // 取得當月最後一天是星期幾（0 = 星期日, 1 = 星期一, ..., 6 = 星期六）
> $weekday = date('w', $timeValue);
>
> // 將星期數字轉為中文名稱（可選）
> $weekdayNames = ['星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'];
> $weekdayName = $weekdayNames[$weekday];
>
> // 輸出結果
> echo "今天是: " . $currentDate . "<br>";
> echo "本月有: " . $daysInMonth . " 天<br>";
> echo "本月最後一天是: " . $lastDayOfMonth . "<br>";
> echo "本月最後一天是: " . $weekdayName . " (數字: " . $weekday . ")";
> ?>
> ```

4. 一個簡單的會員申請畫面包含 ID (text), Name (text), password (hidden), gender (radio: M and F)及『送出』按鈕，請用 HTML form 語法寫一個會員申請的畫面，每一列一個項目，並以 css 之 DIV 設定置中，輸入框或選單前面需要提示資料意義。(10%)

> ```php,html=
> <!DOCTYPE html>
> <html lang="zh-TW">
> <head>
>     <meta charset="UTF-8">
>     <title>會員申請</title>
>     <style>
>         /* 置中並設定樣式 */
>         .container {
>             width: 50%; /* 容器寬度 */
>             margin: 0 auto; /* 水平置中 */
>             padding: 20px;
>             text-align: left; /* 內部文字靠左對齊 */
>         }
>         .form-row {
>             margin-bottom: 15px; /* 每行間距 */
>         }
>         label {
>             margin-right: 10px; /* 提示文字與輸入框間距 */
>         }
>         input[type="text"], input[type="password"] {
>             padding: 5px;
>             width: 200px; /* 輸入框寬度 */
>         }
>         input[type="radio"] {
>             margin-right: 5px; /* 單選框與文字間距 */
>         }
>         button {
>             padding: 8px 20px;
>             background-color: #4CAF50;
>             color: white;
>             border: none;
>             cursor: pointer;
>         }
>         button:hover {
>             background-color: #45a049;
>         }
>     </style>
> </head>
> <body>
>     <div class="container">
>         <h2>會員申請</h2>
>         <form action="submit.php" method="post">
>             <!-- ID -->
>             <div class="form-row">
>                 <label for="id">會員 ID:</label>
>                 <input type="text" id="id" name="id" required>
>             </div>
>             <!-- Name -->
>             <div class="form-row">
>                 <label for="name">姓名:</label>
>                 <input type="text" id="name" name="name" required>
>             </div>
>             <!-- Password -->
>             <div class="form-row">
>                 <label for="password">密碼:</label>
>                 <input type="password" id="password" name="password" required>
>             </div>
>             <!-- Gender -->
>             <div class="form-row">
>                 <label>性別:</label>
>                 <input type="radio" id="male" name="gender" value="M" required>
>                 <label for="male">男</label>
>                 <input type="radio" id="female" name="gender" value="F">
>                 <label for="female">女</label>
>             </div>
>             <!-- Submit Button -->
>             <div class="form-row">
>                 <button type="submit">送出</button>
>             </div>
>         </form>
>     </div>
> </body>
> </html>
> ```
