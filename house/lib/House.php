<?php

class House {
  public function recite() {
    $lines = [];
    foreach (range(1, 12) as $number) {
      $lines[] = $this->line($number);
    }

    return implode("\n", $lines);
  }

  public function phrase($number) {
    $phrases =
      array(
        "the horse and the hound and the horn that belonged to ",
        "the farmer sowing his corn that kept ",
        "the rooster that crowed in the morn that woke ",
        "the priest all shaven and shorn that married ",
        "the man all tattered and torn that kissed ",
        "the maiden all forlorn that milked ",
        "the cow with the crumpled horn that tossed ",
        "the dog that worried ",
        "the cat that killed ",
        "the rat that ate ",
        "the malt that lay in ",
        "");

    return implode('' ,(array_slice($phrases, 0-$number, $number, true)));
  }

  public function line($number) {
    return "This is {$this->phrase($number)}the house that Jack built.\n";
  }
}
