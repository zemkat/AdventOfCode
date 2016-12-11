<?php
#
# p5a.php -- Day 5: How About a Nice Game of Chess?
#
#   They talk about hacking movies like they're a bad place to get your security knowledge...
#
# (c)2016 @zemkat

$key = rtrim(file_get_contents($argv[1]));

$found = 0;
$try = 0;
$answer = "";

while ($found < 8) {
	$tryit = $key . $try;
	$hash = md5($tryit);
	if (substr($hash,0,5) === "00000") {
		$answer .= substr($hash,5,1);
		$found++;
	}
	$try++;
}
	print "ANSWER: $answer\n";
