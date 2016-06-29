# chab

chab は Web SQL Database を使って HTML の &lt;table&gt; タグを SQL ライクにセレクトする JavaScript ライブラリです。

## 特徴

- &lt;table&gt; タグをそのままデータベースのテーブルとして利用できる
  - ドメインをまたがった &lt;table&gt; のセレクトも可能
- HTML5 の API [Cross-document messaging](https://html.spec.whatwg.org/multipage/comms.html#web-messaging/) と[Web SQL Database](http://dev.w3.org/html5/webdatabase/) を使用

chab は以下のようなニーズに答えます。そのようなニーズが存在するかは置いといて。

- &lt;table&gt; タグを結合して閲覧したい
- &lt;table&gt; タグ内をSQLで絞り込みたい
- Excel のように使える簡易データベースがほしい

## 仕組み

chab の仕組みを以下の図で説明します。

[![動作フロー](https://hikarock.github.io/chab/img/overview.png)](https://hikarock.github.io/chab/img/overview.png)

1. example.net/select.html のフォーム項目にSQLを入力し、実行ボタンを押す。実行ボタンをトリガーに chab の select メソッドが入力された SQL を取得して処理を開始する。
2. SQL の FROM 句に指定された URL(example.com/artist.html と example.org/album.html) に Cross-document messaging でメッセージ(取得する対象のテーブル名)を送信する。メッセージ受信時のイベントは送信先 URL の HTML にリンクされている table.js で行う。
3. example.com/artist.html と example.org/album.html にリンクされている table.js は指定されたテーブル名を受け取り、メッセージ (JSON文字列に変換されたテーブルの内容) を返す。メッセージを受け取った chab は JSON から CREATE 文、INSERT 文を生成して、元のテーブル構造のまま Web SQL Database に登録する。
4. 1.で入力された SQL で Web SQL Database からデータをセレクトして example.net/select.html 上に用意しておいた結果出力用の要素にセレクト結果を展開する。

## 動作環境

Web SQL Database と Cross-document messaging に対応したウェブブラウザが必要です。以下のブラウザで動作確認しました。

- Google Chrome 53.0 dev (64-bit)
- Mobile Safari (iOS 9.3.2)
- Safari 9.1.1 (11601.6.17)

## デモ

chab を設置済みのページと、サンプルとして3つのテーブルを用意しました。

[デモ](https://hikarock.github.io/chab/)

## ライセンス

[MIT License](https://hika69.mit-license.org/)

