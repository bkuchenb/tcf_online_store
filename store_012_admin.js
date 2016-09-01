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
navbar_right = document.getElementsByClassName('navbar_right');
//Add a submit button to the navbar.
btn_submit = document.createElement('BUTTON');
btn_submit.innerHTML = 'Submit';
btn_submit.style.fontWeight = 'bold';
navbar_right[0].appendChild(btn_submit);
//Get all the image_box divs.
var image_box   = document.getElementsByClassName('image_box');
//Cycle through the image_box elements.
for(var i = 0; i < image_box.length; i++){
	image_box[i].ondragover = function(){
		//this.style.backgroundColor = '#5cd65c';
		return false;
	};
	image_box[i].ondragend = function(){
		//this.style.backgroundColor = 'white';
		return false;
	};
	image_box[i].ondrop = function(e){
		//Get the files added.
		var files = e.dataTransfer.files;
		if (files[0].type.indexOf("image") == 0){
			var reader = new FileReader();
			reader.onload = function(e){
				file_upload = e.target.result;
			}
			reader.readAsDataURL(files[0]);
		}
		//Change the text displayed.
		this.innerHTML = files[0].name;
		return false;
	};
}
