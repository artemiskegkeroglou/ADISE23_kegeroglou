function draw_empty_board(p) {
	
	if(p!='P') {p='R';}
	var draw_init = {
		'R': {i1:13;,i2:0,istep:-1,j1:1,j2:14,jstep:1},
		'P': {i1:1,i2:13,istep:1, j1:13,j2:0,jstep:-1}
	};
	var s=draw_init[p];
	var t='<table id="ludo_table">';
	for(var i=s.i1;i!=s.i2;i+=s.istep) {
		t += '<tr>';
		for(var j=s.j1;j!=s.j2;j+=s.jstep) {
			t += '<td class="ludo_square" id="square_'+j+'_'+i+'">' + j +','+i+'</td>'; 
		}
		t+='</tr>';
	}
	t+='</table>';
	
	$('#ludo_board').html(t);
	$('.ludo_square').click(click_on_piece);
}
function fill_board() {
	$.ajax({url: "chess.php/board/", 
		headers: {"X-Token": me.token},
		success: fill_board_by_data });
}