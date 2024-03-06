<?php

// faire un tabbleau de guerrier et les faire combattre entre eux de façon aléatoire
$allWarriors = [
    new WarriorAxe('Axe', 10, 100),
    new WarriorSword('Sword', 10, 100),
    new WarriorSpear('Spear', 10, 100),
];

$warrior1 = $allWarriors[array_rand($allWarriors)];
$warrior2 = $allWarriors[array_rand($allWarriors)];


function battle($warrior1, $warrior2) {
    while ($warrior1->isAlive() && $warrior2->isAlive()) {
        $warrior1->attack($warrior2);
        $warrior2->attack($warrior1);
    }

    if ($warrior1->isAlive() && !$warrior2->isAlive()) {
        return $warrior1->getName() . " wins";
    } elseif (!$warrior1->isAlive() && $warrior2->isAlive()) {
        return $warrior2->getName() . " wins";
    } else {
        return "It's a draw";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['battle'])) {
        // Call the battle function
        battle($warrior1, $warrior2);
    }
}

