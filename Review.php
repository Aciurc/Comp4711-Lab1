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
function winner($token, $position) {
	for($row=0; $row<3; $row++) {
		$result = true;
		for($col=0; $col<3; $col++) {
			if ($position[3*$row+$col] != $token)
				$result = false;
		}
	}
	/*$won = false;
    if (($position[0] == $token) &&
		($position[1] == $token) &&
		($position[2] == $token)) {
		$won = true;
	} else if (($position[3] == $token) &&
		($position[4] == $token) &&
		($position[5] == $token)) {
		$won = false;
	}*/
	return $result;
}
if (winner('x', $squares)) echo 'You win.';
else if (winner('o', $squares)) echo 'I win.';
else echo 'No winner yet.';
?>