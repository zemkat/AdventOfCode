<?php
#
# p1b.php -- Day 1: No Time for a Taxicab
#
#   Thanks a lot, elves.
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
			case 0: 
				for ($j=1;$j<=$m[2];$j++) { $posy++; check(); } break;
			case 1: 
				for ($j=1;$j<=$m[2];$j++) { $posx++; check(); } break;
			case 2: 
				for ($j=1;$j<=$m[2];$j++) { $posy--; check(); } break;
			case 3: 
				for ($j=1;$j<=$m[2];$j++) { $posx--; check(); } break;
			default: print "wait what: $facing\n"; 
		}
	}
}

function check() {
	global $posx,$posy,$record;
	if (isset($record["$posx.$posy"])) {
		print "Got it: $posx.$posy -> "; $dist = abs($posx)+abs($posy); print "$dist\n";
		exit;
	} else {
		print "Setting $posx.$posy\n";
		$record["$posx.$posy"] = true;
	}
}


#print "X-Distance: $posx\nY-Distance: $posy\n";
#$final = abs($posx)+abs($posy);
#print "Final distance: $final\n";
