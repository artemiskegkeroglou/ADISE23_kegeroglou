<?php
require_once "../lib/board.php";
require_once "../lib/users.php";

function show_status() {
	global $mysqli;
	check_abort();
	show_score();
	$sql = 'select * from game_status';
	$st = $mysqli->prepare($sql);

	$st->execute();
	$res = $st->get_result();

	header('Content-type: application/json');
	print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
}

function check_abort() {
	global $mysqli;
	$sql = "update game_status set status='aborded', result=null, p_turn=null where p_turn is not null and last_change<(now()-INTERVAL 5 MINUTE) and status='started'";
	$st = $mysqli->prepare($sql);
	$r = $st->execute();
}

function read_status() {
	global $mysqli;
	
	$sql = 'select * from game_status';
	$st = $mysqli->prepare($sql);

	$st->execute();
	$res = $st->get_result();
	$status = $res->fetch_assoc();
	return($status); }

function update_game_status() { //status value='not active' or 'initialized' or 'started'  or 'aborded'. Status 'ended' in update_status function (users.php)
	global $mysqli;

	$sql = 'select * from game_status';
	$st = $mysqli->prepare($sql);

	$st->execute();
	$res = $st->get_result();
	$status = $res->fetch_assoc();
	
	
	$new_status=null;
	$new_turn=null;
	
	$st3=$mysqli->prepare('select count(*) as aborted from players WHERE last_action< (NOW() - INTERVAL 5 MINUTE)');
	$st3->execute();
	$res3 = $st3->get_result();
	$aborted = $res3->fetch_assoc()['aborted'];
	if($aborted>0) {
		$sql = "UPDATE players SET username=NULL, token=NULL WHERE last_action< (NOW() - INTERVAL 5 MINUTE)";
		$st2 = $mysqli->prepare($sql);
		$st2->execute();
		if($status['status']=='started') {
			$new_status='aborted';
		}
	}
	$sql = 'select count(*) as c from players where username is not null';
	$st = $mysqli->prepare($sql);
	$st->execute();
	$res = $st->get_result();
	$active_players = $res->fetch_assoc()['c'];
	
	
	switch($active_players) {
		case 0: $new_status='not active'; break;
		case 1: $new_status='initialized'; break;
		case 2: $new_status='started'; 
				if($status['p_turn']==null) {
					$new_turn='R'; // It was not started before...
				}
				break;
	}

	$sql = 'update game_status set status=?, p_turn=?';
	$st = $mysqli->prepare($sql);
	$st->bind_param('ss',$new_status,$new_turn);
	$st->execute();	
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

function ispawn($x2,$y2) { //function for destination position
	
	global $mysqli;
	$sql = 'select piece_color from board where x=? and y=?';
	$st = $mysqli->prepare($sql);
	$st->bind_param('ii',$x2,$y2);
	$st->execute();
	$res = $st->get_result();
	if($row=$res->fetch_assoc()) {
		return($row['piece_color']);
	}
	return(null);
}

function count_score(){  //set score of Red Purple players
    global $mysqli;
	$sql = 'call `count_score`();';
	$st = $mysqli->prepare($sql);
	$st->execute();
}
function show_score(){  //show score of Red Purple players
    global $mysqli;
	$sql = 'select * from score';
	$st = $mysqli->prepare($sql);
	$st->execute();
	$res = $st->get_result();
	header('Content-type: application/json');
	print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
}

?>