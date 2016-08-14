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

function create_sport_buttons(){
	echo'
	<p>
		<input name="sport" class="xlarge green button" type="submit" value="Baseball" />
		<input name="sport" class="xlarge green button" type="submit" value="Football" />
		<input name="sport" class="xlarge green button" type="submit" value="Basketball" />
		<input name="sport" class="xlarge green button" type="submit" value="Hockey" />
	</p>
	<p>
		<input name="sport" class="xlarge green button" type="submit" value="Nonsports" />
		<input name="sport" class="xlarge green button" type="submit" value="Multisport" />
		<input name="sport" class="xlarge green button" type="submit" value="Racing" />
		<input name="sport" class="xlarge green button" type="submit" value="Wrestling" />
	</p>
	<p>
		<input name="sport" class="xlarge green button" type="submit" value="Soccer" />
		<input name="sport" class="xlarge green button" type="submit" value="Golf" />
		<input name="sport" class="xlarge green button" type="submit" value="Magic" />
		<input name="sport" class="xlarge green button" type="submit" value="YuGiOh" />
	</p>
	<p>
		<input name="sport" class="xlarge green button" type="submit" value="Pokemon" />
		<input name="sport" class="xlarge green button" type="submit" value="Gaming" />
		<input name="sport" class="xlarge green button" type="submit" value="Diecast" />
		<input name="sport" class="xlarge green button btn_hidden" type="submit" value="Diecast" />
	</p>';
}

function create_year_buttons(){
	echo' <p>';
	$counter = 0;//create a counter to put paragraph breaks between the rows
	for($i = 1960; $i < 2020; $i++){
		if($counter == 10){
			$counter = 0;
			echo '<br>';
		}
		
		if($i <= 2016){
			echo '<input name="year" type="submit" class="large green button" value="' . $i . '" />';
		}
		else{
			echo '<input name="year" type="submit" class="large green button btn_hidden" value="' . $i . '" />';
		}
		$counter++;
	}
	echo' </p>';
}

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