<?php
#
# p10b.php -- Day 10: Balance Bots
#
#   I was pretty sure I'd regret just discarding all the chips aimed at "output" bins,
#     and was pleased that I could retrieve just the few I needed without massive change
#     to the data structure.
#


$lines = file($argv[1]);
sort($lines);
$botnet = array();
$work_queue = array();

$CHIP_LOW = 17;
$CHIP_HIGH = 61;

foreach ($lines as $line) {
	if (preg_match("/bot (\d+) gives low to (bot|output) (\d+) and high to (bot|output) (\d+)/", $line, $m)) {
		$output012L = false; $output012H = false;
		if ($m[2] == "output") {
			$low_target = -1;
			if ($m[3] < 3) { $output012L = true; }
		} else {
			$low_target = $m[3];
		}
		if ($m[4] == "output") {
			$high_target = -1;
			if ($m[5] < 3) { $output012H = true; }
		} else {
			$high_target = $m[5];
		 }

		$botnet[$m[1]] = new bot($m[1],$low_target,$high_target, $output012L, $output012H);
	} else {
		if (preg_match("/value (\d+) goes to bot (\d+)/", $line, $m)) {
			$botnet[$m[2]]->accept($m[1]);
			if ($botnet[$m[2]]->full()) {
				array_push($work_queue,$botnet[$m[2]]);
			}
		} else {
			print "BAD LINE: $line\n";
		}
	}
}

$product = 1;

while ($bot = array_shift($work_queue)) {
	if ($bot->low_target > -1) {
		$botnet[$bot->low_target]->accept($bot->inventory[0]);
		if ($botnet[$bot->low_target]->full()) {
			array_push($work_queue,$botnet[$bot->low_target]);
		}
	} else {
		if ($bot->output012L) { $product *= $bot->inventory[0]; }
	}
	if ($bot->high_target > -1) {
		$botnet[$bot->high_target]->accept($bot->inventory[1]);
		if ($botnet[$bot->high_target]->full()) {
			array_push($work_queue,$botnet[$bot->high_target]);
		}
	} else {
		if ($bot->output012H) { $product *= $bot->inventory[1]; }
	}
}

print $product . "\n";

class bot {
	public $label;
	public $inventory = array();
	public $low_target; public $high_target; # who to give to
	public $output012L, $output012H; # omg

	function __construct($label,$low_target,$high_target,$output012L,$output012H) {
		$this->label = $label;
		$this->low_target = $low_target;
		$this->high_target = $high_target;
		$this->output012L = $output012L;
		$this->output012H = $output012H;
	}

	function accept($chip) { 
		array_push($this->inventory, $chip);
		sort($this->inventory,SORT_NUMERIC);
	}

	function full() {
		return (sizeof($this->inventory) == 2);
	}

}

