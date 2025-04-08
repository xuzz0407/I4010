## HTML

- **Hyper Text Markup Language**
- 由 **SGML** (Standard Generalized Markup Language) 簡化而來
- 運用 **標籤 (Tag)** 來說明欲展現的資料內容
- 原始定義較為簡單，但缺乏動態展現能力，因此後來加入一些元素後，變成 **DHTML (Dynamic HTML)**
- 這幾年又加入更多 c**動態元素**，形成所謂的 **HTML5**

---

## Structure

```html=
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//E
N" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
… (header 內容 )
</head>
<body>
… ( 本文內容 )
</body>
</html>
```

> 註：第一行 <!DOCTYPE> 是用在語法提示與驗證用，其他用法可參考 wiki doctype

### Head Elements

- Meta 數據 (Meta Data)
  - **用途**：用於指定文件的附加元數據，例如作者、發布日期、過期日期、頁面描述、關鍵字等
  - **範例**：
  ```html=
  <meta HTTP-EQUIV="Content-Type" content="text/html; charset=utf8">
  <meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
  ```
- 連結其他文件 (Specifies Links to Other Documents)
  - **用途**：用於連結外部資源，例如樣式表 (CSS)
  - **範例**：
  ```html=
  <link rel="stylesheet" title="CSSstyle"href=“http://140.129.6.180/i4010.css" type="text/css" />
  ```
- 標題 (Title) `<title></title>`
  - **用途**：定義文件的標題，在每個 HTML 和 XHTML 文件中為必須元素
  - **範例**：
  ```html=
  <title> 網頁程式設計與安全實務 </title>
  ```
- 樣式 (Style) `<style></style>`
  - **用途**：為文件指定 CSS 樣式，通常以 `<style>` 標籤形式呈現。
  - **範例**：
  ```html=
  <style type="text/css">
      body { font-family: 新細明體, arial; font-size: 12pt; color: #000000; }
      a:active { color: #FF0000; text-decoration: none; }
      a:link { color: #0000FF; text-decoration: none; }
      a:visited {  color: #0000FF; text-decoration: none; }
      a:hover { color: #FF0000; text-decoration: none;  }
  </style>
  ```

### Body Elements

- 區塊元素 (Block Elements)
  - 段落標籤 `<p> </p>`
    - 創建一個段落，可能是最常用的區塊級元素
  - 標題標籤 `<h1>` 至 `<h6>`
    - 定義不同層級的章節標題
      - `<h1>` 表示最高層級標題`<h2>` 表示次層級（子章節），依此類推至 `<h6>`
    - e.g. `<h1> </h1>`
  - 居中標籤 （已棄用） `<center> </center>`
    - 創建一個居中對齊的區塊級元素。（注意：此標籤已棄用，建議使用 CSS 替代）
  - 區塊標籤 `<div> </div>`
    - 創建一個區塊級的邏輯分區
- 列表元素 (Lists)
  - 有序列表 (order list) `<ol> </ol>`
    - 創建一個有序（編號）列表，預設使用阿拉伯數字編號
  - 無序列表 (unorder list) `<ul> </ul>`
    - 創建一個無序（項目符號）列表，預設項目符號為圓點 (disc)
  - 列表項目 (list) `<li> </li>`
    - 定義有序列表 (`<ol>`) 或無序列表 (`<ul>`) 中的單個列表項目
  - **範例**:
  ```html=
  <ol type="A">
      <li>Item 1</li>
      <li>Item 2</li>
  </ol>
  ```
- 錨點元素 (Anchor) `<a> </a>`
  - 錨點元素用於將某段文字連結到網頁中的某個 URL，供網頁設計者使用
  - 使用者在瀏覽器中查看網頁時，可以點擊文字啟動連結，訪問連結中的 URL 所指向的頁面
  - 在 HTML 中，錨點可以作為超連結的起點或終點（目標）
  - 透過 `href` 屬性，錨點可以成為指向文件其他部分或外部資源（例如網頁）的超連結
  - `title` 屬性可用於提供連結的簡要資訊
  - **範例**：
  ```html
  <a href="index.html" title="點選進入網頁設計網站首頁">首頁</a>
  ```
- 表現元素 (Presentation)
  - 粗體標籤 `<b> </b>`
    - 將文字設為粗體，僅影響視覺呈現，適用於瀏覽器顯示
    - 不鼓勵使用此標籤，建議改用樣式表 (CSS) 來實現相同效果
    - 對應的 CSS 屬性為：`{font-weight: bold}`
  - 語義粗體標籤 `<strong> </strong>`
    - 在視覺瀏覽器中通常與 `<b>` 有相同效果（顯示為粗體），但具有更強的語義含義，表示強調
  - 斜體標籤 `<i> </i>`
    - 將文字設為斜體，僅影響視覺呈現，適用於瀏覽器顯示
    - 對應的 CSS 屬性為：`{font-style: italic}`
    - `<em>...</em>` 通常與 `<i>` 在視覺瀏覽器中有相同效果，但具有更強的語義含義，表示強調
  - 下劃線標籤 `<u></u>`
    - 為文字添加下劃線，僅影響視覺呈現
    - 對應的 CSS 屬性為：`{text-decoration: underline}`
  - 縮小字體標籤 `<small></small>`
    - 減小文字的字體大小（顯示為較小字體）
    - 對應的 CSS 屬性為：`{font-size: smaller}`
  - 放大字體標籤 `<big></big>`
    - 增大文字的字體大小（顯示為較大字體）
    - 對應的 CSS 屬性為：`{font-size: larger}`
  - 刪除線標籤 `<s></s>` 或 `<strike></strike>`
    - 為文字添加刪除線（顯示為橫線穿過文字）
    - 對應的 CSS 屬性為：`{text-decoration: line-through}`
- 字體元素 (Font) `<font> </font>`
  - **用途**：
    - 通過 `color` 屬性指定文字顏色，`face` 屬性指定字體類型，`size` 屬性指定文字的絕對或相對大小
    - `<font>[color=color] [size=size] [face=face]</font>`
    - 範例：
      - `<font color="green">text</font>`：將文字設為綠色
      - `<font color="#114499">text</font>`：將文字設為十六進位顏色`#114499`
      - `<font size="4">text</font>`：將文字大小設為 4（大小範圍為 1 到 7，預設為 3，除非在 `<body>` 或其他標籤中另行指定）
      - `<font size="+1">text</font>`：將文字大小設為比標準大 1
      - `<font size="-1">text</font>`：將文字大小設為比標準小 1
      - `<font face="Courier">text</font>`：將文字設為 Courier 字體
  - **對應的 CSS 屬性**：
    - `<font size="N">` → `{font-size: Y units}`
    - `<font color="red">` → `{color: red}`
    - `<font face="Courier">` → `{font-family: "Courier"}`
      - **範例**：
        ```html
        <font color="green">text</font>
        <font size="4">text</font>
        <font face="Courier">text</font>
        ```
- 表格元素 (Tables)
  - 表格標籤 `<table></table>`
    - 定義一個表格。
    - 在 HTML Transitional 中支援多種屬性，但在 HTML Strict 中大多數屬性無效，建議使用樣式表替代
  - 表格行標籤 `<tr></tr>`
    - 定義表格中的一行，包含若干單元格
  - 表格標頭標籤 `<th></th>`
    - 定義表格的標頭單元格，內容通常以粗體和居中顯示
  - 表格數據標籤 `<td></td>`
    - 定義表格的數據單元格
  ![image](https://hackmd.io/_uploads/rJFPLDpTyl.png =75%x)
- 圖片元素 (Img) `<img>`
  - 用於在文件中插入圖片，`src` 屬性指定圖片的 URL，`alt` 屬性（必須）提供圖片無法顯示時的替代文字
  - 可選屬性如 `title` 提供圖片的標題，`width` 指定圖片寬度
  - Example:
  ```html=
  <img src="myphoto.jpg" title="My photo" alt="我的照片" width="200">
  ```
- 表單元素 (Form)
  - 表單標籤 `<form></form>`
    - 創建一個表單，action 屬性（必須）指定表單提交的目標 URL，定義表單的整體行為
    - Example:
    ```html=
     <form action="url">...</form>
    ```
  - 輸入標籤 `<input>`
    - 提供多種標準表單控件，通過 `type` 屬性指定控件類型
    - 輸入類型 (Input Types)：
      - `type="checkbox"`：複選框，可勾選或取消勾選。
      - `type="radio"`：單選按鈕，同一組（相同 `name` 屬性）的單選按鈕只能選擇一個
      - `type="button"`：通用按鈕
      - `type="submit"`：提交按鈕
      - `type="image"`：圖片按鈕，圖片 URL 由 `src` 屬性指定
      - `type="reset"`：重置按鈕，將表單恢復為預設值
      - `type="text"`：單行文字輸入框，`size` 屬性指定輸入框的字符寬度，`maxlength` 屬性指定最大字符數（可能大於 `size`）
      - `type="password"`：密碼輸入框，輸入的文字會被遮蓋（顯示為星號或點）
      - `type="file"`：文件選擇欄，用於上傳文件到伺服器
      - `type="hidden"`：隱藏輸入欄，在頁面渲染時不可見
    - Example:
    ```html=
    <input type="text" size="20" maxlength="50">
    <input type="checkbox">
    <input type="submit">
    ```
