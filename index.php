<?php require_once "header.php" ?>
  <div id="main" class="index">
    <h2 id="preface">はじめに</h2>
    <div class="contents">
      <p>chab.js は HTML のテーブルタグを SQL ライクにセレクトする JavaScript ライブラリです。</p>
      <p>このサイトは chab.js の使用方法や、サンプルプログラム、ライブラリのダウンロードなどを提供します。</p>
    </div>
    <h2>コンテンツ</h2>
    <div class="contents">
      <ol>
        <li><a href="#preface">はじめに</a></li>
        <li><a href="#about">概要</a></li>
        <li><a href="#flow">仕組み</a></li>
        <li><a href="#environment">動作環境</a></li>
        <li><a href="#sample">サンプル</a></li>
        <li><a href="#download">ダウンロード</a></li>
        <li><a href="#license">ライセンス</a></li>
        <li><a href="#howtouse">使い方</a></li>
      </ol>
    </div>
    <h2 id="about">概要</h2>
    <div class="contents">
      <p>chab.jsの特徴</p>
      <ul>
        <li>クライアントサイドで動作する JavaScript プログラム</li>
        <li>HTML5 の API <a href="http://dev.w3.org/html5/postmsg/">Cross-document messaging</a> と<a href="http://dev.w3.org/html5/webdatabase/">Web SQL Database</a> を使用</li>
        <li>ドメインをまたがったテーブルのセレクトが可能</li>
        <li>HTML のテーブルタグをそのままデータベースのテーブルとして利用できる</li>
      </ul>
      <p>chab.jsは以下のようなニーズに対応します (おそらく...)</p>
      <ul>
        <li>Excel のように使える簡易データベースを HTML で作りたい</li>
        <li>データベースの管理を単純にしたい</li>
        <li>テーブルをテキストファイルで管理したい</li>
        <li>テーブルをウェブ上で公開したい</li>
        <li>リレーショナル・データベースを使用したいが、自由に使えるDBサーバーがない</li>
      </ul>
    </div>
    <h2 id="flow">仕組み</h2>
    <div class="contents">
      <p>chab.js の仕組みを以下の図で説明します。</p>
      <a href="/img/flow.png"><img id="flow-img" src="/img/flow.png" alt="動作フロー" /></a>
      <ol>
        <li>example.net/select.html のフォーム項目にSQLを入力し、実行ボタンを押す。<br />実行ボタンをトリガーに chab.js の select メソッドが入力された SQL を取得して処理を開始する。</li>
        <li>SQL の FROM 句に指定された URL(example.com/artist.html と example.org/album.html) に Cross-document messaging でメッセージ(取得する対象のテーブル名)を送信する。<br />メッセージ受信時のイベントは送信先 URL の HTML にリンクされている table.js で行う。</li>
        <li>example.com/artist.html と example.org/album.html にリンクされている table.js は指定されたテーブル名を受け取り、メッセージ (JSON文字列に変換されたテーブルの内容) を返す。<br />メッセージを受け取った chab.js は JSON から CREATE 文、INSERT 文を生成して、元のテーブル構造のまま Web SQL Database に登録する。</li>
        <li>1.で入力された SQL で Web SQL Database からデータをセレクトして example.net/select.html 上に用意しておいた結果出力用の要素にセレクト結果を展開する。</li>
      </ol>
    </div>
    <h2 id="environment">動作環境</h2>
    <div class="contents">
      <p>Web SQL Database と Cross-document messaging に対応したウェブブラウザが必要です。</p>
      <ul>
        <li>Google Chrome 6</li>
        <li>Safari 5</li>
      </ul>
    </div>
    <h2 id="sample">サンプル</h2>
    <div class="contents">
      <p>chab.js を設置済みのページと、サンプルとして3つのテーブルを用意しました。</p>
      <p><a href="/sample.php" class="button">chab.js で遊んでみる</a></p>
      <ul>
        <li><a href="/table/artist.html#artist">artist table (http://chabjs.org/table/artist.html#artist)</a></li>
        <li><a href="/table/album.html#album">album table (http://chabjs.org/table/album.html#album)</a></li>
        <li><a href="/table/history.html#history">history table (http://chabjs.org/table/history.html#history)</a></li>
      </ul>
    </div>
    <h2 id="download">ダウンロード</h2>
    <div class="contents">
      <ul id="download-list" class="clear">
        <li><a href="/lib/latest/chab.js" class="minibutton"><span>chab.js (v1.0.1)</span></a></li>
        <li><a href="/lib/latest/table.js" class="minibutton"><span>table.js (v1.0.0)</span></a></li>
      </ul>
    </div>
    <h2 id="license">ライセンス</h2>
    <div class="contents">
      <p>chab.js および table.js は MIT License で提供しています。</p>
      <a href="/license.php">MIT License</a>
    </div>
    <h2 id="howtouse">使い方</h2>
    <div class="contents">
      コンテンツ作成中...
    </div>
  </div>
<?php require_once "footer.php" ?>