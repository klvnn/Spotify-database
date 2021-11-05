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
      <div class="logo-image">
      <img src="img/spotify.png" class="img-logo">
      <span><a href="index.php">Spotify DB</a></span>
        <a class="navbar-brand" href="/">
      </div>
            </a>
            <ul class="nav-links">
            <li>
            <a class="left" href="index.php">Database</a>
         </li>
        <li>
            <a class="left" href="info.php">Info</a>
        </ul>
    </nav>
</head>
<body>

    <pre>
    <?php
      print_r($nummers);
    ?>
    </pre>

</body>

</html>