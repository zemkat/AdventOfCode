<?php
#
# p7a.php -- Day 7: Internet Protocol Version 7
#
#   I want transport-layer snooping.
#
# (c)2016 @zemkat

$lines = file($argv[1]);

$howmany=0;

function has_abba($str) {
	if (preg_match_all("/(.)(.)\\2\\1/",$str,$m,PREG_SET_ORDER)) {
		foreach ($m as $matchy) {
			if ($matchy[1] != $matchy[2]) {
				return true;
			}
		}
		return false;
	}
}

foreach ($lines as $line) {
	$parts = preg_split("/[\[\]]/", rtrim($line));
	for ($j=1;$j<sizeof($parts);$j+=2) {
		# don't count bracketed ones
		if (has_abba($parts[$j])) {
			continue 2;
		}
	}
	for ($j=0;$j<sizeof($parts);$j+=2) {
		# check others
		if (has_abba($parts[$j])) {
			$howmany++;
			continue 2;
		}
	}
}

print $howmany . "\n";
