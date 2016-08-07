<?php
session_start();
//Import store functions.
include ('store_000_functions.php');
$set_list_table = $_SESSION['set_list_table'];
$sport = $_SESSION['sport'];
$year = $_SESSION['year'];
$letter = $_SESSION['letter'];

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if(isset($_POST['cart']))
	{
		//Update the local variables.
		$set_name = $_SESSION['set_name'];
		$set_table = $_SESSION['set_table'];
		//Cycle through the data in the form and compare with $_SESSION['array'].
		for($j = 0; $j < count($_SESSION['array']); $j++)
		{
            //Get the card_id and quantity available.
            $card_id = $_SESSION['array'][$j][5];
			$qty = $_SESSION['array'][$j][0];
            //Sanitize the user input.
			$qty_update = sanitize_string($_POST[$_SESSION['array'][$j][5]]);
            //If the user didn't add a card, set the quantity to 0.
            if($qty_update == '')
            {$qty_update = 0;}
			//Validate the form input
			if(is_numeric($qty_update))
			{
                //Make sure the qty is greater than 0.
				 if($qty_update > 0)
				 {
                     $in_cart = false;
                     //Check to see if the card is already in the cart.
                     foreach($_SESSION['cart'] as $cart_item)
                     {
                         if($card_id == $cart_item['card_id'])
                         {$in_cart = true;}
                     }
					//Adjust the quantity to qty in stock.
					if($qty_update > $qty)
					{
						$qty_update = $qty;
					}
                    if($in_cart == false)
                    {
    					$cart_array = array();
    					$cart_array['set_table'] = $_SESSION['array'][$j][6];
    					$cart_array['card_id'] = $_SESSION['array'][$j][5];
    					$cart_array['qty'] = $qty_update;
    					$cart_array['total_qty'] = $_SESSION['array'][$j][0];
    					$cart_array['cond'] = $_SESSION['array'][$j][3];
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
			$temp = $key;
		}
		$temp_array = explode(":", $temp);
		$_SESSION['set'] = $year . ' ' . $temp_array[0];
		$set_name = $temp_array[0];
		$_SESSION['set_name'] = $set_name;
		$set_table = $temp_array[1];
		$_SESSION['set_table'] = $set_table;
	}
}//end if statement that checks to see if the form was submitted
//Connect to the db.
require ('store_db_connect.php');
//Get the table name.
$q = "SELECT *
	  FROM $set_table
	  WHERE quantity > 0";
//Run the query
$r = @mysqli_query ($dbc, $q);
//If it runs ok, display the records
	if ($r)
	{
		//Create the header.
		include ('store_00_header.php');
		echo '<body>
				<div class="container_03">
					<div class="body_left_cards">
					</div>
					<div class="body_center">
						<form method="POST" action="store_05_view.php">';
		//Create a 2 dimmensional array to store the results of the query.
		$resultsArray = array();
		$resultsRow = array();
		//initailize the counter
		$counter = 0;
		//Fetch and process the query results.
		while($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
		{	
			//store the query results in the resultsRow array
			$resultsRow[0] = $row['quantity'];
			$resultsRow[1] = $row['card_number'];
			$resultsRow[2] = $row['name'];
			$resultsRow[3] = $row['cond'];
			$resultsRow[4] = $row['cond_price'];
			$resultsRow[5] = $row['card_id'];
			$resultsRow[6] = $set_table;
			$resultsRow[7] = $row['price'];
			$resultsRow[8] = $row['img_front'];
			$resultsRow[9] = $row['img_back'];
		  
			//Add the resultsRow array to the resultsArray.
			$resultsArray[$counter] = $resultsRow;		
			//Update the counter.
			$counter++;		   
		}
		
		//add the results array to the session array
		$_SESSION['array'] = $resultsArray;
		//display the results
		for($i=0; $i < count($resultsArray); $i++)
		{
			
			echo'
			<div class="card">
				<div class="image">' . $resultsArray[$i][8] . '</div>
				<div class="card_info">
					<div class="card_info_text">
						<span>' . $year . '</span>
						<span>' . $set_name . '</span>
					</div>
					<div class="card_info_text">
						<span>Price: $' . $resultsArray[$i][4] . '</span>
					</div>
					<div class="card_info_text">
						<span>' . $resultsArray[$i][1] . '</span>
						<span>' . $resultsArray[$i][2] . '</span>
					</div>
					<div class="card_info_text">
						<span>In Stock: ' . $resultsArray[$i][0] . '</span>
					</div>
					<div class="card_info_text">
						<span>Condition: ' . $resultsArray[$i][3] . '</span>
					</div>
					<div class="card_info_text">
						<input style="width:50px; text-align:right;" name="' . $resultsArray[$i][5] . '"
							type="text" autocomplete="off" />
						<input name="cart" type="submit" value="Add to Cart" />
					</div>
				</div>
			</div>';	  
		}//end of for loop

		mysqli_free_result ($r); // Free up the resources.	
		}//end of if statement that checks to see if the query ran ok																		
 else //start else: query didn't run
	{
		echo mysqli_error($dbc) . '<br>Query: ' . $q . '<br>';
	}//end of else where query did not run*/
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