<?php
#
# p9b.php -- Day 9: Explosives in Cyberspace
#
#   Tidy. Still love that regex.
#
# (c)2016 @zemkat


$lines = file($argv[1]);

foreach ($lines as $line) {
	print length(rtrim($line)) . "\n";
}

function length($line) {
	if (preg_match("/^([^(]+)(.*)/",$line,$m)) {
		return strlen($m[1]) + length($m[2]);
	}
	if (preg_match("/^\((\d+)x(\d+)\)(.*)/",$line,$m)) {
		$str = $m[1];
		$times = $m[2];
		$left = $m[3];
		if ($str == strlen($left)) {
			return $times*length($left);
		}
		return $times*length(substr($left,0,$str)) + length(substr($left,$str-strlen($left)));
	}
	
}

