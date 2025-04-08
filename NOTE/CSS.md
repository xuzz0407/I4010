# CSS

- 讓網頁能有整體性排版展現
- 將樣式與文本分開
- 可以設定相對位置與絕對位置版面設定

---

## 沿革

- 1996 年 World Wide Web Consortium (W3C) 發佈 CSS1 規格
- 1998 年 5 月發佈 CSS2 規格
- 2011 年 7 月發佈 CSS2.1 規格
- CSS3 則依各屬性分別規劃與發佈

![image](https://hackmd.io/_uploads/Hk7UpcaTyl.png =80%x)

---

## CSS 加入方式

- 在 Tag 中加入
  - `<div style="...">`
- 在文件中加入 ( 原則上在 head 區域 )
  - `<style>...</style>`
- 引入外部 css 檔案
  - `<link rel="stylesheet" . . . type="text/css" />`

### 在 Tag 中加入 CSS

- Example

  - `<p style="font-size:16px;color:red">Text</p>`
  - `<div style="margin:3px;">`
  - `<div style="margin:6px 3px;">`
  - `<div style="margin:6px 5px 6px;">`
  - `<div style="margin:6px 4px 3px 12px;">`
  - `<div style="margin:6px auto;">`

- about margin (外間距)
  - margin: 上 右 下 左
    - 只列一個時，四面都用
    - 只列兩個時，第一個為上與下，第二個為左與右
    - 只列三個時，第一個為上，第二個為左與右，第三個為下

### 在文件中加入 `<style>`

- Example

```html=
<style type="text/css">
    body {font-family: 新細明體 , arial; font-size: 12pt; color: #000000}
    a:active{color:#FF0000; text-decoration: none}
    a:link{color:#0000FF; text-decoration: none}
    a:visited{color:#0000FF; text-decoration: none}
    a:hover{color:#FF0000; text-decoration: none}
    table.mistab { border-width: 1px; border-style: outset; border-color: #330066; border-collapse: collapse; }
    table.mistab th { border-width: 1px; padding: 2px; border-style: inset; border-color: #330066; }
    table.mistab td { border-width: 1px; padding: 2px; border-style: inset; border-color: #330066; }
    #footer { padding: 2px;font-size: 1em;text-align: center;margin-left: 0px; margin-right: 0px;margin-top: 12px; color: Purple; background: #F0D2AA; }
</style>
```

### 引進外部 css 檔案

- 同一個 Page **可以引進多個外部 css 檔案**，**屬性前後衝突** 時，`使用後面的設定`，檔案中只能有 css 語法，不能有 HTML 語法
- 可以是在同一台 Server 上，也可以引進其他伺服器上的檔案或是透過 CDN 取得
  - e.g. Bootstrap
- 如果走 https ，則外部伺服器逐漸限制要走 https

---

## CSS 語法

### 類選擇器 (Class Selector)

- **用途**：
  - 選擇單一類別的元素，例如 `p`、`div`、`b` 等。
  - `class`：以類別名稱為基礎，可以是其他類別的子類別。
  - `id`：以井號開頭，原則上一個 `id` 在文件中僅能使用一次，因為 JavaScript 會透過 `id` 標記文件中的元素。
- **範例**：

```css=
/* 選擇所有 p 元素的類別 */
  p {
      color: blue;
  }

  /* 選擇 class 為 "highlight" 的元素 */
  .highlight {
      background-color: yellow;
  }

  /* 選擇 id 為 "unique" 的元素 */
  #unique {
      font-size: 20px;
  }
```

### 常用屬性 (Attributes)

- 屬性列表：
  - `color`：設置文字顏色。
  - `display`：控制元素的顯示方式（例如 block、inline、none）。
  - `font-size`：設置字體大小。
  - `font-weight`：設置字體粗細（例如 bold）。
  - `margin`：設置外邊距。
  - `padding`：設置內邊距。
  - `width`：設置元素寬度
- Example:

```css=
.example {
    color: red;
    display: block;
    font-size: 16px;
    font-weight: bold;
    margin: 10px;
    padding: 5px;
    width: 200px;
}
```
