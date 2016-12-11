<?php
#
# p2b.php -- Day 2: Bathroom Security
#
#   Those darn bathroom-keypad-design meetings
#
# (c)2016 @zemkat

$lines = file($argv[1]);

$posx = 0; $posy = 2;


$label[0] = array(' ',' ','1',' ',' ');
$label[1] = array(' ','2','3','4',' ');
$label[2] = array('5','6','7','8','9');
$label[3] = array(' ','A','B','C',' ');
$label[4] = array(' ',' ','D',' ',' ');

function move($dir) {
	global $posx, $posy;
	switch($dir) {
		case 'D': 
			if (abs($posy-2+1)+abs($posx-2) <= 2) {
				$posy++;
			} break;
		case 'U': 
			if (abs($posy-2-1)+abs($posx-2) <= 2) {
				$posy--;
			} break;
		case 'R': 
			if (abs($posy-2)+abs($posx-2+1) <= 2) {
				$posx++;
			} break;
		case 'L': 
			if (abs($posy-2)+abs($posx-2-1) <= 2) {
				$posx--;
			} break;
		default:
			print "wait what: [$dir]\n";
	}
}

foreach ($lines as $line) {
	$chars = str_split(rtrim($line));
	foreach ($chars as $char) {
		move($char);
	}
	print $label[$posy][$posx];
	#print "CODE: " . $label[$posy][$posx] . "\n";
}
print "\n";


