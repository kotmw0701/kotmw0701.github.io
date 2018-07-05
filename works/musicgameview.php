<?php
$db = new SQLite3("Chunithm.db");
$sql = 'SELECT * FROM music';
$category = ' Category LIKE :category';
$title = ' Title LIKE :title';
$artist = ' Artist LIKE :artist';

if(isset($_POST['category']) && $_POST['category'] !== '') {
  $category_value = $_POST['category'];
  $sql .= ' WHERE'.$category;
}
if(isset($_POST['title']) && $_POST['title'] !== '') {
  $title_value = $_POST['title'];
  $sql .= (strstr($sql, 'WHERE') ? ' AND' : ' WHERE').$title;
}
if(isset($_POST['artist']) && $_POST['artist'] !== '') {
  $artist_value = $_POST['artist'];
  $sql .= (strstr($sql, 'WHERE') ? ' AND' : ' WHERE').$artist;
}
$statement = $db->prepare($sql);
if(isset($category_value)) $statement->bindValue('category', $category_value);
if(isset($title_value)) $statement->bindValue('title', $_POST['title_match'] === 'partinal' ? '%'.$title_value.'%' : $title_value);
if(isset($artist_value)) $statement->bindValue('artist', $_POST['artist_match'] === 'partinal' ? '%'.$artist_value.'%' : $artist_value);
$result = $statement->execute();
?>
<!DOCTYPE html>
<html lang = ja>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>音ゲー曲検索 β版 | そこら辺の雑記帳</title>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../common.js"></script>
    <script type="text/javascript" src="../script.js"></script>
    <link rel="stylesheet" href="../stylesheets/normalize.css">
    <link rel="stylesheet" href="../stylesheets/style.css">
    <link rel="stylesheet" href="../stylesheets/images.css">
    <link rel="stylesheet" href="../stylesheets/day.css" id="toggle">
  </head>
  <body>
    <script type="text/javascript">switchingStyles();</script>
    <header>
      <script type="text/javascript">header('../');</script>
    </header>
    <section>
      <div class="container">
        <main>
          <div class="breadcrumb">
            <ol>
              <li><a href="../index.html">トップページ</a></li>
              <li><a href="index.html">制作物</a></li>
              <li>音ゲー曲検索 β版</li>
            </ol>
          </div>
          <h1>音ゲー曲検索 β版(ウニの曲のみ一時的対応</h1>
          <form name="form" action="musicgameview.php" method="POST">
            <input class="textform" type="text" name="category" placeholder="Category"><br>
            <input class="textform" type="text" name="title" placeholder="Title">
            <select name="title_match">
              <option value="partinal" selected>部分一致</option>
              <option value="exact">完全一致</option>
            </select><br>
            <input class="textform" type="text" name="artist" placeholder="Artist">
            <select name="artist_match">
              <option value="partinal" selected>部分一致</option>
              <option value="exact">完全一致</option>
            </select><br>
            <input type="submit" value="search">
          </form>
          <?php
            print '<table><th>タイトル</th><th>アーティスト</th><th>BPM</th><th>ウニ</th><th>舞</th><th>ボルテ</th></tr>';
            while($row = $result->fetchArray(SQLITE3_NUM)) {
              print "<tr><td><a href=\"musicdata.php?title=$row[1]\">$row[1]</a></td><td>$row[2]</td><td>$row[3]</td><td>〇</td><td></td><td></td></tr>";
            }
            print '</table>';
          ?>
        </main>
        <!--
          SELECT * FROM music WHERE
            (category LIKE '<category_1>' OR category LIKE '<category_2>' OR category LIKE '<category_3>' OR category LIKE '<category_4>' ...)
            AND (basic = <diff> OR advanced = <diff> OR expert = <diff> OR master = <diff>
            AND bpm = <bpm>
            AND artist LIKE '%<artist>%'
        
        -->
        <aside id="sidebar">
          <script type="text/javascript">sidebar('../');</script>
        </aside>
      </div>
    </section>
    <footer>
      <script type="text/javascript">footer('../');</script>
    </footer>
  </body>
</html>
