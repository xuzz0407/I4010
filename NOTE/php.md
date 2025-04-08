# PHP 簡介

## PHP 輸出指令

- `echo`: 有無 () 皆可，**輸出變數或是運算內容**
- `print`: 有無 () 皆可，**輸出變數或是運算內容**
- `var_dump()`: **輸出變數型態與內容**
- `print_r()`: **輸出變數陣列內容**

> 註： echo 與 print 功能大致相同，差別有
>
> - echo 沒有回傳值， print 有回傳值 (1)
> - echo 可以有好幾個參數 ( 以逗號分開 )
>   e.g: `echo "This ", "string ", "was ", "made ", "with multiple parameters.";`

## PHP 註解

- 單行式註解
  - //
  - #
- 多行式註解
  - /_ ... _/

## PHP 變數

### 變數的基本概念

- **用途**：
  - 變數是用來儲存資訊的 `容器` (containers)

### PHP 變數規則 (Rules for PHP Variables)

- **規則**：
  - 變數以 `$` 符號開頭，後接變數名稱
  - 變數名稱必須以字母或底線 `_` 開頭
  - 變數名稱不能以數字開頭
  - 變數名稱只能包含字母、數字和底線（A-Z、0-9 和 `_`）
  - 變數名稱對大小寫敏感（例如 `$age` 和 `$AGE` 是兩個不同的變數）
- **範例**：
  ```php
  $name = "John"; // 正確
  $age_2 = 25;    // 正確
  $2age = 30;     // 錯誤：以數字開頭
  $user-name = "Jane"; // 錯誤：包含非法字符 "-"
  ```

## PHP 變數型態

### PHP 是弱類型語言 (Loosely Typed Language)

- **特性**：
  - 不需要明確指定變數的數據類型，PHP 會根據變數的值自動推斷其數據類型
- **範例**：
  ```php
  $variable = 42;      // 自動推斷為整數 (integer)
  $variable = "Hello"; // 自動推斷為字符串 (string)
  ```

### PHP 7 中的類型聲明 (Type Declarations in PHP 7)

- 特性：
  - PHP 7 引入了類型聲明，允許在函數聲明時指定預期的數據類型
  - 通過啟用嚴格模式 (strict mode)，如果數據類型不匹配，PHP 會拋出 "Fatal Error"

---

## PHP 數據類型 (Data Types)

### 數據類型概述

- **特性**：
  - 變數可以儲存不同類型的數據，不同的數據類型可以執行不同的操作

### PHP 支援的數據類型

- **類型列表**：
  - `String`：字符串，例如 `"Hello"`。
  - `Integer`：整數，例如 `42`。
  - `Float`：浮點數（也稱為 `double`），例如 `3.14`。
  - `Boolean`：布林值，例如 `true` 或 `false`。
  - `Array`：數組，例如 `["apple", "banana"]`。
  - `Object`：對象，例如類的實例。
  - `NULL`：空值，表示變數無值。
  - `Resource`：資源類型，通常用於外部資源（如數據庫連接）。
- **範例**：
  ```php
  $string = "Hello, World!"; // 字符串
  $integer = 100;            // 整數
  $float = 12.34;            // 浮點數
  $boolean = true;           // 布林值
  $array = [1, 2, 3];       // 數組
  $object = new stdClass();  // 對象
  $null = null;              // 空值
  // 資源類型範例（例如數據庫連接）
  $resource = fopen("example.txt", "r");
  ```

### String 相關常用函式

- `strlen()`, `mb_strlen()`: 字串長度
- `str_word_count()`: 計算字串中字 (word) 個數
- `strrev()`: 將字串內容倒過來
- `strpos()`: 在字串中搜尋所給的文字
- `str_replace()`: 字串中的字以所給的文字替代

---

## PHP 運算符 (Operators)

### 運算符類型

- **類型列表**：
  - 算術運算 (Arithmetic operators)
  - 賦值運算 (Assignment operators)
  - 比較運算 (Comparison operators)
  - 增量/減量運算 (Increment/Decrement operators)
  - 邏輯運算 (Logical operators)
  - 字串運算 (String operators)
  - 陣列運算 (Array operators)
  - 條件賦值運算 (Conditional assignment operators)

### 範例

- 四則與指數運算
  ![image](https://hackmd.io/_uploads/rJcOHopTyl.png)
- 指定運算
  ![image](https://hackmd.io/_uploads/HyYtHsT6Jl.png)
- 比較運算
  ![image](https://hackmd.io/_uploads/r1ehBipa1g.png)
- 增量/減量運算
  ![image](https://hackmd.io/_uploads/r1S0Bi6Tyx.png)
- 邏輯運算
  ![image](https://hackmd.io/_uploads/HkO1Uj6ayl.png)
- 字串運算
  ![image](https://hackmd.io/_uploads/B1eG8jpa1l.png)
- 陣列運算
  ![image](https://hackmd.io/_uploads/HJif8iaT1x.png)
- 條件賦值運算
  ![image](https://hackmd.io/_uploads/HkKmIip6Jl.png)

## PHP 常數

### 常數的基本概念

- **特性**：
  - 常數類似變數，但一旦定義，其值不能被更改或取消定義
  - 常數是一個簡單值的標識符（名稱），在腳本執行期間其值不可更改
  - 有效的常數名稱必須以字母或底線開頭（名稱前無 `$` 符號）
  - 與變數不同，常數在整個腳本中自動具有全局作用域。

### 定義常數

- **方法**：
  - 使用 `define()` 函數來定義常數
- **語法**：
  - `define(name, value, case-insensitive)`
    - `name`：指定常數的名稱
    - `value`：指定常數的值
    - `case-insensitive`：指定常數名稱是否對大小寫敏感，預設為 `false`（大小寫敏感）
- **範例**：
  ```php=
  <?php
      define("GREETING", "Welcome to I4010!"); // 定義常數 GREETING
      echo GREETING;                           // 輸出 "Welcome to I4010!"
  ?>
  ```

### 常數數組 (Constant Array)

- 特性：
  - 在 PHP 7 中，可以使用 define() 函數定義常數數組
- **範例**：
  ```php=
  <?php
  define("CARS", [
        "Alfa Romeo",
        "BMW",
        "Toyota"
  ]);
  echo CARS[0]; // 輸出 "Alfa Romeo"
  ?>
  ```

## PHP 條件表示式

### 條件語句概述

- **用途**：
  - 根據不同條件執行不同的動作

### PHP 中的條件語句類型

- **類型列表**：
  - `if` 語句：如果某個條件為真，則執行某段代碼
  - `if...else` 語句：如果條件為真，執行一段代碼；如果條件為假，執行另一段代碼
  - `if...elseif...else` 語句：處理多於兩個條件的不同代碼執行
  - `switch` 語句：從多個代碼塊中選擇一個執行。

## PHP 陣列

### 陣列的基本概念

- **特性**：
  - 陣列可以在單一變數中儲存多個值
  - 陣列的索引從 0 開始
- **範例**：
  ```php=
  $fruit = array("Apple", "Banana", "Orange");
  echo $fruit[0]; // 輸出 "Apple"
  ```

### PHP 中的陣列類型

- 類型列表：
  - 索引陣列 (Indexed arrays)：使用數字索引的陣列
  - 關聯陣列 (Associative arrays)：使用命名鍵的陣列
  - 多維陣列 (Multidimensional arrays)：包含一個或多個子陣列的陣列。

### 陣列元素計數

- 方法：
  - 使用 `count()` 函數獲取陣列中的元素數量
- 範例：
  ```php=
  $fruit = array("Apple", "Banana", "Orange");
  echo count($fruit); // 輸出 3
  ```

## 關聯陣列 (Associative Arrays)

### 關聯陣列的定義

- 特性：
  - 關聯陣列使用自定義的命名鍵來存取值
  - 有兩種方式創建關聯陣列：
    - 使用 `array()` 函數直接指定鍵值對
    - 使用陣列索引方式逐一賦值
- 範例：

  ```php=
  // 方法 1：使用 array() 函數
  $age = array("Peter" => 35, "Ben" => 37, "Joe" => 43);
  echo $age["Peter"]; // 輸出 35

  // 方法 2：逐一賦值
  $age["Peter"] = 35;
  $age["Ben"] = 37;
  $age["Joe"] = 43;
  echo $age["Ben"]; // 輸出 37
  ```

### 關聯數組的使用場景

- 在很多 PHP 應用中，會從資料庫中取出資料並存入關聯陣列。
- 索引值為欄位名稱，則基本不需要對結構做改變，只需要欄位名稱。
- 結構完成後，困難程序困難，需要在資料表上插入一個欄位，以數字做索引基本需要更改整個程序，但以欄位名稱為索引則不需要更改

---

## PHP 日期與時間 (Date and Time)

### 日期與時間概述

- **用途**：
  - 日期與時間函數允許從運行 PHP 腳本的伺服器獲取日期和時間，並可以用來格式化日期和時間
- **注意事項**：
  - 這些函數依賴於伺服器的本地設置
  - 使用時需考慮日光節約時間和閏年
- **時區設置**：
  - 在 `php.ini` 中設置，或在程式碼中動態設置時區，例如 `date.timezone`
  - 範例：設置時區為 "Asia/Taipei"
  ```php=
  date_default_timezone_set("Asia/Taipei");
  ```

### 常用日期與時間函數

- 常用函數：
  - `date("Y-m-d H:i:s")`：返回格式化的當前日期和時間
  - `date("Y-m-d", strtotime("+7 days"))`：返回 7 天後的日期

---

## PHP 與 HTML 混合 (PHP with HTML)

- 混合使用概述
- 特性：
  - PHP 文件的副檔名通常為 `.php`
  - PHP 代碼使用 `<?php ?>` 標記嵌入 HTML 中
