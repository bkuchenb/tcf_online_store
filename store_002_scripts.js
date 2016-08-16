//Get all the image elements.
var img_array = document.getElementsByClassName("thumb");
var i = 0;
//Cycle through the array of images.
for(i = 0; i < img_array.length; i++){
	create_listener(i);
}

//Add an event listener to each button in the popup.
document.getElementById("btn_close").addEventListener("click", function(event){
	event.preventDefault();
	this.parentNode.parentNode.style.display = "none";
}, false);

document.getElementById("btn_back").addEventListener("click", function(event){
	event.preventDefault();
	//Display the back view picture.
	display_image(document.getElementById("large_image_div").name, 'back');
}, false);

document.getElementById("btn_front").addEventListener("click", function(event){
	event.preventDefault();
	//Display the front view picture.
	display_image(document.getElementById("large_image_div").name, 'front');
}, false);