//Get the email and password element.
var email = document.getElementsById("email");
var password = document.getElementsById("password");
//Cycle through the array of images.

//Add an event listener to the email.
email.addEventListener("onblur", function(event){
	event.preventDefault();
	//Check to see if this user already exists.
	console.log(email.value)
	var exists = check_email(email.value);
}, false);

document.getElementById("btn_back").addEventListener("click", function(event){
	event.preventDefault();
	//Display the back view picture.
	
}, false);