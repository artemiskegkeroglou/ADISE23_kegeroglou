<?php
require_once "../lib/users.php";
function move_piece($x,$y,$input) {
	$x2=$input['x2'];
    $y2=$input['y2'];
    $piece_color=$input['piece_color'];

	if($piece_color==null || $piece_color=='') {
	header("HTTP/1.1 400 Bad Request");
	print json_encode(['errormesg'=>"Color is not found."]);
	exit; }
	switch ($piece_color) {
            case 'R': 
            case 'P': $token = current_token($piece_color);
			          if($token==null ) {
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


                        break;
            default: header("HTTP/1.1 404 Not Found");
                     print json_encode(['errormesg'=>"Player with piece_color $piece_color is not found."]);
                     break;
        }

	 

	// $orig_board=read_board();
	// $board=convert_board($orig_board);
	//$n = add_valid_moves_to_piece($board,$color,$x,$y);
	
	// if($n==0) {
	// 	header("HTTP/1.1 400 Bad Request");
	// 	print json_encode(['errormesg'=>"This piece cannot move."]);
	// 	exit;
	// }
	// foreach($board[$x][$y]['moves'] as $i=>$move) {
	// 	if($x2==$move['x'] && $y2==$move['y']) {
			do_move($x,$y,$x2,$y2,$input);
			exit;
	// 	}
	// }
	header("HTTP/1.1 400 Bad Request");
	print json_encode(['errormesg'=>"This move is illegal."]);
	exit;
}
function do_move($x,$y,$x2,$y2,$input) {
	global $mysqli;
	$sql = 'call `move_piece`(?,?,?,?);';
	$st = $mysqli->prepare($sql);
	$st->bind_param('iiii',$x,$y,$x2,$y2 );
	$st->execute();

	//show_board($input);
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
function show_board($input) {
	global $mysqli;
	
	$b=$input['piece_color'];
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
	/* if($status['status']=='started' && $status['p_turn']==$b && $b!=null) {
		// It my turn !!!!
		$n = add_valid_moves_to_board($board,$b);
		
		// Εάν n==0, τότε έχασα !!!!!
		// Θα πρέπει να ενημερωθεί το game_status.
	} */
	header('Content-type: application/json');
	print json_encode($orig_board, JSON_PRETTY_PRINT);
}


function add_valid_moves_to_board(&$board,$b) {
	$number_of_moves=0;
	
	for($x=1;$x<14;$x++) {
		for($y=1;$y<14;$y++) {
			$number_of_moves+=add_valid_moves_to_piece($board,$b,$x,$y);
		}
	}
	return($number_of_moves);
}


/*
function add_valid_moves_to_piece(&$board,$b,$x,$y) {
	$number_of_moves=0;
	if($board[$x][$y]['piece_color']==$b) {
		switch($board[$x][$y]['piece']){
			case 'P': $number_of_moves+=pawn_moves($board,$b,$x,$y);break;
			case 'K': $number_of_moves+=king_moves($board,$b,$x,$y);break;
			case 'Q': $number_of_moves+=queen_moves($board,$b,$x,$y);break;
			case 'R': $number_of_moves+=rook_moves($board,$b,$x,$y);break;
			case 'N': $number_of_moves+=knight_moves($board,$b,$x,$y);break;
			case 'B': $number_of_moves+=bishop_moves($board,$b,$x,$y);break;
		}
	} 
	return($number_of_moves);
}*/


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

