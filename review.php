<?php
class Game {
	/* An array containing each tic tac toe cell. */
    var $position;
    function __construct($squares) {
        $this->position = str_split($squares);
    }
	
	/*
		Checks to see if the specified token (e.g. 'x' or 'o' has won yet.)
		Will check for horizontal, vertical,
		and diagonal wins.
		Returns true if someone has won; false if no one has won yet.
	*/
	function winner($token) {
		// Check for horizontal wins
		for($row=0; $row<3; $row++) {
			$result = true;
			for($col=0; $col<3; $col++) {
				if ($this -> position[3*$row+$col] != $token)
					$result = false;
			}
			if($result)
				return $result;
		}
		// Check for vertical wins
		for($col=0; $col<3; $col++) {
			$result = true;
			for($row=0; $row<3; $row++) {
				if($this -> position[$col+3*$row] != $token)
					$result = false;
			}
			if($result)
				return $result;
		}
		// Check for diagonal wins
		if ($this -> position[0] == $token && $this -> position[4] == $token && $this -> position[8] == $token)
			return true;
		if ($this -> position[2] == $token && $this -> position[4] == $token && $this -> position[6] == $token)
			return true;
		return $result;
	}
	
	/*
		Calls show_cell() to display a 3 x 3 tic tac toe board.
	*/
	function display() {
		echo '<table cols="3" style="font-size:large; font-weight:bold">';
		echo '<tr>';
		for($pos = 0; $pos<9; $pos++) {
			echo $this->show_cell($pos);
			if ($pos %3 == 2) echo '</tr><tr>';
		}
		echo '</tr></table>';
	}
	/*
		Checks element of the given index of $position.
		Hyphen elements are anchor tags which allow the user to replace the hyphen
		 with their own token.
	*/
	function show_cell($which) {
		$token = $this->position[$which];
		if ($token <> '-')
			return '<td>'.$token.'</td>';
		$this -> newposition = $this->position;
		$this -> newposition[$which] = 'o';
		$move = implode($this->newposition);
		$link = $_SERVER['SCRIPT_NAME'].'/?board='.$move;
		return '<td><a href="'.$link.'" style="text-decoration:none">-</a></td>';
	}
	/*
		Chooses the first available cell and replaces it with an 'x' token.
	*/
	function pick_move() {
		$empty_cells = array();
		
		// Populates an empty array with the position of each empty cell
		for($cell = 0; $cell < count($this->position); $cell++) {
			if ($this->position[$cell] == '-') {
				array_push($empty_cells, $cell);
			}
		}
		
		// Replaces the first empty cell with an 'x' token and checks
		//  again to see if the system has won.
		if ($empty_cells) {
			$this->position[$empty_cells[0]] = 'x';
			if ($this->winner('x'))
				echo '<i><b>I win. Muahahahahaha</b></i>';
			else
				echo 'No winner yet, but you are losing.';
		}
	}
}

$position = (isset($_GET['board'])) ? $_GET['board'] : "---------";
$squares = str_split($position);
echo "<b>Welcome to the Tic Tac Toe Championship!</b><br/><br/>";
$game = new Game($position);
if ($game->winner('x'))
	echo '<i><b>You win. Luckey guesses!</b></i>';
else if ($game->winner('o'))
	echo '<i><b>I win. Muahahahahaha</b></i>';
else {
	$game->pick_move();
}
$game->display();
?>