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
	print_r("First move for red player : x=4 y=2 and for purple player : x=10 y=12!");
	print_r ("\n");
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

function show_winner(){
	global $mysqli;
	$sql = 'select winner from show_winner where status=1';
	$st = $mysqli->prepare($sql);
	$st->execute();
	$res = $st->get_result();
	if($row=$res->fetch_assoc()) {
		return($row['winner']);
	}
	return(null);
}
function update_winner($idWinner){//Show winner status=0=no winner if status=1=winner, id=1 for red player and id=2 for purple player
	global $mysqli;
	$sql = 'update show_winner set status=1 where id=?'; 
	$st = $mysqli->prepare($sql); 
	$st->bind_param('i',$idWinner);
	$st->execute();
}
function update_status(){ //for winner
	global $mysqli;
	$sql = "update game_status set status='ended', p_turn=null"; //set status, turn for the end of game
	$st = $mysqli->prepare($sql);
	$r = $st->execute();
}
function set_result($result){ //set result for the end of game
	global $mysqli;
	if($result=='Red'){
		$sql = "update game_status set result='R'";
		$st = $mysqli->prepare($sql);
		$st->execute();
	}
	else {
		$sql = "update game_status set result='P'";
		$st = $mysqli->prepare($sql);
		$st->execute();
	}
}

function show_users() {
	global $mysqli;
	$sql = 'select username,piece_color from players';
	$st = $mysqli->prepare($sql);
	$st->execute();
	$res = $st->get_result();
	header('Content-type: application/json');
	print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
}
?>