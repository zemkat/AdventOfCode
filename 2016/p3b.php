<?php
#
# p3b.php -- Day 3: Squares With Three Sides
#
#	Oh, designers.
#
# (c)2016 @zemkat

$lines = file($argv[1]);

$bads = 0;
$goods = 0;

for ($j=0; $j<sizeof($lines); $j+= 3) {
	for ($k=0;$k<3;$k++) {
		preg_match("/(\d+)\s+(\d+)\s+(\d+)/",$lines[$j+$k],$nums);
		$tr[0][$k] = $nums[1]; $tr[1][$k] = $nums[2]; $tr[2][$k] = $nums[3];
	}

	for ($k=0;$k<3;$k++) {
		sort($tr[$k],SORT_NUMERIC);

		if ($tr[$k][0] + $tr[$k][1] <= $tr[$k][2]) {
			$bads++;
		} else {
			$goods++;
		}
	}

}

print "GOODS: $goods \n";
print "BADS: $bads \n";
