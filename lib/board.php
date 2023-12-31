<?php
require_once "../lib/users.php";
require_once "../lib/game.php";

function move_piece($x,$y,$input) {
	    
	if(show_winner()!=null){
		$winner=show_winner();
		print json_encode(['Winner'=>"$winner"]);
		print json_encode(['Error message'=>"Game is not in action."]);
		show_score();
		show_board();
		exit;
	}

    $status = read_status();
	if($status['status']!='started') {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['Error message'=>"Game is not in action."]);
		exit;}	
	
    $piece_color=$input['piece_color'];
	if($piece_color==null || $piece_color=='') {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['Error message'=>"Color is null."]);
		exit; 
	}

	if (($piece_color!='R') && ($piece_color!='P')) {
		header("HTTP/1.1 404 Not Found");
        print json_encode(['Error message'=>"Player with piece_color $piece_color is not found."]);
        exit;
    }

	$token = current_token($piece_color);
	$pawn_color = pawn_color($x,$y);
	if($token==null) {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['Error message'=>"You are not a player of this game."]);
		exit;}
	
	if($status['p_turn']!=$piece_color) {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['Error message'=>"It is not your turn."]);
		exit;}

	if($pawn_color==null){
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['Error message'=>"You have access to move only pawns."]); //den mporeis na metafereis kenh thesi
		exit;}

	if($pawn_color!=$piece_color){
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['Error message'=>"You have access to move only your pawns."]); //den mporeis na metafereis pioni allou paikth
		exit;}

	$dice = rand(2,12); //as sum of two dices
	print json_encode(['Dice'=>"$dice"]);
	
	$piece=selectPiece($x,$y);
	
	if($piece_color=='R'){
		$number = move_Rnumber($x,$y); //return position for Red player into steps
		$number += ($dice); //prosthesi me o zari
		if(($piece=='K1')&&($number>=51)){
			$number=51;
			$x2=move_Rx($number); //kainourgia thesi gia to pioni
			$y2=move_Ry($number);
			print json_encode(['Message'=>"Finish K1 in x=7 y=5. K2 in position x=3 y=2."]);
			do_move($x,$y,$x2,$y2,$piece_color);
			show_board();
			$x2=3;
			$y2=2;
			nextPosition($x2,$y2,$piece_color); //3,2 h thesi ekinisis tou red K2 
			exit;
		}
	    else if(($piece=='K2')&&($number>=50)){
			$number=50;
			$x2=move_Rx($number); //kainourgia thesi gia to pioni
			$y2=move_Ry($number);
			print json_encode(['Message'=>"You won!!!"]);
			do_move($x,$y,$x2,$y2,$piece_color);
			update_winner(1); //stop the game and message to other player, id=1 for red player
			update_status();
			set_result("Red");
			count_score();
			show_score();
			show_board();
			exit;
		}
		else {
		    $x2=move_Rx($number); //kainourgia thesi gia to pioni
		    $y2=move_Ry($number);
			if(ispawn($x2,$y2)!=null){ //ena pioni tou idiou paikth kathe fora sto paixnidi, opote sigoura pioni antipalou
				print json_encode(['Message'=>"There is a purple pawn in this position. You won!"]);
				do_move($x,$y,$x2,$y2,$piece_color);
				update_winner(1); //stop the game and message to other player, id=1 for red player
				update_status();  //update status and turn
				set_result("Red"); //update winner (result)
				count_score();
				show_score();
				show_board();
				exit;
			}
			print json_encode(['Next position'=>"x=$x2, y=$y2"]);
		    do_move($x,$y,$x2,$y2,$piece_color);
			nextPosition($x2,$y2,$piece_color);
			show_board();
		    exit;
		}
	}
	else {
		$number = move_Pnumber($x,$y); //return position for Purple player into steps
		$number = $number+$dice;
		if(($piece=='K1')&&($number>=51)){
			$number=51;
			$x2=move_Px($number);  //kainourgia thesi gia to pioni
			$y2=move_Py($number);
			print json_encode(['Message'=>"Finish K1 in x=7 y=9. K2 in position x=11 y=12"]);
			do_move($x,$y,$x2,$y2,$piece_color);
			show_board();			
			$x2=11;
			$y2=12;
			nextPosition($x2,$y2,$piece_color); //11,12 h thesi ekinisis tou purple K2 
			exit;
		}
		else if(($piece=='K2')&&($number>=50)){
			$x2=move_Px($number); //kainourgia thesi gia to pioni
		    $y2=move_Py($number);
			print json_encode(['Message'=>"You won!!!"]);
			
			do_move($x,$y,$x2,$y2,$piece_color);
			update_winner(2);  //stop the game and message to other player, id=2 for purple player
			update_status();   //update status and turn
			set_result("Purple");  //update winner (result)
			count_score();
			show_score();
			show_board();
			exit;
		}
		else {
			$x2=move_Px($number);
			$y2=move_Py($number);
			if(ispawn($x2,$y2)!=null){ //ena pioni tou idiou paikth kathe fora sto paixnidi, opote sigoura pioni antipalou
				print json_encode(['Message'=>"There is a red pawn in this position. You won!"]);
				do_move($x,$y,$x2,$y2,$piece_color);
				update_winner(2); //stop the game and message to other player, id=2 for purple player
				update_status();  //update status and turn
				set_result("Purple");  //update winner (result)
				count_score();
				show_score();
				show_board();
				exit;
			}
			print json_encode(['Next position'=>"x=$x2, y=$y2"]);
			do_move($x,$y,$x2,$y2,$piece_color);
			nextPosition($x2,$y2,$piece_color);
			show_board();
			exit;}
	}
	
	header("HTTP/1.1 400 Bad Request");
	print json_encode(['Error message'=>"This move is illegal."]);
	exit;
}
function do_move($x,$y,$x2,$y2,$piece_color) {
	global $mysqli;
	$sql = 'call `move_piece`(?,?,?,?,?);';
	$st = $mysqli->prepare($sql);
	$st->bind_param('iiiii',$x,$y,$x2,$y2,$piece_color);
	$st->execute();
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
	update_game_status(); 
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
		$id=1; //gia red player
		$sql = 'update position set x=?, y=? where id=?'; //apothikeusi sto position thn thesi pou exei to pioni ekeinh thn stigmh
		$st = $mysqli->prepare($sql);
		$st->bind_param('iii',$x2,$y2,$id);
		$st->execute();
	}
	else{
		global $mysqli;
		$id=2; //gia purple player
		$sql = 'update position set x=?, y=? where id=?'; //apothikeusi sto position thn thesi pou exei to pioni ekeinh thn stigmh
		$st = $mysqli->prepare($sql);
		$st->bind_param('iii',$x2,$y2,$id);
		$st->execute();
	}
}

?>

