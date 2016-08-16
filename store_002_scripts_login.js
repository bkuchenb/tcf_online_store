//Get the email and password element.
var email = document.getElementsById("email");
var pword = document.getElementsById("password");

//Add an event listener to the email.
email.addEventListener("onblur", function(event){
	event.preventDefault();
	//Check to see if this user already exists.
	console.log(email.value)
	var exists = check_email(email.value, pword.value);
}, false);

function check_email(email, pword){
	var xhttp = new XMLHttpRequest();
	var post_data = "email=" + email + "&password=" + pword;
	xhttp.onreadystatechange = function(){
		if (xhttp.readyState == 4 && xhttp.status == 200){
			//Get the response from php.
			var img_return = xhttp.responseText;
			//Set the image in the large_image_div and set the data-index.
			document.getElementById("large_image_div").style.backgroundImage = 'url(' + img_return + ')';
			document.getElementById("large_image_div").name = index;
			//Display the popup.
			document.getElementById("popup").style.display = "block";
		}
	}
	xhttp.open("POST", "store_001_get_image.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(post_data);
}