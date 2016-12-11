<?php
#
# p3a.php -- Day 3: Squares With Three Sides
#
#   Spotting impossible triangles.
#
# (c)2016 @zemkat

$lines = file($argv[1]);

$bads = 0;
$goods = 0;
foreach ($lines as $line) {
	preg_match("/(\d+)\s+(\d+)\s+(\d+)/",$line,$nums);
	array_shift($nums);
	sort($nums,SORT_NUMERIC);
	if ($nums[0] + $nums[1] <= $nums[2]) {
		$bads++;
	} else {
		$goods++;
	}
}

print $goods . "\n";
