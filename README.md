# chab.js

Web SQL Database を使ってテーブルタグを SQL ライクにセレクトする JavaScript ライブラリ

## 特徴

chab.js は HTML のテーブルタグを SQL ライクにセレクトする JavaScript ライブラリです。

- クライアントサイドで動作する JavaScript プログラム
- HTML5 の API [Cross-document messaging](http://dev.w3.org/html5/postmsg/) と[Web SQL Database](http://dev.w3.org/html5/webdatabase/) を使用
- ドメインをまたがったテーブルのセレクトが可能
- HTML のテーブルタグをそのままデータベースのテーブルとして利用できる

chab.jsは以下のようなニーズに対応します

- Excel のように使える簡易データベースを HTML で作りたい
- データベースの管理を単純にしたい
- テーブルをテキストファイルで管理したい
- テーブルをウェブ上で公開したい
- リレーショナル・データベースを使用したいが、自由に使えるDBサーバーがない

## 仕組み

chab.js の仕組みを以下の図で説明します。

[![動作フロー]()]()

1. example.net/select.html のフォーム項目にSQLを入力し、実行ボタンを押す。実行ボタンをトリガーに chab.js の select メソッドが入力された SQL を取得して処理を開始する。
2. SQL の FROM 句に指定された URL(example.com/artist.html と example.org/album.html) に Cross-document messaging でメッセージ(取得する対象のテーブル名)を送信する。メッセージ受信時のイベントは送信先 URL の HTML にリンクされている table.js で行う。
3. example.com/artist.html と example.org/album.html にリンクされている table.js は指定されたテーブル名を受け取り、メッセージ (JSON文字列に変換されたテーブルの内容) を返す。メッセージを受け取った chab.js は JSON から CREATE 文、INSERT 文を生成して、元のテーブル構造のまま Web SQL Database に登録する。
4. 1.で入力された SQL で Web SQL Database からデータをセレクトして example.net/select.html 上に用意しておいた結果出力用の要素にセレクト結果を展開する。

## 動作環境

Web SQL Database と Cross-document messaging に対応したウェブブラウザが必要です。

* Google Chrome 6
* Safari 5

## サンプル

chab.js を設置済みのページと、サンプルとして3つのテーブルを用意しました。

[chab.js で遊んでみる](/sample.html)

* [artist table (http://chabjs.org/table/artist.html#artist)](/table/artist.html#artist)
* [album table (http://chabjs.org/table/album.html#album)](/table/album.html#album)
* [history table (http://chabjs.org/table/history.html#history)](/table/history.html#history)

## ライセンス

MIT License

