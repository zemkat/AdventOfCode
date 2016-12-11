<?php
#
# p6a.php -- Day 6: Signals and Noise
#
#   Error correcting codes FTW!
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
	arsort($stats[$j]);
	$keys = array_keys($stats[$j]); print $keys[0];
}

print "\n";
