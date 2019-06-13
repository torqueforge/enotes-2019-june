<?php

const HOUSE_PHRASES =
  array(
    ["the horse and the hound and the horn", "that belonged to"],
    ["the farmer sowing his corn", "that kept"],
    ["the rooster that crowed in the morn", "that woke"],
    ["the priest all shaven and shorn", "that married"],
    ["the man all tattered and torn", "that kissed"],
    ["the maiden all forlorn", "that milked"],
    ["the cow with the crumpled horn", "that tossed"],
    ["the dog", "that worried"],
    ["the cat", "that killed"],
    ["the rat", "that ate"],
    ["the malt", "that lay in"],
    ["the house", "that Jack built"]);

class Phrases {
  protected $data;

  public function __construct($input = HOUSE_PHRASES, $ordererClass = UnchangedOrderer::class) {
    $this->data = (new $ordererClass)->order($input);
  }

  public function data() {
    return $this->data;
  }

  public function phrase($number) {
    $flattened = $this->flatten(array_slice($this->data(), 0-$number, $number, true));
    return implode(' ' , $flattened);
  }

  public function length() {
    return count($this->data());
  }

  // This makes me cry
  public function flatten($array = null) {
    $result = array();

    if (!is_array($array)) {
        $array = func_get_args();
    }

    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $result = array_merge($result, $this->flatten($value));
        } else {
            $result = array_merge($result, array($key => $value));
        }
    }

    return $result;
  }
}


class House {
  protected $phrases;
  protected $prefixer;

  public function __construct(
      $phrases = null,
      $prefixerClass = MundanePrefixer::Class) {

    $this->phrases = ($phrases) ?: new Phrases;
    $this->prefixer = (new $prefixerClass);
  }

  public function phrases() {
    return $this->phrases;
  }

  public function prefixer() {
    return $this->prefixer;
  }

  public function recite() {
    $lines = [];
    foreach (range(1, $this->phrases()->length()) as $number) {
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

class MixedColumnOrderer {
  public function order($data) {
    $columns = array_map(null, ...$data);
    foreach ($columns as &$column) { shuffle($column); }
    return array_map(null, ...$columns);
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
$phrases = new Phrases(HOUSE_PHRASES, MixedColumnOrderer::class);
print(new House($phrases))->line(12);
