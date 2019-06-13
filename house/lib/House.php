<?php

class House {
  protected $data;
  protected $prefixer;

  const LIST =
    [
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
      "the house that Jack built"];

  public function __construct($orderer = null, $prefixer = null)
  {
      if (!$orderer) {
          $orderer = new UnchangedOrderer();
      }
      if (!$prefixer) {
          $prefixer = new MundanePrefixer();
      }

    $this->data = $orderer->order(self::LIST);
    $this->prefixer = $prefixer;
  }

  public function data() {
    return $this->data;
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
    return implode(' ' ,(array_slice($this->data(), 0-$number, $number, true)));
  }

  public function line($number) {
    return "{$this->prefix()} {$this->phrase($number)}.\n";
  }

  public function prefix() {
    return $this->prefixer()->prefix();
  }
}


////////
class RandomOrderer
{
  public function order($data) {
    shuffle($data);
    return $data;
  }
}

class UnchangedOrderer
{
  public function order($data) {
    return $data;
  }
}

class MostlyRandomOrderer
{
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


print "\n";
print (new House(new RandomOrderer()))->line(12);


print "\n";
print (new House(new UnchangedOrderer(), new PiratePrefixer()))->line(12);


print "\n";
print (new House(new RandomOrderer(), new PiratePrefixer()))->line(12);

print "\n";
print (new House(new MostlyRandomOrderer))->line(12);
