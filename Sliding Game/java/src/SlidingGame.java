import static java.lang.System.*;

import java.util.Scanner;

public class SlidingGame {
	public static void main(String[] args){
		Scanner sc = new Scanner(System.in);
		System.out.println("How big is the board? n x n 	 n = ");
		int n = sc.nextInt();
		Board board = new Board(n);
		board.printBoard();
		
		while(!board.checkWin()){
			String input;
			System.out.println("What number do you want to move?");
			input = sc.next();
		
			board.moveBlock(input);
			board.printBoard();
		}
		System.out.println("YOU WIN!!!");
	}
}
