<?php

$sq = [
	[16, 3,	2,	13],
	[5,	10,	11,	8],
	[9,	6,	7,	12],
	[4,	15,	14,	1],
];


$string = 'Приезжаю Скоро я';
function encode($string, $sq)
{
	$encode = '';
	foreach ($sq as $raw_num => $raw) {
		foreach ($raw as $pos_num => $pos) {
			if (strlen($string) < $pos) {
				$encode .= '.';
			}
			$encode .= $string[$pos - 1];
		}
	}
	return $encode;
}

function decode($string, $sq)
{
	$decode = [];
	foreach ($sq as $raw_num => $raw) {
		foreach ($raw as $pos_num => $pos) {
			$decode[$pos] = $string[$pos - 1];
		}
	}
	ksort($decode);
	return implode('', $decode);
}

function checkSquare($sq)
{
	$n = sizeof($sq);
	$lineSum = $n*($n*$n + 1)/2;
	$diagonal_1 = 0;
	$diagonal_2 = 0;
	$rowLine = 0;
	foreach ($sq as $raw_num => $raw) {
		$rowLine += $raw[0];
		$line = 0;
		foreach ($raw as $pos_num => $pos) {
			$line += $pos;		
			if ($pos_num == $raw_num) {
				$diagonal_1 += $pos;				
			}
			if ($pos_num == ($n - ($raw_num + 1))) {
				$diagonal_2 += $pos;
			}
		}
		if ($line !== $lineSum) {
			return false;
		}		

	}
	if ($diagonal_1 === $lineSum &&
			$diagonal_2 === $lineSum && 
			$rowLine === $lineSum) {
			return true;
	}
	return false;
}

function makeSquare($n)
{
	$sq = [];
	$exist =[];
	
	for ($i = 0; $i < $n; $i++) {
		for ($j = 0; $j < $n; $j++) {			
			$value = function() use ($n, &$exist)  {				
				do {
					$genValue = rand(1, $n*$n);
					if (count($exist) < 1 ) {
						break;
					}
				} while(in_array($genValue, $exist));
				$exist[] = $genValue;
				return $genValue;
			};
			$sq[$i][$j] = $value();
		}	
	}
	return $sq;
}
function arrayToSquare($sqArray) {
	$result = '';
	foreach($sqArray as $row){
		$result .= implode(",\t", $row)."\r\n";
	}
	$result .= "\r\n";
	return $result;
}


function makeArray($n)
{
	$lineSum = $n*($n*$n + 1)/2;
	$numbers = []
	for ($i = 0; $i < $n*$n; $i++){
		$numbers[] = $i;
	}
	for ($i = 0; $i < $n; $i++)
	{
		$partNumber =array_slice($numbers, $i*$n, ($i+1)*$n);
		/*
		do {
			shuffle($numbers);
			$partNumber = 
		} while ($lineSum != $partNumber)
			*/
		echo partNumber;
	}
	
}
// ------------------------------------------

print encode($string, $sq);
print "\n--------\n";
print decode($string, $sq);
echo "\n\n------------------\n";
print encode(encode($string, $sq), $sq);
echo "\n\n-----Check Square-------------\n";
echo checkSquare($sq);
echo "\n\n-----Gen Square-------------\n";
$magicSquare = 0;
$time_start_all = microtime(true);
$n = 4;
$time_start = $time_start_all;
while ($magicSquare < 300) {
	$square = makeSquare($n);
	if (checkSquare($square)) {						 
			$matrix = arrayToSquare($square);
			file_put_contents('squares_'.$n.'x'.$n.'.txt', $matrix, FILE_APPEND);
			$time_end = microtime(true) - $time_start;	
			++$magicSquare;			
			echo "\n".$magicSquare.' - squere time discover is '.$time_end .' sec';
			$time_start = microtime(true);
	}
}
$time_end = microtime(true) - $time_start_all;
echo "\n=================\n".'Discover time is '.$time_end.' sec';

