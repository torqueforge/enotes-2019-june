<?php

class Bottles {
    public function song() {
        return $this->verses(99, 0);
    }

    public function verses($starting, $ending) {
        $verses = [];
        foreach (range($starting, $ending) as $number) {
            $verses[] = $this->verse($number);
        }

        return implode("\n", $verses);
    }

    public function verse($number) {
        $bottleNumber = BottleNumber::for($number);

        return
            ucfirst($bottleNumber) . " of beer on the wall, " .
            "{$bottleNumber} of beer.\n" .
            "{$bottleNumber->action()}, " .
            "{$bottleNumber->successor()} " .
            "of beer on the wall.\n";
    }
}


class BottleNumber {
    protected $number;

    public function __construct($number) {
        $this->number = $number;
    }

    public static function for(int $number) {
        $classes = [
            'BottleNumber0',
            'BottleNumber1',
            'BottleNumber',
        ];
        foreach ($classes as $className) {
            if ($className::handles($number)) {
                return new $className($number);
            }
        }


        $classNames = [
            0 => 'BottleNumber0',
            1 => 'BottleNumber1',
        ];
        if (isset($classNames[$number])) {
            return new $classNames[$number]($number);
        } else {
            return new BottleNumber($number);
        }


        $className = 'BottleNumber' . $number;
        if (class_exists($className)) {
            return new $className($number);
        } else {
            return new BottleNumber($number);
        }

        switch ($number) {
        case 0:
            $className = BottleNumber0::class;
            break;
        case 1:
            $className = BottleNumber1::class;
            break;
        default:
            $className = BottleNumber::class;
            break;
        }
        return new $className($number);
    }

    public function container() {
        return "bottles";
    }

    public function quantity() {
        return (string)$this->number;
    }

    public function action() {
        return "Take {$this->pronoun()} down and pass it around";
    }

    public function pronoun() {
        return 'one';
    }

    public function successor() {
        return BottleNumber::for($this->number - 1);
    }

    public function __toString()
    {
        return $this->quantity() . ' ' . $this->container();
    }

    public static function handles($number): bool
    {
        return true;
    }
}

class BottleNumber0 extends BottleNumber {
    public function quantity() {
        return 'no more';
    }

    public function action() {
        return 'Go to the store and buy some more';
    }

    public function successor() {
        return BottleNumber::for(99);
    }

    public static function handles($number): bool
    {
        return $number == 0;
    }
}

class BottleNumber1 extends BottleNumber {
    public function container() {
        return "bottle";
    }

    public function pronoun() {
        return 'it';
    }

    public static function handles($number): bool
    {
        return $number == 1;
    }
}
