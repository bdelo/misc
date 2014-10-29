<?php

function findCoords($needle,$haystack,$linesize){
	$found=false;
	for($i=0;$i<$linesize && $found==false;$i++){
		for($j=0;$j<$linesize && $found==false;$j++){
			if($haystack[$i][$j]==$needle){
				return array('i'=>$i,'j'=>$j);
			}
		}
	}
	return false;
}
function isValidMove($move,$board,$linesize){
	$blank = findCoords('_',$board,$linesize);
	$pending = findCoords($move,$board,$linesize);
	if( ($pending['i']==$blank['i'] && ($pending['j']==$blank['j']-1 || $pending['j']==$blank['j']+1))
}
/*This function prints the board in a readable format*/
function printBoard($board,$board_linesize){
	print("\n");
	for($i=0;$i<$board_linesize;$i++){
		for($j=0;$j<$board_linesize;$j++){
			print($board[$i][$j]."\t");
		}
		print("\n");
	}
	print("\n");
}


function main()
{
	//Find out how big the board is supposed to be
	echo "How big is the board? n x n 	 n = ";
	$handle = fopen("php://stdin","r");
	$line = fgets($handle);
	$line_size = trim($line);
	$total_size = $line_size * $line_size;
	
	//Get an array of numbers needed for size of the board, and then shuffle it
	$numbers = range(1,$total_size-1);
	array_push($numbers,"_");
	shuffle($numbers);
	//Split the array of numbers into a multidimensional array based on line size
	$numbers = array_chunk($numbers,$line_size);
	printBoard($numbers,$line_size);

	while(1){
		Get the number the user wants to move
		echo "Which number do you want to move?     ";
		$handle = fopen("php://stdin","r");
		$line=fgets($handle);
		$move = trim($line);

		isValidMove($move,$numbers,$line_size);

	}
}

main();

?>
