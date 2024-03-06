
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
        $opponent->life -= $this->power;
    }

    public function isAlive() {
        return $this->life > 0;
    }
    public function getName() {
        return $this->name;
    }
}
class WarriorAxe extends Warrior {
    public function attack($opponent) {
        if ($opponent instanceof WarriorSword) {
            $opponent->life -= $this->power * 2;
        } else {
            parent::attack($opponent);
        }
    }
}

class WarriorSword extends Warrior {
    public function attack($opponent) {
        if ($opponent instanceof WarriorSpear) {
            $opponent->life -= $this->power * 2;
        } else {
            parent::attack($opponent);
        }
    }
}

class WarriorSpear extends Warrior {
    public function attack($opponent) {
        if ($opponent instanceof WarriorAxe) {
            $opponent->life -= $this->power * 2;
        } else {
            parent::attack($opponent);
        }
    }
}



