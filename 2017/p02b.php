<?php
#
# p02a.php -- Day 2: Corruption Checksum
#
# (c)2017 @zemkat

$lines = file($argv[1],FILE_IGNORE_NEW_LINES);
$sum = 0;
foreach ($lines as $line) {
	$nums = preg_split("/[\s]+/",$line);
	sort($nums);
	for ($j=0;$j<sizeof($nums);$j++) {
		for ($k=$j+1;$k<sizeof($nums);$k++) {
			if ($nums[$k] % $nums[$j] == 0) {
				$sum += ($nums[$k] / $nums[$j]);
			}
		}
	}
}

print $sum . "\n";
