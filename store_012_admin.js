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
		//this.innerHTML = '';
		return false;
	};
	image_box[i].ondragend = function(){
		//this.innerHTML = '';
		return false;
	};
	image_box[i].ondrop = function(e){
		//Remove the text and border from the div.
		this.innerHTML = '';
		this.style.border = 'none';
		this.style.paddingLeft = '0px';
		//Get the files added.
		var files = e.dataTransfer.files;
		//Create and img tag and display the image.
		img = document.createElement('IMG');
		img.className = 'thumb';
		if (files[0].type.indexOf("image") == 0){
			var reader = new FileReader();
			reader.onload = function(e){
				img.src = e.target.result;
			}
			reader.readAsDataURL(files[0]);
		}
		this.appendChild(img);
		return false;
	};
}
