<?php
#
# p04a.php -- Day 4: High-Entropy Passphrases
#
# (c)2017 @zemkat

$lines = file($argv[1]);

function norm($word) {
	$letters = str_split($word);
	sort($letters);
	return implode($letters);
}

$valid = 0;
foreach ($lines as $line) {
	$words = preg_split("/\s/",$line);
	$sofar = array();
	foreach ($words as $word) {
		$wordn = norm($word);
		if (isset($sofar[$wordn])) {
			continue 2;
		}
		$sofar[$wordn] = true;
	}
	$valid++;
}

print $valid . "\n";
