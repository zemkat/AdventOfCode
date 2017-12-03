<?php
#
# p03b.php -- Day 3: Spiral Memory
#
# (c)2017 @zemkat

$num = $argv[1];

$mem = array();

$r=0; $c=0;
$mem[$r][$c] = 1;
$n=0;

function sum($r,$c) {
	global $mem;
	$s = 0;
	if (isset($mem[$r][$c+1])) { $s += $mem[$r][$c+1]; }
	if (isset($mem[$r+1][$c+1])) { $s += $mem[$r+1][$c+1]; }
	if (isset($mem[$r+1][$c])) { $s += $mem[$r+1][$c]; }
	if (isset($mem[$r+1][$c-1])) { $s += $mem[$r+1][$c-1]; }
	if (isset($mem[$r][$c-1])) { $s += $mem[$r][$c-1]; }
	if (isset($mem[$r-1][$c-1])) { $s += $mem[$r-1][$c-1]; }
	if (isset($mem[$r-1][$c])) { $s += $mem[$r-1][$c]; }
	if (isset($mem[$r-1][$c+1])) { $s += $mem[$r-1][$c+1]; }
	return $s;
}
	
while (true) {
	$n++; # move out a ring
	$c++;
	$mem[$r][$c] = sum($r,$c);
	if ($mem[$r][$c] > $num) { print $mem[$r][$c] . "\n"; exit;}
	for ($j=1;$j<2*$n;$j++) {
		$r++;
		$mem[$r][$c] = sum($r,$c);
		if ($mem[$r][$c] > $num) { print $mem[$r][$c] . "\n"; exit; }
	}
	for ($j=0;$j<2*$n;$j++) {
		$c--;
		$mem[$r][$c] = sum($r,$c);
		if ($mem[$r][$c] > $num) { print $mem[$r][$c] . "\n"; exit; }
	}
	for ($j=0;$j<2*$n;$j++) {
		$r--;
		$mem[$r][$c] = sum($r,$c);
		if ($mem[$r][$c] > $num) { print $mem[$r][$c] . "\n"; exit; }
	}
	for ($j=0;$j<2*$n;$j++) {
		$c++;
		$mem[$r][$c] = sum($r,$c);
		if ($mem[$r][$c] > $num) { print $mem[$r][$c] . "\n"; exit; }
	}
}
