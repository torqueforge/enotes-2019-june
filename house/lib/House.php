<?php

class House {
  public function recite() {
    $lines = [];
    foreach (range(1, 12) as $number) {
      $lines[] = $this->line($number);
    }

    return implode("\n", $lines);
  }

  public function phrase($number=2) {
    return implode(' ' ,(array_slice($this->data(), 0-$number, $number, true)));
  }

  public function line($number) {
    return "{$this->prefix()} {$this->phrase($number)}.\n";
  }

  public function prefix() {
    return "This is";
  }

  public function data() {
    return
      array(
        "the horse and the hound and the horn that belonged to",
        "the farmer sowing his corn that kept",
        "the rooster that crowed in the morn that woke",
        "the priest all shaven and shorn that married",
        "the man all tattered and torn that kissed",
        "the maiden all forlorn that milked",
        "the cow with the crumpled horn that tossed",
        "the dog that worried",
        "the cat that killed",
        "the rat that ate",
        "the malt that lay in",
        "the house that Jack built");
  }
}

class RandomHouse extends House {
  public function data() {
    static $randomized = null;
    if(is_null($randomized)) {
        $randomized = (parent::data());
        shuffle($randomized);
    }
    return $randomized;
  }
}

print (new RandomHouse)->line(12);


class PirateHouse extends House {
  public function prefix() {
    return "Thar be";
  }
}

print "\n";

print (new PirateHouse)->line(12);

print "\n";