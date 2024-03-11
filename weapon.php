<?php

class Weapon {
    protected $name;
    protected $power;
    protected $type;
    protected $durability;
    protected $attackRange;


    public function __construct($name, $power, $type, $durability, $attackRange  ) {
        $this->name = $name;
        $this->power = $power;
        $this->type = $type;
        $this->durability = $durability;
        $this->attackRange = $attackRange;

    }

    public function getName() {
        return $this->name;
    }

    public function getPower() {
        return $this->power;
    }

    public function getType() {
        return $this->type;
    }

    public function getDurability() {
        return $this->durability;
    }
    public function useWeapon() {
        if ($this->durability > 0) {
            $this->durability = max(0, $this->durability - 5);
        } else {
            $this->power = 1;  // l'arme est cassée, elle ne fait pas de dégâts.
        }
    }
    public function getAttackRange() {
        return $this->attackRange;
    }
}

class Axe extends Weapon {
    public function __construct() {
        parent::__construct('Axe', 25, 'Axe', 100,2);
    }


}

class Sword extends Weapon {
    public function __construct() {
        parent::__construct('Sword', 10, 'Sword', 100,4);
    }
}

class Spear extends Weapon {
    public function __construct() {
        parent::__construct('Spear', 10, 'Spear', 100,6);

    }
}

class Bow extends Weapon {
    public function __construct() {
        parent::__construct('Bow', 15, 'Bow', 100,10);
    }
}

class Shield extends Weapon {
    public function __construct() {
        parent::__construct('Shield', 10, 'Shield', 100,2);
    }
}

class Magic extends Weapon {
    public function __construct() {
        parent::__construct('Magic', 20, 'Magic', 100,10);
    }
}