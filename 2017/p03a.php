<?php
#
# p03a.php -- Day 3: Spiral Memory
#
# (c)2017 @zemkat

$num = $argv[1];

# weird case that's wrecking the math
$sq = sqrt($num);
if (($sq == intval($sq)) and ($sq % 2)) {
	$dist = $sq-1;
	print "$dist\n"; exit;
}

# What is the largest odd square smaller than my number?
# it is of the form 2n-1 so we'll keep track of n

$largest = intval(sqrt($num));
if ($largest % 2 == 0) { $largest--; }
$n = ($largest+1)/2;

$left = $num - $largest*$largest;

# they will always be at least $n away 
$dist = $n; # at least

# but how much more?
$pos = $left % (2*$n);

if ($pos <= $n) {
	$dist += $n-$pos;
} else {
	$dist += $pos-$n;
}

print $dist . "\n";

