<?php
#
# p4a.php -- Day 4: Security Through Obscurity
#
#   usort, my old friend.
#
# (c)2016 @zemkat

$total = 0;
$lines = file($argv[1]);

foreach($lines as $line) {
	preg_match("/([a-z-]+)-(\d+)\[([a-z]+)\]/", $line, $m);
	$cksum = $m[3];
	$id = $m[2];
	$chars = str_split($m[1]);
	$tally = array();
	foreach (range('a','z') as $char) {
		$tally[$char] = 0;
	}
	foreach ($chars as $char) {
		if ($char !== "-") {
			$tally[$char]++;
		}
	}
	$keys = range('a','z');
	usort($keys,"cmp");
	$doesit = "";
	for($j=25;$j>20;$j--) { $doesit .= $keys[$j]; }
	if ($doesit == $cksum) {
		$total += $id;
	}
}

print $total . "\n";

function cmp($a,$b) {  # if $a < $b, return -1
	global $tally;
	if ($tally[$a] < $tally[$b]) return -1;
	if ($tally[$a] > $tally[$b]) return 1;
	if ($tally[$a] == $tally[$b]) {
		if ($a < $b) return 1;
		if ($a > $b) return -1;
	}
}


