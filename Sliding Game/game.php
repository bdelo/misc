<?php
function isValidMove($move,$board,$board_linesize){

}
/*This function prints the board in a readable format*/
function printBoard($board,$board_linesize){
	for($i=0;$i<$board_linesize;$i++){
		for($j=0;$j<$board_linesize;$j++){
			print($board[$i][$j]."\t");
		}
		print("\n");
	}
}
function getNewBoard($linesize){
	
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
	print_r($numbers);
	printBoard($numbers,$line_size);
}

main();

?>
