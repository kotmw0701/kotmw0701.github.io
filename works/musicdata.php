<?php
if(!isset($_GET['title'])) return;
$title = $_GET['title'];
$db = new SQLite3("Chunithm.db");

$statement = $db->prepare('SELECT * FROM music WHERE Title = :title');
$statement->bindValue('title', $title);

$result = $statement->execute();
?>
<!DOCTYPE html>
<html lang = ja>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title><?php echo $title;?> | そこら辺の雑記帳</title>
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
              <li><a href="musicgameview.php">音ゲー曲検索</a></li>
              <li><?php echo $title;?></li>
            </ol>
          </div>
          <h1><?php echo $title;?></h1>
          <?php
          $row = $result->fetchArray();
          print $row[0]." : ".$row[1];
          ?>
        </main>
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
