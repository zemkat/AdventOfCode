<?php
#
# p2a.php -- Day 2: Bathroom Security
#
#   Robo-rally bathroom seeking
#
# (c)2016 @zemkat

$lines = file($argv[1]);

$posx = 1; $posy = 1;

$inc = 1;
for ($j=0;$j<3;$j++) {
	for ($k=0;$k<3;$k++) {
		$label[$j][$k] = $inc++;
	}
}

function move($dir) {
	global $posx, $posy;
	switch($dir) {
		case 'D': 
			if ($posy < 2) { $posy++; } break;
		case 'U': 
			if ($posy > 0) { $posy--; } break;
		case 'R': 
			if ($posx < 2) { $posx++; } break;
		case 'L': 
			if ($posx > 0) { $posx--; } break;
		default:
			print "wait what: [$dir]\n";
	}
	#print "DIR: $dir\n POSX: $posx\n POSY: $posy\n\n";
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


