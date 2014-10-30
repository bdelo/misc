import java.util.*;

public class Board {
	public String[][] numbers;
	public int linesize;
	public int totalsize;
	public boolean winner;
	
	//Constructor
	public Board(int l){
		linesize = l;
		numbers = new String[linesize][linesize];
		totalsize = linesize*linesize;
		winner = false;
		
		//create a new board
		for(int i=0,x=1;i<linesize;i++){
			for(int j=0;j<linesize;j++){
				numbers[i][j]=String.valueOf(x);
				x++;
			}
		}
		numbers[linesize-1][linesize-1] = "_";
		
		//shuffle the new board
		Random rand = new Random();
		for(int i=0;i<linesize;i++){
			for(int j=0;j<linesize;j++){
				int x = rand.nextInt(linesize);
				int y = rand.nextInt(linesize);
				String t = numbers[x][y];
				numbers[x][y]=numbers[i][j];
				numbers[i][j]=t;
			}
		}
	}
	
	//Print the board in a readable format
	public void printBoard(){
		 for(int i = 0;i<linesize;i++){
			 for(int j=0;j<linesize;j++){
				 System.out.print(numbers[i][j]+"\t");
			 }
		 System.out.print("\n");
		 }
	}
	
	//Find the coordinates of a desired block
	public int[] findCoords(String needle){
		boolean found = false;
		int[] coords = new int[2];
		for(int i=0;i<linesize && !found;i++){
			for(int j=0;j<linesize && !found;j++){
				if(needle.equals(numbers[i][j])){
					coords[0] = i;
					coords[1] = j;
					found = true;
				}
				else{
					coords[0]=-1;
					coords[1]=-1;
				}
			}
		}
		return coords;
	}
	
	//Move the desired block
	public void moveBlock(String move){
		int[] blank = findCoords("_");
		int[] pending = findCoords(move);
		
		if( (pending[0]==blank[0] && (pending[1]==blank[1]-1 || pending[1]==blank[1]+1))
									||
			(pending[1]==blank[1] && (pending[0]==blank[0]-1 || pending[0]==blank[0]+1)))
		{
			numbers[blank[0]][blank[1]] = move;
			numbers[pending[0]][pending[1]] = "_"; 
		}
	}
	
	//Check if the board is a winner
	public boolean checkWin(){
		boolean retval;
		String[][] winner = new String[linesize][linesize];
		for(int i=0,x=1;i<linesize;i++){
			for(int j=0;j<linesize;j++){
				winner[i][j]=String.valueOf(x);
				x++;
			}
		}
		winner[linesize-1][linesize-1] = "_";
		if(Arrays.deepEquals(winner,numbers)){
			retval=true;
		}
		else{
			retval=false;
		}
		return retval;
	}
	
	
	
}
