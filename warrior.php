<?php

trait AttackUltime {
    public function ultimePerformAttack($opponent) {
        $damage = $this->weapon->getPower() * 4;
        $opponent->life -= $damage;
        if ($opponent->life < 0) {
            $opponent->life = 0;
        }
        return $this->getName() . " attacks " . $opponent->getName() . " pour " . $damage . " damage";
    }
}


abstract class Warrior {
    protected $name;
    protected $power;
    protected $life;
    protected $weapon;
    private $distance = 10;
    private $weaknesses;
    private $dash;

    public function __construct($name, $power, $life, Weapon $weapon) {
        $this->name = $name;
        $this->power = $power;
        $this->life = $life;
        $this->weapon = $weapon;
        $this->weaknesses = ["Sword", "Magic", "Bow", "Spear", "Axe", "Shield"];
    }

    public function attack(Warrior $opponent) {
        $distance = $this->getDistanceTo($opponent);
        $range = $this->weapon->getAttackRange();

        $logMessage = $this->getName() . " est a " . $distance . "M de " . $opponent->getName();
        $logMessage .= $distance <= $range ? " - se préparant à attaquer.\n" : " - hors de portée.\n";

        if ($distance <= $range) {
            if (rand(0, 3) === 1) {
                $logMessage .= $this->performAttack($opponent);
                $opponent->increaseDistance($this);
                $logMessage .= $this->getName() . " attaque. " . $opponent->getName() . " recule.\n";
            } else {
                $opponent->dodge();
                $opponent->increaseDistance($this);
                $logMessage .= $opponent->getName() . " esquive l'attaque.\n";
            }
        } else {
            if (rand(0, 1) === 1) {
                $this->dash($opponent);
                $logMessage .= $this->getName() . " fait un dash.\n";
            } else {
                $this->advance($opponent);
                $logMessage .= $this->getName() . " avance.\n";
            }
        }
        return $logMessage;
    }

    protected function performAttack(Warrior $opponent) {
        $this->weapon->useWeapon();
        $return_message = "";

        if (rand(0, 2) === 0) {
            $return_message .= $this->ultimePerformAttack($opponent) . " C'était une attaque ultime !\n";
        }

        $damage = $this->weapon->getPower();
        $opponentWeaponType = $opponent->weapon->getType();
        if (in_array($opponentWeaponType, $this->weaknesses)) {
            $damage *= 2;
            $return_message .= "C'est une attaque sur faiblesse ! ";
        }
        $opponent->life -= $damage;
        if ($opponent->life < 0) {
            $opponent->life = 0;
        }
        $return_message .= $this->getName() . " attaques " . $opponent->getName() . " pour " . $damage . " dommage\n";

        return $return_message;
    }

    public function isAlive() {
        return $this->life > 0;
    }

    abstract public function getName();

    public function getPower() {
        return $this->power;
    }

    public function getLife() {
        return $this->life;
    }

    public function getDistanceTo(Warrior $opponent) {
        return $this->distance;
    }

    public function increaseDistance(Warrior $opponent) {
        if ($this->distance < 10) {
            $this->distance += 1;
            $opponent->reduceDistance($this);
        }
    }

    public function reduceDistance(Warrior $opponent) {
        if($this->distance > 0){
            $this->distance -= 1;
            $opponent->increaseDistance($this);
        }
    }

    public function advance(Warrior $opponent) {
        $this->distance += 1;
        $opponent->reduceDistance($this);
        if($this->distance > 10){
            $this->distance = 10;
        }
    }

    public function dash(Warrior $opponent) {
        $dashDistance = rand(3, 4);
        $this->distance -= $dashDistance;
        $opponent->increaseDistance($this);
        if($this->distance < 0){
            $this->distance = 0;
        }
    }

    public function dodge() {
        $dodgeOutcome = rand(0, 1);
        if ($dodgeOutcome === 1) {
            $this->distance += 1;
            if($this->distance > 10){
                $this->distance = 10;
            }
        }
    }
}
class WarriorAxe extends Warrior {
    use AttackUltime;

    public function __construct($name, $power, $life, Weapon $weapon) {
        parent::__construct($name, $power, $life, $weapon);
        $this->weaknesses = [ "Magic","Shield"];
    }

    protected function performAttack(Warrior $opponent) {
        $this->weapon->useWeapon();
        $return_message = "";

        if (rand(0, 2) === 0) {
            $return_message .= $this->ultimePerformAttack($opponent) . " C'était une attaque ultime !\n";
        }

        $damage = $this->weapon->getPower();
        $opponentWeaponType = $opponent->weapon->getType();
        if (in_array($opponentWeaponType, $this->weaknesses)) {
            $damage *= 2;
            $return_message .= "C'est une attaque sur faiblesse ! ";
        }
        $opponent->life -= $damage;
        if ($opponent->life < 0) {
            $opponent->life = 0;
        }
        $return_message .= $this->getName() . " attaques " . $opponent->getName() . " pour " . $damage . " dommage\n";

        return $return_message;
    }
    public function getName() {
        return $this->name;
    }

    public function getWeaponInfo() {
        return $this->weapon->getName() . " la puissance: " . $this->weapon->getPower(). " la durabilité: " . $this->weapon->getDurability(). " type: " . $this->weapon->getType();
    }
}



class WarriorSword extends Warrior {
    use AttackUltime;
    public function __construct($name, $power, $life, Weapon $weapon) {
        parent::__construct($name, $power, $life, $weapon);
        $this->weaknesses = ["Bow", "Spear"];
    }

    protected function performAttack(Warrior $opponent) {
        $this->weapon->useWeapon();
        $return_message = "";

        if (rand(0, 2) === 0) {
            $return_message .= $this->ultimePerformAttack($opponent) . " C'était une attaque ultime !\n";
        }

        $damage = $this->weapon->getPower();
        $opponentWeaponType = $opponent->weapon->getType();
        if (in_array($opponentWeaponType, $this->weaknesses)) {
            $damage *= 2;
            $return_message .= "C'est une attaque sur faiblesse ! ";
        }
        $opponent->life -= $damage;
        if ($opponent->life < 0) {
            $opponent->life = 0;
        }
        $return_message .= $this->getName() . " attaques " . $opponent->getName() . " pour " . $damage . " dommage\n";

        return $return_message;
    }

    public function getName() {
        return $this->name;
    }

    public function getWeaponInfo() {
        return $this->weapon->getName() . " la puissance: " . $this->weapon->getPower(). " la durabilité: " . $this->weapon->getDurability(). " type: " . $this->weapon->getType();
    }
}

class WarriorSpear extends Warrior {
    use AttackUltime;
    public function __construct($name, $power, $life, Weapon $weapon) {
        parent::__construct($name, $power, $life, $weapon);
        $this->weaknesses = ["Sword", "Magic"];
    }

    protected function performAttack(Warrior $opponent) {
        $this->weapon->useWeapon();
        $return_message = "";

        if (rand(0, 2) === 0) {
            $return_message .= $this->ultimePerformAttack($opponent) . " C'était une attaque ultime !\n";
        }

        $damage = $this->weapon->getPower();
        $opponentWeaponType = $opponent->weapon->getType();
        if (in_array($opponentWeaponType, $this->weaknesses)) {
            $damage *= 2;
            $return_message .= "C'est une attaque sur faiblesse ! ";
        }
        $opponent->life -= $damage;
        if ($opponent->life < 0) {
            $opponent->life = 0;
        }
        $return_message .= $this->getName() . " attaques " . $opponent->getName() . " pour " . $damage . " dommage\n";

        return $return_message;
    }

    public function getName() {
        return $this->name;
    }

    public function getWeaponInfo() {
        return $this->weapon->getName() . " la puissance: " . $this->weapon->getPower(). " la durabilité: " . $this->weapon->getDurability(). " type: " . $this->weapon->getType();
    }
}

class WarriorBow extends Warrior {
    use AttackUltime;
    public function __construct($name, $power, $life, Weapon $weapon) {
        parent::__construct($name, $power, $life, $weapon);
        $this->weaknesses = ["Sword", "Shield"];
    }

    protected function performAttack(Warrior $opponent) {
        $this->weapon->useWeapon();
        $return_message = "";

        if (rand(0, 2) === 0) {
            $return_message .= $this->ultimePerformAttack($opponent) . " C'était une attaque ultime !\n";
        }

        $damage = $this->weapon->getPower();
        $opponentWeaponType = $opponent->weapon->getType();
        if (in_array($opponentWeaponType, $this->weaknesses)) {
            $damage *= 2;
            $return_message .= "C'est une attaque sur faiblesse ! ";
        }
        $opponent->life -= $damage;
        if ($opponent->life < 0) {
            $opponent->life = 0;
        }
        $return_message .= $this->getName() . " attaques " . $opponent->getName() . " pour " . $damage . " dommage\n";

        return $return_message;
    }
    public function getName() {
        return $this->name;
    }

    public function getWeaponInfo() {
        return $this->weapon->getName() . " la puissance: " . $this->weapon->getPower(). " la durabilité: " . $this->weapon->getDurability(). " type: " . $this->weapon->getType();
    }
}


class WarriorShield extends Warrior {
    use AttackUltime;
    public function __construct($name, $power, $life, Weapon $weapon) {
        parent::__construct($name, $power, $life, $weapon);
        $this->weaknesses = ["Sword", "Magic"];
    }

    protected function performAttack(Warrior $opponent) {
        $this->weapon->useWeapon();
        $return_message = "";

        if (rand(0, 2) === 0) {
            $return_message .= $this->ultimePerformAttack($opponent) . " C'était une attaque ultime !\n";
        }

        $damage = $this->weapon->getPower();
        $opponentWeaponType = $opponent->weapon->getType();
        if (in_array($opponentWeaponType, $this->weaknesses)) {
            $damage *= 2;
            $return_message .= "C'est une attaque sur faiblesse ! ";
        }
        $opponent->life -= $damage;
        if ($opponent->life < 0) {
            $opponent->life = 0;
        }
        $return_message .= $this->getName() . " attaques " . $opponent->getName() . " pour " . $damage . " dommage\n";

        return $return_message;
    }

    public function getName() {
        return $this->name;
    }

    public function getWeaponInfo() {
        return $this->weapon->getName() . " la puissance: " . $this->weapon->getPower(). " la durabilité: " . $this->weapon->getDurability(). " type: " . $this->weapon->getType();
    }
}

class WarriorMagic extends Warrior {
    use AttackUltime;
    public function __construct($name, $power, $life, Weapon $weapon) {
        parent::__construct($name, $power, $life, $weapon);
        $this->weaknesses = ["Sword", "Shield"];
    }

    protected function performAttack(Warrior $opponent) {
        $this->weapon->useWeapon();
        $return_message = "";

        if (rand(0, 2) === 0) {
            $return_message .= $this->ultimePerformAttack($opponent) . " C'était une attaque ultime !\n";
        }

        $damage = $this->weapon->getPower();
        $opponentWeaponType = $opponent->weapon->getType();
        if (in_array($opponentWeaponType, $this->weaknesses)) {
            $damage *= 2;
            $return_message .= "C'est une attaque sur faiblesse ! ";
        }
        $opponent->life -= $damage;
        if ($opponent->life < 0) {
            $opponent->life = 0;
        }
        $return_message .= $this->getName() . " attaques " . $opponent->getName() . " pour " . $damage . " dommage\n";

        return $return_message;
    }

    public function getName() {
        return $this->name;
    }

    public function getWeaponInfo() {
        return $this->weapon->getName() . " la puissance: " . $this->weapon->getPower(). " la durabilité: " . $this->weapon->getDurability(). " type: " . $this->weapon->getType();
    }
}