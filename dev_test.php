<?php 

function makeArray($n)
{
	$lineSum = $n*($n*$n + 1)/2;
	$numbers = [];
	$goodArray = [];
	
	for ($i = 1; $i <= $n*$n; $i++){
		$numbers[] = $i;
	}
	do {
		shuffle($numbers);
		for ($i = 1; $i <= $n; $i++){
			$partNumber[$i - 1] = array_slice($numbers, $n * ($i - 1), $n);
		
			if (array_sum($partNumber[$i - 1]) == $lineSum) {
				if ( in_array($partNumber[$i - 1], $goodArray)) {
					continue;
				}
				echo count($goodArray);
				$goodArray[] = $partNumber[$i - 1];						
			}
		}
	} while(count($goodArray) < 2064);
	return $goodArray;
}

//====================
$arr = [
        0 => 5,
        1 => 15,
        2 => 10,
        3 => 4,
    ];
//print(in_array([1,2,3,4],[$arr, [1,2,3,4]]));

print_r(makeArray(4));