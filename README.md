# Laravel Shopping Cart Demo

### 環境需求（建議本機開發環境）
作業系統：Windows 10

PHP：8.1 或以上（建議使用 XAMPP 控制面板啟動 Apache與資料庫服務）

資料庫管理：使用 XAMPP 內建的 phpMyAdmin

資料庫類型：MariaDB 10.4

套件管理工具：Composer

推薦瀏覽器：Chrome

本專案開發與測試環境為：Windows + XAMPP 3.3.0 + PHP 8.2 + MariaDB 10.4（透過 phpMyAdmin 管理）

## 使用技術
- Laravel 10
- PHP 8+
- Blade + Bootstrap 5
- SweetAlert2（UX 提示）
- Session（購物車暫存）
- Eloquent ORM（Order / OrderItem 關聯）
- JavaScript 表單驗證 + Loading 效果

---

## 專案功能介紹

### 商品管理（CRUD）

- 建立 / 編輯 / 刪除商品
- 表單驗證（後端 + 前端即時檢查）
- 商品分類選單（書籍、電子產品、食品）

### 購物車功能

- 商品加入購物車
- 顯示購物清單、小計與總金額
- 可移除單筆商品 or 一鍵清空購物車
- 購物車內容儲存在 session 中

### 結帳流程

- 結帳頁面顯示購物明細
- 使用者填寫姓名、電話、地址、付款方式
- 表單送出時按鈕鎖定 + loading 效果
- 結帳成功會建立一筆訂單（Order）及對應的訂單項目（OrderItems）

### UX 加強

- 所有操作結果透過 SweetAlert2 彈窗提示
- 表單欄位錯誤即時提示（JS + Bootstrap）
- 按鈕送出後顯示 loading spinner 防止重複送出

---

## 資料表結構

- `products`：商品資訊
- `orders`：訂單基本資料（姓名、電話、地址、總金額）
- `order_items`：訂單項目（每筆購買的商品）

---

## ⚙️ 安裝與啟動方式


# 1. 複製專案
git clone https://github.com/dgitc8051/shopping-demo.git

# 2. 安裝套件
composer install

# 3. 建立 .env 檔並設定資料庫
cp .env.example .env
php artisan key:generate

打開.env檔，設定資料庫連線資訊，例如：

DB_DATABASE=shopping_cart
DB_USERNAME=root
DB_PASSWORD=

# 4. 執行 migration
php artisan migrate

# 5. 啟動伺服器
php artisan serve
