<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT">
    <meta http-equiv="pragma" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.6">
    <title>網頁程式設計與安全實務：四則運算</title>
    <style type="text/css">
        body {font-family: Microsoft JhengHei, arial; font-size: 1.8em; color: #000000;}
        input {font-family: Microsoft JhengHei, arial; font-size: 1em;}
        th {font-family: Microsoft JhengHei, arial; font-size: 1.8em;}
        td {font-family: Microsoft JhengHei, arial; font-size: 1.8em;}
        select {font-family: Microsoft JhengHei, arial; font-size: 1em;}
    </style>
</head>
<body>
<div style="width:800px; margin:20px auto; text-align:center;">
    <div style="margin:10px; font-size:2em;">四則運算</div>
    <form method="POST" action="" onsubmit="return calculate(event)">
        <div style="margin:6px;">
            數字1：<input type="text" name="Num1" value="" size="5" id="num1" />
        </div>
        <div style="margin:6px;">
            數字2：<input type="text" name="Num2" value="" size="5" id="num2" />
        </div>
        <div style="margin:6px;">
            <input type="submit" name="Calculate" value="計算" size="5" />
        </div>
    </form>
    <div id="result" style="margin:10px;">
        請輸入數字進行計算
    </div>
    <a href="index.php">回首頁</a>
</div>

<script>
    function calculate(event) {
        event.preventDefault(); 

        const num1 = parseFloat(document.getElementById('num1').value) || 0;
        const num2 = parseFloat(document.getElementById('num2').value) || 0;
        const resultDiv = document.getElementById('result');

        const add = num1 + num2;
        const subtract = num1 - num2;
        const multiply = num1 * num2;
        const divideMessage = num2 !== 0 ? `${num1} ÷ ${num2} = ${num1 / num2}` : '無法除以 0';

        resultDiv.innerHTML = `
            <div>加法: ${num1} + ${num2} = ${add}</div>
            <div>減法: ${num1} - ${num2} = ${subtract}</div>
            <div>乘法: ${num1} × ${num2} = ${multiply}</div>
            <div>除法: ${divideMessage}</div>
        `;
    }
</script>
</body>
</html>