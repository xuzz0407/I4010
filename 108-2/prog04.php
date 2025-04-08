<?php
// prog4.php - 隨機密碼產生器

// 設定四種不同類型的符號
$uppercase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$lowercase = "abcdefghijklmnopqrstuvwxyz";
$numbers = "0123456789";
$special = "',;/-";

// 合併所有符號為一個字串
$passwordChars = $uppercase . $lowercase . $numbers . $special;
$passwordLen = strlen($passwordChars) - 1;

// 函數：產生符合條件的密碼（至少包含3種不同類型的符號）
function generatePassword($passwordChars, $passwordLen) {
    $types = [false, false, false, false]; // 記錄四種類型符號的使用情況
    $password = "";
    
    // 產生8位密碼
    for ($i = 0; $i < 8; $i++) {
        $index = rand(0, $passwordLen);
        $char = $passwordChars[$index];
        $password .= $char;
        
        // 檢查並標記字元類型
        if (strpos("ABCDEFGHIJKLMNOPQRSTUVWXYZ", $char) !== false) {
            $types[0] = true;
        } elseif (strpos("abcdefghijklmnopqrstuvwxyz", $char) !== false) {
            $types[1] = true;
        } elseif (strpos("0123456789", $char) !== false) {
            $types[2] = true;
        } elseif (strpos("',;/-", $char) !== false) {
            $types[3] = true;
        }
    }
    
    // 計算使用了幾種類型的符號
    $typeCount = array_sum($types);
    
    // 如果少於3種類型，重新產生密碼
    if ($typeCount < 3) {
        return generatePassword($passwordChars, $passwordLen);
    }
    
    return $password;
}

// 計算每種符號類型的數量
function countSymbolTypes($password) {
    $types = [
        'uppercase' => preg_match('/[A-Z]/', $password),
        'lowercase' => preg_match('/[a-z]/', $password),
        'numbers' => preg_match('/[0-9]/', $password),
        'special' => preg_match('/[\',;\/-]/', $password)
    ];
    
    return $types;
}

// 產生密碼
$password = generatePassword($passwordChars, $passwordLen);
$symbolTypes = countSymbolTypes($password);
$symbolCount = array_sum($symbolTypes);
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>安全密碼產生器</title>
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --bg-color: #f8f9fa;
            --text-color: #212529;
            --light-gray: #e9ecef;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            line-height: 1.6;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .container {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            width: 100%;
            max-width: 500px;
            padding: 30px;
            text-align: center;
        }
        
        h1 {
            color: var(--primary-color);
            margin-bottom: 20px;
            font-size: 28px;
        }
        
        .password-container {
            background: linear-gradient(145deg, #e6e6e6, #ffffff);
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.06);
            border-radius: var(--border-radius);
            padding: 20px;
            margin: 25px 0;
            position: relative;
            overflow: hidden;
        }
        
        .password {
            font-family: 'Courier New', monospace;
            font-size: 32px;
            letter-spacing: 4px;
            color: var(--text-color);
            user-select: all;
            position: relative;
            z-index: 2;
        }
        
        button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            padding: 12px 24px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            margin: 10px 0;
            width: 100%;
        }
        
        button:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        button:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        
        .info {
            background-color: var(--light-gray);
            border-radius: var(--border-radius);
            padding: 15px;
            margin-top: 25px;
            font-size: 14px;
            color: #555;
        }
        
        .symbol-types {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
            flex-wrap: wrap;
        }
        
        .symbol-type {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 10px;
            margin: 5px;
            min-width: 100px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            flex: 1;
        }
        
        .symbol-type.active {
            background-color: #d7f5dd;
            border-left: 3px solid #28a745;
        }
        
        .symbol-type.inactive {
            background-color: #f8d7da;
            border-left: 3px solid #dc3545;
            opacity: 0.7;
        }
        
        .symbol-type-label {
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            color: #666;
        }
        
        .symbol-type-icon {
            font-size: 20px;
            margin: 5px 0;
        }
        
        .copy-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: var(--accent-color);
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 3;
        }
        
        .copy-button:hover {
            background-color: var(--primary-color);
        }
        
        .strength-meter {
            margin-top: 20px;
            text-align: left;
        }
        
        .strength-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-size: 14px;
        }
        
        .strength-bar {
            height: 8px;
            background-color: var(--light-gray);
            border-radius: 4px;
            overflow: hidden;
        }
        
        .strength-fill {
            height: 100%;
            background: linear-gradient(90deg, #ff9800, #4caf50);
            border-radius: 4px;
        }
        
        footer {
            margin-top: 20px;
            font-size: 12px;
            color: #888;
        }
        
        @media (max-width: 480px) {
            .container {
                padding: 20px 15px;
            }
            
            .password {
                font-size: 24px;
                letter-spacing: 2px;
            }
            
            .symbol-types {
                flex-direction: column;
            }
            
            .symbol-type {
                margin: 3px 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>安全密碼產生器</h1>
        
        <div class="password-container">
            <div class="password" id="password"><?php echo $password; ?></div>
            <button class="copy-button" onclick="copyPassword()" title="複製密碼">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                    <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                </svg>
            </button>
        </div>
        
        <div class="symbol-types">
            <div class="symbol-type <?php echo $symbolTypes['uppercase'] ? 'active' : 'inactive'; ?>">
                <div class="symbol-type-label">大寫字母</div>
                <div class="symbol-type-icon">Aa</div>
            </div>
            <div class="symbol-type <?php echo $symbolTypes['lowercase'] ? 'active' : 'inactive'; ?>">
                <div class="symbol-type-label">小寫字母</div>
                <div class="symbol-type-icon">aa</div>
            </div>
            <div class="symbol-type <?php echo $symbolTypes['numbers'] ? 'active' : 'inactive'; ?>">
                <div class="symbol-type-label">數字</div>
                <div class="symbol-type-icon">123</div>
            </div>
            <div class="symbol-type <?php echo $symbolTypes['special'] ? 'active' : 'inactive'; ?>">
                <div class="symbol-type-label">特殊符號</div>
                <div class="symbol-type-icon">';,-</div>
            </div>
        </div>
        
        <div class="strength-meter">
            <div class="strength-label">
                <span>密碼強度</span>
                <span>
                    <?php 
                    if ($symbolCount >= 4) echo "極強";
                    else if ($symbolCount == 3) echo "強";
                    else echo "中等";
                    ?>
                </span>
            </div>
            <div class="strength-bar">
                <div class="strength-fill"></div>
                <div class="strength-fill" style="width: <?php echo ($symbolCount / 4) * 100; ?>%;"></div>
        </div>
        
        <form method="post">
            <button type="submit" name="refresh">
                重新產生密碼
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-left: 5px; vertical-align: middle;">
                    <path d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                </svg>
            </button>
        </form>
        
        <div class="info">
            <p>此密碼長度為8位，至少包含大寫字母、小寫字母、數字和特殊符號(',;/-')中的3種。</p>
        </div>
        
        <footer>
            密碼產生器 &copy; <?php echo date('Y'); ?>
        </footer>
    </div>
    
    <script>
        function copyPassword() {
            const password = document.getElementById("password").innerText;
            navigator.clipboard.writeText(password).then(() => {
                alert("密碼已複製到剪貼簿！");
            });
        }
    </script>
</body>
</html>