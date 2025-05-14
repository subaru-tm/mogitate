# アプリケーション名
- mogitate

## 環境構築
- Dockerビルド
  - docker-compose up -d --build
- モデル、マイグレーション作成
  - php artisan make:model Product -m
    - 作成されたモデル、マイグレーションファイル名
      - Product.php
      - 2025_05_07_153047_create_products_table,php
  - php artisan make:model ProductSeason -m
    - 作成されたモデル、マイグレーションファイル名
      - ProductSeason.php
      - 2025_05_07_154532_create_product_seasons_table.php
  - php artisan make:migration create_seasons_table
    - 作成されたマイグレーションファイル名
      - 2025_05_07_154000_create_seasons_table.php
        - ファイル名はリネーム（タイムスタンプ部分を"000"に）
       
  - php artisan migrate
    - 実施後のメッセージ "Migration table created successfully."
   
  - php artisan key:generate
 
- シーダー作成・実行
  - php artisan make:seeder ProductsTableSeeder
  - php artisan make:seeder SeasonsTableSeeder
  - php artisan make:seeder ProductSeasonTableSeeder
 
  - php artisan db:seed
    - 実施後のメッセージ "Database seeding completed successfully."
   
- コントローラ作成
  - php artisan make:controller ProductController
 
- シンボリックリンク
  - php artisan storage:link
    - 実行後メッセージ       "The [/var/www/public/storage] link has been connected to [/var/www/storage/app/public].
The links have been created."

- フォームリクエスト
  - php artisan make:request ProductRequest

## 使用技術（実行環境）
- Laravel Framework 8.83.8
  - php
  - nginx:1.21.1
  - mysql:8.0.26
 
## ER図

## URL
- 開発環境: http://localhost/
