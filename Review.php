<?php
$name = 'Anson';
$what = 'php expert';
$level = 1;

$hoursworked = (isset($_GET['hours'])) ? $_GET['hours'] : 0;
$rate = 12;
if ($hoursworked > 40) {
	$overtime = $hoursworked - 40;
	$total = (($hoursworked - $overtime) + $overtime * 1.5) * $rate;
} else {
	$total = $hoursworked * $rate;
}
echo 'Hi, my name is ' . $name . ', and I am a level ' .$level. ' ' .$what . '<br/>';
echo ($total > 0) ? 'You owe me $' .$total : "You're welcome";
echo ".<br/>";

$position = (isset($_GET['board'])) ? $_GET['board'] : die();
$squares = str_split($position);
class Game {
    var $position;
    function __construct($squares) {
        $this->position = str_split($squares);
    }
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
	function display() {
		foreach($this->position as $cell) {
			if ($i % 3 == 0) {
				echo "<br/>";
				$i = 0;
			}
			echo $thing . " ";
			$i++;
		}
	}
}
$game = new Game($position);
$game->display();
if ($game->winner('x'))
	echo 'You win. Luckey guesses!';
else if ($game->winner('o'))
	echo 'I win. Muahahahahaha';
else
	echo 'No winner yet, but you are losing.';

$i = 0;
?>