<?php
function sanitize_string($var){
    if(get_magic_quotes_gpc()){
        $var = stripslashes($var);
    }
    $var = htmlentities($var);
    $var = strip_tags($var);
    return $var;
}

function sanitize_mysql($var){
    $var = mysql_real_escape_string($var);
    $var = sanitze_string($var);
    return $var;
}
?>
<?php
function create_sport_buttons(){
?>
				<div class="first_button_row">
					<input name="sport" class="xlarge green button" type="submit" value="Baseball" />
					<input name="sport" class="xlarge green button" type="submit" value="Football" />
					<input name="sport" class="xlarge green button" type="submit" value="Basketball" />
					<input name="sport" class="xlarge green button" type="submit" value="Hockey" />
				</div>
				<div>
					<input name="sport" class="xlarge green button" type="submit" value="Nonsports" />
					<input name="sport" class="xlarge green button" type="submit" value="Multisport" />
					<input name="sport" class="xlarge green button" type="submit" value="Racing" />
					<input name="sport" class="xlarge green button" type="submit" value="Wrestling" />
				</div>
				<div>
					<input name="sport" class="xlarge green button" type="submit" value="Soccer" />
					<input name="sport" class="xlarge green button" type="submit" value="Golf" />
					<input name="sport" class="xlarge green button" type="submit" value="Magic" />
					<input name="sport" class="xlarge green button" type="submit" value="YuGiOh" />
				</div>
				<div>
					<input name="sport" class="xlarge green button" type="submit" value="Pokemon" />
					<input name="sport" class="xlarge green button" type="submit" value="Gaming" />
					<input name="sport" class="xlarge green button" type="submit" value="Diecast" />
					<input name="sport" class="xlarge green button btn_hidden" type="submit" value="Diecast" />
				</div>
<?php
}
?>
<?php
function create_year_buttons(){
	//Create the buttons.
	for($i = 1960; $i < 2020; $i++){
		if($i <= 2016){
			if($i == 1960){
?>
				<div class="first_button_row">
<?php
			}
			elseif(substr(strval($i), -1) == '0'){
?>
				<div>
<?php
			}
?>
					<input name="year" type="submit" class="large green button" value="<?php echo $i ?>" />
<?php
			if(substr(strval($i), -1) == '9'){
?>
				</div>
<?php
			}
		}
		else{
?>
					<input name="year" type="submit" class="large green button btn_hidden" value="<?php echo $i ?>" />
<?php
			if(substr(strval($i), -1) == '9'){
?>
				</div>
<?php
			}
		}		
	}
}
?>

<?php
function create_letter_buttons(){
	echo'
	<p>';
		$counter = 0;//create a counter to put paragraph breaks between the rows
		$letters = range('A', 'Z');
		for($i = 0; $i < 26; $i++){
			if($counter == 7)
			{
				$counter = 0;
				echo '</p><p>';
			}
			
			if($i <= 25)
			{echo '<input name="letter" type="submit" class="medium green button" value="' . $letters[$i] . '" />';}
			$counter++;
		}
		echo '
		<input name="letter" type="submit" class="medium green button btn_hidden" value="I" />
		<input name="letter" type="submit" class="medium green button" value="%" />
	</p>';
}
?>