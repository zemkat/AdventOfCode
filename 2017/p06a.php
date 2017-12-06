<?php
#
# p06a.php -- Day 6: Memory Reallocation
#
# (c)2017 @zemkat

$line = file_get_contents($argv[1]);
$nums = preg_split("/\s+/",rtrim($line));
for ($j=0;$j<sizeof($nums);$j++) {
	$nums[$j] = intval($nums[$j]);
}

function ser($arr) {
	return implode("-",$arr);
}

$seen = array();
$steps = 0;
while (!isset($seen[ser($nums)])) {
	$steps++;
	$seen[ser($nums)] = true;
	$max = max($nums);
	$where = array_search($max,$nums);
	$nums[$where]=0;
	for ($j=1;$j<=$max;$j++) {
		$nums[($where+$j)%sizeof($nums)]++;
	}
}

print ser($nums) . "\n";
print "STEPS: $steps\n";
