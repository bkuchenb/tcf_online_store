//Prevent the browser from opening images in a new page.
window.addEventListener("dragover", function(e){
  e = e || event;
  e.preventDefault();
},false);
window.addEventListener("drop",function(e){
  e = e || event;
  e.preventDefault();
},false);
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
		//Display the number of files added.
		var files = e.dataTransfer.files;
		this.innerHTML = files[0].name;
		return false;
	};
}
/* //Check to make sure browser supports HTML5 drag and drop.
if(window.FileReader){
	console.log('window.FileReader = true')
	addEventHandler(window, 'load', function(){
		function cancel(e){
			if(e.preventDefault){
				e.preventDefault();
			}
			return false;
		}
		console.log(image_box.length);
		//Tell the browser that we can drop on these elements.
		for(var i = 0; i < image_box.length; i++){
			addEventHandler(image_box[i], 'dragover', cancel);
			addEventHandler(image_box[i], 'dragenter', cancel);
			addEventHandler(image_box[i], 'drop', function(e){
				//Get window.event if e argument missing (in IE)
				e = e || window.event;
				//Stop the browser from redirecting off to the image.
				if(e.preventDefault){
					e.preventDefault();
				} 

				var dt = e.dataTransfer;
				var files = dt.files;
				for(var i = 0; i < files.length; i++){
					var file = files[i];
					var reader = new FileReader();
					//Attach event handlers here...
			   
					reader.readAsDataURL(file);
				}
				return false;
			});
		}
	});
}
else{ 
  console.log('Your browser does not support the HTML5 FileReader.');
}

//Cancel the browser's default behavior.
function addEventHandler(obj, evt, handler){
    if(obj.addEventListener){
        //W3C method.
        obj.addEventListener(evt, handler, false);
    } 
	else if(obj.attachEvent){
        //IE method.
        obj.attachEvent('on' + evt, handler);
    }
	else{
        // Old school method.
        obj['on' + evt] = handler;
    }
} */