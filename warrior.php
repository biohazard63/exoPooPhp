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

    public function __construct($name, $power, $life, Weapon $weapon) {
        $this->name = $name;
        $this->power = $power;
        $this->life = $life;
        $this->weapon = $weapon;

    }
    public function attack(Warrior $opponent) {
        $distance = $this->getDistanceTo($opponent);
        $range = $this->weapon->getAttackRange();

        // Le message de journal indique si le guerrier peut attaquer ou non.
        $logMessage = $this->getName() . " est a " . $distance . "M de " . $opponent->getName();
        $logMessage .= $distance <= $range ? " - se préparant à attaquer.\n" : " - hors de portée.\n";

        if ($distance > $range) {
            // Si l'adversaire est hors de portée, le guerrier avance.
            $this->reduceDistance();
            $logMessage .= $this->getName() . " avances.\n";
        } else {
            // Si l'adversaire est à portée, le guerrier attaque et l'adversaire recule.
            $logMessage .= $this->performAttack($opponent);
            $opponent->increaseDistance();
            $logMessage .= $this->getName() . " attaques. " . $opponent->getName() . " recule.\n";
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
        if ($opponent instanceof WarriorSword) {
            $damage *= 2;
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
    public function reduceDistance() {
        if($this->distance > 0){ //Assurez-vous que la distance ne peut pas être inférieure à 0
            $this->distance -= 1;
        }
    }

    public function increaseDistance() {
        if($this->distance < 10){ //Assurez-vous que la distance ne peut pas être supérieure à 10
            $this->distance += 1;
        }
    }
}


class WarriorAxe extends Warrior {
    use AttackUltime;

    public function __construct($name, $power, $life, Weapon $weapon) {
        parent::__construct($name, $power, $life, $weapon);
    }

    protected function performAttack(Warrior $opponent) {
        $this->weapon->useWeapon();
        $return_message = "";

        if (rand(0, 2) === 0) {
            $return_message .= $this->ultimePerformAttack($opponent) . " C'était une attaque ultime !\n";
        }

        $damage = $this->weapon->getPower();
        if ($opponent instanceof WarriorSword) {
            $damage *= 2;
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
    }

    protected function performAttack(Warrior $opponent) {
        $this->weapon->useWeapon();
        $return_message = "";

        if (rand(0, 2) === 0) {
            $return_message .= $this->ultimePerformAttack($opponent) . " C'était une attaque ultime !\n";
        }

        $damage = $this->weapon->getPower();
        if ($opponent instanceof WarriorSword) {
            $damage *= 2;
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
    }

    protected function performAttack(Warrior $opponent) {
        $this->weapon->useWeapon();
        $return_message = "";

        if (rand(0, 2) === 0) {
            $return_message .= $this->ultimePerformAttack($opponent) . " C'était une attaque ultime !\n";
        }

        $damage = $this->weapon->getPower();
        if ($opponent instanceof WarriorSword) {
            $damage *= 2;
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
    }

    protected function performAttack(Warrior $opponent) {
        $this->weapon->useWeapon();
        $return_message = "";

        if (rand(0, 2) === 0) {
            $return_message .= $this->ultimePerformAttack($opponent) . " C'était une attaque ultime !\n";
        }

        $damage = $this->weapon->getPower();
        if ($opponent instanceof WarriorSword) {
            $damage *= 2;
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
    }

    protected function performAttack(Warrior $opponent) {
        $this->weapon->useWeapon();
        $return_message = "";

        if (rand(0, 2) === 0) {
            $return_message .= $this->ultimePerformAttack($opponent) . " C'était une attaque ultime !\n";
        }

        $damage = $this->weapon->getPower();
        if ($opponent instanceof WarriorSword) {
            $damage *= 2;
        }
        $opponent->life -= $damage;
        if ($opponent->life < 0) {
            $opponent->life = 0;
        }
        $return_message .= $this->getName() . " attaques " . $opponent->getName() . " pour " . $damage . " v\n";

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
    }

    protected function performAttack(Warrior $opponent) {
        $this->weapon->useWeapon();
        $return_message = "";

        if (rand(0, 2) === 0) {
            $return_message .= $this->ultimePerformAttack($opponent) . " C'était une attaque ultime !\n";
        }

        $damage = $this->weapon->getPower();
        if ($opponent instanceof WarriorSword) {
            $damage *= 2;
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