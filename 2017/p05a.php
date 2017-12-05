<?php
#
# p05a.php -- Day 5: A Maze of Twisty Trampolines, All Alike
#
# (c)2017 @zemkat

$lines = file($argv[1]);
for ($j=0;$j<sizeof($lines);$j++) {
	$lines[$j] = intval($lines[$j]);
}
	
$pos = 0;
$steps = 0;
while (($pos >= 0) && ($pos < sizeof($lines))) {
	$offset = $lines[$pos]++;
	$pos += $offset;
	$steps++;
}
print "STEPS: $steps\n";

