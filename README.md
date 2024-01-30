## Rese
### “Rese（リーズ）”は飲食店予約サービスです。<br>
会員登録をすることで、お気に入りのお店を登録したり予約を行うことができます。<br>

***

## 作成した目的

飲食店の方から、「外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたい。」<br>というご依頼を頂き、Reseを作成致しました。

***

## アプリケーションURL
<br>

***

## 機能一覧
* 会員登録機能(メール認証あり)
* ログイン機能
* ログアウト機能
* ユーザー情報機能(マイページ)
* ユーザー飲食店お気に入り一覧取得(マイページ)
* ユーザー飲食店予約情報取得(マイページ)
* 飲食店一覧取得
* 飲食店詳細取得
* 飲食店お気に入り追加
* 飲食店お気に入り削除
* 飲食店予約情報追加
* 飲食店予約情報削除
* エリア/ジャンル/店名で検索する

**メール送信確認ついて**
Laravel sailに含まれるMailPit機能を使用してご確認いただけます。<br>
【http://localhost:8025】<br>
にアクセスしていただくとMailPit画面が表示されます。

***

## 使用技術
* Laravel 10.42.0
* Laravel Sail(Docker, Nginx, MYSQL, Mailpit)
* Laravel Breeze
* PHP 8.3.2-1
* Tailwind CSS
* 
* 
* 
* 
* AWS(EC2, RDS)

***

## 環境構築
※ Dockerをインストールしていない方は下記よりdockerをインストールしてください。<br>
https://www.docker.com/ja-jp/products/docker-desktop/


### 【新規プロジェクトの作成「rese-project」】<br>
cdコマンドでプロジェクトを作成したいルートに移動し、下記コマンドを実行してください。
```jsx
$ curl -s https://laravel.build/rese-project | bash
```
最後にPassword入力を求められるので、入力すれば作成完了です。


### 【Laravel sailを起動】<br>
プロジェクトのルートに移動し、下記コマンドでLaravel sailを起動させます。
```jsx
$ ./vendor/bin/sail up -d
```
確認のためlocalhostへアクセスするとLaravelのWelcomeページを見ることができます。

### 【エイリアスを作成】<br>
ホームディレクトリに.zshrcファイルを作成し下記を入力します。<br>
(入力する際はiを押すと入力モードに切り替わります。入力が終わったらesc→:wqで入力終了と保存を行なってください。)<br>
**alias sail="vendor/bin/sail"**<br>
※ 今後のコマンドは"vendor/bin/sail"ではなく"sail"で記述していきます。

### 【Laravel sailを止める】<br>
```jsx
$ sail stop
```

### 【phpMyAdminの準備】<br>
* Laravel sailをstopした状態で、docker-compose.ymlファイルを編集します。<br>
mysqlの下(timeout: 5s)53行目〜redis:の間に下記を追記します。
```jsx
phpmyadmin:
image: phpmyadmin/phpmyadmin
links:
- mysql:mysql
ports:
- 8080:80
environment:
MYSQL_USERNAME: '${DB_USERNAME}'
MYSQL_ROOT_PASSWORD: '${DB_PASSWORD}'
PMA_HOST: mysql
networks:
- sail
```
* .envファイルでデータベースの設定を確認し、下記にアクセスしてログインします。<br>
【localhost:8080】<br>
※ ユーザー名・パスワードは先程.envファイルで確認したものを入力してください。<br>
プロジェクト名のデータベースが作成されていれば成功です！

### 【認証機能Breezeをインストール】<br>
* Laravel sailを起動し、プロジェクトのルートでBreezeパッケージをいれるコマンドを実行します。<br>
```jsx
$ sail composer require laravel/breeze --dev
```
下記コマンドでBreezeをインストールします。<br>
```jsx
$ sail artisan breeze:install
```
※ 3つの質問が表示されるので希望に沿って選んで実行してください。<br>
(今回私が選んだ内容は下記の通りです)<br>
・Which Breeze stack would you like to install? → **Blade with Alpine**<br>
・Would you like dark mode support? → **No**<br>
・Which testing framework do you prefer? → **PHPUnit**<br>
Breeze scaffolding installed successfully.と表示されれば成功です！

* Tailwind CSSを反映させます。<br>
(作業用のターミナルとは別にターミナルを開き、下記コマンドを実行してください。)<br>
```jsx
$ sail npm run dev
```
作業用のターミナルに戻り、マイグレートします。<br>
```jsx
$ sail artisan migrate
```
これでrese_projectのデータベース内にusersテーブルが作成され会員登録が可能な状態となりました。

### 【日本語化の設定をする】
* まずはロケールとタイムゾーンの設定を行います。<br>
プロジェクト内のconfig/app.phpを変更していきます。<br>
・timezoneの変更(73行目あたり) → **'timezone' => 'Asia/Tokyo',**<br>
・localeの変更(86行目あたり) → **'locale' => 'ja',**<br>
・faker_localeの変更(112行目あたり) → **'faker_locale' => 'ja_JP',**<br>

* 次にlangディレクトリを作成するため、下記コマンドを実行します。<br>
```jsx
$ sail artisan lang:publish
```
lang/enが作成されました。<br>
* あわせてlang/ja(日本語版)フォルダを作成します。<br>
(今回、Laravel Breeze日本語化パッケージをインストールさせて頂きました)<br>
GitHub : https://github.com/askdkc/breezejp<br>
下記コマンドを実行するとlang/ja(日本語版)フォルダが作成されます。<br>
```jsx
$ sail composer require askdkc/breezejp --dev
$ sail artisan breezejp
```

***

## テーブル設計
### usersテーブル
|Column|Type|Options|
|:---:|:---:|:---:|
|name|varchar(191)|null: false|
|email|varchar(191)|null: false|
|password|varchar(191)|null: false|
|email_verified_at|timestamp|———|
|created_at|timestamp|———|
|updated_at|timestamp|———|

### shopsテーブル
|Column|Type|Options|
|:---:|:---:|:---:|
|area_id|bigint|null: false|
|genre_id|bigint|null: false|
|name|varchar(191)|null: false|
|comment|text|———|
|url|text|———|
|created_at|timestamp|———|
|updated_at|timestamp|———|

### areasテーブル
|Column|Type|Options|
|:---:|:---:|:---:|
|area|varchar(191)|null: false|
|created_at|timestamp|———|
|updated_at|timestamp|———|

### genresテーブル
|Column|Type|Options|
|:---:|:---:|:---:|
|genre|varchar(191)|null: false|
|created_at|timestamp|———|
|updated_at|timestamp|———|

### reservationsテーブル
|Column|Type|Options|
|:---:|:---:|:---:|
|user_id|bigint|null: false|
|shop_id|bigint|null: false|
|date|date|null: false|
|time|time|———|
|number|integer|———|
|created_at|timestamp|———|
|updated_at|timestamp|———|

### favoritesテーブル
|Column|Type|Options|
|:---:|:---:|:---:|
|user_id|bigint|null: false|
|shop_id|bigint|null: false|
|created_at|timestamp|———|
|updated_at|timestamp|———|

***

## ER図
![alt](rese.png)