<?php
session_start();
if(isset($_POST['create_empty']))
{
	//Update the local variables.
	$set_name = $_SESSION['set_name'];
	$set_table = $_SESSION['set_table'];
	//Cycle through the data in the form and compare with $_SESSION['array'].
	for($j = 0; $j < count($_SESSION['array']); $j++)
	{
		$qty = $_SESSION['array'][$j][0];
		$qty_update = sanitize_string($_POST[$_SESSION['array'][$j][5]]);
		if($qty_update == '')
		{$qty_update = 0;}
		//Validate the form input
		if(is_numeric($qty_update))
		{
			 if($qty_update > 0)
			 {
				//Adjust the quantity to qty in stock.
				if($qty_update > $qty)
				{
					$qty_update = $qty;
				}
				$cart_array = array();
				$cart_array['set_table'] = $_SESSION['array'][$j][6];
				$cart_array['card_id'] = $_SESSION['array'][$j][5];
				$cart_array['qty'] = $qty_update;
				$cart_array['total_qty'] = $_SESSION['array'][$j][0];
				$cart_array['cond'] = $_SESSION['array'][$j][7];
				array_push($_SESSION['cart'], $cart_array);
			 }
		}//end of if statement that checks if the form data is a number
		else
		{
			//echo '<center>Error: non-numeric value entered.</center>';
		}
		}//end of for statement that cycles through the form data
	echo'
	<form method="POST" action="store_06_cart.php">
			 <input name="empty" type="submit" value="Empty Cart" />
	</form>';
}

<script>
			params = "createButton"
			request = new ajaxRequest()
			request.open("POST", "store_001_createButton.php", true)
			request.setRequestHeader("Content-type", "application.x-www-form-urlencoded")
			request.setRequestHeader("Content-length", params.length)
			request.setRequestHeader("Connection", "close")
			
			request.onreadystatechange = function()
			{
				if(this.readyState == 4)
				{
					if(this.status == 200)
					{
						if(this.responseText != null)
						{
							document.getElementByClassName(\'\').innerHTML = this.responseText
						}
						else alert("Ajax error: No data received")
					}
					else alert("Ajax error:" + this.statusText)
				}
			}
			request.send(params)
			function ajaxRequest()
			{
				try
				{
					var request = new XMLHttpRequest()
				}
				catch(e1)
				{
					try
					{
						request = new ActiveXObject("Msxml2.XMLHTTP")
					}
					catch(e2)
					{
						try
						{
							request = new ActiveXObject("Microsoft.XMLHTTP")
						}
						catch(e3)
						{
							request = false
						}
					}
				}
				return request
			}
			</script>
			<script>
			function create_empty()
			{
			  var xhttp = new XMLHttpRequest();
			  xhttp.onreadystatechange = function() 
			  {
				if (xhttp.readyState == 4 && xhttp.status == 200) 
				{
					document.getElementByClassName("navbar_right").innerHTML = xhttp.responseText;
				}
			  };
			  xhttp.open("POST", "store_001_createButton", true);
			  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			  xhttp.send("create_empty=1");
			}
			</script>
?>