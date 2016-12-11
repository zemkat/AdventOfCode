<?php
#
# p7b.php -- Day 7: Internet Protocol Version 7
#
#   It's just not secure without super-secret listening.
#
# (c)2016 @zemkat

$lines = file($argv[1]);

$howmany=0;

function has_aba($str) {
	global $lookfor;
	$chars = str_split($str);
	for($j=0;$j<strlen($str)-2;$j++) {
		if (($str[$j] == $str[$j+2]) and ($str[$j] != $str[$j+1])) {
			array_push($lookfor,$str[$j+1].$str[$j].$str[$j+1]);
		}
	}
}


foreach ($lines as $line) {
	$lookfor = array();
	$parts = preg_split("/[\[\]]/", rtrim($line));
	for ($j=1;$j<sizeof($parts);$j+=2) {
		# populate lookfor
		has_aba($parts[$j]);
	}
	foreach ($lookfor as $look) {
		for ($j=0;$j<sizeof($parts);$j+=2) {
			if (strpos($parts[$j],$look) !== false) {
				$howmany++;
				continue 3;
			}
		}
	}
}

print $howmany . "\n";
