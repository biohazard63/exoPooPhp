<?php
global $warrior1, $warrior2;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'warrior.php';
require 'function.php';

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
    <h2>Warrior 1: <?php echo $warrior1->getName() ?></h2>
    <p><?php echo afficherStats($warrior1); ?></p>
    <h2>Warrior 2: <?php echo $warrior2->getName() ?></h2>
    <p><?php echo afficherStats($warrior2); ?></p>
    <form method="post">
        <button type="submit" name="battle">Battle</button>
        <button type="submit" name="battleRoyale">Battle Royale</button>
    </form>
    <?php if (!empty($battleLog)): ?>
        <ul>
            <?php foreach ($battleLog as $log): ?>
                <li><?php echo $log; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</main>


</body>
</html>