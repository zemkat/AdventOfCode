<?php
#
# p1a.php -- Day 1: No Time for a Taxicab
#
#   (Dr. Jones)
#
# (c)2016 @zemkat

$posx = 0; $posy = 0; 
$facing = 0; # 0 = North, 1 = East, 2 = South, 3 = West

$str = file_get_contents("p1.txt");
$dirs = preg_split("/, /",rtrim($str));
foreach ($dirs as $dir) {
	#print "[$dir]\n";
	if (preg_match("/([LR])([\d]+)/",$dir,$m)) {
		if ($m[1] == "R") {
			$facing = ($facing+1+4) % 4;
		} else {
			$facing = ($facing-1+4) % 4;
		}
		switch ($facing) {
			case 0: $posy += $m[2]; break;
			case 1: $posx += $m[2]; break;
			case 2: $posy -= $m[2]; break;
			case 3: $posx -= $m[2]; break;
			default: print "wait what: $facing\n"; 
		}
	}
}
print "X-Distance: $posx\nY-Distance: $posy\n";
$final = abs($posx)+abs($posy);
print "Final distance: $final\n";
