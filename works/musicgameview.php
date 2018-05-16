<?php
$db = new SQLite3("Chunithm.db");
$statement = $db->prepare('SELECT * FROM music WHERE Category LIKE :category');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>音ゲー曲検索 β版 | そこら辺の雑記帳</title>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../common.js"></script>
    <script type="text/javascript" src="../script.js"></script>
    <script type="text/javascript" src="search.js"></script>
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
              <li>テストページ</li>
            </ol>
          </div>
          <h1>音ゲー曲検索 β版(ウニの曲のみ一時的対応</h1>
          <form name="form" action="musicgameview.php">
            <input class="textform" type="text" name="category" placeholder="Category"><br>
            <!--<input class="textform" type="text" name="artist" placeholder="Artist">-->
            <input type="submit" value="search">
          </form>
          
          <?php
          if(isset($_GET['category'])) {
            $category = $_GET['category'];
            $statement->bindValue(':category', $category);

            $result = $statement->execute();
            print "<table><tr><th>タイトル</th><th>アーティスト</th></tr>";
            while($row = $result->fetchArray()) {
              print "<tr><td>".$row[1]."</td><td>".$row[2]."</td></tr>";
            }
            print "</table>";
          }
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
