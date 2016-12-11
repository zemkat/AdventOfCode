<?php
#
# p10a.php -- Day 10: Balance Bots
#
#   Yay! The first puzzle fancy enough to implement a class
#

$lines = file($argv[1]);
sort($lines);
$botnet = array();
$work_queue = array();

$CHIP_LOW = 17;
$CHIP_HIGH = 61;

foreach ($lines as $line) {
	if (preg_match("/bot (\d+) gives low to (bot|output) (\d+) and high to (bot|output) (\d+)/", $line, $m)) {
		if ($m[2] == "output") { $low_target = -1; } else { $low_target = $m[3]; }
		if ($m[4] == "output") { $high_target = -1; } else { $high_target = $m[5]; }
		$botnet[$m[1]] = new bot($m[1],$low_target,$high_target);
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

while ($bot = array_shift($work_queue)) {
	if (($bot->inventory[0] == $CHIP_LOW) and ($bot->inventory[1] == $CHIP_HIGH)) {
		print $bot->label . "\n"; exit;
	}
	if ($bot->low_target > -1) {
		$botnet[$bot->low_target]->accept($bot->inventory[0]);
		if ($botnet[$bot->low_target]->full()) {
			array_push($work_queue,$botnet[$bot->low_target]);
		}
	}
	if ($bot->high_target > -1) {
		$botnet[$bot->high_target]->accept($bot->inventory[1]);
		if ($botnet[$bot->high_target]->full()) {
			array_push($work_queue,$botnet[$bot->high_target]);
		}
	}
}


class bot {
	public $label;
	public $inventory = array();
	public $low_target; public $high_target; # who to give to

	function __construct($label,$low_target,$high_target) {
		$this->label = $label;
		$this->low_target = $low_target;
		$this->high_target = $high_target;
	}

	function accept($chip) { 
		array_push($this->inventory, $chip);
		sort($this->inventory,SORT_NUMERIC);
	}

	function full() {
		return (sizeof($this->inventory) == 2);
	}

}

