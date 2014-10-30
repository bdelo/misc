<?php
/*****************************************************************
Sliding Numbers Game
Author: Bobby DeLorenzo
Command line based game with an nxn array of numbers, containting one blank space.
User must play numbers adjacent to the blank space on the board in order to shift and
rearrange the entire board to be in consecutive order.
*****************************************************************/

/* This function finds the i,j coordinates of the desired number in the board provided */
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

/* This function takes a board array and moves the block provided into the empty space,
	only if it is a valid move */
function moveBlock($move,$board,$linesize){
	//Find the coordinates of both the blank space and the space you want to move
	$blank = findCoords('_',$board,$linesize);
	$pending = findCoords($move,$board,$linesize);
	//Giant if statement to check if the pending square move is adjacent to the blank one
	if( ($pending['i']===$blank['i'] && ($pending['j']===$blank['j']-1 || $pending['j']===$blank['j']+1))
												||
		($pending['j']===$blank['j'] && ($pending['i']===$blank['i']-1 || $pending['i']===$blank['i']+1)))
	{	//if it is, swap the two
		$board[$blank['i']][$blank['j']] = $move;
		$board[$pending['i']][$pending['j']] = '_';
	}
	return $board;
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

/* This function checks if the current board is a winner */
function checkWin($board){
	$full = array();
	//Loop through the multidimensional array to create one merged array
	foreach ($board as $row){
		$full = array_merge($full,$row);
	}
	//Create a winner board to compare to, which is the winning output
	$winner = range(1,count($full)-1);
	//Compare the first n-1 elements in the full array to the winner to see if you've won
	if(array_slice($full,0,count($full)-1) == $winner){
		return true;
	}
	else{
		return false;
	}
}

/* Main function thats called when program is executed */
function main()
{
	//Find out how big the board is supposed to be
	do{
		echo "How big is the board? n x n 	 n = ";
		$handle = fopen("php://stdin","r");
		$line = fgets($handle);
	}while(!is_numeric($line) && $line<2);	//check input is valid

	$line_size = trim($line);
	$total_size = $line_size * $line_size;
	
	//Get an array of numbers needed for size of the board, and then shuffle it
	$numbers = range(1,$total_size-1);
	array_push($numbers,"_");
	shuffle($numbers);
	//Split the array of numbers into a multidimensional array based on line size
	$numbers = array_chunk($numbers,$line_size);

	printBoard($numbers,$line_size);

	do{	//Keep looping until the user has a winning board
		//Get the number the user wants to move
		echo "Which number do you want to move?     ";
		$handle = fopen("php://stdin","r");
		$line=fgets($handle);
		$move = trim($line);
		//Move the desired space
		$numbers = moveBlock($move,$numbers,$line_size);
		printBoard($numbers,$line_size);

		//Check to see if it was a winning move
		if(checkWin($numbers)){
			print("\n\nYOU WIN!\n\n");
			$victory = true;
		}
		else{
			$victory = false;
		}
	}while(!$victory);
}
/*************************************************************************************************/

//Call main function to start
main();

?>
