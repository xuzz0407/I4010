<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT">
    <meta http-equiv="pragma" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.6">
    <title>網頁程式設計與安全實務：九九乘法表</title>
    <style type="text/css">
        body {font-family: Microsoft JhengHei, arial; font-size: 20px; color: #000000;}
        th {font-family: Microsoft JhengHei, arial; font-size: 20px;}
        td {font-family: Microsoft JhengHei, arial; font-size: 20px;}
        select {font-family: Microsoft JhengHei, arial; font-size: 18px;}
        table {border-collapse: collapse; margin: 20px auto;}
        td {padding: 5px 10px; border: 1px solid #ddd;}
    </style>
</head>
<body>
<div style="width:800px; margin:20px auto; text-align:center;">
    <div style="margin:10px; font-size:2em;">九九乘法表</div>
    <form method="POST" action="">
        乘數：
        <select name="Num" id="multiplier" onchange="updateTable();">
            <option value="1" selected>1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
        </select> 
    </form>
    <table width="320" align="center" id="multiplication-table">
        <tr align="center">
            <td>1</td>
            <td>*</td>
            <td>1</td>
            <td>=</td>
            <td>1</td>
        </tr>
        <tr align="center">
            <td>1</td>
            <td>*</td>
            <td>2</td>
            <td>=</td>
            <td>2</td>
        </tr>
        <tr align="center">
            <td>1</td>
            <td>*</td>
            <td>3</td>
            <td>=</td>
            <td>3</td>
        </tr>
        <tr align="center">
            <td>1</td>
            <td>*</td>
            <td>4</td>
            <td>=</td>
            <td>4</td>
        </tr>
        <tr align="center">
            <td>1</td>
            <td>*</td>
            <td>5</td>
            <td>=</td>
            <td>5</td>
        </tr>
        <tr align="center">
            <td>1</td>
            <td>*</td>
            <td>6</td>
            <td>=</td>
            <td>6</td>
        </tr>
        <tr align="center">
            <td>1</td>
            <td>*</td>
            <td>7</td>
            <td>=</td>
            <td>7</td>
        </tr>
        <tr align="center">
            <td>1</td>
            <td>*</td>
            <td>8</td>
            <td>=</td>
            <td>8</td>
        </tr>
        <tr align="center">
            <td>1</td>
            <td>*</td>
            <td>9</td>
            <td>=</td>
            <td>9</td>
        </tr>
    </table>
    <a href="index.php">回首頁</a>
</div>

<script>
    function updateTable() {
        
        const multiplier = parseInt(document.getElementById('multiplier').value);
        const table = document.getElementById('multiplication-table');

        table.innerHTML = '';

        for (let i = 1; i <= 9; i++) {
            const result = multiplier * i;
            const row = document.createElement('tr');
            row.setAttribute('align', 'center');
            row.innerHTML = `
                <td>${multiplier}</td>
                <td>*</td>
                <td>${i}</td>
                <td>=</td>
                <td>${result}</td>
            `;
            table.appendChild(row);
        }
    }

    window.onload = updateTable;
</script>
</body>
</html>