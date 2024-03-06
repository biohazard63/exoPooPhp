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

function battelRoyale($allWarriors) {
    $battleLog = array();
    $nbWarriors = count($allWarriors);
    $nbBattles = 0;
    for ($i = 0; $i < $nbWarriors; $i++) {
        for ($j = $i + 1; $j < $nbWarriors; $j++) {
            $battleLog[] = "Battle " . ++$nbBattles . ": " . $allWarriors[$i]->getName() . " vs " . $allWarriors[$j]->getName();
            $battleLog = array_merge($battleLog, battle($allWarriors[$i], $allWarriors[$j]));
        }
    }
    return $battleLog;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['battleRoyale'])) {
        $battleLog = battelRoyale($allWarriors);
    }
}