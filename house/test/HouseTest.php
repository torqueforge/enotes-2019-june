<?php

require __DIR__ . "/../lib/House.php";

class HouseTest extends \PHPUnit\Framework\TestCase {
  public function test_line_1() {
    $expected = "This is the house that Jack built.\n";
    $this->assertEquals($expected, (new House())->line(1));
  }

  public function test_line_2() {
    $expected = "This is the malt that lay in the house that Jack built.\n";
    $this->assertEquals($expected, (new House())->line(2));
  }

  public function test_line_3() {
    $expected = "This is the rat that ate the malt that lay in the house that Jack built.\n";
    $this->assertEquals($expected, (new House())->line(3));
  }

  public function test_line_4() {
    $expected = "This is the cat that killed the rat that ate the malt that lay in the house that Jack built.\n";
    $this->assertEquals($expected, (new House())->line(4));
  }

  public function test_line_5() {
    $expected = "This is the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.\n";
    $this->assertEquals($expected, (new House())->line(5));
  }

  public function test_line_6() {
    $expected = "This is the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.\n";
    $this->assertEquals($expected, (new House())->line(6));
  }

  public function test_line_7() {
    $expected = "This is the maiden all forlorn that milked the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.\n";
    $this->assertEquals($expected, (new House())->line(7));
  }

  public function test_line_8() {
    $expected = "This is the man all tattered and torn that kissed the maiden all forlorn that milked the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.\n";
    $this->assertEquals($expected, (new House())->line(8));
  }

  public function test_line_9() {
    $expected = "This is the priest all shaven and shorn that married the man all tattered and torn that kissed the maiden all forlorn that milked the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.\n";
    $this->assertEquals($expected, (new House())->line(9));
  }

  public function test_line_10() {
    $expected = "This is the rooster that crowed in the morn that woke the priest all shaven and shorn that married the man all tattered and torn that kissed the maiden all forlorn that milked the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.\n";
    $this->assertEquals($expected, (new House())->line(10));
  }

  public function test_line_11() {
    $expected = "This is the farmer sowing his corn that kept the rooster that crowed in the morn that woke the priest all shaven and shorn that married the man all tattered and torn that kissed the maiden all forlorn that milked the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.\n";
    $this->assertEquals($expected, (new House())->line(11));
  }

  public function test_line_12() {
    $expected = "This is the horse and the hound and the horn that belonged to the farmer sowing his corn that kept the rooster that crowed in the morn that woke the priest all shaven and shorn that married the man all tattered and torn that kissed the maiden all forlorn that milked the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.\n";
    $this->assertEquals($expected, (new House())->line(12));
  }

  public function test_all_lines() {
    $expected = <<< TALE
This is the house that Jack built.

This is the malt that lay in the house that Jack built.

This is the rat that ate the malt that lay in the house that Jack built.

This is the cat that killed the rat that ate the malt that lay in the house that Jack built.

This is the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.

This is the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.

This is the maiden all forlorn that milked the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.

This is the man all tattered and torn that kissed the maiden all forlorn that milked the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.

This is the priest all shaven and shorn that married the man all tattered and torn that kissed the maiden all forlorn that milked the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.

This is the rooster that crowed in the morn that woke the priest all shaven and shorn that married the man all tattered and torn that kissed the maiden all forlorn that milked the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.

This is the farmer sowing his corn that kept the rooster that crowed in the morn that woke the priest all shaven and shorn that married the man all tattered and torn that kissed the maiden all forlorn that milked the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.

This is the horse and the hound and the horn that belonged to the farmer sowing his corn that kept the rooster that crowed in the morn that woke the priest all shaven and shorn that married the man all tattered and torn that kissed the maiden all forlorn that milked the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.

TALE;
    $this->assertEquals($expected, (new House())->recite());
  }
}
