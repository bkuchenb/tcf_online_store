function create_listener(index){
	//Add an event listener to each image.
	img_array[index].addEventListener("click", function(event){
		event.preventDefault();
		//When clicked, open popup window.
		//Make an ajax request to display the image.
		display_image(index, img_array[index].name);
	}, false);
}

function display_image(index, view){	
	var xhttp = new XMLHttpRequest();
	var post_data = "view=" + view + "&index=" + index;
	xhttp.onreadystatechange = function(){
		if (xhttp.readyState == 4 && xhttp.status == 200){
			//Get the image.
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

function check_email(email){
	email = document.getElementById("email");
}