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
    $this->assertEquals($expected, (new Phrases($input))->phrase(2));
  }

  public function test_phrases_handles_2d_list_with_default_orderer() {
    $input    = array(  ["phrase a1", "phrase a2"],
                        ["phrase b1", "phrase b2"],
                        ["phrase c1", "phrase c2"],
                        ["phrase d1", "phrase d2"],
                        ["phrase e1", "phrase e2"]);
    $expected = "phrase d1 phrase d2 phrase e1 phrase e2";
    $this->assertEquals($expected, (new Phrases($input))->phrase(2));
  }

  public function test_phrases_handles_2d_list_containing_nulls() {
    $input    = array(  ["phrase a1", "phrase a2", "phrase a3"],
                        ["phrase b1", NULL, "phrase b2"],
                        [NULL, "phrase c2", "phrase c3"],
                        ["phrase d1", "phrase d2", NULL],
                        ["phrase e1", "phrase e2", "phrase e3"]);
    $expected = "phrase c2 phrase c3 phrase d1 phrase d2 phrase e1 phrase e2 phrase e3";
    $this->assertEquals($expected, (new Phrases($input))->phrase(3));
  }

  // Should you delete this test?  Discuss!
  public function test_phrases_handles_2d_list_with_mixed_column_orderer() {
    $input    = array(  ["phrase a1", "phrase a2"],
                        ["phrase b1", "phrase b2"],
                        ["phrase c1", "phrase c2"],
                        ["phrase d1", "phrase d2"],
                        ["phrase e1", "phrase e2"]);
    $expected = "phrase c1 phrase c2 phrase a1 phrase b2";
    $this->assertEquals($expected, (new Phrases($input, MixedColumnOrderer::class))->phrase(2));
  }


  // House tests //
  public function test_line() {
    $input    = array("phrase a", "phrase b", "phrase c", "phrase d", "phrase e");
    $expected = "This is phrase c phrase d phrase e.\n";
    $this->assertEquals($expected, (new CumulativeTale(new Phrases($input)))->line(3));
  }

  public function test_recite() {
    $input    = array("phrase a", "phrase b", "phrase c", "phrase d", "phrase e");
    $expected = "This is phrase c phrase d phrase e.\n";

    $expected = <<< TALE
This is phrase e.

This is phrase d phrase e.

This is phrase c phrase d phrase e.

This is phrase b phrase c phrase d phrase e.

This is phrase a phrase b phrase c phrase d phrase e.

TALE;
    $this->assertEquals($expected, (new CumulativeTale(new Phrases($input)))->recite());
  }
}
