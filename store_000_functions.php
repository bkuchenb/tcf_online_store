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
<script type="text/javascript">
function open_image(id, index)
{	
	var xhttp = new XMLHttpRequest();
	var view = document.getElementById(id).name;
	var post_data = "view=" + view + "&index=" + index;
	xhttp.onreadystatechange = function() 
	{
		if (xhttp.readyState == 4 && xhttp.status == 200) 
		{
			if(view == "front")
			{
				document.getElementById(id).name = "back";
			}
			else
			{
				document.getElementById(id).name = "front";
			}
			//Change the thumbnail view.
			var new_src = xhttp.responseText;
			document.getElementById(id).src = new_src;
		}
	};
	xhttp.open("POST", "store_001_open_image.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(post_data);
}
</script>';
/*
	
	//Get the image location.
	var url = document.getElementById(id).src;
	//Set the image background of the large_image_div.
	document.getElementById(large_image_div).style.background-image="url("url")";
	//Make the popup div visible.
	document.getElementById(popup).style.display = "block";
*/
?>