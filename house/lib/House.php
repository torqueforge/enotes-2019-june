<?php

class Phrases {
  protected $data;

  const LIST =
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

  public function __construct($ordererClass = UnchangedOrderer::class) {
    $this->data = (new $ordererClass)->order(self::LIST);
  }

  public function data() {
    return $this->data;
  }

  public function phrase($number) {
    return implode(' ' ,(array_slice($this->data(), 0-$number, $number, true)));
  }
}


class House {
  // protected $data;
  protected $phrases;
  protected $prefixer;

  // const LIST =
  //   array(
  //     "the horse and the hound and the horn that belonged to",
  //     "the farmer sowing his corn that kept",
  //     "the rooster that crowed in the morn that woke",
  //     "the priest all shaven and shorn that married",
  //     "the man all tattered and torn that kissed",
  //     "the maiden all forlorn that milked",
  //     "the cow with the crumpled horn that tossed",
  //     "the dog that worried",
  //     "the cat that killed",
  //     "the rat that ate",
  //     "the malt that lay in",
  //     "the house that Jack built");

  public function __construct(
      // $ordererClass  = UnchangedOrderer::class,
      $prefixerClass = MundanePrefixer::Class,
      $phrasesClass  = Phrases::class) {

    // $this->data = (new $ordererClass)->order(self::LIST);
    $this->phrases = (new $phrasesClass);
    $this->prefixer = (new $prefixerClass);
  }

  // public function data() {
  //   return $this->data;
  // }

  public function phrases() {
    return $this->phrases;
  }

  public function prefixer() {
    return $this->prefixer;
  }

  public function recite() {
    $lines = [];
    foreach (range(1, 12) as $number) {
      $lines[] = $this->line($number);
    }

    return implode("\n", $lines);
  }

  public function phrase($number) {
    return $this->phrases()->phrase($number);
  }

  public function line($number) {
    return "{$this->prefix()} {$this->phrase($number)}.\n";
  }

  public function prefix() {
    return $this->prefixer()->prefix();
  }
}


////////
class RandomOrderer {
  public function order($data) {
    shuffle($data);
    return $data;
  }
}

class UnchangedOrderer {
  public function order($data) {
    return $data;
  }
}

class MostlyRandomOrderer {
  public function order($data) {
    $last = array_pop($data);
    shuffle($data);
    array_push($data, $last);
    return $data;
  }
}


////////
class PiratePrefixer {
  public function prefix() {
    return "Thar be";
  }
}

class MundanePrefixer {
  public function prefix() {
    return "This is";
  }
}


// print "\n";
// print (new House(RandomOrderer::class))->line(12);

// print "\n";
// print (new House(UnchangedOrderer::class, PiratePrefixer::class))->line(12);

// print "\n";
// print (new House(RandomOrderer::class, PiratePrefixer::class))->line(12);

// print "\n";
// print (new House(MostlyRandomOrderer::class))->line(12);
