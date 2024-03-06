<?php
class Warrior {
    protected $name;
    protected $power;
    protected $life;

    public function __construct($name, $power, $life) {
        $this->name = $name;
        $this->power = $power;
        $this->life = $life;
    }

    public function attack($opponent) {
        $damage = $this->getPower();
        $opponent->life -= $damage;
        if ($opponent->life < 0) {
            $opponent->life = 0;
        }
    }

    public function isAlive() {
        return $this->life > 0;
    }

    public function getName() {
        return $this->name;
    }

    public function getPower() {
        return $this->power;
    }

    public function getLife() {
        return $this->life;
    }
}

class WarriorAxe extends Warrior {
    public function attack($opponent) {
        $damage = $this->getPower();
        if ($opponent instanceof WarriorSword) {
            $damage *= 2;
        }
        $opponent->life -= $damage;
        if ($opponent->life < 0) {
            $opponent->life = 0;
        }
        return $this->getName() . " attacks " . $opponent->getName() . " for " . $damage . " damage";
    }
}

class WarriorSword extends Warrior {
    public function attack($opponent) {
        $damage = $this->getPower();
        if ($opponent instanceof WarriorSpear) {
            $damage *= 2;
        }
        $opponent->life -= $damage;
        if ($opponent->life < 0) {
            $opponent->life = 0;
        }
        return $this->getName() . " attacks " . $opponent->getName() . " for " . $damage . " damage";
    }
}

class WarriorSpear extends Warrior {
    public function attack($opponent) {
        $damage = $this->getPower();
        if ($opponent instanceof WarriorAxe) {
            $damage *= 2;
        }
        $opponent->life -= $damage;
        if ($opponent->life < 0) {
            $opponent->life = 0;
        }
        return $this->getName() . " attacks " . $opponent->getName() . " for " . $damage . " damage";
    }
}

class WarriorBow extends Warrior {
    public function attack($opponent) {
        $damage = $this->getPower();
        if ($opponent instanceof WarriorSword) {
            $damage *= 2;
        }
        $opponent->life -= $damage;
        if ($opponent->life < 0) {
            $opponent->life = 0;
        }
        return $this->getName() . " attacks " . $opponent->getName() . " for " . $damage . " damage";
    }
}

class WarriorShield extends Warrior {
    public function attack($opponent) {
        $damage = $this->getPower();
        if ($opponent instanceof WarriorBow) {
            $damage *= 2;
        }
        $opponent->life -= $damage;
        if ($opponent->life < 0) {
            $opponent->life = 0;
        }
        return $this->getName() . " attacks " . $opponent->getName() . " for " . $damage . " damage";
    }
}

class WarriorMagic extends Warrior {
    public function attack($opponent) {
        $damage = $this->getPower();
        if ($opponent instanceof WarriorShield) {
            $damage *= 2;
        }
        $opponent->life -= $damage;
        if ($opponent->life < 0) {
            $opponent->life = 0;
        }
        return $this->getName() . " attacks " . $opponent->getName() . " for " . $damage . " damage";
    }
}