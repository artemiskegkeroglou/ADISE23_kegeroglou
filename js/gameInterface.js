/*function show_start_table() {
    var leftBoard = document.getElementById("starting_board");

    var table = document.createElement('TABLE');
    table.border = '2';

    var tableBody = document.createElement('TBODY');
    table.appendChild(tableBody);

    for (var i = 0; i < 14; i++) {
        var tr = document.createElement('TR');
        tableBody.appendChild(tr);

        for (var j = 0; j < 14; j++) {
            var td = document.createElement('TD');
            
            td.appendChild(document.createTextNode( i + "," + j));
            tr.appendChild(td);
        }
    }
    leftBoard.appendChild(table);
}*/

var board = document.getElementById("button");
button.addEventListener("click",show_start_table);

function loadDoc() {
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
	  myFunction(this);
	}
	xhttp.open("GET", "ludo.php");
	xhttp.send();
  }
  function myFunction(php) {
	const phpDoc = php.responsePHP;
	const x = phpDoc.getElementsByTagName("board");
	let table="<tr><th>X</th><th>Y</th></tr>";
	for (let i = 0; i <x.length; i++) { 
	  table += "<tr><td>" +
	  x[i].getElementsByTagName("x")[0].childNodes[0].nodeValue +
	  "</td><td>" +
	  x[i].getElementsByTagName("y")[0].childNodes[0].nodeValue +
	  "</td></tr>";
	}
	document.getElementById("demo").innerHTML = table;
  }/*
  function showBoard() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("demo").innerHTML = this.responseText;
    }
    xhttp.open("GET", ludo.php/board");
    xhttp.send();
  }
  function draw_empty_board(p) {
	
	if(p!='R') {p='P';}
	var draw_init = {
		'R': {i1:8,i2:0,istep:-1,j1:1,j2:9,jstep:1},
		'P': {i1:1,i2:9,istep:1, j1:8,j2:0,jstep:-1}
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
	$('.button').click(click_on_piece);
}*/