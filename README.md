## Rese

### “Rese（リーズ）”は飲食店予約サービスです。<br>

会員登録をすることで、登録されているお店の店舗情報を閲覧できるだけではなく、各店舗の口コミチェック、お店のお気に入り登録、予約を行うことができるようになります。<br>

---

## 作成した目的

飲食店の方から、「外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたい。」というご依頼を頂き、Rese を作成致しました。

---

## アプリケーション URL

<br>

---

## 機能一覧

-   会員登録機能(メール認証あり)
-   ログイン機能
-   ログアウト機能
-   ユーザー情報機能(マイページ)
-   ユーザー飲食店お気に入り一覧取得(マイページ)
-   ユーザー飲食店予約情報取得(マイページ)
-   飲食店一覧取得
-   飲食店詳細取得
-   飲食店お気に入り追加
-   飲食店お気に入り削除
-   飲食店予約情報追加
-   飲食店予約情報更新
-   飲食店予約情報削除
-   5段階評価&レビュー作成(利用後の店舗のみ詳細ページにてレビュー作成可能)
-   エリア/ジャンル/店名で検索する
-   飲食店新規情報作成
-   飲食店店舗代表者登録

**認証メール送信のタイミング**<br>
会員登録後に表示される thanks ページにて『ログインする』ボタンをクリックする必要があるため、下記タイミングにて認証メールが送信されます。<br>
register ページにてフォーム入力 → thanks ページに表示される『ログインする』ボタンをクリック →login フォームを入力 → 認証メールが送信される<br>

**メール送信確認ついて**<br>
Laravel sail に含まれる MailPit 機能を使用してご確認いただけます。<br>
【http://localhost:8025】<br>
にアクセスしていただくと MailPit 画面が表示されます。

---

## 使用技術

-   Laravel 10.42.0
-   Laravel Sail(Docker, Nginx, MYSQL, Mailpit)
-   Laravel Breeze
-   Laravelストレージ使用(店舗イメージ画像保存)　
-   PHP 8.3.2-1
-   Tailwind CSS
-   Javascript 10.3.0<br>
    ・ハンバーガーメニュー<br>
    ・トップページでのEnter検索<br>
    ・入力内容確認欄(予約フォーム内)への即時反映<br>
    ・alert message　のみ
-   Pagination
-   バリデーション(認証/予約/レビュー/店舗情報作成)
-
-   AWS(EC2, RDS)

---

## 環境構築

※ Docker をインストールしていない方は下記より docker をインストールしてください。<br>
https://www.docker.com/ja-jp/products/docker-desktop/

### 【新規プロジェクトの作成「rese-project」】<br>

cd コマンドでプロジェクトを作成したいルートに移動し、下記コマンドを実行してください。

```jsx
$ curl -s https://laravel.build/rese-project | bash
```

最後に Password 入力を求められるので、入力すれば作成完了です。

### 【Laravel sail を起動】<br>

プロジェクトのルートに移動し、下記コマンドで Laravel sail を起動させます。

```jsx
$ ./vendor/bin/sail up -d
```

確認のため localhost へアクセスすると Laravel の Welcome ページを見ることができます。

### 【エイリアスを作成】<br>

ホームディレクトリに.zshrc ファイルを作成し下記を入力します。<br>
(入力する際は i を押すと入力モードに切り替わります。入力が終わったら esc→:wq で入力終了と保存を行なってください。)<br>
**alias sail="vendor/bin/sail"**<br>
※ 今後のコマンドは"vendor/bin/sail"ではなく"sail"で記述していきます。

### 【Laravel sail を止める】<br>

```jsx
$ sail stop
```

### 【phpMyAdmin の準備】<br>

-   Laravel sail を stop した状態で、docker-compose.yml ファイルを編集します。<br>
    mysql の下(timeout: 5s)53 行目〜redis:の間に下記を追記します。

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

-   .env ファイルでデータベースの設定を確認し、下記にアクセスしてログインします。<br>
    【localhost:8080】<br>
    ※ ユーザー名・パスワードは先程.env ファイルで確認したものを入力してください。<br>
    プロジェクト名のデータベースが作成されていれば成功です！

### 【認証機能 Breeze をインストール】<br>

-   Laravel sail を起動し、プロジェクトのルートで Breeze パッケージをいれるコマンドを実行します。<br>

```jsx
$ sail composer require laravel/breeze --dev
```

下記コマンドで Breeze をインストールします。<br>

```jsx
$ sail artisan breeze:install
```

※ 3 つの質問が表示されるので希望に沿って選んで実行してください。<br>
(今回私が選んだ内容は下記の通りです)<br>
・Which Breeze stack would you like to install? → **Blade with Alpine**<br>
・Would you like dark mode support? → **No**<br>
・Which testing framework do you prefer? → **PHPUnit**<br>
Breeze scaffolding installed successfully.と表示されれば成功です！

-   Tailwind CSS を反映させます。<br>
    (作業用のターミナルとは別にターミナルを開き、下記コマンドを実行してください。)<br>

```jsx
$ sail npm run dev
```

作業用のターミナルに戻り、マイグレートします。<br>

```jsx
$ sail artisan migrate
```

これで rese_project のデータベース内に users テーブルが作成され会員登録が可能な状態となりました。

### 【日本語化の設定をする】

-   まずはロケールとタイムゾーンの設定を行います。<br>
    プロジェクト内の config/app.php を変更していきます。<br>
    ・timezone の変更(73 行目あたり) → **'timezone' => 'Asia/Tokyo',**<br>
    ・locale の変更(86 行目あたり) → **'locale' => 'ja',**<br>
    ・faker_locale の変更(112 行目あたり) → **'faker_locale' => 'ja_JP',**<br>

-   次に lang ディレクトリを作成するため、下記コマンドを実行します。<br>

```jsx
$ sail artisan lang:publish
```

lang/en が作成されました。<br>

-   あわせて lang/ja(日本語版)フォルダを作成します。<br>
    (今回、Laravel Breeze 日本語化パッケージをインストールさせて頂きました)<br>
    GitHub : https://github.com/askdkc/breezejp<br>
    下記コマンドを実行すると lang/ja(日本語版)フォルダが作成されます。<br>

```jsx
$ sail composer require askdkc/breezejp --dev
$ sail artisan breezejp
```

---

## テーブル設計

### users テーブル

|      Column       |     Type     |   Options   |
| :---------------: | :----------: | :---------: |
|       name        | varchar(191) | null: false |
|       email       | varchar(191) | null: false |
|     password      | varchar(191) | null: false |
| email_verified_at |  timestamp   |     ———     |
|       role        | varchar(191) |     ———     |
|    created_at     |  timestamp   |     ———     |
|    updated_at     |  timestamp   |     ———     |

### shops テーブル

|   Column   |     Type     |   Options   |
| :--------: | :----------: | :---------: |
|  area_id   |    bigint    | null: false |
|  genre_id  |    bigint    | null: false |
|    name    | varchar(191) | null: false |
|  comment   |     text     |     ———     |
|    url     |     text     |     ———     |
| created_at |  timestamp   |     ———     |
| updated_at |  timestamp   |     ———     |

### areas テーブル

|   Column   |     Type     |   Options   |
| :--------: | :----------: | :---------: |
|    area    | varchar(191) | null: false |
| created_at |  timestamp   |     ———     |
| updated_at |  timestamp   |     ———     |

### genres テーブル

|   Column   |     Type     |   Options   |
| :--------: | :----------: | :---------: |
|   genre    | varchar(191) | null: false |
| created_at |  timestamp   |     ———     |
| updated_at |  timestamp   |     ———     |

### reservations テーブル

|   Column   |   Type    |   Options   |
| :--------: | :-------: | :---------: |
|  user_id   |  bigint   | null: false |
|  shop_id   |  bigint   | null: false |
|    date    |   date    | null: false |
|    time    |   time    |     ———     |
|   number   |  integer  |     ———     |
| created_at | timestamp |     ———     |
| updated_at | timestamp |     ———     |

### favorites テーブル

|   Column   |   Type    |   Options   |
| :--------: | :-------: | :---------: |
|  user_id   |  bigint   | null: false |
|  shop_id   |  bigint   | null: false |
| created_at | timestamp |     ———     |
| updated_at | timestamp |     ———     |

### reviews テーブル

|   Column   |     Type     |   Options   |
| :--------: |   :-------:  | :---------: |
|  user_id   |  bigint      |     ———     |
|  shop_id   |  bigint      | null: false |
|  user_name | varchar(191) | null: false |
|  ranting   |  integer     | null: false |
|  comment   |  text        | null: false |
| created_at | timestamp    |     ———     |
| updated_at | timestamp    |     ———     |

### representatives テーブル

|   Column   |   Type    |   Options   |
| :--------: | :-------: | :---------: |
|  user_id   |  bigint   | null: false |
|  shop_id   |  bigint   |     ———     |
| created_at | timestamp |     ———     |
| updated_at | timestamp |     ———     |

---

## ER 図

![alt](rese.png)
