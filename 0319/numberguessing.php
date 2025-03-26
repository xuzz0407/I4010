<?php
    session_start();

    // 生成不重複的4位數隨機數字
    function generateRandomNumber($previousTarget = null) {
        do {
            // Create an array of digits 0-9
            $digits = range(0, 9);
            
            // Shuffle the digits randomly
            shuffle($digits);
            
            // Take the first 4 digits and ensure the first digit is not zero
            if ($digits[0] == 0) {
                // Swap first non-zero digit with the zero
                for ($i = 1; $i < 4; $i++) {
                    if ($digits[$i] != 0) {
                        $temp = $digits[0];
                        $digits[0] = $digits[$i];
                        $digits[$i] = $temp;
                        break;
                    }
                }
            }
            
            // Convert first 4 digits to a number
            $newTarget = implode('', array_slice($digits, 0, 4));
        } while ($newTarget === $previousTarget);
        
        return $newTarget;
    }

    // 如果按下重新開始按鈕，重置遊戲
    if (isset($_POST['restart'])) {
        unset($_SESSION['target']);
        unset($_SESSION['guesses']);
        $message = "遊戲已重設，請猜一個4位數字！";
        $messageClass = "info";
    }

    // 如果目標數字未設定或需要更換，初始化目標數字
    if (!isset($_SESSION['target'])) {
        $_SESSION['target'] = generateRandomNumber();
    }

    // 如果猜測記錄未設定，初始化猜測記錄陣列
    if (!isset($_SESSION['guesses'])) {
        $_SESSION['guesses'] = array();
    }

    // 計算A和B的函數
    function calculateAB($guess, $target) {
        // 確保 $guess 和 $target 都有4位數字
        $guess = str_pad($guess, 4, '0', STR_PAD_LEFT);
        $target = str_pad($target, 4, '0', STR_PAD_LEFT);

        // 初始化計數器
        $A = 0;
        $B = 0;

        // 建立輔助陣列來追蹤是否已計算
        $guessChecked = [false, false, false, false];
        $targetChecked = [false, false, false, false];

        // 先計算完全正確的位置 (A)
        for ($i = 0; $i < 4; $i++) {
            if ($guess[$i] === $target[$i]) {
                $A++;
                $guessChecked[$i] = true;
                $targetChecked[$i] = true;
            }
        }

        // 再計算數字正確但位置不對的 (B)
        for ($i = 0; $i < 4; $i++) {
            // 如果這個位置已經被A計算過，跳過
            if ($guessChecked[$i]) continue;

            for ($j = 0; $j < 4; $j++) {
                // 確保位置不同，且目標數字位置未被使用，且數字相同
                if ($i != $j && 
                    !$targetChecked[$j] && 
                    !$guessChecked[$i] && 
                    $guess[$i] === $target[$j]) {
                    $B++;
                    $guessChecked[$i] = true;
                    $targetChecked[$j] = true;
                    break;
                }
            }
        }

        return ['A' => $A, 'B' => $B];
    }

    // 處理猜測提交
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['restart'])) {
        $guess = isset($_POST['guess']) ? trim($_POST['guess']) : '';
        
        // 驗證猜測
        if (strlen($guess) != 4 || !ctype_digit($guess)) {
            $message = "請輸入4位數字！";
            $messageClass = "warning";
        } else if (in_array($guess, $_SESSION['guesses'])) {
            $message = "這個數字已經猜過了！請再試一個不同的數字。";
            $messageClass = "warning";
        } else {
            $_SESSION['guesses'][] = $guess;

            $result = calculateAB($guess, $_SESSION['target']);
            
            if ($result['A'] == 4) {
                $message = "恭喜猜對了！答案就是 " . $_SESSION['target'] . "！";
                $messageClass = "success";
                
                // 生成新的目標數字
                $_SESSION['target'] = generateRandomNumber($_SESSION['target']);
                // 重置猜測記錄
                $_SESSION['guesses'] = array();
            } else {
                $message = $guess . " -> " . $result['A'] . "A" . $result['B'] . "B";
                $messageClass = "info";
            }
        }
    } else if (!isset($message)) {
        $message = "請猜一個4位數字！";
        $messageClass = "info";
    }
    
    $attempts = count($_SESSION['guesses']);
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4位數字猜謎遊戲</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400;500;700&display=swap');
    
    body {
        font-family: 'Noto Sans TC', 'Microsoft JhengHei', Arial, sans-serif;
        font-size: 16px;
        line-height: 1.6;
        color: #333;
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f0f5f9;
    }
    
    h1 {
        color: #1a5276;
        text-align: center;
        margin-bottom: 30px;
        font-size: 2.5em;
        position: relative;
        padding-bottom: 15px;
    }
    
    h1:after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 3px;
        background-color: #3498db;
    }
    
    form {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 25px;
        text-align: center;
    }
    
    input, button {
        padding: 12px 20px;
        margin: 10px 5px;
        border-radius: 6px;
        border: 1px solid #e0e0e0;
        font-size: 1em;
        font-family: inherit;
        transition: all 0.3s ease;
    }
    
    input {
        width: 200px;
        text-align: center;
        font-size: 1.2em;
        letter-spacing: 10px;
    }
    
    input:focus {
        border-color: #3498db;
        box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
        outline: none;
    }
    
    button {
        background: linear-gradient(135deg, #3498db, #2980b9);
        color: white;
        border: none;
        cursor: pointer;
        font-weight: bold;
        padding: 12px 25px;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    
    button:hover {
        background: linear-gradient(135deg, #2980b9, #3498db);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    
    .message {
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        margin: 20px 0;
        font-size: 1.3em;
        font-weight: 500;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }
    
    .message.info {
        background-color: #e8f4f8;
        color: #154360;
        border-left: 5px solid #3498db;
    }
    
    .message.success {
        background-color: #d4efdf;
        color: #145a32;
        border-left: 5px solid #2ecc71;
    }
    
    .message.warning {
        background-color: #fdebd0;
        color: #9c640c;
        border-left: 5px solid #f39c12;
    }
    
    .buttons-container {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 25px;
    }
    
    .guesses {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 25px;
    }
    
    .guesses h3 {
        text-align: center;
        color: #2c3e50;
        margin-top: 0;
    }
    
    .status {
        text-align: center;
        margin-bottom: 20px;
    }
    
    .attempt-counter {
        background-color: #34495e;
        color: white;
        padding: 10px 20px;
        border-radius: 30px;
        display: inline-block;
        font-weight: bold;
        margin-bottom: 15px;
    }
    
    .target-number {
        background-color: #f39c12;
        color: white;
        padding: 10px 20px;
        border-radius: 30px;
        display: inline-block;
        font-weight: bold;
        margin-bottom: 15px;
    }
    
    .guesses ul {
        list-style-type: none;
        padding: 0;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
    }
    
    .guesses li {
        padding: 10px 15px;
        background-color: #f7f9fa;
        border-radius: 30px;
        display: inline-block;
        min-width: 80px;
        text-align: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        border: 1px solid #e0e0e0;
    }
    
    .home-button {
        background: linear-gradient(135deg, #95a5a6, #7f8c8d);
    }
    
    .home-button:hover {
        background: linear-gradient(135deg, #7f8c8d, #95a5a6);
    }
    
    .restart-button {
        background: linear-gradient(135deg, #e74c3c, #c0392b);
    }
    
    .restart-button:hover {
        background: linear-gradient(135deg, #c0392b, #e74c3c);
    }
    </style>
</head>
<body>
    <h1>4位數字猜謎遊戲</h1>

    <div class="message <?php echo $messageClass; ?>">
        <?php echo $message; ?>
    </div>

    <form method="POST">
        <input type="text" name="guess" pattern="\d{4}" maxlength="4" required placeholder="請輸入4位數字" autofocus>
        <button type="submit">猜一猜</button>
    </form>

    <div class="guesses">
        <div class="status">
            <?php if ($attempts > 0): ?>
                <div class="target-number">目標數字: <?php echo $_SESSION['target']; ?></div>
                <div class="attempt-counter">已猜次數: <?php echo $attempts; ?></div>
                <h3>猜過的數字:</h3>
                <ul>
                    <?php foreach ($_SESSION['guesses'] as $g): 
                        $result = calculateAB($g, $_SESSION['target']);
                    ?>
                        <li><?php echo $g . " -> " . $result['A'] . "A" . $result['B'] . "B"; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <div class="target-number">目標數字: <?php echo $_SESSION['target']; ?></div>
                <h3>開始猜4位數字吧！</h3>
            <?php endif; ?>
        </div>
        
        <div class="buttons-container">
            <form action="" method="POST">
                <button type="submit" name="restart" class="restart-button">重新開始</button>
            </form>
            
            <form action="index.php" method="GET">
                <button type="submit" class="home-button">回首頁</button>
            </form>
        </div>
    </div>
</body>
</html>

