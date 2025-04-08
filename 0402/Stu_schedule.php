<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>徐士洧 功課表</title>
    <style>
        :root {
            --primary-color: #344955;
            --secondary-color: #4a6572;
            --accent-color: #4a6572;
            --light-bg: #f5f5f5;
            --text-light: #ffffff;
            --text-dark: #333333;
            --lunch-color: #d32f2f;
            --lunch-bg: #ffebee;
            --evening-color: #6a1b9a;
            --evening-bg: #f3e5f5;
            --empty-cell: #ffffff;
            --class-cell: #e3f2fd;
            --border-color: #e0e0e0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

		.school-id .class-code {
    		background-color: #4a6572; /* Bright orange-red background */
    		color: white; /* White text for contrast */
    		padding: 8px 15px;
    		border-radius: 20px; /* More rounded corners */
    		font-size: 1.3em; /* Slightly larger text */
    		font-weight: bold;
    		letter-spacing: 1px; /* Spacing between letters */
    		border: 2px solid white; /* White border for extra pop */
    		display: inline-block;
    		transform: translateY(-3px); /* Slight lift effect */
		}


        body {
            font-family: "Microsoft JhengHei", Arial, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background-color: var(--light-bg);
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 3px solid var(--accent-color);
            padding-bottom: 20px;
        }

        .page-title {
            flex-grow: 1;
            text-align: center;
        }

        h1 {
            color: var(--primary-color);
            margin-bottom: 10px;
            font-size: 2rem;
            font-weight: 700;
        }

        .school-id {
            flex-shrink: 0;
            text-align: right;
            padding-left: 15px;
        }

        .student-id {
            font-size: 1.2em;
            color: var(--secondary-color);
            margin-bottom: 0;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .schedule-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            border-radius: 8px;
            overflow: hidden;
        }

        .schedule-table th, .schedule-table td {
            padding: 14px 10px;
            text-align: center;
            border: 1px solid var(--border-color);
        }

        .schedule-table th {
            background-color: var(--primary-color);
            color: var(--text-light);
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9em;
        }

        .day-header {
            background-color: var(--secondary-color) !important;
            color: var(--text-light);
            position: relative;
        }

        .day-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 25%;
            width: 50%;
            height: 3px;
            background-color: var(--accent-color);
        }

        .time-cell {
            background-color: var(--secondary-color);
            color: var(--text-light);
            font-weight: bold;
            width: 10%;
            border-right: 2px solid var(--accent-color);
        }

        .lunch-cell {
            background-color: var(--lunch-bg);
            color: var(--lunch-color);
            font-weight: bold;
            border: 1px solid #ffcdd2;
        }

        .evening-cell {
            background-color: var(--evening-bg);
            color: var(--evening-color);
            font-weight: bold;
            border: 1px solid #e1bee7;
        }

        .empty-cell {
            background-color: var(--empty-cell);
        }

        .class-cell {
            background-color: var(--class-cell);
            border: 1px solid #bbdefb;
            position: relative;
        }

        .class-code {
            font-weight: bold;
            margin-bottom: 6px;
            color: var(--primary-color);
            background-color: rgba(255, 255, 255, 0.6);
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
        }

        .class-name {
            margin-bottom: 6px;
        }

        .class-name a {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: bold;
            transition: color 0.2s ease-in-out;
        }

        .class-name a:hover {
            color: var(--accent-color);
            text-decoration: underline;
        }

        .class-location {
            font-size: 0.9em;
            color: #555;
            background-color: rgba(255, 255, 255, 0.6);
            display: inline-block;
            padding: 1px 5px;
            border-radius: 4px;
        }

        .time-detail {
            display: block;
            font-size: 0.8em;
            margin-top: 5px;
            opacity: 0.8;
        }

        button {
            padding: 12px 25px;
            margin: 10px 5px;
            border-radius: 30px;
            border: none;
            font-size: 0.95em;
            font-family: inherit;
            cursor: pointer;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .home-button {
            background: var(--primary-color);
            color: white;
            border: 2px solid var(--primary-color);
        }

        .home-button:hover {
            background: white;
            color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .buttons-container {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
        }

        /* 新增教室資訊樣式 */
        .building-info {
            margin-top: 30px;
            border-top: 1px solid var(--border-color);
            padding-top: 15px;
        }

        .building-info h3 {
            color: var(--primary-color);
            margin-bottom: 10px;
            font-size: 1.3rem;
            text-align: center;
        }

        .building-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            border-radius: 8px;
            overflow: hidden;
        }

        .building-table th, .building-table td {
            padding: 10px;
            text-align: center;
            border: 1px solid var(--border-color);
        }

        .building-table th {
            background-color: var(--primary-color);
            color: var(--text-light);
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            
            .page-header {
                flex-direction: column;
                align-items: stretch;
            }
            
            .school-id {
                text-align: center;
                padding-left: 0;
                margin-bottom: 15px;
            }
            
            .student-id {
                justify-content: center;
            }
            
            .page-title {
                order: 2;
            }
            
            .schedule-table th, .schedule-table td {
                padding: 8px 5px;
                font-size: 0.85em;
            }
            
            h1 {
                font-size: 1.5rem;
            }
            
            .time-detail {
                font-size: 0.7em;
            }
            
            button {
                padding: 10px 15px;
                font-size: 0.8em;
            }

            .building-table th, .building-table td {
                padding: 6px 3px;
                font-size: 0.8em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <div class="school-id">
                <h2 class="student-id">
                    <span class="class-code">I3A07</span>
                </h2>
            </div>
            <div class="page-title">
                <h1>徐士洧 功課表</h1>
            </div>
        </div>
        
        <table class="schedule-table">
            <thead>
                <tr>
                    <th>節次</th>
                    <th class="day-header">星期一</th>
                    <th class="day-header">星期二</th>
                    <th class="day-header">星期三</th>
                    <th class="day-header">星期四</th>
                    <th class="day-header">星期五</th>
                    <th class="day-header">星期六</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="time-cell">第一節<span class="time-detail">08:10-09:00</span></td>
                    <td class="empty-cell"></td>
                    <td class="empty-cell"></td>
                    <td class="empty-cell"></td>
                    <td class="class-cell" rowspan="2">
                        <div class="class-code">G1832E</div>
                        <div class="class-name"><a href="SbjDetail.php?SbjNo=I4010" target="_blank">大三體育(二)</a></div>
                        <div class="class-location">-</div>
                    </td>
                    <td class="empty-cell"></td>
                    <td class="empty-cell"></td>
                </tr>
                
                <tr>
                    <td class="time-cell">第二節<span class="time-detail">09:10-10:00</span></td>
                    <td class="class-cell" rowspan="3">
                        <div class="class-code">I4581</div>
                        <div class="class-name"><a href="SbjDetail.php?SbjNo=I4010" target="_blank">創新服務</a></div>
                        <div class="class-location">A4-201</div>
                    </td>
                    <td class="class-cell" rowspan="3">
                        <div class="class-code">I3250A</div>
                        <div class="class-name"><a href="SbjDetail.php?SbjNo=I4010" target="_blank">計算機組織</a></div>
                        <div class="class-location">A3-105</div>
                    </td>
                    <td class="class-cell" rowspan="3">
                        <div class="class-code">I4010</div>
                        <div class="class-name"><a href="SbjDetail.php?SbjNo=I4010" target="_blank">網頁程式</a></div>
                        <div class="class-location">A3-100</div>
                    </td>
                    <td class="class-cell" rowspan="3">
                        <div class="class-code">I4230</div>
                        <div class="class-name"><a href="SbjDetail.php?SbjNo=I4010" target="_blank">資安實務</a></div>
                        <div class="class-location">A8-B209</div>
                    </td>
                    <td class="empty-cell"></td>                    
                </tr>
                
                <tr>
                    <td class="time-cell">第三節<span class="time-detail">10:10-11:00</span></td>
                    <td class="empty-cell"></td>
                </tr>
                
                <tr>
                    <td class="time-cell">第四節<span class="time-detail">11:10-12:00</span></td>
                    <td class="class-cell" rowspan="3">
                        <div class="class-code">I3640</div>
                        <div class="class-name"><a href="SbjDetail.php?SbjNo=I4010" target="_blank">資訊安全管理</a></div>
                        <div class="class-location">A8-B209</div>
                    </td>
                </tr>
                
                <tr>
                    <td class="time-cell">中午<span class="time-detail">12:10-13:00</span></td>
                    <td class="lunch-cell"></td>
                    <td class="lunch-cell"></td>
                    <td class="lunch-cell"></td>
                    <td class="lunch-cell"></td>
                    <td class="lunch-cell"></td>
                </tr>
                
                <tr>
                    <td class="time-cell">第五節<span class="time-detail">13:10-14:00</span></td>
                    <td class="empty-cell"></td>
                    <td class="empty-cell"></td>
                    <td class="empty-cell"></td>
                    <td class="class-cell" rowspan="2">
                        <div class="class-code">G1580</div>
                        <div class="class-name"><a href="SbjDetail.php?SbjNo=I4010" target="_blank">AI 英文</a></div>
                        <div class="class-location">A8-B106</div>
                    </td>
                    <td class="empty-cell"></td>
                </tr>
                
                <tr>
                    <td class="time-cell">第六節<span class="time-detail">14:10-15:00</span></td>
                    <td class="empty-cell"></td>
                    <td class="empty-cell"></td>
                    <td class="empty-cell"></td>
                    <td class="empty-cell"></td>
                    <td class="empty-cell"></td>
                </tr>
                
                <tr>
                    <td class="time-cell">第七節<span class="time-detail">15:10-16:00</span></td>
                    <td class="empty-cell"></td>
                    <td class="class-cell" rowspan="2">
                        <div class="class-code">X4110</div>
                        <div class="class-name"><a href="SbjDetail.php?SbjNo=I4010" target="_blank">科創實務</a></div>
                        <div class="class-location">A3-507</div>
                    </td>
                    <td class="empty-cell"></td>
                    <td class="empty-cell"></td>
                    <td class="empty-cell"></td>
                    <td class="class-cell" rowspan="2">
                        <div class="class-code">G3012F</div>
                        <div class="class-name"><a href="SbjDetail.php?SbjNo=I4010" target="_blank">雜誌研讀(二)</a></div>
                        <div class="class-location">-</div>
                    </td>
                </tr>
                
                <tr>
                    <td class="time-cell">第八節<span class="time-detail">16:10-17:00</span></td>
                    <td class="empty-cell"></td>
                    <td class="empty-cell"></td>
                    <td class="empty-cell"></td>
                    <td class="empty-cell"></td>
                </tr>
                
                <tr>
                    <td class="time-cell">傍晚<span class="time-detail">17:10-18:00</span></td>
                    <td class="evening-cell"></td>
                    <td class="evening-cell"></td>
                    <td class="evening-cell"></td>
                    <td class="evening-cell"></td>
                    <td class="evening-cell"></td>
                    <td class="class-cell" rowspan="2">
                        <div class="class-code">G3020B</div>
                        <div class="class-name"><a href="SbjDetail.php?SbjNo=I4010" target="_blank">專題實驗</a></div>
                        <div class="class-location">-</div>
                    </td>
                </tr>
                <tr>
                    <td class="time-cell">第九節<span class="time-detail">18:20-19:10</span></td>
                    <td class="empty-cell"></td>
                    <td class="empty-cell"></td>
                    <td class="empty-cell"></td>
                    <td class="empty-cell"></td>
                </tr>
            </tbody>
        </table>
        
        <!-- 新增教室資訊區塊 -->
        <div class="building-info">
            <h3>教室資訊</h3>
            <table class="building-table">
                <tr>
                    <th>大樓編號</th>
                    <th>A1</th>
                    <th>A2</th>
                    <th>A3</th>
                    <th>A4</th>
                </tr>
                <tr>
                    <td>大樓名稱</td>
                    <td>經營大樓</td>
                    <td>資訊大樓</td>
                    <td>電機大樓</td>
                    <td>綜合大樓</td>
                </tr>
                <tr>
                    <th>大樓編號</th>
                    <th>A5</th>
                    <th>A6</th>
                    <th>A7</th>
                    <th>A8</th>
                </tr>
                <tr>
                    <td>大樓名稱</td>
                    <td>商志大樓</td>
                    <td>德惠大樓</td>
                    <td>新德惠大樓</td>
                    <td>商品教育館</td>
                </tr>
            </table>
        </div>
        
        <div class="buttons-container">
            <form action="index.php" method="GET">
                <button type="submit" class="home-button">回首頁</button>
            </form>
        </div>
        
    </div>
</body>
</html>