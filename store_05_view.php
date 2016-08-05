<?php
session_start();

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
    					$cart_array['cond'] = $_SESSION['array'][$j][7];
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
						<div class="body_table_header_cards">
							<form method="POST" action="store_05_view.php">
							<table class="table_cards">
								<thead>
									<tr class="table_cards_row_header">
										<th class="table_cell_100">Year</th>
										<th class="table_cell_150">Set</th>
										<th class="table_cell_50">#</th>
										<th class="table_cell_350">Item Description</th>
										<th class="table_cell_100">Condition</th>
										<th class="table_cell_100">Price</th>
										<th class="table_cell_50">Qty</th>
										<th class="table_cell_100 table_cell_btn">
											<input name="cart" type="submit" value="Add to Cart" /></th>
									</tr>
								</thead>
							</table>
						</div>
					<div class="body_table_cards">
						<table class="table_cards">
							<tbody>';
		//create a 2 dimmensional array to store the results of the query
		$resultsArray = array();
		$resultsRow = array();
		//initailize the counter
		$counter = 0;
		//fetch and process the query results
	while($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
	{	
	  //store the query results in the resultsRow array
	  $resultsRow[0] = $row['quantity'];
	  $resultsRow[1] = $row['card_number'];
	  $resultsRow[2] = $row['name'];
	  $resultsRow[3] = $row['price'];
	  $resultsRow[4] = $row['cond_price'];
	  $resultsRow[5] = $row['card_id'];
	  $resultsRow[6] = $set_table;
	  //Determine the condition from the price.
	  $price = (float) $row['price'];
	  $cond_price = (float) $row['cond_price'];
	  if($cond_price >= $price)
	  {
		  $resultsRow[7] = 'NM-MT';
	  }
	  elseif($cond_price >= ($price * .5))
	  {
		  $resultsRow[7] = 'NM';
	  }
	  elseif($cond_price >= ($price * .3))
	  {
		  $resultsRow[7] = 'EX-MT';
	  }
	  elseif($cond_price >= ($price * .2))
	  {
		  $resultsRow[7] = 'EX';
	  }
	  elseif($cond_price >= ($price * .15))
	  {
		  $resultsRow[7] = 'VG-EX';
	  }
	  elseif($cond_price >= ($price * .1))
	  {
		  $resultsRow[7] = 'VG';
	  }
	  elseif($cond_price >= ($price * .05))
	  {
		  $resultsRow[7] = 'GOOD';
	  }
	  else
	  {
		  $resultsRow[7] = 'POOR';
	  }
	  //add the resultsRow array to the resultsArray
	  $resultsArray[$counter] = $resultsRow;	  
	  //update the counter
	  $counter++;		   
	}//end while statement
	
	//add the results array to the session array
	$_SESSION['array'] = $resultsArray;
	//display the results
	for($i=0; $i < count($resultsArray); $i++)
	{
	  echo '<tr class="table_cards_row">
      <td class="table_cell_100">' . $year . '</td>
	  <td class="table_cell_150">' . mb_strimwidth($set_name, 0, 20, "...") . '</td>
	  <td class="table_cell_50">' . $resultsArray[$i][1] . '</td>
	  <td class="table_cell_350">' . mb_strimwidth($resultsArray[$i][2], 0, 45, "...") . '</td>
	  <td class="table_cell_100">' . $resultsArray[$i][7] . '</td>
	  <td class="table_cell_100 align_right">$' . $resultsArray[$i][4] . '</td>
	  <td class="table_cell_50 align_right">' . $resultsArray[$i][0] . '</td>
	  <td class="table_cell_100 table_cards_cell_qty">
		<input class="txt_qty align_right" name="' . $resultsArray[$i][5] . '" type="text" /></td>
	  </tr>';
	}//end of for loop

	mysqli_free_result ($r); // Free up the resources.	
	}//end of if statement that checks to see if the query ran ok																				
 else //start else: query didn't run
	{
		echo mysqli_error($dbc) . '<br>Query: ' . $q . '<br>';
	}//end of else where query did not run*/
echo'
						</tbody>
					</table>
				</form>
			</div>
		</div>
		<div class="body_right_cards">
		</div>
	</div>
</body>
<footer>
<div class="container_04">Icons made by <a href="http://www.flaticon.com/authors/stephen-hutchings" title="Stephen Hutchings">Stephen Hutchings</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
</footer>
</html>';

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
?>