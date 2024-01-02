<?php
require_once "../lib/users.php";
require_once "../lib/game.php";

function move_piece($x,$y,$input) {

	if(show_winner()!=null){
		$winner=show_winner();
		print_r("$winner won");
		show_board();
		exit;
	}
    $piece_color=$input['piece_color'];
	if($piece_color==null || $piece_color=='') {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"Color is null."]);
		exit; 
	}
	if (($piece_color!='R') && ($piece_color!='P')) {
		header("HTTP/1.1 404 Not Found");
        print json_encode(['errormesg'=>"Player with piece_color $piece_color is not found."]);
        exit;
    }
	$token = current_token($piece_color);
	$pawn_color = pawn_color($x,$y);
	if($token==null) {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"You are not a player of this game."]);
		exit;}
	$status = read_status();
	if($status['status']!='started') {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"Game is not in action."]);
		exit;}	
	if($status['p_turn']!=$piece_color) {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"It is not your turn."]);
		exit;}

	if($pawn_color==null){
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"You have access to move only pawns."]);
		exit;}
	if($pawn_color!=$piece_color){
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"You have access to move only your pawns."]);
		exit;}

	$dice = rand(2,12); //as sum of two dices
	print_r("Dice: $dice");
	print_r ("\n");
	$piece=selectPiece($x,$y);
	
	if($piece_color=='R'){
		$number = move_Rnumber($x,$y); //return position for Red player into steps
		$number += ($dice);
		if(($piece=='K1')&&($number>=51)){
			$number=51;
			$x2=move_Rx($number);
			$y2=move_Ry($number);
			print_r("Finish K1 in x=7 y=5. K2 in position x=3 y=2");
			print_r ("\n");
			do_move($x,$y,$x2,$y2,$piece_color);
			$x2=3;
			$y2=2;
			nextPosition($x2,$y2,$piece_color);
			exit;
		}
	    else if(($piece=='K2')&&($number>=50)){
			$number=50;
			$x2=move_Rx($number);
			$y2=move_Ry($number);
			update_winner(1); //stop the game and message to other player
			update_status();
			set_result("Red");
			print_r("You won!!!"); 
			print_r ("\n");
			do_move($x,$y,$x2,$y2,$piece_color);
			exit;
		}
		else {
		    $x2=move_Rx($number);
		    $y2=move_Ry($number);
			if(ispawn($x2,$y2)!=null){ //ena pioni tou idiou paikth kathe fora sto paixnidi, opote sigoura pioni antipalou
				update_winner(1); //stop the game and message to other player
				update_status();
				set_result("Red");
				print_r("There is a purple pawn in this position. You won!");
				print_r ("\n");
				do_move($x,$y,$x2,$y2,$piece_color);
				exit;
			}
		    print_r("Next position: x=$x2 y=$y2");
			print_r ("\n");
		    do_move($x,$y,$x2,$y2,$piece_color);
			nextPosition($x2,$y2,$piece_color);
		    exit;
		}
	}
	else {
		$number = move_Pnumber($x,$y); //return position for Purple player into steps
		$number = $number+$dice;
		if(($piece=='K1')&&($number>=51)){
			$number=51;
			$x2=move_Px($number);
			$y2=move_Py($number);
			print_r("Finish K1 in x=7 y=9. K2 in position x=11 y=12");
			print_r ("\n");
			do_move($x,$y,$x2,$y2,$piece_color);
			$x2=11;
			$y2=12;
			nextPosition($x2,$y2,$piece_color);
			exit;
		}
		else if(($piece=='K2')&&($number>=50)){
			$x2=move_Px($number);
		    $y2=move_Py($number);
			update_winner(2);  //stop the game and message to other player
			update_status();
			set_result("Purple");  
			print_r("You won!!!"); 
			print_r ("\n");
			do_move($x,$y,$x2,$y2,$piece_color);
			exit;
		}
		else {
			$x2=move_Px($number);
			$y2=move_Py($number);
			if(ispawn($x2,$y2)!=null){ //ena pioni tou idiou paikth kathe fora sto paixnidi, opote sigoura pioni antipalou
				update_winner(2); //stop the game and message to other player
				update_status();
				set_result("Purple");  
				print_r("There is a red pawn in this position. You won!");
				print_r ("\n");
				do_move($x,$y,$x2,$y2,$piece_color);
				exit;
			}
			print_r("Next position: x=$x2 y=$y2");
			print_r ("\n");
			do_move($x,$y,$x2,$y2,$piece_color);
			nextPosition($x2,$y2,$piece_color);
			exit;}
	}
	
	header("HTTP/1.1 400 Bad Request");
	print json_encode(['errormesg'=>"This move is illegal."]);
	exit;
}
function do_move($x,$y,$x2,$y2,$piece_color) {
	global $mysqli;
	$sql = 'call `move_piece`(?,?,?,?,?);';
	$st = $mysqli->prepare($sql);
	$st->bind_param('iiiii',$x,$y,$x2,$y2,$piece_color);
	$st->execute();

	show_board();
}
function show_piece($x,$y) {
	global $mysqli;
	
	$sql = 'select * from board where x=? and y=?';
	$st = $mysqli->prepare($sql);
	$st->bind_param('ii',$x,$y);
	$st->execute();
	$res = $st->get_result();
	header('Content-type: application/json');
	print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
}

function show_board() {
	global $mysqli;

	$sql = 'select * from board';
	$st = $mysqli->prepare($sql);
	$st->execute();
	$res = $st->get_result();
	header('Content-type: application/json');
	print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
}
function reset_board() {
	global $mysqli;
	$sql = 'call clean_board()';
	$mysqli->query($sql);
	update_game_status(); //set status=not active
	show_board();
}

function get_position($piece_color,$xORy){
	if(($piece_color=='R')&&($xORy=='x')){
		global $mysqli;
		$id=1;  //for red player
		$sql = 'select x from position where id=?';
		$st = $mysqli->prepare($sql);
		$st->bind_param('i',$id);
		$st->execute();
		$res = $st->get_result();
		if($row=$res->fetch_assoc()) {
			return($row['x']);
		}
		return(null);
	}
	else if(($piece_color=='R')&&($xORy=='y')){
		global $mysqli;
		$id=1;
		$sql = 'select y from position where id=?';
		$st = $mysqli->prepare($sql);
		$st->bind_param('i',$id);
		$st->execute();
		$res = $st->get_result();
		if($row=$res->fetch_assoc()) {
			return($row['y']);
		}
		return(null);
	}
	else if (($piece_color=='P')&&($xORy=='x')){
		global $mysqli;
		$id=2; //for purple player
		$sql = 'select x from position where id=?';
		$st = $mysqli->prepare($sql);
		$st->bind_param('i',$id);
		$st->execute();
		$res = $st->get_result();
		if($row=$res->fetch_assoc()) {
			return($row['x']);
		}
		return(null);
	}
	else {
		global $mysqli;
		$id=2; 
		$sql = 'select y from position where id=?';
		$st = $mysqli->prepare($sql);
		$st->bind_param('i',$id);
		$st->execute();
		$res = $st->get_result();
		if($row=$res->fetch_assoc()) {
			return($row['y']);
		}
		return(null);
	}
}

function nextPosition($x2,$y2,$piece_color){
	if($piece_color=='R'){
		global $mysqli;
		$id=1; 
		$sql = 'update position set x=?, y=? where id=?';
		$st = $mysqli->prepare($sql);
		$st->bind_param('iii',$x2,$y2,$id);
		$st->execute();
	}
	else{
		global $mysqli;
		$id=2; 
		$sql = 'update position set x=?, y=? where id=?';
		$st = $mysqli->prepare($sql);
		$st->bind_param('iii',$x2,$y2,$id);
		$st->execute();
	}
}

?>

