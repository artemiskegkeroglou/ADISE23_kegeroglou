<?php
require_once "../lib/db_connect.php"; 
require_once "../lib/board.php";
require_once "../lib/game.php";
require_once "../lib/users.php";

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);
if($input==null) {
    $input=[];
}

switch ($r=array_shift($request)) {
    case 'board' : 
        switch ($b=array_shift($request)) {
            case '':
            case null: handle_board($method,$input);
                        break;
            case 'piece': handle_piece($method, $input);
                        break;
            }
            break;
    case 'players': handle_player($method, $request, $input);
	        break;
    case 'drop_players': drop_players($method);
            break;
    case 'status': 
		if(sizeof($request)==0) {handle_status($method);}
		else {header("HTTP/1.1 404 Not Found");}
			break; 
 	default:  header("HTTP/1.1 404 Not Found");
            exit;
}


function handle_board($method,$input) {
    if($method=='GET') {
        show_board();
    } else if ($method=='POST') {
        reset_board();
    } else {
        header('HTTP/1.1 405 Method Not Allowed');
    }
    
}

function handle_piece($method, $input) {
    if($method=='GET') {
        $x=get_position($input['piece_color'],'x');
        $y=get_position($input['piece_color'],'y');
        show_piece($x,$y);
}   else if ($method=='PUT') {
        $x=get_position($input['piece_color'],'x');
        $y=get_position($input['piece_color'],'y');
        move_piece($x,$y,$input);
}
else {
    header('HTTP/1.1 405 Method Not Allowed');
}

}

function handle_player($method, $p,$input) {
    switch ($b=array_shift($p)) {
        	case '':
        	case null: if($method=='GET') {show_users($method);}
        			   else {header("HTTP/1.1 400 Bad Request"); 
        					 print json_encode(['Error message'=>"Method $method not allowed here."]);}
                        break;
            case 'R': 
            case 'P': handle_user($method, $b, $input);
                        break;
            default: header("HTTP/1.1 404 Not Found");
                     print json_encode(['Error message'=>"Player $b not found."]);
                     break;
        }
}

function handle_status($method) {
    if($method=='GET') {
        show_status();
    } else {
        header('HTTP/1.1 405 Method Not Allowed');
    }
}

function drop_players($method) {
    if($method=='POST'){
        global $mysqli;
	    $sql = 'call `drop_players`();'; //procedure gia diagrafh paiktwn kai tou score tous
	    $st = $mysqli->prepare($sql);
	    $st->execute();}
    else {
        header('HTTP/1.1 405 Method Not Allowed');
    }
    
}

?>