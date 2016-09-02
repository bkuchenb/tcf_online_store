//Prevent the browser from opening images in a new page.
window.addEventListener("dragover", function(e){
  e = e || event;
  e.preventDefault();
},false);
window.addEventListener("drop",function(e){
  e = e || event;
  e.preventDefault();
},false);
//Get the navbar_right element.
var navbar_right = document.getElementsByClassName('navbar_right');
//Add a submit button to the navbar.
var btn_submit = document.createElement('BUTTON');
btn_submit.innerHTML = 'Submit';
btn_submit.style.fontWeight = 'bold';
navbar_right[0].appendChild(btn_submit);
//Add an action listener to the submit button.
btn_submit.addEventListener("click", function(event){
	event.preventDefault();
	for(var j = 0; j < file_uploads.length; j++){
		upload_images(file_uploads[j]);
	}
}, false);
//Create a variable to store the files that will be uploaded.
var file_uploads = [];
//Get all the image_box divs.
var image_box   = document.getElementsByClassName('image_box');
//Cycle through the image_box elements.
for(var i = 0; i < image_box.length; i++){
	image_box[i].ondragover = function(){
		return false;
	};
	image_box[i].ondragend = function(){
		return false;
	};
	//When an image is dropped in the box, save the file.
	image_box[i].ondrop = function(e){
		//Get the files added.
		var files = e.dataTransfer.files;
		if (files[0].type.indexOf("image") == 0){
			file_uploads.push(files[0]);
			//Change the text displayed.
			this.innerHTML = files[0].name;
		}
		return false;
	};
}

function upload_images(file){
	var xhttp = new XMLHttpRequest();
	var formdata = new FormData();
	formdata.append('image', file);
	xhttp.onreadystatechange = function(){
		if (xhttp.readyState == 4 && xhttp.status == 200){
			//Get the response from ajax.
			var image_uploaded = xhttp.responseText;
		}
	}
	xhttp.open('POST', 'store_001_save_file.php', true);
	xhttp.send(formdata);
}
