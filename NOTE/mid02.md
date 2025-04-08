1. 請撰寫 prog1.php 網頁程式顯現一個輸入框可讓用戶輸入日期資料(資料格式 yyyy-mm-dd，可以用 HTML5 的 input type date 輸入框以日曆選單選擇日期)以及一個送出按鈕，
   當使用者輸入日期並點選送出之後會顯示該日期之星座，同時繼續等待使用者輸入下一個日期，程式需要能判斷輸入的日期格式是否正確，若有錯誤要提出警告。(15 分)
   {星座資料：白羊座 3.21-4.19、金牛座 4.20-5.20、雙子座 5.21-6.21、巨蟹座 6.22-7.22、獅子座 7.23-8.22、處女座 8.23-9.22、天秤座 9.23-10.23、天蠍座 10.24-11.21、射手座 11.22-12.20、魔羯座 12.21-1.20、水瓶座 1.21-2.19、雙魚座 2.20-3.20}

```php,html=
<?php
// 定義星座判斷函數
function getZodiacSign($date) {
    $month = (int)date('m', strtotime($date)); // 取得月份
    $day = (int)date('d', strtotime($date));   // 取得日期

    if (($month == 3 && $day >= 21) || ($month == 4 && $day <= 19)) return "白羊座";
    elseif (($month == 4 && $day >= 20) || ($month == 5 && $day <= 20)) return "金牛座";
    elseif (($month == 5 && $day >= 21) || ($month == 6 && $day <= 21)) return "雙子座";
    elseif (($month == 6 && $day >= 22) || ($month == 7 && $day <= 22)) return "巨蟹座";
    elseif (($month == 7 && $day >= 23) || ($month == 8 && $day <= 22)) return "獅子座";
    elseif (($month == 8 && $day >= 23) || ($month == 9 && $day <= 22)) return "處女座";
    elseif (($month == 9 && $day >= 23) || ($month == 10 && $day <= 23)) return "天秤座";
    elseif (($month == 10 && $day >= 24) || ($month == 11 && $day <= 21)) return "天蠍座";
    elseif (($month == 11 && $day >= 22) || ($month == 12 && $day <= 20)) return "射手座";
    elseif (($month == 12 && $day >= 21) || ($month == 1 && $day <= 20)) return "魔羯座";
    elseif (($month == 1 && $day >= 21) || ($month == 2 && $day <= 19)) return "水瓶座";
    elseif (($month == 2 && $day >= 20) || ($month == 3 && $day <= 20)) return "雙魚座";
    else return "無法判斷"; // 不應該發生，但作為預防
}

// 處理表單提交
$result = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["userDate"])) {
    $inputDate = $_POST["userDate"];

    // 驗證日期格式 (yyyy-mm-dd)
    if (preg_match("/^\d{4}-\d{2}-\d{2}$/", $inputDate) && strtotime($inputDate)) {
        $result = "輸入日期: " . $inputDate . " 的星座是: " . getZodiacSign($inputDate);
    } else {
        $result = "警告：日期格式錯誤，請輸入正確的日期 (yyyy-mm-dd)！";
    }
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>日期星座查詢</title>
    <style>
        .container {
            width: 50%;
            margin: 50px auto;
            text-align: center;
        }
        input[type="date"] {
            padding: 5px;
            margin-right: 10px;
        }
        button {
            padding: 6px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .result {
            margin-top: 20px;
            color: #333;
        }
        .warning {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>日期星座查詢</h2>
        <form method="post" action="">
            <label for="userDate">請輸入日期:</label>
            <input type="date" id="userDate" name="userDate" required>
            <button type="submit">送出</button>
        </form>

        <?php if ($result): ?>
            <div class="result <?php echo (strpos($result, '警告') !== false) ? 'warning' : ''; ?>">
                <?php echo $result; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
```

2.  ![image](https://hackmd.io/_uploads/Sy4jhVeRke.png)

```php,html=
<?php
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Monte Carlo Area Estimation</title>
</head>
<body>
    <h2>估算紅色四分之一圓面積</h2>

    <?php
    $radius = 10;
    $totalPoints = 10000;
    $insideCircle = 0;

    for ($i = 0; $i < $totalPoints; $i++) {
        $x = mt_rand() / mt_getrandmax() * $radius;
        $y = mt_rand() / mt_getrandmax() * $radius;

        if (($x * $x + $y * $y) <= ($radius * $radius)) {
            $insideCircle++;
        }
    }

    $squareArea = $radius * $radius;
    $estimatedArea = ($insideCircle / $totalPoints) * $squareArea;

    echo "<p>總點數：$totalPoints</p>";
    echo "<p>落在圓內點數：$insideCircle</p>";
    echo "<p>估算紅色區域面積：約 <strong>" . round($estimatedArea, 4) . "</strong></p>";
    ?>

    <form method="post">
        <button type="submit">Refresh</button>
    </form>
</body>
</html>

```

3. 請撰寫 prog3.php 網頁程式，連進去後會顯示一個數字輸入框及一個送出按鈕，數字輸入框可輸入 3~10 的整數，點選送出後會在畫面上輸出該數字個數的階乘，例如輸入 4，則輸出 4! = 24，超出範圍要警示使用者。(15 分)

```php,html=
<?php
// 定義階乘計算函數
function calculateFactorial($n) {
    if ($n == 0 || $n == 1) return 1;
    $result = 1;
    for ($i = 2; $i <= $n; $i++) {
        $result *= $i;
    }
    return $result;
}

// 處理表單提交
$result = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["number"])) {
    $inputNumber = filter_input(INPUT_POST, "number", FILTER_VALIDATE_INT); // 驗證整數

    // 檢查是否為有效整數且在範圍內
    if ($inputNumber === false || $inputNumber < 3 || $inputNumber > 10) {
        $result = "警告：請輸入 3 到 10 之間的整數！";
    } else {
        $factorial = calculateFactorial($inputNumber);
        $result = "$inputNumber! = $factorial";
    }
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>階乘計算</title>
    <style>
        .container {
            width: 50%;
            margin: 50px auto;
            text-align: center;
        }
        input[type="number"] {
            padding: 5px;
            margin-right: 10px;
            width: 100px;
        }
        button {
            padding: 6px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .result {
            margin-top: 20px;
            font-size: 18px;
        }
        .warning {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>階乘計算</h2>
        <form method="post" action="">
            <label for="number">請輸入一個數字 (3-10):</label>
            <input type="number" id="number" name="number" min="3" max="10" required>
            <button type="submit">送出</button>
        </form>

        <?php if ($result): ?>
            <div class="result <?php echo (strpos($result, '警告') !== false) ? 'warning' : ''; ?>">
                <?php echo $result; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
```

4. 請撰寫 prog4.php 網頁程式，產生長度為 8 的密碼，密碼所用的符號包括大寫英文字母、小寫英文字母、數字及(', ; / -')特殊符號等四類符號(可重複出現)。畫面要有
   一個 Refresh 按鈕，每次按 Refresh 會輸出一個密碼。提示：建立一個包含上列所有符號的字串 `$PasswordChars`，利用 rand 函式產生該字串長度減 1 的數字，利用該數字從 `$PasswordChars` 中提出一個符號，跑 8 次迴圈即可串出 8 個符號的密碼。(15 分) {加分項(但期中考總分以 100 分為上限)：如果每次產生的密碼至少包含上述 4 種符號中的 3 種，加 10 分}

```php,html=
<?php
// 每次刷新時重新計算，設置標頭以防止快取
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

// 設置隨機數種子以確保每次刷新時隨機數不同
srand(time());

// 定義四類符號
$upperCase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$lowerCase = "abcdefghijklmnopqrstuvwxyz";
$digits = "0123456789";
$specialChars = ",;/ -";

// 將所有符號合併成一個字串
$PasswordChars = $upperCase . $lowerCase . $digits . $specialChars;
$PasswordCharsLength = strlen($PasswordChars);

// 函數：檢查密碼是否至少包含 3 種不同類型的符號
function hasAtLeastThreeTypes($password) {
    $hasUpper = false;
    $hasLower = false;
    $hasDigit = false;
    $hasSpecial = false;

    for ($i = 0; $i < strlen($password); $i++) {
        $char = $password[$i];
        if (preg_match("/[A-Z]/", $char)) $hasUpper = true;
        elseif (preg_match("/[a-z]/", $char)) $hasLower = true;
        elseif (preg_match("/[0-9]/", $char)) $hasDigit = true;
        elseif (preg_match("/[,;\/ -]/", $char)) $hasSpecial = true;
    }

    // 計算有多少種類型
    $typeCount = ($hasUpper ? 1 : 0) + ($hasLower ? 1 : 0) + ($hasDigit ? 1 : 0) + ($hasSpecial ? 1 : 0);
    return $typeCount >= 3;
}

// 函數：生成密碼
function generatePassword($PasswordChars, $PasswordCharsLength) {
    $password = "";
    // 基本生成：隨機選取 8 個字符
    for ($i = 0; $i < 8; $i++) {
        $randomIndex = rand(0, $PasswordCharsLength - 1);
        $password .= $PasswordChars[$randomIndex];
    }
    return $password;
}

// 生成密碼，直到滿足至少包含 3 種符號類型
$password = "";
do {
    $password = generatePassword($PasswordChars, $PasswordCharsLength);
} while (!hasAtLeastThreeTypes($password));
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>密碼生成器</title>
    <style>
        .container {
            text-align: center;
            margin-top: 50px;
        }
        .password {
            font-size: 24px;
            margin: 20px 0;
            color: #333;
        }
        button {
            padding: 8px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>密碼生成器</h2>
        <p>生成的密碼（長度 8，至少包含 3 種符號類型）:</p>
        <div class="password"><?php echo htmlspecialchars($password); ?></div>
        <button onclick="window.location.reload()">Refresh</button>
    </div>
</body>
</html>
```
