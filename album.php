<?php
@include_once('dbh.php');

if(!isset($_GET['id'])) {
  header('Location: index.php');
  exit();
}

$id = $_GET['id'];

// INNER JOIN `artiest` ON `artiest`.`id` = `album`.`artiest_id`
// `artiest`.`naam` AS `artiestnaam`,
Database::query('SELECT `album`.`naam` AS `albumnaam`, `album`.`cover`, `artiest`.`naam` AS `artiestnaam`,`nummers`.*
                 FROM `nummers`
                 INNER JOIN `album` ON `nummers`.`album_id` = `album`.`id`
                 INNER JOIN `artiest` ON `artiest`.`id` = `album`.`artiest_id`
                 WHERE `nummers`.`album_id` = :id', [ ':id' => $id ]);

$nummers = Database::getAll();

$conn = new mysqli('localhost', 'root', '', 'spotify');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify database</title>
    <link rel="stylesheet" href="style.css"><link rel="preconnect" href="https://fonts.gstatic.com/%22%3E">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">
       
</head>
<body>
<nav>   
  <!-- probeer 1 resultaat te krijgen doormiddel van de id in de uri -->  
      <div class="logo-image">
      <img src="img/spotify.png" class="img-logo">
      <span><a href="index.php">Spotty DB</a></span>
        <a class="navbar-brand" href="/">
      </div>
            </a>
            <ul class="nav-links">
            <li>
            <a class="left" href="index.php">Database</a>
         </li>
        <li>
            <a class="l   1eft" href="info.php">Info</a>
        </ul>
    </nav>
    <div class="grid-container">
      <?php 
      $sql = 'SELECT * FROM album WHERE id = ' . $id;
      $result = mysqli_query($conn, $sql);
      $album = $result->fetch_array(MYSQLI_ASSOC);
      // ziet er tantoe gay uit maar dat is nu jouw probleem lmao.
?>
      <a href="album.php?id=<?= $album['id'] ?>" class="album-thumbnail">
      <img src="<?= $album['cover'] ?>" />
 <section class="nummers">
    <?php 
    $teller = 0;
    foreach($nummers as $nummer): ?>
     <?php if($teller == 0) { ?>
      <p class="label"><?= $nummer['naam'] ?></p>
      <?php } ?>
      <div class="nummer">
      <p class=albumbeeld><?= $nummer['naam'] ?> - <?= $nummer['lengte'] ?></p>
      <p class="label"><?= $nummer['artiestnaam'] ?></p>
      </div>
    <?php 
  $teller++;
  endforeach; ?>
    </div>
    </section>
</body>
</html>