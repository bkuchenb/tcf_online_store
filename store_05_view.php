<?php
//Start a session to save user input.
session_start();
//Import store functions.
include ('store_000_functions.php');
//Update the local variables.
$set_list_table = $_SESSION['set_list_table'];
$sport = $_SESSION['sport'];
$year = $_SESSION['year'];
$letter = $_SESSION['letter'];
if(isset($_SESSION['set_table']))
{
	$set_table = $_SESSION['set_table'];
}
if(isset($_SESSION['set_name']))
{
	$set_name = $_SESSION['set_name'];
}
//Process a submitted form.
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	//Update the cart if it was submitted.
	if(isset($_POST['cart']) && isset($_SESSION['array']))
	{		
		//Cycle through the data in the form and compare with $_SESSION['array'].
		for($j = 0; $j < count($_SESSION['array']); $j++)
		{
            //Get the card_id and quantity available.
            $card_id = $_SESSION['array'][$j]['card_id'];
			$qty = $_SESSION['array'][$j]['quantity'];
            //Sanitize the user input.
			$qty_update = sanitize_string($_POST[$_SESSION['array'][$j]['card_id']]);
            //If the user didn't add a card, set the quantity to 0.
            if($qty_update == '')
            {$qty_update = 0;}
			//Validate the form input
			if(is_numeric($qty_update))
			{
				//Set default value for card found in cart.
				$in_cart = false;
                //Make sure the qty is greater than 0.
				 if($qty_update > 0)
				 {
                     if(!isset($_SESSION['cart']))
					 {
						 $_SESSION['cart'] = array();
					 }
					 else
					 {
						 //Check to see if the card is already in the cart.
						 foreach($_SESSION['cart'] as $cart_item)
						 {
							 if($card_id == $cart_item['card_id'])
							 {$in_cart = true;}
						 } 
					 }
                     
					//Adjust the quantity to qty in stock.
					if($qty_update > $qty)
					{
						$qty_update = $qty;
					}
                    if($in_cart == false)
                    {
    					$cart_array = array();
    					$cart_array['set_table'] = $_SESSION['set_table'];
    					$cart_array['card_id'] = $_SESSION['array'][$j]['card_id'];
    					$cart_array['qty'] = $qty_update;
    					$cart_array['total_qty'] = $_SESSION['array'][$j]['quantity'];
    					$cart_array['cond'] = $_SESSION['array'][$j]['cond'];
    					array_push($_SESSION['cart'], $cart_array);
                    }
				 }
			}//end of if statement that checks if the form data is a number
			else
			{
				//echo '<center>Error: non-numeric value entered.</center>';
			}
		}//end of for statement that cycles through the form data
	}
	else
	{
		//Get the values passed from the previous page.
		foreach($_POST as $key => $value)
		{
			if($value == 'View')
			{$set_name = $key;}
			if($value == 'Hidden')
			{$set_table = $key;}
		
		}
		//Add the set_name and set_table to the session.
		$_SESSION['set_name'] = $set_name;
		$_SESSION['set_table'] = $set_table;
	}
}//End of if statement that checks to see if the form was submitted
//Connect to the db.
require ('store_db_connect.php');
//Get all the card data store in set_table.
$q = "SELECT *
	  FROM $set_table
	  WHERE quantity > 0
	  AND img_front <>''";
//Run the query.
$r = @mysqli_query ($dbc, $q);
//If it runs okay, display the records.
	if ($r)
	{
		//Create the header.
		include ('store_00_header.php');
		echo '<body>
				<div class="container_03">
					<div class="body_left_cards">
					</div>
					<div class="body_center">
						<div id="image_popup" class="image_popup">
							<img id="large_image" src="">
							<span class="close">x</span>
						</div>
						<form method="POST" action="store_05_view.php">';
		//Create an array to store the results of the query.
		$resultsArray = array();
		//Initailize the counter.
		$counter = 0;
		//Fetch and process the query results.
		while($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
		{	
			//Store the query results in the resultsRow array
			$resultsArray[$counter] = $row;		
			//Update the counter.
			$counter++;		   
		}
		
		//Add the results array to the session array.
		$_SESSION['array'] = $resultsArray;
		//Display the results.
		for($i=0; $i < count($resultsArray); $i++)
		{
			
			echo'
			<div class="card">
				<div class="image" >
					<img class="thumb" name="front" id="' . $resultsArray[$i]['card_id'] . '"
						onclick="open_image(' . $resultsArray[$i]['card_id'] . ',' .  $i . ')"
						src="' . $resultsArray[$i]['img_front'] . '">
				</div>
				<div class="card_info">
					<div class="card_info_text">
						<span>' . $year . '</span>
						<span>' . $set_name . '</span>
					</div>
					<div class="card_info_text">
						<span>Price: $' . $resultsArray[$i]['cond_price'] . '</span>
					</div>
					<div class="card_info_text">
						<span>' . $resultsArray[$i]['card_number'] . '</span>
						<span>' . $resultsArray[$i]['name'] . '</span>
					</div>
					<div class="card_info_text">
						<span>In Stock: ' . $resultsArray[$i]['quantity'] . '</span>
					</div>
					<div class="card_info_text">
						<span>Condition: ' . $resultsArray[$i]['cond'] . '</span>
					</div>
					<div class="card_info_text">
						<input style="width:50px; text-align:right;" name="' . $resultsArray[$i]['card_id'] . '"
							type="text" autocomplete="off" />
						<input name="cart" type="submit" value="Add to Cart" />
					</div>
				</div>
			</div>';	  
		}//End of for loop.

		mysqli_free_result ($r); //Free up the resources.	
		}//End of if statement that checks to see if the query ran okay.																	
 else//The query did not run okay.
	{
		//Print an error message.
		echo mysqli_error($dbc) . '<br>Query: ' . $q . '<br>';
		echo '<br>There was a problem finding what you requested.<br>';
	}
echo'
			</form>
		</div>
		<div class="body_right_cards">
		</div>
	</div>
</body>
<footer>
<div class="container_04">Icons made by <a href="http://www.flaticon.com/authors/stephen-hutchings" title="Stephen Hutchings">Stephen Hutchings</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
</footer>
</html>';
?>