<?php
#
# p01b.php -- Day 1: Inverse Captcha (Part 2)
#
# (c)2017 @zemkat

$captcha = $argv[1];

$sum = 0;

for ($j = 0; $j < strlen($captcha); $j++) {
	if ($captcha[$j] == $captcha[($j+(strlen($captcha)/2)) % strlen($captcha)]) {
		$sum += $captcha[$j];
	}
}
print $sum . "\n";
