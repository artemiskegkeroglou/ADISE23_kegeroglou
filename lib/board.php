<?php
require_once "../lib/users.php";

function move_piece($x,$y,$input) {

	if(show_winner()!=null){
		$winner=show_winner();
		print_r("$winner won");
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
		print json_encode(['errormesg'=>"There is not a pawn in this position."]);
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
			exit;
		}
	    else if(($piece=='K2')&&($number>=50)){
			$number=50;
			$x2=move_Rx($number);
			$y2=move_Ry($number);
			update_winner(1);
			print_r("You won!!!"); //stop the game and message to other player
			print_r ("\n");
			do_move($x,$y,$x2,$y2,$piece_color);
			exit;
		}
		else {
		    $x2=move_Rx($number);
		    $y2=move_Ry($number);
		    print_r("Next position: x=$x2 y=$y2");
			print_r ("\n");
		    do_move($x,$y,$x2,$y2,$piece_color);
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
			exit;
		}
		else if(($piece=='K2')&&($number>=50)){
			$x2=move_Px($number);
		    $y2=move_Py($number);
			print_r("You won!!!"); //stop the game and message to other player
			print_r ("\n");
			update_winner(2);
			do_move($x,$y,$x2,$y2,$piece_color);
			exit;
		}
		else {
			$x2=move_Px($number);
			$y2=move_Py($number);
			print_r("Next position: x=$x2 y=$y2");
			print_r ("\n");
			do_move($x,$y,$x2,$y2,$piece_color);
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

	show_board($piece_color);
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
function show_board($piece_color) {
	global $mysqli;
	
	$b=$piece_color;
	if($b) {
		show_board_by_player($b);
	} else {
		header('Content-type: application/json');
		print json_encode(read_board(), JSON_PRETTY_PRINT);
	}
}
function show_board_by_player($b) {

	global $mysqli;

	$orig_board=read_board();
	$board=convert_board($orig_board);
	$status = read_status();
	 //if($status['status']=='started' && $status['p_turn']==$b && $b!=null) {
	// It my turn !!!!
		//$n = add_valid_moves_to_board($board,$b);
		
		// Εάν n==0, τότε έχασα !!!!!
		// Θα πρέπει να ενημερωθεί το game_status.
	//} 
	header('Content-type: application/json');
	print json_encode($orig_board, JSON_PRETTY_PRINT);
}

function convert_board(&$orig_board) {
	$board=[];
	foreach($orig_board as $i=>&$row) {
		$board[$row['x']][$row['y']] = &$row;
	} 
	return($board);
}

function read_board() {
	global $mysqli;
	$sql = 'select * from board';
	$st = $mysqli->prepare($sql);
	$st->execute();
	$res = $st->get_result();
	return($res->fetch_all(MYSQLI_ASSOC));
}
function reset_board($input) {
	global $mysqli;
	
	$sql = 'call clean_board()';
	$mysqli->query($sql);
	show_board($input);
}
?>

