<?php
//Include the head.
include ('store_000_head.php');
//Update the local variables.
$set_list_table = $_SESSION['set_list_table'];
$sport = $_SESSION['sport'];
$year = $_SESSION['year'];
$letter = $_SESSION['letter'];
if(isset($_SESSION['set_table'])){
	$set_table = $_SESSION['set_table'];
}
if(isset($_SESSION['set_name'])){
	$set_name = $_SESSION['set_name'];
}
//Process the submitted form.
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	//Update the cart if it was submitted.
	if(isset($_POST['cart']) && isset($_SESSION['array'])){		
		//Cycle through the data in the form and compare with $_SESSION['array'].
		for($j = 0; $j < count($_SESSION['array']); $j++){
            //Get the card_id and quantity available.
            $card_id = $_SESSION['array'][$j]['card_id'];
			$qty = $_SESSION['array'][$j]['quantity'];
            //Sanitize the user input.
			$qty_update = sanitize_string($_POST[$_SESSION['array'][$j]['card_id']]);
            //If the user didn't add a card, set the quantity to 0.
            if($qty_update == ''){
				$qty_update = 0;
			}
			//Validate the form input
			if(is_numeric($qty_update)){
				//Set default value for card found in cart.
				$in_cart = false;
                //Make sure the qty is greater than 0.
				if($qty_update > 0){
					if(!isset($_SESSION['cart'])){
						$_SESSION['cart'] = array();
					}
					else{
						//Check to see if the card is already in the cart.
						foreach($_SESSION['cart'] as $cart_item){
							if($card_id == $cart_item['card_id']){
								$in_cart = true;
							}
						} 
					}
					//Adjust the quantity to qty in stock.
					if($qty_update > $qty){
						$qty_update = $qty;
					}
                    if($in_cart == false){
    					$cart_array = array();
						$cart_array['sport'] = $sport;
						$cart_array['year'] = $year;
						$cart_array['set_name'] = $set_name;
    					$cart_array['set_table'] = $_SESSION['set_table'];
    					$cart_array['card_id'] = $_SESSION['array'][$j]['card_id'];
    					$cart_array['qty'] = $qty_update;
    					$cart_array['total_qty'] = $_SESSION['array'][$j]['quantity'];
    					$cart_array['cond'] = $_SESSION['array'][$j]['cond'];
    					array_push($_SESSION['cart'], $cart_array);
                    }
				}
			}//End of if statement that validates numeric input.
		}//End of for statement that cycles through $_SESSION['array'].
	}//End of if that checks to see if items were added to the cart.
	else{
		//Get the values passed from the previous page.
		foreach($_POST as $key => $value){
			if($value == 'View'){
				$set_name = $key;
			}
			if($value == 'Hidden'){
				$set_table = $key;
			}
		}
		//Add the set_name and set_table to the session.
		$_SESSION['set_name'] = $set_name;
		$_SESSION['set_table'] = $set_table;
	}
}//End of if statement that checks to see if the form was submitted.
//Include the header.
include ('store_00_header.php');
//Get all the card data stored in set_table.
$q = "SELECT *
	  FROM $set_table
	  LIMIT 100";
//Run the query.
$r = mysqli_query($dbc, $q);
//If it runs okay, display the records.
	if($r){
echo'
<body>
	<div class="container_03_admin">
		<div class="body_admin_header">
			<div class="admin_add">Add</div>
			<div class="admin_qty">Qty</div>
			<div class="admin_desc">Description</div>
			<div class="admin_price">Price</div>
			<div class="admin_cond">Cond</div>
			<div class="admin_price_cond">C_Price</div>
			<div class="admin_front">Img(F)</div>
			<div class="admin_back">Img(B)</div>
			<div class="admin_front">Front</div>
			<div class="admin_back">Back</div>
		</div>
		<div class="body_admin">
			<form method="POST" action="store_012_admin.php" enctype="mulitpart/form-data">';
		//Create an array to store the results of the query.
		$resultsArray = array();
		//Initailize the counter.
		$counter = 0;
		//Fetch and process the query results.
		while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){	
			//Store the query results in the resultsRow array
			$resultsArray[$counter] = $row;		
			//Update the counter.
			$counter++;		   
		}
		//Add the results array to the session array.
		$_SESSION['array'] = $resultsArray;
		//Display the results.
		for($i=0; $i < count($resultsArray); $i++){
			echo'
					<div>
						<input class="admin_text_add" name="input_add" id="input_add_' . $resultsArray[$i]['card_id'] . '" type="text" />
						<div class="admin_qty" name="qty" id="qty_' . $resultsArray[$i]['card_id'] . '">' . $resultsArray[$i]['quantity'] . '</div>
						<div class="admin_desc">' . $year . ' ' . $set_name . ' '
							. $resultsArray[$i]['card_number'] . ' ' . $resultsArray[$i]['name'] . '</div>
						<div class="admin_price">' . $resultsArray[$i]['price'] . '</div>
						<input class="admin_text_cond" name="input_cond" id="input_cond_' . $resultsArray[$i]['card_id'] . '"
							type="text" value="' . $resultsArray[$i]['cond'] . '" />
						<input class="admin_text_price" name="input_price" id="input_price_' . $resultsArray[$i]['card_id'] . '"
							type="text "value="' . $resultsArray[$i]['cond_price'] . '" />
						<input class="admin_text_front" name="input_front" id="input_front_' . $resultsArray[$i]['card_id'] . '"
									value="' . $resultsArray[$i]['img_front'] . '" />
						<input class="admin_text_back" name="input_back" id="input_back_' . $resultsArray[$i]['card_id'] . '"
									value="' . $resultsArray[$i]['img_back'] . '" />
						<div class="image_box" name="image_box_front" id="drop_front_' . $resultsArray[$i]['card_id'] . '">Drop</div>
						<div class="image_box" name="image_box_back" id="drop_back_' . $resultsArray[$i]['card_id'] . '">Drop</div>
						<input type="hidden" name="card_id" value="' . $resultsArray[$i]['card_id'] . '" />
					</div>';
		}//End of for loop that displays results.
		//Free up the resources.
		mysqli_free_result ($r); 
	}//End of if statement that checks to see if the query ran okay.																	
	else{
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
<script type="text/javascript" src="store_012_admin.js"></script>
</body>
</html>';
?>