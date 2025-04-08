<?php
// 初始化變數
$date = "";
$zodiac = "";
$error = "";
$zodiacInfo = "";
$zodiacImage = "";

// 檢查是否有提交表單
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 獲取表單提交的日期
    $date = $_POST["date"];
    
    // 檢查日期格式是否正確
    if (empty($date)) {
        $error = "請輸入日期";
    } else {
        // 檢查日期格式是否為yyyy-mm-dd
        if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date)) {
            $error = "日期格式不正確，請使用YYYY-MM-DD格式";
        } else {
            // 將日期轉換為月份和日期
            $dateObj = DateTime::createFromFormat('Y-m-d', $date);
            if ($dateObj === false) {
                $error = "無效的日期";
            } else {
                $month = (int)$dateObj->format('m');
                $day = (int)$dateObj->format('d');
                
                // 判斷星座
                switch ($month) {
                    case 1: // 一月
                        $zodiac = ($day <= 20) ? "魔羯座" : "水瓶座";
                        break;
                    case 2: // 二月
                        $zodiac = ($day <= 19) ? "水瓶座" : "雙魚座";
                        break;
                    case 3: // 三月
                        $zodiac = ($day <= 20) ? "雙魚座" : "白羊座";
                        break;
                    case 4: // 四月
                        $zodiac = ($day <= 19) ? "白羊座" : "金牛座";
                        break;
                    case 5: // 五月
                        $zodiac = ($day <= 20) ? "金牛座" : "雙子座";
                        break;
                    case 6: // 六月
                        $zodiac = ($day <= 21) ? "雙子座" : "巨蟹座";
                        break;
                    case 7: // 七月
                        $zodiac = ($day <= 22) ? "巨蟹座" : "獅子座";
                        break;
                    case 8: // 八月
                        $zodiac = ($day <= 22) ? "獅子座" : "處女座";
                        break;
                    case 9: // 九月
                        $zodiac = ($day <= 22) ? "處女座" : "天秤座";
                        break;
                    case 10: // 十月
                        $zodiac = ($day <= 23) ? "天秤座" : "天蠍座";
                        break;
                    case 11: // 十一月
                        $zodiac = ($day <= 21) ? "天蠍座" : "射手座";
                        break;
                    case 12: // 十二月
                        $zodiac = ($day <= 20) ? "射手座" : "魔羯座";
                        break;
                    default:
                        $error = "無效的月份";
                }
                
                // 根據星座設置描述和符號
                if (!empty($zodiac)) {
                    // 星座詳細信息
                    $zodiacDescription = [
                        "白羊座" => "白羊座的人衝勁十足、熱情直率，是十二星座中的「戰士」。",
                        "金牛座" => "金牛座的人踏實穩重、享受生活，對物質的安全感有很高的要求。",
                        "雙子座" => "雙子座的人機智靈活、善於表達，對新事物充滿好奇心。",
                        "巨蟹座" => "巨蟹座的人情感豐富、重視家庭，擁有強烈的保護慾。",
                        "獅子座" => "獅子座的人自信大方、光明磊落，天生具有領導才能。",
                        "處女座" => "處女座的人做事細心、邏輯性強，追求完美與實用。",
                        "天秤座" => "天秤座的人優雅和諧、公平公正，善於處理人際關係。",
                        "天蠍座" => "天蠍座的人深沉神秘、意志堅定，感情專一而熱烈。",
                        "射手座" => "射手座的人開朗樂觀、追求自由，喜歡冒險和探索。",
                        "魔羯座" => "魔羯座的人務實穩重、有野心，做事認真負責。",
                        "水瓶座" => "水瓶座的人思想前衛、創意豐富，關注人道主義議題。",
                        "雙魚座" => "雙魚座的人富有同情心、浪漫多情，具有超凡的直覺力。"
                    ];
                    
                    // 星座符號
                    $zodiacSymbols = [
                        "白羊座" => "♈",
                        "金牛座" => "♉",
                        "雙子座" => "♊",
                        "巨蟹座" => "♋",
                        "獅子座" => "♌",
                        "處女座" => "♍",
                        "天秤座" => "♎",
                        "天蠍座" => "♏",
                        "射手座" => "♐",
                        "魔羯座" => "♑",
                        "水瓶座" => "♒",
                        "雙魚座" => "♓"
                    ];
                    
                    $zodiacInfo = $zodiacDescription[$zodiac];
                    $zodiacSymbol = $zodiacSymbols[$zodiac];
                }
            }
        }
    }
}

// 設置星座日期區間
$zodiacRanges = [
    ["name" => "白羊座", "symbol" => "♈", "start" => "3-21", "end" => "4-19", "color" => "#FF5733"],
    ["name" => "金牛座", "symbol" => "♉", "start" => "4-20", "end" => "5-20", "color" => "#8B4513"],
    ["name" => "雙子座", "symbol" => "♊", "start" => "5-21", "end" => "6-21", "color" => "#FFFF00"],
    ["name" => "巨蟹座", "symbol" => "♋", "start" => "6-22", "end" => "7-22", "color" => "#87CEEB"],
    ["name" => "獅子座", "symbol" => "♌", "start" => "7-23", "end" => "8-22", "color" => "#FFA500"],
    ["name" => "處女座", "symbol" => "♍", "start" => "8-23", "end" => "9-22", "color" => "#90EE90"],
    ["name" => "天秤座", "symbol" => "♎", "start" => "9-23", "end" => "10-23", "color" => "#FF69B4"],
    ["name" => "天蠍座", "symbol" => "♏", "start" => "10-24", "end" => "11-21", "color" => "#800000"],
    ["name" => "射手座", "symbol" => "♐", "start" => "11-22", "end" => "12-20", "color" => "#9370DB"],
    ["name" => "魔羯座", "symbol" => "♑", "start" => "12-21", "end" => "1-20", "color" => "#708090"],
    ["name" => "水瓶座", "symbol" => "♒", "start" => "1-21", "end" => "2-19", "color" => "#00BFFF"],
    ["name" => "雙魚座", "symbol" => "♓", "start" => "2-20", "end" => "3-20", "color" => "#40E0D0"]
];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>星座查詢</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6b5b95;
            --secondary-color: #feb236;
            --text-color: #333;
            --light-bg: #f8f9fa;
            --card-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            --border-radius: 12px;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Noto Sans TC', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8ed 100%);
            color: var(--text-color);
            line-height: 1.6;
            padding: 20px;
            min-height: 100vh;
        }
        
        .container {
            max-width: 900px;
            margin: 30px auto;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(120deg, var(--primary-color), #8675b9);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }
        
        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }
        
        .header p {
            opacity: 0.9;
            font-weight: 300;
            font-size: 1.1rem;
        }
        
        .stars {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            opacity: 0.3;
            pointer-events: none;
        }
        
        .content {
            padding: 30px;
            position: relative;
            z-index: 1;
        }
        
        .form-group {
            margin-bottom: 25px;
            text-align: center;
        }
        
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: 500;
            font-size: 1.1rem;
            color: var(--primary-color);
        }
        
        input[type="date"] {
            width: 250px;
            padding: 12px 15px;
            border: 2px solid #e1e1e1;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            font-family: inherit;
        }
        
        input[type="date"]:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(107, 91, 149, 0.2);
        }
        
        button {
            background: var(--secondary-color);
            color: #333;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-left: 10px;
        }
        
        button:hover {
            background: #ffc04d;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        
        .error {
            color: #d9534f;
            background-color: #fce6e6;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            font-weight: 500;
            text-align: center;
        }
        
        .result {
            text-align: center;
            padding: 30px 20px;
            background-color: var(--light-bg);
            border-radius: var(--border-radius);
            margin: 30px 0;
            border: 1px solid #e9ecef;
            position: relative;
            overflow: hidden;
            transition: all 0.5s ease;
        }
        
        .result-content {
            position: relative;
            z-index: 1;
        }
        
        .result.has-result {
            background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(245,247,250,0.9) 100%);
        }
        
        .zodiac-symbol {
            font-size: 5rem;
            margin-bottom: 15px;
            display: block;
            color: var(--primary-color);
        }
        
        .zodiac-name {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--primary-color);
        }
        
        .zodiac-date {
            font-size: 1.1rem;
            margin-bottom: 15px;
            color: #666;
        }
        
        .zodiac-info {
            font-size: 1.1rem;
            line-height: 1.7;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .zodiac-table {
            margin-top: 50px;
            border-top: 1px solid #e9ecef;
            padding-top: 30px;
        }
        
        .zodiac-table h3 {
            text-align: center;
            margin-bottom: 20px;
            color: var(--primary-color);
            font-size: 1.5rem;
        }
        
        .zodiac-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }
        
        .zodiac-card {
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid #eee;
        }
        
        .zodiac-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .zodiac-card-symbol {
            font-size: 2rem;
            display: block;
            margin-bottom: 5px;
        }
        
        .zodiac-card-name {
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .zodiac-card-date {
            font-size: 0.85rem;
            color: #666;
        }
        
        .zodiac-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.05;
            background-size: cover;
            background-position: center;
            z-index: 0;
        }
        
        .footer {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
            color: #777;
            font-size: 0.9rem;
        }
        
        @media (max-width: 768px) {
            .container {
                margin: 15px;
            }
            
            .header {
                padding: 20px;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            .content {
                padding: 20px;
            }
            
            .zodiac-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="stars"></div>
            <h1>星座查詢工具</h1>
            <p>輸入您的出生日期，探索您的星座特質</p>
        </div>
        
        <div class="content">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="date">請選擇日期</label>
                    <div>
                        <input type="date" id="date" name="date" value="<?php echo $date; ?>" required>
                        <button type="submit">查詢星座</button>
                    </div>
                </div>
            </form>
            
            <?php if (!empty($error)): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php if (!empty($zodiac)): ?>
                <?php
                    // 找到對應的星座資料
                    $currentZodiac = null;
                    foreach ($zodiacRanges as $z) {
                        if ($z["name"] == $zodiac) {
                            $currentZodiac = $z;
                            break;
                        }
                    }
                ?>
                <div class="result has-result">
                    <div class="zodiac-bg" style="background-color: <?php echo $currentZodiac["color"]; ?>"></div>
                    <div class="result-content">
                        <span class="zodiac-symbol"><?php echo $currentZodiac["symbol"]; ?></span>
                        <h2 class="zodiac-name"><?php echo $zodiac; ?></h2>
                        <div class="zodiac-date">出生日期：<?php echo $date; ?></div>
                        <p class="zodiac-info"><?php echo $zodiacInfo; ?></p>
                    </div>
                </div>
            <?php endif; ?>
            
            <div class="zodiac-table">
                <h3>十二星座日期對照表</h3>
                <div class="zodiac-grid">
                    <?php foreach ($zodiacRanges as $z): ?>
                    <div class="zodiac-card" style="border-top: 3px solid <?php echo $z["color"]; ?>">
                        <span class="zodiac-card-symbol"><?php echo $z["symbol"]; ?></span>
                        <div class="zodiac-card-name"><?php echo $z["name"]; ?></div>
                        <div class="zodiac-card-date"><?php echo $z["start"]; ?> ~ <?php echo $z["end"]; ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <div class="footer">
            &copy; <?php echo date("Y"); ?> 星座查詢系統 | 版權所有
        </div>
    </div>
</body>
</html>
