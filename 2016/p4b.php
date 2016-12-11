<?php
#
# p4b.php -- Day 4: Security Through Obscurity
#
#   They were not expecting to deal with a master cryptographer like myself.
#
# (c)2016 @zemkat

$total = 0;
$lines = file($argv[1]);

$atoz = range('a','z');

foreach($lines as $line) {
	if (preg_match("/([a-z-]+)-(\d+)\[([a-z]+)\]/", $line, $m)) {
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
		#print "DOESIT: $doesit\n";
		if ($doesit == $cksum) {
			# DECRYPT
			#$total += $id;
			$translation = "";
			foreach ($chars as $char) {
				if ($char == "-") { $translation .= " "; continue; }
				$translation .= $atoz[(array_search($char,$atoz) + $id) % 26];
			}
			print "Room $id: $translation\n";
		}
	} else {
		print "BAD FORM: $line\n";
	}
}

#print $total . "\n";

function cmp($a,$b) {  # if $a < $b, return -1
	global $tally;
	if ($tally[$a] < $tally[$b]) return -1;
	if ($tally[$a] > $tally[$b]) return 1;
	if ($tally[$a] == $tally[$b]) {
		if ($a < $b) return 1;
		if ($a > $b) return -1;
	}
}


