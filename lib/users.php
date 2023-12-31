<?php

require_once "../lib/game.php";

function handle_user($method, $b,$input) {
	if($method=='GET') {
		show_user($b);
	} else if($method=='PUT') {
        set_user($b,$input);
    }
}

function show_user($b) {
	global $mysqli;
	$sql = 'select username,piece_color from players where piece_color=?';
	$st = $mysqli->prepare($sql);
	$st->bind_param('s',$b);
	$st->execute();
	$res = $st->get_result();
	header('Content-type: application/json');
	print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
}

function set_user($b,$input) {
    if(!isset($input['username']) || $input['username']=='') {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"No username given."]);
		exit;
	}
	$username=$input['username'];
	global $mysqli;

	$sql = 'select count(*) as c from players where piece_color=? and username is not null';
	$st = $mysqli->prepare($sql);
	$st->bind_param('s',$b);
	$st->execute();
	$res = $st->get_result();
	$r = $res->fetch_all(MYSQLI_ASSOC);
	if($r[0]['c']>0) {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"Player $b is already set. Please select another color."]);
		exit;
	}

	$sql = 'update players set username=?, token=md5(CONCAT( ?, NOW()))  where piece_color=?';
	$st2 = $mysqli->prepare($sql);
	$st2->bind_param('sss',$username,$username,$b);
	$st2->execute();

	update_game_status();
	print_r("First move for red player:4,2 and for purple player:10,12!");
	$sql = 'select * from players where piece_color=?';
	$st = $mysqli->prepare($sql);
	$st->bind_param('s',$b);
	$st->execute();
	$res = $st->get_result();
	header('Content-type: application/json');
	print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
}


function current_token($piece_color) {
	
	global $mysqli;
	if($piece_color==null) {return(null);}
	$sql = 'select * from players where piece_color=?';
	$st = $mysqli->prepare($sql);
	$st->bind_param('s',$piece_color);
	$st->execute();
	$res = $st->get_result();
	if($row=$res->fetch_assoc()) {
		return($row['token']);
	}
	return(null);
}

function pawn_color($x,$y) {
	
	global $mysqli;
	$sql = 'select piece_color from board where x=? and y=?';
	$st = $mysqli->prepare($sql);
	$st->bind_param('ii',$x,$y);
	$st->execute();
	$res = $st->get_result();
	if($row=$res->fetch_assoc()) {
		return($row['piece_color']);
	}
	return(null);
}

function selectPiece($x,$y){
	global $mysqli;
	$sql = 'select piece from board where x=? and y=?';
	$st = $mysqli->prepare($sql);
	$st->bind_param('ii',$x,$y);
	$st->execute();
	$res = $st->get_result();
	if($row=$res->fetch_assoc()) {
		return($row['piece']);
	}
	return(null);
}
//for red player
function move_Rx($number){
	global $mysqli;
	$sql = 'select x from move_R where number=?';
	$st = $mysqli->prepare($sql);
	$st->bind_param('i',$number);
	$st->execute();
	$res = $st->get_result();
	if($row=$res->fetch_assoc()) {
		return($row['x']);
	}
	return(null);
}
function move_Ry($number){
	global $mysqli;
	$sql = 'select y from move_R where number=?';
	$st = $mysqli->prepare($sql);
	$st->bind_param('i',$number);
	$st->execute();
	$res = $st->get_result();
	if($row=$res->fetch_assoc()) {
		return($row['y']);
	}
	return(null);
}
function move_Rnumber($x,$y){
	if((($x==4) && ($y==2))||(($x==3) && ($y==2))) //arxikes theseis tou K1 kai K2 gia red player
	{
		return(0);
	}
	global $mysqli;
	$sql = 'select number from move_R where x=? and y=?';
	$st = $mysqli->prepare($sql);
	$st->bind_param('ii',$x,$y);
	$st->execute();
	$res = $st->get_result();
	if($row=$res->fetch_assoc()) {
		return($row['number']);
	}
	return(null);
}
//for purple player
function move_Px($number){
	global $mysqli;
	$sql = 'select x from move_P where number=?';
	$st = $mysqli->prepare($sql);
	$st->bind_param('i',$number);
	$st->execute();
	$res = $st->get_result();
	if($row=$res->fetch_assoc()) {
		return($row['x']);
	}
	return(null);
}
function move_Py($number){
	global $mysqli;
	$sql = 'select y from move_P where number=?';
	$st = $mysqli->prepare($sql);
	$st->bind_param('i',$number);
	$st->execute();
	$res = $st->get_result();
	if($row=$res->fetch_assoc()) {
		return($row['y']);
	}
	return(null);
}
function move_Pnumber($x,$y){
	if((($x==10) && ($y==12))||(($x==11) && ($y==12))) //arxikes theseis tou K1 kai K2 gia purple player
	{
		return(0);
	}
	global $mysqli;
	$sql = 'select number from move_P where x=? and y=?';
	$st = $mysqli->prepare($sql);
	$st->bind_param('ii',$x,$y);
	$st->execute();
	$res = $st->get_result();
	if($row=$res->fetch_assoc()) {
		return($row['number']);
	}
	return(null);
}

function win_status($R,$P){
	if($R==1){
		return("Red player won");
	}
	else if($P==1){
		return("Purple player won");
	}
	else {return (null);}

}

?>