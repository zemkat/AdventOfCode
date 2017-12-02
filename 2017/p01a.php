<?php
#
# p01a.php -- Day 1: Inverse Captcha
#
# (c)2017 @zemkat

$captcha = $argv[1];

$sum = 0;

for ($j = 0; $j < strlen($captcha); $j++) {
	if ($captcha[$j] == $captcha[($j+1) % strlen($captcha)]) {
		$sum += $captcha[$j];
	}
}
print $sum . "\n";
