<?php
session_start();
$year = $_SESSION['year'];
$set_name = $_SESSION['set_name'];

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_qty']))
{
    //Create a new array to store cards to be deleted.
    $delete = array();
	//Cycle through the data in the form and compare with $_SESSION['cart'].
	foreach($_SESSION['cart'] as $key => $entry)
	{
		$qty = $entry['qty'];
		$qty_update = sanitize_string($_POST[$entry['card_id']]);
		//Validate the form input
		if(is_numeric($qty_update))
		{
			 if($qty_update != $qty)
			 {
				//Adjust the quantity to qty in stock.
				if($qty_update > $entry['total_qty'])
				{
					$qty_update = $qty;
				}
				elseif($qty_update == 0)
				{
					array_push($delete, $key);
				}
				else
				{
					$_SESSION['cart'][$key]['qty'] = $qty_update;
				}
			 }
		}//end of if statement that checks if the form data is a number
	}//end of for statement that cycles through the form data
    //Delete the cards where qty was set to 0.
    foreach($delete as $value)
    {
        unset($_SESSION['cart'][$value]);
    }  
}
elseif($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['empty']))
{
	$_SESSION['cart'] = array();
}
//Create the header and table.
include ('store_00_header.php');
//Connect to the db.
require ('store_db_connect.php');
echo '<body>
		<div class="container_03">
			<div class="body_left_cards">
			</div>
			<div class="body_center">
				<div class="body_table_header_cards">
					<form method="POST" action="store_06_cart.php">
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
									<input name="update_qty" type="submit" value="Update Cart" /></th>
							</tr>
						</thead>
					</table>
				</div>
			<div class="body_table_cards">
				<table class="table_cards">
					<tbody>';
		foreach($_SESSION['cart'] as $entry)
		{
			$set_table = $entry['set_table'];
			$card_id = $entry['card_id'];
			//Get the table name.
			$q = "SELECT *
				  FROM $set_table
				  WHERE card_id = $card_id";
			//Run the query
			$r = @mysqli_query ($dbc, $q);
			//If it runs ok, display the records
			if ($r)
			{
				//Fetch the results.
				while($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
				{
					echo '<tr class="table_cards_row">
							  <td class="table_cell_100">' . $year . '</td>
							  <td class="table_cell_150">' . mb_strimwidth($set_name, 0, 20, "...") . '</td>
							  <td class="table_cell_50">' . $row['card_number'] . '</td>
							  <td class="table_cell_350">' . mb_strimwidth($row['name'], 0, 45, "...") . '</td>
							  <td class="table_cell_100">' . $entry['cond'] . '</td>
							  <td class="table_cell_100 align_right">$' . $row['cond_price'] . '</td>
							  <td class="table_cell_50 align_right">' . $entry['qty'] . '</td>
							  <td class="table_cell_100 table_cards_cell_qty">
								<input class="txt_qty align_right" name="' . $entry['card_id'] . '" type="text" 
									value=""/></td>
							  </tr>';
				}
			}
			else //start else: query didn't run
			{
				echo mysqli_error($dbc) . '<br>Query: ' . $q . '<br>';
			}//end of else where query did not run*/
		}
echo'
						</form>
					</tbody>
				</table>
			</div>
		</div>
		<div class="body_right_cards">
			<form method="GET" action="store_06_cart.php">
			 <input name="empty" type="submit" value="Empty Cart" />
			</form>
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