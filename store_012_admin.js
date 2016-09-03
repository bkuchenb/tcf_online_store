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
	for(var j = 0; j < page_elements.length; j++){
		if(page_elements[j]['file_front'] != 'empty'){
			upload_images(page_elements[j]['file_front'], 'front', j);
		}
		if(page_elements[j]['file_back'] != 'empty'){
			upload_images(page_elements[j]['file_back'], 'back', j);
		}
	}
}, false);
//Create a two dimmensional array to save page elements.
var page_elements = [];

//Get all the add quantity, conditions, and price inputs.
var input_adds = document.getElementsByName('input_add');
var input_conds = document.getElementsByName('input_cond');
var input_prices = document.getElementsByName('input_price');
//Get all the image location inputs.
var input_fronts = document.getElementsByName('input_front');
var input_backs = document.getElementsByName('input_back');
//Get all the image_box divs.
var image_box_fronts = document.getElementsByName('image_box_front');
var image_box_backs = document.getElementsByName('image_box_back');

//Add all page elements to the page_elements array.
for(var k = 0; k < image_box_fronts.length; k++){
	page_elements.push({
		input_add: input_adds[k],
		input_cond: input_conds[k],
		input_price: input_prices[k],
		input_front: input_fronts[k],
		input_back: input_backs[k],
		image_box_front: image_box_fronts[k],
		image_box_back: image_box_backs[k],
		file_front: 'empty',
		file_back: 'empty'
		});
}

//Add an event listener to each of the drop boxes.
for(var i = 0; i < image_box_fronts.length; i++){
	//When an image is dropped in the box, save the file.
	!function outer(i){
		image_box_fronts[i].addEventListener('drop', function inner(event){
			event.preventDefault();
			//Get the files added.
			var files = event.dataTransfer.files;
			if(files[0].type.indexOf("image") == 0){
				page_elements[i]['file_front'] = files[0];
				//Change the text displayed.
				this.innerHTML = files[0].name;
			}
		}, false);
		image_box_backs[i].addEventListener('drop', function inner(event){
			event.preventDefault();
			//Get the files added.
			var files = event.dataTransfer.files;
			if(files[0].type.indexOf("image") == 0){
				page_elements[i]['file_back'] = files[0];
				//Change the text displayed.
				this.innerHTML = files[0].name;
			}
		}, false);
	}(i)
}

function upload_images(file, orient, index){
	var xhttp = new XMLHttpRequest();
	var formdata = new FormData();
	formdata.append('image', file);
	xhttp.onreadystatechange = function(){
		if (xhttp.readyState == 4 && xhttp.status == 200){
			//Get the response from ajax.
			var image_uploaded = xhttp.responseText;
			if(image_uploaded){
				//Update the input text boxes.
				var id_str = 'input_' + orient + '_' + index;
				document.getElementById(id_str).value = file.name;
				var id_str = 'drop_' + orient + '_' + index;
				document.getElementById(id_str).innerHTML = 'Drop';
			}
		}
	}
	xhttp.open('POST', 'store_001_save_file.php', true);
	xhttp.send(formdata);
}