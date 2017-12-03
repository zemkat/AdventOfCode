<?php
#
# p02a.php -- Day 2: Corruption Checksum
#
# (c)2017 @zemkat

$lines = file($argv[1],FILE_IGNORE_NEW_LINES);
$sum = 0;
foreach ($lines as $line) {
	$nums = preg_split("/[\s]+/",$line);
	$max = -1; $min = 10000;
	foreach ($nums as $num) {
		if ($num > $max) { $max = $num; }
		if ($num < $min) { $min = $num; }
	}
	#print "Adding $max - $min...\n";
	$sum += $max - $min;
}

print $sum . "\n";
