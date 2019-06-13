<?php

require __DIR__ . "/../lib/House.php";
srand(1);

class AllTests extends \PHPUnit\Framework\TestCase {

//   Orderer tests //
  public function test_unchanged_orderer() {
      $data     = array("a", "b", "c", "d");
      $expected = $data;
      $this->assertEquals($expected, (new UnchangedOrderer())->order($data));
  }

  public function test_random_orderer() {
    $data     = array("a", "b", "c", "d");
    $expected = array("d", "a", "c", "b");
    $this->assertEquals($expected, (new RandomOrderer())->order($data));
  }

  public function test_mostly_random_orderer() {
    $data     = array("a", "b", "c", "d", "e", "always_last");
    $expected = array("a", "c", "b", "e", "d", "always_last");
    $this->assertEquals($expected, (new MostlyRandomOrderer())->order($data));
  }

  public function test_mixed_column_orderer() {
    $data     = array(["a1", "a2"], ["b1", "b2"], ["c1", "c2"], ["d1", "d2"], ["e1", "e2"]);
    $expected = array(["e1", "d2"], ["c1", "b2"], ["a1", "c2"], ["d1", "a2"], ["b1", "e2"]);
    $this->assertEquals($expected, (new MixedColumnOrderer())->order($data));
  }


  // Phrases tests //
  public function test_phrases_handles_1d_list() {
    $input    = array("phrase a", "phrase b", "phrase c", "phrase d", "phrase e");
    $expected = "phrase d phrase e";
    $this->assertEquals($expected, (new Phrases(UnchangedOrderer::class, $input))->phrase(2));
  }

  public function test_phrases_handles_2d_list() {
    $input    = array(  ["phrase a1", "phrase a2"],
                        ["phrase b1", "phrase b2"],
                        ["phrase c1", "phrase c2"],
                        ["phrase d1", "phrase d2"],
                        ["phrase e1", "phrase e2"]);
    $expected = "phrase d1 phrase d2 phrase e1 phrase e2";
    $this->assertEquals($expected, (new Phrases(UnchangedOrderer::class, $input))->phrase(2));
  }

  public function test_phrases_handles_2d_list_with_mixed_column_orderer() {
    $input    = array(  ["phrase a1", "phrase a2"],
                        ["phrase b1", "phrase b2"],
                        ["phrase c1", "phrase c2"],
                        ["phrase d1", "phrase d2"],
                        ["phrase e1", "phrase e2"]);
    $expected = "phrase c1 phrase c2 phrase a1 phrase b2";
    $this->assertEquals($expected, (new Phrases(MixedColumnOrderer::class, $input))->phrase(2));
  }

  // House tests //
  public function test_line_1() {
    $expected = "This is the house that Jack built.\n";
    $this->assertEquals($expected, (new House(new Phrases))->line(1));
  }

  public function test_line_2() {
    $expected = "This is the malt that lay in the house that Jack built.\n";
    $this->assertEquals($expected, (new House(new Phrases))->line(2));
  }

  public function test_line_3() {
    $expected = "This is the rat that ate the malt that lay in the house that Jack built.\n";
    $this->assertEquals($expected, (new House(new Phrases))->line(3));
  }

  public function test_line_4() {
    $expected = "This is the cat that killed the rat that ate the malt that lay in the house that Jack built.\n";
    $this->assertEquals($expected, (new House(new Phrases))->line(4));
  }

  public function test_line_5() {
    $expected = "This is the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.\n";
    $this->assertEquals($expected, (new House(new Phrases))->line(5));
  }

  public function test_line_6() {
    $expected = "This is the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.\n";
    $this->assertEquals($expected, (new House(new Phrases))->line(6));
  }

  public function test_line_7() {
    $expected = "This is the maiden all forlorn that milked the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.\n";
    $this->assertEquals($expected, (new House(new Phrases))->line(7));
  }

  public function test_line_8() {
    $expected = "This is the man all tattered and torn that kissed the maiden all forlorn that milked the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.\n";
    $this->assertEquals($expected, (new House(new Phrases))->line(8));
  }

  public function test_line_9() {
    $expected = "This is the priest all shaven and shorn that married the man all tattered and torn that kissed the maiden all forlorn that milked the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.\n";
    $this->assertEquals($expected, (new House(new Phrases))->line(9));
  }

  public function test_line_10() {
    $expected = "This is the rooster that crowed in the morn that woke the priest all shaven and shorn that married the man all tattered and torn that kissed the maiden all forlorn that milked the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.\n";
    $this->assertEquals($expected, (new House(new Phrases))->line(10));
  }

  public function test_line_11() {
    $expected = "This is the farmer sowing his corn that kept the rooster that crowed in the morn that woke the priest all shaven and shorn that married the man all tattered and torn that kissed the maiden all forlorn that milked the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.\n";
    $this->assertEquals($expected, (new House(new Phrases))->line(11));
  }

  public function test_line_12() {
    $expected = "This is the horse and the hound and the horn that belonged to the farmer sowing his corn that kept the rooster that crowed in the morn that woke the priest all shaven and shorn that married the man all tattered and torn that kissed the maiden all forlorn that milked the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.\n";
    $this->assertEquals($expected, (new House(new Phrases))->line(12));
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
    $this->assertEquals($expected, (new House(new Phrases))->recite());
  }
}
