//Create an array to save page data.
var page_data = get_page_data();

//Add an event listener to each of the drop boxes.
for(var i = 0; i < page_data.length; i++){
	//When an image is dropped in the box, save the file.
	!function outer(i){
		page_data[i]['element_image_box_front'].addEventListener('drop', function inner(event){
			event.preventDefault();
			//Get the files added.
			var files = event.dataTransfer.files;
			if(files[0].type.indexOf("image") == 0){
				page_data[i]['value_file_front'] = files[0];
				//Change the text displayed.
				this.innerHTML = files[0].name;
			}
		}, false);
		page_data[i]['element_image_box_back'].addEventListener('drop', function inner(event){
			event.preventDefault();
			//Get the files added.
			var files = event.dataTransfer.files;
			if(files[0].type.indexOf("image") == 0){
				page_data[i]['value_file_back'] = files[0];
				//Change the text displayed.
				this.innerHTML = files[0].name;
			}
		}, false);
	}(i)
}

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
	//Get the updated page data.
	var page_data_update = get_page_data();
	//Find the changes that were made and update the database.
	for(var j = 0; j < page_data.length; j++){
		if(page_data[j]['value_add'] != page_data_update[j]['value_add'] ||
			page_data[j]['value_cond'] != page_data_update[j]['value_cond'] ||
			page_data[j]['value_price'] != page_data_update[j]['value_price'] ||
			page_data[j]['value_file_front'] != page_data_update[j]['value_file_front'] ||
			page_data[j]['value_file_back'] != page_data_update[j]['value_file_back']){
				//Add the front image to page_data_update.
				page_data_update[j]['value_file_front'] = page_data[j]['value_file_front'];
				//Add the back image to page_data_update.
				page_data_update[j]['value_file_back'] = page_data[j]['value_file_back'];
				update_database(page_data_update[j]);
			}
	}
}, false);

function get_page_data(){
	//Create a temp array to hold the page elements
	var temp = [];
	//Get the qty and card_id elements.
	var quantities = document.getElementsByName('qty');
	var ids = document.getElementsByName('card_id');
	//Get all the add quantity, condition, and price inputs.
	var input_adds = document.getElementsByName('input_add');
	var input_conds = document.getElementsByName('input_cond');
	var input_prices = document.getElementsByName('input_price');
	//Get all the image location inputs.
	var input_fronts = document.getElementsByName('input_front');
	var input_backs = document.getElementsByName('input_back');
	//Get all the image_box divs.
	var image_box_fronts = document.getElementsByName('image_box_front');
	var image_box_backs = document.getElementsByName('image_box_back');

	//Add all page elements to the temp array.
	for(var k = 0; k < image_box_fronts.length; k++){
		temp.push({
			'value_card_id': ids[k].value,
			'element_input_add': input_adds[k],
			'value_add': input_adds[k].value,
			'value_qty': quantities[k].innerHTML,
			'element_input_cond': input_conds[k],
			'value_cond': input_conds[k].value,
			'element_input_price': input_prices[k],
			'value_price': input_prices[k].value,
			'element_input_front': input_fronts[k],
			'element_input_back': input_backs[k],
			'element_image_box_front': image_box_fronts[k],
			'element_image_box_back': image_box_backs[k],
			'value_file_front': 'empty',
			'value_file_back': 'empty'
			});
	}
	return temp;
}

function update_database(obj){
	var xhttp = new XMLHttpRequest();
	var formdata = new FormData();
	formdata.append('card_id', obj['value_card_id']);
	formdata.append('add', obj['value_add']);
	formdata.append('qty', obj['value_qty']);
	formdata.append('cond', obj['value_cond']);
	formdata.append('cond_price', obj['value_price']);
	formdata.append('file_front', obj['value_file_front']);
	formdata.append('file_back', obj['value_file_back']);
	xhttp.onreadystatechange = function(){
		if (xhttp.readyState == 4 && xhttp.status == 200){
			//Get the response from ajax.
			var image_uploaded = xhttp.responseText;
			if(image_uploaded){
				//Update the input text boxes.
				obj['element_input_front'].value = obj['value_file_front'].name;
				obj['element_image_box_front'].innerHTML = 'Drop';
			}
		}
	}
	xhttp.open('POST', 'store_001_save_file.php', true);
	xhttp.send(formdata);
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