<?php
#
# p6b.php -- Day 6: Signals and Noise
#
#   The sneakiest message of all.
#
# (c)2016 @zemkat

$lines = file($argv[1]);

$length = 8;
$atoz = range('a','z');
for ($j=0;$j<$length;$j++) {
	foreach ($atoz as $letter) {
		$stats[$j][$letter] = 0;
	}
}

foreach ($lines as $line) {
	$chars = str_split($line);
	for ($j=0;$j<$length;$j++) {
		$stats[$j][$line[$j]]++;			
	}
}

for ($j=0;$j<$length;$j++) {
	foreach ($stats[$j] as $k => $v) {
		if ($v == 0) {
			unset($stats[$j][$k]);
		}
	}
	asort($stats[$j]);
	$keys = array_keys($stats[$j]); print $keys[0];
}

print "\n";
