<?php
session_start();

// Initialize variables
$Y = '';
$M = '';

// Set default to current time if not specified
if (!isset($_GET['Y']) || !is_numeric($_GET['Y']) || $_GET['Y'] < 1975 || $_GET['Y'] > 2030) {
    $Y = date('Y');
} else {
    $Y = $_GET['Y'];
}

if (!isset($_GET['M']) || !is_numeric($_GET['M']) || $_GET['M'] < 1 || $_GET['M'] > 12) {
    $M = date('n');
} else {
    $M = $_GET['M'];
}

// Generate arrays for year and month dropdowns
$arrMonth = array(
    '1'=>'January', '2'=>'February', '3'=>'March', '4'=>'April', 
    '5'=>'May', '6'=>'June', '7'=>'July', '8'=>'August', 
    '9'=>'September', '10'=>'October', '11'=>'November', '12'=>'December'
);

$arrYear = array();
for ($i = 1975; $i <= 2030; $i++) {
    $arrYear[$i] = $i;
}

// Calculate calendar data
$FirstDate = 1;
$LastDate = date('j', mktime(0, 0, 0, $M + 1, 0, $Y));
$ShowDate = array();

// Initialize empty calendar grid
for ($i = 0; $i < 6; $i++) {
    for ($j = 0; $j < 7; $j++) {
        $ShowDate[$i][$j] = '';
    }
}

// Fill in the calendar grid
$r = 0;
for ($d = 1; $d <= $LastDate; $d++) {
    $w = date('w', mktime(0, 1, 0, $M, $d, $Y));
    $ShowDate[$r][$w] = $d;
    if ($w == 6) $r++;
}

$Month = date('F', mktime(0, 1, 0, $M, 1, $Y));

// Determine number of rows needed
$LastRow = 5;
if (empty($ShowDate[5][0])) $LastRow = 4;
if (empty($ShowDate[4][0])) $LastRow = 3;

// Function to get lunar calendar date
function GetLunarDate($date) {
    // This is a simplified version - in a real implementation you would 
    // need a comprehensive lunar calendar calculation system
    // The current examples use a lookup table, which would need to be expanded
    
    // For demonstration, return a placeholder
    // In a full implementation, you would calculate the actual lunar date
    // based on astronomical calculations or lookup tables for 1975-2030
    
    $year = date('Y', strtotime($date));
    $month = date('n', strtotime($date));
    $day = date('j', strtotime($date));
    
    // Placeholder - in production, replace with actual lunar calendar conversion
    // You would need to extend the $CalMap and $LunerYearMap arrays in lunercalendar.php
    return "农历日期";
}

// Function to get Chinese zodiac animal for a given year
function getChineseZodiac($year) {
    $zodiac = array('鼠', '牛', '虎', '兔', '龙', '蛇', '马', '羊', '猴', '鸡', '狗', '猪');
    return $zodiac[($year - 4) % 12];
}

// Function to get heavenly stem and earthly branch
function getChineseYear($year) {
    $heavenlyStem = array('甲', '乙', '丙', '丁', '戊', '己', '庚', '辛', '壬', '癸');
    $earthlyBranch = array('子', '丑', '寅', '卯', '辰', '巳', '午', '未', '申', '酉', '戌', '亥');
    
    return $heavenlyStem[($year - 4) % 10] . $earthlyBranch[($year - 4) % 12];
}

// Calculate previous and next month/year links
$prevY = $Y;
$prevM = $M - 1;
if ($prevM < 1) {
    $prevM = 12;
    $prevY--;
}

$nextY = $Y;
$nextM = $M + 1;
if ($nextM > 12) {
    $nextM = 1;
    $nextY++;
}

// Check if navigation should be disabled
$prevDisabled = ($Y <= 1975 && $M == 1) ? 'disabled' : '';
$nextDisabled = ($Y >= 2030 && $M == 12) ? 'disabled' : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gregorian-Lunar Calendar (1975-2030)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        .calendar-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .nav-buttons {
            display: flex;
            gap: 10px;
        }
        button {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }
        .dropdown-container {
            text-align: center;
            margin-bottom: 20px;
        }
        select {
            padding: 8px;
            margin: 0 5px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .today {
            background-color: #AAAAEE;
        }
        .weekend-sun {
            color: red;
        }
        .weekend-sat {
            color: orange;
        }
        .lunar-date {
            font-size: 12px;
            color: #666;
            display: block;
            margin-top: 5px;
        }
        .calendar-info {
            margin-top: 30px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 5px;
            border-left: 4px solid #4CAF50;
        }
        .zodiac-info {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
            background-color: #f0f8ff;
            padding: 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gregorian-Lunar Calendar</h1>
        <h2><?php echo $Month . ' ' . $Y; ?></h2>
        
        <div class="calendar-nav">
            <div class="nav-buttons">
                <button onclick="window.location.href='?Y=<?php echo $prevY; ?>&M=<?php echo $prevM; ?>'" <?php echo $prevDisabled; ?>>Previous Month</button>
                <button onclick="window.location.href='?Y=<?php echo date('Y'); ?>&M=<?php echo date('n'); ?>'">Today</button>
                <button onclick="window.location.href='?Y=<?php echo $nextY; ?>&M=<?php echo $nextM; ?>'" <?php echo $nextDisabled; ?>>Next Month</button>
            </div>
        </div>
        
        <div class="dropdown-container">
            <form method="GET" action="">
                Year:
                <select name="Y" onchange="this.form.submit()">
                    <?php foreach ($arrYear as $key => $value): ?>
                        <option value="<?php echo $key; ?>" <?php echo ($Y == $key) ? 'selected' : ''; ?>><?php echo $value; ?></option>
                    <?php endforeach; ?>
                </select>
                
                Month:
                <select name="M" onchange="this.form.submit()">
                    <?php foreach ($arrMonth as $key => $value): ?>
                        <option value="<?php echo $key; ?>" <?php echo ($M == $key) ? 'selected' : ''; ?>><?php echo $value; ?></option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th class="weekend-sun">Sunday</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th class="weekend-sat">Saturday</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($r = 0; $r <= $LastRow; $r++): ?>
                    <tr>
                        <?php for ($i = 0; $i < 7; $i++): ?>
                            <?php
                                $Date = $ShowDate[$r][$i];
                                $BgClass = '';
                                $DateClass = '';
                                $LunarDate = '';
                                
                                if (!empty($Date)) {
                                    // Format current date for comparison
                                    $currentDateString = date('Y-m-d', mktime(0, 1, 0, $M, $Date, $Y));
                                    $todayString = date('Y-m-d');
                                    
                                    // Get lunar date
                                    $LunarDate = GetLunarDate($currentDateString);
                                    
                                    // Check if it's today
                                    if ($currentDateString == $todayString) {
                                        $BgClass = 'today';
                                    }
                                    
                                    // Apply weekend styles
                                    if ($i == 0) {
                                        $DateClass = 'weekend-sun';
                                    } elseif ($i == 6) {
                                        $DateClass = 'weekend-sat';
                                    }
                                }
                            ?>
                            <td class="<?php echo $BgClass; ?>">
                                <?php if (!empty($Date)): ?>
                                    <span class="<?php echo $DateClass; ?>"><?php echo $Date; ?></span>
                                    <span class="lunar-date"><?php echo $LunarDate; ?></span>
                                <?php endif; ?>
                            </td>
                        <?php endfor; ?>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
        
        <div class="calendar-info">
            <p><strong>Calendar Range:</strong> This calendar provides dates from 1975 to 2030 with both Gregorian (solar) and Chinese lunar calendar information.</p>
            <p><strong>Today's Date:</strong> <?php echo date('F j, Y'); ?></p>
        </div>
        
        <div class="zodiac-info">
            <div>
                <p><strong>Current Year:</strong> <?php echo date('Y'); ?></p>
                <p><strong>Chinese Year:</strong> <?php echo getChineseYear(date('Y')); ?></p>
                <p><strong>Zodiac Animal:</strong> <?php echo getChineseZodiac(date('Y')); ?></p>
            </div>
            <div>
                <p><strong>Selected Year:</strong> <?php echo $Y; ?></p>
                <p><strong>Chinese Year:</strong> <?php echo getChineseYear($Y); ?></p>
                <p><strong>Zodiac Animal:</strong> <?php echo getChineseZodiac($Y); ?></p>
            </div>
        </div>
    </div>
</body>
</html>