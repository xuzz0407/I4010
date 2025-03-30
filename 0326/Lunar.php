<?php
session_start();

require_once 'LunarCalendar.php'; 

$lunarConverter = new Lunar();

$Y = '';
$M = '';

$displayMinYear = 1975;
$displayMaxYear = 2030;

if (!isset($_GET['Y']) || !is_numeric($_GET['Y']) || $_GET['Y'] < $displayMinYear || $_GET['Y'] > $displayMaxYear) {
    $Y = date('Y');
} else {
    $Y = (int)$_GET['Y']; // Cast to integer
}

if (!isset($_GET['M']) || !is_numeric($_GET['M']) || $_GET['M'] < 1 || $_GET['M'] > 12) {
    $M = date('n');
} else {
    $M = (int)$_GET['M']; // Cast to integer
}

// Generate arrays for year and month dropdowns
$arrMonth = array(
    '1'=>'January', '2'=>'February', '3'=>'March', '4'=>'April',
    '5'=>'May', '6'=>'June', '7'=>'July', '8'=>'August',
    '9'=>'September', '10'=>'October', '11'=>'November', '12'=>'December'
);

$arrYear = array();
// Use the display range for the dropdown
for ($i = $displayMinYear; $i <= $displayMaxYear; $i++) {
    $arrYear[$i] = $i;
}

// Calculate calendar data
$FirstDate = 1;
$LastDate = date('t', mktime(0, 0, 0, $M, 1, $Y));
$ShowDate = array();

// Initialize empty calendar grid
for ($i = 0; $i < 6; $i++) {
    for ($j = 0; $j < 7; $j++) {
        $ShowDate[$i][$j] = '';
    }
}

// Fill in the calendar grid
$r = 0;
$firstDayOfWeek = date('w', mktime(0, 0, 0, $M, 1, $Y));
$col = $firstDayOfWeek;

for ($d = 1; $d <= $LastDate; $d++) {
    $ShowDate[$r][$col] = $d;
    $col++;
    if ($col == 7) {
        $col = 0;
        $r++;
    }
}

$Month = date('F', mktime(0, 1, 0, $M, 1, $Y));

// Determine number of rows needed
$LastRow = 0;
for ($checkRow = 5; $checkRow >= 0; $checkRow--) {
    $rowHasDate = false;
    for ($checkCol = 0; $checkCol < 7; $checkCol++) {
        if (!empty($ShowDate[$checkRow][$checkCol])) {
            $rowHasDate = true;
            break;
        }
    }
    if ($rowHasDate) {
        $LastRow = $checkRow;
        break;
    }
}

// ----- Use the NEW Lunar Class Instance -----

// Function to get lunar calendar date using the provided Lunar class instance
function GetLunarDate($date_Ymd, Lunar $converterInstance) {
     try {
        list($y, $m, $d) = explode('-', $date_Ymd);
        $y = (int)$y;
        $m = (int)$m;
        $d = (int)$d;

        // Check against the calculation range supported by the Lunar class
        if ($y < Lunar::MIN_YEAR || $y > Lunar::MAX_YEAR) {
             return '農曆 N/A'; // Out of calculation range
        }
        // Check against the display range of the calendar UI
        global $displayMinYear, $displayMaxYear;
        if ($y < $displayMinYear || $y > $displayMaxYear) {
             return '農曆 N/A'; // Out of display range
        }

        $lunarInfo = $converterInstance->convertSolarToLunar($y, $m, $d);
        // Expected return: [year, monthName, dayName, skyEarth, monthNum, dayNum, zodiac, leapMonthNum]
        if (is_array($lunarInfo) && isset($lunarInfo[1]) && isset($lunarInfo[2])) {
            // Combine month name (index 1) and day name (index 2)
            return $lunarInfo[1] . $lunarInfo[2];
        } else {
            // Log error for debugging if possible
            error_log("Lunar::convertSolarToLunar did not return expected array for $date_Ymd");
            return '農曆 Error';
        }
    } catch (Exception $e) {
        error_log("Error in GetLunarDate for $date_Ymd: " . $e->getMessage());
        return '農曆 Error';
    }
}

// Function to get Chinese zodiac animal using the Lunar class instance
function getChineseZodiac($year, Lunar $converterInstance) {
    // Check against the calculation range supported by the Lunar class
    if ($year < Lunar::MIN_YEAR || $year > Lunar::MAX_YEAR) {
         return 'N/A';
    }
    // The class method getYearZodiac uses the *lunar* year.
    // Let's use the direct calculation based on the class's ZODIAC array order
    // Index appears to be year % 12 for this class's array.
    if ($year < 1891) return 'N/A'; // Min year of class data
    return Lunar::ZODIAC[$year % 12]; // Use the ZODIAC const directly
}

// Function to get heavenly stem and earthly branch using the Lunar class instance
function getChineseYear($year, Lunar $converterInstance) {
    // Check against the calculation range supported by the Lunar class
    if ($year < Lunar::MIN_YEAR || $year > Lunar::MAX_YEAR) {
         return 'N/A';
    }
    // Use the class method which seems designed for Gregorian year input
    return $converterInstance->getLunarYearName($year);
}
// ----- End Class Usage Section -----

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

// Check if navigation should be disabled (using display range)
$prevDisabled = ($Y <= $displayMinYear && $M == 1) ? 'disabled' : '';
$nextDisabled = ($Y >= $displayMaxYear && $M == 12) ? 'disabled' : '';

// Format today's date for comparison once
$todayString = date('Y-n-j'); // Use 'n' and 'j' for no leading zeros

?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>月曆 (<?php echo $displayMinYear; ?>-<?php echo $displayMaxYear; ?>)</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .school-id {
            text-align: center;
    padding: 15px 0;      /* 15px padding top and bottom, 0 left and right */
    margin: 10px ;  /* 10px top margin, 0 left/right, 20px bottom margin */
    }

    .student-id {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        font-size: 1.5em;
        color: #2c3e50;
    }

    .class-code {
        background: linear-gradient(135deg, #3498db, #2980b9);
        color: white;
        padding: 8px 15px;
        border-radius: 6px;
        font-weight: bold;
        letter-spacing: 1px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
    }

        :root {
            --primary-color: #dc3545;
            --primary-light: #f8d7da;
            --secondary-color: #0d6efd;
            --dark-text: #343a40;
            --light-text: #f8f9fa;
        }
        
        body {
            font-family: "Microsoft YaHei", Arial, sans-serif;
            background-color: #f8f9fa;
        }
        
        .calendar-container {
            max-width: 1200px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        
        .calendar-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 10px 10px 0 0;
            padding: 20px;
        }
        
        .calendar-body {
            padding: 20px;
        }
        
        .day-of-week {
            font-weight: bold;
            text-align: center;
            padding: 10px 0;
            border-bottom: 2px solid #dee2e6;
        }
        
        .weekend-sun {
            color: var(--primary-color);
        }
        
        .weekend-sat {
            color: var(--secondary-color);
        }
        
        .calendar-day {
            height: 90px;
            border: 1px solid #dee2e6;
            padding: 5px;
            vertical-align: top;
            transition: all 0.3s;
        }
        
        .calendar-day:hover {
            background-color: #f8f9fa;
        }
        
        .date-gregorian {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 4px;
            display: block;
        }
        
        .lunar-date {
            font-size: 12px;
            color: #6c757d;
            display: block;
        }
        
        .today {
            background-color: var(--primary-light);
            border: 1px solid var(--primary-color);
        }
        
        .today .date-gregorian {
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            line-height: 32px;
            text-align: center;
            display: inline-block;
        }
        
        .empty-day {
            background-color: #f8f9fa;
            border: 1px dashed #dee2e6;
        }
        
        .info-card {
            border-left: 4px solid var(--primary-color);
            background-color: white;
            margin-bottom: 20px;
        }
        
        .info-card .card-header {
            background-color: transparent;
            border-bottom: none;
            font-weight: bold;
        }
        
        .zodiac-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .zodiac-card {
            flex: 1;
            min-width: 200px;
            border-radius: 10px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: transform 0.3s;
        }
        
        .zodiac-card:hover {
            transform: translateY(-5px);
        }
        
        .zodiac-card .card-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 10px 10px 0 0;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .calendar-day {
                height: 75px;
                font-size: 12px;
            }
            
            .date-gregorian {
                font-size: 14px;
            }
            
            .lunar-date {
                font-size: 10px;
            }
            
            .today .date-gregorian {
                width: 24px;
                height: 24px;
                line-height: 24px;
            }
        }
        
        @media (max-width: 576px) {
            .calendar-day {
                height: 60px;
                padding: 2px;
            }
            
            .date-gregorian {
                font-size: 12px;
            }
            
            .lunar-date {
                font-size: 9px;
            }
            
            .today .date-gregorian {
                width: 20px;
                height: 20px;
                line-height: 20px;
            }
            
            .nav-item .form-select {
                font-size: 12px;
                padding: 0.25rem 0.5rem;
            }
        }

        button {
        padding: 12px 25px;
        margin: 10px 5px;
        border-radius: 6px;
        border: none;
        font-size: 1em;
        font-family: inherit;
        transition: all 0.3s ease;
        cursor: pointer;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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
    
    .buttons-container {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 25px;
    }
    </style>
</head>
<body>
<div class="school-id">
        <h2 class="student-id">
            <span class="class-code">I3A07 徐士洧</span>
        </h2>
    </div>
    <div class="container-fluid py-4">
        <div class="calendar-container mx-auto mb-5">
            <!-- Calendar Header -->
            <div class="calendar-header">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h1 class="mb-0">月曆</h1>
                        <h4 class="mb-0"><?php echo htmlspecialchars($Y . ' 年 ' . $M . ' 月 (' . $Month . ')'); ?></h4>
                    </div>
                    <div class="col-md-6">
                        <nav class="navbar navbar-expand-md navbar-dark justify-content-end p-0">
                            <ul class="navbar-nav">
                                <!-- Year & Month Selection -->
                                <li class="nav-item me-2">
                                    <form method="GET" action="" class="d-flex align-items-center">
                                        <select name="Y" class="form-select form-select-sm me-2" onchange="this.form.submit()">
                                            <?php foreach ($arrYear as $key => $value): ?>
                                                <option value="<?php echo $key; ?>" <?php echo ($Y == $key) ? 'selected' : ''; ?>><?php echo $value; ?> 年</option>
                                            <?php endforeach; ?>
                                        </select>
                                        <select name="M" class="form-select form-select-sm" onchange="this.form.submit()">
                                            <?php foreach ($arrMonth as $key => $value): ?>
                                                <option value="<?php echo $key; ?>" <?php echo ($M == $key) ? 'selected' : ''; ?>><?php echo $key; ?> 月</option>
                                            <?php endforeach; ?>
                                        </select>
                                        <noscript><button type="submit" class="btn btn-sm btn-light ms-2">查詢</button></noscript>
                                    </form>
                                </li>
                                <!-- Navigation Buttons -->
                                <li class="nav-item">
                                    <div class="btn-group">
                                        <a href="?Y=<?php echo $prevY; ?>&M=<?php echo $prevM; ?>" class="btn btn-sm btn-outline-light <?php echo $prevDisabled; ?>">
                                            <i class="fas fa-chevron-left"></i> 上個月
                                        </a>
                                        <a href="?Y=<?php echo date('Y'); ?>&M=<?php echo date('n'); ?>" class="btn btn-sm btn-outline-light">
                                            <i class="fas fa-calendar-day"></i> 今天
                                        </a>
                                        <a href="?Y=<?php echo $nextY; ?>&M=<?php echo $nextM; ?>" class="btn btn-sm btn-outline-light <?php echo $nextDisabled; ?>">
                                            下個月 <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Calendar Body -->
            <div class="calendar-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="day-of-week weekend-sun">星期日</th>
                                <th class="day-of-week">星期一</th>
                                <th class="day-of-week">星期二</th>
                                <th class="day-of-week">星期三</th>
                                <th class="day-of-week">星期四</th>
                                <th class="day-of-week">星期五</th>
                                <th class="day-of-week weekend-sat">星期六</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($r = 0; $r <= $LastRow; $r++): ?>
                                <tr>
                                    <?php for ($i = 0; $i < 7; $i++): // 0 = Sunday, 6 = Saturday ?>
                                        <?php
                                            $Date = $ShowDate[$r][$i];
                                            $cellClass = 'calendar-day';
                                            $dateSpanClass = '';
                                            $LunarDate = '';

                                            if (empty($Date)) {
                                                $cellClass .= ' empty-day';
                                            } else {
                                                $currentDateStringYmd = sprintf('%d-%02d-%02d', $Y, $M, $Date);
                                                $currentDateStringYnj = "$Y-$M-$Date";

                                                // Get lunar date using the Lunar class instance
                                                $LunarDate = GetLunarDate($currentDateStringYmd, $lunarConverter);

                                                if ($currentDateStringYnj == $todayString) {
                                                    $cellClass .= ' today';
                                                }

                                                // Apply weekend styles
                                                if ($i == 0) { // Sunday
                                                    $dateSpanClass = 'weekend-sun';
                                                } elseif ($i == 6) { // Saturday
                                                    $dateSpanClass = 'weekend-sat';
                                                }
                                            }
                                        ?>
                                        <td class="<?php echo $cellClass; ?>">
                                            <?php if (!empty($Date)): ?>
                                                <span class="date-gregorian <?php echo $dateSpanClass; ?>"><?php echo $Date; ?></span>
                                                <span class="lunar-date"><?php echo htmlspecialchars($LunarDate); ?></span>
                                            <?php endif; ?>
                                        </td>
                                    <?php endfor; ?>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Calendar Information Section -->
                <div class="row mt-4">
                    <div class="col-lg-6 mb-4">
                        <div class="card info-card">
                            <div class="card-header">
                                <i class="fas fa-info-circle me-2"></i>日曆信息
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-calendar-alt me-2"></i>日曆範圍:</span>
                                        <span class="badge bg-primary rounded-pill"><?php echo $displayMinYear; ?> 年 至 <?php echo $displayMaxYear; ?> 年</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-sun me-2"></i>今日國曆:</span>
                                        <span class="badge bg-success rounded-pill"><?php echo date('Y 年 n 月 j 日'); ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-moon me-2"></i>今日農曆:</span>
                                        <span class="badge bg-danger rounded-pill"><?php echo htmlspecialchars(GetLunarDate(date('Y-m-d'), $lunarConverter)); ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="zodiac-container">
                            <div class="card zodiac-card">
                                <div class="card-header text-center">
                                    <i class="fas fa-calendar-check me-2"></i>今年年份訊息
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><strong>國曆:</strong> <?php echo date('Y'); ?> 年</p>
                                    <p class="card-text"><strong>農曆干支:</strong> <?php echo htmlspecialchars(getChineseYear(date('Y'), $lunarConverter)); ?> 年</p>
                                    <p class="card-text"><strong>生肖:</strong> <?php echo htmlspecialchars(getChineseZodiac(date('Y'), $lunarConverter)); ?></p>
                                </div>
                            </div>

                            <div class="card zodiac-card">
                                <div class="card-header text-center">
                                    <i class="fas fa-search-location me-2"></i>所選年份訊息
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><strong>國曆:</strong> <?php echo $Y; ?> 年</p>
                                    <p class="card-text"><strong>農曆干支:</strong> <?php echo htmlspecialchars(getChineseYear($Y, $lunarConverter)); ?> 年</p>
                                    <p class="card-text"><strong>生肖:</strong> <?php echo htmlspecialchars(getChineseZodiac($Y, $lunarConverter)); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="buttons-container">
            <form action="index.php" method="GET">
                <button type="submit" class="home-button">回首頁</button>
            </form>
        </div>
        
        <footer class="text-center text-muted py-3">
            <small>&copy; <?php echo date('Y'); ?> 農曆月曆</small>
        </footer>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>