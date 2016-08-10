<?php
function sanitize_string($var)
{
    if(get_magic_quotes_gpc())
    {
        $var = stripslashes($var);
    }
    $var = htmlentities($var);
    $var = strip_tags($var);
    return $var;
}

function sanitize_mysql($var)
{
    $var = mysql_real_escape_string($var);
    $var = sanitze_string($var);
    return $var;
}

echo'
<script>
function open_image(str, index)
{
	var xhttp = new XMLHttpRequest();
	var view = document.getElementById(str).name;
	var post_data = "view=" + view + "&index=" + index;
	xhttp.onreadystatechange = function() 
	{
		if (xhttp.readyState == 4 && xhttp.status == 200) 
		{
			if(view == "front")
			{
				document.getElementById(str).name = "back";
			}
			else
			{
				document.getElementById(str).name = "front";
			}
			//Change the thumbnail view.
			var new_src = xhttp.responseText;
			document.getElementById(str).src = new_src;

			//Get the <span> element that closes the popup.
			var span = document.getElementByClassName("close");
			//Set the large image.
			document.getElementById("large_image").style.src = new_src;
			//Set the div to visible;
			document.getElementById("image_popup").style.display = "block";
		}
	};
	xhttp.open("POST", "store_001_open_image.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(post_data);
}
</script>';
?>