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

function destroy_session(){
	$_SESSION = array();
	if(session_id() != '' || isset($_COOKIE[session_name()])){
	setcookie(session_name(),'',time()-2592000, '/');
	}
	session_destroy();
}

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

function create_letter_buttons(){
?>
				<div class="first_button_row">
<?php
	$letters = range('A', 'Z');
	for($i = 0; $i < 26; $i++){
		if($i <= 25){
?>
					<input name="letter" type="submit" class="medium green button" value="<?php echo $letters[$i] ?>" />
<?php
		}
		if($letters[$i] == 'G' || $letters[$i] == 'N' || $letters[$i] == 'U'){
?>
				</div>
				<div>
<?php
		}
		
		
	}
?>
					<input name="letter" type="submit" class="medium green button btn_hidden" value="I" />
					<input name="letter" type="submit" class="medium green button" value="%" />
				</div>
<?php
}
?>