<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>蒙特卡羅面積估算</title>
    <style>
        body {
            font-family: 'Microsoft YaHei', 'PingFang SC', sans-serif;
            line-height: 1.6;
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            color: #333;
        }
        
        .container {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            color: #d32f2f;
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }
        
        .simulation-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .canvas-container {
            position: relative;
            width: 300px;
            height: 300px;
            border: 1px solid #ddd;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        
        .result-panel {
            flex: 1;
            min-width: 250px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            border-left: 4px solid #d32f2f;
        }
        
        .result-item {
            margin-bottom: 15px;
        }
        
        .result-value {
            font-weight: bold;
            color: #d32f2f;
            font-size: 1.2em;
        }
        
        .controls {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        input[type="number"] {
            padding: 10px;
            width: 120px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        button {
            background-color: #d32f2f;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        
        button:hover {
            background-color: #b71c1c;
        }
        
        .explanation {
            margin-top: 30px;
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 8px;
        }
        
        .mathematical {
            font-style: italic;
            color: #666;
        }
        
        @media (max-width: 600px) {
            .canvas-container {
                width: 100%;
                height: 250px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>蒙特卡羅方法估算圓面積</h1>
        
        <div class="simulation-container">
            <div class="canvas-container">
                <canvas id="simulationCanvas"></canvas>
            </div>
            
            <div class="result-panel">
                <h3>模擬結果</h3>
                
                <div class="result-item">
                    <div>總點數：</div>
                    <div class="result-value" id="totalPoints">10000</div>
                </div>
                
                <div class="result-item">
                    <div>落在圓內點數：</div>
                    <div class="result-value" id="insideCircle">0</div>
                </div>
                
                <div class="result-item">
                    <div>估算紅色區域面積：</div>
                    <div class="result-value" id="estimatedArea">0</div>
                </div>
                
                <div class="result-item">
                    <div>理論值：</div>
                    <div class="result-value" id="exactArea">78.5398</div>
                </div>
                
                <div class="result-item">
                    <div>誤差：</div>
                    <div class="result-value" id="error">0%</div>
                </div>
            </div>
        </div>
        
        <div class="controls">
            <div>
                <label for="radiusInput">半徑：</label>
                <input type="number" id="radiusInput" value="10" min="1" max="100">
            </div>
            
            <div>
                <label for="pointsInput">點數：</label>
                <input type="number" id="pointsInput" value="10000" min="100" max="100000" step="100">
            </div>
            
            <button id="runButton">執行模擬</button>
            <button id="clearButton">清除</button>
        </div>
        
        <div class="explanation">
            <h3>蒙特卡羅方法原理</h3>
            <p>蒙特卡羅方法是一種利用隨機數來解決數學問題的方法。在這個示例中，我們用它來估算四分之一圓的面積。</p>
            <p>通過在一個正方形區域內隨機產生大量點，然後計算落在圓內的點的比例，我們可以估算圓的面積。</p>
            <p class="mathematical">對於半徑為 r 的四分之一圓，其理論面積為 πr²/4。</p>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const canvas = document.getElementById('simulationCanvas');
            const ctx = canvas.getContext('2d');
            const runButton = document.getElementById('runButton');
            const clearButton = document.getElementById('clearButton');
            const radiusInput = document.getElementById('radiusInput');
            const pointsInput = document.getElementById('pointsInput');
            
            // 調整Canvas大小以適應容器
            function resizeCanvas() {
                const container = canvas.parentElement;
                canvas.width = container.clientWidth;
                canvas.height = container.clientHeight;
                redrawCanvas();
            }
            
            window.addEventListener('resize', resizeCanvas);
            resizeCanvas();
            
            // 繪製初始畫面
            function redrawCanvas() {
                const width = canvas.width;
                const height = canvas.height;
                const size = Math.min(width, height);
                
                ctx.clearRect(0, 0, width, height);
                
                // 繪製背景網格
                ctx.strokeStyle = '#e0e0e0';
                ctx.lineWidth = 0.5;
                for (let i = 0; i <= size; i += size/10) {
                    // 垂直線
                    ctx.beginPath();
                    ctx.moveTo(i, 0);
                    ctx.lineTo(i, size);
                    ctx.stroke();
                    
                    // 水平線
                    ctx.beginPath();
                    ctx.moveTo(0, i);
                    ctx.lineTo(size, i);
                    ctx.stroke();
                }
                
                // 繪製座標軸
                ctx.strokeStyle = '#666';
                ctx.lineWidth = 1;
                ctx.beginPath();
                ctx.moveTo(0, 0);
                ctx.lineTo(size, 0);
                ctx.stroke();
                
                ctx.beginPath();
                ctx.moveTo(0, 0);
                ctx.lineTo(0, size);
                ctx.stroke();
                
                // 繪製四分之一圓
                ctx.beginPath();
                ctx.fillStyle = 'rgba(255, 0, 0, 0.1)';
                ctx.arc(0, 0, size, 0, Math.PI/2);
                ctx.lineTo(0, 0);
                ctx.fill();
                ctx.strokeStyle = '#d32f2f';
                ctx.lineWidth = 2;
                ctx.beginPath();
                ctx.arc(0, 0, size, 0, Math.PI/2);
                ctx.stroke();
            }
            
            // 運行蒙特卡羅模擬
            function runSimulation() {
                const radius = parseInt(radiusInput.value);
                const totalPoints = parseInt(pointsInput.value);
                let insideCircle = 0;
                
                const width = canvas.width;
                const height = canvas.height;
                const size = Math.min(width, height);
                
                redrawCanvas();
                
                // 繪製隨機點
                for (let i = 0; i < totalPoints; i++) {
                    const x = Math.random() * radius;
                    const y = Math.random() * radius;
                    
                    const scaledX = (x / radius) * size;
                    const scaledY = (y / radius) * size;
                    
                    const isInside = (x * x + y * y) <= (radius * radius);
                    
                    ctx.beginPath();
                    ctx.arc(scaledX, scaledY, 2, 0, Math.PI * 2);
                    ctx.fillStyle = isInside ? 'rgba(0, 128, 255, 0.7)' : 'rgba(128, 128, 128, 0.7)';
                    ctx.fill();
                    
                    if (isInside) {
                        insideCircle++;
                    }
                }
                
                // 計算與顯示結果
                const squareArea = radius * radius;
                const estimatedArea = (insideCircle / totalPoints) * squareArea;
                const exactArea = Math.PI * radius * radius / 4;
                const error = Math.abs((estimatedArea - exactArea) / exactArea * 100);
                
                document.getElementById('totalPoints').textContent = totalPoints;
                document.getElementById('insideCircle').textContent = insideCircle;
                document.getElementById('estimatedArea').textContent = estimatedArea.toFixed(4);
                document.getElementById('exactArea').textContent = exactArea.toFixed(4);
                document.getElementById('error').textContent = error.toFixed(2) + '%';
            }
            
            runButton.addEventListener('click', runSimulation);
            clearButton.addEventListener('click', redrawCanvas);
            
            // 初始運行一次
            runSimulation();
        });
    </script>
</body>
</html>
