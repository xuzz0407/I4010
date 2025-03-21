<?php
    // 檢查 session 是否已啟動，若未啟動則啟動
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // 初始化或獲取迴圈計數
    if (!isset($_SESSION['loopCount'])) {
        $_SESSION['loopCount'] = 10000;
        $_SESSION['last_pi'] = 0; // 初始化 last_pi
    }

    function CalculatePi($loopCount) {
        $pi = 0;
        for ($i = 0; $i < $loopCount; $i++) {
            $pi += pow(-1, $i) / (2 * $i + 1);
        }
        return $pi * 4;
    }

    // 僅在需要時計算 Pi（表單提交或首次載入）
    $loopCount = $_SESSION['loopCount'];
    $pre_Pi = isset($_SESSION['last_pi']) ? $_SESSION['last_pi'] : 0;
    if (!isset($_SESSION['last_pi']) || $_SERVER['REQUEST_METHOD'] == 'POST') {
        $cur_Pi = CalculatePi($loopCount);
        $_SESSION['last_pi'] = $cur_Pi;
    } else {
        $cur_Pi = $_SESSION['last_pi'];
    }
    $diff = abs($cur_Pi - M_PI);
    $accuracy = (1 - ($diff / M_PI)) * 100;

    // 處理表單提交
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['reset'])) {
            $_SESSION['loopCount'] = 10000;
        } else {
            $_SESSION['loopCount'] += rand(5000, 15000);
        }
        // 重定向以防止表單重複提交
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>計算 圓周率</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400;500;700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;500&display=swap');
    
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
    
    .result {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 30px;
        text-align: center;
    }
    
    .pi-container {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 25px;
        box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.05);
    }
    
    .pi-value {
        font-family: 'Roboto Mono', monospace;
        font-size: 2em;
        font-weight: 500;
        color: #e74c3c;
        margin: 15px 0;
        letter-spacing: 1px;
    }
    
    .accuracy-container {
        display: flex;
        justify-content: space-between;
        margin: 25px 0;
    }
    
    .accuracy-box {
        flex: 1;
        padding: 15px;
        border-radius: 8px;
        margin: 0 10px;
    }
    
    .accuracy-actual {
        background-color: #e8f8f5;
        border-left: 5px solid #1abc9c;
    }
    
    .accuracy-diff {
        background-color: #f9ebea;
        border-left: 5px solid #e74c3c;
    }
    
    .accuracy-percent {
        background-color: #ebf5fb;
        border-left: 5px solid #3498db;
    }
    
    .accuracy-label {
        font-size: 1.1em;
        margin-bottom: 8px;
        color: #7f8c8d;
    }
    
    .accuracy-value {
        font-family: 'Roboto Mono', monospace;
        font-size: 1.3em;
        font-weight: 500;
    }
    
    .loop-count {
        background-color: #eaecee;
        color: #2c3e50;
        padding: 10px 20px;
        border-radius: 30px;
        display: inline-block;
        margin: 15px 0;
        font-weight: 500;
    }
    
    .buttons-container {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 25px;
    }
    
    button {
        padding: 12px 25px;
        border-radius: 6px;
        border: none;
        font-size: 1em;
        font-family: inherit;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .calculate-button {
        background: linear-gradient(135deg, #3498db, #2980b9);
        color: white;
    }
    
    .calculate-button:hover {
        background: linear-gradient(135deg, #2980b9, #3498db);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    
    .reset-button {
        background: linear-gradient(135deg, #e74c3c, #c0392b);
        color: white;
    }
    
    .reset-button:hover {
        background: linear-gradient(135deg, #c0392b, #e74c3c);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    
    .home-button {
        background: linear-gradient(135deg, #95a5a6, #7f8c8d);
        color: white;
    }
    
    .home-button:hover {
        background: linear-gradient(135deg, #7f8c8d, #95a5a6);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    </style>
</head>
<body>
    <h1>計算 圓周率 (π)</h1>

    <div class="result">
        <div class="pi-container">
            <div class="pi-value"><?php echo number_format($cur_Pi, 13); ?></div>
        </div>
        
        <div class="accuracy-container">
            <div class="accuracy-box accuracy-actual">
                <div class="accuracy-label">實際值</div>
                <div class="accuracy-value"><?php echo number_format(M_PI, 13); ?></div>
            </div>
            
            <div class="accuracy-box accuracy-diff">
                <div class="accuracy-label">誤差</div>
                <div class="accuracy-value"><?php echo number_format($diff, 13); ?></div>
            </div>
            
            <div class="accuracy-box accuracy-percent">
                <div class="accuracy-label">準確度</div>
                <div class="accuracy-value"><?php echo number_format($accuracy, 10); ?>%</div>
            </div>
        </div>
        
        <div class="loop-count">迭代次數: <?php echo number_format($loopCount); ?></div>
    </div>

    <div class="buttons-container">
        <form method="POST">
            <button type="submit" class="calculate-button">增加迭代次數</button>
        </form>
        
        <form method="POST">
            <button type="submit" name="reset" class="reset-button">重設</button>
        </form>
        
        <form action="index.php" method="GET">
            <button type="submit" class="home-button">回首頁</button>
        </form>
    </div>
</body>
</html>