<?php
#
# p04a.php -- Day 4: High-Entropy Passphrases
#
# (c)2017 @zemkat

$lines = file($argv[1]);

$valid = 0;
foreach ($lines as $line) {
	$words = preg_split("/\s/",$line);
	$sofar = array();
	foreach ($words as $word) {
		if (isset($sofar[$word])) {
			continue 2;
		}
		$sofar[$word] = true;
	}
	$valid++;
}

print $valid . "\n";
