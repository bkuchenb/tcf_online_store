//Check to make sure browser supports HTML5 drag and drop.
if(window.FileReader){
	addEventHandler(window, 'load', function(){
		var image_box   = document.getElementsByIdClassName('image_box');
		function cancel(e){
			if(e.preventDefault){
				e.preventDefault();
			}
			return false;
		}
		//Tell the browser that we can drop on these elements.
		for(var i = 0; i < image_box.length; i++){
			addEventHandler(image_box[i], 'dragover', cancel);
			addEventHandler(image_box[i], 'dragenter', cancel);
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
        obj.attachEvent('on'+evt, handler);
    }
	else{
        // Old school method.
        obj['on'+evt] = handler;
    }
}

addEventHandler(image_box, 'drop', function(e){
	//Get window.event if e argument missing (in IE)
	e = e || window.event;
	//Stop the browser from redirecting off to the image.
	if(e.preventDefault){
		e.preventDefault();
	} 

	var dt    = e.dataTransfer;
	var files = dt.files;
	for(var i = 0; i < files.length; i++){
		var file = files[i];
		var reader = new FileReader();
		//Attach event handlers here...
   
		reader.readAsDataURL(file);
	}
  return false;
});