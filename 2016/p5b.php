<?php
#
# p5b.php -- Day 5: How About a Nice Game of Chess?
#
#   Cinematic "decrypting" animation? Challenge accepted.
#
# (c)2016 @zemkat


$key = rtrim(file_get_contents($argv[1]));

$found = 0;
$try = 0;
$answer = "";

$code_length = 8;
$padding = 5;

$myar = array();
for($j=0;$j<$code_length;$j++) {
	$myar[$j] = -1;
}

$sprites = array('|','/','-','\\');

function goback() {
	global $code_length, $padding;
	for ($j=0;$j<$code_length+$padding;$j++) {
		print chr(8);
	}
}

function init() {
	print "\n\n\n";
	print "     HACKING "; sleep(1); goback();
	print "     STARTUP "; sleep(1); goback();
	print "     SEQUENCE"; sleep(1); goback();

	global $sprites, $code_length, $padding;
	for ($rounds=0;$rounds<5;$rounds++) {
		foreach ($sprites as $sprite) {
			for ($j=0;$j<$padding;$j++) {
				print " ";
			}
			for ($j=0;$j<$code_length;$j++) {
				print $sprite;
			}
			time_nanosleep(0,100000000);
			goback();
		}
	}

	print "      MEMORY "; sleep(1); goback();
	print "      PRIMED "; sleep(1); goback();
	print "       GO!!! "; sleep(1); goback();

	print "     --------";
}

function printit($myar,$spin) {
	global $sprites;
	goback();
	print "     ";
	foreach ($myar as $m) {
		if ($m != -1) {
			print $m;
		} else {
			print $sprites[$spin];
		}
	}
}

init();
$spin = 50000;
while ($found < $code_length) {
	$tryit = $key . $try;
	$hash = md5($tryit);
	if (substr($hash,0,5) === "00000") {
		$pos = substr($hash,5,1);
		if (($pos >= '0') && ($pos < (string)$code_length)) {
			if ($myar[$pos] == -1) {
				$myar[$pos] = substr($hash,6,1);
				$found++;
			}
		}	
	}
	$try++;
	if ($try % $spin == 0) {
		printit($myar, ($try/$spin) % 4);
	}
}
	printit($myar, ($try/$spin) % 4);
	print "\n\n     HACK THE PLANET\n\n";
