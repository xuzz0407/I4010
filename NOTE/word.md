# 名詞解釋

## K8S

- **全名**：Kubernetes（簡稱 K8S，"K" 和 "S" 之間有 8 個字母，因此簡寫為 K8S）。
- **解釋**：
  Kubernetes 是一個開源的容器編排平台，用於自動化部署、擴展和管理容器化應用程式。它最初由 Google 開發，後於 2014 年開源，現由 Cloud Native Computing Foundation (CNCF) 維護。K8S 提供了一個強大的框架來管理容器集群，包括負載平衡、自動擴縮容、服務發現、自我修復等功能。
- **常見用途**：
  - 管理 Docker 容器集群。
  - 實現微服務架構的高可用性和可擴展性。
- **範例**：
  使用 K8S 部署一個應用程式，可以通過 YAML 文件定義 Pod、Service 和 Deployment，例如：
  ```yaml
  apiVersion: v1
  kind: Pod
  metadata:
    name: example-pod
  spec:
    containers:
      - name: nginx
        image: nginx:latest
  ```

## i18n

- **全名**：Internationalization（國際化，"i" 和 "n" 之間有 18 個字母，因此簡寫為 i18n）。
- **解釋**：  
  i18n 是指在軟體開發中設計應用程式，使其能夠適應不同的語言和地區，而無需進行重大修改。國際化的目標是讓應用程式支持多語言、多文化環境，例如不同的日期格式、貨幣符號、文字方向等。
- **常見做法**：
  - 使用語言文件（如 JSON 或 PO 文件）儲存翻譯內容。
  - 避免硬編碼文字，使用變數或鍵值對來動態載入語言。
- **範例**：  
  在 PHP 中使用 `gettext` 實現 i18n：

  ```php
  // 設置語言
  putenv("LANG=zh_TW");
  setlocale(LC_ALL, "zh_TW");
  bindtextdomain("messages", "./locale");
  textdomain("messages");

  // 輸出翻譯後的文字
  echo _("Hello, World!"); // 假設 zh_TW 翻譯為 "你好，世界！"
  ```

## CDN

- **全名**：Content Delivery Network（內容分發網絡）。
- **解釋**：  
  CDN 是一組分佈在全球各地的伺服器網絡，用於加速網頁內容的傳輸。它通過將靜態資源（如圖片、CSS、JavaScript 文件）緩存到離用戶較近的節點，減少延遲並提升載入速度。CDN 還能減輕原始伺服器的負載，提高網站的可用性和性能。
- **常見提供商**：
  - Cloudflare、Akamai、Amazon CloudFront。
- **範例**：  
  使用 CDN 載入 jQuery：
  ```html
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  ```

## RWD

- **全名**：Responsive Web Design（響應式網頁設計）。
- **解釋**：  
  RWD 是一種網頁設計方法，旨在讓網頁在不同設備和螢幕尺寸（如手機、平板、桌面電腦）上都能提供良好的用戶體驗。通過使用流體網格、靈活圖片和 CSS 媒體查詢，RWD 確保網頁佈局能夠根據設備特性動態調整。
- **核心技術**：
  - CSS 媒體查詢（Media Queries）。
  - 百分比單位（如 `vw`、`vh`、`%`）。
- **範例**：  
  使用 CSS 媒體查詢實現響應式設計：

  ```css
  /* 預設樣式 */
  .container {
    width: 100%;
  }

  /* 螢幕寬度小於 600px 時 */
  @media (max-width: 600px) {
    .container {
      background-color: lightblue;
    }
  }
  ```

## PHP `substr`

- **全名**：Substring（子字串）。
- **解釋**：  
  `substr()` 是 PHP 中的一個內建函數，用於從字串中提取指定長度的子字串。它可以指定起始位置和長度來截取字串的一部分。如果不指定長度，則會提取從起始位置到字串末尾的部分。
- **語法**：
  - `string substr(string $string, int $start [, int $length])`
    - `$string`：要處理的字串。
    - `$start`：起始位置（從 0 開始，若為負數則從字串末尾計算）。
    - `$length`：要提取的長度（可選，若省略則提取到字串末尾；若為負數則表示從末尾減去的字符數）。
- **範例**：
  ```php
  $string = "Hello, World!";
  echo substr($string, 0, 5);  // 輸出 "Hello"
  echo substr($string, 7);     // 輸出 "World!"
  echo substr($string, -6, 5); // 輸出 "World"
  ```

## `align="center"`

- **解釋**：  
  `align="center"` 是一個 HTML 屬性，用於指定元素的水平對齊方式為居中。它通常用於 `<div>`、`<p>`、`<table>` 等元素，但該屬性在 HTML5 中已被棄用，建議使用 CSS 來實現對齊效果。
- **替代方法**：  
  使用 CSS 的 `text-align` 或 `margin` 屬性來實現居中效果。
- **範例**：
  - 棄用的 HTML 寫法：
    ```html
    <div align="center">這是居中的文字</div>
    ```
  - 推薦的 CSS 寫法：
    ```html
    <div style="text-align: center;">這是居中的文字</div>
    ```
    或
    ```css=
    div {
    margin: 0 auto;
    width: 200px; /* 需指定寬度才能水平居中 */
    }
    ```
