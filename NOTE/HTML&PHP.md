# PHP & HTML form

## 表單語法 (Form Syntax) `<form> </form>`

### 表單元素 `<form>`

- **屬性**：
  - `method`：指定表單提交的方式，例如 `"POST"` 或 `"GET"`
  - `name`：表單的名稱，例如 `"FormName"`
  - `action`：表單提交的目標 URL，例如 `"scriptname"`
    - 如果有指定 Scriptname ，在按下在按下 Submit 按鈕時會將網頁轉到所指定的 ScriptName
    - 如果沒有指定，在按下則導向產生此網頁的程式
- **範例**：
  ```html=
  <form method="POST" name="FormName" action="scriptname">
  ```

### 輸入元素 `<input>`

- 屬性：
  - `type`：指定輸入類型
    - 例如 `"text"`、`"password"`、`"radio"`、`"checkbox"`、`"submit"` 等。
  - `name`：輸入欄位的名稱
    - 例如 `"ID"`、`"PWD"`、`"TypeCode"`、`"Fruit"`、`"Confirm"` 等。
  - `value`：輸入欄位的值
    - 例如 `<?php echo $ID ?>` 或固定值 `"0"`、`"1"`、`"Orange"`、`"確認"` 等。
  - `size`：輸入欄位的可見字符寬度
    - 例如 `"10"`
  - `maxlength`：輸入欄位的最大字符
    - 例如 `"20"`
  - `checked`：用於 `radio` 或 `checkbox`，表示預設選中
- 範例：

```html=
<!-- 文字輸入框 -->
<input type="text" name="ID" value="<?php echo $ID ?>" size="10" maxlength="20">

<!-- 密碼輸入框 -->
<input type="password" name="PWD" value="" size="10" maxlength="20">

<!-- 單選按鈕 -->
<input type="radio" name="TypeCode" value="0"> 選
<input type="radio" name="TypeCode" value="1" checked> 選

<!-- 複選框 -->
<input type="checkbox" name="Fruit" value="Orange"> 橘子

<!-- 提交按鈕 -->
<input type="submit" name="Confirm" value="確認">
```

### 選擇元素 `<select>` 與 `<option>`

- 屬性：
  - `name`：選擇框的名稱，例如 `"Sel"`
  - `onchange`：當選擇改變時觸發的事件，例如 `"submit();"`
  - `value`（在 `<option>` 中）：選項的值，例如 `"1"`、`"2"` 等
- 範例：

```html=
<select name="Sel" onchange="submit();">
    <option value="1">月</option>
    <option value="2">月</option>
</select>
```

---

## HTML `<form>` 元素包含的子元素 (Form Child Elements)

### 概述

- **特性**：
  - HTML `<form>` 元素可以包含一個或多個以下表單相關的子元素

### 子元素列表

- **子元素**：
  - `<input>`：輸入欄位
  - `<label>`：輸入欄位的說明標籤
  - `<select>`：下拉式選單
  - `<textarea>`：文字輸入區域
  - `<button>`：按鈕
  - `<fieldset>`：框出特定區域域
  - `<legend>`：框的說明文字（須設點示框框的左上角）
  - `<datalist>`：提供 `input type="text"` 的預設選擇項目
  - `<output>`：簡單運算結果表單輸出
  - `<option>`：`<select>` 的選項
  - `<optgroup>`：`<select>` 選項內顯示分組。

### optgroup 範例

```html=
<form action="/action_page.php">
    <label for="cars">Choose a car:</label>
    <select name="cars" id="cars">
        <optgroup label="Swedish Cars">
            <option value="volvo">Volvo</option>
            <option value="saab">Saab</option>
        </optgroup>
        <optgroup label="German Cars">
            <option value="mercedes">Mercedes</option>
            <option value="audi">Audi</option>
        </optgroup>
    </select>
    <br><br>
    <input type="submit" value="Submit">
</form>
```

---

以下是根據最新圖片整理的筆記，延續之前的「表單與其相關元素的語法」筆記，新增「HTML <input> 類型與限制屬性」部分，使用 Markdown 格式輸出：

markdown

Collapse

Wrap

Copy

## HTML `<input>` 類型與限制屬性 (Input Types and Constraints)

### `<input>` 類型 (Input Types)

- **類型列表**：

  - `button`：定義一個按鈕。
  - `checkbox`：定義一個複選框。
  - `color`：用於選擇顏色的輸入欄位。
  - `date`：用於選擇日期的輸入欄位（可使用 `min` 和 `max` 限制日期範圍）。
  - `datetime-local`：用於選擇日期和時間的輸入欄位（不含時區）。
  - `email`：用於輸入電子郵件地址的欄位。
  - `file`：定義文件選擇欄位和「瀏覽」按鈕，用於文件上傳。
  - `hidden`：定義隱藏的輸入欄位。
  - `image`：定義圖片按鈕。
  - `month`：允許用戶選擇月份和年份。
  - `number`：定義數字輸入欄位。
  - `password`：定義密碼輸入欄位。
  - `radio`：定義單選按鈕。
  - `range`：定義滑塊控制，用於輸入數字（預設範圍 0 到 100，可用 `min`、`max` 和 `step` 設置限制）。
  - `reset`：定義重置按鈕，將表單值重置為預設值。
  - `search`：用於搜尋欄位（行為類似普通文字欄位）。
  - `submit`：定義提交按鈕，用於提交表單數據到處理程序。
  - `tel`：用於輸入電話號碼的欄位。
  - `text`：定義單行文字輸入欄位（此為 `input type` 預設值）。
  - `time`：允許用戶選擇時間（不含時區）。
  - `url`：用於輸入 URL 地址的欄位。
  - `week`：允許用戶選擇週和年份。

- **範例**：

  ```html=
  <!-- 文字輸入 -->
  <input type="text" name="username">

  <!-- 密碼輸入 -->
  <input type="password" name="password">

  <!-- 提交按鈕 -->
  <input type="submit" value="提交">

  <!-- 重置按鈕 -->
  <input type="reset" value="重置">

  <!-- 單選按鈕 -->
  <input type="radio" name="gender" value="male"> 男
  <input type="radio" name="gender" value="female"> 女

  <!-- 複選框 -->
  <input type="checkbox" name="hobby" value="reading"> 閱讀

  <!-- 按鈕 -->
  <input type="button" value="點擊我">

  <!-- 文件上傳 -->
  <input type="file" name="upload">

  <!-- 顏色選擇 -->
  <input type="color" name="favcolor">

  <!-- 日期選擇 -->
  <input type="date" name="birthday" min="2000-01-01" max="2025-12-31">

  <!-- 日期與時間 -->
  <input type="datetime-local" name="meeting">

  <!-- 電子郵件 -->
  <input type="email" name="email">

  <!-- 月份選擇 -->
  <input type="month" name="birthmonth">

  <!-- 數字輸入 -->
  <input type="number" name="quantity">

  <!-- 滑塊 -->
  <label for="vol">Volume (between 0 and 50):</label>
  <input type="range" id="vol" name="vol" min="0" max="50">

  <!-- 搜尋欄位 -->
  <input type="search" name="search">

  <!-- 電話號碼 -->
  <input type="tel" name="phone">

  <!-- 時間選擇 -->
  <input type="time" name="meeting_time">

  <!-- URL 輸入 -->
  <input type="url" name="website">

  <!-- 週選擇 -->
  <input type="week" name="week">
  ```

### `<input>` 限制條件 (Input Constraints)

- 屬性列表：

  - `checked`：指定輸入欄位在頁面載入時預選中（適用於` type="checkbox"` 或 `type="radio"`）。
  - `disabled`：指定輸入欄位為禁用狀態。
  - `max`：指定輸入欄位的最大值。
  - `maxlength`：指定輸入欄位的最大字符數。
  - `min`：指定輸入欄位的最小值。
  - `pattern`：指定正則表達式，用於檢查輸入值。
  - `readonly`：指定輸入欄位為唯讀（不可更改）。
  - `required`：指定輸入欄位為必填（必須填寫）。
  - `size`：指定輸入欄位的寬度（以字符數為單位）。
  - `step`：指定輸入欄位的合法數字間隔。
  - `value`：指定輸入欄位的預設值。

- **範例**：

```html=
<!-- 預選中的單選按鈕 -->
<input type="radio" name="gender" value="male" checked> 男

<!-- 禁用輸入欄位 -->
<input type="text" name="username" disabled>

<!-- 最大值與最小值 -->
<input type="number" name="quantity" min="1" max="100">

<!-- 最大字符數 -->
<input type="text" name="comment" maxlength="50">

<!-- 正則表達式驗證 -->
<input type="text" name="code" pattern="[A-Za-z]{3}" title="必須為三個字母">

<!-- 唯讀欄位 -->
<input type="text" name="readonly_field" value="不可更改" readonly>

<!-- 必填欄位 -->
<input type="text" name="required_field" required>

<!-- 寬度 -->
<input type="text" name="username" size="20">

<!-- 數字間隔 -->
<input type="number" name="step_example" step="2">

<!-- 預設值 -->
<input type="text" name="default" value="預設值">
```

---

## Form: radio

- Radio 為小圓圈圈選
  - Syntax: `<input type="radio" name="radioname" value="val">`
- 同一個 form 內，在按下若有多個 radio 用同一名稱 (name) ，在按下則最多只有一
  個可以被 check 。
- 回傳的變數名稱為 $\_POST['radioname'] ，在按下值為被點選的那個選項的
  value 所指定的值
- 例
  - <input type="radio" name="TypeCode" value="0"> 零
  - <input type="radio" name="TypeCode" valud="1"> 壹
    - 零被點選，在按下則 $\_POST['TypeCode'] 為 0
    - 壹被點選，在按下則 $\_POST['TypeCode'] 為 1
    - 兩個都未點選，在按下則 $\_POST['TypeCode'] 未定義

---

## Form: checkbox

- Checkbox 為方塊勾選框
  - Syntax: `<input type="checkbox" name="checkname" value="2">`
- 同一個 form 內，在按下若有多個用同一名稱 (name) ，在按下每個都可以被勾選。
- 回傳的變數名稱為 $\_POST['checkname'] ，在按下值為被勾選的那個選項之 value 所指定的值，在按下若有超過一個選項被勾選，在按下則回傳的值為被勾選的選項串聯起來，在按下中間以逗點分開。
- 例
  - <input type="checkbox" name="fruit" value="Orange"> 橘子
  - <input type="checkbox" name="fruit" value="Apple"> 蘋果
    - 兩個都未勾選： $\_POST['fruit'] 未定義
    - 僅橘子被勾選： $\_POST['fruit'] = 'Orange'
    - 僅蘋果被勾選： $\_POST['fruit'] = 'Apple'
    - 兩個都被勾選： $\_POST['fruit'] = 'Orange,Apple'

---

## 下拉式選單

- Syntax:

```html=
<select name="Sel">
<option value="A">Apple</option>
<option value="O" selected>Orange</option>
<option value="T">Tomato</option>
</select>
```

- 只能選一個，在按下回傳的值 $\_POST['Sel'] 為 value 所設定的值
- value 後面有 selected 時，在按下顯示會鎖定在那個選項

---

## PHP 程式取得回傳變數

- `$_POST` ： post method 回傳的 associative 陣列
- `$_GET` ： get method 回傳的 associative 陣列
- `$_REQUEST` ： get 與 post method 所回傳的陣列聯集
- 例：
  - $\_POST['SelMonth']
  - $\_GET['SchYear']
- 快速解開變數陣列：
  - `extract`
  - 例： extract($\_POST, EXTR_OVERWRITE);
