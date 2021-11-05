<?php
@include_once('dbh.php');

Database::query('SELECT `album`.*, `artiest`.`naam` as `artiestnaam` FROM `album` INNER JOIN `artiest` ON `artiest`.`id` = `album`.`artiest_id`');
$albums = Database::getAll();

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
    <nav>     
      <a href="" class="logo-image">
      <img src="img/spotify.png" class="img-logo">
      <span><a href="" href="index.php">Spotify DB</a></span>
        <a href="" class="navbar-brand" href="/">
      </a>
            </a>
            <ul class="nav-links">
            <li>
            <a href="" class="left" href="index.php">Database</a>
         </li>
        <li>
            <a href="" class="left" href="info.php">Info</a>
        </ul>
    </nav>
</head>
<body>
    <main>
        <?php foreach($albums as $album): ?>
        <a href="album.php?id=<?= $album['id'] ?>" class="album-thumbnail">
            <img src="<?= $album['cover'] ?>" alt="<?= $album['artiestnaam'] ?> - <?= $album['naam'] ?>" title="<?= $album['artiestnaam'] ?> - <?= $album['naam'] ?>" />
            <p class="artiestnaam"><?= $album['artiestnaam'] ?></p>
            <p class="albumnaam"><?= $album['naam'] ?></p>
        </a>
        <?php endforeach; ?>

    </main>
</body>
</html>