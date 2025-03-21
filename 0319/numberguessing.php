<?php
    session_start();

    // 如果按下重新開始按鈕，重置遊戲
    if (isset($_POST['restart'])) {
        unset($_SESSION['target']);
        unset($_SESSION['guesses']);
        $message = "遊戲已重設，請猜一個數字！";
        $messageClass = "info";
    }

    // 如果目標數字未設定，初始化目標數字
    if (!isset($_SESSION['target'])) {
        $_SESSION['target'] = rand(1, 100);
    }

    // 如果猜測記錄未設定，初始化猜測記錄陣列
    if (!isset($_SESSION['guesses'])) {
        $_SESSION['guesses'] = array();
    }

    // 處理猜測提交
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['restart'])) {
        $guess = isset($_POST['guess']) ? (int)$_POST['guess'] : 0;
        
        // 驗證猜測
        if ($guess < 1 || $guess > 100) {
            $message = "請輸入1到100之間的數字！";
            $messageClass = "warning";
        } else {
            $_SESSION['guesses'][] = $guess;

            if ($guess == $_SESSION['target']) {
                $message = "恭喜猜對了！答案就是 " . $_SESSION['target'] . "！";
                $messageClass = "success";
                // 不立即重置，讓用戶看到他們贏了
            } else if ($guess < $_SESSION['target']) {
                $message = "你猜太低了！";
                $messageClass = "low";
            } else {
                $message = "你猜太高了！";
                $messageClass = "high";
            }
        }
    } else if (!isset($message)) {
        $message = "請猜一個1到100之間的數字！";
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
    <title>猜數字遊戲</title>
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
        width: 150px;
        text-align: center;
        font-size: 1.2em;
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
    
    .message.low {
        background-color: #ebf5fb;
        color: #21618c;
        border-left: 5px solid #3498db;
    }
    
    .message.high {
        background-color: #fdedec;
        color: #922b21;
        border-left: 5px solid #e74c3c;
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
    
    .target-number {
        background-color: #e8f8f5;
        color: #145a32;
        padding: 10px 20px;
        border-radius: 30px;
        display: inline-block;
        font-weight: bold;
        margin-bottom: 15px;
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
        min-width: 40px;
        text-align: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        border: 1px solid #e0e0e0;
    }
    
    .guesses li.too-low {
        background-color: #d6eaf8;
        border-color: #3498db;
    }
    
    .guesses li.too-high {
        background-color: #f9ebea;
        border-color: #e74c3c;
    }
    
    .buttons-container {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 25px;
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
    <h1>猜數字遊戲</h1>

    <div class="message <?php echo $messageClass; ?>">
        <?php echo $message; ?>
    </div>

    <form method="POST">
        <input type="number" name="guess" min="1" max="100" required placeholder="請輸入1-100之間的數字" autofocus>
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
                        $class = '';
                        if ($_SESSION['target'] > $g) {
                            $class = 'too-low';
                        } else if ($_SESSION['target'] < $g) {
                            $class = 'too-high';
                        }
                    ?>
                        <li class="<?php echo $class; ?>"><?php echo $g; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <div class="target-number">目標數字: <?php echo $_SESSION['target']; ?></div>
                <h3>開始猜數字吧！</h3>
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