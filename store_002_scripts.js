function display_popup(id, index){
	//Get the view from the element.
	var view = document.getElementById(id).name;
	//Make an ajax request to display the image.
	display_image(index, view);
	
	//Add an event listener to each button in the popup.
	document.getElementById("btn_close").addEventListener("click", function(event){
		event.preventDefault();
		this.parentNode.parentNode.style.display = "none";
	}, false);

	document.getElementById("btn_back").addEventListener("click", function(event){
		event.preventDefault();
		this.parentNode.style.backgroundImage = display_image(index, 'back');
	}, false);


	document.getElementById("btn_front").addEventListener("click", function(event){
		event.preventDefault();
		this.parentNode.style.backgroundImage = display_image(index, 'front');
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
/*
	//Get the image location.
	var url = document.getElementById(id).src;
	//Set the image background of the large_image_div.
	document.getElementById(large_image_div).style.background-image="url("url")";
	//Make the popup div visible.
	document.getElementById(popup).style.display = "block";
	
	if(view == "front")
			{
				document.getElementById(id).name = "back";
			}
			else
			{
				document.getElementById(id).name = "front";
			}
*/