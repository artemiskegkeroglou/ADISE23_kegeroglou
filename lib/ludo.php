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
if(isset($_SERVER['HTTP_X_TOKEN'])) {
    $input['token']=$_SERVER['HTTP_X_TOKEN'];
} else {
    $input['token']='';
}

switch ($r=array_shift($request)) {
    case 'board' : 
        switch ($b=array_shift($request)) {
            case '':
            case null: handle_board($method,$input);
                        break;
            case 'piece': handle_piece($method, $request[0], $request[1], $input);
                        break;
            }
            break;
    case 'define_player' : define_player($method, $request[0],$request[1]);
                break;
    case 'players': handle_player($method, $request, $input);
	        break;
    case 'status': 
		if(sizeof($request)==0) {handle_status($method);}
		else {header("HTTP/1.1 404 Not Found");}
			    break; 
    case 'reset_color' : reset_color();
            break;
 	default:  header("HTTP/1.1 404 Not Found");
            exit;
}


function handle_board($method,$input) {
    if($method=='GET') {
            show_board($input);
    } else if ($method=='POST') {
           reset_board($input);
           show_board($input);
    } else {
        header('HTTP/1.1 405 Method Not Allowed');
    }
    
}

function handle_piece($method, $x, $y, $input) {
    if($method=='GET') {
        show_piece($x,$y);
} else if ($method=='PUT') {
        move_piece($x,$y,$input);
}

}

function handle_player($method, $p,$input) {
    switch ($b=array_shift($p)) {
        //	case '':
        //	case null: if($method=='GET') {show_users($method);}
        //			   else {header("HTTP/1.1 400 Bad Request"); 
        //					 print json_encode(['errormesg'=>"Method $method not allowed here."]);}
        //                break;
            case 'R': 
            case 'P': handle_user($method, $b, $input);
                        break;
            default: header("HTTP/1.1 404 Not Found");
                     print json_encode(['errormesg'=>"Player $b not found."]);
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

// function define_player($method, $username, $n, $length = 16) {
//     if($method=='PUT'){
//         if($n==0){
//             $piece_color='R';
//             $string = uniqid(rand());
//             $randomString = substr($string, 0, $length);
//             $username = $data['username'];
//             global $mysqli;
//             $sql = "INSERT INTO players VALUES ('$username', 'R', '$randomString')";
// 	        $st = $mysqli->prepare($sql);
// 	        $st->bind_param('iii', $username, $piece_color, $randomString);
// 	        $st->execute();
//         }
//         else{
//             $piece_color='P';
//             $string = uniqid(rand());
//             $randomString = substr($string, 0, $length);
//             global $mysqli;
// 	        $sql = "INSERT INTO players (username, piece_color, token) VALUES (?, ?, ?)";
// 	        $st = $mysqli->prepare($sql);
// 	        $st->bind_param('iii', $username, $piece_color, $randomString);
// 	        $st->execute();
//         }
        
//     } else {
//         header('HTTP/1.1 405 Method Not Allowed');
//     }
// }
?>