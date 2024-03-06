<?php

$allWarriors = [
    new WarriorAxe('Axe', 10, 100),
    new WarriorSword('Sword', 10, 100),
    new WarriorSpear('Spear', 10, 100),
    new WarriorBow('Bow', 10, 100),
    new WarriorShield('Shield', 10, 100),
    new WarriorMagic('Magic', 10, 100),
];

$warrior1 = $allWarriors[array_rand($allWarriors)];
$warrior2 = $allWarriors[array_rand($allWarriors)];

function battle($warrior1, $warrior2) {
    $battleLog = array();

    while ($warrior1->isAlive() && $warrior2->isAlive()) {
        $battleLog[] = $warrior1->attack($warrior2);
        $battleLog[] = $warrior2->attack($warrior1);
    }

    if ($warrior1->isAlive() && !$warrior2->isAlive()) {
        $battleLog[] = $warrior1->getName() . " wins";
    } elseif (!$warrior1->isAlive() && $warrior2->isAlive()) {
        $battleLog[] = $warrior2->getName() . " wins";
    } else {
        $battleLog[] = "It's a draw";
    }

    return $battleLog;
}

$battleLog = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['battle'])) {
        $battleLog = battle($warrior1, $warrior2);
    }
}

function afficherStats($guerrier) {
    return $guerrier->getName() . " a " . $guerrier->getLife() . " point de vie et " . $guerrier->getPower() . " points d'attaque.";
}