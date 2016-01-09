<?php
$position = (isset($_GET['board'])) ? $_GET['board'] : "---------";
$squares = str_split($position);
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
		for($row=0; $row<3; $row++) {
			$result = true;
			for($col=0; $col<3; $col++) {
				if ($this -> position[3*$row+$col] != $token)
					$result = false;
			}
			if($result)
				return $result;
		}
		for($col=0; $col<3; $col++) {
			$result = true;
			for($row=0; $row<3; $row++) {
				if($this -> position[$col+3*$row] != $token)
					$result = false;
			}
			if($result)
				return $result;
		}
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
		Iterates through $position and places each element in a 3 x 3 table.
		Hyphen elements are anchors and allow the user to replace the hyphen
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
}
echo "Welcome to the Tic Tac Toe Championship!";
$game = new Game($position);
$game->display();
if ($game->winner('x'))
	echo 'You win. Luckey guesses!';
else if ($game->winner('o')) {
	echo 'I win. Muahahahahaha';
}
else
	echo 'No winner yet, but you are losing.';

$i = 0;
?>