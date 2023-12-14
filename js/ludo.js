function login(){
	var username = document.getElementById("Username").value;
    var password = document.getElementById("pass").value;
	if (username === "" || password === "") {
		window.alert("Add username and password.");
		return false;
	}
}
