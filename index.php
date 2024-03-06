<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'warrior.php';
require 'function.php';
$result = battle($warrior1, $warrior2);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Title</title>
</head>
<body>
<main class="highlight">
    <h1>Warrior Battle</h1>
    <form method="post">
        <button type="submit" name="battle">Battle</button>
    </form>
    <h2> <?php echo $result ?></h2>
</main>


</body>
</html>