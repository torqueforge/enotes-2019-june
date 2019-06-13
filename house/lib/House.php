<?php

class House {
    public function line($number)
    {
        switch ($number) {
        case 1:
            return "This is the house that Jack built.\n";
        case 2:
            return "This is the malt that lay in the house that Jack built.\n";
        case 3:
            return "This is the rat that ate the malt that lay in the house that Jack built.\n";
        case 4:
            return "This is the cat that killed the rat that ate the malt that lay in the house that Jack built.\n";
        case 5:
            return "This is the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.\n";
        case 6:
            return "This is the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.\n";
        case 7:
            return "This is the maiden all forlorn that milked the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.\n";
        case 8:
            return "This is the man all tattered and torn that kissed the maiden all forlorn that milked the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.\n";
        case 9:
            return "This is the priest all shaven and shorn that married the man all tattered and torn that kissed the maiden all forlorn that milked the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.\n";
        case 10:
            return "This is the rooster that crowed in the morn that woke the priest all shaven and shorn that married the man all tattered and torn that kissed the maiden all forlorn that milked the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.\n";
        case 11:
            return "This is the farmer sowing his corn that kept the rooster that crowed in the morn that woke the priest all shaven and shorn that married the man all tattered and torn that kissed the maiden all forlorn that milked the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.\n";
        case 12:
            return "This is the horse and the hound and the horn that belonged to the farmer sowing his corn that kept the rooster that crowed in the morn that woke the priest all shaven and shorn that married the man all tattered and torn that kissed the maiden all forlorn that milked the cow with the crumpled horn that tossed the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built.\n";
        }
    }

    public function recite()
    {
        $tale = [];
        for ($line = 1; $line <= 12; $line++) {
            $tale[] = $this->line($line);
        }
        return implode("\n", $tale);
    }
}
