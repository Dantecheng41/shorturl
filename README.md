# Note

## Day1

- PHP / Laravel 基本認識 （對應 RoR 加速理解
  - Composer
    - 套件管理，類似 RubyGems
  - Laravel
    - 後端框架，架構同 MVC
- 安裝
  - Composer
  - Laravel
  - PHP
- 學習本地開發方式
  - Laravel 架構大致理解對照 Rails
  - 試著理解打通印出 Hello World
  - 掃過各資料夾設定

## Day2

- 確認需求
  - Acceptance Criteria (以 Gherkin format 描述)：
  - user 為 test 的角色進行，需要於 http request 內提供相對應之驗證資訊
    - 可產生短網址
      - Given: 無
      - When: call GET /shorturl?url=<https://www.google.com>
      - Then: 得到 response 200
      - and Then: 得到 payload 為 <https://localhost/JKFIUMSDF> ((因不需部屬上線，故前方為 localhost， 後方為短網址編碼
    - 短網址可連到正確的網址
      - Given: 一串已經產生好的短網址 for google 首頁，假設為 <https://localhost/JKFIUMSDF>
      - When: 瀏覽器開啟 <https://localhost/JKFIUMSDF>
      - Then: response 302
      - and Then: 瀏覽器會轉導到 <www.google.com>
    - 重複輸入的短網址，需要產生出相同的結果
      - Given: 已經針對 <www.google.com> 產生一組短網址，其 url 是 <https://localhost/JKFIUMSDF>
      - When: call GET /shorturl?url=<https://www.google.com>
      - Then: 得到 response 200
      - and Then: 得到 payload 為 <https://localhost/JKFIUMSDF>
- 規劃實作 Restful API
  - 讀 Laravel v11 的官方文件
  - Routes 實作
  - Controller 設計
    - 確認 Laravel 慣例
    - 考慮封裝
  - 功能
    - 短網址生成
        1. 轉換編碼
        2. Database 規劃 I/O對應
        3. Unique
        4. 200
        5. 驗證
    - 實作短網址轉址 Route
        1. 轉址
        2. 302
- 學習慣例以及開發方式

## Day3

- 確認 Route api.php 的相關資訊
  - 會有 /api 路徑段，放棄使用
- 細節實作
  - [x] Service
    - 互相轉換的行為跟 Cache 包裝
  - [x] Cache
    - 讀取有打 Cache
  - [x] Validation
    - 驗 URL 格式
  - Error Handle
    - 暫時沒有 Error 問題

## Day4

- 需求確認，重新審視
- 效能調整
  - Index
    - 有打在 `short_path` 上
- 重新確認設定合理性(提醒)
  - 為何這樣設計
  - 為何這樣設定
  - 優缺取捨
  - 有什麼考慮/想法
