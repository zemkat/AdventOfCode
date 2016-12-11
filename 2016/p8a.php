<?php
#
# p8a.php -- Day 8: Two-Factor Authentication
#
#   This reminds me of the TIS-100 graphics problem I'm working on.
#
# (c)2016 @zemkat

$lines = file($argv[1]);

$dims = array_shift($lines);
preg_match("/(\d+) (\d+)/",$dims,$m);
$screen_cols = $m[1]; $screen_rows = $m[2];

$screen = array();
for ($j=0;$j<$screen_rows*$screen_cols;$j++) {
	$screen[$j] = '.';
}

function display($screen) {
	global $screen, $screen_cols, $screen_rows;
	for ($j=0;$j<$screen_rows;$j++) {
		for ($k=0;$k<$screen_cols;$k++) {
			print $screen[$k+$screen_cols*$j];
		}
		print "\n";
	}
	print "\n\n";
}

function rect($cols,$rows) {
	global $screen, $screen_cols, $screen_rows;
	for ($j=0;$j<$rows;$j++) {
		for ($k=0;$k<$cols;$k++) {
			$screen[$k+$screen_cols*$j] = '#';
		}
	}
}

function rotate_x($column,$amount) {
	global $screen, $screen_cols, $screen_rows;
	# copy column
	$copycol = array();
	for ($j=0;$j<$screen_rows;$j++) {
		$copycol[$j] = $screen[$j*$screen_cols+$column];
	}
	for ($j=0;$j<$screen_rows;$j++) {
		$screen[$j*$screen_cols+$column] = $copycol[($j-$amount+$screen_rows) % $screen_rows];
	}
}

function rotate_y($row,$amount) {
	global $screen, $screen_cols, $screen_rows;
	# copy column
	$copyrow = array();
	for ($j=0;$j<$screen_cols;$j++) {
		$copyrow[$j] = $screen[$row*$screen_cols+$j];
	}
	for ($j=0;$j<$screen_cols;$j++) {
		$screen[$row*$screen_cols+$j] = $copyrow[($j-$amount+$screen_cols) % $screen_cols];
	}
}

#display($screen);
foreach ($lines as $line) {
	if (preg_match("/rect (\d+)x(\d+)/",$line,$m)) {
		rect($m[1],$m[2]);
#		display($screen);
		continue;
	}
	if (preg_match("/rotate column x=(\d+) by (\d+)/",$line,$m)) {
		rotate_x($m[1],$m[2]);
#		display($screen);
		continue;
	}
	if (preg_match("/rotate row y=(\d+) by (\d+)/",$line,$m)) {
		rotate_y($m[1],$m[2]);
#		display($screen);
		continue;
	}
}

# count
$howmany = 0;
for ($j=0;$j<$screen_rows*$screen_cols;$j++) {
	if ($screen[$j] == "#") { $howmany++; }
}
print $howmany . "\n";

?>
