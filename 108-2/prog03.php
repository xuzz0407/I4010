<?php
// 檢查是否有表單提交
$factorial = "";
$input_number = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 取得輸入值
    $input_number = isset($_POST["number"]) ? $_POST["number"] : "";
    
    // 驗證輸入
    if (!is_numeric($input_number)) {
        $error_message = "請輸入數字！";
    } else if ($input_number < 3 || $input_number > 10) {
        $error_message = "請輸入 3 到 10 之間的整數！";
    } else {
        // 計算階乘
        $number = intval($input_number);
        $result = 1;
        for ($i = 1; $i <= $number; $i++) {
            $result *= $i;
        }
        $factorial = $number . "! = " . $result;
    }
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>階乘計算器</title>
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #f72585;
            --background-color: #f8f9fa;
            --card-color: #ffffff;
            --text-color: #333333;
            --error-color: #e63946;
            --success-color: #2a9d8f;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background-color: var(--background-color);
            background-image: radial-gradient(#4361ee20 1px, transparent 1px);
            background-size: 20px 20px;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: var(--text-color);
        }
        
        .app-container {
            width: 90%;
            max-width: 500px;
            padding: 30px;
        }
        
        .app-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        h1 {
            color: var(--primary-color);
            font-size: 2.4rem;
            margin: 0;
            padding: 0;
            font-weight: 700;
        }
        
        .app-subtitle {
            color: var(--text-color);
            font-size: 1rem;
            opacity: 0.8;
            margin-top: 5px;
        }
        
        .card {
            background-color: var(--card-color);
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            padding: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: var(--text-color);
            font-size: 1rem;
        }
        
        input[type="number"] {
            width: 100%;
            padding: 12px 15px;
            font-size: 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            box-sizing: border-box;
            background-color: #f9f9f9;
        }
        
        input[type="number"]:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }
        
        button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 25px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        button:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        button:active {
            transform: translateY(0);
        }
        
        .result {
            margin-top: 25px;
            text-align: center;
            padding: 15px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.2rem;
            animation: fadeIn 0.6s ease-in-out;
            background-color: #f0f5ff;
            border-left: 4px solid var(--primary-color);
        }
        
        .error {
            background-color: #ffeaee;
            border-left: 4px solid var(--error-color);
            color: var(--error-color);
        }
        
        .factorial-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            display: block;
            margin-top: 5px;
        }
        
        .range-info {
            font-size: 0.85rem;
            color: #666;
            margin-top: 8px;
            font-style: italic;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @media (max-width: 480px) {
            .app-container {
                padding: 15px;
            }
            
            h1 {
                font-size: 1.8rem;
            }
            
            .card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="app-container">
        <div class="app-header">
            <h1>階乘計算器</h1>
            <div class="app-subtitle">輸入數字，獲得階乘結果</div>
        </div>
        
        <div class="card">
            <form method="post">
                <div class="form-group">
                    <label for="number">請輸入整數：</label>
                    <input type="number" id="number" name="number" value="<?php echo htmlspecialchars($input_number); ?>" step="1" min="3" max="10" placeholder="請輸入3-10之間的整數" required>
                    <div class="range-info">有效範圍：3 至 10</div>
                </div>
                
                <button type="submit">計算階乘</button>
            </form>
            
            <?php if (!empty($error_message)): ?>
            <div class="result error">
                <?php echo $error_message; ?>
            </div>
            <?php endif; ?>
            
            <?php if (!empty($factorial)): ?>
            <div class="result">
                <span>計算結果</span>
                <span class="factorial-value"><?php echo $factorial; ?></span>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>