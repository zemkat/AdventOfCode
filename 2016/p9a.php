<?php
#
# p9a.php -- Day 9: Explosives in Cyberspace
#
#   Dig that regex on line 14.
#
# (c)2016 @zemkat

$lines = file($argv[1]);

foreach ($lines as $line) {
	$output_length = 0;
	$line = rtrim($line);
	while ($line != "") {
		if (preg_match("/^([^(]+)/",$line,$m)) {
			$output_length += strlen($m[1]);
			if ($m[1] != $line) {
				$line = substr($line,strlen($m[1])-strlen($line));
			} else {
				$line = "";
			}
			continue;
		}
		if (preg_match("/^\((\d+)x(\d+)\)(.*)/",$line,$m)) {
			$str = $m[1];
			$times = $m[2];
			$output_length += $str*$times;
			if ($str != strlen($m[3])) {
				$line = substr($m[3],$str-strlen($m[3]));
			} else {
				$line = "";
			}
			continue;
		}
	}
	print $output_length . "\n";
}

