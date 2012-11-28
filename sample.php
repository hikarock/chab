<?php require_once "header.php" ?>
  <div id="main" class="sample">
    <h2>chab.js sample</h2>
    <div class="contents">
      <p>サンプルとして用意したテーブルです。</p>
      <ul>
          <li><a href="/table/artist.html#artist">artist table (http://chabjs.org/table/artist.html#artist)</a></li>
          <li><a href="/table/album.html#album">album table (http://chabjs.org/table/album.html#album)</a></li>
          <li><a href="/table/history.html#history">history table (http://chabjs.org/table/history.html#history)</a></li>
      </ul>
      <p>ここにセレクト文をかいてね。</p>
      <textarea id="sql">select
     artist.name as アーティスト
    ,album.title as タイトル
    ,album.year as 年
    ,history.event as できごと
  from
     http://chabjs.org/table/history.html#history as history
    ,http://chabjs.org/table/album.html#album as album
    ,http://chabjs.org/table/artist.html#artist as artist
  where
    album.year = history.year
    and artist.artist_id = album.artist_id</textarea>
      <p><a id="execute" class="button">実行</a></p>
    </div>
    <div id="chab"></div>
  </div>
  <script type="text/javascript" src="/lib/latest/chab.js"></script>
  <script type="text/javascript">
  window.onload = function() {
      var exec = document.getElementById("execute");
      exec.onclick = function() {
          var sql = document.getElementById("sql").value;
          chab.select(sql);
      }
  };
  </script>
<?php require_once "footer.php" ?>