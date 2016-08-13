//Get all the image elements.
var img_array = document.getElementsByClassName("thumb");
//Cycle through the array of images.
for(i = 0; i < img_array.length; i++){
	//Make the counter and id global variables.
	var index = i;
	var id = img_array[i].id;
	
	//Add an event listener to each image.
	img_array[i].addEventListener("click", function(event){
		event.preventDefault();
		//When clicked, open popup window.
		//Make an ajax request to display the image.
		display_image(index, this.name);
		//Add an event listener to each button in the popup.
		document.getElementById("btn_close").addEventListener("click", function(event){
			event.preventDefault();
			this.parentNode.parentNode.style.display = "none";
		}, false);

		document.getElementById("btn_back").addEventListener("click", function(event){
			event.preventDefault();
			document.getElementById(id).style.backgroundImage = display_image(index, 'back');
		}, false);


		document.getElementById("btn_front").addEventListener("click", function(event){
			event.preventDefault();
			document.getElementById(id).style.backgroundImage = display_image(index, 'front');
		}, false);
	}, false);
}

function display_image(index, view){	
	var xhttp = new XMLHttpRequest();
	var post_data = "view=" + view + "&index=" + index;
	xhttp.onreadystatechange = function(){
		if (xhttp.readyState == 4 && xhttp.status == 200){
			//Get the image.
			var img_return = xhttp.responseText;
			//Set the image in the large_image_div.
			document.getElementById("large_image_div").style.backgroundImage = 'url(' + img_return + ')';
			//Display the popup.
			document.getElementById("popup").style.display = "block";
		}
	}
	xhttp.open("POST", "store_001_get_image.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(post_data);
}