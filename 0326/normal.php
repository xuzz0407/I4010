<?php
session_start();

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

// Chinese translation of month names for optional display
$arrMonthChinese = array(
    '1'=>'一月', '2'=>'二月', '3'=>'三月', '4'=>'四月',
    '5'=>'五月', '6'=>'六月', '7'=>'七月', '8'=>'八月',
    '9'=>'九月', '10'=>'十月', '11'=>'十一月', '12'=>'十二月'
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

// Function to get the name of the Western zodiac sign for a given date
function getWesternZodiac($month, $day) {
    if (($month == 1 && $day >= 20) || ($month == 2 && $day <= 18)) {
        return "Aquarius (水瓶座)";
    } elseif (($month == 2 && $day >= 19) || ($month == 3 && $day <= 20)) {
        return "Pisces (雙魚座)";
    } elseif (($month == 3 && $day >= 21) || ($month == 4 && $day <= 19)) {
        return "Aries (牡羊座)";
    } elseif (($month == 4 && $day >= 20) || ($month == 5 && $day <= 20)) {
        return "Taurus (金牛座)";
    } elseif (($month == 5 && $day >= 21) || ($month == 6 && $day <= 20)) {
        return "Gemini (雙子座)";
    } elseif (($month == 6 && $day >= 21) || ($month == 7 && $day <= 22)) {
        return "Cancer (巨蟹座)";
    } elseif (($month == 7 && $day >= 23) || ($month == 8 && $day <= 22)) {
        return "Leo (獅子座)";
    } elseif (($month == 8 && $day >= 23) || ($month == 9 && $day <= 22)) {
        return "Virgo (處女座)";
    } elseif (($month == 9 && $day >= 23) || ($month == 10 && $day <= 22)) {
        return "Libra (天秤座)";
    } elseif (($month == 10 && $day >= 23) || ($month == 11 && $day <= 21)) {
        return "Scorpio (天蠍座)";
    } elseif (($month == 11 && $day >= 22) || ($month == 12 && $day <= 21)) {
        return "Sagittarius (射手座)";
    } else {
        return "Capricorn (摩羯座)";
    }
}

// Function to get the day of the year (1-366)
function getDayOfYear($year, $month, $day) {
    return date('z', mktime(0, 0, 0, $month, $day, $year)) + 1;
}

// Function to get the week number
function getWeekNumber($year, $month, $day) {
    return date('W', mktime(0, 0, 0, $month, $day, $year));
}

// Function to determine if a year is a leap year
function isLeapYear($year) {
    return ((($year % 4) == 0) && ((($year % 100) != 0) || (($year % 400) == 0)));
}

// Function to calculate days left in the year
function getDaysLeftInYear($year, $month, $day) {
    $dayOfYear = getDayOfYear($year, $month, $day);
    $daysInYear = isLeapYear($year) ? 366 : 365;
    return $daysInYear - $dayOfYear;
}

// Format today's date for comparison once
$todayString = date('Y-n-j'); // Use 'n' and 'j' for no leading zeros

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

// Season information
$season = "";
$seasonInfo = "";

if (($M == 12 && $Y <= $displayMaxYear) || ($M <= 2 && $Y >= $displayMinYear)) {
    $season = "Winter (冬季)";
    $seasonInfo = "好冷";
} elseif ($M >= 3 && $M <= 5) {
    $season = "Spring (春季)";
    $seasonInfo = "要夏天了!";
} elseif ($M >= 6 && $M <= 8) {
    $season = "Summer (夏季)";
    $seasonInfo = "好熱";
} elseif ($M >= 9 && $M <= 11) {
    $season = "Fall/Autumn (秋季)";
    $seasonInfo = "要冬天了!";
}

// Determine if current year is a leap year
$isCurrentYearLeap = isLeapYear($Y);
$daysInCurrentYear = $isCurrentYearLeap ? 366 : 365;

// Get holidays for the displayed month - MODIFIED FOR TAIWAN HOLIDAYS
function getHolidays($year, $month) {
    $holidays = array();
    
    // Taiwan holidays
    if ($month == 1) {
        $holidays[1] = "元旦 (New Year's Day)";
    }
    
    // Lunar New Year typically falls between Jan 21 and Feb 20
    // Note: Actual date varies each year based on lunar calendar
    if ($month == 2 && $year >= 1975) {
        // Example (approximate) - would need lunar calendar calculations for accuracy
        $holidays[5] = "農曆新年"; // Date is approximate
    }
    
    if ($month == 2 && $year >= 1975) {
        $holidays[28] = "和平紀念日";
    }
    
    if ($month == 4 && $year >= 1975) {
        $holidays[4] = "兒童節";
        $holidays[5] = "清明節"; // Date varies slightly year to year
    }
    
    if ($month == 5 && $year >= 1975) {
        $holidays[1] = "勞動節";
    }
    
    if ($month == 6 && $year >= 1975) {
        // Dragon Boat Festival (varies based on lunar calendar)
        $holidays[25] = "端午節"; // Date is approximate
    }
    
    if ($month == 9 && $year >= 1975) {
        // Mid-Autumn Festival (varies based on lunar calendar)
        $holidays[13] = "中秋節"; // Date is approximate
    }
    
    if ($month == 10 && $year >= 1975) {
        $holidays[10] = "國慶日";
    }
    
    if ($month == 12) {
        $holidays[25] = "聖誕節";
    }
    
    return $holidays;
}

$holidays = getHolidays($Y, $M);
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
            --primary-color:rgb(21, 117, 161);      /* Green instead of red */
            --primary-light: #d1e7dd;      /* Light green */
            --secondary-color: #0d6efd;    /* Blue */
            --dark-text: #343a40;
            --light-text: #f8f9fa;
            --holiday-color: #dc3545;      /* Red for holidays */
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
            color: var(--holiday-color);
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
        
        .date-info {
            font-size: 12px;
            color: #6c757d;
            display: block;
        }
        
        .holiday {
            color: var(--holiday-color);
            font-weight: bold;
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
        
        .season-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .season-card {
            flex: 1;
            min-width: 200px;
            border-radius: 10px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: transform 0.3s;
        }
        
        .season-card:hover {
            transform: translateY(-5px);
        }
        
        .season-card .card-header {
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
            
            .date-info {
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
            
            .date-info {
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
                                                <option value="<?php echo $key; ?>" <?php echo ($M == $key) ? 'selected' : ''; ?>><?php echo $key; ?> (<?php echo $arrMonthChinese[$key]; ?>)</option>
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
                                            $HolidayInfo = '';

                                            if (empty($Date)) {
                                                $cellClass .= ' empty-day';
                                            } else {
                                                $currentDateStringYmd = sprintf('%d-%02d-%02d', $Y, $M, $Date);
                                                $currentDateStringYnj = "$Y-$M-$Date";
                                                
                                                // Check for holidays
                                                if (isset($holidays[$Date])) {
                                                    $HolidayInfo = $holidays[$Date];
                                                }

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
                                                <?php if (!empty($HolidayInfo)): ?>
                                                    <span class="date-info holiday"><?php echo htmlspecialchars($HolidayInfo); ?></span>
                                                <?php endif; ?>
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
                                        <span><i class="fas fa-sun me-2"></i>今日日期:</span>
                                        <span class="badge bg-success rounded-pill"><?php echo date('Y 年 n 月 j 日'); ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-star me-2"></i>星座:</span>
                                        <span class="badge bg-info rounded-pill"><?php echo htmlspecialchars(getWesternZodiac(date('n'), date('j'))); ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-clock me-2"></i>今年是否為閏年:</span>
                                        <span class="badge <?php echo (isLeapYear(date('Y'))) ? 'bg-success' : 'bg-danger'; ?> rounded-pill">
                                            <?php echo (isLeapYear(date('Y'))) ? '是' : '否'; ?>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="season-container">
                            <div class="card season-card">
                                <div class="card-header text-center">
                                    <i class="fas fa-calendar-check me-2"></i>本月季節
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><strong>季節:</strong> <?php echo htmlspecialchars($season); ?></p>
                                    <p class="card-text"><strong>所屬月份:</strong> <?php echo htmlspecialchars($Month . ' (' . $arrMonthChinese[$M] . ')'); ?></p>
                                    <p class="card-text"><small><?php echo htmlspecialchars($seasonInfo); ?></small></p>
                                </div>
                            </div>

                            <div class="card season-card">
                                <div class="card-header text-center">
                                    <i class="fas fa-search-location me-2"></i>所選年份訊息
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><strong>年份:</strong> <?php echo $Y; ?> 年</p>
                                    <p class="card-text"><strong>是否為閏年:</strong> <?php echo (isLeapYear($Y)) ? '是 (366天)' : '否 (365天)'; ?></p>
                                    <p class="card-text"><strong>本月日數:</strong> <?php echo $LastDate; ?> 天</p>
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
            <small>&copy; <?php echo date('Y'); ?> 國曆月曆</small>
        </footer>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>