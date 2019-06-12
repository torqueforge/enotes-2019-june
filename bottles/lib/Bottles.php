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
    $bottleNumber = $this->bottleNumberFor($number);
    $nextBottleNumber = $this->bottleNumberFor($bottleNumber->successor());

    return
      ucfirst($bottleNumber->quantity()) .
      " {$bottleNumber->container()} of beer on the wall, " .
      "{$bottleNumber->quantity()} {$bottleNumber->container()} of beer.\n" .
      "{$bottleNumber->action()}, " .
      "{$nextBottleNumber->quantity()} " .
      "{$nextBottleNumber->container()} " .
      "of beer on the wall.\n";
  }

  public function bottleNumberFor($number) {
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
}

class BottleNumber {
  protected $number;

  public function __construct($number) {
    $this->number = $number;
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
    return $this->number - 1;
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
    return 99;
  }
}

class BottleNumber1 extends BottleNumber {
  public function container() {
    return "bottle";
  }

  public function pronoun() {
    return 'it';
  }
}
